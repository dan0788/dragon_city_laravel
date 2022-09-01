<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atributte_4 extends Model
{
    use SoftDeletes;

    protected $table = 'atributte_4';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'element_id'
    ];

    protected $hidden = [
        //aquí se escriben los campos que laravel no va a mostrar en el frontend
    ];
}
