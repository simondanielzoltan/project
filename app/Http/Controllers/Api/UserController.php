<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function show(User $user) {
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user) {
        $user->update([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'address' => $request->email,
        ]);
        $user->zipCode()->associate($request->zipCodeId);
        return new UserResource($user);
    }
}
