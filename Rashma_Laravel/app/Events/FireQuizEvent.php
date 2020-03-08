<?php

namespace App\Events;

use App\Model\Quiz;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FireQuizEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Quiz */
    public $quiz;

    /**
     * Create a new event instance.
     *
     * @param Quiz $quiz
     */
    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('fireQuiz');
    }
}
