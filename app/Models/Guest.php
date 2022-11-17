<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Guest extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'log_book_id',
        'children',
        'female',
        'male',
        'country'
    ];
}
