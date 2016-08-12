<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use ReCaptcha\ReCaptcha;

class RecaptchaController extends Controller
{
    private $secret;　/* 註冊API Key時給的Secret key */
    private $siteKey; /* 註冊API Key時給的Site key */

    public function __construct()
    {
        $this->secret = env('GOOGLE_SECRET');
        $this->siteKey = env('GOOGLE_SITEKEY');
    }

    /**
     * 介面：檢查驗證碼
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('recaptcha', [
            'siteKey' => $this->siteKey
        ]);
    }

    /**
     * 操作：檢查驗證碼是否正確
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCheck()
    {
        $recaptcha = new ReCaptcha($this->secret);
        $check = $recaptcha->verify(request()->input('g-recaptcha-response'), request()->ip());
        if ($check->isSuccess()){
            return response()->json(['result' => '驗證成功']);
        }else{
            return response()->json(['result' => '驗證失敗']);
        }
    }

}
