<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $ln = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $e7 = Utilities::xpQuery($ln, "\x2e\x2f\x73\141\155\154\137\x6d\145\164\x61\x64\x61\164\x61\x3a\x45\156\x74\x69\164\x79\x44\145\163\x63\x72\151\x70\x74\x6f\x72");
        foreach ($e7 as $L1) {
            $nG = Utilities::xpQuery($L1, "\x2e\x2f\x73\141\x6d\154\x5f\x6d\145\x74\141\144\x61\164\x61\72\111\104\x50\123\x53\x4f\x44\x65\163\143\162\x69\x70\x74\x6f\162");
            if (!(isset($nG) && !empty($nG))) {
                goto Gk;
            }
            array_push($this->identityProviders, new IdentityProviders($L1));
            Gk:
            Pu:
        }
        D4:
    }
    public function getIdentityProviders()
    {
        return $this->identityProviders;
    }
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }
}
class IdentityProviders
{
    private $idpName;
    private $entityID;
    private $loginDetails;
    private $logoutDetails;
    private $signingCertificate;
    private $encryptionCertificate;
    private $signedRequest;
    public function __construct(DOMElement $ln = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$ln->hasAttribute("\145\x6e\164\x69\x74\x79\111\104")) {
            goto lj;
        }
        $this->entityID = $ln->getAttribute("\x65\x6e\164\x69\x74\171\111\104");
        lj:
        if (!$ln->hasAttribute("\x57\x61\156\164\x41\165\x74\150\x6e\x52\145\x71\165\x65\x73\164\x73\123\151\147\x6e\145\x64")) {
            goto W2;
        }
        $this->signedRequest = $ln->getAttribute("\127\x61\156\x74\101\x75\x74\150\156\122\x65\x71\x75\145\x73\x74\x73\x53\x69\x67\156\145\x64");
        W2:
        $nG = Utilities::xpQuery($ln, "\x2e\x2f\163\x61\x6d\x6c\137\x6d\145\x74\x61\144\x61\164\141\72\111\x44\x50\123\x53\117\104\x65\163\x63\162\x69\160\164\x6f\162");
        if (count($nG) > 1) {
            goto kM;
        }
        if (empty($nG)) {
            goto KI;
        }
        goto c7;
        kM:
        throw new Exception("\115\x6f\162\145\x20\x74\x68\141\x6e\40\x6f\x6e\145\40\74\111\104\120\x53\123\x4f\104\x65\x73\x63\162\x69\x70\164\x6f\162\x3e\40\x69\x6e\x20\74\105\156\x74\x69\x74\171\104\145\x73\143\162\x69\x70\164\x6f\162\x3e\x2e");
        goto c7;
        KI:
        throw new Exception("\115\151\163\163\151\x6e\147\40\162\145\x71\x75\x69\162\x65\144\40\74\111\104\x50\x53\x53\x4f\x44\145\x73\x63\162\x69\160\x74\157\162\x3e\x20\x69\x6e\x20\x3c\105\156\x74\151\164\171\x44\145\163\x63\x72\x69\x70\164\157\162\x3e\x2e");
        c7:
        $rX = $nG[0];
        $AA = Utilities::xpQuery($ln, "\56\x2f\x73\141\x6d\x6c\x5f\x6d\145\164\141\144\x61\164\x61\72\x45\x78\164\145\156\x73\x69\157\156\x73");
        if (!$AA) {
            goto ji;
        }
        $this->parseInfo($rX);
        ji:
        $this->parseSSOService($rX);
        $this->parseSLOService($rX);
        $this->parsex509Certificate($rX);
    }
    private function parseInfo($ln)
    {
        $Q8 = Utilities::xpQuery($ln, "\56\x2f\x6d\144\165\x69\72\x55\111\111\x6e\146\x6f\x2f\x6d\x64\165\x69\x3a\104\151\x73\x70\x6c\141\171\116\141\x6d\145");
        foreach ($Q8 as $m9) {
            if (!($m9->hasAttribute("\170\155\154\x3a\154\x61\156\x67") && $m9->getAttribute("\x78\x6d\154\x3a\154\x61\156\147") == "\x65\x6e")) {
                goto RX;
            }
            $this->idpName = $m9->textContent;
            RX:
            Dg:
        }
        oJ:
    }
    private function parseSSOService($ln)
    {
        $Q_ = Utilities::xpQuery($ln, "\56\57\x73\141\155\x6c\x5f\x6d\x65\x74\141\x64\x61\164\x61\x3a\123\151\x6e\147\154\x65\x53\x69\x67\x6e\x4f\x6e\123\145\162\166\151\x63\145");
        foreach ($Q_ as $vh) {
            $ji = str_replace("\165\162\156\72\x6f\x61\163\x69\163\72\x6e\x61\x6d\x65\x73\72\164\143\72\123\101\115\x4c\x3a\62\x2e\x30\x3a\142\151\x6e\144\x69\x6e\147\x73\72", '', $vh->getAttribute("\x42\x69\156\x64\x69\x6e\x67"));
            $this->loginDetails = array_merge($this->loginDetails, array($ji => $vh->getAttribute("\x4c\x6f\143\x61\x74\x69\157\x6e")));
            NV:
        }
        u8:
    }
    private function parseSLOService($ln)
    {
        $ph = Utilities::xpQuery($ln, "\56\57\x73\x61\x6d\x6c\137\155\145\x74\141\x64\141\164\x61\x3a\123\x69\x6e\x67\x6c\145\x4c\157\x67\157\x75\164\x53\x65\162\x76\151\143\x65");
        foreach ($ph as $xi) {
            $ji = str_replace("\x75\x72\x6e\x3a\x6f\141\x73\151\x73\72\x6e\x61\x6d\x65\163\x3a\164\143\72\x53\101\115\114\72\62\x2e\x30\x3a\142\151\156\144\151\x6e\147\163\72", '', $xi->getAttribute("\102\151\x6e\x64\151\156\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($ji => $xi->getAttribute("\x4c\157\x63\x61\164\151\x6f\156")));
            ck:
        }
        vm:
    }
    private function parsex509Certificate($ln)
    {
        foreach (Utilities::xpQuery($ln, "\x2e\57\x73\x61\155\x6c\137\155\x65\x74\x61\x64\x61\164\x61\72\113\145\171\104\145\x73\x63\162\151\x70\164\157\162") as $PT) {
            if ($PT->hasAttribute("\x75\x73\145")) {
                goto yU;
            }
            $this->parseSigningCertificate($PT);
            goto Ad;
            yU:
            if ($PT->getAttribute("\165\163\x65") == "\x65\156\143\x72\x79\x70\x74\151\157\156") {
                goto eC;
            }
            $this->parseSigningCertificate($PT);
            goto e8;
            eC:
            $this->parseEncryptionCertificate($PT);
            e8:
            Ad:
            rb:
        }
        e5:
    }
    private function parseSigningCertificate($ln)
    {
        $Ur = Utilities::xpQuery($ln, "\x2e\x2f\x64\163\72\113\x65\171\x49\x6e\146\157\57\x64\163\72\x58\x35\x30\71\x44\141\164\x61\57\x64\163\72\x58\65\x30\71\103\145\162\164\x69\x66\151\x63\x61\164\x65");
        $xw = trim($Ur[0]->textContent);
        $xw = str_replace(array("\xd", "\xa", "\11", "\40"), '', $xw);
        if (empty($Ur)) {
            goto UX;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($xw));
        UX:
    }
    private function parseEncryptionCertificate($ln)
    {
        $Ur = Utilities::xpQuery($ln, "\56\x2f\144\x73\x3a\113\x65\x79\x49\x6e\x66\x6f\x2f\144\x73\72\x58\x35\x30\x39\x44\141\x74\x61\57\x64\x73\x3a\x58\65\60\71\x43\x65\162\x74\151\x66\151\143\x61\164\x65");
        $xw = trim($Ur[0]->textContent);
        $xw = str_replace(array("\15", "\xa", "\x9", "\40"), '', $xw);
        if (empty($Ur)) {
            goto rt;
        }
        array_push($this->encryptionCertificate, $xw);
        rt:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($ji)
    {
        return $this->loginDetails[$ji];
    }
    public function getLogoutURL($ji)
    {
        return isset($this->logoutDetails[$ji]) ? $this->logoutDetails[$ji] : '';
    }
    public function getLoginDetails()
    {
        return $this->loginDetails;
    }
    public function getLogoutDetails()
    {
        return $this->logoutDetails;
    }
    public function getSigningCertificate()
    {
        return $this->signingCertificate;
    }
    public function getEncryptionCertificate()
    {
        return $this->encryptionCertificate[0];
    }
    public function isRequestSigned()
    {
        return $this->signedRequest;
    }
}
class ServiceProviders
{
}
