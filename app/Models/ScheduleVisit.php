<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleVisit extends Model
{
    use HasFactory;
    
    protected $guarded =['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class);
    }

    
    public function setVisitDateAttribute($value)
    {
        $this->attributes['visit_date'] = Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s');
    }

    // protected function getVisitDateAttribute($value)
    // {
    //     return Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s');
    // }
}
