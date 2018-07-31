<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskManagement extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_managements';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'is_active'];

    
}
