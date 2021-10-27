<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($xv, $ec, $k3, $UB, $Hb, $eD, $dN)
    {
        $oW = variable_get("\155\x69\156\151\157\x72\x61\x6e\x67\x65\x5f\156\x61\155\x65\x69\x64\x5f\146\x6f\x72\155\141\164", '');
        $eI = Utilities::createAuthnRequest($xv, $k3, $ec, $oW, "\146\141\x6c\163\145", $Hb);
        $this->sendSamlRequestByBindingType($eI, $Hb, $UB, $ec, $eD, $dN);
    }
    function sendSamlRequestByBindingType($FN, $Hb, $eW, $QF, $eD, $dN)
    {
        $kg = drupal_get_path("\155\157\144\165\x6c\x65", "\x6d\x69\156\x69\x6f\162\141\156\x67\x65\x5f\163\x61\155\154");
        if (empty($Hb) || $Hb == "\x48\124\x54\120\55\122\145\x64\151\162\145\143\164") {
            goto zz;
        }
        if ($eD) {
            goto aM;
        }
        $uV = base64_encode($FN);
        Utilities::postSAMLRequest($QF, $uV, $eW);
        exit;
        aM:
        $I3 = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $kg . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\165\162\143\145\163" . DIRECTORY_SEPARATOR . Utilities::getKeyName();
        $ZA = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $kg . DIRECTORY_SEPARATOR . "\162\145\163\x6f\165\162\143\145\x73" . DIRECTORY_SEPARATOR . Utilities::getCertficateName();
        $uV = Utilities::signXML($FN, $ZA, $I3, "\116\141\155\x65\111\x44\x50\x6f\154\151\143\x79", $dN);
        Utilities::postSAMLRequest($QF, $uV, $eW);
        goto tR;
        zz:
        $FN = "\x53\x41\x4d\114\x52\145\x71\x75\145\x73\164\x3d" . $FN . "\x26\122\145\x6c\x61\171\123\x74\141\164\145\75" . $eW;
        $PE = array("\164\x79\160\145" => "\160\x72\151\x76\x61\164\x65");
        if ($dN == "\122\123\x41\137\x53\x48\101\62\65\66") {
            goto zb;
        }
        if ($dN == "\x52\x53\101\x5f\x53\110\x41\x33\70\64") {
            goto VN;
        }
        if ($dN == "\122\123\x41\x5f\123\110\101\x35\x31\62") {
            goto kt;
        }
        if ($dN == "\122\x53\101\x5f\x53\x48\101\x31") {
            goto pG;
        }
        goto za;
        zb:
        $hG = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $PE);
        goto za;
        VN:
        $hG = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $PE);
        goto za;
        kt:
        $hG = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $PE);
        goto za;
        pG:
        $hG = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $PE);
        za:
        $XW = Utilities::getKeyPath();
        $hG->loadKey($XW, TRUE);
        $hX = new XMLSecurityDSig();
        $lv = $hG->signData($FN);
        $lv = base64_encode($lv);
        $j6 = $QF;
        if (strpos($QF, "\x3f") !== false) {
            goto pA;
        }
        $j6 .= "\x3f";
        goto UV;
        pA:
        $j6 .= "\x26";
        UV:
        if ($eD) {
            goto Tg;
        }
        $j6 .= $FN;
        goto f5;
        Tg:
        if ($dN == "\122\123\x41\x5f\123\x48\101\62\65\66") {
            goto wf;
        }
        if ($dN == "\x52\123\101\x5f\123\x48\x41\x33\70\x34") {
            goto DY;
        }
        if ($dN == "\122\123\x41\137\x53\x48\101\x35\61\x32") {
            goto bo;
        }
        if ($dN == "\x52\x53\x41\137\x53\110\101\61") {
            goto Av;
        }
        goto e2;
        wf:
        $j6 .= $FN . "\46\x53\151\x67\101\x6c\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\46\x53\151\x67\x6e\141\x74\x75\x72\x65\x3d" . urlencode($lv);
        goto e2;
        DY:
        $j6 .= $FN . "\x26\x53\x69\x67\x41\x6c\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\x53\151\147\156\141\x74\x75\162\145\75" . urlencode($lv);
        goto e2;
        bo:
        $j6 .= $FN . "\46\x53\x69\147\101\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA512) . "\46\x53\x69\x67\156\x61\164\165\x72\x65\x3d" . urlencode($lv);
        goto e2;
        Av:
        $j6 .= $FN . "\46\123\x69\147\x41\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\123\x69\x67\156\141\x74\165\162\145\75" . urlencode($lv);
        e2:
        f5:
        header("\x4c\157\143\x61\164\x69\157\x6e\x3a\40" . $j6);
        exit;
        tR:
    }
}
