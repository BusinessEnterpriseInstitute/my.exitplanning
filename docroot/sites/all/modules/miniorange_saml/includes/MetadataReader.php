<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $lg = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $KN = Utilities::xpQuery($lg, "\x2e\57\163\141\x6d\154\137\x6d\145\x74\141\x64\141\x74\x61\x3a\x45\156\164\x69\164\x79\104\x65\x73\143\162\x69\160\164\x6f\162");
        foreach ($KN as $W5) {
            $gd = Utilities::xpQuery($W5, "\x2e\x2f\163\141\155\154\137\155\x65\x74\141\144\x61\x74\141\x3a\111\104\120\x53\123\117\104\145\x73\143\x72\x69\160\164\x6f\162");
            if (!(isset($gd) && !empty($gd))) {
                goto H_;
            }
            array_push($this->identityProviders, new IdentityProviders($W5));
            H_:
            qQ:
        }
        g7:
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
    public function __construct(DOMElement $lg = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$lg->hasAttribute("\x65\x6e\164\x69\x74\171\x49\x44")) {
            goto zd;
        }
        $this->entityID = $lg->getAttribute("\145\x6e\164\151\164\171\111\x44");
        zd:
        if (!$lg->hasAttribute("\x57\x61\x6e\164\101\x75\164\150\156\x52\x65\x71\x75\145\163\164\163\123\x69\x67\156\145\x64")) {
            goto ip;
        }
        $this->signedRequest = $lg->getAttribute("\x57\141\156\164\x41\x75\164\x68\156\122\x65\x71\165\145\163\164\163\123\151\147\156\145\144");
        ip:
        $gd = Utilities::xpQuery($lg, "\x2e\57\x73\141\x6d\154\x5f\x6d\145\164\141\144\x61\164\141\x3a\111\x44\x50\123\x53\117\104\x65\x73\143\x72\151\x70\164\x6f\162");
        if (count($gd) > 1) {
            goto Sf;
        }
        if (empty($gd)) {
            goto kv;
        }
        goto hT;
        Sf:
        throw new Exception("\115\x6f\x72\x65\40\164\150\141\x6e\40\157\x6e\x65\40\x3c\111\104\120\x53\123\117\x44\x65\163\143\162\151\x70\164\x6f\x72\76\x20\x69\x6e\x20\74\x45\x6e\164\x69\x74\171\x44\145\163\x63\162\x69\x70\x74\x6f\162\76\x2e");
        goto hT;
        kv:
        throw new Exception("\x4d\151\163\x73\x69\x6e\x67\40\162\x65\161\x75\x69\162\145\144\x20\x3c\x49\104\x50\123\x53\117\x44\145\163\x63\x72\151\x70\164\x6f\x72\76\x20\x69\x6e\x20\74\x45\x6e\164\151\x74\x79\x44\145\x73\x63\x72\151\160\x74\x6f\162\76\56");
        hT:
        $ZC = $gd[0];
        $aF = Utilities::xpQuery($lg, "\x2e\57\x73\141\155\154\137\x6d\145\164\141\144\141\x74\141\x3a\x45\x78\x74\145\x6e\x73\151\157\x6e\163");
        if (!$aF) {
            goto xs;
        }
        $this->parseInfo($ZC);
        xs:
        $this->parseSSOService($ZC);
        $this->parseSLOService($ZC);
        $this->parsex509Certificate($ZC);
    }
    private function parseInfo($lg)
    {
        $q4 = Utilities::xpQuery($lg, "\56\x2f\x6d\x64\165\151\72\x55\111\111\x6e\x66\157\x2f\x6d\144\x75\x69\x3a\x44\151\x73\x70\x6c\141\171\116\141\x6d\x65");
        foreach ($q4 as $oR) {
            if (!($oR->hasAttribute("\170\x6d\154\x3a\154\141\156\x67") && $oR->getAttribute("\170\x6d\x6c\x3a\x6c\141\x6e\x67") == "\x65\x6e")) {
                goto vd;
            }
            $this->idpName = $oR->textContent;
            vd:
            pz:
        }
        S3:
    }
    private function parseSSOService($lg)
    {
        $aW = Utilities::xpQuery($lg, "\56\57\x73\x61\x6d\154\x5f\155\145\x74\141\x64\x61\164\141\72\x53\x69\156\147\x6c\145\x53\x69\147\156\117\x6e\x53\x65\162\166\151\x63\145");
        foreach ($aW as $ys) {
            $lW = str_replace("\165\x72\x6e\72\x6f\x61\x73\151\163\72\x6e\141\155\145\x73\72\x74\x63\x3a\123\x41\115\114\72\62\56\60\72\142\x69\156\144\x69\x6e\147\x73\72", '', $ys->getAttribute("\x42\151\156\x64\151\x6e\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($lW => $ys->getAttribute("\114\x6f\143\141\x74\151\x6f\x6e")));
            Lh:
        }
        qV:
    }
    private function parseSLOService($lg)
    {
        $PK = Utilities::xpQuery($lg, "\56\57\163\141\x6d\154\137\155\x65\x74\x61\x64\x61\164\x61\x3a\x53\151\x6e\147\x6c\x65\x4c\x6f\x67\157\x75\x74\123\x65\162\166\x69\x63\x65");
        foreach ($PK as $D_) {
            $lW = str_replace("\165\x72\156\72\x6f\141\163\x69\x73\x3a\156\x61\155\145\x73\72\x74\143\x3a\x53\101\x4d\114\72\62\56\60\72\x62\151\156\144\x69\156\147\163\x3a", '', $D_->getAttribute("\x42\151\156\144\x69\156\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($lW => $D_->getAttribute("\x4c\157\143\x61\x74\x69\x6f\x6e")));
            E2:
        }
        nR:
    }
    private function parsex509Certificate($lg)
    {
        foreach (Utilities::xpQuery($lg, "\56\57\x73\x61\155\154\x5f\155\x65\x74\141\144\141\x74\141\72\x4b\145\171\x44\x65\163\x63\x72\151\x70\x74\x6f\x72") as $mV) {
            if ($mV->hasAttribute("\x75\x73\145")) {
                goto dI;
            }
            $this->parseSigningCertificate($mV);
            goto Hw;
            dI:
            if ($mV->getAttribute("\165\x73\x65") == "\145\x6e\x63\162\x79\x70\164\151\x6f\156") {
                goto Vw;
            }
            $this->parseSigningCertificate($mV);
            goto CH;
            Vw:
            $this->parseEncryptionCertificate($mV);
            CH:
            Hw:
            jO:
        }
        QO:
    }
    private function parseSigningCertificate($lg)
    {
        $VI = Utilities::xpQuery($lg, "\56\57\144\163\72\113\145\171\x49\x6e\146\157\57\x64\163\x3a\x58\65\x30\x39\x44\x61\x74\141\57\144\163\72\x58\65\60\71\x43\x65\162\x74\151\x66\x69\143\x61\x74\145");
        $I2 = trim($VI[0]->textContent);
        $I2 = str_replace(array("\15", "\xa", "\x9", "\x20"), '', $I2);
        if (empty($VI)) {
            goto Cq;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($I2));
        Cq:
    }
    private function parseEncryptionCertificate($lg)
    {
        $VI = Utilities::xpQuery($lg, "\x2e\57\x64\x73\72\x4b\x65\171\x49\156\146\157\x2f\x64\x73\72\x58\x35\60\71\x44\141\x74\x61\57\144\x73\x3a\x58\65\x30\x39\103\145\162\x74\x69\x66\151\143\141\x74\x65");
        $I2 = trim($VI[0]->textContent);
        $I2 = str_replace(array("\15", "\xa", "\x9", "\40"), '', $I2);
        if (empty($VI)) {
            goto NS;
        }
        array_push($this->encryptionCertificate, $I2);
        NS:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($lW)
    {
        return $this->loginDetails[$lW];
    }
    public function getLogoutURL($lW)
    {
        return isset($this->logoutDetails[$lW]) ? $this->logoutDetails[$lW] : '';
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
