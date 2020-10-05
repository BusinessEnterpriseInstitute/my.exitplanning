<?php


include_once "\125\164\x69\x6c\151\164\x69\145\x73\x2e\x70\150\160";
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
    public function __construct(DOMElement $DP = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\162\156\x3a\157\x61\163\x69\163\72\156\x61\x6d\x65\x73\x3a\164\x63\72\x53\101\x4d\x4c\x3a\x31\56\x31\x3a\x6e\x61\x6d\x65\151\144\55\146\157\x72\155\x61\x74\72\x75\156\x73\160\x65\143\x69\146\151\145\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($DP === NULL)) {
            goto QF;
        }
        return;
        QF:
        if (!($DP->localName === "\105\x6e\x63\162\x79\x70\164\145\144\x41\163\x73\x65\162\x74\151\157\x6e")) {
            goto WN;
        }
        $P1 = Utilities::xpQuery($DP, "\56\x2f\x78\x65\x6e\143\x3a\x45\156\x63\162\171\x70\164\x65\144\x44\141\164\x61");
        $lO = Utilities::xpQuery($DP, "\x2e\x2f\170\x65\x6e\143\72\x45\x6e\143\162\x79\160\164\145\x64\104\141\164\x61\57\144\x73\x3a\113\145\171\111\156\x66\x6f\x2f\x78\145\156\x63\72\105\x6e\143\x72\171\160\x74\x65\x64\113\x65\171");
        $Ee = '';
        if (empty($lO)) {
            goto ue;
        }
        $Ee = $lO[0]->firstChild->getAttribute("\101\154\147\157\162\151\x74\150\x6d");
        goto pI;
        ue:
        $lO = Utilities::xpQuery($DP, "\56\x2f\x78\x65\x6e\143\72\x45\156\x63\162\x79\160\164\x65\144\113\145\171\x2f\x78\145\156\x63\x3a\105\156\x63\162\171\x70\x74\x69\157\x6e\x4d\x65\164\x68\157\x64");
        $Ee = $lO[0]->getAttribute("\x41\x6c\x67\157\x72\151\x74\x68\155");
        pI:
        $YM = Utilities::getEncryptionAlgorithm($Ee);
        if (count($P1) === 0) {
            goto k1;
        }
        if (count($P1) > 1) {
            goto xo;
        }
        goto AU;
        k1:
        throw new Exception("\x4d\151\x73\163\151\x6e\147\x20\145\x6e\143\162\x79\160\x74\145\144\40\144\141\164\x61\x20\151\156\40\74\163\x61\155\x6c\72\x45\x6e\143\162\x79\x70\x74\145\x64\101\x73\x73\145\162\164\x69\x6f\156\x3e\56");
        goto AU;
        xo:
        throw new Exception("\x4d\157\x72\145\x20\164\x68\141\x6e\x20\157\x6e\145\x20\145\x6e\x63\x72\x79\x70\164\145\x64\x20\x64\141\164\141\x20\145\154\x65\155\145\156\164\x20\151\156\40\74\x73\141\155\154\x3a\x45\156\x63\162\x79\x70\164\145\144\x41\x73\163\x65\162\x74\x69\157\156\x3e\x2e");
        AU:
        $hM = '';
        $hM = variable_get("\155\x69\x6e\151\x6f\x72\x61\x6e\x67\145\x5f\x73\x61\155\x6c\137\x70\x72\151\x76\141\164\145\137\x63\x65\162\164\151\x66\151\143\141\164\145");
        $xt = new XMLSecurityKey($YM, array("\x74\x79\160\145" => "\x70\x72\151\166\x61\x74\x65"));
        $KQ = drupal_get_path("\x6d\x6f\144\x75\154\145", "\155\x69\x6e\151\x6f\x72\x61\x6e\147\145\x5f\x73\x61\155\x6c");
        if ($hM != '') {
            goto lo;
        }
        $Va = $KQ . "\x2f\162\145\x73\157\x75\x72\x63\145\x73\57\x73\x70\x2d\153\x65\171\56\153\145\x79";
        goto N1;
        lo:
        $Va = $KQ . "\x2f\162\145\163\157\x75\162\143\145\163\57\x43\x75\163\164\x6f\155\137\x50\x72\x69\x76\x61\164\145\x5f\103\x65\x72\164\x69\x66\x69\143\141\164\x65\x2e\x6b\x65\171";
        N1:
        $xt->loadKey($Va, TRUE);
        $bE = new XMLSecurityKey($YM, array("\164\171\x70\x65" => "\160\x72\x69\166\141\x74\145"));
        $O8 = $KQ . "\x2f\x72\x65\x73\x6f\165\162\x63\145\163\x2f\x6d\x69\x6e\151\x6f\x72\141\x6e\x67\x65\137\163\x70\137\160\162\x69\166\x5f\x6b\145\171\x2e\x6b\145\171";
        $bE->loadKey($O8, TRUE);
        $eG = array();
        $DP = Utilities::decryptElement($P1[0], $xt, $eG, $bE);
        WN:
        if ($DP->hasAttribute("\x49\104")) {
            goto Ps;
        }
        throw new Exception("\x4d\x69\163\163\151\156\x67\x20\x49\x44\x20\x61\164\x74\x72\x69\x62\165\164\x65\40\x6f\x6e\x20\123\101\x4d\x4c\40\x61\x73\163\x65\x72\164\151\157\156\56");
        Ps:
        $this->id = $DP->getAttribute("\111\104");
        if (!($DP->getAttribute("\126\145\x72\x73\x69\157\x6e") !== "\62\56\x30")) {
            goto QS;
        }
        throw new Exception("\125\x6e\163\x75\160\160\157\x72\164\x65\x64\40\x76\145\162\x73\151\157\156\72\x20" . $DP->getAttribute("\x56\145\162\x73\x69\157\156"));
        QS:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($DP->getAttribute("\111\163\163\x75\x65\x49\156\163\x74\141\x6e\x74"));
        $mP = Utilities::xpQuery($DP, "\x2e\57\163\x61\155\154\x5f\x61\x73\x73\145\x72\164\151\x6f\156\72\x49\x73\163\x75\x65\x72");
        if (!empty($mP)) {
            goto Ws;
        }
        throw new Exception("\115\x69\163\163\x69\156\x67\40\x3c\x73\x61\x6d\x6c\x3a\x49\x73\163\165\x65\162\x3e\40\151\x6e\40\x61\163\163\145\162\164\151\x6f\156\x2e");
        Ws:
        $this->issuer = trim($mP[0]->textContent);
        $this->parseConditions($DP);
        $this->parseAuthnStatement($DP);
        $this->parseAttributes($DP);
        $this->parseEncryptedAttributes($DP);
        $this->parseSignature($DP);
        $this->parseSubject($DP);
    }
    private function parseSubject(DOMElement $DP)
    {
        $UT = Utilities::xpQuery($DP, "\x2e\57\x73\141\x6d\154\x5f\x61\x73\x73\145\x72\x74\x69\x6f\156\72\x53\x75\142\x6a\x65\x63\x74");
        if (empty($UT)) {
            goto M8;
        }
        if (count($UT) > 1) {
            goto JV;
        }
        goto Jh;
        M8:
        return;
        goto Jh;
        JV:
        throw new Exception("\x4d\157\162\145\x20\x74\150\141\156\40\157\156\145\40\x3c\x73\x61\x6d\154\72\123\165\x62\x6a\x65\143\164\x3e\x20\151\x6e\x20\x3c\x73\x61\155\154\x3a\101\163\163\145\162\x74\x69\x6f\156\76\56");
        Jh:
        $UT = $UT[0];
        $F6 = Utilities::xpQuery($UT, "\x2e\x2f\163\x61\155\x6c\137\141\x73\163\x65\x72\164\151\x6f\x6e\x3a\116\141\x6d\x65\x49\104\x20\x7c\x20\56\57\x73\x61\155\x6c\137\x61\x73\163\145\162\164\x69\x6f\156\x3a\105\x6e\143\x72\x79\x70\164\145\x64\x49\104\57\170\x65\156\143\72\105\x6e\143\162\x79\160\164\145\144\x44\x61\x74\141");
        if (empty($F6)) {
            goto O_;
        }
        if (count($F6) > 1) {
            goto xJ;
        }
        goto U6;
        O_:
        throw new Exception("\115\x69\163\x73\151\156\x67\x20\x3c\163\x61\x6d\154\x3a\x4e\x61\155\x65\111\104\76\40\x6f\x72\40\x3c\163\x61\155\x6c\x3a\x45\156\143\162\x79\x70\164\145\144\x49\104\76\x20\151\156\40\x3c\163\141\x6d\154\x3a\123\165\142\152\145\x63\x74\x3e\x2e");
        goto U6;
        xJ:
        throw new Exception("\x4d\x6f\162\x65\40\x74\x68\x61\156\x20\x6f\x6e\x65\40\x3c\x73\141\x6d\154\72\x4e\x61\x6d\145\x49\x44\76\x20\x6f\x72\40\74\163\141\x6d\154\72\105\x6e\x63\x72\171\x70\164\145\x64\x44\x3e\40\151\156\x20\x3c\x73\141\x6d\x6c\72\x53\165\x62\152\x65\x63\x74\x3e\x2e");
        U6:
        $F6 = $F6[0];
        if ($F6->localName === "\x45\156\x63\x72\171\x70\164\x65\x64\104\141\164\x61") {
            goto zI;
        }
        $this->nameId = Utilities::parseNameId($F6);
        goto Du;
        zI:
        $this->encryptedNameId = $F6;
        Du:
    }
    private function parseConditions(DOMElement $DP)
    {
        $D1 = Utilities::xpQuery($DP, "\x2e\x2f\163\141\x6d\154\137\x61\163\x73\145\162\164\x69\157\156\x3a\x43\157\x6e\x64\151\164\151\x6f\156\163");
        if (empty($D1)) {
            goto z1;
        }
        if (count($D1) > 1) {
            goto qn;
        }
        goto je;
        z1:
        return;
        goto je;
        qn:
        throw new Exception("\115\157\162\145\40\164\x68\141\x6e\x20\x6f\156\x65\40\74\x73\x61\155\154\72\103\157\x6e\x64\x69\x74\151\157\156\163\x3e\40\x69\x6e\40\x3c\x73\x61\x6d\154\72\x41\x73\163\145\162\x74\151\x6f\x6e\x3e\56");
        je:
        $D1 = $D1[0];
        if (!$D1->hasAttribute("\x4e\x6f\x74\102\x65\x66\157\162\x65")) {
            goto D_;
        }
        $rY = Utilities::xsDateTimeToTimestamp($D1->getAttribute("\116\157\x74\102\x65\x66\x6f\x72\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $rY)) {
            goto Zc;
        }
        $this->notBefore = $rY;
        Zc:
        D_:
        if (!$D1->hasAttribute("\x4e\157\164\117\156\117\162\101\x66\164\x65\x72")) {
            goto dw;
        }
        $Z1 = Utilities::xsDateTimeToTimestamp($D1->getAttribute("\116\157\164\x4f\156\x4f\x72\101\x66\x74\x65\162"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $Z1)) {
            goto x_;
        }
        $this->notOnOrAfter = $Z1;
        x_:
        dw:
        $sr = $D1->firstChild;
        X_:
        if (!($sr !== NULL)) {
            goto PT;
        }
        if (!$sr instanceof DOMText) {
            goto HC;
        }
        goto bx;
        HC:
        if (!($sr->namespaceURI !== "\165\x72\156\x3a\x6f\x61\163\x69\x73\72\156\x61\x6d\x65\x73\x3a\x74\x63\x3a\x53\101\x4d\114\72\x32\x2e\60\x3a\141\x73\x73\145\162\164\x69\157\156")) {
            goto OM;
        }
        throw new Exception("\125\156\x6b\x6e\157\167\x6e\x20\x6e\x61\155\145\x73\x70\141\x63\x65\40\x6f\146\x20\x63\x6f\x6e\144\x69\x74\151\157\156\x3a\40" . var_export($sr->namespaceURI, TRUE));
        OM:
        switch ($sr->localName) {
            case "\101\165\144\x69\145\x6e\x63\145\x52\145\x73\164\162\x69\143\164\151\157\156":
                $he = Utilities::extractStrings($sr, "\165\162\x6e\72\157\x61\163\151\163\x3a\x6e\x61\155\145\163\x3a\x74\143\x3a\x53\101\115\114\72\x32\x2e\60\72\141\163\x73\145\162\x74\x69\157\156", "\101\165\144\x69\145\x6e\x63\145");
                if ($this->validAudiences === NULL) {
                    goto cy;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $he);
                goto aG;
                cy:
                $this->validAudiences = $he;
                aG:
                goto Nz;
            case "\x4f\x6e\x65\124\x69\x6d\145\125\x73\145":
                goto Nz;
            case "\120\162\x6f\x78\x79\122\145\x73\x74\162\x69\143\x74\x69\x6f\156":
                goto Nz;
            default:
                throw new Exception("\x55\x6e\153\x6e\x6f\x77\156\x20\x63\157\x6e\144\x69\164\151\157\156\x3a\40" . var_export($sr->localName, TRUE));
        }
        PW:
        Nz:
        bx:
        $sr = $sr->nextSibling;
        goto X_;
        PT:
    }
    private function parseAuthnStatement(DOMElement $DP)
    {
        $Y9 = Utilities::xpQuery($DP, "\x2e\x2f\x73\x61\x6d\154\137\x61\163\x73\145\162\164\x69\x6f\x6e\x3a\x41\x75\x74\x68\x6e\x53\x74\x61\164\x65\x6d\145\156\164");
        if (empty($Y9)) {
            goto Lk;
        }
        if (count($Y9) > 1) {
            goto UA;
        }
        goto y3;
        Lk:
        $this->authnInstant = NULL;
        return;
        goto y3;
        UA:
        throw new Exception("\x4d\x6f\x72\145\40\x74\150\x61\164\40\x6f\x6e\x65\40\74\163\141\x6d\154\72\x41\165\x74\150\x6e\123\x74\141\x74\x65\x6d\x65\x6e\164\76\40\151\x6e\x20\74\163\141\x6d\x6c\72\x41\163\x73\x65\x72\164\x69\x6f\156\x3e\40\x6e\x6f\164\40\x73\x75\160\160\157\162\x74\145\144\x2e");
        y3:
        $Yr = $Y9[0];
        if ($Yr->hasAttribute("\x41\x75\164\x68\x6e\x49\156\x73\x74\141\x6e\164")) {
            goto Ap;
        }
        throw new Exception("\115\151\163\163\151\x6e\x67\40\x72\145\x71\165\151\162\145\x64\40\101\165\164\x68\x6e\x49\156\x73\164\141\156\164\40\141\x74\x74\x72\x69\142\165\x74\145\40\x6f\156\40\x3c\x73\x61\155\154\x3a\101\x75\164\x68\156\123\x74\x61\x74\x65\x6d\145\x6e\164\x3e\x2e");
        Ap:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($Yr->getAttribute("\x41\165\164\150\x6e\x49\x6e\x73\164\x61\156\164"));
        if (!$Yr->hasAttribute("\123\145\163\163\151\157\x6e\116\157\x74\117\x6e\x4f\162\x41\146\164\x65\x72")) {
            goto rB;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($Yr->getAttribute("\123\145\x73\163\x69\157\x6e\x4e\157\x74\117\x6e\x4f\162\101\146\164\145\162"));
        rB:
        if (!$Yr->hasAttribute("\123\145\x73\x73\x69\x6f\156\x49\x6e\144\145\x78")) {
            goto cs;
        }
        $this->sessionIndex = $Yr->getAttribute("\123\145\163\x73\151\x6f\x6e\111\x6e\144\x65\x78");
        cs:
        $this->parseAuthnContext($Yr);
    }
    private function parseAuthnContext(DOMElement $Y4)
    {
        $Bq = Utilities::xpQuery($Y4, "\56\x2f\x73\141\155\x6c\x5f\x61\163\x73\x65\x72\164\x69\x6f\156\x3a\101\165\x74\x68\x6e\x43\157\156\164\145\170\x74");
        if (count($Bq) > 1) {
            goto yZ;
        }
        if (empty($Bq)) {
            goto W0;
        }
        goto gD;
        yZ:
        throw new Exception("\115\157\x72\x65\40\164\150\141\x6e\x20\157\x6e\x65\40\74\x73\141\155\x6c\x3a\x41\x75\164\x68\156\x43\157\x6e\x74\145\x78\164\x3e\40\151\156\x20\74\x73\x61\155\154\72\101\165\164\x68\x6e\123\x74\x61\x74\145\x6d\x65\156\164\76\x2e");
        goto gD;
        W0:
        throw new Exception("\x4d\151\163\x73\151\156\147\x20\162\x65\161\x75\x69\162\x65\x64\40\74\163\141\155\x6c\x3a\x41\x75\x74\150\156\103\x6f\x6e\x74\145\x78\164\x3e\x20\x69\156\x20\74\x73\141\155\154\x3a\x41\165\x74\150\156\123\x74\141\x74\145\x6d\x65\x6e\x74\76\x2e");
        gD:
        $qE = $Bq[0];
        $po = Utilities::xpQuery($qE, "\56\x2f\x73\x61\x6d\x6c\137\141\x73\163\x65\x72\164\151\x6f\156\72\101\165\x74\x68\x6e\103\157\x6e\164\x65\x78\164\104\x65\x63\154\x52\145\x66");
        if (count($po) > 1) {
            goto j8;
        }
        if (count($po) === 1) {
            goto Cw;
        }
        goto iI;
        j8:
        throw new Exception("\x4d\x6f\x72\x65\40\164\150\x61\x6e\x20\x6f\x6e\145\x20\74\x73\x61\155\x6c\72\101\165\164\x68\156\x43\157\x6e\164\x65\170\164\104\145\143\x6c\122\145\x66\x3e\40\146\157\x75\156\x64\x3f");
        goto iI;
        Cw:
        $this->setAuthnContextDeclRef(trim($po[0]->textContent));
        iI:
        $aR = Utilities::xpQuery($qE, "\x2e\x2f\x73\141\x6d\x6c\x5f\x61\163\x73\145\x72\x74\151\x6f\x6e\x3a\101\165\x74\x68\x6e\x43\157\x6e\x74\145\170\164\104\145\143\x6c");
        if (count($aR) > 1) {
            goto L6;
        }
        if (count($aR) === 1) {
            goto Fy;
        }
        goto hi;
        L6:
        throw new Exception("\x4d\157\162\x65\x20\x74\x68\141\x6e\x20\x6f\x6e\145\x20\74\163\141\155\x6c\72\x41\165\164\150\156\x43\157\156\164\145\170\x74\104\x65\143\154\76\x20\146\157\x75\x6e\x64\77");
        goto hi;
        Fy:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($aR[0]));
        hi:
        $bT = Utilities::xpQuery($qE, "\56\x2f\x73\141\155\154\x5f\x61\x73\163\145\x72\164\151\x6f\156\72\x41\x75\164\150\156\x43\157\x6e\x74\145\x78\x74\103\x6c\x61\163\163\x52\x65\x66");
        if (count($bT) > 1) {
            goto ig;
        }
        if (count($bT) === 1) {
            goto ZD;
        }
        goto Fu;
        ig:
        throw new Exception("\115\157\162\x65\x20\x74\150\x61\x6e\40\157\x6e\145\x20\x3c\x73\x61\x6d\x6c\72\x41\165\164\150\156\103\x6f\x6e\164\145\x78\x74\103\x6c\x61\163\163\x52\145\146\x3e\x20\x69\156\40\x3c\x73\141\155\154\72\x41\165\x74\150\x6e\x43\157\156\164\145\x78\164\76\x2e");
        goto Fu;
        ZD:
        $this->setAuthnContextClassRef(trim($bT[0]->textContent));
        Fu:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto R_;
        }
        throw new Exception("\115\151\x73\x73\151\x6e\147\40\x65\151\x74\150\x65\x72\x20\x3c\163\141\x6d\154\72\101\165\164\150\156\x43\157\156\x74\x65\170\x74\103\154\x61\x73\x73\122\145\x66\x3e\x20\157\162\x20\74\x73\x61\155\154\x3a\x41\165\x74\150\x6e\x43\157\x6e\x74\x65\170\x74\x44\145\x63\x6c\x52\x65\146\76\x20\x6f\x72\40\74\x73\141\155\154\72\101\x75\x74\x68\156\103\157\x6e\x74\x65\x78\x74\104\145\143\154\x3e");
        R_:
        $this->AuthenticatingAuthority = Utilities::extractStrings($qE, "\x75\162\156\72\x6f\141\163\x69\x73\72\x6e\x61\x6d\145\163\72\x74\143\x3a\x53\101\x4d\114\x3a\x32\56\60\x3a\141\163\163\x65\162\x74\x69\x6f\x6e", "\101\165\164\x68\145\x6e\164\151\x63\x61\x74\151\156\147\x41\x75\164\150\x6f\x72\151\164\171");
    }
    private function parseAttributes(DOMElement $DP)
    {
        $GR = TRUE;
        $Gd = Utilities::xpQuery($DP, "\56\x2f\163\x61\x6d\154\x5f\x61\x73\x73\145\x72\164\151\x6f\156\x3a\101\x74\164\x72\151\142\165\164\x65\x53\x74\141\x74\145\x6d\x65\x6e\164\x2f\163\141\x6d\x6c\x5f\x61\x73\163\x65\x72\x74\151\x6f\x6e\x3a\101\x74\164\x72\151\142\x75\164\145");
        foreach ($Gd as $lT) {
            if ($lT->hasAttribute("\116\x61\155\x65")) {
                goto dM;
            }
            throw new Exception("\115\151\163\x73\x69\x6e\147\x20\x6e\141\155\x65\x20\157\x6e\x20\74\x73\x61\x6d\x6c\x3a\101\164\164\162\151\142\x75\164\x65\x3e\40\x65\x6c\x65\x6d\145\156\164\x2e");
            dM:
            $ge = $lT->getAttribute("\116\x61\155\145");
            if ($lT->hasAttribute("\x4e\x61\x6d\x65\x46\x6f\162\x6d\x61\x74")) {
                goto vl;
            }
            $wI = "\x75\162\x6e\72\x6f\141\x73\x69\x73\72\156\x61\155\x65\x73\x3a\164\143\x3a\x53\x41\115\114\x3a\61\56\61\72\x6e\x61\155\x65\151\144\x2d\x66\157\x72\x6d\141\164\72\x75\x6e\163\160\x65\x63\x69\146\151\x65\144";
            goto Zz;
            vl:
            $wI = $lT->getAttribute("\x4e\x61\x6d\145\x46\x6f\x72\x6d\x61\x74");
            Zz:
            if ($GR) {
                goto c_;
            }
            if (!($this->nameFormat !== $wI)) {
                goto aA;
            }
            $this->nameFormat = "\x75\162\x6e\72\x6f\x61\x73\151\163\72\156\x61\155\145\x73\72\164\x63\72\x53\101\115\114\72\61\x2e\61\72\x6e\x61\155\145\x69\x64\55\146\157\x72\155\x61\x74\x3a\x75\156\163\x70\x65\143\151\x66\151\x65\144";
            aA:
            goto Dy;
            c_:
            $this->nameFormat = $wI;
            $GR = FALSE;
            Dy:
            if (array_key_exists($ge, $this->attributes)) {
                goto L2;
            }
            $this->attributes[$ge] = array();
            L2:
            $Da = Utilities::xpQuery($lT, "\56\x2f\x73\x61\x6d\154\x5f\141\x73\163\x65\x72\164\x69\157\156\72\x41\x74\x74\162\151\142\165\164\x65\x56\x61\x6c\x75\x65");
            foreach ($Da as $IN) {
                $this->attributes[$ge][] = trim($IN->textContent);
                zF:
            }
            pS:
            tf:
        }
        xm:
    }
    private function parseEncryptedAttributes(DOMElement $DP)
    {
        $this->encryptedAttribute = Utilities::xpQuery($DP, "\56\57\163\x61\155\x6c\x5f\x61\x73\163\x65\x72\164\x69\x6f\x6e\72\101\164\164\x72\x69\x62\165\164\x65\x53\x74\141\x74\x65\155\x65\x6e\164\57\163\x61\x6d\154\137\x61\163\163\145\162\164\x69\157\x6e\72\x45\x6e\143\162\x79\160\x74\x65\144\x41\164\x74\x72\x69\142\x75\164\x65");
    }
    private function parseSignature(DOMElement $DP)
    {
        $gx = Utilities::validateElement($DP);
        if (!($gx !== FALSE)) {
            goto h8;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $gx["\103\x65\x72\164\x69\146\151\143\x61\x74\145\x73"];
        $this->signatureData = $gx;
        h8:
    }
    public function validate(XMLSecurityKey $xt)
    {
        if (!($this->signatureData === NULL)) {
            goto wY;
        }
        return FALSE;
        wY:
        Utilities::validateSignature($this->signatureData, $xt);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($fO)
    {
        $this->id = $fO;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($fq)
    {
        $this->issueInstant = $fq;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($mP)
    {
        $this->issuer = $mP;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto qx;
        }
        throw new Exception("\x41\164\x74\145\155\x70\x74\145\144\x20\164\x6f\40\x72\x65\164\162\x69\x65\x76\x65\40\145\x6e\143\162\x79\160\x74\x65\x64\x20\x4e\141\x6d\145\x49\104\x20\x77\x69\x74\150\157\x75\164\x20\144\x65\x63\162\171\160\x74\151\x6e\147\x20\x69\164\x20\x66\151\x72\x73\x74\56");
        qx:
        return $this->nameId;
    }
    public function setNameId($F6)
    {
        $this->nameId = $F6;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto hn;
        }
        return TRUE;
        hn:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $xt)
    {
        $lu = new DOMDocument();
        $Eb = $lu->createElement("\x72\x6f\x6f\164");
        $lu->appendChild($Eb);
        Utilities::addNameId($Eb, $this->nameId);
        $F6 = $Eb->firstChild;
        Utilities::getContainer()->debugMessage($F6, "\x65\x6e\x63\162\x79\160\164");
        $Et = new XMLSecEnc();
        $Et->setNode($F6);
        $Et->type = XMLSecEnc::Element;
        $e1 = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $e1->generateSessionKey();
        $Et->encryptKey($xt, $e1);
        $this->encryptedNameId = $Et->encryptNode($e1);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $xt, array $eG = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto yh;
        }
        return;
        yh:
        $F6 = Utilities::decryptElement($this->encryptedNameId, $xt, $eG);
        Utilities::getContainer()->debugMessage($F6, "\x64\145\143\x72\x79\x70\x74");
        $this->nameId = Utilities::parseNameId($F6);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $xt, array $eG = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto kw;
        }
        return;
        kw:
        $GR = TRUE;
        $Gd = $this->encryptedAttribute;
        foreach ($Gd as $ZM) {
            $lT = Utilities::decryptElement($ZM->getElementsByTagName("\x45\x6e\143\x72\x79\160\x74\x65\144\104\x61\x74\x61")->item(0), $xt, $eG);
            if ($lT->hasAttribute("\116\141\x6d\x65")) {
                goto r_;
            }
            throw new Exception("\x4d\151\x73\x73\x69\156\x67\x20\156\141\155\x65\40\157\156\40\x3c\x73\x61\x6d\x6c\x3a\101\164\164\162\x69\x62\x75\x74\x65\76\40\145\x6c\x65\155\145\x6e\x74\x2e");
            r_:
            $ge = $lT->getAttribute("\x4e\141\x6d\145");
            if ($lT->hasAttribute("\116\141\155\145\106\x6f\x72\x6d\x61\164")) {
                goto BU;
            }
            $wI = "\165\x72\156\72\x6f\x61\x73\x69\x73\x3a\156\x61\x6d\145\163\x3a\164\143\72\123\101\115\x4c\x3a\x32\56\60\x3a\x61\164\164\162\x6e\x61\155\x65\x2d\x66\157\x72\x6d\141\x74\72\165\156\163\160\x65\x63\x69\x66\151\145\144";
            goto ck;
            BU:
            $wI = $lT->getAttribute("\116\141\x6d\145\x46\157\x72\x6d\141\164");
            ck:
            if ($GR) {
                goto r2;
            }
            if (!($this->nameFormat !== $wI)) {
                goto u3;
            }
            $this->nameFormat = "\165\x72\156\72\x6f\141\163\x69\x73\x3a\x6e\141\155\145\x73\72\164\143\x3a\123\x41\x4d\114\x3a\62\x2e\x30\x3a\141\x74\164\x72\156\141\155\145\55\146\157\162\x6d\141\164\x3a\x75\x6e\163\x70\x65\x63\151\146\x69\x65\x64";
            u3:
            goto gw;
            r2:
            $this->nameFormat = $wI;
            $GR = FALSE;
            gw:
            if (array_key_exists($ge, $this->attributes)) {
                goto Qe;
            }
            $this->attributes[$ge] = array();
            Qe:
            $Da = Utilities::xpQuery($lT, "\x2e\x2f\x73\141\x6d\x6c\x5f\x61\x73\x73\145\x72\x74\x69\x6f\156\72\101\x74\164\162\151\x62\165\164\x65\x56\x61\x6c\x75\145");
            foreach ($Da as $IN) {
                $this->attributes[$ge][] = trim($IN->textContent);
                Jp:
            }
            uV:
            so:
        }
        RZ:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($rY)
    {
        $this->notBefore = $rY;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($Z1)
    {
        $this->notOnOrAfter = $Z1;
    }
    public function setEncryptedAttributes($j5)
    {
        $this->requiredEncAttributes = $j5;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $NA = NULL)
    {
        $this->validAudiences = $NA;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($Ui)
    {
        $this->authnInstant = $Ui;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($BY)
    {
        $this->sessionNotOnOrAfter = $BY;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($Ti)
    {
        $this->sessionIndex = $Ti;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto FQ;
        }
        return $this->authnContextClassRef;
        FQ:
        if (empty($this->authnContextDeclRef)) {
            goto G0;
        }
        return $this->authnContextDeclRef;
        G0:
        return NULL;
    }
    public function setAuthnContext($Dw)
    {
        $this->setAuthnContextClassRef($Dw);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($Qu)
    {
        $this->authnContextClassRef = $Qu;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $F3)
    {
        if (empty($this->authnContextDeclRef)) {
            goto M5;
        }
        throw new Exception("\101\165\164\150\156\103\x6f\x6e\x74\145\170\x74\x44\145\143\154\122\x65\x66\x20\151\163\x20\141\x6c\162\145\x61\144\171\40\x72\x65\x67\x69\x73\x74\145\162\x65\x64\x21\x20\115\x61\x79\40\x6f\x6e\x6c\171\x20\150\x61\x76\145\40\x65\x69\164\150\x65\x72\40\x61\x20\104\x65\x63\x6c\x20\x6f\x72\40\141\40\104\x65\x63\154\122\x65\146\x2c\40\x6e\x6f\x74\40\142\157\164\150\41");
        M5:
        $this->authnContextDecl = $F3;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($yS)
    {
        if (empty($this->authnContextDecl)) {
            goto sX;
        }
        throw new Exception("\101\165\x74\x68\156\x43\157\156\164\145\x78\x74\104\145\143\x6c\x20\151\163\40\x61\x6c\x72\x65\141\144\x79\40\x72\x65\x67\151\x73\x74\x65\162\x65\144\41\40\115\x61\x79\40\157\x6e\x6c\171\40\150\141\166\145\x20\145\x69\164\x68\145\x72\40\x61\x20\104\x65\143\x6c\x20\157\x72\40\x61\40\x44\145\143\154\122\145\146\54\x20\156\x6f\x74\40\142\157\164\150\41");
        sX:
        $this->authnContextDeclRef = $yS;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($qj)
    {
        $this->AuthenticatingAuthority = $qj;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $Gd)
    {
        $this->attributes = $Gd;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($wI)
    {
        $this->nameFormat = $wI;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $lj)
    {
        $this->SubjectConfirmation = $lj;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function setSignatureKey(XMLsecurityKey $dO = NULL)
    {
        $this->signatureKey = $dO;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $tq = NULL)
    {
        $this->encryptionKey = $tq;
    }
    public function setCertificates(array $mA)
    {
        $this->certificates = $mA;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $YI = NULL)
    {
        if ($YI === NULL) {
            goto ke;
        }
        $Wt = $YI->ownerDocument;
        goto pg;
        ke:
        $Wt = new DOMDocument();
        $YI = $Wt;
        pg:
        $Eb = $Wt->createElementNS("\x75\x72\x6e\x3a\157\x61\163\151\x73\72\x6e\141\x6d\145\x73\72\164\x63\x3a\x53\101\x4d\x4c\72\62\x2e\60\72\x61\x73\x73\x65\162\164\x69\157\x6e", "\x73\141\155\x6c\72" . "\101\163\x73\145\162\x74\151\x6f\x6e");
        $YI->appendChild($Eb);
        $Eb->setAttributeNS("\x75\162\x6e\72\x6f\141\163\x69\x73\x3a\156\141\155\x65\x73\x3a\x74\x63\72\123\x41\x4d\114\72\62\x2e\x30\72\x70\162\x6f\x74\157\x63\x6f\154", "\163\141\x6d\154\160\x3a\x74\x6d\160", "\x74\x6d\160");
        $Eb->removeAttributeNS("\x75\162\156\72\157\x61\163\151\x73\x3a\156\x61\155\145\x73\x3a\164\x63\x3a\123\101\x4d\114\x3a\62\56\60\x3a\160\x72\x6f\164\157\x63\x6f\154", "\164\155\x70");
        $Eb->setAttributeNS("\150\x74\x74\x70\72\x2f\57\x77\167\x77\x2e\167\63\x2e\157\x72\147\x2f\62\60\60\61\57\130\x4d\114\x53\x63\150\x65\155\141\55\151\x6e\163\164\141\156\x63\x65", "\170\x73\151\72\x74\x6d\x70", "\x74\155\160");
        $Eb->removeAttributeNS("\x68\x74\x74\160\x3a\x2f\x2f\x77\167\x77\56\x77\63\56\157\x72\147\x2f\62\60\60\x31\x2f\130\115\x4c\123\x63\x68\145\155\141\x2d\x69\x6e\163\x74\x61\x6e\x63\145", "\164\x6d\160");
        $Eb->setAttributeNS("\x68\x74\164\160\x3a\57\57\x77\x77\x77\x2e\167\63\x2e\157\162\x67\57\62\60\x30\x31\x2f\x58\x4d\x4c\x53\x63\x68\145\x6d\x61", "\170\163\x3a\164\x6d\x70", "\164\155\x70");
        $Eb->removeAttributeNS("\150\164\164\x70\72\x2f\57\167\x77\167\x2e\167\x33\56\157\162\x67\57\62\60\x30\61\57\130\115\114\123\x63\150\x65\x6d\141", "\164\x6d\160");
        $Eb->setAttribute("\x49\104", $this->id);
        $Eb->setAttribute("\126\145\x72\163\151\x6f\x6e", "\62\56\60");
        $Eb->setAttribute("\x49\163\163\165\x65\x49\156\x73\x74\x61\x6e\x74", gmdate("\x59\x2d\x6d\55\144\x5c\124\110\72\151\72\163\x5c\x5a", $this->issueInstant));
        $mP = Utilities::addString($Eb, "\165\162\x6e\72\157\x61\x73\151\163\72\156\x61\155\145\163\72\x74\143\x3a\123\x41\x4d\114\72\x32\56\60\x3a\141\163\x73\145\162\x74\151\157\x6e", "\163\x61\x6d\x6c\72\111\x73\x73\x75\145\x72", $this->issuer);
        $this->addSubject($Eb);
        $this->addConditions($Eb);
        $this->addAuthnStatement($Eb);
        if ($this->requiredEncAttributes == FALSE) {
            goto MT;
        }
        $this->addEncryptedAttributeStatement($Eb);
        goto vv;
        MT:
        $this->addAttributeStatement($Eb);
        vv:
        if (!($this->signatureKey !== NULL)) {
            goto aU;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $Eb, $mP->nextSibling);
        aU:
        return $Eb;
    }
    private function addSubject(DOMElement $Eb)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto X1;
        }
        return;
        X1:
        $UT = $Eb->ownerDocument->createElementNS("\165\x72\156\72\x6f\x61\163\151\x73\x3a\156\x61\155\145\163\72\x74\x63\72\123\101\115\114\72\62\56\x30\x3a\141\x73\163\145\x72\x74\151\157\156", "\163\x61\155\154\x3a\x53\165\142\152\145\x63\164");
        $Eb->appendChild($UT);
        if ($this->encryptedNameId === NULL) {
            goto I0;
        }
        $c_ = $UT->ownerDocument->createElementNS("\x75\x72\156\72\157\x61\x73\x69\163\72\x6e\141\x6d\145\163\x3a\x74\143\72\123\x41\115\x4c\72\x32\56\x30\72\x61\163\x73\145\x72\164\151\x6f\156", "\x73\x61\155\x6c\x3a" . "\105\x6e\x63\162\171\160\164\x65\144\x49\104");
        $UT->appendChild($c_);
        $c_->appendChild($UT->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto nr;
        I0:
        Utilities::addNameId($UT, $this->nameId);
        nr:
        foreach ($this->SubjectConfirmation as $kP) {
            $kP->toXML($UT);
            J3:
        }
        a0:
    }
    private function addConditions(DOMElement $Eb)
    {
        $Wt = $Eb->ownerDocument;
        $D1 = $Wt->createElementNS("\x75\x72\156\72\x6f\x61\163\151\163\72\x6e\141\x6d\x65\163\x3a\164\x63\x3a\123\x41\115\x4c\x3a\62\x2e\60\72\141\x73\x73\145\162\x74\151\x6f\x6e", "\x73\141\155\154\x3a\103\157\x6e\144\151\164\x69\157\156\x73");
        $Eb->appendChild($D1);
        if (!($this->notBefore !== NULL)) {
            goto aI;
        }
        $D1->setAttribute("\x4e\157\164\102\x65\x66\x6f\162\x65", gmdate("\131\x2d\x6d\x2d\144\134\x54\x48\x3a\151\72\x73\134\132", $this->notBefore));
        aI:
        if (!($this->notOnOrAfter !== NULL)) {
            goto fJ;
        }
        $D1->setAttribute("\x4e\157\x74\x4f\x6e\117\x72\101\x66\x74\145\162", gmdate("\x59\55\155\x2d\144\x5c\124\110\72\x69\x3a\163\x5c\x5a", $this->notOnOrAfter));
        fJ:
        if (!($this->validAudiences !== NULL)) {
            goto iB;
        }
        $t5 = $Wt->createElementNS("\165\162\x6e\72\157\x61\163\151\x73\72\156\x61\x6d\145\163\x3a\164\143\x3a\x53\101\115\x4c\72\62\x2e\60\72\x61\163\x73\x65\162\164\151\157\156", "\x73\x61\155\x6c\x3a\101\x75\144\151\145\x6e\143\145\x52\145\163\164\162\151\143\164\151\157\x6e");
        $D1->appendChild($t5);
        Utilities::addStrings($t5, "\165\162\x6e\x3a\x6f\141\163\151\x73\x3a\x6e\141\x6d\x65\x73\72\x74\x63\x3a\123\101\115\x4c\x3a\x32\x2e\60\72\x61\163\x73\x65\x72\x74\151\x6f\x6e", "\x73\x61\155\154\72\101\x75\x64\151\x65\156\143\x65", FALSE, $this->validAudiences);
        iB:
    }
    private function addAuthnStatement(DOMElement $Eb)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto L5;
        }
        return;
        L5:
        $Wt = $Eb->ownerDocument;
        $Y4 = $Wt->createElementNS("\x75\x72\x6e\x3a\x6f\x61\163\151\163\x3a\156\x61\155\x65\163\72\164\x63\72\x53\x41\115\114\x3a\62\x2e\60\x3a\141\163\163\x65\162\x74\151\x6f\156", "\x73\141\155\154\72\x41\x75\x74\x68\156\123\164\141\164\x65\x6d\x65\156\x74");
        $Eb->appendChild($Y4);
        $Y4->setAttribute("\x41\165\164\x68\156\111\156\x73\x74\x61\156\164", gmdate("\x59\x2d\x6d\x2d\144\134\x54\x48\x3a\x69\72\x73\x5c\x5a", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto e3;
        }
        $Y4->setAttribute("\123\x65\163\163\x69\157\156\x4e\157\164\x4f\156\117\x72\101\x66\x74\145\x72", gmdate("\x59\x2d\155\55\x64\134\124\110\x3a\151\x3a\x73\134\x5a", $this->sessionNotOnOrAfter));
        e3:
        if (!($this->sessionIndex !== NULL)) {
            goto yt;
        }
        $Y4->setAttribute("\123\145\163\163\x69\x6f\156\111\x6e\x64\x65\x78", $this->sessionIndex);
        yt:
        $qE = $Wt->createElementNS("\x75\162\x6e\x3a\x6f\x61\x73\151\x73\72\x6e\x61\x6d\x65\x73\x3a\164\143\72\x53\x41\115\114\72\x32\56\x30\x3a\141\163\x73\145\x72\x74\151\x6f\156", "\163\141\155\154\72\x41\x75\164\150\x6e\x43\157\x6e\164\145\170\164");
        $Y4->appendChild($qE);
        if (empty($this->authnContextClassRef)) {
            goto C3;
        }
        Utilities::addString($qE, "\165\162\x6e\x3a\157\141\163\x69\x73\x3a\x6e\x61\155\145\163\x3a\x74\143\x3a\x53\x41\x4d\x4c\x3a\x32\x2e\60\x3a\x61\163\163\x65\x72\164\151\x6f\156", "\x73\141\x6d\x6c\72\101\165\x74\150\x6e\x43\157\156\164\145\x78\164\x43\154\x61\x73\x73\122\x65\146", $this->authnContextClassRef);
        C3:
        if (empty($this->authnContextDecl)) {
            goto Ui;
        }
        $this->authnContextDecl->toXML($qE);
        Ui:
        if (empty($this->authnContextDeclRef)) {
            goto hX;
        }
        Utilities::addString($qE, "\x75\162\156\72\x6f\x61\163\151\x73\72\x6e\x61\155\145\163\x3a\164\143\72\123\101\115\x4c\x3a\x32\x2e\60\x3a\x61\163\163\145\x72\x74\151\x6f\156", "\163\x61\155\154\72\101\165\164\x68\156\103\x6f\156\164\x65\170\164\x44\x65\143\154\x52\145\x66", $this->authnContextDeclRef);
        hX:
        Utilities::addStrings($qE, "\165\x72\x6e\x3a\157\x61\163\151\x73\72\156\141\x6d\x65\163\x3a\x74\143\x3a\123\101\x4d\x4c\72\x32\56\60\x3a\141\x73\x73\x65\x72\x74\x69\x6f\x6e", "\163\141\155\x6c\x3a\x41\165\164\x68\145\156\x74\x69\143\x61\164\x69\x6e\147\101\x75\164\150\x6f\x72\151\164\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $Eb)
    {
        if (!empty($this->attributes)) {
            goto I1;
        }
        return;
        I1:
        $Wt = $Eb->ownerDocument;
        $CJ = $Wt->createElementNS("\165\162\156\x3a\157\x61\163\x69\x73\72\x6e\x61\x6d\145\x73\x3a\164\143\x3a\123\x41\115\114\x3a\x32\56\x30\x3a\x61\x73\x73\145\x72\x74\x69\157\x6e", "\163\x61\x6d\x6c\72\x41\164\x74\x72\151\x62\x75\x74\x65\x53\x74\x61\x74\145\x6d\145\x6e\x74");
        $Eb->appendChild($CJ);
        foreach ($this->attributes as $ge => $Da) {
            $lT = $Wt->createElementNS("\x75\x72\x6e\72\x6f\x61\163\151\x73\72\156\x61\155\x65\163\x3a\164\x63\x3a\x53\x41\115\114\72\62\56\60\72\141\163\163\145\162\x74\151\157\156", "\x73\141\155\x6c\x3a\x41\x74\x74\162\x69\x62\165\x74\145");
            $CJ->appendChild($lT);
            $lT->setAttribute("\116\x61\155\145", $ge);
            if (!($this->nameFormat !== "\165\x72\156\72\157\141\163\x69\x73\x3a\156\x61\155\145\x73\x3a\164\x63\x3a\123\x41\115\114\72\x32\x2e\60\x3a\x61\164\164\x72\x6e\141\155\145\55\x66\x6f\162\155\141\164\72\165\156\x73\160\145\x63\151\146\151\x65\144")) {
                goto pV;
            }
            $lT->setAttribute("\116\x61\x6d\145\x46\157\162\x6d\141\164", $this->nameFormat);
            pV:
            foreach ($Da as $IN) {
                if (is_string($IN)) {
                    goto IT;
                }
                if (is_int($IN)) {
                    goto Wj;
                }
                $wP = NULL;
                goto kV;
                IT:
                $wP = "\x78\x73\x3a\163\x74\x72\x69\156\x67";
                goto kV;
                Wj:
                $wP = "\170\163\72\151\156\164\x65\x67\145\162";
                kV:
                $Ul = $Wt->createElementNS("\x75\162\x6e\72\157\141\x73\151\163\x3a\156\141\155\145\x73\x3a\x74\143\72\123\101\115\x4c\72\62\56\60\x3a\x61\163\x73\x65\162\x74\x69\x6f\x6e", "\x73\x61\155\x6c\x3a\101\164\x74\162\x69\142\x75\x74\145\x56\141\x6c\x75\145");
                $lT->appendChild($Ul);
                if (!($wP !== NULL)) {
                    goto Rw;
                }
                $Ul->setAttributeNS("\150\x74\x74\x70\x3a\x2f\57\x77\167\167\x2e\167\63\56\x6f\162\147\57\x32\x30\60\x31\57\130\115\114\123\143\150\x65\155\x61\x2d\151\156\163\x74\x61\x6e\143\145", "\170\163\151\72\164\171\x70\145", $wP);
                Rw:
                if (!is_null($IN)) {
                    goto Ds;
                }
                $Ul->setAttributeNS("\150\x74\x74\x70\72\57\57\x77\167\x77\x2e\167\x33\x2e\157\x72\x67\57\62\x30\60\x31\x2f\x58\x4d\x4c\123\x63\x68\145\x6d\x61\55\x69\156\x73\x74\x61\x6e\x63\x65", "\x78\163\151\72\x6e\151\x6c", "\164\162\x75\145");
                Ds:
                if ($IN instanceof DOMNodeList) {
                    goto af;
                }
                $Ul->appendChild($Wt->createTextNode($IN));
                goto GD;
                af:
                $m3 = 0;
                J6:
                if (!($m3 < $IN->length)) {
                    goto JZ;
                }
                $sr = $Wt->importNode($IN->item($m3), TRUE);
                $Ul->appendChild($sr);
                Ul:
                $m3++;
                goto J6;
                JZ:
                GD:
                fw:
            }
            Ad:
            Ri:
        }
        DK:
    }
    private function addEncryptedAttributeStatement(DOMElement $Eb)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto K8;
        }
        return;
        K8:
        $Wt = $Eb->ownerDocument;
        $CJ = $Wt->createElementNS("\x75\x72\156\x3a\x6f\x61\163\151\x73\x3a\156\141\x6d\x65\x73\x3a\164\143\x3a\123\101\x4d\x4c\72\x32\56\x30\72\141\163\163\x65\x72\x74\x69\157\156", "\163\x61\155\x6c\72\x41\x74\x74\x72\x69\x62\x75\164\x65\x53\x74\141\164\x65\155\145\x6e\164");
        $Eb->appendChild($CJ);
        foreach ($this->attributes as $ge => $Da) {
            $Q5 = new DOMDocument();
            $lT = $Q5->createElementNS("\x75\x72\x6e\x3a\157\141\x73\151\163\x3a\156\x61\x6d\145\x73\x3a\164\143\x3a\x53\101\x4d\x4c\x3a\62\x2e\60\x3a\x61\163\x73\x65\x72\164\151\x6f\156", "\163\x61\x6d\x6c\72\101\x74\164\x72\x69\x62\165\x74\145");
            $lT->setAttribute("\116\141\155\x65", $ge);
            $Q5->appendChild($lT);
            if (!($this->nameFormat !== "\x75\x72\156\x3a\157\x61\x73\151\163\x3a\x6e\141\155\x65\x73\x3a\164\143\x3a\123\101\x4d\x4c\72\x32\x2e\60\x3a\x61\164\164\162\156\141\155\145\55\x66\x6f\x72\155\x61\164\x3a\x75\x6e\x73\x70\145\x63\x69\x66\x69\x65\144")) {
                goto ZK;
            }
            $lT->setAttribute("\116\x61\x6d\145\x46\157\162\x6d\141\164", $this->nameFormat);
            ZK:
            foreach ($Da as $IN) {
                if (is_string($IN)) {
                    goto Wd;
                }
                if (is_int($IN)) {
                    goto P4;
                }
                $wP = NULL;
                goto co;
                Wd:
                $wP = "\x78\163\72\x73\x74\162\x69\156\x67";
                goto co;
                P4:
                $wP = "\x78\163\x3a\151\x6e\164\x65\x67\145\162";
                co:
                $Ul = $Q5->createElementNS("\x75\x72\156\x3a\x6f\x61\x73\151\163\72\x6e\x61\155\x65\163\72\164\143\x3a\x53\101\115\x4c\72\62\x2e\x30\72\141\163\163\145\x72\164\x69\157\x6e", "\x73\141\x6d\x6c\72\101\x74\x74\x72\x69\x62\165\164\x65\x56\141\154\x75\145");
                $lT->appendChild($Ul);
                if (!($wP !== NULL)) {
                    goto lW;
                }
                $Ul->setAttributeNS("\x68\x74\164\x70\72\57\57\167\x77\167\x2e\x77\x33\x2e\x6f\162\x67\57\62\60\x30\61\x2f\x58\115\x4c\x53\x63\150\x65\x6d\141\x2d\151\156\163\x74\x61\156\x63\145", "\170\163\x69\x3a\x74\x79\160\145", $wP);
                lW:
                if ($IN instanceof DOMNodeList) {
                    goto aY;
                }
                $Ul->appendChild($Q5->createTextNode($IN));
                goto FJ;
                aY:
                $m3 = 0;
                lh:
                if (!($m3 < $IN->length)) {
                    goto dP;
                }
                $sr = $Q5->importNode($IN->item($m3), TRUE);
                $Ul->appendChild($sr);
                iH:
                $m3++;
                goto lh;
                dP:
                FJ:
                BD:
            }
            f4:
            $Zk = new XMLSecEnc();
            $Zk->setNode($Q5->documentElement);
            $Zk->type = "\x68\x74\164\160\72\x2f\57\x77\x77\167\x2e\167\63\56\157\162\x67\x2f\x32\x30\x30\61\57\60\x34\57\170\155\154\145\156\143\x23\105\x6c\145\x6d\145\x6e\x74";
            $e1 = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $e1->generateSessionKey();
            $Zk->encryptKey($this->encryptionKey, $e1);
            $Jt = $Zk->encryptNode($e1);
            $ur = $Wt->createElementNS("\x75\162\x6e\x3a\157\x61\163\x69\163\72\156\x61\x6d\x65\x73\72\x74\x63\72\123\x41\115\114\x3a\x32\x2e\x30\72\141\163\x73\145\162\x74\x69\x6f\156", "\x73\x61\155\x6c\x3a\105\x6e\x63\162\171\160\164\x65\x64\x41\x74\164\x72\151\142\x75\164\x65");
            $CJ->appendChild($ur);
            $s2 = $Wt->importNode($Jt, TRUE);
            $ur->appendChild($s2);
            Zh:
        }
        G3:
    }
}
