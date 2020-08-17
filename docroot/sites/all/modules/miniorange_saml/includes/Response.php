<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $uQ = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($uQ === NULL)) {
            goto mA;
        }
        return;
        mA:
        $Rd = Utilities::validateElement($uQ);
        if (!($Rd !== FALSE)) {
            goto l2;
        }
        $this->certificates = $Rd["\103\x65\x72\x74\151\146\x69\x63\141\x74\x65\163"];
        $this->signatureData = $Rd;
        l2:
        if (!$uQ->hasAttribute("\104\145\x73\x74\151\x6e\x61\164\x69\157\156")) {
            goto hM;
        }
        $this->destination = $uQ->getAttribute("\104\x65\x73\x74\151\156\141\164\151\x6f\156");
        hM:
        $oB = $uQ->firstChild;
        zj:
        if (!($oB !== NULL)) {
            goto za;
        }
        if (!($oB->namespaceURI !== "\165\x72\156\x3a\x6f\141\163\x69\163\x3a\x6e\x61\155\x65\x73\72\x74\x63\x3a\x53\101\115\114\72\x32\x2e\60\x3a\141\163\x73\x65\162\164\x69\x6f\156")) {
            goto re;
        }
        goto qi;
        re:
        if (!($oB->localName === "\x41\x73\163\x65\x72\164\x69\x6f\156" || $oB->localName === "\105\156\x63\162\x79\160\164\145\x64\x41\163\163\x65\162\x74\x69\157\156")) {
            goto pq;
        }
        $this->assertions[] = new SAML2_Assertion($oB);
        pq:
        qi:
        $oB = $oB->nextSibling;
        goto zj;
        za:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $jf)
    {
        $this->assertions = $jf;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $nv = parent::toUnsignedXML();
        foreach ($this->assertions as $wm) {
            $wm->toXML($nv);
            rs:
        }
        Q8:
        return $nv;
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
