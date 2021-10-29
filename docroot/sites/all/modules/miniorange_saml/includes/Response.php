<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $p3 = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($p3 === NULL)) {
            goto vt;
        }
        return;
        vt:
        $ja = Utilities::validateElement($p3);
        if (!($ja !== FALSE)) {
            goto R1;
        }
        $this->certificates = $ja["\103\145\x72\164\151\146\151\143\x61\x74\x65\x73"];
        $this->signatureData = $ja;
        R1:
        if (!$p3->hasAttribute("\x44\145\x73\164\151\156\141\x74\151\157\x6e")) {
            goto tL;
        }
        $this->destination = $p3->getAttribute("\x44\x65\x73\x74\151\x6e\x61\x74\151\x6f\156");
        tL:
        $OZ = $p3->firstChild;
        BU:
        if (!($OZ !== NULL)) {
            goto YF;
        }
        if (!($OZ->namespaceURI !== "\165\162\156\72\x6f\x61\x73\x69\x73\x3a\x6e\141\155\x65\163\x3a\164\143\x3a\x53\x41\115\x4c\x3a\x32\56\x30\72\141\163\x73\x65\x72\x74\151\157\156")) {
            goto QL;
        }
        goto a2;
        QL:
        if (!($OZ->localName === "\101\163\x73\x65\162\164\x69\x6f\156" || $OZ->localName === "\105\x6e\143\x72\x79\160\x74\x65\144\x41\x73\x73\x65\162\x74\151\x6f\x6e")) {
            goto bo;
        }
        $this->assertions[] = new SAML2_Assertion($OZ);
        bo:
        a2:
        $OZ = $OZ->nextSibling;
        goto BU;
        YF:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $sg)
    {
        $this->assertions = $sg;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $QR = parent::toUnsignedXML();
        foreach ($this->assertions as $Tn) {
            $Tn->toXML($QR);
            bP:
        }
        Qm:
        return $QR;
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
