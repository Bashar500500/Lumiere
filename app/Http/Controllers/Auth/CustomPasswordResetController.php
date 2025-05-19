<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\Auth\SendResetCodeRequest;
use App\Http\Requests\Auth\VerifyResetCodeRequest;
use App\Http\Resources\Auth\PasswordResetResource;
use App\Jobs\MailJob;
use App\Services\Auth\PasswordResetService;
use Illuminate\Http\JsonResponse;

class CustomPasswordResetController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected PasswordResetService $service
    ) {
        parent::__construct($controller);
    }

    public function verifyResetCode(VerifyResetCodeRequest $request): JsonResponse
    {
        $data=PasswordResetResource::make(
            $this->service->verifyCode($request),
        );

        return $this->controller
            ->setFunctionName(FunctionName::VerifyCode)
            ->setModelName(ModelName::PasswordReset)
            ->setData($data)
            ->successResponse();
    }
    
    public function sendResetCode(SendResetCodeRequest $request): JsonResponse
    {
        $mail = $this->service->sendCode($request);
        $data = PasswordResetResource::make(
            $mail,
        );
        
        // MailJob::dispatch($mail);

        return $this->controller
            ->setFunctionName(FunctionName::SendCode)
            ->setModelName(ModelName::PasswordReset)
            ->setData($data)
            ->successResponse();
    }
}
