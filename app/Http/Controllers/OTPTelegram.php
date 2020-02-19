<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class OTPTelegram extends Controller
{
    function defaultReturnMessage(){
        $data = (object)array();
        $data->state = false;
        $data->message = "Failed";
        $data->code = 105;
        $data->http = 0;
        $data->data = [];
        $data->time = $_SERVER['REQUEST_TIME'];
        return $data;
    }
    function url_get_contents($url, $body){
        $data = $this->defaultReturnMessage();
        if ( ! function_exists( 'curl_init' ) ) {
            $data->http = 500;
            $data->message = 'The cURL library is not installed.';
            return $data;
        }
        try{
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_NOBODY, TRUE);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$body); /*$body = "message={base64}"*/
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $response = curl_exec( $ch );
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            curl_close($ch);
            $data->data = $body;
            $data->http = 200;
            $data->code = 100;
            $data->state = true;
            $data->message = 'Success';
            return json_encode($data);
        }catch(Exception $e){
            $data->data = var_export($e);
            $data->http = 400;
            $data->code = 104;
            return json_encode($data);
        }
    }

    function sendMessageVia($id, $message, $platform){
        /*Default Variable*/
        $url = 'https://api.intek.id/via/notifbyviabot.php';
        $body = array(
            'platform' => $platform,
            'id_receiver' => $id,
            'content_type' => 'application/text',
            'content' => $message,
            'date_send' => Date('YmdHis')
        );
        $body = serialize($body);
        $body = 'message='.base64_encode($body);
        $response = $this->url_get_contents($url, $body);
        $log = new log;
        return $response;
    }
}
