<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $Oe = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($Oe === NULL)) {
            goto HD;
        }
        return;
        HD:
        $sP = Utilities::validateElement($Oe);
        if (!($sP !== FALSE)) {
            goto J5;
        }
        $this->certificates = $sP["\x43\x65\162\164\151\146\x69\143\x61\164\x65\x73"];
        $this->signatureData = $sP;
        J5:
        if (!$Oe->hasAttribute("\x44\145\x73\x74\x69\x6e\141\164\x69\x6f\x6e")) {
            goto DL;
        }
        $this->destination = $Oe->getAttribute("\x44\x65\x73\164\151\x6e\x61\164\151\157\x6e");
        DL:
        $cV = $Oe->firstChild;
        CN:
        if (!($cV !== NULL)) {
            goto ET;
        }
        if (!($cV->namespaceURI !== "\x75\162\156\72\157\x61\163\151\x73\72\156\141\155\x65\163\x3a\164\x63\72\123\x41\115\x4c\x3a\x32\56\60\x3a\141\x73\x73\x65\162\164\151\x6f\x6e")) {
            goto iP;
        }
        goto Fb;
        iP:
        if (!($cV->localName === "\101\x73\x73\x65\x72\x74\x69\x6f\x6e" || $cV->localName === "\105\x6e\143\162\x79\x70\x74\x65\x64\101\x73\x73\x65\162\164\x69\157\x6e")) {
            goto zu;
        }
        $this->assertions[] = new SAML2_Assertion($cV);
        zu:
        Fb:
        $cV = $cV->nextSibling;
        goto CN;
        ET:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $Kw)
    {
        $this->assertions = $Kw;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $uc = parent::toUnsignedXML();
        foreach ($this->assertions as $fv) {
            $fv->toXML($uc);
            Bt:
        }
        Bf:
        return $uc;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
}
