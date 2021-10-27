<?php


class AESEncryption
{
    public static function encrypt_data($ub, $nL)
    {
        $nL = openssl_digest($nL, "\x73\150\x61\62\65\66");
        $zu = "\x41\x45\x53\55\61\62\x38\x2d\x43\x42\x43";
        $Mt = openssl_cipher_iv_length($zu);
        $Os = openssl_random_pseudo_bytes($Mt);
        $Dp = openssl_encrypt($ub, $zu, $nL, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Os);
        return base64_encode($Os . $Dp);
    }
    public static function decrypt_data($ub, $nL, $zu = "\x41\x45\x53\x2d\x31\62\x38\55\103\102\x43")
    {
        $Su = base64_decode($ub);
        $nL = openssl_digest($nL, "\163\x68\x61\62\65\66");
        $Mt = openssl_cipher_iv_length($zu);
        $Os = substr($Su, 0, $Mt);
        $ub = substr($Su, $Mt);
        $rX = openssl_decrypt($ub, $zu, $nL, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Os);
        return $rX;
    }
}
