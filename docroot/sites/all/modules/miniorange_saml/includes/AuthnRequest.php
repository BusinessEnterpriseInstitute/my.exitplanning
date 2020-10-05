<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($sM, $Mb, $mP, $mD, $mh, $XS, $dd)
    {
        $gH = variable_get("\155\x69\x6e\151\157\x72\141\x6e\x67\x65\137\156\x61\x6d\145\x69\x64\137\x66\x6f\x72\x6d\x61\x74", '');
        $JI = Utilities::createAuthnRequest($sM, $mP, $Mb, $gH, "\x66\141\154\x73\145", $mh);
        $this->sendSamlRequestByBindingType($JI, $mh, $mD, $Mb, $XS, $dd);
    }
    function sendSamlRequestByBindingType($Bp, $mh, $PL, $tP, $XS, $dd)
    {
        $D6 = drupal_get_path("\155\x6f\144\165\x6c\x65", "\x6d\x69\156\x69\157\162\141\156\x67\145\x5f\163\141\155\154");
        if (empty($mh) || $mh == "\110\x54\x54\120\x2d\x52\x65\x64\x69\x72\x65\143\164") {
            goto S3;
        }
        if ($XS) {
            goto LD;
        }
        $tM = base64_encode($Bp);
        Utilities::postSAMLRequest($tP, $tM, $PL);
        die;
        LD:
        $Ys = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $D6 . DIRECTORY_SEPARATOR . "\x72\145\x73\157\x75\x72\143\x65\x73" . DIRECTORY_SEPARATOR . Utilities::getKeyName();
        $ij = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $D6 . DIRECTORY_SEPARATOR . "\162\145\163\157\x75\x72\143\145\x73" . DIRECTORY_SEPARATOR . Utilities::getCertficateName();
        $tM = Utilities::signXML($Bp, $ij, $Ys, "\116\x61\155\145\x49\x44\x50\x6f\154\x69\x63\x79", $dd);
        Utilities::postSAMLRequest($tP, $tM, $PL);
        goto JY;
        S3:
        $Bp = "\123\x41\115\114\x52\x65\161\165\x65\x73\x74\x3d" . $Bp . "\x26\122\145\x6c\141\x79\123\164\x61\164\145\x3d" . $PL;
        $IF = array("\164\x79\x70\x65" => "\x70\162\151\x76\141\164\145");
        if ($dd == "\x52\123\101\x5f\x53\110\101\62\65\x36") {
            goto J1;
        }
        if ($dd == "\x52\123\x41\137\x53\x48\x41\x33\70\64") {
            goto G5;
        }
        if ($dd == "\x52\123\x41\137\x53\x48\101\x35\61\x32") {
            goto BV;
        }
        if ($dd == "\122\123\x41\137\x53\x48\101\x31") {
            goto Rq;
        }
        goto Zt;
        J1:
        $xt = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $IF);
        goto Zt;
        G5:
        $xt = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $IF);
        goto Zt;
        BV:
        $xt = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $IF);
        goto Zt;
        Rq:
        $xt = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $IF);
        Zt:
        $qK = Utilities::getKeyPath();
        $xt->loadKey($qK, TRUE);
        $th = new XMLSecurityDSig();
        $V0 = $xt->signData($Bp);
        $V0 = base64_encode($V0);
        $c1 = $tP;
        if (strpos($tP, "\x3f") !== false) {
            goto Zq;
        }
        $c1 .= "\77";
        goto U9;
        Zq:
        $c1 .= "\x26";
        U9:
        if ($XS) {
            goto jR;
        }
        $c1 .= $Bp;
        goto pa;
        jR:
        if ($dd == "\x52\x53\x41\x5f\123\110\x41\x32\65\x36") {
            goto Od;
        }
        if ($dd == "\x52\x53\101\137\x53\110\101\63\70\x34") {
            goto oe;
        }
        if ($dd == "\x52\x53\x41\137\123\110\x41\x35\61\x32") {
            goto nb;
        }
        if ($dd == "\x52\123\x41\137\123\110\x41\61") {
            goto eB;
        }
        goto Ru;
        Od:
        $c1 .= $Bp . "\x26\123\151\x67\101\x6c\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\46\123\151\147\156\x61\x74\165\x72\x65\x3d" . urlencode($V0);
        goto Ru;
        oe:
        $c1 .= $Bp . "\x26\x53\151\147\101\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\x53\x69\147\x6e\141\164\165\x72\x65\x3d" . urlencode($V0);
        goto Ru;
        nb:
        $c1 .= $Bp . "\x26\123\151\x67\101\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA512) . "\x26\x53\151\147\156\x61\x74\165\x72\145\x3d" . urlencode($V0);
        goto Ru;
        eB:
        $c1 .= $Bp . "\46\123\151\147\101\x6c\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA1) . "\x26\123\x69\x67\156\x61\x74\x75\x72\x65\x3d" . urlencode($V0);
        Ru:
        pa:
        header("\114\157\x63\141\164\151\157\156\72\40" . $c1);
        die;
        JY:
    }
}
