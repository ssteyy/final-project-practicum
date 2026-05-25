<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'client_id',
        'freelancer_id',
        'requirements',
        'amount',
        'original_price',
        'platform_fee',
        'status',
        'payment_status',
        'khqr_md5',
        'khqr_string',
        'paid_at',
        'transaction_reference',
    ];

    protected $casts = [
        'amount' => 'float',
        'original_price' => 'float',
        'platform_fee' => 'float',
        'paid_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
