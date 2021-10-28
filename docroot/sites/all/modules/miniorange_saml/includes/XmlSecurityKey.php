<?php


class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\x68\x74\x74\160\72\x2f\x2f\x77\167\167\x2e\167\x33\x2e\x6f\x72\147\57\x32\60\60\61\57\x30\64\x2f\x78\155\x6c\145\x6e\x63\x23\x74\x72\151\160\x6c\145\x64\145\x73\55\143\142\143";
    const AES128_CBC = "\150\x74\164\x70\72\x2f\x2f\167\x77\x77\x2e\167\63\56\157\162\147\57\x32\60\x30\61\x2f\60\x34\x2f\x78\x6d\x6c\145\156\x63\x23\x61\145\x73\x31\x32\70\x2d\143\x62\143";
    const AES192_CBC = "\x68\164\164\x70\x3a\57\x2f\167\167\167\x2e\167\x33\x2e\x6f\162\x67\57\62\x30\60\x31\57\x30\64\x2f\170\155\x6c\145\x6e\x63\x23\x61\x65\x73\61\71\x32\55\x63\142\143";
    const AES256_CBC = "\x68\x74\x74\x70\x3a\x2f\x2f\x77\x77\167\x2e\167\x33\56\x6f\162\147\57\x32\x30\x30\x31\57\x30\64\57\x78\x6d\x6c\x65\x6e\143\43\141\145\x73\62\x35\x36\x2d\x63\x62\x63";
    const RSA_1_5 = "\x68\164\x74\160\x3a\x2f\57\x77\x77\x77\56\x77\63\56\157\x72\147\57\62\60\60\61\x2f\x30\64\57\170\x6d\154\x65\x6e\143\x23\162\163\141\x2d\61\137\65";
    const RSA_OAEP_MGF1P = "\x68\x74\x74\x70\72\57\x2f\167\x77\x77\56\167\x33\x2e\157\162\147\x2f\62\x30\60\61\x2f\60\x34\57\170\155\154\145\x6e\x63\x23\x72\163\x61\55\x6f\141\145\160\x2d\155\x67\x66\x31\x70";
    const DSA_SHA1 = "\x68\164\x74\160\72\x2f\57\x77\x77\167\56\x77\63\56\157\162\x67\57\62\x30\60\x30\57\x30\x39\x2f\170\155\154\x64\x73\151\147\43\144\x73\141\55\x73\150\141\x31";
    const RSA_SHA1 = "\150\164\164\x70\x3a\x2f\x2f\167\167\x77\56\x77\63\x2e\157\162\147\x2f\x32\x30\x30\60\x2f\x30\x39\57\x78\x6d\154\144\163\x69\x67\43\x72\x73\141\55\163\150\141\x31";
    const RSA_SHA256 = "\x68\164\164\x70\x3a\57\x2f\x77\x77\167\x2e\x77\63\56\x6f\162\147\57\62\60\x30\x31\x2f\60\64\57\170\155\x6c\144\x73\x69\x67\55\x6d\157\x72\145\x23\x72\163\141\55\163\x68\x61\x32\65\66";
    const RSA_SHA384 = "\150\164\164\160\72\x2f\x2f\167\x77\167\x2e\x77\63\x2e\157\162\x67\x2f\x32\60\60\x31\x2f\60\64\x2f\x78\x6d\154\144\163\151\x67\55\155\157\x72\145\43\x72\x73\141\55\163\x68\141\63\x38\x34";
    const RSA_SHA512 = "\x68\x74\x74\160\x3a\x2f\57\x77\167\x77\x2e\167\63\x2e\x6f\x72\147\x2f\x32\60\x30\61\57\60\x34\57\170\x6d\154\144\163\151\x67\55\x6d\157\x72\x65\43\x72\163\x61\55\163\150\141\65\61\62";
    const HMAC_SHA1 = "\150\x74\164\160\72\57\57\167\167\x77\56\167\x33\x2e\x6f\x72\x67\x2f\x32\x30\60\60\57\60\71\x2f\170\155\154\144\x73\151\147\43\x68\155\x61\143\x2d\163\x68\x61\x31";
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
    public function __construct($dE, $Ak = null)
    {
        switch ($dE) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\x6c\151\142\162\141\x72\x79"] = "\x6f\x70\145\x6e\163\163\154";
                $this->cryptParams["\143\151\160\150\x65\x72"] = "\144\145\163\x2d\145\x64\x65\63\55\x63\x62\x63";
                $this->cryptParams["\164\x79\160\x65"] = "\x73\x79\x6d\x6d\x65\164\162\x69\143";
                $this->cryptParams["\x6d\x65\x74\150\157\x64"] = "\x68\x74\x74\160\72\57\x2f\167\167\x77\56\167\x33\x2e\157\162\x67\x2f\x32\x30\60\x31\57\x30\x34\57\x78\x6d\154\145\156\143\43\164\x72\x69\160\x6c\x65\144\145\x73\x2d\143\x62\x63";
                $this->cryptParams["\153\145\x79\163\151\x7a\145"] = 24;
                $this->cryptParams["\142\154\157\143\153\163\x69\172\145"] = 8;
                goto lB;
            case self::AES128_CBC:
                $this->cryptParams["\x6c\151\x62\162\141\x72\x79"] = "\x6f\x70\145\156\x73\x73\x6c";
                $this->cryptParams["\143\x69\x70\150\145\162"] = "\141\x65\x73\x2d\61\x32\70\55\x63\142\143";
                $this->cryptParams["\x74\171\160\x65"] = "\163\x79\x6d\x6d\145\164\162\151\x63";
                $this->cryptParams["\x6d\x65\164\150\x6f\144"] = "\150\x74\x74\160\72\57\x2f\167\167\x77\56\x77\x33\x2e\157\162\147\x2f\62\x30\60\61\57\60\64\57\x78\x6d\154\145\x6e\143\43\x61\145\163\61\x32\x38\55\x63\x62\x63";
                $this->cryptParams["\153\x65\x79\163\151\172\x65"] = 16;
                $this->cryptParams["\142\x6c\x6f\143\153\x73\151\172\x65"] = 16;
                goto lB;
            case self::AES192_CBC:
                $this->cryptParams["\x6c\151\x62\x72\x61\162\x79"] = "\157\x70\145\x6e\x73\163\x6c";
                $this->cryptParams["\143\x69\x70\x68\145\162"] = "\x61\145\163\55\x31\71\62\55\143\x62\x63";
                $this->cryptParams["\164\x79\160\x65"] = "\163\x79\x6d\155\x65\164\x72\x69\x63";
                $this->cryptParams["\155\x65\164\x68\x6f\144"] = "\x68\x74\x74\x70\72\57\57\x77\x77\167\56\167\63\56\x6f\x72\147\x2f\x32\x30\60\61\x2f\x30\x34\x2f\170\x6d\x6c\x65\156\143\x23\141\x65\x73\61\71\62\x2d\x63\142\x63";
                $this->cryptParams["\x6b\x65\171\x73\x69\x7a\x65"] = 24;
                $this->cryptParams["\142\x6c\x6f\x63\x6b\163\x69\x7a\x65"] = 16;
                goto lB;
            case self::AES256_CBC:
                $this->cryptParams["\x6c\151\x62\162\x61\x72\171"] = "\x6f\160\145\156\163\x73\154";
                $this->cryptParams["\143\x69\x70\150\145\162"] = "\x61\x65\163\x2d\x32\x35\66\55\x63\x62\x63";
                $this->cryptParams["\164\171\160\x65"] = "\x73\x79\x6d\155\145\164\162\151\143";
                $this->cryptParams["\155\x65\164\150\x6f\x64"] = "\x68\164\x74\x70\x3a\57\57\x77\167\167\56\x77\63\x2e\x6f\x72\x67\57\x32\60\60\61\x2f\x30\x34\57\x78\155\x6c\145\156\143\x23\x61\145\163\62\x35\x36\x2d\x63\x62\x63";
                $this->cryptParams["\153\145\171\x73\151\x7a\145"] = 32;
                $this->cryptParams["\x62\154\157\143\153\x73\151\172\145"] = 16;
                goto lB;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\151\x62\x72\141\162\171"] = "\157\x70\x65\x6e\x73\x73\x6c";
                $this->cryptParams["\160\141\x64\144\x69\x6e\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\155\x65\164\150\157\144"] = "\x68\x74\x74\x70\x3a\57\x2f\167\x77\167\56\x77\x33\56\157\x72\147\57\x32\60\x30\x31\x2f\x30\x34\57\170\x6d\x6c\145\x6e\x63\x23\x72\x73\x61\55\x31\x5f\x35";
                if (!(is_array($Ak) && !empty($Ak["\x74\x79\x70\x65"]))) {
                    goto G6;
                }
                if (!($Ak["\164\171\x70\x65"] == "\160\165\142\154\151\x63" || $Ak["\164\x79\x70\x65"] == "\x70\x72\x69\x76\141\164\145")) {
                    goto Bf;
                }
                $this->cryptParams["\164\171\160\x65"] = $Ak["\x74\x79\160\145"];
                goto lB;
                Bf:
                G6:
                throw new Exception("\103\x65\x72\164\x69\x66\x69\x63\x61\164\145\40\x22\164\171\x70\x65\42\x20\50\160\x72\151\166\x61\164\x65\57\x70\165\142\x6c\x69\x63\x29\x20\155\x75\x73\164\x20\x62\145\x20\160\141\163\163\x65\x64\x20\166\151\x61\40\160\141\162\x61\155\145\x74\x65\162\163");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\x6c\151\x62\x72\141\x72\x79"] = "\157\x70\145\156\163\163\154";
                $this->cryptParams["\x70\x61\x64\x64\151\x6e\147"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\155\145\164\x68\x6f\144"] = "\150\164\164\x70\x3a\x2f\57\x77\167\167\x2e\x77\x33\x2e\157\162\x67\57\x32\x30\x30\61\57\60\x34\x2f\x78\x6d\154\x65\156\143\x23\162\x73\x61\x2d\x6f\141\145\160\x2d\155\147\146\x31\160";
                $this->cryptParams["\150\x61\163\x68"] = null;
                if (!(is_array($Ak) && !empty($Ak["\x74\x79\160\145"]))) {
                    goto L7;
                }
                if (!($Ak["\164\171\160\145"] == "\x70\x75\x62\154\x69\x63" || $Ak["\164\171\160\145"] == "\160\162\x69\x76\141\164\x65")) {
                    goto Vc;
                }
                $this->cryptParams["\x74\x79\x70\145"] = $Ak["\164\171\x70\x65"];
                goto lB;
                Vc:
                L7:
                throw new Exception("\103\145\x72\x74\x69\146\x69\x63\x61\x74\x65\40\x22\164\171\x70\x65\42\40\x28\160\x72\x69\166\141\164\145\57\x70\165\142\154\x69\x63\x29\40\155\x75\x73\x74\40\x62\145\40\160\141\163\163\145\144\x20\166\x69\x61\40\160\x61\x72\141\155\145\164\x65\162\163");
            case self::RSA_SHA1:
                $this->cryptParams["\154\x69\x62\x72\141\x72\x79"] = "\x6f\160\145\156\163\x73\x6c";
                $this->cryptParams["\x6d\145\x74\x68\x6f\144"] = "\150\164\164\160\72\x2f\x2f\167\x77\167\x2e\167\x33\56\157\x72\x67\57\62\x30\60\60\57\x30\71\57\x78\x6d\x6c\144\163\151\x67\x23\x72\x73\x61\55\x73\x68\141\x31";
                $this->cryptParams["\x70\x61\x64\x64\151\x6e\147"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($Ak) && !empty($Ak["\x74\x79\x70\145"]))) {
                    goto jJ;
                }
                if (!($Ak["\164\171\160\x65"] == "\x70\165\x62\x6c\151\x63" || $Ak["\x74\x79\x70\x65"] == "\x70\x72\151\x76\141\x74\145")) {
                    goto yK;
                }
                $this->cryptParams["\x74\171\x70\145"] = $Ak["\x74\x79\x70\x65"];
                goto lB;
                yK:
                jJ:
                throw new Exception("\103\145\x72\x74\x69\x66\151\x63\141\x74\145\x20\x22\164\171\160\x65\42\x20\x28\x70\162\x69\166\141\x74\145\57\160\x75\x62\x6c\x69\x63\x29\x20\x6d\x75\x73\164\40\x62\x65\40\x70\x61\163\x73\145\x64\x20\x76\x69\x61\40\x70\x61\162\141\x6d\x65\x74\x65\162\x73");
            case self::RSA_SHA256:
                $this->cryptParams["\x6c\x69\142\162\x61\162\x79"] = "\x6f\x70\145\x6e\163\163\x6c";
                $this->cryptParams["\x6d\145\164\x68\x6f\x64"] = "\150\164\164\160\72\57\x2f\x77\x77\x77\56\x77\x33\x2e\157\x72\x67\57\62\x30\x30\x31\57\x30\64\x2f\170\x6d\x6c\x64\163\151\147\55\155\157\162\145\43\x72\163\141\55\x73\x68\141\x32\x35\66";
                $this->cryptParams["\160\141\x64\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\147\x65\163\x74"] = "\123\110\x41\62\65\66";
                if (!(is_array($Ak) && !empty($Ak["\164\171\160\x65"]))) {
                    goto vD;
                }
                if (!($Ak["\x74\x79\160\145"] == "\160\165\142\x6c\151\x63" || $Ak["\x74\171\x70\x65"] == "\160\x72\151\166\x61\x74\145")) {
                    goto Dq;
                }
                $this->cryptParams["\164\x79\x70\145"] = $Ak["\164\171\x70\x65"];
                goto lB;
                Dq:
                vD:
                throw new Exception("\x43\145\x72\x74\151\146\x69\143\x61\164\145\x20\42\164\x79\160\145\x22\x20\50\160\162\151\x76\141\x74\x65\x2f\x70\165\142\154\151\143\x29\40\x6d\165\x73\x74\40\142\145\40\160\x61\x73\x73\145\x64\40\x76\x69\x61\x20\x70\x61\x72\x61\x6d\145\x74\x65\x72\163");
            case self::RSA_SHA384:
                $this->cryptParams["\x6c\151\x62\162\x61\x72\171"] = "\x6f\x70\x65\x6e\x73\163\154";
                $this->cryptParams["\155\145\164\x68\157\x64"] = "\x68\164\164\x70\x3a\57\57\167\167\x77\x2e\x77\63\x2e\x6f\x72\x67\57\x32\x30\60\61\57\x30\x34\x2f\x78\155\154\144\x73\151\x67\55\155\x6f\162\x65\x23\x72\x73\141\x2d\x73\150\x61\x33\70\x34";
                $this->cryptParams["\x70\x61\x64\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\x67\145\163\164"] = "\x53\110\x41\x33\x38\x34";
                if (!(is_array($Ak) && !empty($Ak["\x74\171\160\x65"]))) {
                    goto is;
                }
                if (!($Ak["\x74\x79\x70\x65"] == "\x70\165\142\154\x69\x63" || $Ak["\164\x79\160\x65"] == "\160\162\151\166\141\164\145")) {
                    goto M7;
                }
                $this->cryptParams["\x74\x79\x70\x65"] = $Ak["\164\x79\x70\145"];
                goto lB;
                M7:
                is:
                throw new Exception("\x43\x65\162\164\151\x66\151\143\x61\x74\145\x20\42\164\171\x70\x65\42\40\x28\160\162\151\x76\x61\164\145\x2f\160\x75\142\154\151\143\51\40\x6d\165\x73\x74\40\142\x65\x20\160\141\163\x73\145\144\x20\166\151\x61\x20\x70\141\x72\x61\155\145\164\x65\162\163");
            case self::RSA_SHA512:
                $this->cryptParams["\x6c\151\x62\x72\141\x72\x79"] = "\157\160\x65\156\x73\x73\x6c";
                $this->cryptParams["\x6d\x65\x74\150\157\144"] = "\x68\x74\x74\160\x3a\x2f\57\x77\x77\167\x2e\x77\x33\x2e\x6f\162\147\57\x32\60\60\61\57\x30\64\x2f\x78\155\x6c\x64\163\151\x67\x2d\x6d\157\162\145\x23\162\x73\x61\55\163\x68\141\65\61\x32";
                $this->cryptParams["\x70\141\144\144\151\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\x69\147\145\163\164"] = "\123\110\101\65\x31\62";
                if (!(is_array($Ak) && !empty($Ak["\x74\171\160\145"]))) {
                    goto gu;
                }
                if (!($Ak["\164\171\160\x65"] == "\x70\x75\x62\x6c\151\x63" || $Ak["\164\x79\x70\145"] == "\x70\162\151\x76\x61\x74\145")) {
                    goto Zn;
                }
                $this->cryptParams["\x74\171\x70\x65"] = $Ak["\164\171\x70\x65"];
                goto lB;
                Zn:
                gu:
                throw new Exception("\103\x65\162\x74\151\146\151\143\x61\x74\145\40\x22\x74\x79\160\145\x22\40\x28\160\x72\151\166\141\164\145\57\x70\x75\x62\x6c\151\143\51\40\155\165\x73\164\x20\142\145\40\160\141\x73\163\145\144\40\x76\151\141\x20\x70\x61\162\x61\x6d\145\164\145\x72\x73");
            case self::HMAC_SHA1:
                $this->cryptParams["\154\x69\x62\162\x61\x72\x79"] = $dE;
                $this->cryptParams["\x6d\x65\164\x68\x6f\144"] = "\x68\x74\x74\x70\72\57\57\167\x77\x77\56\x77\x33\x2e\157\x72\147\x2f\62\60\x30\x30\x2f\60\x39\57\x78\x6d\x6c\x64\x73\151\x67\43\150\x6d\x61\x63\x2d\163\150\141\x31";
                goto lB;
            default:
                throw new Exception("\x49\x6e\x76\x61\154\x69\144\40\x4b\145\171\40\x54\171\x70\x65");
        }
        wJ:
        lB:
        $this->type = $dE;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\x6b\145\171\163\151\x7a\x65"])) {
            goto RE;
        }
        return null;
        RE:
        return $this->cryptParams["\153\145\x79\163\151\172\145"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\153\145\171\163\151\x7a\x65"])) {
            goto tD;
        }
        throw new Exception("\125\x6e\x6b\x6e\157\x77\x6e\x20\153\145\171\40\163\151\x7a\x65\x20\146\157\162\40\x74\x79\x70\145\40\x22" . $this->type . "\42\x2e");
        tD:
        $jj = $this->cryptParams["\153\x65\x79\x73\151\172\145"];
        $l9 = openssl_random_pseudo_bytes($jj);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto vb;
        }
        $n5 = 0;
        sI:
        if (!($n5 < strlen($l9))) {
            goto nP;
        }
        $ZS = ord($l9[$n5]) & 254;
        $eq = 1;
        $Sa = 1;
        TM:
        if (!($Sa < 8)) {
            goto kr;
        }
        $eq ^= $ZS >> $Sa & 1;
        k4:
        $Sa++;
        goto TM;
        kr:
        $ZS |= $eq;
        $l9[$n5] = chr($ZS);
        p9:
        $n5++;
        goto sI;
        nP:
        vb:
        $this->key = $l9;
        return $l9;
    }
    public static function getRawThumbprint($XE)
    {
        $q4 = explode("\xa", $XE);
        $HC = '';
        $BC = false;
        foreach ($q4 as $q3) {
            if (!$BC) {
                goto kf;
            }
            if (!(strncmp($q3, "\x2d\x2d\x2d\55\x2d\x45\x4e\x44\x20\x43\105\x52\124\111\106\111\103\x41\124\x45", 20) == 0)) {
                goto xj;
            }
            goto L6;
            xj:
            $HC .= trim($q3);
            goto iK;
            kf:
            if (!(strncmp($q3, "\55\55\55\55\x2d\102\105\107\x49\116\40\103\105\x52\x54\111\106\x49\103\101\124\105", 22) == 0)) {
                goto h7;
            }
            $BC = true;
            h7:
            iK:
            YT:
        }
        L6:
        if (empty($HC)) {
            goto Eb;
        }
        return strtolower(sha1(base64_decode($HC)));
        Eb:
        return null;
    }
    public function loadKey($l9, $fD = false, $Ud = false)
    {
        if ($fD) {
            goto py;
        }
        $this->key = $l9;
        goto P0;
        py:
        $this->key = file_get_contents($l9);
        P0:
        if ($Ud) {
            goto RF;
        }
        $this->x509Certificate = null;
        goto kL;
        RF:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $Q7);
        $this->x509Certificate = $Q7;
        $this->key = $Q7;
        kL:
        if (!($this->cryptParams["\154\151\142\162\x61\162\171"] == "\x6f\x70\145\x6e\163\x73\x6c")) {
            goto PI;
        }
        switch ($this->cryptParams["\164\171\x70\x65"]) {
            case "\x70\165\x62\154\151\143":
                if (!$Ud) {
                    goto TK;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                TK:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto ia;
                }
                throw new Exception("\125\156\141\x62\154\x65\40\x74\x6f\40\x65\170\x74\x72\x61\x63\164\40\160\x75\x62\154\x69\x63\40\153\x65\171");
                ia:
                goto oR1;
            case "\160\162\x69\x76\141\x74\145":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto oR1;
            case "\x73\x79\x6d\155\145\x74\x72\151\x63":
                if (!(strlen($this->key) < $this->cryptParams["\153\x65\171\x73\151\x7a\145"])) {
                    goto o2;
                }
                throw new Exception("\x4b\x65\x79\x20\x6d\x75\163\x74\x20\143\157\x6e\164\141\x69\156\40\x61\x74\40\154\x65\x61\163\x74\40\62\65\x20\143\150\x61\x72\141\x63\164\145\162\x73\40\146\x6f\x72\40\164\x68\x69\x73\x20\x63\x69\160\150\x65\x72");
                o2:
                goto oR1;
            default:
                throw new Exception("\125\156\153\156\x6f\x77\156\x20\164\x79\160\x65");
        }
        yN:
        oR1:
        PI:
    }
    private function padISO10126($HC, $jN)
    {
        if (!($jN > 256)) {
            goto fM;
        }
        throw new Exception("\x42\154\157\x63\153\40\163\151\x7a\145\40\150\x69\x67\150\145\x72\x20\x74\x68\141\156\x20\x32\x35\x36\x20\x6e\157\164\x20\141\x6c\154\x6f\167\x65\x64");
        fM:
        $TX = $jN - strlen($HC) % $jN;
        $MC = chr($TX);
        return $HC . str_repeat($MC, $TX);
    }
    private function unpadISO10126($HC)
    {
        $TX = substr($HC, -1);
        $fn = ord($TX);
        return substr($HC, 0, -$fn);
    }
    private function encryptSymmetric($HC)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\x63\x69\x70\x68\x65\162"]));
        $HC = $this->padISO10126($HC, $this->cryptParams["\142\154\x6f\x63\x6b\163\151\x7a\x65"]);
        $Xp = openssl_encrypt($HC, $this->cryptParams["\143\x69\x70\150\x65\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $Xp)) {
            goto Uw;
        }
        throw new Exception("\106\141\151\x6c\165\x72\145\40\145\x6e\x63\162\171\160\x74\151\156\x67\x20\x44\141\164\141\x20\50\x6f\160\145\156\x73\x73\x6c\x20\163\171\x6d\x6d\x65\164\162\151\x63\x29\40\55\x20" . openssl_error_string());
        Uw:
        return $this->iv . $Xp;
    }
    private function decryptSymmetric($HC)
    {
        $YT = openssl_cipher_iv_length($this->cryptParams["\x63\x69\160\x68\145\162"]);
        $this->iv = substr($HC, 0, $YT);
        $HC = substr($HC, $YT);
        $hN = openssl_decrypt($HC, $this->cryptParams["\x63\x69\x70\150\x65\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $hN)) {
            goto bX;
        }
        throw new Exception("\x46\141\151\x6c\165\x72\x65\40\144\x65\x63\x72\x79\x70\x74\x69\156\147\40\x44\141\x74\x61\40\50\157\160\145\156\163\163\x6c\40\163\171\x6d\x6d\x65\x74\162\x69\x63\x29\x20\x2d\x20" . openssl_error_string());
        bX:
        return $this->unpadISO10126($hN);
    }
    private function encryptPublic($HC)
    {
        if (openssl_public_encrypt($HC, $Xp, $this->key, $this->cryptParams["\160\141\x64\x64\x69\156\x67"])) {
            goto PD;
        }
        throw new Exception("\106\x61\151\154\x75\x72\x65\x20\x65\156\x63\162\171\x70\164\151\156\x67\x20\104\x61\164\x61\x20\50\157\160\145\x6e\x73\x73\154\x20\160\x75\142\154\151\x63\x29\x20\x2d\40" . openssl_error_string());
        PD:
        return $Xp;
    }
    private function decryptPublic($HC)
    {
        if (openssl_public_decrypt($HC, $hN, $this->key, $this->cryptParams["\x70\x61\144\x64\151\156\x67"])) {
            goto Ai;
        }
        throw new Exception("\x46\141\151\x6c\x75\162\145\40\144\x65\x63\162\x79\160\x74\x69\x6e\x67\40\104\x61\x74\x61\x20\x28\x6f\160\145\156\x73\163\x6c\40\x70\x75\x62\x6c\151\x63\x29\x20\55\x20" . openssl_error_string);
        Ai:
        return $hN;
    }
    private function encryptPrivate($HC)
    {
        if (openssl_private_encrypt($HC, $Xp, $this->key, $this->cryptParams["\160\x61\144\x64\151\156\147"])) {
            goto Ml;
        }
        throw new Exception("\106\x61\151\154\165\162\x65\x20\x65\x6e\143\x72\171\x70\164\x69\156\147\x20\104\141\x74\x61\x20\50\x6f\160\145\x6e\163\163\x6c\x20\x70\x72\x69\166\x61\164\145\51\x20\x2d\40" . openssl_error_string());
        Ml:
        return $Xp;
    }
    private function decryptPrivate($HC)
    {
        if (openssl_private_decrypt($HC, $hN, $this->key, $this->cryptParams["\160\141\144\x64\x69\156\x67"])) {
            goto xm;
        }
        throw new Exception("\106\x61\151\154\x75\162\x65\40\144\x65\x63\162\x79\160\x74\151\156\147\x20\x44\x61\164\141\40\x28\157\160\x65\x6e\x73\x73\x6c\x20\160\162\151\x76\141\x74\x65\51\x20\55\x20" . openssl_error_string);
        xm:
        return $hN;
    }
    private function signOpenSSL($HC)
    {
        $vy = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\x69\147\145\163\x74"])) {
            goto J3;
        }
        $vy = $this->cryptParams["\x64\151\147\x65\163\x74"];
        J3:
        if (openssl_sign($HC, $J8, $this->key, $vy)) {
            goto yF;
        }
        throw new Exception("\x46\141\151\154\165\x72\145\x20\x53\151\147\x6e\x69\156\x67\40\104\141\164\x61\x3a\x20" . openssl_error_string() . "\x20\x2d\x20" . $vy);
        yF:
        return $J8;
    }
    private function verifyOpenSSL($HC, $J8)
    {
        $vy = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\x69\x67\x65\163\164"])) {
            goto YZ;
        }
        $vy = $this->cryptParams["\x64\x69\147\145\163\164"];
        YZ:
        return openssl_verify($HC, $J8, $this->key, $vy);
    }
    public function encryptData($HC)
    {
        if (!($this->cryptParams["\x6c\151\142\162\x61\x72\x79"] === "\x6f\160\145\x6e\163\163\x6c")) {
            goto kP;
        }
        switch ($this->cryptParams["\x74\x79\160\145"]) {
            case "\x73\171\155\155\x65\x74\x72\151\x63":
                return $this->encryptSymmetric($HC);
            case "\x70\165\142\154\x69\143":
                return $this->encryptPublic($HC);
            case "\x70\x72\151\x76\x61\164\x65":
                return $this->encryptPrivate($HC);
        }
        xE:
        mf:
        kP:
    }
    public function decryptData($HC)
    {
        if (!($this->cryptParams["\x6c\x69\x62\162\x61\162\171"] === "\157\160\145\156\x73\163\154")) {
            goto D_;
        }
        switch ($this->cryptParams["\164\x79\160\145"]) {
            case "\x73\171\155\155\145\164\162\x69\x63":
                return $this->decryptSymmetric($HC);
            case "\x70\165\x62\154\151\x63":
                return $this->decryptPublic($HC);
            case "\x70\162\x69\x76\141\164\x65":
                return $this->decryptPrivate($HC);
        }
        AL:
        zh:
        D_:
    }
    public function signData($HC)
    {
        switch ($this->cryptParams["\154\151\x62\162\141\x72\x79"]) {
            case "\157\x70\x65\156\163\x73\x6c":
                return $this->signOpenSSL($HC);
            case self::HMAC_SHA1:
                return hash_hmac("\163\x68\141\x31", $HC, $this->key, true);
        }
        wU:
        k8:
    }
    public function verifySignature($HC, $J8)
    {
        switch ($this->cryptParams["\x6c\x69\142\x72\x61\162\171"]) {
            case "\157\160\145\156\163\x73\154":
                return $this->verifyOpenSSL($HC, $J8);
            case self::HMAC_SHA1:
                $R6 = hash_hmac("\163\150\141\x31", $HC, $this->key, true);
                return strcmp($J8, $R6) == 0;
        }
        jj:
        ua:
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\155\x65\x74\x68\157\144"];
    }
    public static function makeAsnSegment($dE, $gZ)
    {
        switch ($dE) {
            case 2:
                if (!(ord($gZ) > 127)) {
                    goto QK;
                }
                $gZ = chr(0) . $gZ;
                QK:
                goto E2;
            case 3:
                $gZ = chr(0) . $gZ;
                goto E2;
        }
        a2:
        E2:
        $M0 = strlen($gZ);
        if ($M0 < 128) {
            goto wz;
        }
        if ($M0 < 256) {
            goto Mn;
        }
        if ($M0 < 65536) {
            goto zD;
        }
        $XF = null;
        goto cq;
        zD:
        $XF = sprintf("\x25\x63\45\143\45\143\45\143\x25\x73", $dE, 130, $M0 / 256, $M0 % 256, $gZ);
        cq:
        goto bN;
        Mn:
        $XF = sprintf("\45\x63\45\143\x25\x63\45\163", $dE, 129, $M0, $gZ);
        bN:
        goto Xk;
        wz:
        $XF = sprintf("\45\143\45\x63\x25\163", $dE, $M0, $gZ);
        Xk:
        return $XF;
    }
    public static function convertRSA($Tc, $Zc)
    {
        $Hg = self::makeAsnSegment(2, $Zc);
        $cm = self::makeAsnSegment(2, $Tc);
        $e9 = self::makeAsnSegment(48, $cm . $Hg);
        $NL = self::makeAsnSegment(3, $e9);
        $X6 = pack("\110\52", "\63\60\x30\104\x30\66\60\x39\x32\x41\70\66\64\70\x38\66\x46\67\x30\x44\60\x31\x30\61\x30\x31\60\x35\x30\x30");
        $hy = self::makeAsnSegment(48, $X6 . $NL);
        $NA = base64_encode($hy);
        $mn = "\x2d\55\x2d\x2d\x2d\x42\x45\x47\111\x4e\40\x50\125\102\x4c\x49\103\40\x4b\x45\131\x2d\55\x2d\x2d\55\12";
        $Yr = 0;
        dX:
        if (!($JB = substr($NA, $Yr, 64))) {
            goto dr;
        }
        $mn = $mn . $JB . "\xa";
        $Yr += 64;
        goto dX;
        dr:
        return $mn . "\x2d\x2d\55\x2d\x2d\x45\x4e\104\x20\x50\x55\x42\x4c\111\x43\x20\113\x45\131\x2d\55\x2d\55\55\xa";
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $xK)
    {
        $SV = new XMLSecEnc();
        $SV->setNode($xK);
        if ($EJ = $SV->locateKey()) {
            goto Vu;
        }
        throw new Exception("\125\156\x61\142\154\145\x20\164\157\40\x6c\x6f\x63\x61\x74\x65\40\x61\154\147\157\x72\151\x74\150\x6d\40\146\x6f\162\x20\164\x68\151\x73\x20\x45\x6e\x63\x72\171\160\x74\145\144\x20\x4b\x65\x79");
        Vu:
        $EJ->isEncrypted = true;
        $EJ->encryptedCtx = $SV;
        XMLSecEnc::staticLocateKeyInfo($EJ, $xK);
        return $EJ;
    }
}
class XMLSecurityDSig
{
    const XMLDSIGNS = "\150\x74\164\x70\72\x2f\x2f\167\167\x77\56\x77\63\x2e\x6f\x72\x67\x2f\62\x30\60\x30\57\x30\x39\x2f\x78\x6d\154\144\163\151\x67\43";
    const SHA1 = "\x68\164\x74\x70\x3a\x2f\57\167\167\167\56\x77\x33\56\157\162\147\x2f\x32\x30\60\60\x2f\60\71\57\x78\155\x6c\x64\x73\151\147\x23\163\150\x61\61";
    const SHA256 = "\150\164\164\160\72\57\x2f\x77\x77\167\56\167\63\56\x6f\x72\147\57\x32\x30\60\61\x2f\x30\64\x2f\170\155\154\x65\156\143\43\x73\150\141\62\65\66";
    const SHA384 = "\150\164\x74\x70\72\x2f\57\167\167\167\56\167\63\56\157\162\147\x2f\x32\60\x30\x31\57\x30\x34\x2f\170\155\154\144\x73\151\x67\55\x6d\157\x72\145\43\163\x68\141\63\70\64";
    const SHA512 = "\x68\164\164\160\x3a\57\57\x77\x77\x77\x2e\167\63\x2e\157\x72\147\57\62\x30\x30\x31\57\x30\x34\x2f\170\155\x6c\145\x6e\x63\x23\x73\x68\141\x35\x31\x32";
    const RIPEMD160 = "\150\164\164\160\x3a\x2f\57\167\167\167\56\x77\63\56\157\x72\147\x2f\x32\60\x30\x31\x2f\x30\x34\57\170\x6d\154\145\x6e\x63\43\x72\151\160\145\x6d\144\61\66\x30";
    const C14N = "\150\164\x74\x70\72\57\x2f\x77\167\x77\56\x77\x33\x2e\x6f\x72\x67\x2f\124\x52\x2f\x32\60\x30\61\x2f\x52\105\x43\x2d\170\155\x6c\55\x63\x31\64\156\55\x32\x30\60\61\x30\x33\x31\x35";
    const C14N_COMMENTS = "\x68\164\164\x70\x3a\57\57\167\x77\167\56\x77\63\x2e\157\x72\x67\57\124\122\57\62\60\60\61\x2f\122\x45\x43\55\x78\x6d\154\x2d\143\61\64\x6e\x2d\x32\x30\x30\61\60\63\x31\65\x23\x57\151\164\x68\x43\x6f\155\155\145\156\164\x73";
    const EXC_C14N = "\150\x74\x74\x70\x3a\x2f\x2f\167\167\x77\x2e\167\63\56\157\x72\147\x2f\x32\60\60\x31\x2f\61\60\x2f\170\155\x6c\x2d\145\x78\143\x2d\x63\x31\x34\x6e\43";
    const EXC_C14N_COMMENTS = "\x68\x74\x74\160\72\x2f\57\x77\x77\167\x2e\167\x33\56\x6f\x72\x67\57\62\x30\60\61\57\x31\x30\57\170\155\154\55\x65\170\x63\x2d\x63\x31\64\156\x23\x57\151\164\150\x43\157\x6d\x6d\x65\156\164\x73";
    const template = "\x3c\144\x73\x3a\123\151\x67\x6e\141\164\165\x72\x65\40\x78\x6d\154\156\163\72\x64\x73\75\x22\150\164\164\160\x3a\x2f\x2f\167\x77\x77\x2e\167\x33\x2e\x6f\162\x67\x2f\62\60\x30\x30\57\60\71\x2f\x78\x6d\x6c\x64\x73\151\147\x23\x22\76\15\12\40\x20\74\144\x73\72\123\x69\147\156\x65\x64\111\156\x66\157\76\xd\12\40\40\40\x20\x3c\x64\163\x3a\123\151\x67\156\141\x74\x75\x72\x65\x4d\x65\164\x68\x6f\x64\40\57\76\xd\xa\x20\40\x3c\x2f\x64\163\72\123\x69\147\156\145\144\111\x6e\146\x6f\x3e\15\12\74\57\144\x73\72\123\x69\147\x6e\141\164\x75\x72\145\x3e";
    const BASE_TEMPLATE = "\74\x53\151\147\x6e\x61\x74\x75\162\145\x20\170\x6d\154\x6e\x73\75\42\150\x74\x74\160\x3a\57\x2f\167\x77\167\x2e\167\x33\x2e\157\162\x67\57\62\60\60\x30\57\60\71\57\x78\x6d\x6c\144\163\151\147\43\x22\76\15\12\x20\x20\x3c\123\x69\147\156\x65\144\111\x6e\x66\x6f\x3e\15\12\40\x20\40\x20\74\123\x69\x67\x6e\141\164\165\x72\145\115\x65\164\150\x6f\x64\x20\x2f\76\15\12\x20\40\74\x2f\123\151\147\156\145\x64\x49\x6e\x66\x6f\x3e\15\xa\x3c\57\x53\151\147\x6e\141\164\165\x72\145\76";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\163\x65\143\x64\163\151\x67";
    private $validatedNodes = null;
    public function __construct($wz = "\144\163")
    {
        $YU = self::BASE_TEMPLATE;
        if (empty($wz)) {
            goto C3;
        }
        $this->prefix = $wz . "\72";
        $Jn = array("\x3c\123", "\74\57\123", "\170\x6d\154\156\163\x3d");
        $oH = array("\x3c{$wz}\72\123", "\x3c\x2f{$wz}\72\x53", "\x78\155\154\x6e\163\72{$wz}\75");
        $YU = str_replace($Jn, $oH, $YU);
        C3:
        $rj = new DOMDocument();
        $rj->loadXML($YU);
        $this->sigNode = $rj->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto mD;
        }
        $H1 = new DOMXPath($this->sigNode->ownerDocument);
        $H1->registerNamespace("\163\x65\143\144\x73\151\147", self::XMLDSIGNS);
        $this->xPathCtx = $H1;
        mD:
        return $this->xPathCtx;
    }
    public static function generateGUID($wz = "\160\x66\x78")
    {
        $T3 = md5(uniqid(mt_rand(), true));
        $hI = $wz . substr($T3, 0, 8) . "\55" . substr($T3, 8, 4) . "\55" . substr($T3, 12, 4) . "\55" . substr($T3, 16, 4) . "\x2d" . substr($T3, 20, 12);
        return $hI;
    }
    public static function generate_GUID($wz = "\160\146\x78")
    {
        return self::generateGUID($wz);
    }
    public function locateSignature($i5, $ng = 0)
    {
        if ($i5 instanceof DOMDocument) {
            goto qV;
        }
        $t0 = $i5->ownerDocument;
        goto Mv;
        qV:
        $t0 = $i5;
        Mv:
        if (!$t0) {
            goto ph;
        }
        $H1 = new DOMXPath($t0);
        $H1->registerNamespace("\163\x65\143\144\163\x69\147", self::XMLDSIGNS);
        $hO = "\x2e\x2f\57\163\x65\143\x64\x73\151\147\72\123\x69\x67\156\141\x74\165\x72\145";
        $QP = $H1->query($hO, $i5);
        $this->sigNode = $QP->item($ng);
        return $this->sigNode;
        ph:
        return null;
    }
    public function createNewSignNode($cg, $qO = null)
    {
        $t0 = $this->sigNode->ownerDocument;
        if (!is_null($qO)) {
            goto LH;
        }
        $SP = $t0->createElementNS(self::XMLDSIGNS, $this->prefix . $cg);
        goto mx;
        LH:
        $SP = $t0->createElementNS(self::XMLDSIGNS, $this->prefix . $cg, $qO);
        mx:
        return $SP;
    }
    public function setCanonicalMethod($TI)
    {
        switch ($TI) {
            case "\150\164\164\160\x3a\x2f\57\x77\x77\x77\56\x77\63\56\x6f\x72\x67\57\124\x52\57\x32\x30\x30\61\x2f\122\x45\103\55\x78\155\154\55\143\61\x34\156\55\62\60\x30\61\60\x33\x31\65":
            case "\150\164\x74\160\72\57\x2f\167\167\167\56\167\x33\56\x6f\162\x67\57\124\122\57\x32\x30\60\x31\x2f\122\x45\103\55\170\x6d\154\55\143\61\x34\156\x2d\x32\60\60\x31\60\x33\x31\x35\x23\127\151\164\x68\103\157\155\x6d\145\x6e\164\x73":
            case "\150\x74\x74\x70\x3a\x2f\57\167\x77\x77\x2e\x77\63\x2e\157\162\x67\57\62\x30\60\61\57\x31\60\x2f\170\x6d\x6c\x2d\145\x78\143\x2d\143\x31\x34\156\x23":
            case "\150\164\x74\x70\72\57\57\167\167\167\56\167\63\x2e\x6f\x72\x67\57\62\60\60\x31\x2f\61\x30\x2f\x78\x6d\154\55\x65\170\143\55\143\x31\64\x6e\43\x57\151\164\150\103\x6f\x6d\155\145\156\x74\x73":
                $this->canonicalMethod = $TI;
                goto eb;
            default:
                throw new Exception("\x49\156\166\141\154\x69\x64\40\103\x61\156\157\x6e\x69\143\x61\x6c\40\x4d\x65\x74\x68\x6f\144");
        }
        fW:
        eb:
        if (!($H1 = $this->getXPathObj())) {
            goto J8;
        }
        $hO = "\x2e\x2f" . $this->searchpfx . "\72\123\151\x67\x6e\145\144\x49\156\146\157";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($AZ = $QP->item(0))) {
            goto ya;
        }
        $hO = "\56\57" . $this->searchpfx . "\x43\141\156\x6f\156\x69\x63\x61\x6c\151\172\141\x74\x69\x6f\x6e\x4d\145\164\x68\157\x64";
        $QP = $H1->query($hO, $AZ);
        if ($df = $QP->item(0)) {
            goto E1;
        }
        $df = $this->createNewSignNode("\x43\141\x6e\157\156\151\x63\141\x6c\x69\172\x61\x74\x69\x6f\156\x4d\x65\x74\x68\x6f\144");
        $AZ->insertBefore($df, $AZ->firstChild);
        E1:
        $df->setAttribute("\101\154\147\157\162\x69\164\150\x6d", $this->canonicalMethod);
        ya:
        J8:
    }
    private function canonicalizeData($SP, $vZ, $mK = null, $J5 = null)
    {
        $IY = false;
        $Ya = false;
        switch ($vZ) {
            case "\150\164\x74\160\72\57\x2f\167\167\x77\56\167\63\x2e\157\162\147\57\x54\x52\57\x32\60\60\x31\57\x52\x45\x43\x2d\x78\155\154\x2d\x63\61\x34\x6e\x2d\x32\x30\x30\x31\60\63\x31\x35":
                $IY = false;
                $Ya = false;
                goto RU;
            case "\x68\x74\164\x70\x3a\x2f\x2f\x77\167\x77\x2e\167\63\x2e\x6f\162\147\x2f\x54\122\x2f\x32\x30\x30\61\x2f\122\105\x43\55\x78\x6d\154\x2d\x63\61\64\x6e\x2d\62\60\60\61\60\x33\x31\65\x23\127\x69\x74\x68\103\157\x6d\155\x65\x6e\164\x73":
                $Ya = true;
                goto RU;
            case "\150\x74\x74\x70\x3a\x2f\57\x77\x77\167\56\x77\63\x2e\157\x72\x67\x2f\62\x30\60\x31\x2f\61\x30\57\170\x6d\x6c\55\145\x78\x63\x2d\143\61\64\156\x23":
                $IY = true;
                goto RU;
            case "\150\164\164\x70\x3a\x2f\57\x77\167\167\56\x77\x33\x2e\157\x72\147\x2f\62\60\60\61\x2f\x31\x30\57\x78\155\x6c\x2d\x65\170\x63\x2d\x63\x31\64\156\43\127\x69\164\x68\103\157\155\155\145\156\164\163":
                $IY = true;
                $Ya = true;
                goto RU;
        }
        Nz:
        RU:
        if (!(is_null($mK) && $SP instanceof DOMNode && $SP->ownerDocument !== null && $SP->isSameNode($SP->ownerDocument->documentElement))) {
            goto Th;
        }
        $xK = $SP;
        QS:
        if (!($md = $xK->previousSibling)) {
            goto kO;
        }
        if (!($md->nodeType == XML_PI_NODE || $md->nodeType == XML_COMMENT_NODE && $Ya)) {
            goto jw;
        }
        goto kO;
        jw:
        $xK = $md;
        goto QS;
        kO:
        if (!($md == null)) {
            goto kT;
        }
        $SP = $SP->ownerDocument;
        kT:
        Th:
        return $SP->C14N($IY, $Ya, $mK, $J5);
    }
    public function canonicalizeSignedInfo()
    {
        $t0 = $this->sigNode->ownerDocument;
        $vZ = null;
        if (!$t0) {
            goto bZ;
        }
        $H1 = $this->getXPathObj();
        $hO = "\56\57\163\x65\143\144\163\x69\x67\x3a\x53\151\147\x6e\145\144\111\x6e\146\157";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($yV = $QP->item(0))) {
            goto x8;
        }
        $hO = "\56\x2f\x73\x65\x63\x64\163\151\x67\72\103\x61\x6e\157\x6e\151\143\x61\154\x69\x7a\x61\164\151\x6f\x6e\x4d\145\164\150\x6f\x64";
        $QP = $H1->query($hO, $yV);
        if (!($df = $QP->item(0))) {
            goto Ep;
        }
        $vZ = $df->getAttribute("\x41\154\147\157\x72\x69\x74\x68\x6d");
        Ep:
        $this->signedInfo = $this->canonicalizeData($yV, $vZ);
        return $this->signedInfo;
        x8:
        bZ:
        return null;
    }
    public function calculateDigest($S3, $HC, $yt = true)
    {
        switch ($S3) {
            case self::SHA1:
                $py = "\163\x68\141\x31";
                goto ms;
            case self::SHA256:
                $py = "\163\x68\x61\62\65\x36";
                goto ms;
            case self::SHA384:
                $py = "\x73\x68\x61\x33\70\64";
                goto ms;
            case self::SHA512:
                $py = "\163\150\x61\65\x31\62";
                goto ms;
            case self::RIPEMD160:
                $py = "\x72\x69\x70\x65\x6d\144\61\x36\60";
                goto ms;
            default:
                throw new Exception("\103\x61\156\x6e\x6f\x74\40\166\141\154\x69\144\141\x74\145\x20\144\151\147\x65\163\x74\x3a\40\x55\156\163\x75\x70\x70\157\x72\x74\x65\x64\x20\101\x6c\147\x6f\x72\x69\164\x68\155\40\74{$S3}\x3e");
        }
        rK:
        ms:
        $UR = hash($py, $HC, true);
        if (!$yt) {
            goto X5;
        }
        $UR = base64_encode($UR);
        X5:
        return $UR;
    }
    public function validateDigest($sb, $HC)
    {
        $H1 = new DOMXPath($sb->ownerDocument);
        $H1->registerNamespace("\163\x65\143\x64\163\151\x67", self::XMLDSIGNS);
        $hO = "\163\164\162\151\156\x67\50\56\x2f\163\x65\x63\x64\163\x69\x67\x3a\104\x69\x67\x65\163\x74\x4d\x65\x74\x68\157\x64\x2f\100\101\x6c\x67\x6f\162\151\x74\x68\155\x29";
        $S3 = $H1->evaluate($hO, $sb);
        $Cy = $this->calculateDigest($S3, $HC, false);
        $hO = "\x73\164\x72\151\156\147\50\56\57\x73\x65\143\144\x73\x69\x67\72\x44\x69\147\x65\x73\164\126\x61\x6c\165\x65\51";
        $W1 = $H1->evaluate($hO, $sb);
        return $Cy == base64_decode($W1);
    }
    public function processTransforms($sb, $LO, $EE = true)
    {
        $HC = $LO;
        $H1 = new DOMXPath($sb->ownerDocument);
        $H1->registerNamespace("\163\145\143\x64\163\151\x67", self::XMLDSIGNS);
        $hO = "\56\x2f\x73\x65\x63\144\x73\x69\147\72\x54\x72\x61\x6e\163\x66\x6f\162\x6d\163\x2f\x73\x65\143\x64\x73\151\147\x3a\124\x72\141\x6e\x73\146\157\162\155";
        $hL = $H1->query($hO, $sb);
        $OW = "\x68\x74\164\x70\x3a\57\x2f\x77\167\167\56\167\63\x2e\157\162\147\57\x54\x52\x2f\x32\x30\x30\x31\57\122\105\x43\55\x78\155\x6c\55\143\x31\x34\156\x2d\62\60\60\61\x30\x33\61\65";
        $mK = null;
        $J5 = null;
        foreach ($hL as $Mx) {
            $TT = $Mx->getAttribute("\x41\154\147\x6f\162\x69\x74\150\155");
            switch ($TT) {
                case "\x68\x74\x74\x70\72\57\57\167\x77\167\x2e\167\63\x2e\157\162\147\x2f\62\60\60\x31\x2f\x31\60\57\x78\155\x6c\55\145\170\143\x2d\x63\x31\64\x6e\43":
                case "\x68\x74\164\160\x3a\x2f\x2f\x77\167\x77\x2e\x77\63\56\x6f\x72\147\57\62\x30\60\61\57\x31\x30\x2f\x78\x6d\x6c\55\145\x78\x63\55\x63\x31\x34\x6e\x23\127\151\164\150\x43\157\x6d\x6d\145\156\164\x73":
                    if (!$EE) {
                        goto yA;
                    }
                    $OW = $TT;
                    goto F6;
                    yA:
                    $OW = "\x68\164\164\x70\72\57\x2f\167\167\167\x2e\167\x33\56\x6f\162\x67\x2f\x32\60\60\x31\57\61\x30\x2f\170\155\x6c\55\x65\170\x63\x2d\143\x31\64\156\43";
                    F6:
                    $SP = $Mx->firstChild;
                    Jz:
                    if (!$SP) {
                        goto aA;
                    }
                    if (!($SP->localName == "\x49\156\143\154\x75\163\151\x76\145\x4e\141\x6d\145\x73\160\141\143\x65\x73")) {
                        goto vk;
                    }
                    if (!($oe = $SP->getAttribute("\120\162\145\146\x69\x78\114\151\163\164"))) {
                        goto K2;
                    }
                    $Ov = array();
                    $fm = explode("\x20", $oe);
                    foreach ($fm as $oe) {
                        $Bb = trim($oe);
                        if (empty($Bb)) {
                            goto VW;
                        }
                        $Ov[] = $Bb;
                        VW:
                        ar:
                    }
                    V7:
                    if (!(count($Ov) > 0)) {
                        goto wG;
                    }
                    $J5 = $Ov;
                    wG:
                    K2:
                    goto aA;
                    vk:
                    $SP = $SP->nextSibling;
                    goto Jz;
                    aA:
                    goto Ew;
                case "\x68\164\x74\160\x3a\57\x2f\167\x77\x77\x2e\167\63\56\x6f\x72\147\x2f\x54\x52\57\x32\60\60\61\x2f\122\105\x43\x2d\170\x6d\x6c\55\x63\x31\64\x6e\x2d\62\60\x30\x31\60\x33\61\65":
                case "\x68\x74\x74\x70\x3a\57\57\167\x77\x77\56\167\63\56\x6f\x72\x67\57\x54\122\x2f\x32\60\x30\61\x2f\122\x45\103\x2d\170\x6d\154\55\x63\61\64\156\x2d\62\60\x30\61\60\63\61\x35\43\127\x69\x74\x68\103\x6f\x6d\155\x65\156\x74\x73":
                    if (!$EE) {
                        goto wB;
                    }
                    $OW = $TT;
                    goto fy;
                    wB:
                    $OW = "\x68\164\x74\160\72\x2f\x2f\167\167\x77\x2e\x77\63\x2e\x6f\162\147\x2f\124\122\57\62\60\x30\x31\x2f\x52\105\x43\x2d\x78\x6d\154\55\143\61\64\x6e\x2d\x32\60\60\x31\60\63\x31\x35";
                    fy:
                    goto Ew;
                case "\x68\x74\x74\x70\x3a\57\x2f\167\167\167\56\x77\63\x2e\157\162\x67\57\124\122\x2f\x31\71\x39\71\57\x52\x45\x43\55\x78\x70\141\x74\150\55\x31\x39\71\x39\61\x31\x31\x36":
                    $SP = $Mx->firstChild;
                    D0:
                    if (!$SP) {
                        goto e8;
                    }
                    if (!($SP->localName == "\130\x50\x61\164\x68")) {
                        goto Lv;
                    }
                    $mK = array();
                    $mK["\x71\x75\145\x72\171"] = "\50\56\57\x2f\x2e\40\x7c\x20\x2e\57\57\x40\52\x20\174\x20\x2e\57\x2f\156\x61\x6d\145\163\x70\x61\x63\145\72\x3a\x2a\51\133" . $SP->nodeValue . "\x5d";
                    $Zw["\156\x61\155\x65\163\x70\141\x63\x65\163"] = array();
                    $XW = $H1->query("\x2e\x2f\x6e\141\x6d\x65\163\x70\141\x63\145\x3a\x3a\52", $SP);
                    foreach ($XW as $ct) {
                        if (!($ct->localName != "\x78\x6d\154")) {
                            goto wa;
                        }
                        $mK["\x6e\141\155\145\163\160\141\143\145\x73"][$ct->localName] = $ct->nodeValue;
                        wa:
                        Bp:
                    }
                    bT:
                    goto e8;
                    Lv:
                    $SP = $SP->nextSibling;
                    goto D0;
                    e8:
                    goto Ew;
            }
            DX:
            Ew:
            AB:
        }
        T2:
        if (!$HC instanceof DOMElement) {
            goto H8;
        }
        $HC = $this->canonicalizeData($LO, $OW, $mK, $J5);
        H8:
        return $HC;
    }
    public function processRefNode($sb)
    {
        $Hc = null;
        $EE = true;
        if ($Uj = $sb->getAttribute("\x55\122\111")) {
            goto tw;
        }
        $EE = false;
        $Hc = $sb->ownerDocument;
        goto zR;
        tw:
        $fP = parse_url($Uj);
        if (empty($fP["\160\141\x74\x68"])) {
            goto ud;
        }
        $Hc = file_get_contents($fP);
        goto zg;
        ud:
        if ($eg = $fP["\x66\162\x61\x67\x6d\145\156\164"]) {
            goto hT;
        }
        $Hc = $sb->ownerDocument;
        goto Eg;
        hT:
        $EE = false;
        $Os = new DOMXPath($sb->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto UR;
        }
        foreach ($this->idNS as $Cv => $gc) {
            $Os->registerNamespace($Cv, $gc);
            sR:
        }
        By:
        UR:
        $lF = "\x40\111\144\x3d\x22" . $eg . "\42";
        if (!is_array($this->idKeys)) {
            goto De;
        }
        foreach ($this->idKeys as $mV) {
            $lF .= "\40\157\162\x20\x40{$mV}\75\47{$eg}\47";
            Ax:
        }
        WS:
        De:
        $hO = "\x2f\x2f\x2a\x5b" . $lF . "\135";
        $Hc = $Os->query($hO)->item(0);
        Eg:
        zg:
        zR:
        $HC = $this->processTransforms($sb, $Hc, $EE);
        if ($this->validateDigest($sb, $HC)) {
            goto aJ;
        }
        return false;
        aJ:
        if (!$Hc instanceof DOMElement) {
            goto z2;
        }
        if (!empty($eg)) {
            goto V9;
        }
        $this->validatedNodes[] = $Hc;
        goto YR;
        V9:
        $this->validatedNodes[$eg] = $Hc;
        YR:
        z2:
        return true;
    }
    public function getRefNodeID($sb)
    {
        if (!($Uj = $sb->getAttribute("\x55\x52\x49"))) {
            goto oK;
        }
        $fP = parse_url($Uj);
        if (!empty($fP["\x70\141\x74\150"])) {
            goto sD;
        }
        if (!($eg = $fP["\x66\x72\141\147\155\145\x6e\x74"])) {
            goto bE;
        }
        return $eg;
        bE:
        sD:
        oK:
        return null;
    }
    public function getRefIDs()
    {
        $il = array();
        $H1 = $this->getXPathObj();
        $hO = "\56\x2f\163\145\143\144\163\151\147\x3a\x53\x69\x67\156\145\144\111\156\146\x6f\57\x73\x65\143\144\x73\151\x67\72\x52\x65\146\145\162\145\x6e\143\x65";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($QP->length == 0)) {
            goto vu;
        }
        throw new Exception("\122\145\146\x65\162\145\x6e\143\145\40\156\157\144\x65\163\40\x6e\157\x74\x20\146\x6f\165\x6e\144");
        vu:
        foreach ($QP as $sb) {
            $il[] = $this->getRefNodeID($sb);
            bs:
        }
        Fn1:
        return $il;
    }
    public function validateReference()
    {
        $as = $this->sigNode->ownerDocument->documentElement;
        if ($as->isSameNode($this->sigNode)) {
            goto Q4;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto Gc;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        Gc:
        Q4:
        $H1 = $this->getXPathObj();
        $hO = "\x2e\x2f\163\145\143\x64\x73\151\x67\x3a\x53\151\x67\x6e\145\144\x49\x6e\x66\157\57\x73\145\143\x64\x73\x69\147\x3a\122\145\146\x65\x72\x65\156\x63\x65";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($QP->length == 0)) {
            goto ht;
        }
        throw new Exception("\122\x65\x66\145\162\145\x6e\143\x65\x20\x6e\157\x64\x65\163\x20\x6e\157\164\40\146\157\165\x6e\x64");
        ht:
        $this->validatedNodes = array();
        foreach ($QP as $sb) {
            if ($this->processRefNode($sb)) {
                goto kV;
            }
            $this->validatedNodes = null;
            throw new Exception("\x52\145\146\145\x72\x65\156\x63\x65\x20\x76\x61\x6c\x69\x64\141\164\x69\x6f\156\40\146\x61\x69\x6c\x65\144");
            kV:
            nB:
        }
        KY:
        return true;
    }
    private function addRefInternal($jL, $SP, $TT, $J1 = null, $tl = null)
    {
        $wz = null;
        $ds = null;
        $pZ = "\x49\144";
        $pK = true;
        $lq = false;
        if (!is_array($tl)) {
            goto qz;
        }
        $wz = empty($tl["\x70\162\145\x66\x69\x78"]) ? null : $tl["\160\162\145\146\151\x78"];
        $ds = empty($tl["\160\x72\x65\x66\x69\x78\x5f\x6e\x73"]) ? null : $tl["\160\x72\x65\x66\x69\170\137\x6e\163"];
        $pZ = empty($tl["\x69\144\x5f\156\141\x6d\145"]) ? "\x49\x64" : $tl["\151\144\x5f\156\x61\155\x65"];
        $pK = !isset($tl["\157\x76\145\x72\167\162\151\x74\145"]) ? true : (bool) $tl["\x6f\x76\145\162\167\162\151\x74\145"];
        $lq = !isset($tl["\x66\157\x72\x63\145\137\165\x72\x69"]) ? false : (bool) $tl["\x66\x6f\x72\x63\x65\x5f\x75\162\x69"];
        qz:
        $id = $pZ;
        if (empty($wz)) {
            goto Jl;
        }
        $id = $wz . "\72" . $id;
        Jl:
        $sb = $this->createNewSignNode("\x52\145\146\x65\162\x65\x6e\143\x65");
        $jL->appendChild($sb);
        if (!$SP instanceof DOMDocument) {
            goto Cj;
        }
        if ($lq) {
            goto n0;
        }
        goto Zl;
        Cj:
        $Uj = null;
        if ($pK) {
            goto L1;
        }
        $Uj = $ds ? $SP->getAttributeNS($ds, $pZ) : $SP->getAttribute($pZ);
        L1:
        if (!empty($Uj)) {
            goto sr;
        }
        $Uj = self::generateGUID();
        $SP->setAttributeNS($ds, $id, $Uj);
        sr:
        $sb->setAttribute("\125\x52\111", "\43" . $Uj);
        goto Zl;
        n0:
        $sb->setAttribute("\x55\122\x49", '');
        Zl:
        $Y2 = $this->createNewSignNode("\x54\x72\x61\156\163\x66\157\x72\155\x73");
        $sb->appendChild($Y2);
        if (is_array($J1)) {
            goto XD;
        }
        if (!empty($this->canonicalMethod)) {
            goto kD;
        }
        goto lb;
        XD:
        foreach ($J1 as $Mx) {
            $wv = $this->createNewSignNode("\x54\162\x61\x6e\163\146\157\x72\155");
            $Y2->appendChild($wv);
            if (is_array($Mx) && !empty($Mx["\150\x74\164\x70\x3a\57\57\x77\x77\167\56\167\63\56\157\x72\147\57\x54\122\x2f\x31\71\x39\x39\x2f\x52\x45\x43\55\x78\x70\141\164\150\x2d\x31\71\x39\71\61\61\x31\66"]) && !empty($Mx["\150\164\164\160\72\57\x2f\167\167\x77\x2e\167\63\x2e\157\x72\147\57\x54\122\57\x31\x39\71\71\x2f\122\105\103\55\x78\160\141\164\150\55\x31\71\71\71\61\x31\61\x36"]["\x71\165\145\x72\171"])) {
                goto xN;
            }
            $wv->setAttribute("\x41\154\x67\157\162\x69\x74\150\155", $Mx);
            goto yp;
            xN:
            $wv->setAttribute("\x41\x6c\x67\x6f\x72\x69\164\x68\x6d", "\150\x74\x74\160\x3a\x2f\x2f\x77\167\167\x2e\167\63\56\157\162\x67\x2f\124\122\57\61\x39\71\71\57\122\105\x43\55\x78\x70\x61\x74\x68\55\61\71\x39\71\x31\x31\61\x36");
            $kN = $this->createNewSignNode("\130\x50\141\x74\150", $Mx["\150\164\x74\160\72\x2f\x2f\167\167\167\56\x77\63\56\157\162\147\57\x54\122\57\61\71\71\71\57\x52\x45\103\x2d\x78\160\141\x74\150\55\x31\71\71\x39\61\61\x31\x36"]["\x71\x75\x65\x72\171"]);
            $wv->appendChild($kN);
            if (empty($Mx["\x68\x74\164\160\72\57\x2f\x77\x77\x77\x2e\167\63\56\x6f\162\x67\x2f\x54\x52\57\x31\71\x39\x39\x2f\x52\x45\x43\55\170\160\141\164\150\55\x31\x39\71\x39\x31\x31\61\66"]["\156\141\x6d\145\x73\x70\x61\x63\x65\x73"])) {
                goto SU;
            }
            foreach ($Mx["\150\164\164\160\72\57\x2f\167\167\167\x2e\167\63\56\157\x72\x67\57\124\122\x2f\61\x39\71\71\57\x52\x45\x43\x2d\x78\x70\141\164\150\55\61\x39\71\71\x31\x31\61\x36"]["\156\x61\155\145\x73\x70\141\143\x65\x73"] as $wz => $nM) {
                $kN->setAttributeNS("\150\x74\x74\x70\72\57\x2f\x77\167\167\56\x77\63\56\157\x72\147\57\62\x30\x30\x30\57\x78\155\154\156\x73\x2f", "\x78\155\x6c\x6e\163\x3a{$wz}", $nM);
                Tv:
            }
            C2:
            SU:
            yp:
            TD:
        }
        dR:
        goto lb;
        kD:
        $wv = $this->createNewSignNode("\124\162\x61\156\163\146\157\162\x6d");
        $Y2->appendChild($wv);
        $wv->setAttribute("\x41\154\147\157\162\x69\x74\150\x6d", $this->canonicalMethod);
        lb:
        $IP = $this->processTransforms($sb, $SP);
        $Cy = $this->calculateDigest($TT, $IP);
        $H4 = $this->createNewSignNode("\x44\x69\147\x65\x73\x74\x4d\145\164\x68\x6f\144");
        $sb->appendChild($H4);
        $H4->setAttribute("\x41\x6c\x67\157\162\151\164\x68\x6d", $TT);
        $W1 = $this->createNewSignNode("\x44\x69\x67\145\163\x74\126\x61\154\165\x65", $Cy);
        $sb->appendChild($W1);
    }
    public function addReference($SP, $TT, $J1 = null, $tl = null)
    {
        if (!($H1 = $this->getXPathObj())) {
            goto b3;
        }
        $hO = "\x2e\57\163\145\143\x64\x73\151\x67\x3a\123\151\147\156\x65\144\x49\x6e\x66\157";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($Qa = $QP->item(0))) {
            goto gg;
        }
        $this->addRefInternal($Qa, $SP, $TT, $J1, $tl);
        gg:
        b3:
    }
    public function addReferenceList($F6, $TT, $J1 = null, $tl = null)
    {
        if (!($H1 = $this->getXPathObj())) {
            goto xV;
        }
        $hO = "\56\57\163\145\x63\x64\163\151\x67\x3a\x53\151\147\156\145\x64\x49\x6e\146\157";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($Qa = $QP->item(0))) {
            goto tc;
        }
        foreach ($F6 as $SP) {
            $this->addRefInternal($Qa, $SP, $TT, $J1, $tl);
            Mx:
        }
        Zi:
        tc:
        xV:
    }
    public function addObject($HC, $uw = null, $mn = null)
    {
        $Yi = $this->createNewSignNode("\x4f\142\x6a\145\143\164");
        $this->sigNode->appendChild($Yi);
        if (empty($uw)) {
            goto uX;
        }
        $Yi->setAttribute("\115\151\155\145\x54\x79\x70\145", $uw);
        uX:
        if (empty($mn)) {
            goto RZ;
        }
        $Yi->setAttribute("\x45\156\143\157\x64\151\156\x67", $mn);
        RZ:
        if ($HC instanceof DOMElement) {
            goto R_;
        }
        $B5 = $this->sigNode->ownerDocument->createTextNode($HC);
        goto BS;
        R_:
        $B5 = $this->sigNode->ownerDocument->importNode($HC, true);
        BS:
        $Yi->appendChild($B5);
        return $Yi;
    }
    public function locateKey($SP = null)
    {
        if (!empty($SP)) {
            goto AU;
        }
        $SP = $this->sigNode;
        AU:
        if ($SP instanceof DOMNode) {
            goto d9;
        }
        return null;
        d9:
        if (!($t0 = $SP->ownerDocument)) {
            goto OS;
        }
        $H1 = new DOMXPath($t0);
        $H1->registerNamespace("\x73\x65\x63\144\x73\151\147", self::XMLDSIGNS);
        $hO = "\x73\164\162\x69\156\x67\x28\56\x2f\x73\x65\x63\144\x73\x69\147\x3a\123\x69\x67\x6e\x65\x64\x49\x6e\x66\157\57\163\x65\x63\x64\163\x69\147\72\x53\x69\x67\156\141\x74\x75\x72\x65\115\x65\x74\150\157\144\57\x40\x41\154\x67\157\162\x69\x74\150\x6d\51";
        $TT = $H1->evaluate($hO, $SP);
        if (!$TT) {
            goto GL;
        }
        try {
            $EJ = new XMLSecurityKey($TT, array("\164\x79\160\145" => "\x70\x75\142\154\151\x63"));
        } catch (Exception $pE) {
            return null;
        }
        return $EJ;
        GL:
        OS:
        return null;
    }
    public function verify($EJ)
    {
        $t0 = $this->sigNode->ownerDocument;
        $H1 = new DOMXPath($t0);
        $H1->registerNamespace("\x73\x65\143\144\163\151\147", self::XMLDSIGNS);
        $hO = "\x73\164\x72\151\x6e\x67\50\x2e\57\x73\145\143\144\x73\151\147\72\x53\151\147\x6e\141\164\165\162\x65\126\x61\154\165\145\51";
        $bD = $H1->evaluate($hO, $this->sigNode);
        if (!empty($bD)) {
            goto Jk;
        }
        throw new Exception("\x55\156\141\142\154\145\x20\164\x6f\40\x6c\157\x63\141\x74\145\x20\123\151\147\156\x61\164\x75\162\x65\126\141\154\165\145");
        Jk:
        return $EJ->verifySignature($this->signedInfo, base64_decode($bD));
    }
    public function signData($EJ, $HC)
    {
        return $EJ->signData($HC);
    }
    public function sign($EJ, $I0 = null)
    {
        if (!($I0 != null)) {
            goto Tg;
        }
        $this->resetXPathObj();
        $this->appendSignature($I0);
        $this->sigNode = $I0->lastChild;
        Tg:
        if (!($H1 = $this->getXPathObj())) {
            goto Os;
        }
        $hO = "\x2e\x2f\163\x65\x63\144\x73\151\147\72\123\151\x67\156\145\x64\111\156\146\157";
        $QP = $H1->query($hO, $this->sigNode);
        if (!($Qa = $QP->item(0))) {
            goto Of;
        }
        $hO = "\56\x2f\x73\145\x63\x64\x73\x69\147\x3a\123\151\x67\x6e\x61\x74\165\x72\145\115\145\x74\150\157\144";
        $QP = $H1->query($hO, $Qa);
        $ji = $QP->item(0);
        $ji->setAttribute("\101\154\147\157\x72\x69\164\x68\155", $EJ->type);
        $HC = $this->canonicalizeData($Qa, $this->canonicalMethod);
        $bD = base64_encode($this->signData($EJ, $HC));
        $J6 = $this->createNewSignNode("\123\151\147\156\141\164\165\x72\145\126\141\x6c\x75\145", $bD);
        if ($P8 = $Qa->nextSibling) {
            goto yk;
        }
        $this->sigNode->appendChild($J6);
        goto uy;
        yk:
        $P8->parentNode->insertBefore($J6, $P8);
        uy:
        Of:
        Os:
    }
    public function appendCert()
    {
    }
    public function appendKey($EJ, $Qq = null)
    {
        $EJ->serializeKey($Qq);
    }
    public function insertSignature($SP, $WX = null)
    {
        $XU = $SP->ownerDocument;
        $Q0 = $XU->importNode($this->sigNode, true);
        if ($WX == null) {
            goto iA;
        }
        return $SP->insertBefore($Q0, $WX);
        goto gi;
        iA:
        return $SP->insertBefore($Q0);
        gi:
    }
    public function appendSignature($u0, $ES = false)
    {
        $WX = $ES ? $u0->firstChild : null;
        return $this->insertSignature($u0, $WX);
    }
    public static function get509XCert($XE, $lZ = true)
    {
        $wu = self::staticGet509XCerts($XE, $lZ);
        if (empty($wu)) {
            goto HU;
        }
        return $wu[0];
        HU:
        return '';
    }
    public static function staticGet509XCerts($wu, $lZ = true)
    {
        if ($lZ) {
            goto NN;
        }
        return array($wu);
        goto bd;
        NN:
        $HC = '';
        $xR = array();
        $q4 = explode("\xa", $wu);
        $BC = false;
        foreach ($q4 as $q3) {
            if (!$BC) {
                goto yv;
            }
            if (!(strncmp($q3, "\55\x2d\55\x2d\x2d\105\116\x44\x20\103\105\x52\124\111\106\x49\x43\101\124\x45", 20) == 0)) {
                goto N7;
            }
            $BC = false;
            $xR[] = $HC;
            $HC = '';
            goto up;
            N7:
            $HC .= trim($q3);
            goto W7;
            yv:
            if (!(strncmp($q3, "\55\55\55\x2d\x2d\x42\105\107\x49\116\x20\103\x45\122\x54\x49\x46\111\x43\x41\x54\x45", 22) == 0)) {
                goto U6;
            }
            $BC = true;
            U6:
            W7:
            up:
        }
        ru:
        return $xR;
        bd:
    }
    public static function staticAdd509Cert($ft, $XE, $lZ = true, $uM = false, $H1 = null, $tl = null)
    {
        if (!$uM) {
            goto Jn;
        }
        $XE = file_get_contents($XE);
        Jn:
        if ($ft instanceof DOMElement) {
            goto cl;
        }
        throw new Exception("\111\x6e\x76\141\154\151\144\40\x70\141\x72\145\x6e\164\x20\x4e\x6f\x64\145\40\x70\141\x72\141\155\x65\x74\x65\162");
        cl:
        $ge = $ft->ownerDocument;
        if (!empty($H1)) {
            goto gB;
        }
        $H1 = new DOMXPath($ft->ownerDocument);
        $H1->registerNamespace("\163\145\143\144\x73\151\x67", self::XMLDSIGNS);
        gB:
        $hO = "\56\x2f\163\145\143\144\163\151\x67\72\113\145\x79\111\x6e\146\x6f";
        $QP = $H1->query($hO, $ft);
        $J3 = $QP->item(0);
        $ZK = '';
        if (!$J3) {
            goto r2;
        }
        $oe = $J3->lookupPrefix(self::XMLDSIGNS);
        if (empty($oe)) {
            goto FK;
        }
        $ZK = $oe . "\72";
        FK:
        goto b_;
        r2:
        $oe = $ft->lookupPrefix(self::XMLDSIGNS);
        if (empty($oe)) {
            goto u0;
        }
        $ZK = $oe . "\72";
        u0:
        $r0 = false;
        $J3 = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\x4b\145\x79\x49\156\x66\x6f");
        $hO = "\x2e\57\x73\145\143\x64\x73\151\x67\x3a\117\x62\152\x65\143\x74";
        $QP = $H1->query($hO, $ft);
        if (!($xV = $QP->item(0))) {
            goto IW;
        }
        $xV->parentNode->insertBefore($J3, $xV);
        $r0 = true;
        IW:
        if ($r0) {
            goto tW;
        }
        $ft->appendChild($J3);
        tW:
        b_:
        $wu = self::staticGet509XCerts($XE, $lZ);
        $U3 = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\130\65\x30\x39\104\x61\x74\141");
        $J3->appendChild($U3);
        $P1 = false;
        $sg = false;
        if (!is_array($tl)) {
            goto i9;
        }
        if (empty($tl["\x69\163\163\x75\x65\x72\123\145\x72\x69\141\154"])) {
            goto L2;
        }
        $P1 = true;
        L2:
        if (empty($tl["\x73\x75\x62\152\145\143\x74\116\x61\x6d\145"])) {
            goto gm;
        }
        $sg = true;
        gm:
        i9:
        foreach ($wu as $gF) {
            if (!($P1 || $sg)) {
                goto LV;
            }
            if (!($hl = openssl_x509_parse("\55\x2d\x2d\x2d\55\x42\105\x47\111\116\x20\x43\105\x52\x54\x49\x46\111\x43\x41\x54\105\x2d\55\55\55\x2d\12" . chunk_split($gF, 64, "\xa") . "\55\55\x2d\55\x2d\105\x4e\104\40\x43\105\x52\x54\x49\106\x49\x43\x41\x54\105\55\x2d\55\55\55\12"))) {
                goto iC;
            }
            if (!($sg && !empty($hl["\163\x75\142\152\x65\x63\x74"]))) {
                goto ze;
            }
            if (is_array($hl["\163\165\x62\x6a\145\x63\164"])) {
                goto MB;
            }
            $Oe = $hl["\x69\x73\163\165\145\162"];
            goto mG;
            MB:
            $Y0 = array();
            foreach ($hl["\x73\x75\142\x6a\145\x63\164"] as $l9 => $qO) {
                if (is_array($qO)) {
                    goto ZL;
                }
                array_unshift($Y0, "{$l9}\x3d{$qO}");
                goto yI;
                ZL:
                foreach ($qO as $wq) {
                    array_unshift($Y0, "{$l9}\75{$wq}");
                    aP:
                }
                u3:
                yI:
                na:
            }
            ZQ:
            $Oe = implode("\x2c", $Y0);
            mG:
            $GI = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\x58\x35\60\71\x53\165\x62\x6a\x65\x63\164\x4e\141\155\x65", $Oe);
            $U3->appendChild($GI);
            ze:
            if (!($P1 && !empty($hl["\151\163\x73\165\x65\162"]) && !empty($hl["\163\x65\162\151\x61\154\116\x75\155\x62\x65\x72"]))) {
                goto rq;
            }
            if (is_array($hl["\151\163\x73\x75\x65\x72"])) {
                goto tJ;
            }
            $yg = $hl["\x69\163\x73\x75\x65\x72"];
            goto gF;
            tJ:
            $Y0 = array();
            foreach ($hl["\x69\163\x73\165\x65\162"] as $l9 => $qO) {
                array_unshift($Y0, "{$l9}\x3d{$qO}");
                nL:
            }
            g1:
            $yg = implode("\x2c", $Y0);
            gF:
            $jx = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\130\65\x30\x39\111\x73\163\x75\145\162\123\x65\x72\x69\141\x6c");
            $U3->appendChild($jx);
            $ac = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\130\x35\x30\71\x49\x73\x73\165\145\x72\116\x61\155\x65", $yg);
            $jx->appendChild($ac);
            $ac = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\130\65\x30\x39\x53\x65\162\151\x61\154\116\165\x6d\x62\145\162", $hl["\x73\145\162\x69\x61\x6c\x4e\165\x6d\142\145\x72"]);
            $jx->appendChild($ac);
            rq:
            iC:
            LV:
            $oo = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\130\65\60\x39\x43\145\162\164\x69\x66\151\143\141\x74\x65", $gF);
            $U3->appendChild($oo);
            m9:
        }
        iu:
    }
    public function add509Cert($XE, $lZ = true, $uM = false, $tl = null)
    {
        if (!($H1 = $this->getXPathObj())) {
            goto F1;
        }
        self::staticAdd509Cert($this->sigNode, $XE, $lZ, $uM, $H1, $tl);
        F1:
    }
    public function appendToKeyInfo($SP)
    {
        $ft = $this->sigNode;
        $ge = $ft->ownerDocument;
        $H1 = $this->getXPathObj();
        if (!empty($H1)) {
            goto fs;
        }
        $H1 = new DOMXPath($ft->ownerDocument);
        $H1->registerNamespace("\x73\x65\143\x64\163\x69\x67", self::XMLDSIGNS);
        fs:
        $hO = "\x2e\x2f\x73\x65\143\x64\x73\151\x67\72\113\145\x79\x49\156\146\157";
        $QP = $H1->query($hO, $ft);
        $J3 = $QP->item(0);
        if ($J3) {
            goto SZ;
        }
        $ZK = '';
        $oe = $ft->lookupPrefix(self::XMLDSIGNS);
        if (empty($oe)) {
            goto Y8;
        }
        $ZK = $oe . "\72";
        Y8:
        $r0 = false;
        $J3 = $ge->createElementNS(self::XMLDSIGNS, $ZK . "\x4b\x65\x79\111\x6e\x66\157");
        $hO = "\56\57\163\x65\143\x64\163\151\x67\x3a\x4f\142\152\145\143\164";
        $QP = $H1->query($hO, $ft);
        if (!($xV = $QP->item(0))) {
            goto jm;
        }
        $xV->parentNode->insertBefore($J3, $xV);
        $r0 = true;
        jm:
        if ($r0) {
            goto Uc;
        }
        $ft->appendChild($J3);
        Uc:
        SZ:
        $J3->appendChild($SP);
        return $J3;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
class XMLSecEnc
{
    const template = "\x3c\170\x65\x6e\x63\72\x45\156\143\x72\x79\160\x74\145\x64\x44\141\164\x61\x20\x78\x6d\154\x6e\163\72\170\145\156\143\75\47\150\x74\x74\x70\72\x2f\x2f\x77\x77\x77\x2e\167\63\56\157\x72\x67\57\x32\60\x30\x31\57\60\64\57\170\x6d\x6c\x65\156\143\43\47\76\15\12\40\x20\x20\74\170\x65\156\143\72\x43\x69\160\x68\x65\x72\x44\141\164\x61\x3e\xd\xa\x20\x20\x20\x20\x20\40\74\170\145\x6e\143\72\103\151\x70\x68\x65\x72\126\141\x6c\165\x65\76\74\57\x78\x65\156\143\72\103\x69\160\x68\145\x72\x56\x61\154\165\x65\x3e\xd\12\40\40\40\74\x2f\x78\145\x6e\143\x3a\x43\x69\x70\x68\x65\x72\104\x61\x74\x61\x3e\xd\xa\x3c\x2f\170\145\156\143\x3a\105\156\x63\x72\x79\160\164\x65\144\x44\x61\164\141\76";
    const Element = "\x68\164\x74\160\72\57\x2f\167\x77\167\x2e\167\x33\56\157\162\x67\57\x32\x30\x30\x31\57\x30\64\x2f\170\x6d\x6c\x65\156\x63\x23\105\154\x65\x6d\145\x6e\x74";
    const Content = "\150\164\164\x70\72\x2f\57\x77\167\x77\x2e\167\x33\56\157\162\147\x2f\62\x30\60\61\57\60\64\x2f\170\x6d\x6c\x65\x6e\143\x23\x43\157\x6e\164\145\156\x74";
    const URI = 3;
    const XMLENCNS = "\150\164\x74\x70\72\57\57\x77\x77\167\56\167\x33\56\x6f\x72\147\57\62\60\x30\x31\x2f\60\64\57\x78\x6d\x6c\145\x6e\143\x23";
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
    public function addReference($cg, $SP, $dE)
    {
        if ($SP instanceof DOMNode) {
            goto d6;
        }
        throw new Exception("\44\x6e\x6f\144\145\x20\151\x73\x20\x6e\x6f\x74\x20\157\146\x20\164\x79\160\x65\x20\104\117\x4d\x4e\157\144\145");
        d6:
        $UC = $this->encdoc;
        $this->_resetTemplate();
        $rT = $this->encdoc;
        $this->encdoc = $UC;
        $wm = XMLSecurityDSig::generateGUID();
        $xK = $rT->documentElement;
        $xK->setAttribute("\x49\144", $wm);
        $this->references[$cg] = array("\156\x6f\144\x65" => $SP, "\164\x79\x70\145" => $dE, "\145\x6e\143\x6e\157\144\145" => $rT, "\x72\145\x66\x75\x72\151" => $wm);
    }
    public function setNode($SP)
    {
        $this->rawNode = $SP;
    }
    public function encryptNode($EJ, $oH = true)
    {
        $HC = '';
        if (!empty($this->rawNode)) {
            goto nU;
        }
        throw new Exception("\116\x6f\144\145\40\164\x6f\x20\x65\156\x63\162\x79\160\164\40\150\141\x73\40\156\157\164\40\x62\x65\145\156\x20\163\145\x74");
        nU:
        if ($EJ instanceof XMLSecurityKey) {
            goto O0;
        }
        throw new Exception("\x49\x6e\166\x61\x6c\151\144\x20\x4b\x65\171");
        O0:
        $t0 = $this->rawNode->ownerDocument;
        $Os = new DOMXPath($this->encdoc);
        $DE = $Os->query("\x2f\170\x65\x6e\x63\72\105\156\x63\162\x79\x70\164\x65\144\x44\x61\x74\x61\57\170\145\156\143\x3a\x43\x69\160\150\145\162\x44\141\164\x61\57\170\x65\x6e\143\72\103\151\160\150\x65\x72\x56\141\154\x75\145");
        $w_ = $DE->item(0);
        if (!($w_ == null)) {
            goto tS;
        }
        throw new Exception("\105\162\162\x6f\x72\40\154\157\x63\141\x74\151\x6e\147\x20\103\x69\x70\150\x65\162\126\141\x6c\165\145\40\x65\154\x65\155\x65\x6e\x74\40\167\x69\x74\x68\x69\156\40\164\x65\155\x70\154\x61\x74\145");
        tS:
        switch ($this->type) {
            case self::Element:
                $HC = $t0->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\124\171\x70\x65", self::Element);
                goto ba;
            case self::Content:
                $HQ = $this->rawNode->childNodes;
                foreach ($HQ as $Q2) {
                    $HC .= $t0->saveXML($Q2);
                    IZ:
                }
                ja:
                $this->encdoc->documentElement->setAttribute("\124\171\160\x65", self::Content);
                goto ba;
            default:
                throw new Exception("\124\x79\160\145\x20\x69\163\x20\143\165\162\162\145\156\164\154\171\40\156\x6f\164\40\163\x75\160\x70\x6f\x72\x74\145\x64");
        }
        IJ:
        ba:
        $eU = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\143\72\105\x6e\143\x72\x79\x70\x74\151\157\x6e\x4d\x65\164\150\x6f\144"));
        $eU->setAttribute("\x41\x6c\147\x6f\162\x69\164\x68\x6d", $EJ->getAlgorithm());
        $w_->parentNode->parentNode->insertBefore($eU, $w_->parentNode->parentNode->firstChild);
        $D2 = base64_encode($EJ->encryptData($HC));
        $qO = $this->encdoc->createTextNode($D2);
        $w_->appendChild($qO);
        if ($oH) {
            goto ZS;
        }
        return $this->encdoc->documentElement;
        goto Dm;
        ZS:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto Ls;
                }
                return $this->encdoc;
                Ls:
                $dD = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($dD, $this->rawNode);
                return $dD;
            case self::Content:
                $dD = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                XP:
                if (!$this->rawNode->firstChild) {
                    goto jF;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto XP;
                jF:
                $this->rawNode->appendChild($dD);
                return $dD;
        }
        NW:
        ao:
        Dm:
    }
    public function encryptReferences($EJ)
    {
        $Qh = $this->rawNode;
        $R5 = $this->type;
        foreach ($this->references as $cg => $X8) {
            $this->encdoc = $X8["\x65\x6e\143\x6e\157\x64\x65"];
            $this->rawNode = $X8["\x6e\x6f\144\x65"];
            $this->type = $X8["\164\171\x70\x65"];
            try {
                $HG = $this->encryptNode($EJ);
                $this->references[$cg]["\x65\x6e\x63\x6e\x6f\144\x65"] = $HG;
            } catch (Exception $pE) {
                $this->rawNode = $Qh;
                $this->type = $R5;
                throw $pE;
            }
            P6:
        }
        FA:
        $this->rawNode = $Qh;
        $this->type = $R5;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto bL;
        }
        throw new Exception("\116\x6f\x64\x65\40\x74\157\40\144\x65\x63\x72\x79\160\x74\40\x68\141\x73\x20\156\157\164\40\x62\145\x65\156\x20\163\x65\x74");
        bL:
        $t0 = $this->rawNode->ownerDocument;
        $Os = new DOMXPath($t0);
        $Os->registerNamespace("\170\155\x6c\145\156\143\162", self::XMLENCNS);
        $hO = "\56\x2f\x78\155\154\145\156\143\x72\x3a\x43\x69\x70\x68\x65\162\104\141\164\x61\57\x78\x6d\154\145\156\143\x72\x3a\103\x69\x70\x68\x65\162\x56\x61\x6c\x75\x65";
        $QP = $Os->query($hO, $this->rawNode);
        $SP = $QP->item(0);
        if ($SP) {
            goto ct;
        }
        return null;
        ct:
        return base64_decode($SP->nodeValue);
    }
    public function decryptNode($EJ, $oH = true)
    {
        if ($EJ instanceof XMLSecurityKey) {
            goto WX;
        }
        throw new Exception("\x49\x6e\166\x61\x6c\151\x64\x20\113\x65\171");
        WX:
        $pw = $this->getCipherValue();
        if ($pw) {
            goto Dz;
        }
        throw new Exception("\103\141\156\156\157\x74\x20\x6c\157\x63\141\x74\x65\40\x65\156\x63\162\x79\160\164\x65\x64\x20\x64\x61\164\141");
        goto aI;
        Dz:
        $hN = $EJ->decryptData($pw);
        if ($oH) {
            goto Z8;
        }
        return $hN;
        goto UJ;
        Z8:
        switch ($this->type) {
            case self::Element:
                $Yl = new DOMDocument();
                $Yl->loadXML($hN);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto bx;
                }
                return $Yl;
                bx:
                $dD = $this->rawNode->ownerDocument->importNode($Yl->documentElement, true);
                $this->rawNode->parentNode->replaceChild($dD, $this->rawNode);
                return $dD;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto E0;
                }
                $t0 = $this->rawNode->ownerDocument;
                goto O9;
                E0:
                $t0 = $this->rawNode;
                O9:
                $a6 = $t0->createDocumentFragment();
                $a6->appendXML($hN);
                $Qq = $this->rawNode->parentNode;
                $Qq->replaceChild($a6, $this->rawNode);
                return $Qq;
            default:
                return $hN;
        }
        rO:
        Us:
        UJ:
        aI:
    }
    public function encryptKey($tu, $On, $qh = true)
    {
        if (!(!$tu instanceof XMLSecurityKey || !$On instanceof XMLSecurityKey)) {
            goto MG;
        }
        throw new Exception("\x49\x6e\166\x61\154\x69\x64\40\x4b\145\171");
        MG:
        $v1 = base64_encode($tu->encryptData($On->key));
        $V1 = $this->encdoc->documentElement;
        $ri = $this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\143\x3a\x45\x6e\143\162\x79\160\x74\x65\144\113\x65\171");
        if ($qh) {
            goto Sc;
        }
        $this->encKey = $ri;
        goto s7;
        Sc:
        $J3 = $V1->insertBefore($this->encdoc->createElementNS("\x68\x74\164\x70\72\57\57\x77\167\167\56\x77\63\56\157\x72\147\57\x32\60\60\60\x2f\x30\71\x2f\x78\155\154\x64\x73\x69\x67\43", "\144\x73\151\147\x3a\x4b\x65\171\x49\156\146\157"), $V1->firstChild);
        $J3->appendChild($ri);
        s7:
        $eU = $ri->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\143\x3a\105\x6e\143\x72\171\160\164\151\157\x6e\115\145\164\150\x6f\x64"));
        $eU->setAttribute("\x41\154\x67\x6f\162\151\x74\x68\x6d", $tu->getAlgorithm());
        if (empty($tu->name)) {
            goto L5;
        }
        $J3 = $ri->appendChild($this->encdoc->createElementNS("\x68\164\x74\160\72\57\57\x77\167\x77\x2e\167\63\x2e\x6f\x72\147\57\62\60\60\60\x2f\x30\x39\x2f\x78\x6d\x6c\144\163\x69\x67\x23", "\x64\163\151\147\x3a\113\x65\171\x49\x6e\x66\x6f"));
        $J3->appendChild($this->encdoc->createElementNS("\150\164\x74\160\x3a\57\57\x77\167\167\56\x77\63\x2e\157\162\147\x2f\x32\x30\60\x30\x2f\60\x39\57\170\x6d\x6c\144\x73\151\147\43", "\x64\x73\151\x67\72\113\145\x79\116\x61\155\145", $tu->name));
        L5:
        $Bm = $ri->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\x63\x3a\x43\x69\160\x68\145\162\x44\x61\164\141"));
        $Bm->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\156\x63\x3a\x43\x69\160\150\x65\x72\126\141\x6c\165\145", $v1));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto Uz;
        }
        $Ce = $ri->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\x6e\143\x3a\x52\145\x66\x65\x72\x65\156\x63\x65\114\x69\x73\164"));
        foreach ($this->references as $cg => $X8) {
            $wm = $X8["\162\x65\146\x75\x72\x69"];
            $j4 = $Ce->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\143\x3a\x44\141\x74\x61\122\145\146\145\x72\145\x6e\x63\145"));
            $j4->setAttribute("\x55\x52\111", "\43" . $wm);
            ke:
        }
        TT:
        Uz:
        return;
    }
    public function decryptKey($ri)
    {
        if ($ri->isEncrypted) {
            goto H0;
        }
        throw new Exception("\113\x65\x79\x20\151\163\x20\x6e\157\164\x20\x45\156\x63\x72\171\160\164\x65\x64");
        H0:
        if (!empty($ri->key)) {
            goto IU;
        }
        throw new Exception("\113\145\171\x20\151\163\40\155\151\163\163\151\156\x67\40\x64\141\x74\x61\x20\164\x6f\x20\x70\145\x72\x66\x6f\x72\x6d\x20\x74\x68\x65\x20\144\x65\x63\x72\171\x70\164\x69\x6f\156");
        IU:
        return $this->decryptNode($ri, false);
    }
    public function locateEncryptedData($xK)
    {
        if ($xK instanceof DOMDocument) {
            goto NT;
        }
        $t0 = $xK->ownerDocument;
        goto zq;
        NT:
        $t0 = $xK;
        zq:
        if (!$t0) {
            goto c6;
        }
        $H1 = new DOMXPath($t0);
        $hO = "\57\x2f\52\x5b\154\157\143\x61\154\x2d\156\141\155\145\50\51\x3d\x27\105\x6e\143\162\171\x70\x74\x65\144\x44\141\x74\x61\x27\40\141\156\x64\40\156\x61\155\145\163\x70\141\143\x65\x2d\x75\x72\x69\50\x29\75\x27" . self::XMLENCNS . "\47\135";
        $QP = $H1->query($hO);
        return $QP->item(0);
        c6:
        return null;
    }
    public function locateKey($SP = null)
    {
        if (!empty($SP)) {
            goto il;
        }
        $SP = $this->rawNode;
        il:
        if ($SP instanceof DOMNode) {
            goto f0;
        }
        return null;
        f0:
        if (!($t0 = $SP->ownerDocument)) {
            goto PC;
        }
        $H1 = new DOMXPath($t0);
        $H1->registerNamespace("\170\155\154\163\x65\143\x65\x6e\143", self::XMLENCNS);
        $hO = "\x2e\x2f\57\x78\155\x6c\163\145\143\145\156\143\x3a\105\x6e\x63\x72\171\160\x74\151\x6f\156\115\x65\x74\x68\157\144";
        $QP = $H1->query($hO, $SP);
        if (!($Ee = $QP->item(0))) {
            goto ST;
        }
        $aK = $Ee->getAttribute("\x41\154\147\x6f\162\151\164\x68\x6d");
        try {
            $EJ = new XMLSecurityKey($aK, array("\164\x79\160\145" => "\160\162\151\166\x61\164\x65"));
        } catch (Exception $pE) {
            return null;
        }
        return $EJ;
        ST:
        PC:
        return null;
    }
    public static function staticLocateKeyInfo($Rv = null, $SP = null)
    {
        if (!(empty($SP) || !$SP instanceof DOMNode)) {
            goto HL;
        }
        return null;
        HL:
        $t0 = $SP->ownerDocument;
        if ($t0) {
            goto h9;
        }
        return null;
        h9:
        $H1 = new DOMXPath($t0);
        $H1->registerNamespace("\170\155\x6c\163\145\143\145\x6e\x63", self::XMLENCNS);
        $H1->registerNamespace("\x78\x6d\x6c\x73\145\x63\144\x73\151\x67", XMLSecurityDSig::XMLDSIGNS);
        $hO = "\56\57\170\155\x6c\163\145\143\144\163\x69\147\x3a\x4b\145\171\x49\x6e\146\157";
        $QP = $H1->query($hO, $SP);
        $Ee = $QP->item(0);
        if ($Ee) {
            goto eV;
        }
        return $Rv;
        eV:
        foreach ($Ee->childNodes as $Q2) {
            switch ($Q2->localName) {
                case "\x4b\145\171\116\x61\x6d\145":
                    if (empty($Rv)) {
                        goto nM;
                    }
                    $Rv->name = $Q2->nodeValue;
                    nM:
                    goto hd;
                case "\113\x65\x79\126\x61\x6c\165\145":
                    foreach ($Q2->childNodes as $Mk) {
                        switch ($Mk->localName) {
                            case "\x44\123\x41\x4b\x65\x79\x56\x61\154\x75\145":
                                throw new Exception("\x44\x53\101\113\145\171\126\x61\154\x75\145\x20\143\x75\x72\x72\145\156\164\x6c\x79\x20\x6e\x6f\x74\x20\x73\x75\x70\x70\x6f\x72\x74\x65\x64");
                            case "\x52\123\x41\113\145\171\x56\x61\154\165\145":
                                $Tc = null;
                                $Zc = null;
                                if (!($Oy = $Mk->getElementsByTagName("\x4d\x6f\x64\x75\x6c\165\163")->item(0))) {
                                    goto DN;
                                }
                                $Tc = base64_decode($Oy->nodeValue);
                                DN:
                                if (!($AQ = $Mk->getElementsByTagName("\105\x78\x70\157\156\x65\156\164")->item(0))) {
                                    goto NC;
                                }
                                $Zc = base64_decode($AQ->nodeValue);
                                NC:
                                if (!(empty($Tc) || empty($Zc))) {
                                    goto Nh;
                                }
                                throw new Exception("\115\151\163\163\151\x6e\x67\40\115\x6f\x64\x75\154\165\163\40\157\162\40\x45\x78\x70\157\x6e\x65\x6e\164");
                                Nh:
                                $bN = XMLSecurityKey::convertRSA($Tc, $Zc);
                                $Rv->loadKey($bN);
                                goto wC;
                        }
                        fz:
                        wC:
                        Q6:
                    }
                    pb:
                    goto hd;
                case "\122\x65\164\x72\x69\145\166\x61\154\x4d\x65\x74\x68\x6f\144":
                    $dE = $Q2->getAttribute("\x54\x79\160\145");
                    if (!($dE !== "\x68\164\164\x70\72\57\x2f\167\x77\x77\x2e\x77\63\56\157\162\x67\x2f\x32\60\60\x31\57\60\x34\57\x78\x6d\154\x65\x6e\143\x23\105\x6e\143\162\x79\160\164\145\x64\x4b\145\171")) {
                        goto nO;
                    }
                    goto hd;
                    nO:
                    $Uj = $Q2->getAttribute("\125\x52\x49");
                    if (!($Uj[0] !== "\43")) {
                        goto AK;
                    }
                    goto hd;
                    AK:
                    $kI = substr($Uj, 1);
                    $hO = "\57\57\170\x6d\154\163\x65\x63\x65\x6e\143\72\x45\x6e\143\x72\171\x70\164\145\x64\x4b\145\171\133\x40\111\144\x3d\47{$kI}\x27\x5d";
                    $dk = $H1->query($hO)->item(0);
                    if ($dk) {
                        goto Mh;
                    }
                    throw new Exception("\x55\x6e\141\x62\x6c\x65\x20\164\157\40\154\x6f\143\x61\164\x65\x20\x45\156\x63\162\171\x70\x74\145\x64\x4b\x65\x79\40\x77\151\x74\150\40\100\111\144\x3d\x27{$kI}\x27\x2e");
                    Mh:
                    return XMLSecurityKey::fromEncryptedKeyElement($dk);
                case "\105\x6e\x63\162\171\160\x74\145\x64\x4b\x65\171":
                    return XMLSecurityKey::fromEncryptedKeyElement($Q2);
                case "\x58\65\x30\71\x44\x61\x74\x61":
                    if (!($Cw = $Q2->getElementsByTagName("\x58\x35\x30\x39\103\145\162\x74\151\146\x69\143\x61\164\145"))) {
                        goto tX;
                    }
                    if (!($Cw->length > 0)) {
                        goto qa;
                    }
                    $fe = $Cw->item(0)->textContent;
                    $fe = str_replace(array("\15", "\12", "\x20"), '', $fe);
                    $fe = "\55\55\x2d\x2d\x2d\x42\105\x47\111\x4e\x20\x43\105\x52\124\x49\x46\x49\x43\101\x54\x45\55\x2d\x2d\x2d\x2d\12" . chunk_split($fe, 64, "\12") . "\55\x2d\x2d\x2d\x2d\105\x4e\104\40\x43\105\122\124\111\106\x49\103\101\124\x45\x2d\55\55\x2d\55\12";
                    $Rv->loadKey($fe, false, true);
                    qa:
                    tX:
                    goto hd;
            }
            qU:
            hd:
            lp:
        }
        LL:
        return $Rv;
    }
    public function locateKeyInfo($Rv = null, $SP = null)
    {
        if (!empty($SP)) {
            goto Za;
        }
        $SP = $this->rawNode;
        Za:
        return self::staticLocateKeyInfo($Rv, $SP);
    }
}
