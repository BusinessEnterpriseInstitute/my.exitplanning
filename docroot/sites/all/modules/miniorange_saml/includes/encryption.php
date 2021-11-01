<?php


class AESEncryption
{
    public static function encrypt_data($pK, $u7)
    {
        $u7 = openssl_digest($u7, "\163\x68\141\62\65\x36");
        $ch = "\x41\105\x53\55\x31\62\70\55\103\x42\x43";
        $b_ = openssl_cipher_iv_length($ch);
        $Cc = openssl_random_pseudo_bytes($b_);
        $mY = openssl_encrypt($pK, $ch, $u7, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Cc);
        return base64_encode($Cc . $mY);
    }
    public static function decrypt_data($pK, $u7, $ch = "\x41\105\123\55\61\x32\x38\x2d\103\102\103")
    {
        $gO = base64_decode($pK);
        $u7 = openssl_digest($u7, "\163\150\141\62\x35\x36");
        $b_ = openssl_cipher_iv_length($ch);
        $Cc = substr($gO, 0, $b_);
        $pK = substr($gO, $b_);
        $dQ = openssl_decrypt($pK, $ch, $u7, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $Cc);
        return $dQ;
    }
}
