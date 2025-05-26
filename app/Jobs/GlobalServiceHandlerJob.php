<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\RealtimeAndNotification\GlobalServiceHandlerService;
use App\Enums\Trait\ModelName;
use App\Models\Message\Message;
use App\Models\Reply\Reply;
use App\Models\Notification\Notification;
use App\Services\Global\Realtime\RealtimeService;
use App\Notifications\Firebase\FirebaseNotification;
use App\Services\Global\Notification\NotificationService;
use App\Models\User\PasswordResetCode;
use App\Services\Global\Email\EmailService;
use App\Emails\PasswordResetEmail;

class GlobalServiceHandlerJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Message|Reply|Notification|PasswordResetCode $model,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (class_basename($this->model) == ModelName::Message->getModelName())
        {
            $this->getInstance()->handleMessage($this->model);
        }
        else if (class_basename($this->model) == ModelName::Reply->getModelName())
        {
            $this->getInstance()->handleReply($this->model);
        }
        else if (class_basename($this->model) == ModelName::Notification->getModelName())
        {
            $this->getInstance()->handleNotification($this->model);
        }
        else
        {
            $this->getInstance()->handleEmail($this->model);
        }
    }

    public function getInstance(): GlobalServiceHandlerService
    {
        $realtimeService = new RealtimeService();
        $firebaseNotification = new FirebaseNotification();
        $notificationService = new NotificationService($firebaseNotification);
        $email = new PasswordResetEmail();
        $emailService = new EmailService($email);
        $globalServiceHandlerService = new GlobalServiceHandlerService(
            $realtimeService,
            $notificationService,
            $emailService,
        );

        return $globalServiceHandlerService;
    }
}
