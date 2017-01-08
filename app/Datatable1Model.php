<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datatable1Model extends Model
{
    //set table
    protected $table = 'users';
    //set primary key
    protected $primaryKey = 'id';
    //when not use table field - updated_at and created_at
    public $timestamps = false;
}
