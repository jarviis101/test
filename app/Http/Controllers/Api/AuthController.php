<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use App\Http\Controllers\Controller;


use App\Models\User;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints"
 * )
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"Users"},
     *      summary="Log in",
     *      description="Login user.",
     *      operationId="login",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Login user",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="password", type="string")
     *              )
     *          )
     *      ),
     *      @OA\Response(response="default", description="Successful operation")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if ($token = JWTAuth::attempt($credentials)) {
            return $this->respondWithToken($token);
        }


        return response()->json(['error' => 'Unauthorized'], 401);
    }
    /**
     * @OA\Post(
     *      path="/auth/me?token={token}",
     *      @OA\Parameter(
     *          name="token",
     *          description="JWT token",
     *          required=true,
     *          in="path"
     *      ),
     *      tags={"Users"},
     *      summary="User info",
     *      description="User info.",
     *      operationId="me",
     *      @OA\Response(response="default", description="Successful operation")
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();


        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Post(
     *      path="/auth/register",
     *      tags={"Users"},
     *      summary="Register",
     *      description="Register new user.",
     *      operationId="register",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Register user",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="password", type="string"),
     *                  @OA\Property(property="password_confirmation", type="string")
     *              )
     *          )
     *      ),
     *      @OA\Response(response="default", description="Successful operation")
     * )
     */
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' =>
                    $validator->errors()->toArray()
            ], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'message' => 'User created.',
            'user' => $user
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
