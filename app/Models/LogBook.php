<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function scopeAgency($query)
    {
        return $query->select('agency', DB::raw('count(agency) as total'))->groupBy('agency')->orderBy('agency');
    }

    public function touguideDrivers()
    {
        return $this->hasMany(LogBookTourguideDriver::class);
    }

    public function guest()
    {
        return $this->hasOne(Guest::class);
    }

}
