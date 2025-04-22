<?php

// app/Models/SaleDraft.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items',
        'total',
        'status'
    ];

    protected $casts = [
        'items' => 'array',
    ];
}