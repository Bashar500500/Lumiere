<?php

namespace App\Traits\Response;
use Illuminate\Http\JsonResponse;
use App\Enums\Trait\ModelName;
use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ResponseStatus;
use App\Exceptions\InternalException;

trait ResponseTrait
{
    public object $data;
    public ModelName $modelName;
    public FunctionName $functionName;
    public InternalException $internalException;

    public function setData(object $data)
    {
        $this->data = $data;
        return $this;
    }

    public function setFunctionName(FunctionName $functionName)
    {
        $this->functionName = $functionName;
        return $this;
    }

    public function setModelName(ModelName $modelName)
    {
        $this->modelName = $modelName;
        return $this;
    }

    public function setInternalException(InternalException $internalException)
    {
        $this->internalException = $internalException;
        return $this;
    }

    public function successResponse(): JsonResponse
    {
        return response()->json([
            'status' => ResponseStatus::Success->getMessage(),
            'message' => $this->modelName->getMessage() . $this->functionName->getMessage(),
            'data' => $this->data,
            ], 200);
    }

    public function errorResponse(): JsonResponse
    {
        $code = $this->internalException->getInternalCode();

        return response()->json([
            'status' => ResponseStatus::Error->getMessage(),
            'code' => $code->value,
            'message' => $this->internalException->getMessage(),
            'description' => $this->internalException->getDescription(),
            'link' => $code->getLink(),
        ], $this->internalException->getCode());
    }
}
