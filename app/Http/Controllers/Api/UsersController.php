<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->input('verification_key'));

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }

        if (!hash_equals($verifyData['code'], $request->input('verification_code'))) {
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::query()->create([
            'name' => $request->input('name'),
            'phone' => $verifyData['phone'],
            'password' => bcrypt($request->input('password')),
        ]);

        \Cache::forget($request->input('verification_key'));

        return $this->response->created();
    }
}
