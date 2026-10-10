
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="text-xs font-semibold tracking-widest text-emerald-400">
            COLLEX / إدارة العملاء / ملف العميل
        </p>

        <h1 class="mt-2 text-2xl font-bold md:text-3xl">
            {{ $client->name }}
        </h1>

        <p class="mt-2 text-sm text-slate-400">
            كود العميل: {{ $client->code ?: 'غير مسجل' }}
            <span class="mx-2 text-slate-700">|</span>
            الرقم القومي: {{ $client->national_id ?: 'غير مسجل' }}
        </p>
    </div>

    <div class="flex flex-wrap gap-2">
        <a href="{{ route('clients.index') }}"
           class="rounded-xl border border-[#1e252b] px-4 py-3 text-sm text-slate-300 hover:bg-white/5">
            <i class="fa-solid fa-arrow-right ml-2"></i>
            قائمة العملاء
        </a>

        @if(\Illuminate\Support\Facades\Route::has('clients.edit'))
            <a href="{{ route('clients.edit', $client) }}"
               class="rounded-xl bg-emerald-400 px-4 py-3 text-sm font-bold text-slate-950 hover:bg-emerald-300">
                <i class="fa-solid fa-pen ml-2"></i>
                تعديل العميل
            </a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="rounded-xl border border-emerald-800 bg-emerald-950/40 p-4 text-sm text-emerald-300">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="rounded-xl border border-rose-800 bg-rose-950/40 p-4 text-sm text-rose-300">
        {{ session('error') }}
    </div>
@endif
