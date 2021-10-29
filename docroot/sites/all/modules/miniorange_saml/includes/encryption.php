<?php


class AESEncryption
{
    public static function encrypt_data($kE, $im)
    {
        $im = openssl_digest($im, "\x73\x68\141\x32\65\x36");
        $Ei = "\x41\x45\x53\x2d\61\x32\70\x2d\103\x42\103";
        $QA = openssl_cipher_iv_length($Ei);
        $Px = openssl_random_pseudo_bytes($QA);
        $NA = openssl_encrypt($kE, $Ei, $im, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Px);
        return base64_encode($Px . $NA);
    }
    public static function decrypt_data($kE, $im, $Ei = "\101\x45\123\55\x31\62\70\55\x43\x42\x43")
    {
        $R9 = base64_decode($kE);
        $im = openssl_digest($im, "\163\150\141\62\65\66");
        $QA = openssl_cipher_iv_length($Ei);
        $Px = substr($R9, 0, $QA);
        $kE = substr($R9, $QA);
        $ea = openssl_decrypt($kE, $Ei, $im, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Px);
        return $ea;
    }
}
