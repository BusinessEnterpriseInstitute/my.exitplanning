<?php


class AuthnRequest
{
    private $nameIdPolicy;
    private $forceAuthn;
    private $isPassive;
    private $RequesterID = array();
    private $assertionConsumerServiceURL;
    private $protocolBinding;
    private $requestedAuthnContext;
    private $namespaceURI;
    private $destination;
    private $issuer;
    private $version;
    private $issueInstant;
    private $requestID;
    public function __construct(DOMElement $RH = null)
    {
        $this->nameIdPolicy = array();
        $this->forceAuthn = false;
        $this->isPassive = false;
        if (!($RH === null)) {
            goto zX;
        }
        return;
        zX:
        $this->forceAuthn = Utilities::parseBoolean($RH, "\106\157\162\143\145\x41\x75\164\150\x6e", false);
        $this->isPassive = Utilities::parseBoolean($RH, "\x49\163\x50\x61\x73\x73\x69\x76\x65", false);
        if (!$RH->hasAttribute("\101\x73\x73\145\162\x74\x69\157\156\x43\157\156\163\165\x6d\x65\x72\x53\145\162\166\151\143\145\125\x52\x4c")) {
            goto rw;
        }
        $this->assertionConsumerServiceURL = $RH->getAttribute("\101\163\163\x65\162\164\151\157\x6e\x43\157\156\163\165\155\145\162\123\145\162\x76\151\x63\145\125\122\114");
        rw:
        if (!$RH->hasAttribute("\120\162\x6f\164\157\143\157\154\x42\x69\156\144\x69\156\147")) {
            goto gb;
        }
        $this->protocolBinding = $RH->getAttribute("\120\x72\157\x74\157\x63\x6f\154\x42\151\x6e\144\x69\156\x67");
        gb:
        if (!$RH->hasAttribute("\101\x74\x74\x72\151\x62\x75\x74\x65\x43\x6f\x6e\163\x75\155\151\156\x67\x53\145\162\166\x69\x63\x65\111\x6e\144\145\170")) {
            goto FY;
        }
        $this->attributeConsumingServiceIndex = (int) $RH->getAttribute("\101\164\x74\x72\x69\x62\x75\164\145\x43\x6f\156\163\165\155\x69\x6e\x67\x53\145\162\x76\x69\x63\145\x49\156\x64\x65\x78");
        FY:
        if (!$RH->hasAttribute("\101\x73\x73\145\162\x74\151\157\x6e\103\x6f\156\x73\165\x6d\x65\162\x53\x65\162\x76\x69\x63\x65\111\156\144\145\170")) {
            goto YC;
        }
        $this->assertionConsumerServiceIndex = (int) $RH->getAttribute("\x41\163\x73\x65\x72\x74\151\x6f\156\x43\x6f\x6e\x73\165\155\x65\x72\x53\145\x72\x76\x69\143\x65\111\156\x64\145\x78");
        YC:
        if (!$RH->hasAttribute("\104\x65\163\164\x69\x6e\141\164\151\x6f\156")) {
            goto mz;
        }
        $this->destination = $RH->getAttribute("\x44\x65\x73\164\151\x6e\141\164\x69\x6f\156");
        mz:
        if (!isset($RH->namespaceURI)) {
            goto zP;
        }
        $this->namespaceURI = $RH->namespaceURI;
        zP:
        if (!$RH->hasAttribute("\x56\x65\162\163\151\157\x6e")) {
            goto l0;
        }
        $this->version = $RH->getAttribute("\126\145\162\163\151\157\x6e");
        l0:
        if (!$RH->hasAttribute("\111\163\163\x75\145\111\x6e\x73\x74\141\x6e\164")) {
            goto jU;
        }
        $this->issueInstant = $RH->getAttribute("\x49\163\163\165\145\x49\156\x73\164\x61\x6e\x74");
        jU:
        if (!$RH->hasAttribute("\111\104")) {
            goto Om;
        }
        $this->requestID = $RH->getAttribute("\111\x44");
        Om:
        $this->parseNameIdPolicy($RH);
        $this->parseIssuer($RH);
        $this->parseRequestedAuthnContext($RH);
        $this->parseScoping($RH);
    }
    public function getNameIdPolicy()
    {
        return $this->nameIdPolicy;
    }
    public function getForceAuthn()
    {
        return $this->forceAuthn;
    }
    public function getVersion()
    {
        return $this->version;
    }
    public function getRequestID()
    {
        return $this->requestID;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function getIsPassive()
    {
        return $this->isPassive;
    }
    public function getIDPList()
    {
        return $this->IDPList;
    }
    public function getProxyCount()
    {
        return $this->ProxyCount;
    }
    public function getRequesterID()
    {
        return $this->RequesterID;
    }
    public function getNamespaceURI()
    {
        return $this->namespaceURI;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function getAssertionConsumerServiceURL()
    {
        return $this->assertionConsumerServiceURL;
    }
    public function getProtocolBinding()
    {
        return $this->protocolBinding;
    }
    public function getAttributeConsumingServiceIndex()
    {
        return $this->attributeConsumingServiceIndex;
    }
    public function getAssertionConsumerServiceIndex()
    {
        return $this->assertionConsumerServiceIndex;
    }
    public function getRequestedAuthnContext()
    {
        return $this->requestedAuthnContext;
    }
    protected function parseIssuer(DOMElement $RH)
    {
        $L1 = Utilities::xpQuery($RH, "\x2e\57\x73\141\155\154\137\141\163\163\x65\162\x74\x69\x6f\x6e\72\x49\163\163\x75\145\162");
        if (!empty($L1)) {
            goto C_;
        }
        throw new Exception("\x4d\151\x73\x73\x69\x6e\x67\40\74\x73\141\155\154\72\x49\x73\x73\165\145\x72\x3e\40\151\x6e\x20\x61\x73\x73\x65\x72\164\x69\x6f\x6e\x2e");
        C_:
        $this->issuer = trim($L1[0]->textContent);
    }
    protected function parseNameIdPolicy(DOMElement $RH)
    {
        $vb = Utilities::xpQuery($RH, "\56\57\x73\x61\155\x6c\137\160\x72\157\x74\x6f\x63\x6f\x6c\72\x4e\x61\155\145\x49\x44\x50\157\154\151\x63\x79");
        if (!empty($vb)) {
            goto CC;
        }
        return;
        CC:
        $vb = $vb[0];
        if (!$vb->hasAttribute("\106\157\x72\x6d\x61\164")) {
            goto OM;
        }
        $this->nameIdPolicy["\106\157\162\155\141\x74"] = $vb->getAttribute("\106\x6f\x72\155\141\164");
        OM:
        if (!$vb->hasAttribute("\123\120\x4e\141\155\x65\121\x75\x61\154\x69\146\151\x65\x72")) {
            goto u1;
        }
        $this->nameIdPolicy["\x53\x50\116\x61\155\145\121\165\141\154\x69\x66\x69\145\162"] = $vb->getAttribute("\123\120\x4e\x61\x6d\x65\121\x75\141\x6c\151\x66\151\145\x72");
        u1:
        if (!$vb->hasAttribute("\x41\154\x6c\157\167\103\162\145\141\x74\145")) {
            goto s4;
        }
        $this->nameIdPolicy["\101\154\154\157\167\103\x72\145\141\164\x65"] = Utilities::parseBoolean($vb, "\101\154\154\x6f\x77\x43\x72\145\x61\x74\145", false);
        s4:
    }
    protected function parseRequestedAuthnContext(DOMElement $RH)
    {
        $GD = Utilities::xpQuery($RH, "\x2e\57\x73\x61\x6d\x6c\137\x70\x72\157\164\157\x63\157\x6c\x3a\x52\x65\161\x75\145\163\x74\145\x64\101\x75\164\150\x6e\x43\157\156\x74\x65\170\164");
        if (!empty($GD)) {
            goto Oe;
        }
        return;
        Oe:
        $GD = $GD[0];
        $vs = array("\101\x75\x74\150\x6e\103\157\x6e\x74\145\x78\164\x43\154\141\163\x73\122\x65\146" => array(), "\103\x6f\x6d\160\x61\x72\x69\x73\x6f\x6e" => "\145\x78\141\143\x74");
        $AV = Utilities::xpQuery($GD, "\x2e\57\163\x61\155\x6c\x5f\141\x73\163\x65\x72\x74\151\x6f\x6e\x3a\101\165\x74\x68\156\x43\157\156\164\x65\170\164\x43\154\x61\163\163\122\145\x66");
        foreach ($AV as $qK) {
            $vs["\101\165\x74\x68\x6e\x43\157\x6e\x74\145\x78\164\103\x6c\x61\x73\163\x52\x65\146"][] = trim($qK->textContent);
            en:
        }
        mA:
        if (!$GD->hasAttribute("\x43\x6f\155\160\141\x72\x69\163\157\156")) {
            goto PB;
        }
        $vs["\x43\x6f\x6d\160\x61\162\x69\x73\x6f\156"] = $GD->getAttribute("\x43\157\155\160\x61\162\x69\x73\x6f\156");
        PB:
        $this->requestedAuthnContext = $vs;
    }
    protected function parseScoping(DOMElement $RH)
    {
        $P1 = Utilities::xpQuery($RH, "\x2e\x2f\x73\x61\x6d\x6c\x5f\x70\162\x6f\164\x6f\x63\157\x6c\x3a\123\143\x6f\160\151\x6e\x67");
        if (!empty($P1)) {
            goto gG;
        }
        return;
        gG:
        $P1 = $P1[0];
        if (!$P1->hasAttribute("\120\x72\157\170\x79\103\x6f\165\156\x74")) {
            goto gS;
        }
        $this->ProxyCount = (int) $P1->getAttribute("\x50\162\x6f\170\x79\103\x6f\165\156\x74");
        gS:
        $DP = Utilities::xpQuery($P1, "\56\x2f\x73\141\x6d\154\137\160\x72\x6f\164\x6f\x63\157\154\x3a\111\104\x50\x4c\x69\163\164\x2f\163\141\155\x6c\x5f\x70\162\157\164\x6f\143\157\x6c\72\x49\x44\120\x45\x6e\x74\x72\x79");
        foreach ($DP as $aj) {
            if ($aj->hasAttribute("\120\162\x6f\x76\151\144\x65\162\x49\x44")) {
                goto kk;
            }
            throw new Exception("\103\157\165\154\144\40\156\157\164\x20\147\x65\x74\x20\x50\162\157\166\151\144\145\x72\x49\104\40\x66\x72\157\155\40\x53\x63\x6f\160\x69\156\x67\x2f\x49\104\x50\x45\x6e\x74\x72\x79\40\x65\154\145\x6d\x65\x6e\164\x20\151\156\x20\101\165\164\150\156\x52\x65\161\x75\145\163\164\x20\x6f\142\x6a\x65\143\164");
            kk:
            $this->IDPList[] = $aj->getAttribute("\x50\x72\157\166\151\144\145\x72\111\104");
            nw:
        }
        NI:
        $HF = Utilities::xpQuery($P1, "\x2e\x2f\163\x61\155\154\137\x70\162\x6f\164\157\143\x6f\154\x3a\x52\145\x71\x75\x65\x73\x74\x65\162\x49\x44");
        foreach ($HF as $C7) {
            $this->RequesterID[] = trim($C7->textContent);
            RO:
        }
        dd:
    }
}
