<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\RealtimeAndNotification\HandleRealtimeAndNotificationService;
use App\Enums\Trait\ModelName;
use App\Models\Message\Message;
use App\Models\Reply\Reply;
use App\Models\Notification\Notification;
use App\Services\Global\Realtime\RealtimeService;
use App\Notifications\Firebase\FirebaseNotification;
use App\Services\Global\Notification\NotificationService;

class HandleRealtimeAndNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Message|Reply|Notification $model,
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
        else
        {
            $this->getInstance()->handleNotification($this->model);
        }
    }

    public function getInstance(): HandleRealtimeAndNotificationService
    {
        $realtimeService = new RealtimeService();
        $firebaseNotification = new FirebaseNotification();
        $notificationService = new NotificationService($firebaseNotification);
        $handleRealtimeAndNotificationService = new HandleRealtimeAndNotificationService(
            $realtimeService,
            $notificationService,
        );

        return $handleRealtimeAndNotificationService;
    }
}
