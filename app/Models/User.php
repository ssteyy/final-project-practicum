<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name','email','password','role','bio','avatar'
    ];

    protected $hidden = [
        'password','remember_token'
    ];

    // Relationships
    public function services() { return $this->hasMany(Service::class, 'user_id'); }
    public function ordersAsClient() { return $this->hasMany(Order::class, 'client_id'); }
    public function ordersAsFreelancer() { return $this->hasMany(Order::class, 'freelancer_id'); }
    public function messagesSent(){ return $this->hasMany(Message::class,'sender_id'); }
    public function messagesReceived(){ return $this->hasMany(Message::class,'receiver_id'); }

    // Accessor for avatar url
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? Storage::url($this->avatar) : asset('images/default-avatar.png');
    }
}