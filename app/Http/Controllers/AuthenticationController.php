<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use PragmaRX\Google2FA\Google2FA;
use Session;

class AuthenticationController extends Controller
{

    private $email = 'demo@gmail.com';

    /**
     * 介面：檢查驗證碼
     * @param  $google2fa   google authentication物件
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Google2FA $google2fa)
    {
        $key = $google2fa->generateSecretKey();
        Session::put('google_key', $key);

        $google2fa_url = $google2fa->getQRCodeGoogleUrl(
            env('GOOGLE_COMPANY'),
            $this->email,
            $key
        );

        return view('authentication', [
            'google2fa_url' => $google2fa_url
        ]);
    }

    /**
     * 操作：檢查驗證碼是否正確
     * @param  $google2fa   google authentication物件
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCheck(Google2FA $google2fa)
    {
        $check = $google2fa->verifyKey(Session::get('google_key'), request()->input('secret'));
        if ($check == true) {
            return response()->json(['result' => '驗證成功']);
        } else {
            return response()->json(['result' => '驗證失敗']);
        }
    }

}
