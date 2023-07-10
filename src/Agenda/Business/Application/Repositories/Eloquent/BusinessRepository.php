<?php

namespace Src\Agenda\Business\Application\Repositories\Eloquent;

use Src\Agenda\Business\Application\Mappers\BusinessMapper;
use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Business\Domain\Repositories\BusinessRepositoryInterface;
use Src\Agenda\Image\Infrastructure\EloquentModels\ImageEloquentModel;

class BusinessRepository implements BusinessRepositoryInterface
{
    // public function findAll(): array
    // {
    //     $users = [];
    //     foreach (UserEloquentModel::all() as $userEloquent) {
    //         $users[] = UserMapper::fromEloquent($userEloquent);
    //     }
    //     return $users;
    // }

    // public function findById(string $userId): User
    // {
    //     $userEloquent = UserEloquentModel::query()->findOrFail($userId);
    //     return UserMapper::fromEloquent($userEloquent);
    // }

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

    // public function update(User $user, Password $password): void
    // {
    //     $userEloquent = UserMapper::toEloquent($user);
    //     if ($password->isNotEmpty()) {
    //         $userEloquent->password = $password->value;
    //     }
    //     $userEloquent->save();
    // }

}
