<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'complaints';

    protected $fillable = ['name',
                            'detaill',
                            'image',
                            'prefix_id'];
}
