@extends('layouts.app')
@section('title', 'الأدوار والصلاحيات')
@section('topbar-title', 'الأدوار والصلاحيات')
@section('content')
@php($records = $roles ?? $items ?? collect())
<x-module-index title="الأدوار والصلاحيات" subtitle="تعريف أدوار النظام ومستويات الوصول بما يحقق مبدأ أقل صلاحية لازمة." eyebrow="الفريق والإدارة" icon="fa-shield-halved" :rows="$records" :columns="[['key'=>'label','label'=>'اسم الدور','type'=>'text'],['key'=>'name','label'=>'المعرّف','type'=>'mono'],['key'=>'level','label'=>'مستوى الوصول','type'=>'text'],['key'=>'users_count','label'=>'عدد المستخدمين','type'=>'text'],['key'=>'is_system','label'=>'دور نظامي','type'=>'boolean']]" show-route="roles.edit" edit-route="roles.edit" create-route="roles.create" search="true" search-placeholder="اسم الدور أو المعرّف..." empty-title="لا توجد أدوار" empty-description="أنشئ الأدوار الأساسية ثم اربط كل دور بالصلاحيات التي يحتاجها فقط." />
@endsection
