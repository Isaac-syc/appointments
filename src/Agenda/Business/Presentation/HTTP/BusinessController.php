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
use Src\Common\Domain\Exceptions\UnauthorizedUserException;
use Src\Common\Infrastructure\Laravel\Controller;
use Symfony\Component\HttpFoundation\Response;

class BusinessController extends Controller
{
    public function store(Request $request): JsonResponse
    {

        try {
            $bussinessData = BusinessMapper::fromRequest($request, null, "wwww.img.com");
            return response()->json($bussinessData, 200);
            $password = new Password($request->input('password'), $request->input('password_confirmation'));
            $user = (new StoreUserCommand($userData, $password))->execute();
            return response()->success($user->toArray(), Response::HTTP_CREATED);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->error($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
    }

}
