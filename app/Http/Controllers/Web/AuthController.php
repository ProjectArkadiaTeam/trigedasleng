<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Login user (Web Route)
     * @param Request $request
     */
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // This seems redundant, but let's create an HTTP request to the API to login the user
        try{
            $client = new Client([
                'verify' => !env('APP_DEBUG', false),
            ]);
            $response = $client->post(url('/api/v1/auth/login'), [
                RequestOptions::JSON  => [
                    'email' => $request->username,
                    'password' => $request->password,
                ],
                RequestOptions::HEADERS => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            $body = json_decode($response->getBody()->getContents());
            $token = $body->access_token;

            // Now that the user is logged in, get the user profile
            $response = $client->get(url('/api/v1/auth/me'), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ]);
            $body = json_decode($response->getBody()->getContents());

            session([
               'access_token' => $token,
               'username' => $body->username,
               'admin' => $body->group->admin,
            ]);
            return 'Success';
        }catch(\Exception $ex){
            //Guzzle throws an exception during certain HTTP status codes
            return 'Incorrect password or username!';
        }
    }
    public function profile(Request $request) {
        if(session('access_token') === null){
            return redirect(route('home'));
        }
        // This seems redundant, but let's create an HTTP request to the API to login the user
        try{
            $client = new Client([
                'verify' => !env('APP_DEBUG', false),
            ]);
            $response = $client->get(url('/api/v1/auth/me'), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . session('access_token'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ]);
            $user = json_decode($response->getBody()->getContents());

            return view('profile', [
                'user' => $user,
            ]);
        }catch(\Exception $ex){
            //Guzzle throws an exception during certain HTTP status codes
            return redirect(url('/404')); // TODO: Change this
        }
    }
}
