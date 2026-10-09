@extends('layouts.app')
@section('title', 'المستخدمون')
@section('topbar-title', 'المستخدمون')
@section('content')
@php($records = $users ?? $items ?? collect())
<x-module-index title="المستخدمون" subtitle="إدارة حسابات الدخول وربطها بالأدوار والمشرفين ومراجعة الحالة." eyebrow="الفريق والإدارة" icon="fa-user-gear" :rows="$records" :columns="[['key'=>'employee_code','label'=>'كود الموظف','type'=>'mono'],['key'=>'name','label'=>'اسم المستخدم','type'=>'text'],['key'=>'email','label'=>'البريد الإلكتروني','type'=>'text'],['key'=>'role.label','label'=>'الدور','type'=>'text'],['key'=>'last_login_at','label'=>'آخر دخول','type'=>'date'],['key'=>'status','label'=>'الحالة','type'=>'status']]" show-route="users.show" edit-route="users.edit" create-route="users.create" search="true" search-placeholder="اسم المستخدم أو البريد..." empty-title="لا توجد حسابات مستخدمين" empty-description="أنشئ حسابًا جديدًا وحدد له الدور والصلاحيات اللازمة." />
@endsection
