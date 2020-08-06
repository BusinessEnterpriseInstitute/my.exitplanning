<?php


include_once "\125\164\x69\x6c\151\x74\151\145\163\x2e\160\x68\x70";
class SAML2_Assertion
{
    private $id;
    private $issueInstant;
    private $issuer;
    private $nameId;
    private $encryptedNameId;
    private $encryptedAttribute;
    private $encryptionKey;
    private $notBefore;
    private $notOnOrAfter;
    private $validAudiences;
    private $sessionNotOnOrAfter;
    private $sessionIndex;
    private $authnInstant;
    private $authnContextClassRef;
    private $authnContextDecl;
    private $authnContextDeclRef;
    private $AuthenticatingAuthority;
    private $attributes;
    private $nameFormat;
    private $signatureKey;
    private $certificates;
    private $signatureData;
    private $requiredEncAttributes;
    private $SubjectConfirmation;
    protected $wasSignedAtConstruction = FALSE;
    public function __construct(DOMElement $TW = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\x72\156\x3a\157\141\x73\151\163\x3a\x6e\x61\155\145\163\x3a\x74\x63\x3a\123\x41\115\x4c\x3a\61\56\x31\72\156\141\x6d\145\x69\144\x2d\146\157\162\155\141\164\72\x75\156\x73\160\x65\143\x69\146\x69\x65\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($TW === NULL)) {
            goto Mg;
        }
        return;
        Mg:
        if (!($TW->localName === "\x45\x6e\143\162\171\x70\x74\x65\x64\101\x73\163\145\162\x74\151\x6f\x6e")) {
            goto rC;
        }
        $w5 = Utilities::xpQuery($TW, "\56\x2f\170\145\156\143\x3a\x45\x6e\x63\x72\171\160\x74\x65\x64\104\141\x74\x61");
        $i7 = Utilities::xpQuery($TW, "\x2e\57\170\x65\156\x63\72\x45\x6e\x63\x72\x79\160\x74\x65\144\x44\141\164\141\57\144\x73\x3a\113\x65\171\111\156\146\157\x2f\x78\x65\156\x63\x3a\x45\156\143\x72\171\160\164\x65\144\113\145\x79");
        $L8 = '';
        if (empty($i7)) {
            goto lf;
        }
        $L8 = $i7[0]->firstChild->getAttribute("\x41\154\147\157\162\151\x74\x68\155");
        goto pa;
        lf:
        $i7 = Utilities::xpQuery($TW, "\x2e\57\170\x65\156\143\72\105\156\x63\x72\171\x70\x74\145\x64\113\145\171\57\170\x65\x6e\x63\x3a\x45\x6e\x63\x72\171\160\x74\x69\x6f\x6e\x4d\x65\x74\x68\x6f\x64");
        $L8 = $i7[0]->getAttribute("\101\154\147\x6f\162\x69\x74\150\x6d");
        pa:
        $in = Utilities::getEncryptionAlgorithm($L8);
        if (count($w5) === 0) {
            goto rx;
        }
        if (count($w5) > 1) {
            goto uQ;
        }
        goto tG;
        rx:
        throw new Exception("\115\x69\163\x73\x69\x6e\147\x20\145\156\x63\162\x79\x70\164\145\144\40\x64\141\164\141\x20\x69\156\40\x3c\163\x61\155\x6c\x3a\x45\x6e\143\162\x79\x70\164\145\x64\101\x73\x73\145\162\164\151\x6f\156\76\56");
        goto tG;
        uQ:
        throw new Exception("\x4d\157\x72\145\x20\164\x68\141\156\40\157\156\x65\40\145\x6e\x63\x72\171\x70\x74\x65\x64\x20\144\141\164\141\40\145\x6c\145\x6d\145\156\x74\40\x69\x6e\40\x3c\x73\141\155\x6c\x3a\105\x6e\143\162\x79\160\x74\145\x64\101\163\x73\145\x72\164\x69\157\156\76\x2e");
        tG:
        $Ky = '';
        $Ky = variable_get("\x6d\151\x6e\151\x6f\x72\x61\x6e\147\145\137\x73\141\155\x6c\x5f\x70\x72\x69\x76\x61\164\x65\137\x63\145\x72\164\151\146\151\143\141\x74\145");
        $AM = new XMLSecurityKey($in, array("\x74\x79\x70\x65" => "\x70\162\151\x76\x61\164\145"));
        $zv = drupal_get_path("\x6d\157\x64\x75\x6c\145", "\x6d\151\x6e\x69\x6f\x72\x61\x6e\147\x65\137\x73\141\x6d\x6c");
        if ($Ky != '') {
            goto a3;
        }
        $aa = $zv . "\57\162\145\x73\x6f\165\162\x63\145\x73\57\163\x70\55\153\145\171\x2e\x6b\x65\171";
        goto LS;
        a3:
        $aa = $zv . "\57\162\145\163\157\165\x72\143\x65\163\x2f\103\165\x73\x74\x6f\x6d\137\120\162\151\166\141\x74\x65\x5f\x43\x65\x72\x74\151\x66\x69\143\141\x74\145\x2e\153\145\171";
        LS:
        $AM->loadKey($aa, TRUE);
        $e3 = new XMLSecurityKey($in, array("\164\x79\x70\x65" => "\160\x72\x69\166\x61\164\x65"));
        $gx = $zv . "\57\x72\145\163\x6f\x75\162\x63\145\x73\x2f\x6d\151\156\151\157\162\141\x6e\147\x65\x5f\x73\x70\137\160\162\x69\166\x5f\153\x65\171\x2e\x6b\x65\x79";
        $e3->loadKey($gx, TRUE);
        $vt = array();
        $TW = Utilities::decryptElement($w5[0], $AM, $vt, $e3);
        rC:
        if ($TW->hasAttribute("\111\104")) {
            goto kp;
        }
        throw new Exception("\x4d\x69\163\163\151\156\x67\40\111\104\40\x61\164\x74\162\151\x62\165\164\145\40\x6f\x6e\x20\123\x41\115\x4c\40\x61\x73\163\145\x72\x74\x69\157\156\56");
        kp:
        $this->id = $TW->getAttribute("\x49\x44");
        if (!($TW->getAttribute("\126\145\162\163\x69\x6f\x6e") !== "\62\56\x30")) {
            goto oQ;
        }
        throw new Exception("\125\x6e\x73\165\x70\160\157\162\x74\145\x64\40\x76\x65\162\163\x69\x6f\156\72\40" . $TW->getAttribute("\126\145\162\x73\151\157\x6e"));
        oQ:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($TW->getAttribute("\x49\x73\x73\x75\145\111\156\163\x74\141\156\x74"));
        $vH = Utilities::xpQuery($TW, "\56\x2f\163\141\155\x6c\x5f\x61\163\163\x65\x72\x74\x69\157\x6e\x3a\x49\x73\x73\x75\x65\x72");
        if (!empty($vH)) {
            goto pB;
        }
        throw new Exception("\x4d\151\x73\x73\x69\x6e\x67\x20\x3c\163\x61\155\154\72\x49\x73\163\x75\145\x72\76\x20\x69\156\40\141\163\163\x65\x72\x74\151\x6f\156\x2e");
        pB:
        $this->issuer = trim($vH[0]->textContent);
        $this->parseConditions($TW);
        $this->parseAuthnStatement($TW);
        $this->parseAttributes($TW);
        $this->parseEncryptedAttributes($TW);
        $this->parseSignature($TW);
        $this->parseSubject($TW);
    }
    private function parseSubject(DOMElement $TW)
    {
        $zi = Utilities::xpQuery($TW, "\56\x2f\x73\141\x6d\x6c\x5f\141\163\x73\x65\162\x74\x69\157\x6e\72\x53\x75\142\x6a\x65\143\x74");
        if (empty($zi)) {
            goto zq;
        }
        if (count($zi) > 1) {
            goto IU;
        }
        goto dk;
        zq:
        return;
        goto dk;
        IU:
        throw new Exception("\115\x6f\162\145\x20\x74\x68\141\156\40\x6f\156\x65\40\74\163\x61\x6d\154\72\x53\165\142\x6a\145\143\164\76\40\151\156\x20\x3c\163\141\155\154\x3a\x41\x73\x73\145\162\x74\x69\x6f\x6e\76\56");
        dk:
        $zi = $zi[0];
        $cO = Utilities::xpQuery($zi, "\56\x2f\163\x61\x6d\x6c\137\x61\163\163\x65\162\x74\151\x6f\x6e\72\x4e\x61\155\x65\x49\x44\40\x7c\x20\56\x2f\x73\x61\x6d\154\137\x61\163\x73\x65\162\x74\x69\157\156\72\105\156\x63\x72\171\160\164\145\x64\111\x44\x2f\x78\145\156\143\72\x45\156\x63\162\171\x70\x74\x65\144\x44\x61\x74\x61");
        if (empty($cO)) {
            goto CV;
        }
        if (count($cO) > 1) {
            goto ri;
        }
        goto Fl;
        CV:
        throw new Exception("\115\x69\x73\x73\x69\x6e\x67\40\x3c\163\x61\155\154\x3a\x4e\141\155\145\x49\x44\x3e\40\157\162\40\74\x73\x61\155\x6c\72\x45\x6e\143\162\171\160\x74\x65\x64\x49\x44\76\x20\151\x6e\x20\74\163\141\x6d\x6c\72\x53\x75\142\152\x65\x63\164\76\x2e");
        goto Fl;
        ri:
        throw new Exception("\x4d\157\x72\x65\40\164\150\141\156\40\x6f\156\145\x20\74\x73\x61\155\154\x3a\x4e\141\155\x65\111\x44\76\x20\x6f\162\40\x3c\x73\x61\x6d\x6c\72\105\156\143\162\171\160\164\145\x64\x44\76\40\151\156\x20\74\x73\x61\155\x6c\x3a\x53\165\142\152\x65\x63\164\76\56");
        Fl:
        $cO = $cO[0];
        if ($cO->localName === "\105\x6e\x63\162\x79\x70\164\x65\x64\x44\141\x74\x61") {
            goto u6;
        }
        $this->nameId = Utilities::parseNameId($cO);
        goto Z7;
        u6:
        $this->encryptedNameId = $cO;
        Z7:
    }
    private function parseConditions(DOMElement $TW)
    {
        $Du = Utilities::xpQuery($TW, "\56\57\x73\141\155\154\137\x61\x73\x73\x65\162\164\151\157\x6e\72\x43\157\156\144\x69\164\151\x6f\156\x73");
        if (empty($Du)) {
            goto Gw;
        }
        if (count($Du) > 1) {
            goto Ge;
        }
        goto rF;
        Gw:
        return;
        goto rF;
        Ge:
        throw new Exception("\x4d\157\x72\145\40\x74\150\141\x6e\x20\157\x6e\145\40\x3c\163\141\155\x6c\x3a\103\x6f\x6e\x64\x69\x74\x69\157\x6e\x73\76\40\151\x6e\x20\x3c\163\x61\155\154\72\x41\x73\x73\x65\x72\x74\x69\x6f\156\x3e\56");
        rF:
        $Du = $Du[0];
        if (!$Du->hasAttribute("\116\x6f\x74\102\145\146\157\162\145")) {
            goto N8;
        }
        $dj = Utilities::xsDateTimeToTimestamp($Du->getAttribute("\116\x6f\x74\x42\145\x66\x6f\x72\145"));
        if (!($this->notBefore === NULL || $this->notBefore < $dj)) {
            goto CW;
        }
        $this->notBefore = $dj;
        CW:
        N8:
        if (!$Du->hasAttribute("\x4e\157\164\x4f\x6e\117\x72\x41\x66\164\145\x72")) {
            goto xI;
        }
        $mh = Utilities::xsDateTimeToTimestamp($Du->getAttribute("\x4e\157\x74\x4f\156\x4f\162\x41\146\164\x65\162"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $mh)) {
            goto Hs;
        }
        $this->notOnOrAfter = $mh;
        Hs:
        xI:
        $FF = $Du->firstChild;
        Qa:
        if (!($FF !== NULL)) {
            goto f_;
        }
        if (!$FF instanceof DOMText) {
            goto P8;
        }
        goto Ms;
        P8:
        if (!($FF->namespaceURI !== "\165\162\156\x3a\x6f\141\163\151\x73\x3a\x6e\141\x6d\x65\163\72\164\x63\x3a\x53\101\x4d\x4c\x3a\x32\56\x30\x3a\141\x73\x73\x65\x72\x74\x69\x6f\x6e")) {
            goto JY;
        }
        throw new Exception("\x55\156\153\x6e\x6f\x77\156\40\x6e\x61\155\x65\x73\x70\141\x63\x65\x20\x6f\x66\x20\143\x6f\x6e\144\x69\164\x69\x6f\x6e\72\x20" . var_export($FF->namespaceURI, TRUE));
        JY:
        switch ($FF->localName) {
            case "\101\165\144\151\145\156\143\145\122\x65\x73\x74\162\151\143\164\151\157\156":
                $Ix = Utilities::extractStrings($FF, "\165\x72\156\72\157\141\163\x69\163\x3a\x6e\x61\155\145\x73\x3a\x74\143\72\123\x41\x4d\114\x3a\62\56\60\72\141\x73\x73\x65\162\164\x69\157\x6e", "\x41\x75\144\151\x65\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto sG;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $Ix);
                goto pV;
                sG:
                $this->validAudiences = $Ix;
                pV:
                goto tW;
            case "\x4f\x6e\x65\124\x69\155\x65\125\163\x65":
                goto tW;
            case "\x50\162\157\x78\x79\122\145\x73\x74\x72\151\143\x74\x69\x6f\x6e":
                goto tW;
            default:
                throw new Exception("\125\156\153\156\157\x77\x6e\x20\x63\157\156\144\151\164\151\x6f\156\72\40" . var_export($FF->localName, TRUE));
        }
        by:
        tW:
        Ms:
        $FF = $FF->nextSibling;
        goto Qa;
        f_:
    }
    private function parseAuthnStatement(DOMElement $TW)
    {
        $Zj = Utilities::xpQuery($TW, "\56\57\163\x61\155\x6c\137\x61\x73\x73\145\162\x74\x69\x6f\x6e\x3a\x41\x75\x74\150\156\x53\x74\141\x74\x65\x6d\x65\x6e\x74");
        if (empty($Zj)) {
            goto Bv;
        }
        if (count($Zj) > 1) {
            goto kU;
        }
        goto pP;
        Bv:
        $this->authnInstant = NULL;
        return;
        goto pP;
        kU:
        throw new Exception("\115\x6f\x72\145\40\164\150\x61\164\40\157\x6e\145\x20\74\163\141\155\154\x3a\101\x75\x74\x68\x6e\123\164\141\x74\145\x6d\145\x6e\164\x3e\40\x69\156\x20\74\x73\x61\155\154\72\101\x73\163\x65\x72\164\x69\x6f\156\76\x20\x6e\x6f\x74\x20\163\165\x70\160\x6f\162\x74\145\144\56");
        pP:
        $dr = $Zj[0];
        if ($dr->hasAttribute("\101\x75\164\x68\156\x49\156\x73\x74\x61\x6e\164")) {
            goto fg;
        }
        throw new Exception("\x4d\x69\x73\x73\151\x6e\x67\40\162\145\161\165\151\162\145\x64\x20\101\165\164\150\156\111\156\x73\164\141\156\164\40\141\x74\x74\162\x69\142\x75\x74\x65\x20\x6f\x6e\40\x3c\163\x61\x6d\154\72\101\x75\x74\x68\156\123\x74\x61\164\145\155\145\156\x74\76\56");
        fg:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($dr->getAttribute("\101\x75\x74\150\156\x49\156\163\164\141\156\x74"));
        if (!$dr->hasAttribute("\123\x65\x73\163\x69\157\x6e\x4e\157\x74\x4f\156\x4f\x72\101\x66\x74\145\x72")) {
            goto O5;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($dr->getAttribute("\x53\145\x73\x73\151\x6f\156\x4e\157\164\117\156\x4f\x72\x41\146\164\x65\162"));
        O5:
        if (!$dr->hasAttribute("\x53\x65\x73\x73\151\157\x6e\x49\x6e\144\x65\170")) {
            goto qV;
        }
        $this->sessionIndex = $dr->getAttribute("\123\145\x73\163\151\x6f\x6e\x49\x6e\x64\x65\170");
        qV:
        $this->parseAuthnContext($dr);
    }
    private function parseAuthnContext(DOMElement $Cc)
    {
        $wG = Utilities::xpQuery($Cc, "\x2e\x2f\x73\x61\155\154\x5f\141\x73\x73\145\162\x74\x69\x6f\156\72\101\165\164\150\156\x43\157\x6e\x74\145\x78\x74");
        if (count($wG) > 1) {
            goto K0;
        }
        if (empty($wG)) {
            goto Dy;
        }
        goto yh;
        K0:
        throw new Exception("\115\157\162\145\x20\x74\150\141\156\40\x6f\156\145\x20\x3c\163\141\155\154\72\x41\165\x74\x68\x6e\103\x6f\156\x74\x65\x78\x74\x3e\x20\x69\x6e\x20\74\x73\x61\x6d\154\72\101\165\164\x68\156\x53\164\x61\164\x65\x6d\145\x6e\x74\x3e\56");
        goto yh;
        Dy:
        throw new Exception("\x4d\x69\163\x73\x69\156\147\x20\x72\x65\161\x75\x69\162\x65\144\40\74\x73\141\155\154\x3a\x41\x75\164\x68\156\x43\157\x6e\x74\x65\170\164\76\x20\151\156\x20\74\x73\x61\155\x6c\x3a\101\x75\x74\x68\156\x53\x74\141\164\145\x6d\145\156\164\x3e\x2e");
        yh:
        $Di = $wG[0];
        $qJ = Utilities::xpQuery($Di, "\56\x2f\x73\141\155\x6c\137\x61\163\x73\145\x72\164\x69\157\x6e\72\x41\x75\164\150\156\x43\x6f\156\164\x65\170\x74\104\x65\143\154\x52\145\x66");
        if (count($qJ) > 1) {
            goto yI;
        }
        if (count($qJ) === 1) {
            goto oo;
        }
        goto yg;
        yI:
        throw new Exception("\115\157\162\145\x20\164\x68\x61\156\x20\157\156\145\x20\74\163\x61\155\154\x3a\101\x75\x74\x68\x6e\x43\x6f\156\164\x65\170\164\104\x65\x63\154\122\x65\146\76\x20\146\x6f\165\156\144\x3f");
        goto yg;
        oo:
        $this->setAuthnContextDeclRef(trim($qJ[0]->textContent));
        yg:
        $lJ = Utilities::xpQuery($Di, "\56\57\x73\x61\x6d\154\x5f\x61\x73\x73\x65\x72\164\151\x6f\x6e\x3a\x41\165\x74\x68\156\x43\157\156\x74\145\x78\x74\x44\x65\x63\x6c");
        if (count($lJ) > 1) {
            goto BF;
        }
        if (count($lJ) === 1) {
            goto Cb;
        }
        goto aw;
        BF:
        throw new Exception("\x4d\x6f\x72\145\x20\x74\x68\x61\156\x20\x6f\x6e\145\40\74\x73\141\x6d\x6c\x3a\101\165\x74\150\x6e\103\x6f\x6e\164\x65\x78\x74\x44\x65\x63\x6c\76\x20\x66\x6f\x75\x6e\x64\77");
        goto aw;
        Cb:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($lJ[0]));
        aw:
        $uF = Utilities::xpQuery($Di, "\56\57\163\141\x6d\154\137\141\x73\x73\145\x72\164\x69\157\156\72\101\x75\x74\x68\x6e\x43\157\156\164\x65\x78\164\103\x6c\x61\163\x73\x52\x65\x66");
        if (count($uF) > 1) {
            goto y5;
        }
        if (count($uF) === 1) {
            goto cr;
        }
        goto YK;
        y5:
        throw new Exception("\115\x6f\162\x65\40\164\150\141\x6e\x20\x6f\156\145\40\x3c\163\x61\155\154\x3a\101\165\164\150\x6e\103\157\x6e\164\145\x78\x74\103\154\141\163\163\122\145\x66\76\x20\x69\x6e\x20\74\163\141\155\x6c\72\101\165\x74\x68\x6e\x43\157\156\164\145\170\164\x3e\56");
        goto YK;
        cr:
        $this->setAuthnContextClassRef(trim($uF[0]->textContent));
        YK:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto rU;
        }
        throw new Exception("\x4d\x69\x73\x73\x69\156\147\40\145\151\164\x68\x65\162\40\x3c\x73\141\155\154\72\x41\165\164\150\x6e\x43\x6f\x6e\164\145\170\164\103\154\x61\x73\163\x52\x65\x66\x3e\x20\157\x72\40\74\x73\x61\155\154\72\101\165\x74\x68\x6e\x43\157\x6e\164\145\x78\164\104\x65\x63\x6c\x52\x65\x66\76\40\157\x72\40\74\x73\141\x6d\x6c\72\101\x75\x74\x68\x6e\x43\x6f\x6e\164\145\170\164\104\145\x63\x6c\76");
        rU:
        $this->AuthenticatingAuthority = Utilities::extractStrings($Di, "\x75\x72\x6e\72\x6f\x61\163\151\x73\x3a\156\x61\x6d\x65\163\72\x74\143\72\x53\101\x4d\114\x3a\x32\56\x30\72\141\x73\163\145\x72\x74\x69\x6f\x6e", "\101\x75\x74\150\145\156\164\x69\143\141\x74\151\156\x67\x41\x75\164\x68\157\162\151\164\171");
    }
    private function parseAttributes(DOMElement $TW)
    {
        $l6 = TRUE;
        $M2 = Utilities::xpQuery($TW, "\x2e\x2f\163\141\x6d\x6c\x5f\141\163\x73\x65\x72\x74\x69\157\156\x3a\101\x74\x74\x72\x69\142\x75\x74\145\123\164\x61\x74\145\x6d\145\156\164\x2f\x73\x61\x6d\x6c\x5f\141\163\x73\x65\x72\164\151\157\x6e\x3a\x41\164\x74\x72\151\142\165\x74\145");
        foreach ($M2 as $rM) {
            if ($rM->hasAttribute("\116\141\x6d\x65")) {
                goto Yl;
            }
            throw new Exception("\115\x69\x73\x73\151\x6e\147\x20\x6e\x61\x6d\145\x20\157\156\40\74\163\141\155\x6c\x3a\x41\164\x74\x72\x69\142\x75\x74\145\76\x20\145\x6c\145\x6d\145\x6e\x74\x2e");
            Yl:
            $n3 = $rM->getAttribute("\116\x61\x6d\145");
            if ($rM->hasAttribute("\x4e\x61\x6d\145\106\x6f\x72\x6d\x61\x74")) {
                goto GR;
            }
            $Qw = "\x75\162\x6e\72\157\x61\163\151\163\x3a\156\141\x6d\x65\x73\x3a\164\143\72\x53\x41\115\114\x3a\61\56\61\x3a\x6e\141\x6d\145\151\144\x2d\146\157\x72\155\x61\164\x3a\165\x6e\163\160\x65\143\151\x66\151\x65\x64";
            goto fq;
            GR:
            $Qw = $rM->getAttribute("\x4e\x61\155\x65\106\157\x72\x6d\x61\164");
            fq:
            if ($l6) {
                goto cI;
            }
            if (!($this->nameFormat !== $Qw)) {
                goto LJ;
            }
            $this->nameFormat = "\165\x72\x6e\72\157\x61\x73\151\x73\x3a\156\141\x6d\145\x73\72\x74\x63\x3a\123\x41\x4d\x4c\x3a\61\x2e\61\x3a\156\141\x6d\x65\x69\144\55\146\157\162\155\x61\x74\x3a\x75\x6e\163\x70\x65\143\151\x66\151\145\x64";
            LJ:
            goto Y5;
            cI:
            $this->nameFormat = $Qw;
            $l6 = FALSE;
            Y5:
            if (array_key_exists($n3, $this->attributes)) {
                goto OR1;
            }
            $this->attributes[$n3] = array();
            OR1:
            $FI = Utilities::xpQuery($rM, "\56\x2f\163\141\x6d\154\x5f\x61\x73\163\x65\162\164\x69\x6f\156\72\x41\x74\x74\x72\x69\x62\x75\x74\x65\126\141\x6c\x75\145");
            foreach ($FI as $W8) {
                $this->attributes[$n3][] = trim($W8->textContent);
                cD:
            }
            ZU:
            D6:
        }
        ZI:
    }
    private function parseEncryptedAttributes(DOMElement $TW)
    {
        $this->encryptedAttribute = Utilities::xpQuery($TW, "\x2e\x2f\163\x61\x6d\154\x5f\141\163\x73\145\x72\x74\151\157\x6e\72\101\164\x74\162\151\142\x75\164\145\x53\164\141\164\x65\x6d\145\156\x74\x2f\x73\x61\x6d\154\137\141\x73\163\x65\162\x74\x69\157\x6e\72\105\x6e\x63\x72\171\x70\164\x65\x64\x41\164\x74\162\x69\x62\x75\x74\145");
    }
    private function parseSignature(DOMElement $TW)
    {
        $x1 = Utilities::validateElement($TW);
        if (!($x1 !== FALSE)) {
            goto DT;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $x1["\103\145\x72\164\151\x66\x69\143\x61\164\x65\163"];
        $this->signatureData = $x1;
        DT:
    }
    public function validate(XMLSecurityKey $AM)
    {
        if (!($this->signatureData === NULL)) {
            goto Ts;
        }
        return FALSE;
        Ts:
        Utilities::validateSignature($this->signatureData, $AM);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($my)
    {
        $this->id = $my;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($Ce)
    {
        $this->issueInstant = $Ce;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($vH)
    {
        $this->issuer = $vH;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto bp;
        }
        throw new Exception("\x41\164\164\145\155\x70\164\x65\144\40\x74\157\x20\x72\x65\x74\162\151\x65\166\x65\x20\x65\156\x63\x72\x79\x70\x74\145\144\40\116\141\x6d\x65\111\104\40\167\x69\164\150\x6f\x75\x74\40\144\145\143\162\x79\160\164\151\156\147\40\x69\x74\40\x66\151\162\x73\x74\x2e");
        bp:
        return $this->nameId;
    }
    public function setNameId($cO)
    {
        $this->nameId = $cO;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto qc;
        }
        return TRUE;
        qc:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $AM)
    {
        $rU = new DOMDocument();
        $NQ = $rU->createElement("\162\x6f\x6f\164");
        $rU->appendChild($NQ);
        Utilities::addNameId($NQ, $this->nameId);
        $cO = $NQ->firstChild;
        Utilities::getContainer()->debugMessage($cO, "\x65\x6e\x63\162\x79\x70\164");
        $MR = new XMLSecEnc();
        $MR->setNode($cO);
        $MR->type = XMLSecEnc::Element;
        $u8 = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $u8->generateSessionKey();
        $MR->encryptKey($AM, $u8);
        $this->encryptedNameId = $MR->encryptNode($u8);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $AM, array $vt = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto A7;
        }
        return;
        A7:
        $cO = Utilities::decryptElement($this->encryptedNameId, $AM, $vt);
        Utilities::getContainer()->debugMessage($cO, "\144\x65\x63\x72\171\160\x74");
        $this->nameId = Utilities::parseNameId($cO);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $AM, array $vt = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto CK;
        }
        return;
        CK:
        $l6 = TRUE;
        $M2 = $this->encryptedAttribute;
        foreach ($M2 as $N_) {
            $rM = Utilities::decryptElement($N_->getElementsByTagName("\x45\x6e\143\162\x79\160\164\145\x64\x44\141\x74\141")->item(0), $AM, $vt);
            if ($rM->hasAttribute("\x4e\x61\155\x65")) {
                goto av;
            }
            throw new Exception("\115\151\x73\163\151\x6e\x67\40\156\x61\155\x65\40\157\156\x20\x3c\x73\x61\x6d\x6c\x3a\101\164\x74\162\x69\x62\x75\164\x65\x3e\x20\145\x6c\145\155\145\156\x74\x2e");
            av:
            $n3 = $rM->getAttribute("\x4e\141\155\x65");
            if ($rM->hasAttribute("\116\x61\155\x65\106\x6f\x72\x6d\141\x74")) {
                goto bk;
            }
            $Qw = "\x75\x72\x6e\72\157\141\x73\x69\163\72\x6e\x61\x6d\145\x73\x3a\x74\x63\72\123\x41\x4d\114\x3a\62\x2e\x30\72\141\164\x74\162\156\141\155\145\55\x66\157\162\155\141\x74\x3a\165\156\x73\x70\145\x63\x69\146\x69\x65\144";
            goto r1;
            bk:
            $Qw = $rM->getAttribute("\116\141\x6d\x65\106\157\x72\x6d\x61\x74");
            r1:
            if ($l6) {
                goto IE;
            }
            if (!($this->nameFormat !== $Qw)) {
                goto Kq;
            }
            $this->nameFormat = "\x75\162\156\x3a\x6f\141\x73\x69\163\x3a\156\x61\x6d\x65\x73\72\x74\x63\x3a\123\x41\115\x4c\x3a\x32\56\60\x3a\141\x74\164\162\156\141\x6d\x65\x2d\146\x6f\x72\155\141\x74\x3a\165\x6e\x73\160\x65\143\x69\146\151\x65\x64";
            Kq:
            goto Ag;
            IE:
            $this->nameFormat = $Qw;
            $l6 = FALSE;
            Ag:
            if (array_key_exists($n3, $this->attributes)) {
                goto Xa;
            }
            $this->attributes[$n3] = array();
            Xa:
            $FI = Utilities::xpQuery($rM, "\56\57\x73\141\155\x6c\x5f\x61\x73\x73\145\x72\164\x69\157\x6e\72\x41\164\x74\162\x69\x62\165\164\x65\126\x61\154\165\x65");
            foreach ($FI as $W8) {
                $this->attributes[$n3][] = trim($W8->textContent);
                zd:
            }
            KU:
            gR:
        }
        yu:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($dj)
    {
        $this->notBefore = $dj;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($mh)
    {
        $this->notOnOrAfter = $mh;
    }
    public function setEncryptedAttributes($U3)
    {
        $this->requiredEncAttributes = $U3;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $Er = NULL)
    {
        $this->validAudiences = $Er;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($X5)
    {
        $this->authnInstant = $X5;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($XN)
    {
        $this->sessionNotOnOrAfter = $XN;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($aA)
    {
        $this->sessionIndex = $aA;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto w6;
        }
        return $this->authnContextClassRef;
        w6:
        if (empty($this->authnContextDeclRef)) {
            goto pJ;
        }
        return $this->authnContextDeclRef;
        pJ:
        return NULL;
    }
    public function setAuthnContext($TR)
    {
        $this->setAuthnContextClassRef($TR);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($o1)
    {
        $this->authnContextClassRef = $o1;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $TM)
    {
        if (empty($this->authnContextDeclRef)) {
            goto HT;
        }
        throw new Exception("\x41\x75\x74\150\156\103\157\156\x74\x65\170\164\104\145\x63\x6c\x52\x65\x66\x20\x69\163\40\141\x6c\x72\x65\141\144\171\40\x72\145\147\151\x73\164\x65\x72\145\144\41\40\x4d\x61\171\x20\x6f\156\154\x79\x20\150\141\x76\145\40\x65\x69\x74\x68\x65\162\x20\141\x20\104\145\143\x6c\40\x6f\x72\x20\x61\40\104\145\x63\x6c\122\x65\146\54\40\x6e\157\164\40\x62\x6f\x74\150\x21");
        HT:
        $this->authnContextDecl = $TM;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($iL)
    {
        if (empty($this->authnContextDecl)) {
            goto A0;
        }
        throw new Exception("\x41\x75\164\150\x6e\103\157\156\164\x65\x78\164\x44\x65\143\x6c\x20\x69\163\x20\x61\x6c\x72\145\x61\144\x79\40\162\x65\147\151\163\x74\x65\162\145\144\x21\40\115\x61\x79\40\x6f\x6e\154\x79\40\150\x61\166\145\x20\x65\151\164\x68\x65\162\40\141\40\x44\145\143\154\40\157\x72\40\141\40\104\145\x63\154\122\x65\x66\x2c\40\156\x6f\164\40\142\x6f\164\150\41");
        A0:
        $this->authnContextDeclRef = $iL;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($o9)
    {
        $this->AuthenticatingAuthority = $o9;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $M2)
    {
        $this->attributes = $M2;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($Qw)
    {
        $this->nameFormat = $Qw;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $SW)
    {
        $this->SubjectConfirmation = $SW;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $FR = NULL)
    {
        $this->signatureKey = $FR;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $q4 = NULL)
    {
        $this->encryptionKey = $q4;
    }
    public function setCertificates(array $fp)
    {
        $this->certificates = $fp;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $YZ = NULL)
    {
        if ($YZ === NULL) {
            goto Ul;
        }
        $hW = $YZ->ownerDocument;
        goto Uw;
        Ul:
        $hW = new DOMDocument();
        $YZ = $hW;
        Uw:
        $NQ = $hW->createElementNS("\x75\x72\x6e\x3a\x6f\141\163\151\163\x3a\x6e\x61\x6d\x65\x73\72\164\143\x3a\123\x41\x4d\x4c\72\x32\56\x30\x3a\x61\x73\x73\145\162\x74\151\157\x6e", "\x73\141\155\x6c\x3a" . "\101\163\163\145\x72\x74\x69\x6f\x6e");
        $YZ->appendChild($NQ);
        $NQ->setAttributeNS("\165\162\156\x3a\157\x61\x73\x69\x73\x3a\x6e\x61\x6d\x65\163\x3a\x74\x63\72\123\x41\x4d\114\72\x32\56\x30\x3a\160\x72\x6f\164\x6f\143\157\x6c", "\x73\x61\155\x6c\160\72\x74\x6d\x70", "\164\x6d\160");
        $NQ->removeAttributeNS("\165\x72\156\72\157\x61\x73\x69\163\72\x6e\x61\155\145\x73\x3a\x74\143\x3a\x53\x41\115\114\72\62\56\x30\72\160\x72\x6f\x74\x6f\143\157\x6c", "\164\x6d\160");
        $NQ->setAttributeNS("\150\164\x74\160\72\x2f\57\x77\x77\x77\56\x77\63\x2e\x6f\162\x67\57\62\x30\x30\61\57\x58\x4d\x4c\x53\143\150\145\x6d\141\55\x69\156\163\x74\141\156\x63\x65", "\x78\x73\x69\72\164\155\x70", "\x74\x6d\x70");
        $NQ->removeAttributeNS("\x68\164\x74\x70\72\57\57\167\x77\167\x2e\167\x33\56\157\162\x67\57\62\x30\x30\61\x2f\130\115\x4c\x53\143\150\x65\x6d\x61\x2d\151\x6e\x73\164\141\x6e\143\x65", "\x74\x6d\160");
        $NQ->setAttributeNS("\x68\x74\164\160\x3a\57\x2f\x77\x77\x77\56\167\x33\x2e\x6f\x72\147\x2f\62\x30\x30\61\x2f\x58\115\x4c\123\143\x68\x65\x6d\x61", "\170\x73\x3a\164\x6d\160", "\x74\155\160");
        $NQ->removeAttributeNS("\150\164\164\x70\72\x2f\x2f\167\x77\x77\x2e\x77\x33\56\x6f\x72\147\x2f\x32\60\x30\61\x2f\x58\x4d\x4c\123\x63\x68\x65\155\141", "\164\x6d\x70");
        $NQ->setAttribute("\x49\104", $this->id);
        $NQ->setAttribute("\126\x65\x72\x73\x69\157\156", "\62\56\x30");
        $NQ->setAttribute("\111\x73\x73\165\145\111\156\x73\x74\x61\156\164", gmdate("\x59\x2d\x6d\55\144\x5c\x54\x48\x3a\x69\x3a\x73\134\132", $this->issueInstant));
        $vH = Utilities::addString($NQ, "\165\162\156\72\x6f\141\163\151\x73\x3a\x6e\x61\155\145\163\72\x74\x63\72\123\101\115\x4c\x3a\62\x2e\x30\72\141\x73\x73\x65\162\164\x69\157\x6e", "\163\141\155\154\72\x49\x73\x73\165\145\x72", $this->issuer);
        $this->addSubject($NQ);
        $this->addConditions($NQ);
        $this->addAuthnStatement($NQ);
        if ($this->requiredEncAttributes == FALSE) {
            goto iV;
        }
        $this->addEncryptedAttributeStatement($NQ);
        goto Wx;
        iV:
        $this->addAttributeStatement($NQ);
        Wx:
        if (!($this->signatureKey !== NULL)) {
            goto Xm;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $NQ, $vH->nextSibling);
        Xm:
        return $NQ;
    }
    private function addSubject(DOMElement $NQ)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto lx;
        }
        return;
        lx:
        $zi = $NQ->ownerDocument->createElementNS("\x75\162\156\x3a\x6f\141\x73\x69\163\x3a\156\141\x6d\x65\x73\x3a\164\143\72\123\101\x4d\114\72\x32\x2e\60\x3a\141\163\x73\145\x72\x74\151\157\156", "\x73\x61\155\154\x3a\x53\165\142\152\x65\143\164");
        $NQ->appendChild($zi);
        if ($this->encryptedNameId === NULL) {
            goto f3;
        }
        $gj = $zi->ownerDocument->createElementNS("\x75\x72\156\x3a\157\x61\x73\x69\x73\x3a\x6e\x61\x6d\145\x73\x3a\x74\x63\72\123\101\115\x4c\72\x32\x2e\x30\72\x61\x73\163\145\162\x74\151\x6f\156", "\163\141\155\x6c\72" . "\x45\156\143\x72\x79\x70\164\145\144\111\104");
        $zi->appendChild($gj);
        $gj->appendChild($zi->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto Im;
        f3:
        Utilities::addNameId($zi, $this->nameId);
        Im:
        foreach ($this->SubjectConfirmation as $Zk) {
            $Zk->toXML($zi);
            ER:
        }
        mT:
    }
    private function addConditions(DOMElement $NQ)
    {
        $hW = $NQ->ownerDocument;
        $Du = $hW->createElementNS("\165\162\x6e\72\157\x61\163\151\163\x3a\156\141\x6d\x65\163\x3a\x74\x63\72\x53\x41\x4d\114\x3a\62\56\60\72\141\163\x73\145\162\164\x69\x6f\x6e", "\x73\141\155\x6c\72\x43\x6f\156\144\151\164\x69\x6f\x6e\163");
        $NQ->appendChild($Du);
        if (!($this->notBefore !== NULL)) {
            goto Vf;
        }
        $Du->setAttribute("\x4e\157\164\102\145\x66\x6f\162\x65", gmdate("\x59\x2d\x6d\x2d\144\x5c\x54\x48\x3a\151\x3a\x73\134\x5a", $this->notBefore));
        Vf:
        if (!($this->notOnOrAfter !== NULL)) {
            goto Wd;
        }
        $Du->setAttribute("\x4e\x6f\x74\117\156\117\x72\101\146\164\x65\162", gmdate("\x59\x2d\x6d\x2d\144\134\124\x48\x3a\151\72\x73\134\132", $this->notOnOrAfter));
        Wd:
        if (!($this->validAudiences !== NULL)) {
            goto d6;
        }
        $XD = $hW->createElementNS("\x75\x72\x6e\72\x6f\141\163\151\163\72\x6e\141\155\145\x73\x3a\x74\x63\x3a\x53\101\x4d\114\72\62\56\x30\72\x61\163\x73\145\x72\x74\151\157\x6e", "\163\x61\155\x6c\72\101\165\144\151\x65\156\143\x65\x52\x65\163\164\x72\x69\x63\x74\x69\157\x6e");
        $Du->appendChild($XD);
        Utilities::addStrings($XD, "\x75\x72\x6e\x3a\x6f\x61\163\151\163\72\156\141\155\145\163\x3a\164\143\72\123\x41\115\114\x3a\x32\56\60\x3a\x61\163\x73\145\x72\164\151\157\x6e", "\x73\x61\x6d\x6c\x3a\101\x75\144\151\145\x6e\x63\x65", FALSE, $this->validAudiences);
        d6:
    }
    private function addAuthnStatement(DOMElement $NQ)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto iO;
        }
        return;
        iO:
        $hW = $NQ->ownerDocument;
        $Cc = $hW->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\151\x73\72\156\141\155\x65\163\x3a\164\143\72\x53\101\115\x4c\72\62\x2e\60\72\141\163\163\x65\162\164\151\157\156", "\x73\x61\155\154\72\101\x75\x74\x68\156\x53\x74\x61\x74\x65\155\x65\156\x74");
        $NQ->appendChild($Cc);
        $Cc->setAttribute("\101\x75\164\x68\156\x49\156\163\x74\141\x6e\164", gmdate("\131\55\155\55\144\134\124\110\x3a\151\x3a\163\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto mb;
        }
        $Cc->setAttribute("\x53\x65\163\163\151\x6f\x6e\116\157\164\x4f\156\x4f\x72\101\146\164\145\162", gmdate("\131\55\155\x2d\x64\134\124\110\x3a\x69\x3a\x73\134\x5a", $this->sessionNotOnOrAfter));
        mb:
        if (!($this->sessionIndex !== NULL)) {
            goto nP;
        }
        $Cc->setAttribute("\123\145\163\163\x69\157\156\111\156\x64\x65\x78", $this->sessionIndex);
        nP:
        $Di = $hW->createElementNS("\x75\x72\x6e\72\x6f\141\163\151\163\72\x6e\141\155\145\163\72\164\143\72\123\101\115\x4c\72\x32\56\x30\72\141\x73\x73\x65\162\164\x69\x6f\x6e", "\163\x61\155\x6c\72\x41\165\x74\x68\x6e\103\x6f\156\x74\x65\x78\x74");
        $Cc->appendChild($Di);
        if (empty($this->authnContextClassRef)) {
            goto X1;
        }
        Utilities::addString($Di, "\165\x72\x6e\x3a\x6f\141\x73\x69\163\x3a\156\141\155\145\163\72\x74\x63\x3a\x53\x41\x4d\x4c\72\x32\56\x30\72\x61\163\x73\x65\162\x74\151\x6f\156", "\x73\x61\155\x6c\72\x41\165\164\150\156\103\157\156\164\145\x78\164\x43\x6c\141\x73\163\122\x65\146", $this->authnContextClassRef);
        X1:
        if (empty($this->authnContextDecl)) {
            goto Pe;
        }
        $this->authnContextDecl->toXML($Di);
        Pe:
        if (empty($this->authnContextDeclRef)) {
            goto H7;
        }
        Utilities::addString($Di, "\x75\x72\x6e\x3a\157\x61\x73\151\163\72\156\141\x6d\x65\163\x3a\164\143\x3a\x53\x41\115\x4c\x3a\x32\56\60\72\141\163\x73\145\162\x74\151\x6f\x6e", "\x73\x61\155\x6c\x3a\101\x75\x74\150\x6e\103\x6f\x6e\x74\145\170\x74\x44\145\x63\x6c\122\145\x66", $this->authnContextDeclRef);
        H7:
        Utilities::addStrings($Di, "\x75\x72\156\72\157\141\x73\x69\163\72\156\x61\155\x65\x73\x3a\164\143\72\x53\101\115\114\x3a\x32\56\60\x3a\x61\163\x73\145\x72\164\151\157\x6e", "\x73\141\155\x6c\72\101\165\x74\150\x65\x6e\x74\x69\143\x61\164\151\156\x67\101\x75\164\150\157\x72\x69\164\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $NQ)
    {
        if (!empty($this->attributes)) {
            goto wp;
        }
        return;
        wp:
        $hW = $NQ->ownerDocument;
        $uo = $hW->createElementNS("\165\x72\156\72\x6f\x61\163\151\163\72\156\141\x6d\x65\163\72\x74\143\x3a\x53\101\115\114\x3a\62\x2e\60\72\141\163\x73\145\x72\164\151\157\x6e", "\x73\x61\x6d\x6c\x3a\x41\x74\x74\x72\x69\x62\165\164\x65\123\x74\141\x74\x65\x6d\145\x6e\x74");
        $NQ->appendChild($uo);
        foreach ($this->attributes as $n3 => $FI) {
            $rM = $hW->createElementNS("\165\162\x6e\72\x6f\141\163\x69\163\x3a\x6e\141\x6d\x65\x73\x3a\x74\143\72\123\101\x4d\x4c\72\x32\x2e\60\x3a\141\163\x73\x65\x72\x74\151\x6f\x6e", "\163\141\155\154\x3a\101\x74\164\162\151\142\165\x74\x65");
            $uo->appendChild($rM);
            $rM->setAttribute("\116\141\155\145", $n3);
            if (!($this->nameFormat !== "\x75\x72\x6e\72\x6f\x61\x73\x69\x73\x3a\x6e\141\155\x65\163\72\164\143\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\141\164\164\162\x6e\x61\x6d\x65\55\x66\157\162\155\x61\x74\72\x75\156\163\160\145\x63\x69\146\151\145\144")) {
                goto Cr;
            }
            $rM->setAttribute("\116\x61\x6d\145\x46\x6f\162\x6d\x61\164", $this->nameFormat);
            Cr:
            foreach ($FI as $W8) {
                if (is_string($W8)) {
                    goto ZS;
                }
                if (is_int($W8)) {
                    goto jK;
                }
                $S2 = NULL;
                goto Q0;
                ZS:
                $S2 = "\170\163\x3a\163\x74\162\151\156\147";
                goto Q0;
                jK:
                $S2 = "\x78\163\72\x69\156\164\x65\147\145\x72";
                Q0:
                $ft = $hW->createElementNS("\x75\162\x6e\x3a\157\x61\x73\x69\x73\x3a\156\141\155\x65\163\x3a\164\x63\72\x53\x41\x4d\114\x3a\62\56\60\x3a\x61\x73\x73\x65\x72\x74\x69\157\156", "\x73\141\155\x6c\x3a\101\x74\x74\162\x69\142\x75\x74\145\x56\141\x6c\165\x65");
                $rM->appendChild($ft);
                if (!($S2 !== NULL)) {
                    goto Ke;
                }
                $ft->setAttributeNS("\x68\164\164\x70\72\57\57\167\167\x77\56\x77\x33\56\x6f\162\147\x2f\x32\x30\60\x31\x2f\130\x4d\x4c\123\x63\150\145\x6d\141\55\x69\156\163\164\x61\x6e\143\x65", "\x78\x73\151\72\x74\171\x70\145", $S2);
                Ke:
                if (!is_null($W8)) {
                    goto aJ;
                }
                $ft->setAttributeNS("\150\x74\x74\x70\x3a\x2f\57\x77\x77\167\56\167\63\x2e\157\162\147\x2f\x32\x30\x30\61\x2f\130\115\114\123\143\150\x65\155\x61\x2d\x69\x6e\x73\x74\141\x6e\x63\145", "\170\163\x69\x3a\x6e\x69\154", "\164\x72\x75\145");
                aJ:
                if ($W8 instanceof DOMNodeList) {
                    goto FR;
                }
                $ft->appendChild($hW->createTextNode($W8));
                goto e_;
                FR:
                $rJ = 0;
                ux:
                if (!($rJ < $W8->length)) {
                    goto iY;
                }
                $FF = $hW->importNode($W8->item($rJ), TRUE);
                $ft->appendChild($FF);
                PM:
                $rJ++;
                goto ux;
                iY:
                e_:
                W3:
            }
            Au:
            e0:
        }
        r8:
    }
    private function addEncryptedAttributeStatement(DOMElement $NQ)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto nu;
        }
        return;
        nu:
        $hW = $NQ->ownerDocument;
        $uo = $hW->createElementNS("\x75\x72\156\72\157\141\163\x69\x73\72\156\141\x6d\145\163\x3a\164\143\x3a\123\x41\115\114\72\x32\x2e\x30\72\x61\x73\x73\145\x72\164\x69\x6f\156", "\163\141\x6d\154\72\x41\164\x74\x72\x69\142\165\x74\x65\123\164\x61\164\145\x6d\x65\156\164");
        $NQ->appendChild($uo);
        foreach ($this->attributes as $n3 => $FI) {
            $rt = new DOMDocument();
            $rM = $rt->createElementNS("\165\x72\156\72\x6f\x61\x73\x69\163\72\156\x61\x6d\x65\x73\x3a\164\x63\x3a\123\101\x4d\x4c\x3a\62\x2e\60\72\141\x73\163\145\162\x74\x69\x6f\156", "\x73\141\155\x6c\x3a\x41\164\x74\x72\151\142\x75\164\145");
            $rM->setAttribute("\116\141\155\x65", $n3);
            $rt->appendChild($rM);
            if (!($this->nameFormat !== "\x75\x72\x6e\72\x6f\x61\x73\151\163\72\x6e\x61\155\x65\x73\72\164\143\x3a\123\101\115\x4c\72\62\x2e\x30\x3a\x61\164\x74\162\156\141\x6d\145\x2d\x66\157\x72\155\x61\x74\x3a\x75\x6e\163\x70\x65\x63\x69\146\x69\145\x64")) {
                goto Ud;
            }
            $rM->setAttribute("\116\x61\155\x65\106\x6f\162\155\x61\164", $this->nameFormat);
            Ud:
            foreach ($FI as $W8) {
                if (is_string($W8)) {
                    goto P7;
                }
                if (is_int($W8)) {
                    goto B9;
                }
                $S2 = NULL;
                goto Nw;
                P7:
                $S2 = "\x78\x73\x3a\x73\164\x72\x69\156\147";
                goto Nw;
                B9:
                $S2 = "\170\163\x3a\x69\156\164\145\x67\145\162";
                Nw:
                $ft = $rt->createElementNS("\x75\162\156\x3a\x6f\x61\163\151\163\72\156\141\x6d\x65\163\72\164\143\72\x53\x41\115\x4c\x3a\62\56\60\72\x61\x73\x73\x65\x72\x74\x69\x6f\x6e", "\163\x61\155\x6c\72\x41\164\x74\x72\x69\x62\165\164\145\126\141\154\165\145");
                $rM->appendChild($ft);
                if (!($S2 !== NULL)) {
                    goto GN;
                }
                $ft->setAttributeNS("\x68\x74\164\160\x3a\57\x2f\x77\167\167\x2e\x77\63\x2e\x6f\162\x67\x2f\x32\x30\60\x31\57\x58\115\114\123\x63\150\145\155\141\x2d\x69\156\x73\164\x61\x6e\143\145", "\x78\163\x69\72\164\x79\x70\145", $S2);
                GN:
                if ($W8 instanceof DOMNodeList) {
                    goto kB;
                }
                $ft->appendChild($rt->createTextNode($W8));
                goto al;
                kB:
                $rJ = 0;
                PP:
                if (!($rJ < $W8->length)) {
                    goto T9;
                }
                $FF = $rt->importNode($W8->item($rJ), TRUE);
                $ft->appendChild($FF);
                Pi:
                $rJ++;
                goto PP;
                T9:
                al:
                B5:
            }
            Iq:
            $f2 = new XMLSecEnc();
            $f2->setNode($rt->documentElement);
            $f2->type = "\x68\164\164\160\x3a\57\57\167\167\x77\x2e\167\63\x2e\x6f\162\147\x2f\62\60\x30\61\x2f\x30\64\57\x78\x6d\x6c\145\x6e\143\43\x45\x6c\145\x6d\x65\x6e\x74";
            $u8 = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $u8->generateSessionKey();
            $f2->encryptKey($this->encryptionKey, $u8);
            $fh = $f2->encryptNode($u8);
            $aL = $hW->createElementNS("\x75\x72\156\x3a\x6f\x61\x73\151\x73\x3a\156\141\155\x65\x73\72\164\x63\72\x53\x41\x4d\114\x3a\x32\x2e\x30\72\141\163\163\x65\162\x74\151\x6f\156", "\163\x61\155\154\72\105\x6e\143\162\x79\x70\x74\x65\144\x41\164\164\162\x69\142\165\x74\x65");
            $uo->appendChild($aL);
            $xG = $hW->importNode($fh, TRUE);
            $aL->appendChild($xG);
            UM:
        }
        WZ:
    }
}
