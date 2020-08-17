<?php


class SAML2_Response
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $TW = NULL)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($TW === NULL)) {
            goto dH;
        }
        return;
        dH:
        $x1 = Utilities::validateElement($TW);
        if (!($x1 !== FALSE)) {
            goto jL;
        }
        $this->certificates = $x1["\x43\145\162\164\x69\x66\x69\143\141\164\145\x73"];
        $this->signatureData = $x1;
        jL:
        if (!$TW->hasAttribute("\x44\145\163\164\151\x6e\141\164\151\157\x6e")) {
            goto Q5;
        }
        $this->destination = $TW->getAttribute("\x44\145\163\x74\151\156\x61\x74\151\157\156");
        Q5:
        $FF = $TW->firstChild;
        fO:
        if (!($FF !== NULL)) {
            goto dR;
        }
        if (!($FF->namespaceURI !== "\x75\x72\x6e\x3a\x6f\x61\163\x69\x73\x3a\x6e\x61\155\145\x73\x3a\x74\x63\72\x53\101\115\114\x3a\62\x2e\60\72\141\x73\163\x65\x72\x74\151\157\x6e")) {
            goto cE;
        }
        goto jW;
        cE:
        if (!($FF->localName === "\x41\x73\x73\x65\x72\164\151\157\156" || $FF->localName === "\x45\x6e\143\162\171\x70\x74\145\x64\x41\x73\x73\x65\162\x74\x69\x6f\x6e")) {
            goto sK;
        }
        $this->assertions[] = new SAML2_Assertion($FF);
        sK:
        jW:
        $FF = $FF->nextSibling;
        goto fO;
        dR:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $pk)
    {
        $this->assertions = $pk;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $NQ = parent::toUnsignedXML();
        foreach ($this->assertions as $pv) {
            $pv->toXML($NQ);
            cG:
        }
        g5:
        return $NQ;
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
