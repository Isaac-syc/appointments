<?php

namespace Src\Agenda\Business\Domain\Repositories;

//use Src\Agenda\UserEloquentModel\Infrastructure\Repositories\UserDoesNotExistException;

use Src\Agenda\Business\Domain\Model\Business;

interface BusinessRepositoryInterface
{
    public function getAll(): array;

    public function getById(int $businessId): Business;

    public function store(Business $business, array $urls): Business;

    public function update(Business $business, array $urls): Business;

}
