<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model {
    use HasFactory;
    protected $fillable = ['user_id','title','description','price','category','status','thumbnail'];

    public function freelancer(){ return $this->belongsTo(User::class,'user_id'); }
    public function orders(){ return $this->hasMany(Order::class); }
    public function reviews(){ return $this->hasMany(Review::class); }

    public function averageRating(){
        return round($this->reviews()->avg('rating'),1);
    }
}