<?php

namespace Src\Agenda\Business\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class BusinessEloquentModel extends Model
{
    protected $table = 'bussiness';


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
