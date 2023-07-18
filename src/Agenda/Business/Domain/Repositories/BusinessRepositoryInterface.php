<?php

namespace Src\Agenda\Business\Domain\Repositories;

//use Src\Agenda\UserEloquentModel\Infrastructure\Repositories\UserDoesNotExistException;

use Illuminate\Http\Request;
use Src\Agenda\Business\Domain\Model\Business;

interface BusinessRepositoryInterface
{
    public function getAll(): array;

    public function getById(int $businessId): Business;

    public function store(Business $business, array $urls): Business;

    public function update(Business $business, array $urls): Business;

    public function storeWorkingHour(Request $request): void;

    public function deleteWorkingHour(int $id, string $day): void;

}
