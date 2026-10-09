@php
    $editing = isset($user);
@endphp

@if ($errors->any())
    <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/5 p-4">
        <p class="mb-2 text-xs font-extrabold text-red-400">
            يرجى مراجعة البيانات التالية:
        </p>

        <ul class="space-y-1 text-[11px] text-red-300">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    method="POST"
    action="{{ $editing ? route('users.update', $user) : route('users.store') }}"
>
    @csrf

    @if ($editing)
        @method('PUT')
    @endif

    <x-panel title="البيانات الأساسية" icon="fa-user">

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

            <div>
                <label for="name" class="mb-2 block text-[10px] font-bold text-dim">
                    الاسم بالكامل <span class="text-red-400">*</span>
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name ?? '') }}"
                    required
                    maxlength="255"
                    autocomplete="name"
                    class="app-input w-full"
                    placeholder="اسم الموظف بالكامل"
                >
            </div>

            <div>
                <label for="employee_code" class="mb-2 block text-[10px] font-bold text-dim">
                    كود الموظف <span class="text-red-400">*</span>
                </label>

                <input
                    id="employee_code"
                    name="employee_code"
                    type="text"
                    value="{{ old('employee_code', $user->employee_code ?? '') }}"
                    required
                    maxlength="20"
                    class="app-input w-full"
                    placeholder="مثال: EMP-1001"
                >
            </div>

            <div>
                <label for="phone" class="mb-2 block text-[10px] font-bold text-dim">
                    رقم الهاتف
                </label>

                <input
                    id="phone"
                    name="phone"
                    type="tel"
                    value="{{ old('phone', $user->phone ?? '') }}"
                    maxlength="20"
                    autocomplete="tel"
                    class="app-input w-full"
                    placeholder="01xxxxxxxxx"
                >
            </div>

            <div class="md:col-span-2 xl:col-span-1">
                <label for="email" class="mb-2 block text-[10px] font-bold text-dim">
                    البريد الإلكتروني <span class="text-red-400">*</span>
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email ?? '') }}"
                    required
                    maxlength="255"
                    autocomplete="email"
                    class="app-input w-full"
                    placeholder="employee@example.com"
                >
            </div>

            <div>
                <label for="role_id" class="mb-2 block text-[10px] font-bold text-dim">
                    الدور الوظيفي <span class="text-red-400">*</span>
                </label>

                <select id="role_id" name="role_id" required class="app-input w-full">
                    <option value="">اختر الدور</option>

                    @foreach ($roles as $role)
                        <option
                            value="{{ $role->id }}"
                            @selected((string) old('role_id', $user->role_id ?? '') === (string) $role->id)
                        >
                            {{ $role->label ?: $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="supervisor_id" class="mb-2 block text-[10px] font-bold text-dim">
                    المشرف المباشر
                </label>

                <select id="supervisor_id" name="supervisor_id" class="app-input w-full">
                    <option value="">بدون مشرف</option>

                    @foreach ($supervisors as $supervisor)
                        <option
                            value="{{ $supervisor->id }}"
                            @selected((string) old('supervisor_id', $user->supervisor_id ?? '') === (string) $supervisor->id)
                        >
                            {{ $supervisor->name }} — {{ $supervisor->employee_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="mb-2 block text-[10px] font-bold text-dim">
                    حالة الحساب <span class="text-red-400">*</span>
                </label>

                <select id="status" name="status" required class="app-input w-full">
                    <option value="active" @selected(old('status', $user->status ?? 'active') === 'active')>
                        نشط
                    </option>

                    <option value="inactive" @selected(old('status', $user->status ?? '') === 'inactive')>
                        غير نشط
                    </option>

                    <option value="suspended" @selected(old('status', $user->status ?? '') === 'suspended')>
                        موقوف
                    </option>
                </select>
            </div>

        </div>
    </x-panel>

    <div class="mt-5">
        <x-panel title="بيانات تسجيل الدخول" icon="fa-lock">

            <div class="grid gap-5 md:grid-cols-2">

                <div>
                    <label for="password" class="mb-2 block text-[10px] font-bold text-dim">
                        كلمة المرور
                        @unless ($editing)
                            <span class="text-red-400">*</span>
                        @endunless
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        @required(! $editing)
                        minlength="8"
                        autocomplete="{{ $editing ? 'new-password' : 'new-password' }}"
                        class="app-input w-full"
                        placeholder="{{ $editing ? 'اتركها فارغة للاحتفاظ بالحالية' : '8 أحرف على الأقل' }}"
                    >

                    @if ($editing)
                        <p class="mt-2 text-[10px] text-dim">
                            لن تتغير كلمة المرور إذا تركت الحقل فارغًا.
                        </p>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-[10px] font-bold text-dim">
                        تأكيد كلمة المرور
                    </label>

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        minlength="8"
                        autocomplete="new-password"
                        class="app-input w-full"
                        placeholder="أعد كتابة كلمة المرور"
                    >
                </div>

            </div>

        </x-panel>
    </div>

    <div class="mt-5 flex flex-wrap justify-end gap-3">
        <a
            href="{{ $editing ? route('users.show', $user) : route('users.index') }}"
            class="app-btn app-btn-secondary"
        >
            إلغاء
        </a>

        <button type="submit" class="app-btn app-btn-primary">
            <i class="fa-solid {{ $editing ? 'fa-floppy-disk' : 'fa-user-plus' }}"></i>
            {{ $editing ? 'حفظ التعديلات' : 'إنشاء المستخدم' }}
        </button>
    </div>
</form>