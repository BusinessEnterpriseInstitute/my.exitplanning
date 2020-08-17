<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($Sg, $US, $vH, $P6, $sk, $BB, $aS)
    {
        $pA = variable_get("\155\151\x6e\x69\x6f\x72\x61\156\147\x65\137\x6e\x61\155\145\x69\x64\x5f\146\x6f\x72\155\x61\164", '');
        $HM = Utilities::createAuthnRequest($Sg, $vH, $US, $pA, "\x66\141\x6c\x73\x65", $sk);
        $this->sendSamlRequestByBindingType($HM, $sk, $P6, $US, $BB, $aS);
    }
    function sendSamlRequestByBindingType($O9, $sk, $Ki, $bt, $BB, $aS)
    {
        $na = drupal_get_path("\x6d\x6f\x64\165\x6c\x65", "\155\151\156\151\157\x72\x61\x6e\147\x65\x5f\163\141\155\154");
        if (empty($sk) || $sk == "\x48\124\x54\x50\55\x52\x65\144\x69\x72\x65\x63\x74") {
            goto wi;
        }
        if ($BB) {
            goto GI;
        }
        $bK = base64_encode($O9);
        Utilities::postSAMLRequest($bt, $bK, $Ki);
        die;
        GI:
        $NW = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $na . DIRECTORY_SEPARATOR . "\162\x65\x73\x6f\165\162\143\145\x73" . DIRECTORY_SEPARATOR . Utilities::getKeyName();
        $Ip = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $na . DIRECTORY_SEPARATOR . "\x72\x65\x73\157\x75\x72\143\x65\x73" . DIRECTORY_SEPARATOR . Utilities::getCertficateName();
        $bK = Utilities::signXML($O9, $Ip, $NW, "\x4e\141\x6d\145\111\x44\x50\x6f\154\x69\143\x79", $aS);
        Utilities::postSAMLRequest($bt, $bK, $Ki);
        goto Xo;
        wi:
        $O9 = "\x53\101\x4d\114\122\x65\x71\x75\x65\x73\x74\x3d" . $O9 . "\46\x52\x65\154\141\x79\123\x74\141\164\x65\75" . $Ki;
        $Tu = array("\x74\171\160\145" => "\x70\162\151\x76\141\164\145");
        if ($aS == "\x52\x53\x41\x5f\123\110\101\x32\x35\x36") {
            goto tR;
        }
        if ($aS == "\122\123\101\x5f\x53\110\x41\63\x38\x34") {
            goto TR;
        }
        if ($aS == "\122\x53\101\x5f\123\x48\101\65\x31\62") {
            goto LV;
        }
        if ($aS == "\x52\x53\x41\137\x53\x48\101\x31") {
            goto Wb;
        }
        goto EH;
        tR:
        $AM = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $Tu);
        goto EH;
        TR:
        $AM = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $Tu);
        goto EH;
        LV:
        $AM = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $Tu);
        goto EH;
        Wb:
        $AM = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $Tu);
        EH:
        $VT = Utilities::getKeyPath();
        $AM->loadKey($VT, TRUE);
        $cZ = new XMLSecurityDSig();
        $d9 = $AM->signData($O9);
        $d9 = base64_encode($d9);
        $wD = $bt;
        if (strpos($bt, "\x3f") !== false) {
            goto KY;
        }
        $wD .= "\77";
        goto fR;
        KY:
        $wD .= "\x26";
        fR:
        if ($BB) {
            goto V1;
        }
        $wD .= $O9;
        goto Ki;
        V1:
        if ($aS == "\x52\123\101\x5f\123\110\x41\62\65\x36") {
            goto J_;
        }
        if ($aS == "\122\123\101\x5f\123\110\101\x33\x38\x34") {
            goto tw;
        }
        if ($aS == "\122\x53\101\x5f\x53\x48\x41\x35\x31\x32") {
            goto CL;
        }
        if ($aS == "\x52\123\101\x5f\x53\x48\x41\x31") {
            goto Bt;
        }
        goto X8;
        J_:
        $wD .= $O9 . "\46\123\x69\147\101\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\x26\x53\151\x67\156\x61\164\165\162\x65\x3d" . urlencode($d9);
        goto X8;
        tw:
        $wD .= $O9 . "\46\123\151\x67\x41\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\x53\x69\x67\x6e\x61\164\165\162\x65\x3d" . urlencode($d9);
        goto X8;
        CL:
        $wD .= $O9 . "\x26\x53\151\147\101\154\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA512) . "\x26\x53\x69\x67\156\x61\x74\x75\162\x65\x3d" . urlencode($d9);
        goto X8;
        Bt:
        $wD .= $O9 . "\46\x53\151\147\x41\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\x53\x69\147\156\141\x74\165\162\x65\75" . urlencode($d9);
        X8:
        Ki:
        header("\114\157\x63\x61\164\151\x6f\156\72\x20" . $wD);
        die;
        Xo:
    }
}
