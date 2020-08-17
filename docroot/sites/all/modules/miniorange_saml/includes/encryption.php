<?php


class AESEncryption
{
    public static function encrypt_data($EV, $FS)
    {
        $FS = openssl_digest($FS, "\163\150\141\x32\x35\66");
        $jJ = "\x41\105\x53\x2d\61\x32\x38\55\x43\x42\x43";
        $j0 = openssl_cipher_iv_length($jJ);
        $ow = openssl_random_pseudo_bytes($j0);
        $fn = openssl_encrypt($EV, $jJ, $FS, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $ow);
        return base64_encode($ow . $fn);
    }
    public static function decrypt_data($EV, $FS, $jJ = "\101\x45\x53\55\61\x32\70\x2d\x43\x42\103")
    {
        $F7 = base64_decode($EV);
        $FS = openssl_digest($FS, "\163\x68\x61\62\x35\x36");
        $j0 = openssl_cipher_iv_length($jJ);
        $ow = substr($F7, 0, $j0);
        $EV = substr($F7, $j0);
        $tX = openssl_decrypt($EV, $jJ, $FS, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $ow);
        return $tX;
    }
}
?>
