<?php

namespace App\Listeners;

use App\Events\FireQuizEvent;
use App\Jobs\FireQuizJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class FireQuizListener implements ShouldQueue
{

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'sync';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'FireQuizListener';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param FireQuizEvent $event
     * @return void
     */
    public function handle(FireQuizEvent $event)
    {
        Queue::pushOn('FireQuiz', new FireQuizJob($event->quiz));
    }
}
