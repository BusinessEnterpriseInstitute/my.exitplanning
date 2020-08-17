<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $uQ = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $M1 = Utilities::xpQuery($uQ, "\56\x2f\x73\141\x6d\x6c\x5f\155\145\x74\x61\x64\141\x74\141\72\105\156\x74\x69\164\x79\104\145\x73\x63\x72\151\160\x74\x6f\162");
        foreach ($M1 as $xw) {
            $gN = Utilities::xpQuery($xw, "\x2e\57\163\x61\155\x6c\x5f\x6d\x65\x74\141\x64\141\x74\141\x3a\111\104\x50\123\123\x4f\104\145\163\143\x72\151\160\164\157\x72");
            if (!(isset($gN) && !empty($gN))) {
                goto Qj;
            }
            array_push($this->identityProviders, new IdentityProviders($xw));
            Qj:
            vE:
        }
        TR:
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
    public function __construct(DOMElement $uQ = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$uQ->hasAttribute("\x65\x6e\x74\x69\164\171\111\104")) {
            goto vk;
        }
        $this->entityID = $uQ->getAttribute("\x65\156\164\151\164\x79\111\104");
        vk:
        if (!$uQ->hasAttribute("\x57\141\156\164\101\165\164\x68\x6e\x52\x65\x71\165\x65\163\164\x73\123\x69\x67\x6e\145\x64")) {
            goto BH;
        }
        $this->signedRequest = $uQ->getAttribute("\127\141\x6e\164\x41\x75\164\150\156\122\145\161\165\145\x73\x74\x73\123\x69\147\156\145\x64");
        BH:
        $gN = Utilities::xpQuery($uQ, "\56\57\x73\141\155\x6c\137\155\145\x74\141\x64\141\164\x61\x3a\x49\x44\120\x53\x53\x4f\x44\x65\x73\x63\x72\151\160\x74\x6f\x72");
        if (count($gN) > 1) {
            goto h6;
        }
        if (empty($gN)) {
            goto er;
        }
        goto HP;
        h6:
        throw new Exception("\x4d\x6f\162\x65\x20\x74\150\141\156\x20\157\156\x65\40\x3c\x49\104\120\123\123\117\x44\145\163\x63\x72\x69\x70\164\x6f\x72\76\40\151\156\x20\74\105\156\164\x69\164\x79\104\145\x73\x63\162\x69\160\164\x6f\162\x3e\x2e");
        goto HP;
        er:
        throw new Exception("\x4d\151\163\x73\151\156\x67\40\162\145\x71\165\x69\162\145\x64\40\74\x49\104\120\x53\123\x4f\104\x65\x73\143\x72\151\160\164\x6f\x72\x3e\x20\151\x6e\x20\74\105\156\164\x69\x74\171\x44\x65\x73\143\162\x69\x70\x74\157\162\x3e\56");
        HP:
        $kP = $gN[0];
        $Fh = Utilities::xpQuery($uQ, "\56\57\163\x61\x6d\154\x5f\x6d\145\164\x61\144\141\164\141\x3a\105\x78\164\145\x6e\x73\151\x6f\156\x73");
        if (!$Fh) {
            goto QQ;
        }
        $this->parseInfo($kP);
        QQ:
        $this->parseSSOService($kP);
        $this->parseSLOService($kP);
        $this->parsex509Certificate($kP);
    }
    private function parseInfo($uQ)
    {
        $Hy = Utilities::xpQuery($uQ, "\56\57\155\144\x75\x69\72\125\111\111\156\146\157\57\x6d\144\x75\151\x3a\104\x69\163\x70\154\x61\x79\116\141\155\x65");
        foreach ($Hy as $hL) {
            if (!($hL->hasAttribute("\170\x6d\154\x3a\x6c\141\x6e\147") && $hL->getAttribute("\x78\x6d\154\72\x6c\141\x6e\147") == "\x65\x6e")) {
                goto ZR;
            }
            $this->idpName = $hL->textContent;
            ZR:
            uo:
        }
        ok:
    }
    private function parseSSOService($uQ)
    {
        $my = Utilities::xpQuery($uQ, "\56\57\163\x61\x6d\x6c\x5f\155\145\x74\141\144\x61\x74\141\x3a\x53\151\x6e\x67\154\x65\x53\151\x67\156\117\156\x53\145\x72\166\151\x63\145");
        foreach ($my as $AJ) {
            $Ad = str_replace("\165\x72\156\72\157\141\163\x69\163\x3a\x6e\x61\x6d\x65\163\72\x74\143\72\123\x41\115\114\x3a\62\56\60\x3a\x62\151\x6e\144\x69\156\147\x73\72", '', $AJ->getAttribute("\x42\x69\156\x64\x69\x6e\x67"));
            $this->loginDetails = array_merge($this->loginDetails, array($Ad => $AJ->getAttribute("\x4c\x6f\x63\141\164\x69\x6f\156")));
            wE:
        }
        rU:
    }
    private function parseSLOService($uQ)
    {
        $i8 = Utilities::xpQuery($uQ, "\56\57\163\x61\x6d\154\137\155\x65\x74\141\144\x61\x74\141\72\x53\x69\x6e\x67\154\x65\x4c\x6f\147\157\x75\x74\x53\145\x72\x76\x69\143\145");
        foreach ($i8 as $eB) {
            $Ad = str_replace("\x75\162\156\x3a\157\x61\163\x69\x73\72\156\x61\155\145\x73\x3a\164\x63\x3a\x53\101\115\114\x3a\62\56\60\72\142\151\156\144\151\156\147\x73\72", '', $eB->getAttribute("\102\151\x6e\x64\x69\156\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($Ad => $eB->getAttribute("\x4c\x6f\143\141\164\151\x6f\x6e")));
            GO:
        }
        LL:
    }
    private function parsex509Certificate($uQ)
    {
        foreach (Utilities::xpQuery($uQ, "\56\x2f\163\141\155\154\x5f\155\145\164\141\144\x61\164\x61\x3a\x4b\145\171\104\x65\x73\x63\x72\151\x70\164\x6f\x72") as $uT) {
            if ($uT->hasAttribute("\165\x73\x65")) {
                goto fr;
            }
            $this->parseSigningCertificate($uT);
            goto z2;
            fr:
            if ($uT->getAttribute("\x75\163\x65") == "\x65\x6e\143\x72\171\x70\164\x69\x6f\x6e") {
                goto dO1;
            }
            $this->parseSigningCertificate($uT);
            goto Ob;
            dO1:
            $this->parseEncryptionCertificate($uT);
            Ob:
            z2:
            cS:
        }
        si:
    }
    private function parseSigningCertificate($uQ)
    {
        $Cd = Utilities::xpQuery($uQ, "\x2e\57\x64\x73\x3a\x4b\x65\171\x49\x6e\x66\157\x2f\144\x73\x3a\x58\x35\60\71\x44\x61\x74\141\57\144\163\72\x58\x35\60\x39\x43\145\162\x74\151\x66\x69\143\141\164\x65");
        $ik = trim($Cd[0]->textContent);
        $ik = str_replace(array("\xd", "\12", "\11", "\40"), '', $ik);
        if (empty($Cd)) {
            goto Y_;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($ik));
        Y_:
    }
    private function parseEncryptionCertificate($uQ)
    {
        $Cd = Utilities::xpQuery($uQ, "\x2e\x2f\x64\x73\72\113\145\171\111\x6e\146\x6f\x2f\x64\x73\72\x58\65\60\x39\104\141\164\141\57\144\x73\x3a\130\65\60\x39\x43\145\x72\x74\151\x66\x69\x63\x61\x74\x65");
        $ik = trim($Cd[0]->textContent);
        $ik = str_replace(array("\15", "\12", "\x9", "\x20"), '', $ik);
        if (empty($Cd)) {
            goto Pp;
        }
        array_push($this->encryptionCertificate, $ik);
        Pp:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($Ad)
    {
        return $this->loginDetails[$Ad];
    }
    public function getLogoutURL($Ad)
    {
        return isset($this->logoutDetails[$Ad]) ? $this->logoutDetails[$Ad] : '';
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
