<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

final class ReportExportReadyNotification extends Notification
{
    use Queueable;
    public function __construct(public readonly ReportExport $export) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toArray(object $notifiable): array { return ['title'=>'Report export ready','message'=>'Your '.$this->export->type.' export is ready.','export_id'=>$this->export->getKey(),'format'=>$this->export->format,'status'=>$this->export->status]; }
}
