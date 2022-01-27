<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Create a new user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'username' => 'required|string|unique:users,username',
            'password' => 'required|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Identifies an existing user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return $this->successResponse($request->user());
    }

    /**
     * Authenticate an existing user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        $this->validate($request, $rules);

        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return $this->errorResponse('User does not exist', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!(Hash::check($request->password, $user->password))) {
            return $this->errorResponse('Password mismatch', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token, 'user' => $user->id];
        return $this->successResponse($response);
    }

    /**
     * Expires the token from the authenticated user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout (Request $request): JsonResponse
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];

        return $this->successResponse($response);
    }
}
