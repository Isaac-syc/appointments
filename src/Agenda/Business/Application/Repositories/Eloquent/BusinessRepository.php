<?php

namespace Src\Agenda\Business\Application\Repositories\Eloquent;

use Illuminate\Http\Request;
use Src\Agenda\Business\Application\Mappers\BusinessMapper;
use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Business\Domain\Repositories\BusinessRepositoryInterface;
use Src\Agenda\Business\Infrastructure\EloquentModels\BusinessEloquentModel;
use Src\Agenda\Business\Infrastructure\EloquentModels\WorkingHourEloquentModel;
use Src\Agenda\Image\Infrastructure\EloquentModels\ImageEloquentModel;

use function PHPUnit\Framework\isEmpty;

class BusinessRepository implements BusinessRepositoryInterface
{
    public function getAll(): array
    {
        $business = [];
        foreach (BusinessEloquentModel::all() as $businessEloquent) {
            $business[] = BusinessMapper::fromEloquent($businessEloquent);
        }
        return $business;
    }

    public function getById(int $businessId): Business
    {
        $businessEloquent = BusinessEloquentModel::query()->findOrFail($businessId);
        return BusinessMapper::fromEloquentWithServices($businessEloquent);
    }

    public function store(Business $business, array $urls): Business
    {


        $businessEloquent = BusinessMapper::toEloquent($business);
        $businessEloquent->save();

        foreach ($urls as $url) {
            $image = new ImageEloquentModel();
            $image->path = $url;
            $businessEloquent->images()->save($image);
        }


        return BusinessMapper::fromEloquent($businessEloquent);
    }

    public function update(Business $business, array $urls): Business
    {
        $businessEloquent = BusinessMapper::toEloquent($business);
        $businessEloquent->save();

        if (isset($urls)) {
            $businessEloquent->images()->delete();
            foreach ($urls as $url) {
                $image = new ImageEloquentModel();
                $image->path = $url;
                $businessEloquent->images()->save($image);
            }
        }

        return BusinessMapper::fromEloquent($businessEloquent);
    }

    public function storeWorkingHour(Request $request): void
    {
        foreach ($request->days as $key => $day) {
            $dayEloquent = WorkingHourEloquentModel::firstOrNew(['day' => $day, 'bussiness_id' => $request->bussiness_id]);
            $dayEloquent->day = $day;
            $dayEloquent->start_time = $request->start_times[$key];
            $dayEloquent->finish_time = $request->finish_time[$key];
            $dayEloquent->bussiness_id = $request->bussiness_id;
            $dayEloquent->save();
        }
    }

    public function deleteWorkingHour(int $id, string $day): void
    {
        $dayEloquent = WorkingHourEloquentModel:: where('day', $day)->where('bussiness_id', $id)->first();
        $dayEloquent->delete();
    }
}
