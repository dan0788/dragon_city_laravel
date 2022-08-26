<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListaDragones extends Model
{
    use SoftDeletes;

    protected $table = 'lista_dragones';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre', 'atributo_1', 'atributo_2', 'atributo_3', 'atributo_4'
    ];
}
