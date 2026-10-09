
<?php

return [
    [
        'section' => 'الرئيسية',
        'items' => [
            [
                'label' => 'لوحة التحكم',
                'icon' => 'fa-chart-pie',
                'route' => 'dashboard',
            ],
            [
                'label' => 'نظرة عامة',
                'icon' => 'fa-compass',
                'route' => 'overview.index',
            ],
            [
                'label' => 'مركز العمليات',
                'icon' => 'fa-layer-group',
                'route' => 'operations.index',
            ],
        ],
    ],

    [
        'section' => 'إدارة التحصيل',
        'items' => [
            [
                'label' => 'العملاء',
                'icon' => 'fa-users',
                'route' => 'clients.index',
            ],
            [
                'label' => 'القضايا والقروض',
                'icon' => 'fa-file-invoice-dollar',
                'route' => 'loans.index',
            ],
            [
                'label' => 'المدفوعات',
                'icon' => 'fa-money-bill-transfer',
                'route' => 'payments.index',
            ],
            [
                'label' => 'مراجعة المدفوعات',
                'icon' => 'fa-circle-check',
                'route' => 'payments.confirmations',
            ],
            [
                'label' => 'وعود السداد',
                'icon' => 'fa-handshake',
                'route' => 'ptp.index',
            ],
            [
                'label' => 'الزيارات الميدانية',
                'icon' => 'fa-location-dot',
                'route' => 'banks.visits.index',
                'fallback_route' => 'banks.index',
            ],
            [
                'label' => 'الشكاوى',
                'icon' => 'fa-message',
                'route' => 'banks.complaints.index',
                'fallback_route' => 'banks.index',
            ],
        ],
    ],

    [
        'section' => 'المحافظ والمؤسسات',
        'items' => [
            [
                'label' => 'البنوك',
                'icon' => 'fa-building-columns',
                'children' => [
                    [
                        'label' => 'كل البنوك',
                        'icon' => 'fa-list',
                        'route' => 'banks.index',
                    ],
                    [
                        'label' => 'إضافة بنك',
                        'icon' => 'fa-plus',
                        'route' => 'banks.create',
                    ],
                    [
                        'label' => 'توزيع المحافظ',
                        'icon' => 'fa-diagram-project',
                        'route' => 'banks.distribution.index',
                        'fallback_route' => 'banks.index',
                    ],
                    [
                        'label' => 'استيراد البيانات',
                        'icon' => 'fa-file-import',
                        'route' => 'banks.scope.import',
                        'fallback_route' => 'banks.index',
                    ],
                    [
                        'label' => 'الزيارات الميدانية',
                        'icon' => 'fa-location-dot',
                        'route' => 'banks.visits.index',
                        'fallback_route' => 'banks.index',
                    ],
                    [
                        'label' => 'الشكاوى',
                        'icon' => 'fa-message',
                        'route' => 'banks.complaints.index',
                        'fallback_route' => 'banks.index',
                    ],
                    [
                        'label' => 'الأرشيف',
                        'icon' => 'fa-box-archive',
                        'route' => 'banks.archives.index',
                        'fallback_route' => 'banks.index',
                    ],
                ],
            ],
            [
                'label' => 'شركات التقسيط',
                'icon' => 'fa-shop',
                'children' => [
                    [
                        'label' => 'كل الشركات',
                        'icon' => 'fa-list',
                        'route' => 'installment-companies.index',
                    ],
                    [
                        'label' => 'إضافة شركة',
                        'icon' => 'fa-plus',
                        'route' => 'installment-companies.create',
                    ],
                ],
            ],
            [
                'label' => 'الأرشيف الشهري',
                'icon' => 'fa-box-archive',
                'route' => 'archives.index',
            ],
        ],
    ],

    [
        'section' => 'الفريق والإدارة',
        'items' => [
            [
                'label' => 'الموظفون',
                'icon' => 'fa-user-group',
                'route' => 'employees.index',
            ],
            [
                'label' => 'المستخدمون',
                'icon' => 'fa-user-gear',
                'route' => 'users.index',
            ],
            [
                'label' => 'الأدوار والصلاحيات',
                'icon' => 'fa-shield-halved',
                'route' => 'roles.index',
            ],
            [
                'label' => 'التقارير',
                'icon' => 'fa-chart-column',
                'route' => 'reports.index',
            ],
            [
                'label' => 'سجل النشاط',
                'icon' => 'fa-clock-rotate-left',
                'route' => 'activity-logs.index',
            ],
            [
                'label' => 'الإشعارات',
                'icon' => 'fa-bell',
                'route' => 'notifications.index',
            ],
        ],
    ],

    [
        'section' => 'إعدادات النظام',
        'items' => [
            [
                'label' => 'أنواع القروض',
                'icon' => 'fa-list-check',
                'route' => 'loan-types.index',
            ],
            [
                'label' => 'المحافظات',
                'icon' => 'fa-map-location-dot',
                'route' => 'governorates.index',
            ],
            [
                'label' => 'الإعدادات',
                'icon' => 'fa-sliders',
                'route' => 'settings.index',
            ],
        ],
    ],
];