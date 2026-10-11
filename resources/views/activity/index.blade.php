@extends('layouts.app')

@section('title', 'سجل النشاطات')

@section('content')
<div class="app-content" dir="rtl">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <div class="eyebrow">النظام والرقابة</div>
            <h1 class="page-title">سجل النشاطات</h1>
            <p class="page-subtitle">
                متابعة العمليات والتغييرات التي تمت داخل النظام.
            </p>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">

        <div class="app-stat">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-500">إجمالي النشاطات</p>
                    <p class="text-2xl font-bold mt-2">
                        {{ number_format($stats['total']) }}
                    </p>
                </div>
                <i class="fa-solid fa-list-check text-2xl" aria-hidden="true"></i>
            </div>
        </div>

        <div class="app-stat">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-500">نشاطات اليوم</p>
                    <p class="text-2xl font-bold mt-2">
                        {{ number_format($stats['today']) }}
                    </p>
                </div>
                <i class="fa-solid fa-calendar-day text-2xl" aria-hidden="true"></i>
            </div>
        </div>

        <div class="app-stat">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-gray-500">مستخدمون نشطون اليوم</p>
                    <p class="text-2xl font-bold mt-2">
                        {{ number_format($stats['users_today']) }}
                    </p>
                </div>
                <i class="fa-solid fa-users text-2xl" aria-hidden="true"></i>
            </div>
        </div>

    </div>

    {{-- Filters --}}
    <div class="app-card mb-6">
        <div class="app-card-header">
            <h2 class="font-semibold">البحث والتصفية</h2>
        </div>

        <div class="app-card-body">
            <form method="GET" action="{{ route('activity-logs.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">

                    <div class="xl:col-span-2">
                        <label for="search" class="block text-sm font-medium mb-2">
                            البحث
                        </label>
                        <input
                            id="search"
                            type="text"
                            name="search"
                            value="{{ $filters['search'] ?? '' }}"
                            placeholder="اسم المستخدم، الوصف، عنوان IP..."
                            class="w-full"
                        >
                    </div>

                    <div>
                        <label for="action" class="block text-sm font-medium mb-2">
                            نوع النشاط
                        </label>
                        <select id="action" name="action" class="w-full">
                            <option value="">كل النشاطات</option>

                            @foreach ($actions as $action)
                                <option
                                    value="{{ $action['value'] }}"
                                    @selected(($filters['action'] ?? '') === $action['value'])
                                >
                                    {{ $action['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="date_from" class="block text-sm font-medium mb-2">
                            من تاريخ
                        </label>
                        <input
                            id="date_from"
                            type="date"
                            name="date_from"
                            value="{{ $filters['date_from'] ?? '' }}"
                            class="w-full"
                        >
                    </div>

                    <div>
                        <label for="date_to" class="block text-sm font-medium mb-2">
                            إلى تاريخ
                        </label>
                        <input
                            id="date_to"
                            type="date"
                            name="date_to"
                            value="{{ $filters['date_to'] ?? '' }}"
                            class="w-full"
                        >
                    </div>

                </div>

                @if ($errors->any())
                    <div class="mt-4 text-sm text-red-500">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-wrap items-center gap-3 mt-5">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass ml-1" aria-hidden="true"></i>
                        بحث
                    </button>

                    <a href="{{ route('activity-logs.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-rotate-right ml-1" aria-hidden="true"></i>
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Activities Table --}}
    <div class="app-card">
        <div class="app-card-header flex items-center justify-between gap-3">
            <h2 class="font-semibold">تفاصيل النشاطات</h2>
            <span class="text-sm text-gray-500">
                {{ number_format($activities->total()) }} سجل
            </span>
        </div>

        <div class="app-card-body p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-right">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 whitespace-nowrap">المستخدم</th>
                            <th class="px-4 py-3 whitespace-nowrap">النشاط</th>
                            <th class="px-4 py-3 whitespace-nowrap">الوصف</th>
                            <th class="px-4 py-3 whitespace-nowrap">العنصر المرتبط</th>
                            <th class="px-4 py-3 whitespace-nowrap">عنوان IP</th>
                            <th class="px-4 py-3 whitespace-nowrap">التاريخ والوقت</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td class="px-4 py-3 align-top">
                                    @if ($activity->user)
                                        <div class="font-medium">
                                            {{ $activity->user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $activity->user->email }}
                                        </div>
                                    @else
                                        <span class="text-gray-500">
                                            مستخدم غير متاح
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 align-top whitespace-nowrap">
                                    @php
                                        $eventLabels = [
                                            'created' => 'إنشاء',
                                            'updated' => 'تعديل',
                                            'deleted' => 'حذف',
                                            'login' => 'تسجيل دخول',
                                            'logout' => 'تسجيل خروج',
                                            'failed_login' => 'محاولة دخول فاشلة',
                                        ];

                                        $event = $activity->event;
                                        $eventLabel = $eventLabels[strtolower($event ?? '')]
                                            ?? $event
                                            ?? 'غير محدد';
                                    @endphp

                                    <span class="app-badge">
                                        {{ $eventLabel }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 align-top min-w-56">
                                    {{ $activity->description ?: '—' }}
                                </td>

                                <td class="px-4 py-3 align-top">
                                    @if ($activity->subject_type)
                                        <div>
                                            {{ class_basename($activity->subject_type) }}
                                        </div>

                                        @if ($activity->subject_id !== null)
                                            <div class="text-xs text-gray-500 mt-1">
                                                رقم: {{ $activity->subject_id }}
                                            </div>
                                        @endif
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="px-4 py-3 align-top whitespace-nowrap">
                                    {{ $activity->ip_address ?: '—' }}
                                </td>

                                <td class="px-4 py-3 align-top whitespace-nowrap">
                                    @if ($activity->created_at)
                                        <div>
                                            {{ $activity->created_at->format('Y-m-d') }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $activity->created_at->format('h:i A') }}
                                        </div>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center">
                                    <div class="font-medium">لا توجد نشاطات</div>
                                    <p class="text-sm text-gray-500 mt-2">
                                        لم يتم العثور على سجلات تطابق معايير البحث.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($activities->hasPages())
            <div class="p-4 border-t">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</div>
@endsection