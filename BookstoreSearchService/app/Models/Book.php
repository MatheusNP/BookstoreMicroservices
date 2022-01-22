<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'title',
        'author',
        'maximum_price',
        'offered_price',
        'discount_pctg',
        'available',
        'publisher',
        'edition',
        'category',
        'description',
        'language',
        'page',
        'weight',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
