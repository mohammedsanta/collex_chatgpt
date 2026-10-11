<form method="GET" action="{{ route('payments.confirmations') }}"
      class="app-card-body border-b border-line">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div>
            <label for="search" class="app-label">بحث</label>
            <input
                type="text"
                id="search"
                name="search"
                value="{{ request('search') }}"
                class="app-input w-full"
                placeholder="رقم الإيصال أو رقم الحالة..."
            >
        </div>

        <div>
            <label for="date_from" class="app-label">من تاريخ</label>
            <input
                type="date"
                id="date_from"
                name="date_from"
                value="{{ request('date_from') }}"
                class="app-input w-full"
            >
        </div>

        <div>
            <label for="date_to" class="app-label">إلى تاريخ</label>
            <input
                type="date"
                id="date_to"
                name="date_to"
                value="{{ request('date_to') }}"
                class="app-input w-full"
            >
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="app-btn app-btn-primary">
                <i class="fa-solid fa-magnifying-glass ml-1"></i>
                بحث
            </button>

            <a href="{{ route('payments.confirmations') }}"
               class="app-btn app-btn-secondary">
                إعادة ضبط
            </a>
        </div>
    </div>
</form>