<?php

namespace Src\Agenda\Business\Application\UseCases\Commands;

use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Business\Domain\Repositories\BusinessRepositoryInterface;
use Src\Common\Domain\CommandInterface;

class StoreBusinessCommand implements CommandInterface
{
    private BusinessRepositoryInterface $repository;

    public function __construct(
        private readonly Business $business,
    )
    {
        $this->repository = app()->make(BusinessRepositoryInterface::class);
    }

    public function execute(): Business
    {
        return $this->repository->store($this->business);
    }
}
