<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $lg = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($lg === NULL)) {
            goto VY;
        }
        return;
        VY:
        $s1 = Utilities::validateElement($lg);
        if (!($s1 !== FALSE)) {
            goto pg;
        }
        $this->certificates = $s1["\x43\145\162\164\151\146\151\x63\x61\x74\145\163"];
        $this->signatureData = $s1;
        pg:
        if (!$lg->hasAttribute("\x44\x65\x73\x74\151\156\x61\x74\151\x6f\x6e")) {
            goto eM;
        }
        $this->destination = $lg->getAttribute("\104\x65\163\164\151\156\x61\x74\x69\157\x6e");
        eM:
        $fz = $lg->firstChild;
        zi:
        if (!($fz !== NULL)) {
            goto MG;
        }
        if (!($fz->namespaceURI !== "\x75\x72\156\x3a\157\141\x73\x69\163\x3a\156\141\x6d\145\x73\72\164\143\72\123\101\x4d\x4c\x3a\x32\x2e\x30\72\141\163\163\x65\162\164\151\157\x6e")) {
            goto wH;
        }
        goto G_;
        wH:
        if (!($fz->localName === "\x41\163\163\x65\x72\164\151\157\x6e" || $fz->localName === "\105\x6e\143\x72\x79\160\164\x65\144\x41\x73\x73\x65\162\x74\x69\x6f\156")) {
            goto M9;
        }
        $this->assertions[] = new SAML2_Assertion($fz);
        M9:
        G_:
        $fz = $fz->nextSibling;
        goto zi;
        MG:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $mf)
    {
        $this->assertions = $mf;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $P2 = parent::toUnsignedXML();
        foreach ($this->assertions as $xK) {
            $xK->toXML($P2);
            cR:
        }
        nv:
        return $P2;
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
