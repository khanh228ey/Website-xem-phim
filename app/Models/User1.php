<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User1 extends Model
{
    use HasFactory,Notifiable;
    public $timestamps = false;
    protected $table = 'user1';
}
