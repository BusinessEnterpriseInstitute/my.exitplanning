<?php


include_once "\x55\164\151\154\151\164\x69\x65\163\56\160\150\160";
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
    public function __construct(DOMElement $Oe = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\x72\x6e\72\x6f\141\x73\x69\163\72\x6e\141\155\x65\x73\72\164\x63\72\123\x41\115\114\x3a\x31\x2e\61\72\x6e\141\155\x65\151\x64\x2d\x66\x6f\162\x6d\141\x74\x3a\x75\x6e\163\160\x65\143\151\146\151\x65\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($Oe === NULL)) {
            goto Z9;
        }
        return;
        Z9:
        if (!($Oe->localName === "\105\156\x63\162\171\x70\x74\x65\x64\x41\163\163\x65\162\x74\151\x6f\x6e")) {
            goto lt;
        }
        $ub = Utilities::xpQuery($Oe, "\x2e\x2f\x78\x65\156\143\x3a\x45\x6e\x63\x72\x79\160\164\x65\x64\x44\141\164\141");
        $ZG = Utilities::xpQuery($Oe, "\x2e\x2f\x78\x65\156\143\72\105\156\143\162\171\160\164\x65\144\x44\x61\x74\141\x2f\x64\163\72\x4b\145\171\111\x6e\x66\157\x2f\x78\145\x6e\143\72\x45\156\x63\x72\x79\x70\x74\x65\144\x4b\145\171");
        $zu = '';
        if (empty($ZG)) {
            goto GT;
        }
        $zu = $ZG[0]->firstChild->getAttribute("\101\154\x67\x6f\162\x69\x74\x68\x6d");
        goto nd;
        GT:
        $ZG = Utilities::xpQuery($Oe, "\56\x2f\x78\145\156\x63\x3a\105\x6e\x63\x72\x79\160\x74\145\x64\113\x65\x79\57\x78\145\156\143\x3a\105\156\x63\x72\171\160\164\x69\157\x6e\115\145\164\150\157\x64");
        $zu = $ZG[0]->getAttribute("\101\x6c\x67\157\x72\x69\x74\150\x6d");
        nd:
        $JG = Utilities::getEncryptionAlgorithm($zu);
        if (count($ub) === 0) {
            goto La;
        }
        if (count($ub) > 1) {
            goto xt;
        }
        goto AK;
        La:
        throw new Exception("\x4d\151\163\x73\151\156\147\40\145\156\x63\162\x79\x70\x74\x65\144\x20\x64\141\164\x61\x20\x69\x6e\x20\74\x73\x61\155\154\72\105\x6e\143\162\171\160\x74\x65\144\x41\163\x73\145\162\x74\x69\x6f\156\76\x2e");
        goto AK;
        xt:
        throw new Exception("\x4d\157\x72\145\40\x74\150\x61\x6e\40\157\x6e\x65\x20\145\156\x63\162\171\x70\164\145\x64\40\x64\141\x74\x61\x20\x65\x6c\145\x6d\x65\156\164\40\151\x6e\40\x3c\x73\x61\x6d\x6c\x3a\x45\x6e\143\x72\x79\160\x74\145\144\x41\x73\x73\x65\162\164\151\x6f\x6e\76\56");
        AK:
        $SB = '';
        $SB = variable_get("\x6d\x69\156\151\157\x72\141\156\147\145\x5f\163\x61\155\154\137\x70\x72\151\x76\141\164\145\x5f\143\145\162\x74\x69\146\151\143\x61\164\x65");
        $nL = new XMLSecurityKey($JG, array("\164\171\160\145" => "\x70\162\x69\x76\141\164\x65"));
        $Ay = drupal_get_path("\x6d\x6f\x64\x75\x6c\x65", "\x6d\x69\x6e\x69\x6f\x72\141\156\147\x65\137\x73\141\x6d\154");
        if ($SB != '') {
            goto kI;
        }
        $z6 = $Ay . "\57\x72\x65\163\x6f\x75\162\x63\145\x73\57\x73\160\55\x6b\x65\171\x2e\x6b\x65\171";
        goto MO;
        kI:
        $z6 = $Ay . "\57\x72\145\x73\x6f\165\162\143\x65\x73\x2f\x43\165\163\164\157\155\137\120\162\x69\166\x61\164\145\x5f\x43\x65\162\164\x69\146\151\143\141\x74\x65\56\153\x65\171";
        MO:
        $nL->loadKey($z6, TRUE);
        $iZ = new XMLSecurityKey($JG, array("\x74\x79\x70\145" => "\160\162\151\x76\x61\x74\x65"));
        $jX = $Ay . "\57\x72\145\163\157\x75\162\x63\145\163\57\155\151\x6e\151\157\x72\141\156\147\x65\x5f\163\160\x5f\160\x72\151\166\137\153\x65\171\56\x6b\145\x79";
        $iZ->loadKey($jX, TRUE);
        $hh = array();
        $Oe = Utilities::decryptElement($ub[0], $nL, $hh, $iZ);
        lt:
        if ($Oe->hasAttribute("\111\x44")) {
            goto Wz;
        }
        throw new Exception("\115\x69\x73\x73\x69\156\x67\40\111\x44\x20\x61\x74\164\162\151\x62\165\164\145\x20\x6f\156\40\x53\101\x4d\114\40\x61\x73\x73\145\162\x74\151\157\x6e\56");
        Wz:
        $this->id = $Oe->getAttribute("\111\x44");
        if (!($Oe->getAttribute("\126\x65\162\x73\x69\157\x6e") !== "\x32\x2e\60")) {
            goto LM;
        }
        throw new Exception("\x55\x6e\163\165\x70\x70\157\162\164\145\144\40\166\x65\x72\163\x69\157\156\72\40" . $Oe->getAttribute("\x56\x65\x72\163\151\x6f\156"));
        LM:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($Oe->getAttribute("\x49\x73\x73\x75\145\x49\x6e\163\164\x61\x6e\164"));
        $tR = Utilities::xpQuery($Oe, "\x2e\57\163\141\155\154\x5f\141\163\163\x65\162\x74\151\157\x6e\72\x49\x73\x73\165\x65\x72");
        if (!empty($tR)) {
            goto ph;
        }
        throw new Exception("\x4d\x69\x73\x73\x69\156\147\40\x3c\x73\141\155\x6c\72\111\x73\x73\165\x65\162\76\40\151\x6e\40\x61\163\163\145\162\164\151\157\156\56");
        ph:
        $this->issuer = trim($tR[0]->textContent);
        $this->parseConditions($Oe);
        $this->parseAuthnStatement($Oe);
        $this->parseAttributes($Oe);
        $this->parseEncryptedAttributes($Oe);
        $this->parseSignature($Oe);
        $this->parseSubject($Oe);
    }
    private function parseSubject(DOMElement $Oe)
    {
        $Kx = Utilities::xpQuery($Oe, "\56\x2f\163\141\x6d\x6c\137\x61\163\x73\x65\162\164\151\x6f\x6e\x3a\123\x75\142\152\x65\x63\164");
        if (empty($Kx)) {
            goto O7;
        }
        if (count($Kx) > 1) {
            goto VV;
        }
        goto gb;
        O7:
        return;
        goto gb;
        VV:
        throw new Exception("\115\157\162\x65\40\x74\x68\141\156\x20\157\x6e\x65\40\74\163\x61\155\154\x3a\123\x75\142\152\145\143\164\x3e\x20\x69\x6e\x20\74\163\x61\155\154\72\x41\163\163\145\162\x74\x69\157\156\76\56");
        gb:
        $Kx = $Kx[0];
        $ow = Utilities::xpQuery($Kx, "\x2e\x2f\x73\141\155\154\x5f\141\x73\163\x65\162\x74\151\157\x6e\72\x4e\x61\x6d\145\x49\104\40\174\x20\56\57\163\141\155\154\x5f\x61\x73\x73\x65\162\x74\x69\157\x6e\x3a\x45\x6e\143\x72\x79\x70\164\x65\144\111\x44\57\x78\145\x6e\x63\72\105\x6e\x63\162\171\x70\164\x65\144\104\141\164\x61");
        if (empty($ow)) {
            goto Th;
        }
        if (count($ow) > 1) {
            goto xG;
        }
        goto c0;
        Th:
        throw new Exception("\x4d\151\163\x73\x69\156\147\40\74\x73\141\155\x6c\x3a\x4e\x61\155\145\111\104\x3e\40\x6f\x72\40\x3c\x73\x61\x6d\154\72\105\156\143\x72\x79\x70\x74\145\144\x49\x44\x3e\40\x69\x6e\40\x3c\x73\141\x6d\154\x3a\123\x75\x62\152\145\x63\x74\x3e\56");
        goto c0;
        xG:
        throw new Exception("\x4d\x6f\162\145\40\164\x68\141\156\40\x6f\156\145\40\x3c\163\x61\x6d\154\72\116\x61\155\x65\111\104\76\x20\157\x72\x20\x3c\163\x61\x6d\154\x3a\x45\156\x63\162\x79\x70\x74\145\x64\x44\x3e\x20\x69\x6e\x20\74\163\141\155\x6c\x3a\x53\165\x62\152\145\x63\164\76\56");
        c0:
        $ow = $ow[0];
        if ($ow->localName === "\105\x6e\x63\162\x79\160\164\x65\144\x44\x61\x74\x61") {
            goto th;
        }
        $this->nameId = Utilities::parseNameId($ow);
        goto EM;
        th:
        $this->encryptedNameId = $ow;
        EM:
    }
    private function parseConditions(DOMElement $Oe)
    {
        $KD = Utilities::xpQuery($Oe, "\56\x2f\x73\141\155\x6c\137\141\x73\163\145\162\164\x69\x6f\x6e\x3a\103\x6f\x6e\x64\151\x74\x69\x6f\x6e\163");
        if (empty($KD)) {
            goto nw;
        }
        if (count($KD) > 1) {
            goto Yk;
        }
        goto oJ;
        nw:
        return;
        goto oJ;
        Yk:
        throw new Exception("\115\157\162\x65\40\164\x68\x61\156\40\157\156\x65\x20\74\163\x61\x6d\x6c\x3a\x43\157\156\x64\x69\164\151\157\x6e\x73\x3e\40\151\x6e\x20\74\x73\x61\155\x6c\72\101\163\163\145\x72\164\151\157\156\76\x2e");
        oJ:
        $KD = $KD[0];
        if (!$KD->hasAttribute("\x4e\157\164\x42\x65\x66\157\162\145")) {
            goto n2;
        }
        $H5 = Utilities::xsDateTimeToTimestamp($KD->getAttribute("\116\x6f\164\102\x65\x66\x6f\162\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $H5)) {
            goto vG;
        }
        $this->notBefore = $H5;
        vG:
        n2:
        if (!$KD->hasAttribute("\x4e\157\164\117\x6e\117\x72\x41\x66\x74\145\162")) {
            goto cI;
        }
        $kj = Utilities::xsDateTimeToTimestamp($KD->getAttribute("\116\x6f\164\x4f\x6e\117\x72\x41\x66\x74\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $kj)) {
            goto nz;
        }
        $this->notOnOrAfter = $kj;
        nz:
        cI:
        $cV = $KD->firstChild;
        Hv:
        if (!($cV !== NULL)) {
            goto kX;
        }
        if (!$cV instanceof DOMText) {
            goto la;
        }
        goto Hc;
        la:
        if (!($cV->namespaceURI !== "\165\x72\x6e\72\x6f\x61\x73\x69\163\72\x6e\141\x6d\145\x73\72\x74\143\x3a\123\101\x4d\114\x3a\62\x2e\x30\72\141\163\163\145\162\x74\151\x6f\x6e")) {
            goto ta;
        }
        throw new Exception("\x55\156\153\156\157\167\x6e\x20\x6e\141\x6d\145\x73\x70\141\x63\x65\x20\157\x66\x20\x63\x6f\x6e\x64\x69\x74\x69\157\156\72\40" . var_export($cV->namespaceURI, TRUE));
        ta:
        switch ($cV->localName) {
            case "\x41\165\144\151\x65\x6e\x63\x65\122\x65\x73\x74\x72\x69\x63\x74\151\157\156":
                $oK = Utilities::extractStrings($cV, "\x75\x72\156\72\x6f\141\163\x69\x73\x3a\x6e\x61\155\x65\x73\x3a\x74\143\72\123\x41\x4d\x4c\72\62\x2e\60\72\x61\x73\x73\x65\x72\x74\151\x6f\x6e", "\x41\x75\x64\151\145\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto vK;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $oK);
                goto fQ;
                vK:
                $this->validAudiences = $oK;
                fQ:
                goto QM;
            case "\117\x6e\x65\124\151\155\145\125\163\x65":
                goto QM;
            case "\120\162\157\170\171\x52\x65\163\164\x72\x69\x63\x74\151\x6f\x6e":
                goto QM;
            default:
                throw new Exception("\125\156\153\156\157\x77\x6e\x20\x63\x6f\x6e\144\x69\164\151\157\156\72\x20" . var_export($cV->localName, TRUE));
        }
        iL:
        QM:
        Hc:
        $cV = $cV->nextSibling;
        goto Hv;
        kX:
    }
    private function parseAuthnStatement(DOMElement $Oe)
    {
        $yC = Utilities::xpQuery($Oe, "\x2e\57\x73\141\x6d\x6c\x5f\x61\163\x73\x65\162\164\151\x6f\x6e\72\101\165\164\150\x6e\x53\164\141\164\145\155\x65\x6e\x74");
        if (empty($yC)) {
            goto e5;
        }
        if (count($yC) > 1) {
            goto j2;
        }
        goto GB;
        e5:
        $this->authnInstant = NULL;
        return;
        goto GB;
        j2:
        throw new Exception("\115\x6f\x72\145\40\x74\x68\x61\164\40\x6f\x6e\x65\x20\74\163\x61\x6d\154\72\101\165\x74\150\x6e\x53\x74\x61\164\x65\155\x65\156\x74\x3e\40\151\156\40\x3c\163\x61\155\154\72\101\x73\x73\x65\x72\164\x69\157\x6e\76\x20\x6e\157\x74\x20\163\165\x70\x70\157\x72\164\x65\x64\56");
        GB:
        $Mi = $yC[0];
        if ($Mi->hasAttribute("\101\165\x74\150\156\111\x6e\x73\164\141\x6e\164")) {
            goto XB;
        }
        throw new Exception("\115\151\163\x73\x69\x6e\x67\40\162\145\x71\165\151\x72\145\x64\40\x41\165\x74\x68\x6e\111\x6e\163\164\x61\x6e\164\x20\141\x74\164\x72\151\142\x75\x74\145\40\x6f\156\40\x3c\x73\141\155\x6c\72\x41\165\164\150\156\123\164\x61\x74\145\x6d\x65\156\164\x3e\x2e");
        XB:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($Mi->getAttribute("\x41\165\164\150\x6e\111\156\x73\x74\x61\x6e\x74"));
        if (!$Mi->hasAttribute("\x53\145\163\163\x69\x6f\156\116\157\164\x4f\156\117\x72\x41\x66\164\145\x72")) {
            goto hW;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($Mi->getAttribute("\x53\145\163\163\151\157\x6e\x4e\x6f\x74\117\156\x4f\162\x41\146\x74\x65\162"));
        hW:
        if (!$Mi->hasAttribute("\123\x65\x73\163\151\157\156\x49\156\x64\x65\170")) {
            goto nc;
        }
        $this->sessionIndex = $Mi->getAttribute("\123\x65\163\x73\151\157\x6e\x49\156\x64\x65\x78");
        nc:
        $this->parseAuthnContext($Mi);
    }
    private function parseAuthnContext(DOMElement $RH)
    {
        $Aq = Utilities::xpQuery($RH, "\56\57\163\x61\x6d\x6c\137\141\x73\163\145\162\x74\151\157\x6e\x3a\101\x75\x74\150\x6e\x43\157\x6e\x74\145\x78\164");
        if (count($Aq) > 1) {
            goto ED;
        }
        if (empty($Aq)) {
            goto Rv;
        }
        goto lx;
        ED:
        throw new Exception("\x4d\x6f\162\x65\x20\164\x68\x61\156\40\x6f\156\x65\40\74\163\x61\x6d\154\x3a\x41\x75\x74\x68\156\103\x6f\156\164\145\x78\x74\76\40\151\156\40\74\163\x61\x6d\x6c\72\x41\x75\164\x68\156\x53\164\141\164\145\155\145\x6e\164\76\x2e");
        goto lx;
        Rv:
        throw new Exception("\115\x69\163\163\151\156\147\x20\x72\145\x71\x75\x69\x72\145\x64\40\74\x73\x61\x6d\x6c\72\x41\165\x74\150\x6e\103\x6f\156\x74\x65\170\x74\x3e\x20\151\x6e\x20\x3c\163\141\x6d\154\72\x41\x75\x74\x68\156\123\x74\141\164\145\x6d\145\156\x74\x3e\x2e");
        lx:
        $Q0 = $Aq[0];
        $eD = Utilities::xpQuery($Q0, "\x2e\x2f\163\x61\x6d\x6c\x5f\141\163\163\145\162\x74\151\157\x6e\72\x41\165\x74\x68\x6e\103\157\156\x74\x65\x78\164\104\145\143\x6c\122\x65\146");
        if (count($eD) > 1) {
            goto r5;
        }
        if (count($eD) === 1) {
            goto M7;
        }
        goto t8;
        r5:
        throw new Exception("\115\x6f\x72\x65\40\164\x68\x61\156\40\x6f\156\145\40\x3c\163\x61\x6d\154\x3a\x41\165\164\x68\x6e\103\x6f\156\x74\x65\x78\164\104\145\x63\154\x52\x65\146\x3e\x20\146\x6f\165\156\x64\x3f");
        goto t8;
        M7:
        $this->setAuthnContextDeclRef(trim($eD[0]->textContent));
        t8:
        $Xb = Utilities::xpQuery($Q0, "\56\57\163\141\155\154\137\141\x73\163\145\162\x74\x69\x6f\156\72\101\x75\164\150\x6e\x43\157\156\x74\145\x78\x74\104\x65\143\x6c");
        if (count($Xb) > 1) {
            goto nf;
        }
        if (count($Xb) === 1) {
            goto Kk;
        }
        goto av;
        nf:
        throw new Exception("\x4d\157\x72\145\x20\164\150\x61\x6e\x20\157\156\145\40\74\163\141\x6d\154\x3a\101\x75\x74\x68\x6e\103\157\x6e\164\x65\x78\x74\x44\145\143\x6c\x3e\x20\x66\157\165\x6e\144\77");
        goto av;
        Kk:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($Xb[0]));
        av:
        $Rm = Utilities::xpQuery($Q0, "\x2e\57\163\141\155\x6c\x5f\x61\163\163\145\x72\x74\151\157\156\x3a\x41\165\164\150\156\x43\157\156\164\145\170\164\103\154\141\x73\163\122\145\x66");
        if (count($Rm) > 1) {
            goto Db;
        }
        if (count($Rm) === 1) {
            goto qr;
        }
        goto q6;
        Db:
        throw new Exception("\x4d\157\x72\x65\40\x74\150\x61\x6e\40\x6f\156\x65\x20\74\163\141\x6d\154\x3a\101\x75\x74\x68\156\103\157\x6e\x74\x65\x78\x74\103\x6c\x61\x73\163\122\x65\x66\76\40\x69\156\x20\74\163\141\155\154\72\101\x75\164\x68\156\103\x6f\x6e\164\145\170\164\76\56");
        goto q6;
        qr:
        $this->setAuthnContextClassRef(trim($Rm[0]->textContent));
        q6:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto tv;
        }
        throw new Exception("\x4d\x69\163\x73\x69\156\147\40\145\151\x74\x68\145\162\x20\74\x73\x61\x6d\x6c\72\x41\165\x74\x68\156\103\157\156\x74\x65\170\x74\x43\154\141\163\163\122\145\146\x3e\x20\157\x72\40\x3c\x73\141\155\x6c\72\101\165\x74\x68\x6e\103\157\x6e\x74\145\170\164\104\x65\x63\154\x52\x65\x66\x3e\40\x6f\162\40\74\163\141\x6d\x6c\x3a\x41\165\x74\150\156\x43\157\x6e\164\x65\170\164\x44\145\143\154\x3e");
        tv:
        $this->AuthenticatingAuthority = Utilities::extractStrings($Q0, "\165\162\156\72\157\141\163\x69\x73\72\156\x61\155\x65\x73\72\164\143\72\x53\x41\115\x4c\x3a\62\x2e\60\72\141\x73\x73\145\162\x74\151\157\156", "\101\x75\x74\x68\145\x6e\164\151\x63\141\164\x69\x6e\x67\x41\x75\x74\x68\157\x72\151\164\171");
    }
    private function parseAttributes(DOMElement $Oe)
    {
        $Q6 = TRUE;
        $FU = Utilities::xpQuery($Oe, "\x2e\x2f\163\x61\155\154\x5f\x61\x73\x73\145\x72\x74\151\157\156\72\101\164\x74\x72\151\x62\x75\164\145\x53\x74\141\x74\145\x6d\x65\x6e\164\x2f\x73\141\155\154\137\x61\163\x73\x65\x72\x74\151\157\x6e\72\x41\x74\164\162\x69\142\165\x74\145");
        foreach ($FU as $JB) {
            if ($JB->hasAttribute("\116\x61\x6d\145")) {
                goto V2;
            }
            throw new Exception("\115\x69\163\x73\x69\x6e\x67\x20\x6e\x61\x6d\145\40\157\156\x20\74\x73\141\x6d\154\x3a\x41\164\x74\162\151\142\165\x74\145\76\40\145\154\x65\x6d\145\156\x74\x2e");
            V2:
            $lX = $JB->getAttribute("\116\141\155\x65");
            if ($JB->hasAttribute("\x4e\141\x6d\145\106\x6f\x72\155\x61\x74")) {
                goto T6;
            }
            $Eo = "\165\x72\x6e\x3a\157\x61\x73\x69\163\72\156\141\155\x65\163\72\x74\143\72\123\x41\115\114\x3a\x31\x2e\x31\x3a\156\x61\155\x65\x69\x64\x2d\x66\157\162\x6d\141\164\x3a\x75\156\x73\160\145\x63\151\x66\x69\145\x64";
            goto pE;
            T6:
            $Eo = $JB->getAttribute("\x4e\141\x6d\145\x46\157\162\x6d\x61\x74");
            pE:
            if ($Q6) {
                goto Dn;
            }
            if (!($this->nameFormat !== $Eo)) {
                goto UQ;
            }
            $this->nameFormat = "\165\x72\x6e\72\x6f\141\x73\x69\x73\72\x6e\141\x6d\x65\x73\x3a\164\x63\72\x53\101\x4d\114\72\x31\56\x31\72\x6e\141\155\145\151\x64\55\146\157\162\x6d\x61\x74\72\x75\156\163\160\x65\x63\151\146\x69\145\x64";
            UQ:
            goto gh;
            Dn:
            $this->nameFormat = $Eo;
            $Q6 = FALSE;
            gh:
            if (array_key_exists($lX, $this->attributes)) {
                goto Rm;
            }
            $this->attributes[$lX] = array();
            Rm:
            $Vv = Utilities::xpQuery($JB, "\56\x2f\163\x61\155\x6c\137\x61\x73\163\145\162\164\151\157\156\72\x41\164\164\162\x69\142\165\164\x65\x56\141\154\x75\145");
            foreach ($Vv as $e1) {
                $this->attributes[$lX][] = trim($e1->textContent);
                d3:
            }
            L5:
            mp:
        }
        dm:
    }
    private function parseEncryptedAttributes(DOMElement $Oe)
    {
        $this->encryptedAttribute = Utilities::xpQuery($Oe, "\x2e\x2f\163\x61\x6d\x6c\x5f\x61\163\x73\x65\162\164\151\x6f\156\72\101\x74\164\162\151\x62\165\x74\145\x53\x74\141\164\145\155\145\156\x74\x2f\x73\x61\155\154\x5f\x61\x73\x73\x65\x72\164\x69\x6f\x6e\72\105\x6e\x63\162\x79\160\164\145\144\x41\164\x74\x72\x69\142\x75\164\x65");
    }
    private function parseSignature(DOMElement $Oe)
    {
        $sP = Utilities::validateElement($Oe);
        if (!($sP !== FALSE)) {
            goto Hf;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $sP["\x43\x65\x72\164\x69\x66\151\143\141\164\145\163"];
        $this->signatureData = $sP;
        Hf:
    }
    public function validate(XMLSecurityKey $nL)
    {
        if (!($this->signatureData === NULL)) {
            goto HE;
        }
        return FALSE;
        HE:
        Utilities::validateSignature($this->signatureData, $nL);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($WI)
    {
        $this->id = $WI;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($jM)
    {
        $this->issueInstant = $jM;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($tR)
    {
        $this->issuer = $tR;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto v5;
        }
        throw new Exception("\101\164\x74\x65\x6d\160\x74\x65\144\x20\164\x6f\x20\162\x65\164\x72\151\145\166\145\40\145\156\143\x72\171\x70\x74\x65\144\40\x4e\141\x6d\145\x49\x44\40\x77\151\164\x68\157\x75\x74\x20\x64\145\x63\x72\171\160\164\x69\x6e\x67\x20\151\x74\x20\x66\x69\162\x73\x74\56");
        v5:
        return $this->nameId;
    }
    public function setNameId($ow)
    {
        $this->nameId = $ow;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Jv;
        }
        return TRUE;
        Jv:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $nL)
    {
        $av = new DOMDocument();
        $uc = $av->createElement("\x72\x6f\x6f\164");
        $av->appendChild($uc);
        Utilities::addNameId($uc, $this->nameId);
        $ow = $uc->firstChild;
        Utilities::getContainer()->debugMessage($ow, "\x65\156\x63\162\x79\160\x74");
        $p4 = new XMLSecEnc();
        $p4->setNode($ow);
        $p4->type = XMLSecEnc::Element;
        $gg = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $gg->generateSessionKey();
        $p4->encryptKey($nL, $gg);
        $this->encryptedNameId = $p4->encryptNode($gg);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $nL, array $hh = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto Dq;
        }
        return;
        Dq:
        $ow = Utilities::decryptElement($this->encryptedNameId, $nL, $hh);
        Utilities::getContainer()->debugMessage($ow, "\x64\x65\x63\162\171\x70\x74");
        $this->nameId = Utilities::parseNameId($ow);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $nL, array $hh = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto ZE;
        }
        return;
        ZE:
        $Q6 = TRUE;
        $FU = $this->encryptedAttribute;
        foreach ($FU as $It) {
            $JB = Utilities::decryptElement($It->getElementsByTagName("\105\156\x63\x72\x79\x70\164\x65\x64\x44\141\164\141")->item(0), $nL, $hh);
            if ($JB->hasAttribute("\x4e\x61\x6d\x65")) {
                goto gv;
            }
            throw new Exception("\x4d\151\163\x73\x69\x6e\147\x20\156\x61\x6d\145\40\x6f\x6e\40\x3c\x73\x61\155\154\72\x41\164\164\162\151\142\x75\164\145\76\x20\x65\x6c\x65\x6d\145\x6e\164\56");
            gv:
            $lX = $JB->getAttribute("\116\x61\x6d\x65");
            if ($JB->hasAttribute("\116\141\155\145\x46\x6f\x72\x6d\141\164")) {
                goto yh;
            }
            $Eo = "\165\162\x6e\x3a\157\x61\163\151\163\72\x6e\141\155\145\x73\x3a\164\143\72\123\101\x4d\114\x3a\62\56\60\72\141\x74\x74\162\156\x61\155\145\x2d\x66\x6f\x72\x6d\x61\164\x3a\x75\x6e\163\160\145\x63\151\146\x69\x65\144";
            goto Oy;
            yh:
            $Eo = $JB->getAttribute("\116\141\155\145\106\x6f\162\x6d\x61\x74");
            Oy:
            if ($Q6) {
                goto aE;
            }
            if (!($this->nameFormat !== $Eo)) {
                goto z1;
            }
            $this->nameFormat = "\x75\162\156\72\x6f\141\163\x69\x73\x3a\156\141\x6d\145\163\72\x74\143\x3a\123\x41\x4d\114\72\62\56\60\x3a\141\164\x74\x72\x6e\x61\x6d\145\x2d\146\x6f\x72\x6d\141\164\72\x75\x6e\163\x70\x65\143\151\146\x69\x65\x64";
            z1:
            goto Rh;
            aE:
            $this->nameFormat = $Eo;
            $Q6 = FALSE;
            Rh:
            if (array_key_exists($lX, $this->attributes)) {
                goto n1;
            }
            $this->attributes[$lX] = array();
            n1:
            $Vv = Utilities::xpQuery($JB, "\56\57\x73\141\155\x6c\x5f\x61\x73\163\x65\162\164\x69\x6f\x6e\x3a\x41\164\x74\162\151\142\x75\164\x65\x56\141\x6c\165\145");
            foreach ($Vv as $e1) {
                $this->attributes[$lX][] = trim($e1->textContent);
                Fd:
            }
            GU:
            TU:
        }
        Tw:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($H5)
    {
        $this->notBefore = $H5;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($kj)
    {
        $this->notOnOrAfter = $kj;
    }
    public function setEncryptedAttributes($oc)
    {
        $this->requiredEncAttributes = $oc;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $tu = NULL)
    {
        $this->validAudiences = $tu;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($QZ)
    {
        $this->authnInstant = $QZ;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($c0)
    {
        $this->sessionNotOnOrAfter = $c0;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($qI)
    {
        $this->sessionIndex = $qI;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto pr;
        }
        return $this->authnContextClassRef;
        pr:
        if (empty($this->authnContextDeclRef)) {
            goto gY;
        }
        return $this->authnContextDeclRef;
        gY:
        return NULL;
    }
    public function setAuthnContext($xQ)
    {
        $this->setAuthnContextClassRef($xQ);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($kg)
    {
        $this->authnContextClassRef = $kg;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $JE)
    {
        if (empty($this->authnContextDeclRef)) {
            goto h5;
        }
        throw new Exception("\x41\165\164\150\x6e\103\x6f\x6e\x74\145\x78\x74\104\x65\143\x6c\x52\x65\x66\x20\151\163\x20\141\x6c\162\x65\x61\x64\x79\40\x72\145\x67\151\x73\x74\x65\162\145\x64\41\40\x4d\141\x79\40\157\x6e\154\x79\x20\x68\x61\166\x65\x20\145\151\164\150\145\x72\40\x61\40\104\145\x63\154\x20\157\x72\x20\x61\40\104\x65\143\154\122\x65\146\x2c\40\x6e\157\x74\x20\142\x6f\164\x68\41");
        h5:
        $this->authnContextDecl = $JE;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($ob)
    {
        if (empty($this->authnContextDecl)) {
            goto tQ;
        }
        throw new Exception("\x41\165\164\x68\156\103\157\156\x74\x65\170\x74\104\145\x63\x6c\x20\151\x73\40\141\x6c\x72\145\x61\144\x79\x20\x72\145\147\x69\x73\164\145\162\x65\144\41\40\115\141\x79\40\157\156\154\171\40\x68\x61\x76\145\x20\145\x69\x74\150\145\x72\x20\141\40\104\145\x63\154\40\x6f\162\40\141\40\x44\145\x63\x6c\122\145\146\54\x20\x6e\157\x74\x20\142\x6f\x74\150\x21");
        tQ:
        $this->authnContextDeclRef = $ob;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($Xf)
    {
        $this->AuthenticatingAuthority = $Xf;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $FU)
    {
        $this->attributes = $FU;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($Eo)
    {
        $this->nameFormat = $Eo;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $rn)
    {
        $this->SubjectConfirmation = $rn;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $Hg = NULL)
    {
        $this->signatureKey = $Hg;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $x6 = NULL)
    {
        $this->encryptionKey = $x6;
    }
    public function setCertificates(array $Ky)
    {
        $this->certificates = $Ky;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $M8 = NULL)
    {
        if ($M8 === NULL) {
            goto uz;
        }
        $hS = $M8->ownerDocument;
        goto Lu;
        uz:
        $hS = new DOMDocument();
        $M8 = $hS;
        Lu:
        $uc = $hS->createElementNS("\x75\162\156\x3a\x6f\x61\163\151\163\72\x6e\x61\155\x65\163\72\164\143\x3a\123\101\115\114\72\62\x2e\60\72\x61\x73\163\x65\x72\164\x69\157\x6e", "\x73\141\155\x6c\72" . "\x41\x73\x73\x65\162\164\151\x6f\x6e");
        $M8->appendChild($uc);
        $uc->setAttributeNS("\x75\x72\156\72\x6f\x61\x73\x69\163\x3a\x6e\141\x6d\145\163\72\x74\x63\x3a\123\101\115\x4c\x3a\62\56\60\72\x70\x72\x6f\164\x6f\x63\x6f\154", "\163\141\x6d\x6c\160\72\164\155\160", "\164\155\160");
        $uc->removeAttributeNS("\165\162\156\x3a\157\141\x73\151\163\x3a\x6e\141\155\145\163\72\x74\143\x3a\x53\x41\x4d\114\x3a\62\56\60\72\160\x72\157\164\157\143\x6f\154", "\164\155\160");
        $uc->setAttributeNS("\x68\x74\x74\160\72\x2f\57\x77\167\167\x2e\167\x33\56\157\x72\147\57\x32\60\60\x31\57\x58\x4d\x4c\x53\x63\x68\145\x6d\141\55\x69\x6e\163\x74\141\156\x63\145", "\170\163\151\72\164\155\160", "\x74\155\x70");
        $uc->removeAttributeNS("\x68\164\x74\160\72\x2f\x2f\x77\167\x77\x2e\x77\63\x2e\x6f\162\147\x2f\x32\60\60\61\x2f\x58\115\114\123\143\x68\145\155\141\x2d\x69\x6e\x73\164\141\x6e\x63\145", "\x74\x6d\x70");
        $uc->setAttributeNS("\x68\x74\x74\160\72\57\57\x77\x77\167\56\x77\x33\56\157\x72\x67\57\62\x30\60\x31\57\x58\115\114\x53\143\x68\145\155\x61", "\170\x73\x3a\164\155\160", "\164\x6d\160");
        $uc->removeAttributeNS("\x68\x74\164\160\x3a\x2f\57\167\x77\167\x2e\167\x33\x2e\157\162\x67\57\62\60\60\61\x2f\x58\115\x4c\123\143\x68\145\x6d\141", "\x74\x6d\160");
        $uc->setAttribute("\111\104", $this->id);
        $uc->setAttribute("\126\x65\162\163\x69\x6f\x6e", "\62\56\60");
        $uc->setAttribute("\x49\163\x73\165\x65\111\156\163\164\141\156\164", gmdate("\131\x2d\155\x2d\x64\x5c\124\x48\72\x69\x3a\163\x5c\x5a", $this->issueInstant));
        $tR = Utilities::addString($uc, "\165\162\x6e\72\157\141\163\151\163\x3a\156\x61\x6d\x65\163\72\x74\143\72\x53\x41\115\114\72\62\x2e\x30\x3a\x61\x73\163\x65\x72\x74\151\157\156", "\x73\141\x6d\x6c\x3a\111\x73\163\165\145\x72", $this->issuer);
        $this->addSubject($uc);
        $this->addConditions($uc);
        $this->addAuthnStatement($uc);
        if ($this->requiredEncAttributes == FALSE) {
            goto o_;
        }
        $this->addEncryptedAttributeStatement($uc);
        goto UV;
        o_:
        $this->addAttributeStatement($uc);
        UV:
        if (!($this->signatureKey !== NULL)) {
            goto Qg;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $uc, $tR->nextSibling);
        Qg:
        return $uc;
    }
    private function addSubject(DOMElement $uc)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto i9;
        }
        return;
        i9:
        $Kx = $uc->ownerDocument->createElementNS("\165\162\x6e\72\x6f\x61\163\x69\x73\x3a\156\x61\x6d\145\x73\x3a\x74\143\72\x53\x41\115\x4c\72\x32\x2e\60\x3a\141\163\x73\x65\x72\164\151\157\x6e", "\163\x61\x6d\x6c\x3a\123\165\x62\x6a\145\143\164");
        $uc->appendChild($Kx);
        if ($this->encryptedNameId === NULL) {
            goto k0;
        }
        $iD = $Kx->ownerDocument->createElementNS("\165\x72\156\x3a\157\x61\x73\x69\x73\x3a\x6e\x61\x6d\x65\163\72\x74\143\x3a\x53\101\x4d\x4c\x3a\62\56\x30\72\141\163\x73\145\x72\164\x69\157\x6e", "\x73\141\155\x6c\72" . "\105\x6e\143\162\x79\x70\x74\x65\x64\x49\x44");
        $Kx->appendChild($iD);
        $iD->appendChild($Kx->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto jC;
        k0:
        Utilities::addNameId($Kx, $this->nameId);
        jC:
        foreach ($this->SubjectConfirmation as $kG) {
            $kG->toXML($Kx);
            H7:
        }
        hT:
    }
    private function addConditions(DOMElement $uc)
    {
        $hS = $uc->ownerDocument;
        $KD = $hS->createElementNS("\x75\x72\x6e\72\157\x61\163\151\163\72\x6e\141\155\x65\x73\x3a\x74\x63\72\x53\x41\x4d\x4c\x3a\x32\56\60\x3a\141\x73\163\x65\162\x74\151\x6f\156", "\163\141\x6d\154\72\103\157\156\144\x69\164\x69\x6f\x6e\x73");
        $uc->appendChild($KD);
        if (!($this->notBefore !== NULL)) {
            goto hd;
        }
        $KD->setAttribute("\x4e\157\x74\102\x65\x66\157\x72\x65", gmdate("\x59\55\155\55\144\x5c\124\110\x3a\151\x3a\163\x5c\132", $this->notBefore));
        hd:
        if (!($this->notOnOrAfter !== NULL)) {
            goto Dp;
        }
        $KD->setAttribute("\x4e\157\164\x4f\156\117\162\x41\146\x74\x65\x72", gmdate("\131\x2d\155\x2d\x64\x5c\x54\x48\x3a\x69\x3a\x73\134\x5a", $this->notOnOrAfter));
        Dp:
        if (!($this->validAudiences !== NULL)) {
            goto oB;
        }
        $Q5 = $hS->createElementNS("\165\162\x6e\72\x6f\141\x73\x69\x73\72\156\141\155\145\163\72\x74\x63\72\123\x41\115\x4c\72\x32\56\60\x3a\141\x73\x73\145\x72\164\151\157\156", "\163\x61\x6d\x6c\x3a\101\x75\x64\x69\145\156\x63\x65\122\x65\x73\x74\162\x69\x63\x74\151\157\156");
        $KD->appendChild($Q5);
        Utilities::addStrings($Q5, "\165\162\x6e\x3a\x6f\x61\163\x69\163\72\156\x61\x6d\145\x73\x3a\x74\143\72\x53\101\x4d\x4c\72\x32\x2e\60\72\x61\x73\163\145\162\x74\x69\157\x6e", "\163\141\155\154\72\x41\x75\x64\x69\x65\156\143\x65", FALSE, $this->validAudiences);
        oB:
    }
    private function addAuthnStatement(DOMElement $uc)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto AP;
        }
        return;
        AP:
        $hS = $uc->ownerDocument;
        $RH = $hS->createElementNS("\165\162\x6e\x3a\x6f\x61\163\x69\x73\x3a\x6e\141\155\x65\x73\72\x74\x63\x3a\x53\x41\115\114\x3a\62\x2e\x30\x3a\x61\x73\x73\x65\162\x74\x69\157\x6e", "\x73\x61\x6d\x6c\72\101\165\164\x68\x6e\x53\164\x61\x74\x65\155\x65\x6e\x74");
        $uc->appendChild($RH);
        $RH->setAttribute("\101\165\164\x68\x6e\x49\156\x73\164\141\x6e\164", gmdate("\x59\55\x6d\x2d\144\134\124\110\72\x69\x3a\163\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto tC;
        }
        $RH->setAttribute("\x53\x65\x73\163\x69\x6f\x6e\116\157\164\x4f\x6e\117\162\x41\146\164\x65\x72", gmdate("\x59\x2d\x6d\x2d\144\x5c\124\110\72\x69\x3a\163\134\x5a", $this->sessionNotOnOrAfter));
        tC:
        if (!($this->sessionIndex !== NULL)) {
            goto rp;
        }
        $RH->setAttribute("\123\x65\x73\x73\x69\x6f\156\111\156\144\145\170", $this->sessionIndex);
        rp:
        $Q0 = $hS->createElementNS("\x75\x72\x6e\x3a\x6f\x61\x73\x69\x73\x3a\x6e\x61\x6d\x65\x73\x3a\x74\x63\72\x53\101\115\114\x3a\62\x2e\60\72\141\x73\x73\145\162\x74\151\157\156", "\163\x61\155\x6c\72\101\x75\164\x68\x6e\x43\157\156\164\x65\170\x74");
        $RH->appendChild($Q0);
        if (empty($this->authnContextClassRef)) {
            goto zi;
        }
        Utilities::addString($Q0, "\x75\162\156\72\x6f\141\163\151\163\x3a\156\x61\155\x65\163\x3a\x74\143\x3a\x53\x41\115\114\72\x32\x2e\60\72\x61\x73\x73\x65\x72\164\151\157\156", "\163\x61\155\154\x3a\x41\165\x74\150\156\x43\157\156\164\x65\x78\164\103\x6c\x61\x73\x73\122\x65\x66", $this->authnContextClassRef);
        zi:
        if (empty($this->authnContextDecl)) {
            goto WW;
        }
        $this->authnContextDecl->toXML($Q0);
        WW:
        if (empty($this->authnContextDeclRef)) {
            goto Ts;
        }
        Utilities::addString($Q0, "\x75\x72\156\72\157\141\163\151\163\x3a\156\141\x6d\145\163\x3a\164\x63\72\x53\x41\115\x4c\x3a\x32\56\x30\x3a\141\x73\x73\x65\x72\164\151\157\156", "\x73\x61\x6d\154\72\x41\165\x74\150\x6e\103\157\156\164\x65\170\x74\x44\145\x63\x6c\x52\x65\x66", $this->authnContextDeclRef);
        Ts:
        Utilities::addStrings($Q0, "\165\162\x6e\72\157\141\x73\x69\163\72\156\x61\x6d\145\x73\x3a\x74\x63\72\123\x41\115\x4c\x3a\62\56\60\72\141\x73\163\x65\162\164\151\157\x6e", "\x73\141\x6d\x6c\x3a\101\x75\164\x68\145\156\x74\x69\143\141\x74\151\x6e\147\101\x75\164\150\157\162\x69\x74\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $uc)
    {
        if (!empty($this->attributes)) {
            goto NX;
        }
        return;
        NX:
        $hS = $uc->ownerDocument;
        $a6 = $hS->createElementNS("\x75\162\156\x3a\157\141\163\x69\x73\72\156\x61\x6d\145\x73\72\164\143\72\x53\101\115\x4c\72\62\x2e\x30\x3a\x61\163\x73\x65\162\164\151\x6f\156", "\163\x61\x6d\154\x3a\x41\x74\164\162\151\x62\165\x74\145\123\164\x61\x74\145\x6d\145\156\x74");
        $uc->appendChild($a6);
        foreach ($this->attributes as $lX => $Vv) {
            $JB = $hS->createElementNS("\x75\x72\156\72\157\x61\163\151\x73\x3a\x6e\141\x6d\145\163\72\164\x63\x3a\x53\101\x4d\x4c\72\62\x2e\60\x3a\141\x73\x73\x65\x72\164\151\157\x6e", "\163\x61\155\x6c\x3a\101\164\164\162\x69\142\x75\164\145");
            $a6->appendChild($JB);
            $JB->setAttribute("\116\x61\x6d\x65", $lX);
            if (!($this->nameFormat !== "\x75\x72\x6e\72\x6f\x61\x73\x69\163\x3a\x6e\141\x6d\145\x73\72\x74\x63\72\123\101\x4d\114\x3a\x32\56\x30\x3a\141\164\x74\162\x6e\141\x6d\x65\x2d\146\x6f\162\155\141\x74\x3a\165\156\163\x70\145\x63\x69\x66\x69\x65\144")) {
                goto lG;
            }
            $JB->setAttribute("\116\x61\x6d\x65\x46\x6f\x72\155\141\164", $this->nameFormat);
            lG:
            foreach ($Vv as $e1) {
                if (is_string($e1)) {
                    goto Dk;
                }
                if (is_int($e1)) {
                    goto I3;
                }
                $FP = NULL;
                goto M8;
                Dk:
                $FP = "\x78\x73\72\x73\164\162\x69\x6e\x67";
                goto M8;
                I3:
                $FP = "\170\163\72\x69\x6e\164\145\147\145\x72";
                M8:
                $rg = $hS->createElementNS("\165\x72\x6e\x3a\x6f\141\x73\x69\x73\x3a\x6e\141\155\145\163\72\164\143\x3a\123\x41\x4d\x4c\x3a\x32\x2e\x30\x3a\x61\x73\163\145\x72\x74\151\x6f\156", "\163\x61\155\154\x3a\101\164\x74\162\151\142\165\x74\x65\x56\x61\154\x75\x65");
                $JB->appendChild($rg);
                if (!($FP !== NULL)) {
                    goto Vh;
                }
                $rg->setAttributeNS("\x68\164\x74\160\72\x2f\57\167\167\x77\56\x77\63\x2e\x6f\x72\x67\x2f\62\x30\x30\61\x2f\x58\x4d\114\123\x63\150\x65\x6d\141\55\x69\156\x73\164\141\156\143\x65", "\170\x73\151\72\x74\171\x70\145", $FP);
                Vh:
                if (!is_null($e1)) {
                    goto Mi;
                }
                $rg->setAttributeNS("\150\x74\x74\x70\x3a\x2f\x2f\167\x77\x77\x2e\x77\x33\x2e\x6f\162\x67\57\62\60\x30\x31\x2f\130\x4d\114\123\143\x68\x65\x6d\141\55\x69\x6e\x73\164\x61\156\143\145", "\x78\x73\151\x3a\156\151\x6c", "\164\162\165\x65");
                Mi:
                if ($e1 instanceof DOMNodeList) {
                    goto ze;
                }
                $rg->appendChild($hS->createTextNode($e1));
                goto aw;
                ze:
                $o1 = 0;
                H1:
                if (!($o1 < $e1->length)) {
                    goto LU;
                }
                $cV = $hS->importNode($e1->item($o1), TRUE);
                $rg->appendChild($cV);
                mt:
                $o1++;
                goto H1;
                LU:
                aw:
                ui:
            }
            L9:
            a_:
        }
        hk:
    }
    private function addEncryptedAttributeStatement(DOMElement $uc)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto gn;
        }
        return;
        gn:
        $hS = $uc->ownerDocument;
        $a6 = $hS->createElementNS("\x75\x72\156\x3a\x6f\x61\163\151\163\72\156\141\155\x65\163\72\164\x63\72\123\101\x4d\114\x3a\x32\56\60\x3a\141\163\x73\145\x72\x74\151\157\x6e", "\x73\x61\x6d\154\72\x41\x74\164\162\x69\142\x75\164\145\123\164\141\164\145\155\145\x6e\164");
        $uc->appendChild($a6);
        foreach ($this->attributes as $lX => $Vv) {
            $uu = new DOMDocument();
            $JB = $uu->createElementNS("\x75\x72\x6e\72\157\x61\163\151\x73\72\156\x61\x6d\x65\163\72\164\143\72\123\x41\115\114\72\x32\x2e\60\72\141\x73\x73\145\162\x74\x69\x6f\156", "\163\141\x6d\154\72\101\164\x74\162\151\x62\165\x74\145");
            $JB->setAttribute("\x4e\141\155\145", $lX);
            $uu->appendChild($JB);
            if (!($this->nameFormat !== "\x75\162\x6e\x3a\157\x61\x73\151\x73\72\156\141\155\x65\163\x3a\x74\x63\x3a\x53\x41\115\114\x3a\62\56\60\x3a\141\164\x74\x72\156\x61\x6d\x65\x2d\146\157\162\x6d\141\x74\72\x75\x6e\x73\160\145\143\x69\146\x69\x65\144")) {
                goto Lv;
            }
            $JB->setAttribute("\x4e\x61\155\145\106\x6f\x72\x6d\141\x74", $this->nameFormat);
            Lv:
            foreach ($Vv as $e1) {
                if (is_string($e1)) {
                    goto kF;
                }
                if (is_int($e1)) {
                    goto a5;
                }
                $FP = NULL;
                goto Ys;
                kF:
                $FP = "\170\x73\72\x73\164\x72\x69\156\147";
                goto Ys;
                a5:
                $FP = "\170\163\x3a\x69\156\164\x65\147\x65\x72";
                Ys:
                $rg = $uu->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\x69\x73\72\x6e\x61\155\145\163\72\164\143\72\x53\101\x4d\114\x3a\62\56\60\72\141\x73\x73\x65\x72\x74\151\x6f\156", "\163\141\x6d\154\x3a\101\x74\164\x72\x69\x62\x75\164\145\126\x61\x6c\x75\x65");
                $JB->appendChild($rg);
                if (!($FP !== NULL)) {
                    goto AB;
                }
                $rg->setAttributeNS("\150\164\x74\x70\72\x2f\x2f\167\x77\x77\56\x77\63\56\157\x72\147\57\x32\60\x30\61\57\x58\x4d\x4c\x53\x63\150\145\155\141\x2d\151\x6e\163\x74\x61\x6e\x63\145", "\170\x73\x69\x3a\164\171\160\x65", $FP);
                AB:
                if ($e1 instanceof DOMNodeList) {
                    goto aH;
                }
                $rg->appendChild($uu->createTextNode($e1));
                goto Oa;
                aH:
                $o1 = 0;
                e4:
                if (!($o1 < $e1->length)) {
                    goto sJ;
                }
                $cV = $uu->importNode($e1->item($o1), TRUE);
                $rg->appendChild($cV);
                V0:
                $o1++;
                goto e4;
                sJ:
                Oa:
                zZ:
            }
            rg:
            $qM = new XMLSecEnc();
            $qM->setNode($uu->documentElement);
            $qM->type = "\150\164\x74\x70\x3a\57\x2f\167\x77\167\x2e\167\x33\x2e\x6f\x72\x67\x2f\62\x30\x30\x31\57\x30\64\57\x78\155\x6c\145\x6e\143\43\105\x6c\145\x6d\x65\156\x74";
            $gg = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $gg->generateSessionKey();
            $qM->encryptKey($this->encryptionKey, $gg);
            $BR = $qM->encryptNode($gg);
            $EY = $hS->createElementNS("\165\x72\x6e\x3a\157\x61\163\151\x73\x3a\156\x61\x6d\145\x73\x3a\164\143\x3a\123\x41\115\114\72\x32\56\60\x3a\141\163\x73\x65\x72\164\151\157\x6e", "\163\x61\155\154\x3a\x45\x6e\143\162\x79\160\x74\145\x64\x41\164\164\162\x69\x62\x75\x74\145");
            $a6->appendChild($EY);
            $b8 = $hS->importNode($BR, TRUE);
            $EY->appendChild($b8);
            C_:
        }
        Pl:
    }
}
