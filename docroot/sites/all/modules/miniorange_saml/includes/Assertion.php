<?php


include_once "\x55\x74\x69\154\x69\164\x69\x65\x73\x2e\x70\150\160";
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
    public function __construct(DOMElement $uQ = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\162\x6e\x3a\x6f\141\163\151\163\x3a\156\141\x6d\145\163\72\x74\143\x3a\123\101\x4d\114\x3a\61\56\61\72\156\x61\x6d\x65\151\144\55\146\x6f\x72\x6d\141\164\x3a\x75\156\163\x70\145\143\x69\146\x69\145\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($uQ === NULL)) {
            goto aI;
        }
        return;
        aI:
        if (!($uQ->localName === "\105\156\x63\x72\x79\x70\164\x65\144\101\x73\x73\x65\162\164\151\157\x6e")) {
            goto K3;
        }
        $EV = Utilities::xpQuery($uQ, "\56\57\170\x65\156\143\x3a\x45\x6e\143\x72\171\x70\164\x65\144\104\x61\164\141");
        $Bz = Utilities::xpQuery($uQ, "\56\57\170\145\x6e\x63\72\x45\156\x63\162\x79\x70\x74\145\144\x44\x61\x74\x61\57\x64\x73\x3a\113\145\x79\111\x6e\x66\x6f\x2f\170\145\x6e\x63\72\105\156\143\162\x79\x70\164\x65\x64\x4b\145\x79");
        $jJ = '';
        if (empty($Bz)) {
            goto L2;
        }
        $jJ = $Bz[0]->firstChild->getAttribute("\x41\x6c\147\157\x72\151\164\150\x6d");
        goto S9;
        L2:
        $Bz = Utilities::xpQuery($uQ, "\56\x2f\170\145\156\143\x3a\x45\156\x63\162\x79\x70\164\145\x64\113\x65\x79\57\170\x65\156\143\x3a\105\x6e\x63\162\x79\x70\164\151\157\x6e\115\145\164\x68\x6f\144");
        $jJ = $Bz[0]->getAttribute("\101\154\147\157\162\151\164\x68\155");
        S9:
        $JF = Utilities::getEncryptionAlgorithm($jJ);
        if (count($EV) === 0) {
            goto u5;
        }
        if (count($EV) > 1) {
            goto Na;
        }
        goto Bt;
        u5:
        throw new Exception("\x4d\151\163\163\x69\x6e\147\x20\x65\156\x63\x72\x79\x70\x74\145\x64\40\x64\141\164\141\x20\151\156\40\74\163\x61\x6d\x6c\72\x45\x6e\x63\162\171\x70\164\x65\144\x41\x73\163\145\162\164\x69\x6f\x6e\76\x2e");
        goto Bt;
        Na:
        throw new Exception("\x4d\x6f\x72\x65\x20\164\150\x61\156\x20\157\156\145\40\145\156\x63\162\x79\160\x74\x65\144\40\144\x61\164\141\40\145\x6c\145\155\x65\x6e\164\x20\x69\x6e\x20\74\x73\x61\155\x6c\x3a\x45\x6e\x63\162\x79\160\164\x65\x64\101\163\x73\145\162\164\151\x6f\156\x3e\56");
        Bt:
        $N1 = '';
        $N1 = variable_get("\155\151\156\151\x6f\x72\141\x6e\147\x65\137\x73\141\x6d\154\x5f\160\x72\x69\x76\141\x74\145\137\143\x65\162\x74\x69\146\x69\143\141\164\x65");
        $FS = new XMLSecurityKey($JF, array("\x74\171\x70\145" => "\160\x72\x69\x76\x61\164\x65"));
        $e5 = drupal_get_path("\x6d\157\x64\x75\x6c\x65", "\155\x69\x6e\151\157\x72\141\x6e\x67\145\137\163\141\155\x6c");
        if ($N1 != '') {
            goto II;
        }
        $e2 = $e5 . "\57\162\x65\x73\157\165\x72\x63\145\x73\x2f\x73\x70\x2d\x6b\145\171\x2e\153\145\171";
        goto Lh;
        II:
        $e2 = $e5 . "\57\x72\x65\x73\x6f\x75\162\x63\145\163\57\103\165\x73\164\157\155\x5f\120\x72\151\166\141\x74\x65\137\103\145\162\164\151\x66\x69\x63\x61\x74\x65\x2e\153\145\x79";
        Lh:
        $FS->loadKey($e2, TRUE);
        $yc = new XMLSecurityKey($JF, array("\x74\x79\x70\145" => "\x70\x72\x69\166\x61\164\145"));
        $Mz = $e5 . "\x2f\162\x65\163\157\165\x72\x63\145\163\x2f\x6d\x69\156\151\157\162\x61\156\x67\x65\x5f\163\x70\x5f\160\x72\151\166\x5f\x6b\145\171\56\x6b\x65\171";
        $yc->loadKey($Mz, TRUE);
        $su = array();
        $uQ = Utilities::decryptElement($EV[0], $FS, $su, $yc);
        K3:
        if ($uQ->hasAttribute("\111\x44")) {
            goto nH;
        }
        throw new Exception("\x4d\151\x73\163\x69\156\147\40\111\104\x20\x61\164\164\x72\x69\x62\x75\x74\145\40\157\156\40\x53\x41\x4d\114\x20\141\163\163\145\162\164\151\x6f\156\56");
        nH:
        $this->id = $uQ->getAttribute("\111\x44");
        if (!($uQ->getAttribute("\x56\145\162\x73\151\x6f\156") !== "\62\x2e\60")) {
            goto pT;
        }
        throw new Exception("\125\156\x73\165\x70\160\157\x72\164\x65\144\x20\166\145\162\x73\x69\157\x6e\x3a\40" . $uQ->getAttribute("\x56\x65\162\x73\151\x6f\x6e"));
        pT:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($uQ->getAttribute("\111\163\x73\x75\x65\x49\156\163\164\141\156\164"));
        $PY = Utilities::xpQuery($uQ, "\x2e\57\163\141\x6d\154\137\141\x73\x73\145\162\164\x69\x6f\156\x3a\x49\163\163\x75\x65\162");
        if (!empty($PY)) {
            goto IQ;
        }
        throw new Exception("\115\x69\163\x73\x69\x6e\147\x20\x3c\x73\x61\x6d\x6c\72\x49\163\x73\165\145\162\76\x20\151\156\x20\141\163\x73\145\x72\x74\151\x6f\156\56");
        IQ:
        $this->issuer = trim($PY[0]->textContent);
        $this->parseConditions($uQ);
        $this->parseAuthnStatement($uQ);
        $this->parseAttributes($uQ);
        $this->parseEncryptedAttributes($uQ);
        $this->parseSignature($uQ);
        $this->parseSubject($uQ);
    }
    private function parseSubject(DOMElement $uQ)
    {
        $l1 = Utilities::xpQuery($uQ, "\56\57\x73\x61\x6d\x6c\137\x61\x73\163\145\x72\164\151\157\156\72\123\165\142\152\145\x63\164");
        if (empty($l1)) {
            goto PL;
        }
        if (count($l1) > 1) {
            goto kT;
        }
        goto AV;
        PL:
        return;
        goto AV;
        kT:
        throw new Exception("\115\157\162\145\x20\x74\150\141\x6e\x20\157\x6e\145\x20\x3c\163\141\x6d\x6c\x3a\x53\165\142\152\x65\143\164\x3e\40\x69\x6e\40\74\163\141\155\154\x3a\101\163\x73\x65\162\164\151\x6f\x6e\x3e\56");
        AV:
        $l1 = $l1[0];
        $O_ = Utilities::xpQuery($l1, "\x2e\57\x73\x61\x6d\154\x5f\x61\163\x73\x65\162\164\x69\x6f\x6e\72\116\x61\x6d\145\111\104\x20\174\x20\56\x2f\163\x61\155\154\137\141\x73\x73\145\x72\164\151\x6f\x6e\72\105\156\143\162\171\160\x74\x65\144\x49\104\57\x78\x65\156\143\72\x45\x6e\x63\x72\171\x70\164\145\x64\x44\x61\164\x61");
        if (empty($O_)) {
            goto RT;
        }
        if (count($O_) > 1) {
            goto mk;
        }
        goto wQ;
        RT:
        throw new Exception("\x4d\x69\163\x73\x69\156\147\40\74\x73\141\x6d\154\x3a\116\141\x6d\x65\x49\x44\76\x20\x6f\x72\40\x3c\163\141\155\154\72\x45\156\143\162\x79\x70\x74\145\x64\111\x44\76\40\x69\x6e\40\74\163\x61\x6d\x6c\72\x53\165\x62\152\145\143\x74\76\x2e");
        goto wQ;
        mk:
        throw new Exception("\x4d\x6f\x72\x65\40\x74\x68\x61\156\x20\x6f\x6e\x65\40\x3c\163\x61\155\x6c\x3a\x4e\141\x6d\x65\x49\104\76\x20\157\x72\x20\74\163\141\155\154\x3a\x45\156\x63\x72\171\x70\164\x65\144\104\x3e\x20\x69\156\40\x3c\163\x61\x6d\154\72\x53\165\x62\152\145\x63\x74\76\56");
        wQ:
        $O_ = $O_[0];
        if ($O_->localName === "\x45\156\x63\x72\x79\160\164\145\144\104\x61\x74\141") {
            goto zJ;
        }
        $this->nameId = Utilities::parseNameId($O_);
        goto fV;
        zJ:
        $this->encryptedNameId = $O_;
        fV:
    }
    private function parseConditions(DOMElement $uQ)
    {
        $cT = Utilities::xpQuery($uQ, "\56\57\x73\141\155\154\137\141\163\163\145\x72\164\x69\x6f\x6e\72\103\x6f\x6e\x64\151\164\x69\157\156\163");
        if (empty($cT)) {
            goto MT;
        }
        if (count($cT) > 1) {
            goto Ss;
        }
        goto ua;
        MT:
        return;
        goto ua;
        Ss:
        throw new Exception("\115\x6f\162\x65\x20\164\150\141\156\40\157\156\x65\40\74\x73\141\x6d\154\x3a\x43\x6f\156\144\x69\x74\x69\x6f\156\x73\76\40\x69\x6e\x20\x3c\x73\141\155\x6c\72\x41\163\x73\x65\x72\164\151\157\156\x3e\x2e");
        ua:
        $cT = $cT[0];
        if (!$cT->hasAttribute("\116\157\x74\x42\145\146\x6f\162\145")) {
            goto Nd;
        }
        $Ex = Utilities::xsDateTimeToTimestamp($cT->getAttribute("\x4e\x6f\164\x42\145\146\x6f\x72\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $Ex)) {
            goto tv;
        }
        $this->notBefore = $Ex;
        tv:
        Nd:
        if (!$cT->hasAttribute("\x4e\x6f\164\x4f\156\117\x72\101\x66\x74\x65\x72")) {
            goto ed;
        }
        $hM = Utilities::xsDateTimeToTimestamp($cT->getAttribute("\116\x6f\x74\x4f\156\x4f\x72\x41\146\x74\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $hM)) {
            goto IN;
        }
        $this->notOnOrAfter = $hM;
        IN:
        ed:
        $oB = $cT->firstChild;
        Kd:
        if (!($oB !== NULL)) {
            goto FY;
        }
        if (!$oB instanceof DOMText) {
            goto Lf;
        }
        goto Gb;
        Lf:
        if (!($oB->namespaceURI !== "\x75\162\156\72\x6f\x61\x73\x69\163\x3a\x6e\141\x6d\145\163\72\x74\143\72\x53\x41\x4d\x4c\x3a\x32\x2e\60\x3a\x61\x73\163\x65\x72\x74\151\157\156")) {
            goto AE;
        }
        throw new Exception("\x55\x6e\153\x6e\157\x77\156\x20\156\141\x6d\x65\163\x70\141\143\x65\40\x6f\x66\x20\143\x6f\156\144\151\164\x69\157\156\x3a\40" . var_export($oB->namespaceURI, TRUE));
        AE:
        switch ($oB->localName) {
            case "\x41\165\x64\x69\x65\x6e\143\145\122\x65\x73\x74\162\x69\143\164\151\157\156":
                $Mf = Utilities::extractStrings($oB, "\165\162\x6e\72\157\x61\x73\151\163\72\x6e\141\x6d\x65\163\x3a\x74\143\72\123\x41\115\114\x3a\x32\56\x30\72\x61\163\x73\145\162\x74\151\157\156", "\x41\165\x64\x69\145\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto ef;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $Mf);
                goto cg;
                ef:
                $this->validAudiences = $Mf;
                cg:
                goto Ew;
            case "\117\156\145\124\151\x6d\x65\125\x73\x65":
                goto Ew;
            case "\120\162\x6f\x78\x79\x52\145\163\164\162\151\143\x74\x69\157\x6e":
                goto Ew;
            default:
                throw new Exception("\125\156\x6b\156\157\x77\x6e\40\x63\157\156\x64\x69\x74\x69\x6f\156\72\40" . var_export($oB->localName, TRUE));
        }
        RC:
        Ew:
        Gb:
        $oB = $oB->nextSibling;
        goto Kd;
        FY:
    }
    private function parseAuthnStatement(DOMElement $uQ)
    {
        $Ik = Utilities::xpQuery($uQ, "\x2e\57\x73\x61\x6d\x6c\137\x61\163\163\x65\x72\164\x69\x6f\156\72\101\165\164\x68\156\x53\x74\x61\x74\145\155\x65\156\164");
        if (empty($Ik)) {
            goto GX;
        }
        if (count($Ik) > 1) {
            goto V8;
        }
        goto LP;
        GX:
        $this->authnInstant = NULL;
        return;
        goto LP;
        V8:
        throw new Exception("\x4d\x6f\162\145\40\x74\x68\x61\x74\40\157\x6e\x65\x20\x3c\x73\x61\155\154\x3a\x41\x75\164\x68\156\x53\164\x61\x74\x65\x6d\x65\x6e\x74\x3e\x20\151\x6e\40\74\163\141\155\154\72\x41\x73\163\x65\x72\164\x69\x6f\x6e\76\40\x6e\157\164\x20\163\165\160\160\x6f\162\x74\145\x64\x2e");
        LP:
        $iu = $Ik[0];
        if ($iu->hasAttribute("\x41\x75\x74\150\x6e\x49\156\x73\164\x61\156\164")) {
            goto uq;
        }
        throw new Exception("\115\151\x73\163\x69\x6e\x67\40\x72\x65\161\x75\151\162\x65\144\x20\x41\165\164\150\x6e\111\156\x73\x74\x61\156\164\x20\141\164\164\162\151\x62\165\164\x65\x20\x6f\156\x20\x3c\x73\x61\155\x6c\x3a\x41\x75\164\x68\156\x53\164\x61\164\x65\x6d\x65\156\x74\x3e\x2e");
        uq:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($iu->getAttribute("\x41\x75\x74\x68\156\x49\x6e\x73\x74\x61\x6e\x74"));
        if (!$iu->hasAttribute("\123\145\163\x73\x69\157\x6e\x4e\157\x74\117\x6e\x4f\162\101\146\164\x65\x72")) {
            goto u1;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($iu->getAttribute("\123\145\x73\163\x69\157\156\116\x6f\x74\x4f\x6e\x4f\x72\101\x66\x74\145\162"));
        u1:
        if (!$iu->hasAttribute("\x53\x65\163\x73\x69\x6f\x6e\111\156\144\145\x78")) {
            goto TD;
        }
        $this->sessionIndex = $iu->getAttribute("\x53\x65\x73\x73\151\157\x6e\111\156\144\x65\170");
        TD:
        $this->parseAuthnContext($iu);
    }
    private function parseAuthnContext(DOMElement $Fi)
    {
        $qz = Utilities::xpQuery($Fi, "\x2e\x2f\163\x61\155\x6c\x5f\141\x73\163\x65\x72\x74\151\157\156\x3a\x41\x75\x74\150\156\103\157\156\x74\x65\170\x74");
        if (count($qz) > 1) {
            goto bX;
        }
        if (empty($qz)) {
            goto uF;
        }
        goto iC;
        bX:
        throw new Exception("\115\x6f\162\145\40\x74\x68\141\x6e\40\x6f\x6e\145\x20\x3c\x73\141\x6d\154\72\x41\165\x74\150\156\x43\x6f\x6e\x74\x65\170\164\76\40\x69\x6e\40\74\x73\141\x6d\154\72\101\x75\164\x68\156\123\x74\x61\x74\145\155\145\x6e\x74\76\56");
        goto iC;
        uF:
        throw new Exception("\x4d\151\x73\x73\151\x6e\147\x20\x72\145\x71\165\x69\x72\x65\144\40\x3c\x73\x61\x6d\154\x3a\x41\165\164\150\x6e\x43\157\x6e\x74\x65\170\164\76\40\x69\156\x20\x3c\163\x61\155\x6c\72\101\165\164\x68\x6e\x53\x74\x61\x74\145\155\145\x6e\x74\x3e\x2e");
        iC:
        $yN = $qz[0];
        $hB = Utilities::xpQuery($yN, "\56\57\163\x61\155\x6c\137\x61\x73\x73\x65\162\x74\151\157\x6e\72\x41\165\x74\x68\156\103\157\x6e\x74\x65\170\x74\104\145\143\x6c\122\145\146");
        if (count($hB) > 1) {
            goto hu;
        }
        if (count($hB) === 1) {
            goto pM;
        }
        goto wY;
        hu:
        throw new Exception("\x4d\x6f\x72\x65\x20\164\x68\141\156\x20\157\x6e\x65\40\74\163\x61\155\x6c\72\x41\x75\164\x68\156\103\x6f\156\x74\x65\170\164\x44\x65\143\x6c\122\145\x66\x3e\x20\146\x6f\165\x6e\144\77");
        goto wY;
        pM:
        $this->setAuthnContextDeclRef(trim($hB[0]->textContent));
        wY:
        $xU = Utilities::xpQuery($yN, "\x2e\57\163\141\x6d\x6c\x5f\141\163\x73\x65\x72\x74\151\157\156\x3a\x41\165\164\x68\x6e\103\157\x6e\164\145\x78\164\104\145\143\154");
        if (count($xU) > 1) {
            goto ym;
        }
        if (count($xU) === 1) {
            goto Dh;
        }
        goto hL;
        ym:
        throw new Exception("\115\x6f\162\x65\x20\164\150\x61\156\x20\157\156\x65\40\x3c\163\141\x6d\x6c\x3a\101\x75\x74\x68\x6e\x43\157\156\x74\x65\170\164\104\x65\143\x6c\x3e\x20\x66\x6f\x75\156\144\77");
        goto hL;
        Dh:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($xU[0]));
        hL:
        $pd = Utilities::xpQuery($yN, "\56\57\x73\x61\155\154\x5f\x61\163\163\x65\162\x74\151\157\156\72\101\165\164\150\x6e\x43\157\156\164\145\170\x74\103\x6c\141\163\x73\x52\x65\146");
        if (count($pd) > 1) {
            goto Bp;
        }
        if (count($pd) === 1) {
            goto ic;
        }
        goto ge;
        Bp:
        throw new Exception("\115\x6f\x72\x65\x20\x74\150\x61\156\40\157\156\x65\x20\x3c\x73\x61\155\154\x3a\x41\x75\164\150\156\x43\157\156\164\145\170\x74\x43\154\x61\163\163\122\x65\x66\x3e\x20\x69\x6e\x20\74\163\141\155\154\72\x41\165\x74\x68\156\103\x6f\x6e\x74\x65\170\x74\76\x2e");
        goto ge;
        ic:
        $this->setAuthnContextClassRef(trim($pd[0]->textContent));
        ge:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto ZD;
        }
        throw new Exception("\115\151\163\163\x69\x6e\147\40\145\151\164\150\x65\x72\x20\x3c\163\141\155\154\x3a\x41\x75\164\x68\x6e\103\x6f\x6e\x74\145\170\164\x43\154\x61\163\163\x52\145\x66\76\40\157\x72\x20\x3c\163\x61\155\154\72\101\165\164\x68\156\103\x6f\156\x74\x65\170\164\x44\145\x63\x6c\x52\145\146\x3e\x20\157\162\x20\74\163\141\155\154\x3a\x41\165\164\x68\156\x43\157\156\x74\x65\x78\164\x44\145\143\x6c\x3e");
        ZD:
        $this->AuthenticatingAuthority = Utilities::extractStrings($yN, "\165\162\156\x3a\x6f\x61\x73\151\163\x3a\x6e\141\155\x65\163\x3a\164\143\x3a\x53\x41\x4d\x4c\72\x32\56\60\72\141\x73\163\x65\x72\164\x69\x6f\156", "\101\165\164\x68\x65\156\164\151\143\x61\x74\151\156\147\x41\x75\x74\150\x6f\x72\151\164\171");
    }
    private function parseAttributes(DOMElement $uQ)
    {
        $dG = TRUE;
        $km = Utilities::xpQuery($uQ, "\x2e\x2f\x73\x61\x6d\154\137\x61\x73\163\145\x72\x74\x69\x6f\x6e\72\x41\164\x74\x72\x69\x62\165\164\x65\123\164\141\164\145\x6d\145\x6e\164\x2f\163\141\155\x6c\x5f\x61\163\163\x65\x72\164\151\x6f\x6e\72\x41\x74\x74\x72\x69\x62\165\164\145");
        foreach ($km as $rf) {
            if ($rf->hasAttribute("\x4e\141\155\145")) {
                goto EK;
            }
            throw new Exception("\x4d\151\163\x73\151\x6e\147\x20\156\141\155\145\x20\x6f\x6e\40\x3c\x73\x61\155\154\72\101\164\164\162\151\142\x75\164\x65\76\x20\x65\x6c\x65\x6d\x65\x6e\164\56");
            EK:
            $hL = $rf->getAttribute("\116\x61\155\145");
            if ($rf->hasAttribute("\116\x61\x6d\x65\106\157\162\x6d\141\164")) {
                goto S0;
            }
            $gP = "\165\162\x6e\x3a\x6f\x61\163\x69\163\x3a\x6e\x61\x6d\x65\x73\72\164\143\72\x53\101\x4d\x4c\x3a\x31\56\x31\72\156\x61\x6d\145\x69\x64\55\x66\157\x72\x6d\x61\164\72\165\x6e\163\160\x65\143\x69\x66\151\145\x64";
            goto tX;
            S0:
            $gP = $rf->getAttribute("\116\x61\x6d\145\x46\x6f\162\155\141\164");
            tX:
            if ($dG) {
                goto VX;
            }
            if (!($this->nameFormat !== $gP)) {
                goto Iw;
            }
            $this->nameFormat = "\165\162\156\x3a\157\x61\163\151\x73\x3a\x6e\x61\155\145\x73\x3a\x74\143\x3a\x53\x41\115\x4c\x3a\x31\56\61\x3a\156\x61\x6d\145\x69\144\x2d\x66\x6f\x72\155\x61\x74\x3a\x75\156\x73\x70\145\x63\x69\x66\151\145\x64";
            Iw:
            goto YH;
            VX:
            $this->nameFormat = $gP;
            $dG = FALSE;
            YH:
            if (array_key_exists($hL, $this->attributes)) {
                goto FO;
            }
            $this->attributes[$hL] = array();
            FO:
            $tx = Utilities::xpQuery($rf, "\56\57\163\141\155\154\137\x61\163\163\145\x72\x74\x69\x6f\x6e\x3a\101\164\164\x72\x69\142\x75\x74\145\126\141\x6c\165\x65");
            foreach ($tx as $gI) {
                $this->attributes[$hL][] = trim($gI->textContent);
                Et:
            }
            zx:
            DT:
        }
        yZ:
    }
    private function parseEncryptedAttributes(DOMElement $uQ)
    {
        $this->encryptedAttribute = Utilities::xpQuery($uQ, "\56\57\x73\141\155\154\x5f\x61\x73\163\145\162\164\x69\x6f\156\x3a\x41\164\164\x72\151\x62\165\x74\145\123\x74\x61\x74\145\155\145\156\164\57\x73\141\x6d\154\x5f\x61\163\x73\145\162\x74\151\157\x6e\x3a\105\x6e\x63\x72\171\160\x74\x65\x64\x41\164\164\x72\151\142\x75\x74\145");
    }
    private function parseSignature(DOMElement $uQ)
    {
        $Rd = Utilities::validateElement($uQ);
        if (!($Rd !== FALSE)) {
            goto OZ;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $Rd["\103\x65\162\164\x69\146\151\x63\141\x74\x65\163"];
        $this->signatureData = $Rd;
        OZ:
    }
    public function validate(XMLSecurityKey $FS)
    {
        if (!($this->signatureData === NULL)) {
            goto y0;
        }
        return FALSE;
        y0:
        Utilities::validateSignature($this->signatureData, $FS);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($VV)
    {
        $this->id = $VV;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($F3)
    {
        $this->issueInstant = $F3;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($PY)
    {
        $this->issuer = $PY;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto FL;
        }
        throw new Exception("\x41\164\164\x65\x6d\x70\x74\x65\x64\x20\x74\x6f\x20\162\145\x74\x72\151\145\166\145\x20\x65\x6e\143\162\x79\x70\164\x65\x64\40\116\141\x6d\145\x49\x44\40\x77\x69\x74\150\157\x75\164\40\144\145\x63\162\171\x70\164\x69\x6e\x67\x20\151\x74\40\x66\x69\x72\163\164\56");
        FL:
        return $this->nameId;
    }
    public function setNameId($O_)
    {
        $this->nameId = $O_;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto bG;
        }
        return TRUE;
        bG:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $FS)
    {
        $M8 = new DOMDocument();
        $nv = $M8->createElement("\162\x6f\x6f\164");
        $M8->appendChild($nv);
        Utilities::addNameId($nv, $this->nameId);
        $O_ = $nv->firstChild;
        Utilities::getContainer()->debugMessage($O_, "\x65\156\143\162\171\x70\164");
        $tQ = new XMLSecEnc();
        $tQ->setNode($O_);
        $tQ->type = XMLSecEnc::Element;
        $HH = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $HH->generateSessionKey();
        $tQ->encryptKey($FS, $HH);
        $this->encryptedNameId = $tQ->encryptNode($HH);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $FS, array $su = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto RA;
        }
        return;
        RA:
        $O_ = Utilities::decryptElement($this->encryptedNameId, $FS, $su);
        Utilities::getContainer()->debugMessage($O_, "\144\x65\143\162\x79\x70\164");
        $this->nameId = Utilities::parseNameId($O_);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $FS, array $su = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto hz;
        }
        return;
        hz:
        $dG = TRUE;
        $km = $this->encryptedAttribute;
        foreach ($km as $Ci) {
            $rf = Utilities::decryptElement($Ci->getElementsByTagName("\x45\156\x63\162\171\160\164\145\x64\x44\x61\164\141")->item(0), $FS, $su);
            if ($rf->hasAttribute("\116\141\155\x65")) {
                goto pQ;
            }
            throw new Exception("\x4d\151\x73\x73\151\x6e\x67\40\156\141\155\x65\40\x6f\x6e\x20\x3c\163\141\x6d\154\x3a\101\x74\x74\162\x69\x62\165\164\145\x3e\40\x65\154\145\155\145\156\x74\56");
            pQ:
            $hL = $rf->getAttribute("\x4e\141\155\x65");
            if ($rf->hasAttribute("\116\141\155\x65\106\x6f\x72\155\x61\164")) {
                goto TZ;
            }
            $gP = "\x75\162\156\x3a\157\x61\x73\x69\163\x3a\156\141\155\145\163\72\164\x63\72\123\x41\x4d\114\72\x32\56\60\72\141\164\164\x72\x6e\141\x6d\145\55\x66\x6f\x72\x6d\141\164\x3a\x75\156\163\160\x65\143\151\146\151\x65\144";
            goto s1;
            TZ:
            $gP = $rf->getAttribute("\116\x61\x6d\x65\x46\157\x72\155\x61\164");
            s1:
            if ($dG) {
                goto P4;
            }
            if (!($this->nameFormat !== $gP)) {
                goto Tn;
            }
            $this->nameFormat = "\165\162\x6e\72\157\x61\x73\x69\x73\x3a\156\141\x6d\145\163\x3a\164\x63\72\x53\x41\115\x4c\x3a\x32\x2e\x30\x3a\141\164\x74\x72\156\x61\155\x65\x2d\x66\157\x72\155\x61\164\x3a\165\x6e\x73\x70\x65\x63\151\x66\151\x65\x64";
            Tn:
            goto dU;
            P4:
            $this->nameFormat = $gP;
            $dG = FALSE;
            dU:
            if (array_key_exists($hL, $this->attributes)) {
                goto UE;
            }
            $this->attributes[$hL] = array();
            UE:
            $tx = Utilities::xpQuery($rf, "\56\x2f\163\x61\x6d\x6c\x5f\x61\x73\x73\145\x72\x74\x69\157\156\x3a\x41\x74\164\x72\x69\142\165\x74\145\x56\141\154\x75\145");
            foreach ($tx as $gI) {
                $this->attributes[$hL][] = trim($gI->textContent);
                vO:
            }
            RY:
            is:
        }
        Je:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($Ex)
    {
        $this->notBefore = $Ex;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($hM)
    {
        $this->notOnOrAfter = $hM;
    }
    public function setEncryptedAttributes($gt)
    {
        $this->requiredEncAttributes = $gt;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $Dy = NULL)
    {
        $this->validAudiences = $Dy;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($rx)
    {
        $this->authnInstant = $rx;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($OP)
    {
        $this->sessionNotOnOrAfter = $OP;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($V6)
    {
        $this->sessionIndex = $V6;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto j7;
        }
        return $this->authnContextClassRef;
        j7:
        if (empty($this->authnContextDeclRef)) {
            goto LQ;
        }
        return $this->authnContextDeclRef;
        LQ:
        return NULL;
    }
    public function setAuthnContext($Qe)
    {
        $this->setAuthnContextClassRef($Qe);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($Q8)
    {
        $this->authnContextClassRef = $Q8;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $L1)
    {
        if (empty($this->authnContextDeclRef)) {
            goto DM;
        }
        throw new Exception("\x41\x75\164\150\x6e\103\157\156\x74\x65\x78\164\x44\145\143\x6c\x52\145\x66\x20\x69\x73\40\x61\x6c\x72\x65\141\x64\171\40\x72\145\x67\x69\x73\x74\x65\x72\x65\x64\x21\x20\115\141\171\40\157\156\x6c\x79\40\150\x61\x76\x65\x20\x65\151\x74\x68\x65\162\40\141\x20\104\145\143\154\40\157\x72\40\141\x20\104\x65\143\154\x52\x65\x66\x2c\x20\x6e\157\x74\40\142\157\x74\x68\41");
        DM:
        $this->authnContextDecl = $L1;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($RJ)
    {
        if (empty($this->authnContextDecl)) {
            goto Wd;
        }
        throw new Exception("\101\x75\164\150\x6e\x43\x6f\156\x74\145\170\164\104\145\x63\x6c\40\x69\x73\40\141\154\x72\145\141\144\x79\x20\x72\145\147\151\x73\x74\145\162\145\144\41\x20\x4d\141\171\40\157\x6e\154\x79\40\150\x61\166\145\40\x65\151\x74\x68\x65\x72\40\x61\40\x44\x65\143\154\40\157\162\x20\141\x20\x44\145\143\x6c\122\x65\146\x2c\40\156\x6f\x74\40\x62\x6f\x74\150\x21");
        Wd:
        $this->authnContextDeclRef = $RJ;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($gJ)
    {
        $this->AuthenticatingAuthority = $gJ;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $km)
    {
        $this->attributes = $km;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($gP)
    {
        $this->nameFormat = $gP;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $G5)
    {
        $this->SubjectConfirmation = $G5;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $Fo = NULL)
    {
        $this->signatureKey = $Fo;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $Ms = NULL)
    {
        $this->encryptionKey = $Ms;
    }
    public function setCertificates(array $IU)
    {
        $this->certificates = $IU;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $Td = NULL)
    {
        if ($Td === NULL) {
            goto pe;
        }
        $l0 = $Td->ownerDocument;
        goto Jk;
        pe:
        $l0 = new DOMDocument();
        $Td = $l0;
        Jk:
        $nv = $l0->createElementNS("\165\162\x6e\72\157\141\x73\151\163\x3a\156\x61\x6d\x65\163\72\164\x63\72\x53\x41\115\114\x3a\x32\56\60\x3a\x61\x73\163\145\x72\x74\x69\157\156", "\163\x61\x6d\x6c\72" . "\x41\x73\163\x65\x72\x74\151\x6f\x6e");
        $Td->appendChild($nv);
        $nv->setAttributeNS("\x75\162\156\x3a\x6f\x61\x73\151\163\x3a\156\141\x6d\x65\x73\72\x74\x63\72\x53\101\115\x4c\72\x32\56\x30\x3a\160\x72\157\164\157\x63\157\x6c", "\163\141\155\154\x70\72\x74\155\160", "\x74\x6d\160");
        $nv->removeAttributeNS("\x75\162\x6e\72\157\x61\163\x69\163\72\x6e\141\x6d\145\163\x3a\x74\x63\72\123\101\x4d\114\72\x32\56\x30\72\x70\x72\157\x74\x6f\143\157\154", "\x74\155\x70");
        $nv->setAttributeNS("\150\x74\x74\x70\72\57\57\x77\167\167\x2e\x77\63\x2e\157\162\147\x2f\62\x30\60\x31\x2f\130\115\114\123\143\x68\x65\x6d\x61\55\x69\x6e\163\x74\141\156\x63\145", "\x78\163\x69\72\x74\155\x70", "\164\x6d\160");
        $nv->removeAttributeNS("\x68\x74\164\x70\72\57\x2f\167\167\x77\x2e\x77\x33\x2e\x6f\162\147\x2f\x32\60\x30\61\57\x58\115\x4c\123\x63\150\145\x6d\x61\x2d\151\x6e\163\164\x61\156\x63\145", "\x74\155\160");
        $nv->setAttributeNS("\150\x74\164\x70\72\57\x2f\167\x77\x77\56\167\63\x2e\157\x72\x67\57\62\x30\60\61\57\130\115\x4c\x53\x63\x68\145\155\141", "\170\163\x3a\x74\x6d\x70", "\x74\155\160");
        $nv->removeAttributeNS("\x68\164\164\160\72\57\x2f\x77\x77\167\56\167\x33\x2e\x6f\162\x67\x2f\x32\x30\x30\61\x2f\130\x4d\x4c\123\x63\x68\x65\155\141", "\x74\155\x70");
        $nv->setAttribute("\x49\x44", $this->id);
        $nv->setAttribute("\x56\x65\162\x73\x69\x6f\156", "\62\x2e\x30");
        $nv->setAttribute("\111\163\x73\165\x65\111\156\163\164\x61\x6e\164", gmdate("\x59\x2d\155\x2d\144\x5c\x54\110\72\x69\x3a\x73\x5c\132", $this->issueInstant));
        $PY = Utilities::addString($nv, "\165\162\x6e\72\157\x61\x73\151\163\x3a\156\141\x6d\x65\163\72\x74\143\72\x53\101\x4d\114\x3a\62\56\60\72\x61\163\x73\145\x72\164\151\157\156", "\x73\x61\155\154\72\x49\x73\x73\x75\145\x72", $this->issuer);
        $this->addSubject($nv);
        $this->addConditions($nv);
        $this->addAuthnStatement($nv);
        if ($this->requiredEncAttributes == FALSE) {
            goto lD;
        }
        $this->addEncryptedAttributeStatement($nv);
        goto wo;
        lD:
        $this->addAttributeStatement($nv);
        wo:
        if (!($this->signatureKey !== NULL)) {
            goto tS;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $nv, $PY->nextSibling);
        tS:
        return $nv;
    }
    private function addSubject(DOMElement $nv)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto rM;
        }
        return;
        rM:
        $l1 = $nv->ownerDocument->createElementNS("\165\x72\156\72\157\x61\x73\x69\x73\72\x6e\141\155\145\163\x3a\164\143\x3a\123\101\x4d\114\x3a\x32\56\60\x3a\x61\x73\163\145\x72\x74\151\x6f\156", "\163\x61\x6d\154\x3a\x53\x75\x62\152\145\x63\164");
        $nv->appendChild($l1);
        if ($this->encryptedNameId === NULL) {
            goto Jd;
        }
        $e3 = $l1->ownerDocument->createElementNS("\165\162\156\72\157\141\x73\x69\163\72\x6e\x61\155\x65\163\x3a\x74\x63\72\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\141\163\163\145\x72\x74\151\x6f\x6e", "\x73\141\x6d\154\x3a" . "\105\x6e\143\162\x79\x70\x74\x65\144\x49\x44");
        $l1->appendChild($e3);
        $e3->appendChild($l1->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto ju;
        Jd:
        Utilities::addNameId($l1, $this->nameId);
        ju:
        foreach ($this->SubjectConfirmation as $FC) {
            $FC->toXML($l1);
            ek:
        }
        ad:
    }
    private function addConditions(DOMElement $nv)
    {
        $l0 = $nv->ownerDocument;
        $cT = $l0->createElementNS("\x75\x72\156\x3a\x6f\141\x73\x69\163\72\156\x61\x6d\x65\163\72\164\x63\72\123\x41\115\x4c\72\x32\x2e\60\72\141\163\x73\145\x72\164\x69\157\x6e", "\163\141\155\154\x3a\x43\157\156\x64\x69\x74\151\x6f\x6e\x73");
        $nv->appendChild($cT);
        if (!($this->notBefore !== NULL)) {
            goto oJ;
        }
        $cT->setAttribute("\116\x6f\164\102\145\146\x6f\162\145", gmdate("\131\x2d\x6d\x2d\144\134\x54\x48\x3a\x69\x3a\x73\134\132", $this->notBefore));
        oJ:
        if (!($this->notOnOrAfter !== NULL)) {
            goto bL;
        }
        $cT->setAttribute("\x4e\157\x74\x4f\x6e\x4f\162\101\x66\164\145\162", gmdate("\x59\x2d\x6d\55\x64\x5c\124\110\72\151\72\x73\134\132", $this->notOnOrAfter));
        bL:
        if (!($this->validAudiences !== NULL)) {
            goto BZ;
        }
        $Z3 = $l0->createElementNS("\165\162\156\x3a\157\141\163\151\163\72\x6e\141\x6d\145\163\72\164\143\x3a\x53\101\x4d\114\x3a\62\x2e\60\72\x61\163\163\145\162\164\x69\157\156", "\163\141\155\x6c\72\x41\165\144\151\x65\156\x63\145\x52\145\163\x74\x72\151\143\x74\x69\157\x6e");
        $cT->appendChild($Z3);
        Utilities::addStrings($Z3, "\165\x72\156\x3a\x6f\141\x73\151\x73\x3a\x6e\x61\x6d\x65\163\x3a\x74\x63\x3a\x53\x41\115\114\x3a\x32\x2e\x30\72\x61\x73\x73\x65\162\x74\x69\157\x6e", "\163\x61\x6d\x6c\72\x41\165\144\151\145\156\143\145", FALSE, $this->validAudiences);
        BZ:
    }
    private function addAuthnStatement(DOMElement $nv)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto Z_;
        }
        return;
        Z_:
        $l0 = $nv->ownerDocument;
        $Fi = $l0->createElementNS("\x75\x72\156\72\x6f\141\163\x69\163\72\156\141\155\145\163\x3a\164\143\72\123\x41\x4d\x4c\72\x32\56\60\72\x61\163\x73\x65\x72\164\151\x6f\x6e", "\163\x61\x6d\x6c\x3a\101\165\x74\x68\x6e\x53\164\141\x74\145\x6d\x65\x6e\164");
        $nv->appendChild($Fi);
        $Fi->setAttribute("\x41\x75\164\x68\x6e\111\x6e\163\164\141\156\x74", gmdate("\131\55\155\x2d\144\134\124\110\x3a\x69\x3a\x73\x5c\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto eN;
        }
        $Fi->setAttribute("\x53\145\163\163\151\x6f\156\x4e\157\164\117\x6e\x4f\162\101\x66\x74\x65\x72", gmdate("\131\55\x6d\x2d\x64\x5c\x54\x48\x3a\x69\x3a\163\x5c\132", $this->sessionNotOnOrAfter));
        eN:
        if (!($this->sessionIndex !== NULL)) {
            goto E3;
        }
        $Fi->setAttribute("\x53\145\x73\x73\151\157\x6e\111\156\144\x65\x78", $this->sessionIndex);
        E3:
        $yN = $l0->createElementNS("\x75\x72\x6e\72\x6f\x61\163\151\x73\72\x6e\x61\155\145\x73\x3a\x74\143\x3a\123\x41\115\x4c\72\62\x2e\60\x3a\141\163\x73\x65\162\x74\x69\157\x6e", "\163\x61\x6d\x6c\72\101\165\164\150\156\x43\157\x6e\164\145\x78\x74");
        $Fi->appendChild($yN);
        if (empty($this->authnContextClassRef)) {
            goto KL;
        }
        Utilities::addString($yN, "\x75\162\x6e\x3a\157\x61\x73\151\x73\72\156\141\x6d\x65\163\x3a\x74\x63\x3a\x53\101\x4d\x4c\72\62\x2e\x30\x3a\x61\x73\x73\x65\x72\164\151\x6f\x6e", "\x73\x61\x6d\x6c\x3a\101\165\x74\x68\x6e\103\157\156\x74\145\x78\164\x43\154\x61\163\x73\x52\x65\146", $this->authnContextClassRef);
        KL:
        if (empty($this->authnContextDecl)) {
            goto dw;
        }
        $this->authnContextDecl->toXML($yN);
        dw:
        if (empty($this->authnContextDeclRef)) {
            goto Cw;
        }
        Utilities::addString($yN, "\x75\162\156\x3a\157\141\163\151\163\x3a\156\141\x6d\x65\x73\72\164\143\72\x53\101\115\x4c\72\x32\56\x30\72\x61\x73\163\x65\162\x74\151\x6f\156", "\163\141\x6d\154\72\x41\165\164\x68\156\x43\x6f\x6e\164\145\170\x74\x44\145\x63\154\x52\x65\x66", $this->authnContextDeclRef);
        Cw:
        Utilities::addStrings($yN, "\165\162\156\72\157\x61\x73\x69\163\x3a\x6e\141\x6d\145\163\x3a\164\x63\x3a\x53\x41\x4d\x4c\72\62\x2e\x30\x3a\x61\x73\x73\145\162\164\x69\157\156", "\x73\141\x6d\x6c\72\x41\165\x74\x68\145\156\x74\x69\143\141\164\x69\x6e\x67\101\x75\x74\150\x6f\162\x69\164\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $nv)
    {
        if (!empty($this->attributes)) {
            goto Xy;
        }
        return;
        Xy:
        $l0 = $nv->ownerDocument;
        $jL = $l0->createElementNS("\165\162\x6e\72\157\141\163\x69\x73\x3a\x6e\141\x6d\145\x73\x3a\164\x63\72\123\101\115\x4c\72\62\56\x30\x3a\x61\x73\163\x65\x72\x74\151\x6f\156", "\163\141\155\x6c\72\x41\164\x74\x72\151\x62\x75\x74\145\123\x74\141\164\145\155\145\156\x74");
        $nv->appendChild($jL);
        foreach ($this->attributes as $hL => $tx) {
            $rf = $l0->createElementNS("\165\162\156\x3a\x6f\x61\163\151\x73\x3a\156\141\x6d\145\x73\x3a\164\143\72\x53\101\x4d\114\72\62\56\x30\x3a\x61\163\163\145\x72\164\151\157\156", "\163\x61\x6d\x6c\x3a\x41\x74\164\x72\151\x62\165\164\145");
            $jL->appendChild($rf);
            $rf->setAttribute("\116\x61\x6d\145", $hL);
            if (!($this->nameFormat !== "\x75\162\x6e\72\x6f\x61\x73\x69\163\72\x6e\x61\x6d\x65\163\x3a\164\x63\x3a\123\101\115\x4c\x3a\x32\56\60\72\141\x74\x74\x72\156\x61\x6d\x65\55\x66\x6f\x72\x6d\x61\164\72\x75\156\x73\160\145\x63\x69\x66\151\145\x64")) {
                goto Tu;
            }
            $rf->setAttribute("\x4e\141\x6d\x65\106\x6f\162\155\x61\x74", $this->nameFormat);
            Tu:
            foreach ($tx as $gI) {
                if (is_string($gI)) {
                    goto ku;
                }
                if (is_int($gI)) {
                    goto Ja;
                }
                $NS = NULL;
                goto bR;
                ku:
                $NS = "\x78\x73\x3a\163\164\162\151\156\147";
                goto bR;
                Ja:
                $NS = "\x78\x73\72\151\x6e\x74\145\x67\145\162";
                bR:
                $Tf = $l0->createElementNS("\x75\162\x6e\x3a\x6f\x61\163\151\x73\x3a\x6e\x61\x6d\145\x73\x3a\164\x63\x3a\123\x41\115\x4c\x3a\62\x2e\x30\x3a\x61\x73\163\x65\162\164\151\x6f\x6e", "\163\x61\x6d\154\72\101\x74\x74\x72\151\x62\165\x74\145\126\141\x6c\165\x65");
                $rf->appendChild($Tf);
                if (!($NS !== NULL)) {
                    goto Tz;
                }
                $Tf->setAttributeNS("\x68\164\x74\160\72\x2f\x2f\167\x77\167\x2e\x77\x33\56\157\162\147\57\x32\x30\60\x31\x2f\130\x4d\114\123\143\x68\x65\x6d\x61\x2d\151\156\x73\x74\x61\x6e\x63\x65", "\170\x73\x69\72\164\x79\x70\x65", $NS);
                Tz:
                if (!is_null($gI)) {
                    goto Il;
                }
                $Tf->setAttributeNS("\150\164\x74\160\x3a\x2f\57\x77\167\167\x2e\x77\63\x2e\157\162\147\x2f\62\x30\60\x31\57\130\115\114\x53\143\x68\145\x6d\x61\x2d\x69\156\x73\164\x61\x6e\143\145", "\170\x73\151\x3a\156\x69\x6c", "\x74\x72\165\x65");
                Il:
                if ($gI instanceof DOMNodeList) {
                    goto N9;
                }
                $Tf->appendChild($l0->createTextNode($gI));
                goto MC;
                N9:
                $q2 = 0;
                wm:
                if (!($q2 < $gI->length)) {
                    goto Lz;
                }
                $oB = $l0->importNode($gI->item($q2), TRUE);
                $Tf->appendChild($oB);
                oS:
                $q2++;
                goto wm;
                Lz:
                MC:
                vf:
            }
            XM:
            XS:
        }
        FD:
    }
    private function addEncryptedAttributeStatement(DOMElement $nv)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto KT;
        }
        return;
        KT:
        $l0 = $nv->ownerDocument;
        $jL = $l0->createElementNS("\165\162\x6e\72\x6f\x61\163\151\163\x3a\x6e\141\x6d\x65\163\x3a\x74\x63\72\x53\101\x4d\x4c\72\62\56\60\72\141\x73\x73\145\162\x74\151\x6f\x6e", "\163\141\x6d\x6c\72\x41\x74\164\162\x69\142\165\164\145\123\164\x61\164\x65\x6d\x65\x6e\164");
        $nv->appendChild($jL);
        foreach ($this->attributes as $hL => $tx) {
            $PB = new DOMDocument();
            $rf = $PB->createElementNS("\165\162\156\x3a\157\x61\x73\151\x73\x3a\156\x61\155\x65\x73\72\164\x63\72\x53\x41\115\114\x3a\x32\56\x30\x3a\x61\163\x73\145\162\x74\151\157\156", "\163\x61\155\154\x3a\101\x74\164\162\x69\x62\165\164\x65");
            $rf->setAttribute("\x4e\141\155\x65", $hL);
            $PB->appendChild($rf);
            if (!($this->nameFormat !== "\165\162\x6e\x3a\x6f\141\163\x69\x73\72\156\141\155\145\163\72\x74\143\72\123\101\115\x4c\x3a\62\x2e\x30\x3a\141\164\x74\x72\x6e\x61\x6d\x65\x2d\146\x6f\x72\x6d\x61\x74\x3a\x75\156\x73\x70\x65\x63\x69\146\151\x65\x64")) {
                goto gW;
            }
            $rf->setAttribute("\116\141\x6d\145\x46\157\162\155\x61\x74", $this->nameFormat);
            gW:
            foreach ($tx as $gI) {
                if (is_string($gI)) {
                    goto QJ;
                }
                if (is_int($gI)) {
                    goto QU;
                }
                $NS = NULL;
                goto wI;
                QJ:
                $NS = "\170\x73\x3a\163\x74\162\151\x6e\147";
                goto wI;
                QU:
                $NS = "\x78\163\x3a\151\x6e\x74\x65\147\145\162";
                wI:
                $Tf = $PB->createElementNS("\165\162\156\72\157\141\x73\x69\x73\72\156\x61\x6d\145\163\72\164\x63\x3a\x53\x41\x4d\114\x3a\x32\x2e\x30\72\141\x73\x73\145\162\x74\151\x6f\x6e", "\x73\141\155\x6c\72\101\164\x74\x72\x69\x62\x75\164\145\126\141\x6c\x75\145");
                $rf->appendChild($Tf);
                if (!($NS !== NULL)) {
                    goto Nw;
                }
                $Tf->setAttributeNS("\150\x74\x74\x70\72\57\57\167\167\x77\x2e\167\63\56\157\x72\x67\57\62\x30\60\x31\57\x58\x4d\114\x53\x63\x68\x65\x6d\141\x2d\x69\x6e\163\x74\141\156\x63\145", "\170\x73\x69\72\x74\x79\x70\x65", $NS);
                Nw:
                if ($gI instanceof DOMNodeList) {
                    goto j5;
                }
                $Tf->appendChild($PB->createTextNode($gI));
                goto UG;
                j5:
                $q2 = 0;
                AC:
                if (!($q2 < $gI->length)) {
                    goto Zu;
                }
                $oB = $PB->importNode($gI->item($q2), TRUE);
                $Tf->appendChild($oB);
                Fq:
                $q2++;
                goto AC;
                Zu:
                UG:
                dl:
            }
            jc:
            $Bw = new XMLSecEnc();
            $Bw->setNode($PB->documentElement);
            $Bw->type = "\150\x74\x74\160\x3a\57\x2f\x77\x77\x77\x2e\167\x33\x2e\x6f\162\x67\x2f\62\x30\x30\x31\x2f\x30\64\x2f\170\x6d\154\x65\x6e\143\x23\105\154\x65\155\145\x6e\164";
            $HH = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $HH->generateSessionKey();
            $Bw->encryptKey($this->encryptionKey, $HH);
            $Vb = $Bw->encryptNode($HH);
            $qC = $l0->createElementNS("\x75\x72\x6e\x3a\157\141\x73\x69\x73\72\x6e\x61\155\x65\x73\x3a\164\x63\x3a\x53\101\x4d\x4c\72\62\56\x30\72\x61\163\163\145\x72\164\x69\157\x6e", "\163\141\x6d\154\72\105\156\143\x72\x79\x70\164\x65\144\101\x74\164\162\x69\x62\x75\x74\145");
            $jL->appendChild($qC);
            $Ke = $l0->importNode($Vb, TRUE);
            $qC->appendChild($Ke);
            bf:
        }
        wB:
    }
}
