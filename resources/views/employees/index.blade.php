@extends('layouts.app')
@section('title', 'الموظفون')
@section('topbar-title', 'الموظفون')
@section('content')
@php($records = $employees ?? $users ?? $items ?? collect())
<x-module-index title="الموظفون" subtitle="دليل فريق العمل ومتابعة الأدوار والمشرفين وحالة الحساب." eyebrow="الفريق والإدارة" icon="fa-user-group" :rows="$records" :columns="[['key'=>'employee_code','label'=>'كود الموظف','type'=>'mono'],['key'=>'name','label'=>'الاسم','type'=>'text'],['key'=>'email','label'=>'البريد الإلكتروني','type'=>'text'],['key'=>'role.label','label'=>'الدور','type'=>'text'],['key'=>'supervisor.name','label'=>'المشرف','type'=>'text'],['key'=>'status','label'=>'الحالة','type'=>'status']]" show-route="employees.show" edit-route="users.edit" search="true" search-placeholder="اسم الموظف أو الكود..." empty-title="لا يوجد موظفون" empty-description="ستظهر بيانات أعضاء الفريق وحالة حساباتهم هنا." />
@endsection
