@extends('layouts.app')
@section('title', 'عملاء البنك')
@section('content')
<x-module-index title="عملاء البنك" subtitle="استعراض العملاء المرتبطين بمحافظ البنك." eyebrow="banks" icon="fa-users" :rows="$clients ?? $items ?? collect()" :columns="[['key' => 'name', 'label' => 'اسم العميل', 'type' => 'text'], ['key' => 'code', 'label' => 'كود العميل', 'type' => 'mono'], ['key' => 'national_id', 'label' => 'الرقم القومي', 'type' => 'mono'], ['key' => 'governorate.name', 'label' => 'المحافظة', 'type' => 'text'], ['key' => 'created_at', 'label' => 'تاريخ الإضافة', 'type' => 'date']]"  show-route="clients.show" search="true" search-placeholder="ابحث بالاسم أو الكود..." />
@endsection
