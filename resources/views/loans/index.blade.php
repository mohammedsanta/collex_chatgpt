
@extends('layouts.app')

@section('title', 'القروض | Collex')
@section('topbar-title', 'إدارة القروض')

@section('content')
    <x-page-header
        title="إدارة القروض"
        subtitle="متابعة ملفات القروض والمديونيات والتحصيل وحالة كل ملف."
        eyebrow="القروض والتحصيل"
        icon="fa-file-invoice-dollar"
    >
        <x-slot:actions>
            <span class="app-badge app-badge-gray">
                <i class="fa-solid fa-folder-open"></i>
                {{ number_format($cases->total()) }} ملف
            </span>

            <a href="{{ route('loans.create') }}" class="app-btn app-btn-primary">
                <i class="fa-solid fa-plus"></i>
                إضافة قرض
            </a>
        </x-slot:actions>
    </x-page-header>

    @php
        $statistics = $statistics ?? [];

        $loanStatusLabels = [
            'active' => 'نشط',
            'paid' => 'مسدد',
            'overdue' => 'متأخر',
            'closed' => 'مغلق',
        ];

        $loanStatusClasses = [
            'active' => 'app-badge-blue',
            'paid' => 'app-badge-green',
            'overdue' => 'app-badge-red',
            'closed' => 'app-badge-gray',
        ];

        $currentFilters = $filters ?? [];
        $hasFilters = collect($currentFilters)->contains(
            fn ($value) => filled($value)
        );
    @endphp

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="app-flash app-flash-success" role="status">
            <i class="fa-solid fa-circle-check mt-1"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="app-flash app-flash-error" role="alert">
            <i class="fa-solid fa-circle-exclamation mt-1"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Statistics --}}
    <div class="mb-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-stat-card
            label="إجمالي القروض"
            :value="number_format($statistics['total'] ?? 0)"
            icon="fa-file-invoice-dollar"
            color="blue"
            hint="إجمالي الملفات المسجلة"
        />

        <x-stat-card
            label="القروض النشطة"
            :value="number_format($statistics['active'] ?? 0)"
            icon="fa-chart-line"
            color="green"
            hint="الملفات قيد المتابعة"
        />

        <x-stat-card
            label="إجمالي المتأخرات"
            :value="number_format((float) ($statistics['overdue'] ?? 0), 2)"
            icon="fa-clock"
            color="orange"
            hint="المبالغ المتأخرة عن السداد"
        />

        <x-stat-card
            label="إجمالي المحصل"
            :value="number_format((float) ($statistics['collected'] ?? 0), 2)"
            icon="fa-money-bill-transfer"
            color="purple"
            hint="إجمالي المبالغ المحصلة"
        />
    </div>

    {{-- Search and filters --}}
    <section class="app-card mb-5">
        <div class="app-card-header">
            <div class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-xl border border-brand/15 bg-brand/10 text-brand">
                    <i class="fa-solid fa-filter"></i>
                </span>

                <div>
                    <h2 class="text-sm font-extrabold text-fg">البحث والتصفية</h2>
                    <p class="mt-1 text-[11px] text-muted">
                        حدد معايير البحث للوصول إلى ملف القرض المطلوب.
                    </p>
                </div>
            </div>

            @if ($hasFilters)
                <span class="app-badge app-badge-blue">
                    <i class="fa-solid fa-sliders"></i>
                    توجد تصفية نشطة
                </span>
            @endif
        </div>

        <div class="app-card-body">
            <form method="GET" action="{{ route('loans.index') }}" class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    <div>
                        <label for="loan-search" class="app-label">البحث</label>

                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-xs text-dim"></i>

                            <input
                                id="loan-search"
                                type="search"
                                name="search"
                                value="{{ $currentFilters['search'] ?? request('search', '') }}"
                                placeholder="رقم القرض أو اسم العميل..."
                                class="app-input pr-9"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="bank-filter" class="app-label">البنك</label>

                        <select id="bank-filter" name="bank_id" class="app-input">
                            <option value="">كل البنوك</option>

                            @foreach ($banks as $bank)
                                <option
                                    value="{{ $bank->id }}"
                                    @selected((string) ($currentFilters['bank_id'] ?? request('bank_id', '')) === (string) $bank->id)
                                >
                                    {{ $bank->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status-filter" class="app-label">حالة القرض</label>

                        <select id="status-filter" name="status" class="app-input">
                            <option value="">كل الحالات</option>
                            <option value="active" @selected(($currentFilters['status'] ?? request('status', '')) === 'active')>نشط</option>
                            <option value="paid" @selected(($currentFilters['status'] ?? request('status', '')) === 'paid')>مسدد</option>
                            <option value="overdue" @selected(($currentFilters['status'] ?? request('status', '')) === 'overdue')>متأخر</option>
                            <option value="closed" @selected(($currentFilters['status'] ?? request('status', '')) === 'closed')>مغلق</option>
                        </select>
                    </div>

                    <div>
                        <label for="assignment-filter" class="app-label">الإسناد</label>

                        <select id="assignment-filter" name="assignment" class="app-input">
                            <option value="">كل ملفات الإسناد</option>
                            <option value="assigned" @selected(($currentFilters['assignment'] ?? request('assignment', '')) === 'assigned')>
                                مسند لموظف
                            </option>
                            <option value="unassigned" @selected(($currentFilters['assignment'] ?? request('assignment', '')) === 'unassigned')>
                                غير مسند
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 border-t border-line pt-4">
                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        بحث
                    </button>

                    <a href="{{ route('loans.index') }}" class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-rotate-right"></i>
                        إعادة تعيين
                    </a>

                    <span class="text-[11px] text-muted sm:mr-auto">
                        النتائج:
                        <span class="font-extrabold text-fg">{{ number_format($cases->total()) }}</span>
                        ملف
                    </span>
                </div>
            </form>
        </div>
    </section>

    {{-- Loans table --}}
    <section class="app-card">
        <div class="app-card-header">
            <div class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-xl border border-brand/15 bg-brand/10 text-brand">
                    <i class="fa-solid fa-table-list"></i>
                </span>

                <div>
                    <h2 class="text-sm font-extrabold text-fg">سجلات القروض</h2>
                    <p class="mt-1 text-[11px] text-muted">
                        بيانات العملاء والديون والتحصيل وحالة الملف.
                    </p>
                </div>
            </div>

            <span class="app-badge app-badge-gray">
                الصفحة {{ number_format($cases->currentPage()) }}
                من {{ number_format(max(1, $cases->lastPage())) }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="app-table">
                <thead>
                    <tr>
                        <th>رقم القرض</th>
                        <th>العميل</th>
                        <th>البنك</th>
                        <th>إجمالي الدين</th>
                        <th>المتأخرات</th>
                        <th>المحصل</th>
                        <th>أيام التأخير</th>
                        <th>موظف التحصيل</th>
                        <th>الحالة</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($cases as $case)
                        @php
                            $status = strtolower((string) $case->status);
                            $statusClass = $loanStatusClasses[$status] ?? 'app-badge-yellow';
                            $statusLabel = $loanStatusLabels[$status] ?? str_replace('_', ' ', $status ?: 'غير محدد');
                        @endphp

                        <tr>
                            <td>
                                <span class="font-extrabold text-fg">
                                    {{ $case->loan_number ?: '—' }}
                                </span>
                                <p class="mt-1 text-[10px] text-dim">
                                    ID: {{ $case->id }}
                                </p>
                            </td>

                            <td>
                                <span class="font-bold text-fg">
                                    {{ $case->client?->name ?? '—' }}
                                </span>

                                @if ($case->client?->national_id)
                                    <p class="mt-1 text-[10px] text-dim">
                                        {{ $case->client->national_id }}
                                    </p>
                                @endif
                            </td>

                            <td>
                                <span class="text-xs text-muted">
                                    {{ $case->bank?->name ?? '—' }}
                                </span>
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold text-fg">
                                    {{ number_format((float) $case->total_debt, 2) }}
                                </span>
                                <span class="text-[10px] text-dim">ج.م</span>
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold {{ (float) $case->overdue_amount > 0 ? 'text-danger' : 'text-muted' }}">
                                    {{ number_format((float) $case->overdue_amount, 2) }}
                                </span>
                            </td>

                            <td>
                                <span class="num whitespace-nowrap font-bold text-brand">
                                    {{ number_format((float) $case->collected_amount, 2) }}
                                </span>
                            </td>

                            <td>
                                <span class="num font-bold {{ (int) ($case->dpd ?? 0) > 0 ? 'text-warning' : 'text-muted' }}">
                                    {{ number_format((int) ($case->dpd ?? 0)) }}
                                </span>
                            </td>

                            <td>
                                @if ($case->assignedUser?->name)
                                    <span class="inline-flex items-center gap-2 whitespace-nowrap text-xs text-fg">
                                        <span class="grid h-7 w-7 place-items-center rounded-lg bg-white/[0.05] text-brand">
                                            <i class="fa-solid fa-user text-[10px]"></i>
                                        </span>
                                        {{ $case->assignedUser->name }}
                                    </span>
                                @else
                                    <span class="app-badge app-badge-gray">غير مسند</span>
                                @endif
                            </td>

                            <td>
                                <span class="app-badge {{ $statusClass }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    {{ $statusLabel }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-0">
                                <div class="app-empty">
                                    <span class="app-empty-icon">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </span>

                                    <h3 class="text-sm font-extrabold text-fg">
                                        لا توجد قروض مطابقة
                                    </h3>

                                    <p class="mt-2 max-w-sm text-xs leading-6 text-muted">
                                        جرّب تغيير معايير البحث أو أضف قرضًا جديدًا.
                                    </p>

                                    <div class="mt-5 flex flex-wrap justify-center gap-2">
                                        @if ($hasFilters)
                                            <a href="{{ route('loans.index') }}" class="app-btn app-btn-secondary">
                                                <i class="fa-solid fa-rotate-right"></i>
                                                إعادة تعيين البحث
                                            </a>
                                        @endif

                                        <a href="{{ route('loans.create') }}" class="app-btn app-btn-primary">
                                            <i class="fa-solid fa-plus"></i>
                                            إضافة قرض
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Styled pagination --}}
        @if ($cases->hasPages())
            @php
                $currentPage = $cases->currentPage();
                $lastPage = $cases->lastPage();
                $startPage = max(1, $currentPage - 2);
                $endPage = min($lastPage, $currentPage + 2);
                $pagination = $cases->appends(request()->query());
            @endphp

            <div class="flex flex-col gap-4 border-t border-line px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-[11px] text-muted">
                    عرض
                    <span class="font-extrabold text-fg">{{ number_format($cases->firstItem()) }}</span>
                    إلى
                    <span class="font-extrabold text-fg">{{ number_format($cases->lastItem()) }}</span>
                    من
                    <span class="font-extrabold text-fg">{{ number_format($cases->total()) }}</span>
                    نتيجة
                </p>

                <nav aria-label="التنقل بين صفحات القروض" class="flex flex-wrap items-center gap-1.5">
                    @if ($cases->onFirstPage())
                        <span class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.02] px-3 text-xs text-dim opacity-50">
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            السابق
                        </span>
                    @else
                        <a href="{{ $pagination->previousPageUrl() }}"
                           rel="prev"
                           class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            السابق
                        </a>
                    @endif

                    @if ($startPage > 1)
                        <a href="{{ $pagination->url(1) }}"
                           class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted hover:border-brand/30 hover:text-brand">
                            1
                        </a>

                        @if ($startPage > 2)
                            <span class="px-1 text-xs text-dim">…</span>
                        @endif
                    @endif

                    @foreach (range($startPage, $endPage) as $page)
                        @if ($page === $currentPage)
                            <span aria-current="page"
                                  class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-brand/30 bg-brand/10 px-3 text-xs font-extrabold text-brand">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $pagination->url($page) }}"
                               aria-label="الصفحة {{ $page }}"
                               class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="px-1 text-xs text-dim">…</span>
                        @endif

                        <a href="{{ $pagination->url($lastPage) }}"
                           class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted hover:border-brand/30 hover:text-brand">
                            {{ $lastPage }}
                        </a>
                    @endif

                    @if ($cases->hasMorePages())
                        <a href="{{ $pagination->nextPageUrl() }}"
                           rel="next"
                           class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.03] px-3 text-xs font-bold text-muted transition hover:border-brand/30 hover:bg-brand/10 hover:text-brand">
                            التالي
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </a>
                    @else
                        <span class="inline-flex h-9 items-center gap-2 rounded-xl border border-line bg-white/[0.02] px-3 text-xs text-dim opacity-50">
                            التالي
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </section>
@endsection
