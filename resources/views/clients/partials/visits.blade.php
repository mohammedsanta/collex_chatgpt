
<section class="overflow-hidden rounded-2xl border border-[#1e252b] bg-[#111418]">
    <div class="border-b border-[#1e252b] px-5 py-4">
        <h2 class="font-bold">
            <i class="fa-solid fa-location-dot ml-2 text-cyan-400"></i>
            سجل الزيارات
        </h2>
    </div>

    <div class="divide-y divide-[#1e252b]">
        @forelse($visits as $visit)
            <div class="grid gap-4 p-5 sm:grid-cols-2 xl:grid-cols-4">
                <div>
                    <p class="text-xs text-slate-500">موعد الزيارة</p>
                    <p class="mt-2">{{ $visit->scheduled_at?->format('Y-m-d H:i') ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">تاريخ التنفيذ</p>
                    <p class="mt-2">{{ $visit->visited_at?->format('Y-m-d H:i') ?? 'لم تنفذ بعد' }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">الموظف المسؤول</p>
                    <p class="mt-2">{{ $visit->user?->name ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">الحالة</p>
                    <p class="mt-2">{{ $visit->status ?: '—' }}</p>
                </div>

                <div class="sm:col-span-2 xl:col-span-4">
                    <p class="text-xs text-slate-500">العنوان</p>
                    <p class="mt-2">{{ $visit->address ?: '—' }}</p>
                </div>

                <div class="sm:col-span-2 xl:col-span-4">
                    <p class="text-xs text-slate-500">النتيجة والملاحظات</p>
                    <p class="mt-2 whitespace-pre-line leading-7 text-slate-300">
                        {{ $visit->outcome ?: '—' }}
                        @if($visit->notes)
                            {{ "\n" . $visit->notes }}
                        @endif
                    </p>
                </div>
            </div>
        @empty
            <p class="p-8 text-center text-sm text-slate-500">
                لا توجد زيارات مسجلة.
            </p>
        @endforelse
    </div>
</section>
