<?php


class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $r2 = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $q3 = Utilities::xpQuery($r2, "\56\x2f\163\x61\155\x6c\x5f\x6d\x65\164\141\x64\141\164\141\x3a\105\156\x74\x69\164\x79\104\145\163\x63\x72\151\x70\164\157\162");
        foreach ($q3 as $yJ) {
            $YE = Utilities::xpQuery($yJ, "\x2e\x2f\x73\141\x6d\x6c\x5f\x6d\x65\164\141\144\x61\164\141\x3a\x49\x44\x50\x53\123\x4f\104\x65\x73\143\162\151\x70\x74\157\x72");
            if (!(isset($YE) && !empty($YE))) {
                goto cE;
            }
            array_push($this->identityProviders, new IdentityProviders($yJ));
            cE:
            SA:
        }
        nN:
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
    public function __construct(DOMElement $r2 = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$r2->hasAttribute("\145\x6e\x74\151\x74\x79\x49\x44")) {
            goto Fq;
        }
        $this->entityID = $r2->getAttribute("\145\x6e\x74\151\x74\171\111\104");
        Fq:
        if (!$r2->hasAttribute("\127\141\156\x74\x41\x75\x74\150\156\x52\x65\x71\x75\x65\163\x74\x73\123\151\x67\x6e\145\144")) {
            goto kW;
        }
        $this->signedRequest = $r2->getAttribute("\127\x61\x6e\x74\101\165\x74\x68\x6e\122\145\161\x75\x65\163\164\x73\123\x69\x67\x6e\145\x64");
        kW:
        $YE = Utilities::xpQuery($r2, "\56\57\x73\141\x6d\154\x5f\155\145\x74\141\144\141\164\x61\x3a\111\x44\x50\123\x53\117\x44\x65\x73\x63\162\151\160\x74\157\x72");
        if (count($YE) > 1) {
            goto Pp;
        }
        if (empty($YE)) {
            goto Lb;
        }
        goto Tb;
        Pp:
        throw new Exception("\115\x6f\x72\145\x20\164\150\141\x6e\40\157\156\x65\40\74\111\104\x50\123\123\x4f\104\x65\163\143\x72\x69\160\164\x6f\162\76\40\151\x6e\x20\x3c\105\156\x74\151\164\x79\104\145\x73\143\x72\151\x70\164\x6f\x72\76\x2e");
        goto Tb;
        Lb:
        throw new Exception("\115\x69\163\163\151\156\x67\40\162\145\161\165\151\x72\x65\x64\x20\74\x49\x44\x50\123\123\x4f\x44\x65\x73\x63\x72\151\x70\164\157\162\76\x20\x69\x6e\40\74\105\x6e\164\x69\x74\171\x44\x65\163\143\162\151\160\x74\x6f\x72\76\56");
        Tb:
        $iI = $YE[0];
        $Fg = Utilities::xpQuery($r2, "\x2e\x2f\163\x61\155\154\x5f\x6d\x65\164\141\x64\x61\x74\x61\x3a\105\170\x74\145\x6e\x73\x69\157\x6e\x73");
        if (!$Fg) {
            goto WI;
        }
        $this->parseInfo($iI);
        WI:
        $this->parseSSOService($iI);
        $this->parseSLOService($iI);
        $this->parsex509Certificate($iI);
    }
    private function parseInfo($r2)
    {
        $HM = Utilities::xpQuery($r2, "\56\57\155\144\x75\151\x3a\125\x49\x49\156\x66\x6f\57\x6d\144\165\151\x3a\x44\151\x73\x70\x6c\141\171\116\x61\x6d\x65");
        foreach ($HM as $GZ) {
            if (!($GZ->hasAttribute("\170\155\154\72\154\x61\x6e\147") && $GZ->getAttribute("\x78\x6d\x6c\72\154\x61\x6e\x67") == "\145\x6e")) {
                goto h_;
            }
            $this->idpName = $GZ->textContent;
            h_:
            Y5:
        }
        jE:
    }
    private function parseSSOService($r2)
    {
        $Z_ = Utilities::xpQuery($r2, "\56\x2f\x73\x61\x6d\154\137\155\145\x74\x61\144\x61\164\141\72\x53\x69\156\x67\154\145\x53\x69\x67\x6e\117\x6e\123\x65\162\166\151\x63\145");
        foreach ($Z_ as $xO) {
            $wq = str_replace("\165\x72\x6e\x3a\x6f\x61\163\x69\163\x3a\x6e\141\x6d\x65\163\72\164\x63\72\123\101\x4d\x4c\72\62\56\x30\72\x62\x69\156\x64\x69\x6e\x67\x73\x3a", '', $xO->getAttribute("\x42\x69\x6e\x64\151\x6e\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($wq => $xO->getAttribute("\114\157\x63\x61\164\x69\x6f\156")));
            lz:
        }
        lb:
    }
    private function parseSLOService($r2)
    {
        $om = Utilities::xpQuery($r2, "\56\x2f\163\x61\x6d\154\137\155\145\x74\x61\144\141\164\141\72\x53\x69\156\147\x6c\x65\114\x6f\x67\157\x75\x74\x53\145\162\166\151\143\x65");
        foreach ($om as $P7) {
            $wq = str_replace("\x75\162\156\72\157\x61\x73\x69\163\72\x6e\141\x6d\145\x73\72\164\x63\x3a\123\x41\115\x4c\72\62\x2e\x30\x3a\x62\x69\156\144\x69\x6e\147\x73\x3a", '', $P7->getAttribute("\102\151\x6e\x64\x69\x6e\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($wq => $P7->getAttribute("\x4c\x6f\143\x61\164\x69\157\x6e")));
            Wn:
        }
        Bo:
    }
    private function parsex509Certificate($r2)
    {
        foreach (Utilities::xpQuery($r2, "\x2e\57\x73\x61\155\154\137\x6d\x65\164\x61\144\141\x74\x61\x3a\x4b\145\171\104\x65\x73\x63\162\151\x70\164\157\x72") as $jH) {
            if ($jH->hasAttribute("\x75\163\145")) {
                goto Td;
            }
            $this->parseSigningCertificate($jH);
            goto fK;
            Td:
            if ($jH->getAttribute("\x75\163\145") == "\x65\x6e\x63\162\171\x70\164\x69\x6f\x6e") {
                goto fb;
            }
            $this->parseSigningCertificate($jH);
            goto sQ;
            fb:
            $this->parseEncryptionCertificate($jH);
            sQ:
            fK:
            d3:
        }
        Kz:
    }
    private function parseSigningCertificate($r2)
    {
        $B6 = Utilities::xpQuery($r2, "\x2e\57\144\x73\72\x4b\x65\x79\111\x6e\x66\157\x2f\144\163\x3a\130\x35\x30\x39\104\x61\x74\141\x2f\144\x73\x3a\x58\x35\x30\71\x43\145\162\164\151\x66\151\143\x61\164\145");
        $gj = trim($B6[0]->textContent);
        $gj = str_replace(array("\xd", "\xa", "\11", "\40"), '', $gj);
        if (empty($B6)) {
            goto pj;
        }
        array_push($this->signingCertificate, Utilities::sanitize_certificate($gj));
        pj:
    }
    private function parseEncryptionCertificate($r2)
    {
        $B6 = Utilities::xpQuery($r2, "\56\57\x64\x73\x3a\x4b\145\x79\x49\x6e\146\157\x2f\144\163\x3a\130\x35\60\71\104\x61\x74\141\57\x64\x73\x3a\x58\x35\60\x39\103\145\x72\x74\x69\146\x69\x63\141\x74\145");
        $gj = trim($B6[0]->textContent);
        $gj = str_replace(array("\xd", "\xa", "\11", "\x20"), '', $gj);
        if (empty($B6)) {
            goto nm;
        }
        array_push($this->encryptionCertificate, $gj);
        nm:
    }
    public function getIdpName()
    {
        return '';
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($wq)
    {
        return $this->loginDetails[$wq];
    }
    public function getLogoutURL($wq)
    {
        return isset($this->logoutDetails[$wq]) ? $this->logoutDetails[$wq] : '';
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
