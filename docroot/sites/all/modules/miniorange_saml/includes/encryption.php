<?php


class AESEncryption
{
    public static function encrypt_data($HC, $l9)
    {
        $l9 = openssl_digest($l9, "\x73\x68\141\x32\65\x36");
        $TI = "\101\105\x53\x2d\x31\x32\x38\x2d\x43\x42\x43";
        $OC = openssl_cipher_iv_length($TI);
        $zi = openssl_random_pseudo_bytes($OC);
        $BI = openssl_encrypt($HC, $TI, $l9, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $zi);
        return base64_encode($zi . $BI);
    }
    public static function decrypt_data($HC, $l9, $TI = "\101\105\123\x2d\61\x32\x38\x2d\103\102\103")
    {
        $ZC = base64_decode($HC);
        $l9 = openssl_digest($l9, "\163\x68\141\x32\x35\66");
        $OC = openssl_cipher_iv_length($TI);
        $zi = substr($ZC, 0, $OC);
        $HC = substr($ZC, $OC);
        $OO = openssl_decrypt($HC, $TI, $l9, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $zi);
        return $OO;
    }
}
?>
