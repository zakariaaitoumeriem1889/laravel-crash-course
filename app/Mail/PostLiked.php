<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostLiked extends Mailable
{
    use Queueable, SerializesModels;

    public User $liker;
    public Post $post;

    /**
     * Create a new message instance.
     *
     * @param User $liker
     * @param Post $post
     */
    public function __construct(
        User $liker, Post $post
    )
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.post_liked')
            ->subject('Someone liked your post');
    }
}
