
@extends('layouts.app')

@section('title', ($bank->name ?? 'البنك') . ' | Collex')

@section('content')
<div class="space-y-6 rounded-2xl bg-slate-950 p-4 text-slate-100 md:p-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-emerald-400">COLLEX / البنوك</p>
            <h1 class="mt-2 text-3xl font-bold">{{ $bank->name }}</h1>
            <p class="mt-2 text-sm text-slate-400">
                كود البنك: {{ $bank->code }} · رقم السجل: #{{ $bank->id }}
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('banks.index') }}"
               class="rounded-xl border border-slate-700 px-4 py-3 hover:bg-slate-800">
                كل البنوك
            </a>
            <a href="{{ route('banks.edit', $bank) }}"
               class="rounded-xl bg-emerald-400 px-4 py-3 font-bold text-slate-950 hover:bg-emerald-300">
                تعديل البنك
            </a>
        </div>
    </div>

    @include('banks._nav', ['bank' => $bank])

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700 bg-emerald-950 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold">بيانات البنك</h2>
                <p class="mt-1 text-sm text-slate-400">ملخص البيانات الأساسية وحالة البنك.</p>
            </div>

            @if ($bank->is_active)
                <span class="rounded-full bg-emerald-950 px-3 py-1 text-sm text-emerald-300">
                    نشط
                </span>
            @else
                <span class="rounded-full bg-slate-800 px-3 py-1 text-sm text-slate-400">
                    غير نشط
                </span>
            @endif
        </div>

        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">القطاع</p>
                <p class="mt-2 font-semibold">{{ $bank->sector ?: 'غير محدد' }}</p>
            </div>
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">المستخدمون المرتبطون</p>
                <p class="mt-2 text-2xl font-bold">{{ number_format($bank->users_count ?? 0) }}</p>
            </div>
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">المحافظ</p>
                <p class="mt-2 text-2xl font-bold">{{ number_format($bank->portfolios_count ?? 0) }}</p>
            </div>
            <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">تاريخ الإنشاء</p>
                <p class="mt-2 font-semibold">{{ $bank->created_at?->format('Y-m-d') ?? '—' }}</p>
            </div>
        </div>

        @if ($bank->notes)
            <div class="mt-5 rounded-xl border border-slate-800 bg-slate-950 p-4">
                <p class="text-sm text-slate-500">ملاحظات</p>
                <p class="mt-2 whitespace-pre-line text-slate-300">{{ $bank->notes }}</p>
            </div>
        @endif
    </section>

    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold">محافظ البنك</h2>
                <p class="mt-1 text-sm text-slate-400">أحدث المحافظ المسجلة لهذا البنك.</p>
            </div>
            <a href="{{ route('banks.distribution.index', $bank) }}"
               class="text-sm font-semibold text-emerald-400 hover:text-emerald-300">
                عرض التوزيع ←
            </a>
        </div>

        <div class="mt-5 overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-800 text-slate-300">
                    <tr>
                        <th class="px-4 py-3">اسم المحفظة</th>
                        <th class="px-4 py-3">الفترة</th>
                        <th class="px-4 py-3">عدد الحالات</th>
                        <th class="px-4 py-3">إجمالي المديونية</th>
                        <th class="px-4 py-3">الحالة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($portfolios as $portfolio)
                        <tr>
                            <td class="px-4 py-4 font-semibold">{{ $portfolio->name }}</td>
                            <td class="px-4 py-4 text-slate-300">
                                {{ $portfolio->period_month }}/{{ $portfolio->period_year }}
                            </td>
                            <td class="px-4 py-4">{{ number_format($portfolio->cases_count ?? 0) }}</td>
                            <td class="px-4 py-4 tabular-nums">
                                {{ number_format((float) ($portfolio->total_debt ?? 0), 2) }}
                            </td>
                            <td class="px-4 py-4 text-slate-300">{{ $portfolio->status ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-500">
                                لا توجد محافظ مسجلة لهذا البنك حتى الآن.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $portfolios->links() }}</div>
    </section>

    <section class="rounded-2xl border border-rose-900/60 bg-slate-900 p-5">
        <h2 class="font-bold text-rose-300">إجراءات إدارية</h2>
        <p class="mt-2 text-sm text-slate-400">
            حذف البنك إجراء دائم وقد يتأثر بالسجلات المرتبطة به.
        </p>

        <form method="POST" action="{{ route('banks.destroy', $bank) }}"
              class="mt-4"
              onsubmit="return confirm('هل أنت متأكد من حذف هذا البنك؟')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="rounded-xl border border-rose-800 px-4 py-2 text-sm text-rose-300 hover:bg-rose-950">
                حذف البنك
            </button>
        </form>
    </section>
</div>
@endsection