<?php
abstract class ArcjasCryptUtility
{
    const KEY_ENCRYPT = "A#!%AD31saaA!#";

    public static function encrypt($sourceCode, $key)
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryptedData = openssl_encrypt(
            $sourceCode,
            $ciphering,
            $key,
            $options,
            $encryption_iv
        );
        return bin2hex($encryptedData);
    }

    public static function decrypt($sourceCode, $key)
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = '1234567891011121';
        $binaryData = hex2bin($sourceCode);
        return openssl_decrypt(
            $binaryData,
            $ciphering,
            $key,
            $options,
            $decryption_iv
        );
    }

    public static function response($success = true, $msg = "", $data = [], $status = 200)
    {
        header("Content-type: application/json; charset=utf-8");
        http_response_code($status);
        $resp = new stdClass;
        $resp->success = $success;
        $resp->msg = $msg;
        $resp->data = $data;
        echo json_encode($resp);
    }
}
