<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($mD, $o4, $u1, $X0, $MR, $yV, $cn)
    {
        $vm = variable_get("\155\151\x6e\x69\x6f\x72\x61\x6e\147\145\137\x6e\x61\155\145\151\x64\x5f\x66\157\162\x6d\141\164", '');
        $Ka = Utilities::createAuthnRequest($mD, $u1, $o4, $vm, "\x66\141\154\163\145", $MR);
        $this->sendSamlRequestByBindingType($Ka, $MR, $X0, $o4, $yV, $cn);
    }
    function sendSamlRequestByBindingType($Mq, $MR, $ak, $IA, $yV, $cn)
    {
        $t6 = drupal_get_path("\155\157\x64\x75\154\145", "\155\x69\x6e\x69\x6f\x72\141\x6e\x67\x65\x5f\x73\x61\155\x6c");
        if (empty($MR) || $MR == "\x48\124\124\x50\x2d\x52\145\x64\x69\162\145\143\164") {
            goto Yd;
        }
        if ($yV) {
            goto ZP;
        }
        $Nt = base64_encode($Mq);
        Utilities::postSAMLRequest($IA, $Nt, $ak);
        die;
        ZP:
        $xs = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $t6 . DIRECTORY_SEPARATOR . "\x72\145\163\x6f\165\162\x63\145\163" . DIRECTORY_SEPARATOR . Utilities::getKeyName();
        $Es = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $t6 . DIRECTORY_SEPARATOR . "\x72\x65\163\157\x75\x72\x63\145\163" . DIRECTORY_SEPARATOR . Utilities::getCertficateName();
        $Nt = Utilities::signXML($Mq, $Es, $xs, "\116\x61\155\145\x49\104\x50\x6f\154\x69\x63\x79", $cn);
        Utilities::postSAMLRequest($IA, $Nt, $ak);
        goto RU;
        Yd:
        $Mq = "\x53\101\x4d\x4c\x52\x65\161\165\x65\x73\164\75" . $Mq . "\x26\x52\x65\154\141\171\123\x74\x61\x74\145\x3d" . $ak;
        $E4 = array("\164\x79\x70\x65" => "\160\162\x69\x76\141\x74\x65");
        if ($cn == "\x52\123\101\x5f\123\x48\101\x32\65\x36") {
            goto Lp;
        }
        if ($cn == "\x52\x53\101\x5f\123\110\x41\63\x38\x34") {
            goto CD;
        }
        if ($cn == "\x52\123\x41\x5f\123\x48\x41\x35\61\62") {
            goto qe;
        }
        if ($cn == "\x52\123\x41\x5f\x53\110\x41\x31") {
            goto oi;
        }
        goto br;
        Lp:
        $Rh = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $E4);
        goto br;
        CD:
        $Rh = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $E4);
        goto br;
        qe:
        $Rh = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $E4);
        goto br;
        oi:
        $Rh = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $E4);
        br:
        $oj = Utilities::getKeyPath();
        $Rh->loadKey($oj, TRUE);
        $wG = new XMLSecurityDSig();
        $yN = $Rh->signData($Mq);
        $yN = base64_encode($yN);
        $T9 = $IA;
        if (strpos($IA, "\77") !== false) {
            goto wW;
        }
        $T9 .= "\x3f";
        goto iC;
        wW:
        $T9 .= "\46";
        iC:
        if ($yV) {
            goto op;
        }
        $T9 .= $Mq;
        goto cN;
        op:
        if ($cn == "\x52\x53\x41\137\x53\110\101\62\65\x36") {
            goto IU;
        }
        if ($cn == "\x52\x53\101\x5f\123\110\x41\x33\x38\64") {
            goto La;
        }
        if ($cn == "\122\123\101\137\x53\110\x41\65\x31\62") {
            goto m6;
        }
        if ($cn == "\122\x53\x41\137\123\110\x41\x31") {
            goto vG;
        }
        goto Hk;
        IU:
        $T9 .= $Mq . "\x26\123\151\x67\x41\154\x67\75" . urlencode(XMLSecurityKey::RSA_SHA256) . "\x26\123\151\x67\x6e\141\x74\x75\162\x65\x3d" . urlencode($yN);
        goto Hk;
        La:
        $T9 .= $Mq . "\46\123\x69\147\x41\x6c\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA384) . "\46\x53\x69\147\x6e\141\x74\x75\162\x65\x3d" . urlencode($yN);
        goto Hk;
        m6:
        $T9 .= $Mq . "\46\x53\151\x67\x41\154\147\75" . urlencode(XMLSecurityKey::RSA_SHA512) . "\46\x53\x69\147\x6e\x61\164\165\x72\x65\x3d" . urlencode($yN);
        goto Hk;
        vG:
        $T9 .= $Mq . "\46\123\x69\x67\x41\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\x53\x69\x67\156\x61\x74\x75\x72\145\75" . urlencode($yN);
        Hk:
        cN:
        header("\114\x6f\143\141\x74\151\x6f\x6e\x3a\x20" . $T9);
        die;
        RU:
    }
}
