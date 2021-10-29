<?php


include_once "\x55\x74\151\x6c\151\x74\x69\x65\x73\x2e\x70\150\160";
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
    public function __construct(DOMElement $p3 = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\162\156\x3a\157\x61\163\x69\163\72\x6e\141\155\x65\x73\72\164\143\72\x53\x41\x4d\114\x3a\61\56\61\x3a\156\141\155\145\x69\144\x2d\x66\157\x72\x6d\x61\164\72\165\156\163\160\x65\x63\151\x66\x69\145\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($p3 === NULL)) {
            goto X9;
        }
        return;
        X9:
        if (!($p3->localName === "\105\x6e\143\x72\x79\x70\164\145\144\x41\x73\x73\145\162\164\x69\157\156")) {
            goto rx;
        }
        $kE = Utilities::xpQuery($p3, "\56\x2f\170\x65\156\143\x3a\105\156\x63\x72\x79\160\x74\x65\x64\104\141\164\141");
        $dk = Utilities::xpQuery($p3, "\x2e\x2f\x78\x65\x6e\x63\x3a\x45\x6e\x63\x72\x79\x70\x74\145\x64\x44\x61\x74\x61\57\144\163\72\113\x65\x79\111\156\146\157\x2f\x78\x65\156\x63\x3a\105\156\x63\162\x79\x70\x74\145\144\113\x65\x79");
        $Ei = '';
        if (empty($dk)) {
            goto iB;
        }
        $Ei = $dk[0]->firstChild->getAttribute("\101\154\x67\x6f\162\x69\x74\150\155");
        goto sf;
        iB:
        $dk = Utilities::xpQuery($p3, "\x2e\x2f\x78\145\156\143\72\x45\x6e\143\162\x79\160\164\145\x64\x4b\145\171\57\170\145\x6e\x63\72\105\x6e\x63\162\171\160\x74\x69\x6f\x6e\x4d\145\x74\150\x6f\x64");
        $Ei = $dk[0]->getAttribute("\101\x6c\x67\x6f\162\x69\164\x68\155");
        sf:
        $Qs = Utilities::getEncryptionAlgorithm($Ei);
        if (count($kE) === 0) {
            goto xl;
        }
        if (count($kE) > 1) {
            goto O7;
        }
        goto dB;
        xl:
        throw new Exception("\x4d\x69\163\x73\x69\x6e\147\40\145\x6e\143\x72\x79\x70\164\145\144\40\x64\141\x74\141\x20\x69\156\x20\74\163\141\155\154\x3a\x45\x6e\143\x72\x79\x70\164\145\144\101\163\x73\x65\162\164\151\x6f\x6e\x3e\56");
        goto dB;
        O7:
        throw new Exception("\115\x6f\x72\x65\40\x74\150\141\x6e\x20\x6f\x6e\145\x20\145\x6e\143\162\x79\160\x74\145\144\40\144\141\x74\x61\x20\145\154\145\155\x65\x6e\164\x20\x69\156\40\74\x73\x61\x6d\x6c\72\x45\156\x63\x72\171\160\164\x65\x64\x41\163\163\145\x72\164\151\157\156\76\x2e");
        dB:
        $vC = '';
        $vC = variable_get("\x6d\151\156\151\157\x72\x61\x6e\x67\145\137\163\x61\x6d\154\x5f\160\x72\x69\x76\141\x74\145\x5f\143\x65\x72\x74\151\146\x69\x63\141\x74\x65");
        $im = new XMLSecurityKey($Qs, array("\164\171\x70\x65" => "\x70\162\x69\x76\141\x74\x65"));
        $Hm = drupal_get_path("\155\157\144\165\x6c\x65", "\x6d\151\x6e\x69\157\x72\x61\x6e\x67\x65\x5f\x73\141\155\154");
        if ($vC != '') {
            goto DY;
        }
        $DM = $Hm . "\57\162\x65\163\157\x75\162\x63\x65\163\x2f\x73\x70\55\153\145\x79\56\153\x65\x79";
        goto EQ;
        DY:
        $DM = $Hm . "\x2f\x72\x65\163\157\165\x72\x63\x65\163\57\103\x75\x73\x74\x6f\155\x5f\120\x72\151\x76\141\164\145\137\x43\x65\x72\x74\x69\x66\x69\143\x61\164\145\x2e\153\x65\x79";
        EQ:
        $im->loadKey($DM, TRUE);
        $gt = new XMLSecurityKey($Qs, array("\164\171\160\145" => "\x70\162\151\x76\141\x74\x65"));
        $DB = $Hm . "\x2f\162\x65\x73\x6f\165\162\143\145\x73\57\x6d\151\x6e\x69\157\x72\141\156\x67\145\x5f\163\x70\137\160\162\151\166\137\x6b\145\171\x2e\x6b\145\171";
        $gt->loadKey($DB, TRUE);
        $Fp = array();
        $p3 = Utilities::decryptElement($kE[0], $im, $Fp, $gt);
        rx:
        if ($p3->hasAttribute("\x49\x44")) {
            goto NA;
        }
        throw new Exception("\115\x69\x73\163\x69\x6e\x67\x20\111\104\x20\141\164\x74\x72\x69\142\165\164\145\x20\x6f\156\40\x53\x41\x4d\114\x20\141\163\x73\x65\x72\164\x69\x6f\x6e\56");
        NA:
        $this->id = $p3->getAttribute("\111\x44");
        if (!($p3->getAttribute("\126\x65\x72\x73\x69\157\x6e") !== "\x32\56\x30")) {
            goto G9;
        }
        throw new Exception("\125\x6e\163\165\160\160\x6f\162\164\x65\x64\x20\x76\145\x72\163\151\157\156\72\x20" . $p3->getAttribute("\126\x65\x72\163\x69\x6f\x6e"));
        G9:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($p3->getAttribute("\x49\163\x73\165\x65\111\156\x73\x74\141\156\x74"));
        $JS = Utilities::xpQuery($p3, "\56\57\163\141\155\x6c\137\x61\163\163\145\x72\164\151\157\x6e\72\111\163\x73\165\145\162");
        if (!empty($JS)) {
            goto n9;
        }
        throw new Exception("\x4d\x69\163\x73\151\x6e\147\x20\74\163\x61\x6d\x6c\72\111\x73\x73\165\x65\162\x3e\x20\x69\156\40\x61\x73\x73\145\162\164\151\x6f\x6e\x2e");
        n9:
        $this->issuer = trim($JS[0]->textContent);
        $this->parseConditions($p3);
        $this->parseAuthnStatement($p3);
        $this->parseAttributes($p3);
        $this->parseEncryptedAttributes($p3);
        $this->parseSignature($p3);
        $this->parseSubject($p3);
    }
    private function parseSubject(DOMElement $p3)
    {
        $gO = Utilities::xpQuery($p3, "\56\x2f\163\141\155\154\137\141\x73\x73\145\162\164\151\157\156\x3a\123\x75\142\152\x65\143\x74");
        if (empty($gO)) {
            goto dy;
        }
        if (count($gO) > 1) {
            goto Yu;
        }
        goto wK;
        dy:
        return;
        goto wK;
        Yu:
        throw new Exception("\x4d\x6f\162\x65\x20\x74\x68\x61\156\x20\157\156\145\x20\74\163\x61\155\x6c\72\x53\165\142\x6a\x65\143\x74\76\40\151\156\40\74\163\x61\155\154\x3a\101\x73\163\x65\162\x74\x69\157\x6e\76\x2e");
        wK:
        $gO = $gO[0];
        $rq = Utilities::xpQuery($gO, "\x2e\x2f\163\x61\x6d\154\137\x61\x73\163\x65\x72\164\x69\157\156\x3a\x4e\x61\x6d\145\111\104\40\174\40\x2e\x2f\163\x61\x6d\x6c\137\x61\x73\x73\x65\x72\x74\151\157\x6e\72\x45\156\143\162\x79\x70\x74\145\x64\x49\104\x2f\x78\145\x6e\143\x3a\105\156\143\162\x79\x70\164\x65\144\x44\141\x74\x61");
        if (empty($rq)) {
            goto rs;
        }
        if (count($rq) > 1) {
            goto Y5;
        }
        goto H9;
        rs:
        throw new Exception("\115\x69\163\x73\x69\156\147\x20\74\x73\141\155\154\72\116\x61\155\x65\111\x44\76\x20\157\x72\40\x3c\163\141\x6d\x6c\x3a\105\156\143\162\x79\160\x74\145\x64\111\x44\x3e\x20\151\x6e\x20\x3c\163\x61\x6d\154\72\123\x75\142\152\x65\143\164\x3e\x2e");
        goto H9;
        Y5:
        throw new Exception("\x4d\x6f\x72\145\x20\x74\x68\x61\156\40\157\x6e\x65\40\x3c\163\141\x6d\154\72\x4e\x61\155\145\x49\104\x3e\x20\x6f\162\40\74\163\141\x6d\154\72\x45\x6e\143\162\x79\x70\x74\145\144\104\x3e\x20\151\156\x20\x3c\x73\141\x6d\x6c\72\123\165\142\152\145\143\164\76\56");
        H9:
        $rq = $rq[0];
        if ($rq->localName === "\105\x6e\x63\x72\x79\160\x74\x65\x64\x44\141\164\141") {
            goto Nd;
        }
        $this->nameId = Utilities::parseNameId($rq);
        goto oj;
        Nd:
        $this->encryptedNameId = $rq;
        oj:
    }
    private function parseConditions(DOMElement $p3)
    {
        $Kh = Utilities::xpQuery($p3, "\x2e\57\x73\141\x6d\x6c\x5f\141\163\163\x65\x72\x74\151\x6f\x6e\x3a\x43\157\156\x64\151\164\151\157\x6e\x73");
        if (empty($Kh)) {
            goto LL;
        }
        if (count($Kh) > 1) {
            goto VN;
        }
        goto g_;
        LL:
        return;
        goto g_;
        VN:
        throw new Exception("\115\x6f\x72\x65\x20\164\150\x61\156\x20\x6f\x6e\145\40\x3c\163\x61\x6d\154\x3a\x43\157\156\144\151\x74\x69\x6f\156\x73\76\x20\151\156\40\74\163\141\x6d\154\x3a\x41\x73\163\145\162\164\151\157\x6e\x3e\x2e");
        g_:
        $Kh = $Kh[0];
        if (!$Kh->hasAttribute("\116\x6f\164\x42\145\x66\x6f\x72\x65")) {
            goto j3;
        }
        $QK = Utilities::xsDateTimeToTimestamp($Kh->getAttribute("\x4e\x6f\x74\102\x65\146\157\162\145"));
        if (!($this->notBefore === NULL || $this->notBefore < $QK)) {
            goto FF;
        }
        $this->notBefore = $QK;
        FF:
        j3:
        if (!$Kh->hasAttribute("\116\157\164\117\x6e\x4f\x72\101\x66\x74\x65\162")) {
            goto EY;
        }
        $Jc = Utilities::xsDateTimeToTimestamp($Kh->getAttribute("\116\157\164\x4f\x6e\x4f\162\101\x66\164\145\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $Jc)) {
            goto hj;
        }
        $this->notOnOrAfter = $Jc;
        hj:
        EY:
        $OZ = $Kh->firstChild;
        Gd:
        if (!($OZ !== NULL)) {
            goto n0;
        }
        if (!$OZ instanceof DOMText) {
            goto jS;
        }
        goto yF;
        jS:
        if (!($OZ->namespaceURI !== "\165\x72\156\72\x6f\x61\163\151\x73\x3a\x6e\x61\x6d\145\x73\72\164\x63\x3a\123\x41\x4d\114\72\62\56\x30\72\141\x73\x73\x65\x72\x74\x69\157\x6e")) {
            goto Kc;
        }
        throw new Exception("\x55\156\x6b\156\x6f\167\156\40\x6e\x61\x6d\x65\163\x70\x61\143\145\40\157\x66\40\143\x6f\x6e\x64\151\164\151\157\156\x3a\x20" . var_export($OZ->namespaceURI, TRUE));
        Kc:
        switch ($OZ->localName) {
            case "\x41\x75\144\x69\x65\x6e\143\145\x52\145\163\164\x72\151\143\164\151\157\156":
                $zB = Utilities::extractStrings($OZ, "\x75\x72\156\x3a\157\x61\163\151\x73\72\x6e\141\155\145\x73\x3a\164\143\72\123\101\115\114\x3a\x32\56\x30\72\141\163\x73\145\162\164\x69\x6f\156", "\x41\165\144\151\x65\x6e\x63\145");
                if ($this->validAudiences === NULL) {
                    goto xM;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $zB);
                goto Rd;
                xM:
                $this->validAudiences = $zB;
                Rd:
                goto kp;
            case "\117\156\x65\124\151\155\145\125\x73\145":
                goto kp;
            case "\x50\162\x6f\x78\x79\122\x65\x73\x74\162\x69\143\164\151\x6f\156":
                goto kp;
            default:
                throw new Exception("\125\156\x6b\x6e\x6f\167\x6e\40\x63\157\x6e\x64\x69\x74\151\157\x6e\72\40" . var_export($OZ->localName, TRUE));
        }
        eY:
        kp:
        yF:
        $OZ = $OZ->nextSibling;
        goto Gd;
        n0:
    }
    private function parseAuthnStatement(DOMElement $p3)
    {
        $sW = Utilities::xpQuery($p3, "\56\x2f\163\x61\x6d\x6c\137\x61\x73\x73\x65\x72\164\151\x6f\156\72\101\165\164\150\156\x53\x74\141\x74\145\155\145\x6e\x74");
        if (empty($sW)) {
            goto ZE;
        }
        if (count($sW) > 1) {
            goto VJ;
        }
        goto RE;
        ZE:
        $this->authnInstant = NULL;
        return;
        goto RE;
        VJ:
        throw new Exception("\x4d\157\x72\x65\x20\164\x68\x61\164\40\157\x6e\x65\40\74\x73\x61\x6d\x6c\72\101\165\x74\150\156\123\x74\141\x74\145\x6d\x65\x6e\x74\76\40\151\156\40\74\163\141\x6d\x6c\x3a\101\163\163\145\x72\164\x69\x6f\x6e\x3e\40\156\x6f\x74\40\163\x75\x70\x70\157\162\x74\x65\144\x2e");
        RE:
        $W8 = $sW[0];
        if ($W8->hasAttribute("\x41\x75\x74\150\156\111\x6e\x73\164\141\156\x74")) {
            goto nw;
        }
        throw new Exception("\115\x69\163\163\x69\156\x67\40\x72\145\161\x75\x69\162\145\144\40\101\165\x74\x68\x6e\111\x6e\x73\x74\141\x6e\x74\x20\x61\x74\164\162\x69\x62\165\x74\x65\40\157\156\40\x3c\163\x61\155\x6c\72\101\165\164\150\156\123\x74\141\x74\x65\155\x65\x6e\164\x3e\x2e");
        nw:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($W8->getAttribute("\x41\165\x74\x68\156\x49\x6e\163\x74\141\x6e\164"));
        if (!$W8->hasAttribute("\x53\145\x73\x73\151\x6f\x6e\116\157\x74\x4f\156\117\x72\101\146\164\145\x72")) {
            goto yg;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($W8->getAttribute("\123\x65\163\163\x69\157\x6e\116\157\164\x4f\x6e\117\162\101\x66\164\x65\162"));
        yg:
        if (!$W8->hasAttribute("\123\145\163\x73\151\157\156\x49\156\x64\145\170")) {
            goto bO;
        }
        $this->sessionIndex = $W8->getAttribute("\123\x65\163\x73\151\x6f\156\x49\x6e\x64\x65\170");
        bO:
        $this->parseAuthnContext($W8);
    }
    private function parseAuthnContext(DOMElement $K6)
    {
        $Q1 = Utilities::xpQuery($K6, "\56\x2f\x73\141\155\154\137\141\163\x73\x65\x72\164\151\157\x6e\72\x41\165\164\150\x6e\x43\157\156\164\x65\170\x74");
        if (count($Q1) > 1) {
            goto Fe;
        }
        if (empty($Q1)) {
            goto Xn;
        }
        goto pC;
        Fe:
        throw new Exception("\x4d\157\162\145\x20\x74\150\x61\x6e\x20\x6f\x6e\145\40\74\163\x61\x6d\154\72\101\165\164\150\156\x43\x6f\156\x74\x65\x78\164\x3e\40\x69\x6e\40\74\x73\141\155\154\72\x41\x75\164\150\x6e\123\x74\x61\164\x65\155\145\x6e\164\x3e\56");
        goto pC;
        Xn:
        throw new Exception("\115\151\163\x73\x69\x6e\x67\40\x72\145\161\x75\151\x72\x65\x64\40\74\x73\x61\x6d\x6c\x3a\x41\165\x74\150\x6e\103\x6f\x6e\164\x65\170\x74\x3e\x20\151\156\x20\x3c\x73\141\x6d\x6c\x3a\101\x75\x74\150\x6e\x53\x74\x61\164\145\155\x65\156\x74\x3e\56");
        pC:
        $RR = $Q1[0];
        $Oq = Utilities::xpQuery($RR, "\56\57\x73\141\x6d\154\x5f\141\163\x73\x65\162\x74\151\x6f\x6e\72\101\x75\x74\150\x6e\x43\157\x6e\164\145\x78\164\x44\145\143\154\122\x65\146");
        if (count($Oq) > 1) {
            goto lJ;
        }
        if (count($Oq) === 1) {
            goto TU;
        }
        goto hB;
        lJ:
        throw new Exception("\x4d\x6f\162\145\x20\x74\150\x61\156\40\x6f\156\x65\40\74\163\x61\x6d\154\x3a\101\165\x74\150\x6e\103\x6f\156\164\x65\x78\x74\104\x65\x63\x6c\122\145\146\x3e\40\146\x6f\165\156\144\77");
        goto hB;
        TU:
        $this->setAuthnContextDeclRef(trim($Oq[0]->textContent));
        hB:
        $Et = Utilities::xpQuery($RR, "\x2e\x2f\163\141\x6d\x6c\x5f\x61\x73\x73\145\x72\164\151\x6f\x6e\72\x41\165\164\150\156\x43\157\156\x74\x65\x78\164\x44\x65\x63\154");
        if (count($Et) > 1) {
            goto GF;
        }
        if (count($Et) === 1) {
            goto hr;
        }
        goto a9;
        GF:
        throw new Exception("\x4d\x6f\x72\145\x20\x74\150\141\x6e\x20\157\156\x65\40\x3c\x73\141\x6d\x6c\72\x41\x75\x74\x68\x6e\103\x6f\x6e\164\x65\170\x74\x44\145\x63\x6c\76\x20\x66\157\x75\x6e\144\77");
        goto a9;
        hr:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($Et[0]));
        a9:
        $vZ = Utilities::xpQuery($RR, "\x2e\57\x73\141\155\154\137\141\163\163\x65\x72\164\x69\157\156\x3a\x41\x75\164\150\x6e\103\x6f\156\164\145\x78\164\x43\x6c\141\x73\163\x52\x65\146");
        if (count($vZ) > 1) {
            goto l4;
        }
        if (count($vZ) === 1) {
            goto ei;
        }
        goto MD;
        l4:
        throw new Exception("\x4d\157\162\145\x20\x74\150\141\x6e\x20\157\156\145\x20\x3c\x73\141\x6d\x6c\72\x41\x75\164\150\x6e\103\x6f\x6e\x74\145\170\x74\x43\154\x61\163\163\x52\x65\x66\76\x20\151\x6e\x20\x3c\163\x61\155\154\72\101\165\164\x68\x6e\103\157\156\164\145\170\x74\76\x2e");
        goto MD;
        ei:
        $this->setAuthnContextClassRef(trim($vZ[0]->textContent));
        MD:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto NC;
        }
        throw new Exception("\x4d\151\163\163\151\156\x67\40\x65\x69\164\150\145\162\x20\x3c\x73\x61\155\x6c\x3a\x41\165\164\150\156\x43\157\x6e\164\x65\x78\x74\x43\154\141\163\163\x52\x65\146\76\40\157\x72\x20\x3c\163\x61\x6d\154\x3a\101\x75\164\150\156\x43\x6f\x6e\x74\145\170\164\x44\145\x63\154\122\x65\x66\76\x20\x6f\162\40\74\x73\x61\x6d\154\72\x41\x75\x74\150\x6e\x43\x6f\156\164\x65\170\164\x44\x65\143\x6c\x3e");
        NC:
        $this->AuthenticatingAuthority = Utilities::extractStrings($RR, "\165\x72\x6e\72\157\x61\x73\x69\163\72\156\141\155\145\163\x3a\164\x63\x3a\123\101\x4d\x4c\x3a\62\x2e\60\72\x61\163\163\x65\162\164\151\x6f\x6e", "\x41\165\164\150\145\156\164\151\143\141\164\151\x6e\x67\101\165\x74\150\x6f\162\x69\164\171");
    }
    private function parseAttributes(DOMElement $p3)
    {
        $jb = TRUE;
        $NP = Utilities::xpQuery($p3, "\56\x2f\x73\141\x6d\154\x5f\141\x73\163\x65\x72\164\151\x6f\156\72\x41\x74\x74\162\151\142\165\x74\x65\123\x74\141\164\x65\x6d\x65\156\164\x2f\x73\x61\x6d\154\x5f\141\x73\x73\145\162\x74\x69\157\156\72\x41\x74\164\162\151\x62\165\164\145");
        foreach ($NP as $MB) {
            if ($MB->hasAttribute("\116\x61\x6d\x65")) {
                goto D1;
            }
            throw new Exception("\115\x69\163\163\151\156\x67\x20\156\141\x6d\x65\40\x6f\156\40\x3c\x73\x61\x6d\x6c\72\101\x74\x74\162\151\x62\165\164\x65\76\40\x65\x6c\145\155\x65\x6e\x74\56");
            D1:
            $wL = $MB->getAttribute("\x4e\x61\155\x65");
            if ($MB->hasAttribute("\x4e\x61\155\x65\x46\157\x72\155\141\x74")) {
                goto mI;
            }
            $g3 = "\x75\162\156\72\157\141\x73\x69\x73\x3a\156\x61\x6d\145\163\x3a\164\x63\x3a\x53\x41\115\x4c\x3a\x31\56\x31\x3a\156\x61\155\145\151\x64\x2d\146\x6f\x72\x6d\141\x74\x3a\165\x6e\x73\160\x65\x63\151\x66\x69\145\x64";
            goto oh;
            mI:
            $g3 = $MB->getAttribute("\116\x61\x6d\x65\x46\157\x72\155\x61\x74");
            oh:
            if ($jb) {
                goto G0;
            }
            if (!($this->nameFormat !== $g3)) {
                goto L4;
            }
            $this->nameFormat = "\x75\162\x6e\x3a\x6f\x61\x73\x69\x73\x3a\x6e\141\x6d\145\163\x3a\164\143\72\x53\101\115\x4c\72\x31\x2e\x31\x3a\156\x61\155\145\151\144\55\x66\157\162\x6d\x61\164\x3a\165\x6e\163\x70\145\x63\x69\x66\x69\x65\x64";
            L4:
            goto v4;
            G0:
            $this->nameFormat = $g3;
            $jb = FALSE;
            v4:
            if (array_key_exists($wL, $this->attributes)) {
                goto fY;
            }
            $this->attributes[$wL] = array();
            fY:
            $nJ = Utilities::xpQuery($MB, "\56\57\x73\x61\x6d\154\137\x61\163\163\x65\x72\164\x69\x6f\x6e\72\x41\164\164\x72\151\x62\165\164\x65\126\141\x6c\165\145");
            foreach ($nJ as $ar) {
                $this->attributes[$wL][] = trim($ar->textContent);
                UJ:
            }
            Es:
            vw:
        }
        Lj:
    }
    private function parseEncryptedAttributes(DOMElement $p3)
    {
        $this->encryptedAttribute = Utilities::xpQuery($p3, "\x2e\57\163\141\x6d\x6c\x5f\x61\x73\x73\145\162\x74\x69\x6f\x6e\72\101\164\x74\x72\x69\x62\x75\164\x65\x53\x74\x61\x74\x65\x6d\145\x6e\164\x2f\163\x61\x6d\x6c\137\141\x73\x73\x65\162\164\151\157\156\x3a\105\x6e\143\x72\171\x70\164\x65\x64\101\164\164\x72\151\x62\165\x74\145");
    }
    private function parseSignature(DOMElement $p3)
    {
        $ja = Utilities::validateElement($p3);
        if (!($ja !== FALSE)) {
            goto VO;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $ja["\x43\145\x72\x74\x69\146\151\x63\141\164\x65\163"];
        $this->signatureData = $ja;
        VO:
    }
    public function validate(XMLSecurityKey $im)
    {
        if (!($this->signatureData === NULL)) {
            goto Ao;
        }
        return FALSE;
        Ao:
        Utilities::validateSignature($this->signatureData, $im);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($vv)
    {
        $this->id = $vv;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($gd)
    {
        $this->issueInstant = $gd;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($JS)
    {
        $this->issuer = $JS;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto cT;
        }
        throw new Exception("\x41\164\x74\x65\155\x70\x74\145\x64\40\x74\157\x20\162\x65\x74\162\x69\145\x76\145\40\x65\x6e\x63\x72\171\160\164\145\144\40\116\141\155\145\x49\104\x20\167\x69\164\x68\157\x75\164\x20\x64\145\x63\x72\171\x70\164\x69\x6e\x67\x20\x69\x74\40\x66\151\162\163\x74\x2e");
        cT:
        return $this->nameId;
    }
    public function setNameId($rq)
    {
        $this->nameId = $rq;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto cx;
        }
        return TRUE;
        cx:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $im)
    {
        $Q6 = new DOMDocument();
        $QR = $Q6->createElement("\162\157\157\164");
        $Q6->appendChild($QR);
        Utilities::addNameId($QR, $this->nameId);
        $rq = $QR->firstChild;
        Utilities::getContainer()->debugMessage($rq, "\x65\x6e\143\x72\x79\160\x74");
        $FQ = new XMLSecEnc();
        $FQ->setNode($rq);
        $FQ->type = XMLSecEnc::Element;
        $Tl = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $Tl->generateSessionKey();
        $FQ->encryptKey($im, $Tl);
        $this->encryptedNameId = $FQ->encryptNode($Tl);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $im, array $Fp = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto cP;
        }
        return;
        cP:
        $rq = Utilities::decryptElement($this->encryptedNameId, $im, $Fp);
        Utilities::getContainer()->debugMessage($rq, "\144\x65\x63\162\x79\160\x74");
        $this->nameId = Utilities::parseNameId($rq);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $im, array $Fp = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto xi;
        }
        return;
        xi:
        $jb = TRUE;
        $NP = $this->encryptedAttribute;
        foreach ($NP as $Di) {
            $MB = Utilities::decryptElement($Di->getElementsByTagName("\105\156\x63\x72\x79\x70\164\145\x64\x44\141\x74\x61")->item(0), $im, $Fp);
            if ($MB->hasAttribute("\x4e\x61\x6d\x65")) {
                goto HG;
            }
            throw new Exception("\x4d\151\x73\x73\x69\156\x67\x20\x6e\141\x6d\145\40\x6f\x6e\x20\74\x73\x61\155\154\72\101\164\164\162\151\142\165\x74\x65\x3e\x20\145\x6c\145\x6d\145\x6e\x74\x2e");
            HG:
            $wL = $MB->getAttribute("\x4e\x61\155\145");
            if ($MB->hasAttribute("\116\141\x6d\145\106\157\x72\x6d\141\164")) {
                goto uP;
            }
            $g3 = "\165\x72\x6e\x3a\x6f\141\x73\x69\x73\72\156\x61\x6d\x65\x73\x3a\164\143\72\123\101\x4d\x4c\72\62\56\x30\x3a\141\164\x74\x72\156\141\155\x65\55\x66\x6f\162\155\x61\164\72\165\x6e\163\x70\145\143\151\146\x69\x65\144";
            goto qT;
            uP:
            $g3 = $MB->getAttribute("\116\141\155\x65\106\x6f\162\x6d\141\x74");
            qT:
            if ($jb) {
                goto u1;
            }
            if (!($this->nameFormat !== $g3)) {
                goto ay;
            }
            $this->nameFormat = "\x75\162\x6e\x3a\x6f\x61\163\x69\163\x3a\x6e\x61\x6d\145\x73\x3a\x74\143\x3a\123\101\115\x4c\72\x32\x2e\60\x3a\141\164\164\162\156\x61\155\x65\55\146\157\162\x6d\141\164\72\165\156\x73\160\145\143\151\x66\151\x65\144";
            ay:
            goto N7;
            u1:
            $this->nameFormat = $g3;
            $jb = FALSE;
            N7:
            if (array_key_exists($wL, $this->attributes)) {
                goto pF;
            }
            $this->attributes[$wL] = array();
            pF:
            $nJ = Utilities::xpQuery($MB, "\56\57\x73\141\155\x6c\x5f\141\163\x73\x65\162\164\151\157\156\72\101\x74\164\x72\151\x62\165\164\x65\126\141\154\x75\x65");
            foreach ($nJ as $ar) {
                $this->attributes[$wL][] = trim($ar->textContent);
                S7:
            }
            i3:
            dE:
        }
        sQ:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($QK)
    {
        $this->notBefore = $QK;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($Jc)
    {
        $this->notOnOrAfter = $Jc;
    }
    public function setEncryptedAttributes($tU)
    {
        $this->requiredEncAttributes = $tU;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $Xf = NULL)
    {
        $this->validAudiences = $Xf;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($de)
    {
        $this->authnInstant = $de;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($Bh)
    {
        $this->sessionNotOnOrAfter = $Bh;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($u2)
    {
        $this->sessionIndex = $u2;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto Ty;
        }
        return $this->authnContextClassRef;
        Ty:
        if (empty($this->authnContextDeclRef)) {
            goto eQ;
        }
        return $this->authnContextDeclRef;
        eQ:
        return NULL;
    }
    public function setAuthnContext($je)
    {
        $this->setAuthnContextClassRef($je);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($tm)
    {
        $this->authnContextClassRef = $tm;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $iJ)
    {
        if (empty($this->authnContextDeclRef)) {
            goto rJ;
        }
        throw new Exception("\101\165\x74\150\156\x43\x6f\156\164\x65\x78\x74\104\x65\143\x6c\x52\x65\146\x20\151\x73\40\141\x6c\162\x65\141\144\x79\x20\x72\x65\147\151\163\164\145\x72\x65\144\x21\40\115\141\x79\40\x6f\x6e\x6c\x79\40\x68\141\x76\145\40\x65\x69\164\x68\145\x72\x20\141\x20\104\145\143\x6c\x20\x6f\x72\40\141\40\104\x65\x63\x6c\122\x65\x66\x2c\40\156\x6f\x74\40\142\157\164\x68\41");
        rJ:
        $this->authnContextDecl = $iJ;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($OD)
    {
        if (empty($this->authnContextDecl)) {
            goto jT;
        }
        throw new Exception("\x41\x75\x74\150\x6e\x43\x6f\x6e\164\145\170\x74\x44\145\143\154\x20\x69\163\x20\x61\154\162\145\x61\144\x79\40\x72\x65\147\x69\163\164\x65\162\x65\x64\41\40\115\141\x79\x20\x6f\x6e\x6c\x79\x20\x68\x61\166\145\40\x65\151\x74\150\x65\162\x20\141\40\104\145\x63\x6c\40\157\x72\40\141\x20\x44\145\143\x6c\x52\x65\146\54\x20\156\x6f\x74\40\x62\157\x74\x68\x21");
        jT:
        $this->authnContextDeclRef = $OD;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($AB)
    {
        $this->AuthenticatingAuthority = $AB;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $NP)
    {
        $this->attributes = $NP;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($g3)
    {
        $this->nameFormat = $g3;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $a4)
    {
        $this->SubjectConfirmation = $a4;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $yv = NULL)
    {
        $this->signatureKey = $yv;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $ab = NULL)
    {
        $this->encryptionKey = $ab;
    }
    public function setCertificates(array $MH)
    {
        $this->certificates = $MH;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $dh = NULL)
    {
        if ($dh === NULL) {
            goto bY;
        }
        $RJ = $dh->ownerDocument;
        goto Hf;
        bY:
        $RJ = new DOMDocument();
        $dh = $RJ;
        Hf:
        $QR = $RJ->createElementNS("\x75\162\156\72\157\141\x73\x69\x73\72\x6e\x61\155\x65\163\72\x74\x63\x3a\x53\x41\x4d\x4c\72\62\56\60\x3a\141\163\163\145\x72\x74\x69\x6f\156", "\x73\x61\155\x6c\x3a" . "\101\163\163\145\162\x74\x69\157\x6e");
        $dh->appendChild($QR);
        $QR->setAttributeNS("\165\162\156\x3a\157\141\x73\151\x73\72\x6e\x61\x6d\x65\x73\x3a\164\143\72\123\x41\x4d\x4c\x3a\62\x2e\60\72\x70\x72\157\164\157\x63\157\154", "\163\x61\155\154\x70\x3a\x74\155\160", "\164\155\160");
        $QR->removeAttributeNS("\165\162\156\x3a\157\141\x73\151\x73\72\x6e\x61\x6d\145\x73\72\x74\x63\72\x53\101\x4d\114\72\x32\x2e\x30\x3a\160\x72\x6f\x74\157\143\157\154", "\x74\155\x70");
        $QR->setAttributeNS("\150\164\x74\x70\72\57\57\167\167\x77\x2e\167\63\56\x6f\x72\x67\x2f\x32\60\x30\61\x2f\x58\x4d\x4c\x53\x63\x68\145\x6d\141\55\x69\x6e\163\164\x61\x6e\x63\145", "\170\163\151\72\x74\155\x70", "\x74\x6d\x70");
        $QR->removeAttributeNS("\x68\164\164\x70\x3a\57\57\167\167\167\56\167\63\x2e\x6f\162\x67\57\62\x30\x30\61\x2f\130\x4d\x4c\x53\x63\x68\145\x6d\x61\x2d\151\x6e\x73\x74\141\156\x63\x65", "\x74\x6d\160");
        $QR->setAttributeNS("\x68\x74\164\160\72\x2f\57\x77\167\167\x2e\x77\63\x2e\157\162\x67\57\x32\x30\x30\61\57\130\x4d\x4c\x53\x63\150\x65\x6d\x61", "\170\x73\x3a\164\155\x70", "\164\x6d\160");
        $QR->removeAttributeNS("\x68\164\164\x70\72\57\57\167\x77\167\56\x77\x33\x2e\x6f\x72\x67\x2f\x32\60\x30\x31\x2f\130\115\x4c\123\143\150\x65\155\x61", "\x74\155\x70");
        $QR->setAttribute("\x49\x44", $this->id);
        $QR->setAttribute("\126\145\162\163\x69\x6f\156", "\62\56\60");
        $QR->setAttribute("\111\x73\163\x75\145\x49\x6e\x73\x74\x61\x6e\x74", gmdate("\x59\x2d\155\x2d\x64\134\124\110\x3a\151\x3a\x73\x5c\132", $this->issueInstant));
        $JS = Utilities::addString($QR, "\165\162\x6e\72\x6f\141\163\151\163\x3a\x6e\x61\x6d\145\163\x3a\164\143\x3a\x53\101\115\x4c\x3a\x32\56\60\72\141\x73\163\x65\162\164\151\157\156", "\x73\x61\x6d\154\72\111\163\x73\x75\145\162", $this->issuer);
        $this->addSubject($QR);
        $this->addConditions($QR);
        $this->addAuthnStatement($QR);
        if ($this->requiredEncAttributes == FALSE) {
            goto PN;
        }
        $this->addEncryptedAttributeStatement($QR);
        goto Sb;
        PN:
        $this->addAttributeStatement($QR);
        Sb:
        if (!($this->signatureKey !== NULL)) {
            goto Ab;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $QR, $JS->nextSibling);
        Ab:
        return $QR;
    }
    private function addSubject(DOMElement $QR)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto Pg;
        }
        return;
        Pg:
        $gO = $QR->ownerDocument->createElementNS("\x75\162\x6e\72\157\x61\163\x69\163\72\156\x61\x6d\x65\163\72\164\x63\x3a\123\101\115\114\x3a\62\56\x30\72\x61\x73\163\145\x72\164\151\157\156", "\163\141\x6d\154\72\x53\x75\x62\x6a\x65\143\x74");
        $QR->appendChild($gO);
        if ($this->encryptedNameId === NULL) {
            goto b8;
        }
        $Gh = $gO->ownerDocument->createElementNS("\165\162\156\72\x6f\x61\163\x69\x73\x3a\156\141\x6d\145\163\x3a\x74\143\72\123\x41\x4d\x4c\x3a\62\x2e\x30\72\141\163\163\145\x72\x74\151\157\156", "\163\x61\155\x6c\72" . "\105\x6e\143\x72\x79\160\x74\x65\144\x49\104");
        $gO->appendChild($Gh);
        $Gh->appendChild($gO->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto bZ;
        b8:
        Utilities::addNameId($gO, $this->nameId);
        bZ:
        foreach ($this->SubjectConfirmation as $Gv) {
            $Gv->toXML($gO);
            Gf:
        }
        Qd:
    }
    private function addConditions(DOMElement $QR)
    {
        $RJ = $QR->ownerDocument;
        $Kh = $RJ->createElementNS("\165\x72\156\72\157\141\163\151\163\x3a\156\141\155\x65\x73\72\164\143\x3a\x53\x41\x4d\114\x3a\62\56\60\x3a\141\x73\x73\x65\x72\164\151\x6f\x6e", "\163\141\x6d\154\x3a\103\x6f\156\144\x69\x74\151\x6f\x6e\x73");
        $QR->appendChild($Kh);
        if (!($this->notBefore !== NULL)) {
            goto n4;
        }
        $Kh->setAttribute("\x4e\157\x74\102\x65\x66\157\x72\145", gmdate("\131\55\x6d\55\144\x5c\x54\110\72\x69\x3a\163\134\x5a", $this->notBefore));
        n4:
        if (!($this->notOnOrAfter !== NULL)) {
            goto ZP;
        }
        $Kh->setAttribute("\x4e\157\x74\x4f\156\x4f\x72\101\x66\x74\x65\162", gmdate("\131\55\x6d\x2d\144\x5c\124\110\72\151\x3a\x73\134\132", $this->notOnOrAfter));
        ZP:
        if (!($this->validAudiences !== NULL)) {
            goto Fq;
        }
        $i_ = $RJ->createElementNS("\165\162\x6e\x3a\157\x61\x73\151\163\72\x6e\x61\155\145\163\x3a\164\x63\x3a\x53\x41\x4d\x4c\72\x32\56\60\72\141\x73\x73\145\x72\164\x69\157\x6e", "\163\x61\155\154\72\101\165\x64\151\x65\156\x63\x65\x52\x65\x73\164\162\151\x63\x74\x69\157\156");
        $Kh->appendChild($i_);
        Utilities::addStrings($i_, "\x75\162\x6e\72\157\x61\x73\x69\x73\72\156\x61\x6d\x65\x73\x3a\x74\x63\72\123\x41\115\114\72\x32\56\60\72\x61\163\x73\x65\162\164\151\x6f\156", "\x73\141\x6d\x6c\72\101\x75\x64\x69\x65\156\x63\x65", FALSE, $this->validAudiences);
        Fq:
    }
    private function addAuthnStatement(DOMElement $QR)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto RX;
        }
        return;
        RX:
        $RJ = $QR->ownerDocument;
        $K6 = $RJ->createElementNS("\165\162\x6e\72\157\141\163\151\163\72\156\141\x6d\145\x73\72\164\x63\72\x53\x41\115\114\x3a\62\x2e\x30\72\141\x73\163\x65\162\164\151\x6f\156", "\x73\x61\x6d\154\72\x41\165\x74\x68\156\x53\x74\x61\164\x65\x6d\x65\x6e\164");
        $QR->appendChild($K6);
        $K6->setAttribute("\101\x75\164\150\x6e\111\156\163\x74\141\156\x74", gmdate("\131\55\x6d\55\x64\x5c\x54\x48\x3a\151\72\163\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto mA;
        }
        $K6->setAttribute("\123\145\x73\163\151\x6f\156\x4e\157\x74\x4f\x6e\x4f\x72\x41\x66\164\x65\162", gmdate("\x59\x2d\x6d\x2d\144\134\x54\x48\x3a\x69\x3a\163\134\x5a", $this->sessionNotOnOrAfter));
        mA:
        if (!($this->sessionIndex !== NULL)) {
            goto fq;
        }
        $K6->setAttribute("\123\x65\x73\x73\151\157\156\x49\156\x64\145\x78", $this->sessionIndex);
        fq:
        $RR = $RJ->createElementNS("\165\162\156\x3a\157\141\163\x69\x73\x3a\156\x61\x6d\145\x73\x3a\x74\143\72\123\x41\x4d\x4c\72\x32\x2e\x30\72\x61\163\x73\x65\162\x74\151\157\x6e", "\x73\x61\x6d\x6c\72\101\x75\x74\x68\156\x43\157\156\x74\x65\x78\x74");
        $K6->appendChild($RR);
        if (empty($this->authnContextClassRef)) {
            goto wl;
        }
        Utilities::addString($RR, "\x75\162\x6e\72\x6f\141\x73\151\163\72\x6e\141\155\145\163\72\x74\143\72\123\x41\x4d\x4c\72\x32\56\60\x3a\141\163\x73\145\162\x74\x69\x6f\156", "\163\x61\x6d\154\x3a\101\x75\164\x68\156\x43\x6f\156\x74\145\x78\164\103\x6c\141\x73\x73\122\145\x66", $this->authnContextClassRef);
        wl:
        if (empty($this->authnContextDecl)) {
            goto pB;
        }
        $this->authnContextDecl->toXML($RR);
        pB:
        if (empty($this->authnContextDeclRef)) {
            goto Un;
        }
        Utilities::addString($RR, "\165\162\x6e\x3a\157\x61\163\x69\163\72\x6e\x61\x6d\x65\x73\72\164\143\x3a\x53\101\x4d\114\72\62\56\60\x3a\x61\163\163\145\x72\x74\151\157\x6e", "\x73\x61\x6d\x6c\x3a\101\x75\164\x68\x6e\103\157\x6e\x74\145\x78\x74\104\x65\143\x6c\122\145\146", $this->authnContextDeclRef);
        Un:
        Utilities::addStrings($RR, "\165\162\156\72\x6f\x61\x73\x69\163\72\x6e\141\155\145\163\72\x74\143\72\123\101\115\x4c\x3a\x32\56\x30\x3a\x61\163\x73\145\x72\x74\x69\157\x6e", "\163\x61\x6d\154\72\101\165\x74\x68\x65\x6e\164\x69\x63\x61\x74\151\x6e\147\x41\165\x74\x68\x6f\x72\x69\x74\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $QR)
    {
        if (!empty($this->attributes)) {
            goto IC;
        }
        return;
        IC:
        $RJ = $QR->ownerDocument;
        $hX = $RJ->createElementNS("\165\x72\x6e\x3a\x6f\x61\x73\151\x73\x3a\156\141\x6d\145\163\72\x74\x63\72\123\101\115\114\x3a\x32\x2e\x30\72\141\163\x73\145\x72\x74\x69\157\156", "\163\141\x6d\x6c\72\x41\164\x74\x72\x69\x62\165\x74\x65\x53\164\141\164\x65\x6d\145\156\164");
        $QR->appendChild($hX);
        foreach ($this->attributes as $wL => $nJ) {
            $MB = $RJ->createElementNS("\x75\x72\x6e\x3a\157\x61\x73\x69\163\x3a\x6e\141\x6d\x65\x73\x3a\x74\x63\72\x53\101\x4d\114\x3a\62\x2e\60\72\x61\x73\x73\x65\x72\x74\x69\157\156", "\x73\141\155\x6c\x3a\x41\x74\x74\162\151\x62\165\164\x65");
            $hX->appendChild($MB);
            $MB->setAttribute("\116\x61\155\145", $wL);
            if (!($this->nameFormat !== "\x75\x72\x6e\72\157\x61\x73\x69\x73\72\156\141\x6d\145\x73\72\164\x63\x3a\x53\x41\x4d\114\x3a\62\56\60\x3a\x61\x74\164\162\156\141\x6d\145\55\x66\x6f\x72\x6d\x61\164\x3a\165\x6e\163\x70\x65\x63\x69\x66\x69\145\144")) {
                goto QA;
            }
            $MB->setAttribute("\116\141\155\x65\106\x6f\x72\155\x61\164", $this->nameFormat);
            QA:
            foreach ($nJ as $ar) {
                if (is_string($ar)) {
                    goto mm;
                }
                if (is_int($ar)) {
                    goto K8;
                }
                $S5 = NULL;
                goto du;
                mm:
                $S5 = "\x78\x73\72\x73\x74\x72\151\156\147";
                goto du;
                K8:
                $S5 = "\170\163\x3a\151\x6e\x74\145\x67\x65\162";
                du:
                $Kw = $RJ->createElementNS("\x75\x72\156\72\x6f\x61\x73\151\x73\x3a\156\x61\155\145\x73\72\x74\x63\x3a\x53\101\x4d\114\72\x32\56\x30\72\141\x73\163\x65\x72\164\x69\157\156", "\163\141\155\154\72\x41\164\x74\x72\151\x62\x75\164\x65\x56\141\x6c\x75\x65");
                $MB->appendChild($Kw);
                if (!($S5 !== NULL)) {
                    goto Kg;
                }
                $Kw->setAttributeNS("\x68\164\164\160\72\x2f\57\167\167\x77\x2e\x77\63\56\x6f\162\147\57\x32\x30\x30\61\x2f\130\115\114\x53\x63\x68\x65\155\x61\55\151\156\x73\164\x61\156\x63\x65", "\170\163\x69\x3a\x74\171\x70\x65", $S5);
                Kg:
                if (!is_null($ar)) {
                    goto SP;
                }
                $Kw->setAttributeNS("\x68\x74\164\160\x3a\57\57\x77\167\x77\x2e\x77\x33\56\x6f\x72\147\57\x32\60\x30\61\57\130\x4d\x4c\123\143\150\145\x6d\141\55\x69\156\x73\164\x61\x6e\143\145", "\170\163\151\72\x6e\x69\x6c", "\x74\162\x75\145");
                SP:
                if ($ar instanceof DOMNodeList) {
                    goto S1;
                }
                $Kw->appendChild($RJ->createTextNode($ar));
                goto S2;
                S1:
                $QP = 0;
                w1:
                if (!($QP < $ar->length)) {
                    goto w4;
                }
                $OZ = $RJ->importNode($ar->item($QP), TRUE);
                $Kw->appendChild($OZ);
                Tc:
                $QP++;
                goto w1;
                w4:
                S2:
                XY:
            }
            WZ:
            f3:
        }
        ev:
    }
    private function addEncryptedAttributeStatement(DOMElement $QR)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto l0;
        }
        return;
        l0:
        $RJ = $QR->ownerDocument;
        $hX = $RJ->createElementNS("\165\162\x6e\x3a\x6f\141\x73\x69\163\72\156\x61\155\x65\163\72\164\x63\72\x53\x41\115\x4c\x3a\x32\56\x30\x3a\x61\x73\163\145\x72\x74\151\x6f\x6e", "\163\x61\x6d\154\x3a\x41\x74\164\162\x69\142\165\x74\x65\x53\164\141\164\x65\155\x65\x6e\x74");
        $QR->appendChild($hX);
        foreach ($this->attributes as $wL => $nJ) {
            $Vo = new DOMDocument();
            $MB = $Vo->createElementNS("\165\x72\x6e\x3a\157\141\x73\151\163\72\x6e\141\x6d\x65\163\72\x74\143\x3a\123\101\115\114\72\x32\x2e\60\72\141\x73\163\145\x72\164\x69\157\156", "\163\141\155\154\72\x41\x74\x74\x72\151\x62\165\x74\x65");
            $MB->setAttribute("\116\141\155\145", $wL);
            $Vo->appendChild($MB);
            if (!($this->nameFormat !== "\165\x72\156\72\157\141\x73\151\163\72\x6e\141\155\x65\163\72\164\x63\x3a\x53\x41\x4d\114\72\62\x2e\x30\x3a\x61\x74\x74\162\x6e\141\155\145\x2d\146\157\x72\155\141\x74\x3a\x75\156\x73\160\145\143\151\146\x69\x65\x64")) {
                goto cM;
            }
            $MB->setAttribute("\x4e\141\155\x65\106\157\162\x6d\141\164", $this->nameFormat);
            cM:
            foreach ($nJ as $ar) {
                if (is_string($ar)) {
                    goto hO;
                }
                if (is_int($ar)) {
                    goto ds;
                }
                $S5 = NULL;
                goto lL;
                hO:
                $S5 = "\x78\163\72\x73\x74\162\151\156\x67";
                goto lL;
                ds:
                $S5 = "\170\163\x3a\x69\x6e\x74\x65\x67\145\x72";
                lL:
                $Kw = $Vo->createElementNS("\165\x72\156\x3a\x6f\141\x73\151\x73\72\x6e\x61\x6d\x65\x73\72\164\x63\x3a\x53\x41\115\x4c\72\62\x2e\60\72\141\163\163\145\x72\164\151\x6f\x6e", "\163\141\155\154\72\101\164\x74\162\x69\142\165\x74\x65\126\x61\154\x75\x65");
                $MB->appendChild($Kw);
                if (!($S5 !== NULL)) {
                    goto fO;
                }
                $Kw->setAttributeNS("\150\x74\x74\x70\72\x2f\x2f\x77\x77\x77\56\167\63\x2e\x6f\x72\147\x2f\62\60\60\x31\57\x58\x4d\114\x53\x63\150\145\155\141\x2d\x69\156\x73\x74\141\x6e\143\x65", "\x78\x73\151\72\x74\x79\160\145", $S5);
                fO:
                if ($ar instanceof DOMNodeList) {
                    goto bw;
                }
                $Kw->appendChild($Vo->createTextNode($ar));
                goto Km;
                bw:
                $QP = 0;
                hQ:
                if (!($QP < $ar->length)) {
                    goto ki;
                }
                $OZ = $Vo->importNode($ar->item($QP), TRUE);
                $Kw->appendChild($OZ);
                xm:
                $QP++;
                goto hQ;
                ki:
                Km:
                Wq:
            }
            bq:
            $zl = new XMLSecEnc();
            $zl->setNode($Vo->documentElement);
            $zl->type = "\150\x74\164\160\72\57\57\167\x77\167\56\x77\x33\56\x6f\x72\x67\57\x32\x30\x30\x31\57\x30\x34\x2f\170\155\154\145\156\143\x23\105\x6c\x65\x6d\145\x6e\x74";
            $Tl = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $Tl->generateSessionKey();
            $zl->encryptKey($this->encryptionKey, $Tl);
            $bq = $zl->encryptNode($Tl);
            $k3 = $RJ->createElementNS("\x75\162\156\72\x6f\x61\x73\x69\163\72\x6e\141\155\x65\163\x3a\164\143\72\123\101\115\x4c\x3a\x32\x2e\x30\x3a\141\x73\x73\145\162\164\151\x6f\156", "\163\141\x6d\x6c\72\105\x6e\143\162\x79\160\x74\x65\x64\x41\x74\164\162\x69\142\x75\164\x65");
            $hX->appendChild($k3);
            $d1 = $RJ->importNode($bq, TRUE);
            $k3->appendChild($d1);
            Pj:
        }
        Os:
    }
}
