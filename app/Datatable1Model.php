<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datatable1Model extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';

    //use when table field changed
    public $timestamps = false;
}
