<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = ['vehicle_name', 'type', 'vincode', 'number_plate','user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VehicleType::class,'type','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Deal::class,'vehicle_id','id');
    }


}
