<?php


include_once "\125\164\x69\154\x69\x74\151\145\163\x2e\x70\x68\160";
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
    public function __construct(DOMElement $RH = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\x72\156\72\x6f\x61\x73\x69\163\x3a\x6e\141\x6d\145\163\72\x74\x63\72\123\x41\x4d\114\x3a\x31\x2e\x31\72\x6e\x61\155\x65\x69\144\x2d\x66\157\162\x6d\141\164\x3a\165\156\163\x70\145\143\x69\x66\151\145\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($RH === NULL)) {
            goto yw;
        }
        return;
        yw:
        if (!($RH->localName === "\105\x6e\143\162\171\x70\x74\145\x64\101\x73\x73\145\162\164\151\157\156")) {
            goto x4;
        }
        $Ta = Utilities::xpQuery($RH, "\56\x2f\x78\145\x6e\x63\x3a\105\x6e\143\162\x79\x70\164\145\x64\x44\141\x74\x61");
        $Ou = Utilities::xpQuery($RH, "\56\x2f\x78\x65\156\143\x3a\x45\x6e\x63\162\x79\160\x74\x65\x64\x44\141\164\141\x2f\x64\x73\72\x4b\x65\171\111\x6e\146\157\57\x78\145\x6e\143\x3a\105\156\143\162\171\x70\x74\145\144\113\145\171");
        $yW = '';
        if (empty($Ou)) {
            goto QS;
        }
        $yW = $Ou[0]->firstChild->getAttribute("\x41\x6c\x67\157\162\151\x74\150\155");
        goto qx;
        QS:
        $Ou = Utilities::xpQuery($RH, "\56\57\x78\145\x6e\x63\x3a\105\156\x63\x72\171\160\x74\x65\144\x4b\145\171\x2f\170\x65\156\x63\x3a\x45\156\143\162\171\x70\x74\x69\x6f\156\x4d\x65\x74\150\x6f\x64");
        $yW = $Ou[0]->getAttribute("\x41\154\x67\157\162\151\164\x68\x6d");
        qx:
        $SE = Utilities::getEncryptionAlgorithm($yW);
        if (count($Ta) === 0) {
            goto eR;
        }
        if (count($Ta) > 1) {
            goto Hu;
        }
        goto M1;
        eR:
        throw new Exception("\115\151\x73\x73\151\156\147\40\145\156\x63\x72\x79\160\x74\145\x64\40\144\x61\164\141\40\x69\x6e\40\x3c\x73\141\155\x6c\x3a\105\156\143\162\x79\160\x74\x65\144\101\x73\163\145\162\x74\x69\x6f\156\76\x2e");
        goto M1;
        Hu:
        throw new Exception("\115\x6f\x72\x65\40\164\150\141\156\x20\157\x6e\145\x20\x65\156\x63\x72\171\160\164\145\144\40\144\x61\x74\141\x20\145\x6c\145\155\x65\156\x74\x20\x69\156\40\x3c\x73\141\x6d\x6c\72\x45\156\143\x72\x79\160\x74\145\144\x41\x73\x73\145\162\164\151\x6f\156\x3e\x2e");
        M1:
        $z6 = new XMLSecurityKey($SE, array("\x74\171\x70\145" => "\x70\x72\x69\x76\x61\x74\145"));
        $nk = plugin_dir_path(__FILE__) . "\x72\x65\163\x6f\x75\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\x73\160\x2d\x6b\x65\x79\x2e\x6b\145\171";
        $z6->loadKey($nk, TRUE);
        $ue = new XMLSecurityKey($SE, array("\x74\x79\x70\x65" => "\x70\162\x69\x76\x61\164\x65"));
        $sw = plugin_dir_path(__FILE__) . "\x72\x65\x73\157\x75\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\x6d\x69\x6e\x69\x6f\x72\141\156\x67\145\137\163\x70\137\x70\162\x69\166\137\x6b\x65\171\56\153\x65\x79";
        $ue->loadKey($sw, TRUE);
        $WO = array();
        $RH = Utilities::decryptElement($Ta[0], $z6, $WO, $ue);
        x4:
        if ($RH->hasAttribute("\x49\104")) {
            goto qs;
        }
        throw new Exception("\115\151\x73\163\x69\156\147\x20\111\104\x20\x61\x74\164\162\151\x62\x75\x74\145\x20\x6f\x6e\x20\x53\x41\115\114\x20\x61\x73\163\x65\x72\164\151\x6f\156\56");
        qs:
        $this->id = $RH->getAttribute("\111\x44");
        if (!($RH->getAttribute("\126\x65\162\x73\151\157\x6e") !== "\x32\x2e\60")) {
            goto rf;
        }
        throw new Exception("\x55\x6e\163\165\160\160\x6f\x72\x74\145\144\x20\166\145\x72\163\x69\157\156\x3a\x20" . $RH->getAttribute("\x56\x65\162\x73\x69\x6f\x6e"));
        rf:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($RH->getAttribute("\x49\x73\163\x75\x65\x49\156\x73\164\x61\x6e\164"));
        $L1 = Utilities::xpQuery($RH, "\56\x2f\x73\141\x6d\x6c\x5f\x61\x73\x73\145\162\x74\x69\157\156\72\111\163\x73\165\145\162");
        if (!empty($L1)) {
            goto lu;
        }
        throw new Exception("\115\151\x73\x73\x69\x6e\147\x20\x3c\163\x61\x6d\x6c\x3a\x49\x73\x73\x75\145\162\76\40\x69\156\x20\141\163\163\145\162\x74\x69\x6f\156\56");
        lu:
        $this->issuer = trim($L1[0]->textContent);
        $this->parseConditions($RH);
        $this->parseAuthnStatement($RH);
        $this->parseAttributes($RH);
        $this->parseEncryptedAttributes($RH);
        $this->parseSignature($RH);
        $this->parseSubject($RH);
    }
    private function parseSubject(DOMElement $RH)
    {
        $tZ = Utilities::xpQuery($RH, "\x2e\x2f\x73\x61\x6d\154\x5f\141\163\163\x65\x72\164\151\x6f\156\72\123\x75\x62\152\145\x63\164");
        if (empty($tZ)) {
            goto o0;
        }
        if (count($tZ) > 1) {
            goto ou;
        }
        goto K_;
        o0:
        return;
        goto K_;
        ou:
        throw new Exception("\115\157\x72\x65\40\x74\x68\x61\x6e\x20\x6f\x6e\145\x20\x3c\x73\x61\x6d\x6c\72\123\165\x62\x6a\145\143\164\x3e\x20\x69\x6e\x20\74\x73\141\155\x6c\72\101\x73\163\145\x72\164\151\157\x6e\76\x2e");
        K_:
        $tZ = $tZ[0];
        $yM = Utilities::xpQuery($tZ, "\x2e\x2f\x73\141\x6d\x6c\137\x61\x73\x73\x65\162\164\x69\x6f\156\72\x4e\x61\155\145\x49\x44\40\174\x20\x2e\x2f\163\x61\155\x6c\x5f\x61\163\163\145\162\164\151\157\x6e\x3a\105\x6e\x63\x72\171\160\x74\x65\x64\x49\x44\x2f\x78\145\156\x63\72\105\x6e\x63\x72\171\160\x74\x65\144\104\141\x74\141");
        if (empty($yM)) {
            goto hb;
        }
        if (count($yM) > 1) {
            goto dX;
        }
        goto T8;
        hb:
        throw new Exception("\115\x69\163\163\x69\156\147\40\74\163\x61\x6d\154\72\x4e\x61\155\x65\111\x44\76\x20\157\x72\40\x3c\163\141\x6d\x6c\72\105\x6e\143\162\x79\160\164\145\144\x49\x44\x3e\40\151\156\40\x3c\x73\141\x6d\154\72\x53\x75\x62\x6a\x65\143\164\76\56");
        goto T8;
        dX:
        throw new Exception("\115\x6f\x72\145\x20\x74\x68\141\156\40\x6f\156\x65\x20\x3c\163\x61\x6d\x6c\72\116\141\155\x65\x49\104\x3e\40\x6f\x72\x20\74\163\141\x6d\154\72\x45\156\x63\x72\171\160\164\x65\x64\x44\76\40\151\x6e\40\74\x73\x61\x6d\154\x3a\x53\165\x62\152\x65\x63\x74\x3e\56");
        T8:
        $yM = $yM[0];
        if ($yM->localName === "\x45\156\143\162\171\x70\x74\145\x64\104\x61\x74\141") {
            goto oy;
        }
        $this->nameId = Utilities::parseNameId($yM);
        goto S7;
        oy:
        $this->encryptedNameId = $yM;
        S7:
    }
    private function parseConditions(DOMElement $RH)
    {
        $ch = Utilities::xpQuery($RH, "\56\57\163\x61\x6d\154\x5f\141\163\x73\x65\x72\x74\x69\x6f\x6e\72\103\157\x6e\x64\151\164\151\157\156\x73");
        if (empty($ch)) {
            goto xk;
        }
        if (count($ch) > 1) {
            goto yz;
        }
        goto JM;
        xk:
        return;
        goto JM;
        yz:
        throw new Exception("\x4d\x6f\x72\145\x20\x74\x68\141\x6e\40\157\x6e\x65\40\74\x73\x61\155\x6c\x3a\103\157\156\x64\x69\164\151\x6f\x6e\163\76\40\x69\156\40\x3c\163\x61\x6d\154\72\101\x73\163\x65\x72\x74\151\157\x6e\76\x2e");
        JM:
        $ch = $ch[0];
        if (!$ch->hasAttribute("\116\x6f\x74\x42\145\x66\157\162\x65")) {
            goto aD;
        }
        $Gl = Utilities::xsDateTimeToTimestamp($ch->getAttribute("\116\157\164\x42\145\146\x6f\x72\145"));
        if (!($this->notBefore === NULL || $this->notBefore < $Gl)) {
            goto Yl;
        }
        $this->notBefore = $Gl;
        Yl:
        aD:
        if (!$ch->hasAttribute("\x4e\x6f\164\x4f\x6e\x4f\x72\x41\146\164\x65\162")) {
            goto F9;
        }
        $zH = Utilities::xsDateTimeToTimestamp($ch->getAttribute("\116\157\x74\117\156\x4f\162\x41\146\164\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $zH)) {
            goto fq;
        }
        $this->notOnOrAfter = $zH;
        fq:
        F9:
        $Bu = $ch->firstChild;
        QL:
        if (!($Bu !== NULL)) {
            goto ym;
        }
        if (!$Bu instanceof DOMText) {
            goto kn;
        }
        goto cs;
        kn:
        if (!($Bu->namespaceURI !== "\165\162\156\x3a\x6f\141\163\151\x73\72\x6e\x61\x6d\145\x73\72\x74\143\x3a\x53\x41\x4d\114\x3a\x32\x2e\x30\x3a\x61\163\x73\x65\162\x74\x69\x6f\x6e")) {
            goto Ef;
        }
        throw new Exception("\125\156\153\x6e\157\167\156\40\156\141\155\x65\x73\x70\x61\143\145\x20\157\146\40\x63\157\156\x64\x69\164\151\x6f\x6e\72\40" . var_export($Bu->namespaceURI, TRUE));
        Ef:
        switch ($Bu->localName) {
            case "\x41\165\144\151\145\156\x63\x65\x52\x65\x73\x74\162\x69\x63\164\151\157\x6e":
                $ey = Utilities::extractStrings($Bu, "\x75\x72\x6e\72\157\141\x73\151\x73\x3a\x6e\x61\155\145\x73\x3a\x74\x63\x3a\123\x41\115\114\x3a\62\56\x30\x3a\x61\x73\x73\145\162\x74\x69\157\156", "\x41\x75\x64\x69\145\x6e\143\145");
                if ($this->validAudiences === NULL) {
                    goto JY;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $ey);
                goto ha;
                JY:
                $this->validAudiences = $ey;
                ha:
                goto jq;
            case "\117\156\x65\x54\151\155\x65\125\163\x65":
                goto jq;
            case "\120\162\x6f\170\171\122\145\163\x74\162\151\143\x74\x69\157\x6e":
                goto jq;
            default:
                throw new Exception("\x55\156\x6b\x6e\157\167\x6e\40\x63\x6f\x6e\144\x69\x74\151\157\x6e\72\40" . var_export($Bu->localName, TRUE));
        }
        nh:
        jq:
        cs:
        $Bu = $Bu->nextSibling;
        goto QL;
        ym:
    }
    private function parseAuthnStatement(DOMElement $RH)
    {
        $Ns = Utilities::xpQuery($RH, "\56\57\x73\141\x6d\154\x5f\141\x73\163\145\x72\164\x69\157\x6e\x3a\x41\165\x74\150\x6e\123\x74\141\164\x65\x6d\x65\156\x74");
        if (empty($Ns)) {
            goto my;
        }
        if (count($Ns) > 1) {
            goto mo;
        }
        goto E3;
        my:
        $this->authnInstant = NULL;
        return;
        goto E3;
        mo:
        throw new Exception("\x4d\157\x72\145\x20\164\x68\141\x74\40\x6f\x6e\145\x20\x3c\163\141\155\x6c\72\101\x75\x74\x68\x6e\x53\164\x61\x74\145\155\x65\x6e\164\x3e\x20\151\156\x20\x3c\163\x61\155\x6c\72\x41\x73\163\x65\x72\x74\x69\157\156\76\x20\x6e\x6f\164\x20\163\165\x70\x70\157\162\164\x65\144\56");
        E3:
        $eu = $Ns[0];
        if ($eu->hasAttribute("\x41\x75\x74\x68\156\x49\156\163\164\141\156\164")) {
            goto aL;
        }
        throw new Exception("\115\x69\163\x73\151\x6e\x67\x20\x72\x65\161\x75\151\162\x65\x64\40\x41\165\x74\150\x6e\x49\x6e\x73\x74\x61\x6e\x74\40\141\x74\x74\x72\x69\x62\x75\x74\x65\x20\x6f\156\x20\x3c\x73\x61\155\154\72\101\165\164\x68\156\123\164\x61\164\145\x6d\145\156\x74\76\56");
        aL:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($eu->getAttribute("\x41\165\x74\x68\156\111\x6e\163\x74\x61\156\x74"));
        if (!$eu->hasAttribute("\x53\145\x73\x73\x69\x6f\156\x4e\x6f\x74\x4f\156\x4f\x72\x41\x66\x74\145\x72")) {
            goto CX;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($eu->getAttribute("\x53\x65\x73\x73\x69\157\x6e\116\157\x74\x4f\x6e\117\162\101\x66\x74\x65\x72"));
        CX:
        if (!$eu->hasAttribute("\123\x65\x73\x73\151\157\x6e\x49\156\x64\x65\x78")) {
            goto qu;
        }
        $this->sessionIndex = $eu->getAttribute("\123\145\163\x73\x69\157\x6e\111\156\144\145\x78");
        qu:
        $this->parseAuthnContext($eu);
    }
    private function parseAuthnContext(DOMElement $uL)
    {
        $Xn = Utilities::xpQuery($uL, "\56\57\163\x61\x6d\x6c\x5f\141\163\x73\x65\x72\164\x69\157\156\x3a\101\165\164\x68\156\x43\157\x6e\x74\145\170\164");
        if (count($Xn) > 1) {
            goto kU;
        }
        if (empty($Xn)) {
            goto xQ;
        }
        goto Vy;
        kU:
        throw new Exception("\x4d\x6f\162\145\x20\x74\x68\x61\x6e\x20\157\x6e\145\x20\74\x73\x61\x6d\x6c\72\101\165\164\x68\156\x43\157\x6e\164\x65\x78\x74\x3e\x20\x69\156\x20\74\x73\x61\155\154\72\x41\x75\164\x68\156\x53\x74\x61\x74\145\x6d\x65\156\164\x3e\x2e");
        goto Vy;
        xQ:
        throw new Exception("\x4d\x69\x73\163\151\x6e\147\40\162\145\161\165\x69\162\145\x64\40\x3c\x73\141\155\x6c\72\x41\165\164\150\x6e\x43\157\x6e\164\145\x78\164\76\x20\x69\156\40\74\163\141\x6d\154\x3a\101\165\x74\x68\x6e\123\x74\x61\164\145\155\x65\x6e\x74\76\x2e");
        Vy:
        $w8 = $Xn[0];
        $Na = Utilities::xpQuery($w8, "\x2e\x2f\x73\141\155\x6c\x5f\x61\x73\x73\145\162\x74\151\x6f\x6e\x3a\x41\165\x74\x68\x6e\x43\x6f\156\164\145\170\164\104\145\143\x6c\122\x65\x66");
        if (count($Na) > 1) {
            goto RB;
        }
        if (count($Na) === 1) {
            goto xE;
        }
        goto lE;
        RB:
        throw new Exception("\115\157\162\145\x20\x74\x68\x61\156\x20\x6f\156\145\x20\74\163\141\155\x6c\72\x41\x75\164\150\156\103\x6f\156\164\145\x78\x74\x44\x65\x63\x6c\x52\x65\146\76\40\146\x6f\165\x6e\144\77");
        goto lE;
        xE:
        $this->setAuthnContextDeclRef(trim($Na[0]->textContent));
        lE:
        $kG = Utilities::xpQuery($w8, "\x2e\x2f\x73\141\155\x6c\137\141\x73\163\145\x72\x74\x69\x6f\156\72\101\165\x74\150\156\x43\157\x6e\164\145\170\164\104\145\x63\154");
        if (count($kG) > 1) {
            goto Nr;
        }
        if (count($kG) === 1) {
            goto nH;
        }
        goto U8;
        Nr:
        throw new Exception("\x4d\x6f\x72\x65\x20\164\x68\141\x6e\40\157\156\x65\x20\x3c\x73\x61\155\154\x3a\x41\x75\164\x68\156\103\x6f\x6e\x74\145\x78\164\x44\145\143\x6c\x3e\40\146\157\165\x6e\x64\77");
        goto U8;
        nH:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($kG[0]));
        U8:
        $zE = Utilities::xpQuery($w8, "\x2e\57\163\x61\x6d\154\x5f\x61\163\x73\x65\x72\164\x69\157\x6e\x3a\x41\165\x74\150\156\x43\157\x6e\x74\145\170\164\x43\154\x61\x73\x73\x52\145\146");
        if (count($zE) > 1) {
            goto g_;
        }
        if (count($zE) === 1) {
            goto Yf;
        }
        goto jT;
        g_:
        throw new Exception("\x4d\157\162\145\40\164\x68\x61\x6e\40\x6f\156\x65\40\74\x73\x61\155\154\72\x41\x75\164\x68\x6e\103\157\156\164\145\x78\164\103\154\x61\163\x73\x52\145\x66\76\x20\x69\156\40\x3c\x73\141\155\x6c\72\x41\165\x74\150\x6e\x43\x6f\156\x74\145\x78\x74\x3e\56");
        goto jT;
        Yf:
        $this->setAuthnContextClassRef(trim($zE[0]->textContent));
        jT:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto ZE;
        }
        throw new Exception("\115\151\163\x73\x69\x6e\147\x20\145\x69\164\150\x65\162\40\x3c\x73\x61\x6d\154\x3a\101\165\x74\x68\156\x43\157\156\164\145\x78\164\103\154\x61\x73\163\x52\145\x66\x3e\40\157\162\40\74\x73\x61\155\x6c\72\x41\165\x74\150\x6e\103\157\156\x74\145\170\x74\104\x65\143\x6c\x52\x65\146\x3e\x20\157\x72\x20\74\x73\141\x6d\154\x3a\x41\x75\x74\x68\x6e\103\x6f\156\x74\145\170\164\104\x65\x63\x6c\x3e");
        ZE:
        $this->AuthenticatingAuthority = Utilities::extractStrings($w8, "\x75\162\x6e\x3a\157\141\163\x69\x73\72\x6e\141\155\x65\163\72\164\x63\x3a\123\101\x4d\x4c\72\x32\x2e\x30\72\x61\x73\x73\x65\162\164\x69\157\x6e", "\101\165\164\x68\145\156\164\151\143\x61\x74\151\156\147\101\165\164\x68\157\x72\x69\164\171");
    }
    private function parseAttributes(DOMElement $RH)
    {
        $EF = TRUE;
        $zg = Utilities::xpQuery($RH, "\x2e\x2f\163\141\x6d\x6c\x5f\141\163\x73\x65\x72\x74\x69\x6f\x6e\72\x41\x74\164\162\x69\142\x75\164\145\x53\164\141\164\145\155\x65\156\x74\57\x73\x61\155\154\137\141\163\163\x65\x72\164\x69\157\x6e\72\101\164\164\x72\x69\x62\165\164\x65");
        foreach ($zg as $kl) {
            if ($kl->hasAttribute("\116\x61\x6d\x65")) {
                goto pe;
            }
            throw new Exception("\x4d\151\163\163\151\156\x67\x20\x6e\x61\x6d\145\40\157\x6e\40\74\x73\x61\x6d\154\72\101\164\x74\x72\151\x62\x75\164\x65\76\x20\145\154\145\155\x65\x6e\164\x2e");
            pe:
            $nA = $kl->getAttribute("\116\x61\x6d\145");
            if ($kl->hasAttribute("\x4e\x61\x6d\x65\x46\157\x72\155\x61\164")) {
                goto dH;
            }
            $D5 = "\165\x72\156\72\157\x61\163\x69\163\72\156\x61\155\145\163\x3a\164\143\72\123\101\115\114\x3a\61\x2e\61\72\x6e\141\x6d\145\151\x64\55\x66\157\x72\x6d\141\164\x3a\x75\156\x73\160\x65\143\151\146\x69\145\x64";
            goto LT;
            dH:
            $D5 = $kl->getAttribute("\116\x61\155\145\106\157\162\x6d\141\x74");
            LT:
            if ($EF) {
                goto Q2;
            }
            if (!($this->nameFormat !== $D5)) {
                goto cF;
            }
            $this->nameFormat = "\x75\162\156\72\x6f\x61\163\x69\x73\x3a\x6e\141\x6d\x65\x73\x3a\164\143\72\123\x41\x4d\114\x3a\61\x2e\x31\72\x6e\x61\155\x65\151\144\x2d\x66\157\x72\155\141\164\x3a\x75\x6e\x73\x70\x65\x63\151\x66\x69\x65\144";
            cF:
            goto bP;
            Q2:
            $this->nameFormat = $D5;
            $EF = FALSE;
            bP:
            if (array_key_exists($nA, $this->attributes)) {
                goto GA;
            }
            $this->attributes[$nA] = array();
            GA:
            $QZ = Utilities::xpQuery($kl, "\56\x2f\163\141\x6d\154\137\141\163\163\145\x72\x74\151\157\156\x3a\x41\164\164\x72\x69\x62\x75\x74\145\x56\x61\x6c\x75\145");
            foreach ($QZ as $zf) {
                $this->attributes[$nA][] = trim($zf->textContent);
                XN:
            }
            Bp:
            b3:
        }
        JF:
    }
    private function parseEncryptedAttributes(DOMElement $RH)
    {
        $this->encryptedAttribute = Utilities::xpQuery($RH, "\x2e\x2f\x73\141\x6d\154\x5f\x61\x73\163\x65\x72\164\151\157\156\x3a\x41\x74\164\162\151\142\x75\x74\x65\x53\x74\x61\x74\x65\155\x65\x6e\164\x2f\163\141\x6d\154\x5f\141\163\x73\x65\162\164\x69\157\156\x3a\105\156\143\x72\171\x70\x74\x65\x64\101\x74\164\162\151\x62\x75\x74\x65");
    }
    private function parseSignature(DOMElement $RH)
    {
        $Xh = Utilities::validateElement($RH);
        if (!($Xh !== FALSE)) {
            goto vz;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $Xh["\x43\x65\162\x74\x69\x66\x69\x63\141\164\145\x73"];
        $this->signatureData = $Xh;
        vz:
    }
    public function validate(XMLSecurityKey $z6)
    {
        if (!($this->signatureData === NULL)) {
            goto ai;
        }
        return FALSE;
        ai:
        Utilities::validateSignature($this->signatureData, $z6);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($cw)
    {
        $this->id = $cw;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($io)
    {
        $this->issueInstant = $io;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($L1)
    {
        $this->issuer = $L1;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto pz;
        }
        throw new Exception("\x41\164\x74\145\155\x70\164\x65\x64\40\x74\x6f\40\162\x65\x74\x72\151\x65\x76\x65\40\145\x6e\x63\162\x79\x70\164\x65\144\x20\x4e\141\155\x65\x49\x44\40\167\151\x74\150\x6f\x75\x74\40\144\x65\143\x72\171\160\x74\151\156\147\x20\x69\x74\40\146\151\x72\163\164\56");
        pz:
        return $this->nameId;
    }
    public function setNameId($yM)
    {
        $this->nameId = $yM;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Ls;
        }
        return TRUE;
        Ls:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $z6)
    {
        $jF = new DOMDocument();
        $e0 = $jF->createElement("\x72\x6f\157\x74");
        $jF->appendChild($e0);
        Utilities::addNameId($e0, $this->nameId);
        $yM = $e0->firstChild;
        Utilities::getContainer()->debugMessage($yM, "\x65\x6e\x63\x72\171\x70\164");
        $L0 = new XMLSecEnc();
        $L0->setNode($yM);
        $L0->type = XMLSecEnc::Element;
        $aH = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $aH->generateSessionKey();
        $L0->encryptKey($z6, $aH);
        $this->encryptedNameId = $L0->encryptNode($aH);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $z6, array $WO = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto Vh;
        }
        return;
        Vh:
        $yM = Utilities::decryptElement($this->encryptedNameId, $z6, $WO);
        Utilities::getContainer()->debugMessage($yM, "\x64\x65\x63\162\171\x70\x74");
        $this->nameId = Utilities::parseNameId($yM);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $z6, array $WO = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto Yx;
        }
        return;
        Yx:
        $EF = TRUE;
        $zg = $this->encryptedAttribute;
        foreach ($zg as $Oe) {
            $kl = Utilities::decryptElement($Oe->getElementsByTagName("\x45\156\x63\162\x79\160\x74\x65\x64\x44\x61\x74\141")->item(0), $z6, $WO);
            if ($kl->hasAttribute("\x4e\141\155\145")) {
                goto pQ;
            }
            throw new Exception("\x4d\x69\x73\x73\x69\156\147\40\156\x61\155\145\x20\157\x6e\x20\x3c\x73\x61\155\x6c\72\101\164\x74\162\x69\142\165\164\145\76\40\x65\x6c\145\155\145\156\x74\56");
            pQ:
            $nA = $kl->getAttribute("\116\x61\155\145");
            if ($kl->hasAttribute("\116\x61\155\x65\106\x6f\162\155\x61\164")) {
                goto Bj;
            }
            $D5 = "\165\162\x6e\x3a\x6f\141\x73\151\x73\x3a\x6e\x61\x6d\145\163\72\x74\x63\x3a\123\101\115\114\x3a\62\56\60\72\x61\x74\x74\x72\x6e\x61\x6d\145\55\x66\x6f\x72\x6d\141\164\72\165\156\x73\160\145\143\x69\x66\151\x65\144";
            goto b0;
            Bj:
            $D5 = $kl->getAttribute("\116\141\155\x65\106\157\x72\155\x61\x74");
            b0:
            if ($EF) {
                goto vE;
            }
            if (!($this->nameFormat !== $D5)) {
                goto AP;
            }
            $this->nameFormat = "\x75\x72\x6e\x3a\x6f\141\x73\x69\163\72\156\x61\155\x65\x73\x3a\x74\143\72\123\101\x4d\114\x3a\x32\x2e\60\x3a\141\164\x74\162\x6e\141\x6d\x65\x2d\x66\157\162\155\x61\x74\72\165\156\163\160\145\143\x69\146\151\x65\144";
            AP:
            goto aB;
            vE:
            $this->nameFormat = $D5;
            $EF = FALSE;
            aB:
            if (array_key_exists($nA, $this->attributes)) {
                goto F3;
            }
            $this->attributes[$nA] = array();
            F3:
            $QZ = Utilities::xpQuery($kl, "\x2e\57\163\x61\x6d\154\x5f\x61\x73\163\x65\162\x74\151\157\x6e\72\101\164\164\x72\151\142\165\164\145\126\141\x6c\x75\x65");
            foreach ($QZ as $zf) {
                $this->attributes[$nA][] = trim($zf->textContent);
                fj:
            }
            E1:
            is:
        }
        Lt:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($Gl)
    {
        $this->notBefore = $Gl;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($zH)
    {
        $this->notOnOrAfter = $zH;
    }
    public function setEncryptedAttributes($Fv)
    {
        $this->requiredEncAttributes = $Fv;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $ZW = NULL)
    {
        $this->validAudiences = $ZW;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($QR)
    {
        $this->authnInstant = $QR;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($iY)
    {
        $this->sessionNotOnOrAfter = $iY;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($u0)
    {
        $this->sessionIndex = $u0;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto ud;
        }
        return $this->authnContextClassRef;
        ud:
        if (empty($this->authnContextDeclRef)) {
            goto g4;
        }
        return $this->authnContextDeclRef;
        g4:
        return NULL;
    }
    public function setAuthnContext($bc)
    {
        $this->setAuthnContextClassRef($bc);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($JS)
    {
        $this->authnContextClassRef = $JS;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $cq)
    {
        if (empty($this->authnContextDeclRef)) {
            goto V1;
        }
        throw new Exception("\101\165\164\x68\156\x43\x6f\x6e\164\145\170\x74\x44\x65\x63\154\x52\145\x66\x20\x69\163\x20\x61\154\162\x65\x61\144\x79\40\x72\145\147\151\x73\164\145\162\145\x64\x21\40\115\x61\x79\40\x6f\x6e\154\x79\x20\150\141\x76\145\40\145\151\x74\150\x65\x72\x20\x61\x20\x44\145\143\x6c\40\x6f\162\x20\141\40\104\x65\x63\154\x52\x65\x66\x2c\x20\156\157\164\40\142\157\164\x68\41");
        V1:
        $this->authnContextDecl = $cq;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($Lu)
    {
        if (empty($this->authnContextDecl)) {
            goto VN;
        }
        throw new Exception("\101\x75\x74\150\156\x43\157\156\164\145\x78\x74\x44\x65\143\154\40\151\163\40\x61\154\x72\145\141\144\171\40\x72\145\x67\x69\x73\x74\145\162\145\144\x21\x20\x4d\141\x79\x20\x6f\156\154\x79\x20\x68\x61\x76\145\x20\x65\151\x74\150\145\162\x20\141\x20\104\x65\143\154\x20\157\x72\40\141\x20\x44\145\x63\x6c\122\145\x66\54\40\156\x6f\x74\40\142\157\x74\150\41");
        VN:
        $this->authnContextDeclRef = $Lu;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($xB)
    {
        $this->AuthenticatingAuthority = $xB;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $zg)
    {
        $this->attributes = $zg;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($D5)
    {
        $this->nameFormat = $D5;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $fh)
    {
        $this->SubjectConfirmation = $fh;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function setSignatureKey(XMLsecurityKey $OU = NULL)
    {
        $this->signatureKey = $OU;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $ir = NULL)
    {
        $this->encryptionKey = $ir;
    }
    public function setCertificates(array $ce)
    {
        $this->certificates = $ce;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $f4 = NULL)
    {
        if ($f4 === NULL) {
            goto eV;
        }
        $sV = $f4->ownerDocument;
        goto wr;
        eV:
        $sV = new DOMDocument();
        $f4 = $sV;
        wr:
        $e0 = $sV->createElementNS("\165\x72\156\72\157\141\163\151\x73\72\156\141\x6d\x65\x73\72\164\143\x3a\123\101\x4d\114\72\x32\x2e\x30\72\141\163\163\145\162\164\151\157\x6e", "\163\141\x6d\154\x3a" . "\101\163\163\145\x72\164\x69\157\156");
        $f4->appendChild($e0);
        $e0->setAttributeNS("\x75\162\x6e\x3a\157\x61\163\151\163\x3a\x6e\x61\155\x65\x73\x3a\164\143\72\123\101\115\114\x3a\62\56\60\x3a\x70\162\157\x74\x6f\x63\x6f\154", "\163\x61\x6d\154\160\x3a\164\155\x70", "\x74\x6d\x70");
        $e0->removeAttributeNS("\165\162\156\x3a\x6f\x61\x73\x69\x73\x3a\x6e\141\x6d\145\163\x3a\x74\x63\x3a\123\x41\115\114\x3a\x32\56\60\x3a\x70\162\157\164\157\143\157\x6c", "\164\x6d\x70");
        $e0->setAttributeNS("\x68\x74\x74\x70\72\x2f\57\x77\x77\167\56\x77\63\x2e\x6f\162\x67\x2f\62\60\60\61\x2f\x58\x4d\x4c\x53\143\x68\x65\x6d\x61\x2d\x69\x6e\x73\x74\x61\x6e\x63\x65", "\x78\x73\151\x3a\x74\x6d\x70", "\164\155\x70");
        $e0->removeAttributeNS("\x68\164\164\160\x3a\57\x2f\167\167\x77\x2e\x77\63\x2e\x6f\162\x67\x2f\x32\x30\x30\x31\x2f\130\115\x4c\x53\x63\150\145\155\141\x2d\x69\x6e\163\x74\x61\156\x63\x65", "\x74\x6d\160");
        $e0->setAttributeNS("\x68\x74\164\160\72\57\x2f\x77\x77\x77\56\167\x33\56\x6f\x72\x67\57\x32\x30\60\61\57\x58\x4d\114\123\x63\150\145\x6d\x61", "\170\163\72\164\155\x70", "\164\x6d\160");
        $e0->removeAttributeNS("\150\x74\164\x70\72\x2f\57\167\x77\x77\x2e\167\63\x2e\x6f\162\147\57\x32\x30\60\61\57\x58\x4d\x4c\x53\x63\150\x65\x6d\x61", "\164\x6d\x70");
        $e0->setAttribute("\x49\x44", $this->id);
        $e0->setAttribute("\x56\x65\162\x73\x69\157\x6e", "\62\56\60");
        $e0->setAttribute("\x49\x73\163\x75\x65\x49\156\163\164\141\x6e\x74", gmdate("\x59\55\x6d\55\x64\x5c\x54\110\x3a\x69\x3a\x73\x5c\x5a", $this->issueInstant));
        $L1 = Utilities::addString($e0, "\165\x72\x6e\x3a\x6f\x61\163\151\163\72\156\x61\155\145\x73\x3a\164\143\x3a\123\101\x4d\x4c\x3a\62\x2e\x30\72\x61\163\x73\145\x72\164\x69\x6f\x6e", "\163\141\155\154\72\111\x73\x73\165\145\162", $this->issuer);
        $this->addSubject($e0);
        $this->addConditions($e0);
        $this->addAuthnStatement($e0);
        if ($this->requiredEncAttributes == FALSE) {
            goto yN;
        }
        $this->addEncryptedAttributeStatement($e0);
        goto zS;
        yN:
        $this->addAttributeStatement($e0);
        zS:
        if (!($this->signatureKey !== NULL)) {
            goto BN;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $e0, $L1->nextSibling);
        BN:
        return $e0;
    }
    private function addSubject(DOMElement $e0)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto Nz;
        }
        return;
        Nz:
        $tZ = $e0->ownerDocument->createElementNS("\x75\162\x6e\72\157\141\x73\x69\163\x3a\x6e\141\155\145\163\x3a\164\143\72\123\x41\115\x4c\x3a\62\x2e\x30\x3a\141\x73\x73\145\162\164\151\157\156", "\163\x61\x6d\x6c\x3a\x53\x75\x62\152\x65\143\x74");
        $e0->appendChild($tZ);
        if ($this->encryptedNameId === NULL) {
            goto Vm;
        }
        $tl = $tZ->ownerDocument->createElementNS("\165\162\x6e\x3a\x6f\x61\x73\x69\163\x3a\156\141\155\x65\163\x3a\164\x63\72\x53\x41\x4d\114\72\x32\56\60\72\141\x73\163\145\x72\164\x69\x6f\x6e", "\x73\x61\155\x6c\72" . "\105\156\143\x72\x79\160\x74\x65\144\111\x44");
        $tZ->appendChild($tl);
        $tl->appendChild($tZ->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto H8;
        Vm:
        Utilities::addNameId($tZ, $this->nameId);
        H8:
        foreach ($this->SubjectConfirmation as $LZ) {
            $LZ->toXML($tZ);
            Qr:
        }
        c4:
    }
    private function addConditions(DOMElement $e0)
    {
        $sV = $e0->ownerDocument;
        $ch = $sV->createElementNS("\x75\162\x6e\72\x6f\141\x73\151\x73\x3a\x6e\x61\x6d\x65\x73\72\x74\143\72\x53\x41\115\x4c\72\62\x2e\x30\72\141\x73\163\145\x72\x74\x69\x6f\156", "\x73\x61\x6d\154\x3a\103\157\156\144\151\164\x69\x6f\156\163");
        $e0->appendChild($ch);
        if (!($this->notBefore !== NULL)) {
            goto bk;
        }
        $ch->setAttribute("\x4e\157\164\x42\x65\146\157\x72\145", gmdate("\x59\55\155\55\x64\134\124\x48\x3a\151\x3a\x73\x5c\132", $this->notBefore));
        bk:
        if (!($this->notOnOrAfter !== NULL)) {
            goto Ii;
        }
        $ch->setAttribute("\x4e\157\x74\117\x6e\117\x72\101\x66\164\145\x72", gmdate("\131\55\x6d\55\x64\134\x54\x48\72\x69\x3a\x73\x5c\x5a", $this->notOnOrAfter));
        Ii:
        if (!($this->validAudiences !== NULL)) {
            goto Zg;
        }
        $Ke = $sV->createElementNS("\165\162\156\72\157\141\x73\151\163\x3a\156\x61\x6d\145\163\x3a\164\143\x3a\123\x41\x4d\114\72\x32\x2e\x30\x3a\x61\x73\163\x65\x72\164\x69\157\156", "\163\x61\155\x6c\72\x41\165\x64\x69\x65\x6e\x63\145\122\x65\163\x74\162\x69\143\x74\151\x6f\x6e");
        $ch->appendChild($Ke);
        Utilities::addStrings($Ke, "\x75\x72\x6e\x3a\x6f\141\x73\151\163\x3a\156\x61\155\145\x73\72\164\x63\x3a\x53\x41\115\x4c\72\62\56\x30\72\141\x73\163\145\162\x74\151\x6f\156", "\x73\x61\x6d\x6c\72\101\165\144\x69\x65\x6e\143\x65", FALSE, $this->validAudiences);
        Zg:
    }
    private function addAuthnStatement(DOMElement $e0)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto wb;
        }
        return;
        wb:
        $sV = $e0->ownerDocument;
        $uL = $sV->createElementNS("\165\x72\156\x3a\x6f\141\x73\x69\x73\x3a\156\x61\x6d\145\163\72\x74\x63\72\123\101\115\114\x3a\62\56\60\x3a\141\x73\x73\145\162\x74\x69\157\x6e", "\163\141\155\154\72\101\x75\164\150\156\x53\164\x61\x74\x65\x6d\145\156\x74");
        $e0->appendChild($uL);
        $uL->setAttribute("\101\x75\164\150\156\x49\156\x73\164\x61\156\x74", gmdate("\x59\55\155\55\144\x5c\124\x48\x3a\x69\72\163\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto tk;
        }
        $uL->setAttribute("\x53\145\x73\x73\151\157\156\116\157\x74\117\x6e\x4f\x72\101\x66\164\145\x72", gmdate("\x59\55\155\55\x64\134\x54\110\x3a\151\72\163\x5c\132", $this->sessionNotOnOrAfter));
        tk:
        if (!($this->sessionIndex !== NULL)) {
            goto oa;
        }
        $uL->setAttribute("\123\145\x73\x73\x69\x6f\x6e\111\x6e\x64\x65\170", $this->sessionIndex);
        oa:
        $w8 = $sV->createElementNS("\165\x72\156\72\x6f\141\163\x69\x73\x3a\156\141\x6d\x65\x73\x3a\164\x63\72\x53\x41\115\114\x3a\62\56\60\72\141\x73\163\145\162\164\151\x6f\156", "\x73\x61\x6d\154\72\x41\x75\x74\150\156\103\x6f\x6e\x74\145\170\x74");
        $uL->appendChild($w8);
        if (empty($this->authnContextClassRef)) {
            goto iq;
        }
        Utilities::addString($w8, "\165\x72\156\x3a\x6f\141\163\x69\163\72\156\x61\155\x65\163\72\164\143\72\x53\x41\115\x4c\x3a\x32\x2e\60\x3a\x61\x73\x73\x65\162\x74\x69\x6f\x6e", "\163\141\155\154\72\101\x75\164\x68\x6e\103\x6f\x6e\x74\145\170\164\103\x6c\x61\163\x73\122\x65\x66", $this->authnContextClassRef);
        iq:
        if (empty($this->authnContextDecl)) {
            goto oA;
        }
        $this->authnContextDecl->toXML($w8);
        oA:
        if (empty($this->authnContextDeclRef)) {
            goto ge;
        }
        Utilities::addString($w8, "\x75\x72\x6e\72\x6f\141\163\151\x73\72\156\141\x6d\x65\163\72\164\x63\x3a\x53\101\115\x4c\x3a\62\56\60\72\x61\x73\x73\145\162\x74\x69\x6f\156", "\163\141\155\x6c\72\x41\x75\164\x68\156\x43\x6f\x6e\x74\145\x78\x74\104\x65\143\x6c\122\x65\146", $this->authnContextDeclRef);
        ge:
        Utilities::addStrings($w8, "\165\x72\x6e\x3a\157\x61\x73\x69\163\72\156\x61\x6d\145\x73\72\x74\143\x3a\x53\x41\x4d\x4c\72\x32\x2e\x30\x3a\141\163\163\145\162\x74\x69\157\x6e", "\x73\141\155\x6c\72\x41\x75\x74\150\x65\156\164\x69\x63\x61\x74\x69\x6e\147\101\x75\x74\x68\157\x72\x69\164\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $e0)
    {
        if (!empty($this->attributes)) {
            goto P1;
        }
        return;
        P1:
        $sV = $e0->ownerDocument;
        $zh = $sV->createElementNS("\165\162\x6e\72\157\141\x73\151\x73\x3a\x6e\x61\x6d\145\163\x3a\x74\143\72\123\x41\115\114\72\x32\x2e\x30\x3a\141\163\163\145\x72\164\151\x6f\156", "\163\x61\x6d\x6c\x3a\x41\164\164\x72\151\142\165\x74\145\x53\x74\x61\x74\145\x6d\145\x6e\164");
        $e0->appendChild($zh);
        foreach ($this->attributes as $nA => $QZ) {
            $kl = $sV->createElementNS("\165\162\156\72\x6f\141\x73\151\163\72\156\141\x6d\145\163\x3a\x74\x63\72\123\101\115\x4c\x3a\62\x2e\x30\72\141\x73\x73\145\162\x74\151\x6f\156", "\163\141\x6d\x6c\72\x41\x74\x74\x72\x69\142\x75\x74\145");
            $zh->appendChild($kl);
            $kl->setAttribute("\x4e\x61\x6d\145", $nA);
            if (!($this->nameFormat !== "\165\162\156\72\157\141\x73\x69\163\x3a\156\x61\x6d\x65\163\72\x74\x63\72\123\101\115\x4c\72\62\56\60\x3a\141\164\x74\162\156\141\x6d\145\x2d\146\x6f\x72\x6d\x61\164\72\x75\x6e\x73\160\x65\143\x69\146\151\145\x64")) {
                goto BO;
            }
            $kl->setAttribute("\x4e\x61\x6d\x65\106\157\x72\155\x61\164", $this->nameFormat);
            BO:
            foreach ($QZ as $zf) {
                if (is_string($zf)) {
                    goto uy;
                }
                if (is_int($zf)) {
                    goto LS;
                }
                $Pp = NULL;
                goto c1;
                uy:
                $Pp = "\x78\x73\72\x73\x74\x72\x69\x6e\x67";
                goto c1;
                LS:
                $Pp = "\x78\x73\x3a\x69\x6e\x74\145\x67\x65\x72";
                c1:
                $Mt = $sV->createElementNS("\165\x72\156\x3a\x6f\141\x73\151\x73\x3a\156\x61\x6d\x65\163\x3a\164\x63\x3a\123\101\x4d\x4c\72\x32\56\x30\72\x61\x73\163\x65\162\x74\x69\x6f\x6e", "\x73\x61\x6d\154\x3a\x41\x74\164\162\x69\x62\165\x74\145\126\x61\x6c\165\145");
                $kl->appendChild($Mt);
                if (!($Pp !== NULL)) {
                    goto km;
                }
                $Mt->setAttributeNS("\150\164\x74\160\x3a\x2f\57\x77\167\167\x2e\x77\x33\x2e\157\x72\147\57\x32\60\x30\61\57\130\115\x4c\x53\143\150\145\155\141\55\151\156\163\x74\141\156\x63\145", "\x78\163\x69\x3a\x74\x79\x70\145", $Pp);
                km:
                if (!is_null($zf)) {
                    goto hs;
                }
                $Mt->setAttributeNS("\150\x74\164\x70\72\57\x2f\x77\167\167\56\167\x33\x2e\x6f\x72\x67\x2f\x32\x30\x30\61\57\x58\x4d\x4c\x53\x63\150\x65\155\141\x2d\x69\156\163\164\x61\156\x63\145", "\170\x73\x69\72\x6e\151\154", "\164\162\165\145");
                hs:
                if ($zf instanceof DOMNodeList) {
                    goto aG;
                }
                $Mt->appendChild($sV->createTextNode($zf));
                goto KX;
                aG:
                $qK = 0;
                Ot:
                if (!($qK < $zf->length)) {
                    goto ND;
                }
                $Bu = $sV->importNode($zf->item($qK), TRUE);
                $Mt->appendChild($Bu);
                pS:
                $qK++;
                goto Ot;
                ND:
                KX:
                de:
            }
            bn:
            LE:
        }
        MX:
    }
    private function addEncryptedAttributeStatement(DOMElement $e0)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto ub;
        }
        return;
        ub:
        $sV = $e0->ownerDocument;
        $zh = $sV->createElementNS("\x75\162\x6e\x3a\157\x61\163\151\163\x3a\x6e\141\155\x65\x73\72\164\143\72\x53\101\115\x4c\x3a\x32\56\60\72\x61\163\x73\x65\162\x74\151\x6f\156", "\163\141\x6d\154\x3a\101\x74\x74\162\151\x62\165\x74\x65\123\164\x61\x74\x65\155\145\156\164");
        $e0->appendChild($zh);
        foreach ($this->attributes as $nA => $QZ) {
            $Ec = new DOMDocument();
            $kl = $Ec->createElementNS("\x75\162\156\72\157\141\x73\x69\x73\x3a\x6e\141\155\x65\x73\72\x74\x63\x3a\x53\x41\x4d\x4c\x3a\62\x2e\x30\72\x61\163\x73\145\162\x74\x69\x6f\x6e", "\163\141\155\154\x3a\101\164\164\x72\x69\x62\165\164\x65");
            $kl->setAttribute("\x4e\141\x6d\x65", $nA);
            $Ec->appendChild($kl);
            if (!($this->nameFormat !== "\165\x72\156\x3a\157\x61\163\x69\163\72\156\141\155\x65\x73\72\164\x63\72\123\x41\x4d\114\72\x32\56\x30\x3a\x61\x74\164\x72\156\x61\x6d\145\55\x66\157\162\155\x61\164\72\165\156\x73\160\x65\143\x69\146\151\145\x64")) {
                goto P2;
            }
            $kl->setAttribute("\x4e\141\x6d\x65\x46\x6f\162\x6d\x61\164", $this->nameFormat);
            P2:
            foreach ($QZ as $zf) {
                if (is_string($zf)) {
                    goto Fi;
                }
                if (is_int($zf)) {
                    goto iy;
                }
                $Pp = NULL;
                goto rd;
                Fi:
                $Pp = "\170\x73\x3a\x73\164\162\x69\156\147";
                goto rd;
                iy:
                $Pp = "\x78\163\72\151\156\x74\145\147\145\162";
                rd:
                $Mt = $Ec->createElementNS("\165\162\156\72\x6f\141\x73\x69\x73\72\156\141\x6d\145\x73\72\x74\143\x3a\x53\101\x4d\114\72\62\x2e\x30\72\x61\x73\163\x65\162\x74\151\157\156", "\163\x61\x6d\x6c\x3a\101\x74\164\162\151\x62\x75\x74\x65\126\141\154\165\x65");
                $kl->appendChild($Mt);
                if (!($Pp !== NULL)) {
                    goto QT;
                }
                $Mt->setAttributeNS("\x68\164\164\160\x3a\x2f\57\x77\167\167\56\167\x33\56\x6f\x72\147\x2f\x32\x30\x30\61\57\130\115\114\x53\x63\x68\145\x6d\141\x2d\x69\156\x73\x74\141\x6e\143\x65", "\x78\163\x69\72\164\171\160\145", $Pp);
                QT:
                if ($zf instanceof DOMNodeList) {
                    goto th;
                }
                $Mt->appendChild($Ec->createTextNode($zf));
                goto a0;
                th:
                $qK = 0;
                Km:
                if (!($qK < $zf->length)) {
                    goto i0;
                }
                $Bu = $Ec->importNode($zf->item($qK), TRUE);
                $Mt->appendChild($Bu);
                dp:
                $qK++;
                goto Km;
                i0:
                a0:
                Hz:
            }
            Zy:
            $yI = new XMLSecEnc();
            $yI->setNode($Ec->documentElement);
            $yI->type = "\150\164\x74\160\x3a\x2f\57\x77\167\x77\56\x77\63\56\x6f\162\147\x2f\x32\60\x30\x31\57\60\64\57\170\x6d\154\x65\156\x63\x23\x45\154\x65\x6d\145\x6e\x74";
            $aH = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $aH->generateSessionKey();
            $yI->encryptKey($this->encryptionKey, $aH);
            $PZ = $yI->encryptNode($aH);
            $Uk = $sV->createElementNS("\x75\x72\156\72\157\141\x73\151\x73\72\156\141\x6d\145\x73\72\164\x63\x3a\123\x41\115\114\x3a\x32\x2e\60\72\141\x73\163\145\162\x74\151\x6f\x6e", "\163\x61\x6d\154\x3a\x45\x6e\x63\162\x79\x70\164\x65\144\x41\164\164\162\x69\142\165\164\x65");
            $zh->appendChild($Uk);
            $e5 = $sV->importNode($PZ, TRUE);
            $Uk->appendChild($e5);
            Zv:
        }
        um:
    }
}
