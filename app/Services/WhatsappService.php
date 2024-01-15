<?php

namespace Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function http($slug, $data = [])
    {
        if (setting('wa_isactive') != 'y') {
            return true;
        }else{
            $token = config('services.waindie.key');
            $url='http://147.139.187.197:8001/waapi/' . $slug . '?token=' . $token;
            $data_string = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 360);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'Content-Length: ' . strlen($data_string))
            );
            echo $res=curl_exec($ch);
            curl_close($ch);
        }
    }

    public function send($telp, $message)
    {
        return $this->http('sendMessage', [
            'type' => 'chat',
            'Phone' => $telp,
            'message' => $message
        ]);
    }
}