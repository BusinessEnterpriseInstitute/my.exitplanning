<?php


class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\x68\164\164\x70\x3a\57\57\x77\x77\x77\x2e\167\63\x2e\157\162\147\x2f\62\60\x30\x31\x2f\60\64\57\x78\155\154\145\x6e\x63\43\164\x72\x69\160\x6c\x65\x64\x65\x73\55\143\x62\x63";
    const AES128_CBC = "\150\164\x74\160\x3a\57\x2f\x77\167\x77\x2e\167\63\56\x6f\162\147\x2f\x32\60\60\x31\57\60\x34\57\x78\155\x6c\x65\156\x63\43\x61\145\163\x31\62\70\55\143\x62\143";
    const AES192_CBC = "\150\x74\164\160\x3a\57\x2f\167\x77\167\56\x77\x33\x2e\x6f\x72\147\57\62\60\60\x31\x2f\x30\64\57\x78\x6d\x6c\x65\156\143\43\x61\x65\x73\61\71\62\55\x63\142\143";
    const AES256_CBC = "\x68\164\164\x70\72\x2f\x2f\x77\167\167\x2e\167\63\56\x6f\x72\147\x2f\62\60\60\61\57\60\x34\57\170\x6d\154\145\156\143\x23\141\145\163\x32\x35\66\x2d\x63\x62\x63";
    const RSA_1_5 = "\x68\164\x74\x70\x3a\57\x2f\167\x77\167\56\x77\x33\x2e\157\x72\x67\57\x32\60\60\x31\x2f\x30\64\x2f\x78\155\154\x65\156\x63\x23\162\x73\x61\x2d\x31\x5f\65";
    const RSA_OAEP_MGF1P = "\x68\x74\x74\x70\x3a\x2f\x2f\167\x77\x77\56\167\x33\56\157\x72\x67\x2f\62\60\x30\61\x2f\60\x34\57\x78\x6d\154\145\x6e\143\43\x72\163\x61\55\x6f\x61\x65\x70\55\155\147\x66\61\x70";
    const DSA_SHA1 = "\150\x74\164\160\x3a\x2f\x2f\x77\167\167\x2e\x77\x33\56\157\162\x67\57\62\x30\60\x30\x2f\60\x39\57\x78\x6d\x6c\144\x73\x69\147\x23\x64\x73\x61\x2d\163\x68\141\61";
    const RSA_SHA1 = "\x68\164\164\x70\x3a\57\57\x77\167\167\x2e\x77\x33\56\x6f\162\147\x2f\x32\x30\x30\x30\57\x30\x39\57\170\155\154\144\x73\151\x67\43\x72\x73\x61\x2d\x73\x68\x61\61";
    const RSA_SHA256 = "\x68\164\x74\x70\72\57\57\x77\167\167\56\x77\63\56\x6f\162\x67\57\62\60\x30\x31\x2f\x30\x34\57\170\x6d\x6c\x64\x73\x69\147\55\x6d\x6f\x72\x65\x23\x72\163\x61\x2d\x73\150\x61\62\x35\x36";
    const RSA_SHA384 = "\150\164\x74\x70\72\x2f\57\x77\x77\167\x2e\167\63\x2e\x6f\162\147\57\x32\60\60\61\x2f\x30\64\x2f\170\x6d\154\144\x73\x69\147\55\155\157\162\145\x23\x72\163\141\x2d\x73\150\141\63\70\x34";
    const RSA_SHA512 = "\x68\x74\x74\160\72\57\x2f\167\x77\167\56\x77\63\56\x6f\x72\x67\x2f\x32\60\x30\x31\x2f\60\64\x2f\170\155\154\144\163\151\147\55\x6d\157\162\145\43\162\163\x61\x2d\163\x68\141\x35\x31\x32";
    const HMAC_SHA1 = "\x68\164\x74\160\x3a\x2f\57\167\x77\167\x2e\x77\63\56\157\162\x67\x2f\x32\x30\x30\60\57\60\71\x2f\170\x6d\154\144\x73\x69\x67\43\x68\155\x61\143\x2d\x73\150\x61\x31";
    private $cryptParams = array();
    public $type = 0;
    public $key = null;
    public $passphrase = '';
    public $iv = null;
    public $name = null;
    public $keyChain = null;
    public $isEncrypted = false;
    public $encryptedCtx = null;
    public $guid = null;
    private $x509Certificate = null;
    private $X509Thumbprint = null;
    public function __construct($n3, $c0 = null)
    {
        switch ($n3) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\154\151\x62\162\x61\x72\x79"] = "\x6f\x70\145\156\x73\163\154";
                $this->cryptParams["\143\151\160\x68\145\162"] = "\x64\x65\x73\55\x65\x64\x65\x33\x2d\x63\x62\x63";
                $this->cryptParams["\164\171\160\145"] = "\163\x79\155\x6d\145\164\x72\151\x63";
                $this->cryptParams["\x6d\145\x74\x68\157\144"] = "\x68\164\164\160\72\57\57\x77\x77\167\x2e\x77\x33\x2e\157\162\147\x2f\x32\60\60\x31\x2f\60\64\57\170\x6d\154\x65\156\143\x23\x74\162\151\160\154\145\144\145\163\55\x63\142\x63";
                $this->cryptParams["\x6b\x65\171\x73\x69\172\x65"] = 24;
                $this->cryptParams["\x62\x6c\157\143\x6b\163\x69\x7a\145"] = 8;
                goto Sx;
            case self::AES128_CBC:
                $this->cryptParams["\x6c\x69\142\x72\141\x72\171"] = "\157\160\x65\156\x73\163\x6c";
                $this->cryptParams["\x63\151\160\150\145\162"] = "\141\145\x73\x2d\x31\x32\x38\55\143\142\x63";
                $this->cryptParams["\164\x79\160\145"] = "\163\x79\155\155\145\x74\x72\x69\x63";
                $this->cryptParams["\155\x65\x74\150\157\144"] = "\x68\x74\x74\x70\72\57\x2f\167\167\x77\x2e\x77\x33\56\157\162\147\57\62\x30\60\61\x2f\60\64\57\x78\x6d\154\x65\x6e\143\x23\141\x65\x73\61\62\x38\x2d\x63\142\x63";
                $this->cryptParams["\153\x65\171\163\x69\172\145"] = 16;
                $this->cryptParams["\142\154\x6f\143\x6b\163\x69\172\145"] = 16;
                goto Sx;
            case self::AES192_CBC:
                $this->cryptParams["\x6c\151\x62\x72\141\x72\x79"] = "\x6f\160\x65\156\x73\x73\x6c";
                $this->cryptParams["\143\x69\x70\150\145\x72"] = "\x61\x65\163\55\61\71\x32\55\143\x62\x63";
                $this->cryptParams["\164\x79\160\145"] = "\163\171\x6d\155\x65\x74\162\151\143";
                $this->cryptParams["\155\145\164\x68\157\x64"] = "\150\x74\x74\160\x3a\57\57\167\167\167\x2e\x77\63\x2e\157\162\x67\x2f\62\60\60\61\x2f\x30\64\57\x78\155\154\145\156\x63\x23\141\x65\x73\x31\x39\62\x2d\143\142\143";
                $this->cryptParams["\x6b\145\x79\163\151\x7a\145"] = 24;
                $this->cryptParams["\x62\154\x6f\143\x6b\163\151\x7a\x65"] = 16;
                goto Sx;
            case self::AES256_CBC:
                $this->cryptParams["\x6c\x69\142\x72\141\x72\171"] = "\x6f\160\145\x6e\163\163\x6c";
                $this->cryptParams["\x63\151\x70\x68\x65\162"] = "\x61\x65\x73\x2d\62\x35\66\55\143\x62\143";
                $this->cryptParams["\164\x79\x70\x65"] = "\163\171\x6d\x6d\x65\164\162\x69\143";
                $this->cryptParams["\x6d\145\x74\x68\157\x64"] = "\150\x74\164\x70\x3a\57\x2f\167\167\167\56\167\x33\x2e\x6f\162\147\57\x32\60\x30\x31\57\60\x34\x2f\170\155\154\x65\156\x63\x23\x61\x65\x73\62\x35\66\55\x63\x62\143";
                $this->cryptParams["\153\145\171\x73\151\x7a\x65"] = 32;
                $this->cryptParams["\142\x6c\x6f\x63\x6b\x73\151\172\145"] = 16;
                goto Sx;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\151\x62\162\x61\162\x79"] = "\157\x70\145\156\163\163\x6c";
                $this->cryptParams["\x70\141\x64\144\151\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x6d\145\164\150\x6f\144"] = "\x68\x74\164\160\72\57\x2f\x77\167\x77\x2e\x77\63\x2e\x6f\x72\x67\57\x32\60\x30\61\x2f\60\64\57\x78\x6d\154\145\x6e\x63\43\x72\163\x61\x2d\x31\x5f\65";
                if (!(is_array($c0) && !empty($c0["\164\x79\x70\145"]))) {
                    goto Z7;
                }
                if (!($c0["\164\171\x70\145"] == "\160\165\x62\154\151\x63" || $c0["\x74\x79\x70\x65"] == "\160\162\151\x76\141\164\145")) {
                    goto PI;
                }
                $this->cryptParams["\164\171\160\145"] = $c0["\164\171\160\x65"];
                goto Sx;
                PI:
                Z7:
                throw new Exception("\x43\x65\162\x74\151\146\151\143\x61\164\145\40\x22\x74\171\160\x65\x22\40\x28\x70\x72\x69\x76\x61\164\145\57\x70\165\142\154\x69\143\51\40\x6d\165\163\x74\40\x62\145\x20\160\x61\x73\163\x65\144\x20\x76\151\141\x20\160\x61\162\x61\x6d\145\x74\x65\162\163");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\154\x69\142\162\x61\x72\x79"] = "\157\160\x65\x6e\163\163\x6c";
                $this->cryptParams["\x70\x61\144\x64\151\x6e\147"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\155\x65\x74\x68\x6f\144"] = "\x68\164\x74\x70\x3a\x2f\x2f\x77\167\x77\56\167\x33\56\157\x72\x67\x2f\62\60\60\61\57\x30\x34\57\170\x6d\x6c\x65\x6e\143\x23\x72\x73\x61\55\x6f\x61\x65\160\x2d\x6d\x67\146\61\160";
                $this->cryptParams["\x68\141\163\150"] = null;
                if (!(is_array($c0) && !empty($c0["\164\x79\160\x65"]))) {
                    goto au;
                }
                if (!($c0["\x74\x79\160\145"] == "\x70\x75\x62\x6c\151\143" || $c0["\164\x79\160\145"] == "\x70\x72\151\166\141\x74\145")) {
                    goto Qo;
                }
                $this->cryptParams["\164\x79\160\x65"] = $c0["\164\171\x70\x65"];
                goto Sx;
                Qo:
                au:
                throw new Exception("\x43\x65\x72\x74\x69\146\151\x63\x61\x74\145\40\42\164\x79\160\x65\x22\x20\50\x70\162\151\x76\x61\164\x65\x2f\x70\165\x62\154\x69\143\x29\40\x6d\165\x73\x74\40\142\145\x20\x70\141\163\x73\x65\144\40\x76\151\x61\x20\160\x61\x72\141\155\145\164\x65\162\x73");
            case self::RSA_SHA1:
                $this->cryptParams["\154\151\x62\162\x61\x72\x79"] = "\x6f\x70\x65\156\163\163\x6c";
                $this->cryptParams["\155\x65\164\x68\157\144"] = "\x68\x74\164\160\72\x2f\x2f\x77\x77\x77\x2e\167\x33\x2e\x6f\x72\147\x2f\x32\x30\x30\60\x2f\x30\71\x2f\170\155\154\x64\x73\x69\147\x23\x72\163\141\55\163\x68\141\61";
                $this->cryptParams["\160\141\x64\144\151\x6e\147"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($c0) && !empty($c0["\164\x79\x70\x65"]))) {
                    goto kD;
                }
                if (!($c0["\x74\171\x70\145"] == "\x70\x75\142\154\151\143" || $c0["\x74\171\x70\x65"] == "\x70\162\x69\166\141\164\x65")) {
                    goto CR;
                }
                $this->cryptParams["\164\171\x70\x65"] = $c0["\164\x79\x70\145"];
                goto Sx;
                CR:
                kD:
                throw new Exception("\x43\145\162\164\x69\x66\151\x63\141\164\x65\x20\42\164\171\160\145\42\x20\x28\x70\x72\x69\x76\x61\164\145\x2f\160\165\142\154\x69\143\51\x20\x6d\165\163\x74\40\x62\x65\40\160\x61\x73\x73\145\x64\40\x76\151\x61\40\x70\x61\162\141\x6d\145\164\145\162\x73");
            case self::RSA_SHA256:
                $this->cryptParams["\154\151\142\x72\141\162\171"] = "\157\x70\145\x6e\163\x73\154";
                $this->cryptParams["\155\145\x74\150\x6f\x64"] = "\x68\164\x74\160\x3a\x2f\57\x77\167\x77\56\167\x33\56\157\x72\x67\x2f\62\60\x30\x31\57\x30\64\57\x78\x6d\x6c\144\163\151\147\x2d\155\x6f\162\145\x23\162\163\141\55\x73\150\141\62\65\66";
                $this->cryptParams["\160\141\144\x64\x69\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\x69\x67\145\x73\164"] = "\123\x48\101\x32\x35\66";
                if (!(is_array($c0) && !empty($c0["\x74\x79\x70\145"]))) {
                    goto t0;
                }
                if (!($c0["\x74\171\160\145"] == "\160\x75\142\154\151\x63" || $c0["\x74\171\160\145"] == "\x70\162\x69\x76\x61\164\x65")) {
                    goto rL;
                }
                $this->cryptParams["\164\171\160\x65"] = $c0["\x74\171\160\145"];
                goto Sx;
                rL:
                t0:
                throw new Exception("\x43\145\x72\164\151\146\151\143\x61\x74\145\40\42\164\x79\x70\145\x22\40\x28\160\162\x69\x76\141\164\145\57\x70\x75\142\x6c\151\143\x29\40\155\x75\x73\x74\40\142\145\x20\x70\141\163\x73\145\x64\x20\x76\x69\141\x20\x70\141\x72\x61\x6d\145\x74\x65\162\163");
            case self::RSA_SHA384:
                $this->cryptParams["\x6c\151\142\x72\x61\x72\x79"] = "\157\160\145\156\x73\163\154";
                $this->cryptParams["\x6d\145\x74\x68\157\x64"] = "\x68\164\164\x70\x3a\x2f\57\167\167\167\56\x77\x33\56\157\162\147\57\62\x30\x30\61\x2f\60\x34\57\170\x6d\154\144\163\x69\147\x2d\155\157\162\145\x23\x72\x73\141\x2d\163\x68\141\x33\x38\x34";
                $this->cryptParams["\160\x61\x64\x64\151\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\x67\x65\x73\164"] = "\x53\x48\x41\63\x38\64";
                if (!(is_array($c0) && !empty($c0["\x74\x79\x70\x65"]))) {
                    goto aH;
                }
                if (!($c0["\164\x79\160\145"] == "\160\x75\x62\x6c\151\143" || $c0["\x74\171\160\145"] == "\160\162\151\166\141\164\x65")) {
                    goto J4;
                }
                $this->cryptParams["\x74\x79\160\x65"] = $c0["\x74\171\x70\x65"];
                goto Sx;
                J4:
                aH:
                throw new Exception("\x43\145\162\x74\151\x66\x69\143\141\x74\x65\x20\42\x74\x79\x70\x65\x22\40\x28\160\x72\151\166\x61\164\145\x2f\x70\165\x62\154\151\143\51\40\x6d\x75\x73\x74\x20\x62\x65\40\x70\x61\x73\163\x65\x64\40\x76\x69\141\x20\160\x61\162\x61\x6d\145\164\x65\x72\x73");
            case self::RSA_SHA512:
                $this->cryptParams["\154\x69\142\162\x61\x72\171"] = "\x6f\160\x65\x6e\163\x73\154";
                $this->cryptParams["\155\x65\164\150\x6f\144"] = "\150\164\x74\160\x3a\57\57\167\167\x77\x2e\167\63\x2e\x6f\x72\147\57\x32\x30\x30\x31\57\60\x34\57\x78\x6d\x6c\x64\163\x69\147\55\155\x6f\x72\x65\43\x72\x73\x61\x2d\163\x68\x61\x35\x31\62";
                $this->cryptParams["\160\141\144\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\147\145\x73\164"] = "\x53\x48\101\65\61\x32";
                if (!(is_array($c0) && !empty($c0["\164\x79\x70\x65"]))) {
                    goto Nl;
                }
                if (!($c0["\164\171\160\145"] == "\x70\x75\x62\x6c\151\x63" || $c0["\x74\171\160\x65"] == "\160\162\x69\x76\141\164\x65")) {
                    goto JM;
                }
                $this->cryptParams["\x74\171\160\145"] = $c0["\164\x79\160\145"];
                goto Sx;
                JM:
                Nl:
                throw new Exception("\x43\145\162\164\151\x66\151\143\x61\164\145\x20\x22\x74\x79\x70\x65\42\x20\50\160\162\151\x76\141\x74\x65\x2f\x70\165\142\154\x69\x63\51\x20\x6d\x75\163\x74\40\142\145\x20\x70\x61\x73\x73\x65\144\40\x76\151\x61\x20\x70\141\162\141\155\x65\164\x65\x72\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\x6c\x69\x62\x72\141\x72\171"] = $n3;
                $this->cryptParams["\x6d\x65\x74\x68\x6f\144"] = "\150\x74\164\x70\72\57\x2f\167\x77\167\56\x77\63\56\157\x72\147\x2f\x32\x30\60\60\57\60\x39\x2f\x78\x6d\154\x64\163\x69\147\43\x68\x6d\141\143\55\x73\x68\x61\x31";
                goto Sx;
            default:
                throw new Exception("\x49\x6e\166\x61\154\151\x64\40\x4b\145\x79\40\x54\171\160\145");
        }
        D0:
        Sx:
        $this->type = $n3;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\x6b\x65\171\x73\151\x7a\145"])) {
            goto c2;
        }
        return null;
        c2:
        return $this->cryptParams["\153\145\x79\x73\x69\x7a\x65"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\x6b\x65\171\x73\x69\x7a\145"])) {
            goto vO;
        }
        throw new Exception("\x55\x6e\153\156\157\167\x6e\40\x6b\145\171\40\x73\x69\x7a\x65\x20\x66\157\162\x20\164\171\x70\145\40\x22" . $this->type . "\42\x2e");
        vO:
        $Cc = $this->cryptParams["\153\145\x79\x73\151\172\x65"];
        $Rh = openssl_random_pseudo_bytes($Cc);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto jy;
        }
        $IO = 0;
        RY:
        if (!($IO < strlen($Rh))) {
            goto cZ;
        }
        $SR = ord($Rh[$IO]) & 254;
        $bj = 1;
        $Kr = 1;
        eI:
        if (!($Kr < 8)) {
            goto Jf;
        }
        $bj ^= $SR >> $Kr & 1;
        dU:
        $Kr++;
        goto eI;
        Jf:
        $SR |= $bj;
        $Rh[$IO] = chr($SR);
        cE:
        $IO++;
        goto RY;
        cZ:
        jy:
        $this->key = $Rh;
        return $Rh;
    }
    public static function getRawThumbprint($OQ)
    {
        $D3 = explode("\12", $OQ);
        $iu = '';
        $d8 = false;
        foreach ($D3 as $Ti) {
            if (!$d8) {
                goto zL;
            }
            if (!(strncmp($Ti, "\x2d\x2d\55\55\x2d\105\116\x44\x20\x43\105\122\x54\111\x46\x49\103\x41\124\105", 20) == 0)) {
                goto Of;
            }
            goto Mf;
            Of:
            $iu .= trim($Ti);
            goto Nc;
            zL:
            if (!(strncmp($Ti, "\55\55\55\55\55\x42\105\x47\x49\x4e\40\x43\105\x52\124\x49\106\111\x43\101\x54\x45", 22) == 0)) {
                goto nD;
            }
            $d8 = true;
            nD:
            Nc:
            HS:
        }
        Mf:
        if (empty($iu)) {
            goto bF;
        }
        return strtolower(sha1(base64_decode($iu)));
        bF:
        return null;
    }
    public function loadKey($Rh, $CI = false, $Wk = false)
    {
        if ($CI) {
            goto nG;
        }
        $this->key = $Rh;
        goto jT;
        nG:
        $this->key = file_get_contents($Rh);
        jT:
        if ($Wk) {
            goto VZ;
        }
        $this->x509Certificate = null;
        goto g3;
        VZ:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $Wt);
        $this->x509Certificate = $Wt;
        $this->key = $Wt;
        g3:
        if (!($this->cryptParams["\x6c\151\142\162\141\162\171"] == "\157\x70\x65\x6e\x73\x73\154")) {
            goto Gz;
        }
        switch ($this->cryptParams["\164\171\160\x65"]) {
            case "\160\165\142\154\x69\x63":
                if (!$Wk) {
                    goto CC;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                CC:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto gq;
                }
                throw new Exception("\125\156\141\142\x6c\145\40\164\x6f\40\145\x78\164\x72\x61\x63\x74\x20\x70\x75\142\154\x69\143\x20\x6b\x65\171");
                gq:
                goto SB;
            case "\x70\162\151\166\x61\x74\x65":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto SB;
            case "\163\171\155\x6d\x65\x74\162\151\x63":
                if (!(strlen($this->key) < $this->cryptParams["\x6b\x65\171\x73\x69\x7a\145"])) {
                    goto Yj;
                }
                throw new Exception("\x4b\x65\x79\40\155\x75\x73\x74\40\143\157\156\x74\x61\151\156\40\x61\x74\x20\154\145\141\163\164\x20\62\65\40\x63\150\141\x72\x61\x63\164\145\x72\163\40\x66\x6f\x72\x20\164\x68\151\x73\40\x63\151\x70\150\x65\162");
                Yj:
                goto SB;
            default:
                throw new Exception("\125\x6e\153\x6e\157\167\x6e\x20\x74\171\160\x65");
        }
        IG:
        SB:
        Gz:
    }
    private function padISO10126($iu, $vx)
    {
        if (!($vx > 256)) {
            goto ri;
        }
        throw new Exception("\102\154\157\x63\x6b\x20\163\x69\x7a\x65\x20\150\151\147\x68\x65\162\40\164\150\x61\x6e\40\x32\65\66\x20\156\157\x74\x20\x61\154\x6c\x6f\x77\x65\144");
        ri:
        $Ty = $vx - strlen($iu) % $vx;
        $j3 = chr($Ty);
        return $iu . str_repeat($j3, $Ty);
    }
    private function unpadISO10126($iu)
    {
        $Ty = substr($iu, -1);
        $mt = ord($Ty);
        return substr($iu, 0, -$mt);
    }
    private function encryptSymmetric($iu)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\x63\151\160\x68\145\162"]));
        $iu = $this->padISO10126($iu, $this->cryptParams["\x62\x6c\157\143\153\x73\151\x7a\145"]);
        $Pf = openssl_encrypt($iu, $this->cryptParams["\143\x69\x70\x68\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $Pf)) {
            goto hP;
        }
        throw new Exception("\106\x61\x69\x6c\x75\162\145\x20\x65\x6e\143\x72\171\160\x74\151\x6e\147\x20\x44\141\164\141\x20\x28\x6f\x70\145\x6e\163\163\154\x20\x73\x79\155\155\145\164\162\x69\x63\x29\40\55\40" . openssl_error_string());
        hP:
        return $this->iv . $Pf;
    }
    private function decryptSymmetric($iu)
    {
        $j5 = openssl_cipher_iv_length($this->cryptParams["\x63\151\160\150\x65\162"]);
        $this->iv = substr($iu, 0, $j5);
        $iu = substr($iu, $j5);
        $mK = openssl_decrypt($iu, $this->cryptParams["\x63\151\160\x68\x65\x72"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $mK)) {
            goto s1;
        }
        throw new Exception("\106\x61\151\x6c\165\162\145\x20\144\145\143\x72\x79\160\x74\151\x6e\147\x20\x44\x61\164\141\40\50\157\x70\x65\156\x73\x73\154\x20\163\171\x6d\155\x65\x74\162\151\x63\51\40\x2d\40" . openssl_error_string());
        s1:
        return $this->unpadISO10126($mK);
    }
    private function encryptPublic($iu)
    {
        if (openssl_public_encrypt($iu, $Pf, $this->key, $this->cryptParams["\x70\141\x64\144\151\x6e\147"])) {
            goto ds;
        }
        throw new Exception("\x46\x61\x69\154\165\x72\145\x20\145\156\143\162\171\x70\x74\x69\156\147\x20\104\141\x74\141\40\50\x6f\160\x65\156\x73\x73\154\40\160\165\x62\154\151\x63\51\x20\55\40" . openssl_error_string());
        ds:
        return $Pf;
    }
    private function decryptPublic($iu)
    {
        if (openssl_public_decrypt($iu, $mK, $this->key, $this->cryptParams["\160\141\144\x64\x69\x6e\x67"])) {
            goto sS;
        }
        throw new Exception("\106\x61\151\x6c\165\x72\145\x20\144\x65\x63\162\171\160\x74\151\156\x67\40\x44\141\x74\141\x20\50\x6f\x70\x65\x6e\x73\163\x6c\40\160\165\142\x6c\151\x63\x29\x20\55\40" . openssl_error_string);
        sS:
        return $mK;
    }
    private function encryptPrivate($iu)
    {
        if (openssl_private_encrypt($iu, $Pf, $this->key, $this->cryptParams["\x70\x61\144\144\151\x6e\x67"])) {
            goto Rq;
        }
        throw new Exception("\x46\141\x69\x6c\165\x72\x65\x20\x65\156\143\x72\171\160\164\151\156\147\x20\104\x61\x74\141\x20\x28\x6f\160\145\156\163\x73\x6c\40\160\x72\151\166\x61\164\145\x29\x20\x2d\x20" . openssl_error_string());
        Rq:
        return $Pf;
    }
    private function decryptPrivate($iu)
    {
        if (openssl_private_decrypt($iu, $mK, $this->key, $this->cryptParams["\x70\141\x64\144\151\x6e\x67"])) {
            goto CX;
        }
        throw new Exception("\x46\141\x69\154\x75\x72\145\x20\144\145\143\x72\x79\160\x74\x69\156\x67\x20\x44\141\164\x61\x20\x28\x6f\x70\x65\x6e\x73\163\154\x20\160\x72\x69\x76\x61\164\x65\x29\x20\x2d\x20" . openssl_error_string);
        CX:
        return $mK;
    }
    private function signOpenSSL($iu)
    {
        $F8 = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\147\145\163\x74"])) {
            goto Kx;
        }
        $F8 = $this->cryptParams["\x64\x69\x67\x65\163\164"];
        Kx:
        if (openssl_sign($iu, $yN, $this->key, $F8)) {
            goto pW;
        }
        throw new Exception("\106\141\x69\154\x75\x72\x65\40\x53\x69\147\x6e\151\x6e\147\40\104\141\x74\x61\72\40" . openssl_error_string() . "\40\x2d\40" . $F8);
        pW:
        return $yN;
    }
    private function verifyOpenSSL($iu, $yN)
    {
        $F8 = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\x69\x67\x65\163\x74"])) {
            goto fm;
        }
        $F8 = $this->cryptParams["\144\x69\x67\145\163\x74"];
        fm:
        return openssl_verify($iu, $yN, $this->key, $F8);
    }
    public function encryptData($iu)
    {
        if (!($this->cryptParams["\x6c\151\x62\x72\141\162\x79"] === "\157\160\145\156\x73\x73\x6c")) {
            goto Bz;
        }
        switch ($this->cryptParams["\164\171\160\145"]) {
            case "\163\171\x6d\x6d\x65\x74\162\151\143":
                return $this->encryptSymmetric($iu);
            case "\160\165\142\x6c\x69\143":
                return $this->encryptPublic($iu);
            case "\x70\162\x69\x76\x61\164\145":
                return $this->encryptPrivate($iu);
        }
        DX:
        KD:
        Bz:
    }
    public function decryptData($iu)
    {
        if (!($this->cryptParams["\x6c\x69\142\162\x61\x72\x79"] === "\157\x70\x65\156\163\163\154")) {
            goto SJ;
        }
        switch ($this->cryptParams["\164\x79\x70\145"]) {
            case "\x73\171\x6d\155\145\164\x72\151\x63":
                return $this->decryptSymmetric($iu);
            case "\160\165\x62\154\x69\143":
                return $this->decryptPublic($iu);
            case "\160\162\x69\x76\x61\164\145":
                return $this->decryptPrivate($iu);
        }
        K_:
        Ky:
        SJ:
    }
    public function signData($iu)
    {
        switch ($this->cryptParams["\x6c\151\x62\x72\x61\x72\x79"]) {
            case "\157\160\x65\x6e\163\x73\x6c":
                return $this->signOpenSSL($iu);
            case self::HMAC_SHA1:
                return hash_hmac("\163\150\141\x31", $iu, $this->key, true);
        }
        Rd:
        we:
    }
    public function verifySignature($iu, $yN)
    {
        switch ($this->cryptParams["\x6c\151\x62\x72\141\x72\x79"]) {
            case "\x6f\160\145\x6e\x73\163\x6c":
                return $this->verifyOpenSSL($iu, $yN);
            case self::HMAC_SHA1:
                $dZ = hash_hmac("\163\x68\x61\61", $iu, $this->key, true);
                return strcmp($yN, $dZ) == 0;
        }
        Ci:
        jU:
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\x6d\x65\164\x68\x6f\x64"];
    }
    public static function makeAsnSegment($n3, $m3)
    {
        switch ($n3) {
            case 2:
                if (!(ord($m3) > 127)) {
                    goto r8;
                }
                $m3 = chr(0) . $m3;
                r8:
                goto xk;
            case 3:
                $m3 = chr(0) . $m3;
                goto xk;
        }
        tI:
        xk:
        $cq = strlen($m3);
        if ($cq < 128) {
            goto EI;
        }
        if ($cq < 256) {
            goto Q2;
        }
        if ($cq < 65536) {
            goto ub;
        }
        $DI = null;
        goto Bc;
        ub:
        $DI = sprintf("\x25\x63\45\x63\45\x63\x25\x63\x25\163", $n3, 130, $cq / 256, $cq % 256, $m3);
        Bc:
        goto ZC;
        Q2:
        $DI = sprintf("\45\x63\x25\x63\45\x63\x25\x73", $n3, 129, $cq, $m3);
        ZC:
        goto Zc;
        EI:
        $DI = sprintf("\x25\143\x25\143\45\163", $n3, $cq, $m3);
        Zc:
        return $DI;
    }
    public static function convertRSA($Gh, $g1)
    {
        $Go = self::makeAsnSegment(2, $g1);
        $OO = self::makeAsnSegment(2, $Gh);
        $em = self::makeAsnSegment(48, $OO . $Go);
        $EE = self::makeAsnSegment(3, $em);
        $fM = pack("\x48\x2a", "\63\60\x30\104\x30\x36\60\x39\62\x41\x38\x36\64\x38\x38\66\x46\x37\x30\x44\60\x31\x30\61\60\61\x30\x35\60\x30");
        $lA = self::makeAsnSegment(48, $fM . $EE);
        $w4 = base64_encode($lA);
        $om = "\55\55\x2d\x2d\55\x42\105\x47\x49\116\40\120\125\102\114\x49\103\x20\113\105\x59\x2d\x2d\x2d\x2d\x2d\12";
        $vZ = 0;
        fJ:
        if (!($gM = substr($w4, $vZ, 64))) {
            goto Aa;
        }
        $om = $om . $gM . "\xa";
        $vZ += 64;
        goto fJ;
        Aa:
        return $om . "\x2d\x2d\x2d\55\55\105\116\x44\x20\x50\125\x42\114\111\103\40\113\x45\x59\x2d\x2d\55\x2d\x2d\12";
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $GH)
    {
        $rr = new XMLSecEnc();
        $rr->setNode($GH);
        if ($dl = $rr->locateKey()) {
            goto ow;
        }
        throw new Exception("\125\x6e\x61\x62\154\x65\x20\x74\x6f\40\154\157\x63\141\164\x65\x20\x61\x6c\147\x6f\162\151\164\x68\x6d\x20\x66\x6f\162\x20\164\150\x69\x73\40\105\x6e\143\x72\171\x70\164\x65\x64\x20\113\145\171");
        ow:
        $dl->isEncrypted = true;
        $dl->encryptedCtx = $rr;
        XMLSecEnc::staticLocateKeyInfo($dl, $GH);
        return $dl;
    }
}
class XMLSecurityDSig
{
    const XMLDSIGNS = "\150\164\x74\160\72\x2f\57\x77\167\167\x2e\167\63\x2e\x6f\162\x67\x2f\x32\x30\60\60\57\60\71\x2f\x78\155\x6c\x64\x73\x69\147\x23";
    const SHA1 = "\150\164\164\160\72\x2f\x2f\x77\167\x77\x2e\167\63\56\x6f\x72\147\57\62\x30\60\60\57\60\x39\x2f\170\x6d\x6c\x64\x73\151\147\43\163\150\x61\61";
    const SHA256 = "\x68\164\164\160\x3a\x2f\57\x77\x77\x77\x2e\167\x33\x2e\157\162\x67\x2f\x32\x30\x30\x31\57\x30\64\57\170\x6d\154\x65\x6e\x63\43\163\150\x61\62\x35\66";
    const SHA384 = "\150\164\164\160\72\x2f\x2f\x77\x77\167\x2e\167\63\56\157\x72\147\x2f\x32\60\x30\61\57\60\64\x2f\x78\x6d\154\x64\x73\x69\x67\x2d\155\157\162\x65\43\x73\x68\141\x33\70\x34";
    const SHA512 = "\x68\x74\x74\160\x3a\x2f\57\x77\x77\167\56\167\63\x2e\157\162\x67\x2f\x32\x30\60\61\x2f\x30\x34\57\x78\155\x6c\x65\x6e\x63\43\163\x68\x61\x35\61\x32";
    const RIPEMD160 = "\150\164\164\160\x3a\57\57\x77\x77\167\56\x77\63\x2e\157\162\x67\57\x32\x30\60\x31\x2f\60\64\x2f\170\x6d\154\x65\x6e\x63\43\162\151\x70\145\x6d\x64\x31\x36\60";
    const C14N = "\150\x74\x74\160\x3a\57\57\x77\x77\167\56\x77\63\56\157\162\147\x2f\124\122\57\x32\60\x30\61\x2f\x52\x45\103\55\x78\x6d\x6c\55\143\61\64\156\x2d\62\x30\60\61\60\x33\61\x35";
    const C14N_COMMENTS = "\x68\x74\164\x70\x3a\x2f\x2f\x77\167\167\x2e\167\63\x2e\x6f\x72\147\x2f\124\122\x2f\x32\x30\x30\x31\x2f\122\105\103\55\x78\x6d\x6c\x2d\143\x31\x34\x6e\55\x32\x30\x30\x31\60\x33\61\x35\x23\127\x69\164\150\103\x6f\155\155\145\156\x74\163";
    const EXC_C14N = "\x68\x74\x74\160\72\57\57\167\x77\x77\56\x77\63\56\157\162\x67\57\x32\60\x30\61\57\61\x30\57\170\155\x6c\55\145\170\143\55\143\x31\64\x6e\43";
    const EXC_C14N_COMMENTS = "\150\x74\164\160\x3a\57\57\x77\167\x77\56\x77\x33\x2e\157\x72\147\57\62\60\60\61\57\61\x30\57\170\x6d\x6c\55\145\170\x63\x2d\143\61\64\156\43\x57\151\164\150\103\x6f\x6d\x6d\x65\x6e\x74\163";
    const template = "\74\144\x73\x3a\123\151\147\156\141\164\x75\162\145\40\x78\x6d\x6c\156\163\72\144\163\x3d\42\x68\x74\164\160\x3a\57\x2f\167\167\167\56\167\x33\56\x6f\162\147\57\62\x30\x30\60\57\60\x39\x2f\x78\x6d\154\144\163\x69\147\43\42\76\xd\xa\40\x20\x3c\144\x73\72\x53\x69\x67\156\145\144\111\x6e\146\157\x3e\15\12\x20\40\40\x20\74\x64\163\72\123\x69\147\x6e\141\x74\165\x72\x65\115\145\164\x68\x6f\144\40\57\x3e\xd\12\40\x20\74\x2f\x64\163\x3a\123\x69\x67\x6e\145\144\111\156\146\x6f\76\15\12\x3c\57\144\163\x3a\123\x69\147\x6e\x61\x74\165\162\x65\x3e";
    const BASE_TEMPLATE = "\74\123\x69\147\156\x61\164\165\162\x65\40\170\x6d\x6c\156\x73\75\x22\x68\164\164\x70\x3a\x2f\57\x77\167\167\x2e\167\63\56\x6f\x72\x67\x2f\62\60\x30\x30\57\x30\x39\x2f\x78\x6d\154\144\x73\151\x67\x23\x22\76\xd\xa\40\x20\x3c\x53\151\147\156\x65\144\111\x6e\146\157\x3e\xd\12\40\40\40\40\x3c\x53\x69\147\x6e\141\x74\165\x72\145\115\x65\x74\x68\x6f\144\40\x2f\76\15\xa\40\x20\74\57\123\151\x67\x6e\x65\144\x49\x6e\146\157\x3e\xd\xa\74\57\123\x69\147\x6e\x61\x74\x75\x72\x65\x3e";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\163\145\x63\144\x73\x69\147";
    private $validatedNodes = null;
    public function __construct($E2 = "\144\x73")
    {
        $n7 = self::BASE_TEMPLATE;
        if (empty($E2)) {
            goto WV;
        }
        $this->prefix = $E2 . "\x3a";
        $nz = array("\74\123", "\74\x2f\x53", "\170\x6d\154\x6e\163\75");
        $bQ = array("\x3c{$E2}\72\123", "\x3c\57{$E2}\72\123", "\x78\155\x6c\156\x73\x3a{$E2}\x3d");
        $n7 = str_replace($nz, $bQ, $n7);
        WV:
        $ao = new DOMDocument();
        $ao->loadXML($n7);
        $this->sigNode = $ao->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto I1;
        }
        $Xj = new DOMXPath($this->sigNode->ownerDocument);
        $Xj->registerNamespace("\x73\145\x63\144\163\x69\147", self::XMLDSIGNS);
        $this->xPathCtx = $Xj;
        I1:
        return $this->xPathCtx;
    }
    public static function generateGUID($E2 = "\160\146\x78")
    {
        $bD = md5(uniqid(mt_rand(), true));
        $kh = $E2 . substr($bD, 0, 8) . "\x2d" . substr($bD, 8, 4) . "\55" . substr($bD, 12, 4) . "\x2d" . substr($bD, 16, 4) . "\x2d" . substr($bD, 20, 12);
        return $kh;
    }
    public static function generate_GUID($E2 = "\x70\146\170")
    {
        return self::generateGUID($E2);
    }
    public function locateSignature($aV, $wD = 0)
    {
        if ($aV instanceof DOMDocument) {
            goto FK;
        }
        $Ij = $aV->ownerDocument;
        goto Gp;
        FK:
        $Ij = $aV;
        Gp:
        if (!$Ij) {
            goto LJ;
        }
        $Xj = new DOMXPath($Ij);
        $Xj->registerNamespace("\x73\145\143\144\x73\x69\147", self::XMLDSIGNS);
        $U3 = "\x2e\x2f\x2f\163\x65\143\144\163\151\x67\72\123\151\x67\156\x61\x74\165\x72\145";
        $f9 = $Xj->query($U3, $aV);
        $this->sigNode = $f9->item($wD);
        return $this->sigNode;
        LJ:
        return null;
    }
    public function createNewSignNode($oR, $s5 = null)
    {
        $Ij = $this->sigNode->ownerDocument;
        if (!is_null($s5)) {
            goto sC;
        }
        $fz = $Ij->createElementNS(self::XMLDSIGNS, $this->prefix . $oR);
        goto a3;
        sC:
        $fz = $Ij->createElementNS(self::XMLDSIGNS, $this->prefix . $oR, $s5);
        a3:
        return $fz;
    }
    public function setCanonicalMethod($o6)
    {
        switch ($o6) {
            case "\x68\164\x74\160\x3a\x2f\x2f\x77\167\x77\x2e\x77\63\x2e\157\162\x67\x2f\124\x52\57\x32\x30\x30\61\57\x52\105\x43\55\x78\155\x6c\x2d\143\x31\x34\x6e\55\x32\x30\x30\x31\x30\63\x31\65":
            case "\150\x74\x74\160\x3a\57\57\167\167\x77\56\167\x33\56\x6f\162\x67\57\124\122\57\x32\x30\x30\61\x2f\x52\105\x43\55\x78\155\x6c\55\x63\x31\x34\x6e\x2d\62\x30\60\x31\x30\63\x31\x35\x23\x57\x69\164\150\x43\157\155\155\145\156\164\163":
            case "\150\x74\x74\160\x3a\57\x2f\167\x77\x77\x2e\167\63\x2e\x6f\x72\147\57\62\60\x30\x31\x2f\x31\x30\x2f\170\x6d\x6c\55\145\x78\143\55\x63\61\x34\x6e\x23":
            case "\x68\164\164\x70\72\57\57\167\167\167\x2e\167\63\x2e\157\162\147\x2f\62\x30\60\61\x2f\x31\60\57\170\x6d\x6c\x2d\x65\170\x63\x2d\x63\x31\x34\156\43\x57\151\x74\x68\103\157\x6d\155\145\x6e\164\x73":
                $this->canonicalMethod = $o6;
                goto Tk;
            default:
                throw new Exception("\111\x6e\x76\x61\x6c\x69\144\40\103\x61\156\157\156\x69\x63\x61\x6c\x20\115\145\164\x68\157\x64");
        }
        bX:
        Tk:
        if (!($Xj = $this->getXPathObj())) {
            goto kC;
        }
        $U3 = "\56\57" . $this->searchpfx . "\72\123\151\147\156\x65\x64\111\x6e\x66\x6f";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($m4 = $f9->item(0))) {
            goto ju;
        }
        $U3 = "\x2e\57" . $this->searchpfx . "\x43\x61\x6e\x6f\156\151\143\x61\x6c\x69\172\141\164\x69\x6f\156\x4d\x65\164\x68\x6f\x64";
        $f9 = $Xj->query($U3, $m4);
        if ($bH = $f9->item(0)) {
            goto e9;
        }
        $bH = $this->createNewSignNode("\x43\x61\156\x6f\x6e\x69\x63\x61\154\151\172\141\x74\151\157\156\115\145\164\150\157\x64");
        $m4->insertBefore($bH, $m4->firstChild);
        e9:
        $bH->setAttribute("\101\154\147\x6f\x72\x69\x74\x68\x6d", $this->canonicalMethod);
        ju:
        kC:
    }
    private function canonicalizeData($fz, $j_, $K0 = null, $sI = null)
    {
        $gP = false;
        $qD = false;
        switch ($j_) {
            case "\x68\164\164\x70\72\57\57\167\167\167\56\167\x33\x2e\157\x72\147\57\x54\x52\57\62\60\x30\x31\x2f\x52\x45\x43\x2d\x78\155\154\x2d\143\x31\x34\x6e\x2d\x32\x30\x30\61\60\x33\x31\x35":
                $gP = false;
                $qD = false;
                goto LN;
            case "\x68\164\x74\x70\x3a\57\x2f\x77\167\x77\x2e\167\63\56\x6f\x72\x67\x2f\124\x52\57\x32\60\x30\61\x2f\x52\105\x43\55\x78\155\x6c\55\143\x31\x34\156\x2d\x32\60\60\x31\x30\63\61\x35\43\x57\x69\164\x68\x43\x6f\x6d\x6d\x65\x6e\x74\163":
                $qD = true;
                goto LN;
            case "\x68\164\164\x70\72\x2f\x2f\167\x77\x77\56\x77\x33\x2e\x6f\x72\x67\x2f\62\60\60\x31\57\x31\60\57\x78\x6d\x6c\x2d\145\170\x63\55\143\61\64\x6e\43":
                $gP = true;
                goto LN;
            case "\150\164\x74\160\x3a\57\57\167\x77\167\56\167\63\x2e\x6f\162\x67\x2f\x32\60\60\x31\x2f\61\x30\x2f\170\x6d\154\x2d\x65\x78\143\x2d\143\x31\64\x6e\43\x57\151\x74\150\x43\x6f\x6d\155\x65\156\164\163":
                $gP = true;
                $qD = true;
                goto LN;
        }
        ND:
        LN:
        if (!(is_null($K0) && $fz instanceof DOMNode && $fz->ownerDocument !== null && $fz->isSameNode($fz->ownerDocument->documentElement))) {
            goto wu;
        }
        $GH = $fz;
        Dr:
        if (!($VU = $GH->previousSibling)) {
            goto jt;
        }
        if (!($VU->nodeType == XML_PI_NODE || $VU->nodeType == XML_COMMENT_NODE && $qD)) {
            goto q4;
        }
        goto jt;
        q4:
        $GH = $VU;
        goto Dr;
        jt:
        if (!($VU == null)) {
            goto PP;
        }
        $fz = $fz->ownerDocument;
        PP:
        wu:
        return $fz->C14N($gP, $qD, $K0, $sI);
    }
    public function canonicalizeSignedInfo()
    {
        $Ij = $this->sigNode->ownerDocument;
        $j_ = null;
        if (!$Ij) {
            goto Fw;
        }
        $Xj = $this->getXPathObj();
        $U3 = "\x2e\x2f\x73\x65\x63\144\163\151\x67\x3a\x53\151\147\156\x65\144\111\x6e\x66\157";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($q7 = $f9->item(0))) {
            goto bN;
        }
        $U3 = "\56\x2f\x73\x65\143\144\x73\x69\147\x3a\x43\141\x6e\x6f\x6e\x69\143\141\x6c\151\172\x61\x74\x69\157\156\115\145\164\150\157\x64";
        $f9 = $Xj->query($U3, $q7);
        if (!($bH = $f9->item(0))) {
            goto gR;
        }
        $j_ = $bH->getAttribute("\101\x6c\147\157\x72\151\164\x68\155");
        gR:
        $this->signedInfo = $this->canonicalizeData($q7, $j_);
        return $this->signedInfo;
        bN:
        Fw:
        return null;
    }
    public function calculateDigest($Gr, $iu, $qj = true)
    {
        switch ($Gr) {
            case self::SHA1:
                $q6 = "\x73\150\141\61";
                goto OH;
            case self::SHA256:
                $q6 = "\163\150\141\62\65\66";
                goto OH;
            case self::SHA384:
                $q6 = "\x73\x68\141\x33\x38\64";
                goto OH;
            case self::SHA512:
                $q6 = "\x73\x68\x61\65\x31\62";
                goto OH;
            case self::RIPEMD160:
                $q6 = "\162\x69\x70\145\x6d\144\x31\66\60";
                goto OH;
            default:
                throw new Exception("\103\141\x6e\156\x6f\164\x20\x76\141\154\x69\144\141\x74\x65\x20\144\151\147\145\x73\164\x3a\x20\125\x6e\163\165\160\x70\x6f\162\x74\145\144\x20\x41\154\x67\157\162\151\x74\150\x6d\x20\74{$Gr}\76");
        }
        Xl:
        OH:
        $bs = hash($q6, $iu, true);
        if (!$qj) {
            goto SS;
        }
        $bs = base64_encode($bs);
        SS:
        return $bs;
    }
    public function validateDigest($u7, $iu)
    {
        $Xj = new DOMXPath($u7->ownerDocument);
        $Xj->registerNamespace("\x73\145\143\144\x73\x69\x67", self::XMLDSIGNS);
        $U3 = "\163\x74\162\151\x6e\147\50\x2e\x2f\163\145\143\144\x73\x69\x67\x3a\104\x69\x67\145\163\x74\115\x65\164\150\157\144\x2f\100\x41\x6c\x67\x6f\162\151\164\150\155\x29";
        $Gr = $Xj->evaluate($U3, $u7);
        $xc = $this->calculateDigest($Gr, $iu, false);
        $U3 = "\163\x74\162\151\x6e\147\x28\x2e\x2f\163\145\x63\x64\163\x69\x67\x3a\104\151\x67\x65\163\164\x56\x61\x6c\165\x65\x29";
        $g2 = $Xj->evaluate($U3, $u7);
        return $xc == base64_decode($g2);
    }
    public function processTransforms($u7, $c1, $IG = true)
    {
        $iu = $c1;
        $Xj = new DOMXPath($u7->ownerDocument);
        $Xj->registerNamespace("\163\145\143\144\x73\151\147", self::XMLDSIGNS);
        $U3 = "\56\57\163\145\x63\144\x73\151\x67\x3a\x54\162\x61\x6e\163\x66\157\x72\155\x73\x2f\163\x65\143\x64\163\151\x67\x3a\124\x72\x61\x6e\163\146\x6f\162\155";
        $NV = $Xj->query($U3, $u7);
        $rF = "\x68\164\164\160\x3a\x2f\57\167\x77\x77\x2e\x77\x33\x2e\157\x72\147\57\x54\122\57\x32\60\60\61\x2f\x52\x45\x43\55\170\x6d\x6c\x2d\143\x31\64\x6e\55\x32\x30\60\61\x30\x33\x31\65";
        $K0 = null;
        $sI = null;
        foreach ($NV as $N6) {
            $PB = $N6->getAttribute("\101\x6c\x67\x6f\x72\x69\x74\150\155");
            switch ($PB) {
                case "\150\x74\x74\x70\x3a\x2f\x2f\x77\x77\x77\x2e\167\x33\x2e\x6f\x72\x67\x2f\62\60\x30\61\57\x31\x30\57\x78\x6d\154\x2d\145\x78\143\x2d\x63\61\64\156\43":
                case "\150\164\x74\160\x3a\57\x2f\x77\167\x77\56\x77\63\x2e\157\x72\x67\x2f\x32\x30\x30\x31\57\x31\60\57\170\155\x6c\x2d\x65\x78\143\x2d\143\x31\x34\156\43\127\x69\164\x68\x43\157\x6d\155\145\x6e\x74\x73":
                    if (!$IG) {
                        goto QC;
                    }
                    $rF = $PB;
                    goto dQ;
                    QC:
                    $rF = "\x68\x74\164\x70\x3a\x2f\57\167\167\x77\x2e\x77\x33\56\157\162\147\57\62\x30\60\x31\57\x31\x30\57\170\155\154\55\x65\170\143\x2d\143\x31\64\156\x23";
                    dQ:
                    $fz = $N6->firstChild;
                    dS:
                    if (!$fz) {
                        goto sb;
                    }
                    if (!($fz->localName == "\111\156\143\154\x75\163\151\166\145\x4e\x61\155\145\163\x70\141\143\145\x73")) {
                        goto k6;
                    }
                    if (!($tN = $fz->getAttribute("\x50\x72\145\146\x69\170\114\x69\x73\x74"))) {
                        goto d1;
                    }
                    $AL = array();
                    $s3 = explode("\40", $tN);
                    foreach ($s3 as $tN) {
                        $Sa = trim($tN);
                        if (empty($Sa)) {
                            goto T3;
                        }
                        $AL[] = $Sa;
                        T3:
                        SD:
                    }
                    iZ:
                    if (!(count($AL) > 0)) {
                        goto bH;
                    }
                    $sI = $AL;
                    bH:
                    d1:
                    goto sb;
                    k6:
                    $fz = $fz->nextSibling;
                    goto dS;
                    sb:
                    goto It;
                case "\x68\164\164\x70\72\x2f\57\x77\x77\x77\56\x77\63\x2e\x6f\x72\x67\x2f\x54\x52\x2f\x32\x30\60\61\x2f\x52\105\103\55\x78\155\154\x2d\143\61\x34\156\55\x32\x30\60\x31\60\63\x31\x35":
                case "\x68\x74\x74\160\72\x2f\x2f\167\167\167\56\167\x33\56\x6f\162\147\x2f\x54\122\x2f\62\x30\60\61\57\x52\x45\x43\55\170\x6d\x6c\55\x63\61\x34\x6e\x2d\62\x30\x30\61\60\63\61\65\43\127\151\164\150\103\157\x6d\x6d\x65\x6e\164\x73":
                    if (!$IG) {
                        goto yH;
                    }
                    $rF = $PB;
                    goto hA;
                    yH:
                    $rF = "\x68\164\x74\x70\x3a\x2f\57\x77\167\x77\x2e\x77\63\x2e\x6f\x72\x67\57\124\122\x2f\x32\x30\60\x31\x2f\x52\105\x43\x2d\170\x6d\154\55\143\x31\64\x6e\x2d\62\x30\x30\61\60\x33\x31\x35";
                    hA:
                    goto It;
                case "\x68\164\164\160\x3a\x2f\x2f\x77\167\x77\56\x77\63\x2e\x6f\162\147\57\124\x52\57\x31\x39\71\71\x2f\x52\x45\x43\x2d\x78\x70\141\x74\x68\55\61\71\x39\71\x31\x31\x31\66":
                    $fz = $N6->firstChild;
                    Bp:
                    if (!$fz) {
                        goto Dy;
                    }
                    if (!($fz->localName == "\130\120\x61\x74\150")) {
                        goto gT;
                    }
                    $K0 = array();
                    $K0["\161\x75\145\162\171"] = "\50\56\57\x2f\56\x20\174\x20\x2e\57\x2f\100\x2a\x20\174\x20\x2e\x2f\x2f\x6e\x61\155\x65\x73\160\x61\143\x65\72\72\52\x29\133" . $fz->nodeValue . "\x5d";
                    $s_["\156\x61\155\x65\163\x70\141\x63\x65\163"] = array();
                    $tq = $Xj->query("\56\x2f\156\x61\155\x65\163\x70\x61\x63\x65\x3a\72\x2a", $fz);
                    foreach ($tq as $cI) {
                        if (!($cI->localName != "\x78\x6d\154")) {
                            goto zE;
                        }
                        $K0["\x6e\x61\155\145\x73\160\141\x63\145\163"][$cI->localName] = $cI->nodeValue;
                        zE:
                        z4:
                    }
                    FO:
                    goto Dy;
                    gT:
                    $fz = $fz->nextSibling;
                    goto Bp;
                    Dy:
                    goto It;
            }
            WA:
            It:
            hD:
        }
        tC:
        if (!$iu instanceof DOMElement) {
            goto TF;
        }
        $iu = $this->canonicalizeData($c1, $rF, $K0, $sI);
        TF:
        return $iu;
    }
    public function processRefNode($u7)
    {
        $Ey = null;
        $IG = true;
        if ($oO = $u7->getAttribute("\125\122\x49")) {
            goto Nx;
        }
        $IG = false;
        $Ey = $u7->ownerDocument;
        goto Eu;
        Nx:
        $Ae = parse_url($oO);
        if (empty($Ae["\160\x61\x74\150"])) {
            goto x3;
        }
        $Ey = file_get_contents($Ae);
        goto mF;
        x3:
        if ($ni = $Ae["\146\162\x61\x67\x6d\145\156\164"]) {
            goto lI;
        }
        $Ey = $u7->ownerDocument;
        goto Mw;
        lI:
        $IG = false;
        $Oa = new DOMXPath($u7->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto on;
        }
        foreach ($this->idNS as $HR => $Vd) {
            $Oa->registerNamespace($HR, $Vd);
            Y7:
        }
        vW:
        on:
        $Za = "\x40\111\144\75\42" . $ni . "\42";
        if (!is_array($this->idKeys)) {
            goto H2;
        }
        foreach ($this->idKeys as $vR) {
            $Za .= "\x20\x6f\x72\40\x40{$vR}\x3d\x27{$ni}\x27";
            Uq:
        }
        Q0:
        H2:
        $U3 = "\57\57\52\x5b" . $Za . "\x5d";
        $Ey = $Oa->query($U3)->item(0);
        Mw:
        mF:
        Eu:
        $iu = $this->processTransforms($u7, $Ey, $IG);
        if ($this->validateDigest($u7, $iu)) {
            goto AZ;
        }
        return false;
        AZ:
        if (!$Ey instanceof DOMElement) {
            goto qL;
        }
        if (!empty($ni)) {
            goto Dz;
        }
        $this->validatedNodes[] = $Ey;
        goto qC;
        Dz:
        $this->validatedNodes[$ni] = $Ey;
        qC:
        qL:
        return true;
    }
    public function getRefNodeID($u7)
    {
        if (!($oO = $u7->getAttribute("\x55\122\x49"))) {
            goto wZ;
        }
        $Ae = parse_url($oO);
        if (!empty($Ae["\160\141\x74\150"])) {
            goto HE;
        }
        if (!($ni = $Ae["\146\x72\x61\x67\155\x65\x6e\164"])) {
            goto pY;
        }
        return $ni;
        pY:
        HE:
        wZ:
        return null;
    }
    public function getRefIDs()
    {
        $i1 = array();
        $Xj = $this->getXPathObj();
        $U3 = "\x2e\57\163\145\143\144\x73\x69\x67\x3a\123\151\147\x6e\x65\x64\x49\x6e\146\157\x2f\x73\x65\x63\x64\163\151\147\72\122\x65\x66\145\x72\x65\156\143\x65";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($f9->length == 0)) {
            goto P2;
        }
        throw new Exception("\122\x65\146\145\x72\x65\156\143\x65\40\x6e\x6f\x64\x65\x73\40\x6e\157\164\40\146\157\x75\x6e\x64");
        P2:
        foreach ($f9 as $u7) {
            $i1[] = $this->getRefNodeID($u7);
            cs:
        }
        ka:
        return $i1;
    }
    public function validateReference()
    {
        $L1 = $this->sigNode->ownerDocument->documentElement;
        if ($L1->isSameNode($this->sigNode)) {
            goto Kb;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto jR;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        jR:
        Kb:
        $Xj = $this->getXPathObj();
        $U3 = "\56\x2f\x73\x65\x63\144\x73\151\147\72\x53\x69\x67\x6e\145\144\x49\x6e\146\x6f\57\x73\145\x63\x64\x73\151\147\72\x52\x65\146\145\162\145\x6e\x63\x65";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($f9->length == 0)) {
            goto Y2;
        }
        throw new Exception("\x52\145\x66\145\162\145\x6e\x63\145\40\156\x6f\x64\145\163\40\156\x6f\164\x20\x66\x6f\165\x6e\x64");
        Y2:
        $this->validatedNodes = array();
        foreach ($f9 as $u7) {
            if ($this->processRefNode($u7)) {
                goto z5;
            }
            $this->validatedNodes = null;
            throw new Exception("\122\x65\x66\145\x72\x65\156\x63\145\40\x76\141\154\x69\144\141\164\x69\157\156\40\146\141\151\x6c\145\x64");
            z5:
            mN:
        }
        OS:
        return true;
    }
    private function addRefInternal($RB, $fz, $PB, $Wd = null, $VT = null)
    {
        $E2 = null;
        $G5 = null;
        $xf = "\111\x64";
        $ER = true;
        $V5 = false;
        if (!is_array($VT)) {
            goto XB;
        }
        $E2 = empty($VT["\160\162\145\x66\151\x78"]) ? null : $VT["\x70\162\145\146\x69\170"];
        $G5 = empty($VT["\x70\x72\145\x66\151\x78\137\x6e\163"]) ? null : $VT["\160\x72\145\x66\x69\x78\x5f\156\x73"];
        $xf = empty($VT["\x69\144\137\156\141\x6d\145"]) ? "\111\144" : $VT["\151\144\x5f\156\141\155\145"];
        $ER = !isset($VT["\157\x76\145\162\167\162\x69\x74\145"]) ? true : (bool) $VT["\x6f\166\145\x72\x77\162\151\x74\x65"];
        $V5 = !isset($VT["\x66\x6f\162\143\145\x5f\165\x72\x69"]) ? false : (bool) $VT["\146\157\162\143\145\x5f\165\x72\151"];
        XB:
        $nh = $xf;
        if (empty($E2)) {
            goto f5;
        }
        $nh = $E2 . "\x3a" . $nh;
        f5:
        $u7 = $this->createNewSignNode("\122\145\x66\145\x72\145\156\x63\x65");
        $RB->appendChild($u7);
        if (!$fz instanceof DOMDocument) {
            goto eQ;
        }
        if ($V5) {
            goto Sy;
        }
        goto T_;
        eQ:
        $oO = null;
        if ($ER) {
            goto z7;
        }
        $oO = $G5 ? $fz->getAttributeNS($G5, $xf) : $fz->getAttribute($xf);
        z7:
        if (!empty($oO)) {
            goto LQ;
        }
        $oO = self::generateGUID();
        $fz->setAttributeNS($G5, $nh, $oO);
        LQ:
        $u7->setAttribute("\125\122\x49", "\43" . $oO);
        goto T_;
        Sy:
        $u7->setAttribute("\x55\122\x49", '');
        T_:
        $pm = $this->createNewSignNode("\x54\162\141\x6e\163\146\157\x72\155\x73");
        $u7->appendChild($pm);
        if (is_array($Wd)) {
            goto l_;
        }
        if (!empty($this->canonicalMethod)) {
            goto Xq;
        }
        goto q5;
        l_:
        foreach ($Wd as $N6) {
            $vo = $this->createNewSignNode("\124\x72\x61\156\163\x66\157\162\x6d");
            $pm->appendChild($vo);
            if (is_array($N6) && !empty($N6["\x68\x74\164\160\72\x2f\57\167\167\x77\56\167\x33\56\x6f\162\147\57\x54\x52\57\61\x39\71\71\x2f\x52\x45\103\x2d\x78\160\141\x74\150\x2d\x31\x39\x39\x39\61\x31\x31\66"]) && !empty($N6["\x68\x74\164\160\72\57\57\x77\167\x77\56\167\x33\x2e\x6f\x72\147\x2f\124\x52\57\61\71\x39\71\x2f\122\105\103\55\170\x70\x61\x74\150\x2d\x31\71\x39\71\x31\x31\x31\x36"]["\x71\165\x65\x72\x79"])) {
                goto zY;
            }
            $vo->setAttribute("\x41\x6c\x67\x6f\162\x69\x74\x68\x6d", $N6);
            goto ha;
            zY:
            $vo->setAttribute("\101\154\x67\157\162\151\164\150\x6d", "\x68\x74\x74\160\72\x2f\x2f\x77\167\167\56\167\x33\56\x6f\x72\x67\x2f\x54\122\57\61\71\x39\x39\57\122\105\103\55\x78\160\141\x74\x68\x2d\61\71\x39\x39\x31\x31\61\x36");
            $Gp = $this->createNewSignNode("\x58\120\x61\164\x68", $N6["\150\164\x74\160\72\x2f\x2f\167\x77\167\56\167\63\x2e\x6f\x72\147\x2f\x54\122\x2f\x31\71\x39\71\x2f\x52\105\x43\x2d\170\160\x61\x74\150\x2d\x31\71\71\71\61\61\61\x36"]["\x71\165\145\x72\x79"]);
            $vo->appendChild($Gp);
            if (empty($N6["\x68\164\164\160\x3a\57\x2f\167\167\167\56\x77\63\x2e\157\x72\x67\x2f\124\122\57\61\71\71\71\x2f\122\105\x43\x2d\170\x70\x61\x74\x68\55\x31\x39\71\x39\x31\61\61\x36"]["\x6e\141\155\145\163\x70\141\143\145\163"])) {
                goto Md;
            }
            foreach ($N6["\x68\164\x74\160\x3a\x2f\57\167\x77\x77\x2e\167\63\x2e\157\x72\147\57\124\122\x2f\61\71\x39\x39\x2f\122\x45\103\55\x78\160\x61\164\x68\x2d\61\71\x39\x39\61\x31\x31\x36"]["\x6e\x61\155\145\163\160\141\x63\x65\163"] as $E2 => $k3) {
                $Gp->setAttributeNS("\150\x74\164\160\72\57\57\167\x77\x77\x2e\167\x33\x2e\157\x72\x67\57\x32\60\x30\x30\x2f\x78\x6d\154\156\163\x2f", "\170\x6d\x6c\x6e\x73\x3a{$E2}", $k3);
                mL:
            }
            e8:
            Md:
            ha:
            U6:
        }
        Rf:
        goto q5;
        Xq:
        $vo = $this->createNewSignNode("\124\162\x61\x6e\163\x66\x6f\x72\x6d");
        $pm->appendChild($vo);
        $vo->setAttribute("\101\x6c\147\x6f\x72\x69\x74\150\155", $this->canonicalMethod);
        q5:
        $h2 = $this->processTransforms($u7, $fz);
        $xc = $this->calculateDigest($PB, $h2);
        $Sc = $this->createNewSignNode("\104\151\x67\145\x73\164\x4d\145\x74\150\x6f\144");
        $u7->appendChild($Sc);
        $Sc->setAttribute("\101\x6c\147\x6f\162\x69\x74\150\155", $PB);
        $g2 = $this->createNewSignNode("\104\151\x67\145\x73\x74\x56\x61\x6c\x75\x65", $xc);
        $u7->appendChild($g2);
    }
    public function addReference($fz, $PB, $Wd = null, $VT = null)
    {
        if (!($Xj = $this->getXPathObj())) {
            goto SA;
        }
        $U3 = "\56\57\x73\x65\x63\x64\x73\151\147\72\x53\x69\x67\x6e\145\144\111\x6e\146\157";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($F2 = $f9->item(0))) {
            goto jC;
        }
        $this->addRefInternal($F2, $fz, $PB, $Wd, $VT);
        jC:
        SA:
    }
    public function addReferenceList($vf, $PB, $Wd = null, $VT = null)
    {
        if (!($Xj = $this->getXPathObj())) {
            goto jp;
        }
        $U3 = "\56\x2f\163\x65\x63\x64\163\151\x67\x3a\123\x69\147\156\145\144\x49\156\146\157";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($F2 = $f9->item(0))) {
            goto um;
        }
        foreach ($vf as $fz) {
            $this->addRefInternal($F2, $fz, $PB, $Wd, $VT);
            ux:
        }
        aN:
        um:
        jp:
    }
    public function addObject($iu, $Fb = null, $om = null)
    {
        $ZR = $this->createNewSignNode("\x4f\142\x6a\x65\x63\164");
        $this->sigNode->appendChild($ZR);
        if (empty($Fb)) {
            goto ix;
        }
        $ZR->setAttribute("\115\151\x6d\145\x54\171\160\x65", $Fb);
        ix:
        if (empty($om)) {
            goto uV;
        }
        $ZR->setAttribute("\105\156\x63\157\x64\151\156\x67", $om);
        uV:
        if ($iu instanceof DOMElement) {
            goto bA;
        }
        $Rp = $this->sigNode->ownerDocument->createTextNode($iu);
        goto Vx;
        bA:
        $Rp = $this->sigNode->ownerDocument->importNode($iu, true);
        Vx:
        $ZR->appendChild($Rp);
        return $ZR;
    }
    public function locateKey($fz = null)
    {
        if (!empty($fz)) {
            goto uq;
        }
        $fz = $this->sigNode;
        uq:
        if ($fz instanceof DOMNode) {
            goto q9;
        }
        return null;
        q9:
        if (!($Ij = $fz->ownerDocument)) {
            goto qT;
        }
        $Xj = new DOMXPath($Ij);
        $Xj->registerNamespace("\x73\x65\143\x64\x73\151\x67", self::XMLDSIGNS);
        $U3 = "\x73\x74\162\151\x6e\x67\50\x2e\57\163\145\x63\x64\x73\x69\147\72\123\151\147\x6e\x65\144\111\156\x66\157\x2f\x73\x65\143\x64\x73\151\x67\72\x53\151\x67\x6e\141\x74\x75\x72\x65\x4d\145\164\x68\x6f\144\57\x40\101\x6c\147\x6f\162\151\x74\x68\x6d\51";
        $PB = $Xj->evaluate($U3, $fz);
        if (!$PB) {
            goto Uo;
        }
        try {
            $dl = new XMLSecurityKey($PB, array("\164\171\x70\145" => "\160\165\142\x6c\x69\143"));
        } catch (Exception $R8) {
            return null;
        }
        return $dl;
        Uo:
        qT:
        return null;
    }
    public function verify($dl)
    {
        $Ij = $this->sigNode->ownerDocument;
        $Xj = new DOMXPath($Ij);
        $Xj->registerNamespace("\x73\x65\143\144\163\151\147", self::XMLDSIGNS);
        $U3 = "\163\x74\162\151\x6e\147\50\56\57\163\x65\143\144\x73\151\x67\x3a\123\x69\147\156\141\164\165\162\145\126\141\154\x75\145\x29";
        $o2 = $Xj->evaluate($U3, $this->sigNode);
        if (!empty($o2)) {
            goto Gu;
        }
        throw new Exception("\125\x6e\x61\x62\x6c\145\40\x74\157\40\x6c\x6f\143\141\x74\x65\x20\x53\151\x67\x6e\141\x74\165\162\145\x56\141\x6c\x75\145");
        Gu:
        return $dl->verifySignature($this->signedInfo, base64_decode($o2));
    }
    public function signData($dl, $iu)
    {
        return $dl->signData($iu);
    }
    public function sign($dl, $Ek = null)
    {
        if (!($Ek != null)) {
            goto D_;
        }
        $this->resetXPathObj();
        $this->appendSignature($Ek);
        $this->sigNode = $Ek->lastChild;
        D_:
        if (!($Xj = $this->getXPathObj())) {
            goto GH;
        }
        $U3 = "\56\57\x73\x65\143\x64\163\x69\x67\x3a\123\151\x67\x6e\145\144\x49\x6e\x66\x6f";
        $f9 = $Xj->query($U3, $this->sigNode);
        if (!($F2 = $f9->item(0))) {
            goto eY;
        }
        $U3 = "\x2e\57\163\145\143\144\x73\151\x67\72\x53\x69\x67\156\141\x74\165\x72\x65\115\145\x74\x68\157\144";
        $f9 = $Xj->query($U3, $F2);
        $f5 = $f9->item(0);
        $f5->setAttribute("\x41\154\147\x6f\162\151\x74\150\x6d", $dl->type);
        $iu = $this->canonicalizeData($F2, $this->canonicalMethod);
        $o2 = base64_encode($this->signData($dl, $iu));
        $iW = $this->createNewSignNode("\123\151\x67\x6e\141\164\x75\x72\x65\126\141\x6c\x75\x65", $o2);
        if ($Dq = $F2->nextSibling) {
            goto f6;
        }
        $this->sigNode->appendChild($iW);
        goto eJ;
        f6:
        $Dq->parentNode->insertBefore($iW, $Dq);
        eJ:
        eY:
        GH:
    }
    public function appendCert()
    {
    }
    public function appendKey($dl, $mP = null)
    {
        $dl->serializeKey($mP);
    }
    public function insertSignature($fz, $V7 = null)
    {
        $wl = $fz->ownerDocument;
        $SN = $wl->importNode($this->sigNode, true);
        if ($V7 == null) {
            goto uY;
        }
        return $fz->insertBefore($SN, $V7);
        goto EV;
        uY:
        return $fz->insertBefore($SN);
        EV:
    }
    public function appendSignature($RI, $As = false)
    {
        $V7 = $As ? $RI->firstChild : null;
        return $this->insertSignature($RI, $V7);
    }
    public static function get509XCert($OQ, $jY = true)
    {
        $oI = self::staticGet509XCerts($OQ, $jY);
        if (empty($oI)) {
            goto Br;
        }
        return $oI[0];
        Br:
        return '';
    }
    public static function staticGet509XCerts($oI, $jY = true)
    {
        if ($jY) {
            goto Hv;
        }
        return array($oI);
        goto ZW;
        Hv:
        $iu = '';
        $uW = array();
        $D3 = explode("\xa", $oI);
        $d8 = false;
        foreach ($D3 as $Ti) {
            if (!$d8) {
                goto gc;
            }
            if (!(strncmp($Ti, "\55\x2d\55\55\55\105\x4e\104\40\103\105\122\124\111\106\111\103\101\124\x45", 20) == 0)) {
                goto jd;
            }
            $d8 = false;
            $uW[] = $iu;
            $iu = '';
            goto Yk;
            jd:
            $iu .= trim($Ti);
            goto kj;
            gc:
            if (!(strncmp($Ti, "\55\x2d\x2d\x2d\55\x42\105\x47\111\116\x20\103\105\x52\x54\111\106\x49\x43\101\x54\105", 22) == 0)) {
                goto Ex;
            }
            $d8 = true;
            Ex:
            kj:
            Yk:
        }
        hJ:
        return $uW;
        ZW:
    }
    public static function staticAdd509Cert($Qg, $OQ, $jY = true, $Wc = false, $Xj = null, $VT = null)
    {
        if (!$Wc) {
            goto zb;
        }
        $OQ = file_get_contents($OQ);
        zb:
        if ($Qg instanceof DOMElement) {
            goto av;
        }
        throw new Exception("\x49\156\x76\x61\154\x69\144\40\160\x61\162\145\156\164\x20\116\157\144\145\40\160\141\x72\x61\x6d\145\x74\x65\162");
        av:
        $dE = $Qg->ownerDocument;
        if (!empty($Xj)) {
            goto cI;
        }
        $Xj = new DOMXPath($Qg->ownerDocument);
        $Xj->registerNamespace("\163\x65\x63\x64\x73\x69\x67", self::XMLDSIGNS);
        cI:
        $U3 = "\x2e\x2f\163\145\143\144\163\151\147\x3a\x4b\145\171\111\156\146\x6f";
        $f9 = $Xj->query($U3, $Qg);
        $rc = $f9->item(0);
        $Pc = '';
        if (!$rc) {
            goto ne;
        }
        $tN = $rc->lookupPrefix(self::XMLDSIGNS);
        if (empty($tN)) {
            goto jg;
        }
        $Pc = $tN . "\72";
        jg:
        goto Wi;
        ne:
        $tN = $Qg->lookupPrefix(self::XMLDSIGNS);
        if (empty($tN)) {
            goto L9;
        }
        $Pc = $tN . "\72";
        L9:
        $pf = false;
        $rc = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\113\x65\171\x49\156\146\157");
        $U3 = "\56\57\x73\145\x63\x64\163\151\x67\x3a\x4f\x62\152\145\143\164";
        $f9 = $Xj->query($U3, $Qg);
        if (!($fV = $f9->item(0))) {
            goto C3;
        }
        $fV->parentNode->insertBefore($rc, $fV);
        $pf = true;
        C3:
        if ($pf) {
            goto db;
        }
        $Qg->appendChild($rc);
        db:
        Wi:
        $oI = self::staticGet509XCerts($OQ, $jY);
        $HG = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x58\65\60\71\x44\x61\164\x61");
        $rc->appendChild($HG);
        $FC = false;
        $yu = false;
        if (!is_array($VT)) {
            goto Rt;
        }
        if (empty($VT["\151\163\163\x75\145\x72\123\x65\x72\151\141\154"])) {
            goto TP;
        }
        $FC = true;
        TP:
        if (empty($VT["\x73\x75\142\x6a\145\143\164\116\141\x6d\145"])) {
            goto PC;
        }
        $yu = true;
        PC:
        Rt:
        foreach ($oI as $r3) {
            if (!($FC || $yu)) {
                goto zS;
            }
            if (!($I2 = openssl_x509_parse("\55\55\x2d\55\x2d\x42\105\x47\x49\116\40\x43\x45\x52\124\x49\x46\111\x43\101\x54\105\55\x2d\x2d\55\x2d\12" . chunk_split($r3, 64, "\xa") . "\55\55\55\x2d\55\x45\116\104\x20\103\105\122\x54\x49\x46\111\103\x41\x54\105\55\x2d\x2d\x2d\55\12"))) {
                goto Fs;
            }
            if (!($yu && !empty($I2["\163\x75\142\152\x65\x63\164"]))) {
                goto H0;
            }
            if (is_array($I2["\x73\x75\142\x6a\x65\143\164"])) {
                goto yu;
            }
            $Y6 = $I2["\x69\163\x73\x75\x65\162"];
            goto qj;
            yu:
            $C8 = array();
            foreach ($I2["\163\x75\142\152\145\143\164"] as $Rh => $s5) {
                if (is_array($s5)) {
                    goto iy;
                }
                array_unshift($C8, "{$Rh}\75{$s5}");
                goto fG;
                iy:
                foreach ($s5 as $Uy) {
                    array_unshift($C8, "{$Rh}\75{$Uy}");
                    Aj:
                }
                mp:
                fG:
                ky:
            }
            O2:
            $Y6 = implode("\x2c", $C8);
            qj:
            $Y5 = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x58\x35\x30\71\x53\x75\142\x6a\x65\143\x74\x4e\x61\155\x65", $Y6);
            $HG->appendChild($Y5);
            H0:
            if (!($FC && !empty($I2["\x69\x73\x73\165\x65\x72"]) && !empty($I2["\163\x65\162\x69\x61\x6c\x4e\165\155\142\x65\162"]))) {
                goto zo;
            }
            if (is_array($I2["\151\163\163\x75\145\x72"])) {
                goto iR;
            }
            $rG = $I2["\x69\x73\x73\x75\145\x72"];
            goto GA;
            iR:
            $C8 = array();
            foreach ($I2["\x69\x73\x73\165\x65\x72"] as $Rh => $s5) {
                array_unshift($C8, "{$Rh}\75{$s5}");
                DB:
            }
            vx:
            $rG = implode("\54", $C8);
            GA:
            $Nk = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x58\x35\x30\x39\111\x73\163\165\x65\162\123\145\162\x69\141\x6c");
            $HG->appendChild($Nk);
            $In = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x58\65\x30\x39\111\163\x73\165\145\162\116\x61\x6d\145", $rG);
            $Nk->appendChild($In);
            $In = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x58\x35\x30\x39\x53\x65\x72\151\141\x6c\116\165\x6d\142\x65\x72", $I2["\x73\145\162\x69\x61\x6c\116\x75\x6d\142\x65\x72"]);
            $Nk->appendChild($In);
            zo:
            Fs:
            zS:
            $to = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x58\x35\60\x39\103\145\162\164\x69\146\151\143\x61\164\145", $r3);
            $HG->appendChild($to);
            xH:
        }
        BW:
    }
    public function add509Cert($OQ, $jY = true, $Wc = false, $VT = null)
    {
        if (!($Xj = $this->getXPathObj())) {
            goto dq;
        }
        self::staticAdd509Cert($this->sigNode, $OQ, $jY, $Wc, $Xj, $VT);
        dq:
    }
    public function appendToKeyInfo($fz)
    {
        $Qg = $this->sigNode;
        $dE = $Qg->ownerDocument;
        $Xj = $this->getXPathObj();
        if (!empty($Xj)) {
            goto hg;
        }
        $Xj = new DOMXPath($Qg->ownerDocument);
        $Xj->registerNamespace("\163\145\x63\x64\x73\151\x67", self::XMLDSIGNS);
        hg:
        $U3 = "\x2e\x2f\x73\x65\143\x64\x73\x69\147\72\x4b\x65\x79\111\156\x66\157";
        $f9 = $Xj->query($U3, $Qg);
        $rc = $f9->item(0);
        if ($rc) {
            goto Sh;
        }
        $Pc = '';
        $tN = $Qg->lookupPrefix(self::XMLDSIGNS);
        if (empty($tN)) {
            goto BR;
        }
        $Pc = $tN . "\72";
        BR:
        $pf = false;
        $rc = $dE->createElementNS(self::XMLDSIGNS, $Pc . "\x4b\145\x79\111\x6e\146\157");
        $U3 = "\x2e\x2f\163\145\x63\144\163\x69\x67\72\117\142\x6a\145\143\x74";
        $f9 = $Xj->query($U3, $Qg);
        if (!($fV = $f9->item(0))) {
            goto z2;
        }
        $fV->parentNode->insertBefore($rc, $fV);
        $pf = true;
        z2:
        if ($pf) {
            goto L_;
        }
        $Qg->appendChild($rc);
        L_:
        Sh:
        $rc->appendChild($fz);
        return $rc;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
class XMLSecEnc
{
    const template = "\x3c\x78\x65\156\x63\x3a\x45\156\x63\x72\x79\x70\x74\145\144\x44\x61\164\x61\x20\170\155\154\x6e\163\72\x78\145\x6e\143\75\47\x68\164\x74\160\x3a\x2f\x2f\167\167\167\56\167\x33\56\157\x72\147\x2f\62\60\x30\x31\57\60\64\x2f\x78\155\x6c\145\x6e\143\x23\47\x3e\xd\xa\x20\40\x20\x3c\x78\x65\x6e\x63\x3a\x43\151\x70\x68\x65\x72\104\x61\164\141\x3e\15\xa\x20\x20\x20\x20\x20\40\74\x78\145\156\143\72\x43\x69\160\150\x65\162\x56\141\154\165\145\x3e\74\x2f\x78\145\156\x63\72\103\151\x70\150\145\x72\126\141\154\x75\x65\x3e\15\12\40\x20\40\74\57\170\x65\x6e\x63\x3a\x43\x69\x70\150\x65\162\x44\141\164\141\76\xd\12\x3c\57\170\x65\x6e\143\x3a\105\x6e\x63\x72\171\160\164\145\144\104\141\164\141\76";
    const Element = "\150\x74\x74\x70\x3a\57\x2f\x77\167\167\x2e\167\x33\56\157\x72\147\x2f\x32\x30\x30\x31\x2f\x30\x34\x2f\x78\x6d\x6c\145\x6e\x63\x23\105\154\145\155\145\156\x74";
    const Content = "\150\164\x74\x70\x3a\57\57\x77\167\167\x2e\x77\x33\56\157\x72\147\57\x32\x30\60\x31\57\x30\64\57\x78\x6d\x6c\x65\156\x63\x23\x43\157\156\164\145\x6e\x74";
    const URI = 3;
    const XMLENCNS = "\150\164\x74\160\x3a\x2f\x2f\x77\x77\167\x2e\x77\x33\x2e\157\x72\x67\x2f\x32\60\60\x31\x2f\x30\64\57\x78\155\x6c\x65\x6e\x63\x23";
    private $encdoc = null;
    private $rawNode = null;
    public $type = null;
    public $encKey = null;
    private $references = array();
    public function __construct()
    {
        $this->_resetTemplate();
    }
    private function _resetTemplate()
    {
        $this->encdoc = new DOMDocument();
        $this->encdoc->loadXML(self::template);
    }
    public function addReference($oR, $fz, $n3)
    {
        if ($fz instanceof DOMNode) {
            goto ys;
        }
        throw new Exception("\x24\156\157\x64\x65\x20\151\163\40\156\x6f\x74\40\157\146\x20\164\171\160\x65\x20\x44\x4f\x4d\x4e\157\144\145");
        ys:
        $fl = $this->encdoc;
        $this->_resetTemplate();
        $ie = $this->encdoc;
        $this->encdoc = $fl;
        $Vk = XMLSecurityDSig::generateGUID();
        $GH = $ie->documentElement;
        $GH->setAttribute("\x49\144", $Vk);
        $this->references[$oR] = array("\x6e\157\144\145" => $fz, "\164\x79\160\145" => $n3, "\x65\156\x63\x6e\x6f\144\145" => $ie, "\x72\x65\146\165\162\151" => $Vk);
    }
    public function setNode($fz)
    {
        $this->rawNode = $fz;
    }
    public function encryptNode($dl, $bQ = true)
    {
        $iu = '';
        if (!empty($this->rawNode)) {
            goto yX;
        }
        throw new Exception("\116\x6f\x64\145\40\164\157\x20\x65\156\x63\x72\x79\x70\x74\40\150\x61\x73\x20\156\x6f\164\40\142\x65\145\156\40\163\145\x74");
        yX:
        if ($dl instanceof XMLSecurityKey) {
            goto RI;
        }
        throw new Exception("\x49\156\166\x61\x6c\151\x64\40\x4b\145\x79");
        RI:
        $Ij = $this->rawNode->ownerDocument;
        $Oa = new DOMXPath($this->encdoc);
        $bN = $Oa->query("\x2f\x78\145\x6e\143\x3a\105\156\143\x72\171\160\x74\x65\144\104\141\x74\141\x2f\170\x65\x6e\143\72\x43\151\160\150\x65\x72\104\x61\x74\141\57\x78\x65\x6e\143\x3a\103\x69\160\150\x65\162\126\141\x6c\x75\145");
        $Vl = $bN->item(0);
        if (!($Vl == null)) {
            goto ma;
        }
        throw new Exception("\x45\162\162\x6f\162\x20\x6c\x6f\143\x61\164\x69\156\147\x20\x43\151\x70\x68\x65\162\x56\x61\x6c\165\145\40\x65\x6c\x65\x6d\x65\156\164\40\167\x69\x74\x68\x69\156\40\164\x65\155\160\154\x61\x74\x65");
        ma:
        switch ($this->type) {
            case self::Element:
                $iu = $Ij->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\x54\171\x70\145", self::Element);
                goto C1;
            case self::Content:
                $T4 = $this->rawNode->childNodes;
                foreach ($T4 as $Ra) {
                    $iu .= $Ij->saveXML($Ra);
                    dO1:
                }
                SC:
                $this->encdoc->documentElement->setAttribute("\x54\x79\160\x65", self::Content);
                goto C1;
            default:
                throw new Exception("\x54\x79\x70\145\40\x69\163\40\x63\x75\x72\x72\145\156\x74\154\x79\40\156\x6f\x74\x20\x73\165\160\x70\157\x72\x74\x65\144");
        }
        hp:
        C1:
        $tK = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\143\x3a\105\x6e\x63\x72\x79\160\164\151\x6f\x6e\x4d\x65\x74\x68\157\144"));
        $tK->setAttribute("\x41\154\x67\157\162\x69\164\150\x6d", $dl->getAlgorithm());
        $Vl->parentNode->parentNode->insertBefore($tK, $Vl->parentNode->parentNode->firstChild);
        $n5 = base64_encode($dl->encryptData($iu));
        $s5 = $this->encdoc->createTextNode($n5);
        $Vl->appendChild($s5);
        if ($bQ) {
            goto sM;
        }
        return $this->encdoc->documentElement;
        goto dt;
        sM:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto e5;
                }
                return $this->encdoc;
                e5:
                $yE = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($yE, $this->rawNode);
                return $yE;
            case self::Content:
                $yE = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                fF:
                if (!$this->rawNode->firstChild) {
                    goto j9;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto fF;
                j9:
                $this->rawNode->appendChild($yE);
                return $yE;
        }
        y0:
        PG:
        dt:
    }
    public function encryptReferences($dl)
    {
        $q0 = $this->rawNode;
        $bi = $this->type;
        foreach ($this->references as $oR => $Ar) {
            $this->encdoc = $Ar["\x65\x6e\x63\x6e\157\x64\145"];
            $this->rawNode = $Ar["\x6e\x6f\144\145"];
            $this->type = $Ar["\x74\171\160\x65"];
            try {
                $P_ = $this->encryptNode($dl);
                $this->references[$oR]["\145\x6e\143\x6e\157\144\x65"] = $P_;
            } catch (Exception $R8) {
                $this->rawNode = $q0;
                $this->type = $bi;
                throw $R8;
            }
            h4:
        }
        Ni:
        $this->rawNode = $q0;
        $this->type = $bi;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto QP;
        }
        throw new Exception("\x4e\x6f\144\x65\40\x74\x6f\40\144\145\x63\162\171\x70\164\x20\x68\x61\x73\x20\156\157\164\40\142\x65\x65\x6e\40\163\x65\164");
        QP:
        $Ij = $this->rawNode->ownerDocument;
        $Oa = new DOMXPath($Ij);
        $Oa->registerNamespace("\x78\155\154\145\x6e\143\162", self::XMLENCNS);
        $U3 = "\x2e\57\170\x6d\x6c\145\156\143\x72\72\x43\x69\x70\x68\145\x72\x44\141\164\x61\57\x78\155\154\x65\x6e\143\x72\x3a\x43\151\160\x68\x65\162\x56\141\154\165\145";
        $f9 = $Oa->query($U3, $this->rawNode);
        $fz = $f9->item(0);
        if ($fz) {
            goto r5;
        }
        return null;
        r5:
        return base64_decode($fz->nodeValue);
    }
    public function decryptNode($dl, $bQ = true)
    {
        if ($dl instanceof XMLSecurityKey) {
            goto wO;
        }
        throw new Exception("\111\156\166\x61\154\x69\144\x20\113\145\171");
        wO:
        $Bg = $this->getCipherValue();
        if ($Bg) {
            goto Nq;
        }
        throw new Exception("\x43\141\x6e\156\157\164\40\154\157\x63\141\164\145\40\x65\x6e\x63\x72\x79\160\x74\145\144\40\144\x61\164\x61");
        goto LB;
        Nq:
        $mK = $dl->decryptData($Bg);
        if ($bQ) {
            goto B9;
        }
        return $mK;
        goto q2;
        B9:
        switch ($this->type) {
            case self::Element:
                $Fs = new DOMDocument();
                $Fs->loadXML($mK);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto UB;
                }
                return $Fs;
                UB:
                $yE = $this->rawNode->ownerDocument->importNode($Fs->documentElement, true);
                $this->rawNode->parentNode->replaceChild($yE, $this->rawNode);
                return $yE;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto oW;
                }
                $Ij = $this->rawNode->ownerDocument;
                goto Ji;
                oW:
                $Ij = $this->rawNode;
                Ji:
                $JW = $Ij->createDocumentFragment();
                $JW->appendXML($mK);
                $mP = $this->rawNode->parentNode;
                $mP->replaceChild($JW, $this->rawNode);
                return $mP;
            default:
                return $mK;
        }
        oa:
        OJ:
        q2:
        LB:
    }
    public function encryptKey($oe, $s2, $ss = true)
    {
        if (!(!$oe instanceof XMLSecurityKey || !$s2 instanceof XMLSecurityKey)) {
            goto Hn;
        }
        throw new Exception("\111\x6e\x76\141\154\x69\144\40\113\x65\x79");
        Hn:
        $bV = base64_encode($oe->encryptData($s2->key));
        $P2 = $this->encdoc->documentElement;
        $d3 = $this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\x63\x3a\x45\x6e\x63\x72\x79\160\x74\x65\144\113\145\171");
        if ($ss) {
            goto Gb;
        }
        $this->encKey = $d3;
        goto KH;
        Gb:
        $rc = $P2->insertBefore($this->encdoc->createElementNS("\150\x74\164\160\x3a\x2f\57\x77\x77\x77\x2e\x77\x33\56\x6f\x72\x67\x2f\x32\60\x30\x30\57\x30\x39\x2f\x78\x6d\154\144\163\x69\147\43", "\x64\x73\151\x67\72\x4b\x65\x79\x49\156\x66\157"), $P2->firstChild);
        $rc->appendChild($d3);
        KH:
        $tK = $d3->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\72\x45\156\x63\162\171\160\x74\151\157\156\x4d\145\164\150\157\144"));
        $tK->setAttribute("\101\x6c\x67\x6f\x72\x69\164\x68\x6d", $oe->getAlgorithm());
        if (empty($oe->name)) {
            goto cx;
        }
        $rc = $d3->appendChild($this->encdoc->createElementNS("\150\x74\164\x70\72\x2f\x2f\x77\167\167\x2e\x77\63\x2e\x6f\x72\147\57\x32\60\x30\x30\x2f\x30\71\57\x78\x6d\x6c\144\163\x69\x67\x23", "\144\163\151\x67\72\113\x65\x79\x49\156\146\x6f"));
        $rc->appendChild($this->encdoc->createElementNS("\150\164\x74\160\x3a\x2f\x2f\x77\167\167\x2e\x77\63\56\157\162\147\x2f\x32\x30\60\x30\57\60\71\57\x78\155\154\x64\x73\151\147\x23", "\144\x73\151\147\x3a\x4b\x65\171\116\141\155\x65", $oe->name));
        cx:
        $w7 = $d3->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\x63\x3a\x43\151\160\150\145\162\x44\x61\x74\x61"));
        $w7->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\156\143\72\x43\151\160\x68\x65\x72\x56\x61\x6c\165\145", $bV));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto Y8;
        }
        $M1 = $d3->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\x63\x3a\x52\x65\146\x65\x72\145\156\143\x65\x4c\x69\163\164"));
        foreach ($this->references as $oR => $Ar) {
            $Vk = $Ar["\x72\x65\x66\165\x72\x69"];
            $pQ = $M1->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\x3a\x44\141\x74\x61\122\x65\146\145\x72\145\x6e\143\145"));
            $pQ->setAttribute("\x55\x52\x49", "\x23" . $Vk);
            GM:
        }
        K2:
        Y8:
        return;
    }
    public function decryptKey($d3)
    {
        if ($d3->isEncrypted) {
            goto Uu;
        }
        throw new Exception("\113\x65\x79\x20\151\x73\40\156\x6f\164\x20\105\x6e\143\x72\x79\160\x74\x65\x64");
        Uu:
        if (!empty($d3->key)) {
            goto Ov;
        }
        throw new Exception("\113\x65\171\x20\x69\x73\40\x6d\151\163\x73\151\156\147\x20\144\x61\164\141\x20\164\157\40\160\145\162\146\157\x72\x6d\40\x74\150\x65\40\144\145\143\162\x79\x70\164\151\157\x6e");
        Ov:
        return $this->decryptNode($d3, false);
    }
    public function locateEncryptedData($GH)
    {
        if ($GH instanceof DOMDocument) {
            goto T4;
        }
        $Ij = $GH->ownerDocument;
        goto Ii;
        T4:
        $Ij = $GH;
        Ii:
        if (!$Ij) {
            goto wU;
        }
        $Xj = new DOMXPath($Ij);
        $U3 = "\x2f\57\x2a\133\x6c\x6f\x63\x61\x6c\55\156\x61\x6d\145\50\x29\75\47\x45\x6e\x63\x72\171\160\x74\145\x64\x44\x61\164\141\47\x20\141\x6e\x64\40\156\141\155\x65\x73\160\141\x63\x65\55\x75\162\151\x28\x29\x3d\47" . self::XMLENCNS . "\x27\135";
        $f9 = $Xj->query($U3);
        return $f9->item(0);
        wU:
        return null;
    }
    public function locateKey($fz = null)
    {
        if (!empty($fz)) {
            goto w9;
        }
        $fz = $this->rawNode;
        w9:
        if ($fz instanceof DOMNode) {
            goto hj;
        }
        return null;
        hj:
        if (!($Ij = $fz->ownerDocument)) {
            goto ry;
        }
        $Xj = new DOMXPath($Ij);
        $Xj->registerNamespace("\x78\155\x6c\x73\145\143\145\156\x63", self::XMLENCNS);
        $U3 = "\56\57\x2f\x78\155\x6c\163\x65\143\x65\x6e\x63\x3a\105\x6e\x63\162\171\x70\x74\151\x6f\x6e\115\145\x74\150\x6f\144";
        $f9 = $Xj->query($U3, $fz);
        if (!($l1 = $f9->item(0))) {
            goto nW;
        }
        $dv = $l1->getAttribute("\x41\x6c\x67\x6f\x72\x69\164\x68\x6d");
        try {
            $dl = new XMLSecurityKey($dv, array("\164\x79\160\145" => "\160\162\x69\x76\141\164\x65"));
        } catch (Exception $R8) {
            return null;
        }
        return $dl;
        nW:
        ry:
        return null;
    }
    public static function staticLocateKeyInfo($l3 = null, $fz = null)
    {
        if (!(empty($fz) || !$fz instanceof DOMNode)) {
            goto NB;
        }
        return null;
        NB:
        $Ij = $fz->ownerDocument;
        if ($Ij) {
            goto NV;
        }
        return null;
        NV:
        $Xj = new DOMXPath($Ij);
        $Xj->registerNamespace("\170\155\x6c\163\145\143\145\x6e\143", self::XMLENCNS);
        $Xj->registerNamespace("\x78\155\x6c\x73\x65\143\144\163\151\x67", XMLSecurityDSig::XMLDSIGNS);
        $U3 = "\56\57\170\155\x6c\163\145\x63\144\x73\x69\x67\72\113\x65\171\x49\x6e\x66\157";
        $f9 = $Xj->query($U3, $fz);
        $l1 = $f9->item(0);
        if ($l1) {
            goto Y0;
        }
        return $l3;
        Y0:
        foreach ($l1->childNodes as $Ra) {
            switch ($Ra->localName) {
                case "\x4b\145\x79\116\x61\155\145":
                    if (empty($l3)) {
                        goto s3;
                    }
                    $l3->name = $Ra->nodeValue;
                    s3:
                    goto aK;
                case "\x4b\145\171\x56\141\154\165\145":
                    foreach ($Ra->childNodes as $in) {
                        switch ($in->localName) {
                            case "\104\123\x41\113\145\171\x56\141\x6c\165\145":
                                throw new Exception("\104\x53\101\113\145\x79\x56\141\x6c\x75\x65\x20\x63\165\162\162\x65\x6e\x74\x6c\x79\40\156\157\164\40\x73\x75\x70\x70\157\162\164\145\144");
                            case "\122\123\101\113\145\171\126\x61\154\165\145":
                                $Gh = null;
                                $g1 = null;
                                if (!($Mm = $in->getElementsByTagName("\115\157\x64\x75\154\165\x73")->item(0))) {
                                    goto pS;
                                }
                                $Gh = base64_decode($Mm->nodeValue);
                                pS:
                                if (!($ZB = $in->getElementsByTagName("\105\170\x70\x6f\x6e\x65\156\164")->item(0))) {
                                    goto D9;
                                }
                                $g1 = base64_decode($ZB->nodeValue);
                                D9:
                                if (!(empty($Gh) || empty($g1))) {
                                    goto gk;
                                }
                                throw new Exception("\115\x69\x73\x73\151\156\x67\x20\x4d\x6f\144\x75\154\165\x73\x20\x6f\162\x20\105\x78\x70\157\x6e\145\156\164");
                                gk:
                                $Wo = XMLSecurityKey::convertRSA($Gh, $g1);
                                $l3->loadKey($Wo);
                                goto SK;
                        }
                        Pz:
                        SK:
                        EW:
                    }
                    FM:
                    goto aK;
                case "\x52\145\x74\162\x69\x65\x76\141\x6c\115\x65\164\x68\x6f\x64":
                    $n3 = $Ra->getAttribute("\124\x79\x70\145");
                    if (!($n3 !== "\150\x74\164\160\72\57\57\167\x77\167\x2e\x77\63\x2e\x6f\x72\x67\x2f\62\60\60\x31\57\60\64\57\170\x6d\154\145\156\143\43\105\156\143\162\171\x70\164\x65\x64\x4b\145\x79")) {
                        goto Z2;
                    }
                    goto aK;
                    Z2:
                    $oO = $Ra->getAttribute("\125\x52\x49");
                    if (!($oO[0] !== "\43")) {
                        goto uC;
                    }
                    goto aK;
                    uC:
                    $KG = substr($oO, 1);
                    $U3 = "\57\x2f\170\x6d\x6c\x73\145\143\x65\156\x63\72\105\156\x63\162\171\160\164\x65\x64\113\x65\171\x5b\100\x49\144\x3d\x27{$KG}\x27\135";
                    $hU = $Xj->query($U3)->item(0);
                    if ($hU) {
                        goto GZ;
                    }
                    throw new Exception("\x55\156\141\142\154\145\x20\164\x6f\x20\x6c\157\x63\141\x74\145\x20\105\156\x63\162\x79\160\x74\x65\x64\x4b\145\x79\x20\x77\151\164\x68\x20\x40\x49\x64\75\x27{$KG}\x27\56");
                    GZ:
                    return XMLSecurityKey::fromEncryptedKeyElement($hU);
                case "\105\156\143\x72\171\160\164\x65\144\x4b\145\171":
                    return XMLSecurityKey::fromEncryptedKeyElement($Ra);
                case "\x58\65\x30\x39\104\141\x74\x61":
                    if (!($Hx = $Ra->getElementsByTagName("\x58\x35\x30\71\103\145\162\x74\151\x66\x69\x63\x61\164\145"))) {
                        goto NU;
                    }
                    if (!($Hx->length > 0)) {
                        goto mP;
                    }
                    $s4 = $Hx->item(0)->textContent;
                    $s4 = str_replace(array("\xd", "\xa", "\x20"), '', $s4);
                    $s4 = "\x2d\55\x2d\55\x2d\x42\105\107\x49\x4e\x20\x43\105\122\124\111\106\x49\103\x41\x54\105\55\55\55\x2d\x2d\12" . chunk_split($s4, 64, "\xa") . "\x2d\x2d\x2d\55\55\x45\x4e\x44\40\x43\105\122\x54\111\x46\x49\103\101\124\105\55\55\x2d\55\x2d\xa";
                    $l3->loadKey($s4, false, true);
                    mP:
                    NU:
                    goto aK;
            }
            UK:
            aK:
            fu:
        }
        Tc:
        return $l3;
    }
    public function locateKeyInfo($l3 = null, $fz = null)
    {
        if (!empty($fz)) {
            goto I5;
        }
        $fz = $this->rawNode;
        I5:
        return self::staticLocateKeyInfo($l3, $fz);
    }
}
