<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $p3 = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $WI = Utilities::xpQuery($p3, "\x2e\x2f\163\x61\x6d\154\137\x6d\x65\x74\141\144\x61\x74\x61\72\x45\x6e\x74\151\x74\171\104\145\163\x63\162\151\x70\164\x6f\162");
        foreach ($WI as $mQ) {
            $O_ = Utilities::xpQuery($mQ, "\x2e\57\x73\x61\x6d\154\x5f\155\145\x74\x61\x64\x61\x74\141\x3a\111\104\120\x53\x53\x4f\x44\x65\163\x63\x72\151\160\x74\x6f\x72");
            if (!(isset($O_) && !empty($O_))) {
                goto a4;
            }
            array_push($this->identityProviders, new IdentityProviders($mQ));
            a4:
            gg:
        }
        it:
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
    public function __construct(DOMElement $p3 = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$p3->hasAttribute("\x65\156\x74\x69\x74\171\x49\104")) {
            goto Ly;
        }
        $this->entityID = $p3->getAttribute("\145\156\x74\151\x74\171\x49\x44");
        Ly:
        if (!$p3->hasAttribute("\x57\141\156\x74\101\x75\164\x68\x6e\x52\145\x71\x75\145\163\x74\x73\123\151\147\156\x65\x64")) {
            goto yZ;
        }
        $this->signedRequest = $p3->getAttribute("\127\141\156\x74\x41\165\164\150\156\x52\x65\x71\165\145\163\x74\163\x53\151\147\156\145\x64");
        yZ:
        $O_ = Utilities::xpQuery($p3, "\x2e\57\163\x61\x6d\154\x5f\x6d\145\x74\141\144\141\x74\x61\x3a\x49\104\x50\123\x53\x4f\x44\145\163\x63\162\x69\x70\164\x6f\x72");
        if (count($O_) > 1) {
            goto al;
        }
        if (empty($O_)) {
            goto s6;
        }
        goto ZD;
        al:
        throw new Exception("\115\157\x72\145\x20\x74\x68\141\156\x20\x6f\x6e\145\x20\x3c\111\x44\x50\123\x53\117\104\x65\163\x63\162\x69\x70\164\x6f\x72\x3e\x20\151\156\40\74\105\156\164\151\x74\x79\x44\x65\163\x63\162\x69\160\164\x6f\162\76\56");
        goto ZD;
        s6:
        throw new Exception("\115\x69\163\163\x69\x6e\147\x20\x72\145\x71\x75\x69\162\145\x64\x20\74\111\104\x50\123\123\x4f\104\x65\163\x63\x72\151\160\x74\157\162\76\x20\151\x6e\x20\74\x45\156\164\x69\x74\171\x44\145\x73\x63\162\x69\x70\164\x6f\162\x3e\x2e");
        ZD:
        $h2 = $O_[0];
        $rP = Utilities::xpQuery($p3, "\56\x2f\163\x61\155\154\137\x6d\x65\x74\x61\144\x61\164\x61\72\x45\170\164\145\x6e\x73\151\157\156\x73");
        if (!$rP) {
            goto tC;
        }
        $this->parseInfo($h2);
        tC:
        $this->parseSSOService($h2);
        $this->parseSLOService($h2);
        $this->parsex509Certificate($h2);
    }
    private function parseInfo($p3)
    {
        $w6 = Utilities::xpQuery($p3, "\56\x2f\x6d\x64\165\151\x3a\125\111\111\156\146\157\x2f\x6d\x64\x75\151\72\x44\151\163\x70\154\141\171\116\141\x6d\145");
        foreach ($w6 as $wL) {
            if (!($wL->hasAttribute("\170\155\154\72\154\141\x6e\147") && $wL->getAttribute("\170\x6d\154\72\x6c\141\156\x67") == "\x65\156")) {
                goto n2;
            }
            $this->idpName = $wL->textContent;
            n2:
            d3:
        }
        NY:
    }
    private function parseSSOService($p3)
    {
        $PO = Utilities::xpQuery($p3, "\x2e\57\x73\141\x6d\154\137\x6d\x65\x74\141\x64\x61\164\141\x3a\x53\x69\x6e\147\154\145\x53\x69\147\x6e\117\156\x53\145\162\x76\x69\x63\x65");
        foreach ($PO as $LH) {
            $kg = str_replace("\165\x72\156\72\157\x61\x73\151\x73\x3a\x6e\141\x6d\145\163\x3a\164\143\x3a\x53\x41\x4d\114\72\62\x2e\60\x3a\142\x69\156\x64\151\x6e\147\x73\x3a", '', $LH->getAttribute("\x42\151\x6e\144\151\x6e\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($kg => $LH->getAttribute("\114\x6f\143\141\x74\151\157\156")));
            TZ:
        }
        ed:
    }
    private function parseSLOService($p3)
    {
        $nF = Utilities::xpQuery($p3, "\56\57\163\x61\x6d\x6c\137\x6d\145\x74\x61\x64\x61\x74\141\72\x53\x69\x6e\147\x6c\x65\114\x6f\x67\157\x75\164\x53\x65\x72\x76\x69\143\145");
        foreach ($nF as $Oo) {
            $kg = str_replace("\x75\162\x6e\72\x6f\x61\x73\x69\163\72\156\x61\155\145\x73\x3a\164\143\72\123\x41\115\x4c\72\x32\56\60\72\x62\151\x6e\144\151\156\x67\x73\x3a", '', $Oo->getAttribute("\102\x69\156\144\151\156\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($kg => $Oo->getAttribute("\x4c\157\x63\x61\x74\x69\157\x6e")));
            Mz:
        }
        I3:
    }
    private function parsex509Certificate($p3)
    {
        foreach (Utilities::xpQuery($p3, "\x2e\x2f\163\141\x6d\x6c\137\x6d\145\x74\x61\x64\141\164\x61\72\113\x65\x79\104\x65\x73\x63\162\x69\160\x74\157\162") as $UJ) {
            if ($UJ->hasAttribute("\165\x73\x65")) {
                goto kZ;
            }
            $this->parseSigningCertificate($UJ);
            goto fj;
            kZ:
            if ($UJ->getAttribute("\x75\163\145") == "\145\156\143\162\171\x70\x74\x69\157\x6e") {
                goto j2;
            }
            $this->parseSigningCertificate($UJ);
            goto Di;
            j2:
            $this->parseEncryptionCertificate($UJ);
            Di:
            fj:
            V1:
        }
        nK:
    }
    private function parseSigningCertificate($p3)
    {
        $gQ = Utilities::xpQuery($p3, "\x2e\57\144\x73\x3a\113\x65\171\111\156\x66\x6f\x2f\x64\163\72\130\65\x30\71\x44\x61\164\141\x2f\144\163\x3a\130\x35\60\x39\x43\x65\x72\164\151\146\151\143\141\164\x65");
        $ob = trim($gQ[0]->textContent);
        $ob = str_replace(array("\xd", "\12", "\11", "\x20"), '', $ob);
        if (empty($gQ)) {
            goto sy;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($ob));
        sy:
    }
    private function parseEncryptionCertificate($p3)
    {
        $gQ = Utilities::xpQuery($p3, "\56\x2f\x64\163\x3a\113\145\171\x49\x6e\146\x6f\x2f\x64\163\72\x58\x35\60\x39\104\x61\x74\x61\57\144\163\72\x58\65\60\x39\x43\145\162\164\x69\146\x69\x63\x61\164\145");
        $ob = trim($gQ[0]->textContent);
        $ob = str_replace(array("\xd", "\xa", "\11", "\40"), '', $ob);
        if (empty($gQ)) {
            goto b4;
        }
        array_push($this->encryptionCertificate, $ob);
        b4:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($kg)
    {
        return $this->loginDetails[$kg];
    }
    public function getLogoutURL($kg)
    {
        return isset($this->logoutDetails[$kg]) ? $this->logoutDetails[$kg] : '';
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
