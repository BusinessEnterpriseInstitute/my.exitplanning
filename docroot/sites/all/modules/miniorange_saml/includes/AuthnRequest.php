<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($QN, $Wm, $vy, $Z_, $eA, $r2, $us, $OU)
    {
        $K0 = Utilities::createAuthnRequest($QN, $vy, $Wm, $Z_, "\146\141\154\163\145", $r2);
        $this->sendSamlRequestByBindingType($K0, $r2, $eA, $Wm, $us, $OU);
    }
    function sendSamlRequestByBindingType($DI, $r2, $cY, $VF, $us, $OU)
    {
        if (libraries_get_path("\x78\155\x6c\x73\145\143\154\151\142\x73")) {
            goto Hv;
        }
        $oK = libraries_get_path("\x78\155\x6c\163\145\143\x6c\151\x62\163\x2d\155\x61\163\x74\145\x72") . "\x2f\x78\x6d\154\163\145\143\154\151\x62\x73\56\160\x68\160";
        goto Ud;
        Hv:
        $oK = libraries_get_path("\x78\155\154\x73\145\143\154\x69\142\163") . "\x2f\170\155\154\163\x65\x63\x6c\151\142\163\x2e\x70\150\x70";
        Ud:
        libraries_load("\170\x6d\154\163\145\x63\x6c\151\142\163");
        if (!(!class_exists("\x58\x4d\114\x53\x65\x63\165\x72\151\164\171\113\x65\171") && !@(include $oK))) {
            goto Ks;
        }
        echo "\74\x64\x69\x76\76\xd\12\11\x9\11\x3c\x70\76\74\x66\157\x6e\164\x20\143\154\141\163\163\75\x27\x61\x6c\x65\162\164\x27\x20\x62\x61\143\x6b\x67\x72\157\x75\x6e\144\55\x63\157\x6c\157\x72\75\47\143\162\x69\155\163\x6f\x6e\x27\x20\143\x6f\154\x6f\162\75\47\x72\x65\144\47\x3e\105\162\x72\x6f\162\72\40\x78\155\x6c\163\145\x63\154\151\x62\x73\x20\x6e\157\x74\x20\154\157\141\144\145\x64\x20\x70\x72\x6f\160\145\162\154\171\x3c\57\146\x6f\x6e\x74\76\74\x2f\x70\76\xd\12\x9\11\x9\x3c\160\76\x59\x6f\x75\x20\x63\x61\x6e\x20\144\157\167\156\154\157\141\x64\40\170\x6d\x6c\x73\x65\143\154\x69\x62\x73\40\146\x72\157\x6d\x20\x3c\x61\x20\150\x72\x65\x66\x3d\x27\150\164\x74\x70\x73\72\57\57\147\x69\164\150\165\x62\56\143\157\155\x2f\x72\157\x62\162\x69\143\x68\x61\x72\x64\163\x2f\x78\155\x6c\x73\x65\x63\x6c\x69\x62\163\57\x74\x72\145\145\x2f\61\56\64\x27\40\x74\x61\162\147\145\x74\x3d\x27\137\x62\154\x61\x6e\x6b\x27\76\x68\145\x72\x65\74\57\141\x3e\x2e\xd\12\x9\11\x9\x3c\142\x72\x3e\x45\170\x74\x72\x61\x63\x74\40\164\x68\145\x20\141\162\x63\x68\151\x76\145\x20\x61\156\x64\40\x70\154\x61\x63\145\40\151\x74\40\165\156\144\x65\162\40\x3c\x62\76\x73\151\x74\x65\x73\x2f\141\x6c\154\x2f\154\151\142\162\141\x72\151\x65\x73\x2f\x3c\x2f\x62\x3e\x20\151\156\40\x79\x6f\x75\x72\40\104\162\x75\x70\141\x6c\40\144\151\x72\145\143\164\x6f\162\x79\x2e\74\x2f\x70\76\11\11\11\11\x3c\144\x69\x76\76";
        exit;
        Ks:
        $JS = '';
        $JS = variable_get("\155\x69\x6e\151\157\162\x61\156\x67\145\x5f\163\x61\155\154\137\x70\x75\142\x6c\x5f\143\145\162\x74\151\146\x69\x63\141\164\145");
        $w9 = '';
        $w9 = variable_get("\155\151\156\x69\x6f\x72\141\156\147\x65\x5f\163\141\x6d\154\x5f\160\x72\151\x76\x61\164\x65\137\143\145\x72\x74\151\x66\x69\143\x61\164\145");
        $Yf = drupal_get_path("\155\157\144\165\x6c\x65", "\155\151\156\151\157\x72\x61\156\147\145\x5f\x73\141\155\x6c");
        if (empty($r2) || $r2 == "\x48\124\x54\120\55\122\145\144\151\x72\145\x63\164") {
            goto tU;
        }
        if ($us) {
            goto RL;
        }
        $MG = base64_encode($DI);
        Utilities::postSAMLRequest($VF, $MG, $cY);
        exit;
        RL:
        if ($w9 != '') {
            goto bG;
        }
        $br = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Yf . DIRECTORY_SEPARATOR . "\x72\145\x73\157\x75\x72\143\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\55\x6b\145\171\56\153\x65\171";
        goto HA;
        bG:
        $br = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Yf . DIRECTORY_SEPARATOR . "\162\x65\163\157\x75\x72\x63\145\163" . DIRECTORY_SEPARATOR . "\x43\x75\163\164\157\155\x5f\120\x72\151\166\x61\x74\145\x5f\103\x65\162\x74\x69\x66\x69\143\x61\164\145\56\153\x65\171";
        HA:
        if ($JS != '') {
            goto am;
        }
        $et = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Yf . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\x75\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\55\143\145\162\x74\x69\146\151\x63\x61\164\145\x2e\x63\162\x74";
        goto cL;
        am:
        $et = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Yf . DIRECTORY_SEPARATOR . "\x72\x65\x73\157\x75\x72\x63\145\163" . DIRECTORY_SEPARATOR . "\103\x75\163\164\157\x6d\x5f\x50\x75\142\154\151\143\x5f\103\145\162\164\x69\146\151\143\141\164\145\56\143\162\164";
        cL:
        $MG = Utilities::signXML($DI, $et, $br, "\x4e\141\155\145\x49\104\120\157\154\151\143\x79", $OU);
        Utilities::postSAMLRequest($VF, $MG, $cY);
        goto J_;
        tU:
        $DI = "\123\101\x4d\x4c\122\x65\x71\x75\x65\x73\x74\x3d" . $DI . "\x26\122\x65\154\141\171\123\164\x61\164\145\x3d" . $cY;
        $HT = array("\164\171\x70\x65" => "\160\x72\x69\x76\141\x74\145");
        if ($OU == "\122\x53\x41\137\x53\110\x41\62\x35\66") {
            goto T3;
        }
        if ($OU == "\x52\123\101\137\x53\x48\x41\63\x38\x34") {
            goto UC;
        }
        if ($OU == "\x52\123\101\x5f\x53\110\x41\65\x31\62") {
            goto XH;
        }
        if ($OU == "\122\123\101\x5f\123\x48\x41\x31") {
            goto oE;
        }
        goto zt;
        T3:
        $u7 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $HT);
        goto zt;
        UC:
        $u7 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $HT);
        goto zt;
        XH:
        $u7 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $HT);
        goto zt;
        oE:
        $u7 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $HT);
        zt:
        if ($w9 != '') {
            goto rU;
        }
        $hR = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Yf . DIRECTORY_SEPARATOR . "\x72\x65\163\157\x75\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\163\160\x2d\153\145\171\x2e\x6b\x65\171";
        goto Bc;
        rU:
        $hR = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $Yf . DIRECTORY_SEPARATOR . "\162\145\163\x6f\x75\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\103\x75\163\164\x6f\155\x5f\120\162\x69\x76\x61\x74\x65\137\x43\x65\x72\164\x69\x66\151\143\141\x74\145\56\x6b\145\171";
        Bc:
        $u7->loadKey($hR, TRUE);
        $tl = new XMLSecurityDSig();
        $OO = $u7->signData($DI);
        $OO = base64_encode($OO);
        $qI = $VF;
        if (strpos($VF, "\x3f") !== false) {
            goto Y1;
        }
        $qI .= "\x3f";
        goto lT;
        Y1:
        $qI .= "\x26";
        lT:
        if ($us) {
            goto cx;
        }
        $qI .= $DI;
        goto ne;
        cx:
        if ($OU == "\x52\x53\101\137\x53\x48\101\62\x35\66") {
            goto Ad;
        }
        if ($OU == "\122\x53\x41\x5f\x53\x48\101\x33\70\64") {
            goto J2;
        }
        if ($OU == "\122\123\101\137\123\110\101\x35\61\62") {
            goto Dr;
        }
        if ($OU == "\122\x53\101\137\x53\x48\x41\x31") {
            goto pr;
        }
        goto zC;
        Ad:
        $qI .= $DI . "\x26\123\x69\147\101\x6c\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\x26\x53\x69\147\156\x61\164\x75\162\x65\75" . urlencode($OO);
        goto zC;
        J2:
        $qI .= $DI . "\x26\123\151\147\101\154\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA384) . "\46\x53\x69\147\x6e\141\x74\x75\x72\145\75" . urlencode($OO);
        goto zC;
        Dr:
        $qI .= $DI . "\46\123\x69\x67\x41\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA512) . "\x26\123\151\x67\x6e\x61\164\x75\x72\x65\75" . urlencode($OO);
        goto zC;
        pr:
        $qI .= $DI . "\46\x53\151\147\101\154\x67\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\x53\x69\147\x6e\x61\164\165\x72\x65\x3d" . urlencode($OO);
        zC:
        ne:
        header("\x4c\x6f\x63\x61\x74\151\157\156\x3a\40" . $qI);
        exit;
        J_:
    }
}
