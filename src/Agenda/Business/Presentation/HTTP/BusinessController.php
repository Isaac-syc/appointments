<?php

namespace Src\Agenda\Business\Presentation\HTTP;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Src\Agenda\Business\Application\Mappers\BusinessMapper;
use Src\Agenda\Business\Application\UseCases\Commands\StoreBusinessCommand;
use Src\Auth\Domain\AuthInterface;
use Src\Common\Infrastructure\Laravel\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Src\Agenda\Business\Application\UseCases\Commands\DeleteWorkingHourBusinessCommand;
use Src\Agenda\Business\Application\UseCases\Commands\GetAllBusinessCommand;
use Src\Agenda\Business\Application\UseCases\Commands\GetByIdBusinessCommand;
use Src\Agenda\Business\Application\UseCases\Commands\StoreWorkingHourBusinessCommand;
use Src\Agenda\Business\Application\UseCases\Commands\UpdateBusinessCommand;

use function PHPUnit\Framework\isNull;

class BusinessController extends Controller
{

    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function all(): JsonResponse
    {
        try {

            $bussiness = (new GetAllBusinessCommand())->execute();
            return response()->json([
                "data" => [
                    "bussiness" => $bussiness
                ]
            ], 200);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function getById(int $id): JsonResponse
    {
        try {

            $bussiness = (new GetByIdBusinessCommand($id))->execute();
            return response()->json([
                "data" => [
                    "business" => $bussiness->toArray()
                ]
            ], 200);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            return response()->json([
                "data" => [
                    "business" => "llega"
                ]
            ], 201);
            $url = null;
            $urls = array();

            if ($request->has('photo')) {
                $mime_type = $request->file('photo')->getClientOriginalExtension();
                $filename = Str::uuid() . '.' . $mime_type;
                Storage::disk('public_uploads')->put('/bussiness/' . $filename, File::get($request->photo));
                $url = env('APP_URL') . '/bussiness/' . $filename;
            }


            if ($request->has('photos')) {
                $index = 0;

                foreach ($request->photos as $photo) {

                    $mime_type = $request->file('photos')[$index]->getClientOriginalExtension();
                    $filename = Str::uuid() . '.' . $mime_type;
                    Storage::disk('public_uploads')->put('/bussiness/' . $filename, File::get($photo));
                    $urls[] = env('APP_URL') . '/bussiness/' . $filename;

                    $index++;
                }
            }

            $bussinessData = BusinessMapper::fromRequest($request, null, $url, $this->auth->me()->id);
            $business = (new StoreBusinessCommand($bussinessData, $urls))->execute();
            return response()->json([
                "data" => [
                    "business" => $business->toArray()
                ]
            ], 201);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $url = null;
            if ($request->file('photo') !== null) {
                $mime_type = $request->file('photo')->getClientOriginalExtension();
                $filename = Str::uuid() . '.' . $mime_type;
                Storage::disk('public_uploads')->put('/bussiness/' . $filename, File::get($request->photo));
                $url = env('APP_URL') . '/bussiness/' . $filename;
            }

            $urls = array();
            if ($request->has('photos')) {
                $index = 0;
                foreach ($request->photos as $photo) {
                    $mime_type = $request->file('photos')[$index]->getClientOriginalExtension();
                    $filename = Str::uuid() . '.' . $mime_type;
                    Storage::disk('public_uploads')->put('/bussiness/' . $filename, File::get($photo));
                    $urls[] = env('APP_URL') . '/bussiness/' . $filename;

                    $index++;
                }
            }

            $bussinessData = BusinessMapper::fromRequest($request, $id, $url, $this->auth->me()->id);
            $business = (new UpdateBusinessCommand($bussinessData, $urls))->execute();
            return response()->json([
                "data" => [
                    "business" => $business->toArray()
                ]
            ], 200);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    public function createWorkingHour(Request $request): JsonResponse
    {
        try {

            (new StoreWorkingHourBusinessCommand($request))->execute();
            return response()->json([
                "data" => [
                    "message" => "created"
                ]
            ], 201);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteWorkingHour(int $id, string $day): JsonResponse
    {
        try {

            (new DeleteWorkingHourBusinessCommand($id, $day))->execute();
            return response()->json([
                "data" => [
                    "message" => "deleted"
                ]
            ], 201);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
