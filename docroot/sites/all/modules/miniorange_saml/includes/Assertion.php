<?php


include_once "\125\x74\151\154\151\164\151\145\x73\x2e\x70\x68\x70";
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
    public function __construct(DOMElement $L_ = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\162\x6e\72\157\x61\163\151\x73\72\156\x61\155\x65\163\x3a\164\x63\x3a\123\101\115\114\x3a\x31\56\61\x3a\156\141\155\145\151\x64\55\x66\157\162\x6d\141\164\x3a\165\x6e\163\x70\x65\143\x69\146\151\x65\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($L_ === NULL)) {
            goto mY;
        }
        return;
        mY:
        if (!($L_->localName === "\105\156\143\x72\171\160\164\145\x64\x41\163\163\x65\162\x74\x69\157\156")) {
            goto x6;
        }
        $HC = Utilities::xpQuery($L_, "\56\57\170\145\x6e\143\72\105\156\x63\162\171\x70\164\145\x64\104\141\x74\141");
        $je = Utilities::xpQuery($L_, "\x2e\57\x78\x65\156\x63\72\x45\x6e\143\162\x79\160\x74\x65\x64\x44\141\x74\x61\x2f\x64\x73\x3a\113\145\171\111\156\x66\157\57\170\145\x6e\x63\x3a\x45\x6e\143\x72\171\160\164\145\144\113\145\x79");
        $TI = '';
        if (empty($je)) {
            goto pl;
        }
        $TI = $je[0]->firstChild->getAttribute("\x41\154\x67\157\162\x69\x74\x68\155");
        goto I_;
        pl:
        $je = Utilities::xpQuery($L_, "\56\57\x78\x65\x6e\x63\72\105\156\143\x72\171\x70\x74\x65\x64\x4b\x65\x79\57\x78\145\156\x63\72\x45\x6e\143\162\171\160\164\x69\x6f\156\115\x65\164\x68\157\144");
        $TI = $je[0]->getAttribute("\101\154\x67\x6f\x72\x69\x74\x68\x6d");
        I_:
        $vy = Utilities::getEncryptionAlgorithm($TI);
        if (count($HC) === 0) {
            goto cs;
        }
        if (count($HC) > 1) {
            goto Eq;
        }
        goto Ke;
        cs:
        throw new Exception("\x4d\151\163\163\151\x6e\147\40\145\x6e\x63\x72\x79\x70\x74\x65\144\x20\144\x61\x74\x61\40\x69\x6e\40\x3c\x73\141\155\154\72\105\x6e\x63\162\171\x70\x74\x65\144\x41\163\x73\x65\x72\164\151\157\x6e\x3e\x2e");
        goto Ke;
        Eq:
        throw new Exception("\115\157\x72\145\40\x74\x68\x61\156\40\157\x6e\145\x20\145\x6e\x63\162\x79\x70\164\x65\x64\40\x64\141\164\141\x20\x65\x6c\x65\x6d\x65\x6e\164\x20\151\156\40\74\x73\x61\155\154\72\105\156\x63\162\x79\160\x74\145\144\101\163\163\145\x72\164\x69\157\156\76\x2e");
        Ke:
        $un = '';
        $un = variable_get("\155\x69\156\151\157\x72\x61\x6e\x67\145\x5f\x73\141\155\x6c\137\x70\x72\151\166\x61\164\145\137\x63\145\x72\x74\151\146\x69\x63\x61\x74\x65");
        $l9 = new XMLSecurityKey($vy, array("\164\171\x70\145" => "\160\x72\x69\166\141\164\x65"));
        $LC = drupal_get_path("\x6d\157\x64\x75\x6c\145", "\x6d\x69\156\x69\157\x72\x61\x6e\x67\x65\137\x73\x61\x6d\154");
        if ($un != '') {
            goto VY;
        }
        $Rq = $LC . "\57\162\x65\163\x6f\x75\x72\143\x65\163\57\163\160\55\x6b\x65\171\56\x6b\x65\x79";
        goto hk;
        VY:
        $Rq = $LC . "\57\162\145\x73\157\x75\162\143\x65\x73\57\x43\165\163\x74\157\155\137\120\x72\151\x76\141\x74\145\137\103\x65\x72\164\x69\x66\x69\x63\141\x74\x65\x2e\x6b\145\x79";
        hk:
        $l9->loadKey($Rq, TRUE);
        $jS = new XMLSecurityKey($vy, array("\x74\171\160\145" => "\x70\162\151\166\141\x74\x65"));
        $xp = $LC . "\x2f\162\x65\x73\x6f\165\162\x63\x65\x73\57\x6d\x69\x6e\151\157\x72\x61\156\x67\x65\137\x73\x70\x5f\x70\162\x69\166\x5f\153\x65\x79\56\x6b\x65\x79";
        $jS->loadKey($xp, TRUE);
        $S1 = array();
        $L_ = Utilities::decryptElement($HC[0], $l9, $S1, $jS);
        x6:
        if ($L_->hasAttribute("\111\x44")) {
            goto Bg;
        }
        throw new Exception("\x4d\x69\x73\x73\151\156\147\x20\111\x44\x20\141\x74\164\162\x69\x62\x75\x74\145\40\157\156\40\123\x41\115\x4c\40\x61\163\x73\145\x72\x74\151\157\156\56");
        Bg:
        $this->id = $L_->getAttribute("\111\104");
        if (!($L_->getAttribute("\126\145\x72\163\x69\157\x6e") !== "\62\56\60")) {
            goto kE;
        }
        throw new Exception("\x55\156\x73\165\x70\160\x6f\x72\x74\145\x64\40\166\145\x72\163\151\x6f\156\72\40" . $L_->getAttribute("\x56\x65\162\163\x69\157\x6e"));
        kE:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($L_->getAttribute("\111\x73\x73\x75\x65\x49\x6e\163\164\x61\156\x74"));
        $Pz = Utilities::xpQuery($L_, "\56\57\163\141\x6d\x6c\137\x61\163\x73\145\162\x74\x69\x6f\x6e\72\111\163\163\x75\x65\162");
        if (!empty($Pz)) {
            goto Sj;
        }
        throw new Exception("\115\x69\163\163\151\156\147\x20\74\x73\141\x6d\x6c\72\111\163\163\x75\145\x72\76\40\x69\156\x20\x61\163\163\145\162\164\x69\157\156\x2e");
        Sj:
        $this->issuer = trim($Pz[0]->textContent);
        $this->parseConditions($L_);
        $this->parseAuthnStatement($L_);
        $this->parseAttributes($L_);
        $this->parseEncryptedAttributes($L_);
        $this->parseSignature($L_);
        $this->parseSubject($L_);
    }
    private function parseSubject(DOMElement $L_)
    {
        $mO = Utilities::xpQuery($L_, "\x2e\x2f\163\x61\x6d\x6c\x5f\x61\x73\x73\145\162\x74\x69\x6f\156\x3a\x53\x75\x62\x6a\145\143\x74");
        if (empty($mO)) {
            goto vT;
        }
        if (count($mO) > 1) {
            goto pJ;
        }
        goto Z7;
        vT:
        return;
        goto Z7;
        pJ:
        throw new Exception("\x4d\157\162\145\40\164\x68\141\x6e\40\x6f\x6e\x65\40\74\163\141\155\154\72\x53\x75\142\x6a\145\143\164\x3e\x20\151\156\x20\74\x73\141\155\x6c\x3a\x41\x73\163\x65\162\164\151\157\156\76\x2e");
        Z7:
        $mO = $mO[0];
        $PV = Utilities::xpQuery($mO, "\x2e\x2f\x73\x61\x6d\154\x5f\141\163\163\145\x72\x74\x69\x6f\156\72\116\141\155\x65\x49\104\x20\174\40\56\57\x73\x61\x6d\x6c\137\141\163\163\x65\x72\x74\151\157\x6e\x3a\105\156\143\x72\x79\160\x74\145\144\x49\104\57\x78\145\x6e\x63\72\105\x6e\x63\162\x79\160\x74\x65\x64\104\141\x74\141");
        if (empty($PV)) {
            goto xn;
        }
        if (count($PV) > 1) {
            goto C0;
        }
        goto sF;
        xn:
        throw new Exception("\115\x69\x73\x73\x69\x6e\x67\x20\x3c\x73\x61\x6d\x6c\72\x4e\x61\155\x65\x49\x44\x3e\x20\157\162\40\x3c\163\x61\x6d\154\72\105\156\x63\162\171\x70\x74\x65\x64\x49\x44\x3e\x20\x69\x6e\40\74\x73\141\155\x6c\72\x53\165\142\152\x65\x63\x74\x3e\x2e");
        goto sF;
        C0:
        throw new Exception("\115\x6f\162\145\40\164\150\x61\x6e\40\157\156\x65\40\x3c\163\141\x6d\154\x3a\116\141\x6d\x65\111\104\x3e\x20\157\x72\40\74\x73\141\155\154\x3a\105\156\143\x72\171\x70\164\145\x64\x44\x3e\40\151\156\x20\74\163\141\155\154\x3a\123\x75\x62\x6a\145\x63\164\76\56");
        sF:
        $PV = $PV[0];
        if ($PV->localName === "\105\156\x63\x72\x79\160\x74\x65\x64\104\x61\164\141") {
            goto OR1;
        }
        $this->nameId = Utilities::parseNameId($PV);
        goto C8;
        OR1:
        $this->encryptedNameId = $PV;
        C8:
    }
    private function parseConditions(DOMElement $L_)
    {
        $De = Utilities::xpQuery($L_, "\56\x2f\x73\141\155\154\x5f\x61\x73\x73\145\x72\x74\151\x6f\156\x3a\x43\x6f\156\144\x69\164\151\x6f\x6e\163");
        if (empty($De)) {
            goto Wa;
        }
        if (count($De) > 1) {
            goto S_;
        }
        goto p6;
        Wa:
        return;
        goto p6;
        S_:
        throw new Exception("\115\157\x72\x65\40\164\150\141\156\x20\x6f\156\145\x20\74\163\141\155\154\x3a\103\157\156\x64\x69\164\151\157\156\x73\76\x20\x69\x6e\x20\74\163\x61\155\154\x3a\x41\163\163\145\x72\164\151\157\156\76\x2e");
        p6:
        $De = $De[0];
        if (!$De->hasAttribute("\116\x6f\164\x42\145\x66\157\x72\145")) {
            goto Y6;
        }
        $HO = Utilities::xsDateTimeToTimestamp($De->getAttribute("\x4e\x6f\x74\x42\145\146\157\x72\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $HO)) {
            goto KC;
        }
        $this->notBefore = $HO;
        KC:
        Y6:
        if (!$De->hasAttribute("\x4e\157\x74\117\x6e\117\x72\x41\146\164\x65\162")) {
            goto jH;
        }
        $Lh = Utilities::xsDateTimeToTimestamp($De->getAttribute("\x4e\x6f\x74\x4f\156\117\x72\x41\x66\164\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $Lh)) {
            goto aK;
        }
        $this->notOnOrAfter = $Lh;
        aK:
        jH:
        $SP = $De->firstChild;
        QL:
        if (!($SP !== NULL)) {
            goto EG;
        }
        if (!$SP instanceof DOMText) {
            goto fS;
        }
        goto uw;
        fS:
        if (!($SP->namespaceURI !== "\165\x72\156\x3a\x6f\141\x73\x69\x73\72\156\x61\155\x65\163\72\164\x63\72\x53\x41\x4d\x4c\x3a\62\56\60\x3a\141\163\x73\x65\162\164\x69\x6f\156")) {
            goto Ad;
        }
        throw new Exception("\x55\156\153\156\157\167\x6e\x20\156\x61\155\x65\163\160\x61\143\x65\40\x6f\x66\40\x63\157\156\144\151\164\x69\x6f\x6e\72\40" . var_export($SP->namespaceURI, TRUE));
        Ad:
        switch ($SP->localName) {
            case "\x41\x75\x64\x69\x65\156\143\x65\122\145\x73\164\162\x69\143\164\x69\157\x6e":
                $CA = Utilities::extractStrings($SP, "\x75\x72\156\x3a\157\141\x73\x69\163\x3a\x6e\x61\155\145\163\x3a\x74\x63\72\123\101\x4d\x4c\x3a\x32\x2e\x30\72\x61\163\x73\x65\x72\164\x69\x6f\156", "\x41\165\x64\151\145\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto j9;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $CA);
                goto IA;
                j9:
                $this->validAudiences = $CA;
                IA:
                goto nZ;
            case "\117\x6e\145\x54\151\x6d\x65\125\163\x65":
                goto nZ;
            case "\x50\x72\157\x78\171\x52\x65\163\164\162\151\x63\164\x69\157\156":
                goto nZ;
            default:
                throw new Exception("\x55\x6e\x6b\x6e\x6f\167\156\x20\143\157\156\144\x69\164\x69\x6f\x6e\x3a\40" . var_export($SP->localName, TRUE));
        }
        RG:
        nZ:
        uw:
        $SP = $SP->nextSibling;
        goto QL;
        EG:
    }
    private function parseAuthnStatement(DOMElement $L_)
    {
        $VQ = Utilities::xpQuery($L_, "\56\x2f\163\x61\155\x6c\137\x61\163\x73\x65\x72\x74\x69\x6f\x6e\72\x41\165\x74\x68\156\123\164\x61\x74\145\155\145\156\164");
        if (empty($VQ)) {
            goto Rp;
        }
        if (count($VQ) > 1) {
            goto GR;
        }
        goto jn;
        Rp:
        $this->authnInstant = NULL;
        return;
        goto jn;
        GR:
        throw new Exception("\x4d\157\x72\145\40\164\150\x61\164\x20\x6f\156\x65\40\74\163\x61\155\x6c\x3a\101\165\x74\150\x6e\123\164\x61\164\145\x6d\145\156\x74\x3e\40\151\156\x20\x3c\x73\141\155\154\72\x41\163\x73\x65\162\x74\151\x6f\156\x3e\x20\156\x6f\x74\x20\x73\165\x70\160\x6f\162\164\x65\x64\x2e");
        jn:
        $Tx = $VQ[0];
        if ($Tx->hasAttribute("\101\x75\164\150\x6e\x49\x6e\x73\x74\x61\156\x74")) {
            goto U3;
        }
        throw new Exception("\x4d\151\163\163\x69\x6e\147\40\162\145\x71\165\x69\x72\145\x64\x20\x41\x75\164\x68\x6e\x49\156\163\164\141\156\x74\x20\x61\x74\164\162\x69\142\x75\164\145\40\x6f\156\x20\x3c\163\141\x6d\154\72\x41\165\164\150\156\x53\164\x61\164\145\155\145\x6e\x74\76\56");
        U3:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($Tx->getAttribute("\x41\x75\x74\150\x6e\111\x6e\x73\x74\141\x6e\164"));
        if (!$Tx->hasAttribute("\x53\145\x73\x73\151\x6f\156\x4e\x6f\x74\117\x6e\x4f\162\x41\146\x74\145\x72")) {
            goto vl;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($Tx->getAttribute("\x53\145\163\163\x69\x6f\x6e\x4e\x6f\164\x4f\156\117\162\101\146\x74\145\162"));
        vl:
        if (!$Tx->hasAttribute("\x53\145\163\x73\x69\x6f\156\x49\156\x64\x65\170")) {
            goto sJ;
        }
        $this->sessionIndex = $Tx->getAttribute("\x53\145\x73\163\151\x6f\x6e\x49\x6e\x64\145\170");
        sJ:
        $this->parseAuthnContext($Tx);
    }
    private function parseAuthnContext(DOMElement $uD)
    {
        $wc = Utilities::xpQuery($uD, "\56\x2f\x73\141\155\154\x5f\x61\163\163\x65\162\164\x69\157\156\72\101\165\164\x68\x6e\x43\x6f\156\x74\x65\170\164");
        if (count($wc) > 1) {
            goto Cw;
        }
        if (empty($wc)) {
            goto PQ;
        }
        goto Bv;
        Cw:
        throw new Exception("\115\x6f\162\x65\40\x74\150\141\x6e\40\x6f\156\x65\x20\74\x73\x61\155\154\72\x41\x75\x74\x68\156\x43\x6f\156\164\145\x78\164\x3e\x20\x69\156\40\74\x73\x61\155\154\x3a\101\x75\164\150\x6e\x53\164\141\164\x65\155\145\x6e\164\76\x2e");
        goto Bv;
        PQ:
        throw new Exception("\x4d\x69\x73\x73\x69\x6e\147\x20\162\145\161\165\151\162\145\x64\40\74\x73\x61\x6d\x6c\x3a\x41\x75\164\x68\x6e\103\157\x6e\164\x65\170\164\x3e\x20\x69\x6e\40\x3c\163\x61\155\154\72\x41\165\164\150\156\x53\x74\x61\164\x65\155\x65\156\x74\x3e\x2e");
        Bv:
        $Sh = $wc[0];
        $pv = Utilities::xpQuery($Sh, "\x2e\57\163\141\x6d\x6c\x5f\x61\163\163\x65\x72\164\x69\157\x6e\x3a\x41\x75\x74\150\156\103\x6f\156\164\x65\170\164\104\x65\143\x6c\x52\145\x66");
        if (count($pv) > 1) {
            goto nH;
        }
        if (count($pv) === 1) {
            goto IT;
        }
        goto P4;
        nH:
        throw new Exception("\x4d\x6f\x72\145\x20\164\x68\141\156\40\157\x6e\145\x20\x3c\x73\141\x6d\154\72\101\x75\x74\x68\156\103\157\156\x74\x65\170\x74\x44\145\x63\x6c\122\145\146\x3e\40\146\x6f\165\156\x64\77");
        goto P4;
        IT:
        $this->setAuthnContextDeclRef(trim($pv[0]->textContent));
        P4:
        $ik = Utilities::xpQuery($Sh, "\x2e\x2f\163\x61\x6d\x6c\137\141\x73\x73\x65\x72\164\151\x6f\156\72\x41\165\x74\x68\156\103\157\x6e\x74\145\x78\164\x44\x65\143\x6c");
        if (count($ik) > 1) {
            goto U1;
        }
        if (count($ik) === 1) {
            goto OM;
        }
        goto yz;
        U1:
        throw new Exception("\x4d\x6f\162\145\x20\164\150\x61\156\x20\x6f\x6e\x65\x20\74\163\x61\x6d\154\72\x41\x75\x74\150\x6e\103\157\156\164\x65\170\x74\x44\x65\x63\154\x3e\x20\146\157\165\156\x64\77");
        goto yz;
        OM:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($ik[0]));
        yz:
        $e3 = Utilities::xpQuery($Sh, "\56\57\x73\x61\155\154\137\141\163\x73\x65\x72\164\151\157\x6e\x3a\x41\165\164\150\156\103\157\x6e\164\x65\x78\164\x43\x6c\141\163\x73\122\x65\146");
        if (count($e3) > 1) {
            goto Rh;
        }
        if (count($e3) === 1) {
            goto UT;
        }
        goto AM;
        Rh:
        throw new Exception("\x4d\157\162\145\x20\164\x68\x61\x6e\40\157\156\x65\x20\x3c\163\x61\x6d\x6c\72\101\165\x74\x68\x6e\103\157\x6e\x74\145\170\x74\103\x6c\x61\163\x73\122\x65\146\76\x20\151\156\x20\74\x73\x61\155\154\x3a\101\165\x74\150\x6e\x43\157\156\164\145\x78\164\76\56");
        goto AM;
        UT:
        $this->setAuthnContextClassRef(trim($e3[0]->textContent));
        AM:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto FC;
        }
        throw new Exception("\x4d\x69\163\163\x69\x6e\x67\40\x65\x69\x74\x68\x65\162\x20\x3c\x73\x61\x6d\x6c\72\101\165\164\150\156\x43\x6f\156\x74\x65\170\164\103\x6c\x61\x73\163\x52\x65\146\76\40\x6f\x72\x20\x3c\163\x61\x6d\x6c\x3a\101\165\x74\x68\156\x43\157\x6e\164\145\x78\x74\104\145\x63\x6c\x52\x65\146\76\x20\x6f\162\x20\74\x73\141\155\154\72\x41\x75\x74\150\x6e\103\x6f\x6e\x74\x65\x78\x74\x44\x65\x63\154\x3e");
        FC:
        $this->AuthenticatingAuthority = Utilities::extractStrings($Sh, "\165\162\156\72\157\x61\x73\x69\x73\72\x6e\141\155\x65\163\x3a\x74\x63\x3a\123\x41\x4d\114\72\x32\56\x30\72\141\163\163\145\162\164\x69\157\x6e", "\x41\x75\164\150\145\x6e\164\151\143\141\x74\151\x6e\x67\101\x75\x74\150\157\162\151\164\171");
    }
    private function parseAttributes(DOMElement $L_)
    {
        $q7 = TRUE;
        $K5 = Utilities::xpQuery($L_, "\56\57\163\141\155\154\137\141\x73\163\145\x72\x74\151\x6f\x6e\72\101\164\x74\x72\x69\142\165\164\145\x53\x74\x61\x74\x65\x6d\x65\156\164\57\163\141\x6d\154\x5f\x61\x73\163\145\x72\164\151\x6f\x6e\x3a\x41\164\x74\x72\x69\x62\x75\164\145");
        foreach ($K5 as $Aa) {
            if ($Aa->hasAttribute("\116\141\x6d\x65")) {
                goto uh;
            }
            throw new Exception("\x4d\151\x73\163\x69\x6e\x67\40\x6e\141\x6d\145\x20\x6f\x6e\40\x3c\163\x61\155\x6c\x3a\x41\164\164\162\151\142\165\x74\x65\76\x20\145\x6c\145\x6d\145\x6e\164\x2e");
            uh:
            $cg = $Aa->getAttribute("\x4e\x61\x6d\145");
            if ($Aa->hasAttribute("\x4e\141\x6d\145\106\x6f\162\155\141\x74")) {
                goto va;
            }
            $hJ = "\165\x72\156\x3a\x6f\141\163\151\x73\x3a\156\141\155\145\163\x3a\x74\143\72\x53\101\115\x4c\x3a\61\56\x31\72\x6e\141\155\145\151\144\55\x66\x6f\162\155\x61\x74\x3a\165\156\163\160\x65\143\x69\146\x69\x65\x64";
            goto NJ;
            va:
            $hJ = $Aa->getAttribute("\116\141\155\x65\106\x6f\x72\155\141\164");
            NJ:
            if ($q7) {
                goto dJ;
            }
            if (!($this->nameFormat !== $hJ)) {
                goto t2;
            }
            $this->nameFormat = "\x75\x72\x6e\x3a\157\x61\163\151\163\x3a\156\x61\x6d\145\x73\x3a\x74\x63\72\123\x41\115\x4c\x3a\x31\56\x31\x3a\x6e\x61\x6d\145\x69\144\x2d\x66\157\162\x6d\x61\164\x3a\165\x6e\x73\160\145\143\151\146\x69\145\144";
            t2:
            goto iW;
            dJ:
            $this->nameFormat = $hJ;
            $q7 = FALSE;
            iW:
            if (array_key_exists($cg, $this->attributes)) {
                goto es;
            }
            $this->attributes[$cg] = array();
            es:
            $EP = Utilities::xpQuery($Aa, "\56\x2f\163\141\x6d\154\x5f\x61\163\163\145\x72\164\x69\x6f\156\x3a\101\164\x74\x72\151\142\165\x74\x65\x56\x61\154\x75\145");
            foreach ($EP as $qO) {
                $this->attributes[$cg][] = trim($qO->textContent);
                n_:
            }
            kd:
            iO:
        }
        y9:
    }
    private function parseEncryptedAttributes(DOMElement $L_)
    {
        $this->encryptedAttribute = Utilities::xpQuery($L_, "\56\x2f\x73\x61\155\x6c\x5f\x61\163\163\145\162\x74\x69\157\x6e\x3a\x41\164\164\162\x69\x62\165\x74\145\123\164\141\164\x65\155\x65\156\164\x2f\163\x61\155\x6c\x5f\x61\x73\x73\x65\x72\164\x69\157\x6e\72\105\x6e\x63\x72\x79\160\164\x65\144\101\164\164\162\151\x62\x75\164\x65");
    }
    private function parseSignature(DOMElement $L_)
    {
        $R3 = Utilities::validateElement($L_);
        if (!($R3 !== FALSE)) {
            goto oe;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $R3["\x43\145\x72\164\x69\146\151\143\x61\x74\x65\x73"];
        $this->signatureData = $R3;
        oe:
    }
    public function validate(XMLSecurityKey $l9)
    {
        if (!($this->signatureData === NULL)) {
            goto mv;
        }
        return FALSE;
        mv:
        Utilities::validateSignature($this->signatureData, $l9);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($kI)
    {
        $this->id = $kI;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($ZY)
    {
        $this->issueInstant = $ZY;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($Pz)
    {
        $this->issuer = $Pz;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto cf;
        }
        throw new Exception("\x41\164\164\145\x6d\x70\164\145\144\x20\x74\157\x20\162\145\164\x72\151\x65\x76\145\40\x65\156\143\x72\171\160\x74\145\144\40\x4e\141\x6d\x65\111\x44\40\x77\151\164\x68\x6f\165\x74\x20\x64\145\143\x72\171\160\164\x69\156\x67\x20\151\x74\40\146\x69\x72\163\164\56");
        cf:
        return $this->nameId;
    }
    public function setNameId($PV)
    {
        $this->nameId = $PV;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto em;
        }
        return TRUE;
        em:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $l9)
    {
        $t0 = new DOMDocument();
        $V1 = $t0->createElement("\162\157\x6f\164");
        $t0->appendChild($V1);
        Utilities::addNameId($V1, $this->nameId);
        $PV = $V1->firstChild;
        Utilities::getContainer()->debugMessage($PV, "\145\x6e\x63\x72\x79\160\x74");
        $pe = new XMLSecEnc();
        $pe->setNode($PV);
        $pe->type = XMLSecEnc::Element;
        $mI = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $mI->generateSessionKey();
        $pe->encryptKey($l9, $mI);
        $this->encryptedNameId = $pe->encryptNode($mI);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $l9, array $S1 = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto mX;
        }
        return;
        mX:
        $PV = Utilities::decryptElement($this->encryptedNameId, $l9, $S1);
        Utilities::getContainer()->debugMessage($PV, "\x64\145\143\x72\171\x70\x74");
        $this->nameId = Utilities::parseNameId($PV);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $l9, array $S1 = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto T5;
        }
        return;
        T5:
        $q7 = TRUE;
        $K5 = $this->encryptedAttribute;
        foreach ($K5 as $YR) {
            $Aa = Utilities::decryptElement($YR->getElementsByTagName("\105\x6e\143\162\171\x70\x74\x65\x64\x44\141\164\141")->item(0), $l9, $S1);
            if ($Aa->hasAttribute("\x4e\141\155\145")) {
                goto j5;
            }
            throw new Exception("\115\151\163\163\151\156\147\x20\156\x61\155\x65\40\x6f\156\x20\74\163\141\155\154\72\101\x74\164\x72\x69\142\165\164\145\76\40\145\x6c\145\x6d\145\x6e\x74\x2e");
            j5:
            $cg = $Aa->getAttribute("\x4e\x61\x6d\x65");
            if ($Aa->hasAttribute("\116\x61\x6d\x65\x46\157\162\x6d\x61\164")) {
                goto n2;
            }
            $hJ = "\165\162\x6e\72\x6f\141\x73\151\163\x3a\x6e\x61\x6d\145\x73\x3a\164\143\72\123\x41\115\114\72\x32\56\60\x3a\x61\164\164\x72\x6e\141\155\x65\x2d\x66\x6f\162\x6d\141\x74\x3a\165\156\163\x70\145\143\151\x66\151\145\x64";
            goto br;
            n2:
            $hJ = $Aa->getAttribute("\x4e\141\155\145\x46\157\x72\155\x61\x74");
            br:
            if ($q7) {
                goto t0;
            }
            if (!($this->nameFormat !== $hJ)) {
                goto sx;
            }
            $this->nameFormat = "\165\162\x6e\x3a\157\141\x73\151\163\x3a\x6e\x61\155\145\x73\72\x74\x63\x3a\123\101\x4d\x4c\72\x32\56\60\72\x61\x74\x74\x72\x6e\141\x6d\x65\55\146\157\162\x6d\x61\x74\x3a\x75\x6e\x73\x70\x65\143\151\x66\x69\145\x64";
            sx:
            goto WN;
            t0:
            $this->nameFormat = $hJ;
            $q7 = FALSE;
            WN:
            if (array_key_exists($cg, $this->attributes)) {
                goto w6;
            }
            $this->attributes[$cg] = array();
            w6:
            $EP = Utilities::xpQuery($Aa, "\x2e\57\163\x61\x6d\154\x5f\x61\x73\163\x65\x72\x74\x69\157\156\x3a\101\x74\x74\x72\151\x62\x75\x74\x65\126\141\154\x75\x65");
            foreach ($EP as $qO) {
                $this->attributes[$cg][] = trim($qO->textContent);
                TI:
            }
            Es:
            RS:
        }
        Zw:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($HO)
    {
        $this->notBefore = $HO;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($Lh)
    {
        $this->notOnOrAfter = $Lh;
    }
    public function setEncryptedAttributes($jA)
    {
        $this->requiredEncAttributes = $jA;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $t2 = NULL)
    {
        $this->validAudiences = $t2;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($Gl)
    {
        $this->authnInstant = $Gl;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($HV)
    {
        $this->sessionNotOnOrAfter = $HV;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($Cn)
    {
        $this->sessionIndex = $Cn;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto Vl;
        }
        return $this->authnContextClassRef;
        Vl:
        if (empty($this->authnContextDeclRef)) {
            goto sy;
        }
        return $this->authnContextDeclRef;
        sy:
        return NULL;
    }
    public function setAuthnContext($T4)
    {
        $this->setAuthnContextClassRef($T4);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($Bq)
    {
        $this->authnContextClassRef = $Bq;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $B4)
    {
        if (empty($this->authnContextDeclRef)) {
            goto AA;
        }
        throw new Exception("\101\x75\164\150\x6e\103\x6f\156\x74\x65\x78\x74\x44\145\143\x6c\122\x65\x66\x20\x69\x73\40\x61\x6c\x72\x65\x61\144\x79\40\x72\145\x67\x69\163\164\x65\162\145\x64\x21\40\x4d\x61\171\40\157\x6e\154\x79\40\150\x61\166\x65\x20\x65\x69\x74\150\145\x72\x20\141\x20\x44\x65\143\x6c\40\x6f\x72\40\141\40\x44\x65\143\154\122\x65\x66\54\40\x6e\157\164\x20\142\x6f\164\x68\x21");
        AA:
        $this->authnContextDecl = $B4;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($Rp)
    {
        if (empty($this->authnContextDecl)) {
            goto fK;
        }
        throw new Exception("\101\165\164\x68\x6e\x43\x6f\x6e\164\145\170\x74\x44\x65\143\154\40\151\x73\x20\x61\154\162\145\x61\x64\x79\x20\162\145\147\x69\163\x74\145\162\x65\144\x21\x20\x4d\x61\x79\x20\x6f\156\154\171\40\150\141\x76\145\x20\x65\x69\164\x68\x65\162\40\x61\x20\x44\x65\x63\154\x20\157\x72\x20\x61\x20\x44\145\x63\x6c\122\145\146\x2c\40\x6e\x6f\164\40\x62\x6f\164\x68\41");
        fK:
        $this->authnContextDeclRef = $Rp;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($AA)
    {
        $this->AuthenticatingAuthority = $AA;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $K5)
    {
        $this->attributes = $K5;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($hJ)
    {
        $this->nameFormat = $hJ;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $hE)
    {
        $this->SubjectConfirmation = $hE;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $DO = NULL)
    {
        $this->signatureKey = $DO;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $tZ = NULL)
    {
        $this->encryptionKey = $tZ;
    }
    public function setCertificates(array $Un)
    {
        $this->certificates = $Un;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $s4 = NULL)
    {
        if ($s4 === NULL) {
            goto Vk;
        }
        $XU = $s4->ownerDocument;
        goto DD;
        Vk:
        $XU = new DOMDocument();
        $s4 = $XU;
        DD:
        $V1 = $XU->createElementNS("\165\x72\x6e\x3a\x6f\x61\163\151\x73\72\x6e\141\155\x65\x73\72\164\x63\72\123\101\115\114\72\x32\56\60\x3a\x61\x73\163\x65\162\x74\x69\157\156", "\x73\x61\155\x6c\x3a" . "\101\163\x73\145\162\164\x69\157\156");
        $s4->appendChild($V1);
        $V1->setAttributeNS("\165\162\x6e\x3a\157\141\163\151\163\x3a\156\x61\155\x65\163\72\x74\143\x3a\x53\101\x4d\x4c\72\62\x2e\60\x3a\160\162\157\164\157\x63\x6f\154", "\163\141\155\154\160\72\164\155\160", "\164\x6d\160");
        $V1->removeAttributeNS("\165\162\156\x3a\x6f\141\163\x69\x73\72\x6e\x61\155\x65\163\x3a\x74\143\x3a\x53\x41\x4d\114\72\x32\x2e\x30\72\x70\162\157\164\157\x63\x6f\x6c", "\x74\x6d\160");
        $V1->setAttributeNS("\150\164\x74\x70\x3a\x2f\x2f\167\167\167\x2e\x77\63\56\x6f\x72\147\57\x32\60\60\x31\57\x58\x4d\x4c\123\x63\x68\145\x6d\141\55\151\156\163\x74\x61\156\x63\145", "\x78\x73\x69\x3a\x74\x6d\x70", "\x74\x6d\160");
        $V1->removeAttributeNS("\x68\x74\164\160\x3a\x2f\x2f\x77\167\x77\x2e\167\x33\x2e\157\x72\x67\57\62\x30\60\x31\57\x58\x4d\x4c\123\x63\150\145\155\x61\x2d\151\156\163\164\141\156\143\x65", "\x74\155\x70");
        $V1->setAttributeNS("\x68\x74\x74\160\72\x2f\57\167\167\x77\56\167\x33\56\x6f\162\x67\x2f\x32\x30\60\x31\57\x58\115\x4c\x53\143\150\x65\155\x61", "\170\163\72\164\155\160", "\x74\155\x70");
        $V1->removeAttributeNS("\150\x74\164\x70\x3a\57\57\167\x77\167\x2e\167\63\56\x6f\x72\x67\57\62\60\60\x31\57\x58\x4d\114\123\x63\150\145\155\141", "\164\x6d\160");
        $V1->setAttribute("\x49\x44", $this->id);
        $V1->setAttribute("\126\145\x72\x73\151\x6f\156", "\62\56\60");
        $V1->setAttribute("\111\x73\163\165\x65\x49\156\163\164\141\156\x74", gmdate("\x59\x2d\155\x2d\x64\x5c\124\110\x3a\151\72\x73\x5c\x5a", $this->issueInstant));
        $Pz = Utilities::addString($V1, "\x75\162\156\72\157\x61\x73\x69\x73\x3a\156\x61\x6d\x65\x73\72\164\x63\x3a\x53\x41\x4d\x4c\72\x32\56\60\72\x61\x73\x73\145\x72\x74\151\x6f\156", "\163\x61\155\x6c\72\111\x73\163\x75\145\x72", $this->issuer);
        $this->addSubject($V1);
        $this->addConditions($V1);
        $this->addAuthnStatement($V1);
        if ($this->requiredEncAttributes == FALSE) {
            goto zf;
        }
        $this->addEncryptedAttributeStatement($V1);
        goto vY;
        zf:
        $this->addAttributeStatement($V1);
        vY:
        if (!($this->signatureKey !== NULL)) {
            goto JW;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $V1, $Pz->nextSibling);
        JW:
        return $V1;
    }
    private function addSubject(DOMElement $V1)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto dm;
        }
        return;
        dm:
        $mO = $V1->ownerDocument->createElementNS("\x75\162\x6e\72\157\x61\x73\151\163\72\156\141\155\x65\x73\x3a\164\x63\x3a\123\101\x4d\114\x3a\x32\x2e\60\72\141\163\163\x65\x72\164\151\157\x6e", "\163\141\x6d\x6c\72\x53\x75\142\x6a\x65\x63\x74");
        $V1->appendChild($mO);
        if ($this->encryptedNameId === NULL) {
            goto LE;
        }
        $QC = $mO->ownerDocument->createElementNS("\165\162\x6e\72\157\141\x73\151\x73\x3a\156\141\155\145\x73\x3a\x74\143\72\x53\101\x4d\x4c\x3a\x32\56\x30\72\x61\163\x73\x65\x72\164\x69\x6f\156", "\x73\x61\x6d\x6c\72" . "\x45\156\x63\x72\x79\x70\x74\x65\144\111\x44");
        $mO->appendChild($QC);
        $QC->appendChild($mO->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto iy;
        LE:
        Utilities::addNameId($mO, $this->nameId);
        iy:
        foreach ($this->SubjectConfirmation as $rX) {
            $rX->toXML($mO);
            vi:
        }
        M9:
    }
    private function addConditions(DOMElement $V1)
    {
        $XU = $V1->ownerDocument;
        $De = $XU->createElementNS("\x75\162\x6e\72\x6f\141\x73\x69\163\72\156\141\155\145\163\72\x74\x63\72\123\x41\x4d\114\72\x32\56\60\x3a\x61\163\x73\145\x72\x74\x69\157\x6e", "\x73\141\x6d\154\72\103\157\156\x64\x69\x74\x69\x6f\x6e\x73");
        $V1->appendChild($De);
        if (!($this->notBefore !== NULL)) {
            goto Wg;
        }
        $De->setAttribute("\x4e\x6f\x74\102\145\x66\x6f\x72\x65", gmdate("\x59\x2d\155\55\144\134\x54\110\x3a\151\72\163\134\132", $this->notBefore));
        Wg:
        if (!($this->notOnOrAfter !== NULL)) {
            goto TU;
        }
        $De->setAttribute("\116\x6f\x74\x4f\x6e\117\x72\101\146\x74\x65\162", gmdate("\131\55\155\55\144\134\124\x48\x3a\x69\x3a\163\134\x5a", $this->notOnOrAfter));
        TU:
        if (!($this->validAudiences !== NULL)) {
            goto DZ;
        }
        $iS = $XU->createElementNS("\165\162\x6e\72\x6f\x61\163\151\163\72\x6e\x61\155\145\x73\72\164\143\x3a\123\101\x4d\114\x3a\x32\x2e\60\x3a\x61\163\163\145\162\164\x69\x6f\156", "\x73\141\155\x6c\x3a\x41\165\x64\x69\x65\x6e\143\145\122\145\x73\164\162\151\143\x74\x69\157\156");
        $De->appendChild($iS);
        Utilities::addStrings($iS, "\165\162\x6e\72\x6f\141\163\151\163\72\x6e\141\x6d\x65\x73\72\x74\143\72\123\101\x4d\x4c\x3a\x32\x2e\x30\x3a\x61\x73\x73\145\x72\164\x69\x6f\156", "\x73\141\155\154\x3a\x41\165\144\151\145\x6e\143\x65", FALSE, $this->validAudiences);
        DZ:
    }
    private function addAuthnStatement(DOMElement $V1)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto Ev;
        }
        return;
        Ev:
        $XU = $V1->ownerDocument;
        $uD = $XU->createElementNS("\165\x72\156\72\x6f\141\163\151\x73\72\x6e\141\155\x65\163\x3a\x74\x63\72\123\x41\x4d\114\72\62\56\x30\x3a\x61\163\163\145\162\164\151\x6f\156", "\x73\x61\155\x6c\72\x41\x75\x74\150\156\x53\x74\141\164\x65\155\x65\156\x74");
        $V1->appendChild($uD);
        $uD->setAttribute("\x41\x75\x74\150\156\x49\x6e\163\164\x61\x6e\164", gmdate("\x59\x2d\155\55\144\134\124\x48\72\151\x3a\163\134\x5a", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto Ta;
        }
        $uD->setAttribute("\123\145\x73\163\151\x6f\x6e\116\x6f\x74\117\156\117\162\101\x66\164\x65\162", gmdate("\x59\55\x6d\55\144\x5c\124\x48\x3a\x69\x3a\163\134\x5a", $this->sessionNotOnOrAfter));
        Ta:
        if (!($this->sessionIndex !== NULL)) {
            goto t7;
        }
        $uD->setAttribute("\x53\145\x73\163\x69\157\x6e\111\156\x64\x65\170", $this->sessionIndex);
        t7:
        $Sh = $XU->createElementNS("\165\162\x6e\x3a\x6f\x61\x73\151\163\x3a\156\x61\x6d\x65\x73\72\164\143\72\x53\x41\x4d\x4c\x3a\x32\56\60\72\x61\x73\x73\x65\x72\x74\151\157\x6e", "\163\141\155\154\x3a\101\165\164\150\156\103\157\156\x74\x65\170\164");
        $uD->appendChild($Sh);
        if (empty($this->authnContextClassRef)) {
            goto u6;
        }
        Utilities::addString($Sh, "\165\x72\x6e\x3a\x6f\x61\163\x69\163\72\x6e\141\x6d\145\x73\x3a\x74\x63\x3a\x53\x41\x4d\114\72\x32\56\60\72\141\163\x73\x65\x72\164\151\157\x6e", "\x73\x61\x6d\154\x3a\x41\165\164\x68\x6e\x43\157\156\x74\145\170\164\103\x6c\x61\x73\x73\x52\145\146", $this->authnContextClassRef);
        u6:
        if (empty($this->authnContextDecl)) {
            goto ZM;
        }
        $this->authnContextDecl->toXML($Sh);
        ZM:
        if (empty($this->authnContextDeclRef)) {
            goto rV;
        }
        Utilities::addString($Sh, "\x75\x72\156\72\157\141\x73\151\163\x3a\x6e\141\x6d\x65\x73\72\x74\143\x3a\123\x41\115\x4c\72\62\56\x30\x3a\141\163\163\x65\162\x74\151\157\x6e", "\163\141\x6d\x6c\72\x41\x75\164\x68\x6e\103\x6f\x6e\x74\145\170\164\x44\145\143\x6c\x52\x65\146", $this->authnContextDeclRef);
        rV:
        Utilities::addStrings($Sh, "\165\x72\x6e\72\157\x61\x73\151\x73\x3a\x6e\x61\x6d\145\x73\72\x74\x63\x3a\x53\x41\x4d\114\x3a\62\56\60\72\x61\x73\163\x65\162\x74\151\157\156", "\x73\141\155\154\x3a\x41\165\x74\x68\145\156\164\151\x63\141\164\x69\x6e\147\x41\x75\164\150\157\162\x69\164\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $V1)
    {
        if (!empty($this->attributes)) {
            goto Ih;
        }
        return;
        Ih:
        $XU = $V1->ownerDocument;
        $lH = $XU->createElementNS("\x75\162\x6e\x3a\157\x61\163\151\163\72\x6e\x61\155\x65\163\72\x74\143\x3a\123\x41\115\x4c\72\x32\56\60\x3a\x61\x73\163\x65\x72\164\151\157\156", "\163\141\x6d\x6c\72\x41\x74\164\162\x69\142\x75\164\145\x53\164\x61\164\145\155\145\156\x74");
        $V1->appendChild($lH);
        foreach ($this->attributes as $cg => $EP) {
            $Aa = $XU->createElementNS("\x75\x72\x6e\x3a\157\141\163\x69\163\72\156\141\155\145\x73\x3a\164\x63\72\x53\x41\x4d\x4c\x3a\62\56\x30\x3a\141\163\x73\x65\x72\164\151\x6f\x6e", "\163\141\x6d\154\x3a\x41\x74\x74\162\151\x62\x75\164\x65");
            $lH->appendChild($Aa);
            $Aa->setAttribute("\116\141\x6d\x65", $cg);
            if (!($this->nameFormat !== "\x75\x72\x6e\72\157\x61\x73\151\163\72\156\x61\x6d\x65\x73\x3a\x74\143\x3a\x53\x41\115\114\72\62\x2e\x30\x3a\x61\x74\x74\x72\x6e\x61\155\x65\x2d\146\x6f\162\x6d\x61\x74\72\x75\156\x73\x70\145\x63\x69\x66\151\x65\x64")) {
                goto Jj;
            }
            $Aa->setAttribute("\116\141\x6d\145\106\x6f\162\x6d\141\164", $this->nameFormat);
            Jj:
            foreach ($EP as $qO) {
                if (is_string($qO)) {
                    goto gQ;
                }
                if (is_int($qO)) {
                    goto j2;
                }
                $dE = NULL;
                goto eB;
                gQ:
                $dE = "\170\163\x3a\163\164\x72\151\x6e\147";
                goto eB;
                j2:
                $dE = "\x78\163\72\x69\156\164\145\147\145\162";
                eB:
                $WZ = $XU->createElementNS("\x75\162\x6e\x3a\157\141\163\151\x73\x3a\156\141\155\145\163\72\x74\143\x3a\123\101\115\x4c\x3a\62\x2e\x30\x3a\x61\163\163\x65\x72\164\x69\x6f\x6e", "\x73\x61\x6d\x6c\x3a\101\164\164\x72\x69\x62\x75\164\145\x56\x61\154\165\145");
                $Aa->appendChild($WZ);
                if (!($dE !== NULL)) {
                    goto px;
                }
                $WZ->setAttributeNS("\x68\164\x74\160\x3a\57\x2f\167\x77\167\x2e\167\63\56\157\162\x67\57\62\60\x30\x31\57\x58\115\x4c\123\x63\x68\x65\x6d\141\55\x69\x6e\163\x74\141\156\143\145", "\170\163\151\x3a\x74\171\x70\x65", $dE);
                px:
                if (!is_null($qO)) {
                    goto Nv;
                }
                $WZ->setAttributeNS("\150\164\x74\160\72\x2f\57\x77\x77\x77\x2e\x77\63\56\x6f\x72\147\57\62\60\60\61\x2f\x58\x4d\114\x53\143\x68\145\x6d\141\x2d\151\156\x73\x74\x61\x6e\143\145", "\170\x73\151\x3a\x6e\x69\154", "\x74\162\165\x65");
                Nv:
                if ($qO instanceof DOMNodeList) {
                    goto GQ;
                }
                $WZ->appendChild($XU->createTextNode($qO));
                goto m2;
                GQ:
                $n5 = 0;
                rp:
                if (!($n5 < $qO->length)) {
                    goto ii;
                }
                $SP = $XU->importNode($qO->item($n5), TRUE);
                $WZ->appendChild($SP);
                O3:
                $n5++;
                goto rp;
                ii:
                m2:
                HI:
            }
            Ia:
            lR:
        }
        DG:
    }
    private function addEncryptedAttributeStatement(DOMElement $V1)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto Sy;
        }
        return;
        Sy:
        $XU = $V1->ownerDocument;
        $lH = $XU->createElementNS("\x75\162\x6e\72\157\141\x73\151\x73\x3a\x6e\141\x6d\x65\163\72\164\x63\72\123\101\x4d\114\72\x32\x2e\60\72\x61\163\x73\x65\162\164\151\157\x6e", "\163\x61\155\154\72\x41\164\164\x72\151\x62\x75\x74\x65\123\164\x61\164\145\155\145\x6e\x74");
        $V1->appendChild($lH);
        foreach ($this->attributes as $cg => $EP) {
            $Rl = new DOMDocument();
            $Aa = $Rl->createElementNS("\165\x72\156\72\157\x61\x73\151\163\72\156\x61\x6d\145\x73\72\x74\143\72\123\101\x4d\114\x3a\62\x2e\60\x3a\141\163\x73\145\x72\x74\151\157\x6e", "\163\x61\155\x6c\72\x41\164\x74\x72\151\x62\x75\x74\x65");
            $Aa->setAttribute("\116\141\x6d\x65", $cg);
            $Rl->appendChild($Aa);
            if (!($this->nameFormat !== "\165\x72\156\72\157\x61\163\x69\x73\x3a\156\x61\155\145\163\72\x74\x63\72\123\101\115\x4c\72\x32\56\x30\x3a\x61\x74\x74\x72\156\x61\155\x65\55\146\x6f\162\155\x61\x74\x3a\x75\156\x73\x70\145\143\151\146\151\145\x64")) {
                goto UO;
            }
            $Aa->setAttribute("\116\x61\x6d\x65\x46\x6f\162\x6d\141\164", $this->nameFormat);
            UO:
            foreach ($EP as $qO) {
                if (is_string($qO)) {
                    goto Yz;
                }
                if (is_int($qO)) {
                    goto tb;
                }
                $dE = NULL;
                goto l0;
                Yz:
                $dE = "\170\163\72\163\x74\162\x69\x6e\147";
                goto l0;
                tb:
                $dE = "\x78\163\72\x69\156\164\x65\x67\145\162";
                l0:
                $WZ = $Rl->createElementNS("\165\x72\x6e\x3a\157\x61\x73\x69\163\72\156\141\155\x65\163\72\164\143\x3a\x53\101\115\114\72\x32\x2e\x30\x3a\141\163\163\x65\x72\x74\x69\157\156", "\x73\x61\x6d\154\72\101\x74\x74\162\x69\142\165\164\145\x56\141\154\x75\145");
                $Aa->appendChild($WZ);
                if (!($dE !== NULL)) {
                    goto ad;
                }
                $WZ->setAttributeNS("\x68\x74\164\160\x3a\x2f\x2f\x77\167\167\x2e\x77\63\x2e\157\162\147\x2f\62\x30\60\x31\x2f\130\115\114\x53\x63\x68\x65\155\141\55\151\x6e\x73\x74\x61\x6e\x63\145", "\170\x73\151\x3a\x74\171\x70\145", $dE);
                ad:
                if ($qO instanceof DOMNodeList) {
                    goto gG;
                }
                $WZ->appendChild($Rl->createTextNode($qO));
                goto CI;
                gG:
                $n5 = 0;
                Lo:
                if (!($n5 < $qO->length)) {
                    goto Js;
                }
                $SP = $Rl->importNode($qO->item($n5), TRUE);
                $WZ->appendChild($SP);
                e2:
                $n5++;
                goto Lo;
                Js:
                CI:
                zV:
            }
            Pc:
            $O2 = new XMLSecEnc();
            $O2->setNode($Rl->documentElement);
            $O2->type = "\150\x74\x74\160\x3a\x2f\x2f\167\x77\167\56\167\x33\56\157\162\147\57\62\60\x30\61\x2f\x30\x34\57\170\x6d\x6c\x65\156\143\43\105\x6c\145\x6d\145\x6e\164";
            $mI = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $mI->generateSessionKey();
            $O2->encryptKey($this->encryptionKey, $mI);
            $lR = $O2->encryptNode($mI);
            $KV = $XU->createElementNS("\165\162\x6e\72\x6f\x61\x73\151\163\x3a\x6e\x61\x6d\145\163\x3a\x74\x63\x3a\x53\101\x4d\114\72\62\x2e\60\72\141\163\163\x65\162\164\x69\157\x6e", "\163\141\x6d\154\x3a\105\156\143\162\171\160\x74\145\144\x41\x74\x74\x72\151\142\x75\164\x65");
            $lH->appendChild($KV);
            $mr = $XU->importNode($lR, TRUE);
            $KV->appendChild($mr);
            Qo:
        }
        D3:
    }
}
