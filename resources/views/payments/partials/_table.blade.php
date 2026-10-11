```blade
{{-- Payments Table --}}
<div class="overflow-x-auto">
    <table class="app-table w-full">
        <thead>
            <tr>
                <th>الإيصال</th>
                <th>الحالة</th>
                <th>العميل</th>
                <th>الموظف</th>
                <th>المبلغ</th>
                <th>طريقة الدفع</th>
                <th>تاريخ التحصيل</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($payments as $payment)
                @include('payments.partials._row', [
                    'payment' => $payment,
                ])
            @empty
                <tr>
                    <td colspan="8">
                        <div class="app-empty py-10 text-center">
                            <i class="fa-solid fa-inbox mb-3 text-2xl"></i>

                            <p class="font-medium text-fg">
                                لا توجد تحصيلات تحتاج إلى مراجعة.
                            </p>

                            <p class="mt-2 text-sm text-muted">
                                ستظهر التحصيلات هنا عندما تكون متاحة للمراجعة.
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Rejection dialogs outside the table --}}
@foreach ($payments as $payment)
    @can('reject', $payment)
        @include('payments.partials._reject-modal', [
            'payment' => $payment,
        ])
    @endcan
@endforeach

{{-- Pagination --}}
@if ($payments->hasPages())
    <div class="border-t border-line p-4">
        {{ $payments->withQueryString()->links() }}
    </div>
@endif
```