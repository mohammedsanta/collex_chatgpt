<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

final class CollexDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $now = now();

            /*
             * Helper: insert or update a record using its unique business key.
             * Existing records are retained; soft-deleted demo records are restored.
             */
            $save = static function (
                string $table,
                array $unique,
                array $values
            ) use ($now): int {
                $values['updated_at'] = $now;
                $values['created_at'] ??= $now;

                DB::table($table)->updateOrInsert(
                    $unique,
                    $values
                );

                $id = DB::table($table)
                    ->where($unique)
                    ->value('id');

                if ($id === null) {
                    throw new RuntimeException(
                        "Unable to retrieve seeded record from {$table}."
                    );
                }

                return (int) $id;
            };

            /*
             * 1. Roles and permissions
             */
            $roles = [];

            foreach ([
                ['name' => 'owner', 'label' => 'مالك النظام', 'level' => 100],
                ['name' => 'supervisor', 'label' => 'مشرف', 'level' => 50],
                ['name' => 'call_center', 'label' => 'موظف تحصيل', 'level' => 10],
            ] as $role) {
                $roles[$role['name']] = $save('roles', [
                    'name' => $role['name'],
                ], [
                    'label' => $role['label'],
                    'description' => 'Demo role',
                    'is_system' => true,
                    'level' => $role['level'],
                ]);
            }

            $permissionNames = [
                'dashboard.view',
                'users.view', 'users.create', 'users.update', 'users.delete',
                'roles.view', 'roles.create', 'roles.update', 'roles.delete',
                'permissions.view',
                'banks.view', 'banks.create', 'banks.update', 'banks.delete',
                'installment_companies.view',
                'clients.view', 'clients.create', 'clients.update',
                'loan_types.view', 'loan_types.create', 'loan_types.update',
                'portfolios.view', 'portfolios.create', 'portfolios.update',
                'portfolios.import', 'portfolios.activate', 'portfolios.archive',
                'loans.view', 'loans.create', 'loans.update', 'loans.assign',
                'interactions.view', 'interactions.create',
                'promises.view', 'promises.create', 'promises.update',
                'payments.view', 'payments.create',
                'payments.confirm', 'payments.reject',
                'visits.view', 'visits.create', 'visits.update',
                'complaints.view', 'complaints.create', 'complaints.update',
                'complaints.resolve',
                'dcr.view', 'dcr.create', 'dcr.submit', 'dcr.approve',
                'reports.view', 'reports.export',
                'archives.view', 'archives.create',
                'settings.view', 'settings.update',
                'activity_logs.view',
            ];

            $permissions = [];

            foreach ($permissionNames as $permissionName) {
                [$group] = explode('.', $permissionName, 2);

                $permissions[$permissionName] = $save('permissions', [
                    'name' => $permissionName,
                ], [
                    'label' => ucwords(str_replace(
                        ['.', '_'],
                        ' ',
                        $permissionName
                    )),
                    'group' => $group,
                ]);
            }

            $supervisorPermissions = array_values(array_filter(
                $permissionNames,
                static fn (string $name): bool =>
                    ! in_array($name, [
                        'users.delete',
                        'roles.delete',
                        'settings.update',
                    ], true)
            ));

            $collectorPermissions = [
                'dashboard.view',
                'banks.view',
                'clients.view',
                'loan_types.view',
                'portfolios.view',
                'loans.view',
                'interactions.view',
                'interactions.create',
                'promises.view',
                'promises.create',
                'payments.view',
                'payments.create',
                'visits.view',
                'visits.create',
                'complaints.view',
                'complaints.create',
                'dcr.view',
                'dcr.create',
                'dcr.submit',
                'reports.view',
            ];

            foreach ([
                'owner' => $permissionNames,
                'supervisor' => $supervisorPermissions,
                'call_center' => $collectorPermissions,
            ] as $roleName => $assignedPermissions) {
                foreach ($assignedPermissions as $permissionName) {
                    DB::table('permission_role')->updateOrInsert(
                        [
                            'role_id' => $roles[$roleName],
                            'permission_id' => $permissions[$permissionName],
                        ],
                        [
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }
            }

            /*
             * 2. Users
             *
             * Demo password for all users: Password123!
             * Change these credentials before using the application outside testing.
             */
            $password = Hash::make('Password123!');

            $ownerId = $save('users', [
                'email' => 'owner@collex.test',
            ], [
                'employee_code' => 'COL-OWNER-001',
                'name' => 'مدير النظام',
                'phone' => '01000000001',
                'password' => $password,
                'role_id' => $roles['owner'],
                'supervisor_id' => null,
                'status' => 'active',
                'is_system_account' => true,
                'deleted_at' => null,
            ]);

            $supervisorId = $save('users', [
                'email' => 'supervisor@collex.test',
            ], [
                'employee_code' => 'COL-SUP-001',
                'name' => 'مشرف التحصيل',
                'phone' => '01000000002',
                'password' => $password,
                'role_id' => $roles['supervisor'],
                'supervisor_id' => $ownerId,
                'status' => 'active',
                'is_system_account' => false,
                'deleted_at' => null,
            ]);

            $collectorOneId = $save('users', [
                'email' => 'collector1@collex.test',
            ], [
                'employee_code' => 'COL-EMP-001',
                'name' => 'أحمد محمد',
                'phone' => '01000000003',
                'password' => $password,
                'role_id' => $roles['call_center'],
                'supervisor_id' => $supervisorId,
                'status' => 'active',
                'is_system_account' => false,
                'deleted_at' => null,
            ]);

            $collectorTwoId = $save('users', [
                'email' => 'collector2@collex.test',
            ], [
                'employee_code' => 'COL-EMP-002',
                'name' => 'محمود علي',
                'phone' => '01000000004',
                'password' => $password,
                'role_id' => $roles['call_center'],
                'supervisor_id' => $supervisorId,
                'status' => 'active',
                'is_system_account' => false,
                'deleted_at' => null,
            ]);

            /*
             * 3. Banks, installment companies, and assignments
             */
            $bankId = $save('banks', [
                'code' => 'BANK-DEMO',
            ], [
                'name' => 'بنك تجريبي',
                'is_active' => true,
                'sector' => 'Banking',
                'notes' => 'Demo bank',
                'deleted_at' => null,
            ]);

            $companyId = $save('installment_companies', [
                'code' => 'INST-DEMO',
            ], [
                'name' => 'شركة تقسيط تجريبية',
                'is_active' => true,
                'sector' => 'Installments',
                'notes' => 'Demo installment company',
                'deleted_at' => null,
            ]);

            foreach ([$ownerId, $supervisorId, $collectorOneId, $collectorTwoId] as $userId) {
                DB::table('bank_user')->updateOrInsert(
                    ['bank_id' => $bankId, 'user_id' => $userId],
                    ['assigned_by' => $ownerId, 'created_at' => $now, 'updated_at' => $now]
                );

                DB::table('installment_company_user')->updateOrInsert(
                    ['installment_company_id' => $companyId, 'user_id' => $userId],
                    ['assigned_by' => $ownerId, 'created_at' => $now, 'updated_at' => $now]
                );
            }

/*
 * 4. Governorates and loan types
 */
$governorates = [];

foreach ([
    'CAI' => 'القاهرة',
    'GIZ' => 'الجيزة',
    'ALX' => 'الإسكندرية',
] as $governorateCode => $governorateName) {
    $governorates[$governorateCode] = $save(
        'governorates',
        ['name' => $governorateName],
        []
    );
}

$loanTypes = [];

foreach (['قرض شخصي', 'قرض سيارة', 'تمويل مشتريات'] as $loanTypeName) {
    $loanTypes[$loanTypeName] = $save(
        'loan_types',
        ['name' => $loanTypeName],
        [
            'is_active' => true,
        ]
    );
}

            /*
             * 5. Clients and phone numbers
             */
            $clients = [];

            $clientData = [
                [
                    'code' => 'CLI-DEMO-001',
                    'national_id' => '29001011234561',
                    'name' => 'محمد إبراهيم',
                    'phone' => '01110000001',
                    'governorate' => 'CAI',
                ],
                [
                    'code' => 'CLI-DEMO-002',
                    'national_id' => '28505221234562',
                    'name' => 'أحمد السيد',
                    'phone' => '01110000002',
                    'governorate' => 'GIZ',
                ],
                [
                    'code' => 'CLI-DEMO-003',
                    'national_id' => '29507151234563',
                    'name' => 'محمود حسن',
                    'phone' => '01110000003',
                    'governorate' => 'ALX',
                ],
            ];

            foreach ($clientData as $client) {
                $clientId = $save('clients', [
                    'code' => $client['code'],
                ], [
                    'national_id' => $client['national_id'],
                    'name' => $client['name'],
                    'email' => null,
                    'governorate_id' => $governorates[$client['governorate']],
                    'address' => 'عنوان تجريبي - ' . $client['name'],
                    'employer_name' => 'شركة تجريبية',
                    'job_title' => 'موظف',
                    'work_address' => 'عنوان عمل تجريبي',
                    'notes' => 'Demo client',
                    'deleted_at' => null,
                ]);

                $clients[] = $clientId;

                DB::table('client_phones')->updateOrInsert(
                    ['client_id' => $clientId, 'phone' => $client['phone']],
                    [
                        'label' => 'primary',
                        'is_valid' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }

            /*
             * 6. Portfolio and import record
             */
            $portfolioId = $save('portfolios', [
                'bank_id' => $bankId,
                'period_year' => (int) $now->format('Y'),
                'period_month' => (int) $now->format('n'),
            ], [
                'name' => 'نطاق تجريبي - ' . $now->format('Y-m'),
                'status' => 'active',
                'cases_count' => count($clients),
                'total_debt' => 45000,
                'created_by' => $ownerId,
                'activated_at' => $now,
                'archived_at' => null,
                'archived_by' => null,
                'notes' => 'Demo portfolio',
                'deleted_at' => null,
            ]);

            $importId = $save('portfolio_imports', [
                'portfolio_id' => $portfolioId,
                'original_filename' => 'demo-portfolio.xlsx',
            ], [
                'imported_by' => $ownerId,
                'stored_path' => 'demo/demo-portfolio.xlsx',
                'status' => 'completed',
                'total_rows' => 3,
                'success_rows' => 3,
                'failed_rows' => 0,
                'errors' => null,
                'started_at' => $now->copy()->subMinutes(5),
                'finished_at' => $now,
            ]);

            /*
             * 7. Debt cases
             */
            $caseIds = [];
            $caseAmounts = [
                ['total' => 20000, 'overdue' => 5000, 'installment' => 1500, 'dpd' => 45, 'bucket' => '1'],
                ['total' => 15000, 'overdue' => 4000, 'installment' => 1000, 'dpd' => 75, 'bucket' => '2'],
                ['total' => 10000, 'overdue' => 3000, 'installment' => 750, 'dpd' => 120, 'bucket' => '3+'],
            ];

            foreach ($clients as $index => $clientId) {
                $collectorId = $index % 2 === 0
                    ? $collectorOneId
                    : $collectorTwoId;

                $amounts = $caseAmounts[$index];

                $caseId = $save('debt_cases', [
                    'portfolio_id' => $portfolioId,
                    'client_id' => $clientId,
                    'loan_number' => 'DEMO-LOAN-' . str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT),
                ], [
                    'bank_id' => $bankId,
                    'loan_type_id' => array_values($loanTypes)[$index],
                    'assigned_user_id' => $collectorId,
                    'status' => 'active',
                    'total_debt' => $amounts['total'],
                    'overdue_amount' => $amounts['overdue'],
                    'installment_value' => $amounts['installment'],
                    'min_installment_diff' => 100,
                    'late_fee' => 100,
                    'collected_amount' => 0,
                    'bucket' => $amounts['bucket'],
                    'dpd' => $amounts['dpd'],
                    'next_due_date' => $now->copy()->addDays(10 + $index)->toDateString(),
                    'loan_start_date' => $now->copy()->subYear()->toDateString(),
                    'loan_end_date' => $now->copy()->addYears(2)->toDateString(),
                    'last_payment_date' => null,
                    'last_payment_amount' => null,
                    'is_processed' => true,
                    'processed_at' => $now,
                    'deleted_at' => null,
                ]);

                $caseIds[] = $caseId;

                DB::table('case_assignments')->updateOrInsert(
                    [
                        'debt_case_id' => $caseId,
                        'user_id' => $collectorId,
                        'unassigned_at' => null,
                    ],
                    [
                        'assigned_by' => $supervisorId,
                        'assigned_at' => $now,
                        'reason' => 'Initial demo assignment',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }

            /*
             * 8. Interactions and promises to pay
             */
            $promiseIds = [];

            foreach ($caseIds as $index => $caseId) {
                $collectorId = $index % 2 === 0
                    ? $collectorOneId
                    : $collectorTwoId;

                $phoneId = DB::table('client_phones')
                    ->where('client_id', $clients[$index])
                    ->value('id');

                $save('case_interactions', [
                    'debt_case_id' => $caseId,
                    'user_id' => $collectorId,
                    'occurred_at' => $now->copy()->subHours($index + 1),
                    'type' => 'call',
                ], [
                    'client_phone_id' => $phoneId,
                    'outcome' => 'answered',
                    'notes' => 'Demo call interaction',
                    'duration_seconds' => 180,
                    'followup_at' => $now->copy()->addDays(2),
                ]);

                $promiseIds[] = $save('promises_to_pay', [
                    'debt_case_id' => $caseId,
                    'user_id' => $collectorId,
                    'promise_date' => $now->copy()->addDays($index + 1)->toDateString(),
                ], [
                    'promised_amount' => 1000 + ($index * 500),
                    'paid_amount' => 0,
                    'status' => 'active',
                    'notes' => 'Demo promise to pay',
                    'reviewed_by' => $supervisorId,
                    'reviewed_at' => $now,
                    'closed_at' => null,
                    'deleted_at' => null,
                ]);
            }

            /*
             * 9. Payments: pending, confirmed, and rejected
             */
            $paymentData = [
                [
                    'receipt_number' => 'DEMO-RCPT-001',
                    'amount' => 1500,
                    'method' => 'cash',
                    'status' => 'pending',
                    'case' => 0,
                    'promise' => 0,
                ],
                [
                    'receipt_number' => 'DEMO-RCPT-002',
                    'amount' => 2200,
                    'method' => 'e_wallet',
                    'status' => 'pending',
                    'case' => 1,
                    'promise' => 1,
                ],
                [
                    'receipt_number' => 'DEMO-RCPT-003',
                    'amount' => 750,
                    'method' => 'bank_transfer',
                    'status' => 'confirmed',
                    'case' => 2,
                    'promise' => 2,
                ],
                [
                    'receipt_number' => 'DEMO-RCPT-004',
                    'amount' => 1200,
                    'method' => 'card',
                    'status' => 'rejected',
                    'case' => 0,
                    'promise' => null,
                ],
                [
                    'receipt_number' => 'DEMO-RCPT-005',
                    'amount' => 950,
                    'method' => 'cheque',
                    'status' => 'pending',
                    'case' => 2,
                    'promise' => null,
                ],
            ];

            foreach ($paymentData as $index => $payment) {
                $collectorId = $index % 2 === 0
                    ? $collectorOneId
                    : $collectorTwoId;

                $isConfirmed = $payment['status'] === 'confirmed';

                $save('payments', [
                    'receipt_number' => $payment['receipt_number'],
                ], [
                    'debt_case_id' => $caseIds[$payment['case']],
                    'collector_id' => $collectorId,
                    'promise_id' => $payment['promise'] === null
                        ? null
                        : $promiseIds[$payment['promise']],
                    'amount' => $payment['amount'],
                    'method' => $payment['method'],
                    'reference' => null,
                    'proof_path' => null,
                    'paid_at' => $now->copy()->subHours($index + 1),
                    'status' => $payment['status'],
                    'confirmed_by' => $isConfirmed ? $supervisorId : null,
                    'confirmed_at' => $isConfirmed ? $now : null,
                    'rejection_reason' => $payment['status'] === 'rejected'
                        ? 'بيانات التحصيل غير مطابقة.'
                        : null,
                    'notes' => 'Demo payment record',
                    'deleted_at' => null,
                ]);
            }

            /*
             * 10. Visits
             */
            foreach ($caseIds as $index => $caseId) {
                $collectorId = $index % 2 === 0
                    ? $collectorOneId
                    : $collectorTwoId;

                $save('visits', [
                    'debt_case_id' => $caseId,
                    'user_id' => $collectorId,
                    'scheduled_at' => $now->copy()->addDays($index + 1),
                ], [
                    'assigned_by' => $supervisorId,
                    'status' => $index === 0 ? 'completed' : 'scheduled',
                    'visited_at' => $index === 0 ? $now : null,
                    'address' => 'عنوان زيارة تجريبي',
                    'latitude' => null,
                    'longitude' => null,
                    'outcome' => $index === 0 ? 'contacted' : null,
                    'notes' => 'Demo visit',
                    'deleted_at' => null,
                ]);
            }

            /*
             * 11. Complaints
             */
            $save('complaints', [
                'reference_number' => 'CMP-DEMO-0001',
            ], [
                'bank_id' => $bankId,
                'debt_case_id' => $caseIds[0],
                'client_id' => $clients[0],
                'logged_by' => $collectorOneId,
                'assigned_to' => $supervisorId,
                'subject' => 'شكوى تجريبية',
                'description' => 'شكوى لاختبار دورة إدارة الشكاوى.',
                'source' => 'phone',
                'priority' => 'medium',
                'status' => 'open',
                'due_at' => $now->copy()->addDays(3),
                'resolution' => null,
                'resolved_by' => null,
                'resolved_at' => null,
                'deleted_at' => null,
            ]);

            $save('complaints', [
                'reference_number' => 'CMP-DEMO-0002',
            ], [
                'bank_id' => $bankId,
                'debt_case_id' => $caseIds[1],
                'client_id' => $clients[1],
                'logged_by' => $supervisorId,
                'assigned_to' => $supervisorId,
                'subject' => 'شكوى تم حلها - اختبار',
                'description' => 'شكوى تجريبية بحالة مغلقة.',
                'source' => 'branch',
                'priority' => 'low',
                'status' => 'resolved',
                'due_at' => $now->copy()->subDay(),
                'resolution' => 'تمت المعالجة للاختبار.',
                'resolved_by' => $supervisorId,
                'resolved_at' => $now,
                'deleted_at' => null,
            ]);

            /*
             * 12. Daily collection reports
             */
            foreach ([$collectorOneId, $collectorTwoId] as $index => $collectorId) {
                $save('daily_collection_reports', [
                    'bank_id' => $bankId,
                    'user_id' => $collectorId,
                    'report_date' => $now->toDateString(),
                ], [
                    'cases_worked' => $index === 0 ? 2 : 1,
                    'calls_count' => $index === 0 ? 12 : 8,
                    'visits_count' => 1,
                    'promises_count' => 1,
                    'promised_amount' => $index === 0 ? 1500 : 1000,
                    'collected_amount' => $index === 0 ? 0 : 750,
                    'status' => $index === 0 ? 'submitted' : 'draft',
                    'submitted_at' => $index === 0 ? $now : null,
                    'approved_by' => null,
                    'approved_at' => null,
                    'notes' => 'Demo daily collection report',
                ]);
            }

            /*
             * 13. Performance snapshots
             */
            foreach ([$collectorOneId, $collectorTwoId] as $index => $collectorId) {
                $save('performance_snapshots', [
                    'user_id' => $collectorId,
                    'bank_id' => $bankId,
                    'year' => (int) $now->format('Y'),
                    'month' => (int) $now->format('n'),
                ], [
                    'cases_assigned' => $index === 0 ? 2 : 1,
                    'cases_processed' => $index === 0 ? 2 : 1,
                    'promises_total' => 1,
                    'promises_kept' => 0,
                    'promises_broken' => 0,
                    'collected_amount' => $index === 0 ? 0 : 750,
                    'target_amount' => 10000,
                    'efficiency' => $index === 0 ? 20 : 35,
                    'rank_position' => $index + 1,
                    'calculated_at' => $now,
                ]);
            }

            /*
             * 14. Monthly archive
             */
            $save('monthly_archives', [
                'bank_id' => $bankId,
                'year' => (int) $now->format('Y'),
                'month' => (int) $now->format('n'),
            ], [
                'portfolio_id' => $portfolioId,
                'cases_count' => count($caseIds),
                'total_debt' => 45000,
                'collected_amount' => 750,
                'snapshot_path' => null,
                'archived_by' => $ownerId,
                'archived_at' => $now,
                'notes' => 'Demo monthly archive',
            ]);

            /*
             * 15. Report exports
             */
            $save('report_exports', [
                'user_id' => $ownerId,
                'type' => 'collections',
                'format' => 'xlsx',
            ], [
                'filters' => json_encode(
                    ['demo' => true],
                    JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
                ),
                'status' => 'completed',
                'file_path' => null,
                'row_count' => 3,
                'error' => null,
                'generated_at' => $now,
                'expires_at' => $now->copy()->addDays(7),
            ]);

            /*
             * 16. Activity logs
             */
            DB::table('activity_logs')->updateOrInsert(
                [
                    'user_id' => $ownerId,
                    'event' => 'demo.seeded',
                    'description' => 'Collex demo data initialized',
                ],
                [
                    'subject_type' => null,
                    'subject_id' => null,
                    'properties' => json_encode(
                        ['portfolio_id' => $portfolioId, 'import_id' => $importId],
                        JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
                    ),
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Collex Demo Seeder',
                    'created_at' => $now,
                ]
            );

            /*
             * 17. Settings
             */
            foreach ([
                [
                    'key' => 'app.name',
                    'value' => 'Collex',
                    'type' => 'string',
                    'group' => 'general',
                    'is_public' => true,
                ],
                [
                    'key' => 'app.currency',
                    'value' => 'EGP',
                    'type' => 'string',
                    'group' => 'general',
                    'is_public' => true,
                ],
                [
                    'key' => 'collections.work_week_start',
                    'value' => 'saturday',
                    'type' => 'string',
                    'group' => 'collections',
                    'is_public' => true,
                ],
            ] as $setting) {
                $save('settings', ['key' => $setting['key']], [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                    'is_public' => $setting['is_public'],
                ]);
            }

            /*
             * 18. Notifications
             *
             * The notifiable type must match your application's User model.
             * Change App\Models\User if your User model uses another namespace.
             */
            $notificationType = 'App\\Models\\User';

            foreach ([$ownerId, $supervisorId, $collectorOneId] as $userId) {
                $exists = DB::table('notifications')
                    ->where('notifiable_type', $notificationType)
                    ->where('notifiable_id', $userId)
                    ->where('type', 'demo')
                    ->where('data', 'like', '%Collex demo notification%')
                    ->exists();

                if (! $exists) {
                    DB::table('notifications')->insert([
                        'id' => (string) Str::uuid(),
                        'type' => 'demo',
                        'notifiable_type' => $notificationType,
                        'notifiable_id' => $userId,
                        'data' => json_encode([
                            'title' => 'إشعار تجريبي',
                            'message' => 'Collex demo notification',
                        ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
                        'read_at' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            /*
             * 19. User-specific permission overrides
             */
            foreach ([
                [$ownerId, 'payments.confirm', true],
                [$ownerId, 'payments.reject', true],
                [$supervisorId, 'payments.confirm', true],
                [$supervisorId, 'payments.reject', true],
                [$collectorOneId, 'payments.confirm', false],
                [$collectorOneId, 'payments.reject', false],
            ] as [$userId, $permissionName, $granted]) {
                DB::table('permission_user')->updateOrInsert(
                    [
                        'user_id' => $userId,
                        'permission_id' => $permissions[$permissionName],
                    ],
                    [
                        'granted' => $granted,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }

            $this->command?->info(
                'Collex demo database seeded successfully.'
            );
        });
    }
}