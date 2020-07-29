<?php


class MetadataReader
{
    private $serviceProviders;
    public function __construct(\DOMNode $RH = NULL)
    {
        $this->serviceProviders = array();
        $fp = Utilities::xpQuery($RH, "\x2e\57\x73\141\x6d\x6c\x5f\x6d\145\x74\141\x64\x61\x74\141\x3a\105\x6e\x74\x69\x74\x79\104\x65\163\143\162\x69\x70\x74\x6f\x72");
        foreach ($fp as $sC) {
            $RZ = Utilities::xpQuery($sC, "\x2e\57\163\141\x6d\154\x5f\x6d\145\x74\x61\144\141\x74\141\x3a\123\120\x53\123\x4f\x44\x65\x73\x63\x72\x69\x70\x74\x6f\162");
            if (!(isset($RZ) && !empty($RZ))) {
                goto GI;
            }
            array_push($this->serviceProviders, new ServiceProviders($sC));
            GI:
            Mt:
        }
        Yh:
    }
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }
}
class ServiceProviders
{
    private $entityID;
    private $acsURL;
    private $logoutDetails;
    private $assertionsSigned;
    private $signingCertificate;
    public function __construct(\DOMElement $RH = NULL)
    {
        $this->signingCertificate = array();
        $this->logoutDetails = array();
        if (!$RH->hasAttribute("\145\x6e\164\x69\x74\x79\111\104")) {
            goto bF;
        }
        $this->entityID = $RH->getAttribute("\145\x6e\x74\151\x74\x79\111\104");
        bF:
        $RZ = Utilities::xpQuery($RH, "\x2e\57\x73\x61\155\x6c\137\155\x65\164\x61\x64\141\x74\141\72\123\120\x53\x53\x4f\x44\145\x73\x63\x72\151\x70\164\157\x72");
        if (count($RZ) > 1) {
            goto B6;
        }
        if (empty($RZ)) {
            goto oX;
        }
        goto Ac;
        B6:
        throw new Exception("\115\157\162\x65\40\x74\150\141\x6e\x20\x6f\x6e\145\x20\x3c\x53\x50\x53\123\117\x44\x65\163\x63\162\151\x70\x74\x6f\x72\x3e\x20\x69\156\x20\74\105\156\x74\151\x74\x79\x44\145\163\x63\162\x69\x70\x74\157\162\76\56");
        goto Ac;
        oX:
        throw new Exception("\x4d\x69\x73\x73\x69\x6e\147\40\162\145\161\165\151\162\x65\x64\40\74\123\x50\x53\x53\117\104\145\x73\x63\x72\x69\160\164\x6f\x72\x3e\40\151\156\40\x3c\105\x6e\x74\x69\x74\171\x44\x65\163\x63\x72\151\x70\x74\x6f\162\x3e\x2e");
        Ac:
        $this->parseAcsURL($RZ);
        $this->parseLogoutURL($RZ);
        $this->assertionsSigned($RZ);
        $this->parsex509Certificate($RZ);
    }
    private function parsex509Certificate($RH)
    {
        $Cu = Utilities::xpQuery($RH[0], "\x2e\57\163\x61\x6d\x6c\137\x6d\x65\164\x61\144\x61\x74\x61\x3a\113\x65\x79\x44\145\x73\143\x72\x69\x70\x74\157\162");
        foreach ($Cu as $bG) {
            if ($bG->hasAttribute("\x75\x73\145")) {
                goto LX;
            }
            $this->parseSigningCertificate($bG);
            goto v0;
            LX:
            if (!($bG->getAttribute("\165\x73\145") == "\x73\x69\147\156\151\156\147")) {
                goto rz;
            }
            $this->parseSigningCertificate($bG);
            rz:
            v0:
            BG:
        }
        ji:
    }
    private function parseSigningCertificate($RH)
    {
        $Nl = Utilities::xpQuery($RH, "\56\57\144\163\72\113\145\171\x49\x6e\x66\157\57\144\163\x3a\130\x35\60\71\x44\x61\x74\141\x2f\x64\x73\72\x58\x35\60\71\103\x65\x72\x74\x69\146\151\143\141\x74\x65");
        $wd = trim($Nl[0]->textContent);
        $wd = str_replace(array("\xd", "\xa", "\x9", "\40"), '', $wd);
        if (empty($Nl)) {
            goto tY;
        }
        $this->signingCertificate = Utilities::sanitize_certificate($wd);
        tY:
    }
    private function parseAcsURL($RZ)
    {
        $kw = Utilities::xpQuery($RZ[0], "\56\57\163\141\x6d\x6c\x5f\x6d\145\164\141\x64\141\x74\141\x3a\x41\163\x73\x65\x72\x74\151\x6f\156\x43\x6f\x6e\163\x75\155\145\162\123\x65\162\x76\x69\143\x65");
        foreach ($kw as $EV) {
            if (!$EV->hasAttribute("\x4c\157\143\141\164\x69\x6f\x6e")) {
                goto zf;
            }
            $this->acsURL = $EV->getAttribute("\114\157\x63\141\x74\151\157\156");
            zf:
            Mp:
        }
        iY:
    }
    private function assertionsSigned($RZ)
    {
        foreach ($RZ as $EV) {
            if (!$EV->hasAttribute("\x57\x61\x6e\x74\x41\x73\x73\145\162\x74\151\157\x6e\x73\x53\x69\x67\x6e\145\144")) {
                goto jj;
            }
            $this->assertionsSigned = $EV->getAttribute("\x57\141\156\x74\101\x73\163\145\162\164\x69\x6f\x6e\163\x53\x69\x67\x6e\145\x64");
            jj:
            im:
        }
        zW:
    }
    private function parseLogoutURL($RH)
    {
        $Zn = Utilities::xpQuery($RH[0], "\56\57\x73\141\155\x6c\x5f\x6d\145\x74\x61\x64\x61\x74\141\x3a\123\x69\x6e\x67\154\x65\114\157\x67\x6f\x75\x74\123\145\x72\x76\x69\x63\x65");
        foreach ($Zn as $zk) {
            $xF = str_replace("\165\x72\x6e\x3a\157\141\163\151\x73\72\x6e\x61\155\145\x73\72\164\x63\x3a\123\x41\x4d\x4c\x3a\62\x2e\60\x3a\x62\x69\156\144\151\x6e\147\163\x3a", '', $zk->getAttribute("\102\151\x6e\144\x69\x6e\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($xF => $zk->getAttribute("\x4c\157\143\x61\x74\151\157\156")));
            o1:
        }
        k0:
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getAcsURL()
    {
        return $this->acsURL;
    }
    public function getAssertionsSigned()
    {
        return $this->assertionsSigned;
    }
    public function getSigningCertificate()
    {
        return $this->signingCertificate;
    }
    public function getLogoutURL($xF)
    {
        return isset($this->logoutDetails[$xF]) ? $this->logoutDetails[$xF] : '';
    }
}
