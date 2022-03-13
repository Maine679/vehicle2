<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = ['salesman_id','buyer_id','price','mileage'];

    public function salesman() {
        return $this->belongsTo(User::class,'salesman_id','id');
    }
    public function buyer() {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
}
