<?php


include_once "\125\x74\151\154\x69\x74\x69\145\163\x2e\x70\150\160";
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
    public function __construct(DOMElement $Tr = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\x72\x6e\72\157\141\x73\151\163\x3a\x6e\x61\x6d\145\x73\x3a\164\143\72\123\101\115\114\x3a\x31\x2e\x31\x3a\156\x61\155\145\x69\144\x2d\x66\x6f\162\155\x61\x74\72\x75\156\x73\x70\x65\143\x69\x66\x69\x65\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($Tr === NULL)) {
            goto BB;
        }
        return;
        BB:
        if (!($Tr->localName === "\105\x6e\143\162\x79\x70\164\x65\144\x41\x73\163\145\x72\164\151\157\156")) {
            goto YL;
        }
        $TG = Utilities::xpQuery($Tr, "\x2e\x2f\x78\x65\x6e\x63\72\105\x6e\x63\x72\171\x70\x74\145\x64\104\141\x74\141");
        $uA = Utilities::xpQuery($Tr, "\x2e\57\x78\x65\156\143\x3a\105\x6e\x63\162\171\160\x74\145\x64\104\x61\164\x61\x2f\x64\163\72\113\x65\171\x49\156\x66\157\57\170\145\156\143\x3a\105\x6e\x63\162\171\160\x74\x65\144\113\x65\171");
        $Ub = '';
        if (empty($uA)) {
            goto ed;
        }
        $Ub = $uA[0]->firstChild->getAttribute("\x41\x6c\147\157\x72\x69\164\150\x6d");
        goto ce;
        ed:
        $uA = Utilities::xpQuery($Tr, "\56\x2f\x78\x65\x6e\143\72\105\x6e\143\x72\x79\160\x74\145\x64\x4b\145\171\x2f\170\x65\x6e\x63\x3a\105\156\143\162\x79\160\x74\151\157\x6e\115\x65\164\x68\x6f\144");
        $Ub = $uA[0]->getAttribute("\101\x6c\x67\157\162\x69\164\x68\155");
        ce:
        $Li = Utilities::getEncryptionAlgorithm($Ub);
        if (count($TG) === 0) {
            goto kH;
        }
        if (count($TG) > 1) {
            goto f5;
        }
        goto rq;
        kH:
        throw new Exception("\x4d\151\163\163\151\156\x67\x20\x65\156\x63\162\x79\x70\164\145\144\x20\x64\141\x74\x61\40\x69\156\40\74\x73\x61\x6d\x6c\72\x45\x6e\143\x72\171\160\x74\x65\144\101\163\163\x65\x72\164\151\x6f\156\x3e\x2e");
        goto rq;
        f5:
        throw new Exception("\115\157\x72\x65\x20\164\150\141\x6e\40\x6f\x6e\x65\40\145\156\143\162\171\x70\164\145\144\40\x64\x61\164\141\x20\145\x6c\145\x6d\145\156\x74\x20\151\x6e\x20\x3c\x73\x61\x6d\154\72\105\156\x63\x72\171\160\164\x65\x64\101\163\x73\x65\x72\164\x69\x6f\156\76\56");
        rq:
        $QP = '';
        $QP = variable_get("\155\151\x6e\x69\x6f\x72\x61\156\147\145\x5f\x73\141\155\154\137\x70\162\151\x76\x61\164\145\137\x63\145\162\x74\x69\x66\x69\x63\x61\164\x65");
        $aC = new XMLSecurityKey($Li, array("\164\171\160\x65" => "\160\162\x69\166\141\x74\x65"));
        $RO = drupal_get_path("\155\x6f\144\x75\154\145", "\x6d\151\156\x69\x6f\x72\141\156\x67\x65\x5f\x73\x61\x6d\x6c");
        if ($QP != '') {
            goto dR;
        }
        $P4 = $RO . "\57\162\145\163\x6f\165\x72\x63\x65\x73\x2f\163\160\55\x6b\145\171\56\153\145\x79";
        goto P5;
        dR:
        $P4 = $RO . "\x2f\162\145\x73\157\165\x72\x63\x65\163\x2f\103\165\163\x74\157\x6d\x5f\120\x72\x69\166\x61\164\145\x5f\x43\145\x72\164\151\146\151\143\141\164\x65\56\153\x65\171";
        P5:
        $aC->loadKey($P4, TRUE);
        $wH = new XMLSecurityKey($Li, array("\164\x79\x70\145" => "\160\x72\151\x76\x61\x74\x65"));
        $Ig = $RO . "\57\x72\x65\163\x6f\165\x72\x63\x65\x73\57\x6d\x69\156\x69\157\162\x61\x6e\147\145\137\163\160\x5f\x70\162\151\166\x5f\x6b\x65\x79\x2e\153\x65\x79";
        $wH->loadKey($Ig, TRUE);
        $HS = array();
        $Tr = Utilities::decryptElement($TG[0], $aC, $HS, $wH);
        YL:
        if ($Tr->hasAttribute("\111\104")) {
            goto rv;
        }
        throw new Exception("\115\151\x73\x73\x69\156\x67\40\x49\x44\x20\x61\x74\x74\x72\x69\142\x75\x74\145\40\x6f\156\x20\x53\x41\115\114\40\x61\x73\x73\145\162\164\x69\157\156\x2e");
        rv:
        $this->id = $Tr->getAttribute("\111\104");
        if (!($Tr->getAttribute("\126\145\162\x73\x69\x6f\x6e") !== "\62\56\x30")) {
            goto AM;
        }
        throw new Exception("\125\156\x73\x75\160\x70\x6f\162\x74\x65\144\40\166\145\x72\163\x69\x6f\156\x3a\x20" . $Tr->getAttribute("\126\x65\162\163\151\x6f\x6e"));
        AM:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($Tr->getAttribute("\x49\163\163\165\x65\x49\156\163\x74\141\156\x74"));
        $xx = Utilities::xpQuery($Tr, "\x2e\x2f\x73\x61\155\154\137\141\x73\163\x65\162\164\151\x6f\x6e\72\x49\163\163\x75\145\x72");
        if (!empty($xx)) {
            goto Y5;
        }
        throw new Exception("\x4d\x69\163\163\x69\x6e\147\x20\74\163\x61\x6d\x6c\x3a\x49\163\x73\165\x65\x72\76\x20\x69\156\40\x61\x73\x73\x65\162\x74\x69\x6f\x6e\x2e");
        Y5:
        $this->issuer = trim($xx[0]->textContent);
        $this->parseConditions($Tr);
        $this->parseAuthnStatement($Tr);
        $this->parseAttributes($Tr);
        $this->parseEncryptedAttributes($Tr);
        $this->parseSignature($Tr);
        $this->parseSubject($Tr);
    }
    private function parseSubject(DOMElement $Tr)
    {
        $Av = Utilities::xpQuery($Tr, "\56\x2f\x73\x61\155\154\x5f\141\163\x73\x65\x72\164\x69\x6f\x6e\72\x53\x75\142\152\145\143\x74");
        if (empty($Av)) {
            goto uG;
        }
        if (count($Av) > 1) {
            goto o1;
        }
        goto kj;
        uG:
        return;
        goto kj;
        o1:
        throw new Exception("\x4d\x6f\x72\145\40\x74\x68\x61\156\40\x6f\156\145\x20\74\x73\141\x6d\x6c\72\x53\165\142\x6a\x65\x63\x74\x3e\40\151\156\40\x3c\x73\x61\155\154\72\101\x73\163\145\162\x74\151\157\x6e\x3e\x2e");
        kj:
        $Av = $Av[0];
        $jE = Utilities::xpQuery($Av, "\x2e\57\163\x61\155\154\x5f\x61\163\163\x65\162\x74\151\157\156\x3a\x4e\x61\155\x65\x49\104\x20\x7c\40\56\x2f\x73\x61\155\x6c\x5f\141\163\x73\145\x72\164\x69\157\x6e\72\105\x6e\143\162\x79\x70\x74\x65\144\x49\104\57\170\145\x6e\x63\72\x45\x6e\143\162\171\160\x74\145\144\104\141\x74\141");
        if (empty($jE)) {
            goto ue;
        }
        if (count($jE) > 1) {
            goto s4;
        }
        goto Ux;
        ue:
        throw new Exception("\115\151\x73\163\x69\156\147\40\74\163\x61\x6d\154\x3a\116\x61\155\x65\111\x44\x3e\x20\157\162\40\74\163\x61\155\x6c\72\105\x6e\143\x72\171\x70\x74\x65\144\111\104\x3e\x20\151\156\x20\x3c\163\x61\x6d\x6c\x3a\x53\x75\142\152\145\143\x74\x3e\x2e");
        goto Ux;
        s4:
        throw new Exception("\115\x6f\x72\x65\x20\x74\150\141\156\40\157\x6e\145\40\74\163\141\x6d\154\72\x4e\141\x6d\x65\111\104\x3e\x20\157\162\40\x3c\163\x61\x6d\154\72\x45\156\x63\162\x79\160\x74\x65\144\x44\x3e\x20\151\156\x20\74\163\x61\x6d\x6c\x3a\123\x75\142\152\x65\143\x74\x3e\56");
        Ux:
        $jE = $jE[0];
        if ($jE->localName === "\105\x6e\x63\162\171\x70\164\x65\x64\x44\141\164\141") {
            goto x0;
        }
        $this->nameId = Utilities::parseNameId($jE);
        goto Gt;
        x0:
        $this->encryptedNameId = $jE;
        Gt:
    }
    private function parseConditions(DOMElement $Tr)
    {
        $b2 = Utilities::xpQuery($Tr, "\x2e\57\163\x61\155\154\137\141\163\x73\x65\x72\x74\151\x6f\156\x3a\103\x6f\156\144\x69\x74\x69\157\x6e\x73");
        if (empty($b2)) {
            goto Wz;
        }
        if (count($b2) > 1) {
            goto RX;
        }
        goto BL;
        Wz:
        return;
        goto BL;
        RX:
        throw new Exception("\115\x6f\x72\x65\x20\164\150\141\156\x20\157\156\145\x20\74\163\141\x6d\x6c\72\x43\x6f\156\144\151\x74\151\157\156\163\76\x20\151\x6e\40\x3c\163\141\155\154\x3a\101\x73\x73\x65\x72\x74\x69\x6f\x6e\76\x2e");
        BL:
        $b2 = $b2[0];
        if (!$b2->hasAttribute("\116\x6f\164\102\x65\x66\157\x72\x65")) {
            goto BO;
        }
        $Ex = Utilities::xsDateTimeToTimestamp($b2->getAttribute("\x4e\x6f\x74\102\145\x66\x6f\162\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $Ex)) {
            goto sy;
        }
        $this->notBefore = $Ex;
        sy:
        BO:
        if (!$b2->hasAttribute("\116\157\x74\x4f\x6e\117\x72\x41\x66\164\x65\162")) {
            goto gO;
        }
        $AO = Utilities::xsDateTimeToTimestamp($b2->getAttribute("\x4e\x6f\x74\x4f\x6e\x4f\x72\x41\146\x74\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $AO)) {
            goto mc;
        }
        $this->notOnOrAfter = $AO;
        mc:
        gO:
        $y2 = $b2->firstChild;
        HH:
        if (!($y2 !== NULL)) {
            goto Xi;
        }
        if (!$y2 instanceof DOMText) {
            goto Iu;
        }
        goto HA;
        Iu:
        if (!($y2->namespaceURI !== "\x75\162\x6e\x3a\x6f\141\163\x69\x73\x3a\x6e\x61\x6d\x65\x73\x3a\x74\143\72\x53\101\115\114\x3a\62\x2e\x30\72\x61\x73\163\145\162\x74\x69\157\156")) {
            goto NU;
        }
        throw new Exception("\125\x6e\x6b\156\157\x77\156\x20\x6e\141\155\x65\163\x70\x61\143\145\40\x6f\x66\x20\143\x6f\156\144\151\x74\151\157\x6e\x3a\40" . var_export($y2->namespaceURI, TRUE));
        NU:
        switch ($y2->localName) {
            case "\x41\165\x64\x69\x65\156\x63\x65\122\145\163\x74\162\x69\x63\x74\x69\x6f\156":
                $O3 = Utilities::extractStrings($y2, "\165\x72\x6e\72\x6f\141\x73\x69\x73\72\156\x61\x6d\145\163\x3a\x74\x63\72\x53\101\115\114\72\x32\56\60\x3a\x61\163\x73\145\162\164\x69\x6f\x6e", "\x41\165\144\x69\x65\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto Wn;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $O3);
                goto l3;
                Wn:
                $this->validAudiences = $O3;
                l3:
                goto kK;
            case "\117\156\x65\124\151\155\x65\125\163\x65":
                goto kK;
            case "\120\x72\x6f\x78\171\x52\x65\x73\164\162\151\143\164\x69\x6f\x6e":
                goto kK;
            default:
                throw new Exception("\x55\156\x6b\x6e\x6f\x77\x6e\x20\143\x6f\156\x64\151\x74\151\157\x6e\72\40" . var_export($y2->localName, TRUE));
        }
        Da:
        kK:
        HA:
        $y2 = $y2->nextSibling;
        goto HH;
        Xi:
    }
    private function parseAuthnStatement(DOMElement $Tr)
    {
        $uk = Utilities::xpQuery($Tr, "\x2e\x2f\x73\141\155\154\137\x61\x73\163\145\x72\164\151\157\x6e\x3a\x41\165\x74\x68\x6e\x53\x74\141\x74\x65\155\x65\156\x74");
        if (empty($uk)) {
            goto t2;
        }
        if (count($uk) > 1) {
            goto wF;
        }
        goto A5;
        t2:
        $this->authnInstant = NULL;
        return;
        goto A5;
        wF:
        throw new Exception("\115\157\162\145\40\164\x68\141\x74\x20\157\x6e\x65\40\74\163\x61\x6d\x6c\72\x41\165\x74\150\156\x53\164\141\x74\145\x6d\x65\x6e\164\x3e\x20\x69\156\40\x3c\x73\141\155\x6c\72\101\x73\163\x65\162\x74\x69\157\x6e\76\40\x6e\x6f\164\x20\x73\x75\x70\x70\157\x72\x74\145\x64\56");
        A5:
        $Mj = $uk[0];
        if ($Mj->hasAttribute("\x41\165\x74\x68\x6e\111\x6e\x73\164\x61\156\164")) {
            goto j7;
        }
        throw new Exception("\x4d\x69\x73\163\151\x6e\147\x20\x72\145\x71\x75\x69\x72\145\x64\x20\101\x75\164\x68\x6e\111\x6e\x73\164\x61\156\x74\40\x61\x74\164\x72\151\x62\x75\164\x65\40\x6f\x6e\40\74\x73\141\155\x6c\x3a\x41\165\164\x68\x6e\123\x74\x61\164\x65\x6d\145\156\x74\76\x2e");
        j7:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($Mj->getAttribute("\x41\165\x74\x68\x6e\111\156\163\x74\141\156\164"));
        if (!$Mj->hasAttribute("\x53\x65\163\163\x69\157\x6e\x4e\157\164\x4f\156\117\x72\x41\146\164\x65\162")) {
            goto Zu;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($Mj->getAttribute("\123\x65\163\x73\x69\157\x6e\x4e\x6f\164\x4f\156\x4f\x72\x41\x66\164\145\x72"));
        Zu:
        if (!$Mj->hasAttribute("\x53\x65\x73\163\151\x6f\156\111\156\x64\145\170")) {
            goto wD;
        }
        $this->sessionIndex = $Mj->getAttribute("\x53\145\x73\x73\151\x6f\156\111\156\144\x65\170");
        wD:
        $this->parseAuthnContext($Mj);
    }
    private function parseAuthnContext(DOMElement $og)
    {
        $IS = Utilities::xpQuery($og, "\x2e\57\x73\141\x6d\154\137\141\x73\163\x65\162\164\x69\x6f\x6e\72\101\x75\x74\x68\x6e\x43\x6f\x6e\164\x65\x78\164");
        if (count($IS) > 1) {
            goto Jx;
        }
        if (empty($IS)) {
            goto qW;
        }
        goto zU;
        Jx:
        throw new Exception("\115\157\x72\x65\x20\x74\x68\x61\x6e\40\x6f\x6e\145\x20\74\x73\x61\x6d\154\x3a\x41\165\x74\x68\156\x43\x6f\156\164\145\x78\164\76\x20\151\156\x20\74\163\x61\155\x6c\72\101\165\164\150\156\123\164\141\x74\145\155\x65\156\164\76\x2e");
        goto zU;
        qW:
        throw new Exception("\x4d\x69\x73\163\x69\x6e\147\40\x72\145\x71\x75\x69\x72\x65\144\40\x3c\163\141\155\154\72\x41\165\x74\150\156\x43\x6f\x6e\164\145\170\164\x3e\x20\x69\x6e\x20\x3c\x73\x61\155\x6c\72\x41\x75\x74\150\x6e\x53\164\x61\164\x65\155\x65\156\x74\76\56");
        zU:
        $f9 = $IS[0];
        $A7 = Utilities::xpQuery($f9, "\56\x2f\x73\x61\155\154\137\141\163\163\145\162\164\151\x6f\x6e\72\x41\165\x74\150\x6e\103\157\156\164\145\x78\x74\x44\145\x63\154\x52\x65\146");
        if (count($A7) > 1) {
            goto nP;
        }
        if (count($A7) === 1) {
            goto dg;
        }
        goto fq;
        nP:
        throw new Exception("\115\x6f\162\x65\x20\164\x68\x61\x6e\40\x6f\x6e\x65\40\x3c\x73\x61\155\154\x3a\101\x75\x74\x68\156\x43\157\x6e\164\x65\x78\164\x44\145\143\154\x52\x65\146\x3e\x20\146\157\x75\156\144\77");
        goto fq;
        dg:
        $this->setAuthnContextDeclRef(trim($A7[0]->textContent));
        fq:
        $m0 = Utilities::xpQuery($f9, "\56\x2f\163\x61\155\x6c\137\x61\163\163\145\162\164\x69\157\x6e\72\101\165\x74\x68\156\x43\x6f\156\x74\145\170\164\104\x65\x63\x6c");
        if (count($m0) > 1) {
            goto e2;
        }
        if (count($m0) === 1) {
            goto TE;
        }
        goto gM;
        e2:
        throw new Exception("\115\157\162\x65\40\164\150\x61\156\40\157\x6e\x65\40\74\x73\x61\x6d\x6c\x3a\x41\165\164\150\x6e\103\157\156\x74\x65\x78\164\x44\x65\x63\x6c\x3e\x20\x66\x6f\x75\156\144\77");
        goto gM;
        TE:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($m0[0]));
        gM:
        $Jy = Utilities::xpQuery($f9, "\56\x2f\x73\141\x6d\154\137\x61\163\163\x65\162\x74\151\x6f\x6e\72\x41\x75\x74\150\x6e\103\x6f\x6e\x74\x65\170\x74\x43\154\x61\x73\163\x52\145\146");
        if (count($Jy) > 1) {
            goto jB;
        }
        if (count($Jy) === 1) {
            goto nh;
        }
        goto TW;
        jB:
        throw new Exception("\x4d\x6f\162\145\40\164\x68\141\x6e\x20\x6f\156\x65\40\x3c\x73\141\155\x6c\x3a\x41\x75\x74\x68\156\x43\157\156\x74\145\x78\x74\103\x6c\141\x73\x73\122\x65\x66\76\x20\151\x6e\x20\74\x73\141\155\154\72\101\165\164\x68\156\x43\157\x6e\x74\145\x78\164\76\56");
        goto TW;
        nh:
        $this->setAuthnContextClassRef(trim($Jy[0]->textContent));
        TW:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto Lb;
        }
        throw new Exception("\115\151\163\163\151\156\x67\x20\145\151\164\x68\x65\162\x20\74\163\141\155\154\72\101\x75\x74\150\x6e\103\x6f\156\x74\145\x78\x74\103\x6c\x61\x73\x73\x52\145\x66\x3e\x20\157\162\40\x3c\x73\141\x6d\x6c\72\x41\165\x74\x68\x6e\103\157\x6e\164\x65\170\x74\104\145\x63\154\x52\x65\146\76\x20\x6f\162\x20\x3c\x73\141\155\x6c\x3a\x41\165\164\x68\x6e\x43\157\x6e\x74\x65\170\164\x44\x65\x63\154\76");
        Lb:
        $this->AuthenticatingAuthority = Utilities::extractStrings($f9, "\x75\162\x6e\72\157\x61\163\x69\163\72\x6e\x61\x6d\145\163\72\x74\143\72\123\101\x4d\114\x3a\x32\56\60\x3a\141\163\x73\145\x72\x74\151\x6f\156", "\x41\x75\x74\x68\145\x6e\164\151\143\x61\164\x69\x6e\147\101\165\x74\x68\x6f\162\151\x74\171");
    }
    private function parseAttributes(DOMElement $Tr)
    {
        $XF = TRUE;
        $At = Utilities::xpQuery($Tr, "\x2e\x2f\x73\141\x6d\154\x5f\141\163\x73\x65\x72\x74\x69\157\x6e\x3a\101\x74\164\x72\151\142\x75\164\x65\123\164\x61\x74\x65\x6d\x65\x6e\164\x2f\163\x61\x6d\154\x5f\141\163\x73\145\162\164\151\157\156\x3a\x41\164\164\162\151\142\x75\x74\145");
        foreach ($At as $BW) {
            if ($BW->hasAttribute("\x4e\141\x6d\x65")) {
                goto fT;
            }
            throw new Exception("\115\x69\x73\x73\x69\156\x67\x20\x6e\141\155\x65\x20\157\156\x20\74\163\x61\155\154\72\101\164\164\x72\151\142\165\164\145\x3e\x20\x65\x6c\145\155\145\x6e\x74\56");
            fT:
            $nP = $BW->getAttribute("\116\x61\155\x65");
            if ($BW->hasAttribute("\x4e\x61\155\x65\x46\x6f\x72\155\x61\164")) {
                goto kB;
            }
            $t4 = "\165\162\x6e\x3a\x6f\x61\163\x69\x73\72\156\x61\155\x65\163\x3a\164\x63\x3a\x53\101\x4d\114\72\61\x2e\x31\72\x6e\141\155\x65\x69\144\55\x66\x6f\162\x6d\141\x74\x3a\x75\x6e\x73\160\x65\x63\x69\x66\151\145\x64";
            goto TK;
            kB:
            $t4 = $BW->getAttribute("\x4e\x61\155\x65\106\x6f\162\155\141\164");
            TK:
            if ($XF) {
                goto Hu;
            }
            if (!($this->nameFormat !== $t4)) {
                goto St;
            }
            $this->nameFormat = "\165\x72\x6e\x3a\157\x61\x73\x69\163\x3a\156\x61\155\145\163\x3a\164\x63\x3a\123\x41\115\x4c\x3a\61\x2e\x31\72\x6e\x61\x6d\145\151\144\x2d\x66\157\x72\x6d\x61\164\72\165\x6e\x73\x70\x65\143\151\146\x69\x65\x64";
            St:
            goto cM;
            Hu:
            $this->nameFormat = $t4;
            $XF = FALSE;
            cM:
            if (array_key_exists($nP, $this->attributes)) {
                goto t8;
            }
            $this->attributes[$nP] = array();
            t8:
            $JB = Utilities::xpQuery($BW, "\x2e\x2f\x73\141\155\x6c\x5f\x61\163\163\145\162\164\x69\x6f\156\x3a\101\x74\164\162\151\142\165\x74\x65\x56\141\x6c\165\x65");
            foreach ($JB as $uo) {
                $this->attributes[$nP][] = trim($uo->textContent);
                oy:
            }
            Mf:
            VO:
        }
        QO:
    }
    private function parseEncryptedAttributes(DOMElement $Tr)
    {
        $this->encryptedAttribute = Utilities::xpQuery($Tr, "\56\57\x73\x61\155\x6c\137\x61\x73\163\145\x72\164\151\x6f\156\72\101\164\164\162\x69\142\165\x74\x65\123\x74\x61\x74\145\x6d\x65\x6e\x74\x2f\163\x61\x6d\154\137\141\x73\x73\x65\162\x74\151\157\x6e\x3a\105\x6e\x63\162\171\160\x74\145\x64\101\164\x74\x72\x69\142\165\x74\145");
    }
    private function parseSignature(DOMElement $Tr)
    {
        $QH = Utilities::validateElement($Tr);
        if (!($QH !== FALSE)) {
            goto WN;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $QH["\103\145\162\164\x69\146\151\x63\x61\164\145\x73"];
        $this->signatureData = $QH;
        WN:
    }
    public function validate(XMLSecurityKey $aC)
    {
        if (!($this->signatureData === NULL)) {
            goto Ed;
        }
        return FALSE;
        Ed:
        Utilities::validateSignature($this->signatureData, $aC);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($qj)
    {
        $this->id = $qj;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($ql)
    {
        $this->issueInstant = $ql;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($xx)
    {
        $this->issuer = $xx;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto wv;
        }
        throw new Exception("\101\x74\164\145\155\x70\x74\145\x64\40\164\x6f\40\162\x65\164\x72\151\x65\x76\145\x20\145\x6e\143\162\171\x70\164\145\144\x20\116\141\155\145\x49\x44\x20\167\151\x74\150\x6f\x75\164\40\x64\x65\x63\x72\x79\160\x74\151\156\x67\x20\151\164\40\146\x69\162\x73\164\56");
        wv:
        return $this->nameId;
    }
    public function setNameId($jE)
    {
        $this->nameId = $jE;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto xD;
        }
        return TRUE;
        xD:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $aC)
    {
        $JC = new DOMDocument();
        $uw = $JC->createElement("\x72\x6f\x6f\x74");
        $JC->appendChild($uw);
        Utilities::addNameId($uw, $this->nameId);
        $jE = $uw->firstChild;
        Utilities::getContainer()->debugMessage($jE, "\x65\156\143\162\171\x70\164");
        $qm = new XMLSecEnc();
        $qm->setNode($jE);
        $qm->type = XMLSecEnc::Element;
        $Qj = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $Qj->generateSessionKey();
        $qm->encryptKey($aC, $Qj);
        $this->encryptedNameId = $qm->encryptNode($Qj);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $aC, array $HS = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto rj;
        }
        return;
        rj:
        $jE = Utilities::decryptElement($this->encryptedNameId, $aC, $HS);
        Utilities::getContainer()->debugMessage($jE, "\144\145\143\x72\x79\x70\x74");
        $this->nameId = Utilities::parseNameId($jE);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $aC, array $HS = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto iC;
        }
        return;
        iC:
        $XF = TRUE;
        $At = $this->encryptedAttribute;
        foreach ($At as $mG) {
            $BW = Utilities::decryptElement($mG->getElementsByTagName("\x45\156\x63\162\171\160\x74\x65\x64\104\x61\x74\x61")->item(0), $aC, $HS);
            if ($BW->hasAttribute("\116\141\x6d\x65")) {
                goto Rk;
            }
            throw new Exception("\x4d\151\163\x73\151\156\x67\x20\156\141\x6d\x65\x20\x6f\x6e\40\x3c\163\141\x6d\x6c\x3a\101\164\x74\162\x69\142\165\164\x65\76\40\145\154\x65\155\x65\156\x74\x2e");
            Rk:
            $nP = $BW->getAttribute("\116\x61\x6d\145");
            if ($BW->hasAttribute("\116\x61\155\145\106\x6f\162\155\x61\164")) {
                goto wo;
            }
            $t4 = "\165\162\x6e\72\157\x61\x73\x69\x73\x3a\x6e\141\155\145\x73\x3a\x74\143\72\123\101\x4d\x4c\72\x32\x2e\x30\72\141\164\164\162\x6e\141\155\x65\x2d\146\157\162\x6d\x61\x74\72\x75\156\163\x70\145\143\151\146\151\145\144";
            goto FY;
            wo:
            $t4 = $BW->getAttribute("\x4e\x61\x6d\x65\106\157\162\x6d\141\x74");
            FY:
            if ($XF) {
                goto Ma;
            }
            if (!($this->nameFormat !== $t4)) {
                goto zo;
            }
            $this->nameFormat = "\x75\162\x6e\72\x6f\141\x73\x69\163\x3a\156\x61\x6d\145\163\x3a\x74\x63\72\123\x41\x4d\114\72\62\56\60\x3a\141\x74\x74\x72\156\x61\x6d\145\x2d\x66\157\162\x6d\141\164\x3a\165\156\x73\x70\145\x63\x69\146\x69\x65\x64";
            zo:
            goto ym;
            Ma:
            $this->nameFormat = $t4;
            $XF = FALSE;
            ym:
            if (array_key_exists($nP, $this->attributes)) {
                goto w6;
            }
            $this->attributes[$nP] = array();
            w6:
            $JB = Utilities::xpQuery($BW, "\56\x2f\x73\141\155\154\x5f\x61\163\x73\145\162\x74\151\x6f\156\72\101\x74\x74\162\151\x62\165\x74\x65\x56\141\x6c\165\145");
            foreach ($JB as $uo) {
                $this->attributes[$nP][] = trim($uo->textContent);
                HR:
            }
            hX:
            Ou:
        }
        aX:
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
    public function setNotOnOrAfter($AO)
    {
        $this->notOnOrAfter = $AO;
    }
    public function setEncryptedAttributes($tP)
    {
        $this->requiredEncAttributes = $tP;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $V3 = NULL)
    {
        $this->validAudiences = $V3;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($gu)
    {
        $this->authnInstant = $gu;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($wQ)
    {
        $this->sessionNotOnOrAfter = $wQ;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($bq)
    {
        $this->sessionIndex = $bq;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto WA;
        }
        return $this->authnContextClassRef;
        WA:
        if (empty($this->authnContextDeclRef)) {
            goto uu;
        }
        return $this->authnContextDeclRef;
        uu:
        return NULL;
    }
    public function setAuthnContext($fV)
    {
        $this->setAuthnContextClassRef($fV);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($pf)
    {
        $this->authnContextClassRef = $pf;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $jc)
    {
        if (empty($this->authnContextDeclRef)) {
            goto B5;
        }
        throw new Exception("\101\165\164\150\x6e\x43\x6f\x6e\x74\145\170\164\104\145\x63\154\122\x65\146\40\151\163\40\x61\154\162\145\141\x64\x79\x20\162\145\x67\x69\163\164\x65\x72\145\x64\41\x20\x4d\x61\x79\40\157\156\x6c\171\40\150\x61\x76\145\40\x65\x69\164\150\145\162\x20\x61\x20\x44\x65\143\x6c\40\x6f\162\x20\141\40\104\145\143\154\x52\x65\146\54\x20\x6e\x6f\x74\40\x62\x6f\164\150\x21");
        B5:
        $this->authnContextDecl = $jc;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($pr)
    {
        if (empty($this->authnContextDecl)) {
            goto f8;
        }
        throw new Exception("\x41\x75\x74\x68\156\103\x6f\x6e\164\145\170\x74\x44\145\x63\154\x20\x69\x73\40\141\x6c\x72\x65\x61\144\171\40\x72\145\147\x69\x73\164\x65\162\145\x64\x21\40\115\x61\171\x20\157\x6e\154\171\40\150\141\x76\x65\40\145\x69\x74\150\x65\x72\40\x61\x20\x44\145\x63\x6c\40\x6f\162\40\141\40\104\145\x63\154\x52\145\x66\x2c\x20\x6e\157\x74\40\142\x6f\x74\150\41");
        f8:
        $this->authnContextDeclRef = $pr;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($Jp)
    {
        $this->AuthenticatingAuthority = $Jp;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $At)
    {
        $this->attributes = $At;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($t4)
    {
        $this->nameFormat = $t4;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $yg)
    {
        $this->SubjectConfirmation = $yg;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $rC = NULL)
    {
        $this->signatureKey = $rC;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $QJ = NULL)
    {
        $this->encryptionKey = $QJ;
    }
    public function setCertificates(array $pF)
    {
        $this->certificates = $pF;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $cn = NULL)
    {
        if ($cn === NULL) {
            goto zY;
        }
        $Uz = $cn->ownerDocument;
        goto sY;
        zY:
        $Uz = new DOMDocument();
        $cn = $Uz;
        sY:
        $uw = $Uz->createElementNS("\165\162\x6e\72\157\141\x73\x69\x73\72\x6e\x61\155\145\163\x3a\x74\143\72\x53\101\x4d\x4c\72\x32\56\60\x3a\x61\163\163\x65\x72\164\x69\x6f\x6e", "\163\x61\155\x6c\x3a" . "\x41\163\163\x65\162\x74\x69\157\156");
        $cn->appendChild($uw);
        $uw->setAttributeNS("\x75\x72\156\72\x6f\x61\163\151\163\72\156\x61\x6d\x65\163\72\164\x63\72\x53\x41\x4d\114\72\x32\x2e\60\72\160\x72\157\164\x6f\143\x6f\x6c", "\163\x61\155\x6c\160\72\164\155\x70", "\x74\x6d\x70");
        $uw->removeAttributeNS("\x75\x72\x6e\72\x6f\141\163\x69\163\72\x6e\x61\x6d\x65\163\72\164\x63\72\123\x41\x4d\x4c\72\62\x2e\60\72\160\162\157\164\x6f\x63\x6f\154", "\x74\155\160");
        $uw->setAttributeNS("\150\164\164\x70\72\57\x2f\167\167\167\x2e\x77\x33\56\157\162\147\x2f\x32\x30\60\61\57\x58\x4d\114\x53\143\x68\145\155\x61\55\x69\156\163\164\x61\156\143\145", "\170\x73\x69\72\x74\x6d\160", "\x74\155\x70");
        $uw->removeAttributeNS("\x68\164\164\x70\x3a\57\57\x77\167\x77\x2e\x77\63\56\x6f\162\x67\57\x32\60\60\61\x2f\130\115\x4c\123\143\x68\145\155\141\55\151\x6e\x73\x74\141\156\x63\145", "\164\155\x70");
        $uw->setAttributeNS("\x68\164\x74\x70\72\x2f\57\167\167\167\x2e\x77\63\x2e\x6f\162\x67\57\62\60\x30\61\x2f\x58\115\114\123\143\x68\145\155\x61", "\170\x73\x3a\x74\x6d\160", "\x74\x6d\x70");
        $uw->removeAttributeNS("\150\164\x74\x70\72\x2f\x2f\167\x77\167\x2e\167\x33\56\x6f\x72\x67\57\62\60\60\x31\57\130\x4d\x4c\x53\x63\150\x65\155\x61", "\x74\155\x70");
        $uw->setAttribute("\x49\x44", $this->id);
        $uw->setAttribute("\126\145\162\x73\151\157\x6e", "\62\x2e\x30");
        $uw->setAttribute("\111\163\x73\165\x65\x49\156\163\x74\x61\156\x74", gmdate("\x59\x2d\155\55\x64\x5c\124\x48\72\x69\x3a\163\134\132", $this->issueInstant));
        $xx = Utilities::addString($uw, "\165\x72\156\x3a\x6f\141\163\x69\x73\72\x6e\x61\155\145\x73\x3a\164\x63\x3a\123\101\x4d\114\x3a\62\x2e\x30\x3a\141\163\163\x65\x72\x74\x69\x6f\156", "\163\x61\155\154\x3a\111\x73\x73\x75\x65\162", $this->issuer);
        $this->addSubject($uw);
        $this->addConditions($uw);
        $this->addAuthnStatement($uw);
        if ($this->requiredEncAttributes == FALSE) {
            goto Nn;
        }
        $this->addEncryptedAttributeStatement($uw);
        goto Fv;
        Nn:
        $this->addAttributeStatement($uw);
        Fv:
        if (!($this->signatureKey !== NULL)) {
            goto Q0;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $uw, $xx->nextSibling);
        Q0:
        return $uw;
    }
    private function addSubject(DOMElement $uw)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto w9;
        }
        return;
        w9:
        $Av = $uw->ownerDocument->createElementNS("\165\x72\x6e\72\x6f\141\x73\x69\x73\x3a\156\141\x6d\145\x73\72\164\x63\72\123\101\x4d\114\x3a\62\x2e\60\72\x61\163\x73\x65\x72\164\x69\157\156", "\x73\141\155\x6c\72\x53\165\142\x6a\x65\x63\164");
        $uw->appendChild($Av);
        if ($this->encryptedNameId === NULL) {
            goto gS;
        }
        $FP = $Av->ownerDocument->createElementNS("\x75\162\x6e\x3a\x6f\141\163\151\163\x3a\x6e\141\155\x65\x73\72\x74\x63\x3a\123\101\x4d\114\72\62\56\60\72\x61\163\x73\x65\162\x74\x69\157\156", "\163\x61\155\154\72" . "\105\x6e\143\x72\x79\160\164\x65\144\x49\104");
        $Av->appendChild($FP);
        $FP->appendChild($Av->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto Bt;
        gS:
        Utilities::addNameId($Av, $this->nameId);
        Bt:
        foreach ($this->SubjectConfirmation as $em) {
            $em->toXML($Av);
            IL:
        }
        in:
    }
    private function addConditions(DOMElement $uw)
    {
        $Uz = $uw->ownerDocument;
        $b2 = $Uz->createElementNS("\x75\x72\x6e\72\157\x61\x73\151\163\72\156\x61\155\145\x73\x3a\x74\143\x3a\123\101\115\114\x3a\x32\56\60\72\141\x73\x73\x65\x72\x74\x69\x6f\156", "\x73\x61\155\154\x3a\x43\157\156\x64\151\164\x69\x6f\x6e\163");
        $uw->appendChild($b2);
        if (!($this->notBefore !== NULL)) {
            goto i9;
        }
        $b2->setAttribute("\x4e\157\x74\102\x65\x66\x6f\x72\x65", gmdate("\131\x2d\x6d\55\144\134\x54\x48\72\151\x3a\163\x5c\x5a", $this->notBefore));
        i9:
        if (!($this->notOnOrAfter !== NULL)) {
            goto mn;
        }
        $b2->setAttribute("\x4e\157\x74\117\x6e\117\x72\x41\146\x74\145\x72", gmdate("\131\55\x6d\x2d\x64\x5c\x54\x48\72\x69\x3a\163\134\132", $this->notOnOrAfter));
        mn:
        if (!($this->validAudiences !== NULL)) {
            goto GV;
        }
        $WT = $Uz->createElementNS("\x75\162\156\x3a\157\141\x73\x69\163\72\156\x61\x6d\x65\163\x3a\x74\x63\72\123\101\115\114\x3a\x32\56\60\x3a\x61\163\x73\x65\162\164\x69\157\156", "\x73\141\x6d\154\72\101\165\144\x69\x65\156\x63\x65\x52\x65\163\x74\162\x69\143\164\x69\x6f\x6e");
        $b2->appendChild($WT);
        Utilities::addStrings($WT, "\165\162\x6e\x3a\x6f\141\x73\x69\163\x3a\x6e\141\x6d\145\163\x3a\164\x63\x3a\123\x41\x4d\114\x3a\62\56\x30\72\141\163\x73\145\x72\x74\151\x6f\156", "\163\141\155\154\x3a\101\165\x64\151\x65\156\x63\x65", FALSE, $this->validAudiences);
        GV:
    }
    private function addAuthnStatement(DOMElement $uw)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto WE;
        }
        return;
        WE:
        $Uz = $uw->ownerDocument;
        $og = $Uz->createElementNS("\165\162\x6e\72\157\x61\x73\x69\x73\72\x6e\x61\x6d\x65\x73\x3a\x74\143\72\123\101\115\114\72\62\x2e\60\72\x61\x73\x73\145\162\x74\151\157\x6e", "\163\x61\155\154\x3a\x41\165\x74\x68\x6e\x53\164\x61\164\x65\155\145\x6e\x74");
        $uw->appendChild($og);
        $og->setAttribute("\x41\165\164\150\x6e\111\x6e\x73\164\x61\x6e\164", gmdate("\131\x2d\155\55\x64\134\124\x48\72\x69\x3a\163\134\x5a", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto Ob;
        }
        $og->setAttribute("\x53\145\x73\x73\x69\x6f\x6e\x4e\x6f\x74\117\x6e\x4f\x72\x41\x66\164\145\162", gmdate("\x59\x2d\x6d\55\x64\134\x54\110\x3a\151\x3a\163\134\132", $this->sessionNotOnOrAfter));
        Ob:
        if (!($this->sessionIndex !== NULL)) {
            goto e1;
        }
        $og->setAttribute("\123\145\163\x73\151\157\156\111\156\144\x65\170", $this->sessionIndex);
        e1:
        $f9 = $Uz->createElementNS("\x75\162\156\72\x6f\x61\163\151\163\x3a\x6e\x61\x6d\x65\163\72\164\x63\x3a\x53\101\115\x4c\72\62\x2e\x30\x3a\141\x73\x73\145\x72\164\151\157\156", "\x73\x61\x6d\154\72\101\165\164\x68\x6e\x43\x6f\156\x74\145\170\x74");
        $og->appendChild($f9);
        if (empty($this->authnContextClassRef)) {
            goto IY;
        }
        Utilities::addString($f9, "\x75\162\156\x3a\x6f\141\x73\151\163\72\x6e\141\x6d\145\163\x3a\x74\143\72\x53\x41\x4d\114\x3a\62\x2e\x30\72\141\x73\x73\x65\x72\x74\151\x6f\x6e", "\163\x61\x6d\x6c\x3a\101\165\164\x68\x6e\103\x6f\156\x74\145\170\164\103\154\x61\x73\x73\x52\x65\x66", $this->authnContextClassRef);
        IY:
        if (empty($this->authnContextDecl)) {
            goto nR;
        }
        $this->authnContextDecl->toXML($f9);
        nR:
        if (empty($this->authnContextDeclRef)) {
            goto AB;
        }
        Utilities::addString($f9, "\165\x72\156\x3a\x6f\141\163\151\x73\72\156\x61\155\145\x73\72\x74\x63\x3a\x53\101\115\x4c\x3a\x32\x2e\60\x3a\141\x73\163\x65\162\x74\151\x6f\156", "\163\141\155\x6c\72\x41\x75\x74\150\x6e\103\x6f\156\164\145\170\x74\104\145\143\154\x52\x65\146", $this->authnContextDeclRef);
        AB:
        Utilities::addStrings($f9, "\165\162\x6e\72\157\x61\x73\151\x73\x3a\156\141\155\x65\x73\x3a\164\143\x3a\x53\101\x4d\x4c\72\x32\56\x30\x3a\141\163\163\145\x72\164\151\x6f\x6e", "\163\x61\155\x6c\x3a\x41\x75\x74\150\x65\156\x74\151\x63\x61\x74\x69\x6e\147\101\x75\164\x68\x6f\x72\151\164\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $uw)
    {
        if (!empty($this->attributes)) {
            goto Hz;
        }
        return;
        Hz:
        $Uz = $uw->ownerDocument;
        $JJ = $Uz->createElementNS("\165\x72\156\x3a\157\x61\x73\x69\163\72\x6e\141\155\145\163\x3a\164\143\72\123\101\115\x4c\x3a\x32\56\60\x3a\141\163\x73\145\162\x74\x69\157\x6e", "\163\x61\155\154\72\x41\164\164\x72\x69\x62\x75\164\145\123\164\141\x74\145\x6d\x65\x6e\164");
        $uw->appendChild($JJ);
        foreach ($this->attributes as $nP => $JB) {
            $BW = $Uz->createElementNS("\165\x72\156\x3a\x6f\141\x73\151\163\x3a\156\141\155\x65\x73\x3a\x74\x63\x3a\123\x41\115\x4c\72\62\56\x30\x3a\x61\163\x73\x65\162\x74\151\157\x6e", "\163\x61\x6d\154\72\101\x74\164\x72\x69\x62\165\x74\x65");
            $JJ->appendChild($BW);
            $BW->setAttribute("\116\x61\155\145", $nP);
            if (!($this->nameFormat !== "\x75\162\x6e\72\157\x61\x73\x69\163\x3a\x6e\x61\155\x65\x73\72\164\143\x3a\x53\x41\115\x4c\x3a\62\56\60\72\141\164\x74\162\x6e\141\x6d\x65\x2d\x66\x6f\x72\x6d\141\164\72\x75\156\x73\x70\x65\x63\151\146\151\x65\x64")) {
                goto TL;
            }
            $BW->setAttribute("\x4e\141\155\x65\106\157\162\x6d\141\164", $this->nameFormat);
            TL:
            foreach ($JB as $uo) {
                if (is_string($uo)) {
                    goto gq;
                }
                if (is_int($uo)) {
                    goto Et;
                }
                $KA = NULL;
                goto Mr;
                gq:
                $KA = "\170\x73\72\163\164\162\x69\156\x67";
                goto Mr;
                Et:
                $KA = "\170\x73\x3a\x69\x6e\x74\x65\147\145\x72";
                Mr:
                $ul = $Uz->createElementNS("\x75\x72\x6e\72\x6f\x61\x73\x69\x73\x3a\x6e\x61\155\x65\163\72\x74\143\x3a\123\x41\x4d\x4c\72\62\x2e\60\x3a\x61\163\x73\145\x72\164\151\x6f\156", "\163\141\x6d\154\72\101\x74\164\162\x69\x62\165\164\145\x56\141\x6c\x75\x65");
                $BW->appendChild($ul);
                if (!($KA !== NULL)) {
                    goto KJ;
                }
                $ul->setAttributeNS("\150\x74\164\160\72\57\57\167\167\167\x2e\x77\63\x2e\157\162\147\57\x32\x30\60\x31\x2f\x58\x4d\x4c\123\143\x68\145\155\141\x2d\151\x6e\x73\x74\x61\156\143\145", "\x78\x73\x69\x3a\x74\171\160\145", $KA);
                KJ:
                if (!is_null($uo)) {
                    goto ug;
                }
                $ul->setAttributeNS("\x68\164\164\x70\x3a\x2f\57\167\x77\167\x2e\167\x33\56\157\162\x67\x2f\x32\x30\60\x31\x2f\x58\x4d\x4c\x53\x63\x68\x65\x6d\x61\55\151\x6e\163\164\141\156\143\145", "\x78\x73\x69\72\156\x69\x6c", "\164\162\165\x65");
                ug:
                if ($uo instanceof DOMNodeList) {
                    goto pD;
                }
                $ul->appendChild($Uz->createTextNode($uo));
                goto fe;
                pD:
                $MS = 0;
                XY:
                if (!($MS < $uo->length)) {
                    goto w0;
                }
                $y2 = $Uz->importNode($uo->item($MS), TRUE);
                $ul->appendChild($y2);
                UC:
                $MS++;
                goto XY;
                w0:
                fe:
                th:
            }
            oL:
            WH:
        }
        gZ:
    }
    private function addEncryptedAttributeStatement(DOMElement $uw)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto oq;
        }
        return;
        oq:
        $Uz = $uw->ownerDocument;
        $JJ = $Uz->createElementNS("\x75\162\156\72\x6f\x61\163\x69\x73\72\x6e\141\x6d\145\163\x3a\x74\143\x3a\123\101\x4d\x4c\x3a\62\x2e\60\x3a\141\x73\x73\x65\x72\164\x69\x6f\x6e", "\163\141\155\154\x3a\x41\x74\x74\x72\x69\x62\165\164\145\x53\x74\141\164\145\x6d\145\x6e\x74");
        $uw->appendChild($JJ);
        foreach ($this->attributes as $nP => $JB) {
            $Dz = new DOMDocument();
            $BW = $Dz->createElementNS("\x75\x72\156\x3a\x6f\x61\163\151\163\72\156\141\x6d\145\x73\x3a\164\x63\x3a\123\101\x4d\114\x3a\62\x2e\60\72\x61\163\163\x65\x72\x74\151\x6f\156", "\163\141\x6d\x6c\72\101\164\x74\x72\x69\x62\x75\x74\x65");
            $BW->setAttribute("\116\141\x6d\x65", $nP);
            $Dz->appendChild($BW);
            if (!($this->nameFormat !== "\165\x72\156\x3a\x6f\x61\x73\x69\x73\72\x6e\141\155\x65\163\72\164\143\72\x53\x41\115\114\x3a\x32\56\60\72\141\x74\164\x72\x6e\141\155\x65\55\x66\157\162\155\141\164\x3a\165\156\163\160\145\143\x69\x66\x69\145\144")) {
                goto PC;
            }
            $BW->setAttribute("\116\x61\x6d\145\106\x6f\x72\155\141\164", $this->nameFormat);
            PC:
            foreach ($JB as $uo) {
                if (is_string($uo)) {
                    goto Nj;
                }
                if (is_int($uo)) {
                    goto Z4;
                }
                $KA = NULL;
                goto Fr;
                Nj:
                $KA = "\x78\163\72\x73\164\x72\151\x6e\x67";
                goto Fr;
                Z4:
                $KA = "\170\163\x3a\x69\156\x74\x65\147\x65\x72";
                Fr:
                $ul = $Dz->createElementNS("\165\162\x6e\x3a\157\141\x73\x69\163\x3a\x6e\141\x6d\145\163\x3a\x74\143\x3a\x53\x41\x4d\x4c\72\x32\x2e\x30\x3a\141\163\163\145\162\x74\151\157\156", "\163\x61\155\154\72\101\x74\x74\162\x69\x62\165\164\x65\x56\x61\x6c\165\x65");
                $BW->appendChild($ul);
                if (!($KA !== NULL)) {
                    goto YI;
                }
                $ul->setAttributeNS("\150\x74\164\160\72\x2f\x2f\x77\167\167\x2e\167\x33\x2e\x6f\162\147\57\x32\60\x30\x31\57\x58\115\x4c\123\143\150\x65\155\x61\55\x69\156\x73\164\141\x6e\143\145", "\x78\x73\151\72\164\171\160\x65", $KA);
                YI:
                if ($uo instanceof DOMNodeList) {
                    goto jH;
                }
                $ul->appendChild($Dz->createTextNode($uo));
                goto be;
                jH:
                $MS = 0;
                zp:
                if (!($MS < $uo->length)) {
                    goto mQ;
                }
                $y2 = $Dz->importNode($uo->item($MS), TRUE);
                $ul->appendChild($y2);
                Lg:
                $MS++;
                goto zp;
                mQ:
                be:
                BV:
            }
            eJ:
            $Yb = new XMLSecEnc();
            $Yb->setNode($Dz->documentElement);
            $Yb->type = "\x68\x74\164\x70\x3a\x2f\x2f\167\167\167\x2e\x77\x33\56\157\x72\147\x2f\62\60\60\61\57\x30\x34\57\x78\x6d\x6c\x65\x6e\143\43\x45\x6c\x65\155\145\x6e\x74";
            $Qj = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $Qj->generateSessionKey();
            $Yb->encryptKey($this->encryptionKey, $Qj);
            $sS = $Yb->encryptNode($Qj);
            $re = $Uz->createElementNS("\x75\x72\x6e\x3a\x6f\x61\x73\x69\x73\x3a\x6e\x61\155\x65\x73\x3a\x74\143\x3a\x53\x41\x4d\114\x3a\x32\x2e\60\x3a\141\x73\x73\x65\162\164\x69\x6f\x6e", "\163\x61\155\x6c\x3a\105\x6e\143\x72\x79\x70\x74\x65\144\101\x74\164\x72\x69\142\x75\x74\145");
            $JJ->appendChild($re);
            $fR = $Uz->importNode($sS, TRUE);
            $re->appendChild($fR);
            by:
        }
        o4:
    }
}
