<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserApiController extends Controller
{
    public function list(Request $request) {
        return new UserCollection(User::all());
    }

    public function get(Request $request, $id) {
        return new UserResource(User::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $status = $request->input('status');
        $request->input('status');
        $user->status = $status;
        $user->save();
        return $user->toJson();

    }

    public function getStatuses(Request $request) {
        return response()->json(["Active", "Inactive", "Pending", "Banned"]);
    }
}
