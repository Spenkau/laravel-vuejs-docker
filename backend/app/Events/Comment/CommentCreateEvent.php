<?php

namespace App\Events\Comment;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentCreateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Comment $comment;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Return name of broadcast event
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'comment.create';
    }

    /**
     * Return data received from params
     *
     * @return Comment[]
     */
    public function broadcastWith(): array
    {
        return ['comment' => $this->comment];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('task-channel'),
        ];
    }
}
