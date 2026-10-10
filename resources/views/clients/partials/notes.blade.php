
<section class="space-y-5">

    <div class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
        <div class="border-b border-[#1e252b] px-5 py-4">
            <h2 class="font-bold">
                <i class="fa-solid fa-note-sticky ml-2 text-amber-400"></i>
                ملاحظات العميل
            </h2>
        </div>

        <div class="p-5">
            @if($client->notes)
                <p class="whitespace-pre-line text-sm leading-8 text-slate-300">
                    {{ $client->notes }}
                </p>
            @else
                <p class="text-sm text-slate-500">
                    لا توجد ملاحظات مسجلة لهذا العميل.
                </p>
            @endif
        </div>

        <div class="grid gap-4 border-t border-[#1e252b] bg-[#0a0c0e] p-5 sm:grid-cols-2">
            <div>
                <p class="text-xs text-slate-500">تاريخ إنشاء الملف</p>
                <p class="mt-2 text-sm">{{ $client->created_at?->format('Y-m-d H:i') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500">آخر تحديث للملف</p>
                <p class="mt-2 text-sm">{{ $client->updated_at?->format('Y-m-d H:i') ?? '—' }}</p>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
        <div class="border-b border-[#1e252b] px-5 py-4">
            <h2 class="font-bold">
                <i class="fa-solid fa-clock-rotate-left ml-2 text-violet-400"></i>
                سجل المتابعات
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                تفاعلات التحصيل المرتبطة بحالات العميل
            </p>
        </div>

        <div class="divide-y divide-[#1e252b]">
            @forelse($interactions as $interaction)
                <div class="p-5">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <p class="font-semibold">
                            {{ data_get($interaction, 'type') ?? data_get($interaction, 'channel') ?? 'متابعة' }}
                        </p>
                        <p class="text-xs text-slate-500">
                            {{ data_get($interaction, 'created_at') ?? '—' }}
                        </p>
                    </div>

                    <p class="mt-2 whitespace-pre-line text-sm leading-7 text-slate-400">
                        {{ data_get($interaction, 'notes') ?? data_get($interaction, 'description') ?? '—' }}
                    </p>
                </div>
            @empty
                <p class="p-8 text-center text-sm text-slate-500">
                    لا توجد متابعات مسجلة.
                </p>
            @endforelse
        </div>
    </div>

</section>
