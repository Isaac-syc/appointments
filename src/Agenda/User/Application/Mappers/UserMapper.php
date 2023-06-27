<?php

namespace Src\Agenda\User\Application\Mappers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Src\Agenda\User\Domain\Model\User;
use Src\Agenda\User\Domain\Model\ValueObjects\Avatar;
use Src\Agenda\User\Domain\Model\ValueObjects\Email;
use Src\Agenda\User\Domain\Model\ValueObjects\LastName;
use Src\Agenda\User\Domain\Model\ValueObjects\Name;
use Src\Agenda\User\Domain\Model\ValueObjects\TypeUsersId;
use Src\Agenda\User\Infrastructure\EloquentModels\UserEloquentModel;

class UserMapper
{
    public static function fromRequest(Request $request, ?int $user_id = null): User
    {
        return new User(
            id: $user_id,
            name: new Name($request->string('name')),
            email: new Email($request->string('email')),
            avatar: new Avatar(binary_data: $request->string('avatar'), filename: null),
            is_admin: $request->boolean('is_admin', false),
            is_active: $request->boolean('is_active', true),
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
