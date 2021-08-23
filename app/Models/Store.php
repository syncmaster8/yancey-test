<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'store_name',
        'owner_name',
        'floor_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id','store_id');
    }
}
