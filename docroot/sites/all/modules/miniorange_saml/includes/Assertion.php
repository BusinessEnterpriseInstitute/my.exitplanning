<?php


include_once "\125\x74\151\x6c\151\164\x69\x65\163\x2e\x70\x68\160";
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
    public function __construct(DOMElement $lg = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\162\x6e\x3a\x6f\141\x73\151\x73\x3a\x6e\141\155\x65\x73\x3a\x74\x63\x3a\123\101\x4d\114\x3a\61\x2e\x31\72\x6e\141\x6d\x65\151\144\x2d\x66\157\x72\x6d\141\164\x3a\165\x6e\163\x70\x65\x63\x69\146\151\x65\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($lg === NULL)) {
            goto f2;
        }
        return;
        f2:
        if (!($lg->localName === "\105\x6e\x63\x72\171\x70\x74\145\144\101\163\x73\x65\162\x74\x69\x6f\x6e")) {
            goto mh;
        }
        $iu = Utilities::xpQuery($lg, "\x2e\57\170\x65\156\x63\x3a\x45\156\143\x72\171\x70\164\145\144\104\141\164\x61");
        $BU = Utilities::xpQuery($lg, "\56\x2f\170\x65\x6e\143\72\x45\156\x63\162\171\x70\x74\x65\144\104\141\x74\x61\x2f\144\163\72\x4b\x65\x79\x49\x6e\x66\157\57\170\x65\156\x63\x3a\105\156\x63\162\x79\160\x74\x65\x64\113\145\x79");
        $o6 = '';
        if (empty($BU)) {
            goto Qy;
        }
        $o6 = $BU[0]->firstChild->getAttribute("\x41\154\x67\157\x72\151\x74\x68\155");
        goto Av;
        Qy:
        $BU = Utilities::xpQuery($lg, "\x2e\57\x78\x65\x6e\143\72\x45\x6e\x63\x72\171\160\164\x65\x64\113\145\171\57\170\x65\156\143\x3a\105\156\143\x72\x79\x70\x74\x69\157\156\x4d\145\x74\150\157\x64");
        $o6 = $BU[0]->getAttribute("\x41\154\x67\x6f\x72\151\x74\x68\155");
        Av:
        $F8 = Utilities::getEncryptionAlgorithm($o6);
        if (count($iu) === 0) {
            goto eB;
        }
        if (count($iu) > 1) {
            goto hB;
        }
        goto Sc;
        eB:
        throw new Exception("\115\x69\x73\163\x69\x6e\x67\x20\145\156\143\162\171\160\164\x65\144\x20\144\x61\x74\141\40\151\x6e\x20\74\163\141\155\x6c\x3a\x45\156\143\162\171\160\x74\x65\144\101\163\163\145\162\164\151\157\156\76\56");
        goto Sc;
        hB:
        throw new Exception("\x4d\x6f\162\145\x20\164\x68\141\x6e\x20\x6f\156\x65\x20\145\x6e\143\162\171\x70\x74\x65\144\x20\144\141\x74\141\x20\x65\154\145\155\145\156\164\40\x69\x6e\x20\74\x73\141\155\154\x3a\x45\156\x63\162\171\x70\x74\145\144\101\163\163\145\x72\164\151\157\156\76\x2e");
        Sc:
        $Sy = '';
        $Sy = variable_get("\155\151\156\151\157\x72\141\x6e\147\x65\137\x73\141\x6d\154\137\x70\162\x69\166\x61\x74\145\x5f\x63\x65\x72\164\151\x66\x69\143\x61\x74\x65");
        $Rh = new XMLSecurityKey($F8, array("\164\171\160\x65" => "\x70\x72\151\166\x61\x74\x65"));
        $dM = drupal_get_path("\155\x6f\x64\165\x6c\145", "\x6d\x69\x6e\x69\x6f\162\x61\156\x67\x65\137\x73\141\x6d\x6c");
        if ($Sy != '') {
            goto Bo;
        }
        $lY = $dM . "\x2f\x72\x65\x73\157\x75\162\x63\x65\x73\57\x73\160\x2d\153\x65\171\x2e\153\145\171";
        goto OB;
        Bo:
        $lY = $dM . "\57\x72\145\163\157\165\x72\x63\145\x73\x2f\103\x75\163\164\157\x6d\137\x50\162\x69\x76\141\x74\x65\137\103\145\162\x74\151\x66\151\x63\141\x74\145\56\x6b\145\x79";
        OB:
        $Rh->loadKey($lY, TRUE);
        $Zl = new XMLSecurityKey($F8, array("\164\171\x70\x65" => "\x70\162\x69\166\141\x74\145"));
        $vP = $dM . "\57\x72\145\x73\157\x75\x72\x63\145\x73\x2f\155\x69\156\x69\x6f\162\x61\156\x67\x65\x5f\x73\160\x5f\160\162\x69\166\x5f\x6b\145\171\x2e\x6b\x65\171";
        $Zl->loadKey($vP, TRUE);
        $ls = array();
        $lg = Utilities::decryptElement($iu[0], $Rh, $ls, $Zl);
        mh:
        if ($lg->hasAttribute("\111\104")) {
            goto rk;
        }
        throw new Exception("\x4d\x69\163\x73\151\156\147\40\111\x44\x20\141\x74\164\162\x69\x62\x75\x74\x65\40\x6f\156\40\123\101\x4d\114\40\x61\163\x73\x65\x72\x74\x69\x6f\x6e\x2e");
        rk:
        $this->id = $lg->getAttribute("\111\104");
        if (!($lg->getAttribute("\x56\x65\x72\163\x69\x6f\x6e") !== "\x32\56\x30")) {
            goto mT;
        }
        throw new Exception("\x55\x6e\x73\165\160\160\x6f\x72\164\145\x64\x20\x76\145\x72\163\151\157\x6e\x3a\40" . $lg->getAttribute("\x56\x65\162\x73\151\157\156"));
        mT:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($lg->getAttribute("\111\163\163\x75\145\x49\x6e\x73\x74\x61\156\164"));
        $u1 = Utilities::xpQuery($lg, "\56\57\x73\141\155\154\x5f\x61\163\x73\x65\x72\x74\151\157\156\x3a\x49\x73\163\165\x65\162");
        if (!empty($u1)) {
            goto z6;
        }
        throw new Exception("\x4d\151\163\163\x69\x6e\147\40\x3c\x73\x61\155\x6c\x3a\111\163\x73\x75\x65\162\76\x20\x69\156\x20\141\x73\x73\x65\x72\x74\151\157\156\56");
        z6:
        $this->issuer = trim($u1[0]->textContent);
        $this->parseConditions($lg);
        $this->parseAuthnStatement($lg);
        $this->parseAttributes($lg);
        $this->parseEncryptedAttributes($lg);
        $this->parseSignature($lg);
        $this->parseSubject($lg);
    }
    private function parseSubject(DOMElement $lg)
    {
        $Aq = Utilities::xpQuery($lg, "\56\x2f\x73\x61\155\x6c\137\141\163\x73\x65\162\x74\x69\x6f\x6e\72\123\165\142\x6a\145\x63\164");
        if (empty($Aq)) {
            goto WD;
        }
        if (count($Aq) > 1) {
            goto iq;
        }
        goto AE;
        WD:
        return;
        goto AE;
        iq:
        throw new Exception("\115\x6f\162\145\x20\x74\150\x61\156\x20\x6f\156\145\40\x3c\x73\141\155\x6c\x3a\123\x75\142\x6a\145\x63\x74\76\x20\x69\x6e\x20\74\x73\x61\155\x6c\72\101\163\163\x65\x72\164\x69\157\156\x3e\x2e");
        AE:
        $Aq = $Aq[0];
        $px = Utilities::xpQuery($Aq, "\56\57\163\141\155\x6c\137\141\163\x73\145\162\x74\151\157\156\x3a\x4e\141\155\x65\111\104\x20\174\40\x2e\x2f\163\x61\155\x6c\x5f\141\x73\163\145\162\164\151\x6f\x6e\x3a\105\156\143\162\171\x70\164\145\x64\111\104\x2f\170\x65\156\143\x3a\105\156\143\x72\x79\x70\164\145\144\104\141\x74\x61");
        if (empty($px)) {
            goto B6;
        }
        if (count($px) > 1) {
            goto gd;
        }
        goto gi;
        B6:
        throw new Exception("\115\151\x73\163\151\156\x67\x20\74\x73\x61\x6d\x6c\x3a\x4e\x61\x6d\145\111\x44\76\x20\157\x72\40\74\163\x61\x6d\154\72\x45\156\143\162\x79\160\x74\145\x64\111\x44\76\40\151\x6e\40\x3c\x73\x61\x6d\154\x3a\x53\x75\142\x6a\145\143\164\x3e\x2e");
        goto gi;
        gd:
        throw new Exception("\x4d\157\162\145\40\x74\x68\141\156\x20\x6f\x6e\145\x20\x3c\163\141\155\x6c\x3a\x4e\141\155\x65\111\104\x3e\40\x6f\x72\40\74\x73\x61\155\154\x3a\105\156\143\x72\171\160\164\145\x64\x44\x3e\40\151\156\40\74\x73\141\155\x6c\72\x53\x75\x62\x6a\x65\x63\164\76\56");
        gi:
        $px = $px[0];
        if ($px->localName === "\x45\156\x63\x72\x79\160\x74\145\144\104\x61\x74\x61") {
            goto G1;
        }
        $this->nameId = Utilities::parseNameId($px);
        goto Kc;
        G1:
        $this->encryptedNameId = $px;
        Kc:
    }
    private function parseConditions(DOMElement $lg)
    {
        $iS = Utilities::xpQuery($lg, "\56\57\163\141\155\x6c\137\141\163\163\x65\162\164\151\x6f\156\x3a\x43\x6f\x6e\x64\x69\x74\151\x6f\x6e\x73");
        if (empty($iS)) {
            goto RN;
        }
        if (count($iS) > 1) {
            goto ym;
        }
        goto ug;
        RN:
        return;
        goto ug;
        ym:
        throw new Exception("\x4d\x6f\x72\145\x20\164\x68\x61\x6e\40\157\x6e\145\x20\74\163\141\155\x6c\72\103\x6f\x6e\144\151\164\x69\157\156\163\x3e\x20\x69\156\40\x3c\x73\141\x6d\x6c\72\101\163\163\145\x72\x74\151\x6f\x6e\76\x2e");
        ug:
        $iS = $iS[0];
        if (!$iS->hasAttribute("\116\157\x74\102\145\x66\157\x72\145")) {
            goto GW;
        }
        $N1 = Utilities::xsDateTimeToTimestamp($iS->getAttribute("\x4e\157\x74\x42\145\146\157\162\145"));
        if (!($this->notBefore === NULL || $this->notBefore < $N1)) {
            goto HL;
        }
        $this->notBefore = $N1;
        HL:
        GW:
        if (!$iS->hasAttribute("\116\157\x74\117\156\x4f\162\101\146\164\x65\x72")) {
            goto j7;
        }
        $OF = Utilities::xsDateTimeToTimestamp($iS->getAttribute("\116\157\164\117\x6e\117\x72\x41\146\x74\145\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $OF)) {
            goto YV;
        }
        $this->notOnOrAfter = $OF;
        YV:
        j7:
        $fz = $iS->firstChild;
        v3:
        if (!($fz !== NULL)) {
            goto sd;
        }
        if (!$fz instanceof DOMText) {
            goto Sv;
        }
        goto ge;
        Sv:
        if (!($fz->namespaceURI !== "\165\162\x6e\x3a\157\x61\163\151\163\72\156\x61\x6d\x65\x73\72\164\x63\72\123\x41\115\114\x3a\x32\x2e\60\72\x61\163\163\x65\162\x74\151\x6f\156")) {
            goto Zm;
        }
        throw new Exception("\125\156\x6b\156\157\x77\156\x20\156\x61\x6d\x65\x73\160\141\143\x65\40\x6f\146\x20\143\157\156\144\151\164\151\157\x6e\x3a\40" . var_export($fz->namespaceURI, TRUE));
        Zm:
        switch ($fz->localName) {
            case "\x41\x75\x64\x69\x65\x6e\x63\x65\x52\x65\163\164\162\151\x63\x74\x69\x6f\156":
                $y5 = Utilities::extractStrings($fz, "\165\x72\x6e\x3a\x6f\x61\x73\x69\x73\x3a\x6e\x61\155\x65\x73\72\164\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\72\141\163\x73\x65\x72\x74\151\157\x6e", "\x41\165\144\x69\145\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto BN;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $y5);
                goto Y9;
                BN:
                $this->validAudiences = $y5;
                Y9:
                goto V1;
            case "\x4f\156\x65\124\151\155\x65\125\163\145":
                goto V1;
            case "\120\162\x6f\170\171\x52\x65\x73\164\x72\151\x63\x74\151\x6f\x6e":
                goto V1;
            default:
                throw new Exception("\x55\x6e\x6b\x6e\157\x77\x6e\x20\143\x6f\156\x64\151\x74\x69\157\x6e\72\40" . var_export($fz->localName, TRUE));
        }
        eD:
        V1:
        ge:
        $fz = $fz->nextSibling;
        goto v3;
        sd:
    }
    private function parseAuthnStatement(DOMElement $lg)
    {
        $aa = Utilities::xpQuery($lg, "\56\x2f\x73\x61\x6d\x6c\x5f\x61\x73\163\x65\x72\x74\x69\157\x6e\72\x41\x75\x74\x68\x6e\x53\x74\141\x74\145\155\x65\x6e\x74");
        if (empty($aa)) {
            goto Up;
        }
        if (count($aa) > 1) {
            goto rA;
        }
        goto Jl;
        Up:
        $this->authnInstant = NULL;
        return;
        goto Jl;
        rA:
        throw new Exception("\x4d\x6f\x72\x65\40\164\x68\x61\x74\x20\157\x6e\145\40\74\x73\141\x6d\x6c\x3a\x41\x75\164\x68\x6e\x53\164\x61\164\145\155\145\156\164\x3e\40\151\x6e\x20\x3c\163\141\155\x6c\72\x41\163\x73\145\x72\x74\x69\x6f\156\x3e\x20\156\x6f\x74\40\163\x75\160\x70\x6f\x72\164\145\144\56");
        Jl:
        $l8 = $aa[0];
        if ($l8->hasAttribute("\x41\x75\x74\x68\x6e\111\156\163\x74\141\156\164")) {
            goto W3;
        }
        throw new Exception("\115\x69\x73\163\151\156\x67\x20\x72\145\x71\165\151\x72\x65\144\x20\101\x75\164\150\x6e\111\156\x73\x74\141\x6e\x74\x20\141\x74\164\x72\x69\x62\165\164\x65\40\x6f\156\40\x3c\163\x61\155\154\x3a\101\165\x74\x68\x6e\123\x74\x61\x74\x65\155\145\x6e\x74\76\56");
        W3:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($l8->getAttribute("\x41\165\164\x68\156\111\156\x73\164\141\x6e\164"));
        if (!$l8->hasAttribute("\123\145\x73\163\151\157\x6e\x4e\157\164\117\156\x4f\162\101\x66\164\145\x72")) {
            goto n8;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($l8->getAttribute("\x53\145\x73\163\151\157\x6e\116\x6f\164\117\156\117\x72\101\146\x74\x65\162"));
        n8:
        if (!$l8->hasAttribute("\123\145\163\x73\151\x6f\x6e\111\x6e\144\x65\170")) {
            goto dL;
        }
        $this->sessionIndex = $l8->getAttribute("\x53\x65\163\163\x69\x6f\156\x49\x6e\144\x65\x78");
        dL:
        $this->parseAuthnContext($l8);
    }
    private function parseAuthnContext(DOMElement $CC)
    {
        $DZ = Utilities::xpQuery($CC, "\x2e\57\163\141\155\154\x5f\x61\163\163\x65\x72\164\x69\x6f\156\72\101\x75\164\x68\x6e\103\x6f\156\164\x65\170\x74");
        if (count($DZ) > 1) {
            goto qO;
        }
        if (empty($DZ)) {
            goto Nf;
        }
        goto Tw;
        qO:
        throw new Exception("\x4d\157\162\x65\x20\164\150\x61\x6e\x20\x6f\x6e\145\x20\74\x73\141\x6d\154\72\101\165\164\150\x6e\103\157\156\164\x65\x78\x74\76\x20\x69\156\x20\x3c\x73\141\x6d\154\72\x41\x75\164\x68\156\123\x74\x61\164\145\155\x65\156\x74\x3e\56");
        goto Tw;
        Nf:
        throw new Exception("\115\151\163\163\x69\x6e\x67\40\x72\145\161\x75\x69\x72\145\x64\40\x3c\163\x61\x6d\x6c\72\101\x75\164\150\x6e\103\x6f\156\164\145\x78\x74\76\x20\x69\x6e\40\74\x73\x61\x6d\154\x3a\101\x75\x74\150\156\x53\164\x61\x74\x65\x6d\145\156\x74\76\x2e");
        Tw:
        $us = $DZ[0];
        $j6 = Utilities::xpQuery($us, "\x2e\57\163\x61\x6d\x6c\137\141\x73\x73\145\x72\x74\x69\157\156\72\101\x75\164\150\x6e\103\x6f\156\164\x65\x78\164\104\145\143\154\122\x65\146");
        if (count($j6) > 1) {
            goto eR;
        }
        if (count($j6) === 1) {
            goto w1;
        }
        goto xQ;
        eR:
        throw new Exception("\115\x6f\x72\x65\x20\x74\x68\x61\x6e\x20\x6f\x6e\145\40\74\163\x61\155\154\72\101\165\164\x68\x6e\103\157\x6e\x74\x65\170\x74\104\x65\143\x6c\x52\145\146\76\x20\x66\x6f\165\x6e\x64\x3f");
        goto xQ;
        w1:
        $this->setAuthnContextDeclRef(trim($j6[0]->textContent));
        xQ:
        $uX = Utilities::xpQuery($us, "\56\x2f\163\x61\x6d\x6c\x5f\x61\163\x73\x65\x72\164\151\157\156\x3a\101\165\x74\150\156\x43\x6f\156\164\x65\170\164\x44\x65\143\x6c");
        if (count($uX) > 1) {
            goto wn;
        }
        if (count($uX) === 1) {
            goto xu;
        }
        goto nB;
        wn:
        throw new Exception("\x4d\x6f\x72\145\x20\x74\x68\x61\156\40\157\x6e\x65\40\74\x73\x61\155\154\x3a\x41\165\164\150\156\x43\x6f\156\x74\145\170\164\x44\x65\x63\x6c\76\x20\x66\x6f\x75\156\144\x3f");
        goto nB;
        xu:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($uX[0]));
        nB:
        $TZ = Utilities::xpQuery($us, "\56\x2f\x73\141\155\x6c\x5f\141\x73\163\145\x72\x74\151\157\156\72\101\165\x74\x68\156\x43\157\156\164\145\170\x74\103\154\141\163\x73\122\145\146");
        if (count($TZ) > 1) {
            goto eN;
        }
        if (count($TZ) === 1) {
            goto pi;
        }
        goto nm;
        eN:
        throw new Exception("\x4d\157\162\x65\40\164\x68\141\156\40\157\x6e\x65\40\x3c\163\x61\x6d\154\72\101\165\164\150\x6e\x43\157\x6e\164\x65\170\164\x43\x6c\141\163\x73\x52\145\x66\76\x20\x69\156\x20\x3c\x73\x61\155\x6c\x3a\x41\165\x74\x68\x6e\103\157\156\x74\x65\170\x74\76\x2e");
        goto nm;
        pi:
        $this->setAuthnContextClassRef(trim($TZ[0]->textContent));
        nm:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto ra;
        }
        throw new Exception("\x4d\151\163\163\x69\156\x67\x20\x65\151\164\150\145\x72\x20\74\163\x61\x6d\x6c\72\x41\x75\164\x68\156\x43\x6f\156\164\145\170\x74\x43\154\141\163\x73\122\145\x66\x3e\x20\x6f\162\x20\x3c\x73\141\x6d\154\x3a\x41\165\164\150\156\x43\157\x6e\164\x65\x78\x74\104\145\143\x6c\x52\x65\x66\x3e\x20\157\162\40\74\x73\x61\x6d\x6c\72\x41\x75\164\x68\x6e\x43\157\x6e\x74\x65\x78\x74\x44\145\x63\x6c\76");
        ra:
        $this->AuthenticatingAuthority = Utilities::extractStrings($us, "\165\162\x6e\x3a\157\x61\163\151\x73\72\156\x61\155\x65\163\72\164\143\72\x53\101\x4d\114\72\62\56\x30\x3a\141\163\163\145\x72\164\x69\157\x6e", "\101\165\164\x68\145\156\x74\x69\143\x61\x74\x69\x6e\147\101\x75\164\150\x6f\162\x69\x74\171");
    }
    private function parseAttributes(DOMElement $lg)
    {
        $uB = TRUE;
        $Dx = Utilities::xpQuery($lg, "\x2e\x2f\163\x61\155\154\x5f\141\163\x73\145\x72\164\151\157\x6e\72\x41\x74\164\x72\151\142\165\164\145\x53\164\141\x74\x65\x6d\145\156\164\x2f\x73\x61\155\x6c\137\x61\163\x73\x65\162\164\x69\157\x6e\72\x41\x74\164\162\151\x62\165\x74\145");
        foreach ($Dx as $xQ) {
            if ($xQ->hasAttribute("\116\x61\x6d\145")) {
                goto L3;
            }
            throw new Exception("\x4d\x69\163\x73\151\x6e\x67\x20\156\x61\x6d\x65\x20\x6f\x6e\x20\x3c\163\x61\155\x6c\x3a\x41\164\x74\162\x69\x62\x75\164\145\x3e\40\145\x6c\145\x6d\x65\156\x74\56");
            L3:
            $oR = $xQ->getAttribute("\x4e\141\155\145");
            if ($xQ->hasAttribute("\x4e\141\x6d\145\x46\157\x72\x6d\x61\164")) {
                goto Rv;
            }
            $ly = "\x75\x72\156\x3a\157\141\163\x69\163\72\156\x61\155\145\x73\72\164\x63\x3a\123\x41\x4d\x4c\x3a\61\56\x31\72\156\141\155\145\x69\144\55\146\x6f\162\x6d\141\164\x3a\165\156\x73\160\x65\143\x69\146\151\145\144";
            goto zW;
            Rv:
            $ly = $xQ->getAttribute("\116\x61\155\x65\x46\157\x72\x6d\x61\x74");
            zW:
            if ($uB) {
                goto F8;
            }
            if (!($this->nameFormat !== $ly)) {
                goto DE;
            }
            $this->nameFormat = "\x75\162\156\72\x6f\x61\x73\x69\163\x3a\x6e\x61\155\145\x73\72\x74\x63\x3a\x53\101\115\114\72\x31\x2e\x31\x3a\x6e\141\x6d\145\x69\x64\x2d\x66\x6f\x72\155\141\164\72\x75\x6e\x73\x70\145\x63\x69\146\x69\145\144";
            DE:
            goto S1;
            F8:
            $this->nameFormat = $ly;
            $uB = FALSE;
            S1:
            if (array_key_exists($oR, $this->attributes)) {
                goto pM;
            }
            $this->attributes[$oR] = array();
            pM:
            $vK = Utilities::xpQuery($xQ, "\56\57\163\141\155\x6c\137\141\x73\163\145\162\164\151\157\156\72\x41\x74\164\x72\x69\142\165\x74\x65\126\x61\154\165\145");
            foreach ($vK as $s5) {
                $this->attributes[$oR][] = trim($s5->textContent);
                wq:
            }
            Nh:
            wy:
        }
        Q8:
    }
    private function parseEncryptedAttributes(DOMElement $lg)
    {
        $this->encryptedAttribute = Utilities::xpQuery($lg, "\x2e\57\x73\x61\155\154\137\x61\163\x73\145\x72\164\151\x6f\x6e\72\x41\164\x74\162\x69\x62\165\x74\145\x53\x74\x61\164\145\x6d\145\156\x74\57\x73\141\155\x6c\137\141\x73\163\x65\x72\164\151\x6f\x6e\72\105\x6e\143\x72\x79\x70\164\145\x64\x41\164\x74\162\151\142\165\x74\145");
    }
    private function parseSignature(DOMElement $lg)
    {
        $s1 = Utilities::validateElement($lg);
        if (!($s1 !== FALSE)) {
            goto Z0;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $s1["\103\145\162\x74\x69\x66\x69\143\x61\x74\x65\163"];
        $this->signatureData = $s1;
        Z0:
    }
    public function validate(XMLSecurityKey $Rh)
    {
        if (!($this->signatureData === NULL)) {
            goto XH;
        }
        return FALSE;
        XH:
        Utilities::validateSignature($this->signatureData, $Rh);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($KG)
    {
        $this->id = $KG;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($u6)
    {
        $this->issueInstant = $u6;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($u1)
    {
        $this->issuer = $u1;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Iy;
        }
        throw new Exception("\x41\x74\164\x65\x6d\x70\x74\x65\x64\40\x74\x6f\40\x72\145\164\162\151\x65\166\145\40\145\x6e\x63\162\x79\160\x74\145\x64\x20\x4e\x61\x6d\x65\111\104\40\167\x69\x74\x68\157\x75\x74\40\144\x65\143\162\171\x70\164\151\156\x67\40\x69\x74\x20\x66\x69\162\x73\x74\56");
        Iy:
        return $this->nameId;
    }
    public function setNameId($px)
    {
        $this->nameId = $px;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto bM;
        }
        return TRUE;
        bM:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $Rh)
    {
        $Ij = new DOMDocument();
        $P2 = $Ij->createElement("\162\x6f\157\x74");
        $Ij->appendChild($P2);
        Utilities::addNameId($P2, $this->nameId);
        $px = $P2->firstChild;
        Utilities::getContainer()->debugMessage($px, "\x65\x6e\143\x72\x79\x70\x74");
        $mu = new XMLSecEnc();
        $mu->setNode($px);
        $mu->type = XMLSecEnc::Element;
        $dD = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $dD->generateSessionKey();
        $mu->encryptKey($Rh, $dD);
        $this->encryptedNameId = $mu->encryptNode($dD);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $Rh, array $ls = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto K7;
        }
        return;
        K7:
        $px = Utilities::decryptElement($this->encryptedNameId, $Rh, $ls);
        Utilities::getContainer()->debugMessage($px, "\144\x65\x63\x72\171\160\x74");
        $this->nameId = Utilities::parseNameId($px);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $Rh, array $ls = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto GU;
        }
        return;
        GU:
        $uB = TRUE;
        $Dx = $this->encryptedAttribute;
        foreach ($Dx as $kx) {
            $xQ = Utilities::decryptElement($kx->getElementsByTagName("\x45\x6e\143\x72\171\160\164\145\x64\104\141\x74\141")->item(0), $Rh, $ls);
            if ($xQ->hasAttribute("\x4e\x61\x6d\x65")) {
                goto MF;
            }
            throw new Exception("\x4d\151\x73\x73\151\156\x67\x20\156\141\x6d\145\40\157\x6e\x20\74\x73\141\x6d\154\x3a\x41\x74\164\x72\151\142\165\x74\145\76\x20\145\154\145\155\145\156\164\x2e");
            MF:
            $oR = $xQ->getAttribute("\x4e\x61\x6d\145");
            if ($xQ->hasAttribute("\x4e\x61\155\x65\x46\157\x72\155\141\x74")) {
                goto FW;
            }
            $ly = "\165\162\x6e\72\157\141\163\151\x73\72\x6e\x61\x6d\x65\x73\x3a\164\x63\72\x53\101\x4d\x4c\x3a\x32\x2e\x30\72\x61\164\164\x72\156\141\155\145\x2d\146\x6f\x72\x6d\141\164\72\165\x6e\x73\x70\145\143\151\146\x69\145\144";
            goto LZ;
            FW:
            $ly = $xQ->getAttribute("\116\x61\x6d\x65\x46\157\x72\155\x61\x74");
            LZ:
            if ($uB) {
                goto rz;
            }
            if (!($this->nameFormat !== $ly)) {
                goto PL;
            }
            $this->nameFormat = "\165\x72\x6e\x3a\x6f\x61\x73\x69\x73\72\x6e\x61\155\x65\163\x3a\164\143\x3a\123\x41\115\114\x3a\62\56\60\72\x61\x74\x74\x72\156\141\x6d\145\x2d\146\157\162\x6d\x61\164\72\165\x6e\163\160\145\143\151\146\151\145\144";
            PL:
            goto Ac;
            rz:
            $this->nameFormat = $ly;
            $uB = FALSE;
            Ac:
            if (array_key_exists($oR, $this->attributes)) {
                goto WO;
            }
            $this->attributes[$oR] = array();
            WO:
            $vK = Utilities::xpQuery($xQ, "\56\57\x73\141\x6d\x6c\x5f\141\x73\163\x65\x72\x74\x69\x6f\x6e\x3a\x41\x74\164\162\151\x62\165\164\x65\x56\x61\x6c\x75\x65");
            foreach ($vK as $s5) {
                $this->attributes[$oR][] = trim($s5->textContent);
                tn:
            }
            wJ:
            H3:
        }
        JO:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($N1)
    {
        $this->notBefore = $N1;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($OF)
    {
        $this->notOnOrAfter = $OF;
    }
    public function setEncryptedAttributes($VJ)
    {
        $this->requiredEncAttributes = $VJ;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $EL = NULL)
    {
        $this->validAudiences = $EL;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($wr)
    {
        $this->authnInstant = $wr;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($fC)
    {
        $this->sessionNotOnOrAfter = $fC;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($XO)
    {
        $this->sessionIndex = $XO;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto d5;
        }
        return $this->authnContextClassRef;
        d5:
        if (empty($this->authnContextDeclRef)) {
            goto RM;
        }
        return $this->authnContextDeclRef;
        RM:
        return NULL;
    }
    public function setAuthnContext($xF)
    {
        $this->setAuthnContextClassRef($xF);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($WX)
    {
        $this->authnContextClassRef = $WX;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $yA)
    {
        if (empty($this->authnContextDeclRef)) {
            goto An;
        }
        throw new Exception("\x41\165\164\x68\156\103\157\x6e\164\x65\x78\x74\104\145\143\x6c\122\145\x66\x20\151\163\x20\141\154\162\145\141\x64\171\x20\x72\x65\x67\151\163\x74\145\x72\x65\x64\41\x20\115\141\171\40\x6f\156\x6c\171\x20\x68\x61\166\x65\x20\145\151\x74\150\145\x72\40\x61\x20\104\x65\x63\x6c\40\157\x72\x20\141\40\104\145\143\154\122\145\x66\x2c\x20\x6e\x6f\164\x20\142\x6f\x74\150\x21");
        An:
        $this->authnContextDecl = $yA;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($QY)
    {
        if (empty($this->authnContextDecl)) {
            goto PT;
        }
        throw new Exception("\101\165\x74\150\156\x43\x6f\x6e\x74\145\x78\164\104\145\143\x6c\x20\x69\163\x20\x61\x6c\162\x65\141\x64\x79\x20\x72\x65\x67\151\163\x74\x65\x72\145\144\x21\40\x4d\x61\x79\x20\x6f\x6e\154\x79\x20\150\x61\166\145\40\145\x69\x74\x68\145\x72\x20\141\40\x44\145\x63\x6c\40\157\162\x20\x61\40\104\145\143\x6c\122\x65\x66\x2c\40\x6e\157\x74\40\142\157\164\x68\41");
        PT:
        $this->authnContextDeclRef = $QY;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($UQ)
    {
        $this->AuthenticatingAuthority = $UQ;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $Dx)
    {
        $this->attributes = $Dx;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($ly)
    {
        $this->nameFormat = $ly;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $dR)
    {
        $this->SubjectConfirmation = $dR;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $wp = NULL)
    {
        $this->signatureKey = $wp;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $sx = NULL)
    {
        $this->encryptionKey = $sx;
    }
    public function setCertificates(array $q3)
    {
        $this->certificates = $q3;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $RN = NULL)
    {
        if ($RN === NULL) {
            goto bv;
        }
        $wl = $RN->ownerDocument;
        goto l7;
        bv:
        $wl = new DOMDocument();
        $RN = $wl;
        l7:
        $P2 = $wl->createElementNS("\x75\x72\156\72\x6f\x61\x73\x69\x73\x3a\156\141\155\145\163\72\164\143\x3a\123\x41\115\114\72\62\56\60\72\141\x73\x73\x65\162\x74\x69\157\x6e", "\163\x61\x6d\154\72" . "\101\163\163\x65\162\164\x69\x6f\x6e");
        $RN->appendChild($P2);
        $P2->setAttributeNS("\165\162\156\72\157\141\x73\x69\163\x3a\156\x61\155\x65\163\x3a\164\x63\x3a\123\101\x4d\x4c\x3a\x32\x2e\60\x3a\x70\162\x6f\x74\157\143\x6f\x6c", "\163\141\x6d\x6c\160\x3a\x74\x6d\160", "\x74\155\160");
        $P2->removeAttributeNS("\x75\x72\x6e\72\157\x61\163\x69\x73\72\156\141\155\x65\163\72\164\143\72\x53\101\115\114\x3a\62\x2e\x30\x3a\160\x72\157\164\x6f\143\x6f\154", "\164\x6d\160");
        $P2->setAttributeNS("\150\x74\164\x70\72\57\x2f\x77\x77\167\56\x77\63\56\157\162\147\57\x32\60\60\61\57\x58\115\114\x53\143\x68\145\155\x61\55\x69\156\x73\164\x61\156\x63\145", "\x78\x73\x69\x3a\164\155\160", "\164\155\160");
        $P2->removeAttributeNS("\150\x74\164\160\x3a\x2f\57\167\167\x77\56\x77\x33\56\157\x72\147\x2f\x32\x30\60\61\x2f\x58\x4d\114\x53\143\x68\x65\x6d\x61\55\151\156\x73\x74\x61\x6e\x63\145", "\164\x6d\x70");
        $P2->setAttributeNS("\150\x74\164\160\72\57\57\x77\x77\x77\x2e\x77\x33\x2e\157\x72\147\x2f\x32\x30\x30\61\x2f\130\115\x4c\x53\x63\x68\145\155\x61", "\x78\163\x3a\164\155\160", "\164\155\x70");
        $P2->removeAttributeNS("\150\164\164\x70\x3a\57\57\167\x77\x77\x2e\x77\x33\56\157\162\147\x2f\62\60\x30\x31\x2f\130\x4d\x4c\x53\143\150\145\x6d\x61", "\164\x6d\160");
        $P2->setAttribute("\x49\104", $this->id);
        $P2->setAttribute("\x56\x65\x72\x73\x69\157\156", "\62\56\60");
        $P2->setAttribute("\111\163\163\x75\145\x49\x6e\163\x74\x61\x6e\164", gmdate("\x59\x2d\x6d\x2d\144\x5c\124\x48\x3a\151\72\163\x5c\x5a", $this->issueInstant));
        $u1 = Utilities::addString($P2, "\165\162\156\72\x6f\141\163\151\x73\x3a\x6e\141\x6d\145\x73\x3a\x74\143\72\123\x41\115\x4c\x3a\62\x2e\x30\72\141\x73\x73\145\162\164\x69\x6f\x6e", "\x73\x61\155\x6c\72\x49\163\163\x75\x65\162", $this->issuer);
        $this->addSubject($P2);
        $this->addConditions($P2);
        $this->addAuthnStatement($P2);
        if ($this->requiredEncAttributes == FALSE) {
            goto NF;
        }
        $this->addEncryptedAttributeStatement($P2);
        goto BM;
        NF:
        $this->addAttributeStatement($P2);
        BM:
        if (!($this->signatureKey !== NULL)) {
            goto aa;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $P2, $u1->nextSibling);
        aa:
        return $P2;
    }
    private function addSubject(DOMElement $P2)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto eV;
        }
        return;
        eV:
        $Aq = $P2->ownerDocument->createElementNS("\x75\162\156\72\157\x61\163\151\x73\x3a\x6e\141\x6d\x65\x73\72\164\143\72\123\101\115\x4c\72\62\56\60\x3a\x61\163\163\145\162\x74\x69\157\x6e", "\x73\141\155\x6c\x3a\x53\165\142\x6a\x65\x63\x74");
        $P2->appendChild($Aq);
        if ($this->encryptedNameId === NULL) {
            goto ls;
        }
        $Ds = $Aq->ownerDocument->createElementNS("\x75\162\x6e\x3a\157\141\x73\x69\x73\72\x6e\141\x6d\x65\x73\72\164\143\x3a\x53\x41\x4d\114\x3a\x32\56\60\x3a\141\163\x73\x65\162\x74\151\x6f\156", "\163\x61\x6d\154\x3a" . "\105\x6e\x63\162\171\x70\164\145\x64\x49\x44");
        $Aq->appendChild($Ds);
        $Ds->appendChild($Aq->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto lG;
        ls:
        Utilities::addNameId($Aq, $this->nameId);
        lG:
        foreach ($this->SubjectConfirmation as $JA) {
            $JA->toXML($Aq);
            jB:
        }
        l9:
    }
    private function addConditions(DOMElement $P2)
    {
        $wl = $P2->ownerDocument;
        $iS = $wl->createElementNS("\165\x72\156\x3a\157\141\163\x69\x73\72\156\141\155\145\163\72\x74\143\72\123\x41\x4d\x4c\x3a\x32\x2e\60\72\141\163\x73\145\162\164\151\157\x6e", "\163\x61\155\154\72\103\157\x6e\x64\x69\164\151\x6f\156\163");
        $P2->appendChild($iS);
        if (!($this->notBefore !== NULL)) {
            goto Jo;
        }
        $iS->setAttribute("\116\157\164\102\x65\146\157\162\x65", gmdate("\x59\55\x6d\x2d\144\x5c\124\x48\x3a\151\x3a\x73\134\132", $this->notBefore));
        Jo:
        if (!($this->notOnOrAfter !== NULL)) {
            goto NJ;
        }
        $iS->setAttribute("\x4e\x6f\x74\x4f\x6e\x4f\x72\x41\x66\164\145\162", gmdate("\131\55\x6d\x2d\144\134\124\110\x3a\151\72\163\134\132", $this->notOnOrAfter));
        NJ:
        if (!($this->validAudiences !== NULL)) {
            goto XM;
        }
        $M4 = $wl->createElementNS("\165\x72\156\72\157\x61\163\151\163\x3a\x6e\x61\x6d\145\163\72\164\x63\x3a\123\101\115\x4c\72\62\56\x30\72\x61\x73\163\x65\162\164\151\157\x6e", "\x73\x61\x6d\154\72\101\165\x64\x69\x65\156\143\145\x52\x65\163\164\x72\x69\x63\x74\x69\157\156");
        $iS->appendChild($M4);
        Utilities::addStrings($M4, "\165\x72\x6e\x3a\x6f\x61\163\151\x73\x3a\x6e\x61\155\145\163\72\x74\143\x3a\x53\101\x4d\114\x3a\62\x2e\x30\x3a\141\x73\x73\145\162\x74\151\x6f\156", "\x73\x61\155\x6c\x3a\x41\x75\x64\x69\145\x6e\143\145", FALSE, $this->validAudiences);
        XM:
    }
    private function addAuthnStatement(DOMElement $P2)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto ef;
        }
        return;
        ef:
        $wl = $P2->ownerDocument;
        $CC = $wl->createElementNS("\x75\x72\156\x3a\157\141\x73\x69\163\x3a\156\x61\x6d\145\x73\72\x74\143\72\123\101\115\x4c\72\x32\56\60\x3a\x61\163\x73\145\162\164\151\157\x6e", "\163\x61\x6d\x6c\72\101\x75\164\150\156\123\x74\141\x74\x65\x6d\145\x6e\x74");
        $P2->appendChild($CC);
        $CC->setAttribute("\x41\165\x74\x68\156\x49\x6e\x73\x74\141\x6e\164", gmdate("\131\x2d\155\x2d\x64\x5c\x54\110\72\151\72\163\x5c\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto xg;
        }
        $CC->setAttribute("\x53\145\x73\163\151\157\x6e\116\157\x74\x4f\x6e\x4f\x72\x41\x66\x74\145\162", gmdate("\x59\55\x6d\55\144\134\124\110\x3a\151\72\x73\134\132", $this->sessionNotOnOrAfter));
        xg:
        if (!($this->sessionIndex !== NULL)) {
            goto NR;
        }
        $CC->setAttribute("\x53\145\x73\163\x69\157\156\x49\156\144\145\170", $this->sessionIndex);
        NR:
        $us = $wl->createElementNS("\165\162\x6e\x3a\157\x61\x73\x69\x73\72\156\141\x6d\145\163\72\164\x63\x3a\123\101\115\114\x3a\x32\x2e\x30\x3a\x61\x73\163\x65\162\164\x69\x6f\156", "\163\141\x6d\154\72\x41\165\x74\150\156\x43\x6f\156\164\145\x78\x74");
        $CC->appendChild($us);
        if (empty($this->authnContextClassRef)) {
            goto Im;
        }
        Utilities::addString($us, "\x75\x72\156\x3a\x6f\141\x73\x69\163\72\156\x61\x6d\x65\163\x3a\x74\x63\72\x53\101\x4d\114\x3a\62\56\x30\72\141\x73\163\x65\x72\x74\151\x6f\x6e", "\x73\x61\x6d\x6c\x3a\101\x75\164\x68\156\x43\157\x6e\164\145\170\164\103\x6c\x61\x73\163\122\145\x66", $this->authnContextClassRef);
        Im:
        if (empty($this->authnContextDecl)) {
            goto yT;
        }
        $this->authnContextDecl->toXML($us);
        yT:
        if (empty($this->authnContextDeclRef)) {
            goto E4;
        }
        Utilities::addString($us, "\165\x72\156\72\x6f\141\x73\151\163\x3a\156\141\x6d\145\163\x3a\x74\143\x3a\x53\x41\x4d\x4c\x3a\x32\x2e\x30\72\x61\163\x73\145\x72\x74\151\157\x6e", "\x73\141\155\154\72\101\x75\x74\150\x6e\x43\157\x6e\x74\145\170\x74\x44\x65\143\x6c\x52\x65\x66", $this->authnContextDeclRef);
        E4:
        Utilities::addStrings($us, "\x75\162\156\x3a\x6f\141\163\151\x73\72\x6e\x61\x6d\145\x73\x3a\164\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\x61\x73\x73\x65\x72\164\151\x6f\x6e", "\163\141\155\154\72\101\165\164\x68\145\156\x74\x69\x63\x61\x74\x69\x6e\147\101\x75\x74\x68\157\x72\151\x74\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $P2)
    {
        if (!empty($this->attributes)) {
            goto fw;
        }
        return;
        fw:
        $wl = $P2->ownerDocument;
        $wz = $wl->createElementNS("\x75\162\x6e\72\157\x61\x73\x69\x73\x3a\156\x61\x6d\x65\x73\x3a\x74\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\60\x3a\x61\x73\x73\145\x72\x74\151\157\x6e", "\163\x61\x6d\154\72\x41\164\x74\162\x69\142\165\164\x65\x53\164\141\164\145\155\145\156\164");
        $P2->appendChild($wz);
        foreach ($this->attributes as $oR => $vK) {
            $xQ = $wl->createElementNS("\x75\162\156\x3a\x6f\141\x73\151\163\x3a\156\x61\155\145\163\x3a\164\143\x3a\123\101\x4d\114\72\62\x2e\x30\72\141\163\x73\145\x72\x74\x69\157\x6e", "\163\x61\155\x6c\x3a\x41\x74\x74\162\151\x62\x75\x74\x65");
            $wz->appendChild($xQ);
            $xQ->setAttribute("\116\141\155\145", $oR);
            if (!($this->nameFormat !== "\165\162\x6e\72\x6f\141\163\151\163\72\156\141\155\x65\x73\x3a\x74\143\72\123\101\115\114\72\x32\x2e\x30\72\x61\164\164\x72\x6e\141\155\145\x2d\146\157\x72\155\x61\x74\72\165\156\x73\x70\145\x63\x69\146\x69\145\x64")) {
                goto IT;
            }
            $xQ->setAttribute("\x4e\x61\x6d\x65\x46\x6f\x72\155\141\x74", $this->nameFormat);
            IT:
            foreach ($vK as $s5) {
                if (is_string($s5)) {
                    goto Pk;
                }
                if (is_int($s5)) {
                    goto Ql;
                }
                $n3 = NULL;
                goto tw;
                Pk:
                $n3 = "\x78\x73\x3a\x73\164\x72\x69\156\x67";
                goto tw;
                Ql:
                $n3 = "\x78\163\x3a\151\156\164\x65\147\145\162";
                tw:
                $xl = $wl->createElementNS("\165\x72\156\x3a\157\141\163\151\163\x3a\x6e\x61\155\145\163\x3a\164\x63\72\123\101\x4d\x4c\72\x32\x2e\x30\72\x61\x73\x73\x65\x72\x74\151\x6f\x6e", "\x73\141\x6d\154\72\x41\164\164\162\x69\x62\165\x74\x65\x56\x61\x6c\x75\145");
                $xQ->appendChild($xl);
                if (!($n3 !== NULL)) {
                    goto wK;
                }
                $xl->setAttributeNS("\150\164\164\160\x3a\57\x2f\167\x77\167\x2e\x77\x33\x2e\x6f\x72\x67\57\x32\60\x30\61\57\130\x4d\114\123\143\x68\x65\x6d\x61\x2d\x69\156\163\164\x61\x6e\143\x65", "\170\x73\151\72\164\x79\160\x65", $n3);
                wK:
                if (!is_null($s5)) {
                    goto cn;
                }
                $xl->setAttributeNS("\x68\x74\164\x70\x3a\57\x2f\167\x77\167\56\167\63\56\x6f\162\x67\57\x32\60\x30\x31\57\x58\115\x4c\123\x63\150\145\x6d\x61\55\x69\x6e\x73\164\x61\156\143\x65", "\x78\163\151\x3a\156\151\154", "\164\162\165\x65");
                cn:
                if ($s5 instanceof DOMNodeList) {
                    goto c0;
                }
                $xl->appendChild($wl->createTextNode($s5));
                goto bi;
                c0:
                $IO = 0;
                E7:
                if (!($IO < $s5->length)) {
                    goto Wa;
                }
                $fz = $wl->importNode($s5->item($IO), TRUE);
                $xl->appendChild($fz);
                oS:
                $IO++;
                goto E7;
                Wa:
                bi:
                J5:
            }
            M3:
            UO:
        }
        n5:
    }
    private function addEncryptedAttributeStatement(DOMElement $P2)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto Hl;
        }
        return;
        Hl:
        $wl = $P2->ownerDocument;
        $wz = $wl->createElementNS("\165\x72\156\72\157\141\x73\151\x73\x3a\156\141\x6d\x65\x73\x3a\164\x63\x3a\123\x41\115\114\72\x32\56\60\x3a\141\x73\x73\145\x72\164\151\157\x6e", "\x73\141\155\x6c\x3a\x41\x74\164\x72\x69\142\165\164\145\x53\164\141\164\145\155\145\156\x74");
        $P2->appendChild($wz);
        foreach ($this->attributes as $oR => $vK) {
            $bU = new DOMDocument();
            $xQ = $bU->createElementNS("\x75\162\156\x3a\157\x61\163\151\x73\72\x6e\x61\x6d\145\163\72\x74\143\x3a\123\x41\x4d\x4c\72\x32\56\x30\72\x61\163\163\x65\x72\164\x69\157\x6e", "\163\x61\155\154\72\101\x74\164\x72\x69\142\165\164\x65");
            $xQ->setAttribute("\x4e\141\x6d\145", $oR);
            $bU->appendChild($xQ);
            if (!($this->nameFormat !== "\165\162\156\72\x6f\141\163\x69\163\x3a\x6e\141\155\145\x73\x3a\x74\143\72\x53\101\115\114\x3a\x32\56\60\x3a\141\x74\x74\x72\x6e\141\155\x65\55\146\x6f\162\x6d\x61\x74\72\x75\x6e\x73\x70\x65\143\151\146\x69\145\144")) {
                goto tJ;
            }
            $xQ->setAttribute("\x4e\x61\155\145\x46\157\x72\155\x61\164", $this->nameFormat);
            tJ:
            foreach ($vK as $s5) {
                if (is_string($s5)) {
                    goto Wx;
                }
                if (is_int($s5)) {
                    goto Ts;
                }
                $n3 = NULL;
                goto fL;
                Wx:
                $n3 = "\x78\163\72\163\x74\x72\151\156\147";
                goto fL;
                Ts:
                $n3 = "\170\x73\x3a\151\x6e\164\145\x67\x65\x72";
                fL:
                $xl = $bU->createElementNS("\x75\x72\156\72\157\x61\x73\151\163\72\156\141\x6d\x65\163\x3a\164\x63\x3a\123\x41\115\114\72\62\x2e\x30\72\141\163\x73\x65\x72\164\x69\157\x6e", "\x73\141\x6d\x6c\72\x41\x74\164\x72\x69\142\165\x74\145\x56\141\154\x75\x65");
                $xQ->appendChild($xl);
                if (!($n3 !== NULL)) {
                    goto P_;
                }
                $xl->setAttributeNS("\150\164\164\x70\x3a\x2f\57\167\x77\167\56\167\63\56\157\x72\147\57\62\60\60\61\x2f\130\115\114\x53\143\x68\x65\155\141\55\x69\156\163\164\141\156\x63\145", "\x78\x73\x69\x3a\164\171\x70\145", $n3);
                P_:
                if ($s5 instanceof DOMNodeList) {
                    goto JF;
                }
                $xl->appendChild($bU->createTextNode($s5));
                goto q6;
                JF:
                $IO = 0;
                tH:
                if (!($IO < $s5->length)) {
                    goto t7;
                }
                $fz = $bU->importNode($s5->item($IO), TRUE);
                $xl->appendChild($fz);
                lK:
                $IO++;
                goto tH;
                t7:
                q6:
                dy:
            }
            fQ:
            $Ni = new XMLSecEnc();
            $Ni->setNode($bU->documentElement);
            $Ni->type = "\150\x74\164\x70\72\x2f\57\167\167\x77\56\167\x33\x2e\157\x72\x67\57\x32\60\x30\x31\57\60\64\x2f\170\x6d\154\145\x6e\143\43\105\x6c\x65\x6d\145\156\x74";
            $dD = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $dD->generateSessionKey();
            $Ni->encryptKey($this->encryptionKey, $dD);
            $U2 = $Ni->encryptNode($dD);
            $p5 = $wl->createElementNS("\165\x72\x6e\72\x6f\x61\163\x69\163\72\x6e\x61\155\x65\163\x3a\x74\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\x61\163\163\145\162\164\x69\x6f\156", "\x73\x61\x6d\154\72\x45\156\143\162\x79\160\164\x65\x64\101\x74\164\162\x69\x62\x75\164\x65");
            $wz->appendChild($p5);
            $jM = $wl->importNode($U2, TRUE);
            $p5->appendChild($jM);
            TG:
        }
        wx:
    }
}
