<?php


class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\x68\x74\164\x70\x3a\x2f\x2f\x77\167\167\x2e\167\63\x2e\x6f\x72\x67\57\x32\60\60\x31\x2f\60\x34\57\170\x6d\154\145\x6e\143\x23\164\162\151\x70\x6c\x65\x64\x65\163\55\x63\142\x63";
    const AES128_CBC = "\150\x74\x74\x70\72\x2f\57\167\x77\167\56\167\x33\x2e\157\162\x67\x2f\x32\60\x30\x31\57\x30\x34\x2f\170\x6d\x6c\x65\156\143\43\x61\x65\x73\61\x32\70\55\143\x62\x63";
    const AES192_CBC = "\150\x74\164\160\72\57\57\167\167\167\x2e\x77\63\56\x6f\x72\x67\x2f\62\60\x30\x31\x2f\x30\x34\x2f\170\x6d\x6c\x65\x6e\143\x23\141\x65\163\x31\71\62\x2d\143\x62\x63";
    const AES256_CBC = "\150\164\x74\160\72\x2f\x2f\x77\167\167\56\167\x33\x2e\x6f\x72\147\57\x32\x30\x30\61\57\60\64\x2f\170\155\x6c\145\x6e\143\x23\x61\x65\x73\x32\65\x36\x2d\x63\x62\143";
    const RSA_1_5 = "\x68\164\x74\x70\x3a\57\57\x77\167\x77\56\x77\63\x2e\157\x72\x67\x2f\x32\x30\x30\x31\x2f\60\64\x2f\170\155\154\x65\x6e\143\43\162\x73\x61\55\x31\x5f\x35";
    const RSA_OAEP_MGF1P = "\150\164\x74\160\x3a\57\x2f\167\167\x77\56\x77\x33\56\x6f\162\147\57\62\x30\60\x31\x2f\x30\64\57\x78\x6d\x6c\145\156\x63\x23\x72\x73\141\55\157\141\145\160\55\155\x67\x66\61\x70";
    const DSA_SHA1 = "\150\x74\x74\160\72\x2f\57\167\x77\167\x2e\167\x33\x2e\x6f\162\147\x2f\62\x30\60\60\x2f\x30\x39\57\x78\x6d\154\x64\163\x69\147\43\144\163\x61\x2d\163\150\141\61";
    const RSA_SHA1 = "\150\x74\164\160\x3a\57\x2f\x77\167\167\x2e\x77\x33\56\x6f\x72\147\57\62\x30\x30\60\57\x30\x39\x2f\x78\155\x6c\144\x73\x69\147\43\162\163\141\55\163\150\x61\61";
    const RSA_SHA256 = "\150\x74\x74\160\x3a\x2f\57\x77\x77\x77\x2e\x77\63\56\x6f\x72\x67\57\62\60\60\x31\x2f\x30\64\x2f\x78\155\x6c\x64\x73\x69\x67\x2d\x6d\x6f\x72\145\43\x72\163\141\x2d\163\150\141\x32\65\x36";
    const RSA_SHA384 = "\x68\x74\x74\x70\x3a\57\57\167\167\167\x2e\x77\x33\56\157\162\147\57\x32\60\60\61\x2f\60\x34\x2f\x78\x6d\154\144\x73\x69\x67\55\x6d\157\x72\x65\x23\x72\163\141\x2d\x73\x68\141\x33\x38\64";
    const RSA_SHA512 = "\150\x74\164\160\72\57\57\x77\x77\167\56\167\x33\x2e\x6f\x72\x67\x2f\x32\60\60\x31\x2f\60\64\x2f\170\x6d\154\144\163\x69\x67\x2d\x6d\157\162\145\x23\x72\x73\x61\55\163\150\x61\65\61\62";
    const HMAC_SHA1 = "\150\x74\164\160\x3a\x2f\x2f\x77\167\167\56\167\63\x2e\x6f\x72\x67\x2f\62\x30\x30\60\x2f\x30\x39\x2f\170\x6d\x6c\x64\163\151\x67\x23\x68\155\x61\143\55\x73\x68\x61\x31";
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
    public function __construct($fd, $UC = null)
    {
        switch ($fd) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\x6c\x69\142\x72\x61\162\x79"] = "\157\x70\x65\x6e\163\163\154";
                $this->cryptParams["\143\x69\160\150\x65\x72"] = "\x64\x65\163\x2d\x65\144\145\x33\x2d\143\142\x63";
                $this->cryptParams["\164\x79\x70\145"] = "\x73\x79\x6d\x6d\145\x74\x72\x69\x63";
                $this->cryptParams["\155\145\164\x68\x6f\x64"] = "\x68\x74\164\x70\x3a\57\57\167\167\167\56\x77\63\56\157\x72\147\57\62\60\x30\x31\57\x30\64\x2f\x78\155\x6c\x65\x6e\x63\x23\x74\162\x69\160\154\145\x64\145\x73\x2d\x63\x62\143";
                $this->cryptParams["\153\145\171\163\151\172\x65"] = 24;
                $this->cryptParams["\x62\x6c\157\143\x6b\x73\151\x7a\145"] = 8;
                goto Ip;
            case self::AES128_CBC:
                $this->cryptParams["\x6c\151\x62\162\x61\162\x79"] = "\x6f\x70\145\156\163\163\154";
                $this->cryptParams["\x63\151\x70\150\x65\162"] = "\141\x65\x73\x2d\61\62\70\x2d\143\x62\x63";
                $this->cryptParams["\164\x79\160\145"] = "\x73\x79\155\155\x65\164\162\151\x63";
                $this->cryptParams["\155\145\x74\150\157\x64"] = "\150\x74\164\160\x3a\57\57\x77\167\167\x2e\x77\63\x2e\x6f\x72\147\x2f\x32\60\60\61\x2f\60\64\57\170\x6d\x6c\x65\156\143\x23\x61\x65\x73\61\62\70\x2d\x63\142\x63";
                $this->cryptParams["\x6b\x65\x79\163\x69\x7a\145"] = 16;
                $this->cryptParams["\142\154\x6f\x63\x6b\x73\151\x7a\x65"] = 16;
                goto Ip;
            case self::AES192_CBC:
                $this->cryptParams["\154\x69\x62\x72\141\x72\171"] = "\x6f\x70\145\x6e\x73\163\154";
                $this->cryptParams["\143\x69\x70\150\145\x72"] = "\x61\x65\163\x2d\61\71\62\x2d\143\x62\x63";
                $this->cryptParams["\164\x79\160\145"] = "\163\x79\155\x6d\x65\x74\x72\151\143";
                $this->cryptParams["\155\145\164\x68\157\x64"] = "\x68\x74\164\160\72\x2f\x2f\x77\x77\167\x2e\x77\63\56\157\162\x67\x2f\x32\x30\60\x31\57\x30\64\x2f\170\155\154\145\156\x63\43\141\145\163\61\71\62\55\x63\142\x63";
                $this->cryptParams["\x6b\x65\x79\x73\x69\172\x65"] = 24;
                $this->cryptParams["\x62\154\157\143\x6b\163\x69\172\x65"] = 16;
                goto Ip;
            case self::AES256_CBC:
                $this->cryptParams["\x6c\151\x62\162\x61\162\171"] = "\157\160\145\x6e\163\163\x6c";
                $this->cryptParams["\x63\x69\x70\150\x65\x72"] = "\x61\x65\163\x2d\62\x35\66\55\143\142\x63";
                $this->cryptParams["\x74\x79\x70\x65"] = "\x73\171\x6d\x6d\145\x74\162\151\143";
                $this->cryptParams["\x6d\145\x74\x68\157\144"] = "\150\x74\x74\160\72\57\57\167\167\x77\x2e\167\63\x2e\x6f\162\x67\x2f\62\x30\x30\x31\57\60\64\x2f\x78\155\154\x65\x6e\x63\43\141\145\x73\62\x35\x36\55\143\142\x63";
                $this->cryptParams["\x6b\x65\x79\163\x69\x7a\x65"] = 32;
                $this->cryptParams["\142\154\x6f\143\x6b\x73\151\x7a\x65"] = 16;
                goto Ip;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\151\142\162\x61\x72\x79"] = "\157\x70\145\156\x73\x73\154";
                $this->cryptParams["\160\x61\144\144\151\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x6d\145\x74\150\x6f\x64"] = "\150\164\x74\x70\72\57\57\167\167\167\56\x77\x33\56\x6f\162\147\57\x32\60\x30\61\x2f\60\64\57\170\155\x6c\x65\156\143\43\162\163\x61\x2d\x31\x5f\65";
                if (!(is_array($UC) && !empty($UC["\x74\171\x70\145"]))) {
                    goto JF;
                }
                if (!($UC["\164\171\160\x65"] == "\160\x75\142\154\x69\143" || $UC["\x74\171\x70\145"] == "\x70\x72\151\166\141\164\x65")) {
                    goto yo;
                }
                $this->cryptParams["\x74\x79\160\145"] = $UC["\x74\x79\x70\x65"];
                goto Ip;
                yo:
                JF:
                throw new Exception("\x43\145\x72\x74\151\146\x69\143\x61\x74\x65\40\42\164\171\160\145\x22\x20\50\160\162\x69\x76\x61\164\145\x2f\x70\165\142\x6c\151\x63\x29\40\x6d\165\163\x74\40\x62\145\40\160\141\x73\x73\x65\x64\x20\166\151\141\40\160\141\162\x61\155\145\164\145\162\163");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\154\x69\142\162\x61\162\x79"] = "\x6f\x70\145\156\x73\x73\154";
                $this->cryptParams["\160\x61\144\144\151\156\147"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\x6d\x65\164\150\x6f\144"] = "\150\164\x74\x70\72\x2f\x2f\x77\x77\x77\x2e\x77\x33\56\x6f\162\x67\57\62\x30\60\x31\57\60\64\57\x78\x6d\x6c\145\x6e\x63\x23\162\163\141\x2d\x6f\141\x65\160\55\x6d\147\146\x31\x70";
                $this->cryptParams["\x68\x61\163\150"] = null;
                if (!(is_array($UC) && !empty($UC["\164\171\x70\145"]))) {
                    goto VW;
                }
                if (!($UC["\x74\171\x70\145"] == "\x70\x75\142\x6c\x69\x63" || $UC["\164\x79\x70\145"] == "\160\x72\x69\x76\141\164\x65")) {
                    goto Xj;
                }
                $this->cryptParams["\164\171\x70\x65"] = $UC["\x74\x79\x70\x65"];
                goto Ip;
                Xj:
                VW:
                throw new Exception("\103\x65\x72\164\151\x66\x69\143\x61\164\145\40\42\x74\x79\160\x65\42\x20\x28\160\x72\151\166\141\x74\145\57\160\165\142\x6c\x69\143\x29\x20\x6d\165\x73\x74\x20\142\x65\40\x70\x61\163\163\145\x64\40\x76\151\141\x20\160\x61\162\141\x6d\x65\x74\x65\162\x73");
            case self::RSA_SHA1:
                $this->cryptParams["\154\x69\x62\x72\141\162\171"] = "\x6f\160\x65\156\163\163\154";
                $this->cryptParams["\x6d\x65\x74\x68\x6f\x64"] = "\150\x74\164\x70\x3a\57\x2f\167\x77\x77\x2e\x77\x33\x2e\x6f\x72\147\57\x32\x30\x30\60\x2f\x30\x39\57\170\x6d\x6c\x64\x73\x69\x67\x23\162\x73\141\55\163\150\x61\61";
                $this->cryptParams["\x70\x61\x64\x64\x69\x6e\x67"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($UC) && !empty($UC["\164\x79\x70\145"]))) {
                    goto uU;
                }
                if (!($UC["\x74\x79\x70\x65"] == "\x70\165\142\154\x69\x63" || $UC["\x74\x79\x70\145"] == "\160\162\x69\x76\x61\164\x65")) {
                    goto hs;
                }
                $this->cryptParams["\x74\x79\160\145"] = $UC["\x74\x79\x70\x65"];
                goto Ip;
                hs:
                uU:
                throw new Exception("\x43\x65\x72\x74\x69\146\151\x63\141\x74\145\x20\42\x74\171\x70\x65\42\40\x28\160\162\x69\x76\141\x74\x65\x2f\x70\165\142\154\151\x63\x29\x20\155\165\x73\x74\40\142\x65\40\160\x61\x73\x73\145\x64\40\x76\151\141\x20\160\x61\x72\x61\x6d\145\164\145\162\x73");
            case self::RSA_SHA256:
                $this->cryptParams["\x6c\151\x62\162\141\162\171"] = "\157\160\x65\156\163\x73\154";
                $this->cryptParams["\155\x65\x74\x68\x6f\144"] = "\x68\x74\164\x70\72\57\x2f\167\x77\167\x2e\x77\63\x2e\x6f\x72\x67\57\62\x30\x30\61\57\x30\x34\x2f\170\x6d\154\x64\x73\x69\x67\x2d\155\157\x72\145\x23\162\163\141\x2d\163\150\141\62\x35\66";
                $this->cryptParams["\160\x61\x64\x64\151\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\151\x67\145\163\164"] = "\123\110\x41\62\65\66";
                if (!(is_array($UC) && !empty($UC["\164\x79\160\145"]))) {
                    goto TH;
                }
                if (!($UC["\164\171\x70\x65"] == "\x70\165\142\154\x69\x63" || $UC["\164\171\x70\145"] == "\x70\162\x69\x76\x61\164\x65")) {
                    goto v1;
                }
                $this->cryptParams["\x74\171\160\145"] = $UC["\x74\x79\160\x65"];
                goto Ip;
                v1:
                TH:
                throw new Exception("\103\x65\x72\164\x69\x66\151\x63\x61\x74\x65\x20\x22\x74\171\x70\145\42\x20\x28\x70\162\151\166\x61\x74\145\x2f\160\x75\142\154\x69\x63\51\x20\x6d\165\x73\x74\x20\142\x65\40\x70\x61\163\x73\145\144\x20\166\x69\141\40\x70\141\x72\141\155\x65\x74\145\162\x73");
            case self::RSA_SHA384:
                $this->cryptParams["\x6c\151\x62\162\x61\x72\x79"] = "\157\x70\x65\x6e\163\163\154";
                $this->cryptParams["\x6d\x65\x74\x68\157\144"] = "\150\x74\x74\160\x3a\57\x2f\167\x77\167\56\x77\63\x2e\157\162\147\57\x32\60\60\x31\57\60\x34\57\170\155\154\144\x73\151\x67\x2d\x6d\x6f\x72\145\43\162\163\x61\x2d\x73\150\x61\63\x38\64";
                $this->cryptParams["\x70\141\144\144\151\x6e\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\151\x67\x65\x73\164"] = "\123\x48\101\63\70\64";
                if (!(is_array($UC) && !empty($UC["\x74\x79\160\x65"]))) {
                    goto Tu;
                }
                if (!($UC["\x74\171\160\x65"] == "\x70\165\142\x6c\151\143" || $UC["\x74\171\x70\145"] == "\160\x72\151\166\x61\x74\x65")) {
                    goto ex;
                }
                $this->cryptParams["\164\x79\160\145"] = $UC["\164\x79\160\x65"];
                goto Ip;
                ex:
                Tu:
                throw new Exception("\x43\145\x72\x74\151\x66\x69\x63\x61\164\x65\40\42\164\171\160\145\x22\40\50\x70\x72\x69\166\x61\x74\145\57\160\x75\142\154\151\143\51\x20\155\165\163\x74\x20\142\x65\40\160\141\163\x73\145\x64\40\166\151\x61\x20\160\x61\162\141\x6d\145\164\x65\162\x73");
            case self::RSA_SHA512:
                $this->cryptParams["\x6c\x69\x62\x72\x61\162\171"] = "\x6f\x70\x65\x6e\163\x73\154";
                $this->cryptParams["\x6d\x65\164\x68\x6f\x64"] = "\150\164\x74\160\x3a\57\x2f\x77\x77\167\x2e\167\x33\56\157\x72\147\57\62\x30\60\61\x2f\60\x34\x2f\x78\x6d\x6c\x64\x73\151\147\55\x6d\x6f\162\x65\43\x72\163\141\55\x73\150\141\65\x31\x32";
                $this->cryptParams["\160\141\144\144\151\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\x67\145\163\164"] = "\x53\110\x41\65\x31\62";
                if (!(is_array($UC) && !empty($UC["\x74\171\160\x65"]))) {
                    goto LG;
                }
                if (!($UC["\x74\x79\160\x65"] == "\160\x75\142\154\151\x63" || $UC["\164\x79\160\145"] == "\160\162\151\x76\x61\164\x65")) {
                    goto H7;
                }
                $this->cryptParams["\x74\171\160\145"] = $UC["\x74\x79\x70\145"];
                goto Ip;
                H7:
                LG:
                throw new Exception("\x43\x65\162\x74\151\x66\151\143\141\164\x65\40\x22\164\x79\x70\145\x22\x20\x28\160\162\151\x76\x61\x74\145\x2f\x70\x75\142\154\x69\143\x29\40\155\x75\163\164\40\x62\145\40\x70\141\163\163\x65\144\x20\166\151\x61\x20\x70\x61\162\x61\x6d\145\164\145\162\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\x6c\151\142\x72\141\162\x79"] = $fd;
                $this->cryptParams["\155\145\x74\150\x6f\144"] = "\150\164\164\x70\72\x2f\57\x77\167\x77\56\167\x33\x2e\x6f\x72\x67\57\x32\60\60\60\57\60\x39\57\170\155\x6c\x64\163\x69\147\x23\150\155\x61\143\x2d\163\150\141\61";
                goto Ip;
            default:
                throw new Exception("\x49\x6e\x76\x61\154\151\144\40\113\145\x79\x20\124\171\x70\145");
        }
        Uw:
        Ip:
        $this->type = $fd;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\153\x65\171\x73\151\172\145"])) {
            goto F1;
        }
        return null;
        F1:
        return $this->cryptParams["\x6b\145\171\163\x69\x7a\x65"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\153\145\171\x73\151\172\x65"])) {
            goto cB;
        }
        throw new Exception("\125\156\153\x6e\157\167\x6e\x20\x6b\x65\171\x20\x73\151\172\145\x20\146\157\x72\x20\164\x79\x70\x65\x20\x22" . $this->type . "\x22\x2e");
        cB:
        $QB = $this->cryptParams["\153\x65\x79\x73\x69\x7a\145"];
        $qT = openssl_random_pseudo_bytes($QB);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto fW;
        }
        $zj = 0;
        Ld:
        if (!($zj < strlen($qT))) {
            goto ig;
        }
        $az = ord($qT[$zj]) & 254;
        $pp = 1;
        $wD = 1;
        rY:
        if (!($wD < 8)) {
            goto aF;
        }
        $pp ^= $az >> $wD & 1;
        P3:
        $wD++;
        goto rY;
        aF:
        $az |= $pp;
        $qT[$zj] = chr($az);
        b0:
        $zj++;
        goto Ld;
        ig:
        fW:
        $this->key = $qT;
        return $qT;
    }
    public static function getRawThumbprint($nd)
    {
        $jE = explode("\xa", $nd);
        $eY = '';
        $i_ = false;
        foreach ($jE as $IQ) {
            if (!$i_) {
                goto Qu;
            }
            if (!(strncmp($IQ, "\55\x2d\55\55\x2d\x45\116\x44\x20\103\105\122\x54\x49\x46\111\103\x41\x54\x45", 20) == 0)) {
                goto Mr;
            }
            goto bi;
            Mr:
            $eY .= trim($IQ);
            goto cY;
            Qu:
            if (!(strncmp($IQ, "\55\55\55\55\55\x42\x45\107\x49\x4e\x20\x43\105\122\x54\x49\x46\111\x43\101\x54\105", 22) == 0)) {
                goto wJ;
            }
            $i_ = true;
            wJ:
            cY:
            is:
        }
        bi:
        if (empty($eY)) {
            goto El;
        }
        return strtolower(sha1(base64_decode($eY)));
        El:
        return null;
    }
    public function loadKey($qT, $oh = false, $wE = false)
    {
        if ($oh) {
            goto Ug;
        }
        $this->key = $qT;
        goto S4;
        Ug:
        $this->key = file_get_contents($qT);
        S4:
        if ($wE) {
            goto mD;
        }
        $this->x509Certificate = null;
        goto rZ;
        mD:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $hf);
        $this->x509Certificate = $hf;
        $this->key = $hf;
        rZ:
        if (!($this->cryptParams["\154\x69\x62\162\141\x72\x79"] == "\157\x70\145\x6e\163\x73\154")) {
            goto wZ;
        }
        switch ($this->cryptParams["\164\171\x70\145"]) {
            case "\x70\x75\142\x6c\151\143":
                if (!$wE) {
                    goto aj;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                aj:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto eB;
                }
                throw new Exception("\125\x6e\x61\142\x6c\x65\x20\x74\157\40\145\170\164\x72\x61\x63\x74\40\160\165\x62\x6c\x69\143\40\x6b\145\x79");
                eB:
                goto BR;
            case "\160\162\x69\166\x61\x74\145":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto BR;
            case "\163\171\x6d\x6d\x65\x74\x72\x69\143":
                if (!(strlen($this->key) < $this->cryptParams["\153\x65\171\x73\x69\172\145"])) {
                    goto WK;
                }
                throw new Exception("\x4b\145\171\40\155\165\x73\x74\40\x63\157\x6e\164\x61\151\x6e\40\x61\164\40\x6c\145\141\163\164\40\62\x35\40\x63\150\x61\x72\x61\143\164\145\162\x73\x20\x66\x6f\162\40\x74\150\151\163\40\143\x69\160\x68\x65\162");
                WK:
                goto BR;
            default:
                throw new Exception("\125\x6e\153\156\157\167\x6e\40\x74\x79\x70\145");
        }
        cS:
        BR:
        wZ:
    }
    private function padISO10126($eY, $re)
    {
        if (!($re > 256)) {
            goto gB;
        }
        throw new Exception("\102\x6c\157\143\x6b\x20\x73\x69\172\145\40\x68\151\147\150\145\x72\40\164\x68\141\156\x20\x32\x35\x36\x20\x6e\157\x74\40\141\x6c\x6c\x6f\x77\145\144");
        gB:
        $PI = $re - strlen($eY) % $re;
        $iV = chr($PI);
        return $eY . str_repeat($iV, $PI);
    }
    private function unpadISO10126($eY)
    {
        $PI = substr($eY, -1);
        $iM = ord($PI);
        return substr($eY, 0, -$iM);
    }
    private function encryptSymmetric($eY)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\x63\151\x70\x68\145\162"]));
        $eY = $this->padISO10126($eY, $this->cryptParams["\142\154\157\x63\153\163\x69\x7a\x65"]);
        $x4 = openssl_encrypt($eY, $this->cryptParams["\143\151\160\150\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $x4)) {
            goto Zy;
        }
        throw new Exception("\106\x61\x69\154\x75\162\x65\x20\x65\x6e\x63\x72\171\160\164\x69\x6e\147\40\x44\141\x74\141\40\50\x6f\x70\x65\x6e\163\163\154\x20\163\171\x6d\x6d\x65\164\162\x69\x63\51\40\x2d\x20" . openssl_error_string());
        Zy:
        return $this->iv . $x4;
    }
    private function decryptSymmetric($eY)
    {
        $vo = openssl_cipher_iv_length($this->cryptParams["\x63\x69\160\150\x65\162"]);
        $this->iv = substr($eY, 0, $vo);
        $eY = substr($eY, $vo);
        $ix = openssl_decrypt($eY, $this->cryptParams["\x63\x69\160\x68\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $ix)) {
            goto fM;
        }
        throw new Exception("\x46\x61\151\154\165\162\145\x20\x64\x65\x63\162\x79\160\x74\151\x6e\x67\x20\104\x61\164\141\x20\x28\x6f\160\x65\156\163\x73\x6c\40\163\x79\x6d\155\145\x74\162\151\143\51\x20\55\40" . openssl_error_string());
        fM:
        return $this->unpadISO10126($ix);
    }
    private function encryptPublic($eY)
    {
        if (openssl_public_encrypt($eY, $x4, $this->key, $this->cryptParams["\x70\141\x64\144\151\x6e\x67"])) {
            goto rP;
        }
        throw new Exception("\106\x61\151\x6c\x75\162\145\x20\x65\x6e\143\x72\171\x70\164\x69\156\x67\x20\104\141\x74\141\40\x28\x6f\x70\x65\156\163\x73\x6c\40\x70\x75\142\154\x69\x63\x29\x20\x2d\x20" . openssl_error_string());
        rP:
        return $x4;
    }
    private function decryptPublic($eY)
    {
        if (openssl_public_decrypt($eY, $ix, $this->key, $this->cryptParams["\x70\141\144\x64\151\x6e\147"])) {
            goto bY;
        }
        throw new Exception("\106\141\x69\154\x75\162\145\40\144\x65\143\162\x79\x70\x74\x69\156\147\40\104\x61\164\141\x20\50\x6f\x70\x65\156\x73\163\x6c\40\x70\x75\142\154\151\143\51\x20\55\x20" . openssl_error_string);
        bY:
        return $ix;
    }
    private function encryptPrivate($eY)
    {
        if (openssl_private_encrypt($eY, $x4, $this->key, $this->cryptParams["\160\141\144\x64\151\156\147"])) {
            goto Yw;
        }
        throw new Exception("\x46\x61\151\154\x75\x72\145\40\145\156\x63\x72\x79\x70\x74\151\x6e\x67\40\104\141\164\x61\x20\x28\x6f\160\x65\x6e\x73\x73\x6c\x20\x70\162\x69\x76\x61\164\x65\51\x20\x2d\x20" . openssl_error_string());
        Yw:
        return $x4;
    }
    private function decryptPrivate($eY)
    {
        if (openssl_private_decrypt($eY, $ix, $this->key, $this->cryptParams["\160\141\x64\144\151\x6e\147"])) {
            goto xD;
        }
        throw new Exception("\106\x61\151\154\x75\x72\x65\x20\144\145\143\x72\171\x70\x74\x69\156\147\40\x44\x61\x74\141\x20\x28\x6f\x70\x65\x6e\163\163\154\40\x70\x72\x69\x76\141\164\145\51\x20\55\x20" . openssl_error_string);
        xD:
        return $ix;
    }
    private function signOpenSSL($eY)
    {
        $t5 = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\x67\x65\163\x74"])) {
            goto le;
        }
        $t5 = $this->cryptParams["\x64\x69\x67\x65\163\x74"];
        le:
        if (openssl_sign($eY, $ur, $this->key, $t5)) {
            goto DU;
        }
        throw new Exception("\106\x61\x69\154\165\x72\145\40\x53\x69\147\156\x69\156\147\x20\x44\141\164\x61\72\x20" . openssl_error_string() . "\x20\x2d\40" . $t5);
        DU:
        return $ur;
    }
    private function verifyOpenSSL($eY, $ur)
    {
        $t5 = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\x67\x65\163\164"])) {
            goto RR;
        }
        $t5 = $this->cryptParams["\144\151\147\x65\163\164"];
        RR:
        return openssl_verify($eY, $ur, $this->key, $t5);
    }
    public function encryptData($eY)
    {
        if (!($this->cryptParams["\154\151\x62\162\x61\x72\x79"] === "\157\160\145\x6e\x73\x73\154")) {
            goto Dq;
        }
        switch ($this->cryptParams["\164\171\x70\x65"]) {
            case "\163\171\155\155\x65\x74\x72\x69\x63":
                return $this->encryptSymmetric($eY);
            case "\160\165\142\x6c\151\x63":
                return $this->encryptPublic($eY);
            case "\x70\162\x69\166\x61\x74\x65":
                return $this->encryptPrivate($eY);
        }
        oz:
        iJ:
        Dq:
    }
    public function decryptData($eY)
    {
        if (!($this->cryptParams["\x6c\151\142\162\x61\x72\171"] === "\x6f\160\145\x6e\x73\x73\x6c")) {
            goto zW;
        }
        switch ($this->cryptParams["\x74\x79\x70\145"]) {
            case "\163\171\x6d\155\145\164\x72\151\143":
                return $this->decryptSymmetric($eY);
            case "\x70\165\142\154\151\x63":
                return $this->decryptPublic($eY);
            case "\x70\x72\x69\166\141\164\145":
                return $this->decryptPrivate($eY);
        }
        Z1:
        km:
        zW:
    }
    public function signData($eY)
    {
        switch ($this->cryptParams["\154\x69\x62\162\141\162\171"]) {
            case "\157\160\145\x6e\163\163\x6c":
                return $this->signOpenSSL($eY);
            case self::HMAC_SHA1:
                return hash_hmac("\163\x68\x61\x31", $eY, $this->key, true);
        }
        E4:
        Al:
    }
    public function verifySignature($eY, $ur)
    {
        switch ($this->cryptParams["\154\151\142\x72\x61\x72\171"]) {
            case "\157\x70\x65\x6e\x73\x73\154":
                return $this->verifyOpenSSL($eY, $ur);
            case self::HMAC_SHA1:
                $SR = hash_hmac("\x73\150\x61\61", $eY, $this->key, true);
                return strcmp($ur, $SR) == 0;
        }
        eM:
        rj:
    }
    public function getAlgorith()
    {
        return $this->cryptParams["\155\145\x74\150\157\144"];
    }
    public static function makeAsnSegment($fd, $wa)
    {
        switch ($fd) {
            case 2:
                if (!(ord($wa) > 127)) {
                    goto i0;
                }
                $wa = chr(0) . $wa;
                i0:
                goto XZ;
            case 3:
                $wa = chr(0) . $wa;
                goto XZ;
        }
        Qo:
        XZ:
        $rJ = strlen($wa);
        if ($rJ < 128) {
            goto Rc;
        }
        if ($rJ < 256) {
            goto KH;
        }
        if ($rJ < 65536) {
            goto PV;
        }
        $Wj = null;
        goto dg;
        PV:
        $Wj = sprintf("\45\x63\45\143\45\143\45\143\x25\x73", $fd, 130, $rJ / 256, $rJ % 256, $wa);
        dg:
        goto UD;
        KH:
        $Wj = sprintf("\45\x63\x25\x63\x25\x63\x25\x73", $fd, 129, $rJ, $wa);
        UD:
        goto T8;
        Rc:
        $Wj = sprintf("\x25\143\45\143\45\x73", $fd, $rJ, $wa);
        T8:
        return $Wj;
    }
    public static function convertRSA($W_, $xx)
    {
        $Sq = self::makeAsnSegment(2, $xx);
        $cp = self::makeAsnSegment(2, $W_);
        $hu = self::makeAsnSegment(48, $cp . $Sq);
        $D7 = self::makeAsnSegment(3, $hu);
        $Sv = pack("\110\52", "\63\60\x30\x44\60\66\60\x39\62\101\x38\66\64\x38\x38\66\x46\x37\x30\104\60\61\60\x31\60\x31\x30\65\60\60");
        $X3 = self::makeAsnSegment(48, $Sv . $D7);
        $M_ = base64_encode($X3);
        $NH = "\55\x2d\55\x2d\55\102\105\107\x49\x4e\40\x50\x55\x42\x4c\x49\x43\x20\113\x45\131\55\55\55\x2d\x2d\xa";
        $gT = 0;
        c0:
        if (!($Y0 = substr($M_, $gT, 64))) {
            goto mp;
        }
        $NH = $NH . $Y0 . "\12";
        $gT += 64;
        goto c0;
        mp:
        return $NH . "\x2d\55\x2d\x2d\55\105\116\104\40\x50\125\x42\114\111\103\x20\113\x45\x59\55\55\x2d\x2d\x2d\12";
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $ya)
    {
        $dr = new XMLSecEnc();
        $dr->setNode($ya);
        if ($cT = $dr->locateKey()) {
            goto tD;
        }
        throw new Exception("\x55\x6e\141\142\154\145\x20\x74\157\40\x6c\x6f\x63\x61\164\145\40\141\154\x67\x6f\x72\151\164\150\x6d\x20\x66\x6f\162\40\164\x68\151\163\x20\105\156\143\x72\x79\160\x74\x65\x64\x20\113\x65\x79");
        tD:
        $cT->isEncrypted = true;
        $cT->encryptedCtx = $dr;
        XMLSecEnc::staticLocateKeyInfo($cT, $ya);
        return $cT;
    }
}
class XMLSecurityDSig
{
    const XMLDSIGNS = "\150\164\164\160\x3a\x2f\x2f\167\x77\x77\x2e\167\63\56\157\x72\x67\x2f\x32\x30\x30\x30\57\x30\71\x2f\x78\155\154\144\x73\x69\x67\x23";
    const SHA1 = "\150\x74\164\x70\72\x2f\57\167\x77\x77\56\167\x33\x2e\x6f\x72\x67\57\62\60\60\x30\57\60\x39\57\x78\x6d\x6c\x64\x73\151\x67\x23\x73\x68\141\x31";
    const SHA256 = "\150\x74\164\x70\72\57\57\167\x77\x77\x2e\167\x33\56\157\162\147\57\x32\x30\60\61\57\60\64\57\x78\155\154\145\156\143\x23\x73\x68\x61\x32\65\x36";
    const SHA384 = "\x68\x74\x74\160\72\57\x2f\167\167\167\x2e\167\63\56\157\x72\x67\x2f\62\x30\x30\61\57\x30\64\x2f\x78\x6d\x6c\x64\x73\x69\147\x2d\x6d\157\x72\x65\43\163\x68\x61\63\70\64";
    const SHA512 = "\150\164\164\160\x3a\57\57\167\x77\x77\x2e\167\63\56\157\x72\147\x2f\x32\60\x30\x31\x2f\60\x34\57\x78\x6d\x6c\145\x6e\x63\x23\x73\x68\141\65\x31\x32";
    const RIPEMD160 = "\150\164\x74\160\x3a\x2f\x2f\x77\x77\167\x2e\x77\63\56\x6f\162\x67\57\x32\x30\x30\61\57\60\x34\x2f\x78\155\154\145\156\x63\43\162\x69\160\x65\x6d\x64\61\x36\x30";
    const C14N = "\x68\164\164\160\x3a\57\x2f\167\167\167\56\167\x33\56\157\162\x67\x2f\x54\x52\57\x32\60\x30\x31\57\122\105\103\55\x78\x6d\154\55\143\x31\64\x6e\55\62\x30\60\x31\x30\63\61\65";
    const C14N_COMMENTS = "\x68\x74\164\160\72\57\57\x77\x77\x77\56\x77\x33\x2e\x6f\x72\x67\x2f\124\x52\x2f\x32\60\60\x31\x2f\122\105\103\55\170\x6d\154\55\x63\61\64\156\55\x32\60\x30\61\x30\x33\x31\65\x23\x57\151\164\150\103\x6f\155\155\145\156\164\163";
    const EXC_C14N = "\150\164\164\160\x3a\57\x2f\167\167\167\x2e\167\63\x2e\157\162\147\x2f\x32\60\60\x31\57\61\60\x2f\170\x6d\x6c\x2d\x65\x78\143\x2d\143\61\x34\156\x23";
    const EXC_C14N_COMMENTS = "\150\164\164\160\x3a\57\x2f\167\167\x77\x2e\x77\x33\x2e\x6f\x72\147\57\x32\60\60\x31\57\61\60\57\170\155\154\x2d\145\x78\x63\x2d\143\61\x34\x6e\x23\127\x69\x74\x68\x43\x6f\x6d\x6d\145\156\x74\163";
    const template = "\x3c\144\x73\72\x53\151\x67\156\x61\x74\x75\162\x65\40\170\x6d\x6c\x6e\x73\x3a\144\163\75\x22\x68\x74\x74\160\72\57\x2f\x77\x77\167\x2e\x77\x33\56\x6f\162\147\57\62\x30\60\60\57\x30\x39\x2f\170\155\154\144\163\151\147\43\42\76\15\12\40\x20\74\x64\x73\72\x53\x69\x67\156\145\x64\x49\156\146\157\x3e\xd\12\x20\40\x20\x20\x3c\x64\163\72\x53\x69\147\x6e\x61\164\165\x72\145\x4d\x65\164\150\x6f\144\x20\x2f\x3e\xd\xa\40\40\74\57\144\x73\72\x53\151\x67\156\145\144\x49\156\x66\x6f\x3e\15\12\x3c\57\144\x73\x3a\x53\x69\147\156\141\164\165\162\x65\x3e";
    const BASE_TEMPLATE = "\74\x53\x69\x67\156\141\164\x75\x72\145\x20\x78\155\x6c\156\x73\x3d\42\150\164\164\160\72\x2f\x2f\x77\x77\167\56\167\x33\56\x6f\162\x67\57\x32\60\x30\60\x2f\x30\71\57\170\155\x6c\x64\163\x69\x67\43\x22\76\15\12\40\x20\74\123\x69\147\x6e\145\x64\x49\156\146\157\76\15\xa\40\x20\x20\x20\74\x53\x69\147\x6e\x61\x74\x75\x72\x65\x4d\145\164\x68\x6f\x64\40\57\76\xd\12\40\40\x3c\x2f\123\x69\x67\x6e\x65\144\x49\x6e\x66\157\76\15\12\x3c\57\x53\151\x67\x6e\x61\x74\x75\x72\145\76";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\x73\x65\143\144\163\151\x67";
    private $validatedNodes = null;
    public function __construct($Xj = "\144\x73")
    {
        $Y_ = self::BASE_TEMPLATE;
        if (empty($Xj)) {
            goto LP;
        }
        $this->prefix = $Xj . "\72";
        $rt = array("\74\x53", "\x3c\x2f\123", "\170\155\x6c\156\x73\75");
        $BE = array("\x3c{$Xj}\x3a\123", "\x3c\57{$Xj}\x3a\123", "\x78\x6d\x6c\156\163\72{$Xj}\75");
        $Y_ = str_replace($rt, $BE, $Y_);
        LP:
        $Yf = new DOMDocument();
        $Yf->loadXML($Y_);
        $this->sigNode = $Yf->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto tN;
        }
        $bw = new DOMXPath($this->sigNode->ownerDocument);
        $bw->registerNamespace("\x73\145\143\144\163\x69\147", self::XMLDSIGNS);
        $this->xPathCtx = $bw;
        tN:
        return $this->xPathCtx;
    }
    public static function generateGUID($Xj = "\160\x66\x78")
    {
        $yl = md5(uniqid(mt_rand(), true));
        $UP = $Xj . substr($yl, 0, 8) . "\55" . substr($yl, 8, 4) . "\55" . substr($yl, 12, 4) . "\55" . substr($yl, 16, 4) . "\55" . substr($yl, 20, 12);
        return $UP;
    }
    public static function generate_GUID($Xj = "\x70\146\170")
    {
        return self::generateGUID($Xj);
    }
    public function locateSignature($wK, $OX = 0)
    {
        if ($wK instanceof DOMDocument) {
            goto it;
        }
        $Sj = $wK->ownerDocument;
        goto Ne;
        it:
        $Sj = $wK;
        Ne:
        if (!$Sj) {
            goto xc;
        }
        $bw = new DOMXPath($Sj);
        $bw->registerNamespace("\163\x65\143\144\x73\x69\x67", self::XMLDSIGNS);
        $ZC = "\x2e\57\x2f\163\145\143\144\163\x69\147\72\123\151\147\x6e\x61\164\165\162\x65";
        $tu = $bw->query($ZC, $wK);
        $this->sigNode = $tu->item($OX);
        return $this->sigNode;
        xc:
        return null;
    }
    public function createNewSignNode($m9, $e4 = null)
    {
        $Sj = $this->sigNode->ownerDocument;
        if (!is_null($e4)) {
            goto K8;
        }
        $Cz = $Sj->createElementNS(self::XMLDSIGNS, $this->prefix . $m9);
        goto wt;
        K8:
        $Cz = $Sj->createElementNS(self::XMLDSIGNS, $this->prefix . $m9, $e4);
        wt:
        return $Cz;
    }
    public function setCanonicalMethod($Cp)
    {
        switch ($Cp) {
            case "\x68\164\164\160\72\x2f\57\x77\x77\x77\56\x77\63\x2e\157\162\147\57\x54\x52\x2f\x32\x30\60\61\x2f\x52\x45\103\55\x78\x6d\154\x2d\143\x31\64\x6e\55\62\x30\x30\61\x30\x33\x31\x35":
            case "\x68\164\164\x70\72\x2f\57\167\x77\167\56\x77\x33\56\157\162\147\57\x54\122\x2f\62\x30\x30\x31\x2f\122\x45\103\x2d\x78\x6d\x6c\x2d\143\61\x34\x6e\x2d\x32\x30\x30\61\x30\x33\x31\x35\x23\127\151\164\150\103\x6f\x6d\x6d\145\x6e\164\163":
            case "\x68\164\x74\x70\x3a\x2f\x2f\x77\167\167\x2e\167\63\x2e\157\x72\x67\x2f\62\60\x30\x31\57\61\60\x2f\x78\x6d\154\x2d\145\x78\143\x2d\x63\x31\x34\156\43":
            case "\x68\x74\164\x70\x3a\x2f\57\167\x77\167\x2e\167\63\x2e\x6f\162\147\x2f\62\60\x30\x31\x2f\x31\60\57\170\x6d\x6c\55\145\170\x63\55\143\61\64\x6e\x23\127\151\164\x68\x43\x6f\x6d\155\145\x6e\x74\x73":
                $this->canonicalMethod = $Cp;
                goto lG;
            default:
                throw new Exception("\111\156\x76\x61\x6c\151\x64\x20\x43\x61\x6e\x6f\156\151\x63\x61\154\x20\115\145\164\x68\x6f\144");
        }
        GD:
        lG:
        if (!($bw = $this->getXPathObj())) {
            goto ou;
        }
        $ZC = "\56\57" . $this->searchpfx . "\x3a\x53\x69\x67\x6e\145\x64\x49\x6e\146\x6f";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($yR = $tu->item(0))) {
            goto NS;
        }
        $ZC = "\x2e\57" . $this->searchpfx . "\x43\x61\156\157\x6e\x69\143\141\x6c\x69\x7a\141\x74\151\x6f\x6e\115\145\164\x68\x6f\x64";
        $tu = $bw->query($ZC, $yR);
        if ($Ck = $tu->item(0)) {
            goto j5;
        }
        $Ck = $this->createNewSignNode("\x43\141\x6e\157\156\151\x63\141\x6c\x69\x7a\141\x74\x69\157\156\x4d\145\164\x68\x6f\x64");
        $yR->insertBefore($Ck, $yR->firstChild);
        j5:
        $Ck->setAttribute("\101\154\147\x6f\162\x69\164\x68\155", $this->canonicalMethod);
        NS:
        ou:
    }
    private function canonicalizeData($Cz, $CN, $aH = null, $ve = null)
    {
        $gr = false;
        $yi = false;
        switch ($CN) {
            case "\x68\x74\x74\x70\x3a\x2f\x2f\x77\167\167\56\167\63\x2e\157\162\x67\57\x54\122\57\62\60\x30\x31\x2f\x52\x45\103\55\x78\155\x6c\x2d\143\61\x34\156\55\x32\60\60\x31\x30\x33\x31\65":
                $gr = false;
                $yi = false;
                goto Z5;
            case "\x68\164\164\160\72\x2f\57\x77\167\x77\x2e\x77\x33\x2e\x6f\162\147\x2f\124\122\x2f\x32\x30\60\61\57\122\105\103\55\x78\x6d\154\55\143\x31\x34\156\55\x32\x30\60\61\60\63\61\x35\x23\127\x69\x74\x68\103\157\x6d\x6d\145\156\164\163":
                $yi = true;
                goto Z5;
            case "\x68\164\164\x70\72\x2f\57\167\167\167\56\x77\63\x2e\157\x72\147\57\x32\60\60\x31\57\61\x30\57\170\155\154\55\145\x78\143\x2d\143\61\x34\x6e\43":
                $gr = true;
                goto Z5;
            case "\150\164\x74\x70\72\x2f\57\167\167\167\x2e\x77\x33\56\x6f\x72\147\57\62\x30\x30\x31\x2f\x31\x30\x2f\170\x6d\154\55\145\x78\143\x2d\x63\x31\x34\156\x23\x57\x69\164\x68\103\157\155\155\145\x6e\164\x73":
                $gr = true;
                $yi = true;
                goto Z5;
        }
        Pn:
        Z5:
        if (!(is_null($aH) && $Cz instanceof DOMNode && $Cz->ownerDocument !== null && $Cz->isSameNode($Cz->ownerDocument->documentElement))) {
            goto fO;
        }
        $ya = $Cz;
        SD:
        if (!($RL = $ya->previousSibling)) {
            goto Pd;
        }
        if (!($RL->nodeType == XML_PI_NODE || $RL->nodeType == XML_COMMENT_NODE && $yi)) {
            goto R2;
        }
        goto Pd;
        R2:
        $ya = $RL;
        goto SD;
        Pd:
        if (!($RL == null)) {
            goto Xf;
        }
        $Cz = $Cz->ownerDocument;
        Xf:
        fO:
        return $Cz->C14N($gr, $yi, $aH, $ve);
    }
    public function canonicalizeSignedInfo()
    {
        $Sj = $this->sigNode->ownerDocument;
        $CN = null;
        if (!$Sj) {
            goto eY;
        }
        $bw = $this->getXPathObj();
        $ZC = "\x2e\x2f\x73\x65\x63\144\163\151\x67\72\x53\x69\x67\x6e\145\x64\111\x6e\x66\x6f";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($Oh = $tu->item(0))) {
            goto U2;
        }
        $ZC = "\56\x2f\163\145\x63\144\163\x69\x67\72\103\x61\156\157\x6e\151\x63\141\154\151\172\141\x74\x69\x6f\156\x4d\x65\x74\150\157\x64";
        $tu = $bw->query($ZC, $Oh);
        if (!($Ck = $tu->item(0))) {
            goto fA;
        }
        $CN = $Ck->getAttribute("\x41\154\147\157\162\x69\x74\150\155");
        fA:
        $this->signedInfo = $this->canonicalizeData($Oh, $CN);
        return $this->signedInfo;
        U2:
        eY:
        return null;
    }
    public function calculateDigest($nz, $eY, $Mv = true)
    {
        switch ($nz) {
            case self::SHA1:
                $Oj = "\163\150\x61\61";
                goto ed;
            case self::SHA256:
                $Oj = "\x73\x68\x61\62\65\x36";
                goto ed;
            case self::SHA384:
                $Oj = "\163\x68\141\x33\70\x34";
                goto ed;
            case self::SHA512:
                $Oj = "\163\x68\x61\65\61\x32";
                goto ed;
            case self::RIPEMD160:
                $Oj = "\162\x69\160\145\155\x64\61\x36\x30";
                goto ed;
            default:
                throw new Exception("\x43\x61\156\x6e\157\x74\40\166\141\x6c\x69\x64\x61\164\145\40\144\151\x67\145\x73\x74\x3a\40\x55\156\163\x75\x70\x70\157\162\164\145\144\40\x41\154\x67\x6f\x72\151\x74\150\x6d\40\74{$nz}\76");
        }
        EN:
        ed:
        $mK = hash($Oj, $eY, true);
        if (!$Mv) {
            goto jz;
        }
        $mK = base64_encode($mK);
        jz:
        return $mK;
    }
    public function validateDigest($gk, $eY)
    {
        $bw = new DOMXPath($gk->ownerDocument);
        $bw->registerNamespace("\163\145\x63\x64\x73\151\147", self::XMLDSIGNS);
        $ZC = "\x73\164\162\x69\x6e\147\x28\x2e\57\163\x65\143\144\163\x69\x67\72\x44\151\147\145\163\x74\115\x65\164\x68\157\144\x2f\100\x41\x6c\x67\x6f\x72\151\x74\x68\155\x29";
        $nz = $bw->evaluate($ZC, $gk);
        $k1 = $this->calculateDigest($nz, $eY, false);
        $ZC = "\x73\x74\162\151\156\147\50\x2e\57\x73\145\x63\144\163\151\x67\72\x44\151\x67\x65\x73\x74\x56\x61\x6c\x75\x65\x29";
        $Yh = $bw->evaluate($ZC, $gk);
        return $k1 == base64_decode($Yh);
    }
    public function processTransforms($gk, $Bz, $Zv = true)
    {
        $eY = $Bz;
        $bw = new DOMXPath($gk->ownerDocument);
        $bw->registerNamespace("\x73\145\143\144\x73\151\x67", self::XMLDSIGNS);
        $ZC = "\x2e\57\x73\145\143\144\163\151\147\x3a\124\x72\141\x6e\163\x66\x6f\x72\155\163\57\x73\x65\143\x64\x73\x69\x67\72\x54\x72\x61\156\x73\x66\x6f\x72\155";
        $UG = $bw->query($ZC, $gk);
        $a_ = "\150\164\164\160\72\57\x2f\167\167\167\x2e\x77\x33\56\x6f\162\x67\57\x54\x52\57\62\x30\x30\61\57\122\x45\x43\x2d\x78\155\154\x2d\x63\x31\64\x6e\55\62\60\60\61\x30\x33\x31\65";
        $aH = null;
        $ve = null;
        foreach ($UG as $bZ) {
            $EJ = $bZ->getAttribute("\x41\154\x67\157\162\151\x74\x68\155");
            switch ($EJ) {
                case "\150\164\164\x70\x3a\57\x2f\167\167\x77\56\167\63\56\x6f\162\x67\x2f\x32\60\x30\61\x2f\x31\60\57\170\155\x6c\55\x65\170\143\55\x63\x31\x34\156\43":
                case "\150\164\x74\x70\72\x2f\x2f\167\x77\x77\56\167\x33\x2e\157\x72\x67\57\62\60\x30\x31\x2f\61\60\x2f\170\155\154\55\x65\x78\x63\55\x63\x31\64\x6e\x23\x57\x69\x74\x68\x43\x6f\155\x6d\x65\156\x74\x73":
                    if (!$Zv) {
                        goto rm;
                    }
                    $a_ = $EJ;
                    goto gR;
                    rm:
                    $a_ = "\x68\164\x74\160\x3a\x2f\x2f\x77\167\167\x2e\x77\63\56\157\x72\x67\x2f\x32\60\60\x31\57\x31\60\57\170\155\x6c\x2d\145\x78\x63\55\x63\x31\x34\156\x23";
                    gR:
                    $Cz = $bZ->firstChild;
                    fU:
                    if (!$Cz) {
                        goto t5;
                    }
                    if (!($Cz->localName == "\x49\156\x63\154\x75\163\151\166\145\116\141\x6d\x65\x73\x70\141\x63\145\163")) {
                        goto kP;
                    }
                    if (!($PG = $Cz->getAttribute("\x50\162\x65\x66\151\x78\x4c\151\x73\x74"))) {
                        goto Ow;
                    }
                    $fK = array();
                    $MC = explode("\x20", $PG);
                    foreach ($MC as $PG) {
                        $Gv = trim($PG);
                        if (empty($Gv)) {
                            goto ES;
                        }
                        $fK[] = $Gv;
                        ES:
                        s6:
                    }
                    d1:
                    if (!(count($fK) > 0)) {
                        goto Mw;
                    }
                    $ve = $fK;
                    Mw:
                    Ow:
                    goto t5;
                    kP:
                    $Cz = $Cz->nextSibling;
                    goto fU;
                    t5:
                    goto Ti;
                case "\150\x74\164\160\x3a\57\x2f\x77\x77\167\x2e\167\x33\56\157\162\x67\57\124\x52\57\62\x30\60\61\x2f\x52\x45\103\x2d\170\155\x6c\55\143\61\x34\x6e\55\x32\x30\x30\x31\x30\63\x31\65":
                case "\150\164\164\160\x3a\x2f\57\167\x77\167\56\167\x33\x2e\x6f\162\x67\57\124\122\x2f\x32\x30\x30\61\57\122\105\x43\x2d\x78\x6d\154\55\143\61\x34\x6e\x2d\62\60\x30\61\x30\63\61\65\x23\x57\x69\x74\150\103\x6f\x6d\155\145\156\x74\x73":
                    if (!$Zv) {
                        goto QG;
                    }
                    $a_ = $EJ;
                    goto Rt;
                    QG:
                    $a_ = "\x68\x74\x74\x70\x3a\57\57\167\x77\x77\x2e\167\x33\56\x6f\162\x67\57\x54\x52\x2f\62\x30\x30\x31\57\x52\x45\103\55\x78\x6d\x6c\x2d\143\61\x34\x6e\x2d\62\x30\60\61\x30\x33\x31\x35";
                    Rt:
                    goto Ti;
                case "\150\164\164\x70\72\57\x2f\167\x77\167\56\x77\x33\x2e\157\x72\x67\57\x54\x52\57\61\x39\x39\x39\57\x52\x45\103\55\x78\160\x61\x74\150\x2d\x31\x39\x39\x39\61\61\x31\66":
                    $Cz = $bZ->firstChild;
                    Ux:
                    if (!$Cz) {
                        goto pQ;
                    }
                    if (!($Cz->localName == "\x58\120\141\164\x68")) {
                        goto ar;
                    }
                    $aH = array();
                    $aH["\161\x75\x65\x72\171"] = "\50\x2e\x2f\x2f\x2e\40\x7c\x20\x2e\57\57\x40\52\40\x7c\40\x2e\57\x2f\x6e\x61\x6d\145\163\160\x61\x63\145\x3a\72\52\x29\133" . $Cz->nodeValue . "\x5d";
                    $H2["\x6e\x61\155\x65\x73\160\x61\x63\x65\163"] = array();
                    $zl = $bw->query("\56\x2f\156\141\x6d\x65\x73\x70\x61\x63\145\x3a\72\x2a", $Cz);
                    foreach ($zl as $ec) {
                        if (!($ec->localName != "\170\x6d\x6c")) {
                            goto yW;
                        }
                        $aH["\156\x61\x6d\145\163\160\141\x63\145\163"][$ec->localName] = $ec->nodeValue;
                        yW:
                        Ud:
                    }
                    dO1:
                    goto pQ;
                    ar:
                    $Cz = $Cz->nextSibling;
                    goto Ux;
                    pQ:
                    goto Ti;
            }
            EG:
            Ti:
            Xb:
        }
        iz:
        if (!$eY instanceof DOMElement) {
            goto ja;
        }
        $eY = $this->canonicalizeData($Bz, $a_, $aH, $ve);
        ja:
        return $eY;
    }
    public function processRefNode($gk)
    {
        $bH = null;
        $Zv = true;
        if ($mL = $gk->getAttribute("\x55\x52\111")) {
            goto LD;
        }
        $Zv = false;
        $bH = $gk->ownerDocument;
        goto OX;
        LD:
        $iS = parse_url($mL);
        if (empty($iS["\160\x61\164\x68"])) {
            goto mk;
        }
        $bH = file_get_contents($iS);
        goto U9;
        mk:
        if ($XJ = $iS["\146\162\141\x67\x6d\145\x6e\164"]) {
            goto PN;
        }
        $bH = $gk->ownerDocument;
        goto NW;
        PN:
        $Zv = false;
        $Nw = new DOMXPath($gk->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto Ao;
        }
        foreach ($this->idNS as $zQ => $HT) {
            $Nw->registerNamespace($zQ, $HT);
            ey:
        }
        E_:
        Ao:
        $Q6 = "\100\111\144\75\x22" . $XJ . "\42";
        if (!is_array($this->idKeys)) {
            goto Hf;
        }
        foreach ($this->idKeys as $LX) {
            $Q6 .= "\40\x6f\162\x20\100{$LX}\75\x27{$XJ}\x27";
            we:
        }
        gQ:
        Hf:
        $ZC = "\x2f\57\52\x5b" . $Q6 . "\x5d";
        $bH = $Nw->query($ZC)->item(0);
        NW:
        U9:
        OX:
        $eY = $this->processTransforms($gk, $bH, $Zv);
        if ($this->validateDigest($gk, $eY)) {
            goto ih;
        }
        return false;
        ih:
        if (!$bH instanceof DOMElement) {
            goto n9;
        }
        if (!empty($XJ)) {
            goto CH;
        }
        $this->validatedNodes[] = $bH;
        goto Sx;
        CH:
        $this->validatedNodes[$XJ] = $bH;
        Sx:
        n9:
        return true;
    }
    public function getRefNodeID($gk)
    {
        if (!($mL = $gk->getAttribute("\x55\x52\x49"))) {
            goto MK;
        }
        $iS = parse_url($mL);
        if (!empty($iS["\x70\x61\164\x68"])) {
            goto gt;
        }
        if (!($XJ = $iS["\x66\x72\x61\x67\x6d\145\156\164"])) {
            goto nr;
        }
        return $XJ;
        nr:
        gt:
        MK:
        return null;
    }
    public function getRefIDs()
    {
        $zB = array();
        $bw = $this->getXPathObj();
        $ZC = "\x2e\x2f\x73\x65\143\144\163\151\x67\72\x53\151\147\x6e\x65\144\x49\156\x66\157\57\x73\145\143\x64\x73\151\147\x3a\x52\145\x66\x65\162\145\x6e\143\145";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($tu->length == 0)) {
            goto DV;
        }
        throw new Exception("\x52\145\x66\x65\162\x65\156\143\145\40\156\157\x64\145\x73\x20\x6e\157\164\x20\146\x6f\165\156\144");
        DV:
        foreach ($tu as $gk) {
            $zB[] = $this->getRefNodeID($gk);
            Se:
        }
        Yf:
        return $zB;
    }
    public function validateReference()
    {
        $FO = $this->sigNode->ownerDocument->documentElement;
        if ($FO->isSameNode($this->sigNode)) {
            goto wW;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto T1;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        T1:
        wW:
        $bw = $this->getXPathObj();
        $ZC = "\x2e\57\163\x65\x63\x64\x73\151\147\72\x53\151\147\x6e\145\x64\111\156\x66\157\x2f\x73\x65\x63\144\163\151\x67\x3a\122\145\146\145\x72\145\156\x63\x65";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($tu->length == 0)) {
            goto NL;
        }
        throw new Exception("\x52\145\146\145\x72\x65\156\143\145\40\x6e\157\x64\145\x73\40\156\x6f\164\x20\x66\157\165\156\x64");
        NL:
        $this->validatedNodes = array();
        foreach ($tu as $gk) {
            if ($this->processRefNode($gk)) {
                goto zf;
            }
            $this->validatedNodes = null;
            throw new Exception("\122\x65\x66\145\162\145\x6e\143\145\40\166\x61\154\151\x64\x61\x74\151\157\156\40\x66\141\151\154\145\144");
            zf:
            Ro:
        }
        mN:
        return true;
    }
    private function addRefInternal($U4, $Cz, $EJ, $g6 = null, $cS = null)
    {
        $Xj = null;
        $P1 = null;
        $NB = "\x49\144";
        $X7 = true;
        $jK = false;
        if (!is_array($cS)) {
            goto ax;
        }
        $Xj = empty($cS["\x70\x72\145\x66\x69\x78"]) ? null : $cS["\160\162\145\146\151\170"];
        $P1 = empty($cS["\x70\x72\x65\146\151\170\x5f\156\163"]) ? null : $cS["\160\162\145\x66\x69\x78\x5f\156\x73"];
        $NB = empty($cS["\151\x64\137\x6e\x61\x6d\x65"]) ? "\x49\144" : $cS["\x69\144\137\156\141\x6d\145"];
        $X7 = !isset($cS["\157\x76\145\162\167\x72\151\164\145"]) ? true : (bool) $cS["\157\x76\145\162\x77\162\x69\x74\145"];
        $jK = !isset($cS["\x66\157\x72\x63\x65\x5f\x75\x72\x69"]) ? false : (bool) $cS["\146\x6f\162\143\x65\137\x75\162\x69"];
        ax:
        $oq = $NB;
        if (empty($Xj)) {
            goto k1;
        }
        $oq = $Xj . "\72" . $oq;
        k1:
        $gk = $this->createNewSignNode("\x52\x65\x66\145\162\145\156\x63\145");
        $U4->appendChild($gk);
        if (!$Cz instanceof DOMDocument) {
            goto la;
        }
        if ($jK) {
            goto MS;
        }
        goto Un;
        la:
        $mL = null;
        if ($X7) {
            goto SR;
        }
        $mL = $P1 ? $Cz->getAttributeNS($P1, $NB) : $Cz->getAttribute($NB);
        SR:
        if (!empty($mL)) {
            goto af;
        }
        $mL = self::generateGUID();
        $Cz->setAttributeNS($P1, $oq, $mL);
        af:
        $gk->setAttribute("\x55\122\111", "\43" . $mL);
        goto Un;
        MS:
        $gk->setAttribute("\125\x52\111", '');
        Un:
        $rI = $this->createNewSignNode("\124\162\141\156\x73\x66\x6f\x72\155\x73");
        $gk->appendChild($rI);
        if (is_array($g6)) {
            goto eF;
        }
        if (!empty($this->canonicalMethod)) {
            goto sy;
        }
        goto b6;
        eF:
        foreach ($g6 as $bZ) {
            $m6 = $this->createNewSignNode("\124\162\x61\156\163\146\157\x72\x6d");
            $rI->appendChild($m6);
            if (is_array($bZ) && !empty($bZ["\x68\164\164\160\72\x2f\x2f\167\167\x77\56\x77\x33\x2e\x6f\162\147\x2f\124\122\x2f\61\71\71\x39\57\122\105\x43\55\170\160\141\x74\x68\55\x31\x39\71\71\61\x31\61\66"]) && !empty($bZ["\x68\x74\164\x70\72\57\57\167\x77\x77\56\x77\x33\56\x6f\162\x67\x2f\x54\x52\57\x31\x39\71\x39\57\x52\x45\x43\55\170\x70\x61\164\x68\55\61\x39\71\71\x31\61\x31\x36"]["\161\x75\145\x72\x79"])) {
                goto QB;
            }
            $m6->setAttribute("\101\x6c\x67\x6f\162\x69\x74\150\155", $bZ);
            goto Sl;
            QB:
            $m6->setAttribute("\x41\x6c\x67\157\x72\x69\164\150\x6d", "\x68\x74\164\160\x3a\57\57\x77\167\167\56\x77\x33\x2e\157\162\x67\x2f\124\x52\57\61\71\x39\71\x2f\122\105\x43\x2d\170\x70\141\164\150\x2d\x31\71\x39\x39\61\61\61\66");
            $xR = $this->createNewSignNode("\130\x50\141\x74\x68", $bZ["\150\x74\164\160\72\57\57\167\x77\x77\56\x77\x33\56\x6f\x72\147\57\x54\x52\57\x31\x39\x39\x39\57\x52\105\x43\55\x78\160\141\x74\150\55\x31\71\x39\x39\x31\x31\x31\x36"]["\x71\x75\145\x72\x79"]);
            $m6->appendChild($xR);
            if (empty($bZ["\150\164\x74\x70\x3a\x2f\x2f\167\167\x77\x2e\167\x33\x2e\x6f\x72\147\x2f\x54\x52\x2f\61\x39\x39\x39\57\122\x45\x43\x2d\170\160\x61\164\x68\55\61\71\x39\x39\x31\x31\61\x36"]["\156\x61\155\145\163\160\x61\143\145\x73"])) {
                goto xy;
            }
            foreach ($bZ["\x68\x74\164\160\72\57\57\167\167\167\56\x77\x33\56\157\162\x67\x2f\124\x52\57\x31\x39\x39\x39\x2f\122\105\x43\x2d\170\x70\141\x74\150\55\61\x39\71\x39\x31\61\61\x36"]["\156\x61\155\145\x73\x70\x61\x63\145\x73"] as $Xj => $nm) {
                $xR->setAttributeNS("\150\164\164\x70\x3a\57\57\167\x77\167\x2e\x77\x33\x2e\157\162\x67\x2f\62\x30\60\x30\x2f\170\x6d\154\x6e\163\x2f", "\x78\155\154\156\x73\x3a{$Xj}", $nm);
                hg:
            }
            a7:
            xy:
            Sl:
            PW:
        }
        zo:
        goto b6;
        sy:
        $m6 = $this->createNewSignNode("\124\162\x61\156\x73\146\x6f\x72\155");
        $rI->appendChild($m6);
        $m6->setAttribute("\x41\154\x67\157\x72\151\164\150\x6d", $this->canonicalMethod);
        b6:
        $PJ = $this->processTransforms($gk, $Cz);
        $k1 = $this->calculateDigest($EJ, $PJ);
        $xE = $this->createNewSignNode("\104\151\147\145\163\x74\115\145\x74\150\157\x64");
        $gk->appendChild($xE);
        $xE->setAttribute("\101\154\147\x6f\162\151\x74\150\155", $EJ);
        $Yh = $this->createNewSignNode("\x44\x69\147\145\x73\164\126\x61\x6c\165\145", $k1);
        $gk->appendChild($Yh);
    }
    public function addReference($Cz, $EJ, $g6 = null, $cS = null)
    {
        if (!($bw = $this->getXPathObj())) {
            goto K5;
        }
        $ZC = "\56\x2f\163\145\x63\144\163\151\x67\x3a\x53\x69\x67\x6e\145\x64\x49\156\x66\157";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($K3 = $tu->item(0))) {
            goto cT;
        }
        $this->addRefInternal($K3, $Cz, $EJ, $g6, $cS);
        cT:
        K5:
    }
    public function addReferenceList($db, $EJ, $g6 = null, $cS = null)
    {
        if (!($bw = $this->getXPathObj())) {
            goto dP;
        }
        $ZC = "\x2e\57\163\145\x63\x64\x73\x69\x67\72\123\x69\x67\x6e\x65\144\111\x6e\x66\157";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($K3 = $tu->item(0))) {
            goto vT;
        }
        foreach ($db as $Cz) {
            $this->addRefInternal($K3, $Cz, $EJ, $g6, $cS);
            p0:
        }
        Xk:
        vT:
        dP:
    }
    public function addObject($eY, $nv = null, $NH = null)
    {
        $Ae = $this->createNewSignNode("\117\142\x6a\x65\143\x74");
        $this->sigNode->appendChild($Ae);
        if (empty($nv)) {
            goto Vs;
        }
        $Ae->setAttribute("\115\151\x6d\145\124\171\160\x65", $nv);
        Vs:
        if (empty($NH)) {
            goto vF;
        }
        $Ae->setAttribute("\105\156\143\x6f\x64\x69\156\x67", $NH);
        vF:
        if ($eY instanceof DOMElement) {
            goto Y4;
        }
        $Av = $this->sigNode->ownerDocument->createTextNode($eY);
        goto dl;
        Y4:
        $Av = $this->sigNode->ownerDocument->importNode($eY, true);
        dl:
        $Ae->appendChild($Av);
        return $Ae;
    }
    public function locateKey($Cz = null)
    {
        if (!empty($Cz)) {
            goto pk;
        }
        $Cz = $this->sigNode;
        pk:
        if ($Cz instanceof DOMNode) {
            goto NF;
        }
        return null;
        NF:
        if (!($Sj = $Cz->ownerDocument)) {
            goto yB;
        }
        $bw = new DOMXPath($Sj);
        $bw->registerNamespace("\x73\145\x63\144\163\x69\147", self::XMLDSIGNS);
        $ZC = "\x73\164\x72\151\x6e\x67\50\56\x2f\x73\145\x63\144\x73\x69\x67\x3a\x53\151\147\156\145\144\111\x6e\x66\x6f\x2f\163\145\143\144\x73\151\x67\x3a\x53\151\147\156\x61\x74\165\x72\x65\x4d\145\164\150\x6f\x64\57\100\101\x6c\x67\x6f\162\x69\x74\x68\155\x29";
        $EJ = $bw->evaluate($ZC, $Cz);
        if (!$EJ) {
            goto Cd;
        }
        try {
            $cT = new XMLSecurityKey($EJ, array("\164\171\160\145" => "\x70\x75\x62\x6c\151\143"));
        } catch (Exception $oB) {
            return null;
        }
        return $cT;
        Cd:
        yB:
        return null;
    }
    public function verify($cT)
    {
        $Sj = $this->sigNode->ownerDocument;
        $bw = new DOMXPath($Sj);
        $bw->registerNamespace("\163\145\143\x64\x73\151\147", self::XMLDSIGNS);
        $ZC = "\x73\164\162\151\156\x67\x28\56\x2f\x73\145\143\144\x73\151\147\72\x53\x69\147\x6e\x61\x74\165\162\x65\x56\x61\x6c\x75\145\51";
        $K6 = $bw->evaluate($ZC, $this->sigNode);
        if (!empty($K6)) {
            goto Jy;
        }
        throw new Exception("\125\x6e\141\142\x6c\145\x20\164\157\40\154\157\x63\x61\x74\x65\40\123\x69\x67\x6e\x61\x74\x75\x72\x65\126\x61\154\165\x65");
        Jy:
        return $cT->verifySignature($this->signedInfo, base64_decode($K6));
    }
    public function signData($cT, $eY)
    {
        return $cT->signData($eY);
    }
    public function sign($cT, $Mw = null)
    {
        if (!($Mw != null)) {
            goto yQ;
        }
        $this->resetXPathObj();
        $this->appendSignature($Mw);
        $this->sigNode = $Mw->lastChild;
        yQ:
        if (!($bw = $this->getXPathObj())) {
            goto Ks;
        }
        $ZC = "\x2e\x2f\163\x65\x63\144\163\151\147\72\123\151\147\x6e\145\x64\x49\156\146\x6f";
        $tu = $bw->query($ZC, $this->sigNode);
        if (!($K3 = $tu->item(0))) {
            goto dM;
        }
        $ZC = "\56\57\163\145\x63\x64\x73\x69\x67\72\x53\151\147\156\141\164\x75\162\145\x4d\145\164\150\x6f\x64";
        $tu = $bw->query($ZC, $K3);
        $Ra = $tu->item(0);
        $Ra->setAttribute("\x41\154\147\x6f\162\x69\x74\x68\x6d", $cT->type);
        $eY = $this->canonicalizeData($K3, $this->canonicalMethod);
        $K6 = base64_encode($this->signData($cT, $eY));
        $Nr = $this->createNewSignNode("\x53\x69\147\156\141\x74\x75\x72\145\126\x61\x6c\165\145", $K6);
        if ($Ui = $K3->nextSibling) {
            goto hV;
        }
        $this->sigNode->appendChild($Nr);
        goto pe;
        hV:
        $Ui->parentNode->insertBefore($Nr, $Ui);
        pe:
        dM:
        Ks:
    }
    public function appendCert()
    {
    }
    public function appendKey($cT, $nt = null)
    {
        $cT->serializeKey($nt);
    }
    public function insertSignature($Cz, $eB = null)
    {
        $lQ = $Cz->ownerDocument;
        $Zd = $lQ->importNode($this->sigNode, true);
        if ($eB == null) {
            goto WU;
        }
        return $Cz->insertBefore($Zd, $eB);
        goto N5;
        WU:
        return $Cz->insertBefore($Zd);
        N5:
    }
    public function appendSignature($GP, $Bp = false)
    {
        $eB = $Bp ? $GP->firstChild : null;
        return $this->insertSignature($GP, $eB);
    }
    public static function get509XCert($nd, $Pu = true)
    {
        $Oq = self::staticGet509XCerts($nd, $Pu);
        if (empty($Oq)) {
            goto jV;
        }
        return $Oq[0];
        jV:
        return '';
    }
    public static function staticGet509XCerts($Oq, $Pu = true)
    {
        if ($Pu) {
            goto Cl;
        }
        return array($Oq);
        goto qz;
        Cl:
        $eY = '';
        $or = array();
        $jE = explode("\xa", $Oq);
        $i_ = false;
        foreach ($jE as $IQ) {
            if (!$i_) {
                goto kK;
            }
            if (!(strncmp($IQ, "\x2d\55\55\55\x2d\x45\x4e\x44\x20\x43\x45\x52\x54\x49\x46\111\103\x41\124\x45", 20) == 0)) {
                goto Ex;
            }
            $i_ = false;
            $or[] = $eY;
            $eY = '';
            goto oM;
            Ex:
            $eY .= trim($IQ);
            goto x0;
            kK:
            if (!(strncmp($IQ, "\55\55\55\55\55\102\x45\107\111\x4e\40\x43\105\122\x54\111\x46\x49\103\101\x54\x45", 22) == 0)) {
                goto Tk;
            }
            $i_ = true;
            Tk:
            x0:
            oM:
        }
        Gm:
        return $or;
        qz:
    }
    public static function staticAdd509Cert($x1, $nd, $Pu = true, $VR = false, $bw = null, $cS = null)
    {
        if (!$VR) {
            goto l8;
        }
        $nd = file_get_contents($nd);
        l8:
        if ($x1 instanceof DOMElement) {
            goto ye;
        }
        throw new Exception("\x49\x6e\166\x61\154\151\x64\x20\x70\141\162\x65\156\164\x20\x4e\157\x64\x65\x20\x70\x61\162\141\155\x65\164\x65\x72");
        ye:
        $yw = $x1->ownerDocument;
        if (!empty($bw)) {
            goto os;
        }
        $bw = new DOMXPath($x1->ownerDocument);
        $bw->registerNamespace("\x73\x65\x63\144\163\151\147", self::XMLDSIGNS);
        os:
        $ZC = "\56\57\x73\145\143\144\x73\x69\147\x3a\113\145\171\111\x6e\x66\157";
        $tu = $bw->query($ZC, $x1);
        $Uv = $tu->item(0);
        $bV = '';
        if (!$Uv) {
            goto iv;
        }
        $PG = $Uv->lookupPrefix(self::XMLDSIGNS);
        if (empty($PG)) {
            goto TE;
        }
        $bV = $PG . "\x3a";
        TE:
        goto lc;
        iv:
        $PG = $x1->lookupPrefix(self::XMLDSIGNS);
        if (empty($PG)) {
            goto jX;
        }
        $bV = $PG . "\72";
        jX:
        $pN = false;
        $Uv = $yw->createElementNS(self::XMLDSIGNS, $bV . "\x4b\145\x79\111\156\146\x6f");
        $ZC = "\x2e\57\x73\145\143\x64\x73\151\x67\72\x4f\x62\152\145\x63\164";
        $tu = $bw->query($ZC, $x1);
        if (!($dE = $tu->item(0))) {
            goto W4;
        }
        $dE->parentNode->insertBefore($Uv, $dE);
        $pN = true;
        W4:
        if ($pN) {
            goto og;
        }
        $x1->appendChild($Uv);
        og:
        lc:
        $Oq = self::staticGet509XCerts($nd, $Pu);
        $YE = $yw->createElementNS(self::XMLDSIGNS, $bV . "\130\x35\x30\x39\x44\141\164\x61");
        $Uv->appendChild($YE);
        $Wv = false;
        $dT = false;
        if (!is_array($cS)) {
            goto ue;
        }
        if (empty($cS["\x69\x73\x73\165\x65\x72\123\x65\162\x69\x61\154"])) {
            goto Wv;
        }
        $Wv = true;
        Wv:
        if (empty($cS["\163\x75\142\x6a\145\x63\164\x4e\x61\155\x65"])) {
            goto Af;
        }
        $dT = true;
        Af:
        ue:
        foreach ($Oq as $Iv) {
            if (!($Wv || $dT)) {
                goto q0;
            }
            if (!($xw = openssl_x509_parse("\55\x2d\55\x2d\x2d\x42\105\107\x49\116\40\103\x45\122\124\111\x46\111\103\101\x54\105\x2d\x2d\55\x2d\55\12" . chunk_split($Iv, 64, "\xa") . "\x2d\x2d\x2d\55\55\105\x4e\104\x20\103\x45\122\x54\x49\x46\x49\103\x41\x54\x45\55\55\x2d\55\55\12"))) {
                goto wG;
            }
            if (!($dT && !empty($xw["\163\x75\142\x6a\x65\143\164"]))) {
                goto FI;
            }
            if (is_array($xw["\x73\165\142\x6a\x65\143\x74"])) {
                goto o9;
            }
            $Dj = $xw["\x69\163\x73\165\x65\162"];
            goto D6;
            o9:
            $yy = array();
            foreach ($xw["\163\165\x62\x6a\x65\x63\x74"] as $qT => $e4) {
                if (is_array($e4)) {
                    goto Sj;
                }
                array_unshift($yy, "{$qT}\x3d{$e4}");
                goto tW;
                Sj:
                foreach ($e4 as $OD) {
                    array_unshift($yy, "{$qT}\75{$OD}");
                    tj:
                }
                YN:
                tW:
                Zc:
            }
            bE:
            $Dj = implode("\54", $yy);
            D6:
            $NG = $yw->createElementNS(self::XMLDSIGNS, $bV . "\x58\x35\x30\x39\x53\x75\142\x6a\145\143\x74\x4e\141\x6d\x65", $Dj);
            $YE->appendChild($NG);
            FI:
            if (!($Wv && !empty($xw["\x69\x73\163\165\145\x72"]) && !empty($xw["\x73\145\x72\151\141\x6c\116\165\x6d\x62\x65\x72"]))) {
                goto MX;
            }
            if (is_array($xw["\x69\x73\x73\165\145\162"])) {
                goto a1;
            }
            $JV = $xw["\151\x73\x73\x75\145\x72"];
            goto Mm;
            a1:
            $yy = array();
            foreach ($xw["\151\163\163\165\145\x72"] as $qT => $e4) {
                array_unshift($yy, "{$qT}\75{$e4}");
                SS:
            }
            Jp:
            $JV = implode("\x2c", $yy);
            Mm:
            $WM = $yw->createElementNS(self::XMLDSIGNS, $bV . "\130\x35\x30\x39\x49\163\163\165\145\162\123\145\x72\x69\141\x6c");
            $YE->appendChild($WM);
            $BH = $yw->createElementNS(self::XMLDSIGNS, $bV . "\x58\65\x30\x39\111\163\x73\x75\145\x72\x4e\x61\x6d\x65", $JV);
            $WM->appendChild($BH);
            $BH = $yw->createElementNS(self::XMLDSIGNS, $bV . "\x58\x35\x30\x39\123\145\x72\x69\x61\x6c\x4e\x75\x6d\x62\x65\x72", $xw["\163\x65\x72\x69\141\x6c\x4e\x75\x6d\142\x65\x72"]);
            $WM->appendChild($BH);
            MX:
            wG:
            q0:
            $EV = $yw->createElementNS(self::XMLDSIGNS, $bV . "\130\65\60\x39\103\145\x72\x74\151\x66\x69\x63\x61\x74\145", $Iv);
            $YE->appendChild($EV);
            xB:
        }
        AB:
    }
    public function add509Cert($nd, $Pu = true, $VR = false, $cS = null)
    {
        if (!($bw = $this->getXPathObj())) {
            goto jH;
        }
        self::staticAdd509Cert($this->sigNode, $nd, $Pu, $VR, $bw, $cS);
        jH:
    }
    public function appendToKeyInfo($Cz)
    {
        $x1 = $this->sigNode;
        $yw = $x1->ownerDocument;
        $bw = $this->getXPathObj();
        if (!empty($bw)) {
            goto QT;
        }
        $bw = new DOMXPath($x1->ownerDocument);
        $bw->registerNamespace("\x73\x65\x63\x64\163\x69\x67", self::XMLDSIGNS);
        QT:
        $ZC = "\56\57\x73\145\x63\144\163\151\x67\72\113\145\171\x49\x6e\146\x6f";
        $tu = $bw->query($ZC, $x1);
        $Uv = $tu->item(0);
        if ($Uv) {
            goto HV;
        }
        $bV = '';
        $PG = $x1->lookupPrefix(self::XMLDSIGNS);
        if (empty($PG)) {
            goto qq;
        }
        $bV = $PG . "\72";
        qq:
        $pN = false;
        $Uv = $yw->createElementNS(self::XMLDSIGNS, $bV . "\113\x65\x79\x49\156\146\157");
        $ZC = "\x2e\57\163\145\143\144\163\151\147\x3a\x4f\142\152\145\x63\x74";
        $tu = $bw->query($ZC, $x1);
        if (!($dE = $tu->item(0))) {
            goto QI;
        }
        $dE->parentNode->insertBefore($Uv, $dE);
        $pN = true;
        QI:
        if ($pN) {
            goto ZL;
        }
        $x1->appendChild($Uv);
        ZL:
        HV:
        $Uv->appendChild($Cz);
        return $Uv;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
class XMLSecEnc
{
    const template = "\x3c\x78\145\156\x63\72\105\156\x63\x72\171\160\164\145\x64\x44\x61\x74\141\40\170\x6d\154\156\163\72\170\145\x6e\143\x3d\x27\150\x74\164\160\x3a\57\x2f\167\x77\x77\x2e\x77\x33\56\157\x72\147\57\62\x30\60\61\x2f\60\64\57\170\x6d\154\145\x6e\x63\43\x27\76\xd\12\40\x20\40\74\170\145\156\x63\72\103\x69\x70\x68\x65\162\104\141\164\x61\76\xd\xa\40\x20\x20\40\x20\x20\x3c\x78\x65\x6e\143\72\103\x69\160\x68\145\x72\x56\x61\x6c\165\145\x3e\x3c\57\170\x65\156\143\72\103\x69\160\150\x65\x72\126\x61\x6c\165\x65\x3e\xd\xa\40\x20\40\x3c\x2f\x78\x65\x6e\x63\x3a\103\151\160\150\145\162\x44\x61\164\x61\x3e\xd\12\x3c\57\x78\x65\156\143\x3a\105\x6e\x63\162\x79\x70\164\x65\144\104\141\x74\x61\x3e";
    const Element = "\x68\x74\164\x70\x3a\57\x2f\167\167\167\56\167\x33\56\157\162\x67\x2f\x32\x30\x30\x31\57\60\x34\x2f\170\x6d\154\x65\156\143\43\105\x6c\145\x6d\145\x6e\x74";
    const Content = "\x68\x74\x74\x70\x3a\57\57\167\x77\167\56\x77\x33\x2e\157\x72\x67\57\x32\x30\60\61\x2f\60\64\x2f\170\x6d\154\x65\156\143\x23\x43\x6f\156\x74\x65\156\164";
    const URI = 3;
    const XMLENCNS = "\150\x74\x74\x70\x3a\57\57\x77\167\167\x2e\167\63\x2e\x6f\162\147\x2f\62\60\60\61\57\60\64\x2f\x78\x6d\x6c\x65\x6e\x63\43";
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
    public function addReference($m9, $Cz, $fd)
    {
        if ($Cz instanceof DOMNode) {
            goto Wp;
        }
        throw new Exception("\44\x6e\157\144\145\40\x69\x73\x20\156\157\x74\x20\157\x66\40\164\171\160\x65\x20\x44\x4f\x4d\116\157\144\145");
        Wp:
        $YK = $this->encdoc;
        $this->_resetTemplate();
        $yu = $this->encdoc;
        $this->encdoc = $YK;
        $W1 = XMLSecurityDSig::generateGUID();
        $ya = $yu->documentElement;
        $ya->setAttribute("\x49\144", $W1);
        $this->references[$m9] = array("\156\x6f\x64\x65" => $Cz, "\164\x79\160\145" => $fd, "\x65\x6e\143\x6e\x6f\x64\x65" => $yu, "\162\145\x66\165\x72\151" => $W1);
    }
    public function setNode($Cz)
    {
        $this->rawNode = $Cz;
    }
    public function encryptNode($cT, $BE = true)
    {
        $eY = '';
        if (!empty($this->rawNode)) {
            goto RP;
        }
        throw new Exception("\116\157\x64\145\x20\x74\157\x20\145\x6e\143\x72\171\x70\164\40\x68\141\x73\40\156\157\x74\x20\x62\x65\145\156\40\163\145\164");
        RP:
        if ($cT instanceof XMLSecurityKey) {
            goto NM;
        }
        throw new Exception("\x49\x6e\166\141\154\151\144\x20\x4b\145\x79");
        NM:
        $Sj = $this->rawNode->ownerDocument;
        $Nw = new DOMXPath($this->encdoc);
        $mh = $Nw->query("\57\x78\145\x6e\x63\72\x45\x6e\x63\162\x79\160\x74\145\144\104\141\164\141\57\170\145\156\x63\x3a\103\x69\x70\x68\x65\162\x44\141\x74\x61\x2f\170\x65\x6e\143\72\103\x69\x70\x68\145\x72\126\x61\x6c\165\x65");
        $Qr = $mh->item(0);
        if (!($Qr == null)) {
            goto YS;
        }
        throw new Exception("\105\162\x72\x6f\x72\x20\x6c\x6f\143\x61\164\151\x6e\147\x20\103\151\x70\150\145\x72\126\x61\x6c\x75\145\x20\145\154\x65\x6d\145\156\x74\40\x77\x69\x74\x68\151\x6e\40\164\145\155\160\154\141\164\x65");
        YS:
        switch ($this->type) {
            case self::Element:
                $eY = $Sj->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\124\171\160\145", self::Element);
                goto Fa;
            case self::Content:
                $LJ = $this->rawNode->childNodes;
                foreach ($LJ as $sb) {
                    $eY .= $Sj->saveXML($sb);
                    S0:
                }
                rL:
                $this->encdoc->documentElement->setAttribute("\124\x79\x70\145", self::Content);
                goto Fa;
            default:
                throw new Exception("\124\x79\160\145\x20\151\163\40\x63\165\162\x72\x65\156\164\154\171\40\x6e\157\164\x20\163\165\160\160\x6f\x72\x74\145\144");
        }
        L1:
        Fa:
        $rW = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\x6e\143\72\x45\x6e\143\x72\171\x70\x74\x69\157\x6e\115\145\x74\150\x6f\x64"));
        $rW->setAttribute("\x41\x6c\147\x6f\162\x69\164\x68\x6d", $cT->getAlgorithm());
        $Qr->parentNode->parentNode->insertBefore($rW, $Qr->parentNode->parentNode->firstChild);
        $Bh = base64_encode($cT->encryptData($eY));
        $e4 = $this->encdoc->createTextNode($Bh);
        $Qr->appendChild($e4);
        if ($BE) {
            goto yt;
        }
        return $this->encdoc->documentElement;
        goto Tm;
        yt:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto r9;
                }
                return $this->encdoc;
                r9:
                $yc = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($yc, $this->rawNode);
                return $yc;
            case self::Content:
                $yc = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                Sw:
                if (!$this->rawNode->firstChild) {
                    goto Pg;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto Sw;
                Pg:
                $this->rawNode->appendChild($yc);
                return $yc;
        }
        Nv:
        b_:
        Tm:
    }
    public function encryptReferences($cT)
    {
        $n_ = $this->rawNode;
        $Cv = $this->type;
        foreach ($this->references as $m9 => $YH) {
            $this->encdoc = $YH["\145\156\143\x6e\x6f\x64\145"];
            $this->rawNode = $YH["\x6e\157\x64\x65"];
            $this->type = $YH["\x74\x79\x70\x65"];
            try {
                $cP = $this->encryptNode($cT);
                $this->references[$m9]["\145\156\143\156\x6f\x64\x65"] = $cP;
            } catch (Exception $oB) {
                $this->rawNode = $n_;
                $this->type = $Cv;
                throw $oB;
            }
            yK:
        }
        Cg:
        $this->rawNode = $n_;
        $this->type = $Cv;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto pv;
        }
        throw new Exception("\116\157\144\x65\x20\x74\x6f\40\144\x65\143\x72\171\x70\164\x20\x68\141\163\x20\x6e\157\164\40\142\145\x65\x6e\40\163\x65\164");
        pv:
        $Sj = $this->rawNode->ownerDocument;
        $Nw = new DOMXPath($Sj);
        $Nw->registerNamespace("\x78\x6d\x6c\x65\x6e\143\162", self::XMLENCNS);
        $ZC = "\x2e\57\170\155\x6c\x65\x6e\143\162\x3a\x43\x69\160\150\x65\162\x44\141\x74\141\x2f\170\x6d\154\x65\x6e\143\162\72\103\x69\160\x68\145\x72\x56\x61\x6c\x75\145";
        $tu = $Nw->query($ZC, $this->rawNode);
        $Cz = $tu->item(0);
        if ($Cz) {
            goto A0;
        }
        return null;
        A0:
        return base64_decode($Cz->nodeValue);
    }
    public function decryptNode($cT, $BE = true)
    {
        if ($cT instanceof XMLSecurityKey) {
            goto TL;
        }
        throw new Exception("\x49\156\x76\141\x6c\151\x64\x20\x4b\145\x79");
        TL:
        $Ys = $this->getCipherValue();
        if ($Ys) {
            goto UE;
        }
        throw new Exception("\x43\x61\x6e\156\157\x74\x20\154\157\x63\141\164\x65\x20\x65\x6e\x63\x72\x79\x70\164\145\144\x20\x64\141\164\x61");
        goto Sh;
        UE:
        $ix = $cT->decryptData($Ys);
        if ($BE) {
            goto Mk;
        }
        return $ix;
        goto cs;
        Mk:
        switch ($this->type) {
            case self::Element:
                $uz = new DOMDocument();
                $uz->loadXML($ix);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto Jf;
                }
                return $uz;
                Jf:
                $yc = $this->rawNode->ownerDocument->importNode($uz->documentElement, true);
                $this->rawNode->parentNode->replaceChild($yc, $this->rawNode);
                return $yc;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto TB;
                }
                $Sj = $this->rawNode->ownerDocument;
                goto bb;
                TB:
                $Sj = $this->rawNode;
                bb:
                $EZ = $Sj->createDocumentFragment();
                $EZ->appendXML($ix);
                $nt = $this->rawNode->parentNode;
                $nt->replaceChild($EZ, $this->rawNode);
                return $nt;
            default:
                return $ix;
        }
        mV:
        Kb:
        cs:
        Sh:
    }
    public function encryptKey($Lz, $PC, $Ku = true)
    {
        if (!(!$Lz instanceof XMLSecurityKey || !$PC instanceof XMLSecurityKey)) {
            goto AU;
        }
        throw new Exception("\111\x6e\166\141\x6c\151\x64\40\x4b\145\x79");
        AU:
        $IH = base64_encode($Lz->encryptData($PC->key));
        $t2 = $this->encdoc->documentElement;
        $sV = $this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\143\72\105\x6e\143\x72\x79\x70\164\x65\x64\x4b\x65\x79");
        if ($Ku) {
            goto xW;
        }
        $this->encKey = $sV;
        goto J9;
        xW:
        $Uv = $t2->insertBefore($this->encdoc->createElementNS("\x68\x74\x74\x70\x3a\x2f\57\x77\167\x77\56\167\x33\56\x6f\x72\x67\x2f\x32\60\x30\x30\57\60\71\57\170\155\154\144\x73\151\x67\x23", "\x64\x73\x69\x67\72\113\x65\x79\x49\x6e\146\157"), $t2->firstChild);
        $Uv->appendChild($sV);
        J9:
        $rW = $sV->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\x3a\105\156\143\162\171\x70\164\x69\x6f\156\x4d\145\164\x68\x6f\144"));
        $rW->setAttribute("\x41\154\147\x6f\162\x69\164\x68\155", $Lz->getAlgorithm());
        if (empty($Lz->name)) {
            goto Z4;
        }
        $Uv = $sV->appendChild($this->encdoc->createElementNS("\150\x74\x74\160\x3a\57\x2f\x77\x77\167\x2e\x77\63\56\157\162\x67\x2f\62\x30\60\x30\x2f\x30\71\57\x78\x6d\154\x64\x73\x69\147\x23", "\144\163\x69\x67\72\113\145\x79\111\x6e\146\x6f"));
        $Uv->appendChild($this->encdoc->createElementNS("\150\164\x74\160\x3a\57\57\x77\x77\167\56\167\x33\x2e\157\x72\147\57\x32\x30\x30\x30\57\60\71\x2f\170\x6d\x6c\x64\163\x69\147\43", "\x64\x73\151\147\x3a\113\x65\x79\x4e\141\155\x65", $Lz->name));
        Z4:
        $mm = $sV->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\143\72\x43\151\160\150\x65\x72\x44\141\164\141"));
        $mm->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\156\143\x3a\x43\151\x70\150\x65\162\x56\x61\x6c\x75\145", $IH));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto PH;
        }
        $nw = $sV->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\x6e\143\72\122\145\146\145\162\145\156\x63\145\114\x69\163\164"));
        foreach ($this->references as $m9 => $YH) {
            $W1 = $YH["\x72\x65\146\165\162\151"];
            $Gy = $nw->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\x6e\x63\72\104\141\164\x61\x52\x65\146\145\x72\x65\156\x63\x65"));
            $Gy->setAttribute("\x55\122\x49", "\x23" . $W1);
            js:
        }
        mE:
        PH:
        return;
    }
    public function decryptKey($sV)
    {
        if ($sV->isEncrypted) {
            goto Bh;
        }
        throw new Exception("\113\145\171\40\x69\x73\x20\156\x6f\164\40\105\x6e\x63\x72\x79\160\x74\145\x64");
        Bh:
        if (!empty($sV->key)) {
            goto Nc;
        }
        throw new Exception("\113\145\171\x20\x69\x73\x20\x6d\x69\x73\x73\x69\x6e\x67\40\144\141\x74\141\x20\164\157\40\x70\x65\x72\x66\157\162\x6d\40\164\x68\145\x20\x64\x65\x63\x72\x79\x70\x74\x69\157\x6e");
        Nc:
        return $this->decryptNode($sV, false);
    }
    public function locateEncryptedData($ya)
    {
        if ($ya instanceof DOMDocument) {
            goto xd;
        }
        $Sj = $ya->ownerDocument;
        goto Yo;
        xd:
        $Sj = $ya;
        Yo:
        if (!$Sj) {
            goto Vf;
        }
        $bw = new DOMXPath($Sj);
        $ZC = "\57\57\52\133\154\157\x63\x61\154\55\x6e\141\155\x65\50\x29\x3d\x27\105\156\x63\x72\x79\160\x74\145\144\104\x61\x74\x61\x27\40\x61\x6e\144\x20\156\x61\155\145\x73\160\x61\143\x65\x2d\165\162\x69\50\51\75\x27" . self::XMLENCNS . "\47\x5d";
        $tu = $bw->query($ZC);
        return $tu->item(0);
        Vf:
        return null;
    }
    public function locateKey($Cz = null)
    {
        if (!empty($Cz)) {
            goto FP;
        }
        $Cz = $this->rawNode;
        FP:
        if ($Cz instanceof DOMNode) {
            goto Vo;
        }
        return null;
        Vo:
        if (!($Sj = $Cz->ownerDocument)) {
            goto Tv;
        }
        $bw = new DOMXPath($Sj);
        $bw->registerNamespace("\x78\x6d\154\163\145\x63\x65\156\x63", self::XMLENCNS);
        $ZC = "\x2e\x2f\57\170\155\154\x73\145\x63\x65\156\143\x3a\x45\x6e\x63\162\x79\x70\x74\151\x6f\x6e\x4d\x65\x74\150\157\144";
        $tu = $bw->query($ZC, $Cz);
        if (!($Ln = $tu->item(0))) {
            goto YO;
        }
        $f8 = $Ln->getAttribute("\x41\x6c\147\157\x72\x69\164\150\155");
        try {
            $cT = new XMLSecurityKey($f8, array("\x74\171\x70\145" => "\160\x72\x69\166\x61\164\145"));
        } catch (Exception $oB) {
            return null;
        }
        return $cT;
        YO:
        Tv:
        return null;
    }
    public static function staticLocateKeyInfo($mk = null, $Cz = null)
    {
        if (!(empty($Cz) || !$Cz instanceof DOMNode)) {
            goto e6;
        }
        return null;
        e6:
        $Sj = $Cz->ownerDocument;
        if ($Sj) {
            goto Go;
        }
        return null;
        Go:
        $bw = new DOMXPath($Sj);
        $bw->registerNamespace("\x78\x6d\x6c\x73\145\x63\x65\156\143", self::XMLENCNS);
        $bw->registerNamespace("\x78\x6d\154\x73\x65\143\x64\x73\151\147", XMLSecurityDSig::XMLDSIGNS);
        $ZC = "\56\57\170\155\154\163\145\143\144\x73\151\147\72\x4b\145\171\111\x6e\x66\157";
        $tu = $bw->query($ZC, $Cz);
        $Ln = $tu->item(0);
        if ($Ln) {
            goto Va;
        }
        return $mk;
        Va:
        foreach ($Ln->childNodes as $sb) {
            switch ($sb->localName) {
                case "\113\145\x79\116\141\x6d\145":
                    if (empty($mk)) {
                        goto qJ;
                    }
                    $mk->name = $sb->nodeValue;
                    qJ:
                    goto dy;
                case "\113\x65\171\x56\x61\154\x75\145":
                    foreach ($sb->childNodes as $sy) {
                        switch ($sy->localName) {
                            case "\x44\123\x41\113\x65\x79\x56\141\154\x75\x65":
                                throw new Exception("\104\123\x41\113\145\171\x56\141\154\x75\x65\40\143\x75\162\162\145\156\x74\154\171\40\156\x6f\x74\x20\163\165\160\160\x6f\162\164\145\144");
                            case "\x52\x53\101\113\145\x79\x56\x61\x6c\x75\x65":
                                $W_ = null;
                                $xx = null;
                                if (!($SQ = $sy->getElementsByTagName("\115\x6f\x64\165\x6c\x75\163")->item(0))) {
                                    goto fS;
                                }
                                $W_ = base64_decode($SQ->nodeValue);
                                fS:
                                if (!($kv = $sy->getElementsByTagName("\105\170\x70\x6f\156\145\x6e\x74")->item(0))) {
                                    goto oE;
                                }
                                $xx = base64_decode($kv->nodeValue);
                                oE:
                                if (!(empty($W_) || empty($xx))) {
                                    goto nz;
                                }
                                throw new Exception("\x4d\x69\x73\x73\151\156\x67\x20\x4d\x6f\144\165\x6c\x75\x73\x20\x6f\162\x20\105\170\x70\x6f\x6e\145\x6e\x74");
                                nz:
                                $OP = XMLSecurityKey::convertRSA($W_, $xx);
                                $mk->loadKey($OP);
                                goto XI;
                        }
                        ZA:
                        XI:
                        g6:
                    }
                    hd:
                    goto dy;
                case "\x52\145\164\x72\151\x65\x76\141\x6c\115\x65\x74\x68\x6f\144":
                    $fd = $sb->getAttribute("\124\171\x70\x65");
                    if (!($fd !== "\150\164\164\160\x3a\57\57\167\167\x77\x2e\167\63\x2e\x6f\x72\x67\57\x32\x30\x30\x31\57\60\64\57\170\x6d\x6c\x65\156\143\43\x45\x6e\143\162\x79\160\x74\145\144\x4b\x65\171")) {
                        goto HY;
                    }
                    goto dy;
                    HY:
                    $mL = $sb->getAttribute("\x55\122\x49");
                    if (!($mL[0] !== "\x23")) {
                        goto bl;
                    }
                    goto dy;
                    bl:
                    $UZ = substr($mL, 1);
                    $ZC = "\57\x2f\170\155\x6c\x73\x65\143\145\x6e\x63\72\105\156\x63\x72\171\x70\164\145\144\x4b\x65\x79\x5b\x40\x49\144\75\47{$UZ}\47\135";
                    $dY = $bw->query($ZC)->item(0);
                    if ($dY) {
                        goto vs;
                    }
                    throw new Exception("\125\156\141\x62\154\x65\40\x74\x6f\x20\154\157\x63\141\164\145\40\x45\x6e\x63\162\171\160\x74\x65\x64\x4b\x65\x79\x20\167\x69\x74\150\40\x40\x49\144\x3d\x27{$UZ}\x27\x2e");
                    vs:
                    return XMLSecurityKey::fromEncryptedKeyElement($dY);
                case "\105\156\x63\x72\171\x70\164\145\x64\113\145\x79":
                    return XMLSecurityKey::fromEncryptedKeyElement($sb);
                case "\130\x35\x30\71\104\x61\164\141":
                    if (!($tU = $sb->getElementsByTagName("\x58\x35\x30\x39\103\x65\162\164\x69\146\x69\143\x61\164\145"))) {
                        goto Ac;
                    }
                    if (!($tU->length > 0)) {
                        goto x4;
                    }
                    $G5 = $tU->item(0)->textContent;
                    $G5 = str_replace(array("\xd", "\xa", "\40"), '', $G5);
                    $G5 = "\x2d\x2d\55\55\x2d\x42\105\x47\111\116\40\103\105\x52\124\111\x46\x49\x43\101\x54\105\x2d\55\55\55\55\12" . chunk_split($G5, 64, "\12") . "\x2d\55\x2d\x2d\x2d\105\116\x44\40\x43\x45\122\x54\x49\x46\111\103\x41\x54\105\x2d\x2d\55\x2d\55\xa";
                    $mk->loadKey($G5, false, true);
                    x4:
                    Ac:
                    goto dy;
            }
            CQ:
            dy:
            Bv:
        }
        Hn:
        return $mk;
    }
    public function locateKeyInfo($mk = null, $Cz = null)
    {
        if (!empty($Cz)) {
            goto kx;
        }
        $Cz = $this->rawNode;
        kx:
        return self::staticLocateKeyInfo($mk, $Cz);
    }
}
