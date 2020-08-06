<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $TW = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $sV = Utilities::xpQuery($TW, "\x2e\57\163\141\x6d\x6c\x5f\155\145\164\x61\x64\141\x74\141\72\x45\156\164\x69\x74\171\x44\x65\x73\143\162\151\160\164\x6f\162");
        foreach ($sV as $cY) {
            $h1 = Utilities::xpQuery($cY, "\56\x2f\x73\141\x6d\x6c\137\x6d\x65\x74\x61\x64\x61\x74\141\x3a\111\104\x50\x53\123\x4f\104\145\163\143\162\151\x70\x74\157\162");
            if (!(isset($h1) && !empty($h1))) {
                goto qK;
            }
            array_push($this->identityProviders, new IdentityProviders($cY));
            qK:
            nj:
        }
        Ry:
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
    public function __construct(DOMElement $TW = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$TW->hasAttribute("\145\156\164\x69\x74\x79\x49\x44")) {
            goto fM;
        }
        $this->entityID = $TW->getAttribute("\x65\x6e\x74\151\x74\171\111\104");
        fM:
        if (!$TW->hasAttribute("\x57\141\x6e\x74\x41\165\x74\x68\156\122\145\161\165\x65\163\164\x73\123\151\147\156\145\144")) {
            goto m9;
        }
        $this->signedRequest = $TW->getAttribute("\127\141\156\x74\101\x75\x74\150\x6e\122\145\161\x75\x65\163\x74\163\123\x69\x67\156\145\x64");
        m9:
        $h1 = Utilities::xpQuery($TW, "\x2e\x2f\x73\141\x6d\154\137\155\x65\x74\141\x64\141\164\x61\72\x49\x44\x50\x53\x53\x4f\104\x65\x73\143\x72\x69\160\x74\x6f\162");
        if (count($h1) > 1) {
            goto oL;
        }
        if (empty($h1)) {
            goto RU;
        }
        goto Cw;
        oL:
        throw new Exception("\x4d\x6f\x72\x65\40\x74\150\x61\x6e\x20\157\x6e\145\x20\x3c\x49\x44\120\123\123\117\x44\145\x73\143\162\151\x70\164\x6f\x72\76\x20\151\x6e\40\x3c\105\x6e\x74\151\x74\x79\104\x65\x73\x63\x72\151\160\164\157\162\x3e\x2e");
        goto Cw;
        RU:
        throw new Exception("\115\x69\163\163\151\156\147\40\162\145\x71\165\x69\162\145\144\x20\74\111\104\120\x53\123\x4f\x44\x65\x73\x63\x72\x69\160\x74\x6f\x72\x3e\40\x69\156\40\x3c\105\x6e\164\151\x74\x79\x44\x65\x73\143\162\151\x70\x74\157\162\76\56");
        Cw:
        $kD = $h1[0];
        $ss = Utilities::xpQuery($TW, "\56\57\163\141\x6d\154\x5f\x6d\x65\164\x61\144\141\164\141\72\x45\170\x74\x65\156\163\x69\157\156\163");
        if (!$ss) {
            goto nV;
        }
        $this->parseInfo($kD);
        nV:
        $this->parseSSOService($kD);
        $this->parseSLOService($kD);
        $this->parsex509Certificate($kD);
    }
    private function parseInfo($TW)
    {
        $om = Utilities::xpQuery($TW, "\x2e\57\x6d\x64\x75\151\72\125\x49\x49\x6e\146\x6f\57\x6d\x64\165\151\x3a\104\151\x73\x70\x6c\x61\x79\x4e\141\x6d\x65");
        foreach ($om as $n3) {
            if (!($n3->hasAttribute("\x78\x6d\x6c\x3a\x6c\x61\x6e\147") && $n3->getAttribute("\170\155\x6c\72\154\141\x6e\x67") == "\145\156")) {
                goto X0;
            }
            $this->idpName = $n3->textContent;
            X0:
            LO:
        }
        SE:
    }
    private function parseSSOService($TW)
    {
        $ic = Utilities::xpQuery($TW, "\x2e\x2f\x73\x61\155\x6c\137\155\145\x74\141\144\x61\164\141\x3a\x53\151\156\147\154\145\123\151\x67\x6e\117\156\x53\145\162\x76\x69\143\145");
        foreach ($ic as $gN) {
            $Xb = str_replace("\x75\x72\156\x3a\157\141\163\151\163\x3a\156\141\x6d\x65\x73\72\x74\143\72\x53\x41\115\x4c\72\62\x2e\60\72\142\x69\x6e\144\151\156\147\163\72", '', $gN->getAttribute("\x42\x69\156\x64\151\156\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($Xb => $gN->getAttribute("\114\x6f\x63\141\164\x69\x6f\x6e")));
            mN:
        }
        Ze:
    }
    private function parseSLOService($TW)
    {
        $lW = Utilities::xpQuery($TW, "\x2e\57\x73\x61\155\x6c\x5f\x6d\x65\x74\x61\x64\x61\164\141\x3a\123\151\x6e\x67\154\x65\114\157\x67\x6f\x75\164\x53\145\x72\166\151\x63\x65");
        foreach ($lW as $e4) {
            $Xb = str_replace("\x75\x72\x6e\72\157\141\163\x69\x73\x3a\x6e\x61\x6d\x65\x73\72\x74\x63\x3a\123\x41\x4d\114\x3a\62\x2e\60\72\x62\x69\x6e\x64\x69\156\x67\x73\72", '', $e4->getAttribute("\102\151\x6e\x64\151\x6e\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($Xb => $e4->getAttribute("\114\157\143\141\164\151\x6f\x6e")));
            An:
        }
        fJ:
    }
    private function parsex509Certificate($TW)
    {
        foreach (Utilities::xpQuery($TW, "\x2e\57\163\x61\155\154\137\155\x65\x74\x61\144\141\x74\x61\x3a\113\145\171\x44\145\x73\x63\162\x69\x70\x74\157\x72") as $lB) {
            if ($lB->hasAttribute("\165\163\x65")) {
                goto OJ;
            }
            $this->parseSigningCertificate($lB);
            goto Sw;
            OJ:
            if ($lB->getAttribute("\165\x73\x65") == "\x65\156\143\x72\x79\x70\164\x69\157\156") {
                goto Vu;
            }
            $this->parseSigningCertificate($lB);
            goto fX;
            Vu:
            $this->parseEncryptionCertificate($lB);
            fX:
            Sw:
            Oj:
        }
        dG:
    }
    private function parseSigningCertificate($TW)
    {
        $Iu = Utilities::xpQuery($TW, "\x2e\x2f\x64\x73\x3a\x4b\x65\x79\x49\x6e\x66\157\57\x64\163\72\x58\x35\x30\71\x44\x61\164\x61\57\144\163\72\130\x35\60\71\103\x65\x72\x74\151\x66\x69\143\141\164\x65");
        $Em = trim($Iu[0]->textContent);
        $Em = str_replace(array("\15", "\xa", "\11", "\x20"), '', $Em);
        if (empty($Iu)) {
            goto Xs;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($Em));
        Xs:
    }
    private function parseEncryptionCertificate($TW)
    {
        $Iu = Utilities::xpQuery($TW, "\56\x2f\x64\x73\x3a\x4b\145\171\x49\156\146\x6f\x2f\144\x73\x3a\130\x35\x30\71\x44\x61\164\141\x2f\144\x73\72\x58\65\x30\x39\x43\145\162\164\x69\146\x69\143\x61\164\145");
        $Em = trim($Iu[0]->textContent);
        $Em = str_replace(array("\xd", "\12", "\x9", "\x20"), '', $Em);
        if (empty($Iu)) {
            goto qE;
        }
        array_push($this->encryptionCertificate, $Em);
        qE:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($Xb)
    {
        return $this->loginDetails[$Xb];
    }
    public function getLogoutURL($Xb)
    {
        return isset($this->logoutDetails[$Xb]) ? $this->logoutDetails[$Xb] : '';
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
