<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $DP = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $gq = Utilities::xpQuery($DP, "\x2e\57\x73\141\155\x6c\137\155\145\x74\x61\x64\x61\164\x61\72\x45\156\164\151\x74\171\x44\145\163\x63\162\x69\160\164\x6f\x72");
        foreach ($gq as $mi) {
            $h2 = Utilities::xpQuery($mi, "\x2e\57\163\x61\155\154\137\x6d\145\164\141\x64\x61\x74\141\x3a\111\x44\120\x53\x53\117\104\x65\x73\143\x72\151\x70\x74\157\162");
            if (!(isset($h2) && !empty($h2))) {
                goto f_;
            }
            array_push($this->identityProviders, new IdentityProviders($mi));
            f_:
            Ho:
        }
        am:
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
    public function __construct(DOMElement $DP = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$DP->hasAttribute("\x65\x6e\x74\x69\164\x79\x49\x44")) {
            goto FR;
        }
        $this->entityID = $DP->getAttribute("\x65\x6e\x74\x69\x74\x79\x49\104");
        FR:
        if (!$DP->hasAttribute("\127\x61\x6e\164\101\165\164\150\x6e\122\145\161\x75\145\163\x74\163\x53\151\x67\x6e\x65\144")) {
            goto vy;
        }
        $this->signedRequest = $DP->getAttribute("\127\141\156\164\x41\x75\164\150\156\122\145\161\165\145\163\164\x73\123\151\147\156\145\144");
        vy:
        $h2 = Utilities::xpQuery($DP, "\x2e\57\163\141\x6d\x6c\137\x6d\x65\164\x61\x64\141\164\141\x3a\111\x44\x50\123\x53\x4f\104\145\163\143\162\151\x70\164\157\162");
        if (count($h2) > 1) {
            goto RW;
        }
        if (empty($h2)) {
            goto GW;
        }
        goto fa;
        RW:
        throw new Exception("\115\x6f\x72\145\40\x74\150\141\156\40\x6f\x6e\x65\40\x3c\111\x44\x50\x53\x53\x4f\x44\x65\x73\x63\162\x69\x70\164\x6f\x72\x3e\40\x69\x6e\x20\74\105\x6e\164\x69\x74\171\x44\x65\163\x63\162\x69\x70\164\x6f\x72\x3e\56");
        goto fa;
        GW:
        throw new Exception("\115\151\x73\x73\x69\x6e\x67\40\162\145\161\165\151\x72\145\144\x20\x3c\111\104\120\123\123\117\x44\x65\x73\143\162\x69\x70\164\157\x72\x3e\x20\x69\x6e\40\74\105\x6e\164\151\164\171\x44\x65\163\143\x72\151\x70\x74\157\162\x3e\56");
        fa:
        $RF = $h2[0];
        $tH = Utilities::xpQuery($DP, "\x2e\57\x73\141\155\x6c\137\x6d\145\164\x61\144\141\164\x61\x3a\105\x78\x74\x65\156\163\151\x6f\156\163");
        if (!$tH) {
            goto Xc;
        }
        $this->parseInfo($RF);
        Xc:
        $this->parseSSOService($RF);
        $this->parseSLOService($RF);
        $this->parsex509Certificate($RF);
    }
    private function parseInfo($DP)
    {
        $KN = Utilities::xpQuery($DP, "\56\57\155\x64\165\151\x3a\125\111\111\156\x66\x6f\x2f\155\x64\165\x69\72\x44\x69\163\160\154\141\x79\x4e\x61\x6d\145");
        foreach ($KN as $ge) {
            if (!($ge->hasAttribute("\170\155\x6c\x3a\x6c\x61\156\147") && $ge->getAttribute("\170\x6d\x6c\x3a\154\141\x6e\147") == "\x65\x6e")) {
                goto yJ;
            }
            $this->idpName = $ge->textContent;
            yJ:
            tx:
        }
        T2:
    }
    private function parseSSOService($DP)
    {
        $ef = Utilities::xpQuery($DP, "\56\57\x73\x61\x6d\x6c\137\x6d\x65\164\x61\144\x61\164\x61\72\123\x69\x6e\147\154\145\123\151\x67\156\x4f\x6e\123\145\162\166\x69\143\x65");
        foreach ($ef as $EC) {
            $mJ = str_replace("\x75\162\x6e\72\x6f\x61\163\x69\163\x3a\x6e\x61\155\145\x73\x3a\x74\x63\x3a\x53\101\115\114\x3a\x32\x2e\60\x3a\x62\x69\x6e\x64\x69\156\147\x73\x3a", '', $EC->getAttribute("\102\151\x6e\x64\x69\156\x67"));
            $this->loginDetails = array_merge($this->loginDetails, array($mJ => $EC->getAttribute("\x4c\157\143\x61\x74\151\157\156")));
            gk:
        }
        M3:
    }
    private function parseSLOService($DP)
    {
        $lN = Utilities::xpQuery($DP, "\x2e\57\163\x61\x6d\154\137\155\145\164\x61\x64\x61\x74\141\x3a\x53\x69\156\x67\154\x65\114\157\x67\157\x75\x74\x53\145\x72\x76\x69\x63\145");
        foreach ($lN as $Ix) {
            $mJ = str_replace("\165\162\156\72\x6f\x61\163\x69\x73\x3a\156\x61\155\x65\x73\x3a\x74\x63\72\123\101\115\114\x3a\62\x2e\x30\72\x62\x69\156\144\x69\x6e\x67\163\x3a", '', $Ix->getAttribute("\102\151\x6e\144\151\156\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($mJ => $Ix->getAttribute("\114\x6f\143\x61\x74\x69\157\x6e")));
            LX:
        }
        qz:
    }
    private function parsex509Certificate($DP)
    {
        foreach (Utilities::xpQuery($DP, "\56\x2f\163\141\x6d\154\x5f\x6d\x65\164\x61\144\141\164\141\72\x4b\x65\171\x44\x65\x73\143\x72\x69\x70\x74\x6f\162") as $yn) {
            if ($yn->hasAttribute("\x75\x73\x65")) {
                goto gQ;
            }
            $this->parseSigningCertificate($yn);
            goto lT;
            gQ:
            if ($yn->getAttribute("\165\163\145") == "\145\x6e\143\x72\171\160\164\151\x6f\156") {
                goto zt;
            }
            $this->parseSigningCertificate($yn);
            goto sW;
            zt:
            $this->parseEncryptionCertificate($yn);
            sW:
            lT:
            MB:
        }
        oO:
    }
    private function parseSigningCertificate($DP)
    {
        $EI = Utilities::xpQuery($DP, "\56\57\144\x73\72\113\x65\x79\111\156\146\x6f\57\144\163\x3a\130\65\60\71\x44\141\x74\x61\x2f\144\x73\72\130\x35\x30\x39\103\x65\162\x74\x69\146\x69\x63\x61\164\145");
        $T9 = trim($EI[0]->textContent);
        $T9 = str_replace(array("\xd", "\12", "\x9", "\40"), '', $T9);
        if (empty($EI)) {
            goto KM;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($T9));
        KM:
    }
    private function parseEncryptionCertificate($DP)
    {
        $EI = Utilities::xpQuery($DP, "\x2e\x2f\144\x73\72\x4b\145\x79\x49\x6e\x66\x6f\x2f\x64\163\72\130\x35\60\71\x44\141\x74\x61\57\x64\x73\x3a\130\65\x30\x39\103\145\x72\x74\x69\146\x69\x63\x61\x74\145");
        $T9 = trim($EI[0]->textContent);
        $T9 = str_replace(array("\15", "\12", "\x9", "\x20"), '', $T9);
        if (empty($EI)) {
            goto O9;
        }
        array_push($this->encryptionCertificate, $T9);
        O9:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($mJ)
    {
        return $this->loginDetails[$mJ];
    }
    public function getLogoutURL($mJ)
    {
        return isset($this->logoutDetails[$mJ]) ? $this->logoutDetails[$mJ] : '';
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
