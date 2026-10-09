
@extends('layouts.app')

@section('title', 'عملاء البنك')

@section('content')
<div dir="rtl" class="space-y-6">

    <x-page-header
        title="عملاء البنك"
        subtitle="عرض العملاء المرتبطين بحالات مديونية تابعة للبنك."
        eyebrow="البنوك / العملاء"
        icon="fa-users"
    >
        <x-slot:actions>
            <a
                href="{{ route('banks.clients.assign', ['bank' => $bank->id]) }}"
                class="app-btn app-btn-primary"
            >
                <i class="fa-solid fa-layer-group"></i>
                توزيع الحالات
            </a>
        </x-slot:actions>
    </x-page-header>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <x-panel
        title="بيانات العملاء"
        subtitle="البنك: {{ $bank->name }}"
        icon="fa-user-group"
    >
        <form
            method="GET"
            action="{{ route('banks.clients.index', ['bank' => $bank->id]) }}"
            class="mb-5 flex flex-col gap-3 sm:flex-row"
        >
            <input
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="ابحث بالاسم أو كود العميل أو الرقم القومي..."
                class="app-input min-w-0 flex-1"
            >

            <button type="submit" class="app-btn app-btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
                بحث
            </button>

            @if ($search !== '')
                <a
                    href="{{ route('banks.clients.index', ['bank' => $bank->id]) }}"
                    class="app-btn app-btn-secondary"
                >
                    مسح البحث
                </a>
            @endif
        </form>

        <div class="mb-4 flex flex-wrap gap-3 text-sm text-gray-400">
            <span>
                إجمالي النتائج:
                <strong class="text-emerald-300">{{ $clients->total() }}</strong>
            </span>
            <span>
                البنك:
                <strong class="text-white">{{ $bank->name }}</strong>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[750px] text-right text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-gray-400">
                        <th class="px-4 py-3 font-medium">اسم العميل</th>
                        <th class="px-4 py-3 font-medium">كود العميل</th>
                        <th class="px-4 py-3 font-medium">الرقم القومي</th>
                        <th class="px-4 py-3 font-medium">المحافظة</th>
                        <th class="px-4 py-3 font-medium">عدد الحالات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    @forelse ($clients as $client)
                        <tr class="transition hover:bg-white/[0.03]">
                            <td class="px-4 py-4 font-semibold">
                                {{ $client->name }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $client->code ?: '—' }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $client->national_id ?: '—' }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $client->governorate?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="rounded-lg bg-emerald-500/10 px-3 py-1 text-emerald-300">
                                    {{ $client->bank_cases_count }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-400">
                                @if ($search !== '')
                                    لا توجد نتائج مطابقة لعبارة البحث.
                                @else
                                    لا يوجد عملاء مرتبطون بحالات مديونية لهذا البنك.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5 border-t border-white/10 pt-5">
            {{ $clients->links() }}
        </div>
    </x-panel>
</div>
@endsection