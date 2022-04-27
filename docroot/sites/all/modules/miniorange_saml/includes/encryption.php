<?php


class AESEncryption
{
    public static function encrypt_data($TG, $aC)
    {
        $aC = openssl_digest($aC, "\x73\150\141\x32\x35\66");
        $Ub = "\101\105\123\55\x31\62\x38\x2d\103\x42\x43";
        $IK = openssl_cipher_iv_length($Ub);
        $VV = openssl_random_pseudo_bytes($IK);
        $SS = openssl_encrypt($TG, $Ub, $aC, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $VV);
        return base64_encode($VV . $SS);
    }
    public static function decrypt_data($TG, $aC, $Ub = "\x41\x45\123\55\61\62\x38\x2d\x43\102\x43")
    {
        $Lw = base64_decode($TG);
        $aC = openssl_digest($aC, "\x73\x68\x61\62\x35\x36");
        $IK = openssl_cipher_iv_length($Ub);
        $VV = substr($Lw, 0, $IK);
        $TG = substr($Lw, $IK);
        $Ch = openssl_decrypt($TG, $Ub, $aC, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $VV);
        return $Ch;
    }
}
