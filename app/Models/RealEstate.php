<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute ;


class RealEstate extends Model
{
    use HasFactory;
    
    protected $guarded =['id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function schedule()
    {
        return $this->hasMany(ScheduleVisit::class);
    }

}
