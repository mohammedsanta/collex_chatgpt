<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Domain\Reports\Actions\CreateReportExport;
use App\Domain\Reports\Jobs\GenerateReportExport;
use App\Domain\Reports\Models\ReportExport;
use App\Domain\Reports\Queries\GetReportExportsByUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\StoreReportExportRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ReportExportController extends Controller
{
    public function __construct(
        private readonly GetReportExportsByUser $getReportExportsByUser,
        private readonly CreateReportExport $createReportExport,
    ) {
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', ReportExport::class);

        $filters = $request->only([
            'search',
            'type',
            'status',
        ]);

        $exports = ($this->getReportExportsByUser)(
            $request->user(),
            $filters,
        );

        $baseQuery = ReportExport::query();

        // Scope statistics to the authenticated user's exports.
        $statsQuery = (clone $baseQuery)
            ->where('user_id', $request->user()->getKey());

        $stats = [
            [
                'label' => 'إجمالي الطلبات',
                'value' => (clone $statsQuery)->count(),
                'icon' => 'fa-file-export',
            ],
            [
                'label' => 'قيد الانتظار',
                'value' => (clone $statsQuery)
                    ->where('status', 'pending')
                    ->count(),
                'icon' => 'fa-clock',
            ],
            [
                'label' => 'جارٍ التجهيز',
                'value' => (clone $statsQuery)
                    ->where('status', 'processing')
                    ->count(),
                'icon' => 'fa-gears',
            ],
            [
                'label' => 'ملفات جاهزة',
                'value' => (clone $statsQuery)
                    ->where('status', 'completed')
                    ->count(),
                'icon' => 'fa-circle-check',
            ],
        ];

        $reportTypes = [
            'collection' => 'تقرير التحصيل',
            'performance' => 'تقرير الأداء',
            'payment' => 'تقرير المدفوعات',
            'portfolio' => 'تقرير النطاق',
            'dcr' => 'تقرير التحصيل اليومي',
        ];

        $formats = [
            'xlsx' => 'Excel',
            'csv' => 'CSV',
            'pdf' => 'PDF',
        ];

        $statuses = [
            'pending' => 'قيد الانتظار',
            'processing' => 'جارٍ التجهيز',
            'completed' => 'مكتمل',
            'failed' => 'فشل',
            'expired' => 'منتهي',
        ];

        return view('reports.exports', compact(
            'exports',
            'stats',
            'filters',
            'reportTypes',
            'formats',
            'statuses',
        ));
    }


    public function store(StoreReportExportRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['user_id'] = $request->user()->getKey();

        $export = $this->createReportExport->execute($data);

        GenerateReportExport::dispatch($export);

        return redirect()
            ->route('reports.exports')
            ->with('success', 'تم إنشاء طلب التصدير بنجاح.');
    }


public function download(
    ReportExport $export
) {
    $this->authorize('view', $export);

    if ($export->status !== 'completed') {
        return redirect()
            ->route('reports.exports')
            ->with(
                'error',
                'لا يمكن تحميل التقرير؛ حالة التقرير الحالية: '
                . $export->status
            );
    }

    if (blank($export->file_path)) {
        return redirect()
            ->route('reports.exports')
            ->with('error', 'ملف التقرير غير مرتبط بالسجل.');
    }

    $disk = \Illuminate\Support\Facades\Storage::disk('local');

    if (! $disk->exists($export->file_path)) {
        return redirect()
            ->route('reports.exports')
            ->with(
                'error',
                'ملف التقرير غير موجود على السيرفر. أعد إنشاء التقرير.'
            );
    }

    return $disk->download(
        $export->file_path,
        basename($export->file_path),
    );
}

    public function retry(ReportExport $export): RedirectResponse
    {
        $this->authorize('update', $export);

        abort_unless(
            in_array($export->status, ['pending', 'failed', 'expired'], true),
            422,
            'لا يمكن إعادة تشغيل طلب التصدير في حالته الحالية.',
        );

        // Reset only retryable exports.
        $export->forceFill([
            'status' => 'pending',
            'error_message' => null,
        ])->save();

        GenerateReportExport::dispatch($export);

        return redirect()
            ->route('reports.exports')
            ->with('success', 'تمت إعادة إرسال طلب التصدير للمعالجة.');
    }

    public function destroy(ReportExport $export): RedirectResponse
    {
        $this->authorize('delete', $export);

        abort_if(
            $export->status === 'processing',
            422,
            'لا يمكن حذف طلب قيد المعالجة.',
        );

        if ($export->file_path) {
            Storage::disk('local')->delete($export->file_path);
        }

        $export->delete();

        return redirect()
            ->route('reports.exports')
            ->with('success', 'تم حذف طلب التصدير بنجاح.');
    }
}