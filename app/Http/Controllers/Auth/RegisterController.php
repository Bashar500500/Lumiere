<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Auth\BaseController as BaseController;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use App\Models\User\User;


class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'in:student,instructor,admin'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            // 'role' => $fields['role'] ?? 'student',
        ]);

        // $user['token'] =  $user->createToken('api_token')->accessToken;
        $user['token'] =  'ljsdjfsdfsdfdfbsdbisub';

        $data = UserResource::make($user);

        return $this->controller->setFunctionName(FunctionName::Register)
            ->setModelName(ModelName::User)
            ->setData($data)
            ->successResponse();
        // return $this->sendResponse($success, 'User register successfully.');
    }
    // public function register(Request $request)
    // {
    //     $validator = FacadesValidator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //         'role' => 'in:student,instructor,admin'
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     $success['token'] =  $user->createToken('MyApp')->accessToken;
    //     $success['name'] =  $user->name;
    //     return $this->sendResponse($success, 'User register successfully.');
    // }
}
