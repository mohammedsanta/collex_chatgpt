<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 mb-6">
    <x-stat-card
        label="عدد التحصيلات المعلقة"
        :value="$statistics['count'] ?? 0"
        icon="fa-solid fa-hourglass-half"
        color="orange"
    />

    <x-stat-card
        label="إجمالي المبالغ المعلقة"
        :value="number_format((float) ($statistics['amount'] ?? 0), 2) . ' ج.م'"
        icon="fa-solid fa-money-bill-wave"
        color="green"
    />

    <x-stat-card
        label="تحصيلات اليوم"
        :value="$statistics['today_count'] ?? 0"
        icon="fa-solid fa-calendar-day"
        color="blue"
    />
</div>