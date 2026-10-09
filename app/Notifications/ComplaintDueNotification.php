<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Domain\Collections\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

final class ComplaintDueNotification extends Notification
{
    use Queueable;
    public function __construct(public readonly Complaint $complaint) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toArray(object $notifiable): array { return ['title'=>'Complaint due','message'=>'Complaint '.$this->complaint->reference_number.' requires attention.','complaint_id'=>$this->complaint->getKey(),'reference_number'=>$this->complaint->reference_number,'due_at'=>$this->complaint->due_at?->toISOString()]; }
}
