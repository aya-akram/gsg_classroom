<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ClassworkCreated;
use App\Jobs\SendClassworkNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewClassworkNotification;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAssignedStudents
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassworkCreated $event): void
    {
        // $user =User::find(1);
        // $user->notify(new NewClassworkNotification($event->classwork));

        // foreach($event->classwork->users as $user){
        //     $user->notify(new NewClassworkNotification($event->classwork));
        // }
        $classwork = $event->classwork;
        $jobs = new SendClassworkNotification(
            $classwork->users,new NewClassworkNotification($classwork)
        );
        dispatch($jobs)->onQueue('default');
        // SendClassworkNotification::dispatch($classwork->users,new NewClassworkNotification($classwork));
        // Notification::send();
        

    }
}
