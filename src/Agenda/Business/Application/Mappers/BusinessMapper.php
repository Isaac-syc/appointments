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
use Src\Agenda\Business\Domain\Model\ValueObjects\UserId;

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
            stateId: new StateId($request->integer('stateId')),
            neighborhood: new Neighborhood($request->string('neighborhood')),
            street1: new Street1($request->string('street1')),
            street2: new Street2($request->string('street2')),
            photo: new Photo($photoUrl),
            isActive: $request->boolean('isActive', true),
            userId: $userId,
        );
    }

    public static function fromEloquent(UserEloquentModel $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: new Name($userEloquent->name),
            email: new Email($userEloquent->email),
            last_name: new LastName($userEloquent->last_name),
            type_users_id: new TypeUsersId($userEloquent->type_users_id)
        );
    }

    public static function fromAuth(Authenticatable $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: new Name($userEloquent->name),
            email: new Email($userEloquent->email),
            last_name: new LastName($userEloquent->last_name),
            type_users_id: new TypeUsersId($userEloquent->type_users_id)
        );
    }

    public static function toEloquent(User $user): UserEloquentModel
    {
        $userEloquent = new UserEloquentModel();
        if ($user->id) {
            $userEloquent = UserEloquentModel::query()->findOrFail($user->id);
        }
        $userEloquent->name = $user->name;
        $userEloquent->email = $user->email;
        $userEloquent->avatar = $user->avatar->filename;
        $userEloquent->is_admin = $user->is_admin;
        $userEloquent->is_active = $user->is_active;
        return $userEloquent;
    }
}
