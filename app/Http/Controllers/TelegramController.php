<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    /**
     * 介面：取得相關資訊(chat id)
     * @return object  bot 相關資訊
     */
    public function getInfo()
    {
        dd(Telegram::getUpdates());
    }

    /**
     * 操作：傳送訊息
     * @return object  傳送訊息執行結果     
     */
    public function sendMessage($message = 'Hello world')
    {
        $result = Telegram::sendMessage(['chat_id' => ENV('TELEGRAM_CHAT_ID'), 'text' => $message]);
        dd($result);
    }
}
