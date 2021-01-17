<?php

namespace App\Http\Controllers\Api\v1;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function list(Request $request){
        return response()->json(
            Group::all(),
            200,
            []
        );
    }
}
