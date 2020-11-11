<?php

namespace App\Http\Controllers\Api\v1;

use App\Group;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 422, array(), JSON_PRETTY_PRINT);
        }

        $user = new User([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => $request->password,
            'group_id' => env('APP_DEFAULT_GROUP_ID', Group::getDefaultGroupId()),
        ]);
        $user->save();

        return response()->json([
            'success' => true,
            'id' => $user->id,
            'name' => $user->first_name,
            'email' => $user->email,
        ], 201);

//        return response()->json([
//            'message' => 'Successfully created user!',
//        ], 201, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request) {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request([
            'email',
            'password',
        ]);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return response()->json([
            'success' => true,
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

//        return response()->json([
//            'access_token' => $tokenResult->accessToken,
//            'token_type'   => 'Bearer',
//            'expires_at'   => Carbon::parse(
//                $tokenResult->token->expires_at
//            )->toDateTimeString(),
//        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request) {
        return response()->json(
            User::with('group')->where('id', $request->user()->id)->first(),
            200,
            [],
            JSON_PRETTY_PRINT
        );
    }
}
