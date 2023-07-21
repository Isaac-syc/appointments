<?php

namespace Src\Agenda\Services\Application\Repositories\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Src\Agenda\Services\Domain\Repositories\ServiceRepositoryInterface;
use Src\Agenda\Services\Infrastructure\EloquentModels\ServiceEloquentModel;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isEmpty;

class ServiceRepository implements ServiceRepositoryInterface
{


    public function store(Request $request): ServiceEloquentModel
    {
        $service = new ServiceEloquentModel;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->time_stimate = $request->time_stimate;

        if ($request->has('photo')) {
            $mime_type = $request->file('photo')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $mime_type;
            Storage::disk('public_uploads')->put('/bussiness/' . $filename, File::get($request->photo));
            $url = env('APP_URL') . '/bussiness/' . $filename;
            $service->photo = $url;
        }
        $service->is_active = $request->is_active;
        $service->bussiness_id = $request->bussiness_id;
        $service->save();

        return $service;
    }
}
