<?php

namespace Src\Agenda\Image\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ImageEloquentModel extends Model
{
    protected $table = 'images';


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

}
