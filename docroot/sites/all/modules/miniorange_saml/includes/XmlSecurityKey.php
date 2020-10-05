<?php


class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\150\x74\x74\x70\x3a\57\57\x77\167\x77\56\x77\63\56\157\x72\x67\x2f\x32\x30\60\61\x2f\60\64\x2f\170\x6d\x6c\145\x6e\x63\x23\x74\162\x69\x70\154\145\144\145\x73\x2d\143\142\143";
    const AES128_CBC = "\150\164\164\x70\x3a\57\57\167\x77\x77\x2e\167\63\56\157\x72\147\57\62\60\60\x31\57\60\x34\57\x78\x6d\154\145\x6e\x63\43\141\145\x73\x31\x32\70\x2d\x63\x62\143";
    const AES192_CBC = "\150\x74\164\x70\72\x2f\x2f\x77\167\167\56\x77\x33\x2e\x6f\x72\x67\x2f\x32\x30\x30\x31\x2f\x30\x34\57\x78\155\154\x65\x6e\143\43\141\145\x73\61\71\x32\55\x63\142\x63";
    const AES256_CBC = "\x68\164\164\x70\x3a\x2f\x2f\167\167\x77\56\167\63\56\x6f\162\147\x2f\x32\60\x30\x31\57\x30\64\x2f\170\155\x6c\145\x6e\143\43\x61\x65\163\62\65\x36\55\143\x62\x63";
    const RSA_1_5 = "\x68\164\164\x70\x3a\x2f\x2f\x77\x77\x77\56\x77\63\x2e\157\x72\147\x2f\62\x30\x30\x31\x2f\x30\x34\x2f\x78\x6d\154\x65\156\x63\43\x72\x73\141\x2d\61\137\65";
    const RSA_OAEP_MGF1P = "\150\164\x74\x70\72\x2f\x2f\167\x77\x77\56\167\x33\56\x6f\162\147\x2f\62\60\60\x31\57\x30\x34\57\x78\x6d\154\x65\156\x63\x23\x72\163\141\x2d\157\141\x65\160\x2d\x6d\x67\x66\61\160";
    const DSA_SHA1 = "\x68\164\x74\160\x3a\57\x2f\167\x77\x77\56\167\63\x2e\x6f\162\x67\x2f\x32\60\60\60\x2f\60\71\x2f\x78\x6d\x6c\144\x73\x69\x67\43\x64\x73\141\x2d\x73\150\x61\61";
    const RSA_SHA1 = "\150\x74\164\x70\72\x2f\x2f\167\167\x77\x2e\x77\63\x2e\x6f\x72\147\x2f\x32\60\60\x30\x2f\x30\71\57\x78\x6d\x6c\144\x73\151\147\x23\162\x73\x61\55\x73\150\x61\x31";
    const RSA_SHA256 = "\150\x74\x74\x70\72\57\57\167\x77\x77\56\x77\x33\56\157\x72\x67\57\62\60\60\61\x2f\60\64\57\170\155\x6c\x64\x73\x69\x67\55\x6d\x6f\x72\145\x23\x72\x73\x61\x2d\x73\x68\x61\x32\65\66";
    const RSA_SHA384 = "\x68\x74\164\x70\72\x2f\x2f\x77\x77\x77\x2e\167\63\x2e\157\162\147\57\x32\60\60\61\x2f\60\64\x2f\x78\x6d\x6c\144\x73\x69\x67\55\155\157\162\x65\43\162\163\x61\x2d\163\150\x61\63\x38\x34";
    const RSA_SHA512 = "\150\x74\x74\x70\x3a\57\57\167\x77\x77\56\167\63\x2e\x6f\x72\147\57\62\x30\x30\x31\57\60\64\57\x78\x6d\154\x64\x73\x69\147\55\155\157\162\x65\43\162\x73\141\55\163\150\141\x35\61\62";
    const HMAC_SHA1 = "\x68\x74\164\160\72\57\57\x77\167\x77\x2e\x77\63\x2e\157\x72\x67\x2f\62\x30\x30\60\x2f\60\x39\x2f\170\x6d\x6c\144\x73\151\147\x23\150\x6d\x61\x63\x2d\163\x68\x61\x31";
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
    public function __construct($wP, $kg = null)
    {
        switch ($wP) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\154\x69\142\x72\141\162\171"] = "\x6f\160\145\156\163\163\154";
                $this->cryptParams["\x63\151\160\x68\x65\162"] = "\x64\x65\x73\55\145\144\145\x33\55\x63\142\143";
                $this->cryptParams["\164\171\x70\x65"] = "\163\171\x6d\x6d\145\164\162\151\143";
                $this->cryptParams["\155\145\x74\x68\157\144"] = "\150\x74\x74\x70\x3a\x2f\57\167\x77\x77\56\167\63\56\157\162\x67\57\62\60\x30\61\57\60\64\x2f\170\155\x6c\x65\x6e\143\43\164\x72\151\160\154\145\x64\145\x73\55\x63\x62\x63";
                $this->cryptParams["\x6b\x65\x79\163\151\172\x65"] = 24;
                $this->cryptParams["\142\154\x6f\x63\x6b\163\x69\172\145"] = 8;
                goto yV;
            case self::AES128_CBC:
                $this->cryptParams["\154\x69\x62\x72\x61\162\x79"] = "\157\160\x65\156\163\163\x6c";
                $this->cryptParams["\143\151\160\x68\145\x72"] = "\x61\145\163\x2d\61\62\x38\55\x63\142\143";
                $this->cryptParams["\164\171\x70\145"] = "\x73\171\155\155\x65\x74\x72\x69\143";
                $this->cryptParams["\155\x65\164\150\x6f\144"] = "\150\x74\x74\160\72\x2f\x2f\x77\167\167\x2e\167\63\56\x6f\x72\x67\57\x32\x30\60\61\x2f\60\x34\x2f\x78\x6d\154\145\156\143\43\141\x65\x73\61\x32\70\55\143\x62\x63";
                $this->cryptParams["\153\145\171\163\151\x7a\x65"] = 16;
                $this->cryptParams["\x62\154\x6f\143\x6b\x73\151\172\145"] = 16;
                goto yV;
            case self::AES192_CBC:
                $this->cryptParams["\x6c\151\x62\162\x61\x72\x79"] = "\157\160\145\x6e\163\163\x6c";
                $this->cryptParams["\143\151\160\150\145\x72"] = "\x61\x65\163\x2d\61\x39\x32\55\x63\x62\143";
                $this->cryptParams["\x74\x79\x70\145"] = "\x73\171\155\x6d\145\164\162\151\143";
                $this->cryptParams["\155\145\x74\150\x6f\144"] = "\150\164\x74\160\x3a\x2f\57\167\x77\x77\56\167\x33\56\x6f\162\147\57\62\x30\x30\61\x2f\60\64\57\170\x6d\x6c\x65\x6e\143\x23\x61\145\x73\x31\x39\x32\x2d\143\142\143";
                $this->cryptParams["\x6b\x65\171\x73\151\x7a\145"] = 24;
                $this->cryptParams["\142\154\157\x63\x6b\x73\x69\x7a\145"] = 16;
                goto yV;
            case self::AES256_CBC:
                $this->cryptParams["\154\x69\142\162\x61\x72\171"] = "\157\160\145\x6e\x73\163\x6c";
                $this->cryptParams["\143\x69\x70\x68\x65\x72"] = "\141\x65\163\55\x32\x35\x36\x2d\143\x62\x63";
                $this->cryptParams["\164\171\160\145"] = "\163\x79\x6d\155\x65\164\162\151\143";
                $this->cryptParams["\x6d\x65\164\x68\x6f\144"] = "\150\x74\x74\160\72\x2f\57\167\x77\167\x2e\x77\63\x2e\157\x72\147\x2f\x32\60\x30\x31\57\60\64\57\170\155\154\x65\x6e\143\x23\x61\145\x73\62\x35\66\55\143\x62\x63";
                $this->cryptParams["\x6b\145\x79\x73\151\x7a\x65"] = 32;
                $this->cryptParams["\x62\x6c\x6f\143\x6b\x73\151\x7a\x65"] = 16;
                goto yV;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\151\142\x72\x61\x72\x79"] = "\x6f\x70\x65\x6e\x73\x73\x6c";
                $this->cryptParams["\x70\x61\144\144\x69\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\155\x65\164\x68\157\x64"] = "\150\x74\164\x70\72\57\x2f\x77\167\167\56\167\63\x2e\x6f\x72\147\57\62\x30\x30\x31\57\60\64\57\170\155\x6c\x65\156\143\x23\x72\x73\x61\x2d\61\x5f\65";
                if (!(is_array($kg) && !empty($kg["\x74\x79\x70\145"]))) {
                    goto yR;
                }
                if (!($kg["\164\171\x70\x65"] == "\160\165\x62\154\151\x63" || $kg["\x74\171\160\x65"] == "\x70\162\x69\166\x61\x74\x65")) {
                    goto Z0;
                }
                $this->cryptParams["\164\x79\160\145"] = $kg["\164\x79\x70\x65"];
                goto yV;
                Z0:
                yR:
                throw new Exception("\x43\145\162\x74\x69\x66\151\143\x61\164\x65\x20\x22\x74\171\160\145\x22\40\x28\160\162\x69\166\141\x74\145\x2f\x70\165\x62\x6c\x69\143\51\40\x6d\x75\x73\x74\x20\142\x65\x20\160\141\x73\163\x65\x64\40\166\x69\141\x20\x70\141\x72\x61\155\x65\x74\x65\x72\x73");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\x6c\x69\x62\162\x61\x72\x79"] = "\157\x70\x65\x6e\163\163\x6c";
                $this->cryptParams["\x70\x61\144\144\x69\156\x67"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\x6d\x65\x74\150\x6f\x64"] = "\150\164\x74\x70\x3a\x2f\57\167\x77\x77\56\x77\x33\56\x6f\162\x67\x2f\62\x30\60\61\x2f\x30\x34\x2f\170\x6d\x6c\x65\156\x63\x23\x72\x73\x61\55\157\141\145\160\55\x6d\x67\146\61\x70";
                $this->cryptParams["\150\x61\x73\x68"] = null;
                if (!(is_array($kg) && !empty($kg["\x74\171\160\145"]))) {
                    goto ji;
                }
                if (!($kg["\164\x79\x70\x65"] == "\x70\165\142\154\x69\143" || $kg["\x74\x79\160\145"] == "\x70\162\x69\166\141\164\145")) {
                    goto rF;
                }
                $this->cryptParams["\x74\171\x70\145"] = $kg["\164\x79\160\145"];
                goto yV;
                rF:
                ji:
                throw new Exception("\103\x65\162\164\x69\x66\151\x63\141\164\145\40\42\164\171\160\145\42\x20\50\160\x72\x69\x76\141\x74\x65\x2f\160\x75\142\154\151\x63\x29\x20\155\x75\163\x74\40\142\x65\40\x70\141\163\x73\x65\144\x20\166\151\x61\40\x70\141\162\x61\155\x65\x74\x65\x72\163");
            case self::RSA_SHA1:
                $this->cryptParams["\x6c\151\x62\162\141\162\x79"] = "\x6f\160\145\x6e\163\163\154";
                $this->cryptParams["\155\145\x74\150\157\x64"] = "\x68\164\x74\x70\72\57\x2f\167\x77\x77\56\x77\x33\x2e\157\162\x67\x2f\62\60\x30\60\x2f\60\x39\x2f\x78\x6d\x6c\144\x73\151\147\x23\x72\163\141\55\163\x68\x61\x31";
                $this->cryptParams["\160\141\x64\x64\x69\x6e\x67"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($kg) && !empty($kg["\x74\171\x70\x65"]))) {
                    goto Kl;
                }
                if (!($kg["\x74\171\160\x65"] == "\160\x75\142\x6c\x69\143" || $kg["\164\171\160\x65"] == "\160\x72\x69\x76\141\164\x65")) {
                    goto ZW;
                }
                $this->cryptParams["\164\171\x70\x65"] = $kg["\x74\x79\x70\145"];
                goto yV;
                ZW:
                Kl:
                throw new Exception("\103\x65\x72\x74\151\146\x69\x63\x61\164\x65\x20\x22\x74\171\160\x65\42\40\x28\160\162\x69\x76\141\164\x65\x2f\x70\165\x62\x6c\151\x63\51\40\155\x75\x73\x74\40\x62\145\40\160\x61\x73\x73\x65\144\x20\x76\x69\x61\x20\x70\x61\x72\x61\155\x65\164\145\162\163");
            case self::RSA_SHA256:
                $this->cryptParams["\154\x69\x62\x72\x61\162\171"] = "\157\x70\x65\x6e\x73\163\x6c";
                $this->cryptParams["\x6d\145\x74\150\x6f\x64"] = "\150\x74\164\x70\72\x2f\x2f\167\167\167\x2e\167\x33\x2e\x6f\x72\x67\57\62\60\x30\x31\57\60\64\x2f\170\x6d\x6c\144\x73\x69\x67\x2d\155\157\162\x65\x23\162\x73\x61\x2d\163\150\x61\x32\x35\x36";
                $this->cryptParams["\x70\141\144\x64\151\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\x67\145\163\164"] = "\x53\110\101\x32\65\66";
                if (!(is_array($kg) && !empty($kg["\164\171\160\x65"]))) {
                    goto Ga;
                }
                if (!($kg["\x74\x79\160\x65"] == "\160\165\142\154\x69\x63" || $kg["\164\171\x70\x65"] == "\x70\162\x69\166\141\x74\145")) {
                    goto LW;
                }
                $this->cryptParams["\164\171\x70\x65"] = $kg["\164\x79\160\145"];
                goto yV;
                LW:
                Ga:
                throw new Exception("\103\145\x72\x74\151\146\x69\143\x61\164\145\40\42\164\x79\160\x65\x22\x20\x28\x70\x72\x69\x76\141\x74\145\x2f\x70\165\x62\154\151\x63\x29\x20\155\x75\163\x74\x20\x62\145\40\160\x61\x73\x73\x65\x64\x20\x76\x69\x61\40\x70\141\x72\x61\155\x65\164\x65\x72\x73");
            case self::RSA_SHA384:
                $this->cryptParams["\154\151\142\162\x61\162\x79"] = "\x6f\160\x65\x6e\163\x73\x6c";
                $this->cryptParams["\x6d\x65\164\150\x6f\x64"] = "\150\164\x74\x70\x3a\x2f\x2f\167\167\x77\56\x77\63\x2e\157\162\x67\57\x32\x30\60\61\x2f\60\64\57\170\155\x6c\x64\x73\x69\147\x2d\155\157\x72\x65\43\162\x73\x61\55\x73\150\x61\63\x38\64";
                $this->cryptParams["\160\141\144\144\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\x67\145\163\x74"] = "\x53\x48\101\63\70\64";
                if (!(is_array($kg) && !empty($kg["\164\x79\160\145"]))) {
                    goto uF;
                }
                if (!($kg["\164\171\160\145"] == "\x70\x75\x62\x6c\151\143" || $kg["\x74\171\x70\145"] == "\x70\162\x69\166\141\164\145")) {
                    goto AT;
                }
                $this->cryptParams["\x74\171\x70\x65"] = $kg["\164\x79\x70\x65"];
                goto yV;
                AT:
                uF:
                throw new Exception("\x43\x65\x72\164\151\146\151\143\x61\164\145\40\x22\164\171\160\x65\x22\40\50\160\162\151\x76\x61\164\x65\x2f\160\x75\142\154\151\143\51\40\155\165\163\164\x20\x62\x65\x20\x70\x61\x73\163\x65\x64\40\166\151\141\40\160\x61\162\x61\155\x65\x74\x65\x72\163");
            case self::RSA_SHA512:
                $this->cryptParams["\154\151\x62\x72\x61\162\171"] = "\157\160\145\x6e\163\163\x6c";
                $this->cryptParams["\155\x65\164\x68\x6f\144"] = "\x68\164\x74\160\72\57\x2f\x77\x77\x77\56\167\x33\56\157\x72\147\57\62\60\60\61\x2f\x30\x34\57\x78\x6d\x6c\x64\163\x69\147\55\155\157\162\145\43\162\163\x61\55\x73\150\141\x35\61\x32";
                $this->cryptParams["\x70\141\144\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\151\x67\x65\163\x74"] = "\123\x48\101\65\x31\62";
                if (!(is_array($kg) && !empty($kg["\164\171\160\145"]))) {
                    goto kh;
                }
                if (!($kg["\164\x79\160\x65"] == "\x70\165\142\154\x69\x63" || $kg["\164\171\160\x65"] == "\x70\x72\x69\x76\x61\164\x65")) {
                    goto fQ;
                }
                $this->cryptParams["\164\x79\x70\x65"] = $kg["\164\x79\x70\145"];
                goto yV;
                fQ:
                kh:
                throw new Exception("\x43\x65\162\x74\151\x66\x69\x63\141\x74\145\x20\x22\x74\x79\160\x65\42\x20\x28\x70\162\x69\x76\x61\x74\145\x2f\x70\x75\x62\154\x69\x63\51\x20\155\165\163\164\x20\x62\145\40\160\x61\x73\x73\x65\x64\40\166\x69\x61\x20\160\x61\162\141\x6d\145\x74\x65\162\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\x6c\151\x62\x72\141\162\x79"] = $wP;
                $this->cryptParams["\x6d\x65\164\x68\x6f\x64"] = "\x68\x74\164\160\72\57\x2f\167\x77\x77\x2e\x77\x33\x2e\157\x72\x67\x2f\x32\x30\x30\x30\x2f\x30\x39\57\x78\155\x6c\144\x73\x69\147\43\x68\x6d\x61\143\x2d\163\150\x61\x31";
                goto yV;
            default:
                throw new Exception("\x49\x6e\166\141\154\151\144\x20\113\145\x79\40\124\x79\160\x65");
        }
        js:
        yV:
        $this->type = $wP;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\x6b\x65\x79\x73\151\172\145"])) {
            goto J2;
        }
        return null;
        J2:
        return $this->cryptParams["\x6b\x65\171\163\151\x7a\x65"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\x6b\145\171\x73\x69\172\145"])) {
            goto NR;
        }
        throw new Exception("\x55\x6e\153\x6e\x6f\x77\156\x20\x6b\x65\171\40\x73\151\172\145\40\146\x6f\162\x20\164\171\160\x65\x20\x22" . $this->type . "\42\56");
        NR:
        $Dp = $this->cryptParams["\x6b\145\171\x73\x69\172\x65"];
        $xt = openssl_random_pseudo_bytes($Dp);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto GO;
        }
        $m3 = 0;
        B1:
        if (!($m3 < strlen($xt))) {
            goto va;
        }
        $uO = ord($xt[$m3]) & 254;
        $bK = 1;
        $YV = 1;
        ht:
        if (!($YV < 8)) {
            goto CF;
        }
        $bK ^= $uO >> $YV & 1;
        Cy:
        $YV++;
        goto ht;
        CF:
        $uO |= $bK;
        $xt[$m3] = chr($uO);
        lj:
        $m3++;
        goto B1;
        va:
        GO:
        $this->key = $xt;
        return $xt;
    }
    public static function getRawThumbprint($fg)
    {
        $Ou = explode("\12", $fg);
        $P1 = '';
        $md = false;
        foreach ($Ou as $ze) {
            if (!$md) {
                goto XW;
            }
            if (!(strncmp($ze, "\x2d\x2d\x2d\55\55\x45\116\104\40\103\x45\122\124\x49\106\x49\x43\x41\124\x45", 20) == 0)) {
                goto Yi;
            }
            goto ao;
            Yi:
            $P1 .= trim($ze);
            goto Fq;
            XW:
            if (!(strncmp($ze, "\x2d\x2d\x2d\55\x2d\102\x45\107\111\x4e\40\x43\105\x52\x54\x49\x46\x49\103\x41\124\105", 22) == 0)) {
                goto qj;
            }
            $md = true;
            qj:
            Fq:
            ye:
        }
        ao:
        if (empty($P1)) {
            goto vi;
        }
        return strtolower(sha1(base64_decode($P1)));
        vi:
        return null;
    }
    public function loadKey($xt, $Qv = false, $Yb = false)
    {
        if ($Qv) {
            goto A4;
        }
        $this->key = $xt;
        goto yG;
        A4:
        $this->key = file_get_contents($xt);
        yG:
        if ($Yb) {
            goto H3;
        }
        $this->x509Certificate = null;
        goto WI;
        H3:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $DR);
        $this->x509Certificate = $DR;
        $this->key = $DR;
        WI:
        if (!($this->cryptParams["\x6c\x69\142\x72\x61\x72\x79"] == "\157\160\x65\156\163\x73\154")) {
            goto h_;
        }
        switch ($this->cryptParams["\164\171\160\145"]) {
            case "\160\x75\x62\x6c\151\x63":
                if (!$Yb) {
                    goto s_;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                s_:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto Hf;
                }
                throw new Exception("\x55\x6e\141\142\x6c\x65\40\x74\157\x20\x65\170\x74\162\141\143\164\40\160\165\142\x6c\151\143\40\x6b\145\171");
                Hf:
                goto YR;
            case "\160\x72\x69\166\141\x74\x65":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto YR;
            case "\163\x79\155\155\145\x74\x72\151\x63":
                if (!(strlen($this->key) < $this->cryptParams["\x6b\145\x79\163\x69\x7a\x65"])) {
                    goto gs;
                }
                throw new Exception("\x4b\x65\171\40\155\x75\x73\x74\x20\x63\x6f\x6e\164\141\x69\x6e\40\141\164\x20\154\145\x61\163\164\x20\62\x35\x20\x63\150\141\x72\141\143\x74\x65\x72\x73\40\x66\x6f\162\40\164\x68\x69\x73\x20\143\151\x70\150\x65\x72");
                gs:
                goto YR;
            default:
                throw new Exception("\x55\156\x6b\x6e\x6f\167\156\x20\164\171\x70\145");
        }
        LH:
        YR:
        h_:
    }
    private function padISO10126($P1, $L4)
    {
        if (!($L4 > 256)) {
            goto dl;
        }
        throw new Exception("\x42\x6c\157\143\x6b\x20\163\151\x7a\x65\x20\x68\151\147\150\145\x72\x20\x74\x68\x61\156\40\62\x35\x36\40\156\x6f\164\40\141\x6c\154\157\167\145\x64");
        dl:
        $RO = $L4 - strlen($P1) % $L4;
        $zu = chr($RO);
        return $P1 . str_repeat($zu, $RO);
    }
    private function unpadISO10126($P1)
    {
        $RO = substr($P1, -1);
        $h_ = ord($RO);
        return substr($P1, 0, -$h_);
    }
    private function encryptSymmetric($P1)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\143\151\x70\150\145\162"]));
        $P1 = $this->padISO10126($P1, $this->cryptParams["\142\154\157\x63\153\163\x69\172\x65"]);
        $W7 = openssl_encrypt($P1, $this->cryptParams["\x63\151\x70\x68\x65\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $W7)) {
            goto kE;
        }
        throw new Exception("\106\141\151\x6c\x75\x72\x65\40\145\156\143\x72\x79\x70\x74\x69\156\147\x20\x44\x61\x74\141\40\x28\x6f\x70\145\x6e\x73\x73\154\x20\163\171\x6d\155\145\164\162\151\x63\51\40\x2d\x20" . openssl_error_string());
        kE:
        return $this->iv . $W7;
    }
    private function decryptSymmetric($P1)
    {
        $Ap = openssl_cipher_iv_length($this->cryptParams["\x63\151\160\x68\145\x72"]);
        $this->iv = substr($P1, 0, $Ap);
        $P1 = substr($P1, $Ap);
        $AA = openssl_decrypt($P1, $this->cryptParams["\x63\151\160\x68\145\x72"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        if (!(false === $AA)) {
            goto Np;
        }
        throw new Exception("\106\141\151\x6c\x75\x72\x65\x20\x64\x65\143\x72\171\160\x74\x69\156\147\x20\x44\x61\x74\141\x20\x28\x6f\160\145\x6e\163\163\x6c\x20\163\171\x6d\155\x65\x74\x72\151\x63\51\40\x2d\40" . openssl_error_string());
        Np:
        return $this->unpadISO10126($AA);
    }
    private function encryptPublic($P1)
    {
        if (openssl_public_encrypt($P1, $W7, $this->key, $this->cryptParams["\x70\141\x64\144\151\156\x67"])) {
            goto bK;
        }
        throw new Exception("\x46\141\151\154\165\162\x65\x20\145\156\143\162\171\x70\164\151\156\147\x20\104\x61\164\141\x20\50\x6f\x70\145\156\163\163\x6c\40\x70\165\142\154\x69\x63\51\x20\55\40" . openssl_error_string());
        bK:
        return $W7;
    }
    private function decryptPublic($P1)
    {
        if (openssl_public_decrypt($P1, $AA, $this->key, $this->cryptParams["\160\x61\144\144\151\156\x67"])) {
            goto G1;
        }
        throw new Exception("\x46\141\151\154\x75\x72\x65\40\144\x65\143\x72\171\x70\x74\x69\x6e\x67\x20\104\x61\164\x61\40\x28\x6f\160\145\156\x73\163\154\40\x70\165\x62\154\151\143\x29\x20\x2d\40" . openssl_error_string);
        G1:
        return $AA;
    }
    private function encryptPrivate($P1)
    {
        if (openssl_private_encrypt($P1, $W7, $this->key, $this->cryptParams["\x70\x61\x64\144\x69\156\x67"])) {
            goto te;
        }
        throw new Exception("\106\x61\x69\x6c\165\x72\x65\x20\145\x6e\143\162\171\x70\x74\151\156\x67\40\104\141\164\141\40\50\x6f\x70\145\156\x73\x73\x6c\x20\160\162\x69\166\x61\x74\x65\x29\40\55\x20" . openssl_error_string());
        te:
        return $W7;
    }
    private function decryptPrivate($P1)
    {
        if (openssl_private_decrypt($P1, $AA, $this->key, $this->cryptParams["\160\141\x64\x64\x69\x6e\x67"])) {
            goto yQ;
        }
        throw new Exception("\106\x61\x69\154\165\162\145\40\x64\x65\x63\x72\171\x70\x74\151\x6e\147\x20\x44\141\164\x61\40\x28\x6f\x70\x65\x6e\x73\163\x6c\40\160\162\x69\166\x61\164\145\x29\40\55\40" . openssl_error_string);
        yQ:
        return $AA;
    }
    private function signOpenSSL($P1)
    {
        $YM = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\x69\147\x65\163\x74"])) {
            goto vF;
        }
        $YM = $this->cryptParams["\144\151\147\x65\163\164"];
        vF:
        if (openssl_sign($P1, $V0, $this->key, $YM)) {
            goto hH;
        }
        throw new Exception("\x46\141\x69\x6c\165\x72\x65\40\123\151\147\156\x69\x6e\x67\x20\104\141\x74\141\72\x20" . openssl_error_string() . "\x20\55\x20" . $YM);
        hH:
        return $V0;
    }
    private function verifyOpenSSL($P1, $V0)
    {
        $YM = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\x67\145\163\x74"])) {
            goto Qa;
        }
        $YM = $this->cryptParams["\144\151\x67\145\163\x74"];
        Qa:
        return openssl_verify($P1, $V0, $this->key, $YM);
    }
    public function encryptData($P1)
    {
        if (!($this->cryptParams["\154\151\x62\x72\141\x72\x79"] === "\x6f\160\145\156\x73\163\x6c")) {
            goto qQ;
        }
        switch ($this->cryptParams["\x74\171\x70\145"]) {
            case "\163\171\155\x6d\x65\164\162\x69\143":
                return $this->encryptSymmetric($P1);
            case "\x70\165\x62\154\151\x63":
                return $this->encryptPublic($P1);
            case "\x70\162\151\x76\141\164\x65":
                return $this->encryptPrivate($P1);
        }
        VG:
        Nw:
        qQ:
    }
    public function decryptData($P1)
    {
        if (!($this->cryptParams["\x6c\151\x62\162\x61\162\x79"] === "\157\160\145\156\163\x73\x6c")) {
            goto rW;
        }
        switch ($this->cryptParams["\164\171\160\145"]) {
            case "\x73\x79\155\x6d\145\x74\x72\x69\x63":
                return $this->decryptSymmetric($P1);
            case "\x70\165\x62\154\x69\x63":
                return $this->decryptPublic($P1);
            case "\x70\162\151\166\x61\164\x65":
                return $this->decryptPrivate($P1);
        }
        Pl:
        jW:
        rW:
    }
    public function signData($P1)
    {
        switch ($this->cryptParams["\x6c\151\142\162\141\x72\171"]) {
            case "\x6f\160\x65\x6e\x73\163\154":
                return $this->signOpenSSL($P1);
            case self::HMAC_SHA1:
                return hash_hmac("\163\x68\141\61", $P1, $this->key, true);
        }
        ut:
        uB:
    }
    public function verifySignature($P1, $V0)
    {
        switch ($this->cryptParams["\x6c\x69\x62\x72\141\162\x79"]) {
            case "\157\x70\x65\x6e\x73\x73\x6c":
                return $this->verifyOpenSSL($P1, $V0);
            case self::HMAC_SHA1:
                $P_ = hash_hmac("\x73\150\141\x31", $P1, $this->key, true);
                return strcmp($V0, $P_) == 0;
        }
        Sh:
        j3:
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\155\145\x74\x68\157\x64"];
    }
    public static function makeAsnSegment($wP, $zz)
    {
        switch ($wP) {
            case 2:
                if (!(ord($zz) > 127)) {
                    goto kC;
                }
                $zz = chr(0) . $zz;
                kC:
                goto NZ;
            case 3:
                $zz = chr(0) . $zz;
                goto NZ;
        }
        kZ:
        NZ:
        $Hx = strlen($zz);
        if ($Hx < 128) {
            goto pl;
        }
        if ($Hx < 256) {
            goto dj;
        }
        if ($Hx < 65536) {
            goto Am;
        }
        $Fd = null;
        goto K4;
        Am:
        $Fd = sprintf("\45\143\45\x63\x25\143\x25\143\45\163", $wP, 130, $Hx / 256, $Hx % 256, $zz);
        K4:
        goto QJ;
        dj:
        $Fd = sprintf("\x25\143\45\x63\x25\x63\45\x73", $wP, 129, $Hx, $zz);
        QJ:
        goto BE;
        pl:
        $Fd = sprintf("\x25\x63\x25\x63\45\163", $wP, $Hx, $zz);
        BE:
        return $Fd;
    }
    public static function convertRSA($GU, $RX)
    {
        $nQ = self::makeAsnSegment(2, $RX);
        $vy = self::makeAsnSegment(2, $GU);
        $hO = self::makeAsnSegment(48, $vy . $nQ);
        $e8 = self::makeAsnSegment(3, $hO);
        $AN = pack("\110\x2a", "\63\x30\60\104\x30\66\x30\71\x32\x41\x38\66\x34\70\x38\66\x46\x37\x30\x44\60\x31\60\61\60\61\60\65\60\x30");
        $pb = self::makeAsnSegment(48, $AN . $e8);
        $oJ = base64_encode($pb);
        $nL = "\x2d\55\55\x2d\x2d\x42\105\x47\x49\116\40\120\125\x42\x4c\111\x43\x20\x4b\x45\x59\x2d\x2d\x2d\x2d\x2d\xa";
        $WB = 0;
        ri:
        if (!($od = substr($oJ, $WB, 64))) {
            goto Ck;
        }
        $nL = $nL . $od . "\xa";
        $WB += 64;
        goto ri;
        Ck:
        return $nL . "\x2d\x2d\55\x2d\x2d\105\x4e\104\40\120\125\x42\x4c\111\103\x20\113\x45\131\x2d\x2d\x2d\55\x2d\12";
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $Ve)
    {
        $cK = new XMLSecEnc();
        $cK->setNode($Ve);
        if ($Gg = $cK->locateKey()) {
            goto Kb;
        }
        throw new Exception("\125\x6e\x61\x62\x6c\x65\x20\x74\x6f\40\154\157\143\141\x74\145\40\141\154\x67\x6f\162\151\164\150\x6d\x20\146\x6f\162\x20\x74\150\x69\163\40\105\156\x63\x72\171\160\x74\145\x64\x20\113\x65\x79");
        Kb:
        $Gg->isEncrypted = true;
        $Gg->encryptedCtx = $cK;
        XMLSecEnc::staticLocateKeyInfo($Gg, $Ve);
        return $Gg;
    }
}
class XMLSecurityDSig
{
    const XMLDSIGNS = "\x68\164\x74\160\x3a\57\57\167\167\x77\56\167\x33\x2e\157\x72\147\x2f\x32\x30\x30\60\x2f\60\x39\57\x78\155\154\x64\163\151\147\43";
    const SHA1 = "\x68\164\164\160\x3a\57\x2f\167\167\167\x2e\167\63\56\157\x72\x67\x2f\62\x30\60\60\57\60\x39\57\x78\155\154\144\x73\151\147\43\x73\x68\x61\61";
    const SHA256 = "\x68\x74\164\160\x3a\57\57\x77\167\x77\x2e\x77\63\56\x6f\162\x67\57\62\x30\60\x31\x2f\x30\x34\x2f\170\155\x6c\x65\x6e\x63\x23\x73\150\x61\x32\x35\x36";
    const SHA384 = "\150\164\164\x70\72\57\x2f\167\167\167\56\167\63\x2e\157\162\147\x2f\x32\x30\x30\x31\57\x30\x34\57\170\x6d\x6c\144\x73\x69\147\x2d\155\157\162\x65\x23\x73\x68\141\63\x38\x34";
    const SHA512 = "\x68\164\164\160\x3a\57\57\167\167\167\x2e\x77\x33\56\x6f\x72\147\57\x32\x30\x30\x31\57\x30\64\57\x78\155\x6c\x65\156\143\43\163\150\x61\x35\61\x32";
    const RIPEMD160 = "\x68\x74\x74\160\x3a\x2f\57\x77\x77\167\x2e\167\x33\x2e\x6f\x72\x67\x2f\x32\60\x30\61\57\x30\64\x2f\170\x6d\154\x65\156\143\43\162\x69\x70\x65\155\144\x31\66\60";
    const C14N = "\x68\164\x74\160\x3a\x2f\x2f\167\x77\x77\56\x77\x33\x2e\x6f\x72\x67\x2f\x54\122\57\62\x30\60\x31\57\x52\x45\x43\x2d\x78\155\154\55\143\x31\64\156\55\62\60\60\x31\x30\x33\x31\x35";
    const C14N_COMMENTS = "\x68\x74\x74\x70\72\x2f\57\x77\x77\x77\x2e\x77\x33\56\157\162\147\x2f\x54\x52\x2f\x32\x30\60\x31\x2f\x52\x45\x43\x2d\170\155\154\x2d\143\61\x34\x6e\55\62\60\x30\61\60\x33\x31\65\x23\127\x69\164\150\103\157\155\155\x65\x6e\164\x73";
    const EXC_C14N = "\x68\164\x74\x70\x3a\57\x2f\167\167\167\x2e\167\63\56\157\162\x67\57\x32\60\x30\x31\57\x31\x30\57\170\x6d\x6c\55\x65\170\x63\x2d\x63\61\x34\156\x23";
    const EXC_C14N_COMMENTS = "\150\x74\164\x70\72\57\57\167\167\167\x2e\x77\x33\56\157\x72\x67\57\x32\x30\60\61\57\x31\60\x2f\170\155\x6c\x2d\145\170\143\55\x63\61\x34\x6e\43\x57\151\x74\150\x43\157\x6d\155\145\x6e\x74\x73";
    const template = "\74\144\163\72\x53\x69\147\x6e\x61\x74\x75\x72\x65\40\x78\x6d\154\x6e\x73\x3a\x64\163\x3d\42\150\164\164\x70\72\57\x2f\167\x77\x77\x2e\x77\x33\x2e\x6f\x72\147\x2f\x32\x30\x30\x30\57\x30\x39\57\x78\x6d\x6c\x64\163\151\147\43\42\76\xd\xa\x20\40\x3c\x64\x73\72\x53\x69\147\156\145\144\111\156\146\157\76\xd\12\x20\x20\40\40\x3c\144\163\x3a\123\151\147\x6e\141\164\x75\x72\145\x4d\x65\164\150\x6f\144\40\x2f\x3e\xd\12\x20\40\x3c\x2f\x64\x73\72\x53\x69\147\156\x65\144\111\x6e\x66\x6f\76\15\xa\74\57\x64\163\72\x53\x69\x67\156\141\164\x75\x72\145\x3e";
    const BASE_TEMPLATE = "\x3c\x53\151\147\156\x61\164\165\162\x65\x20\x78\x6d\154\x6e\x73\75\42\x68\x74\x74\x70\72\x2f\57\167\x77\167\x2e\167\63\x2e\x6f\162\x67\x2f\62\60\x30\60\x2f\60\71\57\170\155\154\x64\x73\151\147\43\42\76\xd\12\40\x20\x3c\x53\x69\147\x6e\x65\144\x49\x6e\x66\x6f\x3e\15\12\x20\40\40\40\74\x53\x69\147\x6e\141\164\165\x72\x65\115\x65\164\150\157\x64\40\x2f\x3e\15\12\x20\40\x3c\x2f\x53\151\x67\156\x65\144\x49\156\146\x6f\76\15\xa\x3c\57\x53\x69\147\x6e\141\164\165\x72\145\76";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\x73\x65\143\144\163\x69\147";
    private $validatedNodes = null;
    public function __construct($dJ = "\144\163")
    {
        $kl = self::BASE_TEMPLATE;
        if (empty($dJ)) {
            goto w2;
        }
        $this->prefix = $dJ . "\72";
        $w6 = array("\74\123", "\74\x2f\123", "\x78\155\x6c\156\x73\x3d");
        $PP = array("\74{$dJ}\72\123", "\x3c\57{$dJ}\x3a\123", "\170\155\x6c\x6e\x73\x3a{$dJ}\75");
        $kl = str_replace($w6, $PP, $kl);
        w2:
        $qF = new DOMDocument();
        $qF->loadXML($kl);
        $this->sigNode = $qF->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto k8;
        }
        $Ty = new DOMXPath($this->sigNode->ownerDocument);
        $Ty->registerNamespace("\163\x65\x63\x64\x73\x69\147", self::XMLDSIGNS);
        $this->xPathCtx = $Ty;
        k8:
        return $this->xPathCtx;
    }
    public static function generateGUID($dJ = "\160\x66\170")
    {
        $Pj = md5(uniqid(mt_rand(), true));
        $Db = $dJ . substr($Pj, 0, 8) . "\x2d" . substr($Pj, 8, 4) . "\x2d" . substr($Pj, 12, 4) . "\x2d" . substr($Pj, 16, 4) . "\x2d" . substr($Pj, 20, 12);
        return $Db;
    }
    public static function generate_GUID($dJ = "\x70\146\170")
    {
        return self::generateGUID($dJ);
    }
    public function locateSignature($zS, $PK = 0)
    {
        if ($zS instanceof DOMDocument) {
            goto jt;
        }
        $lu = $zS->ownerDocument;
        goto ST;
        jt:
        $lu = $zS;
        ST:
        if (!$lu) {
            goto N7;
        }
        $Ty = new DOMXPath($lu);
        $Ty->registerNamespace("\x73\x65\x63\x64\x73\x69\x67", self::XMLDSIGNS);
        $AH = "\x2e\57\57\163\145\x63\144\x73\x69\x67\72\x53\x69\x67\x6e\x61\164\x75\162\145";
        $D4 = $Ty->query($AH, $zS);
        $this->sigNode = $D4->item($PK);
        return $this->sigNode;
        N7:
        return null;
    }
    public function createNewSignNode($ge, $IN = null)
    {
        $lu = $this->sigNode->ownerDocument;
        if (!is_null($IN)) {
            goto G6;
        }
        $sr = $lu->createElementNS(self::XMLDSIGNS, $this->prefix . $ge);
        goto ew;
        G6:
        $sr = $lu->createElementNS(self::XMLDSIGNS, $this->prefix . $ge, $IN);
        ew:
        return $sr;
    }
    public function setCanonicalMethod($Ee)
    {
        switch ($Ee) {
            case "\150\164\x74\x70\x3a\x2f\x2f\x77\x77\x77\56\167\63\56\157\x72\x67\57\x54\x52\x2f\62\x30\x30\61\x2f\x52\105\103\55\x78\x6d\x6c\x2d\143\61\x34\x6e\55\x32\60\x30\61\x30\x33\x31\x35":
            case "\150\164\x74\160\x3a\57\x2f\x77\167\x77\x2e\x77\63\56\157\x72\147\57\x54\122\57\62\x30\x30\x31\57\x52\105\x43\x2d\x78\x6d\154\55\143\x31\64\156\55\x32\60\x30\x31\60\63\61\65\43\x57\151\164\x68\103\x6f\x6d\155\x65\156\164\163":
            case "\150\x74\x74\x70\x3a\x2f\57\x77\x77\x77\x2e\167\63\x2e\x6f\x72\147\x2f\x32\60\60\61\57\x31\60\57\x78\155\x6c\55\x65\x78\143\x2d\143\x31\x34\x6e\43":
            case "\150\x74\x74\x70\x3a\x2f\x2f\x77\x77\167\56\167\63\56\x6f\x72\x67\x2f\x32\60\60\x31\57\61\60\57\x78\x6d\154\55\x65\170\x63\x2d\x63\x31\x34\x6e\x23\x57\151\x74\150\103\x6f\x6d\x6d\x65\156\x74\x73":
                $this->canonicalMethod = $Ee;
                goto RA;
            default:
                throw new Exception("\111\x6e\166\x61\154\x69\144\x20\x43\x61\x6e\x6f\x6e\x69\x63\x61\154\x20\x4d\145\x74\150\x6f\144");
        }
        XD:
        RA:
        if (!($Ty = $this->getXPathObj())) {
            goto SH;
        }
        $AH = "\x2e\57" . $this->searchpfx . "\72\123\151\147\156\145\x64\111\156\146\157";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($uX = $D4->item(0))) {
            goto M4;
        }
        $AH = "\56\x2f" . $this->searchpfx . "\x43\x61\x6e\x6f\156\151\143\141\x6c\x69\172\x61\164\x69\x6f\x6e\x4d\145\x74\150\157\x64";
        $D4 = $Ty->query($AH, $uX);
        if ($KV = $D4->item(0)) {
            goto Dj;
        }
        $KV = $this->createNewSignNode("\103\x61\x6e\x6f\156\151\x63\x61\154\151\x7a\141\x74\x69\x6f\x6e\115\145\164\150\x6f\144");
        $uX->insertBefore($KV, $uX->firstChild);
        Dj:
        $KV->setAttribute("\x41\154\147\157\x72\151\164\150\x6d", $this->canonicalMethod);
        M4:
        SH:
    }
    private function canonicalizeData($sr, $jd, $QV = null, $Fh = null)
    {
        $a5 = false;
        $Hu = false;
        switch ($jd) {
            case "\150\164\x74\160\x3a\x2f\x2f\167\x77\167\x2e\167\63\56\157\162\x67\57\x54\x52\x2f\62\x30\60\61\x2f\122\x45\103\x2d\170\155\154\x2d\x63\x31\x34\156\55\x32\x30\60\61\x30\x33\61\65":
                $a5 = false;
                $Hu = false;
                goto ti;
            case "\x68\x74\164\x70\x3a\x2f\57\x77\x77\x77\56\x77\x33\56\x6f\162\147\57\124\x52\x2f\62\60\60\x31\x2f\122\x45\103\55\x78\155\x6c\55\x63\x31\64\x6e\x2d\x32\x30\x30\61\60\x33\61\65\43\x57\x69\x74\x68\103\157\x6d\x6d\x65\156\164\x73":
                $Hu = true;
                goto ti;
            case "\x68\x74\164\x70\72\57\57\x77\x77\167\x2e\167\x33\56\157\x72\x67\57\x32\x30\x30\x31\x2f\x31\x30\x2f\x78\155\154\55\145\170\x63\x2d\143\x31\x34\x6e\43":
                $a5 = true;
                goto ti;
            case "\150\x74\164\160\72\x2f\x2f\x77\x77\167\x2e\x77\63\x2e\157\162\x67\x2f\x32\60\x30\61\x2f\61\60\x2f\170\155\x6c\55\145\170\x63\55\x63\x31\64\x6e\43\x57\x69\x74\x68\x43\157\155\155\x65\x6e\164\x73":
                $a5 = true;
                $Hu = true;
                goto ti;
        }
        kN:
        ti:
        if (!(is_null($QV) && $sr instanceof DOMNode && $sr->ownerDocument !== null && $sr->isSameNode($sr->ownerDocument->documentElement))) {
            goto sY;
        }
        $Ve = $sr;
        HO:
        if (!($Xa = $Ve->previousSibling)) {
            goto cp;
        }
        if (!($Xa->nodeType == XML_PI_NODE || $Xa->nodeType == XML_COMMENT_NODE && $Hu)) {
            goto PZ;
        }
        goto cp;
        PZ:
        $Ve = $Xa;
        goto HO;
        cp:
        if (!($Xa == null)) {
            goto A2;
        }
        $sr = $sr->ownerDocument;
        A2:
        sY:
        return $sr->C14N($a5, $Hu, $QV, $Fh);
    }
    public function canonicalizeSignedInfo()
    {
        $lu = $this->sigNode->ownerDocument;
        $jd = null;
        if (!$lu) {
            goto s0;
        }
        $Ty = $this->getXPathObj();
        $AH = "\56\x2f\163\145\x63\x64\x73\151\x67\x3a\x53\151\147\x6e\145\x64\x49\x6e\146\x6f";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($bg = $D4->item(0))) {
            goto QO;
        }
        $AH = "\56\57\x73\145\x63\x64\x73\151\x67\x3a\103\x61\x6e\157\156\x69\x63\x61\154\151\172\x61\164\151\157\156\115\x65\164\150\157\x64";
        $D4 = $Ty->query($AH, $bg);
        if (!($KV = $D4->item(0))) {
            goto uP;
        }
        $jd = $KV->getAttribute("\x41\x6c\x67\157\x72\151\x74\150\155");
        uP:
        $this->signedInfo = $this->canonicalizeData($bg, $jd);
        return $this->signedInfo;
        QO:
        s0:
        return null;
    }
    public function calculateDigest($l0, $P1, $Gu = true)
    {
        switch ($l0) {
            case self::SHA1:
                $VN = "\x73\150\x61\61";
                goto yX;
            case self::SHA256:
                $VN = "\163\x68\141\62\x35\x36";
                goto yX;
            case self::SHA384:
                $VN = "\163\150\141\63\x38\64";
                goto yX;
            case self::SHA512:
                $VN = "\x73\150\x61\65\x31\62";
                goto yX;
            case self::RIPEMD160:
                $VN = "\x72\x69\x70\145\x6d\144\x31\66\x30";
                goto yX;
            default:
                throw new Exception("\x43\x61\156\156\157\x74\x20\x76\141\154\151\x64\x61\x74\145\40\144\151\x67\x65\x73\x74\x3a\40\x55\x6e\x73\x75\x70\160\x6f\x72\164\145\144\40\101\x6c\147\x6f\x72\x69\x74\150\x6d\x20\74{$l0}\x3e");
        }
        Vi:
        yX:
        $QD = hash($VN, $P1, true);
        if (!$Gu) {
            goto K0;
        }
        $QD = base64_encode($QD);
        K0:
        return $QD;
    }
    public function validateDigest($Hm, $P1)
    {
        $Ty = new DOMXPath($Hm->ownerDocument);
        $Ty->registerNamespace("\163\x65\x63\x64\163\x69\x67", self::XMLDSIGNS);
        $AH = "\163\164\162\151\156\x67\50\x2e\x2f\163\x65\143\x64\163\151\147\x3a\x44\151\x67\x65\x73\164\x4d\145\x74\x68\x6f\144\x2f\100\x41\154\147\157\162\x69\x74\x68\155\x29";
        $l0 = $Ty->evaluate($AH, $Hm);
        $Wn = $this->calculateDigest($l0, $P1, false);
        $AH = "\x73\x74\x72\x69\156\147\x28\56\x2f\163\x65\143\x64\163\151\x67\x3a\104\x69\x67\145\x73\164\x56\141\154\165\x65\51";
        $L8 = $Ty->evaluate($AH, $Hm);
        return $Wn == base64_decode($L8);
    }
    public function processTransforms($Hm, $ck, $nd = true)
    {
        $P1 = $ck;
        $Ty = new DOMXPath($Hm->ownerDocument);
        $Ty->registerNamespace("\163\145\143\144\163\x69\x67", self::XMLDSIGNS);
        $AH = "\x2e\x2f\163\145\143\144\x73\x69\x67\x3a\x54\x72\x61\x6e\x73\146\x6f\x72\x6d\163\x2f\x73\x65\143\x64\163\151\x67\x3a\x54\x72\141\156\163\146\x6f\x72\155";
        $WM = $Ty->query($AH, $Hm);
        $Zl = "\150\x74\164\x70\x3a\57\57\x77\x77\x77\x2e\167\63\x2e\157\162\147\x2f\124\122\x2f\x32\x30\60\x31\57\x52\105\x43\x2d\170\155\154\x2d\x63\x31\64\x6e\55\62\x30\60\x31\60\63\61\65";
        $QV = null;
        $Fh = null;
        foreach ($WM as $IA) {
            $qO = $IA->getAttribute("\x41\x6c\x67\157\162\151\164\150\155");
            switch ($qO) {
                case "\150\x74\x74\160\72\x2f\x2f\167\167\x77\56\167\x33\x2e\157\162\147\x2f\x32\x30\60\x31\57\61\60\x2f\x78\x6d\154\x2d\x65\x78\x63\55\x63\x31\x34\156\x23":
                case "\x68\164\164\160\72\57\x2f\x77\x77\167\56\167\x33\56\x6f\162\147\x2f\62\x30\x30\x31\57\x31\x30\57\x78\155\154\x2d\x65\x78\x63\55\x63\x31\64\156\x23\127\x69\x74\150\103\x6f\x6d\155\x65\156\x74\x73":
                    if (!$nd) {
                        goto V5;
                    }
                    $Zl = $qO;
                    goto Se;
                    V5:
                    $Zl = "\150\164\164\160\72\x2f\57\167\167\x77\x2e\x77\63\56\x6f\162\x67\x2f\62\60\60\61\x2f\x31\x30\x2f\x78\x6d\x6c\x2d\x65\170\x63\55\143\x31\64\x6e\43";
                    Se:
                    $sr = $IA->firstChild;
                    PP:
                    if (!$sr) {
                        goto IJ;
                    }
                    if (!($sr->localName == "\111\x6e\143\x6c\x75\163\x69\166\x65\x4e\x61\155\145\163\160\141\143\x65\x73")) {
                        goto hu;
                    }
                    if (!($Yh = $sr->getAttribute("\120\x72\x65\146\x69\x78\114\151\163\x74"))) {
                        goto fT;
                    }
                    $D0 = array();
                    $M8 = explode("\x20", $Yh);
                    foreach ($M8 as $Yh) {
                        $LL = trim($Yh);
                        if (empty($LL)) {
                            goto EK;
                        }
                        $D0[] = $LL;
                        EK:
                        SS:
                    }
                    U7:
                    if (!(count($D0) > 0)) {
                        goto Hu;
                    }
                    $Fh = $D0;
                    Hu:
                    fT:
                    goto IJ;
                    hu:
                    $sr = $sr->nextSibling;
                    goto PP;
                    IJ:
                    goto cP;
                case "\150\x74\164\x70\x3a\57\x2f\x77\167\167\x2e\167\x33\56\157\162\x67\57\x54\x52\57\62\60\60\61\x2f\x52\105\103\55\170\x6d\x6c\55\143\x31\64\x6e\x2d\x32\x30\60\x31\x30\x33\x31\65":
                case "\x68\164\164\160\72\57\x2f\x77\167\167\x2e\x77\63\x2e\157\x72\147\x2f\x54\x52\x2f\62\x30\x30\61\57\122\x45\x43\55\170\x6d\154\x2d\x63\61\64\156\x2d\62\60\x30\61\x30\63\61\x35\43\x57\151\164\150\x43\x6f\x6d\155\145\x6e\x74\163":
                    if (!$nd) {
                        goto MC;
                    }
                    $Zl = $qO;
                    goto Cz;
                    MC:
                    $Zl = "\150\164\164\x70\72\x2f\x2f\x77\x77\x77\56\x77\x33\x2e\x6f\162\147\57\124\122\57\62\60\60\x31\x2f\122\x45\103\x2d\170\x6d\x6c\55\x63\61\64\156\55\x32\x30\x30\x31\60\x33\x31\x35";
                    Cz:
                    goto cP;
                case "\x68\x74\x74\160\x3a\x2f\x2f\167\167\x77\x2e\x77\x33\x2e\157\162\x67\x2f\x54\122\x2f\x31\x39\71\71\x2f\x52\105\x43\55\x78\x70\141\164\x68\55\61\x39\x39\71\61\61\61\66":
                    $sr = $IA->firstChild;
                    fW:
                    if (!$sr) {
                        goto wq;
                    }
                    if (!($sr->localName == "\x58\x50\141\164\150")) {
                        goto yq;
                    }
                    $QV = array();
                    $QV["\x71\165\145\x72\171"] = "\50\x2e\57\x2f\56\40\174\x20\x2e\57\57\x40\52\x20\x7c\40\x2e\x2f\57\156\141\x6d\145\163\x70\141\143\145\x3a\72\52\51\133" . $sr->nodeValue . "\x5d";
                    $CL["\156\x61\155\145\163\160\141\143\145\x73"] = array();
                    $N1 = $Ty->query("\x2e\57\156\x61\x6d\x65\x73\160\141\x63\145\x3a\x3a\x2a", $sr);
                    foreach ($N1 as $hJ) {
                        if (!($hJ->localName != "\x78\x6d\x6c")) {
                            goto DG;
                        }
                        $QV["\156\141\155\145\163\x70\x61\143\145\163"][$hJ->localName] = $hJ->nodeValue;
                        DG:
                        TN:
                    }
                    L0:
                    goto wq;
                    yq:
                    $sr = $sr->nextSibling;
                    goto fW;
                    wq:
                    goto cP;
            }
            Kk:
            cP:
            tn:
        }
        nL:
        if (!$P1 instanceof DOMElement) {
            goto VX;
        }
        $P1 = $this->canonicalizeData($ck, $Zl, $QV, $Fh);
        VX:
        return $P1;
    }
    public function processRefNode($Hm)
    {
        $bh = null;
        $nd = true;
        if ($hK = $Hm->getAttribute("\x55\x52\x49")) {
            goto Tt;
        }
        $nd = false;
        $bh = $Hm->ownerDocument;
        goto Oz;
        Tt:
        $QM = parse_url($hK);
        if (empty($QM["\x70\141\164\150"])) {
            goto gq;
        }
        $bh = file_get_contents($QM);
        goto aS1;
        gq:
        if ($gv = $QM["\x66\162\x61\147\x6d\x65\x6e\164"]) {
            goto Y7;
        }
        $bh = $Hm->ownerDocument;
        goto FP;
        Y7:
        $nd = false;
        $YK = new DOMXPath($Hm->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto Fb;
        }
        foreach ($this->idNS as $yF => $Wz) {
            $YK->registerNamespace($yF, $Wz);
            Fl:
        }
        Fp:
        Fb:
        $WA = "\100\111\x64\75\42" . $gv . "\42";
        if (!is_array($this->idKeys)) {
            goto hT;
        }
        foreach ($this->idKeys as $Ft) {
            $WA .= "\40\157\162\x20\x40{$Ft}\75\47{$gv}\x27";
            O2:
        }
        Rj:
        hT:
        $AH = "\x2f\x2f\52\133" . $WA . "\135";
        $bh = $YK->query($AH)->item(0);
        FP:
        aS1:
        Oz:
        $P1 = $this->processTransforms($Hm, $bh, $nd);
        if ($this->validateDigest($Hm, $P1)) {
            goto Mr;
        }
        return false;
        Mr:
        if (!$bh instanceof DOMElement) {
            goto nK;
        }
        if (!empty($gv)) {
            goto Q3;
        }
        $this->validatedNodes[] = $bh;
        goto fs;
        Q3:
        $this->validatedNodes[$gv] = $bh;
        fs:
        nK:
        return true;
    }
    public function getRefNodeID($Hm)
    {
        if (!($hK = $Hm->getAttribute("\125\122\x49"))) {
            goto BM;
        }
        $QM = parse_url($hK);
        if (!empty($QM["\x70\141\164\x68"])) {
            goto Tz;
        }
        if (!($gv = $QM["\x66\x72\x61\x67\155\x65\x6e\x74"])) {
            goto xT;
        }
        return $gv;
        xT:
        Tz:
        BM:
        return null;
    }
    public function getRefIDs()
    {
        $TT = array();
        $Ty = $this->getXPathObj();
        $AH = "\56\x2f\x73\x65\x63\x64\163\151\x67\x3a\x53\x69\147\x6e\145\x64\111\156\x66\x6f\x2f\x73\x65\143\x64\163\x69\147\72\x52\145\146\145\162\x65\156\143\x65";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($D4->length == 0)) {
            goto CQ;
        }
        throw new Exception("\122\145\146\x65\x72\145\156\143\x65\x20\156\x6f\144\145\163\40\156\x6f\x74\x20\x66\x6f\165\x6e\144");
        CQ:
        foreach ($D4 as $Hm) {
            $TT[] = $this->getRefNodeID($Hm);
            Dp:
        }
        mV:
        return $TT;
    }
    public function validateReference()
    {
        $XP = $this->sigNode->ownerDocument->documentElement;
        if ($XP->isSameNode($this->sigNode)) {
            goto W1;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto lx;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        lx:
        W1:
        $Ty = $this->getXPathObj();
        $AH = "\56\x2f\x73\x65\x63\144\x73\x69\x67\x3a\123\151\x67\156\145\144\x49\x6e\x66\157\x2f\x73\145\x63\144\163\151\x67\x3a\122\x65\146\x65\162\145\156\143\145";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($D4->length == 0)) {
            goto E2;
        }
        throw new Exception("\x52\x65\146\145\x72\x65\156\143\145\40\x6e\x6f\x64\x65\163\40\x6e\157\164\40\146\x6f\x75\156\144");
        E2:
        $this->validatedNodes = array();
        foreach ($D4 as $Hm) {
            if ($this->processRefNode($Hm)) {
                goto Fx;
            }
            $this->validatedNodes = null;
            throw new Exception("\x52\x65\146\x65\x72\145\156\143\x65\40\x76\141\154\151\144\x61\164\x69\x6f\156\40\x66\141\x69\x6c\x65\144");
            Fx:
            z2:
        }
        dp:
        return true;
    }
    private function addRefInternal($lK, $sr, $qO, $kw = null, $XV = null)
    {
        $dJ = null;
        $CZ = null;
        $ve = "\111\x64";
        $LR = true;
        $eV = false;
        if (!is_array($XV)) {
            goto Hi;
        }
        $dJ = empty($XV["\x70\162\145\146\151\170"]) ? null : $XV["\x70\162\x65\146\151\170"];
        $CZ = empty($XV["\160\162\145\x66\x69\170\137\x6e\x73"]) ? null : $XV["\160\162\x65\146\x69\x78\x5f\156\x73"];
        $ve = empty($XV["\x69\x64\x5f\x6e\x61\155\145"]) ? "\x49\x64" : $XV["\151\144\x5f\156\x61\155\x65"];
        $LR = !isset($XV["\x6f\166\x65\x72\167\x72\x69\x74\x65"]) ? true : (bool) $XV["\x6f\x76\145\x72\x77\162\x69\x74\145"];
        $eV = !isset($XV["\x66\157\x72\143\x65\137\x75\162\x69"]) ? false : (bool) $XV["\146\157\x72\143\145\x5f\165\x72\151"];
        Hi:
        $oU = $ve;
        if (empty($dJ)) {
            goto ZI;
        }
        $oU = $dJ . "\x3a" . $oU;
        ZI:
        $Hm = $this->createNewSignNode("\122\x65\x66\x65\x72\145\x6e\x63\145");
        $lK->appendChild($Hm);
        if (!$sr instanceof DOMDocument) {
            goto bn;
        }
        if ($eV) {
            goto zq;
        }
        goto pM;
        bn:
        $hK = null;
        if ($LR) {
            goto ox;
        }
        $hK = $CZ ? $sr->getAttributeNS($CZ, $ve) : $sr->getAttribute($ve);
        ox:
        if (!empty($hK)) {
            goto iU;
        }
        $hK = self::generateGUID();
        $sr->setAttributeNS($CZ, $oU, $hK);
        iU:
        $Hm->setAttribute("\125\122\x49", "\43" . $hK);
        goto pM;
        zq:
        $Hm->setAttribute("\125\x52\x49", '');
        pM:
        $R9 = $this->createNewSignNode("\x54\162\x61\x6e\163\x66\x6f\162\x6d\163");
        $Hm->appendChild($R9);
        if (is_array($kw)) {
            goto aZ;
        }
        if (!empty($this->canonicalMethod)) {
            goto A8;
        }
        goto tH;
        aZ:
        foreach ($kw as $IA) {
            $G1 = $this->createNewSignNode("\x54\x72\141\x6e\x73\x66\x6f\162\155");
            $R9->appendChild($G1);
            if (is_array($IA) && !empty($IA["\x68\164\164\x70\x3a\57\57\167\x77\x77\x2e\167\x33\56\x6f\x72\x67\57\x54\122\x2f\x31\x39\x39\71\x2f\x52\x45\x43\55\x78\160\x61\164\x68\x2d\x31\71\x39\71\61\61\x31\x36"]) && !empty($IA["\x68\x74\x74\160\72\57\57\167\167\x77\x2e\167\63\x2e\x6f\x72\147\57\x54\x52\x2f\61\71\71\71\57\122\x45\x43\x2d\170\x70\x61\x74\x68\55\61\x39\71\x39\x31\61\x31\66"]["\x71\x75\145\x72\171"])) {
                goto VQ;
            }
            $G1->setAttribute("\101\x6c\147\x6f\x72\151\x74\x68\x6d", $IA);
            goto qW;
            VQ:
            $G1->setAttribute("\x41\154\x67\157\162\151\x74\x68\155", "\150\164\164\160\72\57\57\167\167\167\x2e\167\x33\x2e\x6f\x72\147\57\x54\122\57\61\x39\71\71\x2f\x52\x45\x43\x2d\x78\160\x61\164\150\55\61\x39\71\71\61\x31\x31\x36");
            $gD = $this->createNewSignNode("\130\x50\x61\x74\150", $IA["\150\164\x74\x70\x3a\57\57\x77\x77\x77\56\x77\x33\56\x6f\162\x67\x2f\x54\122\x2f\61\x39\71\71\57\122\105\x43\x2d\170\160\141\x74\x68\x2d\x31\71\x39\x39\61\61\x31\x36"]["\x71\x75\145\x72\x79"]);
            $G1->appendChild($gD);
            if (empty($IA["\x68\164\164\160\72\57\57\167\x77\x77\56\167\63\56\x6f\162\147\57\124\122\57\61\71\71\x39\x2f\x52\x45\103\55\170\160\x61\164\x68\55\61\71\x39\71\x31\61\61\x36"]["\156\141\x6d\x65\x73\160\141\x63\145\163"])) {
                goto ez;
            }
            foreach ($IA["\x68\164\x74\160\x3a\57\57\167\x77\167\56\x77\63\x2e\157\x72\147\x2f\x54\122\x2f\x31\x39\71\71\x2f\122\105\103\55\x78\x70\x61\164\150\55\x31\x39\x39\x39\61\61\61\x36"]["\x6e\141\155\x65\163\160\x61\143\x65\x73"] as $dJ => $mW) {
                $gD->setAttributeNS("\x68\x74\x74\x70\x3a\57\x2f\x77\x77\167\x2e\167\63\56\157\162\147\x2f\62\60\x30\60\x2f\x78\x6d\154\x6e\163\57", "\170\155\x6c\x6e\x73\72{$dJ}", $mW);
                d1:
            }
            lH:
            ez:
            qW:
            h7:
        }
        Uu:
        goto tH;
        A8:
        $G1 = $this->createNewSignNode("\x54\x72\x61\x6e\163\146\157\162\155");
        $R9->appendChild($G1);
        $G1->setAttribute("\101\154\x67\x6f\x72\151\164\150\x6d", $this->canonicalMethod);
        tH:
        $aS = $this->processTransforms($Hm, $sr);
        $Wn = $this->calculateDigest($qO, $aS);
        $O9 = $this->createNewSignNode("\104\x69\x67\x65\x73\x74\115\145\164\x68\x6f\x64");
        $Hm->appendChild($O9);
        $O9->setAttribute("\x41\154\147\x6f\162\151\x74\x68\x6d", $qO);
        $L8 = $this->createNewSignNode("\x44\151\147\x65\163\164\x56\141\154\x75\x65", $Wn);
        $Hm->appendChild($L8);
    }
    public function addReference($sr, $qO, $kw = null, $XV = null)
    {
        if (!($Ty = $this->getXPathObj())) {
            goto iW;
        }
        $AH = "\56\57\163\145\x63\144\163\x69\x67\x3a\x53\151\x67\x6e\145\x64\x49\x6e\146\157";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($bA = $D4->item(0))) {
            goto Jw;
        }
        $this->addRefInternal($bA, $sr, $qO, $kw, $XV);
        Jw:
        iW:
    }
    public function addReferenceList($PH, $qO, $kw = null, $XV = null)
    {
        if (!($Ty = $this->getXPathObj())) {
            goto a5;
        }
        $AH = "\56\57\163\145\143\x64\163\x69\x67\x3a\x53\151\147\156\x65\144\111\x6e\x66\157";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($bA = $D4->item(0))) {
            goto HH;
        }
        foreach ($PH as $sr) {
            $this->addRefInternal($bA, $sr, $qO, $kw, $XV);
            Ov:
        }
        y8:
        HH:
        a5:
    }
    public function addObject($P1, $Cf = null, $nL = null)
    {
        $Yt = $this->createNewSignNode("\x4f\x62\152\145\x63\164");
        $this->sigNode->appendChild($Yt);
        if (empty($Cf)) {
            goto cU;
        }
        $Yt->setAttribute("\x4d\x69\155\145\124\x79\160\x65", $Cf);
        cU:
        if (empty($nL)) {
            goto a8;
        }
        $Yt->setAttribute("\105\156\x63\157\x64\x69\x6e\147", $nL);
        a8:
        if ($P1 instanceof DOMElement) {
            goto Jl;
        }
        $qe = $this->sigNode->ownerDocument->createTextNode($P1);
        goto Q1;
        Jl:
        $qe = $this->sigNode->ownerDocument->importNode($P1, true);
        Q1:
        $Yt->appendChild($qe);
        return $Yt;
    }
    public function locateKey($sr = null)
    {
        if (!empty($sr)) {
            goto YC;
        }
        $sr = $this->sigNode;
        YC:
        if ($sr instanceof DOMNode) {
            goto zb;
        }
        return null;
        zb:
        if (!($lu = $sr->ownerDocument)) {
            goto Mh;
        }
        $Ty = new DOMXPath($lu);
        $Ty->registerNamespace("\x73\145\x63\144\x73\x69\x67", self::XMLDSIGNS);
        $AH = "\163\164\162\x69\156\147\50\56\x2f\x73\x65\x63\x64\163\x69\x67\x3a\123\x69\147\156\x65\144\111\x6e\x66\x6f\57\x73\145\143\x64\163\151\x67\x3a\123\151\x67\156\141\x74\165\162\145\x4d\x65\164\x68\x6f\x64\57\100\x41\x6c\147\x6f\x72\x69\164\150\155\x29";
        $qO = $Ty->evaluate($AH, $sr);
        if (!$qO) {
            goto n4;
        }
        try {
            $Gg = new XMLSecurityKey($qO, array("\164\x79\x70\145" => "\x70\x75\x62\154\151\143"));
        } catch (Exception $Ms) {
            return null;
        }
        return $Gg;
        n4:
        Mh:
        return null;
    }
    public function verify($Gg)
    {
        $lu = $this->sigNode->ownerDocument;
        $Ty = new DOMXPath($lu);
        $Ty->registerNamespace("\163\x65\143\144\163\x69\x67", self::XMLDSIGNS);
        $AH = "\x73\x74\x72\151\x6e\147\50\56\57\x73\145\x63\x64\x73\151\147\72\123\151\147\156\141\164\165\x72\x65\x56\141\x6c\x75\x65\51";
        $s3 = $Ty->evaluate($AH, $this->sigNode);
        if (!empty($s3)) {
            goto zP;
        }
        throw new Exception("\125\x6e\x61\x62\154\145\x20\x74\157\40\x6c\157\x63\x61\164\145\x20\123\151\147\156\141\164\x75\162\145\126\141\154\165\x65");
        zP:
        return $Gg->verifySignature($this->signedInfo, base64_decode($s3));
    }
    public function signData($Gg, $P1)
    {
        return $Gg->signData($P1);
    }
    public function sign($Gg, $uL = null)
    {
        if (!($uL != null)) {
            goto kz;
        }
        $this->resetXPathObj();
        $this->appendSignature($uL);
        $this->sigNode = $uL->lastChild;
        kz:
        if (!($Ty = $this->getXPathObj())) {
            goto i7;
        }
        $AH = "\56\x2f\x73\x65\143\144\x73\x69\147\72\x53\151\147\x6e\145\144\x49\156\146\157";
        $D4 = $Ty->query($AH, $this->sigNode);
        if (!($bA = $D4->item(0))) {
            goto JR;
        }
        $AH = "\x2e\57\163\145\143\144\x73\151\147\x3a\x53\151\x67\156\x61\x74\165\x72\145\x4d\x65\x74\x68\x6f\144";
        $D4 = $Ty->query($AH, $bA);
        $mM = $D4->item(0);
        $mM->setAttribute("\x41\x6c\147\157\x72\x69\164\150\155", $Gg->type);
        $P1 = $this->canonicalizeData($bA, $this->canonicalMethod);
        $s3 = base64_encode($this->signData($Gg, $P1));
        $Nb = $this->createNewSignNode("\123\151\147\156\x61\x74\x75\x72\145\126\141\x6c\165\145", $s3);
        if ($Ic = $bA->nextSibling) {
            goto dO1;
        }
        $this->sigNode->appendChild($Nb);
        goto is;
        dO1:
        $Ic->parentNode->insertBefore($Nb, $Ic);
        is:
        JR:
        i7:
    }
    public function appendCert()
    {
    }
    public function appendKey($Gg, $Iz = null)
    {
        $Gg->serializeKey($Iz);
    }
    public function insertSignature($sr, $mf = null)
    {
        $Wt = $sr->ownerDocument;
        $on = $Wt->importNode($this->sigNode, true);
        if ($mf == null) {
            goto P_;
        }
        return $sr->insertBefore($on, $mf);
        goto yl;
        P_:
        return $sr->insertBefore($on);
        yl:
    }
    public function appendSignature($oG, $F1 = false)
    {
        $mf = $F1 ? $oG->firstChild : null;
        return $this->insertSignature($oG, $mf);
    }
    public static function get509XCert($fg, $U1 = true)
    {
        $Sx = self::staticGet509XCerts($fg, $U1);
        if (empty($Sx)) {
            goto UL;
        }
        return $Sx[0];
        UL:
        return '';
    }
    public static function staticGet509XCerts($Sx, $U1 = true)
    {
        if ($U1) {
            goto YI;
        }
        return array($Sx);
        goto MO;
        YI:
        $P1 = '';
        $EN = array();
        $Ou = explode("\12", $Sx);
        $md = false;
        foreach ($Ou as $ze) {
            if (!$md) {
                goto ks;
            }
            if (!(strncmp($ze, "\x2d\55\x2d\55\x2d\x45\x4e\x44\x20\x43\105\122\x54\x49\x46\111\103\101\x54\105", 20) == 0)) {
                goto ya;
            }
            $md = false;
            $EN[] = $P1;
            $P1 = '';
            goto bI;
            ya:
            $P1 .= trim($ze);
            goto ba;
            ks:
            if (!(strncmp($ze, "\x2d\x2d\55\55\55\102\x45\107\111\116\x20\103\x45\x52\124\111\106\x49\x43\x41\x54\x45", 22) == 0)) {
                goto b3;
            }
            $md = true;
            b3:
            ba:
            bI:
        }
        Kc:
        return $EN;
        MO:
    }
    public static function staticAdd509Cert($Dx, $fg, $U1 = true, $fN = false, $Ty = null, $XV = null)
    {
        if (!$fN) {
            goto nR;
        }
        $fg = file_get_contents($fg);
        nR:
        if ($Dx instanceof DOMElement) {
            goto Ni;
        }
        throw new Exception("\111\156\x76\x61\x6c\x69\x64\x20\160\x61\162\x65\x6e\164\40\116\157\144\x65\x20\160\141\x72\x61\155\x65\x74\x65\x72");
        Ni:
        $zF = $Dx->ownerDocument;
        if (!empty($Ty)) {
            goto jM;
        }
        $Ty = new DOMXPath($Dx->ownerDocument);
        $Ty->registerNamespace("\163\145\x63\x64\x73\151\147", self::XMLDSIGNS);
        jM:
        $AH = "\x2e\57\x73\x65\x63\144\163\151\x67\x3a\x4b\x65\x79\x49\x6e\146\157";
        $D4 = $Ty->query($AH, $Dx);
        $Zj = $D4->item(0);
        $iZ = '';
        if (!$Zj) {
            goto A5;
        }
        $Yh = $Zj->lookupPrefix(self::XMLDSIGNS);
        if (empty($Yh)) {
            goto rI;
        }
        $iZ = $Yh . "\x3a";
        rI:
        goto Ih;
        A5:
        $Yh = $Dx->lookupPrefix(self::XMLDSIGNS);
        if (empty($Yh)) {
            goto EM;
        }
        $iZ = $Yh . "\72";
        EM:
        $A5 = false;
        $Zj = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\x4b\145\171\x49\156\146\157");
        $AH = "\56\x2f\163\x65\x63\144\x73\x69\x67\x3a\117\x62\152\x65\x63\164";
        $D4 = $Ty->query($AH, $Dx);
        if (!($Ot = $D4->item(0))) {
            goto Vb;
        }
        $Ot->parentNode->insertBefore($Zj, $Ot);
        $A5 = true;
        Vb:
        if ($A5) {
            goto ui;
        }
        $Dx->appendChild($Zj);
        ui:
        Ih:
        $Sx = self::staticGet509XCerts($fg, $U1);
        $qL = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\x58\65\60\71\104\141\164\x61");
        $Zj->appendChild($qL);
        $WF = false;
        $GX = false;
        if (!is_array($XV)) {
            goto X0;
        }
        if (empty($XV["\x69\163\163\x75\145\x72\123\145\x72\151\x61\154"])) {
            goto ft;
        }
        $WF = true;
        ft:
        if (empty($XV["\163\x75\142\152\145\x63\x74\x4e\x61\155\x65"])) {
            goto tv;
        }
        $GX = true;
        tv:
        X0:
        foreach ($Sx as $fz) {
            if (!($WF || $GX)) {
                goto hk;
            }
            if (!($T9 = openssl_x509_parse("\x2d\x2d\55\x2d\55\x42\x45\107\111\116\x20\x43\x45\x52\x54\111\106\111\103\x41\124\105\x2d\55\55\x2d\55\xa" . chunk_split($fz, 64, "\12") . "\x2d\55\55\55\55\105\x4e\x44\x20\x43\x45\122\124\111\x46\x49\103\101\124\x45\55\55\x2d\x2d\55\12"))) {
                goto V7;
            }
            if (!($GX && !empty($T9["\163\165\142\152\145\143\x74"]))) {
                goto Qx;
            }
            if (is_array($T9["\x73\x75\x62\152\x65\143\164"])) {
                goto w9;
            }
            $fa = $T9["\x69\x73\x73\165\x65\x72"];
            goto G2;
            w9:
            $IO = array();
            foreach ($T9["\163\x75\x62\x6a\x65\x63\164"] as $xt => $IN) {
                if (is_array($IN)) {
                    goto jr;
                }
                array_unshift($IO, "{$xt}\x3d{$IN}");
                goto mz;
                jr:
                foreach ($IN as $B7) {
                    array_unshift($IO, "{$xt}\75{$B7}");
                    UU:
                }
                NG:
                mz:
                mW:
            }
            qe:
            $fa = implode("\54", $IO);
            G2:
            $Uo = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\x58\65\x30\71\x53\165\142\x6a\x65\x63\164\116\141\x6d\x65", $fa);
            $qL->appendChild($Uo);
            Qx:
            if (!($WF && !empty($T9["\x69\163\x73\165\x65\x72"]) && !empty($T9["\163\x65\162\151\x61\154\116\165\155\142\x65\x72"]))) {
                goto Ue;
            }
            if (is_array($T9["\x69\163\x73\165\x65\162"])) {
                goto JE;
            }
            $v7 = $T9["\151\163\163\165\x65\x72"];
            goto yw;
            JE:
            $IO = array();
            foreach ($T9["\151\x73\163\165\x65\x72"] as $xt => $IN) {
                array_unshift($IO, "{$xt}\x3d{$IN}");
                tD:
            }
            kq:
            $v7 = implode("\x2c", $IO);
            yw:
            $ca = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\130\65\60\x39\111\x73\163\x75\x65\x72\123\145\162\151\141\x6c");
            $qL->appendChild($ca);
            $ZK = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\130\65\x30\71\x49\163\163\x75\x65\x72\116\141\155\145", $v7);
            $ca->appendChild($ZK);
            $ZK = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\130\x35\60\71\x53\145\x72\x69\141\154\116\x75\155\x62\x65\x72", $T9["\163\x65\162\x69\141\154\116\x75\155\x62\145\x72"]);
            $ca->appendChild($ZK);
            Ue:
            V7:
            hk:
            $Rm = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\x58\65\x30\x39\103\x65\x72\x74\x69\146\151\143\141\x74\145", $fz);
            $qL->appendChild($Rm);
            NA:
        }
        MK:
    }
    public function add509Cert($fg, $U1 = true, $fN = false, $XV = null)
    {
        if (!($Ty = $this->getXPathObj())) {
            goto g_;
        }
        self::staticAdd509Cert($this->sigNode, $fg, $U1, $fN, $Ty, $XV);
        g_:
    }
    public function appendToKeyInfo($sr)
    {
        $Dx = $this->sigNode;
        $zF = $Dx->ownerDocument;
        $Ty = $this->getXPathObj();
        if (!empty($Ty)) {
            goto yA;
        }
        $Ty = new DOMXPath($Dx->ownerDocument);
        $Ty->registerNamespace("\x73\145\x63\144\163\151\147", self::XMLDSIGNS);
        yA:
        $AH = "\x2e\57\163\x65\143\144\163\x69\147\x3a\x4b\x65\171\111\x6e\x66\157";
        $D4 = $Ty->query($AH, $Dx);
        $Zj = $D4->item(0);
        if ($Zj) {
            goto Tb;
        }
        $iZ = '';
        $Yh = $Dx->lookupPrefix(self::XMLDSIGNS);
        if (empty($Yh)) {
            goto Cq;
        }
        $iZ = $Yh . "\72";
        Cq:
        $A5 = false;
        $Zj = $zF->createElementNS(self::XMLDSIGNS, $iZ . "\113\x65\x79\111\156\146\157");
        $AH = "\56\x2f\163\x65\x63\144\163\x69\147\x3a\117\142\152\145\x63\164";
        $D4 = $Ty->query($AH, $Dx);
        if (!($Ot = $D4->item(0))) {
            goto Ry;
        }
        $Ot->parentNode->insertBefore($Zj, $Ot);
        $A5 = true;
        Ry:
        if ($A5) {
            goto YF;
        }
        $Dx->appendChild($Zj);
        YF:
        Tb:
        $Zj->appendChild($sr);
        return $Zj;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
class XMLSecEnc
{
    const template = "\74\170\x65\x6e\143\x3a\105\156\x63\x72\171\x70\x74\145\x64\x44\141\164\x61\40\170\155\154\x6e\163\x3a\x78\145\156\x63\x3d\47\x68\x74\x74\x70\x3a\57\57\x77\x77\167\56\x77\x33\56\x6f\162\147\x2f\62\60\60\61\x2f\60\x34\x2f\170\x6d\154\145\x6e\x63\x23\47\x3e\xd\12\40\x20\40\74\x78\x65\156\x63\72\x43\151\160\150\x65\162\104\141\164\141\x3e\15\12\x20\x20\40\40\40\40\74\170\x65\x6e\143\x3a\103\151\x70\150\145\162\126\x61\154\165\x65\x3e\74\x2f\170\x65\x6e\x63\72\x43\x69\160\150\145\162\x56\141\154\165\145\x3e\15\12\x20\40\40\x3c\x2f\x78\x65\x6e\143\72\x43\151\x70\x68\x65\x72\x44\x61\x74\141\76\xd\xa\x3c\x2f\x78\145\156\x63\x3a\105\156\143\162\171\160\164\145\144\x44\141\164\141\x3e";
    const Element = "\x68\x74\164\x70\x3a\57\x2f\167\167\167\x2e\167\63\56\x6f\x72\147\57\62\60\x30\x31\57\x30\x34\57\x78\x6d\x6c\x65\156\x63\43\105\x6c\145\x6d\x65\156\164";
    const Content = "\150\164\164\x70\72\x2f\57\167\x77\x77\x2e\167\63\56\157\x72\147\x2f\62\x30\x30\x31\57\x30\64\x2f\170\155\154\145\156\x63\43\103\157\x6e\164\145\156\x74";
    const URI = 3;
    const XMLENCNS = "\x68\x74\164\x70\72\x2f\57\167\x77\167\56\x77\x33\x2e\157\162\147\57\x32\x30\x30\x31\57\x30\x34\57\170\x6d\154\x65\x6e\143\x23";
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
    public function addReference($ge, $sr, $wP)
    {
        if ($sr instanceof DOMNode) {
            goto HM;
        }
        throw new Exception("\x24\x6e\157\144\x65\40\x69\x73\40\x6e\157\164\x20\x6f\x66\x20\x74\x79\160\x65\x20\104\x4f\x4d\x4e\157\144\x65");
        HM:
        $as = $this->encdoc;
        $this->_resetTemplate();
        $yj = $this->encdoc;
        $this->encdoc = $as;
        $Tj = XMLSecurityDSig::generateGUID();
        $Ve = $yj->documentElement;
        $Ve->setAttribute("\x49\144", $Tj);
        $this->references[$ge] = array("\156\x6f\144\x65" => $sr, "\x74\x79\x70\x65" => $wP, "\145\x6e\143\x6e\x6f\x64\x65" => $yj, "\162\145\x66\165\162\151" => $Tj);
    }
    public function setNode($sr)
    {
        $this->rawNode = $sr;
    }
    public function encryptNode($Gg, $PP = true)
    {
        $P1 = '';
        if (!empty($this->rawNode)) {
            goto LY;
        }
        throw new Exception("\x4e\x6f\x64\145\40\x74\157\40\x65\x6e\x63\162\171\x70\x74\x20\150\141\163\x20\x6e\x6f\x74\x20\142\x65\145\156\x20\x73\145\164");
        LY:
        if ($Gg instanceof XMLSecurityKey) {
            goto rl;
        }
        throw new Exception("\111\x6e\x76\141\154\151\144\40\x4b\145\171");
        rl:
        $lu = $this->rawNode->ownerDocument;
        $YK = new DOMXPath($this->encdoc);
        $ts = $YK->query("\57\x78\145\156\x63\x3a\x45\156\x63\162\171\x70\164\x65\x64\x44\x61\x74\141\x2f\170\145\156\143\x3a\x43\x69\160\x68\x65\162\x44\x61\x74\141\x2f\170\x65\156\143\72\x43\x69\x70\x68\145\x72\126\141\x6c\x75\x65");
        $n0 = $ts->item(0);
        if (!($n0 == null)) {
            goto SO;
        }
        throw new Exception("\x45\162\x72\157\162\40\x6c\157\143\141\x74\151\156\x67\x20\x43\x69\x70\x68\x65\162\126\x61\x6c\165\x65\40\145\154\145\x6d\145\156\x74\x20\167\x69\x74\x68\x69\x6e\40\x74\x65\155\x70\154\x61\164\x65");
        SO:
        switch ($this->type) {
            case self::Element:
                $P1 = $lu->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\124\171\160\145", self::Element);
                goto X4;
            case self::Content:
                $dn = $this->rawNode->childNodes;
                foreach ($dn as $lt) {
                    $P1 .= $lu->saveXML($lt);
                    pm:
                }
                Ku:
                $this->encdoc->documentElement->setAttribute("\124\171\x70\x65", self::Content);
                goto X4;
            default:
                throw new Exception("\x54\171\160\145\40\x69\x73\x20\143\x75\162\x72\145\156\x74\x6c\171\40\156\157\164\40\163\x75\x70\x70\157\162\x74\145\144");
        }
        JU:
        X4:
        $wi = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\143\72\105\156\143\x72\x79\160\164\151\157\x6e\x4d\x65\x74\x68\157\x64"));
        $wi->setAttribute("\101\x6c\x67\x6f\x72\x69\x74\x68\155", $Gg->getAlgorithm());
        $n0->parentNode->parentNode->insertBefore($wi, $n0->parentNode->parentNode->firstChild);
        $B2 = base64_encode($Gg->encryptData($P1));
        $IN = $this->encdoc->createTextNode($B2);
        $n0->appendChild($IN);
        if ($PP) {
            goto K1;
        }
        return $this->encdoc->documentElement;
        goto TT;
        K1:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto i6;
                }
                return $this->encdoc;
                i6:
                $jy = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($jy, $this->rawNode);
                return $jy;
            case self::Content:
                $jy = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                Ev:
                if (!$this->rawNode->firstChild) {
                    goto jH;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto Ev;
                jH:
                $this->rawNode->appendChild($jy);
                return $jy;
        }
        mD:
        ho:
        TT:
    }
    public function encryptReferences($Gg)
    {
        $JO = $this->rawNode;
        $yp = $this->type;
        foreach ($this->references as $ge => $MN) {
            $this->encdoc = $MN["\145\x6e\x63\x6e\x6f\144\x65"];
            $this->rawNode = $MN["\156\x6f\x64\x65"];
            $this->type = $MN["\x74\x79\x70\x65"];
            try {
                $UI = $this->encryptNode($Gg);
                $this->references[$ge]["\145\x6e\x63\156\x6f\144\x65"] = $UI;
            } catch (Exception $Ms) {
                $this->rawNode = $JO;
                $this->type = $yp;
                throw $Ms;
            }
            Gr:
        }
        RR:
        $this->rawNode = $JO;
        $this->type = $yp;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto G_;
        }
        throw new Exception("\116\157\x64\145\40\164\x6f\x20\x64\x65\x63\162\x79\x70\164\40\x68\141\x73\40\156\157\x74\x20\x62\x65\145\x6e\x20\x73\145\164");
        G_:
        $lu = $this->rawNode->ownerDocument;
        $YK = new DOMXPath($lu);
        $YK->registerNamespace("\x78\155\154\x65\x6e\143\162", self::XMLENCNS);
        $AH = "\56\x2f\170\155\154\145\x6e\143\162\x3a\103\151\160\150\145\x72\104\141\164\141\x2f\x78\x6d\x6c\145\156\x63\x72\x3a\x43\x69\160\x68\145\x72\126\141\x6c\165\x65";
        $D4 = $YK->query($AH, $this->rawNode);
        $sr = $D4->item(0);
        if ($sr) {
            goto jZ;
        }
        return null;
        jZ:
        return base64_decode($sr->nodeValue);
    }
    public function decryptNode($Gg, $PP = true)
    {
        if ($Gg instanceof XMLSecurityKey) {
            goto NY;
        }
        throw new Exception("\x49\x6e\x76\141\x6c\151\144\40\113\x65\171");
        NY:
        $py = $this->getCipherValue();
        if ($py) {
            goto fm;
        }
        throw new Exception("\x43\141\156\x6e\x6f\x74\x20\x6c\x6f\x63\x61\x74\x65\x20\145\156\143\x72\x79\x70\x74\x65\x64\x20\144\x61\x74\x61");
        goto hj;
        fm:
        $AA = $Gg->decryptData($py);
        if ($PP) {
            goto kg;
        }
        return $AA;
        goto Fi;
        kg:
        switch ($this->type) {
            case self::Element:
                $GH = new DOMDocument();
                $GH->loadXML($AA);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto MS;
                }
                return $GH;
                MS:
                $jy = $this->rawNode->ownerDocument->importNode($GH->documentElement, true);
                $this->rawNode->parentNode->replaceChild($jy, $this->rawNode);
                return $jy;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto N4;
                }
                $lu = $this->rawNode->ownerDocument;
                goto cl;
                N4:
                $lu = $this->rawNode;
                cl:
                $BO = $lu->createDocumentFragment();
                $BO->appendXML($AA);
                $Iz = $this->rawNode->parentNode;
                $Iz->replaceChild($BO, $this->rawNode);
                return $Iz;
            default:
                return $AA;
        }
        Sz:
        c3:
        Fi:
        hj:
    }
    public function encryptKey($B9, $EU, $vX = true)
    {
        if (!(!$B9 instanceof XMLSecurityKey || !$EU instanceof XMLSecurityKey)) {
            goto cH;
        }
        throw new Exception("\111\x6e\x76\x61\154\151\144\40\113\x65\x79");
        cH:
        $U6 = base64_encode($B9->encryptData($EU->key));
        $Eb = $this->encdoc->documentElement;
        $MM = $this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\143\x3a\x45\x6e\143\x72\171\160\x74\x65\x64\x4b\x65\171");
        if ($vX) {
            goto ED;
        }
        $this->encKey = $MM;
        goto yz;
        ED:
        $Zj = $Eb->insertBefore($this->encdoc->createElementNS("\x68\x74\x74\x70\72\57\57\167\167\167\x2e\x77\63\x2e\x6f\x72\147\x2f\x32\60\x30\60\57\60\71\x2f\170\x6d\154\144\x73\x69\147\43", "\144\163\x69\147\x3a\x4b\145\171\111\156\146\x6f"), $Eb->firstChild);
        $Zj->appendChild($MM);
        yz:
        $wi = $MM->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\156\143\72\x45\x6e\x63\162\171\160\x74\x69\x6f\x6e\115\145\x74\x68\x6f\144"));
        $wi->setAttribute("\x41\x6c\x67\x6f\x72\x69\x74\x68\x6d", $B9->getAlgorithm());
        if (empty($B9->name)) {
            goto sI;
        }
        $Zj = $MM->appendChild($this->encdoc->createElementNS("\x68\x74\x74\x70\x3a\x2f\x2f\167\167\167\56\167\x33\56\x6f\162\x67\57\62\x30\60\60\57\x30\71\57\x78\155\x6c\x64\x73\x69\147\43", "\144\163\151\x67\72\113\x65\x79\x49\156\x66\157"));
        $Zj->appendChild($this->encdoc->createElementNS("\150\164\164\x70\72\57\x2f\x77\167\167\x2e\x77\63\56\x6f\162\x67\57\62\60\x30\x30\57\x30\71\x2f\170\x6d\154\144\163\151\147\x23", "\x64\163\151\147\x3a\113\145\x79\116\x61\155\x65", $B9->name));
        sI:
        $IJ = $MM->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\143\72\103\x69\160\150\x65\162\x44\141\164\x61"));
        $IJ->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\156\x63\72\103\151\x70\x68\x65\162\x56\x61\154\165\x65", $U6));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto vr;
        }
        $oX = $MM->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\143\x3a\x52\x65\x66\x65\x72\x65\x6e\143\145\114\151\x73\x74"));
        foreach ($this->references as $ge => $MN) {
            $Tj = $MN["\x72\145\x66\x75\162\151"];
            $Ze = $oX->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\143\72\x44\x61\164\x61\122\145\x66\145\162\145\156\143\145"));
            $Ze->setAttribute("\x55\122\111", "\43" . $Tj);
            Kj:
        }
        Mk:
        vr:
        return;
    }
    public function decryptKey($MM)
    {
        if ($MM->isEncrypted) {
            goto zD;
        }
        throw new Exception("\113\x65\171\40\151\x73\x20\156\x6f\164\x20\105\x6e\143\162\171\x70\x74\x65\144");
        zD:
        if (!empty($MM->key)) {
            goto fM;
        }
        throw new Exception("\113\x65\171\x20\151\163\x20\x6d\151\x73\163\x69\156\x67\x20\144\x61\x74\x61\40\x74\157\x20\x70\145\x72\146\x6f\162\155\40\x74\150\145\x20\x64\145\143\x72\x79\x70\164\151\157\x6e");
        fM:
        return $this->decryptNode($MM, false);
    }
    public function locateEncryptedData($Ve)
    {
        if ($Ve instanceof DOMDocument) {
            goto Q6;
        }
        $lu = $Ve->ownerDocument;
        goto Dv;
        Q6:
        $lu = $Ve;
        Dv:
        if (!$lu) {
            goto kj;
        }
        $Ty = new DOMXPath($lu);
        $AH = "\57\x2f\52\x5b\x6c\157\x63\141\154\x2d\x6e\x61\155\x65\x28\x29\x3d\47\105\156\x63\x72\171\x70\164\145\144\x44\x61\x74\141\47\40\141\156\x64\x20\156\x61\x6d\x65\163\160\x61\143\145\55\165\x72\151\50\51\x3d\47" . self::XMLENCNS . "\47\x5d";
        $D4 = $Ty->query($AH);
        return $D4->item(0);
        kj:
        return null;
    }
    public function locateKey($sr = null)
    {
        if (!empty($sr)) {
            goto W8;
        }
        $sr = $this->rawNode;
        W8:
        if ($sr instanceof DOMNode) {
            goto NU;
        }
        return null;
        NU:
        if (!($lu = $sr->ownerDocument)) {
            goto pA;
        }
        $Ty = new DOMXPath($lu);
        $Ty->registerNamespace("\170\x6d\154\x73\145\143\x65\156\x63", self::XMLENCNS);
        $AH = "\56\x2f\57\170\155\154\x73\x65\x63\145\156\x63\x3a\105\156\x63\162\x79\x70\x74\151\157\156\115\145\x74\150\157\x64";
        $D4 = $Ty->query($AH, $sr);
        if (!($E1 = $D4->item(0))) {
            goto Nq;
        }
        $W1 = $E1->getAttribute("\101\x6c\147\x6f\162\151\x74\150\155");
        try {
            $Gg = new XMLSecurityKey($W1, array("\x74\x79\160\145" => "\x70\x72\151\x76\141\164\x65"));
        } catch (Exception $Ms) {
            return null;
        }
        return $Gg;
        Nq:
        pA:
        return null;
    }
    public static function staticLocateKeyInfo($Jr = null, $sr = null)
    {
        if (!(empty($sr) || !$sr instanceof DOMNode)) {
            goto qu;
        }
        return null;
        qu:
        $lu = $sr->ownerDocument;
        if ($lu) {
            goto Pq;
        }
        return null;
        Pq:
        $Ty = new DOMXPath($lu);
        $Ty->registerNamespace("\x78\155\x6c\x73\x65\x63\x65\x6e\143", self::XMLENCNS);
        $Ty->registerNamespace("\x78\x6d\x6c\x73\x65\143\144\163\x69\147", XMLSecurityDSig::XMLDSIGNS);
        $AH = "\x2e\57\x78\x6d\x6c\x73\145\x63\x64\x73\x69\x67\x3a\x4b\x65\171\x49\x6e\x66\x6f";
        $D4 = $Ty->query($AH, $sr);
        $E1 = $D4->item(0);
        if ($E1) {
            goto wQ;
        }
        return $Jr;
        wQ:
        foreach ($E1->childNodes as $lt) {
            switch ($lt->localName) {
                case "\x4b\x65\x79\116\141\155\145":
                    if (empty($Jr)) {
                        goto wf;
                    }
                    $Jr->name = $lt->nodeValue;
                    wf:
                    goto P3;
                case "\x4b\145\171\126\x61\x6c\165\x65":
                    foreach ($lt->childNodes as $Nk) {
                        switch ($Nk->localName) {
                            case "\104\x53\x41\113\145\x79\126\141\154\x75\145":
                                throw new Exception("\x44\123\101\113\145\x79\x56\141\x6c\165\x65\40\143\165\x72\162\x65\x6e\164\154\171\40\156\x6f\164\40\163\165\x70\x70\157\162\164\145\144");
                            case "\x52\123\101\113\x65\x79\126\x61\x6c\x75\x65":
                                $GU = null;
                                $RX = null;
                                if (!($K4 = $Nk->getElementsByTagName("\115\157\144\x75\154\165\x73")->item(0))) {
                                    goto d3;
                                }
                                $GU = base64_decode($K4->nodeValue);
                                d3:
                                if (!($l_ = $Nk->getElementsByTagName("\105\x78\160\157\x6e\x65\156\x74")->item(0))) {
                                    goto DZ;
                                }
                                $RX = base64_decode($l_->nodeValue);
                                DZ:
                                if (!(empty($GU) || empty($RX))) {
                                    goto n7;
                                }
                                throw new Exception("\x4d\151\163\x73\151\156\x67\x20\115\157\x64\x75\x6c\165\163\40\x6f\162\40\x45\170\160\157\x6e\145\x6e\x74");
                                n7:
                                $O5 = XMLSecurityKey::convertRSA($GU, $RX);
                                $Jr->loadKey($O5);
                                goto vc;
                        }
                        tm:
                        vc:
                        UQ:
                    }
                    rs:
                    goto P3;
                case "\122\x65\164\162\x69\x65\166\x61\154\x4d\x65\x74\x68\x6f\x64":
                    $wP = $lt->getAttribute("\x54\171\160\145");
                    if (!($wP !== "\x68\164\164\160\x3a\57\57\x77\x77\167\x2e\167\63\56\157\x72\147\x2f\x32\x30\x30\61\x2f\60\64\57\170\x6d\x6c\145\x6e\x63\x23\105\156\143\162\x79\160\164\145\144\113\145\x79")) {
                        goto CO;
                    }
                    goto P3;
                    CO:
                    $hK = $lt->getAttribute("\x55\122\111");
                    if (!($hK[0] !== "\x23")) {
                        goto m5;
                    }
                    goto P3;
                    m5:
                    $fO = substr($hK, 1);
                    $AH = "\x2f\x2f\x78\155\154\x73\x65\x63\x65\156\x63\x3a\105\156\143\162\171\160\164\145\x64\113\x65\x79\x5b\100\x49\x64\x3d\x27{$fO}\x27\135";
                    $Gn = $Ty->query($AH)->item(0);
                    if ($Gn) {
                        goto GA;
                    }
                    throw new Exception("\125\156\x61\142\x6c\x65\40\x74\x6f\x20\x6c\157\143\141\164\145\40\105\156\143\x72\171\x70\164\145\x64\x4b\145\x79\x20\167\x69\164\x68\x20\x40\x49\x64\75\47{$fO}\x27\x2e");
                    GA:
                    return XMLSecurityKey::fromEncryptedKeyElement($Gn);
                case "\105\x6e\x63\162\171\x70\164\145\x64\x4b\145\x79":
                    return XMLSecurityKey::fromEncryptedKeyElement($lt);
                case "\130\65\60\71\x44\141\164\x61":
                    if (!($Vn = $lt->getElementsByTagName("\130\x35\x30\x39\x43\x65\162\164\151\x66\x69\143\141\164\145"))) {
                        goto uA;
                    }
                    if (!($Vn->length > 0)) {
                        goto r8;
                    }
                    $Ax = $Vn->item(0)->textContent;
                    $Ax = str_replace(array("\xd", "\xa", "\40"), '', $Ax);
                    $Ax = "\55\55\x2d\x2d\x2d\x42\105\x47\x49\116\40\103\x45\122\124\111\x46\111\x43\101\x54\105\x2d\55\x2d\x2d\55\12" . chunk_split($Ax, 64, "\12") . "\55\55\x2d\x2d\55\x45\116\x44\40\x43\x45\x52\124\111\x46\x49\103\x41\124\x45\x2d\x2d\x2d\55\x2d\12";
                    $Jr->loadKey($Ax, false, true);
                    r8:
                    uA:
                    goto P3;
            }
            MP:
            P3:
            DQ:
        }
        cb:
        return $Jr;
    }
    public function locateKeyInfo($Jr = null, $sr = null)
    {
        if (!empty($sr)) {
            goto Yc;
        }
        $sr = $this->rawNode;
        Yc:
        return self::staticLocateKeyInfo($Jr, $sr);
    }
}
