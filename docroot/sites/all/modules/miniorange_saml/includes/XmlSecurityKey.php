<?php


class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\150\x74\164\x70\72\57\x2f\x77\x77\x77\56\167\x33\x2e\157\162\147\x2f\x32\60\x30\x31\57\x30\64\x2f\170\x6d\x6c\145\x6e\x63\x23\164\x72\151\160\154\x65\144\x65\163\x2d\143\142\x63";
    const AES128_CBC = "\x68\164\x74\x70\72\x2f\57\x77\x77\167\x2e\167\63\56\157\x72\147\x2f\x32\60\x30\61\57\x30\64\57\x78\155\x6c\x65\x6e\143\x23\x61\x65\163\x31\62\x38\55\143\x62\143";
    const AES192_CBC = "\x68\164\x74\x70\72\57\x2f\x77\x77\167\x2e\x77\x33\x2e\157\x72\x67\x2f\x32\60\x30\61\57\60\x34\57\x78\x6d\154\145\156\143\43\141\145\163\x31\x39\62\55\x63\x62\143";
    const AES256_CBC = "\x68\x74\164\x70\x3a\57\57\167\167\x77\56\167\63\56\157\x72\147\57\x32\60\x30\61\x2f\x30\64\57\x78\x6d\154\145\x6e\x63\43\141\145\163\x32\x35\66\55\x63\142\x63";
    const RSA_1_5 = "\x68\164\x74\x70\x3a\57\x2f\167\x77\167\x2e\167\x33\x2e\157\162\x67\x2f\62\x30\60\61\x2f\x30\64\57\x78\x6d\x6c\145\156\x63\x23\162\x73\x61\x2d\61\137\65";
    const RSA_OAEP_MGF1P = "\150\164\164\x70\72\x2f\57\x77\167\x77\x2e\x77\63\x2e\x6f\162\147\57\62\60\x30\61\57\60\64\57\x78\155\x6c\145\x6e\143\x23\162\163\141\x2d\157\x61\145\160\x2d\x6d\x67\146\61\160";
    const DSA_SHA1 = "\x68\164\164\x70\x3a\x2f\57\167\167\x77\56\167\63\56\157\162\x67\x2f\62\x30\60\60\x2f\60\x39\57\170\155\154\144\x73\x69\147\43\144\163\x61\55\x73\x68\141\x31";
    const RSA_SHA1 = "\x68\164\x74\x70\72\57\57\x77\x77\167\x2e\x77\x33\56\x6f\162\147\57\62\x30\60\x30\x2f\60\x39\57\170\x6d\154\144\163\151\x67\x23\x72\163\x61\55\x73\x68\141\61";
    const RSA_SHA256 = "\x68\x74\x74\x70\x3a\57\57\x77\x77\167\56\x77\x33\x2e\157\x72\147\57\x32\60\x30\61\x2f\60\64\x2f\170\155\x6c\144\x73\151\x67\x2d\x6d\x6f\162\145\x23\x72\x73\x61\55\163\150\141\x32\x35\66";
    const RSA_SHA384 = "\150\x74\x74\x70\72\57\57\167\x77\167\x2e\x77\63\x2e\157\162\147\57\x32\60\60\x31\x2f\60\64\x2f\170\x6d\x6c\144\x73\x69\147\55\x6d\x6f\x72\145\43\162\x73\141\x2d\x73\x68\x61\63\x38\x34";
    const RSA_SHA512 = "\x68\x74\x74\160\72\x2f\57\x77\167\x77\56\167\x33\x2e\157\x72\147\57\62\60\x30\61\57\60\x34\x2f\x78\x6d\154\144\163\x69\x67\55\155\x6f\x72\145\x23\x72\x73\x61\x2d\x73\150\x61\x35\x31\62";
    const HMAC_SHA1 = "\150\x74\164\x70\72\x2f\57\x77\x77\x77\x2e\x77\x33\56\157\x72\x67\57\x32\x30\x30\x30\57\60\x39\57\x78\x6d\x6c\x64\x73\151\x67\43\x68\155\141\x63\x2d\x73\x68\141\x31";
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
    public function __construct($S2, $w0 = null)
    {
        switch ($S2) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\x6c\151\x62\x72\x61\x72\x79"] = "\x6f\x70\x65\x6e\163\x73\x6c";
                $this->cryptParams["\143\151\160\150\x65\x72"] = "\x64\x65\x73\x2d\x65\144\145\x33\55\x63\x62\143";
                $this->cryptParams["\x74\171\x70\x65"] = "\163\171\155\x6d\x65\164\162\x69\143";
                $this->cryptParams["\155\145\x74\x68\x6f\x64"] = "\x68\164\x74\x70\72\x2f\57\x77\167\x77\x2e\x77\x33\x2e\x6f\162\x67\57\62\x30\x30\61\57\60\64\x2f\170\x6d\x6c\x65\x6e\143\43\x74\162\x69\x70\154\145\144\145\x73\55\143\142\x63";
                $this->cryptParams["\153\x65\171\x73\x69\x7a\145"] = 24;
                $this->cryptParams["\142\154\x6f\x63\153\x73\151\172\x65"] = 8;
                goto Na;
            case self::AES128_CBC:
                $this->cryptParams["\154\x69\x62\162\x61\162\171"] = "\x6f\160\145\x6e\163\163\154";
                $this->cryptParams["\x63\151\160\x68\x65\x72"] = "\x61\145\x73\55\61\62\70\55\143\142\143";
                $this->cryptParams["\164\171\160\145"] = "\163\x79\x6d\155\x65\x74\162\x69\x63";
                $this->cryptParams["\155\145\x74\x68\x6f\x64"] = "\x68\164\164\x70\x3a\57\57\x77\167\167\56\x77\x33\x2e\157\x72\x67\x2f\x32\60\60\x31\57\x30\64\57\x78\x6d\154\145\x6e\143\x23\141\145\x73\61\62\x38\x2d\x63\142\x63";
                $this->cryptParams["\x6b\145\171\x73\151\172\x65"] = 16;
                $this->cryptParams["\x62\154\x6f\143\x6b\163\151\x7a\x65"] = 16;
                goto Na;
            case self::AES192_CBC:
                $this->cryptParams["\154\151\142\x72\x61\162\171"] = "\157\160\145\x6e\163\x73\154";
                $this->cryptParams["\143\151\160\x68\145\162"] = "\x61\145\x73\55\x31\71\x32\55\x63\x62\x63";
                $this->cryptParams["\164\x79\x70\x65"] = "\163\x79\155\x6d\145\x74\x72\151\x63";
                $this->cryptParams["\x6d\145\164\x68\157\144"] = "\150\x74\164\x70\72\x2f\x2f\x77\x77\x77\x2e\x77\x33\x2e\157\x72\147\57\x32\60\x30\x31\x2f\x30\x34\57\x78\x6d\154\x65\x6e\143\x23\x61\145\x73\x31\71\x32\x2d\143\142\x63";
                $this->cryptParams["\x6b\x65\171\163\151\x7a\145"] = 24;
                $this->cryptParams["\x62\x6c\x6f\143\153\x73\151\x7a\x65"] = 16;
                goto Na;
            case self::AES256_CBC:
                $this->cryptParams["\154\151\142\162\x61\x72\x79"] = "\x6f\160\145\156\x73\163\154";
                $this->cryptParams["\143\151\x70\150\x65\x72"] = "\141\x65\x73\55\x32\x35\66\55\143\142\x63";
                $this->cryptParams["\x74\x79\x70\145"] = "\163\171\155\x6d\x65\164\x72\151\143";
                $this->cryptParams["\155\145\164\x68\157\x64"] = "\x68\164\x74\160\x3a\57\x2f\x77\x77\x77\x2e\x77\63\x2e\157\162\147\57\x32\60\x30\x31\x2f\x30\x34\57\x78\155\x6c\145\x6e\143\43\x61\145\163\62\x35\x36\55\143\x62\x63";
                $this->cryptParams["\x6b\145\x79\x73\151\172\145"] = 32;
                $this->cryptParams["\142\x6c\x6f\x63\153\x73\x69\172\x65"] = 16;
                goto Na;
            case self::RSA_1_5:
                $this->cryptParams["\154\151\142\x72\x61\x72\x79"] = "\x6f\160\145\156\163\163\x6c";
                $this->cryptParams["\160\x61\x64\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x6d\145\164\150\x6f\144"] = "\x68\x74\x74\160\72\x2f\x2f\167\167\167\56\167\63\x2e\x6f\x72\x67\x2f\62\60\x30\x31\57\x30\x34\x2f\170\x6d\x6c\145\x6e\x63\43\x72\x73\141\55\x31\x5f\x35";
                if (!(is_array($w0) && !empty($w0["\x74\171\160\145"]))) {
                    goto WA;
                }
                if (!($w0["\x74\x79\160\x65"] == "\160\x75\142\154\x69\x63" || $w0["\164\x79\160\145"] == "\160\162\x69\x76\141\164\x65")) {
                    goto mt;
                }
                $this->cryptParams["\164\x79\160\x65"] = $w0["\164\171\x70\x65"];
                goto Na;
                mt:
                WA:
                throw new Exception("\x43\x65\162\x74\151\x66\151\x63\141\164\x65\40\42\x74\171\x70\x65\42\40\x28\160\162\151\x76\141\x74\145\x2f\160\x75\x62\x6c\151\x63\51\40\x6d\165\x73\164\x20\142\145\x20\x70\141\163\x73\145\x64\40\166\x69\x61\x20\x70\x61\x72\141\x6d\x65\x74\x65\x72\163");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\x6c\x69\142\162\141\x72\171"] = "\157\160\145\x6e\163\163\154";
                $this->cryptParams["\160\x61\144\144\x69\x6e\x67"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\x6d\145\164\x68\x6f\144"] = "\x68\164\164\x70\72\57\x2f\x77\167\x77\56\x77\x33\56\x6f\162\147\57\x32\x30\60\61\57\60\64\x2f\170\x6d\x6c\x65\156\x63\x23\x72\163\141\55\157\x61\145\x70\55\x6d\x67\x66\61\160";
                $this->cryptParams["\150\141\163\150"] = null;
                if (!(is_array($w0) && !empty($w0["\164\x79\160\x65"]))) {
                    goto gH;
                }
                if (!($w0["\x74\x79\160\x65"] == "\x70\x75\142\x6c\x69\143" || $w0["\164\171\x70\x65"] == "\160\x72\151\166\141\164\145")) {
                    goto a6;
                }
                $this->cryptParams["\164\x79\160\145"] = $w0["\164\x79\160\145"];
                goto Na;
                a6:
                gH:
                throw new Exception("\103\x65\x72\164\x69\146\151\x63\141\x74\145\40\42\164\x79\x70\145\x22\x20\50\x70\x72\151\166\141\x74\x65\57\x70\x75\142\154\x69\x63\x29\x20\155\x75\x73\x74\x20\x62\x65\x20\160\141\x73\163\x65\144\40\x76\151\141\x20\160\x61\162\141\x6d\145\164\x65\x72\163");
            case self::RSA_SHA1:
                $this->cryptParams["\154\151\x62\162\x61\x72\171"] = "\x6f\160\145\x6e\x73\163\154";
                $this->cryptParams["\155\x65\164\x68\x6f\x64"] = "\150\164\164\160\x3a\x2f\57\167\x77\x77\x2e\167\x33\56\157\162\x67\x2f\62\60\60\x30\x2f\x30\x39\x2f\x78\155\154\144\163\151\147\x23\162\x73\x61\x2d\x73\x68\141\61";
                $this->cryptParams["\x70\x61\x64\144\151\156\147"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($w0) && !empty($w0["\164\x79\160\145"]))) {
                    goto x7;
                }
                if (!($w0["\164\171\160\x65"] == "\160\x75\142\154\151\143" || $w0["\x74\171\160\x65"] == "\160\162\x69\166\x61\x74\x65")) {
                    goto oZ;
                }
                $this->cryptParams["\x74\171\x70\145"] = $w0["\x74\x79\x70\145"];
                goto Na;
                oZ:
                x7:
                throw new Exception("\103\145\x72\164\151\x66\x69\x63\141\x74\x65\x20\x22\164\171\160\x65\42\40\x28\160\162\151\166\x61\x74\x65\57\x70\165\x62\x6c\x69\x63\x29\40\x6d\x75\x73\x74\40\x62\x65\40\160\141\x73\x73\x65\x64\x20\x76\x69\141\40\160\x61\162\141\155\145\164\145\x72\x73");
            case self::RSA_SHA256:
                $this->cryptParams["\x6c\151\142\162\141\x72\171"] = "\157\160\x65\156\163\x73\x6c";
                $this->cryptParams["\155\x65\x74\150\157\x64"] = "\x68\164\x74\160\72\57\57\167\167\167\x2e\x77\x33\x2e\x6f\162\x67\x2f\x32\60\x30\61\57\60\x34\57\x78\x6d\154\144\163\x69\x67\x2d\x6d\157\x72\145\x23\x72\x73\141\55\163\150\x61\x32\x35\66";
                $this->cryptParams["\160\141\x64\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\x67\145\x73\164"] = "\123\x48\x41\62\x35\x36";
                if (!(is_array($w0) && !empty($w0["\x74\171\x70\x65"]))) {
                    goto Qm;
                }
                if (!($w0["\164\171\160\x65"] == "\160\165\142\x6c\x69\x63" || $w0["\x74\x79\x70\145"] == "\160\x72\x69\166\x61\x74\145")) {
                    goto ei;
                }
                $this->cryptParams["\164\x79\160\145"] = $w0["\164\x79\x70\145"];
                goto Na;
                ei:
                Qm:
                throw new Exception("\103\145\x72\164\x69\x66\x69\x63\x61\x74\x65\40\x22\x74\x79\x70\145\42\40\50\x70\x72\151\166\x61\164\145\x2f\x70\x75\x62\154\x69\143\51\x20\155\x75\x73\164\40\142\145\40\160\x61\x73\x73\145\144\40\166\x69\x61\x20\160\x61\x72\141\155\145\164\145\162\163");
            case self::RSA_SHA384:
                $this->cryptParams["\154\x69\142\x72\141\162\171"] = "\x6f\x70\x65\x6e\x73\x73\154";
                $this->cryptParams["\x6d\145\164\150\157\144"] = "\150\164\164\160\x3a\57\57\x77\x77\x77\56\167\63\56\157\162\147\x2f\x32\x30\x30\61\57\x30\64\x2f\x78\155\x6c\144\163\151\x67\x2d\155\157\162\x65\43\162\x73\x61\55\163\x68\141\63\70\x34";
                $this->cryptParams["\x70\x61\x64\144\x69\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\x69\147\145\163\164"] = "\123\110\x41\63\70\64";
                if (!(is_array($w0) && !empty($w0["\164\x79\x70\145"]))) {
                    goto Zy;
                }
                if (!($w0["\x74\171\160\145"] == "\x70\x75\142\154\151\143" || $w0["\x74\x79\x70\145"] == "\x70\162\x69\166\141\164\145")) {
                    goto UR;
                }
                $this->cryptParams["\x74\171\160\x65"] = $w0["\164\x79\x70\x65"];
                goto Na;
                UR:
                Zy:
                throw new Exception("\x43\x65\162\x74\151\x66\151\143\x61\164\145\x20\42\164\x79\x70\145\x22\x20\50\x70\162\x69\x76\141\164\145\x2f\160\x75\142\x6c\151\x63\x29\x20\155\165\163\x74\40\142\x65\40\x70\x61\163\163\145\144\40\x76\x69\x61\x20\x70\x61\162\x61\155\x65\164\x65\x72\163");
            case self::RSA_SHA512:
                $this->cryptParams["\154\151\142\162\141\x72\171"] = "\157\160\145\156\163\x73\154";
                $this->cryptParams["\x6d\145\164\x68\157\144"] = "\150\x74\x74\160\x3a\x2f\x2f\x77\167\x77\x2e\x77\63\x2e\x6f\162\147\57\62\60\x30\61\x2f\x30\64\57\x78\155\x6c\144\x73\151\147\55\155\157\x72\145\x23\x72\x73\x61\x2d\163\x68\x61\x35\61\x32";
                $this->cryptParams["\x70\141\x64\144\151\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\x69\147\145\x73\x74"] = "\x53\x48\x41\65\x31\x32";
                if (!(is_array($w0) && !empty($w0["\164\x79\x70\145"]))) {
                    goto BL;
                }
                if (!($w0["\164\171\160\x65"] == "\x70\165\142\x6c\x69\143" || $w0["\x74\171\x70\145"] == "\x70\162\151\x76\141\x74\x65")) {
                    goto zf;
                }
                $this->cryptParams["\164\x79\160\x65"] = $w0["\164\x79\160\x65"];
                goto Na;
                zf:
                BL:
                throw new Exception("\x43\145\x72\164\x69\146\151\x63\141\x74\x65\40\42\164\171\160\x65\x22\40\x28\x70\162\x69\x76\141\x74\x65\x2f\x70\x75\x62\154\x69\143\x29\40\x6d\165\x73\164\40\142\145\x20\x70\x61\x73\163\x65\144\x20\x76\151\141\x20\160\141\x72\141\x6d\145\x74\x65\162\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\154\151\142\162\x61\162\x79"] = $S2;
                $this->cryptParams["\x6d\145\164\150\x6f\144"] = "\150\164\x74\160\x3a\57\x2f\x77\167\x77\56\x77\63\56\157\162\147\x2f\62\60\60\x30\57\60\71\57\x78\155\x6c\144\x73\151\x67\x23\150\x6d\x61\143\x2d\163\150\141\x31";
                goto Na;
            default:
                throw new Exception("\x49\x6e\166\x61\154\151\x64\40\113\145\x79\40\124\171\x70\x65");
        }
        V5:
        Na:
        $this->type = $S2;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\153\x65\171\x73\x69\172\x65"])) {
            goto Fy;
        }
        return null;
        Fy:
        return $this->cryptParams["\153\x65\171\x73\151\x7a\x65"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\x6b\145\171\x73\x69\x7a\x65"])) {
            goto MY;
        }
        throw new Exception("\125\156\x6b\156\157\167\x6e\40\153\145\x79\x20\163\151\x7a\145\x20\x66\x6f\x72\x20\x74\x79\x70\145\x20\42" . $this->type . "\x22\x2e");
        MY:
        $K1 = $this->cryptParams["\153\145\x79\163\151\172\x65"];
        $AM = openssl_random_pseudo_bytes($K1);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto lY;
        }
        $rJ = 0;
        Uv:
        if (!($rJ < strlen($AM))) {
            goto f8;
        }
        $kh = ord($AM[$rJ]) & 254;
        $Lk = 1;
        $P1 = 1;
        Ah:
        if (!($P1 < 8)) {
            goto f2;
        }
        $Lk ^= $kh >> $P1 & 1;
        ha:
        $P1++;
        goto Ah;
        f2:
        $kh |= $Lk;
        $AM[$rJ] = chr($kh);
        xU:
        $rJ++;
        goto Uv;
        f8:
        lY:
        $this->key = $AM;
        return $AM;
    }
    public static function getRawThumbprint($fN)
    {
        $w_ = explode("\xa", $fN);
        $w5 = '';
        $Ku = false;
        foreach ($w_ as $BP) {
            if (!$Ku) {
                goto Xq;
            }
            if (!(strncmp($BP, "\55\55\55\x2d\55\x45\x4e\104\40\x43\105\x52\124\x49\x46\111\x43\101\x54\105", 20) == 0)) {
                goto g4;
            }
            goto ji;
            g4:
            $w5 .= trim($BP);
            goto Gm;
            Xq:
            if (!(strncmp($BP, "\55\x2d\55\55\x2d\102\x45\x47\x49\116\40\103\105\x52\124\x49\x46\111\x43\101\124\105", 22) == 0)) {
                goto f0;
            }
            $Ku = true;
            f0:
            Gm:
            YC:
        }
        ji:
        if (empty($w5)) {
            goto jR;
        }
        return strtolower(sha1(base64_decode($w5)));
        jR:
        return null;
    }
    public function loadKey($AM, $CN = false, $sj = false)
    {
        if ($CN) {
            goto wf;
        }
        $this->key = $AM;
        goto oF;
        wf:
        $this->key = file_get_contents($AM);
        oF:
        if ($sj) {
            goto Ut;
        }
        $this->x509Certificate = null;
        goto H4;
        Ut:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $Xk);
        $this->x509Certificate = $Xk;
        $this->key = $Xk;
        H4:
        if (!($this->cryptParams["\x6c\151\x62\x72\141\x72\x79"] == "\157\x70\145\x6e\x73\x73\154")) {
            goto UO;
        }
        switch ($this->cryptParams["\x74\171\x70\145"]) {
            case "\x70\x75\x62\x6c\151\x63":
                if (!$sj) {
                    goto fD;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                fD:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto Do1;
                }
                throw new Exception("\x55\x6e\141\x62\x6c\145\x20\164\x6f\x20\x65\x78\164\x72\141\x63\x74\40\160\165\142\x6c\x69\143\x20\153\145\171");
                Do1:
                goto Hn;
            case "\160\162\x69\166\141\164\145":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto Hn;
            case "\x73\171\155\x6d\145\164\x72\151\143":
                if (!(strlen($this->key) < $this->cryptParams["\x6b\x65\x79\x73\x69\172\145"])) {
                    goto h6;
                }
                throw new Exception("\113\x65\x79\40\155\165\163\x74\40\x63\157\x6e\x74\141\151\156\x20\141\164\x20\154\145\x61\x73\x74\40\x32\x35\40\143\150\141\162\x61\x63\x74\x65\x72\x73\40\146\x6f\x72\40\164\x68\x69\163\40\143\151\x70\x68\145\162");
                h6:
                goto Hn;
            default:
                throw new Exception("\x55\156\153\x6e\157\167\x6e\40\x74\x79\x70\x65");
        }
        rY:
        Hn:
        UO:
    }
    private function padISO10126($w5, $Jf)
    {
        if (!($Jf > 256)) {
            goto yF;
        }
        throw new Exception("\102\154\157\143\x6b\40\x73\x69\172\x65\40\150\x69\147\x68\x65\162\x20\x74\x68\141\x6e\40\62\x35\66\40\x6e\x6f\x74\x20\141\154\x6c\157\x77\145\144");
        yF:
        $Ea = $Jf - strlen($w5) % $Jf;
        $AA = chr($Ea);
        return $w5 . str_repeat($AA, $Ea);
    }
    private function unpadISO10126($w5)
    {
        $Ea = substr($w5, -1);
        $qr = ord($Ea);
        return substr($w5, 0, -$qr);
    }
    private function encryptSymmetric($w5)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\x63\151\x70\150\145\162"]));
        $w5 = $this->padISO10126($w5, $this->cryptParams["\142\154\157\x63\x6b\163\x69\172\145"]);
        $zP = openssl_encrypt($w5, $this->cryptParams["\143\x69\160\150\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $zP)) {
            goto yP;
        }
        throw new Exception("\x46\141\151\x6c\165\x72\x65\x20\145\x6e\143\x72\x79\160\164\151\x6e\147\x20\104\141\x74\x61\x20\50\157\x70\145\x6e\163\163\x6c\40\163\171\155\x6d\145\x74\x72\x69\143\51\x20\x2d\x20" . openssl_error_string());
        yP:
        return $this->iv . $zP;
    }
    private function decryptSymmetric($w5)
    {
        $Fd = openssl_cipher_iv_length($this->cryptParams["\143\151\160\150\145\162"]);
        $this->iv = substr($w5, 0, $Fd);
        $w5 = substr($w5, $Fd);
        $Ci = openssl_decrypt($w5, $this->cryptParams["\143\x69\x70\x68\x65\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $Ci)) {
            goto xi;
        }
        throw new Exception("\106\x61\x69\x6c\165\162\145\x20\144\145\x63\162\x79\160\164\151\156\x67\40\104\x61\164\141\x20\x28\x6f\x70\x65\x6e\163\163\154\x20\163\171\155\x6d\x65\164\x72\151\143\51\40\x2d\40" . openssl_error_string());
        xi:
        return $this->unpadISO10126($Ci);
    }
    private function encryptPublic($w5)
    {
        if (openssl_public_encrypt($w5, $zP, $this->key, $this->cryptParams["\x70\141\144\144\151\156\147"])) {
            goto eh;
        }
        throw new Exception("\x46\x61\151\154\x75\162\145\x20\x65\156\x63\162\171\x70\x74\151\156\147\x20\104\141\164\141\x20\x28\157\x70\x65\x6e\163\x73\x6c\40\x70\165\142\154\151\x63\51\40\55\x20" . openssl_error_string());
        eh:
        return $zP;
    }
    private function decryptPublic($w5)
    {
        if (openssl_public_decrypt($w5, $Ci, $this->key, $this->cryptParams["\160\141\x64\144\x69\156\x67"])) {
            goto BI;
        }
        throw new Exception("\106\141\x69\x6c\165\x72\145\40\144\145\143\x72\171\x70\x74\151\156\x67\40\x44\141\164\x61\40\x28\157\160\145\156\x73\163\154\x20\160\x75\x62\154\x69\x63\51\x20\55\x20" . openssl_error_string);
        BI:
        return $Ci;
    }
    private function encryptPrivate($w5)
    {
        if (openssl_private_encrypt($w5, $zP, $this->key, $this->cryptParams["\160\x61\144\144\151\156\x67"])) {
            goto tz;
        }
        throw new Exception("\106\x61\151\154\x75\162\x65\x20\145\x6e\x63\x72\x79\160\x74\x69\156\147\40\104\x61\x74\141\40\x28\157\x70\145\156\163\x73\x6c\x20\160\162\151\x76\x61\164\145\51\x20\x2d\40" . openssl_error_string());
        tz:
        return $zP;
    }
    private function decryptPrivate($w5)
    {
        if (openssl_private_decrypt($w5, $Ci, $this->key, $this->cryptParams["\x70\141\144\144\151\156\x67"])) {
            goto Pf;
        }
        throw new Exception("\x46\141\x69\x6c\x75\162\x65\x20\x64\x65\x63\x72\x79\x70\164\151\x6e\x67\40\104\x61\x74\141\40\50\157\160\x65\156\x73\x73\154\x20\x70\162\x69\x76\x61\164\145\51\40\x2d\40" . openssl_error_string);
        Pf:
        return $Ci;
    }
    private function signOpenSSL($w5)
    {
        $in = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\x69\147\x65\x73\x74"])) {
            goto Y8;
        }
        $in = $this->cryptParams["\144\x69\x67\145\x73\x74"];
        Y8:
        if (openssl_sign($w5, $d9, $this->key, $in)) {
            goto bY;
        }
        throw new Exception("\x46\x61\151\154\165\x72\145\40\123\151\x67\156\151\x6e\x67\x20\104\x61\164\141\x3a\x20" . openssl_error_string() . "\x20\x2d\40" . $in);
        bY:
        return $d9;
    }
    private function verifyOpenSSL($w5, $d9)
    {
        $in = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\x69\147\145\163\x74"])) {
            goto Td;
        }
        $in = $this->cryptParams["\144\x69\147\x65\163\164"];
        Td:
        return openssl_verify($w5, $d9, $this->key, $in);
    }
    public function encryptData($w5)
    {
        if (!($this->cryptParams["\154\151\142\x72\x61\162\x79"] === "\157\x70\145\156\163\163\x6c")) {
            goto Xf;
        }
        switch ($this->cryptParams["\164\171\160\x65"]) {
            case "\x73\171\155\155\x65\x74\x72\151\143":
                return $this->encryptSymmetric($w5);
            case "\160\x75\x62\154\151\143":
                return $this->encryptPublic($w5);
            case "\160\x72\x69\x76\141\x74\x65":
                return $this->encryptPrivate($w5);
        }
        Ck:
        hA:
        Xf:
    }
    public function decryptData($w5)
    {
        if (!($this->cryptParams["\154\x69\x62\x72\x61\162\171"] === "\x6f\x70\145\x6e\x73\x73\x6c")) {
            goto Nr;
        }
        switch ($this->cryptParams["\164\171\160\x65"]) {
            case "\163\x79\x6d\x6d\x65\164\162\x69\x63":
                return $this->decryptSymmetric($w5);
            case "\160\165\x62\154\151\x63":
                return $this->decryptPublic($w5);
            case "\160\162\x69\x76\x61\164\145":
                return $this->decryptPrivate($w5);
        }
        po:
        sJ:
        Nr:
    }
    public function signData($w5)
    {
        switch ($this->cryptParams["\154\151\x62\x72\141\162\x79"]) {
            case "\157\x70\x65\x6e\x73\x73\x6c":
                return $this->signOpenSSL($w5);
            case self::HMAC_SHA1:
                return hash_hmac("\x73\150\x61\x31", $w5, $this->key, true);
        }
        Yt:
        Uo:
    }
    public function verifySignature($w5, $d9)
    {
        switch ($this->cryptParams["\x6c\151\x62\x72\141\x72\171"]) {
            case "\157\x70\x65\156\163\x73\x6c":
                return $this->verifyOpenSSL($w5, $d9);
            case self::HMAC_SHA1:
                $er = hash_hmac("\163\150\x61\x31", $w5, $this->key, true);
                return strcmp($d9, $er) == 0;
        }
        vP:
        Su:
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\x6d\145\x74\150\x6f\144"];
    }
    public static function makeAsnSegment($S2, $Lt)
    {
        switch ($S2) {
            case 2:
                if (!(ord($Lt) > 127)) {
                    goto g_;
                }
                $Lt = chr(0) . $Lt;
                g_:
                goto x0;
            case 3:
                $Lt = chr(0) . $Lt;
                goto x0;
        }
        Ir:
        x0:
        $x7 = strlen($Lt);
        if ($x7 < 128) {
            goto sm;
        }
        if ($x7 < 256) {
            goto ln;
        }
        if ($x7 < 65536) {
            goto vU;
        }
        $VN = null;
        goto gD;
        vU:
        $VN = sprintf("\x25\x63\x25\x63\45\x63\45\x63\x25\163", $S2, 130, $x7 / 256, $x7 % 256, $Lt);
        gD:
        goto KW;
        ln:
        $VN = sprintf("\x25\143\x25\143\45\x63\x25\163", $S2, 129, $x7, $Lt);
        KW:
        goto k9;
        sm:
        $VN = sprintf("\x25\143\45\143\45\163", $S2, $x7, $Lt);
        k9:
        return $VN;
    }
    public static function convertRSA($OJ, $rk)
    {
        $cc = self::makeAsnSegment(2, $rk);
        $Lf = self::makeAsnSegment(2, $OJ);
        $eg = self::makeAsnSegment(48, $Lf . $cc);
        $qf = self::makeAsnSegment(3, $eg);
        $kr = pack("\110\x2a", "\x33\x30\x30\x44\x30\x36\60\71\62\x41\70\66\64\70\70\66\106\67\x30\104\60\61\60\61\60\x31\x30\65\60\60");
        $Sm = self::makeAsnSegment(48, $kr . $qf);
        $fg = base64_encode($Sm);
        $Gg = "\55\x2d\x2d\x2d\55\102\x45\x47\111\x4e\x20\x50\125\x42\114\111\103\40\113\105\131\x2d\55\55\55\x2d\xa";
        $Wt = 0;
        k4:
        if (!($Hb = substr($fg, $Wt, 64))) {
            goto VM;
        }
        $Gg = $Gg . $Hb . "\xa";
        $Wt += 64;
        goto k4;
        VM:
        return $Gg . "\x2d\55\x2d\x2d\x2d\105\x4e\x44\40\x50\x55\x42\114\x49\103\40\x4b\x45\131\x2d\55\x2d\55\x2d\12";
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $S_)
    {
        $z2 = new XMLSecEnc();
        $z2->setNode($S_);
        if ($kJ = $z2->locateKey()) {
            goto GC;
        }
        throw new Exception("\x55\156\141\142\154\145\x20\x74\x6f\x20\154\157\x63\141\164\145\x20\141\x6c\x67\x6f\162\151\x74\x68\155\40\146\157\162\x20\x74\150\x69\163\x20\105\x6e\143\x72\x79\x70\164\145\x64\x20\x4b\145\x79");
        GC:
        $kJ->isEncrypted = true;
        $kJ->encryptedCtx = $z2;
        XMLSecEnc::staticLocateKeyInfo($kJ, $S_);
        return $kJ;
    }
}
class XMLSecurityDSig
{
    const XMLDSIGNS = "\x68\164\164\x70\72\57\57\x77\x77\167\x2e\x77\63\x2e\157\162\x67\57\62\60\x30\60\x2f\60\x39\57\x78\x6d\x6c\x64\163\x69\147\43";
    const SHA1 = "\150\164\x74\x70\72\x2f\57\x77\x77\167\56\167\x33\x2e\x6f\162\147\57\x32\60\60\x30\57\60\x39\57\170\155\x6c\x64\x73\x69\147\43\163\150\x61\x31";
    const SHA256 = "\x68\164\x74\160\72\57\x2f\167\167\x77\x2e\x77\63\x2e\x6f\162\x67\57\62\x30\x30\x31\x2f\x30\x34\57\170\155\154\x65\x6e\143\x23\163\150\141\x32\65\x36";
    const SHA384 = "\x68\x74\x74\x70\x3a\x2f\57\x77\167\x77\x2e\167\63\x2e\157\x72\x67\57\62\x30\60\61\x2f\x30\x34\x2f\170\155\x6c\x64\163\x69\x67\55\155\x6f\162\x65\x23\x73\150\x61\x33\x38\x34";
    const SHA512 = "\x68\x74\164\160\72\x2f\57\x77\x77\167\56\x77\x33\56\x6f\x72\147\57\62\60\x30\x31\57\x30\64\x2f\x78\x6d\154\x65\x6e\x63\43\163\x68\141\65\61\x32";
    const RIPEMD160 = "\150\164\x74\x70\x3a\x2f\x2f\x77\x77\x77\56\x77\x33\x2e\x6f\162\147\57\62\x30\60\x31\x2f\60\64\57\170\x6d\x6c\x65\156\143\x23\162\x69\x70\x65\155\144\x31\x36\x30";
    const C14N = "\x68\x74\x74\160\72\57\x2f\x77\167\x77\56\167\x33\x2e\x6f\x72\147\x2f\124\x52\57\62\x30\60\x31\x2f\122\x45\103\55\x78\155\x6c\x2d\x63\x31\x34\x6e\55\x32\60\60\61\x30\63\61\x35";
    const C14N_COMMENTS = "\x68\x74\164\160\72\x2f\57\x77\x77\167\x2e\x77\63\56\x6f\x72\147\57\124\122\57\62\x30\60\61\57\x52\x45\x43\55\x78\155\x6c\55\143\x31\x34\156\x2d\62\60\60\61\x30\x33\x31\x35\x23\x57\x69\x74\150\103\x6f\x6d\x6d\x65\x6e\164\x73";
    const EXC_C14N = "\150\164\164\160\x3a\x2f\x2f\x77\167\167\x2e\167\63\x2e\157\x72\x67\x2f\62\60\x30\61\x2f\x31\x30\57\170\155\x6c\x2d\145\x78\x63\x2d\143\61\x34\x6e\x23";
    const EXC_C14N_COMMENTS = "\x68\x74\x74\160\72\57\57\x77\167\167\x2e\x77\x33\56\x6f\x72\147\x2f\62\x30\x30\61\57\x31\x30\x2f\170\x6d\x6c\55\x65\170\143\x2d\x63\61\x34\x6e\43\127\151\x74\150\x43\157\x6d\155\145\x6e\x74\163";
    const template = "\x3c\x64\x73\x3a\123\151\147\x6e\x61\164\165\x72\145\x20\x78\155\154\156\163\72\144\x73\75\x22\150\x74\164\x70\x3a\x2f\57\167\x77\167\56\x77\x33\x2e\157\x72\147\x2f\x32\60\60\60\57\60\71\57\170\x6d\154\x64\x73\x69\x67\43\x22\x3e\xd\12\x20\x20\74\144\x73\72\123\151\147\x6e\145\144\111\x6e\x66\x6f\76\15\xa\40\40\x20\40\74\144\x73\72\x53\151\147\x6e\141\164\x75\x72\145\x4d\x65\x74\150\x6f\144\x20\x2f\76\xd\xa\x20\x20\x3c\x2f\x64\x73\x3a\x53\151\147\x6e\145\144\111\x6e\x66\x6f\76\xd\xa\74\x2f\x64\x73\72\123\151\x67\x6e\141\164\165\x72\145\76";
    const BASE_TEMPLATE = "\74\x53\151\x67\x6e\141\164\x75\x72\145\x20\x78\x6d\x6c\x6e\x73\x3d\x22\x68\164\164\x70\72\x2f\x2f\x77\167\x77\x2e\x77\x33\56\x6f\x72\147\x2f\62\60\60\x30\57\x30\x39\57\170\x6d\154\144\x73\151\147\43\x22\x3e\xd\12\x20\40\74\x53\x69\147\156\x65\144\x49\156\x66\157\x3e\xd\12\x20\40\40\40\x3c\123\151\147\x6e\141\x74\x75\162\145\115\x65\164\x68\x6f\144\40\x2f\76\15\12\40\x20\x3c\57\x53\x69\x67\x6e\145\144\111\x6e\146\157\76\15\12\74\57\123\151\x67\156\141\x74\165\162\x65\76";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\x73\145\x63\144\x73\x69\x67";
    private $validatedNodes = null;
    public function __construct($W9 = "\144\x73")
    {
        $UY = self::BASE_TEMPLATE;
        if (empty($W9)) {
            goto di;
        }
        $this->prefix = $W9 . "\72";
        $T3 = array("\74\x53", "\74\x2f\x53", "\170\x6d\x6c\156\x73\x3d");
        $kp = array("\x3c{$W9}\x3a\123", "\x3c\x2f{$W9}\x3a\123", "\x78\155\x6c\x6e\163\72{$W9}\x3d");
        $UY = str_replace($T3, $kp, $UY);
        di:
        $Fp = new DOMDocument();
        $Fp->loadXML($UY);
        $this->sigNode = $Fp->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto MZ;
        }
        $pR = new DOMXPath($this->sigNode->ownerDocument);
        $pR->registerNamespace("\163\x65\143\x64\x73\x69\147", self::XMLDSIGNS);
        $this->xPathCtx = $pR;
        MZ:
        return $this->xPathCtx;
    }
    public static function generateGUID($W9 = "\x70\146\170")
    {
        $uT = md5(uniqid(mt_rand(), true));
        $nX = $W9 . substr($uT, 0, 8) . "\x2d" . substr($uT, 8, 4) . "\55" . substr($uT, 12, 4) . "\55" . substr($uT, 16, 4) . "\55" . substr($uT, 20, 12);
        return $nX;
    }
    public static function generate_GUID($W9 = "\x70\146\170")
    {
        return self::generateGUID($W9);
    }
    public function locateSignature($eb, $Yo = 0)
    {
        if ($eb instanceof DOMDocument) {
            goto xW;
        }
        $rU = $eb->ownerDocument;
        goto U5;
        xW:
        $rU = $eb;
        U5:
        if (!$rU) {
            goto Gq;
        }
        $pR = new DOMXPath($rU);
        $pR->registerNamespace("\x73\x65\x63\144\163\151\x67", self::XMLDSIGNS);
        $xI = "\56\57\x2f\x73\x65\143\x64\x73\151\x67\x3a\x53\x69\x67\x6e\x61\164\165\x72\145";
        $rq = $pR->query($xI, $eb);
        $this->sigNode = $rq->item($Yo);
        return $this->sigNode;
        Gq:
        return null;
    }
    public function createNewSignNode($n3, $W8 = null)
    {
        $rU = $this->sigNode->ownerDocument;
        if (!is_null($W8)) {
            goto VG;
        }
        $FF = $rU->createElementNS(self::XMLDSIGNS, $this->prefix . $n3);
        goto lh;
        VG:
        $FF = $rU->createElementNS(self::XMLDSIGNS, $this->prefix . $n3, $W8);
        lh:
        return $FF;
    }
    public function setCanonicalMethod($L8)
    {
        switch ($L8) {
            case "\150\164\164\160\x3a\x2f\x2f\x77\x77\167\x2e\167\63\x2e\157\x72\x67\57\x54\x52\57\x32\x30\60\61\x2f\x52\105\103\x2d\170\155\x6c\x2d\143\61\x34\x6e\x2d\62\60\60\x31\x30\x33\x31\x35":
            case "\x68\x74\x74\160\x3a\57\x2f\x77\167\167\56\167\x33\56\157\162\147\x2f\124\x52\x2f\62\60\x30\x31\x2f\x52\105\x43\x2d\170\x6d\x6c\55\x63\x31\x34\156\55\62\x30\60\61\x30\63\x31\x35\x23\x57\151\x74\150\103\157\x6d\155\145\x6e\x74\x73":
            case "\150\x74\164\x70\72\57\x2f\x77\x77\x77\x2e\167\x33\56\157\x72\x67\57\x32\60\60\61\57\x31\x30\x2f\x78\x6d\x6c\x2d\145\170\x63\55\143\61\64\156\x23":
            case "\x68\164\x74\160\72\57\x2f\x77\x77\167\x2e\x77\x33\56\x6f\x72\147\57\62\60\60\61\x2f\x31\x30\x2f\x78\155\x6c\55\x65\170\x63\55\143\61\64\156\x23\x57\151\164\x68\x43\157\155\155\x65\156\164\x73":
                $this->canonicalMethod = $L8;
                goto h2;
            default:
                throw new Exception("\x49\x6e\166\x61\x6c\x69\x64\40\x43\141\156\157\156\x69\x63\x61\154\x20\115\x65\164\150\x6f\144");
        }
        LG:
        h2:
        if (!($pR = $this->getXPathObj())) {
            goto HI;
        }
        $xI = "\x2e\57" . $this->searchpfx . "\x3a\x53\x69\x67\x6e\x65\144\x49\156\146\x6f";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($Z1 = $rq->item(0))) {
            goto RB;
        }
        $xI = "\56\x2f" . $this->searchpfx . "\103\x61\x6e\157\x6e\151\143\x61\154\x69\172\x61\x74\151\x6f\156\115\x65\x74\x68\x6f\144";
        $rq = $pR->query($xI, $Z1);
        if ($GJ = $rq->item(0)) {
            goto i3;
        }
        $GJ = $this->createNewSignNode("\x43\141\156\x6f\x6e\x69\x63\141\154\151\172\141\164\151\x6f\x6e\115\x65\164\150\157\x64");
        $Z1->insertBefore($GJ, $Z1->firstChild);
        i3:
        $GJ->setAttribute("\101\x6c\147\x6f\162\151\x74\150\155", $this->canonicalMethod);
        RB:
        HI:
    }
    private function canonicalizeData($FF, $Zg, $Kh = null, $SN = null)
    {
        $ao = false;
        $GP = false;
        switch ($Zg) {
            case "\x68\x74\164\160\72\57\x2f\x77\167\x77\56\167\x33\56\157\x72\x67\57\124\x52\57\62\x30\x30\61\x2f\x52\105\103\x2d\170\x6d\x6c\55\143\61\x34\x6e\x2d\x32\60\x30\x31\x30\63\61\65":
                $ao = false;
                $GP = false;
                goto YJ;
            case "\150\x74\x74\x70\x3a\57\x2f\x77\x77\167\56\167\63\x2e\157\162\147\x2f\x54\x52\57\62\x30\60\61\57\122\x45\103\55\170\155\x6c\x2d\143\x31\64\156\55\x32\60\60\x31\x30\63\61\65\x23\x57\151\x74\150\103\157\155\155\145\156\164\x73":
                $GP = true;
                goto YJ;
            case "\x68\x74\x74\160\72\x2f\x2f\x77\167\x77\x2e\x77\63\x2e\x6f\162\147\x2f\x32\60\60\x31\x2f\x31\60\x2f\x78\x6d\154\x2d\145\170\143\55\143\61\x34\x6e\43":
                $ao = true;
                goto YJ;
            case "\x68\x74\x74\x70\x3a\x2f\x2f\x77\167\167\x2e\167\x33\56\157\162\147\x2f\62\x30\x30\61\57\x31\x30\57\x78\x6d\154\55\x65\170\x63\x2d\x63\61\64\x6e\43\x57\151\x74\x68\103\x6f\x6d\155\x65\156\164\163":
                $ao = true;
                $GP = true;
                goto YJ;
        }
        t9:
        YJ:
        if (!(is_null($Kh) && $FF instanceof DOMNode && $FF->ownerDocument !== null && $FF->isSameNode($FF->ownerDocument->documentElement))) {
            goto l4;
        }
        $S_ = $FF;
        Ia:
        if (!($l1 = $S_->previousSibling)) {
            goto Af;
        }
        if (!($l1->nodeType == XML_PI_NODE || $l1->nodeType == XML_COMMENT_NODE && $GP)) {
            goto XL;
        }
        goto Af;
        XL:
        $S_ = $l1;
        goto Ia;
        Af:
        if (!($l1 == null)) {
            goto gb;
        }
        $FF = $FF->ownerDocument;
        gb:
        l4:
        return $FF->C14N($ao, $GP, $Kh, $SN);
    }
    public function canonicalizeSignedInfo()
    {
        $rU = $this->sigNode->ownerDocument;
        $Zg = null;
        if (!$rU) {
            goto Zj;
        }
        $pR = $this->getXPathObj();
        $xI = "\x2e\57\x73\145\x63\144\x73\x69\x67\x3a\123\x69\x67\156\145\x64\111\x6e\146\157";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($G0 = $rq->item(0))) {
            goto c8;
        }
        $xI = "\x2e\57\163\145\x63\144\x73\x69\x67\72\103\141\156\x6f\x6e\x69\143\141\154\x69\172\141\x74\x69\157\156\115\x65\x74\x68\157\x64";
        $rq = $pR->query($xI, $G0);
        if (!($GJ = $rq->item(0))) {
            goto v3;
        }
        $Zg = $GJ->getAttribute("\x41\154\x67\x6f\162\x69\x74\x68\x6d");
        v3:
        $this->signedInfo = $this->canonicalizeData($G0, $Zg);
        return $this->signedInfo;
        c8:
        Zj:
        return null;
    }
    public function calculateDigest($EI, $w5, $La = true)
    {
        switch ($EI) {
            case self::SHA1:
                $Gi = "\x73\150\141\x31";
                goto Kw;
            case self::SHA256:
                $Gi = "\163\150\x61\x32\65\x36";
                goto Kw;
            case self::SHA384:
                $Gi = "\163\150\x61\63\70\64";
                goto Kw;
            case self::SHA512:
                $Gi = "\x73\x68\x61\x35\x31\x32";
                goto Kw;
            case self::RIPEMD160:
                $Gi = "\162\151\x70\145\x6d\144\61\x36\60";
                goto Kw;
            default:
                throw new Exception("\x43\x61\156\x6e\x6f\x74\40\166\x61\x6c\151\144\141\164\x65\40\144\151\x67\145\x73\164\x3a\x20\x55\x6e\x73\165\160\160\157\x72\164\145\x64\x20\x41\x6c\x67\157\x72\151\164\x68\155\40\x3c{$EI}\76");
        }
        SI:
        Kw:
        $He = hash($Gi, $w5, true);
        if (!$La) {
            goto nW;
        }
        $He = base64_encode($He);
        nW:
        return $He;
    }
    public function validateDigest($Gz, $w5)
    {
        $pR = new DOMXPath($Gz->ownerDocument);
        $pR->registerNamespace("\x73\x65\x63\x64\x73\x69\x67", self::XMLDSIGNS);
        $xI = "\x73\x74\x72\151\x6e\x67\50\56\57\163\145\143\144\x73\151\147\x3a\104\x69\x67\x65\x73\x74\x4d\145\164\x68\x6f\x64\x2f\x40\101\154\x67\x6f\162\151\x74\x68\x6d\x29";
        $EI = $pR->evaluate($xI, $Gz);
        $Bc = $this->calculateDigest($EI, $w5, false);
        $xI = "\x73\x74\162\151\156\x67\x28\56\57\x73\145\143\x64\163\x69\x67\72\x44\151\147\145\x73\164\126\141\x6c\x75\x65\51";
        $ML = $pR->evaluate($xI, $Gz);
        return $Bc == base64_decode($ML);
    }
    public function processTransforms($Gz, $Yw, $W0 = true)
    {
        $w5 = $Yw;
        $pR = new DOMXPath($Gz->ownerDocument);
        $pR->registerNamespace("\x73\145\143\x64\x73\151\147", self::XMLDSIGNS);
        $xI = "\x2e\x2f\163\x65\143\144\x73\151\x67\72\124\x72\x61\x6e\x73\x66\x6f\162\155\x73\x2f\163\x65\x63\x64\x73\151\147\72\124\162\x61\156\163\146\x6f\162\155";
        $p4 = $pR->query($xI, $Gz);
        $FY = "\150\x74\x74\x70\72\57\57\x77\167\167\56\x77\x33\56\x6f\x72\147\57\x54\122\x2f\x32\x30\x30\x31\x2f\x52\x45\x43\x2d\170\155\154\x2d\143\61\x34\156\55\62\x30\x30\x31\x30\x33\61\x35";
        $Kh = null;
        $SN = null;
        foreach ($p4 as $Kf) {
            $LO = $Kf->getAttribute("\101\154\x67\x6f\162\x69\164\150\x6d");
            switch ($LO) {
                case "\x68\x74\x74\160\x3a\57\x2f\167\x77\167\x2e\x77\63\56\x6f\x72\147\57\x32\60\x30\61\x2f\x31\60\57\x78\155\x6c\x2d\x65\170\143\x2d\143\61\64\156\x23":
                case "\150\x74\x74\x70\x3a\57\x2f\167\x77\x77\x2e\167\63\x2e\157\x72\147\x2f\x32\60\60\x31\x2f\x31\60\x2f\170\155\154\55\145\x78\143\x2d\143\x31\64\156\43\x57\151\164\150\x43\157\x6d\155\x65\x6e\164\163":
                    if (!$W0) {
                        goto nz;
                    }
                    $FY = $LO;
                    goto n6;
                    nz:
                    $FY = "\150\x74\164\160\x3a\57\x2f\167\167\x77\56\167\x33\x2e\157\x72\x67\x2f\62\x30\x30\x31\x2f\x31\x30\57\x78\155\x6c\55\145\x78\143\55\143\x31\64\x6e\43";
                    n6:
                    $FF = $Kf->firstChild;
                    kC:
                    if (!$FF) {
                        goto sf;
                    }
                    if (!($FF->localName == "\x49\x6e\143\x6c\x75\x73\151\166\145\116\141\x6d\x65\163\x70\141\143\x65\x73")) {
                        goto Fi;
                    }
                    if (!($I5 = $FF->getAttribute("\120\x72\145\146\x69\170\114\151\163\x74"))) {
                        goto TW;
                    }
                    $Wl = array();
                    $su = explode("\x20", $I5);
                    foreach ($su as $I5) {
                        $sS = trim($I5);
                        if (empty($sS)) {
                            goto Pm;
                        }
                        $Wl[] = $sS;
                        Pm:
                        yL:
                    }
                    NR:
                    if (!(count($Wl) > 0)) {
                        goto du;
                    }
                    $SN = $Wl;
                    du:
                    TW:
                    goto sf;
                    Fi:
                    $FF = $FF->nextSibling;
                    goto kC;
                    sf:
                    goto a8;
                case "\x68\164\x74\160\72\57\57\x77\167\x77\x2e\x77\63\56\x6f\162\x67\x2f\x54\122\57\x32\x30\60\61\x2f\x52\x45\103\x2d\x78\x6d\x6c\x2d\x63\61\x34\156\x2d\62\x30\60\61\60\63\61\x35":
                case "\150\x74\x74\x70\x3a\x2f\57\167\x77\x77\56\x77\x33\x2e\x6f\162\147\57\x54\x52\57\62\x30\60\61\57\122\105\x43\55\x78\x6d\x6c\x2d\x63\x31\64\156\55\62\x30\x30\x31\60\x33\61\65\43\127\x69\164\150\x43\157\x6d\155\145\x6e\164\163":
                    if (!$W0) {
                        goto C6;
                    }
                    $FY = $LO;
                    goto dC;
                    C6:
                    $FY = "\150\x74\x74\160\x3a\57\x2f\167\x77\167\56\167\x33\56\x6f\162\x67\57\x54\x52\57\62\60\x30\61\x2f\122\x45\x43\55\170\155\x6c\55\x63\x31\64\x6e\x2d\x32\x30\x30\61\x30\63\61\65";
                    dC:
                    goto a8;
                case "\x68\x74\x74\x70\x3a\57\x2f\x77\x77\167\56\x77\63\56\157\162\147\57\x54\x52\57\x31\x39\x39\x39\x2f\x52\105\103\55\170\160\141\164\150\x2d\x31\71\x39\x39\x31\x31\61\66":
                    $FF = $Kf->firstChild;
                    aG:
                    if (!$FF) {
                        goto Rz;
                    }
                    if (!($FF->localName == "\130\x50\x61\x74\150")) {
                        goto TD;
                    }
                    $Kh = array();
                    $Kh["\161\165\145\162\171"] = "\x28\56\57\57\x2e\x20\174\40\56\57\x2f\100\x2a\x20\174\x20\x2e\57\57\x6e\141\x6d\x65\x73\x70\x61\143\145\72\x3a\x2a\51\x5b" . $FF->nodeValue . "\x5d";
                    $qs["\156\141\155\x65\163\x70\141\143\x65\x73"] = array();
                    $c7 = $pR->query("\56\57\x6e\141\x6d\145\x73\x70\x61\x63\145\x3a\72\x2a", $FF);
                    foreach ($c7 as $m7) {
                        if (!($m7->localName != "\x78\155\154")) {
                            goto YP;
                        }
                        $Kh["\x6e\x61\x6d\x65\x73\x70\x61\143\x65\x73"][$m7->localName] = $m7->nodeValue;
                        YP:
                        jF:
                    }
                    QA:
                    goto Rz;
                    TD:
                    $FF = $FF->nextSibling;
                    goto aG;
                    Rz:
                    goto a8;
            }
            IX:
            a8:
            vy:
        }
        z4:
        if (!$w5 instanceof DOMElement) {
            goto bs;
        }
        $w5 = $this->canonicalizeData($Yw, $FY, $Kh, $SN);
        bs:
        return $w5;
    }
    public function processRefNode($Gz)
    {
        $Le = null;
        $W0 = true;
        if ($Mi = $Gz->getAttribute("\x55\122\x49")) {
            goto DV;
        }
        $W0 = false;
        $Le = $Gz->ownerDocument;
        goto I4;
        DV:
        $XF = parse_url($Mi);
        if (empty($XF["\160\x61\164\150"])) {
            goto u5;
        }
        $Le = file_get_contents($XF);
        goto lN;
        u5:
        if ($lk = $XF["\146\162\141\147\155\x65\x6e\x74"]) {
            goto IN;
        }
        $Le = $Gz->ownerDocument;
        goto UI;
        IN:
        $W0 = false;
        $wM = new DOMXPath($Gz->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto g3;
        }
        foreach ($this->idNS as $cp => $jD) {
            $wM->registerNamespace($cp, $jD);
            Rl:
        }
        AY:
        g3:
        $UT = "\100\x49\x64\75\42" . $lk . "\x22";
        if (!is_array($this->idKeys)) {
            goto bQ;
        }
        foreach ($this->idKeys as $tq) {
            $UT .= "\40\157\x72\x20\100{$tq}\x3d\47{$lk}\47";
            CE:
        }
        nr:
        bQ:
        $xI = "\57\57\52\133" . $UT . "\135";
        $Le = $wM->query($xI)->item(0);
        UI:
        lN:
        I4:
        $w5 = $this->processTransforms($Gz, $Le, $W0);
        if ($this->validateDigest($Gz, $w5)) {
            goto FO;
        }
        return false;
        FO:
        if (!$Le instanceof DOMElement) {
            goto Dq;
        }
        if (!empty($lk)) {
            goto Hy;
        }
        $this->validatedNodes[] = $Le;
        goto hv;
        Hy:
        $this->validatedNodes[$lk] = $Le;
        hv:
        Dq:
        return true;
    }
    public function getRefNodeID($Gz)
    {
        if (!($Mi = $Gz->getAttribute("\125\122\111"))) {
            goto T0;
        }
        $XF = parse_url($Mi);
        if (!empty($XF["\160\x61\x74\x68"])) {
            goto LU;
        }
        if (!($lk = $XF["\146\162\x61\x67\x6d\145\x6e\x74"])) {
            goto Yr;
        }
        return $lk;
        Yr:
        LU:
        T0:
        return null;
    }
    public function getRefIDs()
    {
        $oH = array();
        $pR = $this->getXPathObj();
        $xI = "\56\x2f\163\145\x63\x64\x73\151\x67\x3a\x53\x69\x67\x6e\145\144\x49\156\x66\x6f\57\163\x65\x63\144\163\x69\x67\x3a\122\145\x66\x65\162\x65\x6e\143\x65";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($rq->length == 0)) {
            goto yc;
        }
        throw new Exception("\x52\145\146\x65\x72\145\156\x63\x65\40\156\157\x64\x65\163\x20\156\157\164\40\x66\157\165\156\x64");
        yc:
        foreach ($rq as $Gz) {
            $oH[] = $this->getRefNodeID($Gz);
            Cv:
        }
        Vl:
        return $oH;
    }
    public function validateReference()
    {
        $yG = $this->sigNode->ownerDocument->documentElement;
        if ($yG->isSameNode($this->sigNode)) {
            goto oO;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto rM;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        rM:
        oO:
        $pR = $this->getXPathObj();
        $xI = "\x2e\x2f\163\145\x63\x64\x73\x69\147\72\x53\151\147\x6e\145\144\111\x6e\146\157\57\163\x65\143\x64\x73\151\147\x3a\122\x65\x66\145\x72\x65\156\143\x65";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($rq->length == 0)) {
            goto gE;
        }
        throw new Exception("\x52\145\x66\145\x72\x65\156\x63\145\x20\x6e\157\x64\x65\163\x20\x6e\157\x74\x20\146\x6f\x75\x6e\144");
        gE:
        $this->validatedNodes = array();
        foreach ($rq as $Gz) {
            if ($this->processRefNode($Gz)) {
                goto jz;
            }
            $this->validatedNodes = null;
            throw new Exception("\122\145\146\x65\x72\x65\156\x63\x65\x20\166\141\x6c\x69\x64\141\x74\x69\157\x6e\40\x66\141\x69\154\145\x64");
            jz:
            J3:
        }
        dO1:
        return true;
    }
    private function addRefInternal($PN, $FF, $LO, $yx = null, $jR = null)
    {
        $W9 = null;
        $LC = null;
        $b1 = "\x49\x64";
        $Y3 = true;
        $RW = false;
        if (!is_array($jR)) {
            goto Ji;
        }
        $W9 = empty($jR["\160\x72\x65\146\151\x78"]) ? null : $jR["\x70\x72\x65\146\151\170"];
        $LC = empty($jR["\x70\162\145\x66\x69\x78\x5f\156\x73"]) ? null : $jR["\160\x72\x65\x66\151\x78\137\156\x73"];
        $b1 = empty($jR["\x69\144\137\156\141\x6d\145"]) ? "\x49\x64" : $jR["\151\x64\137\x6e\x61\x6d\145"];
        $Y3 = !isset($jR["\x6f\x76\x65\x72\167\x72\x69\164\x65"]) ? true : (bool) $jR["\157\166\145\x72\x77\162\151\164\x65"];
        $RW = !isset($jR["\146\157\x72\x63\x65\x5f\x75\x72\151"]) ? false : (bool) $jR["\146\157\162\x63\145\137\x75\x72\151"];
        Ji:
        $Os = $b1;
        if (empty($W9)) {
            goto EV;
        }
        $Os = $W9 . "\72" . $Os;
        EV:
        $Gz = $this->createNewSignNode("\x52\x65\146\x65\x72\x65\x6e\143\145");
        $PN->appendChild($Gz);
        if (!$FF instanceof DOMDocument) {
            goto ex;
        }
        if ($RW) {
            goto fK;
        }
        goto GZ;
        ex:
        $Mi = null;
        if ($Y3) {
            goto ru;
        }
        $Mi = $LC ? $FF->getAttributeNS($LC, $b1) : $FF->getAttribute($b1);
        ru:
        if (!empty($Mi)) {
            goto Xn;
        }
        $Mi = self::generateGUID();
        $FF->setAttributeNS($LC, $Os, $Mi);
        Xn:
        $Gz->setAttribute("\x55\122\x49", "\x23" . $Mi);
        goto GZ;
        fK:
        $Gz->setAttribute("\125\x52\x49", '');
        GZ:
        $jO = $this->createNewSignNode("\x54\162\141\x6e\163\x66\157\162\155\163");
        $Gz->appendChild($jO);
        if (is_array($yx)) {
            goto Xu;
        }
        if (!empty($this->canonicalMethod)) {
            goto gV;
        }
        goto AW;
        Xu:
        foreach ($yx as $Kf) {
            $Ri = $this->createNewSignNode("\124\162\x61\x6e\x73\146\x6f\x72\x6d");
            $jO->appendChild($Ri);
            if (is_array($Kf) && !empty($Kf["\x68\164\x74\x70\x3a\57\x2f\167\x77\x77\x2e\x77\x33\56\x6f\x72\147\57\124\x52\57\61\x39\71\71\57\122\x45\x43\x2d\170\x70\x61\164\x68\x2d\x31\71\x39\x39\x31\61\x31\x36"]) && !empty($Kf["\x68\164\164\160\x3a\x2f\x2f\167\x77\167\x2e\167\x33\x2e\x6f\x72\x67\x2f\124\x52\57\61\71\71\x39\x2f\122\x45\x43\55\170\x70\141\164\x68\55\x31\x39\71\x39\x31\61\x31\x36"]["\161\x75\x65\162\x79"])) {
                goto rr;
            }
            $Ri->setAttribute("\x41\154\147\157\162\x69\x74\x68\x6d", $Kf);
            goto td;
            rr:
            $Ri->setAttribute("\x41\154\147\157\162\x69\x74\x68\155", "\x68\x74\x74\x70\72\57\57\167\x77\x77\56\x77\x33\56\157\x72\147\x2f\124\122\x2f\61\x39\71\71\57\x52\x45\103\x2d\x78\160\141\164\150\55\x31\x39\x39\x39\x31\x31\x31\66");
            $p1 = $this->createNewSignNode("\130\120\141\x74\150", $Kf["\x68\x74\x74\x70\x3a\57\x2f\x77\167\167\56\167\x33\56\157\x72\147\57\124\122\57\x31\x39\x39\71\57\122\105\103\55\x78\160\x61\164\x68\55\x31\x39\x39\71\61\61\x31\x36"]["\161\165\145\x72\171"]);
            $Ri->appendChild($p1);
            if (empty($Kf["\x68\164\x74\160\72\57\x2f\x77\x77\x77\56\x77\63\x2e\157\162\147\57\x54\x52\57\x31\71\x39\x39\57\122\105\x43\55\x78\x70\x61\x74\150\x2d\x31\x39\x39\71\61\61\x31\x36"]["\x6e\141\x6d\145\163\160\141\143\x65\x73"])) {
                goto Y1;
            }
            foreach ($Kf["\x68\164\x74\160\72\x2f\57\167\x77\167\56\167\x33\56\x6f\x72\147\57\x54\122\57\x31\x39\x39\71\57\x52\105\x43\55\170\160\141\x74\x68\55\x31\x39\71\x39\61\61\61\x36"]["\156\x61\x6d\145\x73\160\141\143\145\x73"] as $W9 => $L1) {
                $p1->setAttributeNS("\150\164\164\160\72\x2f\x2f\x77\167\167\56\167\63\x2e\x6f\x72\147\x2f\62\x30\60\x30\57\x78\x6d\154\x6e\x73\x2f", "\170\x6d\154\156\x73\72{$W9}", $L1);
                M3:
            }
            sH:
            Y1:
            td:
            bM:
        }
        iz:
        goto AW;
        gV:
        $Ri = $this->createNewSignNode("\x54\162\x61\x6e\163\146\157\162\155");
        $jO->appendChild($Ri);
        $Ri->setAttribute("\x41\x6c\147\157\x72\x69\x74\150\155", $this->canonicalMethod);
        AW:
        $LL = $this->processTransforms($Gz, $FF);
        $Bc = $this->calculateDigest($LO, $LL);
        $ko = $this->createNewSignNode("\104\x69\147\x65\163\164\115\145\164\x68\157\x64");
        $Gz->appendChild($ko);
        $ko->setAttribute("\101\154\147\157\x72\x69\164\x68\x6d", $LO);
        $ML = $this->createNewSignNode("\104\x69\x67\x65\163\164\126\x61\x6c\165\x65", $Bc);
        $Gz->appendChild($ML);
    }
    public function addReference($FF, $LO, $yx = null, $jR = null)
    {
        if (!($pR = $this->getXPathObj())) {
            goto MC;
        }
        $xI = "\x2e\x2f\x73\x65\x63\x64\x73\x69\147\72\123\x69\147\x6e\145\144\x49\156\x66\157";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($md = $rq->item(0))) {
            goto bq;
        }
        $this->addRefInternal($md, $FF, $LO, $yx, $jR);
        bq:
        MC:
    }
    public function addReferenceList($JC, $LO, $yx = null, $jR = null)
    {
        if (!($pR = $this->getXPathObj())) {
            goto iE;
        }
        $xI = "\x2e\57\163\145\x63\144\x73\151\x67\72\123\151\147\156\145\144\111\x6e\x66\x6f";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($md = $rq->item(0))) {
            goto sC;
        }
        foreach ($JC as $FF) {
            $this->addRefInternal($md, $FF, $LO, $yx, $jR);
            XT:
        }
        Ty:
        sC:
        iE:
    }
    public function addObject($w5, $Kc = null, $Gg = null)
    {
        $JF = $this->createNewSignNode("\x4f\x62\152\145\143\164");
        $this->sigNode->appendChild($JF);
        if (empty($Kc)) {
            goto Pd;
        }
        $JF->setAttribute("\115\x69\155\145\124\x79\x70\x65", $Kc);
        Pd:
        if (empty($Gg)) {
            goto Oi;
        }
        $JF->setAttribute("\105\156\143\157\144\151\156\147", $Gg);
        Oi:
        if ($w5 instanceof DOMElement) {
            goto uk;
        }
        $U9 = $this->sigNode->ownerDocument->createTextNode($w5);
        goto Tn;
        uk:
        $U9 = $this->sigNode->ownerDocument->importNode($w5, true);
        Tn:
        $JF->appendChild($U9);
        return $JF;
    }
    public function locateKey($FF = null)
    {
        if (!empty($FF)) {
            goto ef;
        }
        $FF = $this->sigNode;
        ef:
        if ($FF instanceof DOMNode) {
            goto BG;
        }
        return null;
        BG:
        if (!($rU = $FF->ownerDocument)) {
            goto wO;
        }
        $pR = new DOMXPath($rU);
        $pR->registerNamespace("\163\x65\x63\144\x73\x69\147", self::XMLDSIGNS);
        $xI = "\163\164\x72\151\156\x67\x28\56\57\x73\145\x63\x64\163\151\x67\x3a\123\x69\147\x6e\x65\x64\x49\x6e\x66\157\57\x73\145\x63\x64\x73\151\x67\x3a\x53\x69\x67\x6e\141\164\165\x72\x65\115\x65\x74\150\x6f\144\57\x40\x41\154\147\x6f\x72\x69\164\x68\155\x29";
        $LO = $pR->evaluate($xI, $FF);
        if (!$LO) {
            goto gt;
        }
        try {
            $kJ = new XMLSecurityKey($LO, array("\164\171\x70\x65" => "\160\165\x62\154\x69\143"));
        } catch (Exception $iJ) {
            return null;
        }
        return $kJ;
        gt:
        wO:
        return null;
    }
    public function verify($kJ)
    {
        $rU = $this->sigNode->ownerDocument;
        $pR = new DOMXPath($rU);
        $pR->registerNamespace("\x73\x65\x63\x64\163\x69\147", self::XMLDSIGNS);
        $xI = "\163\x74\162\x69\156\147\x28\56\x2f\163\x65\143\x64\163\151\x67\x3a\123\x69\147\x6e\141\x74\x75\162\x65\126\141\154\x75\145\51";
        $o4 = $pR->evaluate($xI, $this->sigNode);
        if (!empty($o4)) {
            goto pO;
        }
        throw new Exception("\125\x6e\141\142\154\x65\40\164\x6f\40\x6c\157\143\x61\x74\145\x20\x53\151\147\156\141\164\x75\x72\x65\x56\x61\x6c\165\x65");
        pO:
        return $kJ->verifySignature($this->signedInfo, base64_decode($o4));
    }
    public function signData($kJ, $w5)
    {
        return $kJ->signData($w5);
    }
    public function sign($kJ, $qP = null)
    {
        if (!($qP != null)) {
            goto sr;
        }
        $this->resetXPathObj();
        $this->appendSignature($qP);
        $this->sigNode = $qP->lastChild;
        sr:
        if (!($pR = $this->getXPathObj())) {
            goto Fu;
        }
        $xI = "\56\57\x73\x65\143\x64\x73\151\147\72\123\x69\147\156\145\x64\x49\156\146\x6f";
        $rq = $pR->query($xI, $this->sigNode);
        if (!($md = $rq->item(0))) {
            goto ja;
        }
        $xI = "\x2e\57\x73\145\x63\144\163\x69\147\x3a\x53\x69\x67\156\x61\164\165\162\145\115\x65\164\x68\x6f\x64";
        $rq = $pR->query($xI, $md);
        $Ia = $rq->item(0);
        $Ia->setAttribute("\x41\x6c\147\x6f\162\x69\164\150\155", $kJ->type);
        $w5 = $this->canonicalizeData($md, $this->canonicalMethod);
        $o4 = base64_encode($this->signData($kJ, $w5));
        $hb = $this->createNewSignNode("\x53\151\147\x6e\x61\x74\165\x72\x65\x56\141\154\x75\x65", $o4);
        if ($en = $md->nextSibling) {
            goto Bj;
        }
        $this->sigNode->appendChild($hb);
        goto uP;
        Bj:
        $en->parentNode->insertBefore($hb, $en);
        uP:
        ja:
        Fu:
    }
    public function appendCert()
    {
    }
    public function appendKey($kJ, $Ba = null)
    {
        $kJ->serializeKey($Ba);
    }
    public function insertSignature($FF, $Ws = null)
    {
        $hW = $FF->ownerDocument;
        $aX = $hW->importNode($this->sigNode, true);
        if ($Ws == null) {
            goto j1;
        }
        return $FF->insertBefore($aX, $Ws);
        goto bd;
        j1:
        return $FF->insertBefore($aX);
        bd:
    }
    public function appendSignature($it, $HZ = false)
    {
        $Ws = $HZ ? $it->firstChild : null;
        return $this->insertSignature($it, $Ws);
    }
    public static function get509XCert($fN, $nM = true)
    {
        $AS = self::staticGet509XCerts($fN, $nM);
        if (empty($AS)) {
            goto RJ;
        }
        return $AS[0];
        RJ:
        return '';
    }
    public static function staticGet509XCerts($AS, $nM = true)
    {
        if ($nM) {
            goto zP;
        }
        return array($AS);
        goto JI;
        zP:
        $w5 = '';
        $rc = array();
        $w_ = explode("\12", $AS);
        $Ku = false;
        foreach ($w_ as $BP) {
            if (!$Ku) {
                goto Eu;
            }
            if (!(strncmp($BP, "\x2d\x2d\x2d\x2d\55\x45\x4e\x44\x20\103\105\x52\124\111\106\x49\x43\101\x54\x45", 20) == 0)) {
                goto k_;
            }
            $Ku = false;
            $rc[] = $w5;
            $w5 = '';
            goto Ig;
            k_:
            $w5 .= trim($BP);
            goto ic;
            Eu:
            if (!(strncmp($BP, "\55\x2d\55\55\x2d\x42\105\107\x49\116\40\103\105\122\124\x49\x46\111\x43\101\x54\105", 22) == 0)) {
                goto rp;
            }
            $Ku = true;
            rp:
            ic:
            Ig:
        }
        E4:
        return $rc;
        JI:
    }
    public static function staticAdd509Cert($mw, $fN, $nM = true, $YJ = false, $pR = null, $jR = null)
    {
        if (!$YJ) {
            goto EQ;
        }
        $fN = file_get_contents($fN);
        EQ:
        if ($mw instanceof DOMElement) {
            goto PK;
        }
        throw new Exception("\x49\156\x76\x61\x6c\151\x64\x20\x70\x61\x72\145\x6e\x74\x20\116\x6f\144\x65\x20\160\141\x72\x61\x6d\145\164\x65\162");
        PK:
        $ig = $mw->ownerDocument;
        if (!empty($pR)) {
            goto kf;
        }
        $pR = new DOMXPath($mw->ownerDocument);
        $pR->registerNamespace("\163\x65\x63\x64\x73\151\x67", self::XMLDSIGNS);
        kf:
        $xI = "\x2e\57\x73\145\x63\144\x73\x69\x67\x3a\x4b\x65\x79\x49\156\x66\157";
        $rq = $pR->query($xI, $mw);
        $bq = $rq->item(0);
        $J7 = '';
        if (!$bq) {
            goto kw;
        }
        $I5 = $bq->lookupPrefix(self::XMLDSIGNS);
        if (empty($I5)) {
            goto kP;
        }
        $J7 = $I5 . "\x3a";
        kP:
        goto c1;
        kw:
        $I5 = $mw->lookupPrefix(self::XMLDSIGNS);
        if (empty($I5)) {
            goto jm;
        }
        $J7 = $I5 . "\x3a";
        jm:
        $yi = false;
        $bq = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\x4b\145\x79\111\x6e\146\157");
        $xI = "\x2e\57\x73\145\143\x64\163\x69\147\x3a\x4f\142\152\x65\x63\x74";
        $rq = $pR->query($xI, $mw);
        if (!($l4 = $rq->item(0))) {
            goto VQ;
        }
        $l4->parentNode->insertBefore($bq, $l4);
        $yi = true;
        VQ:
        if ($yi) {
            goto Ie;
        }
        $mw->appendChild($bq);
        Ie:
        c1:
        $AS = self::staticGet509XCerts($fN, $nM);
        $pS = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\x58\65\x30\x39\x44\141\164\x61");
        $bq->appendChild($pS);
        $nk = false;
        $Jr = false;
        if (!is_array($jR)) {
            goto Yk;
        }
        if (empty($jR["\151\x73\x73\165\145\162\x53\x65\162\x69\x61\x6c"])) {
            goto EK;
        }
        $nk = true;
        EK:
        if (empty($jR["\163\165\142\152\x65\x63\164\x4e\x61\x6d\x65"])) {
            goto cL;
        }
        $Jr = true;
        cL:
        Yk:
        foreach ($AS as $R9) {
            if (!($nk || $Jr)) {
                goto ML;
            }
            if (!($Em = openssl_x509_parse("\55\x2d\55\55\x2d\102\105\107\x49\116\x20\x43\105\x52\124\x49\x46\x49\x43\101\124\x45\55\x2d\55\x2d\55\12" . chunk_split($R9, 64, "\xa") . "\55\55\x2d\x2d\55\105\116\x44\40\103\105\x52\x54\111\x46\111\103\101\x54\x45\x2d\x2d\55\x2d\55\xa"))) {
                goto Uk;
            }
            if (!($Jr && !empty($Em["\x73\x75\x62\152\145\x63\164"]))) {
                goto C1;
            }
            if (is_array($Em["\163\x75\142\152\x65\143\164"])) {
                goto fp;
            }
            $Q6 = $Em["\x69\163\x73\165\x65\x72"];
            goto yk;
            fp:
            $JM = array();
            foreach ($Em["\x73\165\142\152\145\143\x74"] as $AM => $W8) {
                if (is_array($W8)) {
                    goto jA;
                }
                array_unshift($JM, "{$AM}\75{$W8}");
                goto V8;
                jA:
                foreach ($W8 as $ZD) {
                    array_unshift($JM, "{$AM}\75{$ZD}");
                    vE:
                }
                rd:
                V8:
                wJ:
            }
            ot:
            $Q6 = implode("\54", $JM);
            yk:
            $Ye = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\x58\65\60\x39\x53\x75\x62\x6a\145\x63\164\116\x61\x6d\x65", $Q6);
            $pS->appendChild($Ye);
            C1:
            if (!($nk && !empty($Em["\151\x73\163\x75\x65\x72"]) && !empty($Em["\163\145\x72\151\141\x6c\x4e\165\155\142\145\x72"]))) {
                goto Ey;
            }
            if (is_array($Em["\x69\x73\163\165\145\x72"])) {
                goto Z_;
            }
            $tg = $Em["\x69\163\x73\165\145\162"];
            goto w8;
            Z_:
            $JM = array();
            foreach ($Em["\x69\x73\x73\x75\x65\x72"] as $AM => $W8) {
                array_unshift($JM, "{$AM}\x3d{$W8}");
                ra:
            }
            j_:
            $tg = implode("\x2c", $JM);
            w8:
            $bB = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\130\65\x30\x39\111\163\x73\165\145\x72\123\x65\x72\x69\x61\154");
            $pS->appendChild($bB);
            $YO = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\130\65\x30\x39\x49\x73\163\165\145\x72\116\x61\155\145", $tg);
            $bB->appendChild($YO);
            $YO = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\x58\x35\x30\x39\123\x65\162\x69\141\154\116\x75\155\142\x65\x72", $Em["\163\x65\x72\x69\x61\154\x4e\x75\155\142\145\x72"]);
            $bB->appendChild($YO);
            Ey:
            Uk:
            ML:
            $hA = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\x58\x35\60\x39\103\x65\162\164\151\x66\x69\143\x61\164\145", $R9);
            $pS->appendChild($hA);
            vs:
        }
        MK:
    }
    public function add509Cert($fN, $nM = true, $YJ = false, $jR = null)
    {
        if (!($pR = $this->getXPathObj())) {
            goto ay;
        }
        self::staticAdd509Cert($this->sigNode, $fN, $nM, $YJ, $pR, $jR);
        ay:
    }
    public function appendToKeyInfo($FF)
    {
        $mw = $this->sigNode;
        $ig = $mw->ownerDocument;
        $pR = $this->getXPathObj();
        if (!empty($pR)) {
            goto eg;
        }
        $pR = new DOMXPath($mw->ownerDocument);
        $pR->registerNamespace("\x73\x65\x63\x64\x73\x69\147", self::XMLDSIGNS);
        eg:
        $xI = "\x2e\x2f\163\x65\x63\x64\163\x69\x67\72\113\x65\171\x49\156\x66\157";
        $rq = $pR->query($xI, $mw);
        $bq = $rq->item(0);
        if ($bq) {
            goto qH;
        }
        $J7 = '';
        $I5 = $mw->lookupPrefix(self::XMLDSIGNS);
        if (empty($I5)) {
            goto Ed;
        }
        $J7 = $I5 . "\x3a";
        Ed:
        $yi = false;
        $bq = $ig->createElementNS(self::XMLDSIGNS, $J7 . "\113\145\171\x49\x6e\x66\x6f");
        $xI = "\x2e\x2f\163\x65\143\144\163\x69\x67\72\117\142\152\145\143\x74";
        $rq = $pR->query($xI, $mw);
        if (!($l4 = $rq->item(0))) {
            goto x3;
        }
        $l4->parentNode->insertBefore($bq, $l4);
        $yi = true;
        x3:
        if ($yi) {
            goto WV;
        }
        $mw->appendChild($bq);
        WV:
        qH:
        $bq->appendChild($FF);
        return $bq;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
class XMLSecEnc
{
    const template = "\74\170\145\x6e\x63\72\105\x6e\143\162\171\160\x74\x65\144\104\141\164\141\x20\x78\x6d\154\156\163\72\x78\145\156\143\75\47\x68\x74\x74\x70\x3a\57\57\x77\x77\x77\56\x77\63\56\x6f\x72\147\x2f\62\60\60\61\x2f\60\64\57\170\155\x6c\145\156\x63\x23\47\x3e\15\xa\x20\40\40\74\x78\x65\156\143\x3a\103\151\160\x68\x65\162\x44\x61\x74\141\76\15\12\40\x20\40\x20\40\40\x3c\x78\145\x6e\143\x3a\103\151\160\150\145\x72\x56\141\x6c\165\x65\x3e\74\x2f\x78\145\x6e\x63\72\103\151\x70\150\145\162\x56\141\154\x75\145\x3e\xd\12\x20\x20\40\74\57\x78\145\x6e\x63\x3a\103\151\160\150\x65\162\104\141\164\x61\x3e\xd\xa\74\x2f\170\x65\156\143\72\x45\x6e\x63\162\x79\x70\x74\x65\144\104\141\x74\x61\x3e";
    const Element = "\150\164\164\160\72\57\x2f\x77\x77\167\56\167\63\56\157\x72\x67\57\62\60\x30\x31\x2f\60\x34\57\170\x6d\154\145\x6e\x63\43\105\154\145\155\x65\156\x74";
    const Content = "\150\x74\164\x70\x3a\57\x2f\x77\x77\167\56\167\63\56\157\162\147\x2f\x32\x30\x30\x31\57\x30\64\57\170\155\154\145\x6e\143\x23\103\157\156\164\x65\x6e\x74";
    const URI = 3;
    const XMLENCNS = "\x68\164\x74\160\72\x2f\57\167\x77\x77\x2e\167\x33\56\157\162\x67\x2f\62\x30\x30\61\x2f\60\x34\57\170\155\154\x65\156\x63\x23";
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
    public function addReference($n3, $FF, $S2)
    {
        if ($FF instanceof DOMNode) {
            goto PW;
        }
        throw new Exception("\44\156\157\144\145\40\151\163\x20\x6e\x6f\164\40\157\x66\x20\164\171\x70\145\40\x44\117\x4d\x4e\x6f\144\145");
        PW:
        $Co = $this->encdoc;
        $this->_resetTemplate();
        $dE = $this->encdoc;
        $this->encdoc = $Co;
        $Lp = XMLSecurityDSig::generateGUID();
        $S_ = $dE->documentElement;
        $S_->setAttribute("\x49\144", $Lp);
        $this->references[$n3] = array("\x6e\157\x64\x65" => $FF, "\164\171\160\145" => $S2, "\145\156\143\x6e\x6f\144\x65" => $dE, "\162\145\146\x75\x72\x69" => $Lp);
    }
    public function setNode($FF)
    {
        $this->rawNode = $FF;
    }
    public function encryptNode($kJ, $kp = true)
    {
        $w5 = '';
        if (!empty($this->rawNode)) {
            goto fs;
        }
        throw new Exception("\x4e\x6f\x64\145\40\164\157\40\x65\x6e\x63\x72\x79\x70\x74\40\x68\x61\x73\40\x6e\x6f\164\40\x62\x65\x65\156\40\163\145\164");
        fs:
        if ($kJ instanceof XMLSecurityKey) {
            goto Bw;
        }
        throw new Exception("\x49\x6e\x76\x61\x6c\151\144\x20\x4b\145\x79");
        Bw:
        $rU = $this->rawNode->ownerDocument;
        $wM = new DOMXPath($this->encdoc);
        $Lc = $wM->query("\x2f\x78\145\x6e\143\72\x45\x6e\143\162\171\x70\x74\145\144\x44\x61\164\141\57\170\145\x6e\143\72\103\151\x70\x68\145\162\104\x61\164\x61\57\170\145\x6e\143\72\103\x69\160\150\x65\x72\126\141\154\x75\x65");
        $gD = $Lc->item(0);
        if (!($gD == null)) {
            goto tN;
        }
        throw new Exception("\105\162\x72\157\162\x20\x6c\157\x63\x61\164\x69\156\x67\40\x43\151\x70\150\145\162\126\141\x6c\x75\145\x20\x65\154\145\x6d\x65\156\x74\40\x77\151\x74\150\151\156\40\164\x65\155\160\154\x61\164\145");
        tN:
        switch ($this->type) {
            case self::Element:
                $w5 = $rU->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\x54\x79\160\x65", self::Element);
                goto i6;
            case self::Content:
                $GK = $this->rawNode->childNodes;
                foreach ($GK as $i_) {
                    $w5 .= $rU->saveXML($i_);
                    J8:
                }
                bg:
                $this->encdoc->documentElement->setAttribute("\124\171\160\x65", self::Content);
                goto i6;
            default:
                throw new Exception("\124\171\x70\x65\x20\151\x73\x20\143\165\162\162\x65\x6e\164\154\171\x20\156\157\x74\x20\x73\x75\160\160\157\x72\x74\x65\144");
        }
        zl:
        i6:
        $ca = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\x3a\x45\x6e\143\x72\171\160\164\x69\x6f\x6e\115\x65\x74\150\x6f\144"));
        $ca->setAttribute("\101\x6c\147\157\162\x69\x74\150\x6d", $kJ->getAlgorithm());
        $gD->parentNode->parentNode->insertBefore($ca, $gD->parentNode->parentNode->firstChild);
        $rH = base64_encode($kJ->encryptData($w5));
        $W8 = $this->encdoc->createTextNode($rH);
        $gD->appendChild($W8);
        if ($kp) {
            goto QN;
        }
        return $this->encdoc->documentElement;
        goto K6;
        QN:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto n9;
                }
                return $this->encdoc;
                n9:
                $cb = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($cb, $this->rawNode);
                return $cb;
            case self::Content:
                $cb = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                J1:
                if (!$this->rawNode->firstChild) {
                    goto XW;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto J1;
                XW:
                $this->rawNode->appendChild($cb);
                return $cb;
        }
        Ll:
        Yn:
        K6:
    }
    public function encryptReferences($kJ)
    {
        $Af = $this->rawNode;
        $jd = $this->type;
        foreach ($this->references as $n3 => $WR) {
            $this->encdoc = $WR["\145\156\143\156\x6f\x64\145"];
            $this->rawNode = $WR["\156\157\x64\x65"];
            $this->type = $WR["\164\x79\160\145"];
            try {
                $UX = $this->encryptNode($kJ);
                $this->references[$n3]["\x65\x6e\x63\156\x6f\x64\x65"] = $UX;
            } catch (Exception $iJ) {
                $this->rawNode = $Af;
                $this->type = $jd;
                throw $iJ;
            }
            uc:
        }
        ac:
        $this->rawNode = $Af;
        $this->type = $jd;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto io;
        }
        throw new Exception("\116\x6f\144\x65\x20\164\x6f\40\144\x65\x63\x72\x79\160\x74\40\x68\141\x73\x20\156\x6f\164\40\x62\x65\145\x6e\40\x73\145\x74");
        io:
        $rU = $this->rawNode->ownerDocument;
        $wM = new DOMXPath($rU);
        $wM->registerNamespace("\170\x6d\x6c\145\x6e\x63\162", self::XMLENCNS);
        $xI = "\x2e\57\170\155\x6c\x65\x6e\143\162\x3a\103\x69\x70\x68\x65\x72\104\x61\x74\141\x2f\x78\x6d\x6c\145\x6e\143\x72\72\103\x69\160\150\x65\x72\126\x61\x6c\x75\145";
        $rq = $wM->query($xI, $this->rawNode);
        $FF = $rq->item(0);
        if ($FF) {
            goto Fa;
        }
        return null;
        Fa:
        return base64_decode($FF->nodeValue);
    }
    public function decryptNode($kJ, $kp = true)
    {
        if ($kJ instanceof XMLSecurityKey) {
            goto gS;
        }
        throw new Exception("\x49\156\166\141\154\151\x64\x20\x4b\145\171");
        gS:
        $X2 = $this->getCipherValue();
        if ($X2) {
            goto oH;
        }
        throw new Exception("\x43\141\156\156\157\164\x20\154\x6f\x63\141\x74\x65\40\145\156\x63\162\x79\160\x74\x65\144\x20\144\x61\164\x61");
        goto o2;
        oH:
        $Ci = $kJ->decryptData($X2);
        if ($kp) {
            goto W1;
        }
        return $Ci;
        goto W7;
        W1:
        switch ($this->type) {
            case self::Element:
                $qW = new DOMDocument();
                $qW->loadXML($Ci);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto l8;
                }
                return $qW;
                l8:
                $cb = $this->rawNode->ownerDocument->importNode($qW->documentElement, true);
                $this->rawNode->parentNode->replaceChild($cb, $this->rawNode);
                return $cb;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto s0;
                }
                $rU = $this->rawNode->ownerDocument;
                goto O2;
                s0:
                $rU = $this->rawNode;
                O2:
                $VY = $rU->createDocumentFragment();
                $VY->appendXML($Ci);
                $Ba = $this->rawNode->parentNode;
                $Ba->replaceChild($VY, $this->rawNode);
                return $Ba;
            default:
                return $Ci;
        }
        A6:
        Vr:
        W7:
        o2:
    }
    public function encryptKey($Cp, $M1, $Wi = true)
    {
        if (!(!$Cp instanceof XMLSecurityKey || !$M1 instanceof XMLSecurityKey)) {
            goto cq;
        }
        throw new Exception("\111\156\166\141\154\151\x64\40\x4b\x65\171");
        cq:
        $Cx = base64_encode($Cp->encryptData($M1->key));
        $NQ = $this->encdoc->documentElement;
        $mb = $this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\143\72\x45\x6e\143\162\x79\160\164\x65\144\x4b\145\x79");
        if ($Wi) {
            goto xN;
        }
        $this->encKey = $mb;
        goto Qc;
        xN:
        $bq = $NQ->insertBefore($this->encdoc->createElementNS("\x68\x74\x74\x70\x3a\57\x2f\x77\167\167\56\x77\x33\x2e\x6f\162\147\x2f\x32\60\x30\60\x2f\60\71\57\x78\155\154\x64\163\x69\147\x23", "\144\163\x69\147\x3a\113\x65\171\111\156\x66\x6f"), $NQ->firstChild);
        $bq->appendChild($mb);
        Qc:
        $ca = $mb->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\x63\72\105\156\x63\162\171\160\164\151\x6f\156\115\145\164\150\157\x64"));
        $ca->setAttribute("\x41\154\147\x6f\x72\151\x74\x68\x6d", $Cp->getAlgorithm());
        if (empty($Cp->name)) {
            goto lQ;
        }
        $bq = $mb->appendChild($this->encdoc->createElementNS("\x68\164\164\x70\x3a\x2f\x2f\167\x77\167\x2e\x77\63\56\157\x72\x67\x2f\62\60\x30\x30\57\x30\x39\57\170\x6d\154\144\163\x69\147\x23", "\x64\163\x69\x67\72\x4b\x65\171\x49\x6e\x66\x6f"));
        $bq->appendChild($this->encdoc->createElementNS("\x68\164\x74\160\72\x2f\57\167\167\x77\56\167\63\x2e\x6f\162\x67\57\x32\x30\60\60\57\60\71\x2f\x78\x6d\x6c\144\x73\x69\x67\x23", "\x64\x73\x69\147\x3a\x4b\145\171\x4e\141\x6d\x65", $Cp->name));
        lQ:
        $vB = $mb->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\143\72\x43\x69\x70\x68\x65\162\104\x61\x74\141"));
        $vB->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\156\x63\x3a\x43\x69\160\150\145\162\x56\x61\x6c\x75\145", $Cx));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto hp;
        }
        $U_ = $mb->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\x3a\122\x65\x66\145\162\x65\x6e\143\x65\114\151\x73\164"));
        foreach ($this->references as $n3 => $WR) {
            $Lp = $WR["\162\x65\146\x75\x72\151"];
            $u6 = $U_->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\156\x63\x3a\x44\x61\x74\141\122\145\146\x65\162\145\156\x63\145"));
            $u6->setAttribute("\125\x52\x49", "\43" . $Lp);
            jG:
        }
        QW:
        hp:
        return;
    }
    public function decryptKey($mb)
    {
        if ($mb->isEncrypted) {
            goto mM;
        }
        throw new Exception("\x4b\x65\x79\40\x69\163\40\156\x6f\x74\40\105\x6e\x63\x72\x79\x70\164\x65\x64");
        mM:
        if (!empty($mb->key)) {
            goto OA;
        }
        throw new Exception("\x4b\145\171\40\x69\163\40\155\151\x73\163\151\156\147\x20\x64\141\164\x61\x20\164\x6f\x20\160\145\x72\x66\157\x72\155\40\164\150\145\40\x64\145\x63\x72\171\x70\164\151\x6f\156");
        OA:
        return $this->decryptNode($mb, false);
    }
    public function locateEncryptedData($S_)
    {
        if ($S_ instanceof DOMDocument) {
            goto m8;
        }
        $rU = $S_->ownerDocument;
        goto Bc;
        m8:
        $rU = $S_;
        Bc:
        if (!$rU) {
            goto ql;
        }
        $pR = new DOMXPath($rU);
        $xI = "\x2f\57\52\133\x6c\157\143\x61\x6c\x2d\x6e\x61\155\145\x28\x29\x3d\x27\x45\x6e\x63\162\x79\x70\164\145\x64\104\x61\x74\141\47\x20\141\x6e\x64\40\x6e\x61\155\145\x73\160\x61\x63\145\x2d\x75\162\151\50\51\x3d\47" . self::XMLENCNS . "\47\135";
        $rq = $pR->query($xI);
        return $rq->item(0);
        ql:
        return null;
    }
    public function locateKey($FF = null)
    {
        if (!empty($FF)) {
            goto uO;
        }
        $FF = $this->rawNode;
        uO:
        if ($FF instanceof DOMNode) {
            goto Ld;
        }
        return null;
        Ld:
        if (!($rU = $FF->ownerDocument)) {
            goto H5;
        }
        $pR = new DOMXPath($rU);
        $pR->registerNamespace("\170\155\x6c\x73\x65\143\x65\x6e\x63", self::XMLENCNS);
        $xI = "\56\57\57\x78\x6d\x6c\x73\145\143\x65\x6e\143\72\x45\156\x63\x72\171\160\x74\x69\x6f\156\x4d\145\164\x68\157\144";
        $rq = $pR->query($xI, $FF);
        if (!($J2 = $rq->item(0))) {
            goto ga;
        }
        $Lw = $J2->getAttribute("\x41\x6c\147\157\x72\151\x74\x68\x6d");
        try {
            $kJ = new XMLSecurityKey($Lw, array("\164\x79\160\145" => "\x70\x72\151\x76\141\x74\145"));
        } catch (Exception $iJ) {
            return null;
        }
        return $kJ;
        ga:
        H5:
        return null;
    }
    public static function staticLocateKeyInfo($gO = null, $FF = null)
    {
        if (!(empty($FF) || !$FF instanceof DOMNode)) {
            goto CQ;
        }
        return null;
        CQ:
        $rU = $FF->ownerDocument;
        if ($rU) {
            goto kO;
        }
        return null;
        kO:
        $pR = new DOMXPath($rU);
        $pR->registerNamespace("\170\x6d\x6c\x73\145\143\145\156\143", self::XMLENCNS);
        $pR->registerNamespace("\x78\x6d\154\x73\145\x63\144\x73\151\x67", XMLSecurityDSig::XMLDSIGNS);
        $xI = "\56\57\170\x6d\154\x73\x65\143\x64\163\151\x67\x3a\x4b\x65\x79\111\x6e\x66\x6f";
        $rq = $pR->query($xI, $FF);
        $J2 = $rq->item(0);
        if ($J2) {
            goto Sr;
        }
        return $gO;
        Sr:
        foreach ($J2->childNodes as $i_) {
            switch ($i_->localName) {
                case "\x4b\145\171\x4e\x61\155\145":
                    if (empty($gO)) {
                        goto Nl;
                    }
                    $gO->name = $i_->nodeValue;
                    Nl:
                    goto Rf;
                case "\113\x65\171\x56\x61\154\x75\145":
                    foreach ($i_->childNodes as $Pz) {
                        switch ($Pz->localName) {
                            case "\104\123\101\113\145\x79\x56\141\x6c\x75\x65":
                                throw new Exception("\104\123\x41\x4b\145\x79\x56\141\154\x75\x65\x20\x63\x75\x72\x72\145\156\x74\154\171\x20\x6e\157\164\40\x73\x75\160\x70\157\x72\164\145\x64");
                            case "\x52\x53\101\x4b\x65\x79\x56\x61\154\x75\x65":
                                $OJ = null;
                                $rk = null;
                                if (!($GT = $Pz->getElementsByTagName("\115\x6f\144\x75\154\165\x73")->item(0))) {
                                    goto EN;
                                }
                                $OJ = base64_decode($GT->nodeValue);
                                EN:
                                if (!($ho = $Pz->getElementsByTagName("\105\x78\x70\x6f\156\145\156\164")->item(0))) {
                                    goto ma;
                                }
                                $rk = base64_decode($ho->nodeValue);
                                ma:
                                if (!(empty($OJ) || empty($rk))) {
                                    goto Mf;
                                }
                                throw new Exception("\x4d\x69\163\x73\x69\x6e\x67\40\x4d\x6f\144\x75\x6c\165\x73\x20\157\x72\40\105\x78\160\157\156\x65\156\164");
                                Mf:
                                $uj = XMLSecurityKey::convertRSA($OJ, $rk);
                                $gO->loadKey($uj);
                                goto l6;
                        }
                        yd:
                        l6:
                        Yv:
                    }
                    Pn:
                    goto Rf;
                case "\x52\x65\164\162\x69\x65\166\141\154\115\145\x74\150\157\144":
                    $S2 = $i_->getAttribute("\x54\171\x70\145");
                    if (!($S2 !== "\x68\x74\164\160\72\x2f\x2f\x77\167\x77\x2e\x77\63\x2e\x6f\x72\x67\57\x32\x30\60\61\57\60\x34\57\x78\155\x6c\x65\x6e\143\x23\105\x6e\x63\x72\171\x70\164\145\x64\x4b\x65\171")) {
                        goto lt;
                    }
                    goto Rf;
                    lt:
                    $Mi = $i_->getAttribute("\125\x52\x49");
                    if (!($Mi[0] !== "\43")) {
                        goto ME;
                    }
                    goto Rf;
                    ME:
                    $my = substr($Mi, 1);
                    $xI = "\57\57\x78\x6d\154\x73\x65\143\145\x6e\x63\72\x45\156\143\162\171\160\x74\x65\144\113\145\171\133\100\x49\144\75\x27{$my}\47\x5d";
                    $Iy = $pR->query($xI)->item(0);
                    if ($Iy) {
                        goto XO;
                    }
                    throw new Exception("\125\156\x61\142\154\145\x20\x74\x6f\x20\x6c\x6f\x63\x61\164\145\x20\x45\156\x63\162\171\160\x74\x65\x64\113\x65\171\x20\x77\x69\164\x68\x20\100\x49\144\x3d\47{$my}\x27\56");
                    XO:
                    return XMLSecurityKey::fromEncryptedKeyElement($Iy);
                case "\105\156\143\162\x79\160\164\x65\x64\x4b\x65\x79":
                    return XMLSecurityKey::fromEncryptedKeyElement($i_);
                case "\130\65\x30\71\x44\x61\x74\x61":
                    if (!($Nk = $i_->getElementsByTagName("\x58\65\60\71\103\145\162\x74\x69\146\151\x63\x61\x74\145"))) {
                        goto eT;
                    }
                    if (!($Nk->length > 0)) {
                        goto gu;
                    }
                    $qp = $Nk->item(0)->textContent;
                    $qp = str_replace(array("\xd", "\xa", "\x20"), '', $qp);
                    $qp = "\55\55\55\55\x2d\102\x45\x47\111\116\40\x43\x45\122\124\111\x46\x49\x43\x41\x54\x45\x2d\55\x2d\55\55\12" . chunk_split($qp, 64, "\xa") . "\55\55\x2d\x2d\55\x45\116\x44\40\103\x45\122\x54\x49\106\x49\103\101\x54\105\x2d\55\x2d\55\x2d\xa";
                    $gO->loadKey($qp, false, true);
                    gu:
                    eT:
                    goto Rf;
            }
            jO:
            Rf:
            Ka:
        }
        mw:
        return $gO;
    }
    public function locateKeyInfo($gO = null, $FF = null)
    {
        if (!empty($FF)) {
            goto YZ;
        }
        $FF = $this->rawNode;
        YZ:
        return self::staticLocateKeyInfo($gO, $FF);
    }
}
