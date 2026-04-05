<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'client_id',
        'freelancer_id',
        'rating',
        'review',
    ];

    /**
     * Get the order that was reviewed.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the client who wrote the review.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get the freelancer being reviewed.
     */
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
