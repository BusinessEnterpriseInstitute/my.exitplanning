<?php


include_once "\125\164\151\154\x69\164\151\145\x73\x2e\x70\x68\x70";
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
    public function __construct(DOMElement $ln = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\162\x6e\72\157\141\x73\151\x73\72\156\x61\x6d\x65\163\x3a\164\143\x3a\x53\x41\115\114\x3a\x31\56\x31\x3a\x6e\141\x6d\145\x69\144\55\x66\x6f\162\155\x61\x74\72\x75\x6e\163\160\x65\143\x69\x66\151\145\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($ln === NULL)) {
            goto Yb;
        }
        return;
        Yb:
        if (!($ln->localName === "\105\156\143\x72\x79\x70\164\145\144\x41\x73\163\x65\162\x74\x69\x6f\x6e")) {
            goto WJ;
        }
        $eY = Utilities::xpQuery($ln, "\x2e\x2f\170\x65\x6e\x63\x3a\105\156\x63\162\171\x70\x74\145\144\104\x61\164\x61");
        $Cs = Utilities::xpQuery($ln, "\56\57\x78\x65\156\x63\x3a\x45\x6e\143\162\x79\160\x74\x65\144\x44\x61\x74\x61\57\x64\163\x3a\113\x65\171\x49\156\146\x6f\57\170\145\156\x63\72\x45\156\143\162\x79\x70\164\145\144\113\x65\x79");
        $Cp = '';
        if (empty($Cs)) {
            goto hz;
        }
        $Cp = $Cs[0]->firstChild->getAttribute("\x41\154\x67\x6f\x72\151\164\x68\155");
        goto ok;
        hz:
        $Cs = Utilities::xpQuery($ln, "\56\x2f\170\145\156\x63\x3a\105\x6e\x63\x72\x79\x70\x74\145\x64\x4b\145\x79\57\170\145\x6e\x63\72\105\156\143\x72\171\x70\x74\151\x6f\156\x4d\x65\164\x68\x6f\x64");
        $Cp = $Cs[0]->getAttribute("\101\x6c\x67\157\x72\151\164\150\155");
        ok:
        $t5 = Utilities::getEncryptionAlgorithm($Cp);
        if (count($eY) === 0) {
            goto bf;
        }
        if (count($eY) > 1) {
            goto z4;
        }
        goto LR;
        bf:
        throw new Exception("\115\151\x73\x73\x69\x6e\x67\x20\145\156\143\162\171\160\164\145\x64\40\144\x61\x74\x61\40\x69\x6e\40\x3c\163\141\155\x6c\72\105\156\143\x72\x79\160\x74\x65\x64\101\163\163\x65\162\164\151\157\x6e\76\56");
        goto LR;
        z4:
        throw new Exception("\x4d\157\162\x65\x20\x74\150\x61\x6e\40\x6f\156\145\x20\x65\156\143\x72\171\160\x74\x65\x64\40\x64\x61\x74\141\40\145\154\x65\155\x65\156\x74\40\151\x6e\x20\74\163\x61\x6d\x6c\72\105\156\143\x72\171\x70\x74\145\x64\101\163\x73\145\x72\164\x69\x6f\156\x3e\56");
        LR:
        $qT = new XMLSecurityKey($t5, array("\164\x79\160\145" => "\x70\162\x69\x76\x61\x74\145"));
        $lY = drupal_get_path("\x6d\157\x64\x75\154\x65", "\155\x69\x6e\x69\x6f\162\141\156\147\145\x5f\163\x61\x6d\x6c");
        $Pk = $lY . "\57\162\145\x73\x6f\165\162\x63\145\x73\x2f\x73\160\x2d\x6b\145\x79\x2e\x6b\145\x79";
        $qT->loadKey($Pk, TRUE);
        $gO = new XMLSecurityKey($t5, array("\x74\x79\x70\145" => "\x70\162\x69\166\141\164\x65"));
        $A5 = $lY . "\x2f\x72\145\163\x6f\165\x72\143\145\x73\x2f\155\x69\156\x69\x6f\162\x61\x6e\147\145\137\163\x70\x5f\160\162\x69\166\137\153\145\171\56\153\145\171";
        $gO->loadKey($A5, TRUE);
        $c3 = array();
        $ln = Utilities::decryptElement($eY[0], $qT, $c3, $gO);
        WJ:
        if ($ln->hasAttribute("\x49\104")) {
            goto YY;
        }
        throw new Exception("\x4d\x69\x73\163\x69\x6e\147\40\x49\x44\40\141\x74\x74\x72\x69\142\165\164\x65\x20\x6f\x6e\40\x53\101\115\x4c\x20\x61\x73\x73\145\x72\164\x69\x6f\156\56");
        YY:
        $this->id = $ln->getAttribute("\x49\104");
        if (!($ln->getAttribute("\x56\x65\x72\163\151\157\x6e") !== "\62\x2e\60")) {
            goto Uv;
        }
        throw new Exception("\125\x6e\163\165\160\x70\x6f\162\164\145\x64\x20\166\x65\162\163\151\x6f\x6e\72\x20" . $ln->getAttribute("\x56\145\x72\x73\x69\x6f\x6e"));
        Uv:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($ln->getAttribute("\111\x73\x73\165\145\111\156\x73\164\x61\156\x74"));
        $KU = Utilities::xpQuery($ln, "\56\x2f\x73\x61\155\154\x5f\x61\x73\x73\145\162\164\x69\x6f\156\x3a\x49\163\163\x75\x65\162");
        if (!empty($KU)) {
            goto ta;
        }
        throw new Exception("\115\151\163\x73\x69\x6e\147\40\74\163\x61\155\154\72\111\163\163\165\x65\x72\76\x20\151\x6e\x20\x61\163\163\x65\162\164\151\x6f\x6e\56");
        ta:
        $this->issuer = trim($KU[0]->textContent);
        $this->parseConditions($ln);
        $this->parseAuthnStatement($ln);
        $this->parseAttributes($ln);
        $this->parseEncryptedAttributes($ln);
        $this->parseSignature($ln);
        $this->parseSubject($ln);
    }
    private function parseSubject(DOMElement $ln)
    {
        $rs = Utilities::xpQuery($ln, "\56\57\163\141\x6d\154\x5f\141\x73\163\x65\162\164\x69\x6f\x6e\72\123\165\x62\x6a\x65\143\x74");
        if (empty($rs)) {
            goto iI;
        }
        if (count($rs) > 1) {
            goto DN;
        }
        goto jT;
        iI:
        return;
        goto jT;
        DN:
        throw new Exception("\115\x6f\x72\x65\x20\164\x68\141\x6e\x20\157\156\145\x20\x3c\x73\141\155\154\x3a\x53\165\x62\x6a\x65\143\164\x3e\40\x69\156\40\x3c\x73\141\x6d\154\72\x41\163\163\145\x72\x74\x69\x6f\156\76\56");
        jT:
        $rs = $rs[0];
        $BP = Utilities::xpQuery($rs, "\56\x2f\x73\141\x6d\154\x5f\x61\163\163\145\x72\x74\151\x6f\156\x3a\116\141\x6d\x65\111\104\x20\x7c\40\56\x2f\x73\141\x6d\x6c\137\x61\163\163\145\162\164\151\157\156\x3a\105\156\x63\x72\171\x70\164\145\x64\x49\104\x2f\170\145\156\143\72\x45\156\x63\162\171\x70\x74\145\144\104\141\x74\141");
        if (empty($BP)) {
            goto jP;
        }
        if (count($BP) > 1) {
            goto wD;
        }
        goto PT;
        jP:
        throw new Exception("\115\x69\163\x73\x69\x6e\147\40\x3c\163\141\x6d\x6c\72\116\141\x6d\145\111\104\x3e\40\157\x72\x20\74\x73\141\x6d\x6c\72\x45\x6e\143\162\x79\160\164\145\x64\x49\104\x3e\40\151\156\x20\74\163\x61\155\x6c\72\x53\165\x62\x6a\145\143\x74\76\56");
        goto PT;
        wD:
        throw new Exception("\115\x6f\162\145\40\164\150\141\156\x20\157\156\145\40\x3c\163\141\x6d\154\72\x4e\x61\x6d\x65\111\x44\x3e\40\157\x72\x20\x3c\163\x61\155\154\x3a\105\156\x63\162\171\x70\x74\145\144\104\76\x20\151\x6e\40\x3c\163\141\x6d\154\x3a\x53\165\142\152\x65\x63\x74\x3e\56");
        PT:
        $BP = $BP[0];
        if ($BP->localName === "\105\156\x63\x72\x79\160\x74\145\144\x44\x61\x74\141") {
            goto WA;
        }
        $this->nameId = Utilities::parseNameId($BP);
        goto kE;
        WA:
        $this->encryptedNameId = $BP;
        kE:
    }
    private function parseConditions(DOMElement $ln)
    {
        $W0 = Utilities::xpQuery($ln, "\x2e\57\163\141\x6d\154\x5f\x61\x73\163\x65\x72\164\x69\157\x6e\72\103\157\156\x64\x69\x74\x69\157\156\x73");
        if (empty($W0)) {
            goto n1;
        }
        if (count($W0) > 1) {
            goto NK;
        }
        goto EJ;
        n1:
        return;
        goto EJ;
        NK:
        throw new Exception("\x4d\157\x72\x65\40\164\x68\x61\156\40\157\156\145\40\74\163\141\x6d\154\x3a\x43\x6f\156\x64\151\164\151\x6f\x6e\x73\76\x20\x69\156\x20\74\x73\141\155\x6c\72\101\163\163\x65\x72\x74\151\x6f\156\76\56");
        EJ:
        $W0 = $W0[0];
        if (!$W0->hasAttribute("\116\x6f\x74\102\145\x66\157\x72\145")) {
            goto Kk;
        }
        $Oa = Utilities::xsDateTimeToTimestamp($W0->getAttribute("\116\157\164\102\x65\x66\x6f\162\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $Oa)) {
            goto GZ;
        }
        $this->notBefore = $Oa;
        GZ:
        Kk:
        if (!$W0->hasAttribute("\x4e\157\x74\117\x6e\x4f\x72\x41\x66\164\145\x72")) {
            goto gE;
        }
        $pH = Utilities::xsDateTimeToTimestamp($W0->getAttribute("\116\x6f\164\117\x6e\117\162\x41\146\164\145\162"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $pH)) {
            goto d_;
        }
        $this->notOnOrAfter = $pH;
        d_:
        gE:
        $Cz = $W0->firstChild;
        Ma:
        if (!($Cz !== NULL)) {
            goto hl;
        }
        if (!$Cz instanceof DOMText) {
            goto RK;
        }
        goto ka;
        RK:
        if (!($Cz->namespaceURI !== "\x75\x72\156\72\x6f\141\163\x69\163\72\156\x61\x6d\x65\x73\x3a\164\x63\72\x53\x41\x4d\114\x3a\x32\56\x30\72\x61\x73\x73\x65\x72\164\x69\x6f\x6e")) {
            goto UR;
        }
        throw new Exception("\x55\x6e\153\x6e\157\167\156\x20\x6e\141\x6d\x65\163\x70\141\x63\145\40\x6f\146\x20\x63\157\156\x64\151\164\151\157\156\72\40" . var_export($Cz->namespaceURI, TRUE));
        UR:
        switch ($Cz->localName) {
            case "\x41\165\144\151\x65\x6e\143\x65\122\145\x73\164\162\151\x63\164\151\157\156":
                $c9 = Utilities::extractStrings($Cz, "\165\x72\x6e\x3a\x6f\x61\163\x69\x73\x3a\156\x61\155\x65\163\x3a\x74\x63\72\x53\x41\x4d\x4c\x3a\x32\56\x30\72\141\163\163\x65\x72\x74\x69\157\x6e", "\x41\x75\144\x69\x65\x6e\143\145");
                if ($this->validAudiences === NULL) {
                    goto rw;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $c9);
                goto ML;
                rw:
                $this->validAudiences = $c9;
                ML:
                goto KX;
            case "\x4f\x6e\x65\x54\x69\155\x65\125\x73\x65":
                goto KX;
            case "\x50\x72\157\170\x79\x52\145\163\x74\162\x69\143\x74\x69\157\156":
                goto KX;
            default:
                throw new Exception("\x55\156\153\x6e\157\167\156\x20\x63\157\x6e\x64\151\x74\151\x6f\156\72\40" . var_export($Cz->localName, TRUE));
        }
        SV:
        KX:
        ka:
        $Cz = $Cz->nextSibling;
        goto Ma;
        hl:
    }
    private function parseAuthnStatement(DOMElement $ln)
    {
        $Ab = Utilities::xpQuery($ln, "\56\57\163\141\x6d\154\137\141\x73\x73\145\162\x74\151\x6f\156\x3a\101\165\x74\x68\156\123\x74\x61\x74\145\x6d\145\156\x74");
        if (empty($Ab)) {
            goto Lt;
        }
        if (count($Ab) > 1) {
            goto s2;
        }
        goto lZ;
        Lt:
        $this->authnInstant = NULL;
        return;
        goto lZ;
        s2:
        throw new Exception("\115\157\x72\145\x20\x74\150\141\x74\40\x6f\156\x65\x20\x3c\x73\141\155\154\x3a\x41\x75\x74\150\x6e\123\x74\x61\x74\x65\155\145\156\164\76\40\151\156\40\x3c\x73\141\155\x6c\x3a\x41\163\x73\145\162\164\151\157\156\76\40\156\x6f\164\x20\163\165\160\160\x6f\x72\x74\145\x64\x2e");
        lZ:
        $DI = $Ab[0];
        if ($DI->hasAttribute("\101\x75\x74\x68\156\111\156\x73\164\x61\156\164")) {
            goto Ys;
        }
        throw new Exception("\115\151\x73\x73\151\156\x67\40\162\145\161\165\151\162\145\x64\x20\101\165\x74\x68\x6e\x49\156\x73\x74\x61\156\164\40\141\164\x74\162\151\142\165\164\x65\40\157\x6e\40\x3c\163\x61\x6d\x6c\72\101\x75\x74\x68\x6e\123\164\x61\164\145\x6d\x65\156\164\x3e\x2e");
        Ys:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($DI->getAttribute("\x41\x75\164\150\x6e\x49\x6e\x73\164\141\x6e\x74"));
        if (!$DI->hasAttribute("\x53\x65\163\x73\151\x6f\156\116\x6f\164\x4f\x6e\117\162\101\146\x74\x65\x72")) {
            goto td;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($DI->getAttribute("\x53\x65\163\163\x69\157\156\116\157\x74\x4f\156\117\162\101\146\x74\145\x72"));
        td:
        if (!$DI->hasAttribute("\123\x65\x73\x73\x69\157\x6e\x49\x6e\x64\145\170")) {
            goto mv;
        }
        $this->sessionIndex = $DI->getAttribute("\123\145\163\163\x69\157\156\111\x6e\x64\x65\x78");
        mv:
        $this->parseAuthnContext($DI);
    }
    private function parseAuthnContext(DOMElement $jW)
    {
        $Va = Utilities::xpQuery($jW, "\56\57\x73\141\155\154\137\x61\x73\163\x65\x72\164\151\x6f\156\72\x41\165\164\x68\x6e\103\x6f\x6e\164\145\x78\164");
        if (count($Va) > 1) {
            goto L9;
        }
        if (empty($Va)) {
            goto Sr;
        }
        goto z2;
        L9:
        throw new Exception("\x4d\157\x72\145\x20\x74\150\141\x6e\x20\x6f\156\x65\40\74\163\141\x6d\154\x3a\x41\165\x74\150\156\x43\x6f\x6e\x74\145\x78\164\x3e\40\151\x6e\40\74\x73\141\155\x6c\72\x41\165\x74\150\156\123\x74\141\x74\x65\155\x65\x6e\x74\76\x2e");
        goto z2;
        Sr:
        throw new Exception("\x4d\x69\x73\x73\151\156\147\40\x72\145\x71\165\151\x72\145\x64\x20\x3c\163\141\155\x6c\72\x41\165\164\150\x6e\x43\x6f\156\164\145\170\164\x3e\x20\151\156\x20\x3c\163\141\x6d\154\x3a\x41\x75\x74\x68\156\123\164\141\164\x65\x6d\145\x6e\164\x3e\56");
        z2:
        $Nq = $Va[0];
        $xA = Utilities::xpQuery($Nq, "\56\x2f\x73\141\x6d\154\x5f\x61\x73\x73\145\x72\164\x69\157\x6e\72\101\x75\164\x68\x6e\x43\x6f\x6e\164\x65\x78\164\x44\x65\x63\154\x52\x65\x66");
        if (count($xA) > 1) {
            goto YQ;
        }
        if (count($xA) === 1) {
            goto O7;
        }
        goto wx;
        YQ:
        throw new Exception("\x4d\157\x72\x65\x20\164\150\141\x6e\x20\157\x6e\x65\40\74\163\141\155\154\72\101\x75\x74\150\156\x43\157\156\x74\x65\170\x74\104\x65\x63\x6c\122\x65\146\x3e\x20\146\157\x75\156\144\77");
        goto wx;
        O7:
        $this->setAuthnContextDeclRef(trim($xA[0]->textContent));
        wx:
        $iB = Utilities::xpQuery($Nq, "\x2e\57\x73\x61\155\154\137\141\x73\x73\x65\x72\164\151\x6f\156\x3a\101\165\164\150\156\103\157\156\x74\x65\170\x74\104\x65\x63\154");
        if (count($iB) > 1) {
            goto Vi;
        }
        if (count($iB) === 1) {
            goto ga;
        }
        goto Et;
        Vi:
        throw new Exception("\115\x6f\162\145\x20\x74\x68\141\x6e\x20\157\x6e\x65\40\x3c\x73\141\x6d\x6c\x3a\101\x75\164\150\156\103\157\156\x74\x65\x78\x74\104\x65\143\x6c\x3e\x20\x66\157\x75\156\144\77");
        goto Et;
        ga:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($iB[0]));
        Et:
        $vS = Utilities::xpQuery($Nq, "\56\57\x73\141\155\154\137\141\163\163\x65\162\164\x69\x6f\156\72\101\x75\164\x68\x6e\103\x6f\156\164\x65\x78\x74\103\x6c\141\x73\x73\x52\145\146");
        if (count($vS) > 1) {
            goto Yn;
        }
        if (count($vS) === 1) {
            goto g5;
        }
        goto I4;
        Yn:
        throw new Exception("\115\x6f\162\x65\x20\164\150\141\x6e\40\157\x6e\145\40\x3c\163\141\x6d\x6c\x3a\101\165\x74\x68\156\x43\157\156\164\x65\170\x74\x43\x6c\141\163\163\122\x65\146\76\x20\151\x6e\40\x3c\x73\141\x6d\154\x3a\x41\x75\164\x68\x6e\103\x6f\156\164\145\x78\x74\76\x2e");
        goto I4;
        g5:
        $this->setAuthnContextClassRef(trim($vS[0]->textContent));
        I4:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto ZK;
        }
        throw new Exception("\x4d\x69\163\163\151\156\147\40\x65\151\x74\x68\145\162\40\x3c\163\141\x6d\x6c\72\101\165\x74\150\156\103\x6f\x6e\x74\145\x78\164\103\154\x61\x73\x73\122\x65\146\x3e\40\157\x72\40\x3c\x73\141\155\154\x3a\x41\165\164\150\156\x43\157\x6e\x74\145\x78\x74\104\x65\x63\x6c\x52\145\146\76\x20\x6f\x72\x20\74\x73\x61\x6d\154\x3a\x41\165\164\150\156\x43\x6f\x6e\164\x65\170\x74\x44\145\x63\x6c\76");
        ZK:
        $this->AuthenticatingAuthority = Utilities::extractStrings($Nq, "\x75\x72\156\72\x6f\141\x73\x69\163\72\x6e\141\155\x65\x73\72\164\143\72\x53\101\x4d\x4c\72\62\x2e\x30\x3a\x61\163\163\x65\162\x74\x69\x6f\156", "\x41\x75\164\x68\145\x6e\164\151\143\141\164\151\156\x67\101\165\x74\x68\157\162\151\164\x79");
    }
    private function parseAttributes(DOMElement $ln)
    {
        $Fo = TRUE;
        $TP = Utilities::xpQuery($ln, "\56\x2f\163\x61\x6d\154\x5f\x61\x73\x73\145\162\164\x69\x6f\156\x3a\101\x74\x74\x72\151\x62\165\x74\145\123\164\141\x74\145\x6d\145\x6e\x74\57\163\x61\155\x6c\137\141\163\x73\145\162\164\151\157\156\x3a\x41\164\164\x72\151\x62\165\x74\145");
        foreach ($TP as $A9) {
            if ($A9->hasAttribute("\x4e\x61\x6d\x65")) {
                goto Zr;
            }
            throw new Exception("\x4d\151\163\x73\151\x6e\x67\40\156\141\155\x65\x20\157\x6e\40\74\x73\141\155\154\x3a\101\164\x74\162\151\142\165\164\x65\x3e\x20\145\x6c\145\155\145\156\164\x2e");
            Zr:
            $m9 = $A9->getAttribute("\116\x61\155\145");
            if ($A9->hasAttribute("\x4e\141\x6d\x65\106\x6f\162\155\x61\164")) {
                goto Yj;
            }
            $O0 = "\165\162\x6e\72\x6f\141\163\151\x73\72\156\141\155\x65\x73\x3a\164\x63\x3a\x53\x41\x4d\114\72\61\56\x31\x3a\156\x61\x6d\145\x69\x64\x2d\x66\157\x72\155\x61\x74\72\x75\156\163\160\145\x63\x69\146\x69\x65\x64";
            goto Hc;
            Yj:
            $O0 = $A9->getAttribute("\x4e\x61\155\x65\x46\157\162\x6d\141\x74");
            Hc:
            if ($Fo) {
                goto Cs;
            }
            if (!($this->nameFormat !== $O0)) {
                goto jd;
            }
            $this->nameFormat = "\x75\x72\156\x3a\x6f\141\x73\x69\x73\72\x6e\x61\155\145\x73\72\x74\143\x3a\x53\x41\115\114\72\x31\x2e\x31\72\156\x61\155\145\x69\x64\x2d\x66\157\x72\155\141\164\x3a\165\x6e\x73\160\x65\143\x69\x66\151\x65\x64";
            jd:
            goto Xh;
            Cs:
            $this->nameFormat = $O0;
            $Fo = FALSE;
            Xh:
            if (array_key_exists($m9, $this->attributes)) {
                goto uF;
            }
            $this->attributes[$m9] = array();
            uF:
            $pP = Utilities::xpQuery($A9, "\56\57\x73\141\x6d\154\x5f\x61\163\x73\x65\x72\x74\x69\x6f\x6e\72\x41\164\x74\162\x69\142\x75\x74\x65\x56\x61\x6c\x75\x65");
            foreach ($pP as $e4) {
                $this->attributes[$m9][] = trim($e4->textContent);
                w7:
            }
            ch:
            bX:
        }
        GN:
    }
    private function parseEncryptedAttributes(DOMElement $ln)
    {
        $this->encryptedAttribute = Utilities::xpQuery($ln, "\x2e\57\163\141\155\154\137\141\x73\163\145\x72\164\151\x6f\156\72\x41\x74\164\162\x69\142\165\164\145\123\164\141\164\x65\x6d\145\x6e\x74\57\163\141\155\x6c\137\x61\163\x73\x65\x72\x74\x69\157\156\x3a\x45\156\143\x72\171\160\164\x65\144\x41\164\164\x72\x69\x62\x75\164\x65");
    }
    private function parseSignature(DOMElement $ln)
    {
        $ht = Utilities::validateElement($ln);
        if (!($ht !== FALSE)) {
            goto Y6;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $ht["\x43\145\x72\164\151\146\x69\143\x61\x74\145\163"];
        $this->signatureData = $ht;
        Y6:
    }
    public function validate(XMLSecurityKey $qT)
    {
        if (!($this->signatureData === NULL)) {
            goto yO;
        }
        return FALSE;
        yO:
        Utilities::validateSignature($this->signatureData, $qT);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($UZ)
    {
        $this->id = $UZ;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($uV)
    {
        $this->issueInstant = $uV;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($KU)
    {
        $this->issuer = $KU;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto h2;
        }
        throw new Exception("\x41\x74\164\x65\155\x70\164\145\x64\40\x74\157\40\162\145\x74\x72\151\145\166\145\x20\145\156\143\162\x79\x70\164\x65\x64\40\116\x61\155\x65\111\104\x20\x77\151\x74\x68\x6f\165\164\40\144\145\x63\162\171\x70\164\151\156\x67\40\x69\x74\x20\146\151\162\x73\164\x2e");
        h2:
        return $this->nameId;
    }
    public function setNameId($BP)
    {
        $this->nameId = $BP;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto en;
        }
        return TRUE;
        en:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $qT)
    {
        $Sj = new DOMDocument();
        $t2 = $Sj->createElement("\x72\x6f\x6f\x74");
        $Sj->appendChild($t2);
        Utilities::addNameId($t2, $this->nameId);
        $BP = $t2->firstChild;
        Utilities::getContainer()->debugMessage($BP, "\145\x6e\x63\x72\x79\160\164");
        $Le = new XMLSecEnc();
        $Le->setNode($BP);
        $Le->type = XMLSecEnc::Element;
        $QM = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $QM->generateSessionKey();
        $Le->encryptKey($qT, $QM);
        $this->encryptedNameId = $Le->encryptNode($QM);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $qT, array $c3 = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto gb;
        }
        return;
        gb:
        $BP = Utilities::decryptElement($this->encryptedNameId, $qT, $c3);
        Utilities::getContainer()->debugMessage($BP, "\144\145\143\162\x79\x70\164");
        $this->nameId = Utilities::parseNameId($BP);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $qT, array $c3 = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto n3;
        }
        return;
        n3:
        $Fo = TRUE;
        $TP = $this->encryptedAttribute;
        foreach ($TP as $SN) {
            $A9 = Utilities::decryptElement($SN->getElementsByTagName("\105\x6e\143\162\x79\x70\164\145\144\x44\x61\164\141")->item(0), $qT, $c3);
            if ($A9->hasAttribute("\x4e\x61\x6d\x65")) {
                goto EU;
            }
            throw new Exception("\x4d\151\x73\163\151\156\x67\40\x6e\141\155\x65\x20\157\x6e\x20\x3c\x73\x61\155\x6c\72\101\164\164\162\151\x62\x75\x74\x65\76\40\145\x6c\x65\x6d\145\156\164\56");
            EU:
            $m9 = $A9->getAttribute("\x4e\x61\155\145");
            if ($A9->hasAttribute("\116\x61\x6d\x65\106\157\x72\x6d\x61\x74")) {
                goto MY;
            }
            $O0 = "\x75\x72\156\x3a\157\141\x73\151\x73\72\x6e\x61\155\x65\163\x3a\164\x63\72\123\x41\115\x4c\72\62\56\60\x3a\141\164\x74\162\x6e\141\155\145\x2d\146\x6f\x72\155\x61\164\x3a\165\156\x73\160\145\143\151\146\151\145\x64";
            goto bL;
            MY:
            $O0 = $A9->getAttribute("\x4e\141\x6d\145\x46\x6f\162\x6d\141\164");
            bL:
            if ($Fo) {
                goto cX;
            }
            if (!($this->nameFormat !== $O0)) {
                goto Tj;
            }
            $this->nameFormat = "\165\162\156\x3a\157\x61\x73\151\x73\72\156\141\x6d\x65\163\x3a\x74\x63\72\x53\101\x4d\114\x3a\62\56\x30\x3a\141\x74\164\162\156\141\x6d\x65\x2d\146\157\x72\x6d\x61\164\x3a\x75\156\x73\x70\x65\143\151\x66\x69\145\144";
            Tj:
            goto KQ;
            cX:
            $this->nameFormat = $O0;
            $Fo = FALSE;
            KQ:
            if (array_key_exists($m9, $this->attributes)) {
                goto CZ;
            }
            $this->attributes[$m9] = array();
            CZ:
            $pP = Utilities::xpQuery($A9, "\x2e\x2f\x73\141\x6d\x6c\x5f\x61\163\x73\145\162\164\x69\157\156\72\101\x74\x74\162\x69\x62\x75\x74\145\x56\141\x6c\x75\145");
            foreach ($pP as $e4) {
                $this->attributes[$m9][] = trim($e4->textContent);
                pY:
            }
            Zg:
            Vx:
        }
        ii:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($Oa)
    {
        $this->notBefore = $Oa;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($pH)
    {
        $this->notOnOrAfter = $pH;
    }
    public function setEncryptedAttributes($tg)
    {
        $this->requiredEncAttributes = $tg;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $Kf = NULL)
    {
        $this->validAudiences = $Kf;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($iF)
    {
        $this->authnInstant = $iF;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($Fn)
    {
        $this->sessionNotOnOrAfter = $Fn;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($l0)
    {
        $this->sessionIndex = $l0;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto ni;
        }
        return $this->authnContextClassRef;
        ni:
        if (empty($this->authnContextDeclRef)) {
            goto nW;
        }
        return $this->authnContextDeclRef;
        nW:
        return NULL;
    }
    public function setAuthnContext($en)
    {
        $this->setAuthnContextClassRef($en);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($wr)
    {
        $this->authnContextClassRef = $wr;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $k5)
    {
        if (empty($this->authnContextDeclRef)) {
            goto Rf;
        }
        throw new Exception("\x41\x75\164\150\x6e\x43\157\x6e\x74\145\x78\x74\104\x65\x63\x6c\x52\145\x66\40\151\163\40\141\x6c\x72\145\x61\144\x79\x20\x72\x65\147\x69\x73\164\x65\162\145\x64\x21\40\115\x61\x79\x20\x6f\x6e\x6c\171\x20\x68\x61\x76\145\x20\x65\x69\x74\x68\x65\x72\40\141\x20\104\x65\143\x6c\x20\157\x72\40\141\x20\104\145\143\154\x52\x65\146\54\40\x6e\x6f\x74\40\142\x6f\164\150\x21");
        Rf:
        $this->authnContextDecl = $k5;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($IR)
    {
        if (empty($this->authnContextDecl)) {
            goto JM;
        }
        throw new Exception("\101\165\164\x68\x6e\x43\157\x6e\164\x65\x78\x74\x44\x65\x63\154\40\151\163\x20\141\x6c\162\x65\x61\x64\x79\40\162\x65\147\151\x73\164\145\162\145\x64\x21\x20\115\141\x79\x20\157\156\154\171\40\150\x61\x76\145\40\x65\x69\164\x68\145\162\40\141\40\x44\145\143\x6c\x20\x6f\162\40\x61\40\104\x65\143\x6c\122\x65\x66\x2c\x20\156\157\x74\x20\x62\157\164\x68\x21");
        JM:
        $this->authnContextDeclRef = $IR;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($fM)
    {
        $this->AuthenticatingAuthority = $fM;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $TP)
    {
        $this->attributes = $TP;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($O0)
    {
        $this->nameFormat = $O0;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $n5)
    {
        $this->SubjectConfirmation = $n5;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $tw = NULL)
    {
        $this->signatureKey = $tw;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $zv = NULL)
    {
        $this->encryptionKey = $zv;
    }
    public function setCertificates(array $Mp)
    {
        $this->certificates = $Mp;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $Tf = NULL)
    {
        if ($Tf === NULL) {
            goto Sk;
        }
        $lQ = $Tf->ownerDocument;
        goto EV;
        Sk:
        $lQ = new DOMDocument();
        $Tf = $lQ;
        EV:
        $t2 = $lQ->createElementNS("\165\x72\156\x3a\x6f\x61\163\151\163\72\156\141\x6d\x65\163\x3a\164\x63\x3a\x53\x41\x4d\114\72\62\56\60\72\141\163\163\x65\x72\164\x69\157\x6e", "\163\141\155\154\72" . "\x41\x73\163\145\x72\164\x69\x6f\156");
        $Tf->appendChild($t2);
        $t2->setAttributeNS("\165\x72\x6e\x3a\157\141\x73\x69\163\x3a\156\141\155\145\163\72\x74\x63\x3a\123\x41\x4d\x4c\x3a\x32\56\x30\72\160\162\157\164\x6f\x63\157\x6c", "\163\x61\x6d\154\x70\72\x74\155\x70", "\x74\x6d\x70");
        $t2->removeAttributeNS("\165\x72\156\72\157\141\x73\151\163\x3a\x6e\141\155\x65\x73\x3a\164\x63\x3a\x53\101\115\114\x3a\62\x2e\x30\x3a\160\x72\157\x74\x6f\143\x6f\x6c", "\x74\155\160");
        $t2->setAttributeNS("\150\164\164\160\72\x2f\x2f\167\x77\167\56\167\x33\x2e\157\x72\x67\x2f\62\60\60\x31\x2f\x58\x4d\x4c\x53\143\x68\x65\155\141\55\151\156\x73\164\141\156\143\x65", "\170\163\x69\72\x74\155\x70", "\164\x6d\160");
        $t2->removeAttributeNS("\x68\x74\164\160\x3a\57\57\x77\167\167\56\167\x33\56\157\162\147\x2f\x32\x30\x30\61\57\130\115\x4c\123\x63\x68\x65\155\x61\55\x69\156\x73\164\x61\x6e\143\x65", "\x74\x6d\160");
        $t2->setAttributeNS("\x68\x74\164\x70\x3a\x2f\x2f\167\x77\167\x2e\167\63\x2e\157\162\x67\57\62\x30\x30\x31\57\x58\115\114\x53\x63\150\x65\155\141", "\170\x73\x3a\x74\155\160", "\x74\155\160");
        $t2->removeAttributeNS("\x68\x74\164\160\72\57\x2f\x77\x77\x77\56\167\x33\56\157\162\147\57\x32\60\60\61\x2f\130\115\114\x53\143\x68\145\x6d\141", "\x74\155\160");
        $t2->setAttribute("\x49\104", $this->id);
        $t2->setAttribute("\x56\145\162\x73\151\x6f\156", "\x32\x2e\x30");
        $t2->setAttribute("\111\163\x73\x75\x65\x49\156\163\164\x61\x6e\x74", gmdate("\x59\x2d\155\x2d\x64\134\124\110\72\151\x3a\163\134\x5a", $this->issueInstant));
        $KU = Utilities::addString($t2, "\165\162\x6e\x3a\x6f\141\x73\x69\x73\x3a\156\141\155\x65\163\72\x74\x63\x3a\123\101\115\114\72\x32\56\x30\x3a\x61\163\x73\145\x72\164\x69\x6f\156", "\163\x61\x6d\154\72\x49\x73\163\165\145\162", $this->issuer);
        $this->addSubject($t2);
        $this->addConditions($t2);
        $this->addAuthnStatement($t2);
        if ($this->requiredEncAttributes == FALSE) {
            goto kb;
        }
        $this->addEncryptedAttributeStatement($t2);
        goto aB;
        kb:
        $this->addAttributeStatement($t2);
        aB:
        if (!($this->signatureKey !== NULL)) {
            goto N1;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $t2, $KU->nextSibling);
        N1:
        return $t2;
    }
    private function addSubject(DOMElement $t2)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto wE;
        }
        return;
        wE:
        $rs = $t2->ownerDocument->createElementNS("\165\162\x6e\72\157\x61\163\151\163\72\156\x61\x6d\x65\163\x3a\x74\143\72\x53\101\x4d\114\x3a\x32\56\x30\72\141\163\163\x65\162\x74\x69\157\x6e", "\x73\141\155\154\72\123\165\142\152\x65\x63\164");
        $t2->appendChild($rs);
        if ($this->encryptedNameId === NULL) {
            goto HK;
        }
        $vX = $rs->ownerDocument->createElementNS("\165\162\x6e\x3a\157\x61\163\x69\x73\x3a\x6e\x61\155\145\163\72\x74\x63\72\x53\101\115\114\x3a\62\56\60\72\141\163\x73\x65\162\164\x69\157\x6e", "\163\141\x6d\x6c\72" . "\x45\156\x63\x72\x79\x70\164\145\x64\111\x44");
        $rs->appendChild($vX);
        $vX->appendChild($rs->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto mI;
        HK:
        Utilities::addNameId($rs, $this->nameId);
        mI:
        foreach ($this->SubjectConfirmation as $Wa) {
            $Wa->toXML($rs);
            zj:
        }
        TU:
    }
    private function addConditions(DOMElement $t2)
    {
        $lQ = $t2->ownerDocument;
        $W0 = $lQ->createElementNS("\165\x72\x6e\x3a\x6f\141\163\151\x73\72\156\x61\155\145\x73\x3a\x74\143\x3a\123\101\x4d\x4c\72\62\56\60\x3a\141\163\163\x65\162\x74\x69\157\x6e", "\163\x61\x6d\154\72\x43\x6f\156\144\151\x74\x69\x6f\x6e\163");
        $t2->appendChild($W0);
        if (!($this->notBefore !== NULL)) {
            goto dU;
        }
        $W0->setAttribute("\116\157\x74\102\145\146\x6f\162\x65", gmdate("\131\55\x6d\55\144\134\124\x48\x3a\151\x3a\x73\x5c\x5a", $this->notBefore));
        dU:
        if (!($this->notOnOrAfter !== NULL)) {
            goto D5;
        }
        $W0->setAttribute("\x4e\157\x74\x4f\x6e\117\162\x41\x66\x74\145\162", gmdate("\131\55\155\55\144\x5c\x54\110\72\151\x3a\x73\x5c\x5a", $this->notOnOrAfter));
        D5:
        if (!($this->validAudiences !== NULL)) {
            goto HB;
        }
        $Wm = $lQ->createElementNS("\x75\162\156\72\x6f\x61\x73\151\163\72\156\141\x6d\145\x73\72\164\143\x3a\x53\x41\115\114\72\x32\56\60\72\x61\x73\x73\145\162\x74\x69\x6f\x6e", "\x73\x61\155\x6c\x3a\x41\165\144\x69\145\x6e\x63\x65\122\x65\x73\164\162\x69\x63\x74\x69\x6f\x6e");
        $W0->appendChild($Wm);
        Utilities::addStrings($Wm, "\165\x72\x6e\72\157\x61\x73\x69\163\x3a\x6e\x61\155\x65\x73\x3a\164\143\x3a\x53\x41\115\x4c\x3a\62\x2e\x30\x3a\x61\x73\x73\x65\x72\x74\151\x6f\x6e", "\x73\x61\x6d\154\72\101\165\144\151\145\156\143\x65", FALSE, $this->validAudiences);
        HB:
    }
    private function addAuthnStatement(DOMElement $t2)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto jt;
        }
        return;
        jt:
        $lQ = $t2->ownerDocument;
        $jW = $lQ->createElementNS("\x75\162\156\72\x6f\141\x73\151\x73\72\x6e\x61\x6d\x65\x73\72\x74\143\72\123\x41\115\114\x3a\x32\x2e\x30\72\x61\x73\x73\x65\x72\164\x69\157\156", "\x73\141\155\154\72\101\x75\164\x68\156\123\x74\x61\164\x65\155\x65\x6e\164");
        $t2->appendChild($jW);
        $jW->setAttribute("\x41\165\164\150\x6e\x49\156\x73\x74\141\156\164", gmdate("\131\x2d\x6d\x2d\x64\x5c\x54\110\x3a\151\x3a\x73\x5c\x5a", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto nd;
        }
        $jW->setAttribute("\x53\145\x73\x73\x69\157\x6e\x4e\x6f\164\117\x6e\x4f\x72\101\x66\x74\145\x72", gmdate("\131\55\155\x2d\144\x5c\124\110\72\151\x3a\163\134\132", $this->sessionNotOnOrAfter));
        nd:
        if (!($this->sessionIndex !== NULL)) {
            goto uk;
        }
        $jW->setAttribute("\x53\x65\x73\x73\x69\x6f\x6e\x49\156\144\x65\x78", $this->sessionIndex);
        uk:
        $Nq = $lQ->createElementNS("\165\162\156\72\x6f\x61\163\151\163\x3a\156\x61\155\x65\163\72\x74\x63\72\123\101\115\x4c\72\x32\x2e\60\x3a\141\x73\163\x65\x72\x74\151\x6f\156", "\163\141\155\154\72\101\165\x74\150\x6e\x43\x6f\156\164\145\x78\x74");
        $jW->appendChild($Nq);
        if (empty($this->authnContextClassRef)) {
            goto q8;
        }
        Utilities::addString($Nq, "\165\x72\156\72\157\141\163\x69\x73\x3a\x6e\x61\155\145\x73\72\164\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\72\141\x73\x73\145\x72\x74\x69\157\156", "\163\141\x6d\x6c\x3a\x41\x75\164\150\x6e\x43\157\156\164\x65\x78\x74\x43\154\141\163\163\x52\145\146", $this->authnContextClassRef);
        q8:
        if (empty($this->authnContextDecl)) {
            goto WV;
        }
        $this->authnContextDecl->toXML($Nq);
        WV:
        if (empty($this->authnContextDeclRef)) {
            goto ht;
        }
        Utilities::addString($Nq, "\x75\162\156\72\157\141\163\x69\x73\72\156\141\x6d\x65\163\x3a\164\x63\x3a\x53\x41\115\x4c\x3a\62\56\60\72\x61\163\x73\x65\162\x74\151\x6f\x6e", "\163\141\155\154\x3a\x41\165\x74\x68\x6e\103\157\x6e\x74\x65\x78\164\104\145\143\154\122\145\x66", $this->authnContextDeclRef);
        ht:
        Utilities::addStrings($Nq, "\x75\x72\156\x3a\157\x61\163\151\163\72\x6e\141\155\145\163\72\x74\x63\x3a\x53\101\x4d\x4c\72\x32\56\60\x3a\141\x73\x73\x65\162\164\151\157\156", "\163\141\155\154\x3a\101\x75\x74\x68\x65\x6e\x74\151\x63\x61\164\151\x6e\x67\101\165\164\150\157\162\x69\164\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $t2)
    {
        if (!empty($this->attributes)) {
            goto V2;
        }
        return;
        V2:
        $lQ = $t2->ownerDocument;
        $k6 = $lQ->createElementNS("\165\x72\x6e\72\x6f\x61\x73\x69\163\72\156\x61\155\x65\163\x3a\x74\x63\72\123\x41\115\x4c\x3a\62\56\60\x3a\141\163\x73\145\x72\164\x69\157\x6e", "\x73\141\x6d\x6c\x3a\101\x74\x74\162\151\142\x75\164\145\123\x74\141\x74\x65\155\145\156\164");
        $t2->appendChild($k6);
        foreach ($this->attributes as $m9 => $pP) {
            $A9 = $lQ->createElementNS("\x75\162\156\x3a\157\x61\x73\151\x73\72\x6e\x61\155\145\x73\x3a\x74\x63\x3a\123\101\115\x4c\72\62\x2e\60\x3a\141\163\x73\145\x72\164\x69\x6f\156", "\x73\141\155\154\x3a\101\x74\164\162\151\142\165\x74\145");
            $k6->appendChild($A9);
            $A9->setAttribute("\116\141\x6d\x65", $m9);
            if (!($this->nameFormat !== "\x75\162\156\x3a\157\141\x73\151\x73\x3a\x6e\x61\155\145\x73\72\x74\143\72\123\x41\x4d\x4c\72\x32\56\60\x3a\141\x74\164\x72\x6e\141\155\x65\55\146\157\162\x6d\x61\x74\72\165\156\x73\160\x65\x63\x69\x66\151\145\144")) {
                goto YP;
            }
            $A9->setAttribute("\116\x61\155\145\x46\x6f\162\155\141\x74", $this->nameFormat);
            YP:
            foreach ($pP as $e4) {
                if (is_string($e4)) {
                    goto ub;
                }
                if (is_int($e4)) {
                    goto Hr;
                }
                $fd = NULL;
                goto d3;
                ub:
                $fd = "\x78\x73\x3a\x73\x74\x72\151\x6e\147";
                goto d3;
                Hr:
                $fd = "\x78\163\x3a\x69\156\x74\x65\147\145\162";
                d3:
                $Eq = $lQ->createElementNS("\x75\162\156\72\157\141\x73\x69\x73\x3a\x6e\141\x6d\145\163\x3a\x74\x63\72\x53\101\x4d\x4c\x3a\62\56\x30\72\x61\163\x73\145\162\x74\x69\x6f\156", "\x73\x61\x6d\x6c\72\101\x74\x74\x72\151\x62\x75\164\145\126\x61\154\x75\x65");
                $A9->appendChild($Eq);
                if (!($fd !== NULL)) {
                    goto K_;
                }
                $Eq->setAttributeNS("\x68\164\164\x70\x3a\x2f\57\167\167\x77\x2e\167\63\56\157\162\147\57\62\x30\60\x31\x2f\130\115\x4c\x53\x63\150\x65\x6d\x61\x2d\151\156\x73\x74\x61\x6e\x63\145", "\x78\x73\151\x3a\x74\x79\160\145", $fd);
                K_:
                if (!is_null($e4)) {
                    goto gf;
                }
                $Eq->setAttributeNS("\150\164\x74\160\72\57\x2f\167\167\x77\56\x77\x33\x2e\157\162\147\x2f\62\x30\60\x31\x2f\130\115\x4c\x53\143\150\145\x6d\x61\x2d\151\x6e\163\164\141\156\x63\x65", "\x78\163\151\x3a\156\151\154", "\x74\x72\165\x65");
                gf:
                if ($e4 instanceof DOMNodeList) {
                    goto nf;
                }
                $Eq->appendChild($lQ->createTextNode($e4));
                goto tS;
                nf:
                $zj = 0;
                ET:
                if (!($zj < $e4->length)) {
                    goto NY;
                }
                $Cz = $lQ->importNode($e4->item($zj), TRUE);
                $Eq->appendChild($Cz);
                M0:
                $zj++;
                goto ET;
                NY:
                tS:
                tG:
            }
            Bl:
            wb:
        }
        oK:
    }
    private function addEncryptedAttributeStatement(DOMElement $t2)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto h7;
        }
        return;
        h7:
        $lQ = $t2->ownerDocument;
        $k6 = $lQ->createElementNS("\165\162\x6e\x3a\157\x61\163\151\x73\x3a\x6e\x61\x6d\145\x73\x3a\x74\x63\72\123\101\x4d\x4c\72\62\x2e\60\x3a\x61\163\x73\145\x72\x74\151\x6f\x6e", "\163\x61\x6d\154\x3a\101\164\164\162\151\142\x75\x74\x65\x53\164\141\x74\145\155\145\x6e\x74");
        $t2->appendChild($k6);
        foreach ($this->attributes as $m9 => $pP) {
            $LC = new DOMDocument();
            $A9 = $LC->createElementNS("\x75\x72\x6e\72\157\x61\163\151\x73\72\x6e\x61\155\x65\163\x3a\x74\x63\72\123\x41\115\x4c\x3a\62\56\x30\x3a\141\x73\163\x65\x72\x74\151\x6f\x6e", "\163\x61\x6d\x6c\x3a\101\164\164\x72\x69\x62\165\x74\x65");
            $A9->setAttribute("\116\x61\155\145", $m9);
            $LC->appendChild($A9);
            if (!($this->nameFormat !== "\165\162\x6e\x3a\157\141\x73\x69\163\72\156\141\x6d\x65\163\x3a\164\x63\x3a\x53\101\x4d\x4c\72\x32\x2e\x30\x3a\141\164\x74\162\x6e\x61\155\145\x2d\x66\x6f\162\x6d\x61\164\x3a\165\x6e\163\160\x65\143\x69\x66\151\x65\144")) {
                goto t9;
            }
            $A9->setAttribute("\116\141\x6d\x65\x46\x6f\x72\155\141\164", $this->nameFormat);
            t9:
            foreach ($pP as $e4) {
                if (is_string($e4)) {
                    goto Yc;
                }
                if (is_int($e4)) {
                    goto up;
                }
                $fd = NULL;
                goto OD;
                Yc:
                $fd = "\170\163\72\163\x74\162\151\156\x67";
                goto OD;
                up:
                $fd = "\x78\163\72\151\156\164\x65\x67\x65\162";
                OD:
                $Eq = $LC->createElementNS("\x75\x72\156\72\x6f\141\x73\x69\163\72\x6e\141\x6d\x65\163\x3a\x74\x63\x3a\123\101\x4d\114\72\62\x2e\x30\x3a\141\x73\163\145\x72\164\x69\157\156", "\163\141\155\154\x3a\101\164\x74\162\151\x62\165\x74\145\126\141\154\x75\x65");
                $A9->appendChild($Eq);
                if (!($fd !== NULL)) {
                    goto kD;
                }
                $Eq->setAttributeNS("\x68\x74\164\x70\72\x2f\x2f\167\167\167\56\x77\63\56\157\x72\x67\x2f\x32\x30\60\x31\x2f\x58\x4d\114\x53\143\x68\x65\155\141\55\151\x6e\x73\x74\141\x6e\143\x65", "\x78\x73\151\72\x74\171\x70\x65", $fd);
                kD:
                if ($e4 instanceof DOMNodeList) {
                    goto gC;
                }
                $Eq->appendChild($LC->createTextNode($e4));
                goto nu;
                gC:
                $zj = 0;
                Y3:
                if (!($zj < $e4->length)) {
                    goto dA;
                }
                $Cz = $LC->importNode($e4->item($zj), TRUE);
                $Eq->appendChild($Cz);
                ZN:
                $zj++;
                goto Y3;
                dA:
                nu:
                J6:
            }
            di:
            $Fk = new XMLSecEnc();
            $Fk->setNode($LC->documentElement);
            $Fk->type = "\150\164\x74\x70\72\57\x2f\167\167\x77\56\167\x33\x2e\157\162\x67\57\62\60\x30\x31\57\60\x34\57\x78\155\154\x65\x6e\143\x23\105\x6c\x65\x6d\145\156\x74";
            $QM = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $QM->generateSessionKey();
            $Fk->encryptKey($this->encryptionKey, $QM);
            $Qa = $Fk->encryptNode($QM);
            $tB = $lQ->createElementNS("\x75\x72\x6e\x3a\x6f\x61\163\151\x73\x3a\x6e\x61\155\145\163\x3a\164\x63\72\x53\x41\x4d\114\72\62\x2e\x30\x3a\x61\x73\x73\x65\162\164\151\157\156", "\163\141\x6d\154\x3a\x45\x6e\x63\162\x79\x70\x74\145\144\101\x74\164\x72\151\142\x75\164\145");
            $k6->appendChild($tB);
            $nb = $lQ->importNode($Qa, TRUE);
            $tB->appendChild($nb);
            hf:
        }
        gO:
    }
}
