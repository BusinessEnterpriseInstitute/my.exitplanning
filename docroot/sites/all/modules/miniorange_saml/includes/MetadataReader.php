<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $Tr = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $su = Utilities::xpQuery($Tr, "\x2e\57\163\x61\155\x6c\x5f\x6d\x65\x74\141\x64\141\164\x61\x3a\x45\x6e\164\151\x74\171\104\145\x73\x63\x72\x69\160\164\x6f\162");
        foreach ($su as $dz) {
            $b9 = Utilities::xpQuery($dz, "\x2e\x2f\163\x61\155\154\x5f\155\x65\164\x61\x64\x61\164\141\72\111\104\120\123\123\117\x44\145\x73\x63\x72\x69\160\x74\x6f\x72");
            if (!(isset($b9) && !empty($b9))) {
                goto Ct;
            }
            array_push($this->identityProviders, new IdentityProviders($dz));
            Ct:
            tR:
        }
        Im:
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
    public function __construct(DOMElement $Tr = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$Tr->hasAttribute("\x65\156\164\151\164\171\111\x44")) {
            goto xq;
        }
        $this->entityID = $Tr->getAttribute("\145\x6e\x74\151\164\x79\x49\104");
        xq:
        if (!$Tr->hasAttribute("\127\141\156\x74\101\x75\x74\x68\156\122\x65\x71\165\x65\x73\164\163\123\151\147\156\x65\144")) {
            goto z1;
        }
        $this->signedRequest = $Tr->getAttribute("\x57\141\156\164\101\x75\x74\150\x6e\122\x65\x71\x75\x65\x73\164\163\123\x69\x67\156\x65\144");
        z1:
        $b9 = Utilities::xpQuery($Tr, "\x2e\57\x73\141\155\154\x5f\155\x65\164\x61\144\141\164\141\72\111\104\x50\x53\123\117\104\145\163\x63\x72\151\160\x74\x6f\x72");
        if (count($b9) > 1) {
            goto Pa;
        }
        if (empty($b9)) {
            goto yK;
        }
        goto VI;
        Pa:
        throw new Exception("\115\x6f\162\x65\40\164\x68\141\156\x20\157\x6e\145\40\x3c\x49\x44\x50\x53\123\117\104\145\163\143\x72\x69\160\x74\x6f\162\76\x20\x69\x6e\x20\74\105\156\x74\x69\x74\171\x44\145\x73\x63\162\x69\x70\x74\157\162\x3e\56");
        goto VI;
        yK:
        throw new Exception("\x4d\151\x73\x73\x69\156\x67\x20\162\145\x71\x75\x69\162\x65\144\x20\74\111\104\120\x53\x53\117\x44\145\x73\x63\x72\x69\x70\164\x6f\162\76\40\x69\x6e\40\74\105\x6e\x74\151\x74\171\x44\x65\x73\143\x72\x69\160\164\x6f\x72\76\56");
        VI:
        $sV = $b9[0];
        $iP = Utilities::xpQuery($Tr, "\x2e\57\x73\x61\x6d\x6c\x5f\x6d\145\x74\x61\x64\141\x74\x61\x3a\105\170\164\x65\x6e\x73\x69\157\156\x73");
        if (!$iP) {
            goto d7;
        }
        $this->parseInfo($sV);
        d7:
        $this->parseSSOService($sV);
        $this->parseSLOService($sV);
        $this->parsex509Certificate($sV);
    }
    private function parseInfo($Tr)
    {
        $Sw = Utilities::xpQuery($Tr, "\56\x2f\155\x64\x75\x69\72\125\x49\x49\156\146\157\57\155\144\x75\151\x3a\104\151\x73\x70\x6c\141\171\x4e\x61\x6d\145");
        foreach ($Sw as $nP) {
            if (!($nP->hasAttribute("\170\x6d\x6c\72\154\141\x6e\147") && $nP->getAttribute("\x78\x6d\x6c\72\154\141\156\x67") == "\145\x6e")) {
                goto rP;
            }
            $this->idpName = $nP->textContent;
            rP:
            wy:
        }
        Wd:
    }
    private function parseSSOService($Tr)
    {
        $Iy = Utilities::xpQuery($Tr, "\56\x2f\163\141\155\x6c\137\x6d\145\164\x61\x64\141\x74\x61\x3a\123\x69\x6e\x67\154\145\123\x69\147\156\x4f\156\x53\145\x72\x76\151\143\145");
        foreach ($Iy as $Gi) {
            $I1 = str_replace("\x75\162\156\x3a\157\x61\x73\151\163\72\156\x61\155\145\x73\72\x74\x63\x3a\123\101\115\x4c\72\x32\x2e\60\x3a\142\151\x6e\144\151\x6e\x67\x73\x3a", '', $Gi->getAttribute("\x42\151\156\144\x69\156\x67"));
            $this->loginDetails = array_merge($this->loginDetails, array($I1 => $Gi->getAttribute("\114\x6f\143\x61\164\x69\x6f\156")));
            R7:
        }
        U0:
    }
    private function parseSLOService($Tr)
    {
        $le = Utilities::xpQuery($Tr, "\56\x2f\x73\141\155\154\137\155\x65\164\x61\x64\141\x74\x61\x3a\123\x69\156\147\154\145\x4c\157\147\157\165\164\123\x65\162\166\x69\143\x65");
        foreach ($le as $Jv) {
            $I1 = str_replace("\165\162\x6e\x3a\157\141\x73\151\x73\72\156\141\155\145\163\x3a\x74\143\x3a\123\101\x4d\x4c\x3a\62\56\x30\72\142\x69\x6e\144\x69\156\147\x73\x3a", '', $Jv->getAttribute("\102\x69\x6e\x64\x69\x6e\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($I1 => $Jv->getAttribute("\114\x6f\x63\x61\164\x69\x6f\x6e")));
            RE:
        }
        FJ:
    }
    private function parsex509Certificate($Tr)
    {
        foreach (Utilities::xpQuery($Tr, "\56\57\163\141\155\x6c\x5f\x6d\145\164\141\x64\x61\164\141\72\x4b\145\x79\x44\x65\163\143\x72\151\x70\164\x6f\162") as $GR) {
            if ($GR->hasAttribute("\x75\x73\x65")) {
                goto Fj;
            }
            $this->parseSigningCertificate($GR);
            goto IR;
            Fj:
            if ($GR->getAttribute("\x75\163\145") == "\x65\156\143\x72\171\160\x74\151\157\156") {
                goto K4;
            }
            $this->parseSigningCertificate($GR);
            goto Cx;
            K4:
            $this->parseEncryptionCertificate($GR);
            Cx:
            IR:
            jV:
        }
        tY:
    }
    private function parseSigningCertificate($Tr)
    {
        $r1 = Utilities::xpQuery($Tr, "\56\x2f\144\x73\72\x4b\145\171\111\x6e\x66\x6f\57\144\163\x3a\130\x35\60\x39\104\x61\x74\141\x2f\144\163\x3a\130\x35\60\x39\103\145\x72\x74\151\x66\151\143\x61\164\x65");
        $sf = trim($r1[0]->textContent);
        $sf = str_replace(array("\xd", "\xa", "\11", "\40"), '', $sf);
        if (empty($r1)) {
            goto ee;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($sf));
        ee:
    }
    private function parseEncryptionCertificate($Tr)
    {
        $r1 = Utilities::xpQuery($Tr, "\x2e\x2f\144\163\x3a\113\145\x79\111\156\146\157\57\144\x73\x3a\x58\65\x30\71\x44\x61\x74\x61\57\144\x73\x3a\x58\x35\x30\x39\103\145\162\x74\151\x66\x69\x63\141\164\145");
        $sf = trim($r1[0]->textContent);
        $sf = str_replace(array("\15", "\12", "\x9", "\40"), '', $sf);
        if (empty($r1)) {
            goto ho;
        }
        array_push($this->encryptionCertificate, $sf);
        ho:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($I1)
    {
        return $this->loginDetails[$I1];
    }
    public function getLogoutURL($I1)
    {
        return isset($this->logoutDetails[$I1]) ? $this->logoutDetails[$I1] : '';
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
