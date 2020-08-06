<?php


class AESEncryption
{
    public static function encrypt_data($w5, $AM)
    {
        $AM = openssl_digest($AM, "\x73\x68\x61\x32\65\x36");
        $L8 = "\x41\x45\123\x2d\x31\x32\x38\55\x43\x42\x43";
        $fq = openssl_cipher_iv_length($L8);
        $NN = openssl_random_pseudo_bytes($fq);
        $kC = openssl_encrypt($w5, $L8, $AM, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $NN);
        return base64_encode($NN . $kC);
    }
    public static function decrypt_data($w5, $AM, $L8 = "\x41\x45\123\55\61\x32\x38\55\x43\x42\103")
    {
        $mu = base64_decode($w5);
        $AM = openssl_digest($AM, "\163\150\x61\x32\x35\66");
        $fq = openssl_cipher_iv_length($L8);
        $NN = substr($mu, 0, $fq);
        $w5 = substr($mu, $fq);
        $zZ = openssl_decrypt($w5, $L8, $AM, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $NN);
        return $zZ;
    }
}
?>
