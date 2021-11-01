<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $fk = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $GL = Utilities::xpQuery($fk, "\x2e\57\163\x61\x6d\154\137\155\145\x74\x61\144\141\164\x61\x3a\x45\x6e\164\151\x74\171\x44\x65\x73\x63\x72\151\x70\x74\x6f\162");
        foreach ($GL as $ln) {
            $ij = Utilities::xpQuery($ln, "\56\57\163\141\155\x6c\x5f\155\x65\164\x61\144\x61\x74\x61\72\111\104\120\123\x53\x4f\x44\x65\x73\x63\x72\151\160\x74\157\162");
            if (!(isset($ij) && !empty($ij))) {
                goto Vc;
            }
            array_push($this->identityProviders, new IdentityProviders($ln));
            Vc:
            Ua:
        }
        AH:
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
    public function __construct(DOMElement $fk = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$fk->hasAttribute("\x65\x6e\x74\x69\164\171\111\x44")) {
            goto mJ;
        }
        $this->entityID = $fk->getAttribute("\x65\x6e\164\151\164\171\x49\104");
        mJ:
        if (!$fk->hasAttribute("\x57\141\x6e\x74\x41\165\164\150\156\x52\x65\161\x75\x65\163\164\163\123\151\x67\156\145\144")) {
            goto R3;
        }
        $this->signedRequest = $fk->getAttribute("\127\x61\156\x74\x41\165\x74\150\156\122\x65\161\x75\145\x73\x74\x73\123\x69\147\156\x65\144");
        R3:
        $ij = Utilities::xpQuery($fk, "\56\57\x73\x61\x6d\x6c\137\155\145\164\x61\144\141\164\x61\x3a\111\x44\x50\123\x53\117\x44\145\x73\x63\x72\x69\x70\x74\157\x72");
        if (count($ij) > 1) {
            goto y4;
        }
        if (empty($ij)) {
            goto yh;
        }
        goto gA;
        y4:
        throw new Exception("\115\157\x72\145\40\164\x68\x61\156\40\x6f\156\145\40\x3c\111\x44\120\x53\x53\117\x44\x65\163\x63\x72\151\x70\x74\157\x72\x3e\40\x69\x6e\40\74\105\156\x74\x69\164\171\x44\x65\163\x63\162\x69\x70\164\x6f\162\x3e\x2e");
        goto gA;
        yh:
        throw new Exception("\115\x69\163\x73\151\x6e\x67\x20\162\145\x71\165\151\x72\x65\144\40\74\111\104\x50\123\x53\117\x44\x65\163\143\162\x69\x70\x74\157\162\76\x20\x69\156\40\x3c\105\156\x74\x69\164\x79\104\145\x73\x63\162\x69\160\x74\157\x72\76\56");
        gA:
        $A3 = $ij[0];
        $cm = Utilities::xpQuery($fk, "\x2e\x2f\x73\141\x6d\x6c\137\x6d\x65\x74\141\x64\141\164\141\x3a\x45\x78\164\145\x6e\x73\151\x6f\156\x73");
        if (!$cm) {
            goto Mb;
        }
        $this->parseInfo($A3);
        Mb:
        $this->parseSSOService($A3);
        $this->parseSLOService($A3);
        $this->parsex509Certificate($A3);
    }
    private function parseInfo($fk)
    {
        $A6 = Utilities::xpQuery($fk, "\x2e\x2f\x6d\x64\x75\151\72\x55\111\x49\x6e\x66\157\57\x6d\x64\165\151\x3a\x44\151\x73\x70\154\141\171\116\141\x6d\145");
        foreach ($A6 as $Z5) {
            if (!($Z5->hasAttribute("\170\155\154\x3a\x6c\141\156\147") && $Z5->getAttribute("\x78\x6d\154\72\154\141\156\147") == "\x65\x6e")) {
                goto PG;
            }
            $this->idpName = $Z5->textContent;
            PG:
            Ho:
        }
        h3:
    }
    private function parseSSOService($fk)
    {
        $xz = Utilities::xpQuery($fk, "\56\x2f\x73\x61\x6d\154\137\x6d\x65\x74\x61\x64\x61\164\141\x3a\123\151\156\147\154\x65\123\x69\147\x6e\117\156\123\145\x72\x76\151\x63\145");
        foreach ($xz as $of) {
            $XD = str_replace("\x75\x72\156\x3a\157\x61\x73\x69\x73\x3a\x6e\x61\x6d\145\x73\72\164\143\x3a\123\101\x4d\114\72\62\x2e\x30\x3a\x62\151\x6e\x64\x69\x6e\x67\x73\x3a", '', $of->getAttribute("\x42\x69\x6e\144\x69\156\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($XD => $of->getAttribute("\114\157\143\x61\164\151\157\156")));
            pc:
        }
        CM:
    }
    private function parseSLOService($fk)
    {
        $AN = Utilities::xpQuery($fk, "\x2e\x2f\x73\141\x6d\x6c\x5f\155\145\164\141\x64\x61\x74\x61\x3a\123\x69\x6e\147\154\145\114\157\147\x6f\x75\x74\123\145\x72\166\x69\x63\x65");
        foreach ($AN as $ND) {
            $XD = str_replace("\x75\162\x6e\72\x6f\141\x73\151\163\72\x6e\x61\155\x65\163\x3a\x74\x63\72\123\101\x4d\x4c\72\x32\56\60\72\x62\x69\156\144\x69\156\147\163\72", '', $ND->getAttribute("\x42\x69\156\144\x69\x6e\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($XD => $ND->getAttribute("\x4c\x6f\x63\x61\x74\x69\x6f\x6e")));
            f7:
        }
        ix:
    }
    private function parsex509Certificate($fk)
    {
        foreach (Utilities::xpQuery($fk, "\56\57\163\141\155\x6c\x5f\x6d\x65\164\141\144\141\x74\x61\72\113\145\x79\104\x65\163\143\162\151\160\x74\157\x72") as $YO) {
            if ($YO->hasAttribute("\x75\163\x65")) {
                goto eK;
            }
            $this->parseSigningCertificate($YO);
            goto ci;
            eK:
            if ($YO->getAttribute("\165\163\x65") == "\x65\156\x63\x72\171\160\x74\x69\x6f\156") {
                goto Ep;
            }
            $this->parseSigningCertificate($YO);
            goto gw;
            Ep:
            $this->parseEncryptionCertificate($YO);
            gw:
            ci:
            UW:
        }
        E5:
    }
    private function parseSigningCertificate($fk)
    {
        $qq = Utilities::xpQuery($fk, "\56\57\144\x73\72\x4b\145\x79\111\x6e\146\157\57\x64\x73\72\130\x35\60\71\x44\141\x74\141\x2f\x64\x73\x3a\130\65\x30\71\103\x65\162\x74\x69\x66\x69\x63\141\164\x65");
        $L6 = trim($qq[0]->textContent);
        $L6 = str_replace(array("\15", "\12", "\11", "\x20"), '', $L6);
        if (empty($qq)) {
            goto em;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($L6));
        em:
    }
    private function parseEncryptionCertificate($fk)
    {
        $qq = Utilities::xpQuery($fk, "\x2e\57\x64\163\72\113\145\171\x49\x6e\x66\157\57\144\x73\x3a\x58\x35\60\x39\104\x61\x74\141\x2f\144\163\72\x58\65\60\x39\103\145\162\164\151\146\x69\143\x61\x74\x65");
        $L6 = trim($qq[0]->textContent);
        $L6 = str_replace(array("\xd", "\xa", "\x9", "\40"), '', $L6);
        if (empty($qq)) {
            goto DP;
        }
        array_push($this->encryptionCertificate, $L6);
        DP:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($XD)
    {
        return $this->loginDetails[$XD];
    }
    public function getLogoutURL($XD)
    {
        return isset($this->logoutDetails[$XD]) ? $this->logoutDetails[$XD] : '';
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
