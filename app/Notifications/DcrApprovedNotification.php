<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

final class DcrApprovedNotification extends Notification
{
    use Queueable;
    public function __construct(public readonly DailyCollectionReport $report) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toArray(object $notifiable): array { return ['title'=>'Daily report approved','message'=>'Your daily collection report for '.$this->report->report_date?->format('Y-m-d').' was approved.','report_id'=>$this->report->getKey(),'status'=>$this->report->status]; }
}
