<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($ZU, $EA, $Pz, $oG, $TY, $g6, $MR)
    {
        $xB = variable_get("\x6d\151\156\151\x6f\162\141\156\147\145\x5f\x6e\x61\x6d\145\x69\144\x5f\x66\x6f\162\155\x61\164", '');
        $h7 = Utilities::createAuthnRequest($ZU, $Pz, $EA, $xB, "\146\141\154\163\145", $TY);
        $this->sendSamlRequestByBindingType($h7, $TY, $oG, $EA, $g6, $MR);
    }
    function sendSamlRequestByBindingType($yk, $TY, $iZ, $E3, $g6, $MR)
    {
        $Oi = drupal_get_path("\155\x6f\144\165\x6c\145", "\x6d\151\x6e\x69\157\x72\x61\x6e\x67\x65\137\x73\141\x6d\x6c");
        if (empty($TY) || $TY == "\110\x54\x54\120\55\122\x65\x64\151\162\145\x63\x74") {
            goto ib;
        }
        if ($g6) {
            goto cK;
        }
        $x4 = base64_encode($yk);
        Utilities::postSAMLRequest($E3, $x4, $iZ);
        die;
        cK:
        $aq = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Oi . DIRECTORY_SEPARATOR . "\x72\x65\x73\x6f\165\162\x63\x65\163" . DIRECTORY_SEPARATOR . Utilities::getKeyName();
        $YD = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Oi . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\x75\162\x63\145\163" . DIRECTORY_SEPARATOR . Utilities::getCertficateName();
        $x4 = Utilities::signXML($yk, $YD, $aq, "\116\141\155\145\111\104\120\x6f\x6c\x69\143\x79", $MR);
        Utilities::postSAMLRequest($E3, $x4, $iZ);
        goto pF;
        ib:
        $yk = "\123\101\115\x4c\122\x65\x71\165\145\x73\164\x3d" . $yk . "\x26\x52\145\154\141\x79\x53\x74\x61\164\x65\x3d" . $iZ;
        $OT = array("\x74\171\160\145" => "\x70\x72\151\166\141\x74\145");
        if ($MR == "\x52\x53\101\x5f\123\110\101\62\x35\66") {
            goto TX;
        }
        if ($MR == "\122\123\x41\x5f\123\x48\101\63\x38\x34") {
            goto Gl;
        }
        if ($MR == "\122\x53\101\x5f\123\x48\101\x35\x31\62") {
            goto H5;
        }
        if ($MR == "\x52\123\101\137\x53\x48\101\x31") {
            goto Tk;
        }
        goto gS;
        TX:
        $l9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $OT);
        goto gS;
        Gl:
        $l9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $OT);
        goto gS;
        H5:
        $l9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $OT);
        goto gS;
        Tk:
        $l9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $OT);
        gS:
        $OK = Utilities::getKeyPath();
        $l9->loadKey($OK, TRUE);
        $ZF = new XMLSecurityDSig();
        $J8 = $l9->signData($yk);
        $J8 = base64_encode($J8);
        $KI = $E3;
        if (strpos($E3, "\77") !== false) {
            goto pG;
        }
        $KI .= "\77";
        goto j3;
        pG:
        $KI .= "\46";
        j3:
        if ($g6) {
            goto a_;
        }
        $KI .= $yk;
        goto FP;
        a_:
        if ($MR == "\122\123\x41\x5f\x53\x48\101\62\x35\66") {
            goto tm;
        }
        if ($MR == "\x52\x53\101\x5f\x53\110\101\x33\70\x34") {
            goto a4;
        }
        if ($MR == "\x52\123\x41\137\x53\110\101\65\x31\x32") {
            goto jy;
        }
        if ($MR == "\122\x53\x41\137\123\110\101\x31") {
            goto k2;
        }
        goto I1;
        tm:
        $KI .= $yk . "\x26\x53\151\x67\101\x6c\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\46\x53\151\x67\156\141\x74\x75\x72\145\75" . urlencode($J8);
        goto I1;
        a4:
        $KI .= $yk . "\x26\x53\x69\147\101\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\123\x69\147\156\141\164\x75\x72\145\x3d" . urlencode($J8);
        goto I1;
        jy:
        $KI .= $yk . "\46\x53\x69\147\x41\x6c\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA512) . "\46\x53\151\x67\x6e\x61\164\165\x72\145\75" . urlencode($J8);
        goto I1;
        k2:
        $KI .= $yk . "\46\x53\151\x67\x41\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA1) . "\x26\x53\x69\147\x6e\x61\164\165\x72\145\75" . urlencode($J8);
        I1:
        FP:
        header("\x4c\157\143\x61\164\151\x6f\x6e\x3a\40" . $KI);
        die;
        pF:
    }
}
