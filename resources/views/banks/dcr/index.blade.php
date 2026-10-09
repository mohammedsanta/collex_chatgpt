@extends('layouts.app')

@section('title', 'تقارير DCR - ' . $bank->name)

@section('content')
<div dir="rtl" class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                <a href="{{ route('banks.show', $bank) }}" class="transition hover:text-emerald-400">البنوك</a>
                <i class="fa-solid fa-chevron-left text-xs"></i>
                <span>{{ $bank->name }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">تقارير التحصيل اليومية (DCR)</h1>
            <p class="mt-2 text-sm text-gray-400">متابعة أداء التحصيل اليومي، ومراجعة التقارير المرسلة من فريق البنك.</p>
        </div>
        @can('create', \App\Domain\Reports\Models\DailyCollectionReport::class)
            <a href="{{ route('banks.dcr.create', ['bank' => $bank->id]) }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-lime-400 px-5 py-3 font-bold text-gray-950 transition hover:bg-lime-300">
                <i class="fa-solid fa-plus"></i> إنشاء تقرير يومي
            </a>
        @endcan
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-300"><i class="fa-solid fa-circle-check ml-2"></i>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-300"><i class="fa-solid fa-circle-exclamation ml-2"></i>{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([['إجمالي التقارير', $stats['total'], 'fa-file-lines', 'text-white', 'bg-slate-400/10 text-slate-300'], ['تقارير اليوم', $stats['today'], 'fa-calendar-day', 'text-sky-400', 'bg-sky-400/10 text-sky-400'], ['بانتظار المراجعة', $stats['pending'], 'fa-clock', 'text-amber-400', 'bg-amber-400/10 text-amber-400'], ['تقارير معتمدة', $stats['approved'], 'fa-circle-check', 'text-emerald-400', 'bg-emerald-400/10 text-emerald-400']] as [$label, $value, $icon, $valueClass, $iconClass])
            <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
                <div class="flex items-center justify-between gap-3"><span class="text-sm text-gray-400">{{ $label }}</span><span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $iconClass }}"><i class="fa-solid {{ $icon }}"></i></span></div>
                <p class="mt-4 text-3xl font-bold {{ $valueClass }}">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
            <p class="text-sm text-gray-400">إجمالي التحصيل المعتمد</p>
            <p class="mt-3 text-2xl font-bold text-emerald-400">{{ number_format((float) $stats['collected'], 2) }} <span class="text-xs font-medium text-gray-500">جنيه</span></p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
            <p class="text-sm text-gray-400">إجمالي المبالغ الموعودة للتقارير المرسلة والمعتمدة</p>
            <p class="mt-3 text-2xl font-bold text-sky-400">{{ number_format((float) $stats['promised'], 2) }} <span class="text-xs font-medium text-gray-500">جنيه</span></p>
        </div>
    </div>

    <form method="GET" action="{{ route('banks.dcr.index', ['bank' => $bank->id]) }}" class="rounded-2xl border border-white/10 bg-gray-900/70 p-4">
        <div class="grid grid-cols-1 items-end gap-3 sm:grid-cols-2 xl:grid-cols-5">
            <div class="xl:col-span-2">
                <label for="search" class="mb-2 block text-sm text-gray-300">بحث باسم الموظف أو الكود</label>
                <input id="search" name="search" type="search" value="{{ $search }}" placeholder="اسم الموظف أو كود الموظف..." class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none placeholder:text-gray-600 focus:border-emerald-400">
            </div>
            <div>
                <label for="status" class="mb-2 block text-sm text-gray-300">حالة التقرير</label>
                <select id="status" name="status" class="w-full rounded-xl border border-white/10 bg-gray-950 px-4 py-3 text-sm text-white outline-none focus:border-emerald-400">
                    <option value="">كل الحالات</option>
                    <option value="draft" @selected($status === 'draft')>مسودة</option>
                    <option value="submitted" @selected($status === 'submitted')>مرسل للمراجعة</option>
                    <option value="approved" @selected($status === 'approved')>معتمد</option>
                    <option value="rejected" @selected($status === 'rejected')>مرفوض</option>
                </select>
            </div>
            <div>
                <label for="date_from" class="mb-2 block text-sm text-gray-300">من تاريخ</label>
                <input id="date_from" type="date" name="date_from" value="{{ $dateFrom }}" class="w-full rounded-xl border border-white/10 bg-gray-950 px-3 py-3 text-sm text-white outline-none focus:border-emerald-400">
            </div>
            <div>
                <label for="date_to" class="mb-2 block text-sm text-gray-300">إلى تاريخ</label>
                <input id="date_to" type="date" name="date_to" value="{{ $dateTo }}" class="w-full rounded-xl border border-white/10 bg-gray-950 px-3 py-3 text-sm text-white outline-none focus:border-emerald-400">
            </div>
            <div class="flex gap-2 sm:col-span-2 xl:col-span-5">
                <button type="submit" class="rounded-xl bg-lime-400 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-lime-300"><i class="fa-solid fa-filter ml-1"></i> تطبيق الفلاتر</button>
                <a href="{{ route('banks.dcr.index', ['bank' => $bank->id]) }}" class="rounded-xl border border-white/10 px-4 py-3 text-sm text-gray-300 transition hover:bg-white/5">إعادة ضبط</a>
            </div>
        </div>
    </form>

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-gray-900/70">
        <div class="flex flex-col justify-between gap-2 border-b border-white/10 px-5 py-4 sm:flex-row sm:items-center">
            <div><h2 class="font-bold text-white">سجل تقارير البنك</h2><p class="mt-1 text-xs text-gray-500">النتائج المعروضة: {{ $reports->total() }} تقرير</p></div>
            <span class="text-xs text-gray-400">{{ $reports->firstItem() ?? 0 }}–{{ $reports->lastItem() ?? 0 }} من {{ $reports->total() }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1050px] text-right text-sm">
                <thead class="border-b border-white/10 bg-white/[0.02] text-xs text-gray-400"><tr>
                    <th class="px-5 py-4 font-medium">الموظف</th><th class="px-5 py-4 font-medium">تاريخ التقرير</th><th class="px-5 py-4 font-medium">القضايا</th><th class="px-5 py-4 font-medium">المكالمات</th><th class="px-5 py-4 font-medium">الزيارات</th><th class="px-5 py-4 font-medium">الوعود</th><th class="px-5 py-4 font-medium">الموعود</th><th class="px-5 py-4 font-medium">المحصل</th><th class="px-5 py-4 font-medium">الحالة</th><th class="px-5 py-4 font-medium">الإجراءات</th>
                </tr></thead>
                <tbody class="divide-y divide-white/5">
                @forelse ($reports as $report)
                    @php($statusMap = ['draft' => ['مسودة', 'border-slate-400/20 bg-slate-400/10 text-slate-300'], 'submitted' => ['بانتظار المراجعة', 'border-amber-400/20 bg-amber-400/10 text-amber-300'], 'approved' => ['معتمد', 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300'], 'rejected' => ['مرفوض', 'border-red-400/20 bg-red-400/10 text-red-300']])
                    <tr class="transition hover:bg-white/[0.02]">
                        <td class="px-5 py-4"><div class="font-semibold text-white">{{ $report->user?->name ?? 'موظف غير متاح' }}</div><div class="mt-1 text-xs text-gray-500">{{ $report->user?->employee_code ?? '—' }}</div></td>
                        <td class="px-5 py-4 text-gray-300">{{ $report->report_date?->format('Y-m-d') ?? '—' }}</td>
                        <td class="px-5 py-4 text-gray-300">{{ number_format($report->cases_worked) }}</td><td class="px-5 py-4 text-gray-300">{{ number_format($report->calls_count) }}</td><td class="px-5 py-4 text-gray-300">{{ number_format($report->visits_count) }}</td><td class="px-5 py-4 text-gray-300">{{ number_format($report->promises_count) }}</td>
                        <td class="px-5 py-4 text-sky-300">{{ number_format((float) $report->promised_amount, 2) }}</td><td class="px-5 py-4 font-semibold text-emerald-300">{{ number_format((float) $report->collected_amount, 2) }}</td>
                        <td class="px-5 py-4"><span class="inline-flex rounded-full border px-3 py-1 text-xs font-semibold {{ $statusMap[$report->status][1] ?? 'border-white/10 text-gray-300' }}">{{ $statusMap[$report->status][0] ?? $report->status }}</span>
                            @if ($report->status === 'rejected' && $report->notes)<p class="mt-2 max-w-xs text-xs leading-5 text-red-300">{{ $report->notes }}</p>@endif
                        </td>
                        <td class="px-5 py-4"><div class="flex flex-wrap gap-2">
                            @can('submit', $report)
                                <form method="POST" action="{{ route('banks.dcr.submit', ['bank' => $bank->id, 'dailyReport' => $report->id]) }}" onsubmit="return confirm('هل تريد إرسال هذا التقرير للمراجعة؟')">@csrf<button class="rounded-lg border border-sky-400/20 bg-sky-400/10 px-3 py-2 text-xs font-semibold text-sky-300 hover:bg-sky-400/20">إرسال للمراجعة</button></form>
                            @endcan
                            @can('approve', $report)
                                <form method="POST" action="{{ route('banks.dcr.approve', ['bank' => $bank->id, 'dailyReport' => $report->id]) }}" onsubmit="return confirm('تأكيد اعتماد التقرير؟')">@csrf<button class="rounded-lg border border-emerald-400/20 bg-emerald-400/10 px-3 py-2 text-xs font-semibold text-emerald-300 hover:bg-emerald-400/20">اعتماد</button></form>
                            @endcan
                            @can('reject', $report)
                                <form method="POST" action="{{ route('banks.dcr.reject', ['bank' => $bank->id, 'dailyReport' => $report->id]) }}" class="flex max-w-sm gap-2">@csrf<input name="reason" required minlength="3" maxlength="2000" placeholder="سبب الرفض" class="min-w-28 rounded-lg border border-white/10 bg-gray-950 px-2 py-2 text-xs text-white outline-none focus:border-red-400"><button class="rounded-lg border border-red-400/20 bg-red-400/10 px-3 py-2 text-xs font-semibold text-red-300 hover:bg-red-400/20">رفض</button></form>
                            @endcan
                            @if (!auth()->user()->can('submit', $report) && !auth()->user()->can('approve', $report) && !auth()->user()->can('reject', $report))<span class="text-xs text-gray-600">—</span>@endif
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="px-5 py-14 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 text-gray-500"><i class="fa-solid fa-file-circle-xmark text-xl"></i></div><h3 class="mt-4 font-bold text-white">لا توجد تقارير مطابقة</h3><p class="mt-2 text-sm text-gray-500">جرّب تغيير الفلاتر أو أنشئ تقريرًا يوميًا جديدًا.</p></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if ($reports->hasPages())<div class="border-t border-white/10 px-5 py-4">{{ $reports->links() }}</div>@endif
    </div>
</div>
@endsection
