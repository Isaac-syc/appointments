<?php

namespace Src\Agenda\Business\Application\UseCases\Commands;

use Src\Agenda\Business\Domain\Repositories\BusinessRepositoryInterface;
use Src\Common\Domain\CommandInterface;

class GetAllBusinessCommand implements CommandInterface
{
    private BusinessRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app()->make(BusinessRepositoryInterface::class);
    }

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
