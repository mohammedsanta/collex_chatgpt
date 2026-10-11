<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Actions\CreatePayment;
use App\Domain\Payments\Actions\DeletePayment;
use App\Domain\Payments\Actions\UpdatePayment;
use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Queries\GetPendingPayments;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\CreatePaymentRequest;
use App\Http\Requests\Payments\UpdatePaymentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Payment::class);
        $payments = Payment::query()->with(['debtCase.client', 'collector'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest('created_at')->paginate(25)->withQueryString();
        return view('payments.index', compact('payments'));
    }


    public function confirmations(
        Request $request,
        GetPendingPayments $getPendingPayments
    ): View {
        $this->authorize('viewAny', Payment::class);

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $pendingQuery = Payment::query()
            ->where('status', 'pending');

        $paymentsQuery = $getPendingPayments->execute()
            ->when(
                filled($filters['search'] ?? null),
                function ($query) use ($filters): void {
                    $search = trim($filters['search']);

                    $query->where(function ($nestedQuery) use ($search): void {
                        $nestedQuery
                            ->where('receipt_number', 'like', "%{$search}%")
                            ->orWhereHas('debtCase.client', function ($clientQuery) use ($search): void {
                                $clientQuery->where('name', 'like', "%{$search}%");
                            });
                    });
                }
            )
            ->when(
                filled($filters['date_from'] ?? null),
                fn ($query) => $query->whereDate('paid_at', '>=', $filters['date_from'])
            )
            ->when(
                filled($filters['date_to'] ?? null),
                fn ($query) => $query->whereDate('paid_at', '<=', $filters['date_to'])
            );

        $statistics = [
            'count' => (clone $pendingQuery)->count(),
            'amount' => (clone $pendingQuery)->sum('amount'),
            'today_count' => (clone $pendingQuery)
                ->whereDate('paid_at', today())
                ->count(),
        ];

        $payments = $paymentsQuery
            ->orderBy('paid_at')
            ->paginate(15)
            ->withQueryString();

        return view('payments.confirmations', compact(
            'payments',
            'statistics'
        ));
    }


    public function create(): View
    {
        $this->authorize('create', Payment::class);
        return view('payments.create', ['debtCases' => DebtCase::query()->with('client')->whereIn('status', ['active','legal'])->orderByDesc('id')->limit(500)->get()]);
    }

    public function store(CreatePaymentRequest $request, CreatePayment $action): RedirectResponse|Payment
    {
        $data = $request->validated();
        $data['collector_id'] ??= $request->user()->getAuthIdentifier();
        $payment = $action->execute($data, (int) $request->user()->getAuthIdentifier());
        return $request->expectsJson() ? $payment : redirect()->route('payments.show', $payment)->with('status', 'تم تسجيل الدفعة وهي بانتظار التأكيد.');
    }

    public function show(Payment $payment): View|Payment
    {
        $this->authorize('view', $payment);
        $payment->load(['debtCase.client', 'collector', 'confirmedBy', 'promise']);
        return request()->expectsJson() ? $payment : view('payments.show', compact('payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment, UpdatePayment $action): RedirectResponse|Payment
    {
        $updated = $action->execute($payment, $request->validated());
        return $request->expectsJson() ? $updated : redirect()->route('payments.show', $updated)->with('status', 'تم تحديث بيانات الدفعة.');
    }

    public function destroy(Request $request, Payment $payment, DeletePayment $action): RedirectResponse|null
    {
        $this->authorize('delete', $payment);
        $action->execute($payment);
        return $request->expectsJson() ? null : redirect()->route('payments.index')->with('status', 'تم حذف الدفعة المعلقة.');
    }
}
