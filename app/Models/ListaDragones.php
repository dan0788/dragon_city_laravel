<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListaDragones extends Model
{
    use SoftDeletes;

    protected $table = 'dragon_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'dragon', 'first_element', 'second_element', 'third_element', 'fourth_element','created_by','updated_by','deleted_by'
    ];

    protected $hidden = [
        //aquí se escriben los campos que laravel no va a mostrar en el frontend
    ];
}
