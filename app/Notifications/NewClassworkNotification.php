<?php

namespace App\Notifications;

use App\Models\Classwork;
use App\Notifications\Channels\HadaraSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
class NewClassworkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Classwork $classwork)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Channels: mail, database, broadcast, vonage(sms),slack

        $via = [
            'database',
            HadaraSmsChannel::class,
            'mail',
            'broadcast',
           // 'vonage'

        ];
        // if($notifiable->receive_mail_notifiaction){
        //     $via[] = 'mail';
        // }
        // if($notifiable->receive_push_notifiaction){
        //     $via[] = 'brodcast';
        // }
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content =__(':name posted a new :type: :title',[
            'name' => $classwork->user->name,
            'type' => __($classwork->type),
            'title' => $classwork->title
        ]);
        return (new MailMessage)
                    ->subject(__('New :type',[
                       'type' => $this->classwork->type]))
                    ->greeting(__('Hi :name',[
                        'name' => $notifiable->name
                    ]))
                    ->line($content)
                    ->action(__('Go to classwork'), route('classrooms.classworks.show',[  $classwork->classroom_id, $classwork->id]))
                    ->line('Thank you for using our application!');
    }

    public function toVonage(object $notifiable) :VonageMessage
    {
        return (new VonageMessage)->content(__('A new classwork!'));
    }
    public function toHadara(object $notifiable) :string
    {
        return __('A new classwork created');
    }
        public function toDatabase(object $notifiable):DatabaseMessage{
            return new DatabaseMessage($this->createMessage());

      }

      public function toBroadcast(object $notifiable): BroadcastMessage{
     return new BroadcastMessage($this->createMessage());
      }
      protected function createMessage():array{
        $classwork = $this->classwork;
        $content =__(':name posted a new :type: :title',[
            'name' => $classwork->user->name,
            'type' => __($classwork->type),
            'title' => $classwork->title
        ]);
        return [
            'title' => __('New :type',[
                'type' => $this->classwork->type]),
              'body' => $content,
              'image' =>'',
              'link' => route('classrooms.classworks.show',[  $classwork->classroom_id, $classwork->id]),
              'classwork'=> $classwork->id,
            ];
      }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
