<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MeasurementAttribute extends Model
{
    use SoftDeletes;
    //
    protected $table='measurement_attributes';

    protected $guarded=[''];
    protected $dates = ['deleted_at'];
}
