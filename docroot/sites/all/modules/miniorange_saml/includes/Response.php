<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $r2 = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($r2 === NULL)) {
            goto OD;
        }
        return;
        OD:
        $G0 = Utilities::validateElement($r2);
        if (!($G0 !== FALSE)) {
            goto zi;
        }
        $this->certificates = $G0["\103\145\x72\164\x69\x66\x69\x63\x61\164\145\163"];
        $this->signatureData = $G0;
        zi:
        if (!$r2->hasAttribute("\x44\145\x73\164\x69\x6e\141\x74\x69\157\x6e")) {
            goto wh;
        }
        $this->destination = $r2->getAttribute("\x44\145\x73\164\151\x6e\x61\x74\x69\157\156");
        wh:
        $fr = $r2->firstChild;
        SU:
        if (!($fr !== NULL)) {
            goto VI;
        }
        if (!($fr->namespaceURI !== "\165\162\156\72\x6f\141\163\x69\x73\x3a\156\141\x6d\145\x73\x3a\164\x63\72\x53\101\115\114\72\x32\x2e\60\72\x61\163\163\145\162\x74\x69\x6f\156")) {
            goto dt;
        }
        goto mu;
        dt:
        if (!($fr->localName === "\101\x73\x73\145\162\x74\151\x6f\156" || $fr->localName === "\x45\156\x63\x72\x79\x70\164\145\x64\101\163\x73\145\x72\x74\x69\157\156")) {
            goto YO;
        }
        $this->assertions[] = new SAML2_Assertion($fr);
        YO:
        mu:
        $fr = $fr->nextSibling;
        goto SU;
        VI:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $MS)
    {
        $this->assertions = $MS;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $qs = parent::toUnsignedXML();
        foreach ($this->assertions as $iZ) {
            $iZ->toXML($qs);
            g5:
        }
        Mv:
        return $qs;
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
