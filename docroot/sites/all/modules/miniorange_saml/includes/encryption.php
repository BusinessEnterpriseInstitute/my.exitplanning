<?php


class AESEncryption
{
    public static function encrypt_data($iu, $Rh)
    {
        $Rh = openssl_digest($Rh, "\163\150\x61\62\x35\x36");
        $o6 = "\101\x45\123\55\x31\x32\70\x2d\103\x42\x43";
        $ii = openssl_cipher_iv_length($o6);
        $sN = openssl_random_pseudo_bytes($ii);
        $A0 = openssl_encrypt($iu, $o6, $Rh, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $sN);
        return base64_encode($sN . $A0);
    }
    public static function decrypt_data($iu, $Rh, $o6 = "\x41\105\123\55\61\62\70\55\103\102\x43")
    {
        $T_ = base64_decode($iu);
        $Rh = openssl_digest($Rh, "\163\150\x61\62\65\x36");
        $ii = openssl_cipher_iv_length($o6);
        $sN = substr($T_, 0, $ii);
        $iu = substr($T_, $ii);
        $H3 = openssl_decrypt($iu, $o6, $Rh, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $sN);
        return $H3;
    }
}
?>
