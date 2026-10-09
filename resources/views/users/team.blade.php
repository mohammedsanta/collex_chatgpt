@extends('layouts.app')

@section('title', 'فريق المستخدم')

@section('content')

    <x-page-header
        title="الفريق التابع"
        subtitle="عرض الهيكل الإداري والموظفين المرتبطين بالمستخدم."
        eyebrow="إدارة المستخدمين / الفريق"
        icon="fa-people-group"
    >
        <x-slot:actions>
            <a href="{{ route('users.show', $user) }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للمستخدم
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="mt-5">
        <x-panel title="المشرف المباشر" icon="fa-user-tie">

            @if ($user->supervisor)
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-extrabold">{{ $user->supervisor->name }}</p>
                        <p class="mt-1 text-[10px] text-dim">
                            كود الموظف: {{ $user->supervisor->employee_code }}
                        </p>
                    </div>

                    <a href="{{ route('users.show', $user->supervisor) }}" class="app-btn app-btn-secondary">
                        <i class="fa-solid fa-eye"></i>
                        عرض المشرف
                    </a>
                </div>
            @else
                <p class="py-4 text-center text-xs text-dim">
                    لا يوجد مشرف مباشر مسجل لهذا المستخدم.
                </p>
            @endif

        </x-panel>
    </div>

    <div class="mt-5">
        <x-panel title="الموظفون التابعون" icon="fa-people-group">

            <div class="table-wrap w-full overflow-x-auto">
                <table class="data-table w-full min-w-[700px]">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الموظف</th>
                            <th>كود الموظف</th>
                            <th>الدور</th>
                            <th>الحالة</th>
                            <th>التفاصيل</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($user->subordinates as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-xs font-bold">{{ $employee->name }}</td>
                                <td class="text-xs text-dim">{{ $employee->employee_code }}</td>
                                <td class="text-xs">{{ $employee->role?->label ?? $employee->role?->name ?? '—' }}</td>
                                <td class="text-xs">{{ $employee->status }}</td>
                                <td>
                                    <a href="{{ route('users.show', $employee) }}" class="app-btn app-btn-secondary !px-3 !py-2">
                                        <i class="fa-solid fa-eye"></i>
                                        عرض
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-xs text-dim">
                                    لا يوجد موظفون تابعون لهذا المستخدم.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </x-panel>
    </div>

@endsection