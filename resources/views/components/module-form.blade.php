@props([
    'title',
    'subtitle' => null,
    'icon' => 'fa-pen-to-square',
    'fields' => [],
    'actionRoute' => null,
    'backRoute' => null,
    'backUrl' => null,
    'record' => null,
    'bank' => null,
    'editing' => false,
    'submitLabel' => 'حفظ البيانات',
    'routeParameters' => [],
    'backRouteParameters' => [],
])

@php
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Normalize Route Parameters
    |--------------------------------------------------------------------------
    */

    $routeParameters = is_array($routeParameters)
        ? $routeParameters
        : [];

    $backRouteParameters = is_array($backRouteParameters)
        ? $backRouteParameters
        : [];

    if ($bank) {
        $routeParameters['bank'] ??= $bank->getRouteKey();
        $backRouteParameters['bank'] ??= $bank->getRouteKey();
    }

    /*
    |--------------------------------------------------------------------------
    | Resolve Form Action
    |--------------------------------------------------------------------------
    */

    $actionExists = filled($actionRoute)
        && Route::has($actionRoute);

    $formAction = '#';
    $missingRouteParameters = [];

    if ($actionExists) {
        $route = Route::getRoutes()->getByName($actionRoute);

        $requiredParameters = $route?->parameterNames() ?? [];

        // Automatically resolve the record parameter only when unambiguous.
        if ($editing && $record) {
            $missingParameters = array_values(array_diff(
                $requiredParameters,
                array_keys($routeParameters)
            ));

            if (count($missingParameters) === 1) {
                $routeParameters[$missingParameters[0]] = $record->getRouteKey();
            }
        }

        $missingRouteParameters = array_values(array_diff(
            $requiredParameters,
            array_keys($routeParameters)
        ));

        if ($missingRouteParameters === []) {
            $formAction = route($actionRoute, $routeParameters);
        } else {
            $actionExists = false;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Resolve Back URL
    |--------------------------------------------------------------------------
    */

    if (! filled($backUrl) && filled($backRoute) && Route::has($backRoute)) {
        $backRouteDefinition = Route::getRoutes()->getByName($backRoute);

        $backRequiredParameters = $backRouteDefinition?->parameterNames() ?? [];

        $missingBackParameters = array_values(array_diff(
            $backRequiredParameters,
            array_keys($backRouteParameters)
        ));

        if ($missingBackParameters === []) {
            $backUrl = route($backRoute, $backRouteParameters);
        }
    }
@endphp

<x-page-header
    :title="$title"
    :subtitle="$subtitle"
    eyebrow="إدارة البيانات"
    :icon="$icon"
>
    <x-slot:actions>
        @if (filled($backUrl))
            <a href="{{ $backUrl }}" class="app-btn app-btn-secondary">
                <i class="fa-solid fa-arrow-right"></i>
                العودة للقائمة
            </a>
        @endif
    </x-slot:actions>
</x-page-header>

<div class="mx-auto max-w-4xl">
    <x-panel
        :title="$title"
        subtitle="أدخل البيانات المطلوبة ثم راجعها قبل الحفظ"
        :icon="$icon"
    >
        <form method="POST" action="{{ $formAction }}">
            @csrf

            @if ($editing)
                @method('PUT')
            @endif

            <div class="grid gap-x-5 gap-y-4 md:grid-cols-2">
                @foreach ($fields as $field)
                    @php
                        $fieldName = $field['name'];

                        $fieldValue = old(
                            $fieldName,
                            data_get($record, $fieldName)
                        );

                        $fieldType = $field['type'] ?? 'text';
                    @endphp

                    <div @class([
                        'md:col-span-2' => ($field['full'] ?? false),
                    ])>
                        @if ($fieldType === 'textarea')
                            <x-textarea-field
                                :label="$field['label']"
                                :name="$fieldName"
                                :value="$fieldValue"
                                :required="$field['required'] ?? false"
                                :rows="$field['rows'] ?? 4"
                                :placeholder="$field['placeholder'] ?? null"
                            />

                        @elseif ($fieldType === 'select')
                            <x-select-field
                                :label="$field['label']"
                                :name="$fieldName"
                                :value="$fieldValue"
                                :options="$field['options'] ?? []"
                                :required="$field['required'] ?? false"
                                :placeholder="$field['placeholder'] ?? 'اختر...'"
                            />

                        @elseif ($fieldType === 'checkbox')
                            <label class="flex items-center gap-3 rounded-xl border border-line p-3">
                                <input
                                    type="hidden"
                                    name="{{ $fieldName }}"
                                    value="0"
                                >

                                <input
                                    type="checkbox"
                                    name="{{ $fieldName }}"
                                    value="1"
                                    @checked((bool) $fieldValue)
                                    class="rounded border-line text-brand focus:ring-brand/30"
                                >

                                <span class="text-[11px] font-bold">
                                    {{ $field['label'] }}
                                </span>
                            </label>

                        @else
                            <x-form-field
                                :label="$field['label']"
                                :name="$fieldName"
                                :type="$fieldType"
                                :value="$fieldValue"
                                :required="$field['required'] ?? false"
                                :placeholder="$field['placeholder'] ?? null"
                                :help="$field['help'] ?? null"
                            />
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-7 flex flex-wrap items-center gap-2 border-t border-line pt-5">
                @if ($actionExists)
                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        {{ $submitLabel }}
                    </button>
                @else
                    <button
                        type="button"
                        disabled
                        class="app-btn cursor-not-allowed bg-surface-raised text-dim"
                    >
                        <i class="fa-solid fa-link-slash"></i>
                        الحفظ غير متاح حتى استكمال المسار
                    </button>
                @endif

                @if (filled($backUrl))
                    <a href="{{ $backUrl }}" class="app-btn app-btn-secondary">
                        إلغاء
                    </a>
                @endif
            </div>

            @if (! $actionExists)
                <div class="mt-4 rounded-xl border border-warning/20 bg-warning/10 p-3 text-[10px] leading-5 text-warning">
                    <i class="fa-solid fa-circle-info ml-1"></i>

                    @if (! filled($actionRoute) || ! Route::has($actionRoute))
                        مسار الحفظ غير مسجل في routes/web.php.
                    @else
                        تعذر إنشاء رابط الحفظ. معاملات المسار الناقصة:
                        {{ implode('، ', $missingRouteParameters) }}.
                        مرّرها من الصفحة المستدعية للمكوّن.
                    @endif
                </div>
            @endif
        </form>
    </x-panel>
</div>