<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $fk = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($fk === NULL)) {
            goto E8;
        }
        return;
        E8:
        $HD = Utilities::validateElement($fk);
        if (!($HD !== FALSE)) {
            goto cT;
        }
        $this->certificates = $HD["\103\145\162\164\x69\146\x69\x63\x61\x74\145\x73"];
        $this->signatureData = $HD;
        cT:
        if (!$fk->hasAttribute("\x44\145\163\x74\151\x6e\x61\x74\151\157\156")) {
            goto L0;
        }
        $this->destination = $fk->getAttribute("\x44\145\x73\164\x69\156\141\x74\151\x6f\x6e");
        L0:
        $JM = $fk->firstChild;
        hu:
        if (!($JM !== NULL)) {
            goto vR;
        }
        if (!($JM->namespaceURI !== "\x75\x72\156\x3a\157\141\163\x69\163\x3a\156\141\155\145\x73\x3a\164\x63\x3a\123\x41\x4d\114\72\62\56\60\x3a\141\x73\x73\145\x72\164\x69\x6f\x6e")) {
            goto eQ;
        }
        goto mq;
        eQ:
        if (!($JM->localName === "\x41\163\x73\x65\x72\x74\x69\x6f\x6e" || $JM->localName === "\x45\156\x63\x72\x79\160\164\145\144\101\x73\x73\145\x72\164\151\x6f\x6e")) {
            goto zb;
        }
        $this->assertions[] = new SAML2_Assertion($JM);
        zb:
        mq:
        $JM = $JM->nextSibling;
        goto hu;
        vR:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $OY)
    {
        $this->assertions = $OY;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $Gh = parent::toUnsignedXML();
        foreach ($this->assertions as $fA) {
            $fA->toXML($Gh);
            NM:
        }
        Np:
        return $Gh;
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
