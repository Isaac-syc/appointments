<?php

namespace Src\Agenda\Services\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Src\Agenda\Image\Infrastructure\EloquentModels\ImageEloquentModel;

class ServiceEloquentModel extends Model
{
    protected $table = 'services';


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
