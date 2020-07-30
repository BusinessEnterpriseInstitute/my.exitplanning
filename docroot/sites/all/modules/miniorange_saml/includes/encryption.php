<?php


class AESEncryption
{
    public static function encrypt_data($eY, $qT)
    {
        $qT = openssl_digest($qT, "\x73\x68\141\62\65\x36");
        $Cp = "\x41\105\x53\55\61\x32\70\55\103\x42\103";
        $Mr = openssl_cipher_iv_length($Cp);
        $J6 = openssl_random_pseudo_bytes($Mr);
        $kx = openssl_encrypt($eY, $Cp, $qT, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $J6);
        return base64_encode($J6 . $kx);
    }
    public static function decrypt_data($eY, $qT, $Cp = "\101\105\x53\55\61\62\x38\x2d\103\x42\103")
    {
        $YC = base64_decode($eY);
        $qT = openssl_digest($qT, "\163\150\x61\x32\x35\66");
        $Mr = openssl_cipher_iv_length($Cp);
        $J6 = substr($YC, 0, $Mr);
        $eY = substr($YC, $Mr);
        $It = openssl_decrypt($eY, $Cp, $qT, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $J6);
        return $It;
    }
}
?>
