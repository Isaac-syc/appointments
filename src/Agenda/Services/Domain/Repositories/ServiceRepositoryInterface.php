<?php

namespace Src\Agenda\Services\Domain\Repositories;

//use Src\Agenda\UserEloquentModel\Infrastructure\Repositories\UserDoesNotExistException;

use Illuminate\Http\Request;
use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Services\Infrastructure\EloquentModels\ServiceEloquentModel;

interface ServiceRepositoryInterface
{
    // public function getAll(): array;

    // public function getById(int $businessId): Business;

    public function store(Request $request): ServiceEloquentModel;

    // public function update(Business $business, array $urls): Business;

    // public function storeWorkingHour(Request $request): void;

    // public function deleteWorkingHour(int $id, string $day): void;

}
