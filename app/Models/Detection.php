<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kekurangan','keterangan','created_by','modified_by'];
}
