<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'id',
        'agency',
        'amount',
        'share',
        'individual_share',
        'date',
        'user_id',
    ];

    public function touguideDrivers()
    {
        return $this->hasMany(LogBookTourguideDriver::class);
    }

}
