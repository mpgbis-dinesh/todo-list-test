<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterTask extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_tasks';

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
    protected $fillable = ['group_managements_id', 'task_managements_id', 'is_active', 'users_id', 'completed_on'];

    
}
