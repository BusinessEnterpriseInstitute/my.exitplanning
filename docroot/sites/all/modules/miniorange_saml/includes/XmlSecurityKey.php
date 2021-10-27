<?php


class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\150\x74\164\x70\x3a\57\57\x77\x77\x77\x2e\167\63\56\157\162\147\57\62\60\60\61\x2f\x30\x34\x2f\x78\155\x6c\145\x6e\x63\x23\164\x72\x69\160\x6c\145\144\145\x73\x2d\x63\142\143";
    const AES128_CBC = "\x68\164\x74\160\72\x2f\57\x77\x77\x77\56\167\63\x2e\157\162\x67\57\x32\x30\60\61\57\60\x34\57\x78\155\154\x65\156\x63\x23\x61\x65\x73\x31\x32\x38\x2d\x63\x62\x63";
    const AES192_CBC = "\150\x74\164\x70\72\57\x2f\x77\167\167\x2e\167\63\56\x6f\x72\x67\57\62\x30\60\x31\57\x30\64\57\170\x6d\154\145\x6e\143\x23\141\145\163\x31\x39\x32\55\143\x62\x63";
    const AES256_CBC = "\150\164\164\160\72\x2f\x2f\x77\x77\x77\56\x77\x33\56\x6f\162\147\57\x32\60\x30\x31\x2f\60\64\57\x78\155\x6c\145\156\143\x23\x61\145\163\62\x35\66\x2d\143\142\x63";
    const RSA_1_5 = "\x68\164\x74\x70\72\57\x2f\167\167\167\x2e\167\63\x2e\x6f\162\147\x2f\62\60\60\61\x2f\x30\x34\57\x78\155\154\x65\x6e\143\43\x72\163\141\55\x31\137\65";
    const RSA_OAEP_MGF1P = "\150\x74\164\160\72\x2f\57\167\x77\x77\56\x77\x33\x2e\x6f\162\x67\57\62\x30\x30\x31\57\x30\64\x2f\x78\155\x6c\145\x6e\143\43\162\x73\x61\x2d\x6f\141\145\160\55\155\147\146\x31\x70";
    const DSA_SHA1 = "\150\164\x74\160\72\57\x2f\167\167\x77\x2e\x77\63\x2e\x6f\162\x67\x2f\62\60\60\x30\57\x30\x39\57\170\155\154\x64\x73\151\147\43\x64\x73\141\55\x73\x68\x61\61";
    const RSA_SHA1 = "\150\164\164\x70\x3a\x2f\57\167\x77\x77\56\167\x33\56\157\162\147\x2f\62\60\60\60\57\60\71\x2f\170\x6d\154\144\163\151\x67\43\x72\163\x61\x2d\x73\x68\141\x31";
    const RSA_SHA256 = "\x68\x74\164\160\72\57\57\167\x77\167\56\x77\63\x2e\157\162\147\x2f\62\x30\x30\x31\x2f\60\64\57\x78\x6d\x6c\144\x73\x69\x67\x2d\155\x6f\x72\145\43\162\163\x61\55\x73\x68\x61\62\x35\x36";
    const RSA_SHA384 = "\x68\x74\164\x70\x3a\57\57\167\x77\167\56\167\63\56\x6f\162\x67\x2f\x32\60\60\x31\57\60\x34\x2f\x78\155\x6c\144\163\x69\x67\55\155\157\x72\145\43\162\x73\x61\55\163\150\141\63\70\64";
    const RSA_SHA512 = "\x68\164\x74\x70\x3a\57\57\167\x77\167\x2e\x77\x33\56\x6f\x72\147\x2f\x32\60\x30\x31\x2f\60\x34\57\x78\x6d\154\x64\163\151\147\55\x6d\157\x72\x65\x23\162\x73\x61\55\x73\x68\141\65\61\62";
    const HMAC_SHA1 = "\150\164\x74\x70\72\57\x2f\167\x77\167\x2e\167\x33\56\157\162\x67\x2f\x32\x30\60\60\57\x30\x39\x2f\x78\155\154\x64\163\151\147\43\x68\155\x61\x63\55\163\x68\141\61";
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
    public function __construct($NX, $Yx = null)
    {
        switch ($NX) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\x6c\151\x62\162\x61\162\x79"] = "\157\x70\x65\x6e\x73\163\154";
                $this->cryptParams["\x63\x69\160\x68\145\162"] = "\x64\x65\163\x2d\145\x64\x65\x33\55\x63\142\143";
                $this->cryptParams["\x74\171\x70\145"] = "\x73\x79\155\x6d\145\x74\162\151\143";
                $this->cryptParams["\155\x65\x74\150\157\144"] = "\150\164\x74\160\72\57\57\167\x77\167\56\x77\63\56\x6f\162\x67\x2f\62\60\60\x31\57\60\64\x2f\x78\155\x6c\x65\x6e\143\x23\x74\x72\x69\160\154\x65\x64\x65\163\55\143\142\x63";
                $this->cryptParams["\153\x65\171\x73\151\172\x65"] = 24;
                $this->cryptParams["\x62\154\157\143\x6b\x73\151\x7a\145"] = 8;
                goto lH;
            case self::AES128_CBC:
                $this->cryptParams["\154\x69\142\162\x61\162\x79"] = "\x6f\x70\x65\x6e\x73\x73\154";
                $this->cryptParams["\x63\x69\x70\x68\x65\162"] = "\x61\x65\x73\55\61\x32\x38\55\143\x62\x63";
                $this->cryptParams["\x74\171\x70\145"] = "\x73\x79\x6d\x6d\x65\x74\x72\151\143";
                $this->cryptParams["\x6d\145\x74\x68\157\144"] = "\150\164\164\160\72\57\x2f\x77\167\167\x2e\167\x33\56\157\162\147\57\62\60\x30\61\57\x30\x34\x2f\x78\155\x6c\145\156\x63\x23\141\145\x73\61\x32\70\x2d\x63\x62\143";
                $this->cryptParams["\153\x65\171\x73\151\x7a\x65"] = 16;
                $this->cryptParams["\x62\154\157\x63\153\x73\x69\172\x65"] = 16;
                goto lH;
            case self::AES192_CBC:
                $this->cryptParams["\x6c\151\x62\x72\141\x72\x79"] = "\157\160\145\x6e\x73\x73\154";
                $this->cryptParams["\x63\151\160\150\x65\162"] = "\141\x65\x73\55\x31\x39\62\55\x63\x62\x63";
                $this->cryptParams["\164\171\160\145"] = "\x73\171\x6d\155\145\164\162\151\143";
                $this->cryptParams["\x6d\x65\164\150\x6f\144"] = "\x68\164\164\160\x3a\57\57\167\167\167\x2e\167\x33\56\x6f\x72\147\x2f\62\60\x30\x31\57\x30\x34\x2f\170\155\x6c\145\x6e\143\x23\x61\145\163\x31\71\x32\x2d\x63\142\143";
                $this->cryptParams["\153\145\171\x73\151\172\x65"] = 24;
                $this->cryptParams["\142\x6c\157\143\153\x73\151\x7a\145"] = 16;
                goto lH;
            case self::AES256_CBC:
                $this->cryptParams["\x6c\x69\x62\162\x61\162\x79"] = "\x6f\160\145\156\x73\163\x6c";
                $this->cryptParams["\143\151\160\150\145\x72"] = "\141\145\x73\x2d\x32\65\x36\x2d\143\x62\x63";
                $this->cryptParams["\x74\x79\x70\145"] = "\x73\171\155\x6d\x65\164\162\x69\x63";
                $this->cryptParams["\155\x65\x74\150\157\x64"] = "\150\164\x74\x70\x3a\x2f\x2f\167\x77\x77\x2e\167\63\x2e\157\x72\147\x2f\x32\60\60\x31\57\x30\64\x2f\170\155\154\x65\156\143\43\141\145\x73\x32\65\66\55\x63\142\x63";
                $this->cryptParams["\153\145\171\x73\x69\172\x65"] = 32;
                $this->cryptParams["\142\x6c\x6f\143\153\163\151\172\x65"] = 16;
                goto lH;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\151\x62\162\x61\162\171"] = "\157\160\145\x6e\163\163\154";
                $this->cryptParams["\x70\141\144\144\x69\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\155\x65\164\150\157\x64"] = "\x68\x74\164\160\x3a\57\57\167\x77\167\x2e\167\63\56\x6f\x72\x67\x2f\x32\x30\60\x31\x2f\60\x34\x2f\x78\x6d\x6c\145\x6e\143\x23\162\x73\x61\55\61\137\65";
                if (!(is_array($Yx) && !empty($Yx["\164\171\x70\x65"]))) {
                    goto t1;
                }
                if (!($Yx["\x74\171\160\x65"] == "\160\165\x62\154\151\x63" || $Yx["\x74\171\160\x65"] == "\x70\x72\x69\x76\141\x74\145")) {
                    goto m8;
                }
                $this->cryptParams["\x74\171\160\145"] = $Yx["\x74\171\160\x65"];
                goto lH;
                m8:
                t1:
                throw new Exception("\x43\145\162\x74\151\x66\x69\x63\x61\x74\145\x20\x22\164\171\x70\x65\42\x20\x28\x70\x72\151\x76\x61\164\145\57\160\165\142\154\151\x63\x29\40\x6d\x75\163\164\40\142\x65\x20\x70\x61\163\x73\x65\144\x20\166\x69\x61\40\160\x61\x72\141\155\145\x74\145\162\163");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\154\151\142\162\x61\162\171"] = "\x6f\160\145\x6e\163\x73\x6c";
                $this->cryptParams["\x70\x61\x64\x64\151\x6e\x67"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\155\145\x74\x68\157\144"] = "\x68\x74\164\160\x3a\57\x2f\167\167\x77\56\x77\x33\x2e\x6f\x72\147\57\x32\60\x30\61\x2f\60\64\x2f\x78\x6d\x6c\145\x6e\143\x23\162\163\141\55\157\141\x65\160\x2d\155\x67\146\61\x70";
                $this->cryptParams["\x68\x61\163\150"] = null;
                if (!(is_array($Yx) && !empty($Yx["\x74\171\160\145"]))) {
                    goto Mk;
                }
                if (!($Yx["\x74\x79\160\x65"] == "\x70\x75\x62\154\151\143" || $Yx["\164\171\160\x65"] == "\x70\162\151\166\x61\x74\x65")) {
                    goto Om;
                }
                $this->cryptParams["\x74\x79\x70\x65"] = $Yx["\164\x79\x70\x65"];
                goto lH;
                Om:
                Mk:
                throw new Exception("\x43\x65\162\x74\151\x66\x69\x63\141\x74\145\40\x22\164\x79\160\x65\x22\x20\x28\x70\x72\x69\166\x61\x74\x65\57\160\165\142\154\151\143\51\x20\155\x75\163\164\40\x62\145\x20\x70\x61\163\x73\145\x64\40\166\151\141\x20\x70\x61\162\x61\155\x65\164\145\162\x73");
            case self::RSA_SHA1:
                $this->cryptParams["\154\x69\142\x72\x61\162\171"] = "\157\160\x65\156\x73\x73\154";
                $this->cryptParams["\x6d\x65\x74\x68\157\144"] = "\150\164\x74\160\72\x2f\57\x77\x77\x77\x2e\167\x33\56\157\x72\147\x2f\x32\x30\x30\60\x2f\60\71\57\x78\155\x6c\x64\163\x69\147\43\x72\x73\141\55\x73\150\x61\61";
                $this->cryptParams["\160\141\x64\x64\x69\156\x67"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($Yx) && !empty($Yx["\x74\171\x70\x65"]))) {
                    goto A1;
                }
                if (!($Yx["\x74\171\x70\x65"] == "\x70\x75\x62\x6c\151\x63" || $Yx["\164\171\x70\x65"] == "\x70\162\x69\166\x61\164\x65")) {
                    goto nl;
                }
                $this->cryptParams["\164\x79\160\145"] = $Yx["\164\171\160\x65"];
                goto lH;
                nl:
                A1:
                throw new Exception("\103\145\162\164\151\x66\x69\x63\141\164\145\40\x22\x74\171\x70\x65\x22\40\50\x70\162\x69\166\x61\x74\x65\57\x70\165\142\x6c\151\143\x29\40\155\x75\x73\164\x20\142\x65\40\x70\x61\x73\163\145\144\x20\166\x69\141\x20\160\x61\162\141\155\x65\x74\x65\162\x73");
            case self::RSA_SHA256:
                $this->cryptParams["\x6c\x69\x62\162\x61\162\171"] = "\x6f\160\x65\156\x73\163\154";
                $this->cryptParams["\x6d\145\164\150\157\x64"] = "\x68\x74\164\x70\x3a\x2f\57\167\x77\167\x2e\x77\x33\56\x6f\x72\147\57\x32\x30\60\x31\x2f\x30\64\57\170\155\154\x64\x73\x69\147\55\x6d\x6f\162\145\x23\x72\x73\x61\x2d\x73\150\x61\62\65\x36";
                $this->cryptParams["\x70\x61\144\144\151\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\x67\145\x73\164"] = "\123\x48\101\x32\65\66";
                if (!(is_array($Yx) && !empty($Yx["\x74\171\x70\145"]))) {
                    goto R3;
                }
                if (!($Yx["\x74\171\x70\x65"] == "\160\x75\x62\x6c\x69\x63" || $Yx["\164\171\x70\x65"] == "\160\x72\x69\x76\141\164\x65")) {
                    goto yz;
                }
                $this->cryptParams["\x74\x79\x70\x65"] = $Yx["\164\171\x70\x65"];
                goto lH;
                yz:
                R3:
                throw new Exception("\103\145\162\x74\x69\146\x69\x63\x61\x74\145\40\42\x74\171\160\x65\x22\40\x28\160\x72\x69\166\x61\164\x65\x2f\160\165\x62\x6c\x69\x63\51\x20\155\165\x73\x74\40\x62\145\40\160\x61\163\163\145\x64\x20\x76\151\141\40\160\141\x72\141\x6d\x65\x74\145\x72\163");
            case self::RSA_SHA384:
                $this->cryptParams["\x6c\151\x62\x72\141\162\x79"] = "\157\x70\x65\x6e\163\163\154";
                $this->cryptParams["\x6d\145\x74\x68\157\144"] = "\x68\x74\x74\160\x3a\57\x2f\x77\167\167\56\x77\63\x2e\x6f\162\x67\57\62\x30\x30\61\57\x30\64\x2f\170\x6d\154\x64\x73\x69\147\x2d\155\x6f\x72\145\43\162\163\141\x2d\x73\150\x61\63\x38\x34";
                $this->cryptParams["\x70\x61\144\144\151\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\147\x65\x73\164"] = "\123\x48\101\x33\70\x34";
                if (!(is_array($Yx) && !empty($Yx["\164\x79\160\x65"]))) {
                    goto Rz;
                }
                if (!($Yx["\x74\x79\x70\145"] == "\x70\165\x62\154\x69\143" || $Yx["\x74\171\160\x65"] == "\x70\x72\x69\166\x61\x74\x65")) {
                    goto jJ;
                }
                $this->cryptParams["\164\171\x70\145"] = $Yx["\164\171\160\145"];
                goto lH;
                jJ:
                Rz:
                throw new Exception("\103\145\x72\x74\x69\146\x69\x63\141\x74\x65\40\42\164\171\x70\145\x22\40\50\x70\162\x69\166\x61\164\145\57\x70\x75\142\x6c\x69\x63\x29\x20\155\165\163\x74\x20\142\145\x20\x70\141\163\x73\x65\144\x20\166\x69\141\40\x70\141\162\141\155\x65\x74\x65\x72\163");
            case self::RSA_SHA512:
                $this->cryptParams["\x6c\151\142\x72\141\162\x79"] = "\x6f\x70\145\x6e\163\x73\x6c";
                $this->cryptParams["\x6d\145\164\150\157\144"] = "\150\164\164\x70\x3a\x2f\x2f\167\167\167\56\x77\x33\x2e\x6f\x72\x67\57\62\60\x30\x31\57\x30\64\57\x78\155\x6c\144\163\151\x67\55\x6d\157\x72\145\43\x72\x73\141\x2d\x73\x68\x61\x35\61\x32";
                $this->cryptParams["\x70\x61\144\x64\x69\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\147\145\x73\164"] = "\x53\110\101\65\x31\62";
                if (!(is_array($Yx) && !empty($Yx["\164\171\160\145"]))) {
                    goto lo;
                }
                if (!($Yx["\164\171\160\x65"] == "\x70\165\142\x6c\x69\x63" || $Yx["\x74\171\160\145"] == "\160\x72\151\x76\141\164\145")) {
                    goto Tl;
                }
                $this->cryptParams["\164\171\x70\145"] = $Yx["\164\171\160\145"];
                goto lH;
                Tl:
                lo:
                throw new Exception("\103\x65\x72\x74\151\x66\x69\x63\141\164\145\40\42\164\x79\160\145\x22\40\50\160\x72\x69\x76\141\x74\x65\57\x70\165\142\x6c\x69\x63\x29\40\x6d\165\163\x74\x20\142\145\x20\x70\x61\163\x73\x65\144\40\166\x69\141\x20\160\141\162\141\x6d\x65\164\145\162\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\154\x69\x62\x72\141\x72\x79"] = $NX;
                $this->cryptParams["\x6d\145\164\x68\x6f\144"] = "\x68\164\164\x70\72\57\x2f\167\167\167\56\x77\x33\x2e\x6f\162\147\57\62\x30\x30\x30\57\60\x39\57\170\x6d\x6c\144\x73\x69\147\43\150\155\141\143\x2d\163\x68\141\61";
                goto lH;
            default:
                throw new Exception("\x49\x6e\x76\141\154\x69\144\x20\113\x65\171\40\124\171\160\145");
        }
        cz:
        lH:
        $this->type = $NX;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\x6b\x65\171\x73\151\172\x65"])) {
            goto cp;
        }
        return null;
        cp:
        return $this->cryptParams["\x6b\145\x79\163\151\172\145"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\153\x65\x79\x73\151\x7a\x65"])) {
            goto GU;
        }
        throw new Exception("\125\156\153\156\157\167\156\x20\153\145\171\x20\163\x69\172\145\x20\146\157\162\40\164\x79\x70\x65\x20\x22" . $this->type . "\x22\56");
        GU:
        $Rc = $this->cryptParams["\153\145\x79\x73\151\x7a\x65"];
        $hG = openssl_random_pseudo_bytes($Rc);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto QK;
        }
        $Pg = 0;
        cH:
        if (!($Pg < strlen($hG))) {
            goto wa;
        }
        $C_ = ord($hG[$Pg]) & 0xfe;
        $Yo = 1;
        $kR = 1;
        rY:
        if (!($kR < 8)) {
            goto ze;
        }
        $Yo ^= $C_ >> $kR & 1;
        bX:
        $kR++;
        goto rY;
        ze:
        $C_ |= $Yo;
        $hG[$Pg] = chr($C_);
        eq:
        $Pg++;
        goto cH;
        wa:
        QK:
        $this->key = $hG;
        return $hG;
    }
    public static function getRawThumbprint($GJ)
    {
        $Nh = explode("\12", $GJ);
        $uq = '';
        $UG = false;
        foreach ($Nh as $Gc) {
            if (!$UG) {
                goto fe;
            }
            if (!(strncmp($Gc, "\55\x2d\55\x2d\55\105\116\x44\x20\103\105\122\x54\111\x46\111\103\x41\124\105", 20) == 0)) {
                goto Dc;
            }
            goto p2;
            Dc:
            $uq .= trim($Gc);
            goto cu;
            fe:
            if (!(strncmp($Gc, "\x2d\55\x2d\x2d\x2d\x42\x45\107\x49\116\x20\103\105\122\124\x49\106\111\103\101\x54\x45", 22) == 0)) {
                goto zs;
            }
            $UG = true;
            zs:
            cu:
            UX:
        }
        p2:
        if (empty($uq)) {
            goto zE;
        }
        return strtolower(sha1(base64_decode($uq)));
        zE:
        return null;
    }
    public function loadKey($hG, $fc = false, $QB = false)
    {
        if ($fc) {
            goto YC;
        }
        $this->key = $hG;
        goto Nq;
        YC:
        $this->key = file_get_contents($hG);
        Nq:
        if ($QB) {
            goto px;
        }
        $this->x509Certificate = null;
        goto qm;
        px:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $a9);
        $this->x509Certificate = $a9;
        $this->key = $a9;
        qm:
        if (!($this->cryptParams["\154\151\x62\x72\x61\162\171"] == "\157\x70\145\x6e\163\x73\154")) {
            goto Qp;
        }
        switch ($this->cryptParams["\x74\171\x70\x65"]) {
            case "\160\x75\142\154\151\x63":
                if (!$QB) {
                    goto nQ;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                nQ:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto q_;
                }
                throw new Exception("\x55\x6e\141\142\154\x65\x20\x74\x6f\40\x65\x78\x74\x72\x61\x63\x74\x20\x70\165\x62\154\x69\x63\40\x6b\145\171");
                q_:
                goto kj;
            case "\160\162\x69\166\141\x74\x65":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto kj;
            case "\163\x79\155\x6d\x65\x74\x72\151\143":
                if (!(strlen($this->key) < $this->cryptParams["\x6b\145\x79\163\151\172\145"])) {
                    goto P8;
                }
                throw new Exception("\x4b\x65\171\40\x6d\x75\163\164\x20\143\157\156\x74\x61\x69\156\40\x61\x74\x20\154\x65\x61\163\x74\40\x32\x35\40\143\150\x61\162\141\143\164\x65\162\x73\40\146\x6f\162\x20\164\150\x69\163\x20\x63\151\160\150\145\x72");
                P8:
                goto kj;
            default:
                throw new Exception("\x55\x6e\x6b\156\157\167\x6e\40\x74\x79\160\145");
        }
        RH:
        kj:
        Qp:
    }
    private function padISO10126($uq, $Et)
    {
        if (!($Et > 256)) {
            goto hL;
        }
        throw new Exception("\x42\154\157\x63\153\40\x73\x69\172\145\x20\x68\x69\147\x68\x65\x72\x20\x74\150\x61\156\40\x32\x35\66\40\156\157\x74\40\141\154\154\157\x77\145\x64");
        hL:
        $lm = $Et - strlen($uq) % $Et;
        $L8 = chr($lm);
        return $uq . str_repeat($L8, $lm);
    }
    private function unpadISO10126($uq)
    {
        $lm = substr($uq, -1);
        $GL = ord($lm);
        return substr($uq, 0, -$GL);
    }
    private function encryptSymmetric($uq)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\x63\151\160\150\145\x72"]));
        $uq = $this->padISO10126($uq, $this->cryptParams["\x62\x6c\157\143\x6b\x73\151\172\x65"]);
        $xE = openssl_encrypt($uq, $this->cryptParams["\143\151\x70\x68\145\x72"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $xE)) {
            goto G3;
        }
        throw new Exception("\x46\141\x69\154\165\162\145\40\x65\x6e\143\162\171\160\164\x69\156\147\x20\104\141\x74\x61\40\x28\157\160\x65\156\x73\x73\154\40\163\171\x6d\155\x65\x74\162\151\143\51\x20\x2d\40" . openssl_error_string());
        G3:
        return $this->iv . $xE;
    }
    private function decryptSymmetric($uq)
    {
        $JU = openssl_cipher_iv_length($this->cryptParams["\x63\151\x70\x68\x65\162"]);
        $this->iv = substr($uq, 0, $JU);
        $uq = substr($uq, $JU);
        $ZZ = openssl_decrypt($uq, $this->cryptParams["\143\x69\x70\x68\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $ZZ)) {
            goto El;
        }
        throw new Exception("\106\141\151\x6c\x75\162\145\x20\144\145\143\x72\171\160\x74\x69\x6e\x67\40\x44\141\164\141\x20\x28\x6f\160\145\x6e\x73\x73\x6c\x20\163\x79\x6d\x6d\145\164\x72\151\x63\x29\x20\x2d\x20" . openssl_error_string());
        El:
        return $this->unpadISO10126($ZZ);
    }
    private function encryptPublic($uq)
    {
        if (openssl_public_encrypt($uq, $xE, $this->key, $this->cryptParams["\x70\x61\x64\144\151\156\147"])) {
            goto gV;
        }
        throw new Exception("\106\141\x69\154\165\x72\145\40\145\x6e\143\162\x79\160\164\151\156\x67\40\x44\141\164\x61\40\50\157\160\x65\x6e\163\x73\154\x20\x70\x75\142\154\151\143\x29\40\55\x20" . openssl_error_string());
        gV:
        return $xE;
    }
    private function decryptPublic($uq)
    {
        if (openssl_public_decrypt($uq, $ZZ, $this->key, $this->cryptParams["\x70\x61\x64\144\x69\156\x67"])) {
            goto NF;
        }
        throw new Exception("\106\141\151\x6c\x75\x72\x65\40\144\x65\143\162\x79\160\164\x69\156\x67\x20\x44\141\x74\141\40\50\157\x70\x65\x6e\163\163\x6c\40\160\x75\142\x6c\151\x63\51\40\x2d\x20" . openssl_error_string);
        NF:
        return $ZZ;
    }
    private function encryptPrivate($uq)
    {
        if (openssl_private_encrypt($uq, $xE, $this->key, $this->cryptParams["\160\141\144\144\x69\156\x67"])) {
            goto Wr;
        }
        throw new Exception("\106\x61\x69\154\x75\x72\x65\40\145\x6e\143\162\x79\x70\164\151\156\147\40\x44\x61\164\141\40\x28\x6f\x70\x65\x6e\x73\163\154\40\160\x72\151\x76\141\x74\x65\x29\40\x2d\x20" . openssl_error_string());
        Wr:
        return $xE;
    }
    private function decryptPrivate($uq)
    {
        if (openssl_private_decrypt($uq, $ZZ, $this->key, $this->cryptParams["\x70\141\144\x64\x69\156\x67"])) {
            goto d6;
        }
        throw new Exception("\106\141\x69\154\165\162\x65\x20\144\145\x63\x72\x79\x70\x74\151\156\147\x20\x44\x61\164\141\x20\x28\157\x70\x65\156\163\163\x6c\40\160\x72\x69\166\141\164\145\x29\40\x2d\40" . openssl_error_string);
        d6:
        return $ZZ;
    }
    private function signOpenSSL($uq)
    {
        $jK = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\x67\145\163\164"])) {
            goto EB;
        }
        $jK = $this->cryptParams["\144\151\147\x65\163\x74"];
        EB:
        if (openssl_sign($uq, $lv, $this->key, $jK)) {
            goto o9;
        }
        throw new Exception("\x46\x61\x69\x6c\165\162\x65\x20\123\x69\147\x6e\151\156\x67\x20\x44\141\x74\141\x3a\40" . openssl_error_string() . "\40\x2d\40" . $jK);
        o9:
        return $lv;
    }
    private function verifyOpenSSL($uq, $lv)
    {
        $jK = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\x67\x65\163\164"])) {
            goto q8;
        }
        $jK = $this->cryptParams["\144\151\147\x65\163\164"];
        q8:
        return openssl_verify($uq, $lv, $this->key, $jK);
    }
    public function encryptData($uq)
    {
        if (!($this->cryptParams["\x6c\151\142\162\x61\162\x79"] === "\x6f\x70\x65\x6e\163\163\154")) {
            goto mb;
        }
        switch ($this->cryptParams["\164\171\160\x65"]) {
            case "\x73\x79\x6d\x6d\x65\164\x72\151\143":
                return $this->encryptSymmetric($uq);
            case "\x70\165\x62\154\151\143":
                return $this->encryptPublic($uq);
            case "\x70\x72\151\166\141\164\145":
                return $this->encryptPrivate($uq);
        }
        pS:
        W7:
        mb:
    }
    public function decryptData($uq)
    {
        if (!($this->cryptParams["\154\x69\x62\x72\x61\162\171"] === "\157\x70\145\156\163\x73\x6c")) {
            goto iE;
        }
        switch ($this->cryptParams["\x74\x79\x70\x65"]) {
            case "\x73\x79\x6d\155\x65\164\x72\x69\143":
                return $this->decryptSymmetric($uq);
            case "\x70\x75\x62\154\151\x63":
                return $this->decryptPublic($uq);
            case "\160\x72\151\x76\x61\x74\x65":
                return $this->decryptPrivate($uq);
        }
        BJ:
        Rs:
        iE:
    }
    public function signData($uq)
    {
        switch ($this->cryptParams["\154\x69\142\x72\141\x72\171"]) {
            case "\157\x70\145\156\x73\163\154":
                return $this->signOpenSSL($uq);
            case self::HMAC_SHA1:
                return hash_hmac("\x73\x68\141\61", $uq, $this->key, true);
        }
        bz:
        uR:
    }
    public function verifySignature($uq, $lv)
    {
        switch ($this->cryptParams["\154\151\x62\x72\141\162\x79"]) {
            case "\157\160\145\156\x73\x73\x6c":
                return $this->verifyOpenSSL($uq, $lv);
            case self::HMAC_SHA1:
                $pl = hash_hmac("\163\x68\x61\x31", $uq, $this->key, true);
                return strcmp($lv, $pl) == 0;
        }
        UP:
        fH:
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\x6d\145\x74\x68\x6f\144"];
    }
    public static function makeAsnSegment($NX, $xD)
    {
        switch ($NX) {
            case 0x2:
                if (!(ord($xD) > 0x7f)) {
                    goto pZ;
                }
                $xD = chr(0) . $xD;
                pZ:
                goto nt;
            case 0x3:
                $xD = chr(0) . $xD;
                goto nt;
        }
        qA:
        nt:
        $L3 = strlen($xD);
        if ($L3 < 128) {
            goto Os;
        }
        if ($L3 < 0x100) {
            goto Km;
        }
        if ($L3 < 0x10000) {
            goto jD;
        }
        $Mt = null;
        goto uD;
        jD:
        $Mt = sprintf("\x25\x63\x25\x63\x25\x63\x25\143\45\x73", $NX, 0x82, $L3 / 0x100, $L3 % 0x100, $xD);
        uD:
        goto Po;
        Km:
        $Mt = sprintf("\x25\x63\45\143\45\x63\45\163", $NX, 0x81, $L3, $xD);
        Po:
        goto xD;
        Os:
        $Mt = sprintf("\45\143\45\143\x25\x73", $NX, $L3, $xD);
        xD:
        return $Mt;
    }
    public static function convertRSA($JB, $DB)
    {
        $e7 = self::makeAsnSegment(0x2, $DB);
        $Zb = self::makeAsnSegment(0x2, $JB);
        $IG = self::makeAsnSegment(0x30, $Zb . $e7);
        $eG = self::makeAsnSegment(0x3, $IG);
        $Jd = pack("\x48\52", "\x33\60\x30\x44\x30\x36\60\x39\x32\101\x38\x36\x34\x38\x38\66\106\x37\60\x44\x30\61\x30\x31\60\61\x30\x35\x30\x30");
        $MR = self::makeAsnSegment(0x30, $Jd . $eG);
        $lB = base64_encode($MR);
        $IU = "\x2d\x2d\55\x2d\x2d\102\x45\107\x49\116\x20\x50\125\x42\114\111\103\x20\113\x45\131\x2d\55\55\x2d\x2d\xa";
        $iQ = 0;
        Lz:
        if (!($Ri = substr($lB, $iQ, 64))) {
            goto Ge;
        }
        $IU = $IU . $Ri . "\12";
        $iQ += 64;
        goto Lz;
        Ge:
        return $IU . "\55\x2d\x2d\55\x2d\105\116\x44\40\x50\125\x42\114\x49\103\40\113\105\x59\55\55\x2d\55\55\xa";
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $y0)
    {
        $Jq = new XMLSecEnc();
        $Jq->setNode($y0);
        if ($Yl = $Jq->locateKey()) {
            goto m1;
        }
        throw new Exception("\x55\156\x61\142\154\145\x20\x74\x6f\x20\x6c\x6f\143\x61\164\145\40\141\x6c\147\157\162\x69\164\x68\x6d\40\146\x6f\x72\40\x74\150\151\163\40\105\156\143\x72\x79\160\164\145\144\x20\113\145\x79");
        m1:
        $Yl->isEncrypted = true;
        $Yl->encryptedCtx = $Jq;
        XMLSecEnc::staticLocateKeyInfo($Yl, $y0);
        return $Yl;
    }
}
class XMLSecurityDSig
{
    const XMLDSIGNS = "\150\x74\x74\x70\x3a\57\57\x77\x77\167\56\x77\63\x2e\157\162\x67\x2f\x32\60\x30\60\x2f\x30\x39\x2f\170\155\x6c\144\163\x69\147\43";
    const SHA1 = "\150\164\164\160\x3a\x2f\57\167\167\167\x2e\x77\63\x2e\x6f\x72\147\x2f\62\x30\60\60\57\x30\x39\x2f\x78\155\x6c\x64\x73\x69\x67\43\x73\x68\141\61";
    const SHA256 = "\150\x74\164\x70\x3a\57\x2f\167\x77\167\x2e\167\63\56\157\162\147\x2f\62\x30\x30\x31\x2f\x30\64\57\170\155\154\x65\x6e\143\43\163\150\141\62\x35\66";
    const SHA384 = "\150\164\x74\160\x3a\x2f\57\167\167\167\56\167\63\x2e\157\162\x67\x2f\62\x30\60\x31\57\x30\x34\x2f\x78\x6d\x6c\x64\x73\x69\147\55\x6d\x6f\x72\145\43\x73\x68\x61\63\x38\x34";
    const SHA512 = "\x68\x74\164\160\72\57\x2f\167\x77\167\56\167\63\56\x6f\162\x67\57\62\x30\x30\61\57\60\64\57\170\155\154\145\156\x63\x23\163\x68\x61\x35\x31\62";
    const RIPEMD160 = "\x68\164\164\x70\72\x2f\x2f\167\167\x77\x2e\x77\63\x2e\157\162\147\57\62\60\x30\x31\x2f\x30\64\x2f\170\155\x6c\145\x6e\143\x23\x72\151\x70\x65\x6d\x64\x31\66\60";
    const C14N = "\150\164\164\x70\72\57\57\x77\167\x77\x2e\x77\x33\x2e\x6f\162\x67\x2f\124\x52\57\62\60\60\61\57\x52\105\x43\x2d\x78\155\154\55\x63\61\64\156\55\x32\x30\60\61\60\x33\61\65";
    const C14N_COMMENTS = "\x68\x74\x74\x70\72\57\x2f\167\167\167\56\167\63\56\x6f\162\147\x2f\x54\122\x2f\x32\x30\60\x31\57\122\x45\x43\x2d\x78\155\x6c\55\143\x31\64\156\55\x32\60\60\61\x30\x33\x31\65\x23\x57\x69\164\150\x43\x6f\x6d\155\145\156\164\x73";
    const EXC_C14N = "\150\164\164\160\72\57\x2f\167\167\167\x2e\167\x33\56\x6f\162\147\57\x32\60\x30\x31\57\x31\x30\57\170\155\x6c\55\x65\x78\143\55\143\x31\64\156\43";
    const EXC_C14N_COMMENTS = "\x68\x74\x74\160\x3a\x2f\57\167\x77\x77\56\167\63\56\x6f\162\x67\57\x32\60\60\x31\57\x31\60\x2f\x78\155\x6c\x2d\x65\x78\x63\55\x63\61\x34\x6e\43\127\x69\x74\x68\103\157\x6d\155\x65\x6e\x74\163";
    const template = "\74\144\163\72\x53\151\147\156\141\x74\165\x72\145\40\170\155\x6c\156\163\72\x64\163\x3d\x22\150\164\x74\160\72\57\57\167\167\x77\x2e\167\63\56\157\162\147\x2f\x32\x30\x30\x30\57\x30\71\x2f\170\x6d\154\x64\x73\151\147\43\42\76\xd\12\x20\40\74\144\163\x3a\x53\151\x67\x6e\145\144\111\x6e\x66\157\76\15\12\40\x20\40\x20\x3c\x64\x73\72\x53\151\x67\x6e\141\164\165\x72\145\x4d\x65\x74\x68\x6f\x64\40\57\76\15\12\x20\40\74\57\144\163\72\123\151\x67\156\x65\x64\111\x6e\146\157\x3e\xd\12\74\x2f\144\163\x3a\x53\x69\x67\x6e\141\x74\165\x72\145\76";
    const BASE_TEMPLATE = "\74\123\151\x67\156\x61\164\165\x72\x65\40\x78\x6d\154\156\x73\x3d\42\150\164\164\x70\x3a\57\x2f\x77\x77\x77\x2e\167\x33\x2e\157\x72\147\57\62\60\x30\60\x2f\60\71\x2f\170\x6d\154\x64\x73\151\147\43\42\x3e\xd\12\x20\40\74\x53\x69\x67\x6e\x65\144\111\156\x66\157\76\15\xa\x20\x20\40\40\74\x53\x69\147\x6e\x61\164\165\x72\145\115\145\x74\x68\157\x64\40\57\x3e\xd\12\x20\x20\x3c\x2f\x53\151\147\156\145\x64\x49\x6e\146\157\x3e\xd\xa\74\57\x53\151\147\156\x61\164\165\162\x65\76";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\x73\145\143\144\x73\151\147";
    private $validatedNodes = null;
    public function __construct($GD = "\x64\163")
    {
        $Tf = self::BASE_TEMPLATE;
        if (empty($GD)) {
            goto at;
        }
        $this->prefix = $GD . "\72";
        $um = array("\74\x53", "\x3c\x2f\x53", "\x78\x6d\154\156\163\x3d");
        $rx = array("\x3c{$GD}\72\x53", "\x3c\57{$GD}\x3a\123", "\x78\x6d\x6c\x6e\163\72{$GD}\x3d");
        $Tf = str_replace($um, $rx, $Tf);
        at:
        $HP = new DOMDocument();
        $HP->loadXML($Tf);
        $this->sigNode = $HP->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto Fx;
        }
        $c1 = new DOMXPath($this->sigNode->ownerDocument);
        $c1->registerNamespace("\163\x65\x63\x64\163\x69\x67", self::XMLDSIGNS);
        $this->xPathCtx = $c1;
        Fx:
        return $this->xPathCtx;
    }
    public static function generateGUID($GD = "\x70\146\x78")
    {
        $pc = md5(uniqid(mt_rand(), true));
        $XG = $GD . substr($pc, 0, 8) . "\x2d" . substr($pc, 8, 4) . "\55" . substr($pc, 12, 4) . "\x2d" . substr($pc, 16, 4) . "\55" . substr($pc, 20, 12);
        return $XG;
    }
    public static function generate_GUID($GD = "\x70\x66\x78")
    {
        return self::generateGUID($GD);
    }
    public function locateSignature($hy, $Qk = 0)
    {
        if ($hy instanceof DOMDocument) {
            goto je;
        }
        $FU = $hy->ownerDocument;
        goto eW;
        je:
        $FU = $hy;
        eW:
        if (!$FU) {
            goto uv;
        }
        $c1 = new DOMXPath($FU);
        $c1->registerNamespace("\163\145\143\144\163\151\147", self::XMLDSIGNS);
        $PI = "\x2e\x2f\x2f\x73\x65\x63\144\163\x69\147\72\123\x69\147\x6e\x61\164\165\162\x65";
        $E5 = $c1->query($PI, $hy);
        $this->sigNode = $E5->item($Qk);
        return $this->sigNode;
        uv:
        return null;
    }
    public function createNewSignNode($GZ, $Er = null)
    {
        $FU = $this->sigNode->ownerDocument;
        if (!is_null($Er)) {
            goto cO;
        }
        $fr = $FU->createElementNS(self::XMLDSIGNS, $this->prefix . $GZ);
        goto QC;
        cO:
        $fr = $FU->createElementNS(self::XMLDSIGNS, $this->prefix . $GZ, $Er);
        QC:
        return $fr;
    }
    public function setCanonicalMethod($R2)
    {
        switch ($R2) {
            case "\x68\x74\164\160\72\57\57\167\x77\167\x2e\x77\63\x2e\157\x72\x67\57\x54\x52\57\x32\x30\x30\61\57\x52\105\x43\55\x78\x6d\154\x2d\x63\61\64\156\x2d\62\60\60\x31\x30\63\61\65":
            case "\150\x74\164\x70\x3a\x2f\x2f\x77\x77\167\x2e\167\x33\x2e\x6f\x72\147\x2f\x54\x52\57\62\x30\60\x31\57\x52\x45\x43\x2d\x78\155\154\x2d\x63\61\64\x6e\55\62\x30\x30\61\x30\63\61\x35\x23\x57\151\164\x68\x43\157\155\x6d\x65\156\164\x73":
            case "\x68\164\164\160\72\x2f\57\167\x77\x77\x2e\167\63\x2e\157\x72\x67\x2f\x32\x30\60\61\57\x31\60\x2f\170\155\x6c\55\x65\x78\143\x2d\143\61\64\x6e\x23":
            case "\150\x74\x74\x70\x3a\x2f\57\x77\x77\167\x2e\167\63\x2e\x6f\x72\147\x2f\x32\x30\60\x31\57\61\60\57\170\155\x6c\x2d\x65\170\143\55\x63\x31\64\156\43\127\x69\164\150\x43\x6f\155\155\145\x6e\164\x73":
                $this->canonicalMethod = $R2;
                goto JL;
            default:
                throw new Exception("\x49\x6e\x76\141\x6c\151\144\x20\x43\141\156\x6f\156\151\143\141\x6c\40\115\x65\164\150\x6f\x64");
        }
        yP:
        JL:
        if (!($c1 = $this->getXPathObj())) {
            goto F0;
        }
        $PI = "\56\x2f" . $this->searchpfx . "\72\x53\151\x67\x6e\145\x64\111\x6e\146\x6f";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($d0 = $E5->item(0))) {
            goto r4;
        }
        $PI = "\x2e\57" . $this->searchpfx . "\103\x61\156\x6f\x6e\151\x63\x61\x6c\x69\172\141\x74\x69\x6f\x6e\x4d\145\x74\x68\x6f\144";
        $E5 = $c1->query($PI, $d0);
        if ($yA = $E5->item(0)) {
            goto zL;
        }
        $yA = $this->createNewSignNode("\x43\x61\156\157\x6e\x69\143\141\x6c\151\172\141\x74\x69\x6f\156\x4d\x65\164\x68\157\144");
        $d0->insertBefore($yA, $d0->firstChild);
        zL:
        $yA->setAttribute("\101\154\147\157\162\x69\x74\150\x6d", $this->canonicalMethod);
        r4:
        F0:
    }
    private function canonicalizeData($fr, $cN, $vO = null, $Mc = null)
    {
        $mH = false;
        $SM = false;
        switch ($cN) {
            case "\x68\164\x74\x70\72\57\57\x77\x77\167\x2e\x77\63\x2e\x6f\x72\147\57\124\122\57\62\60\x30\x31\x2f\122\x45\103\55\170\x6d\x6c\55\143\x31\x34\x6e\x2d\x32\x30\60\61\x30\63\x31\65":
                $mH = false;
                $SM = false;
                goto O4;
            case "\x68\x74\164\x70\72\57\57\167\167\x77\x2e\x77\63\x2e\157\162\147\x2f\124\122\x2f\62\x30\60\x31\57\122\x45\103\55\170\155\x6c\x2d\143\61\x34\x6e\x2d\x32\60\x30\x31\x30\63\x31\x35\43\127\x69\164\x68\x43\157\x6d\x6d\x65\156\164\x73":
                $SM = true;
                goto O4;
            case "\x68\x74\x74\160\x3a\57\x2f\167\x77\x77\56\x77\63\x2e\x6f\x72\x67\57\x32\60\x30\x31\x2f\61\60\x2f\x78\x6d\154\55\145\x78\x63\55\x63\x31\x34\x6e\43":
                $mH = true;
                goto O4;
            case "\x68\164\x74\160\x3a\x2f\57\x77\x77\167\x2e\x77\63\56\157\162\x67\x2f\x32\60\x30\61\x2f\61\60\x2f\170\x6d\154\55\x65\x78\143\x2d\143\61\x34\x6e\x23\127\x69\164\150\103\157\x6d\155\145\156\164\163":
                $mH = true;
                $SM = true;
                goto O4;
        }
        Lu:
        O4:
        if (!(is_null($vO) && $fr instanceof DOMNode && $fr->ownerDocument !== null && $fr->isSameNode($fr->ownerDocument->documentElement))) {
            goto bR;
        }
        $y0 = $fr;
        gz:
        if (!($sm = $y0->previousSibling)) {
            goto X7;
        }
        if (!($sm->nodeType == XML_PI_NODE || $sm->nodeType == XML_COMMENT_NODE && $SM)) {
            goto o2;
        }
        goto X7;
        o2:
        $y0 = $sm;
        goto gz;
        X7:
        if (!($sm == null)) {
            goto lw;
        }
        $fr = $fr->ownerDocument;
        lw:
        bR:
        return $fr->C14N($mH, $SM, $vO, $Mc);
    }
    public function canonicalizeSignedInfo()
    {
        $FU = $this->sigNode->ownerDocument;
        $cN = null;
        if (!$FU) {
            goto lc;
        }
        $c1 = $this->getXPathObj();
        $PI = "\56\57\x73\x65\x63\x64\163\151\x67\x3a\x53\x69\147\x6e\x65\x64\111\x6e\146\157";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($E2 = $E5->item(0))) {
            goto KE;
        }
        $PI = "\x2e\x2f\163\x65\x63\x64\x73\x69\147\x3a\x43\x61\x6e\157\x6e\x69\143\141\x6c\x69\172\141\x74\x69\157\156\x4d\x65\x74\x68\157\x64";
        $E5 = $c1->query($PI, $E2);
        if (!($yA = $E5->item(0))) {
            goto sg;
        }
        $cN = $yA->getAttribute("\x41\154\x67\x6f\x72\151\x74\x68\155");
        sg:
        $this->signedInfo = $this->canonicalizeData($E2, $cN);
        return $this->signedInfo;
        KE:
        lc:
        return null;
    }
    public function calculateDigest($Fv, $uq, $sL = true)
    {
        switch ($Fv) {
            case self::SHA1:
                $iV = "\163\150\141\x31";
                goto dn;
            case self::SHA256:
                $iV = "\163\150\141\62\x35\x36";
                goto dn;
            case self::SHA384:
                $iV = "\x73\150\x61\63\x38\x34";
                goto dn;
            case self::SHA512:
                $iV = "\163\x68\x61\65\x31\62";
                goto dn;
            case self::RIPEMD160:
                $iV = "\x72\x69\160\145\155\x64\x31\x36\x30";
                goto dn;
            default:
                throw new Exception("\103\x61\x6e\x6e\157\164\40\x76\141\154\151\144\x61\x74\145\x20\144\151\x67\145\x73\164\72\x20\x55\156\163\x75\x70\160\x6f\x72\164\x65\144\40\101\x6c\147\x6f\x72\151\x74\x68\155\x20\x3c{$Fv}\76");
        }
        Cv:
        dn:
        $N9 = hash($iV, $uq, true);
        if (!$sL) {
            goto yo;
        }
        $N9 = base64_encode($N9);
        yo:
        return $N9;
    }
    public function validateDigest($nd, $uq)
    {
        $c1 = new DOMXPath($nd->ownerDocument);
        $c1->registerNamespace("\x73\145\x63\144\163\x69\147", self::XMLDSIGNS);
        $PI = "\x73\x74\x72\151\156\x67\x28\56\x2f\x73\x65\x63\x64\x73\x69\x67\x3a\x44\x69\147\145\163\164\115\x65\164\x68\157\x64\x2f\x40\x41\154\x67\157\162\151\164\x68\155\51";
        $Fv = $c1->evaluate($PI, $nd);
        $z0 = $this->calculateDigest($Fv, $uq, false);
        $PI = "\x73\164\x72\x69\x6e\x67\50\56\x2f\x73\x65\x63\x64\163\151\x67\x3a\104\x69\x67\145\x73\164\126\141\154\x75\145\51";
        $J5 = $c1->evaluate($PI, $nd);
        return $z0 == base64_decode($J5);
    }
    public function processTransforms($nd, $OD, $dv = true)
    {
        $uq = $OD;
        $c1 = new DOMXPath($nd->ownerDocument);
        $c1->registerNamespace("\163\x65\143\x64\x73\x69\x67", self::XMLDSIGNS);
        $PI = "\56\57\x73\145\x63\144\163\151\x67\72\x54\x72\141\156\x73\146\x6f\162\155\163\57\163\145\x63\144\163\151\x67\72\124\162\141\x6e\x73\146\x6f\x72\x6d";
        $L6 = $c1->query($PI, $nd);
        $yR = "\x68\x74\164\160\72\57\57\167\167\x77\56\x77\63\x2e\x6f\162\147\x2f\124\x52\x2f\x32\60\x30\61\x2f\122\x45\x43\55\x78\x6d\154\55\143\x31\x34\156\55\x32\x30\60\61\x30\63\x31\x35";
        $vO = null;
        $Mc = null;
        foreach ($L6 as $X0) {
            $em = $X0->getAttribute("\101\154\x67\157\x72\151\164\x68\x6d");
            switch ($em) {
                case "\150\x74\164\x70\72\x2f\57\x77\x77\x77\56\x77\x33\56\157\162\147\x2f\x32\60\60\x31\x2f\x31\x30\57\170\x6d\154\55\145\x78\143\x2d\x63\x31\x34\x6e\x23":
                case "\150\x74\164\160\x3a\x2f\x2f\x77\x77\167\x2e\x77\x33\x2e\157\x72\147\57\x32\60\x30\61\57\61\x30\x2f\x78\x6d\x6c\x2d\145\170\x63\x2d\143\x31\x34\x6e\x23\127\151\164\150\103\x6f\155\x6d\145\156\x74\x73":
                    if (!$dv) {
                        goto es;
                    }
                    $yR = $em;
                    goto ir;
                    es:
                    $yR = "\x68\164\164\160\72\57\57\x77\x77\167\56\x77\x33\56\x6f\x72\x67\57\x32\60\60\x31\x2f\x31\60\x2f\x78\155\x6c\x2d\145\x78\x63\x2d\143\x31\x34\156\x23";
                    ir:
                    $fr = $X0->firstChild;
                    cI:
                    if (!$fr) {
                        goto g_;
                    }
                    if (!($fr->localName == "\x49\x6e\143\x6c\165\x73\151\x76\145\116\x61\155\x65\x73\x70\x61\x63\145\x73")) {
                        goto sO;
                    }
                    if (!($dJ = $fr->getAttribute("\x50\x72\x65\146\151\x78\114\x69\x73\164"))) {
                        goto qc;
                    }
                    $SE = array();
                    $xw = explode("\40", $dJ);
                    foreach ($xw as $dJ) {
                        $fT = trim($dJ);
                        if (empty($fT)) {
                            goto yv;
                        }
                        $SE[] = $fT;
                        yv:
                        V5:
                    }
                    re:
                    if (!(count($SE) > 0)) {
                        goto ZS;
                    }
                    $Mc = $SE;
                    ZS:
                    qc:
                    goto g_;
                    sO:
                    $fr = $fr->nextSibling;
                    goto cI;
                    g_:
                    goto Hl;
                case "\x68\x74\x74\x70\72\57\x2f\x77\167\x77\x2e\x77\63\56\157\x72\147\57\124\122\x2f\x32\60\x30\61\x2f\x52\105\103\55\170\x6d\154\55\x63\61\64\x6e\x2d\62\60\60\x31\x30\x33\61\x35":
                case "\x68\164\164\160\72\57\57\x77\167\167\56\167\x33\x2e\157\x72\x67\x2f\124\122\57\x32\60\60\x31\x2f\122\x45\x43\55\x78\155\x6c\55\143\61\x34\x6e\x2d\62\60\60\x31\x30\x33\x31\x35\x23\127\x69\164\150\103\157\x6d\155\145\x6e\164\163":
                    if (!$dv) {
                        goto il;
                    }
                    $yR = $em;
                    goto v9;
                    il:
                    $yR = "\x68\164\x74\x70\x3a\57\57\167\167\167\x2e\x77\63\x2e\x6f\162\x67\x2f\x54\122\57\x32\60\60\61\57\122\x45\x43\x2d\170\x6d\154\x2d\x63\x31\x34\156\55\62\x30\60\61\60\63\x31\65";
                    v9:
                    goto Hl;
                case "\150\164\x74\x70\x3a\x2f\x2f\x77\167\167\x2e\x77\63\x2e\157\162\x67\57\124\122\57\x31\x39\71\x39\x2f\122\105\x43\x2d\170\x70\x61\164\x68\55\61\x39\x39\x39\x31\x31\x31\x36":
                    $fr = $X0->firstChild;
                    UI:
                    if (!$fr) {
                        goto Dl;
                    }
                    if (!($fr->localName == "\x58\120\x61\x74\x68")) {
                        goto LQ;
                    }
                    $vO = array();
                    $vO["\x71\165\x65\x72\171"] = "\50\x2e\x2f\x2f\x2e\x20\174\x20\x2e\57\x2f\x40\52\x20\x7c\40\x2e\57\57\156\141\x6d\x65\x73\160\x61\x63\x65\72\72\x2a\x29\x5b" . $fr->nodeValue . "\x5d";
                    $Qj["\156\141\x6d\x65\x73\x70\x61\x63\145\x73"] = array();
                    $PO = $c1->query("\56\57\x6e\x61\155\x65\x73\x70\141\143\x65\72\72\x2a", $fr);
                    foreach ($PO as $ef) {
                        if (!($ef->localName != "\170\155\154")) {
                            goto tD;
                        }
                        $vO["\x6e\141\155\x65\x73\x70\x61\143\x65\x73"][$ef->localName] = $ef->nodeValue;
                        tD:
                        Xc:
                    }
                    yn:
                    goto Dl;
                    LQ:
                    $fr = $fr->nextSibling;
                    goto UI;
                    Dl:
                    goto Hl;
            }
            R9:
            Hl:
            ib:
        }
        kZ:
        if (!$uq instanceof DOMElement) {
            goto bY;
        }
        $uq = $this->canonicalizeData($OD, $yR, $vO, $Mc);
        bY:
        return $uq;
    }
    public function processRefNode($nd)
    {
        $cP = null;
        $dv = true;
        if ($kM = $nd->getAttribute("\x55\122\x49")) {
            goto gW;
        }
        $dv = false;
        $cP = $nd->ownerDocument;
        goto NZ;
        gW:
        $m0 = parse_url($kM);
        if (empty($m0["\160\x61\x74\x68"])) {
            goto c0;
        }
        $cP = file_get_contents($m0);
        goto Uq;
        c0:
        if ($PW = $m0["\x66\162\x61\x67\155\145\156\x74"]) {
            goto Dj;
        }
        $cP = $nd->ownerDocument;
        goto Ha;
        Dj:
        $dv = false;
        $Sp = new DOMXPath($nd->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto OH;
        }
        foreach ($this->idNS as $yQ => $pE) {
            $Sp->registerNamespace($yQ, $pE);
            R0:
        }
        Uy:
        OH:
        $wI = "\x40\x49\144\75\x22" . $PW . "\x22";
        if (!is_array($this->idKeys)) {
            goto IS;
        }
        foreach ($this->idKeys as $Mb) {
            $wI .= "\40\157\x72\40\100{$Mb}\x3d\47{$PW}\47";
            FQ:
        }
        Q1:
        IS:
        $PI = "\x2f\57\52\x5b" . $wI . "\x5d";
        $cP = $Sp->query($PI)->item(0);
        Ha:
        Uq:
        NZ:
        $uq = $this->processTransforms($nd, $cP, $dv);
        if ($this->validateDigest($nd, $uq)) {
            goto ni;
        }
        return false;
        ni:
        if (!$cP instanceof DOMElement) {
            goto Xo;
        }
        if (!empty($PW)) {
            goto X0;
        }
        $this->validatedNodes[] = $cP;
        goto U6;
        X0:
        $this->validatedNodes[$PW] = $cP;
        U6:
        Xo:
        return true;
    }
    public function getRefNodeID($nd)
    {
        if (!($kM = $nd->getAttribute("\x55\x52\x49"))) {
            goto MT;
        }
        $m0 = parse_url($kM);
        if (!empty($m0["\160\141\164\x68"])) {
            goto Ls;
        }
        if (!($PW = $m0["\x66\162\x61\x67\155\x65\x6e\x74"])) {
            goto Hx;
        }
        return $PW;
        Hx:
        Ls:
        MT:
        return null;
    }
    public function getRefIDs()
    {
        $L1 = array();
        $c1 = $this->getXPathObj();
        $PI = "\x2e\57\163\x65\x63\144\163\x69\147\x3a\x53\151\147\x6e\145\x64\111\156\146\157\57\163\145\x63\144\x73\x69\x67\x3a\122\145\x66\145\x72\145\x6e\143\145";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($E5->length == 0)) {
            goto yW;
        }
        throw new Exception("\122\145\x66\145\x72\x65\156\143\x65\40\156\x6f\144\145\163\x20\x6e\157\x74\40\x66\x6f\x75\x6e\144");
        yW:
        foreach ($E5 as $nd) {
            $L1[] = $this->getRefNodeID($nd);
            W8:
        }
        EH:
        return $L1;
    }
    public function validateReference()
    {
        $ch = $this->sigNode->ownerDocument->documentElement;
        if ($ch->isSameNode($this->sigNode)) {
            goto dG;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto jk;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        jk:
        dG:
        $c1 = $this->getXPathObj();
        $PI = "\56\x2f\163\x65\143\144\x73\151\x67\72\123\151\x67\x6e\x65\x64\x49\156\146\x6f\57\163\x65\x63\144\x73\151\147\72\122\145\146\145\162\x65\x6e\143\x65";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($E5->length == 0)) {
            goto AG;
        }
        throw new Exception("\122\x65\146\145\x72\145\x6e\x63\x65\40\x6e\x6f\x64\145\x73\x20\x6e\157\x74\40\146\x6f\x75\x6e\x64");
        AG:
        $this->validatedNodes = array();
        foreach ($E5 as $nd) {
            if ($this->processRefNode($nd)) {
                goto Cj;
            }
            $this->validatedNodes = null;
            throw new Exception("\x52\x65\x66\x65\x72\145\x6e\143\x65\40\x76\141\154\151\144\x61\164\151\157\x6e\40\x66\141\151\x6c\145\x64");
            Cj:
            JK:
        }
        ey:
        return true;
    }
    private function addRefInternal($TI, $fr, $em, $Gl = null, $B0 = null)
    {
        $GD = null;
        $j_ = null;
        $O8 = "\x49\x64";
        $k4 = true;
        $yf = false;
        if (!is_array($B0)) {
            goto fB;
        }
        $GD = empty($B0["\160\x72\x65\146\x69\x78"]) ? null : $B0["\x70\x72\145\x66\x69\170"];
        $j_ = empty($B0["\x70\x72\145\x66\151\170\137\x6e\x73"]) ? null : $B0["\x70\162\x65\x66\x69\x78\137\x6e\x73"];
        $O8 = empty($B0["\x69\144\x5f\x6e\141\x6d\145"]) ? "\111\x64" : $B0["\x69\x64\x5f\x6e\x61\x6d\x65"];
        $k4 = !isset($B0["\x6f\166\145\162\167\x72\151\x74\145"]) ? true : (bool) $B0["\x6f\166\145\x72\x77\162\151\164\145"];
        $yf = !isset($B0["\x66\x6f\x72\x63\x65\137\x75\x72\x69"]) ? false : (bool) $B0["\x66\157\162\x63\145\x5f\165\x72\x69"];
        fB:
        $Gi = $O8;
        if (empty($GD)) {
            goto hW;
        }
        $Gi = $GD . "\72" . $Gi;
        hW:
        $nd = $this->createNewSignNode("\x52\145\146\x65\x72\x65\156\x63\x65");
        $TI->appendChild($nd);
        if (!$fr instanceof DOMDocument) {
            goto tC;
        }
        if ($yf) {
            goto it;
        }
        goto EW;
        tC:
        $kM = null;
        if ($k4) {
            goto n1;
        }
        $kM = $j_ ? $fr->getAttributeNS($j_, $O8) : $fr->getAttribute($O8);
        n1:
        if (!empty($kM)) {
            goto gy;
        }
        $kM = self::generateGUID();
        $fr->setAttributeNS($j_, $Gi, $kM);
        gy:
        $nd->setAttribute("\x55\122\x49", "\x23" . $kM);
        goto EW;
        it:
        $nd->setAttribute("\x55\x52\111", '');
        EW:
        $tS = $this->createNewSignNode("\x54\162\141\x6e\x73\146\157\162\155\x73");
        $nd->appendChild($tS);
        if (is_array($Gl)) {
            goto kv;
        }
        if (!empty($this->canonicalMethod)) {
            goto j2;
        }
        goto fJ;
        kv:
        foreach ($Gl as $X0) {
            $Gh = $this->createNewSignNode("\124\x72\141\x6e\163\x66\157\x72\x6d");
            $tS->appendChild($Gh);
            if (is_array($X0) && !empty($X0["\x68\164\x74\160\x3a\57\57\x77\167\167\x2e\167\63\x2e\157\x72\147\x2f\x54\x52\x2f\x31\71\x39\x39\x2f\x52\x45\x43\55\170\160\141\x74\150\x2d\x31\71\71\x39\61\61\61\66"]) && !empty($X0["\150\x74\164\160\72\x2f\x2f\167\x77\x77\x2e\167\x33\x2e\157\162\x67\x2f\124\x52\57\x31\x39\71\x39\57\122\105\103\x2d\170\x70\x61\x74\x68\55\61\x39\x39\x39\x31\61\61\x36"]["\161\165\145\162\x79"])) {
                goto Aj;
            }
            $Gh->setAttribute("\x41\x6c\x67\157\162\151\x74\150\155", $X0);
            goto CE;
            Aj:
            $Gh->setAttribute("\x41\154\147\x6f\x72\151\x74\150\155", "\150\x74\x74\160\72\57\57\167\x77\x77\x2e\x77\x33\56\157\x72\x67\57\124\122\57\61\71\71\x39\57\122\x45\103\55\x78\x70\x61\164\x68\55\x31\x39\x39\x39\61\x31\x31\x36");
            $gs = $this->createNewSignNode("\130\x50\141\x74\x68", $X0["\150\164\x74\160\72\x2f\57\167\x77\167\56\x77\x33\x2e\157\162\147\57\x54\x52\57\x31\x39\71\71\57\122\x45\103\x2d\170\x70\141\164\150\x2d\61\71\x39\x39\x31\x31\61\x36"]["\x71\165\x65\162\x79"]);
            $Gh->appendChild($gs);
            if (empty($X0["\x68\x74\x74\x70\x3a\57\x2f\x77\x77\x77\x2e\167\63\56\157\162\x67\x2f\x54\122\57\x31\x39\x39\71\57\x52\x45\103\55\170\x70\x61\164\150\55\x31\x39\x39\x39\61\x31\61\66"]["\156\141\155\x65\x73\160\141\143\145\x73"])) {
                goto ep;
            }
            foreach ($X0["\x68\x74\164\x70\x3a\x2f\57\x77\x77\x77\x2e\167\x33\x2e\157\162\147\57\124\122\x2f\x31\x39\x39\71\x2f\x52\x45\103\55\170\x70\x61\164\x68\x2d\x31\x39\71\x39\x31\x31\61\x36"]["\x6e\141\155\145\x73\160\141\x63\x65\x73"] as $GD => $aL) {
                $gs->setAttributeNS("\x68\164\164\x70\x3a\x2f\x2f\x77\167\x77\x2e\x77\63\56\x6f\162\x67\57\62\x30\60\60\57\170\155\154\x6e\163\57", "\170\x6d\x6c\x6e\x73\x3a{$GD}", $aL);
                kK:
            }
            WF:
            ep:
            CE:
            IM:
        }
        Az:
        goto fJ;
        j2:
        $Gh = $this->createNewSignNode("\x54\162\141\156\163\x66\157\x72\155");
        $tS->appendChild($Gh);
        $Gh->setAttribute("\101\154\x67\157\x72\x69\x74\x68\155", $this->canonicalMethod);
        fJ:
        $l_ = $this->processTransforms($nd, $fr);
        $z0 = $this->calculateDigest($em, $l_);
        $ET = $this->createNewSignNode("\104\x69\147\145\x73\164\115\145\x74\x68\157\x64");
        $nd->appendChild($ET);
        $ET->setAttribute("\x41\154\x67\x6f\162\x69\164\x68\155", $em);
        $J5 = $this->createNewSignNode("\104\151\147\145\x73\164\x56\x61\154\x75\x65", $z0);
        $nd->appendChild($J5);
    }
    public function addReference($fr, $em, $Gl = null, $B0 = null)
    {
        if (!($c1 = $this->getXPathObj())) {
            goto Tw;
        }
        $PI = "\x2e\x2f\x73\145\143\144\x73\x69\147\72\123\151\x67\156\145\144\111\x6e\146\157";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($JP = $E5->item(0))) {
            goto SK;
        }
        $this->addRefInternal($JP, $fr, $em, $Gl, $B0);
        SK:
        Tw:
    }
    public function addReferenceList($gc, $em, $Gl = null, $B0 = null)
    {
        if (!($c1 = $this->getXPathObj())) {
            goto Xi;
        }
        $PI = "\x2e\57\x73\145\143\144\163\x69\x67\x3a\x53\x69\x67\156\x65\144\111\x6e\x66\x6f";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($JP = $E5->item(0))) {
            goto PV;
        }
        foreach ($gc as $fr) {
            $this->addRefInternal($JP, $fr, $em, $Gl, $B0);
            CP:
        }
        Ei:
        PV:
        Xi:
    }
    public function addObject($uq, $qS = null, $IU = null)
    {
        $vu = $this->createNewSignNode("\x4f\x62\x6a\145\x63\164");
        $this->sigNode->appendChild($vu);
        if (empty($qS)) {
            goto Im;
        }
        $vu->setAttribute("\x4d\x69\155\145\x54\x79\160\x65", $qS);
        Im:
        if (empty($IU)) {
            goto pY;
        }
        $vu->setAttribute("\x45\156\x63\x6f\x64\x69\x6e\x67", $IU);
        pY:
        if ($uq instanceof DOMElement) {
            goto X_;
        }
        $im = $this->sigNode->ownerDocument->createTextNode($uq);
        goto gw;
        X_:
        $im = $this->sigNode->ownerDocument->importNode($uq, true);
        gw:
        $vu->appendChild($im);
        return $vu;
    }
    public function locateKey($fr = null)
    {
        if (!empty($fr)) {
            goto cm;
        }
        $fr = $this->sigNode;
        cm:
        if ($fr instanceof DOMNode) {
            goto V1;
        }
        return null;
        V1:
        if (!($FU = $fr->ownerDocument)) {
            goto Se;
        }
        $c1 = new DOMXPath($FU);
        $c1->registerNamespace("\163\145\x63\x64\163\x69\x67", self::XMLDSIGNS);
        $PI = "\163\164\x72\151\156\x67\x28\56\x2f\163\x65\143\144\x73\x69\x67\x3a\123\x69\x67\156\145\144\111\156\146\x6f\x2f\x73\x65\x63\x64\x73\151\147\x3a\x53\x69\x67\x6e\x61\164\165\162\x65\115\x65\164\150\157\x64\x2f\100\x41\x6c\x67\x6f\162\x69\x74\x68\x6d\51";
        $em = $c1->evaluate($PI, $fr);
        if (!$em) {
            goto mJ;
        }
        try {
            $Yl = new XMLSecurityKey($em, array("\x74\x79\x70\x65" => "\160\165\x62\x6c\x69\x63"));
        } catch (Exception $l3) {
            return null;
        }
        return $Yl;
        mJ:
        Se:
        return null;
    }
    public function verify($Yl)
    {
        $FU = $this->sigNode->ownerDocument;
        $c1 = new DOMXPath($FU);
        $c1->registerNamespace("\x73\145\143\144\x73\x69\147", self::XMLDSIGNS);
        $PI = "\163\x74\x72\x69\x6e\147\50\x2e\57\163\x65\x63\144\163\151\x67\72\123\151\x67\156\141\164\x75\x72\145\x56\x61\154\165\x65\51";
        $kr = $c1->evaluate($PI, $this->sigNode);
        if (!empty($kr)) {
            goto Sv;
        }
        throw new Exception("\125\156\141\x62\x6c\x65\40\x74\x6f\x20\x6c\x6f\143\x61\x74\x65\40\x53\x69\x67\x6e\141\x74\x75\x72\145\x56\x61\154\165\x65");
        Sv:
        return $Yl->verifySignature($this->signedInfo, base64_decode($kr));
    }
    public function signData($Yl, $uq)
    {
        return $Yl->signData($uq);
    }
    public function sign($Yl, $Am = null)
    {
        if (!($Am != null)) {
            goto gL;
        }
        $this->resetXPathObj();
        $this->appendSignature($Am);
        $this->sigNode = $Am->lastChild;
        gL:
        if (!($c1 = $this->getXPathObj())) {
            goto cy;
        }
        $PI = "\56\x2f\x73\x65\143\144\x73\x69\x67\72\123\151\x67\156\145\144\111\156\x66\157";
        $E5 = $c1->query($PI, $this->sigNode);
        if (!($JP = $E5->item(0))) {
            goto wT;
        }
        $PI = "\x2e\57\x73\x65\x63\x64\x73\151\147\x3a\123\151\x67\x6e\141\x74\x75\162\x65\x4d\145\164\x68\157\x64";
        $E5 = $c1->query($PI, $JP);
        $tT = $E5->item(0);
        $tT->setAttribute("\x41\x6c\x67\157\162\x69\164\150\x6d", $Yl->type);
        $uq = $this->canonicalizeData($JP, $this->canonicalMethod);
        $kr = base64_encode($this->signData($Yl, $uq));
        $DW = $this->createNewSignNode("\123\x69\147\x6e\141\x74\165\162\145\126\141\154\x75\x65", $kr);
        if ($yp = $JP->nextSibling) {
            goto eg;
        }
        $this->sigNode->appendChild($DW);
        goto sK;
        eg:
        $yp->parentNode->insertBefore($DW, $yp);
        sK:
        wT:
        cy:
    }
    public function appendCert()
    {
    }
    public function appendKey($Yl, $y1 = null)
    {
        $Yl->serializeKey($y1);
    }
    public function insertSignature($fr, $Dh = null)
    {
        $LC = $fr->ownerDocument;
        $aI = $LC->importNode($this->sigNode, true);
        if ($Dh == null) {
            goto zY;
        }
        return $fr->insertBefore($aI, $Dh);
        goto O_;
        zY:
        return $fr->insertBefore($aI);
        O_:
    }
    public function appendSignature($n3, $Oz = false)
    {
        $Dh = $Oz ? $n3->firstChild : null;
        return $this->insertSignature($n3, $Dh);
    }
    public static function get509XCert($GJ, $un = true)
    {
        $iL = self::staticGet509XCerts($GJ, $un);
        if (empty($iL)) {
            goto R7;
        }
        return $iL[0];
        R7:
        return '';
    }
    public static function staticGet509XCerts($iL, $un = true)
    {
        if ($un) {
            goto Za;
        }
        return array($iL);
        goto ej;
        Za:
        $uq = '';
        $vs = array();
        $Nh = explode("\12", $iL);
        $UG = false;
        foreach ($Nh as $Gc) {
            if (!$UG) {
                goto T3;
            }
            if (!(strncmp($Gc, "\x2d\x2d\55\x2d\x2d\x45\116\x44\40\103\x45\122\x54\x49\106\111\103\101\x54\x45", 20) == 0)) {
                goto YM;
            }
            $UG = false;
            $vs[] = $uq;
            $uq = '';
            goto sb;
            YM:
            $uq .= trim($Gc);
            goto I_;
            T3:
            if (!(strncmp($Gc, "\55\55\55\55\55\x42\x45\x47\111\x4e\x20\103\105\122\x54\x49\x46\x49\103\101\x54\x45", 22) == 0)) {
                goto yq;
            }
            $UG = true;
            yq:
            I_:
            sb:
        }
        kE:
        return $vs;
        ej:
    }
    public static function staticAdd509Cert($Pu, $GJ, $un = true, $W0 = false, $c1 = null, $B0 = null)
    {
        if (!$W0) {
            goto T9;
        }
        $GJ = file_get_contents($GJ);
        T9:
        if ($Pu instanceof DOMElement) {
            goto sJ;
        }
        throw new Exception("\111\x6e\166\x61\x6c\151\x64\x20\x70\141\162\x65\x6e\164\40\x4e\157\144\x65\40\x70\x61\x72\141\155\x65\x74\145\x72");
        sJ:
        $Fl = $Pu->ownerDocument;
        if (!empty($c1)) {
            goto FB;
        }
        $c1 = new DOMXPath($Pu->ownerDocument);
        $c1->registerNamespace("\163\x65\143\144\163\x69\x67", self::XMLDSIGNS);
        FB:
        $PI = "\56\x2f\x73\145\x63\144\163\x69\x67\x3a\113\x65\x79\x49\x6e\146\157";
        $E5 = $c1->query($PI, $Pu);
        $Zr = $E5->item(0);
        $An = '';
        if (!$Zr) {
            goto i1;
        }
        $dJ = $Zr->lookupPrefix(self::XMLDSIGNS);
        if (empty($dJ)) {
            goto tX;
        }
        $An = $dJ . "\72";
        tX:
        goto VV;
        i1:
        $dJ = $Pu->lookupPrefix(self::XMLDSIGNS);
        if (empty($dJ)) {
            goto jF;
        }
        $An = $dJ . "\72";
        jF:
        $X6 = false;
        $Zr = $Fl->createElementNS(self::XMLDSIGNS, $An . "\113\145\x79\111\156\x66\x6f");
        $PI = "\x2e\57\163\x65\143\x64\x73\x69\147\72\x4f\142\x6a\145\143\164";
        $E5 = $c1->query($PI, $Pu);
        if (!($YV = $E5->item(0))) {
            goto Rw;
        }
        $YV->parentNode->insertBefore($Zr, $YV);
        $X6 = true;
        Rw:
        if ($X6) {
            goto fQ;
        }
        $Pu->appendChild($Zr);
        fQ:
        VV:
        $iL = self::staticGet509XCerts($GJ, $un);
        $UF = $Fl->createElementNS(self::XMLDSIGNS, $An . "\130\x35\x30\x39\x44\141\164\141");
        $Zr->appendChild($UF);
        $ar = false;
        $xN = false;
        if (!is_array($B0)) {
            goto XY;
        }
        if (empty($B0["\x69\163\x73\165\145\162\123\145\x72\151\141\x6c"])) {
            goto Yw;
        }
        $ar = true;
        Yw:
        if (empty($B0["\x73\165\142\x6a\145\143\x74\x4e\141\155\145"])) {
            goto NG;
        }
        $xN = true;
        NG:
        XY:
        foreach ($iL as $HR) {
            if (!($ar || $xN)) {
                goto CV;
            }
            if (!($gj = openssl_x509_parse("\x2d\55\x2d\55\x2d\102\x45\x47\111\116\x20\103\105\x52\124\x49\x46\x49\x43\x41\124\x45\55\55\55\55\x2d\xa" . chunk_split($HR, 64, "\12") . "\x2d\55\55\55\x2d\105\x4e\x44\x20\103\x45\122\124\111\106\111\103\x41\x54\x45\x2d\x2d\x2d\x2d\x2d\xa"))) {
                goto L6;
            }
            if (!($xN && !empty($gj["\163\x75\142\152\145\143\164"]))) {
                goto vL;
            }
            if (is_array($gj["\x73\165\142\152\x65\143\x74"])) {
                goto Tf;
            }
            $h0 = $gj["\151\x73\163\165\x65\x72"];
            goto el;
            Tf:
            $Ja = array();
            foreach ($gj["\163\x75\x62\x6a\x65\x63\164"] as $hG => $Er) {
                if (is_array($Er)) {
                    goto b4;
                }
                array_unshift($Ja, "{$hG}\x3d{$Er}");
                goto Pn;
                b4:
                foreach ($Er as $bw) {
                    array_unshift($Ja, "{$hG}\75{$bw}");
                    Zg:
                }
                kX:
                Pn:
                Kg:
            }
            MY:
            $h0 = implode("\x2c", $Ja);
            el:
            $aq = $Fl->createElementNS(self::XMLDSIGNS, $An . "\x58\x35\x30\71\123\x75\x62\152\145\x63\164\x4e\x61\x6d\x65", $h0);
            $UF->appendChild($aq);
            vL:
            if (!($ar && !empty($gj["\x69\163\163\165\145\162"]) && !empty($gj["\163\x65\162\x69\x61\154\x4e\x75\x6d\142\145\162"]))) {
                goto ZG;
            }
            if (is_array($gj["\151\163\x73\x75\x65\x72"])) {
                goto DI;
            }
            $jP = $gj["\x69\x73\x73\x75\145\x72"];
            goto bm;
            DI:
            $Ja = array();
            foreach ($gj["\151\x73\163\x75\145\x72"] as $hG => $Er) {
                array_unshift($Ja, "{$hG}\75{$Er}");
                WM:
            }
            mI:
            $jP = implode("\x2c", $Ja);
            bm:
            $Nr = $Fl->createElementNS(self::XMLDSIGNS, $An . "\x58\65\x30\x39\x49\163\x73\165\x65\x72\123\145\x72\x69\141\154");
            $UF->appendChild($Nr);
            $xT = $Fl->createElementNS(self::XMLDSIGNS, $An . "\130\65\x30\x39\x49\x73\163\x75\145\162\x4e\141\x6d\145", $jP);
            $Nr->appendChild($xT);
            $xT = $Fl->createElementNS(self::XMLDSIGNS, $An . "\x58\x35\60\x39\x53\145\x72\x69\141\154\116\165\x6d\x62\x65\x72", $gj["\163\145\x72\151\x61\154\116\165\x6d\x62\x65\162"]);
            $Nr->appendChild($xT);
            ZG:
            L6:
            CV:
            $AA = $Fl->createElementNS(self::XMLDSIGNS, $An . "\130\x35\60\x39\103\x65\x72\164\151\146\x69\143\x61\164\x65", $HR);
            $UF->appendChild($AA);
            xa:
        }
        G6:
    }
    public function add509Cert($GJ, $un = true, $W0 = false, $B0 = null)
    {
        if (!($c1 = $this->getXPathObj())) {
            goto Va;
        }
        self::staticAdd509Cert($this->sigNode, $GJ, $un, $W0, $c1, $B0);
        Va:
    }
    public function appendToKeyInfo($fr)
    {
        $Pu = $this->sigNode;
        $Fl = $Pu->ownerDocument;
        $c1 = $this->getXPathObj();
        if (!empty($c1)) {
            goto o3;
        }
        $c1 = new DOMXPath($Pu->ownerDocument);
        $c1->registerNamespace("\x73\x65\143\144\x73\151\147", self::XMLDSIGNS);
        o3:
        $PI = "\56\57\163\x65\143\x64\163\151\147\72\x4b\x65\171\111\x6e\x66\x6f";
        $E5 = $c1->query($PI, $Pu);
        $Zr = $E5->item(0);
        if ($Zr) {
            goto Q2;
        }
        $An = '';
        $dJ = $Pu->lookupPrefix(self::XMLDSIGNS);
        if (empty($dJ)) {
            goto dm;
        }
        $An = $dJ . "\72";
        dm:
        $X6 = false;
        $Zr = $Fl->createElementNS(self::XMLDSIGNS, $An . "\113\145\171\111\156\x66\x6f");
        $PI = "\x2e\x2f\x73\x65\x63\x64\x73\151\x67\x3a\x4f\142\x6a\x65\143\x74";
        $E5 = $c1->query($PI, $Pu);
        if (!($YV = $E5->item(0))) {
            goto CH;
        }
        $YV->parentNode->insertBefore($Zr, $YV);
        $X6 = true;
        CH:
        if ($X6) {
            goto fE;
        }
        $Pu->appendChild($Zr);
        fE:
        Q2:
        $Zr->appendChild($fr);
        return $Zr;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
class XMLSecEnc
{
    const template = "\74\170\x65\156\x63\x3a\x45\x6e\x63\x72\171\160\x74\145\144\x44\x61\x74\x61\x20\x78\155\154\156\163\x3a\x78\x65\156\143\75\47\x68\x74\x74\x70\72\x2f\57\167\x77\x77\x2e\167\63\56\x6f\x72\147\57\62\60\x30\61\57\60\64\x2f\x78\x6d\x6c\145\x6e\143\43\47\76\xd\12\40\x20\40\x3c\x78\145\156\143\72\103\151\160\150\x65\x72\104\141\x74\141\76\15\12\x20\40\40\x20\x20\x20\x3c\x78\145\156\143\x3a\103\151\160\150\145\162\126\x61\154\x75\x65\76\74\x2f\170\x65\x6e\x63\72\x43\151\160\150\145\162\x56\x61\x6c\x75\145\x3e\15\xa\x20\x20\40\74\57\170\x65\156\143\72\103\151\160\150\x65\x72\104\141\x74\141\x3e\xd\xa\x3c\x2f\x78\145\x6e\x63\x3a\105\156\x63\162\171\160\164\x65\144\104\141\164\141\76";
    const Element = "\150\x74\x74\x70\72\x2f\x2f\x77\167\167\x2e\x77\63\56\157\162\x67\57\62\x30\60\x31\x2f\60\64\57\170\x6d\x6c\145\x6e\143\43\x45\x6c\x65\155\x65\156\164";
    const Content = "\150\x74\x74\160\72\57\57\x77\x77\x77\x2e\167\x33\x2e\x6f\x72\147\x2f\x32\60\x30\61\x2f\60\64\57\x78\x6d\x6c\145\156\x63\x23\103\157\156\x74\x65\x6e\x74";
    const URI = 3;
    const XMLENCNS = "\x68\164\164\x70\72\57\x2f\x77\x77\x77\56\167\63\x2e\x6f\x72\147\57\62\x30\x30\x31\x2f\60\64\x2f\170\155\154\x65\156\143\x23";
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
    public function addReference($GZ, $fr, $NX)
    {
        if ($fr instanceof DOMNode) {
            goto K2;
        }
        throw new Exception("\44\156\x6f\x64\145\40\x69\163\40\156\x6f\164\40\157\146\40\x74\171\x70\x65\40\104\117\115\x4e\x6f\x64\x65");
        K2:
        $TQ = $this->encdoc;
        $this->_resetTemplate();
        $LT = $this->encdoc;
        $this->encdoc = $TQ;
        $pY = XMLSecurityDSig::generateGUID();
        $y0 = $LT->documentElement;
        $y0->setAttribute("\x49\144", $pY);
        $this->references[$GZ] = array("\x6e\x6f\x64\x65" => $fr, "\164\x79\x70\145" => $NX, "\145\x6e\143\x6e\157\144\x65" => $LT, "\162\x65\146\x75\x72\151" => $pY);
    }
    public function setNode($fr)
    {
        $this->rawNode = $fr;
    }
    public function encryptNode($Yl, $rx = true)
    {
        $uq = '';
        if (!empty($this->rawNode)) {
            goto Ie;
        }
        throw new Exception("\x4e\x6f\144\145\40\x74\x6f\40\x65\156\143\162\x79\x70\164\40\x68\141\x73\40\x6e\x6f\164\40\x62\x65\x65\156\x20\163\x65\x74");
        Ie:
        if ($Yl instanceof XMLSecurityKey) {
            goto kS;
        }
        throw new Exception("\111\x6e\x76\141\x6c\x69\x64\x20\113\x65\x79");
        kS:
        $FU = $this->rawNode->ownerDocument;
        $Sp = new DOMXPath($this->encdoc);
        $gP = $Sp->query("\57\170\x65\156\143\72\x45\x6e\143\x72\171\160\x74\145\x64\104\x61\x74\x61\x2f\x78\x65\x6e\143\x3a\103\x69\160\150\145\x72\x44\141\x74\141\57\x78\145\156\x63\x3a\x43\x69\x70\150\145\162\x56\x61\x6c\165\145");
        $vK = $gP->item(0);
        if (!($vK == null)) {
            goto ZF;
        }
        throw new Exception("\105\x72\162\157\x72\x20\154\x6f\143\x61\164\x69\x6e\147\40\x43\151\x70\150\145\162\126\141\x6c\165\x65\40\x65\x6c\x65\x6d\x65\156\164\40\x77\x69\x74\150\x69\x6e\40\164\x65\x6d\160\x6c\x61\164\145");
        ZF:
        switch ($this->type) {
            case self::Element:
                $uq = $FU->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\124\x79\x70\145", self::Element);
                goto GG;
            case self::Content:
                $Ts = $this->rawNode->childNodes;
                foreach ($Ts as $A2) {
                    $uq .= $FU->saveXML($A2);
                    Yf:
                }
                Nw:
                $this->encdoc->documentElement->setAttribute("\x54\x79\x70\x65", self::Content);
                goto GG;
            default:
                throw new Exception("\x54\171\x70\145\40\x69\163\x20\143\x75\162\162\145\156\x74\154\x79\40\x6e\x6f\164\40\x73\165\x70\x70\x6f\162\164\145\144");
        }
        Uf:
        GG:
        $vi = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\72\x45\156\x63\x72\x79\160\x74\151\157\x6e\115\x65\164\x68\x6f\x64"));
        $vi->setAttribute("\101\x6c\147\x6f\x72\x69\164\150\x6d", $Yl->getAlgorithm());
        $vK->parentNode->parentNode->insertBefore($vi, $vK->parentNode->parentNode->firstChild);
        $vm = base64_encode($Yl->encryptData($uq));
        $Er = $this->encdoc->createTextNode($vm);
        $vK->appendChild($Er);
        if ($rx) {
            goto Fz;
        }
        return $this->encdoc->documentElement;
        goto aK;
        Fz:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto HI;
                }
                return $this->encdoc;
                HI:
                $gA = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($gA, $this->rawNode);
                return $gA;
            case self::Content:
                $gA = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                gM:
                if (!$this->rawNode->firstChild) {
                    goto TA;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto gM;
                TA:
                $this->rawNode->appendChild($gA);
                return $gA;
        }
        TD:
        lC:
        aK:
    }
    public function encryptReferences($Yl)
    {
        $pV = $this->rawNode;
        $FW = $this->type;
        foreach ($this->references as $GZ => $lO) {
            $this->encdoc = $lO["\x65\x6e\143\156\x6f\144\145"];
            $this->rawNode = $lO["\x6e\157\144\145"];
            $this->type = $lO["\164\171\160\145"];
            try {
                $bQ = $this->encryptNode($Yl);
                $this->references[$GZ]["\145\x6e\x63\156\x6f\x64\145"] = $bQ;
            } catch (Exception $l3) {
                $this->rawNode = $pV;
                $this->type = $FW;
                throw $l3;
            }
            FH:
        }
        lJ:
        $this->rawNode = $pV;
        $this->type = $FW;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto VF;
        }
        throw new Exception("\x4e\x6f\x64\x65\40\164\x6f\x20\144\145\x63\162\171\160\164\40\x68\141\163\x20\156\x6f\164\x20\142\x65\x65\156\40\x73\145\x74");
        VF:
        $FU = $this->rawNode->ownerDocument;
        $Sp = new DOMXPath($FU);
        $Sp->registerNamespace("\170\x6d\x6c\145\x6e\143\x72", self::XMLENCNS);
        $PI = "\56\57\x78\x6d\x6c\145\156\x63\x72\72\x43\x69\x70\150\x65\x72\104\141\x74\x61\x2f\x78\155\x6c\145\156\143\162\x3a\103\x69\x70\x68\145\162\126\141\x6c\x75\x65";
        $E5 = $Sp->query($PI, $this->rawNode);
        $fr = $E5->item(0);
        if ($fr) {
            goto yU;
        }
        return null;
        yU:
        return base64_decode($fr->nodeValue);
    }
    public function decryptNode($Yl, $rx = true)
    {
        if ($Yl instanceof XMLSecurityKey) {
            goto bk;
        }
        throw new Exception("\111\156\166\141\x6c\151\x64\x20\x4b\145\171");
        bk:
        $X4 = $this->getCipherValue();
        if ($X4) {
            goto JO;
        }
        throw new Exception("\x43\141\x6e\x6e\x6f\164\40\x6c\x6f\x63\x61\x74\x65\40\145\156\x63\x72\171\x70\x74\x65\144\x20\x64\x61\164\141");
        goto W6;
        JO:
        $ZZ = $Yl->decryptData($X4);
        if ($rx) {
            goto DW;
        }
        return $ZZ;
        goto wX;
        DW:
        switch ($this->type) {
            case self::Element:
                $Wb = new DOMDocument();
                $Wb->loadXML($ZZ);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto rl;
                }
                return $Wb;
                rl:
                $gA = $this->rawNode->ownerDocument->importNode($Wb->documentElement, true);
                $this->rawNode->parentNode->replaceChild($gA, $this->rawNode);
                return $gA;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto Ue;
                }
                $FU = $this->rawNode->ownerDocument;
                goto XV;
                Ue:
                $FU = $this->rawNode;
                XV:
                $yE = $FU->createDocumentFragment();
                $yE->appendXML($ZZ);
                $y1 = $this->rawNode->parentNode;
                $y1->replaceChild($yE, $this->rawNode);
                return $y1;
            default:
                return $ZZ;
        }
        dY:
        rx:
        wX:
        W6:
    }
    public function encryptKey($o4, $oA, $D9 = true)
    {
        if (!(!$o4 instanceof XMLSecurityKey || !$oA instanceof XMLSecurityKey)) {
            goto fu;
        }
        throw new Exception("\111\156\166\x61\154\151\x64\x20\x4b\x65\x79");
        fu:
        $W5 = base64_encode($o4->encryptData($oA->key));
        $qs = $this->encdoc->documentElement;
        $v8 = $this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\x63\72\x45\x6e\x63\x72\x79\160\x74\x65\144\x4b\x65\171");
        if ($D9) {
            goto mF;
        }
        $this->encKey = $v8;
        goto bg;
        mF:
        $Zr = $qs->insertBefore($this->encdoc->createElementNS("\x68\164\164\x70\x3a\x2f\x2f\x77\x77\167\56\x77\x33\x2e\x6f\x72\x67\x2f\x32\60\x30\60\x2f\x30\x39\x2f\170\155\154\x64\163\151\147\x23", "\144\163\151\x67\72\113\x65\171\x49\156\x66\157"), $qs->firstChild);
        $Zr->appendChild($v8);
        bg:
        $vi = $v8->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\x63\72\105\x6e\143\x72\x79\x70\164\151\157\x6e\x4d\x65\x74\x68\157\x64"));
        $vi->setAttribute("\x41\x6c\147\157\x72\151\x74\150\155", $o4->getAlgorithm());
        if (empty($o4->name)) {
            goto AO;
        }
        $Zr = $v8->appendChild($this->encdoc->createElementNS("\150\x74\164\160\x3a\57\57\167\x77\167\56\x77\x33\56\157\162\147\57\x32\60\60\x30\x2f\60\71\x2f\x78\x6d\154\144\163\151\147\x23", "\144\x73\151\x67\x3a\113\145\x79\x49\x6e\x66\157"));
        $Zr->appendChild($this->encdoc->createElementNS("\x68\x74\164\160\72\x2f\57\x77\x77\167\x2e\x77\x33\56\157\162\x67\x2f\x32\x30\60\60\57\60\71\x2f\170\155\x6c\144\x73\151\x67\43", "\144\x73\x69\x67\72\113\x65\x79\116\141\155\145", $o4->name));
        AO:
        $eC = $v8->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\156\143\x3a\103\x69\160\x68\x65\x72\104\x61\164\141"));
        $eC->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\x6e\x63\x3a\103\x69\x70\150\x65\162\x56\x61\154\x75\x65", $W5));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto K8;
        }
        $vE = $v8->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\x6e\143\x3a\122\x65\146\x65\x72\x65\156\143\145\x4c\x69\163\x74"));
        foreach ($this->references as $GZ => $lO) {
            $pY = $lO["\162\145\146\x75\x72\x69"];
            $i4 = $vE->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\156\143\x3a\104\x61\x74\x61\x52\145\146\x65\162\x65\x6e\x63\x65"));
            $i4->setAttribute("\x55\x52\x49", "\x23" . $pY);
            zK:
        }
        st:
        K8:
        return;
    }
    public function decryptKey($v8)
    {
        if ($v8->isEncrypted) {
            goto C_;
        }
        throw new Exception("\x4b\x65\171\40\151\x73\x20\156\157\164\40\x45\x6e\x63\x72\171\x70\x74\145\144");
        C_:
        if (!empty($v8->key)) {
            goto lp;
        }
        throw new Exception("\x4b\x65\171\40\151\x73\x20\x6d\x69\x73\x73\x69\x6e\x67\x20\x64\141\x74\x61\x20\164\157\x20\160\145\x72\146\157\162\x6d\40\164\x68\x65\x20\x64\x65\143\x72\x79\160\x74\x69\157\156");
        lp:
        return $this->decryptNode($v8, false);
    }
    public function locateEncryptedData($y0)
    {
        if ($y0 instanceof DOMDocument) {
            goto M0;
        }
        $FU = $y0->ownerDocument;
        goto SL;
        M0:
        $FU = $y0;
        SL:
        if (!$FU) {
            goto QL;
        }
        $c1 = new DOMXPath($FU);
        $PI = "\57\57\52\133\154\157\x63\141\154\55\156\141\155\x65\50\51\75\x27\105\x6e\143\162\171\x70\x74\145\x64\104\x61\164\141\47\x20\x61\156\x64\x20\156\141\155\145\163\x70\x61\x63\145\x2d\x75\x72\x69\x28\x29\x3d\x27" . self::XMLENCNS . "\47\135";
        $E5 = $c1->query($PI);
        return $E5->item(0);
        QL:
        return null;
    }
    public function locateKey($fr = null)
    {
        if (!empty($fr)) {
            goto aF;
        }
        $fr = $this->rawNode;
        aF:
        if ($fr instanceof DOMNode) {
            goto Re;
        }
        return null;
        Re:
        if (!($FU = $fr->ownerDocument)) {
            goto ZC;
        }
        $c1 = new DOMXPath($FU);
        $c1->registerNamespace("\x78\155\154\x73\x65\143\x65\156\x63", self::XMLENCNS);
        $PI = "\56\x2f\x2f\170\x6d\154\x73\x65\143\145\156\143\x3a\105\156\143\x72\x79\x70\x74\151\x6f\x6e\x4d\145\x74\150\x6f\x64";
        $E5 = $c1->query($PI, $fr);
        if (!($Ef = $E5->item(0))) {
            goto bF;
        }
        $g5 = $Ef->getAttribute("\101\154\147\157\162\151\164\x68\x6d");
        try {
            $Yl = new XMLSecurityKey($g5, array("\x74\x79\160\x65" => "\160\x72\151\166\x61\164\x65"));
        } catch (Exception $l3) {
            return null;
        }
        return $Yl;
        bF:
        ZC:
        return null;
    }
    public static function staticLocateKeyInfo($rB = null, $fr = null)
    {
        if (!(empty($fr) || !$fr instanceof DOMNode)) {
            goto N0;
        }
        return null;
        N0:
        $FU = $fr->ownerDocument;
        if ($FU) {
            goto nx;
        }
        return null;
        nx:
        $c1 = new DOMXPath($FU);
        $c1->registerNamespace("\170\x6d\x6c\x73\x65\x63\145\156\x63", self::XMLENCNS);
        $c1->registerNamespace("\170\155\x6c\163\x65\143\x64\163\151\x67", XMLSecurityDSig::XMLDSIGNS);
        $PI = "\56\x2f\170\155\154\163\145\x63\144\163\151\147\x3a\x4b\x65\171\x49\x6e\146\x6f";
        $E5 = $c1->query($PI, $fr);
        $Ef = $E5->item(0);
        if ($Ef) {
            goto kQ;
        }
        return $rB;
        kQ:
        foreach ($Ef->childNodes as $A2) {
            switch ($A2->localName) {
                case "\x4b\145\x79\116\141\x6d\x65":
                    if (empty($rB)) {
                        goto qW;
                    }
                    $rB->name = $A2->nodeValue;
                    qW:
                    goto uq;
                case "\x4b\x65\171\x56\x61\x6c\x75\x65":
                    foreach ($A2->childNodes as $hE) {
                        switch ($hE->localName) {
                            case "\x44\x53\101\x4b\145\x79\126\x61\x6c\x75\x65":
                                throw new Exception("\x44\123\101\x4b\145\171\x56\x61\154\x75\145\40\143\165\162\x72\145\x6e\164\154\171\40\x6e\x6f\x74\40\163\x75\x70\160\x6f\162\164\145\144");
                            case "\x52\x53\101\113\145\171\x56\x61\154\x75\145":
                                $JB = null;
                                $DB = null;
                                if (!($dR = $hE->getElementsByTagName("\115\x6f\144\165\x6c\x75\x73")->item(0))) {
                                    goto aP;
                                }
                                $JB = base64_decode($dR->nodeValue);
                                aP:
                                if (!($Sr = $hE->getElementsByTagName("\105\x78\160\x6f\156\145\156\164")->item(0))) {
                                    goto Hh;
                                }
                                $DB = base64_decode($Sr->nodeValue);
                                Hh:
                                if (!(empty($JB) || empty($DB))) {
                                    goto Xp;
                                }
                                throw new Exception("\115\x69\163\x73\x69\x6e\147\40\115\x6f\x64\x75\x6c\165\163\40\x6f\162\x20\105\x78\160\x6f\x6e\145\156\164");
                                Xp:
                                $V0 = XMLSecurityKey::convertRSA($JB, $DB);
                                $rB->loadKey($V0);
                                goto Ws;
                        }
                        lF:
                        Ws:
                        Ja:
                    }
                    Yt:
                    goto uq;
                case "\122\145\x74\x72\151\x65\166\x61\154\x4d\x65\164\150\157\x64":
                    $NX = $A2->getAttribute("\x54\171\160\145");
                    if (!($NX !== "\x68\164\164\x70\x3a\57\x2f\x77\167\x77\56\x77\x33\x2e\157\162\x67\x2f\62\x30\x30\61\57\x30\64\57\x78\x6d\x6c\x65\156\x63\43\105\x6e\x63\x72\171\160\x74\x65\x64\x4b\x65\x79")) {
                        goto r7;
                    }
                    goto uq;
                    r7:
                    $kM = $A2->getAttribute("\x55\122\111");
                    if (!($kM[0] !== "\x23")) {
                        goto am;
                    }
                    goto uq;
                    am:
                    $Sa = substr($kM, 1);
                    $PI = "\x2f\57\x78\x6d\154\163\145\143\x65\156\x63\x3a\x45\x6e\143\x72\171\160\x74\145\x64\113\x65\171\x5b\100\111\144\75\x27{$Sa}\47\135";
                    $tZ = $c1->query($PI)->item(0);
                    if ($tZ) {
                        goto Hy;
                    }
                    throw new Exception("\125\156\141\142\154\x65\40\x74\x6f\x20\154\157\x63\x61\164\145\x20\x45\156\x63\x72\171\x70\x74\145\x64\113\x65\x79\x20\x77\x69\x74\x68\x20\100\x49\144\75\47{$Sa}\47\x2e");
                    Hy:
                    return XMLSecurityKey::fromEncryptedKeyElement($tZ);
                case "\105\x6e\143\x72\x79\160\x74\x65\x64\113\x65\171":
                    return XMLSecurityKey::fromEncryptedKeyElement($A2);
                case "\x58\x35\60\71\x44\x61\x74\x61":
                    if (!($hu = $A2->getElementsByTagName("\130\65\60\x39\103\145\162\164\151\146\151\x63\141\x74\x65"))) {
                        goto qK;
                    }
                    if (!($hu->length > 0)) {
                        goto ms;
                    }
                    $GB = $hu->item(0)->textContent;
                    $GB = str_replace(array("\15", "\xa", "\x20"), '', $GB);
                    $GB = "\x2d\55\x2d\55\55\x42\x45\107\x49\116\40\103\105\x52\124\x49\106\111\x43\101\x54\105\x2d\x2d\x2d\55\x2d\xa" . chunk_split($GB, 64, "\12") . "\x2d\55\55\55\55\x45\x4e\x44\x20\x43\x45\122\124\x49\106\x49\103\x41\x54\105\x2d\x2d\x2d\x2d\55\xa";
                    $rB->loadKey($GB, false, true);
                    ms:
                    qK:
                    goto uq;
            }
            n6:
            uq:
            D3:
        }
        GI:
        return $rB;
    }
    public function locateKeyInfo($rB = null, $fr = null)
    {
        if (!empty($fr)) {
            goto OV;
        }
        $fr = $this->rawNode;
        OV:
        return self::staticLocateKeyInfo($rB, $fr);
    }
}
