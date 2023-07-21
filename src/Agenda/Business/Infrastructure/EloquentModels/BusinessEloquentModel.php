<?php

namespace Src\Agenda\Business\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Src\Agenda\Image\Infrastructure\EloquentModels\ImageEloquentModel;
use Src\Agenda\Services\Infrastructure\EloquentModels\ServiceEloquentModel;

class BusinessEloquentModel extends Model
{
    protected $table = 'bussiness';


    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function images(): MorphMany
    {
        return $this->morphMany(ImageEloquentModel::class, 'imageable');
    }


    public function services(): HasMany
    {
        return $this->hasMany(ServiceEloquentModel::class, 'bussiness_id');
    }


}
