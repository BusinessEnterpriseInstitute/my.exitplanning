<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $Oe = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $RE = Utilities::xpQuery($Oe, "\56\x2f\163\x61\155\x6c\137\x6d\145\164\141\144\141\164\x61\x3a\x45\156\164\x69\x74\x79\104\x65\163\x63\162\151\x70\164\157\x72");
        foreach ($RE as $mX) {
            $B4 = Utilities::xpQuery($mX, "\x2e\57\163\141\155\x6c\137\x6d\x65\x74\x61\x64\x61\x74\141\x3a\x49\x44\x50\123\x53\117\x44\x65\163\143\162\x69\160\164\x6f\162");
            if (!(isset($B4) && !empty($B4))) {
                goto WP;
            }
            array_push($this->identityProviders, new IdentityProviders($mX));
            WP:
            EQ:
        }
        f4:
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
    public function __construct(DOMElement $Oe = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$Oe->hasAttribute("\x65\x6e\164\x69\x74\171\111\x44")) {
            goto ZQ;
        }
        $this->entityID = $Oe->getAttribute("\145\x6e\164\151\x74\171\x49\104");
        ZQ:
        if (!$Oe->hasAttribute("\x57\141\156\164\101\x75\x74\150\156\x52\x65\161\165\145\x73\x74\163\x53\x69\147\156\x65\x64")) {
            goto TV;
        }
        $this->signedRequest = $Oe->getAttribute("\x57\141\x6e\164\101\165\164\x68\x6e\122\x65\161\x75\x65\163\164\x73\123\151\x67\156\x65\x64");
        TV:
        $B4 = Utilities::xpQuery($Oe, "\x2e\57\x73\x61\x6d\154\137\155\x65\x74\x61\x64\141\164\x61\72\111\x44\120\123\x53\x4f\x44\x65\163\x63\162\151\160\x74\157\162");
        if (count($B4) > 1) {
            goto E8;
        }
        if (empty($B4)) {
            goto HZ;
        }
        goto M0;
        E8:
        throw new Exception("\115\157\x72\145\40\x74\x68\x61\156\x20\x6f\x6e\x65\40\x3c\x49\104\x50\123\x53\x4f\x44\145\163\143\x72\151\160\x74\x6f\x72\76\x20\x69\x6e\40\74\x45\x6e\164\151\x74\171\104\x65\163\143\162\x69\160\x74\157\x72\x3e\x2e");
        goto M0;
        HZ:
        throw new Exception("\x4d\151\163\x73\x69\156\x67\x20\162\x65\161\165\151\x72\x65\x64\x20\74\x49\104\x50\x53\123\x4f\x44\145\163\x63\x72\x69\160\x74\157\162\x3e\40\151\156\x20\74\105\156\164\x69\164\171\x44\x65\x73\x63\162\x69\x70\164\x6f\162\76\x2e");
        M0:
        $Ij = $B4[0];
        $pr = Utilities::xpQuery($Oe, "\x2e\57\x73\141\155\154\137\155\145\164\141\144\141\164\x61\72\x45\x78\164\x65\156\x73\x69\157\156\x73");
        if (!$pr) {
            goto YJ;
        }
        $this->parseInfo($Ij);
        YJ:
        $this->parseSSOService($Ij);
        $this->parseSLOService($Ij);
        $this->parsex509Certificate($Ij);
    }
    private function parseInfo($Oe)
    {
        $lZ = Utilities::xpQuery($Oe, "\56\57\155\144\x75\x69\x3a\x55\x49\x49\156\x66\157\57\155\144\x75\x69\72\104\x69\163\160\x6c\141\171\x4e\141\x6d\145");
        foreach ($lZ as $lX) {
            if (!($lX->hasAttribute("\x78\155\154\72\154\x61\x6e\147") && $lX->getAttribute("\170\x6d\x6c\x3a\x6c\141\156\x67") == "\x65\156")) {
                goto iu;
            }
            $this->idpName = $lX->textContent;
            iu:
            nP:
        }
        kj:
    }
    private function parseSSOService($Oe)
    {
        $LE = Utilities::xpQuery($Oe, "\56\57\163\141\155\x6c\x5f\x6d\x65\164\x61\x64\141\164\141\x3a\123\151\x6e\x67\154\x65\x53\x69\147\156\x4f\x6e\123\145\162\166\x69\x63\x65");
        foreach ($LE as $iS) {
            $AI = str_replace("\165\162\156\x3a\x6f\x61\163\151\x73\72\x6e\x61\155\x65\163\72\164\143\x3a\123\101\115\114\x3a\62\56\60\x3a\142\x69\156\144\151\156\x67\x73\72", '', $iS->getAttribute("\102\x69\x6e\144\x69\156\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($AI => $iS->getAttribute("\x4c\157\x63\x61\x74\x69\157\156")));
            xm:
        }
        ya:
    }
    private function parseSLOService($Oe)
    {
        $Pr = Utilities::xpQuery($Oe, "\56\x2f\x73\x61\155\x6c\x5f\155\145\x74\141\144\141\x74\x61\72\123\151\156\147\154\x65\114\x6f\147\x6f\x75\164\x53\x65\162\x76\x69\143\x65");
        foreach ($Pr as $Uz) {
            $AI = str_replace("\165\162\x6e\x3a\x6f\x61\163\x69\x73\x3a\x6e\141\155\x65\x73\x3a\164\x63\x3a\x53\x41\x4d\x4c\72\62\x2e\x30\72\142\151\156\x64\151\156\x67\163\x3a", '', $Uz->getAttribute("\102\x69\156\x64\x69\x6e\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($AI => $Uz->getAttribute("\x4c\157\143\141\x74\151\157\x6e")));
            YX:
        }
        c9:
    }
    private function parsex509Certificate($Oe)
    {
        foreach (Utilities::xpQuery($Oe, "\56\x2f\163\x61\155\154\x5f\155\145\x74\141\x64\141\x74\x61\72\x4b\x65\171\104\x65\163\143\162\x69\160\x74\x6f\162") as $VK) {
            if ($VK->hasAttribute("\x75\x73\145")) {
                goto Qj;
            }
            $this->parseSigningCertificate($VK);
            goto qG;
            Qj:
            if ($VK->getAttribute("\x75\163\x65") == "\145\156\143\x72\171\160\164\x69\157\156") {
                goto my;
            }
            $this->parseSigningCertificate($VK);
            goto Ue;
            my:
            $this->parseEncryptionCertificate($VK);
            Ue:
            qG:
            C3:
        }
        jS:
    }
    private function parseSigningCertificate($Oe)
    {
        $ih = Utilities::xpQuery($Oe, "\56\x2f\144\x73\x3a\x4b\x65\x79\111\x6e\146\157\x2f\144\163\72\x58\65\x30\71\104\141\x74\141\57\x64\x73\72\130\x35\60\71\103\145\162\164\151\146\x69\x63\141\x74\x65");
        $rm = trim($ih[0]->textContent);
        $rm = str_replace(array("\xd", "\12", "\11", "\40"), '', $rm);
        if (empty($ih)) {
            goto x9;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($rm));
        x9:
    }
    private function parseEncryptionCertificate($Oe)
    {
        $ih = Utilities::xpQuery($Oe, "\x2e\57\144\x73\x3a\x4b\145\x79\111\156\x66\x6f\57\144\163\x3a\x58\x35\60\71\x44\141\164\x61\57\144\163\x3a\x58\x35\60\71\x43\145\162\164\x69\146\x69\143\141\x74\145");
        $rm = trim($ih[0]->textContent);
        $rm = str_replace(array("\xd", "\xa", "\11", "\x20"), '', $rm);
        if (empty($ih)) {
            goto lK;
        }
        array_push($this->encryptionCertificate, $rm);
        lK:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($AI)
    {
        return $this->loginDetails[$AI];
    }
    public function getLogoutURL($AI)
    {
        return isset($this->logoutDetails[$AI]) ? $this->logoutDetails[$AI] : '';
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
