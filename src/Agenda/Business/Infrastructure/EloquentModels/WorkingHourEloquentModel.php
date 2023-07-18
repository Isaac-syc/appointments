<?php

namespace Src\Agenda\Business\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class WorkingHourEloquentModel extends Model
{
    protected $table = 'working_hours';

    public $incrementing = false;

    protected $primaryKey = [
        'day',
        'bussiness_id'
    ];

    protected $fillable = [
        'day',
        'bussiness_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function setKeysForSaveQuery($query)
    {
        if (is_array($this->primaryKey)) {
            foreach ($this->primaryKey as $pk) {
                $query->where($pk, '=', $this->original[$pk]);
            }
            return $query;
        } else {
            return $this->setKeysForSaveQuery($query);
        }
    }

}
