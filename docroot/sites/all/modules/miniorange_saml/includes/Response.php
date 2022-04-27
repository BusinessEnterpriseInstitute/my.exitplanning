<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $Tr = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($Tr === NULL)) {
            goto k9;
        }
        return;
        k9:
        $QH = Utilities::validateElement($Tr);
        if (!($QH !== FALSE)) {
            goto wg;
        }
        $this->certificates = $QH["\103\x65\162\x74\151\146\151\143\x61\164\145\163"];
        $this->signatureData = $QH;
        wg:
        if (!$Tr->hasAttribute("\104\145\x73\x74\151\156\x61\164\x69\x6f\156")) {
            goto Dy;
        }
        $this->destination = $Tr->getAttribute("\x44\145\x73\x74\151\156\x61\164\x69\x6f\156");
        Dy:
        $y2 = $Tr->firstChild;
        yf:
        if (!($y2 !== NULL)) {
            goto RS;
        }
        if (!($y2->namespaceURI !== "\x75\162\x6e\72\157\x61\163\151\163\72\156\x61\155\145\163\x3a\164\143\72\x53\x41\115\114\x3a\62\56\60\72\x61\x73\163\145\x72\164\151\x6f\x6e")) {
            goto So;
        }
        goto WW;
        So:
        if (!($y2->localName === "\101\163\x73\145\x72\164\151\x6f\x6e" || $y2->localName === "\105\x6e\143\162\171\160\x74\x65\x64\101\163\x73\145\162\164\x69\x6f\156")) {
            goto jR;
        }
        $this->assertions[] = new SAML2_Assertion($y2);
        jR:
        WW:
        $y2 = $y2->nextSibling;
        goto yf;
        RS:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $mE)
    {
        $this->assertions = $mE;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $uw = parent::toUnsignedXML();
        foreach ($this->assertions as $kV) {
            $kV->toXML($uw);
            O6:
        }
        SB:
        return $uw;
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
