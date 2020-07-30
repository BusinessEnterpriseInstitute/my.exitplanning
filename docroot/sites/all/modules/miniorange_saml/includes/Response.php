<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $ln = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($ln === NULL)) {
            goto O5;
        }
        return;
        O5:
        $ht = Utilities::validateElement($ln);
        if (!($ht !== FALSE)) {
            goto um;
        }
        $this->certificates = $ht["\x43\x65\x72\x74\151\x66\151\143\141\x74\x65\163"];
        $this->signatureData = $ht;
        um:
        if (!$ln->hasAttribute("\x44\145\x73\164\151\156\141\x74\x69\x6f\x6e")) {
            goto Ez;
        }
        $this->destination = $ln->getAttribute("\104\145\x73\164\151\x6e\x61\x74\151\157\156");
        Ez:
        $Cz = $ln->firstChild;
        lX:
        if (!($Cz !== NULL)) {
            goto S6;
        }
        if (!($Cz->namespaceURI !== "\x75\162\x6e\72\157\x61\163\x69\163\x3a\156\x61\155\145\x73\72\164\x63\x3a\123\101\115\114\72\x32\x2e\60\72\141\x73\x73\x65\162\164\151\x6f\156")) {
            goto C_;
        }
        goto z7;
        C_:
        if (!($Cz->localName === "\x41\x73\163\x65\x72\164\x69\x6f\x6e" || $Cz->localName === "\x45\156\x63\x72\x79\x70\164\x65\144\x41\163\163\145\x72\164\151\157\x6e")) {
            goto cx;
        }
        $this->assertions[] = new SAML2_Assertion($Cz);
        cx:
        z7:
        $Cz = $Cz->nextSibling;
        goto lX;
        S6:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $vZ)
    {
        $this->assertions = $vZ;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $t2 = parent::toUnsignedXML();
        foreach ($this->assertions as $lB) {
            $lB->toXML($t2);
            ho:
        }
        I6:
        return $t2;
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
