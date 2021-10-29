<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($GR, $qV, $JS, $mJ, $pp, $oe, $Z7, $b2)
    {
        $Y0 = Utilities::createAuthnRequest($GR, $JS, $qV, $mJ, "\146\x61\x6c\163\x65", $oe);
        $this->sendSamlRequestByBindingType($Y0, $oe, $pp, $qV, $Z7, $b2);
    }
    function sendSamlRequestByBindingType($HH, $oe, $oB, $g8, $Z7, $b2)
    {
        if (libraries_get_path("\170\155\x6c\x73\145\x63\x6c\x69\x62\x73")) {
            goto CP;
        }
        $NQ = libraries_get_path("\x78\x6d\154\x73\x65\x63\154\x69\x62\x73\x2d\x6d\x61\163\x74\145\x72") . "\x2f\170\x6d\154\x73\x65\143\154\x69\142\163\x2e\x70\150\160";
        goto hH;
        CP:
        $NQ = libraries_get_path("\170\x6d\154\x73\145\x63\x6c\151\x62\163") . "\57\x78\155\x6c\x73\x65\x63\154\x69\142\x73\x2e\x70\x68\160";
        hH:
        libraries_load("\170\x6d\154\163\x65\x63\154\151\142\x73");
        if (!(!class_exists("\130\x4d\114\123\145\x63\x75\x72\x69\164\171\x4b\x65\171") && !@(include $NQ))) {
            goto w8;
        }
        echo "\74\144\x69\166\x3e\xd\xa\11\11\11\x3c\x70\76\x3c\x66\x6f\156\164\40\x63\154\x61\x73\163\x3d\47\141\154\x65\162\164\47\x20\x62\141\143\x6b\147\162\157\x75\156\144\55\x63\x6f\x6c\157\162\x3d\47\143\162\x69\x6d\x73\157\x6e\47\x20\x63\x6f\x6c\157\x72\x3d\47\162\145\x64\x27\76\105\x72\162\x6f\x72\x3a\x20\170\x6d\x6c\x73\x65\143\x6c\151\x62\163\x20\156\157\x74\40\154\157\141\x64\145\x64\x20\160\162\x6f\x70\x65\x72\154\x79\x3c\57\146\x6f\x6e\x74\76\74\57\x70\76\xd\12\11\x9\x9\74\x70\x3e\131\x6f\165\x20\143\x61\156\x20\x64\157\167\x6e\154\x6f\141\x64\x20\x78\155\154\x73\x65\143\x6c\x69\142\163\40\146\x72\x6f\155\40\74\x61\x20\150\x72\145\146\x3d\x27\x68\164\x74\160\x73\72\x2f\x2f\x67\151\x74\150\x75\x62\56\143\x6f\x6d\57\162\x6f\142\x72\151\x63\x68\x61\162\144\163\x2f\170\x6d\x6c\163\145\x63\154\151\x62\163\57\164\x72\145\145\57\x31\56\x34\x27\x20\164\141\162\x67\x65\x74\75\47\x5f\142\x6c\x61\156\153\47\76\x68\x65\162\145\74\x2f\x61\x3e\56\15\xa\11\11\x9\74\142\x72\x3e\x45\x78\x74\162\x61\x63\164\x20\x74\x68\x65\40\141\162\143\150\x69\166\145\x20\x61\156\x64\x20\160\x6c\x61\143\145\x20\151\164\x20\x75\x6e\x64\x65\x72\40\x3c\142\x3e\x73\x69\x74\145\163\x2f\141\154\154\x2f\154\x69\x62\x72\x61\162\151\x65\163\x2f\74\57\x62\76\x20\151\156\x20\x79\157\x75\162\x20\x44\162\165\160\x61\154\x20\x64\151\162\145\x63\x74\x6f\162\x79\x2e\x3c\x2f\x70\x3e\11\11\11\x9\x3c\144\151\166\76";
        exit;
        w8:
        $iq = '';
        $iq = variable_get("\x6d\x69\156\151\157\162\141\x6e\147\x65\x5f\163\x61\x6d\x6c\x5f\x70\165\142\154\x5f\143\145\x72\x74\151\146\151\x63\141\164\145");
        $vC = '';
        $vC = variable_get("\155\151\x6e\151\157\162\141\x6e\147\145\x5f\x73\141\x6d\154\x5f\160\162\151\166\141\x74\x65\x5f\143\x65\x72\164\151\x66\x69\143\141\x74\x65");
        $U6 = drupal_get_path("\x6d\x6f\x64\x75\x6c\145", "\x6d\x69\x6e\x69\x6f\x72\x61\x6e\x67\x65\137\x73\x61\x6d\x6c");
        if (empty($oe) || $oe == "\110\124\x54\x50\55\x52\145\144\x69\162\145\143\164") {
            goto Nb;
        }
        if ($Z7) {
            goto qE;
        }
        $FO = base64_encode($HH);
        Utilities::postSAMLRequest($g8, $FO, $oB);
        exit;
        qE:
        if ($vC != '') {
            goto c2;
        }
        $MK = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $U6 . DIRECTORY_SEPARATOR . "\x72\x65\x73\x6f\x75\162\x63\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\x2d\x6b\145\x79\56\x6b\x65\171";
        goto ZU;
        c2:
        $MK = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $U6 . DIRECTORY_SEPARATOR . "\162\x65\x73\x6f\165\162\143\x65\163" . DIRECTORY_SEPARATOR . "\103\x75\x73\164\157\x6d\137\120\x72\151\166\141\164\x65\137\x43\x65\162\x74\x69\146\x69\x63\x61\x74\x65\56\153\x65\171";
        ZU:
        if ($iq != '') {
            goto ZZ;
        }
        $wh = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $U6 . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\165\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\163\x70\x2d\143\145\162\164\x69\146\151\143\x61\164\x65\x2e\143\162\164";
        goto KU;
        ZZ:
        $wh = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $U6 . DIRECTORY_SEPARATOR . "\x72\145\163\157\165\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\x43\x75\x73\164\x6f\x6d\x5f\x50\x75\142\x6c\x69\143\x5f\x43\x65\x72\164\x69\146\x69\143\141\164\x65\x2e\143\x72\x74";
        KU:
        $FO = Utilities::signXML($HH, $wh, $MK, "\x4e\x61\155\145\x49\x44\120\x6f\x6c\x69\143\x79", $b2);
        Utilities::postSAMLRequest($g8, $FO, $oB);
        goto Sn;
        Nb:
        $HH = "\x53\x41\x4d\114\x52\145\x71\165\145\163\164\75" . $HH . "\x26\x52\145\x6c\x61\171\x53\164\141\x74\x65\x3d" . $oB;
        $Om = array("\164\171\160\145" => "\160\162\x69\x76\x61\164\x65");
        if ($b2 == "\122\x53\x41\137\x53\x48\x41\x32\65\66") {
            goto dX;
        }
        if ($b2 == "\x52\x53\101\x5f\x53\110\101\x33\x38\x34") {
            goto gD;
        }
        if ($b2 == "\x52\123\x41\137\x53\110\x41\65\61\x32") {
            goto gN;
        }
        if ($b2 == "\122\123\101\x5f\x53\110\101\61") {
            goto iQ;
        }
        goto H0;
        dX:
        $im = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $Om);
        goto H0;
        gD:
        $im = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $Om);
        goto H0;
        gN:
        $im = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $Om);
        goto H0;
        iQ:
        $im = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $Om);
        H0:
        if ($vC != '') {
            goto w7;
        }
        $vy = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $U6 . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\165\162\x63\145\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\153\145\171\56\x6b\x65\171";
        goto L2;
        w7:
        $vy = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $U6 . DIRECTORY_SEPARATOR . "\162\145\163\x6f\165\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\103\165\x73\x74\x6f\x6d\137\x50\162\151\166\141\x74\145\137\103\x65\x72\164\x69\x66\151\143\141\x74\145\x2e\x6b\x65\x79";
        L2:
        $im->loadKey($vy, TRUE);
        $Gn = new XMLSecurityDSig();
        $IJ = $im->signData($HH);
        $IJ = base64_encode($IJ);
        $xn = $g8;
        if (strpos($g8, "\77") !== false) {
            goto Jt;
        }
        $xn .= "\x3f";
        goto HM;
        Jt:
        $xn .= "\46";
        HM:
        if ($Z7) {
            goto hU;
        }
        $xn .= $HH;
        goto AO;
        hU:
        if ($b2 == "\122\x53\x41\x5f\x53\x48\101\62\65\66") {
            goto AG;
        }
        if ($b2 == "\122\x53\101\x5f\123\110\x41\x33\70\64") {
            goto Pm;
        }
        if ($b2 == "\122\123\x41\137\x53\x48\x41\65\61\62") {
            goto uX;
        }
        if ($b2 == "\x52\x53\x41\x5f\x53\110\101\61") {
            goto eP;
        }
        goto aH;
        AG:
        $xn .= $HH . "\x26\x53\x69\147\x41\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA256) . "\x26\123\151\x67\156\x61\164\x75\162\145\75" . urlencode($IJ);
        goto aH;
        Pm:
        $xn .= $HH . "\46\x53\x69\x67\101\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\123\x69\147\156\141\164\x75\162\x65\75" . urlencode($IJ);
        goto aH;
        uX:
        $xn .= $HH . "\46\x53\x69\147\101\x6c\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA512) . "\46\x53\151\x67\x6e\x61\164\165\x72\145\x3d" . urlencode($IJ);
        goto aH;
        eP:
        $xn .= $HH . "\x26\123\151\147\101\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\x53\151\x67\x6e\x61\164\165\162\145\x3d" . urlencode($IJ);
        aH:
        AO:
        header("\114\157\143\x61\x74\151\157\156\x3a\x20" . $xn);
        exit;
        Sn:
    }
}
