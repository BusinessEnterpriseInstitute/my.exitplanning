<?php


include_once "\125\x74\151\154\x69\164\151\x65\x73\x2e\160\x68\x70";
class SAML2_LogoutRequest
{
    private $tagName;
    private $id;
    private $issuer;
    private $destination;
    private $issueInstant;
    private $certificates;
    private $validators;
    private $notOnOrAfter;
    private $encryptedNameId;
    private $nameId;
    private $sessionIndexes;
    public function __construct(DOMElement $RH = NULL)
    {
        $this->tagName = "\114\157\x67\x6f\165\164\122\145\161\x75\x65\x73\x74";
        $this->id = Utilities::generateID();
        $this->issueInstant = time();
        $this->certificates = array();
        $this->validators = array();
        if (!($RH === NULL)) {
            goto d9;
        }
        return;
        d9:
        if ($RH->hasAttribute("\x49\x44")) {
            goto bU;
        }
        throw new Exception("\115\x69\163\163\151\156\147\40\x49\104\40\141\164\x74\x72\x69\142\165\x74\x65\40\157\x6e\40\x53\101\115\x4c\x20\155\x65\163\163\141\x67\145\x2e");
        bU:
        $this->id = $RH->getAttribute("\x49\104");
        if (!($RH->getAttribute("\126\x65\162\x73\151\157\156") !== "\62\56\60")) {
            goto sY;
        }
        throw new Exception("\x55\x6e\x73\x75\160\x70\x6f\x72\164\145\144\40\x76\x65\x72\163\x69\157\x6e\72\x20" . $RH->getAttribute("\x56\x65\x72\x73\151\x6f\x6e"));
        sY:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($RH->getAttribute("\111\x73\x73\165\x65\x49\156\163\x74\x61\156\164"));
        if (!$RH->hasAttribute("\x44\145\x73\164\x69\156\x61\164\x69\157\156")) {
            goto Xu;
        }
        $this->destination = $RH->getAttribute("\x44\145\x73\164\151\x6e\x61\x74\x69\157\156");
        Xu:
        $L1 = Utilities::xpQuery($RH, "\x2e\x2f\163\141\x6d\x6c\137\x61\x73\x73\145\x72\164\151\x6f\156\72\x49\x73\163\x75\145\162");
        if (empty($L1)) {
            goto EZ;
        }
        $this->issuer = trim($L1[0]->textContent);
        EZ:
        try {
            $Xh = Utilities::validateElement($RH);
            if (!($Xh !== FALSE)) {
                goto jl;
            }
            $this->certificates = $Xh["\x43\145\162\x74\x69\x66\x69\143\x61\x74\x65\163"];
            $this->validators[] = array("\106\165\x6e\143\164\x69\157\x6e" => array("\125\164\151\x6c\x69\164\151\x65\163", "\166\141\154\151\144\141\164\145\123\x69\x67\156\x61\x74\165\162\145"), "\x44\141\164\x61" => $Xh);
            jl:
        } catch (Exception $jC) {
        }
        $this->sessionIndexes = array();
        if (!$RH->hasAttribute("\x4e\x6f\x74\117\156\117\x72\101\146\x74\145\x72")) {
            goto lP;
        }
        $this->notOnOrAfter = Utilities::xsDateTimeToTimestamp($RH->getAttribute("\x4e\157\164\117\x6e\117\x72\x41\146\164\x65\162"));
        lP:
        $yM = Utilities::xpQuery($RH, "\x2e\x2f\163\141\x6d\x6c\137\141\x73\x73\x65\162\x74\x69\x6f\x6e\72\x4e\141\x6d\145\x49\x44\40\174\x20\x2e\57\x73\x61\x6d\x6c\x5f\141\x73\163\x65\162\164\x69\x6f\x6e\72\x45\x6e\143\162\x79\x70\164\145\144\x49\x44\57\x78\x65\x6e\x63\x3a\105\x6e\143\162\171\160\x74\x65\144\104\141\x74\x61");
        if (empty($yM)) {
            goto l9;
        }
        if (count($yM) > 1) {
            goto Ky;
        }
        goto hr;
        l9:
        throw new Exception("\115\x69\x73\x73\151\x6e\147\40\74\163\141\x6d\154\x3a\x4e\141\155\x65\111\x44\76\x20\x6f\x72\x20\74\163\x61\155\154\x3a\105\156\143\162\171\160\164\145\144\x49\104\x3e\x20\151\x6e\40\x3c\x73\x61\x6d\x6c\160\72\x4c\x6f\x67\157\165\x74\x52\145\x71\165\x65\163\164\x3e\56");
        goto hr;
        Ky:
        throw new Exception("\x4d\157\x72\x65\40\164\150\x61\x6e\x20\157\156\145\x20\74\x73\141\x6d\x6c\72\x4e\x61\155\x65\111\x44\x3e\x20\157\162\40\74\163\141\155\154\x3a\x45\156\x63\x72\x79\x70\x74\x65\x64\x44\x3e\x20\151\156\40\x3c\x73\141\x6d\154\160\72\x4c\x6f\x67\x6f\165\x74\x52\x65\x71\165\x65\x73\x74\x3e\56");
        hr:
        $yM = $yM[0];
        if ($yM->localName === "\x45\x6e\x63\x72\171\x70\x74\145\144\x44\141\x74\141") {
            goto f9;
        }
        $this->nameId = Utilities::parseNameId($yM);
        goto ly;
        f9:
        $this->encryptedNameId = $yM;
        ly:
        $nn = Utilities::xpQuery($RH, "\56\57\x73\141\x6d\154\x5f\160\162\x6f\x74\x6f\143\x6f\x6c\x3a\123\145\x73\x73\151\157\x6e\x49\156\x64\145\170");
        foreach ($nn as $u0) {
            $this->sessionIndexes[] = trim($u0->textContent);
            NF:
        }
        nv:
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($zH)
    {
        $this->notOnOrAfter = $zH;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto kK;
        }
        return TRUE;
        kK:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $z6)
    {
        $jF = new DOMDocument();
        $e0 = $jF->createElement("\162\x6f\x6f\164");
        $jF->appendChild($e0);
        SAML2_Utils::addNameId($e0, $this->nameId);
        $yM = $e0->firstChild;
        SAML2_Utils::getContainer()->debugMessage($yM, "\x65\x6e\x63\162\x79\x70\x74");
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
            goto Ru;
        }
        return;
        Ru:
        $yM = SAML2_Utils::decryptElement($this->encryptedNameId, $z6, $WO);
        SAML2_Utils::getContainer()->debugMessage($yM, "\x64\x65\143\162\x79\160\x74");
        $this->nameId = SAML2_Utils::parseNameId($yM);
        $this->encryptedNameId = NULL;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto B5;
        }
        throw new Exception("\101\x74\164\145\x6d\160\164\145\x64\40\164\157\x20\x72\145\x74\162\151\145\166\x65\40\x65\x6e\x63\x72\171\x70\x74\x65\144\x20\x4e\x61\155\x65\111\104\x20\167\151\164\x68\157\x75\x74\40\144\x65\143\x72\171\x70\164\151\156\x67\x20\x69\164\x20\x66\151\162\163\x74\56");
        B5:
        return $this->nameId;
    }
    public function setNameId($yM)
    {
        $this->nameId = $yM;
    }
    public function getSessionIndexes()
    {
        return $this->sessionIndexes;
    }
    public function setSessionIndexes(array $nn)
    {
        $this->sessionIndexes = $nn;
    }
    public function getSessionIndex()
    {
        if (!empty($this->sessionIndexes)) {
            goto Xl;
        }
        return NULL;
        Xl:
        return $this->sessionIndexes[0];
    }
    public function setSessionIndex($u0)
    {
        if (is_null($u0)) {
            goto aP;
        }
        $this->sessionIndexes = array($u0);
        goto z7;
        aP:
        $this->sessionIndexes = array();
        z7:
    }
    public function toUnsignedXML()
    {
        $e0 = parent::toUnsignedXML();
        if (!($this->notOnOrAfter !== NULL)) {
            goto OZ;
        }
        $e0->setAttribute("\x4e\157\164\x4f\156\117\x72\x41\146\164\145\162", gmdate("\x59\55\x6d\x2d\x64\134\124\x48\72\x69\x3a\163\134\x5a", $this->notOnOrAfter));
        OZ:
        if ($this->encryptedNameId === NULL) {
            goto TU;
        }
        $tl = $e0->ownerDocument->createElementNS(SAML2_Const::NS_SAML, "\x73\x61\x6d\154\x3a" . "\x45\156\x63\x72\x79\x70\164\x65\144\111\104");
        $e0->appendChild($tl);
        $tl->appendChild($e0->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto rB;
        TU:
        SAML2_Utils::addNameId($e0, $this->nameId);
        rB:
        foreach ($this->sessionIndexes as $u0) {
            SAML2_Utils::addString($e0, SAML2_Const::NS_SAMLP, "\123\145\x73\x73\151\157\156\111\156\144\145\170", $u0);
            m7:
        }
        Ki:
        return $e0;
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
    public function getDestination()
    {
        return $this->destination;
    }
    public function setDestination($vL)
    {
        $this->destination = $vL;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($L1)
    {
        $this->issuer = $L1;
    }
}
