<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $L_ = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $Dp = Utilities::xpQuery($L_, "\56\57\x73\141\x6d\x6c\x5f\155\145\164\141\x64\141\164\141\x3a\105\156\x74\x69\x74\x79\104\145\x73\143\x72\151\x70\164\x6f\162");
        foreach ($Dp as $xs) {
            $Ix = Utilities::xpQuery($xs, "\x2e\57\163\x61\x6d\x6c\x5f\x6d\145\x74\141\144\141\x74\141\72\x49\104\120\123\123\117\x44\x65\x73\x63\x72\151\160\x74\x6f\x72");
            if (!(isset($Ix) && !empty($Ix))) {
                goto sM;
            }
            array_push($this->identityProviders, new IdentityProviders($xs));
            sM:
            Ya:
        }
        D6:
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
    public function __construct(DOMElement $L_ = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$L_->hasAttribute("\145\156\x74\x69\x74\x79\x49\104")) {
            goto W9;
        }
        $this->entityID = $L_->getAttribute("\145\156\x74\x69\x74\x79\111\104");
        W9:
        if (!$L_->hasAttribute("\127\141\156\x74\x41\165\164\150\156\x52\145\x71\165\x65\x73\x74\163\x53\151\x67\x6e\x65\x64")) {
            goto oV;
        }
        $this->signedRequest = $L_->getAttribute("\x57\x61\156\164\101\x75\164\x68\156\x52\145\x71\x75\x65\x73\x74\x73\x53\x69\147\156\x65\x64");
        oV:
        $Ix = Utilities::xpQuery($L_, "\56\57\x73\x61\x6d\x6c\137\x6d\145\x74\141\144\x61\x74\x61\x3a\111\x44\120\123\123\x4f\x44\x65\x73\143\162\x69\x70\x74\x6f\x72");
        if (count($Ix) > 1) {
            goto m3;
        }
        if (empty($Ix)) {
            goto K_;
        }
        goto vV;
        m3:
        throw new Exception("\x4d\x6f\162\x65\40\164\150\141\x6e\x20\x6f\x6e\x65\40\x3c\111\x44\120\x53\123\x4f\x44\x65\x73\x63\162\x69\160\x74\x6f\x72\76\x20\151\156\x20\x3c\105\x6e\x74\151\x74\x79\104\145\x73\143\162\151\x70\x74\x6f\162\76\x2e");
        goto vV;
        K_:
        throw new Exception("\115\x69\x73\163\151\x6e\x67\40\x72\x65\x71\x75\151\162\x65\144\x20\x3c\x49\104\x50\123\123\117\x44\145\x73\x63\162\151\160\164\157\162\x3e\x20\151\156\x20\74\x45\x6e\164\151\164\x79\104\145\163\143\x72\x69\x70\x74\x6f\162\x3e\56");
        vV:
        $Cd = $Ix[0];
        $hn = Utilities::xpQuery($L_, "\56\57\x73\141\155\x6c\137\x6d\x65\x74\x61\x64\x61\164\x61\72\105\170\164\145\x6e\x73\151\x6f\x6e\x73");
        if (!$hn) {
            goto S2;
        }
        $this->parseInfo($Cd);
        S2:
        $this->parseSSOService($Cd);
        $this->parseSLOService($Cd);
        $this->parsex509Certificate($Cd);
    }
    private function parseInfo($L_)
    {
        $PY = Utilities::xpQuery($L_, "\56\57\155\x64\165\151\72\x55\x49\x49\x6e\146\x6f\x2f\155\x64\x75\x69\x3a\x44\151\x73\x70\x6c\141\x79\x4e\x61\x6d\x65");
        foreach ($PY as $cg) {
            if (!($cg->hasAttribute("\x78\155\154\72\154\141\x6e\x67") && $cg->getAttribute("\170\155\x6c\72\x6c\141\156\147") == "\145\156")) {
                goto F7;
            }
            $this->idpName = $cg->textContent;
            F7:
            yO:
        }
        hM:
    }
    private function parseSSOService($L_)
    {
        $XH = Utilities::xpQuery($L_, "\x2e\x2f\163\141\155\154\137\155\x65\164\141\144\x61\164\141\72\x53\x69\156\x67\154\145\x53\x69\x67\x6e\117\156\123\x65\162\x76\x69\143\x65");
        foreach ($XH as $Ze) {
            $RU = str_replace("\x75\162\x6e\x3a\x6f\x61\x73\151\163\72\156\141\x6d\145\163\72\x74\x63\x3a\123\x41\115\114\72\62\56\x30\x3a\x62\x69\156\144\x69\x6e\x67\163\72", '', $Ze->getAttribute("\102\151\x6e\144\x69\156\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($RU => $Ze->getAttribute("\114\x6f\x63\x61\x74\151\x6f\x6e")));
            y4:
        }
        Zz:
    }
    private function parseSLOService($L_)
    {
        $nS = Utilities::xpQuery($L_, "\56\57\163\x61\155\154\x5f\x6d\x65\x74\141\x64\141\x74\x61\x3a\x53\x69\x6e\x67\154\145\x4c\157\147\157\165\x74\x53\x65\x72\x76\x69\x63\x65");
        foreach ($nS as $Wy) {
            $RU = str_replace("\165\x72\x6e\72\157\x61\x73\151\163\72\x6e\x61\x6d\x65\163\x3a\x74\143\x3a\x53\101\x4d\114\x3a\x32\56\x30\72\142\x69\x6e\144\151\x6e\147\163\x3a", '', $Wy->getAttribute("\102\x69\x6e\144\151\x6e\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($RU => $Wy->getAttribute("\114\x6f\143\141\x74\151\157\156")));
            T6:
        }
        wR:
    }
    private function parsex509Certificate($L_)
    {
        foreach (Utilities::xpQuery($L_, "\56\57\163\x61\x6d\154\137\155\x65\x74\x61\x64\x61\164\141\72\113\145\x79\104\145\163\143\162\151\160\x74\157\162") as $gu) {
            if ($gu->hasAttribute("\x75\163\145")) {
                goto qh;
            }
            $this->parseSigningCertificate($gu);
            goto yE;
            qh:
            if ($gu->getAttribute("\165\x73\145") == "\145\156\143\162\x79\x70\164\x69\x6f\x6e") {
                goto iZ;
            }
            $this->parseSigningCertificate($gu);
            goto T3;
            iZ:
            $this->parseEncryptionCertificate($gu);
            T3:
            yE:
            fU:
        }
        WZ:
    }
    private function parseSigningCertificate($L_)
    {
        $Ot = Utilities::xpQuery($L_, "\x2e\x2f\144\163\72\x4b\145\171\x49\156\x66\157\57\x64\163\x3a\130\x35\60\71\x44\x61\x74\141\x2f\x64\x73\x3a\x58\x35\x30\71\x43\x65\x72\164\x69\x66\151\143\x61\x74\x65");
        $hl = trim($Ot[0]->textContent);
        $hl = str_replace(array("\xd", "\12", "\11", "\40"), '', $hl);
        if (empty($Ot)) {
            goto Nt;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($hl));
        Nt:
    }
    private function parseEncryptionCertificate($L_)
    {
        $Ot = Utilities::xpQuery($L_, "\56\x2f\x64\163\x3a\113\145\171\111\x6e\146\157\57\144\163\x3a\130\x35\x30\x39\104\x61\x74\x61\x2f\144\x73\x3a\130\x35\60\x39\103\145\162\x74\x69\x66\151\x63\141\164\145");
        $hl = trim($Ot[0]->textContent);
        $hl = str_replace(array("\15", "\12", "\11", "\40"), '', $hl);
        if (empty($Ot)) {
            goto LU;
        }
        array_push($this->encryptionCertificate, $hl);
        LU:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($RU)
    {
        return $this->loginDetails[$RU];
    }
    public function getLogoutURL($RU)
    {
        return isset($this->logoutDetails[$RU]) ? $this->logoutDetails[$RU] : '';
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
