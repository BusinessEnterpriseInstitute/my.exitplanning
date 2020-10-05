<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $DP = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($DP === NULL)) {
            goto Xf;
        }
        return;
        Xf:
        $gx = Utilities::validateElement($DP);
        if (!($gx !== FALSE)) {
            goto GY;
        }
        $this->certificates = $gx["\103\x65\162\x74\x69\x66\x69\143\x61\164\x65\x73"];
        $this->signatureData = $gx;
        GY:
        if (!$DP->hasAttribute("\x44\x65\163\x74\x69\156\x61\164\x69\157\x6e")) {
            goto wb;
        }
        $this->destination = $DP->getAttribute("\104\145\x73\164\151\156\141\x74\151\157\x6e");
        wb:
        $sr = $DP->firstChild;
        B8:
        if (!($sr !== NULL)) {
            goto uD;
        }
        if (!($sr->namespaceURI !== "\x75\x72\156\x3a\157\141\x73\151\x73\x3a\156\141\155\145\163\72\164\x63\72\x53\101\x4d\114\72\x32\x2e\60\72\x61\x73\163\x65\x72\164\151\x6f\156")) {
            goto ng;
        }
        goto CH;
        ng:
        if (!($sr->localName === "\x41\x73\x73\x65\162\x74\x69\157\x6e" || $sr->localName === "\x45\x6e\143\x72\171\x70\x74\145\144\x41\163\x73\x65\162\164\x69\x6f\x6e")) {
            goto ed;
        }
        $this->assertions[] = new SAML2_Assertion($sr);
        ed:
        CH:
        $sr = $sr->nextSibling;
        goto B8;
        uD:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $x_)
    {
        $this->assertions = $x_;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $Eb = parent::toUnsignedXML();
        foreach ($this->assertions as $Tn) {
            $Tn->toXML($Eb);
            Wo:
        }
        B2:
        return $Eb;
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
