<?php


include "\x41\163\163\x65\x72\164\151\157\156\x2e\160\150\x70";
class SAML2_Response
{
    private $assertions;
    private $destination;
    public function __construct(DOMElement $RH = NULL)
    {
        $this->assertions = array();
        if (!($RH === NULL)) {
            goto tE;
        }
        return;
        tE:
        if (!$RH->hasAttribute("\104\x65\x73\164\151\x6e\x61\x74\x69\157\156")) {
            goto WH;
        }
        $this->destination = $RH->getAttribute("\x44\x65\x73\164\151\156\x61\164\x69\157\156");
        WH:
        $Bu = $RH->firstChild;
        aj:
        if (!($Bu !== NULL)) {
            goto vs;
        }
        if (!($Bu->namespaceURI !== "\165\162\156\x3a\157\141\x73\x69\x73\72\x6e\x61\155\x65\163\72\x74\143\72\x53\x41\x4d\x4c\72\62\56\x30\x3a\x61\x73\163\x65\162\x74\x69\157\156")) {
            goto Qt;
        }
        goto I0;
        Qt:
        if (!($Bu->localName === "\101\x73\x73\145\x72\164\151\x6f\156" || $Bu->localName === "\105\156\143\162\x79\x70\x74\145\x64\x41\x73\x73\145\162\164\x69\x6f\x6e")) {
            goto Bo;
        }
        $this->assertions[] = new SAML2_Assertion($Bu);
        Bo:
        I0:
        $Bu = $Bu->nextSibling;
        goto aj;
        vs:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $Ql)
    {
        $this->assertions = $Ql;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $e0 = parent::toUnsignedXML();
        foreach ($this->assertions as $bg) {
            $bg->toXML($e0);
            QP:
        }
        xw:
        return $e0;
    }
}
