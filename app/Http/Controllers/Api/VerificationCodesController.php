<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request)
    {
        $phone = $request->input('phone');
        $code = '1234';

        $key = 'verificationCode_' . str_random(15);
        $expiredAt = now()->addMinutes(10);

        // 缓存验证码，10 分钟过期
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);


        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
