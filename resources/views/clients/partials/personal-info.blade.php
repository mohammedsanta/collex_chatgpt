
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-id-card ml-2 text-emerald-400"></i>
            البيانات الشخصية
        </h2>
    </div>

    <div class="grid gap-5 p-5 sm:grid-cols-2 xl:grid-cols-3">
        <div>
            <p class="text-xs text-slate-500">اسم العميل</p>
            <p class="mt-2 font-semibold">{{ $client->name ?: '—' }}</p>
        </div>

        <div>
            <p class="text-xs text-slate-500">كود العميل</p>
            <p class="mt-2 font-mono">{{ $client->code ?: '—' }}</p>
        </div>

        <div>
            <p class="text-xs text-slate-500">الرقم القومي</p>
            <p class="mt-2 font-mono">{{ $client->national_id ?: '—' }}</p>
        </div>

        <div>
            <p class="text-xs text-slate-500">البريد الإلكتروني</p>
            @if($client->email)
                <a href="mailto:{{ $client->email }}" class="mt-2 inline-block break-all text-emerald-400 hover:underline">
                    {{ $client->email }}
                </a>
            @else
                <p class="mt-2">—</p>
            @endif
        </div>

        <div>
            <p class="text-xs text-slate-500">المحافظة</p>
            <p class="mt-2">{{ $client->governorate?->name ?? '—' }}</p>
        </div>

        <div>
            <p class="text-xs text-slate-500">العنوان</p>
            <p class="mt-2 whitespace-pre-line leading-7">{{ $client->address ?: '—' }}</p>
        </div>
    </div>
</section>
