<?php

namespace Src\Agenda\Business\Domain\Repositories;

//use Src\Agenda\UserEloquentModel\Infrastructure\Repositories\UserDoesNotExistException;

use Src\Agenda\Business\Domain\Model\Business;

interface BusinessRepositoryInterface
{
    // public function findAll(): array;

    // public function findById(string $businessId): Business;

    public function store(Business $business, array $urls): Business;

    // public function update(Business $business): void;

}
