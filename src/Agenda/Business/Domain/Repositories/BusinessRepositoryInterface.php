<?php

namespace Src\Agenda\Business\Domain\Repositories;

//use Src\Agenda\UserEloquentModel\Infrastructure\Repositories\UserDoesNotExistException;

use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\User\Domain\Model\User;
use Src\Agenda\User\Domain\Model\ValueObjects\Password;

interface BusinessRepositoryInterface
{
    // public function findAll(): array;

    // public function findById(string $businessId): Business;

    public function store(Business $business): Business;

    // public function update(Business $business): void;

}
