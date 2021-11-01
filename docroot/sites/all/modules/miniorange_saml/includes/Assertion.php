<?php


include_once "\x55\x74\x69\154\151\164\x69\145\163\x2e\x70\x68\x70";
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
    public function __construct(DOMElement $fk = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\162\x6e\72\x6f\x61\x73\151\x73\x3a\156\141\155\145\163\x3a\164\x63\72\123\x41\115\x4c\x3a\x31\56\x31\72\x6e\141\155\145\151\x64\x2d\x66\x6f\x72\155\141\164\x3a\x75\x6e\163\160\x65\143\x69\146\151\145\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($fk === NULL)) {
            goto sR;
        }
        return;
        sR:
        if (!($fk->localName === "\105\156\143\x72\x79\160\164\145\x64\x41\163\x73\x65\162\164\x69\157\156")) {
            goto d1;
        }
        $pK = Utilities::xpQuery($fk, "\56\57\170\145\x6e\143\72\x45\156\143\x72\171\x70\164\x65\x64\104\x61\164\141");
        $Bd = Utilities::xpQuery($fk, "\56\57\x78\x65\x6e\143\72\x45\156\x63\162\171\x70\x74\145\144\x44\141\x74\141\x2f\x64\163\x3a\113\145\x79\111\156\146\157\57\170\x65\x6e\x63\x3a\x45\156\x63\x72\x79\x70\x74\145\x64\113\145\171");
        $ch = '';
        if (empty($Bd)) {
            goto l_;
        }
        $ch = $Bd[0]->firstChild->getAttribute("\x41\x6c\147\x6f\162\x69\x74\x68\x6d");
        goto iw;
        l_:
        $Bd = Utilities::xpQuery($fk, "\x2e\x2f\170\x65\x6e\143\x3a\105\x6e\x63\x72\171\160\164\145\x64\113\145\x79\x2f\170\x65\156\x63\72\105\x6e\x63\162\171\160\x74\151\157\156\x4d\x65\x74\150\157\x64");
        $ch = $Bd[0]->getAttribute("\x41\154\147\157\162\x69\x74\150\155");
        iw:
        $Po = Utilities::getEncryptionAlgorithm($ch);
        if (count($pK) === 0) {
            goto nG;
        }
        if (count($pK) > 1) {
            goto B_;
        }
        goto ta;
        nG:
        throw new Exception("\x4d\151\163\163\x69\x6e\147\x20\x65\156\143\x72\171\x70\164\145\144\x20\x64\x61\x74\x61\40\x69\156\40\74\x73\141\x6d\154\x3a\105\156\143\x72\171\x70\164\x65\x64\x41\x73\163\145\x72\164\151\x6f\x6e\76\56");
        goto ta;
        B_:
        throw new Exception("\115\x6f\162\x65\x20\x74\x68\141\156\40\157\x6e\x65\40\145\156\143\x72\171\160\x74\x65\144\40\144\141\x74\x61\x20\145\154\145\155\x65\156\x74\40\151\156\40\74\163\141\155\154\x3a\x45\156\x63\x72\x79\x70\x74\145\144\x41\x73\x73\145\x72\164\151\x6f\156\x3e\x2e");
        ta:
        $w9 = '';
        $w9 = variable_get("\x6d\x69\156\151\x6f\162\x61\156\x67\x65\x5f\163\141\155\x6c\x5f\160\162\151\x76\x61\164\x65\137\x63\x65\162\x74\151\146\151\x63\141\164\145");
        $u7 = new XMLSecurityKey($Po, array("\x74\x79\x70\145" => "\x70\162\151\x76\x61\x74\145"));
        $D3 = drupal_get_path("\x6d\x6f\x64\x75\154\x65", "\155\151\156\151\157\x72\x61\156\x67\145\137\163\x61\x6d\154");
        if ($w9 != '') {
            goto JV;
        }
        $eY = $D3 . "\x2f\x72\x65\163\157\165\162\143\x65\163\x2f\163\x70\55\153\x65\x79\56\153\x65\171";
        goto qV;
        JV:
        $eY = $D3 . "\57\162\145\x73\157\165\x72\x63\145\163\57\x43\x75\163\x74\157\155\x5f\120\x72\151\x76\141\164\x65\137\x43\145\x72\164\151\146\x69\143\141\164\x65\56\x6b\145\171";
        qV:
        $u7->loadKey($eY, TRUE);
        $td = new XMLSecurityKey($Po, array("\x74\171\160\x65" => "\x70\162\x69\166\141\x74\145"));
        $nP = $D3 . "\57\x72\x65\x73\x6f\x75\162\x63\x65\163\57\x6d\151\156\x69\157\x72\141\x6e\x67\145\137\x73\x70\x5f\160\x72\151\x76\137\x6b\x65\x79\x2e\x6b\145\171";
        $td->loadKey($nP, TRUE);
        $oJ = array();
        $fk = Utilities::decryptElement($pK[0], $u7, $oJ, $td);
        d1:
        if ($fk->hasAttribute("\x49\104")) {
            goto km;
        }
        throw new Exception("\115\151\x73\163\151\156\x67\x20\111\x44\x20\x61\x74\x74\x72\151\x62\x75\164\145\x20\x6f\x6e\40\123\x41\x4d\x4c\40\x61\x73\x73\145\162\x74\151\x6f\156\x2e");
        km:
        $this->id = $fk->getAttribute("\x49\104");
        if (!($fk->getAttribute("\x56\145\x72\x73\151\x6f\x6e") !== "\x32\56\60")) {
            goto X4;
        }
        throw new Exception("\125\156\x73\165\160\x70\157\x72\164\145\x64\40\x76\145\162\x73\151\x6f\156\72\40" . $fk->getAttribute("\126\145\162\x73\151\x6f\156"));
        X4:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($fk->getAttribute("\x49\x73\163\165\145\111\x6e\x73\x74\x61\x6e\164"));
        $vy = Utilities::xpQuery($fk, "\56\x2f\163\x61\155\154\137\141\163\x73\145\162\164\x69\157\x6e\72\x49\163\x73\x75\x65\162");
        if (!empty($vy)) {
            goto zS;
        }
        throw new Exception("\x4d\151\x73\163\x69\x6e\x67\40\74\x73\x61\x6d\154\72\111\x73\163\x75\x65\162\x3e\x20\151\x6e\x20\x61\163\x73\x65\162\164\151\157\156\x2e");
        zS:
        $this->issuer = trim($vy[0]->textContent);
        $this->parseConditions($fk);
        $this->parseAuthnStatement($fk);
        $this->parseAttributes($fk);
        $this->parseEncryptedAttributes($fk);
        $this->parseSignature($fk);
        $this->parseSubject($fk);
    }
    private function parseSubject(DOMElement $fk)
    {
        $no = Utilities::xpQuery($fk, "\56\57\x73\x61\x6d\154\x5f\141\x73\163\x65\x72\164\x69\x6f\156\72\123\165\142\152\145\143\x74");
        if (empty($no)) {
            goto MK;
        }
        if (count($no) > 1) {
            goto SQ;
        }
        goto ws;
        MK:
        return;
        goto ws;
        SQ:
        throw new Exception("\115\x6f\162\x65\x20\x74\150\x61\156\40\x6f\156\x65\x20\x3c\163\x61\x6d\x6c\72\x53\x75\x62\x6a\145\143\x74\76\x20\x69\156\x20\74\x73\x61\155\154\x3a\101\163\163\145\x72\164\151\x6f\156\76\x2e");
        ws:
        $no = $no[0];
        $PU = Utilities::xpQuery($no, "\56\x2f\163\x61\155\x6c\137\x61\x73\163\x65\x72\x74\x69\157\156\x3a\x4e\141\x6d\145\111\x44\x20\x7c\x20\x2e\57\163\x61\x6d\x6c\137\141\x73\x73\145\x72\x74\151\157\x6e\x3a\105\x6e\143\x72\171\160\x74\x65\x64\x49\x44\x2f\170\x65\156\x63\72\105\x6e\143\162\171\160\164\x65\144\x44\x61\x74\141");
        if (empty($PU)) {
            goto hK;
        }
        if (count($PU) > 1) {
            goto Ot;
        }
        goto nq;
        hK:
        throw new Exception("\115\151\163\x73\x69\156\147\40\x3c\x73\x61\x6d\154\x3a\x4e\141\x6d\x65\x49\x44\76\x20\157\162\40\74\163\141\x6d\154\72\x45\x6e\x63\162\x79\160\164\145\x64\111\104\76\x20\x69\x6e\40\x3c\163\x61\155\x6c\72\123\165\142\152\x65\x63\164\76\x2e");
        goto nq;
        Ot:
        throw new Exception("\115\157\162\x65\x20\164\x68\141\156\x20\x6f\x6e\145\x20\x3c\x73\141\x6d\154\72\x4e\x61\x6d\x65\x49\104\x3e\x20\157\x72\40\x3c\x73\141\155\154\x3a\x45\x6e\x63\x72\171\160\x74\x65\x64\104\76\x20\151\156\x20\74\163\x61\155\x6c\72\123\x75\142\152\x65\x63\164\76\56");
        nq:
        $PU = $PU[0];
        if ($PU->localName === "\x45\x6e\143\162\x79\160\164\x65\x64\104\x61\164\141") {
            goto kN;
        }
        $this->nameId = Utilities::parseNameId($PU);
        goto wd;
        kN:
        $this->encryptedNameId = $PU;
        wd:
    }
    private function parseConditions(DOMElement $fk)
    {
        $YT = Utilities::xpQuery($fk, "\x2e\57\x73\141\155\x6c\137\141\x73\163\x65\162\164\x69\x6f\156\72\103\157\156\x64\x69\164\151\157\x6e\x73");
        if (empty($YT)) {
            goto a0;
        }
        if (count($YT) > 1) {
            goto pt;
        }
        goto LP;
        a0:
        return;
        goto LP;
        pt:
        throw new Exception("\115\157\x72\x65\x20\164\x68\141\156\40\x6f\156\x65\x20\x3c\163\141\155\154\72\103\157\x6e\x64\x69\164\151\157\x6e\163\x3e\x20\151\x6e\40\74\x73\x61\x6d\x6c\72\101\x73\x73\145\x72\164\x69\157\156\76\x2e");
        LP:
        $YT = $YT[0];
        if (!$YT->hasAttribute("\x4e\157\x74\x42\145\x66\x6f\162\145")) {
            goto H8;
        }
        $yq = Utilities::xsDateTimeToTimestamp($YT->getAttribute("\116\157\x74\102\145\146\157\x72\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $yq)) {
            goto TK;
        }
        $this->notBefore = $yq;
        TK:
        H8:
        if (!$YT->hasAttribute("\116\157\164\117\x6e\117\162\101\x66\164\x65\x72")) {
            goto gN;
        }
        $EO = Utilities::xsDateTimeToTimestamp($YT->getAttribute("\x4e\157\x74\117\x6e\x4f\x72\101\x66\x74\145\162"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $EO)) {
            goto tm;
        }
        $this->notOnOrAfter = $EO;
        tm:
        gN:
        $JM = $YT->firstChild;
        pF:
        if (!($JM !== NULL)) {
            goto I8;
        }
        if (!$JM instanceof DOMText) {
            goto Di;
        }
        goto Nj;
        Di:
        if (!($JM->namespaceURI !== "\x75\162\156\x3a\x6f\x61\x73\x69\163\72\156\141\x6d\145\163\72\x74\x63\72\123\101\x4d\x4c\72\62\x2e\60\x3a\141\x73\x73\x65\162\164\x69\157\x6e")) {
            goto U9;
        }
        throw new Exception("\125\156\153\156\157\x77\156\40\x6e\x61\155\x65\163\160\141\x63\x65\x20\x6f\x66\40\143\x6f\156\x64\x69\x74\x69\x6f\x6e\72\40" . var_export($JM->namespaceURI, TRUE));
        U9:
        switch ($JM->localName) {
            case "\x41\x75\144\151\145\156\x63\x65\122\x65\x73\x74\x72\x69\143\164\151\x6f\x6e":
                $DX = Utilities::extractStrings($JM, "\x75\162\x6e\72\x6f\x61\x73\x69\x73\x3a\x6e\x61\155\145\x73\72\x74\x63\x3a\x53\x41\x4d\x4c\x3a\x32\56\x30\72\x61\163\163\x65\162\x74\x69\157\156", "\101\165\x64\x69\145\156\143\x65");
                if ($this->validAudiences === NULL) {
                    goto V4;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $DX);
                goto xX;
                V4:
                $this->validAudiences = $DX;
                xX:
                goto oT;
            case "\117\x6e\145\x54\x69\x6d\x65\125\x73\x65":
                goto oT;
            case "\120\162\x6f\170\x79\x52\145\163\x74\162\151\143\x74\x69\x6f\x6e":
                goto oT;
            default:
                throw new Exception("\125\x6e\x6b\x6e\157\x77\156\40\143\x6f\x6e\144\x69\164\151\x6f\x6e\x3a\x20" . var_export($JM->localName, TRUE));
        }
        fB:
        oT:
        Nj:
        $JM = $JM->nextSibling;
        goto pF;
        I8:
    }
    private function parseAuthnStatement(DOMElement $fk)
    {
        $yo = Utilities::xpQuery($fk, "\56\57\x73\141\155\x6c\137\x61\x73\163\145\x72\164\x69\x6f\156\x3a\101\165\x74\x68\156\x53\164\141\164\145\155\x65\x6e\164");
        if (empty($yo)) {
            goto uc;
        }
        if (count($yo) > 1) {
            goto IZ;
        }
        goto ED;
        uc:
        $this->authnInstant = NULL;
        return;
        goto ED;
        IZ:
        throw new Exception("\115\157\x72\145\40\x74\150\x61\x74\40\x6f\156\145\40\x3c\163\141\x6d\x6c\72\x41\x75\164\x68\156\x53\164\141\164\145\155\145\x6e\x74\76\x20\x69\x6e\x20\x3c\163\x61\155\154\72\x41\x73\163\145\162\x74\x69\x6f\156\x3e\40\x6e\x6f\x74\x20\x73\x75\160\160\x6f\x72\x74\x65\x64\56");
        ED:
        $Wj = $yo[0];
        if ($Wj->hasAttribute("\x41\165\164\x68\x6e\111\x6e\163\164\x61\x6e\x74")) {
            goto tC;
        }
        throw new Exception("\x4d\151\163\163\151\x6e\x67\40\x72\145\161\165\x69\162\x65\x64\40\101\165\164\x68\x6e\111\156\163\x74\141\156\164\40\141\x74\164\162\x69\x62\165\164\145\40\157\x6e\40\x3c\x73\141\x6d\154\x3a\x41\165\x74\x68\x6e\123\x74\141\164\x65\155\145\156\x74\x3e\x2e");
        tC:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($Wj->getAttribute("\101\165\164\x68\x6e\111\156\x73\164\141\x6e\164"));
        if (!$Wj->hasAttribute("\x53\x65\x73\163\x69\157\x6e\116\x6f\x74\117\x6e\x4f\162\101\x66\164\145\162")) {
            goto Sq;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($Wj->getAttribute("\123\145\163\163\151\x6f\x6e\116\x6f\164\117\156\x4f\x72\101\146\x74\145\162"));
        Sq:
        if (!$Wj->hasAttribute("\x53\145\x73\163\x69\x6f\x6e\x49\156\x64\145\170")) {
            goto FP;
        }
        $this->sessionIndex = $Wj->getAttribute("\x53\x65\163\x73\x69\x6f\x6e\x49\156\144\145\170");
        FP:
        $this->parseAuthnContext($Wj);
    }
    private function parseAuthnContext(DOMElement $QP)
    {
        $HP = Utilities::xpQuery($QP, "\56\x2f\163\141\155\x6c\x5f\141\163\x73\x65\x72\x74\151\x6f\x6e\x3a\x41\165\x74\150\x6e\x43\157\x6e\164\145\x78\164");
        if (count($HP) > 1) {
            goto de;
        }
        if (empty($HP)) {
            goto qt;
        }
        goto cy;
        de:
        throw new Exception("\x4d\157\162\145\x20\x74\x68\x61\156\x20\x6f\156\145\x20\x3c\163\x61\155\x6c\x3a\101\x75\x74\150\156\x43\x6f\x6e\164\x65\170\164\76\40\x69\156\40\x3c\163\141\x6d\x6c\x3a\x41\165\x74\150\156\x53\x74\141\x74\x65\x6d\145\156\x74\76\56");
        goto cy;
        qt:
        throw new Exception("\115\151\163\x73\x69\x6e\x67\40\162\x65\x71\165\x69\x72\x65\144\x20\x3c\x73\141\x6d\x6c\72\x41\x75\164\x68\156\x43\157\156\x74\x65\x78\x74\76\40\x69\156\40\x3c\163\141\x6d\x6c\72\101\x75\164\x68\x6e\x53\x74\141\164\145\x6d\145\x6e\164\76\x2e");
        cy:
        $mG = $HP[0];
        $mr = Utilities::xpQuery($mG, "\x2e\x2f\x73\x61\155\x6c\x5f\141\x73\x73\x65\162\164\151\157\156\72\101\165\164\x68\x6e\103\157\156\164\145\170\x74\104\x65\x63\154\122\145\146");
        if (count($mr) > 1) {
            goto It;
        }
        if (count($mr) === 1) {
            goto yg;
        }
        goto VU;
        It:
        throw new Exception("\115\157\x72\x65\40\x74\x68\141\156\x20\x6f\x6e\x65\x20\x3c\163\141\155\154\x3a\101\x75\x74\150\x6e\103\x6f\x6e\x74\x65\x78\x74\x44\x65\x63\154\122\145\x66\x3e\40\146\157\165\x6e\144\x3f");
        goto VU;
        yg:
        $this->setAuthnContextDeclRef(trim($mr[0]->textContent));
        VU:
        $St = Utilities::xpQuery($mG, "\56\57\163\141\155\154\x5f\x61\x73\163\145\x72\x74\151\157\x6e\x3a\x41\x75\164\150\156\x43\x6f\156\164\145\170\164\104\145\143\154");
        if (count($St) > 1) {
            goto ME;
        }
        if (count($St) === 1) {
            goto Sj;
        }
        goto zE;
        ME:
        throw new Exception("\115\157\x72\145\40\164\x68\141\x6e\x20\x6f\x6e\x65\40\x3c\163\141\x6d\154\x3a\x41\x75\x74\150\156\103\x6f\x6e\x74\x65\x78\164\x44\145\143\x6c\x3e\40\146\x6f\x75\x6e\144\x3f");
        goto zE;
        Sj:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($St[0]));
        zE:
        $Qt = Utilities::xpQuery($mG, "\x2e\57\163\x61\x6d\x6c\x5f\141\163\x73\145\162\x74\x69\x6f\156\x3a\101\165\x74\x68\x6e\103\x6f\156\164\145\170\x74\103\x6c\141\x73\x73\122\x65\x66");
        if (count($Qt) > 1) {
            goto ph;
        }
        if (count($Qt) === 1) {
            goto VV;
        }
        goto E4;
        ph:
        throw new Exception("\115\157\162\x65\40\164\x68\141\156\40\x6f\156\145\40\74\163\x61\x6d\x6c\x3a\101\x75\x74\x68\156\103\157\x6e\x74\145\x78\164\x43\x6c\x61\163\163\x52\x65\x66\x3e\40\151\x6e\x20\74\x73\141\x6d\154\72\101\165\164\x68\156\x43\157\156\x74\x65\170\164\x3e\56");
        goto E4;
        VV:
        $this->setAuthnContextClassRef(trim($Qt[0]->textContent));
        E4:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto xq;
        }
        throw new Exception("\115\x69\x73\x73\x69\x6e\x67\40\145\151\164\x68\145\162\x20\74\x73\141\155\x6c\x3a\x41\165\164\x68\x6e\103\x6f\156\x74\x65\x78\x74\x43\x6c\141\163\x73\x52\145\146\76\40\157\x72\40\x3c\x73\x61\x6d\154\x3a\x41\165\x74\150\156\103\x6f\x6e\x74\145\170\164\x44\145\143\x6c\122\x65\x66\x3e\x20\x6f\x72\x20\x3c\163\141\x6d\x6c\x3a\x41\165\x74\150\x6e\103\x6f\156\164\x65\170\x74\104\x65\x63\154\76");
        xq:
        $this->AuthenticatingAuthority = Utilities::extractStrings($mG, "\x75\x72\156\72\x6f\x61\163\x69\163\x3a\x6e\141\x6d\x65\x73\72\164\x63\72\x53\x41\x4d\114\72\62\x2e\60\x3a\141\x73\x73\x65\x72\164\x69\x6f\156", "\101\165\x74\x68\145\x6e\x74\x69\x63\141\x74\x69\156\x67\101\x75\164\x68\157\162\151\x74\171");
    }
    private function parseAttributes(DOMElement $fk)
    {
        $SB = TRUE;
        $B9 = Utilities::xpQuery($fk, "\x2e\x2f\x73\141\155\154\x5f\x61\x73\163\145\162\x74\151\157\x6e\72\101\164\164\x72\x69\x62\x75\164\x65\x53\164\x61\164\x65\x6d\145\156\164\57\x73\141\x6d\x6c\137\x61\163\x73\x65\162\x74\x69\157\x6e\72\101\164\164\162\x69\142\x75\164\x65");
        foreach ($B9 as $ax) {
            if ($ax->hasAttribute("\x4e\141\155\145")) {
                goto oL;
            }
            throw new Exception("\x4d\x69\163\x73\151\x6e\x67\x20\156\x61\155\x65\40\x6f\x6e\x20\x3c\x73\x61\x6d\154\72\101\164\x74\x72\151\x62\165\164\145\76\40\145\154\145\x6d\145\156\164\x2e");
            oL:
            $Z5 = $ax->getAttribute("\x4e\x61\155\145");
            if ($ax->hasAttribute("\116\141\155\145\106\157\x72\x6d\141\164")) {
                goto sO;
            }
            $q9 = "\x75\x72\156\72\157\141\x73\x69\163\x3a\156\x61\x6d\x65\163\x3a\164\x63\72\123\x41\115\114\72\x31\x2e\61\x3a\156\141\155\x65\x69\x64\55\146\x6f\162\155\141\164\72\165\x6e\163\x70\x65\143\151\146\x69\x65\144";
            goto H4;
            sO:
            $q9 = $ax->getAttribute("\x4e\141\155\145\x46\x6f\162\x6d\141\x74");
            H4:
            if ($SB) {
                goto Z6;
            }
            if (!($this->nameFormat !== $q9)) {
                goto iU;
            }
            $this->nameFormat = "\x75\x72\x6e\x3a\157\141\163\151\x73\72\156\x61\155\145\163\72\x74\x63\x3a\x53\101\x4d\114\x3a\61\x2e\61\x3a\x6e\141\155\145\151\x64\55\x66\x6f\162\x6d\x61\x74\x3a\165\156\163\x70\x65\x63\151\x66\151\x65\144";
            iU:
            goto wn;
            Z6:
            $this->nameFormat = $q9;
            $SB = FALSE;
            wn:
            if (array_key_exists($Z5, $this->attributes)) {
                goto hP;
            }
            $this->attributes[$Z5] = array();
            hP:
            $Mb = Utilities::xpQuery($ax, "\x2e\57\163\141\x6d\154\x5f\x61\x73\x73\x65\162\x74\151\157\x6e\x3a\x41\x74\164\162\151\x62\165\164\x65\x56\141\x6c\165\x65");
            foreach ($Mb as $Y_) {
                $this->attributes[$Z5][] = trim($Y_->textContent);
                AN:
            }
            CF:
            Mi:
        }
        Mq:
    }
    private function parseEncryptedAttributes(DOMElement $fk)
    {
        $this->encryptedAttribute = Utilities::xpQuery($fk, "\x2e\x2f\x73\141\x6d\154\137\141\x73\163\x65\x72\164\151\x6f\156\x3a\x41\x74\x74\x72\x69\x62\165\x74\145\123\164\x61\164\145\155\x65\156\x74\57\x73\141\155\x6c\137\x61\x73\163\x65\x72\164\x69\157\156\x3a\x45\x6e\143\x72\x79\x70\164\145\144\x41\x74\164\162\x69\142\x75\x74\145");
    }
    private function parseSignature(DOMElement $fk)
    {
        $HD = Utilities::validateElement($fk);
        if (!($HD !== FALSE)) {
            goto mu;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $HD["\x43\x65\x72\x74\x69\x66\151\143\x61\164\x65\x73"];
        $this->signatureData = $HD;
        mu:
    }
    public function validate(XMLSecurityKey $u7)
    {
        if (!($this->signatureData === NULL)) {
            goto XF;
        }
        return FALSE;
        XF:
        Utilities::validateSignature($this->signatureData, $u7);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($G6)
    {
        $this->id = $G6;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($KE)
    {
        $this->issueInstant = $KE;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($vy)
    {
        $this->issuer = $vy;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto L2;
        }
        throw new Exception("\x41\x74\164\145\155\x70\x74\145\144\40\x74\157\40\162\145\x74\x72\151\145\166\x65\x20\145\x6e\143\x72\x79\160\x74\x65\144\x20\116\x61\155\x65\x49\104\40\x77\151\164\150\157\x75\x74\40\144\x65\143\x72\x79\160\164\x69\x6e\147\40\151\x74\40\146\x69\x72\163\x74\56");
        L2:
        return $this->nameId;
    }
    public function setNameId($PU)
    {
        $this->nameId = $PU;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto uV;
        }
        return TRUE;
        uV:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $u7)
    {
        $mD = new DOMDocument();
        $Gh = $mD->createElement("\x72\157\157\x74");
        $mD->appendChild($Gh);
        Utilities::addNameId($Gh, $this->nameId);
        $PU = $Gh->firstChild;
        Utilities::getContainer()->debugMessage($PU, "\145\x6e\143\x72\x79\160\x74");
        $F9 = new XMLSecEnc();
        $F9->setNode($PU);
        $F9->type = XMLSecEnc::Element;
        $SZ = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $SZ->generateSessionKey();
        $F9->encryptKey($u7, $SZ);
        $this->encryptedNameId = $F9->encryptNode($SZ);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $u7, array $oJ = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto pa;
        }
        return;
        pa:
        $PU = Utilities::decryptElement($this->encryptedNameId, $u7, $oJ);
        Utilities::getContainer()->debugMessage($PU, "\144\145\143\x72\171\160\x74");
        $this->nameId = Utilities::parseNameId($PU);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $u7, array $oJ = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto lX;
        }
        return;
        lX:
        $SB = TRUE;
        $B9 = $this->encryptedAttribute;
        foreach ($B9 as $dg) {
            $ax = Utilities::decryptElement($dg->getElementsByTagName("\x45\156\143\162\171\x70\x74\x65\144\104\141\164\141")->item(0), $u7, $oJ);
            if ($ax->hasAttribute("\116\x61\155\x65")) {
                goto C_;
            }
            throw new Exception("\115\x69\163\x73\151\x6e\x67\x20\x6e\141\155\145\40\x6f\156\x20\74\x73\x61\x6d\154\x3a\x41\164\x74\x72\151\142\165\164\145\x3e\x20\x65\154\x65\x6d\145\x6e\164\x2e");
            C_:
            $Z5 = $ax->getAttribute("\x4e\141\x6d\145");
            if ($ax->hasAttribute("\116\141\x6d\145\x46\157\x72\x6d\x61\164")) {
                goto jN;
            }
            $q9 = "\x75\162\x6e\72\157\x61\x73\151\x73\x3a\156\141\x6d\145\163\x3a\x74\143\72\123\x41\115\114\x3a\x32\x2e\x30\72\141\164\x74\x72\156\x61\155\145\55\x66\x6f\162\155\x61\x74\72\x75\156\x73\160\x65\143\151\x66\151\145\144";
            goto pu;
            jN:
            $q9 = $ax->getAttribute("\x4e\141\155\x65\x46\x6f\x72\x6d\x61\x74");
            pu:
            if ($SB) {
                goto wg;
            }
            if (!($this->nameFormat !== $q9)) {
                goto rH;
            }
            $this->nameFormat = "\x75\x72\156\72\157\x61\x73\x69\x73\x3a\x6e\x61\x6d\145\163\72\164\143\72\123\101\x4d\114\x3a\x32\x2e\x30\72\141\164\164\162\x6e\141\x6d\145\x2d\x66\x6f\162\x6d\141\x74\x3a\x75\156\163\x70\145\143\x69\146\151\x65\144";
            rH:
            goto Wt;
            wg:
            $this->nameFormat = $q9;
            $SB = FALSE;
            Wt:
            if (array_key_exists($Z5, $this->attributes)) {
                goto UX;
            }
            $this->attributes[$Z5] = array();
            UX:
            $Mb = Utilities::xpQuery($ax, "\x2e\57\163\141\x6d\154\137\x61\163\163\x65\162\x74\151\x6f\156\x3a\x41\x74\x74\x72\151\142\x75\x74\145\126\141\154\x75\x65");
            foreach ($Mb as $Y_) {
                $this->attributes[$Z5][] = trim($Y_->textContent);
                q_:
            }
            sV:
            QH:
        }
        Zr:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($yq)
    {
        $this->notBefore = $yq;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($EO)
    {
        $this->notOnOrAfter = $EO;
    }
    public function setEncryptedAttributes($G2)
    {
        $this->requiredEncAttributes = $G2;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $S7 = NULL)
    {
        $this->validAudiences = $S7;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($nE)
    {
        $this->authnInstant = $nE;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($Kd)
    {
        $this->sessionNotOnOrAfter = $Kd;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($qE)
    {
        $this->sessionIndex = $qE;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto ZF;
        }
        return $this->authnContextClassRef;
        ZF:
        if (empty($this->authnContextDeclRef)) {
            goto X6;
        }
        return $this->authnContextDeclRef;
        X6:
        return NULL;
    }
    public function setAuthnContext($TU)
    {
        $this->setAuthnContextClassRef($TU);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($YP)
    {
        $this->authnContextClassRef = $YP;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $bX)
    {
        if (empty($this->authnContextDeclRef)) {
            goto qD;
        }
        throw new Exception("\101\x75\164\150\x6e\x43\x6f\x6e\164\x65\x78\x74\x44\145\143\154\x52\x65\x66\40\x69\x73\40\141\x6c\162\x65\x61\x64\x79\40\x72\145\147\151\x73\164\x65\x72\145\x64\41\x20\x4d\x61\171\x20\x6f\156\x6c\x79\x20\x68\x61\x76\145\x20\145\x69\164\150\x65\162\x20\141\x20\x44\145\143\154\40\157\x72\x20\141\x20\x44\x65\x63\154\x52\145\146\54\x20\156\157\164\x20\x62\157\164\x68\x21");
        qD:
        $this->authnContextDecl = $bX;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($Ul)
    {
        if (empty($this->authnContextDecl)) {
            goto VM;
        }
        throw new Exception("\101\165\164\150\x6e\103\157\x6e\x74\145\170\164\x44\x65\143\154\40\151\163\40\x61\x6c\162\x65\x61\144\171\40\x72\x65\x67\151\163\x74\x65\162\145\x64\x21\40\x4d\141\171\40\157\156\154\171\40\x68\141\x76\x65\40\x65\151\164\x68\x65\162\x20\x61\40\x44\x65\143\154\x20\x6f\162\x20\141\40\x44\145\x63\154\x52\x65\x66\x2c\40\156\x6f\x74\40\x62\x6f\x74\150\41");
        VM:
        $this->authnContextDeclRef = $Ul;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($vz)
    {
        $this->AuthenticatingAuthority = $vz;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $B9)
    {
        $this->attributes = $B9;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($q9)
    {
        $this->nameFormat = $q9;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $BM)
    {
        $this->SubjectConfirmation = $BM;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $jc = NULL)
    {
        $this->signatureKey = $jc;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $kO = NULL)
    {
        $this->encryptionKey = $kO;
    }
    public function setCertificates(array $mR)
    {
        $this->certificates = $mR;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $Ev = NULL)
    {
        if ($Ev === NULL) {
            goto uO;
        }
        $jE = $Ev->ownerDocument;
        goto Iq;
        uO:
        $jE = new DOMDocument();
        $Ev = $jE;
        Iq:
        $Gh = $jE->createElementNS("\x75\162\156\72\157\141\x73\x69\163\72\156\141\x6d\145\x73\x3a\164\x63\72\x53\x41\x4d\x4c\72\62\56\x30\72\x61\163\x73\x65\162\164\151\157\x6e", "\163\141\155\x6c\72" . "\x41\163\x73\145\x72\x74\151\157\x6e");
        $Ev->appendChild($Gh);
        $Gh->setAttributeNS("\x75\162\156\72\x6f\141\163\151\163\72\x6e\x61\x6d\145\x73\72\x74\143\x3a\x53\x41\115\114\72\x32\x2e\60\x3a\160\x72\157\164\x6f\x63\157\154", "\163\141\155\x6c\x70\x3a\164\155\160", "\x74\155\x70");
        $Gh->removeAttributeNS("\165\x72\x6e\72\x6f\141\163\151\x73\x3a\156\141\x6d\x65\x73\x3a\x74\143\x3a\x53\x41\x4d\x4c\x3a\x32\56\x30\72\x70\162\157\164\x6f\143\x6f\154", "\164\155\x70");
        $Gh->setAttributeNS("\x68\x74\x74\x70\72\x2f\57\x77\167\x77\x2e\167\63\56\157\x72\147\x2f\62\x30\x30\x31\x2f\x58\x4d\114\123\x63\x68\x65\x6d\141\55\151\x6e\x73\x74\141\x6e\x63\145", "\170\163\151\x3a\x74\x6d\160", "\x74\x6d\160");
        $Gh->removeAttributeNS("\150\164\164\160\72\x2f\x2f\167\167\x77\56\167\x33\x2e\x6f\162\x67\x2f\62\x30\60\x31\57\130\x4d\x4c\123\143\150\x65\x6d\x61\x2d\x69\x6e\x73\x74\x61\156\143\x65", "\164\x6d\160");
        $Gh->setAttributeNS("\150\x74\164\160\x3a\57\57\167\x77\167\56\x77\63\56\157\x72\147\x2f\x32\x30\x30\x31\57\x58\115\114\123\143\150\x65\155\141", "\x78\163\72\x74\x6d\x70", "\164\155\x70");
        $Gh->removeAttributeNS("\x68\164\164\x70\x3a\57\x2f\x77\167\x77\x2e\167\63\x2e\x6f\162\x67\57\62\x30\60\x31\57\130\115\114\123\143\150\x65\x6d\x61", "\164\x6d\160");
        $Gh->setAttribute("\111\104", $this->id);
        $Gh->setAttribute("\126\x65\162\x73\151\x6f\156", "\62\x2e\x30");
        $Gh->setAttribute("\111\163\x73\165\145\x49\156\x73\164\x61\x6e\164", gmdate("\x59\55\x6d\55\144\134\124\110\72\x69\72\163\134\132", $this->issueInstant));
        $vy = Utilities::addString($Gh, "\x75\162\156\x3a\x6f\141\x73\151\163\72\156\141\155\145\x73\x3a\164\x63\x3a\123\x41\115\x4c\x3a\62\x2e\60\x3a\x61\x73\163\145\162\x74\x69\157\x6e", "\x73\141\x6d\x6c\72\111\x73\163\165\x65\162", $this->issuer);
        $this->addSubject($Gh);
        $this->addConditions($Gh);
        $this->addAuthnStatement($Gh);
        if ($this->requiredEncAttributes == FALSE) {
            goto Lp;
        }
        $this->addEncryptedAttributeStatement($Gh);
        goto Kw;
        Lp:
        $this->addAttributeStatement($Gh);
        Kw:
        if (!($this->signatureKey !== NULL)) {
            goto z4;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $Gh, $vy->nextSibling);
        z4:
        return $Gh;
    }
    private function addSubject(DOMElement $Gh)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto nk;
        }
        return;
        nk:
        $no = $Gh->ownerDocument->createElementNS("\x75\162\156\72\x6f\x61\x73\x69\163\x3a\x6e\141\155\145\163\72\x74\143\x3a\x53\x41\115\114\x3a\x32\x2e\x30\x3a\141\163\x73\x65\162\x74\151\x6f\156", "\163\141\x6d\154\72\123\165\142\x6a\x65\x63\x74");
        $Gh->appendChild($no);
        if ($this->encryptedNameId === NULL) {
            goto yP;
        }
        $fl = $no->ownerDocument->createElementNS("\x75\x72\x6e\x3a\x6f\141\x73\151\163\x3a\156\141\x6d\x65\x73\x3a\x74\143\72\123\101\115\x4c\x3a\62\56\60\x3a\141\163\x73\145\162\x74\151\157\x6e", "\x73\x61\155\x6c\72" . "\105\x6e\x63\162\171\160\164\x65\x64\111\x44");
        $no->appendChild($fl);
        $fl->appendChild($no->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto cO;
        yP:
        Utilities::addNameId($no, $this->nameId);
        cO:
        foreach ($this->SubjectConfirmation as $qw) {
            $qw->toXML($no);
            p4:
        }
        np:
    }
    private function addConditions(DOMElement $Gh)
    {
        $jE = $Gh->ownerDocument;
        $YT = $jE->createElementNS("\165\162\x6e\72\x6f\141\x73\151\x73\72\156\141\155\x65\x73\x3a\164\143\x3a\123\101\x4d\114\72\62\56\x30\72\141\163\163\x65\162\164\151\157\x6e", "\163\141\x6d\x6c\x3a\x43\x6f\x6e\x64\x69\x74\x69\x6f\156\x73");
        $Gh->appendChild($YT);
        if (!($this->notBefore !== NULL)) {
            goto GN;
        }
        $YT->setAttribute("\116\157\164\102\145\146\157\162\145", gmdate("\131\55\155\x2d\x64\x5c\124\x48\x3a\x69\x3a\x73\134\132", $this->notBefore));
        GN:
        if (!($this->notOnOrAfter !== NULL)) {
            goto N_;
        }
        $YT->setAttribute("\116\157\164\x4f\156\x4f\x72\x41\146\x74\x65\x72", gmdate("\x59\x2d\155\55\x64\x5c\x54\110\x3a\x69\72\163\134\x5a", $this->notOnOrAfter));
        N_:
        if (!($this->validAudiences !== NULL)) {
            goto TO;
        }
        $me = $jE->createElementNS("\165\162\156\72\x6f\x61\163\151\163\x3a\x6e\x61\155\x65\163\72\x74\143\x3a\123\101\x4d\x4c\x3a\x32\56\60\x3a\141\163\x73\x65\162\164\151\x6f\156", "\x73\x61\155\154\72\x41\165\x64\151\145\156\x63\x65\x52\145\x73\x74\x72\x69\x63\x74\x69\157\x6e");
        $YT->appendChild($me);
        Utilities::addStrings($me, "\x75\162\156\72\x6f\x61\x73\151\x73\72\156\x61\x6d\x65\163\x3a\x74\x63\72\123\x41\x4d\x4c\x3a\x32\x2e\x30\72\x61\x73\x73\145\162\164\151\157\156", "\163\141\x6d\x6c\72\101\165\144\151\x65\x6e\x63\145", FALSE, $this->validAudiences);
        TO:
    }
    private function addAuthnStatement(DOMElement $Gh)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto yw;
        }
        return;
        yw:
        $jE = $Gh->ownerDocument;
        $QP = $jE->createElementNS("\x75\162\156\x3a\x6f\x61\x73\151\x73\x3a\x6e\x61\x6d\145\163\72\x74\143\x3a\123\x41\115\114\72\x32\x2e\x30\x3a\141\x73\x73\145\x72\x74\151\x6f\x6e", "\x73\141\155\x6c\x3a\x41\x75\x74\x68\x6e\x53\164\x61\x74\x65\x6d\x65\x6e\164");
        $Gh->appendChild($QP);
        $QP->setAttribute("\101\165\x74\150\156\111\x6e\163\164\x61\156\164", gmdate("\131\x2d\155\55\x64\x5c\124\110\72\151\72\x73\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto Qq;
        }
        $QP->setAttribute("\x53\145\163\163\151\x6f\x6e\116\157\x74\117\156\x4f\162\x41\146\x74\145\162", gmdate("\x59\x2d\x6d\55\144\134\124\x48\72\151\72\x73\134\x5a", $this->sessionNotOnOrAfter));
        Qq:
        if (!($this->sessionIndex !== NULL)) {
            goto qX;
        }
        $QP->setAttribute("\x53\145\x73\x73\x69\x6f\x6e\111\x6e\x64\x65\170", $this->sessionIndex);
        qX:
        $mG = $jE->createElementNS("\x75\162\156\72\x6f\x61\163\x69\x73\72\156\x61\x6d\145\163\x3a\x74\x63\72\x53\101\115\x4c\72\62\x2e\60\x3a\x61\x73\163\145\162\164\x69\x6f\156", "\x73\141\155\154\x3a\101\x75\x74\150\x6e\x43\x6f\x6e\164\x65\x78\164");
        $QP->appendChild($mG);
        if (empty($this->authnContextClassRef)) {
            goto U2;
        }
        Utilities::addString($mG, "\x75\162\x6e\x3a\x6f\x61\163\151\163\72\156\141\x6d\145\163\72\x74\x63\72\123\101\x4d\x4c\72\62\x2e\x30\72\141\163\x73\145\x72\164\151\x6f\x6e", "\163\x61\155\154\72\101\x75\x74\x68\156\x43\x6f\x6e\164\x65\x78\x74\x43\154\141\163\x73\122\145\x66", $this->authnContextClassRef);
        U2:
        if (empty($this->authnContextDecl)) {
            goto xw;
        }
        $this->authnContextDecl->toXML($mG);
        xw:
        if (empty($this->authnContextDeclRef)) {
            goto it;
        }
        Utilities::addString($mG, "\165\x72\156\x3a\x6f\x61\163\x69\163\72\156\141\155\145\x73\72\x74\x63\72\x53\101\x4d\x4c\x3a\62\56\x30\72\x61\163\163\145\x72\164\151\x6f\156", "\163\x61\x6d\x6c\x3a\101\165\164\150\x6e\x43\x6f\x6e\164\145\170\x74\x44\145\x63\x6c\122\x65\x66", $this->authnContextDeclRef);
        it:
        Utilities::addStrings($mG, "\165\162\x6e\x3a\x6f\141\x73\x69\163\72\156\x61\x6d\x65\163\x3a\164\x63\x3a\x53\101\x4d\x4c\x3a\x32\56\x30\72\141\163\x73\x65\162\164\151\x6f\x6e", "\x73\141\x6d\154\x3a\x41\165\x74\x68\x65\x6e\x74\x69\x63\141\x74\x69\156\147\x41\x75\x74\x68\x6f\x72\151\x74\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $Gh)
    {
        if (!empty($this->attributes)) {
            goto vv;
        }
        return;
        vv:
        $jE = $Gh->ownerDocument;
        $Qb = $jE->createElementNS("\165\162\156\72\157\x61\163\x69\163\x3a\156\141\155\145\x73\x3a\x74\x63\x3a\123\101\115\x4c\72\62\x2e\x30\72\x61\163\x73\145\x72\x74\x69\x6f\x6e", "\x73\141\155\154\x3a\101\x74\164\x72\151\x62\x75\164\145\x53\164\x61\164\x65\x6d\x65\156\164");
        $Gh->appendChild($Qb);
        foreach ($this->attributes as $Z5 => $Mb) {
            $ax = $jE->createElementNS("\165\x72\x6e\x3a\x6f\x61\163\x69\163\x3a\x6e\141\x6d\145\163\x3a\x74\143\x3a\x53\x41\115\x4c\x3a\62\x2e\60\x3a\141\163\x73\145\x72\164\151\x6f\x6e", "\163\x61\155\154\72\101\164\164\x72\x69\142\x75\164\145");
            $Qb->appendChild($ax);
            $ax->setAttribute("\116\141\155\145", $Z5);
            if (!($this->nameFormat !== "\165\162\156\x3a\157\141\x73\x69\163\x3a\x6e\141\155\x65\x73\x3a\x74\143\x3a\x53\101\x4d\114\72\62\56\x30\72\141\x74\x74\x72\156\141\155\x65\55\x66\157\x72\155\141\164\72\x75\156\163\160\145\143\151\x66\151\x65\144")) {
                goto y8;
            }
            $ax->setAttribute("\116\x61\155\145\106\x6f\x72\155\x61\x74", $this->nameFormat);
            y8:
            foreach ($Mb as $Y_) {
                if (is_string($Y_)) {
                    goto Eb;
                }
                if (is_int($Y_)) {
                    goto WP;
                }
                $XR = NULL;
                goto Vy;
                Eb:
                $XR = "\170\x73\72\x73\164\x72\x69\x6e\147";
                goto Vy;
                WP:
                $XR = "\170\163\72\151\156\164\x65\147\145\162";
                Vy:
                $m5 = $jE->createElementNS("\165\x72\156\x3a\157\141\x73\x69\x73\x3a\x6e\141\155\145\163\x3a\x74\x63\x3a\123\x41\115\114\x3a\62\56\x30\72\x61\x73\163\145\x72\x74\151\157\156", "\163\141\155\154\x3a\101\164\164\x72\x69\x62\165\x74\145\126\x61\154\165\145");
                $ax->appendChild($m5);
                if (!($XR !== NULL)) {
                    goto AO;
                }
                $m5->setAttributeNS("\150\164\x74\160\72\57\57\x77\167\167\x2e\167\x33\56\x6f\x72\x67\x2f\x32\60\60\x31\x2f\x58\115\114\123\x63\x68\x65\155\141\x2d\x69\x6e\x73\164\x61\x6e\x63\x65", "\170\163\151\x3a\164\x79\160\x65", $XR);
                AO:
                if (!is_null($Y_)) {
                    goto WG;
                }
                $m5->setAttributeNS("\150\x74\x74\160\72\x2f\57\x77\x77\x77\56\167\x33\x2e\x6f\162\x67\x2f\x32\x30\x30\61\x2f\x58\115\114\x53\143\150\145\155\x61\x2d\151\156\163\x74\141\x6e\143\x65", "\x78\163\x69\x3a\x6e\x69\x6c", "\x74\x72\165\145");
                WG:
                if ($Y_ instanceof DOMNodeList) {
                    goto Kt;
                }
                $m5->appendChild($jE->createTextNode($Y_));
                goto yd;
                Kt:
                $zO = 0;
                Z2:
                if (!($zO < $Y_->length)) {
                    goto IK;
                }
                $JM = $jE->importNode($Y_->item($zO), TRUE);
                $m5->appendChild($JM);
                mK:
                $zO++;
                goto Z2;
                IK:
                yd:
                Cw:
            }
            ax:
            di:
        }
        Ra:
    }
    private function addEncryptedAttributeStatement(DOMElement $Gh)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto w3;
        }
        return;
        w3:
        $jE = $Gh->ownerDocument;
        $Qb = $jE->createElementNS("\x75\x72\x6e\x3a\157\141\163\x69\x73\x3a\x6e\x61\x6d\145\163\72\164\x63\72\123\101\115\x4c\x3a\62\x2e\x30\x3a\x61\x73\163\145\x72\164\x69\x6f\x6e", "\x73\x61\155\x6c\72\x41\x74\164\162\x69\x62\x75\x74\145\123\164\141\x74\x65\155\145\x6e\x74");
        $Gh->appendChild($Qb);
        foreach ($this->attributes as $Z5 => $Mb) {
            $xx = new DOMDocument();
            $ax = $xx->createElementNS("\x75\x72\x6e\72\157\x61\x73\151\x73\72\156\x61\x6d\x65\163\x3a\x74\x63\x3a\123\x41\115\x4c\72\x32\56\x30\x3a\141\x73\163\x65\x72\x74\x69\157\x6e", "\163\x61\x6d\154\x3a\x41\164\x74\x72\x69\142\x75\164\145");
            $ax->setAttribute("\x4e\x61\x6d\145", $Z5);
            $xx->appendChild($ax);
            if (!($this->nameFormat !== "\x75\x72\156\x3a\157\141\x73\x69\x73\x3a\x6e\x61\x6d\x65\163\x3a\x74\x63\72\123\101\115\x4c\x3a\62\x2e\x30\x3a\x61\164\x74\162\x6e\141\155\x65\55\x66\x6f\x72\155\141\x74\72\165\156\163\x70\145\143\x69\x66\x69\x65\x64")) {
                goto IS;
            }
            $ax->setAttribute("\x4e\141\155\145\x46\x6f\162\155\x61\x74", $this->nameFormat);
            IS:
            foreach ($Mb as $Y_) {
                if (is_string($Y_)) {
                    goto RV;
                }
                if (is_int($Y_)) {
                    goto vL;
                }
                $XR = NULL;
                goto wZ;
                RV:
                $XR = "\x78\163\72\x73\x74\x72\151\156\x67";
                goto wZ;
                vL:
                $XR = "\170\x73\x3a\151\x6e\164\145\147\145\162";
                wZ:
                $m5 = $xx->createElementNS("\165\162\x6e\x3a\x6f\x61\x73\x69\x73\72\x6e\x61\x6d\x65\163\x3a\164\x63\72\123\101\x4d\114\72\62\x2e\x30\x3a\x61\163\x73\x65\162\x74\151\x6f\x6e", "\x73\x61\x6d\154\72\101\x74\164\162\x69\x62\165\x74\x65\x56\x61\x6c\x75\145");
                $ax->appendChild($m5);
                if (!($XR !== NULL)) {
                    goto UL;
                }
                $m5->setAttributeNS("\x68\x74\x74\160\72\57\x2f\x77\x77\167\x2e\167\63\56\x6f\x72\x67\x2f\62\60\60\x31\57\x58\115\x4c\x53\143\x68\x65\155\x61\x2d\x69\x6e\163\x74\x61\156\143\145", "\x78\x73\151\72\164\171\160\145", $XR);
                UL:
                if ($Y_ instanceof DOMNodeList) {
                    goto ti;
                }
                $m5->appendChild($xx->createTextNode($Y_));
                goto Up;
                ti:
                $zO = 0;
                KG:
                if (!($zO < $Y_->length)) {
                    goto Fm;
                }
                $JM = $xx->importNode($Y_->item($zO), TRUE);
                $m5->appendChild($JM);
                es:
                $zO++;
                goto KG;
                Fm:
                Up:
                hf:
            }
            Xy:
            $AS = new XMLSecEnc();
            $AS->setNode($xx->documentElement);
            $AS->type = "\150\164\164\x70\72\x2f\57\167\167\167\x2e\x77\x33\x2e\157\162\147\x2f\x32\60\x30\x31\57\60\64\x2f\170\155\x6c\x65\x6e\143\x23\x45\154\x65\x6d\145\x6e\x74";
            $SZ = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $SZ->generateSessionKey();
            $AS->encryptKey($this->encryptionKey, $SZ);
            $ie = $AS->encryptNode($SZ);
            $yZ = $jE->createElementNS("\165\162\156\72\x6f\141\163\151\x73\72\156\x61\x6d\145\163\x3a\x74\143\x3a\123\x41\x4d\114\x3a\x32\56\60\x3a\141\x73\163\x65\x72\x74\151\157\x6e", "\163\x61\155\154\72\105\156\143\x72\171\x70\x74\145\144\101\x74\x74\162\151\142\165\x74\x65");
            $Qb->appendChild($yZ);
            $Td = $jE->importNode($ie, TRUE);
            $yZ->appendChild($Td);
            QX:
        }
        Xg:
    }
}
