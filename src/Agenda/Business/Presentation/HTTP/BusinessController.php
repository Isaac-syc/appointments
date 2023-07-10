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
            $mime_type = $request->file('photo')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $mime_type;
            Storage::disk('public_uploads')->put('/bussiness/' . $filename, File::get($request->photo));
            $url = env('APP_URL') . '/bussiness/' . $filename;

            if ($request->has('photos')) {
                return response()->json([
                    "data" => [
                        "business" => 'Llego'
                    ]
                ], 200);
            }

            $bussinessData = BusinessMapper::fromRequest($request, null, $url, $this->auth->me()->id);
            $business = (new StoreBusinessCommand($bussinessData))->execute();
            return response()->json([
                "data" => [
                    "business" => $business->toArray()
                ]
            ], 201);
        } catch (\DomainException $domainException) {
            return response()->error($domainException->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
