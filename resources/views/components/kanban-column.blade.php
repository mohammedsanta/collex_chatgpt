@props(['title', 'count' => 0, 'tone' => 'gray'])
<section class="min-w-[250px] flex-1 rounded-2xl bg-surface-raised p-3"><header class="mb-3 flex items-center justify-between"><h3 class="text-xs font-extrabold text-fg">{{ $title }}</h3><span class="rounded-lg bg-surface px-2 py-1 text-[10px] font-bold text-muted">{{ $count }}</span></header><div class="space-y-3">{{ $slot }}</div></section>
