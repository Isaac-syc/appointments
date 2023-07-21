<?php

namespace Src\Agenda\Services\Application\UseCases\Commands;

use Illuminate\Http\Request;
use Src\Agenda\Business\Domain\Model\Business;
use Src\Agenda\Services\Domain\Repositories\ServiceRepositoryInterface;
use Src\Agenda\Services\Infrastructure\EloquentModels\ServiceEloquentModel;
use Src\Common\Domain\CommandInterface;

class StoreServiceCommand implements CommandInterface
{
    private ServiceRepositoryInterface $repository;

    public function __construct(
        private readonly Request $request
    )
    {
        $this->repository = app()->make(ServiceRepositoryInterface::class);
    }

    public function execute(): ServiceEloquentModel
    {
        return $this->repository->store($this->request);
    }
}
