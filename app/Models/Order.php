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
        'status',
    ];

    protected $casts = [
        'amount' => 'float',
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
}
