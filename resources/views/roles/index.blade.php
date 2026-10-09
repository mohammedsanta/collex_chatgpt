
@extends('layouts.app')

@section('title', 'إدارة الصلاحيات - Collex')

@section('content')
<div class="space-y-6" dir="rtl">

    <x-page-header
        title="إدارة الصلاحيات"
        subtitle="تعريف صلاحيات النظام وربطها بالأدوار."
    >
        <x-slot:actions>
            <a href="{{ route('roles.index') }}" class="app-btn">
                <i class="fa-solid fa-user-shield ml-2"></i>
                إدارة الأدوار
            </a>
        </x-slot:actions>
    </x-page-header>

    <x-flash />

    <x-panel title="إضافة صلاحية">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="name" class="mb-2 block text-sm text-slate-300">
                        الاسم البرمجي
                    </label>
                    <input
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="app-input w-full"
                        placeholder="banks.view"
                        maxlength="100"
                        pattern="[A-Za-z][A-Za-z0-9_.]*"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="label" class="mb-2 block text-sm text-slate-300">
                        اسم الصلاحية
                    </label>
                    <input
                        id="label"
                        name="label"
                        value="{{ old('label') }}"
                        class="app-input w-full"
                        placeholder="عرض البنوك"
                        maxlength="255"
                        required
                    >
                    @error('label')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="group" class="mb-2 block text-sm text-slate-300">
                        المجموعة
                    </label>
                    <input
                        id="group"
                        name="group"
                        value="{{ old('group') }}"
                        class="app-input w-full"
                        placeholder="banks"
                        maxlength="100"
                        pattern="[A-Za-z][A-Za-z0-9_]*"
                        required
                    >
                    @error('group')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="app-btn app-btn-primary">
                    <i class="fa-solid fa-plus ml-2"></i>
                    إضافة الصلاحية
                </button>
            </div>
        </form>
    </x-panel>

    <x-panel title="الصلاحيات المسجلة">
        <div class="table-wrap w-full overflow-x-auto">
            <table class="data-table w-full min-w-[850px]">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصلاحية</th>
                        <th>الاسم البرمجي</th>
                        <th>المجموعة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permissions instanceof \Illuminate\Contracts\Pagination\Paginator ? $permissions->firstItem() + $loop->index : $loop->iteration }}</td>

                            <td class="font-medium text-white">
                                {{ $permission->label }}
                            </td>

                            <td>
                                <code>{{ $permission->name }}</code>
                            </td>

                            <td>{{ $permission->group }}</td>

                            <td>
                                <div class="flex flex-wrap items-center gap-2">
                                    <details class="relative">
                                        <summary
                                            class="icon-btn icon-btn-info cursor-pointer"
                                            title="تعديل الصلاحية"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </summary>

                                        <div class="absolute left-0 z-20 mt-2 w-80 rounded-xl border border-white/10 bg-[#111418] p-4 shadow-xl">
                                            <form
                                                action="{{ route('permissions.update', $permission) }}"
                                                method="POST"
                                                class="space-y-3"
                                            >
                                                @csrf
                                                @method('PUT')

                                                <div>
                                                    <label class="mb-1 block text-xs text-slate-400">
                                                        الاسم البرمجي
                                                    </label>
                                                    <input
                                                        name="name"
                                                        value="{{ $permission->name }}"
                                                        class="app-input w-full"
                                                        maxlength="100"
                                                        required
                                                    >
                                                </div>

                                                <div>
                                                    <label class="mb-1 block text-xs text-slate-400">
                                                        اسم الصلاحية
                                                    </label>
                                                    <input
                                                        name="label"
                                                        value="{{ $permission->label }}"
                                                        class="app-input w-full"
                                                        maxlength="255"
                                                        required
                                                    >
                                                </div>

                                                <div>
                                                    <label class="mb-1 block text-xs text-slate-400">
                                                        المجموعة
                                                    </label>
                                                    <input
                                                        name="group"
                                                        value="{{ $permission->group }}"
                                                        class="app-input w-full"
                                                        maxlength="100"
                                                        required
                                                    >
                                                </div>

                                                <button type="submit" class="app-btn app-btn-primary w-full">
                                                    حفظ التعديلات
                                                </button>
                                            </form>
                                        </div>
                                    </details>

                                    <form
                                        action="{{ route('permissions.destroy', $permission) }}"
                                        method="POST"
                                        onsubmit="return confirm('سيتم حذف الصلاحية من جميع الأدوار والمستخدمين. هل تريد المتابعة؟')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="icon-btn icon-btn-danger"
                                            title="حذف الصلاحية"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                لا توجد صلاحيات مسجلة.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($permissions instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div class="mt-5">
                {{ $permissions->links() }}
            </div>
        @endif
    </x-panel>

</div>
@endsection
