<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $fillable = [
        'store_entered_id',
        'floor_number',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class,'store_entered_id','id');
    }
}
