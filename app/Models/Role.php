<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug_name',
        'name',
        'status',
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
