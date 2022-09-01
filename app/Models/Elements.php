<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elements extends Model
{
    use SoftDeletes;

    protected $table = 'elements';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name','created_by','updated_by','deleted_by'
    ];

    protected $hidden = [
        //aquí se escriben los campos que laravel no va a mostrar en el frontend
    ];
}
