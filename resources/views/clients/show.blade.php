
@extends('layouts.app')

@section('title', 'ملف العميل | Collex')

@section('content')
<div dir="rtl" class="min-h-screen space-y-6 bg-[#0a0c0e] p-4 text-slate-100 md:p-6">

    @include('clients.partials.header')

    @include('clients.partials.summary')

    @include('clients.partials.personal-info')

    @include('clients.partials.phones')

    @include('clients.partials.guarantor')

    @include('clients.partials.employment')

    @include('clients.partials.debt-cases')

    @include('clients.partials.promises')

    @include('clients.partials.payments')

    @include('clients.partials.visits')

    @include('clients.partials.notes')

</div>
@endsection
