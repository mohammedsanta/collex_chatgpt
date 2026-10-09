
@extends('layouts.app')

@section('title', 'لوحة البنك | Collex')

@section('content')
<div class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-emerald-400">COLLEX / مساحة العمل</p>
            <h1 class="mt-2 text-3xl font-bold">{{ $bank->name }}</h1>
            <p class="mt-2 text-sm text-slate-400">
                لوحة إدارة عمليات البنك ومحافظ التحصيل.
            </p>
        </div>

        <a href="{{ route('banks.show', $bank) }}"
           class="rounded-xl border border-slate-700 px-4 py-3 hover:bg-slate-800">
            تفاصيل البنك
        </a>
    </div>

    @include('banks._nav', ['bank' => $bank])

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            ['title' => 'العملاء', 'description' => 'استعراض العملاء المرتبطين بالبنك.', 'route' => 'banks.clients.index', 'icon' => '♙'],
            ['title' => 'توزيع المحافظ', 'description' => 'عرض المحافظ ومتابعة توزيع الحالات.', 'route' => 'banks.distribution.index', 'icon' => '⇄'],
            ['title' => 'استيراد النطاق', 'description' => 'استيراد ملف بيانات نطاق البنك.', 'route' => 'banks.scope.import', 'icon' => '↑'],
            ['title' => 'الأرشيف', 'description' => 'استعراض أرشيف البنك.', 'route' => 'banks.archives.index', 'icon' => '▣'],
            ['title' => 'وعود السداد', 'description' => 'متابعة وعود السداد المسجلة.', 'route' => 'banks.ptp.index', 'icon' => '✓'],
            ['title' => 'الزيارات', 'description' => 'متابعة الزيارات الميدانية.', 'route' => 'banks.visits.index', 'icon' => '⌖'],
            ['title' => 'الشكاوى', 'description' => 'إدارة شكاوى العملاء.', 'route' => 'banks.complaints.index', 'icon' => '!'],
            ['title' => 'تقارير DCR', 'description' => 'متابعة تقارير التحصيل اليومية.', 'route' => 'banks.dcr.index', 'icon' => '▥'],
        ] as $item)
            <a href="{{ route($item['route'], ['bank' => $bank->id]) }}"
               class="group rounded-2xl border border-slate-800 bg-slate-900 p-5 transition hover:border-emerald-500 hover:bg-slate-900/70">
                <div class="flex items-center justify-between">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-950 text-xl text-emerald-300">
                        {{ $item['icon'] }}
                    </span>
                    <span class="text-slate-500 transition group-hover:text-emerald-400">↗</span>
                </div>
                <h2 class="mt-5 text-lg font-bold">{{ $item['title'] }}</h2>
                <p class="mt-2 text-sm leading-6 text-slate-400">{{ $item['description'] }}</p>
            </a>
        @endforeach
    </div>

    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <h2 class="text-lg font-bold">أحدث المحافظ</h2>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="px-4 py-3">اسم المحفظة</th>
                        <th class="px-4 py-3">الفترة</th>
                        <th class="px-4 py-3">عدد الحالات</th>
                        <th class="px-4 py-3">المديونية</th>
                        <th class="px-4 py-3">الحالة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($portfolios as $portfolio)
                        <tr>
                            <td class="px-4 py-4 font-semibold">{{ $portfolio->name }}</td>
                            <td class="px-4 py-4">{{ $portfolio->period_month }}/{{ $portfolio->period_year }}</td>
                            <td class="px-4 py-4">{{ number_format($portfolio->cases_count ?? 0) }}</td>
                            <td class="px-4 py-4">{{ number_format((float) ($portfolio->total_debt ?? 0), 2) }}</td>
                            <td class="px-4 py-4">{{ $portfolio->status ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-500">
                                لا توجد محافظ لعرضها.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection