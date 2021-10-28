<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $L_ = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($L_ === NULL)) {
            goto SD;
        }
        return;
        SD:
        $R3 = Utilities::validateElement($L_);
        if (!($R3 !== FALSE)) {
            goto fQ;
        }
        $this->certificates = $R3["\103\145\162\164\151\146\151\143\x61\164\145\163"];
        $this->signatureData = $R3;
        fQ:
        if (!$L_->hasAttribute("\104\x65\163\164\x69\156\141\164\x69\157\x6e")) {
            goto w0;
        }
        $this->destination = $L_->getAttribute("\104\145\163\164\x69\156\141\x74\x69\x6f\156");
        w0:
        $SP = $L_->firstChild;
        TB:
        if (!($SP !== NULL)) {
            goto JO;
        }
        if (!($SP->namespaceURI !== "\x75\x72\156\x3a\157\141\x73\x69\x73\72\156\x61\155\x65\x73\72\x74\x63\x3a\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\x61\163\163\145\162\164\151\157\x6e")) {
            goto tV;
        }
        goto MK;
        tV:
        if (!($SP->localName === "\101\x73\163\x65\x72\x74\x69\x6f\x6e" || $SP->localName === "\x45\x6e\143\x72\171\160\x74\145\144\x41\x73\x73\x65\162\164\151\157\x6e")) {
            goto C7;
        }
        $this->assertions[] = new SAML2_Assertion($SP);
        C7:
        MK:
        $SP = $SP->nextSibling;
        goto TB;
        JO:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $g8)
    {
        $this->assertions = $g8;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $V1 = parent::toUnsignedXML();
        foreach ($this->assertions as $RV) {
            $RV->toXML($V1);
            dS:
        }
        E3:
        return $V1;
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
