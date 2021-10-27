<?php


include_once "\x55\x74\x69\154\x69\x74\151\x65\x73\x2e\x70\150\160";
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
    public function __construct(DOMElement $r2 = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\162\156\x3a\x6f\141\x73\x69\163\x3a\156\141\155\145\x73\72\x74\143\72\123\101\115\114\72\61\56\61\x3a\156\x61\155\x65\x69\144\x2d\146\x6f\x72\155\x61\x74\x3a\165\x6e\x73\160\x65\x63\x69\x66\x69\145\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($r2 === NULL)) {
            goto AK;
        }
        return;
        AK:
        if (!($r2->localName === "\x45\156\143\162\171\x70\x74\145\x64\x41\163\163\145\162\x74\x69\x6f\156")) {
            goto KI;
        }
        $uq = Utilities::xpQuery($r2, "\56\57\x78\x65\156\x63\x3a\105\156\143\x72\x79\x70\164\x65\144\x44\141\164\x61");
        $op = Utilities::xpQuery($r2, "\x2e\x2f\x78\x65\x6e\143\72\105\x6e\143\162\171\160\164\x65\x64\104\x61\164\x61\x2f\x64\163\72\113\x65\x79\111\156\x66\x6f\x2f\170\x65\x6e\x63\72\x45\x6e\143\162\171\160\x74\145\x64\x4b\145\171");
        $R2 = '';
        if (empty($op)) {
            goto Bx;
        }
        $R2 = $op[0]->firstChild->getAttribute("\x41\x6c\147\x6f\x72\x69\x74\150\155");
        goto Ib;
        Bx:
        $op = Utilities::xpQuery($r2, "\x2e\57\x78\x65\x6e\x63\x3a\x45\156\x63\x72\171\160\164\x65\x64\113\145\x79\57\x78\x65\x6e\x63\x3a\105\156\143\x72\x79\x70\164\151\x6f\156\x4d\145\164\x68\157\x64");
        $R2 = $op[0]->getAttribute("\x41\x6c\x67\x6f\162\x69\164\x68\155");
        Ib:
        $jK = Utilities::getEncryptionAlgorithm($R2);
        if (count($uq) === 0) {
            goto iV;
        }
        if (count($uq) > 1) {
            goto pT;
        }
        goto Yl;
        iV:
        throw new Exception("\x4d\x69\x73\x73\151\x6e\147\x20\x65\x6e\143\162\x79\160\164\145\144\x20\x64\x61\164\141\x20\x69\x6e\x20\x3c\x73\x61\155\154\72\x45\156\x63\162\x79\x70\164\x65\x64\x41\x73\163\145\162\164\151\157\156\76\x2e");
        goto Yl;
        pT:
        throw new Exception("\115\157\x72\145\x20\x74\150\x61\x6e\x20\x6f\x6e\x65\40\x65\x6e\x63\x72\171\160\x74\x65\144\40\144\141\x74\141\x20\x65\x6c\x65\155\x65\156\164\x20\151\156\x20\74\x73\141\x6d\x6c\72\x45\x6e\x63\162\171\160\x74\x65\x64\101\x73\163\x65\x72\x74\x69\x6f\x6e\x3e\x2e");
        Yl:
        $EG = '';
        $EG = variable_get("\x6d\x69\156\x69\x6f\162\x61\156\147\x65\x5f\x73\141\155\x6c\137\x70\162\x69\166\141\164\x65\x5f\143\145\162\164\151\x66\x69\x63\x61\x74\x65");
        $hG = new XMLSecurityKey($jK, array("\164\x79\x70\145" => "\x70\x72\x69\166\x61\x74\x65"));
        $Br = drupal_get_path("\155\157\144\165\x6c\145", "\x6d\x69\x6e\x69\x6f\162\141\156\x67\x65\137\163\x61\x6d\x6c");
        if ($EG != '') {
            goto SG;
        }
        $ae = $Br . "\57\x72\145\163\x6f\165\162\x63\145\163\57\163\160\55\153\145\171\56\x6b\x65\171";
        goto xE;
        SG:
        $ae = $Br . "\x2f\x72\145\163\157\x75\x72\143\145\x73\57\103\x75\163\x74\x6f\155\x5f\120\162\151\166\x61\164\x65\137\103\x65\x72\164\151\x66\x69\143\x61\x74\145\x2e\x6b\x65\171";
        xE:
        $hG->loadKey($ae, TRUE);
        $eR = new XMLSecurityKey($jK, array("\x74\171\x70\145" => "\x70\x72\151\166\141\164\145"));
        $Pn = $Br . "\57\162\145\x73\x6f\x75\x72\143\x65\x73\x2f\x6d\x69\156\151\x6f\x72\x61\x6e\147\x65\137\x73\x70\x5f\160\x72\151\x76\137\x6b\x65\x79\x2e\x6b\145\171";
        $eR->loadKey($Pn, TRUE);
        $oI = array();
        $r2 = Utilities::decryptElement($uq[0], $hG, $oI, $eR);
        KI:
        if ($r2->hasAttribute("\111\104")) {
            goto MJ;
        }
        throw new Exception("\115\x69\163\163\151\156\147\40\x49\x44\40\141\164\164\162\151\x62\165\x74\x65\x20\x6f\156\x20\x53\101\115\x4c\x20\141\x73\x73\145\x72\164\151\x6f\x6e\56");
        MJ:
        $this->id = $r2->getAttribute("\x49\x44");
        if (!($r2->getAttribute("\x56\145\x72\x73\151\x6f\156") !== "\x32\56\60")) {
            goto Qk;
        }
        throw new Exception("\125\x6e\x73\165\160\160\x6f\x72\x74\x65\x64\40\166\145\x72\x73\151\x6f\x6e\x3a\x20" . $r2->getAttribute("\126\145\162\x73\x69\x6f\x6e"));
        Qk:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($r2->getAttribute("\111\x73\163\x75\x65\x49\x6e\x73\x74\x61\156\x74"));
        $k3 = Utilities::xpQuery($r2, "\x2e\57\x73\x61\x6d\x6c\137\141\163\163\145\162\x74\x69\157\156\x3a\111\163\x73\x75\145\x72");
        if (!empty($k3)) {
            goto bb;
        }
        throw new Exception("\115\151\x73\163\x69\156\147\40\x3c\163\141\155\154\72\111\x73\x73\165\145\x72\76\x20\x69\x6e\40\x61\x73\163\145\x72\164\151\157\x6e\x2e");
        bb:
        $this->issuer = trim($k3[0]->textContent);
        $this->parseConditions($r2);
        $this->parseAuthnStatement($r2);
        $this->parseAttributes($r2);
        $this->parseEncryptedAttributes($r2);
        $this->parseSignature($r2);
        $this->parseSubject($r2);
    }
    private function parseSubject(DOMElement $r2)
    {
        $OU = Utilities::xpQuery($r2, "\56\x2f\x73\141\155\154\x5f\x61\x73\x73\x65\162\x74\x69\x6f\x6e\72\123\165\x62\152\x65\x63\x74");
        if (empty($OU)) {
            goto w9;
        }
        if (count($OU) > 1) {
            goto Ed;
        }
        goto in;
        w9:
        return;
        goto in;
        Ed:
        throw new Exception("\x4d\157\162\x65\x20\x74\150\141\x6e\40\x6f\156\x65\40\74\163\x61\155\x6c\x3a\123\165\x62\x6a\145\x63\x74\76\x20\x69\156\40\x3c\x73\x61\155\154\72\x41\163\163\x65\162\x74\151\x6f\156\76\56");
        in:
        $OU = $OU[0];
        $cz = Utilities::xpQuery($OU, "\56\57\x73\x61\x6d\154\x5f\141\163\163\x65\162\164\x69\x6f\x6e\72\x4e\x61\x6d\145\x49\x44\x20\174\40\56\x2f\x73\141\155\154\x5f\141\163\163\x65\162\x74\151\x6f\156\72\105\x6e\x63\162\171\x70\164\x65\144\111\x44\x2f\x78\145\x6e\x63\72\105\156\x63\162\171\160\164\145\x64\104\141\164\x61");
        if (empty($cz)) {
            goto w2;
        }
        if (count($cz) > 1) {
            goto yf;
        }
        goto Lm;
        w2:
        throw new Exception("\115\x69\163\x73\151\x6e\147\40\x3c\163\141\x6d\154\x3a\116\141\155\x65\111\x44\x3e\x20\157\x72\40\x3c\x73\141\x6d\x6c\x3a\105\156\143\162\171\160\164\145\x64\111\104\x3e\40\151\x6e\40\74\x73\x61\x6d\x6c\72\123\x75\x62\152\145\143\x74\x3e\56");
        goto Lm;
        yf:
        throw new Exception("\x4d\157\162\x65\40\164\150\141\x6e\x20\x6f\x6e\x65\x20\x3c\x73\141\x6d\x6c\x3a\x4e\141\155\145\111\104\x3e\40\157\x72\x20\74\163\141\155\x6c\x3a\x45\156\143\x72\x79\x70\x74\145\x64\104\x3e\40\151\156\x20\x3c\163\141\155\x6c\x3a\x53\165\142\152\145\143\x74\76\56");
        Lm:
        $cz = $cz[0];
        if ($cz->localName === "\x45\156\x63\x72\171\160\164\145\x64\104\x61\x74\141") {
            goto Y1;
        }
        $this->nameId = Utilities::parseNameId($cz);
        goto S5;
        Y1:
        $this->encryptedNameId = $cz;
        S5:
    }
    private function parseConditions(DOMElement $r2)
    {
        $S7 = Utilities::xpQuery($r2, "\x2e\x2f\x73\x61\155\154\x5f\141\163\163\145\x72\164\x69\x6f\x6e\72\x43\x6f\x6e\x64\151\x74\x69\x6f\x6e\x73");
        if (empty($S7)) {
            goto hA;
        }
        if (count($S7) > 1) {
            goto z6;
        }
        goto Oh;
        hA:
        return;
        goto Oh;
        z6:
        throw new Exception("\115\x6f\x72\145\x20\x74\x68\x61\x6e\40\x6f\x6e\145\x20\x3c\163\x61\x6d\154\72\x43\157\x6e\144\151\164\x69\157\x6e\x73\76\x20\151\156\x20\74\163\x61\155\x6c\x3a\x41\163\163\145\x72\x74\x69\157\156\x3e\x2e");
        Oh:
        $S7 = $S7[0];
        if (!$S7->hasAttribute("\x4e\x6f\164\102\145\x66\x6f\162\x65")) {
            goto Zb;
        }
        $SF = Utilities::xsDateTimeToTimestamp($S7->getAttribute("\x4e\x6f\x74\x42\145\146\x6f\x72\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $SF)) {
            goto jK;
        }
        $this->notBefore = $SF;
        jK:
        Zb:
        if (!$S7->hasAttribute("\116\x6f\x74\117\x6e\x4f\162\101\x66\x74\x65\x72")) {
            goto Wx;
        }
        $wo = Utilities::xsDateTimeToTimestamp($S7->getAttribute("\116\157\x74\117\x6e\x4f\x72\x41\x66\164\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $wo)) {
            goto nn;
        }
        $this->notOnOrAfter = $wo;
        nn:
        Wx:
        $fr = $S7->firstChild;
        LW:
        if (!($fr !== NULL)) {
            goto D9;
        }
        if (!$fr instanceof DOMText) {
            goto gK;
        }
        goto wN;
        gK:
        if (!($fr->namespaceURI !== "\x75\162\156\72\x6f\x61\x73\151\163\72\x6e\x61\155\145\x73\72\x74\x63\x3a\x53\101\115\x4c\72\x32\56\x30\x3a\x61\163\x73\145\162\164\151\x6f\156")) {
            goto Ph;
        }
        throw new Exception("\x55\156\153\x6e\157\167\x6e\x20\x6e\141\x6d\145\163\160\x61\x63\145\x20\157\146\40\x63\157\156\144\x69\164\x69\x6f\156\72\x20" . var_export($fr->namespaceURI, TRUE));
        Ph:
        switch ($fr->localName) {
            case "\101\165\144\151\x65\x6e\143\x65\122\145\163\164\162\151\x63\x74\151\x6f\x6e":
                $ND = Utilities::extractStrings($fr, "\165\162\x6e\72\157\x61\x73\151\x73\x3a\x6e\141\155\x65\163\x3a\x74\x63\x3a\x53\x41\115\114\72\x32\56\60\72\x61\x73\163\145\162\164\x69\x6f\156", "\101\165\x64\x69\x65\156\x63\x65");
                if ($this->validAudiences === NULL) {
                    goto hH;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $ND);
                goto P5;
                hH:
                $this->validAudiences = $ND;
                P5:
                goto Ew;
            case "\117\156\145\124\x69\155\x65\x55\x73\x65":
                goto Ew;
            case "\120\x72\x6f\170\171\x52\x65\x73\x74\x72\x69\x63\164\x69\x6f\156":
                goto Ew;
            default:
                throw new Exception("\x55\156\x6b\x6e\x6f\x77\x6e\40\x63\x6f\156\144\x69\164\x69\157\x6e\72\40" . var_export($fr->localName, TRUE));
        }
        uY:
        Ew:
        wN:
        $fr = $fr->nextSibling;
        goto LW;
        D9:
    }
    private function parseAuthnStatement(DOMElement $r2)
    {
        $YA = Utilities::xpQuery($r2, "\x2e\x2f\163\x61\x6d\x6c\137\x61\x73\x73\x65\x72\164\151\x6f\x6e\x3a\x41\165\x74\x68\x6e\x53\164\141\x74\145\x6d\x65\x6e\x74");
        if (empty($YA)) {
            goto fZ;
        }
        if (count($YA) > 1) {
            goto z0;
        }
        goto We;
        fZ:
        $this->authnInstant = NULL;
        return;
        goto We;
        z0:
        throw new Exception("\115\x6f\162\x65\x20\164\150\x61\x74\x20\x6f\x6e\145\x20\74\163\x61\155\154\x3a\101\165\x74\x68\x6e\123\164\141\x74\x65\x6d\x65\x6e\x74\x3e\40\x69\156\x20\x3c\163\x61\x6d\154\72\x41\163\163\x65\x72\164\151\157\156\x3e\x20\x6e\x6f\x74\x20\163\165\160\x70\x6f\162\164\145\x64\56");
        We:
        $Om = $YA[0];
        if ($Om->hasAttribute("\101\x75\x74\x68\156\x49\x6e\x73\x74\x61\x6e\164")) {
            goto gp;
        }
        throw new Exception("\x4d\151\163\x73\x69\156\x67\40\162\145\161\x75\x69\x72\145\x64\x20\101\165\x74\150\156\111\x6e\x73\x74\x61\156\x74\x20\141\x74\x74\x72\x69\x62\165\164\x65\x20\x6f\x6e\40\74\x73\x61\x6d\154\72\x41\165\164\x68\x6e\x53\x74\141\x74\x65\x6d\145\x6e\164\x3e\x2e");
        gp:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($Om->getAttribute("\x41\x75\164\x68\x6e\x49\x6e\163\164\x61\x6e\x74"));
        if (!$Om->hasAttribute("\123\x65\163\x73\151\x6f\156\116\157\164\x4f\156\x4f\162\101\x66\x74\145\x72")) {
            goto wk;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($Om->getAttribute("\123\x65\163\x73\x69\x6f\156\x4e\x6f\x74\117\156\x4f\162\101\146\x74\x65\x72"));
        wk:
        if (!$Om->hasAttribute("\123\x65\x73\x73\x69\x6f\x6e\x49\156\144\145\x78")) {
            goto Vg;
        }
        $this->sessionIndex = $Om->getAttribute("\x53\x65\163\x73\151\157\156\x49\156\x64\145\x78");
        Vg:
        $this->parseAuthnContext($Om);
    }
    private function parseAuthnContext(DOMElement $FJ)
    {
        $so = Utilities::xpQuery($FJ, "\56\x2f\163\x61\155\x6c\x5f\x61\x73\163\x65\162\x74\x69\x6f\x6e\72\x41\165\164\150\156\103\157\x6e\x74\145\x78\164");
        if (count($so) > 1) {
            goto vG;
        }
        if (empty($so)) {
            goto WL;
        }
        goto dp;
        vG:
        throw new Exception("\115\157\162\x65\40\x74\x68\141\156\x20\157\x6e\x65\x20\74\x73\141\x6d\x6c\x3a\101\165\x74\150\156\x43\x6f\x6e\x74\x65\x78\x74\76\40\151\156\x20\x3c\x73\141\x6d\154\x3a\x41\165\164\x68\x6e\x53\x74\x61\164\x65\155\x65\156\164\x3e\x2e");
        goto dp;
        WL:
        throw new Exception("\115\x69\x73\163\x69\x6e\x67\x20\x72\x65\161\165\151\162\x65\144\x20\74\163\141\155\154\x3a\x41\x75\164\150\x6e\103\x6f\x6e\x74\145\x78\164\x3e\x20\x69\x6e\x20\74\163\x61\x6d\154\x3a\101\x75\164\150\x6e\x53\164\141\x74\x65\x6d\145\x6e\164\76\x2e");
        dp:
        $rh = $so[0];
        $Ps = Utilities::xpQuery($rh, "\x2e\57\163\141\155\x6c\x5f\x61\x73\x73\145\162\x74\x69\157\x6e\72\x41\x75\164\x68\156\103\x6f\156\x74\145\x78\164\x44\145\143\x6c\122\145\146");
        if (count($Ps) > 1) {
            goto Ji;
        }
        if (count($Ps) === 1) {
            goto Xl;
        }
        goto be;
        Ji:
        throw new Exception("\115\157\x72\x65\x20\x74\150\x61\156\40\157\156\x65\40\x3c\163\x61\155\154\72\101\165\x74\150\x6e\103\x6f\156\x74\145\x78\164\104\x65\x63\x6c\122\145\146\x3e\40\x66\157\165\x6e\x64\77");
        goto be;
        Xl:
        $this->setAuthnContextDeclRef(trim($Ps[0]->textContent));
        be:
        $zq = Utilities::xpQuery($rh, "\56\x2f\x73\x61\x6d\154\x5f\141\x73\163\x65\162\164\x69\x6f\156\x3a\x41\165\x74\150\x6e\103\x6f\156\164\145\170\x74\104\x65\143\x6c");
        if (count($zq) > 1) {
            goto Qh;
        }
        if (count($zq) === 1) {
            goto M1;
        }
        goto Ga;
        Qh:
        throw new Exception("\x4d\157\x72\x65\x20\x74\150\x61\156\x20\157\156\x65\40\74\163\141\155\154\x3a\x41\x75\164\150\156\103\x6f\156\x74\x65\x78\164\104\145\143\x6c\x3e\40\146\x6f\165\x6e\144\x3f");
        goto Ga;
        M1:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($zq[0]));
        Ga:
        $ca = Utilities::xpQuery($rh, "\x2e\x2f\x73\x61\155\x6c\x5f\141\163\x73\145\x72\x74\x69\157\156\72\101\165\x74\150\x6e\103\157\x6e\164\145\x78\164\x43\154\x61\x73\x73\x52\x65\146");
        if (count($ca) > 1) {
            goto JC;
        }
        if (count($ca) === 1) {
            goto dB;
        }
        goto BB;
        JC:
        throw new Exception("\x4d\157\x72\145\40\x74\x68\141\x6e\40\x6f\x6e\145\40\74\163\x61\x6d\x6c\x3a\x41\x75\x74\x68\156\x43\157\156\x74\145\170\164\x43\x6c\x61\x73\163\x52\145\146\x3e\x20\x69\x6e\x20\x3c\163\x61\155\154\x3a\101\165\x74\150\156\x43\157\156\164\145\x78\x74\76\x2e");
        goto BB;
        dB:
        $this->setAuthnContextClassRef(trim($ca[0]->textContent));
        BB:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto F7;
        }
        throw new Exception("\x4d\151\163\163\151\x6e\x67\40\145\151\164\x68\x65\162\x20\74\163\141\155\x6c\72\x41\x75\x74\150\x6e\103\157\x6e\x74\145\170\164\x43\154\x61\163\x73\122\145\x66\76\40\157\x72\x20\x3c\163\x61\x6d\154\x3a\101\x75\x74\150\x6e\103\157\156\164\145\x78\164\104\x65\x63\x6c\x52\145\x66\x3e\x20\x6f\x72\x20\74\163\141\155\154\72\101\x75\x74\x68\156\x43\x6f\156\x74\x65\170\164\x44\145\x63\x6c\x3e");
        F7:
        $this->AuthenticatingAuthority = Utilities::extractStrings($rh, "\165\x72\156\x3a\x6f\x61\x73\151\163\72\156\x61\x6d\x65\163\x3a\x74\143\x3a\123\x41\x4d\x4c\x3a\x32\56\x30\72\141\x73\163\x65\162\164\x69\x6f\x6e", "\101\165\164\150\x65\156\164\x69\x63\x61\x74\x69\x6e\x67\101\165\x74\x68\157\x72\x69\164\171");
    }
    private function parseAttributes(DOMElement $r2)
    {
        $fA = TRUE;
        $ab = Utilities::xpQuery($r2, "\56\x2f\163\141\155\x6c\137\141\x73\163\x65\x72\x74\x69\157\156\x3a\101\164\x74\x72\x69\142\165\x74\145\123\x74\x61\x74\x65\x6d\145\156\164\57\x73\x61\155\154\137\141\x73\163\145\162\x74\151\157\x6e\72\x41\164\x74\x72\x69\x62\x75\x74\145");
        foreach ($ab as $qI) {
            if ($qI->hasAttribute("\116\141\155\145")) {
                goto FR;
            }
            throw new Exception("\115\x69\163\x73\x69\156\x67\x20\156\x61\155\x65\x20\157\156\x20\74\x73\141\x6d\x6c\72\x41\164\x74\x72\151\142\165\164\145\76\40\x65\x6c\145\155\x65\x6e\x74\x2e");
            FR:
            $GZ = $qI->getAttribute("\116\x61\155\x65");
            if ($qI->hasAttribute("\x4e\x61\155\145\106\x6f\x72\x6d\x61\x74")) {
                goto dW;
            }
            $CF = "\x75\162\156\72\x6f\x61\x73\151\x73\x3a\156\x61\155\x65\x73\x3a\164\x63\72\123\x41\115\114\x3a\61\56\61\x3a\156\141\x6d\145\x69\144\x2d\146\157\162\x6d\141\164\72\x75\x6e\163\x70\x65\x63\151\x66\151\145\144";
            goto Wa;
            dW:
            $CF = $qI->getAttribute("\x4e\141\x6d\145\x46\157\162\155\141\x74");
            Wa:
            if ($fA) {
                goto hX;
            }
            if (!($this->nameFormat !== $CF)) {
                goto XN;
            }
            $this->nameFormat = "\165\162\x6e\72\x6f\141\x73\x69\x73\72\156\x61\x6d\x65\x73\x3a\164\143\72\123\101\115\x4c\72\x31\x2e\x31\x3a\156\141\x6d\x65\151\144\55\146\x6f\162\155\141\x74\x3a\x75\156\x73\160\145\143\x69\146\x69\x65\144";
            XN:
            goto XR;
            hX:
            $this->nameFormat = $CF;
            $fA = FALSE;
            XR:
            if (array_key_exists($GZ, $this->attributes)) {
                goto FW;
            }
            $this->attributes[$GZ] = array();
            FW:
            $os = Utilities::xpQuery($qI, "\x2e\x2f\x73\x61\155\x6c\137\x61\163\x73\x65\162\164\151\157\156\x3a\101\x74\164\162\x69\x62\x75\x74\x65\126\x61\154\x75\x65");
            foreach ($os as $Er) {
                $this->attributes[$GZ][] = trim($Er->textContent);
                js:
            }
            Jp:
            tj:
        }
        LK:
    }
    private function parseEncryptedAttributes(DOMElement $r2)
    {
        $this->encryptedAttribute = Utilities::xpQuery($r2, "\x2e\57\x73\141\155\154\x5f\x61\163\x73\145\x72\164\x69\157\x6e\72\101\x74\x74\x72\151\142\x75\x74\x65\x53\164\141\164\x65\x6d\x65\156\x74\x2f\163\141\x6d\x6c\137\x61\x73\163\145\162\x74\151\157\156\72\105\x6e\143\162\171\x70\x74\x65\144\101\164\164\162\x69\142\x75\164\x65");
    }
    private function parseSignature(DOMElement $r2)
    {
        $G0 = Utilities::validateElement($r2);
        if (!($G0 !== FALSE)) {
            goto nA;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $G0["\x43\145\x72\164\151\146\151\143\141\x74\x65\163"];
        $this->signatureData = $G0;
        nA:
    }
    public function validate(XMLSecurityKey $hG)
    {
        if (!($this->signatureData === NULL)) {
            goto hg;
        }
        return FALSE;
        hg:
        Utilities::validateSignature($this->signatureData, $hG);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($Sa)
    {
        $this->id = $Sa;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($Wi)
    {
        $this->issueInstant = $Wi;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($k3)
    {
        $this->issuer = $k3;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Ca;
        }
        throw new Exception("\x41\164\164\x65\155\x70\x74\145\x64\40\x74\157\x20\x72\145\164\x72\151\x65\166\x65\x20\x65\x6e\x63\x72\171\160\164\145\x64\40\116\141\x6d\x65\x49\x44\40\x77\151\x74\x68\x6f\x75\164\x20\x64\145\143\162\171\160\x74\x69\156\147\x20\x69\x74\x20\146\x69\x72\x73\164\56");
        Ca:
        return $this->nameId;
    }
    public function setNameId($cz)
    {
        $this->nameId = $cz;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto ZX;
        }
        return TRUE;
        ZX:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $hG)
    {
        $FU = new DOMDocument();
        $qs = $FU->createElement("\x72\x6f\x6f\164");
        $FU->appendChild($qs);
        Utilities::addNameId($qs, $this->nameId);
        $cz = $qs->firstChild;
        Utilities::getContainer()->debugMessage($cz, "\145\x6e\143\x72\x79\x70\164");
        $la = new XMLSecEnc();
        $la->setNode($cz);
        $la->type = XMLSecEnc::Element;
        $Sw = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $Sw->generateSessionKey();
        $la->encryptKey($hG, $Sw);
        $this->encryptedNameId = $la->encryptNode($Sw);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $hG, array $oI = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto t0;
        }
        return;
        t0:
        $cz = Utilities::decryptElement($this->encryptedNameId, $hG, $oI);
        Utilities::getContainer()->debugMessage($cz, "\x64\x65\x63\162\x79\160\164");
        $this->nameId = Utilities::parseNameId($cz);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $hG, array $oI = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto oQ;
        }
        return;
        oQ:
        $fA = TRUE;
        $ab = $this->encryptedAttribute;
        foreach ($ab as $qq) {
            $qI = Utilities::decryptElement($qq->getElementsByTagName("\105\156\143\162\x79\x70\164\145\x64\104\x61\164\x61")->item(0), $hG, $oI);
            if ($qI->hasAttribute("\x4e\141\155\145")) {
                goto CB;
            }
            throw new Exception("\115\x69\163\163\151\x6e\147\40\156\141\155\145\x20\x6f\156\x20\x3c\x73\x61\155\x6c\x3a\101\164\x74\x72\x69\142\x75\164\145\x3e\x20\x65\x6c\145\x6d\x65\x6e\x74\x2e");
            CB:
            $GZ = $qI->getAttribute("\116\141\x6d\x65");
            if ($qI->hasAttribute("\x4e\141\155\x65\x46\x6f\x72\155\x61\x74")) {
                goto f_;
            }
            $CF = "\165\162\x6e\x3a\157\141\163\x69\163\72\x6e\x61\155\145\163\72\164\143\x3a\x53\x41\115\x4c\72\x32\x2e\60\x3a\141\x74\164\162\x6e\x61\155\145\55\146\157\x72\x6d\x61\x74\x3a\x75\x6e\x73\x70\145\x63\x69\x66\151\x65\144";
            goto Dh;
            f_:
            $CF = $qI->getAttribute("\116\141\x6d\145\106\x6f\162\x6d\x61\164");
            Dh:
            if ($fA) {
                goto Gn;
            }
            if (!($this->nameFormat !== $CF)) {
                goto mS;
            }
            $this->nameFormat = "\x75\162\x6e\72\157\141\163\x69\x73\x3a\x6e\141\155\145\163\x3a\x74\143\x3a\x53\x41\x4d\x4c\72\62\56\x30\72\x61\164\164\162\x6e\141\155\145\x2d\146\x6f\162\155\141\x74\x3a\165\156\163\160\x65\x63\x69\x66\x69\145\x64";
            mS:
            goto L8;
            Gn:
            $this->nameFormat = $CF;
            $fA = FALSE;
            L8:
            if (array_key_exists($GZ, $this->attributes)) {
                goto QD;
            }
            $this->attributes[$GZ] = array();
            QD:
            $os = Utilities::xpQuery($qI, "\56\x2f\163\x61\x6d\x6c\x5f\x61\163\x73\145\162\164\151\x6f\156\x3a\101\164\x74\x72\x69\x62\165\164\145\x56\x61\x6c\x75\145");
            foreach ($os as $Er) {
                $this->attributes[$GZ][] = trim($Er->textContent);
                wE:
            }
            iS:
            fm:
        }
        VW:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($SF)
    {
        $this->notBefore = $SF;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($wo)
    {
        $this->notOnOrAfter = $wo;
    }
    public function setEncryptedAttributes($vS)
    {
        $this->requiredEncAttributes = $vS;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $Du = NULL)
    {
        $this->validAudiences = $Du;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($du)
    {
        $this->authnInstant = $du;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($kK)
    {
        $this->sessionNotOnOrAfter = $kK;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($S9)
    {
        $this->sessionIndex = $S9;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto z_;
        }
        return $this->authnContextClassRef;
        z_:
        if (empty($this->authnContextDeclRef)) {
            goto qs;
        }
        return $this->authnContextDeclRef;
        qs:
        return NULL;
    }
    public function setAuthnContext($vQ)
    {
        $this->setAuthnContextClassRef($vQ);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($Kk)
    {
        $this->authnContextClassRef = $Kk;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $Oo)
    {
        if (empty($this->authnContextDeclRef)) {
            goto d5;
        }
        throw new Exception("\x41\165\164\150\x6e\103\157\156\164\x65\x78\164\104\x65\x63\x6c\x52\145\146\x20\151\x73\x20\141\x6c\x72\145\141\x64\171\x20\162\x65\x67\151\163\x74\145\162\145\x64\41\40\x4d\x61\171\40\157\x6e\x6c\171\x20\150\141\166\145\40\x65\x69\x74\x68\145\x72\40\141\x20\104\x65\x63\x6c\x20\x6f\162\40\x61\40\104\x65\x63\154\122\145\146\54\40\156\157\x74\x20\x62\157\164\x68\x21");
        d5:
        $this->authnContextDecl = $Oo;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($T_)
    {
        if (empty($this->authnContextDecl)) {
            goto Ia;
        }
        throw new Exception("\x41\165\164\x68\x6e\103\157\x6e\164\x65\170\164\x44\145\143\x6c\x20\151\163\x20\141\x6c\x72\x65\x61\x64\171\40\162\x65\147\x69\x73\x74\145\162\145\x64\41\40\x4d\x61\x79\x20\x6f\x6e\x6c\171\40\x68\141\x76\145\40\145\151\x74\150\x65\162\40\x61\40\104\x65\x63\x6c\40\157\x72\40\x61\x20\x44\x65\x63\154\x52\145\x66\x2c\x20\x6e\x6f\164\40\x62\157\x74\x68\x21");
        Ia:
        $this->authnContextDeclRef = $T_;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($AR)
    {
        $this->AuthenticatingAuthority = $AR;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $ab)
    {
        $this->attributes = $ab;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($CF)
    {
        $this->nameFormat = $CF;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $p2)
    {
        $this->SubjectConfirmation = $p2;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $mM = NULL)
    {
        $this->signatureKey = $mM;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $xd = NULL)
    {
        $this->encryptionKey = $xd;
    }
    public function setCertificates(array $KX)
    {
        $this->certificates = $KX;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $td = NULL)
    {
        if ($td === NULL) {
            goto OF;
        }
        $LC = $td->ownerDocument;
        goto qE;
        OF:
        $LC = new DOMDocument();
        $td = $LC;
        qE:
        $qs = $LC->createElementNS("\165\x72\x6e\x3a\x6f\x61\x73\151\x73\x3a\x6e\x61\155\x65\163\72\x74\x63\x3a\123\x41\115\114\72\62\56\x30\x3a\141\163\x73\x65\162\164\151\x6f\156", "\163\141\155\x6c\x3a" . "\x41\163\x73\x65\x72\x74\151\x6f\156");
        $td->appendChild($qs);
        $qs->setAttributeNS("\x75\162\156\x3a\x6f\141\163\151\163\72\156\141\x6d\x65\x73\72\164\x63\72\123\x41\115\114\72\62\56\60\x3a\160\162\157\x74\x6f\x63\157\154", "\163\x61\x6d\x6c\160\72\x74\x6d\160", "\164\155\160");
        $qs->removeAttributeNS("\x75\162\156\72\157\141\163\151\x73\x3a\x6e\x61\155\145\x73\x3a\164\143\72\123\101\115\114\72\x32\x2e\x30\x3a\160\162\157\x74\x6f\x63\x6f\x6c", "\164\155\160");
        $qs->setAttributeNS("\x68\x74\x74\160\x3a\57\57\167\x77\167\56\x77\63\x2e\157\162\x67\57\62\x30\60\61\57\x58\x4d\114\x53\x63\x68\145\155\141\55\151\156\163\164\141\156\x63\x65", "\170\163\151\72\164\155\x70", "\164\x6d\160");
        $qs->removeAttributeNS("\x68\164\x74\160\72\x2f\x2f\x77\x77\x77\x2e\167\63\x2e\157\x72\x67\57\62\60\60\x31\x2f\130\x4d\114\x53\143\x68\x65\155\x61\55\151\x6e\163\x74\x61\x6e\143\145", "\x74\x6d\x70");
        $qs->setAttributeNS("\150\164\164\160\x3a\57\57\167\x77\x77\x2e\x77\63\x2e\x6f\x72\x67\57\62\x30\x30\61\57\130\x4d\x4c\123\x63\150\x65\155\x61", "\x78\163\x3a\x74\x6d\160", "\x74\155\x70");
        $qs->removeAttributeNS("\x68\164\x74\160\72\57\57\167\167\x77\56\x77\x33\56\x6f\x72\147\57\x32\x30\x30\61\57\130\x4d\x4c\123\x63\x68\x65\x6d\x61", "\164\x6d\160");
        $qs->setAttribute("\x49\104", $this->id);
        $qs->setAttribute("\x56\145\x72\163\151\157\x6e", "\x32\56\x30");
        $qs->setAttribute("\111\x73\163\x75\x65\x49\156\163\164\141\x6e\164", gmdate("\x59\x2d\x6d\x2d\x64\134\124\110\x3a\151\72\163\x5c\132", $this->issueInstant));
        $k3 = Utilities::addString($qs, "\165\162\156\x3a\x6f\141\x73\151\x73\x3a\156\141\155\x65\163\x3a\x74\143\72\x53\101\x4d\x4c\72\62\56\60\72\x61\163\163\145\x72\164\151\x6f\156", "\x73\141\155\154\x3a\x49\163\163\165\145\x72", $this->issuer);
        $this->addSubject($qs);
        $this->addConditions($qs);
        $this->addAuthnStatement($qs);
        if ($this->requiredEncAttributes == FALSE) {
            goto NH;
        }
        $this->addEncryptedAttributeStatement($qs);
        goto oc;
        NH:
        $this->addAttributeStatement($qs);
        oc:
        if (!($this->signatureKey !== NULL)) {
            goto s2;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $qs, $k3->nextSibling);
        s2:
        return $qs;
    }
    private function addSubject(DOMElement $qs)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto Uu;
        }
        return;
        Uu:
        $OU = $qs->ownerDocument->createElementNS("\165\162\x6e\x3a\157\x61\x73\151\x73\72\156\x61\155\x65\x73\x3a\x74\143\72\x53\101\115\114\72\x32\56\60\72\141\x73\163\145\162\x74\x69\157\x6e", "\x73\x61\155\x6c\72\123\165\142\x6a\x65\x63\164");
        $qs->appendChild($OU);
        if ($this->encryptedNameId === NULL) {
            goto q9;
        }
        $If = $OU->ownerDocument->createElementNS("\165\x72\x6e\72\157\141\x73\x69\x73\x3a\156\141\155\x65\163\x3a\164\143\72\123\x41\115\114\72\x32\x2e\60\x3a\141\163\x73\x65\162\x74\151\157\156", "\x73\x61\155\154\x3a" . "\105\156\x63\162\171\x70\164\x65\x64\x49\x44");
        $OU->appendChild($If);
        $If->appendChild($OU->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto Ts;
        q9:
        Utilities::addNameId($OU, $this->nameId);
        Ts:
        foreach ($this->SubjectConfirmation as $aH) {
            $aH->toXML($OU);
            AT:
        }
        tJ:
    }
    private function addConditions(DOMElement $qs)
    {
        $LC = $qs->ownerDocument;
        $S7 = $LC->createElementNS("\165\162\x6e\72\x6f\141\163\151\163\x3a\156\x61\155\145\x73\72\x74\x63\x3a\x53\101\x4d\114\x3a\62\56\x30\72\x61\x73\163\x65\162\x74\x69\x6f\156", "\163\x61\155\x6c\72\103\x6f\156\144\151\164\151\157\156\163");
        $qs->appendChild($S7);
        if (!($this->notBefore !== NULL)) {
            goto uV;
        }
        $S7->setAttribute("\x4e\157\164\x42\145\146\x6f\162\145", gmdate("\131\55\155\x2d\x64\x5c\x54\x48\x3a\151\x3a\163\x5c\132", $this->notBefore));
        uV:
        if (!($this->notOnOrAfter !== NULL)) {
            goto Lw;
        }
        $S7->setAttribute("\x4e\157\164\x4f\x6e\117\162\x41\146\164\145\162", gmdate("\131\x2d\155\x2d\x64\x5c\x54\x48\72\x69\x3a\163\x5c\132", $this->notOnOrAfter));
        Lw:
        if (!($this->validAudiences !== NULL)) {
            goto zG;
        }
        $Iz = $LC->createElementNS("\x75\x72\156\x3a\157\141\163\x69\163\72\156\141\x6d\145\x73\72\x74\x63\72\x53\x41\x4d\x4c\72\x32\x2e\x30\x3a\x61\163\163\x65\162\x74\x69\x6f\156", "\x73\141\155\154\x3a\x41\165\x64\x69\x65\156\143\x65\122\x65\x73\164\162\x69\143\164\x69\157\x6e");
        $S7->appendChild($Iz);
        Utilities::addStrings($Iz, "\165\162\x6e\x3a\x6f\x61\x73\151\163\72\156\141\x6d\145\x73\x3a\x74\143\72\123\101\x4d\114\72\62\x2e\60\x3a\141\x73\x73\x65\x72\164\x69\x6f\156", "\163\x61\x6d\x6c\72\101\x75\x64\151\x65\x6e\143\x65", FALSE, $this->validAudiences);
        zG:
    }
    private function addAuthnStatement(DOMElement $qs)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto Z7;
        }
        return;
        Z7:
        $LC = $qs->ownerDocument;
        $FJ = $LC->createElementNS("\x75\x72\156\72\x6f\x61\163\x69\163\72\x6e\141\x6d\145\163\72\164\143\72\123\x41\115\114\72\62\56\x30\72\141\163\163\145\162\164\151\157\x6e", "\x73\x61\x6d\x6c\72\101\x75\164\150\156\123\x74\141\x74\x65\155\x65\x6e\x74");
        $qs->appendChild($FJ);
        $FJ->setAttribute("\x41\x75\164\150\x6e\111\x6e\163\x74\x61\156\164", gmdate("\x59\55\x6d\x2d\144\x5c\124\x48\72\x69\72\x73\x5c\x5a", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto Ko;
        }
        $FJ->setAttribute("\123\x65\x73\163\151\x6f\156\x4e\157\164\117\156\117\x72\x41\x66\x74\x65\x72", gmdate("\x59\55\155\55\x64\134\x54\x48\x3a\151\x3a\x73\134\x5a", $this->sessionNotOnOrAfter));
        Ko:
        if (!($this->sessionIndex !== NULL)) {
            goto PT;
        }
        $FJ->setAttribute("\x53\145\x73\163\x69\x6f\x6e\111\x6e\x64\x65\x78", $this->sessionIndex);
        PT:
        $rh = $LC->createElementNS("\165\x72\x6e\72\x6f\x61\x73\151\x73\x3a\x6e\141\155\x65\x73\x3a\x74\143\x3a\x53\101\x4d\x4c\x3a\x32\56\x30\x3a\141\x73\x73\145\162\x74\x69\x6f\x6e", "\x73\141\x6d\154\x3a\101\165\x74\x68\156\103\157\x6e\x74\145\170\x74");
        $FJ->appendChild($rh);
        if (empty($this->authnContextClassRef)) {
            goto QZ;
        }
        Utilities::addString($rh, "\165\x72\x6e\x3a\157\x61\x73\x69\x73\72\156\141\155\x65\x73\x3a\164\x63\x3a\x53\x41\115\114\72\62\56\60\72\141\x73\x73\145\162\164\151\157\156", "\163\141\155\154\x3a\x41\x75\164\x68\156\x43\x6f\156\164\x65\x78\164\x43\154\141\x73\x73\122\145\x66", $this->authnContextClassRef);
        QZ:
        if (empty($this->authnContextDecl)) {
            goto RT;
        }
        $this->authnContextDecl->toXML($rh);
        RT:
        if (empty($this->authnContextDeclRef)) {
            goto NA;
        }
        Utilities::addString($rh, "\x75\162\x6e\72\157\141\163\151\x73\72\156\141\x6d\x65\x73\x3a\164\x63\72\x53\101\x4d\x4c\72\x32\56\x30\x3a\x61\x73\x73\x65\162\x74\x69\x6f\156", "\x73\141\x6d\154\72\101\165\164\x68\156\103\157\156\164\145\x78\164\104\x65\x63\x6c\122\x65\146", $this->authnContextDeclRef);
        NA:
        Utilities::addStrings($rh, "\x75\x72\156\x3a\157\141\x73\151\x73\x3a\x6e\x61\155\145\163\x3a\x74\143\72\x53\x41\115\x4c\72\x32\x2e\x30\x3a\141\163\163\145\162\x74\151\x6f\156", "\163\x61\x6d\154\x3a\x41\165\164\150\x65\x6e\x74\x69\x63\141\164\x69\156\x67\x41\x75\x74\150\157\162\151\x74\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $qs)
    {
        if (!empty($this->attributes)) {
            goto Oq;
        }
        return;
        Oq:
        $LC = $qs->ownerDocument;
        $uo = $LC->createElementNS("\x75\x72\156\72\x6f\141\x73\x69\163\x3a\156\141\x6d\x65\x73\72\x74\x63\72\123\x41\x4d\x4c\x3a\62\56\x30\72\x61\x73\x73\x65\162\x74\151\x6f\x6e", "\x73\141\155\154\72\x41\164\x74\x72\x69\142\165\164\x65\123\164\x61\164\145\155\145\x6e\164");
        $qs->appendChild($uo);
        foreach ($this->attributes as $GZ => $os) {
            $qI = $LC->createElementNS("\165\162\156\72\157\141\163\151\163\x3a\156\141\155\145\x73\x3a\x74\143\72\x53\x41\115\114\x3a\x32\56\60\72\141\x73\163\x65\162\x74\x69\x6f\x6e", "\x73\x61\155\154\72\101\164\x74\x72\151\x62\x75\x74\x65");
            $uo->appendChild($qI);
            $qI->setAttribute("\116\x61\155\145", $GZ);
            if (!($this->nameFormat !== "\165\x72\x6e\72\x6f\141\163\x69\x73\x3a\x6e\141\x6d\x65\x73\72\x74\143\72\123\101\x4d\x4c\72\x32\56\60\72\141\164\164\162\156\x61\155\x65\x2d\146\157\162\155\141\x74\72\165\x6e\163\160\x65\x63\x69\x66\151\145\x64")) {
                goto tw;
            }
            $qI->setAttribute("\x4e\141\155\x65\x46\x6f\162\155\x61\x74", $this->nameFormat);
            tw:
            foreach ($os as $Er) {
                if (is_string($Er)) {
                    goto oU;
                }
                if (is_int($Er)) {
                    goto R8;
                }
                $NX = NULL;
                goto Ow;
                oU:
                $NX = "\x78\163\x3a\x73\x74\x72\151\156\x67";
                goto Ow;
                R8:
                $NX = "\170\x73\x3a\x69\x6e\164\x65\x67\x65\x72";
                Ow:
                $p5 = $LC->createElementNS("\x75\162\156\x3a\157\141\163\x69\x73\x3a\x6e\x61\155\145\x73\72\x74\x63\x3a\123\x41\x4d\x4c\x3a\62\56\60\x3a\x61\163\163\145\162\164\151\x6f\156", "\163\141\x6d\154\x3a\x41\164\x74\x72\151\x62\165\x74\145\x56\x61\x6c\165\145");
                $qI->appendChild($p5);
                if (!($NX !== NULL)) {
                    goto pU;
                }
                $p5->setAttributeNS("\x68\x74\164\160\x3a\x2f\57\x77\x77\167\56\167\x33\x2e\x6f\162\147\57\x32\60\x30\61\57\x58\x4d\114\123\x63\x68\x65\x6d\x61\x2d\151\156\x73\x74\141\156\143\145", "\170\163\151\72\x74\171\160\145", $NX);
                pU:
                if (!is_null($Er)) {
                    goto O8;
                }
                $p5->setAttributeNS("\150\164\164\160\x3a\x2f\x2f\167\x77\167\56\167\x33\56\157\162\147\57\x32\60\60\61\x2f\x58\x4d\114\123\x63\x68\145\155\x61\55\151\156\x73\164\x61\x6e\143\x65", "\x78\163\x69\72\x6e\x69\154", "\x74\x72\x75\x65");
                O8:
                if ($Er instanceof DOMNodeList) {
                    goto H5;
                }
                $p5->appendChild($LC->createTextNode($Er));
                goto rG;
                H5:
                $Pg = 0;
                da:
                if (!($Pg < $Er->length)) {
                    goto Tu;
                }
                $fr = $LC->importNode($Er->item($Pg), TRUE);
                $p5->appendChild($fr);
                XE:
                $Pg++;
                goto da;
                Tu:
                rG:
                FS:
            }
            Fv:
            My:
        }
        Mm:
    }
    private function addEncryptedAttributeStatement(DOMElement $qs)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto mR;
        }
        return;
        mR:
        $LC = $qs->ownerDocument;
        $uo = $LC->createElementNS("\165\x72\156\72\157\141\x73\151\163\x3a\x6e\141\x6d\145\x73\x3a\164\143\x3a\x53\x41\115\x4c\x3a\62\x2e\x30\x3a\141\163\x73\145\162\164\x69\x6f\x6e", "\x73\141\155\x6c\72\101\x74\x74\162\151\142\x75\x74\x65\x53\164\141\164\x65\x6d\145\156\164");
        $qs->appendChild($uo);
        foreach ($this->attributes as $GZ => $os) {
            $xZ = new DOMDocument();
            $qI = $xZ->createElementNS("\165\162\156\72\x6f\x61\163\151\163\72\x6e\141\155\145\163\x3a\164\x63\72\x53\101\115\x4c\x3a\62\56\60\72\x61\163\163\x65\162\164\151\157\x6e", "\163\141\155\154\72\x41\164\x74\162\x69\x62\x75\164\145");
            $qI->setAttribute("\116\x61\x6d\x65", $GZ);
            $xZ->appendChild($qI);
            if (!($this->nameFormat !== "\x75\162\x6e\72\157\x61\163\x69\x73\x3a\156\141\x6d\x65\163\72\x74\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\x61\164\x74\x72\x6e\x61\x6d\x65\55\x66\x6f\x72\x6d\141\x74\72\x75\x6e\x73\x70\x65\143\x69\x66\x69\x65\x64")) {
                goto JM;
            }
            $qI->setAttribute("\116\141\x6d\145\106\157\x72\x6d\141\164", $this->nameFormat);
            JM:
            foreach ($os as $Er) {
                if (is_string($Er)) {
                    goto Yk;
                }
                if (is_int($Er)) {
                    goto Bz;
                }
                $NX = NULL;
                goto wo;
                Yk:
                $NX = "\x78\163\72\x73\x74\162\151\156\x67";
                goto wo;
                Bz:
                $NX = "\x78\163\x3a\151\156\x74\145\x67\145\162";
                wo:
                $p5 = $xZ->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\x69\163\x3a\x6e\x61\x6d\x65\x73\x3a\164\143\72\x53\101\x4d\114\x3a\62\56\60\72\x61\x73\163\x65\x72\164\x69\157\156", "\x73\141\155\154\72\x41\x74\x74\x72\151\142\x75\x74\x65\x56\141\x6c\x75\145");
                $qI->appendChild($p5);
                if (!($NX !== NULL)) {
                    goto fW;
                }
                $p5->setAttributeNS("\150\x74\164\x70\x3a\x2f\57\167\x77\167\56\x77\63\56\x6f\x72\x67\x2f\62\x30\x30\61\57\x58\x4d\114\123\x63\x68\x65\155\x61\55\x69\x6e\163\164\141\156\x63\145", "\x78\x73\x69\x3a\164\171\x70\x65", $NX);
                fW:
                if ($Er instanceof DOMNodeList) {
                    goto Bu;
                }
                $p5->appendChild($xZ->createTextNode($Er));
                goto Bb;
                Bu:
                $Pg = 0;
                C1:
                if (!($Pg < $Er->length)) {
                    goto MS;
                }
                $fr = $xZ->importNode($Er->item($Pg), TRUE);
                $p5->appendChild($fr);
                RW:
                $Pg++;
                goto C1;
                MS:
                Bb:
                Zd:
            }
            QP:
            $YZ = new XMLSecEnc();
            $YZ->setNode($xZ->documentElement);
            $YZ->type = "\x68\164\164\160\72\57\57\167\x77\167\56\x77\x33\56\157\162\x67\x2f\62\x30\60\x31\57\60\x34\x2f\x78\x6d\154\x65\x6e\143\x23\105\x6c\145\x6d\x65\x6e\164";
            $Sw = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $Sw->generateSessionKey();
            $YZ->encryptKey($this->encryptionKey, $Sw);
            $Yc = $YZ->encryptNode($Sw);
            $tJ = $LC->createElementNS("\x75\x72\156\x3a\x6f\x61\163\x69\163\72\x6e\x61\x6d\145\x73\x3a\164\x63\72\123\101\x4d\x4c\x3a\62\56\x30\72\x61\x73\163\x65\162\164\151\x6f\x6e", "\163\x61\155\154\x3a\x45\x6e\x63\162\x79\160\164\145\144\101\164\164\x72\151\x62\x75\164\145");
            $uo->appendChild($tJ);
            $ms = $LC->importNode($Yc, TRUE);
            $tJ->appendChild($ms);
            x1:
        }
        oS:
    }
}
