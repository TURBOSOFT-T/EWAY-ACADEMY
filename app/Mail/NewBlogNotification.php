<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Blog;

class NewBlogNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function build()
    {
        return $this->subject('Nouveau actualité publiée !')
                    ->view('Mail.new_blog_notification');
    }
}
