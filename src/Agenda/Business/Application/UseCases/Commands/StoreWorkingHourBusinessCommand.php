<?php

namespace Src\Agenda\Business\Application\UseCases\Commands;

use Illuminate\Http\Request;
use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Business\Domain\Repositories\BusinessRepositoryInterface;
use Src\Common\Domain\CommandInterface;

class StoreWorkingHourBusinessCommand implements CommandInterface
{
    private BusinessRepositoryInterface $repository;

    public function __construct(
        private readonly Request $request,
    )
    {
        $this->repository = app()->make(BusinessRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->storeWorkingHour($this->request);
    }
}
