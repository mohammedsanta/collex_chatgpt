@extends('layouts.guest')
@section('title', 'استعادة كلمة المرور')
@section('content')
<div class="mb-6"><a href="{{ route('login') }}" class="mb-5 inline-flex items-center gap-2 text-[11px] font-bold text-muted hover:text-brand"><i class="fa-solid fa-arrow-right"></i> العودة لتسجيل الدخول</a><span class="mb-4 grid h-12 w-12 place-items-center rounded-2xl bg-brand/10 text-lg text-brand"><i class="fa-solid fa-key"></i></span><h2 class="text-xl font-extrabold text-fg">استعادة كلمة المرور</h2><p class="mt-2 text-xs leading-6 text-muted">أدخل البريد الإلكتروني المسجل وسنرسل لك رابطًا لإعادة تعيين كلمة المرور إذا كان الحساب موجودًا.</p></div>
<form method="POST" action="{{ route('password.email') }}" class="space-y-5">@csrf<x-form-field label="البريد الإلكتروني" name="email" type="email" :value="old('email')" required autocomplete="email" placeholder="name@company.com" /><button class="app-btn app-btn-primary w-full py-3.5"><i class="fa-solid fa-paper-plane"></i> إرسال رابط الاستعادة</button></form>
@endsection
