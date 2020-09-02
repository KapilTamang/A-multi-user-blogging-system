<?php

namespace App\Mail;

use App\User;
use App\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogPublished extends Mailable
{
    use Queueable, SerializesModels;
    protected $blog;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Blog $blog, User $user)
    {
        $this->blog = $blog;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->subject('A new blog has been published')
        ->view('emails.newBlog')
        ->with([
            'user' => $this->user,
            'blog' => $this->blog
        ]);

        return $this;
    }
}
