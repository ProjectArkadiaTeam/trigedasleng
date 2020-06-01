<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get the Users profile
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse [json] user object
     */
    public function profile(Request $request, $id) {
        $user = User::with('group')->where('id', $id)->first();
        if($user){
            $user->makeHidden('verified_at');
        }

        return response()->json(
            $user,
            200,
            [],
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Update the Users profile
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null [json] user object
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id) {
        Gate::authorize('update-profile', $id);

        $Profile = User::with('group')->find($id);
        if(!$Profile){
            abort(404, 'User not found.');
        }

        if(Gate::allows('is-admin')){
            $Profile->group_id = $request->has('group_id') ? $request->input('group_id') : $Profile->group_id;
        }

        $Profile->save();

        return $Profile;
    }
}
