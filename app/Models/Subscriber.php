<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;


class Subscriber extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
      
       'email',
    

        'active',
        'unsubscribed_at',
        'unsubscribe_token'
      

    ];
    public $timestamps = true;

    /* protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ]; */

}