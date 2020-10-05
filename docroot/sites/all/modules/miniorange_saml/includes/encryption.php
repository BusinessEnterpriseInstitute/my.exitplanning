<?php


class AESEncryption
{
    public static function encrypt_data($P1, $xt)
    {
        $xt = openssl_digest($xt, "\x73\150\141\62\65\x36");
        $Ee = "\101\105\x53\55\x31\62\x38\x2d\x43\x42\x43";
        $cF = openssl_cipher_iv_length($Ee);
        $BU = openssl_random_pseudo_bytes($cF);
        $uk = openssl_encrypt($P1, $Ee, $xt, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $BU);
        return base64_encode($BU . $uk);
    }
    public static function decrypt_data($P1, $xt, $Ee = "\101\x45\123\55\61\x32\70\x2d\x43\x42\x43")
    {
        $JN = base64_decode($P1);
        $xt = openssl_digest($xt, "\x73\150\141\x32\x35\x36");
        $cF = openssl_cipher_iv_length($Ee);
        $BU = substr($JN, 0, $cF);
        $P1 = substr($JN, $cF);
        $np = openssl_decrypt($P1, $Ee, $xt, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $BU);
        return $np;
    }
}
?>
