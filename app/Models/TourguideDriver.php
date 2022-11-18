<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class TourguideDriver extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name', 'occupation', 'agency', 'amount'
    ];

    public function logBooks()
    {
        return $this->hasMany(LogBookTourguideDriver::class );
    }
}
