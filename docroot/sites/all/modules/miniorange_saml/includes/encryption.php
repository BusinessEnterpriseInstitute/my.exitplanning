<?php


class AESEncryption
{
    public static function encrypt_data($uq, $hG)
    {
        $hG = openssl_digest($hG, "\163\150\141\x32\65\66");
        $R2 = "\x41\105\x53\55\61\62\x38\x2d\x43\x42\103";
        $Je = openssl_cipher_iv_length($R2);
        $pI = openssl_random_pseudo_bytes($Je);
        $Ln = openssl_encrypt($uq, $R2, $hG, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $pI);
        return base64_encode($pI . $Ln);
    }
    public static function decrypt_data($uq, $hG, $R2 = "\101\x45\x53\55\61\x32\x38\55\103\102\x43")
    {
        $dH = base64_decode($uq);
        $hG = openssl_digest($hG, "\163\x68\x61\62\x35\x36");
        $Je = openssl_cipher_iv_length($R2);
        $pI = substr($dH, 0, $Je);
        $uq = substr($dH, $Je);
        $cO = openssl_decrypt($uq, $R2, $hG, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $pI);
        return $cO;
    }
}
