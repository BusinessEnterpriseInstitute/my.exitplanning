<?php


class GenerateResponse
{
    private $xml;
    private $acsUrl;
    private $issuer;
    private $audience;
    private $username;
    private $email;
    private $name_id_attr;
    private $name_id_attr_format;
    private $mo_idp_response_signed;
    private $mo_idp_assertion_signed;
    private $mo_idp_encrypted_assertion;
    private $mo_idp_cert_encrypt;
    private $encryptionKey;
    private $attributes;
    private $inResponseTo;
    private $subject;
    function __construct($Wp, $ND, $E5, $L1, $WN, $pf = null, $d5 = null, $a0 = null, $Ey = null, $m2 = null, $zg = array(), $c6 = '', $kn = null)
    {
        $this->xml = new DOMDocument("\61\x2e\x30", "\x75\x74\x66\x2d\70");
        $this->acsUrl = $E5;
        $this->issuer = $L1;
        $this->audience = $WN;
        $this->email = $Wp;
        $this->username = $ND;
        $this->name_id_attr = $pf;
        $this->name_id_attr_format = $c6;
        $this->mo_idp_response_signed = $d5;
        $this->mo_idp_assertion_signed = $a0;
        $this->mo_idp_encrypted_assertion = $Ey;
        $this->mo_idp_cert_encrypt = $m2;
        $this->attributes = $zg;
        $this->inResponseTo = $kn;
    }
    function createSamlResponse()
    {
        $this->licenseCheck();
        $eR = $this->getResponseParams();
        $aD = $this->createResponseElement($eR);
        $this->xml->appendChild($aD);
        $L1 = $this->buildIssuer();
        $aD->appendChild($L1);
        $iJ = $this->buildStatus();
        $aD->appendChild($iJ);
        $ij = $this->buildStatusCode();
        $iJ->appendChild($ij);
        $bg = $this->buildAssertion($eR);
        $aD->appendChild($bg);
        $Ok = '';
        $Ok = variable_get("\x6d\151\156\x69\157\x72\x61\156\147\145\x5f\163\x61\155\x6c\x5f\x69\x64\x70\x5f\x70\x72\151\166\141\164\145\x5f\143\145\x72\164\151\x66\x69\x63\x61\164\145");
        if (!$this->mo_idp_assertion_signed) {
            goto cm;
        }
        if (!empty($Ok)) {
            goto tC;
        }
        $Dr = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\163\x6f\165\x72\143\145\x73" . DIRECTORY_SEPARATOR . "\x69\144\x70\x2d\x73\x69\147\156\x69\156\147\56\153\145\x79";
        goto mF;
        tC:
        $Dr = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\x75\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\103\x75\x73\164\157\x6d\x5f\x50\x72\x69\x76\x61\x74\145\x5f\x43\x65\x72\x74\x69\x66\151\143\141\164\145\x2e\153\x65\171";
        mF:
        $this->signNode($Dr, $bg, $this->subject, $eR);
        cm:
        if (!$this->mo_idp_encrypted_assertion) {
            goto mB;
        }
        $ZL = $this->buildEncryptedAssertion($bg);
        $aD->removeChild($bg);
        $aD->appendChild($ZL);
        mB:
        if (!$this->mo_idp_response_signed) {
            goto eg;
        }
        if (!empty($Ok)) {
            goto UD;
        }
        $Dr = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\145\x73\x6f\x75\162\x63\145\163" . DIRECTORY_SEPARATOR . "\151\x64\160\x2d\163\151\x67\x6e\x69\x6e\147\56\x6b\145\x79";
        goto zJ;
        UD:
        $Dr = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\x65\x73\157\165\162\143\x65\x73" . DIRECTORY_SEPARATOR . "\103\x75\x73\164\x6f\155\x5f\x50\x72\151\x76\141\x74\x65\137\103\145\162\164\x69\x66\x69\143\141\x74\x65\x2e\153\145\x79";
        zJ:
        $this->signNode($Dr, $aD, $iJ, $eR);
        eg:
        $sZ = $this->xml->saveXML();
        return $sZ;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $ir = NULL)
    {
        $this->encryptionKey = $ir;
    }
    function getResponseParams()
    {
        $eR = array();
        $TQ = time();
        $eR["\x49\x73\163\x75\x65\x49\156\x73\164\141\x6e\164"] = str_replace("\53\x30\60\x3a\x30\60", "\132", gmdate("\143", $TQ));
        $eR["\x4e\157\164\117\156\x4f\x72\101\146\164\145\x72"] = str_replace("\x2b\60\60\72\x30\x30", "\x5a", gmdate("\x63", $TQ + 300));
        $eR["\116\157\x74\102\x65\x66\157\162\145"] = str_replace("\x2b\x30\60\72\60\x30", "\x5a", gmdate("\143", $TQ - 30));
        $eR["\x41\165\x74\150\x6e\x49\156\163\164\141\x6e\164"] = str_replace("\53\x30\x30\72\60\60", "\x5a", gmdate("\143", $TQ - 120));
        $eR["\123\145\163\163\151\157\156\x4e\x6f\x74\117\x6e\x4f\x72\x41\x66\164\145\162"] = str_replace("\53\x30\60\x3a\60\60", "\x5a", gmdate("\143", $TQ + 3600 * 8));
        $eR["\111\x44"] = $this->generateUniqueID(40);
        $eR["\101\163\163\145\162\x74\x49\x44"] = $this->generateUniqueID(40);
        $eR["\x49\163\x73\x75\145\162"] = $this->issuer;
        $Zt = '';
        $Zt = variable_get("\155\151\x6e\151\x6f\162\141\156\147\x65\137\x73\x61\155\154\x5f\151\x64\160\137\x70\x75\142\154\x5f\143\145\162\164\151\x66\151\143\x61\164\145");
        if ($Zt != '') {
            goto vu;
        }
        $q2 = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\x65\x73\x6f\165\162\x63\x65\163" . DIRECTORY_SEPARATOR . "\151\x64\x70\x2d\163\x69\x67\x6e\151\x6e\x67\x2e\143\x72\164";
        goto cS;
        vu:
        $q2 = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\x65\163\157\x75\x72\143\145\163" . DIRECTORY_SEPARATOR . "\x43\x75\163\164\157\155\137\x50\x75\142\154\x69\143\137\103\x65\162\164\x69\x66\x69\143\141\x74\x65\x2e\x63\x72\164";
        cS:
        $Mj = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\171\160\145" => "\160\165\142\154\x69\x63"));
        $Mj->loadKey($q2, TRUE, TRUE);
        $eR["\x78\65\60\x39"] = $Mj->getX509Certificate();
        $eR["\x41\164\x74\x72\151\142\x75\x74\145\163"] = $this->attributes;
        return $eR;
    }
    function createResponseElement($eR)
    {
        $aD = $this->xml->createElementNS("\165\162\156\x3a\157\x61\163\x69\163\x3a\156\141\x6d\145\163\72\164\143\x3a\x53\x41\115\x4c\72\x32\56\60\72\x70\162\157\x74\157\x63\x6f\x6c", "\x73\141\x6d\x6c\x70\x3a\x52\145\163\160\x6f\x6e\x73\145");
        $aD->setAttribute("\x49\x44", $eR["\111\104"]);
        $aD->setAttribute("\x56\145\162\x73\151\x6f\156", "\x32\56\x30");
        $aD->setAttribute("\x49\x73\163\165\x65\x49\156\163\x74\x61\x6e\164", $eR["\111\163\163\x75\145\x49\x6e\x73\164\141\x6e\164"]);
        $aD->setAttribute("\104\x65\x73\164\x69\156\141\x74\151\x6f\x6e", $this->acsUrl);
        if (!(isset($this->inResponseTo) && !is_null($this->inResponseTo))) {
            goto KG;
        }
        $aD->setAttribute("\111\156\122\x65\163\160\157\156\163\x65\124\x6f", $this->inResponseTo);
        KG:
        return $aD;
    }
    function buildIssuer()
    {
        $L1 = $this->xml->createElementNS("\x75\162\156\72\157\141\x73\x69\x73\72\156\141\155\145\163\x3a\164\x63\x3a\123\x41\x4d\114\72\62\56\x30\x3a\141\x73\x73\145\x72\x74\151\157\156", "\163\141\x6d\x6c\72\111\163\163\x75\145\x72", $this->issuer);
        return $L1;
    }
    function buildStatus()
    {
        $iJ = $this->xml->createElementNS("\165\x72\156\x3a\157\x61\x73\151\x73\x3a\156\141\155\x65\163\x3a\x74\x63\x3a\x53\x41\115\x4c\72\62\x2e\60\x3a\160\x72\157\x74\x6f\143\157\154", "\163\141\x6d\154\x70\72\x53\x74\x61\164\165\x73");
        return $iJ;
    }
    function buildStatusCode()
    {
        $ij = $this->xml->createElementNS("\165\162\156\72\157\x61\163\151\163\x3a\156\141\155\x65\x73\72\164\143\x3a\123\x41\x4d\x4c\x3a\x32\x2e\60\72\x70\162\157\164\x6f\x63\157\x6c", "\163\x61\155\x6c\x70\x3a\x53\164\x61\x74\165\163\x43\x6f\x64\145");
        $ij->setAttribute("\x56\x61\x6c\165\145", "\165\162\x6e\72\157\141\x73\x69\163\72\x6e\x61\155\145\x73\72\164\x63\72\x53\x41\115\x4c\72\62\x2e\60\x3a\x73\x74\x61\x74\x75\163\x3a\x53\x75\x63\x63\x65\163\163");
        return $ij;
    }
    function buildAssertion($eR)
    {
        $bg = $this->xml->createElementNS("\165\162\156\x3a\x6f\x61\163\x69\x73\72\156\141\155\x65\163\x3a\164\143\72\x53\x41\x4d\114\x3a\x32\x2e\60\x3a\x61\163\163\x65\162\x74\x69\x6f\156", "\x73\141\155\x6c\x3a\101\163\x73\x65\162\x74\x69\157\x6e");
        $bg->setAttribute("\x49\x44", $eR["\x41\x73\x73\145\x72\164\x49\x44"]);
        $bg->setAttribute("\x49\163\x73\165\x65\111\x6e\163\164\x61\x6e\164", $eR["\x49\163\163\x75\145\x49\156\x73\x74\141\x6e\164"]);
        $bg->setAttribute("\126\145\162\x73\x69\x6f\156", "\62\56\60");
        $L1 = $this->buildIssuer($eR);
        $bg->appendChild($L1);
        $tZ = $this->buildSubject($eR);
        $this->subject = $tZ;
        $bg->appendChild($tZ);
        $w6 = $this->buildCondition($eR);
        $bg->appendChild($w6);
        $O8 = $this->buildAuthnStatement($eR);
        $bg->appendChild($O8);
        $zg = $eR["\x41\x74\x74\x72\x69\142\x75\164\x65\x73"];
        if (empty($zg)) {
            goto pn;
        }
        $X5 = $this->buildAttrStatement($eR);
        $bg->appendChild($X5);
        pn:
        return $bg;
    }
    function buildSubject($eR)
    {
        $tZ = $this->xml->createElement("\x73\x61\x6d\154\x3a\x53\x75\142\152\x65\x63\x74");
        $QB = $this->buildNameIdentifier();
        $tZ->appendChild($QB);
        $ox = $this->buildSubjectConfirmation($eR);
        $tZ->appendChild($ox);
        return $tZ;
    }
    function buildNameIdentifier()
    {
        if ($this->name_id_attr === "\x65\x6d\141\x69\x6c\x41\144\144\x72\145\x73\163") {
            goto XD;
        }
        $QB = $this->xml->createElement("\163\x61\155\154\72\116\141\155\145\111\104", $this->username);
        goto m8;
        XD:
        $QB = $this->xml->createElement("\x73\141\x6d\154\x3a\x4e\x61\x6d\145\111\104", $this->email);
        m8:
        if (empty($this->name_id_attr_format)) {
            goto X4;
        }
        $QB->setAttribute("\x46\x6f\162\155\x61\x74", "\165\162\x6e\72\157\141\163\x69\163\72\x6e\141\155\145\x73\72\x74\143\x3a\123\x41\115\114\x3a" . $this->name_id_attr_format);
        goto Ec;
        X4:
        $QB->setAttribute("\106\157\x72\155\x61\x74", "\165\x72\x6e\x3a\157\x61\x73\x69\163\x3a\156\141\155\x65\163\72\164\143\x3a\123\101\x4d\114\72\61\56\x31\72\156\x61\155\145\151\144\x2d\x66\x6f\x72\x6d\x61\x74\x3a\145\x6d\141\x69\154\x41\144\x64\x72\145\163\163");
        Ec:
        $QB->setAttribute("\x53\120\x4e\x61\x6d\x65\x51\165\141\154\151\146\151\145\x72", $this->audience);
        return $QB;
    }
    function buildSubjectConfirmation($eR)
    {
        $ox = $this->xml->createElement("\x73\141\155\154\x3a\123\165\x62\152\145\x63\164\103\x6f\x6e\146\151\162\x6d\x61\x74\151\x6f\x6e");
        $ox->setAttribute("\115\145\164\150\157\x64", "\165\x72\x6e\72\157\x61\163\151\163\x3a\x6e\x61\155\145\x73\x3a\x74\x63\x3a\x53\x41\115\114\x3a\x32\56\x30\x3a\143\x6d\72\x62\145\141\162\x65\162");
        $hP = $this->getSubjectConfirmationData($eR);
        $ox->appendChild($hP);
        return $ox;
    }
    function getSubjectConfirmationData($eR)
    {
        $hP = $this->xml->createElement("\163\141\x6d\x6c\x3a\123\165\142\152\x65\x63\164\x43\157\x6e\146\151\x72\x6d\141\x74\x69\x6f\156\104\x61\164\141");
        $hP->setAttribute("\x4e\x6f\x74\x4f\x6e\x4f\162\x41\146\x74\145\x72", $eR["\x4e\x6f\x74\x4f\156\117\x72\101\146\164\145\x72"]);
        $hP->setAttribute("\122\x65\x63\151\x70\151\145\x6e\164", $this->acsUrl);
        if (!(isset($this->inResponseTo) && !is_null($this->inResponseTo))) {
            goto AN;
        }
        $hP->setAttribute("\111\156\x52\x65\163\160\157\156\x73\x65\x54\x6f", $this->inResponseTo);
        AN:
        return $hP;
    }
    function buildCondition($eR)
    {
        $w6 = $this->xml->createElement("\x73\x61\155\154\72\x43\x6f\156\x64\x69\164\x69\157\156\x73");
        $w6->setAttribute("\116\157\164\x42\145\x66\x6f\x72\145", $eR["\116\157\x74\102\145\x66\x6f\162\145"]);
        $w6->setAttribute("\x4e\x6f\x74\117\156\117\162\101\x66\164\145\x72", $eR["\x4e\x6f\164\117\x6e\117\x72\101\146\x74\x65\x72"]);
        $Fl = $this->buildAudienceRestriction();
        $w6->appendChild($Fl);
        return $w6;
    }
    function buildAudienceRestriction()
    {
        $Fl = $this->xml->createElement("\163\x61\155\x6c\72\101\x75\x64\x69\145\156\143\x65\x52\x65\x73\x74\x72\x69\143\x74\151\x6f\156");
        $WN = $this->xml->createElement("\x73\141\155\154\x3a\x41\165\144\x69\145\x6e\143\x65", $this->audience);
        $Fl->appendChild($WN);
        return $Fl;
    }
    function buildAuthnStatement($eR)
    {
        $O8 = $this->xml->createElement("\163\x61\x6d\154\x3a\x41\165\164\x68\156\x53\164\x61\164\145\x6d\145\156\x74");
        $O8->setAttribute("\x41\x75\164\x68\x6e\x49\156\x73\x74\x61\156\x74", $eR["\101\165\x74\x68\x6e\x49\156\x73\x74\x61\x6e\x74"]);
        $O8->setAttribute("\x53\x65\163\163\x69\157\x6e\111\x6e\x64\x65\170", "\x5f" . $this->generateUniqueID(30));
        $O8->setAttribute("\x53\x65\x73\x73\151\x6f\156\116\x6f\164\117\x6e\x4f\x72\x41\x66\x74\145\162", $eR["\x53\145\x73\163\x69\x6f\x6e\x4e\x6f\x74\117\156\117\x72\x41\146\x74\x65\162"]);
        $GF = $this->xml->createElement("\163\141\x6d\x6c\72\101\165\164\150\x6e\103\x6f\x6e\164\145\170\x74");
        $lt = $this->xml->createElement("\163\x61\155\x6c\72\x41\x75\164\150\x6e\103\157\156\164\x65\170\164\103\154\141\x73\163\122\145\146", "\x75\x72\x6e\x3a\x6f\141\163\x69\x73\72\x6e\x61\x6d\x65\x73\72\x74\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\60\x3a\141\x63\x3a\143\x6c\x61\163\163\x65\163\72\x50\141\163\163\x77\x6f\x72\144\120\162\157\164\x65\143\x74\x65\144\x54\162\141\156\x73\x70\x6f\x72\164");
        $GF->appendChild($lt);
        $O8->appendChild($GF);
        return $O8;
    }
    function buildAttrStatement($eR)
    {
        $X5 = $this->xml->createElement("\163\x61\155\154\x3a\x41\x74\x74\162\151\142\x75\164\x65\123\x74\x61\164\x65\155\145\156\x74");
        $hA = $eR["\101\x74\x74\x72\x69\142\x75\x74\145\x73"];
        foreach ($hA as $zI => $zf) {
            $Gg = $this->buildAttribute($zI, $zf);
            $X5->appendChild($Gg);
            xh:
        }
        SQ:
        return $X5;
    }
    function buildAttribute($Dk, $I8)
    {
        $Gg = $this->xml->createElement("\x73\141\x6d\x6c\72\101\x74\x74\x72\x69\142\165\164\145");
        $Gg->setAttribute("\x4e\x61\x6d\x65", $Dk);
        $Gg->setAttribute("\116\x61\x6d\145\x46\157\x72\155\141\164", "\x75\x72\x6e\x3a\x6f\141\163\x69\x73\x3a\156\x61\155\x65\x73\x3a\164\x63\x3a\x53\x41\115\x4c\x3a\x32\x2e\x30\72\141\x74\164\162\x6e\x61\155\145\x2d\x66\157\162\x6d\141\164\x3a\142\x61\x73\151\143");
        if (is_array($I8)) {
            goto Pd;
        }
        $aQ = $this->xml->createElement("\x73\x61\x6d\154\x3a\101\x74\164\x72\151\x62\x75\164\145\x56\141\154\x75\x65", $I8);
        $Gg->appendChild($aQ);
        goto Pv;
        Pd:
        foreach ($I8 as $z6 => $gk) {
            $aQ = $this->xml->createElement("\163\141\x6d\x6c\x3a\x41\164\x74\162\151\142\x75\164\145\126\141\154\165\x65", $gk);
            $Gg->appendChild($aQ);
            EN:
        }
        jd:
        Pv:
        return $Gg;
    }
    function buildEncryptedAssertion($bg)
    {
        $ZL = $this->xml->createElementNS("\x75\162\x6e\x3a\x6f\x61\163\151\x73\72\156\x61\155\145\x73\x3a\164\x63\72\123\x41\x4d\114\x3a\62\x2e\60\72\141\x73\163\x65\x72\164\151\157\x6e", "\163\x61\x6d\x6c\160\x3a\x45\x6e\143\x72\171\160\x74\x65\144\101\x73\x73\x65\x72\x74\151\157\156");
        $IK = $this->buildEncryptedData($bg);
        $ZL->appendChild($ZL->ownerDocument->importNode($IK, TRUE));
        return $ZL;
    }
    function buildEncryptedData($bg)
    {
        $IK = new XMLSecEnc();
        $IK->setNode($bg);
        $IK->type = "\x68\164\x74\x70\x3a\x2f\57\x77\167\x77\x2e\167\63\56\x6f\x72\x67\x2f\x32\x30\x30\61\x2f\60\64\x2f\170\x6d\154\145\x6e\143\x23\105\154\x65\155\145\x6e\164";
        $Ml = $this->mo_idp_cert_encrypt;
        $Yq = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\171\x70\145" => "\x70\165\x62\154\151\143"));
        $Yq->loadKey($Ml, FALSE, TRUE);
        $this->setEncryptionKey($Yq);
        $aH = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $aH->generateSessionKey();
        $IK->encryptKey($this->encryptionKey, $aH);
        $PZ = $IK->encryptNode($aH, FALSE);
        return $PZ;
    }
    function signNode($Dr, $Bu, $tZ, $eR)
    {
        $Mj = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\171\x70\145" => "\160\x72\x69\166\141\164\145"));
        $Mj->loadKey($Dr, TRUE);
        $WU = new XMLSecurityDSig();
        $WU->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $WU->addReferenceList(array($Bu), XMLSecurityDSig::SHA256, array("\150\x74\x74\x70\72\57\x2f\x77\x77\x77\x2e\x77\x33\x2e\x6f\162\x67\57\x32\60\x30\60\57\60\71\57\x78\x6d\x6c\x64\163\151\147\x23\x65\x6e\166\145\x6c\157\x70\x65\x64\x2d\x73\151\x67\x6e\141\x74\x75\162\145", XMLSecurityDSig::EXC_C14N), array("\x69\144\x5f\x6e\141\x6d\x65" => "\x49\104", "\157\166\x65\162\x77\x72\x69\x74\x65" => false));
        $WU->sign($Mj);
        $WU->add509Cert($eR["\x78\x35\x30\71"]);
        $WU->insertSignature($Bu, $tZ);
    }
    function generateUniqueID($Rl)
    {
        $MB = "\141\x62\x63\144\x65\x66\x30\61\62\63\x34\x35\x36\x37\x38\x39";
        $fU = strlen($MB);
        $Bl = '';
        $qK = 0;
        Nj:
        if (!($qK < $Rl)) {
            goto OE;
        }
        $Bl .= substr($MB, rand(0, 15), 1);
        be:
        $qK++;
        goto Nj;
        OE:
        return "\141" . $Bl;
    }
    function licenseCheck()
    {
        global $base_url;
        $vR = db_select("\155\x69\x6e\151\x6f\162\141\156\x67\145\137\163\141\155\x6c\137\x69\x64\x70\137\x75\x73\145\x72", "\125\x73\x65\x72\111\156")->fields("\125\x73\145\162\111\156")->condition("\x6d\x61\x69\x6c", $this->email, "\x3d")->execute()->fetchAssoc();
        $xD = $vR["\125\163\145\162\x49\x6e"];
        $rz = new MiniorangeSAMLIdpCustomer(NULL, NULL, NULL, NULL);
        $XX = variable_get("\x6d\x69\x6e\x69\117\162\141\x6e\x67\145\x5f\x73\x61\x6d\154\137\x69\x64\160\x5f\165\x73\145\162\137\x63\157\165\x6e\x74");
        $iu = variable_get("\x6d\x69\x6e\x69\x4f\162\141\156\147\x65\x5f\163\141\155\x6c\137\x69\144\x70\137\154\137\x65\x78\160");
        $T2 = variable_get("\x74\x65\137\x63\157\165\x6e\164");
        $eo = variable_get("\x75\x65\x5f\x63\x6f\x75\156\164");
        $Ps = variable_get("\144\x63\x68\x65\143\153");
        $Vh = variable_get("\x74\x6d\x70\137\145\170\160");
        $vR = db_select("\x6d\151\156\x69\157\x72\x61\156\147\x65\x5f\x73\x61\155\x6c\137\151\144\x70\137\x75\x73\x65\162", "\x55\x73\145\x72\x49\x6e")->fields("\125\x73\145\x72\x49\156")->condition("\x55\163\x65\x72\x49\x6e", 1, "\75")->execute();
        $SN = $vR->rowCount();
        if ($xD) {
            goto CL;
        }
        if ($SN >= $XX) {
            goto hj;
        }
        $vR = db_select("\x6d\x69\156\x69\157\162\x61\x6e\x67\x65\x5f\x73\141\155\154\137\151\144\160\x5f\165\x73\145\162", "\x55\x73\145\162\x49\x6e")->fields("\x55\x73\145\162\x49\156")->condition("\155\x61\x69\154", $this->email, "\75")->execute();
        $hy = $vR->rowCount();
        if ($hy > 0) {
            goto me;
        }
        db_insert("\x6d\151\156\151\157\x72\141\x6e\147\x65\x5f\x73\x61\155\154\x5f\151\144\160\x5f\x75\163\145\x72")->fields(array("\155\x61\x69\154" => $this->email, "\x55\163\145\x72\x49\x6e" => 1))->execute();
        goto uT;
        me:
        $Kj = db_update("\x6d\151\x6e\151\x6f\x72\141\156\147\x65\137\x73\x61\x6d\154\137\151\144\x70\137\x75\163\145\x72")->fields(array("\x55\x73\x65\x72\x49\156" => 1))->condition("\x6d\141\x69\154", $this->email, "\x3d")->execute();
        uT:
        $SN = $SN + 1;
        $ci = floor($XX * 0.8);
        $IP = floor($XX * 0.9);
        if ($SN == $ci) {
            goto vm;
        }
        if ($SN == $IP) {
            goto u_;
        }
        if ($XX - $SN == 10) {
            goto NZ;
        }
        if (!($SN == $XX)) {
            goto vn;
        }
        if (Utilities::checkupdate($XX)) {
            goto Ed;
        }
        $Ps = 0;
        variable_set("\144\x63\150\145\x63\153", $Ps);
        variable_set("\x74\x6d\x70\137\x65\x78\x70", time() + 2592000);
        Utilities::limitreach($XX, $SN);
        goto er;
        Ed:
        return;
        er:
        vn:
        goto d0;
        NZ:
        if (Utilities::checkupdate($XX)) {
            goto pO;
        }
        Utilities::tenuser($XX, $SN);
        goto vc;
        pO:
        return;
        vc:
        d0:
        goto TZ;
        u_:
        if (Utilities::checkupdate($XX)) {
            goto Tc;
        }
        Utilities::peruser(90, $XX);
        goto oc;
        Tc:
        return;
        oc:
        TZ:
        goto Z2;
        vm:
        Utilities::peruser(80, $XX);
        Z2:
        goto GR;
        hj:
        $jR = abs($Vh - time()) / 60 / 60 / 24;
        if (!($jR != $Ps)) {
            goto l8;
        }
        if (!Utilities::checkupdate($XX)) {
            goto rY;
        }
        variable_set("\x75\145\x5f\x63\157\165\156\x74", 0);
        $vR = db_select("\155\x69\156\x69\157\162\x61\156\147\x65\137\163\141\155\154\x5f\x69\x64\160\137\165\x73\145\x72", "\125\163\145\162\x49\x6e")->fields("\125\x73\x65\162\111\156")->condition("\155\x61\151\154", $this->email, "\x3d")->execute();
        $hy = $vR->rowCount();
        if ($hy > 0) {
            goto mJ;
        }
        db_insert("\x6d\x69\156\151\157\x72\141\156\147\x65\x5f\x73\141\x6d\x6c\137\x69\x64\x70\x5f\165\x73\145\162")->fields(array("\155\x61\151\154" => $this->email, "\125\x73\145\162\x49\156" => 1))->execute();
        goto B_;
        mJ:
        $Kj = db_update("\155\x69\x6e\x69\x6f\x72\x61\x6e\x67\x65\x5f\x73\141\155\x6c\137\x69\144\160\137\x75\163\x65\162")->fields(array("\125\163\145\162\x49\x6e" => 1))->condition("\x6d\x61\151\x6c", $this->email, "\75")->execute();
        B_:
        rY:
        variable_set("\x64\x63\x68\x65\143\x6b", $jR);
        l8:
        if (time() < $Vh) {
            goto aX;
        }
        if (!($eo == 1)) {
            goto s9;
        }
        Utilities::limitend($XX);
        $eo++;
        variable_set("\165\x65\137\143\x6f\165\x6e\x74", $eo);
        s9:
        echo "\123\123\x4f\40\106\x61\151\x6c\145\144\x2e\40\115\141\x78\x69\x6d\x75\155\40\x6c\151\x6d\x69\x74\40\x72\x65\x61\x63\150\x65\144\56\40\x50\x6c\145\141\x73\145\x20\x63\157\156\164\141\x63\x74\40\x79\157\x75\x72\x20\101\x64\x6d\151\156\151\x73\x74\162\x61\x74\157\x72\40\146\157\162\40\x6d\157\162\145\40\144\145\x74\141\x69\154\163\56";
        die;
        goto jy;
        aX:
        if (!(time() > $Vh - 1296000 && $eo == 0)) {
            goto bT;
        }
        Utilities::limitmid($XX);
        $eo++;
        variable_set("\x75\145\137\x63\x6f\165\156\164", $eo);
        bT:
        return;
        jy:
        GR:
        goto we;
        CL:
        return;
        we:
    }
}
