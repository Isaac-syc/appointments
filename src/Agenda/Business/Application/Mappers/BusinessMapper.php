<?php

namespace Src\Agenda\Business\Application\Mappers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Business\Domain\Model\ValueObjects\Address;
use Src\Agenda\Business\Domain\Model\ValueObjects\City;
use Src\Agenda\Business\Domain\Model\ValueObjects\Email;
use Src\Agenda\Business\Domain\Model\ValueObjects\GoogleMapsUrl;
use Src\Agenda\Business\Domain\Model\ValueObjects\Name;
use Src\Agenda\Business\Domain\Model\ValueObjects\Neighborhood;
use Src\Agenda\Business\Domain\Model\ValueObjects\PhoneNumber;
use Src\Agenda\Business\Domain\Model\ValueObjects\Photo;
use Src\Agenda\Business\Domain\Model\ValueObjects\StateId;
use Src\Agenda\Business\Domain\Model\ValueObjects\Street1;
use Src\Agenda\Business\Domain\Model\ValueObjects\Street2;
use Src\Agenda\Business\Infrastructure\EloquentModels\BusinessEloquentModel;
use Src\Agenda\Image\Infrastructure\EloquentModels\ImageEloquentModel;

class BusinessMapper
{
    public static function fromRequest(Request $request, ?int $business_id = null, ?string $photoUrl = null, ?int $userId = null): Business
    {
        return new Business(
            id: $business_id,
            name: new Name($request->string('name')),
            phoneNumber: new PhoneNumber($request->string('phoneNumber')),
            address: new Address($request->string('address')),
            email: new Email($request->string('email')),
            googleMapsUrl: new GoogleMapsUrl($request->string('googleMapsUrl')),
            city: new City($request->string('city')),
            stateId: $request->integer('stateId'),
            neighborhood: new Neighborhood($request->string('neighborhood')),
            street1: new Street1($request->string('street1')),
            street2: new Street2($request->string('street2')),
            photo: new Photo($photoUrl),
            isActive: $request->boolean('isActive', true),
            userId: $userId,
            photos: null,
            services: null,
        );
    }

    public static function fromEloquent(BusinessEloquentModel $businessEloquent): Business
    {
        return new Business(
            id: $businessEloquent->id,
            name: new Name($businessEloquent->name),
            phoneNumber: new PhoneNumber($businessEloquent->phone_number),
            address: new Address($businessEloquent->address),
            email: new Email($businessEloquent->email),
            googleMapsUrl: new GoogleMapsUrl($businessEloquent->google_maps_url),
            city: new City($businessEloquent->city),
            stateId: $businessEloquent->state_id,
            neighborhood: new Neighborhood($businessEloquent->neighborhood),
            street1: new Street1($businessEloquent->street_1),
            street2: new Street2($businessEloquent->street_2),
            photo: new Photo($businessEloquent->photo),
            isActive: $businessEloquent->is_active,
            userId: $businessEloquent->user_id,
            photos: $businessEloquent->images,
            services: null,
        );
    }

    public static function fromEloquentWithServices(BusinessEloquentModel $businessEloquent): Business
    {
        return new Business(
            id: $businessEloquent->id,
            name: new Name($businessEloquent->name),
            phoneNumber: new PhoneNumber($businessEloquent->phone_number),
            address: new Address($businessEloquent->address),
            email: new Email($businessEloquent->email),
            googleMapsUrl: new GoogleMapsUrl($businessEloquent->google_maps_url),
            city: new City($businessEloquent->city),
            stateId: $businessEloquent->state_id,
            neighborhood: new Neighborhood($businessEloquent->neighborhood),
            street1: new Street1($businessEloquent->street_1),
            street2: new Street2($businessEloquent->street_2),
            photo: new Photo($businessEloquent->photo),
            isActive: $businessEloquent->is_active,
            userId: $businessEloquent->user_id,
            photos: $businessEloquent->images,
            services: $businessEloquent->services,
        );
    }

    public static function toEloquent(Business $business): BusinessEloquentModel
    {
        $businessEloquent = new BusinessEloquentModel();
        if ($business->id) {
            $businessEloquent = BusinessEloquentModel::query()->findOrFail($business->id);
        }
        $businessEloquent->name = $business->name;
        $businessEloquent->phone_number = $business->phoneNumber;
        $businessEloquent->address = $business->address;
        $businessEloquent->email = $business->email;
        $businessEloquent->google_maps_url = $business->googleMapsUrl;
        $businessEloquent->city = $business->city;
        $businessEloquent->state_id = $business->stateId;
        $businessEloquent->neighborhood = $business->neighborhood;
        $businessEloquent->street_1 = $business->street1;
        $businessEloquent->street_2 = $business->street2;
        $businessEloquent->photo = $business->photo;
        $businessEloquent->is_active = $business->isActive;
        $businessEloquent->user_id = $business->userId;
        return $businessEloquent;
    }
}
