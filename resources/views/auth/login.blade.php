@extends('layouts.guest')
@section('title', 'تسجيل الدخول')
@section('content')
<div class="mb-7"><p class="text-[10px] font-extrabold uppercase tracking-widest text-brand">مرحبًا بعودتك</p><h2 class="mt-2 text-xl font-extrabold text-fg">تسجيل الدخول إلى حسابك</h2><p class="mt-2 text-xs leading-6 text-muted">أدخل بيانات حسابك للوصول إلى لوحة إدارة التحصيل.</p></div>
<form method="POST" action="{{ route('login') }}" class="space-y-5">@csrf
    <x-form-field label="البريد الإلكتروني" name="email" type="email" :value="old('email')" required autocomplete="username" placeholder="name@company.com" />
    <x-form-field label="كلمة المرور" name="password" type="password" required autocomplete="current-password" placeholder="أدخل كلمة المرور" />
    <div class="flex items-center justify-between gap-3"><label class="flex items-center gap-2 text-[11px] font-semibold text-muted"><input type="checkbox" name="remember" value="1" class="rounded border-line text-brand focus:ring-brand/30"> تذكرني على هذا الجهاز</label>@if(\Illuminate\Support\Facades\Route::has('password.request'))<a href="{{ route('password.request') }}" class="text-[11px] font-extrabold text-brand hover:text-brand">نسيت كلمة المرور؟</a>@endif</div>
    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-brand px-4 py-3.5 text-xs font-extrabold text-black shadow-lg shadow-brand/10 transition hover:bg-brand/85"><i class="fa-solid fa-arrow-right-to-bracket"></i> تسجيل الدخول</button>
</form>
<div class="mt-6 flex items-center justify-center gap-2 border-t border-line pt-5 text-[10px] text-dim"><i class="fa-solid fa-shield-halved text-brand"></i> اتصال آمن · الوصول حسب الصلاحيات المعتمدة</div>
@endsection
