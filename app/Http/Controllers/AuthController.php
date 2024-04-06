<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Traits\ApiResponser;

class AuthController extends Controller
{
    use ApiResponser;





    
    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $data["password"] = Hash::make($request->password);
        $data["rol"] = "patient";

        $user = User::create($data);
        return $this->successResponse(['data' => (new UserResource($user)), 'message' => 'Ha registrado sus datos correctamente, ahora puedes iniciar sesión.']);
    }

   


    /**
     * @OA\Post(
     * path="/api/login",
     * tags={"Access control"},
     * summary="Login a user.",
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             @OA\Property(
     *                property="email",
     *                description="User email",
     *                example="name@dominio.com",
     *                type="string"
     *             ),
     *             @OA\Property(
     *                property="password",
     *                description="User password",
     *                example="082484",
     *                type="string"
     *             )
     *         )
     *     )
     * ),
     *     @OA\Response(response="200", description="Display a credential User."),
     *     @OA\Response(response="201", description="Successful operation"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="401", description="Unauthenticated"),
     *     @OA\Response(response="403", description="Forbidden")
     * )
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse(['data' => (new UserResource($user)), 'token' => $token]);
        }
        return response()->json(['message' => 'Datos incorrectos, por favor verifique.', 'action' => 'login', 'code' => 401], 401);
    }




     /**
     * @OA\Post(
     * path="/api/logout",
     * summary="Logout a user.",
     * tags={"Access control"},
     * @OA\Response(response="200", description="Logout a user.")
     * )
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->successResponse(['message' => 'La session se cerro con exito', 'status' => true]);
    }
}
