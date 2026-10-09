@extends('layouts.guest')
@section('title', 'تعيين كلمة مرور جديدة')
@section('content')
<div class="mb-6"><span class="mb-4 grid h-12 w-12 place-items-center rounded-2xl bg-brand/10 text-lg text-brand"><i class="fa-solid fa-lock"></i></span><h2 class="text-xl font-extrabold text-fg">تعيين كلمة مرور جديدة</h2><p class="mt-2 text-xs leading-6 text-muted">اختر كلمة مرور قوية لا تستخدمها في أي حساب آخر.</p></div>
<form method="POST" action="{{ route('password.update') }}" class="space-y-4">@csrf<input type="hidden" name="token" value="{{ $token ?? request('token') }}"><x-form-field label="البريد الإلكتروني" name="email" type="email" :value="old('email', request('email'))" required autocomplete="email" /><x-form-field label="كلمة المرور الجديدة" name="password" type="password" required autocomplete="new-password" /><x-form-field label="تأكيد كلمة المرور" name="password_confirmation" type="password" required autocomplete="new-password" /><button class="app-btn app-btn-primary w-full py-3.5"><i class="fa-solid fa-check"></i> حفظ كلمة المرور</button></form>
@endsection
