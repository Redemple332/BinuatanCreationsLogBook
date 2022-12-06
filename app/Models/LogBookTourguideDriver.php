<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBookTourguideDriver extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'tourguide_driver_id',
        'log_book_id',
        'date'
    ];

    public function profile()
    {
        return $this->belongsTo(TourguideDriver::class, 'tourguide_driver_id');
    }

    public function logBook()
    {
        return $this->belongsTo(LogBook::class);
    }

}
