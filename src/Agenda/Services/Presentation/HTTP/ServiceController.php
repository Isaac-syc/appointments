<?php

namespace Src\Agenda\Services\Presentation\HTTP;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Auth\Domain\AuthInterface;
use Src\Common\Infrastructure\Laravel\Controller;
use Symfony\Component\HttpFoundation\Response;
use Src\Agenda\Services\Application\UseCases\Commands\StoreServiceCommand;

class ServiceController extends Controller
{

    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }


    public function store(Request $request): JsonResponse
    {
        try {
            $service = (new StoreServiceCommand($request))->execute();
            return response()->json([
                "data" => [
                    "service" => $service
                ]
            ], 200);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
