@extends('layouts.app')

@section('title', 'الجهات المرتبطة بالمستخدم')

@section('content')

    <x-page-header
        title="الجهات المرتبطة"
        subtitle="إدارة البنوك وشركات التقسيط التي يمكن للمستخدم العمل عليها."
        eyebrow="إدارة المستخدمين / التوزيعات"
        icon="fa-building-columns"
    >
        <x-slot:actions>
            <a href="{{ route('users.show', $user) }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للمستخدم
            </a>
        </x-slot:actions>
    </x-page-header>

    @if (session('success'))
        <div class="mb-5 rounded-xl border border-brand/20 bg-brand/5 px-4 py-3 text-xs font-bold text-brand">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 p-4 text-xs text-red-400">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="grid gap-5 xl:grid-cols-2">

        <x-panel title="ربط بنك" icon="fa-building-columns">

            <form method="POST" action="{{ route('users.banks.assign', $user) }}">
                @csrf

                <label for="bank_id" class="mb-2 block text-[10px] font-bold text-dim">
                    اختر البنك
                </label>

                <select id="bank_id" name="bank_id" required class="app-input w-full">
                    <option value="">اختر البنك</option>

                    @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}">
                            {{ $bank->name }} ({{ $bank->code }})
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="app-btn app-btn-primary mt-4">
                    <i class="fa-solid fa-link"></i>
                    ربط البنك
                </button>
            </form>

            <div class="mt-5 border-t border-white/5 pt-4">
                <p class="mb-3 text-xs font-extrabold">
                    البنوك المرتبطة حاليًا
                </p>

                <div class="space-y-2">
                    @forelse ($user->banks as $bank)
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-white/5 bg-white/[0.02] p-3">
                            <div>
                                <p class="text-xs font-bold">{{ $bank->name }}</p>
                                <p class="mt-1 text-[10px] text-dim">{{ $bank->code }}</p>
                            </div>

                            <span class="rounded-lg border border-brand/20 bg-brand/5 px-2 py-1 text-[10px] text-brand">
                                مرتبط
                            </span>
                        </div>
                    @empty
                        <p class="py-4 text-center text-xs text-dim">
                            لا توجد بنوك مرتبطة بهذا المستخدم.
                        </p>
                    @endforelse
                </div>
            </div>

        </x-panel>

        <x-panel title="ربط شركة تقسيط" icon="fa-building">

            <form method="POST" action="{{ route('users.installment-companies.assign', $user) }}">
                @csrf

                <label for="installment_company_id" class="mb-2 block text-[10px] font-bold text-dim">
                    اختر الشركة
                </label>

                <select
                    id="installment_company_id"
                    name="installment_company_id"
                    required
                    class="app-input w-full"
                >
                    <option value="">اختر الشركة</option>

                    @foreach ($installmentCompanies as $company)
                        <option value="{{ $company->id }}">
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="app-btn app-btn-primary mt-4">
                    <i class="fa-solid fa-link"></i>
                    ربط الشركة
                </button>
            </form>

            <div class="mt-5 border-t border-white/5 pt-4">
                <p class="mb-3 text-xs font-extrabold">
                    الشركات المرتبطة حاليًا
                </p>

                <div class="space-y-2">
                    @forelse ($user->installmentCompanies as $company)
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-white/5 bg-white/[0.02] p-3">
                            <p class="text-xs font-bold">{{ $company->name }}</p>

                            <span class="rounded-lg border border-brand/20 bg-brand/5 px-2 py-1 text-[10px] text-brand">
                                مرتبطة
                            </span>
                        </div>
                    @empty
                        <p class="py-4 text-center text-xs text-dim">
                            لا توجد شركات تقسيط مرتبطة بهذا المستخدم.
                        </p>
                    @endforelse
                </div>
            </div>

        </x-panel>

    </div>

@endsection