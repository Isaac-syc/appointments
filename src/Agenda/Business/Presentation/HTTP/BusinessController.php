<?php

namespace Src\Agenda\Business\Presentation\HTTP;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Agenda\Business\Application\Mappers\BusinessMapper;
use Src\Agenda\User\Application\Mappers\UserMapper;
use Src\Agenda\User\Application\UseCases\Commands\DestroyUserCommand;
use Src\Agenda\User\Application\UseCases\Commands\StoreUserCommand;
use Src\Agenda\User\Application\UseCases\Commands\UpdateUserCommand;
use Src\Agenda\User\Application\UseCases\Queries\FindAllUsersQuery;
use Src\Agenda\User\Application\UseCases\Queries\FindUserByIdQuery;
use Src\Agenda\User\Domain\Model\ValueObjects\Password;
use Src\Auth\Domain\AuthInterface;
use Src\Common\Domain\Exceptions\UnauthorizedUserException;
use Src\Common\Infrastructure\Laravel\Controller;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Contracts\Providers\JWT as ProvidersJWT;

class BusinessController extends Controller
{

    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }


    public function store(Request $request): JsonResponse
    {

        try {
            $bussinessData = BusinessMapper::fromRequest($request, null, "wwww.img.com", $this->auth->me()->id);
            return response()->json($bussinessData, 200);
            $business = (new StoreUserCommand($userData, $password))->execute();
            return response()->success($user->toArray(), Response::HTTP_CREATED);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->error($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
    }

}
