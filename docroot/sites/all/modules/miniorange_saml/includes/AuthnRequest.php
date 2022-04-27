<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($d7, $np, $xx, $qA, $c4, $sX, $F0, $f7)
    {
        $es = Utilities::createAuthnRequest($d7, $xx, $np, $qA, "\146\x61\154\x73\x65", $sX);
        $this->sendSamlRequestByBindingType($es, $sX, $c4, $np, $F0, $f7);
    }
    function sendSamlRequestByBindingType($Hw, $sX, $Mx, $Ri, $F0, $f7)
    {
        if (libraries_get_path("\170\155\154\163\x65\143\154\x69\142\x73")) {
            goto jL;
        }
        $dm = libraries_get_path("\170\155\154\x73\x65\x63\154\151\x62\163\x2d\x6d\141\163\164\145\162") . "\57\170\x6d\154\163\x65\x63\x6c\151\x62\x73\56\x70\x68\160";
        goto nn;
        jL:
        $dm = libraries_get_path("\170\x6d\154\x73\x65\143\x6c\151\142\163") . "\57\x78\x6d\154\x73\145\143\x6c\x69\x62\163\56\160\x68\160";
        nn:
        libraries_load("\x78\x6d\154\x73\145\x63\154\x69\142\163");
        if (!(!class_exists("\130\115\114\x53\145\143\165\162\151\164\171\x4b\145\171") && !@(include $dm))) {
            goto sg;
        }
        echo "\74\144\x69\x76\76\15\xa\11\11\11\x3c\x70\76\74\x66\x6f\156\164\40\143\154\x61\163\163\75\47\x61\x6c\x65\x72\x74\47\40\x62\x61\143\x6b\147\x72\x6f\165\x6e\x64\x2d\143\x6f\154\157\162\x3d\x27\143\x72\x69\x6d\163\157\156\47\x20\x63\157\x6c\x6f\162\x3d\x27\162\145\144\47\x3e\x45\x72\x72\157\162\x3a\x20\x78\155\x6c\x73\x65\x63\154\x69\x62\163\x20\156\157\164\x20\154\x6f\x61\144\145\144\x20\160\162\157\160\x65\162\x6c\x79\74\57\146\x6f\x6e\164\76\74\x2f\x70\x3e\15\xa\11\x9\x9\74\160\76\x59\157\165\x20\x63\x61\x6e\x20\144\157\x77\156\x6c\x6f\x61\x64\x20\x78\155\x6c\x73\145\143\x6c\x69\142\x73\x20\x66\x72\157\155\40\74\x61\x20\150\x72\145\x66\75\47\x68\x74\x74\160\x73\72\57\x2f\x67\151\x74\x68\x75\142\x2e\x63\x6f\155\57\162\157\x62\162\151\x63\150\x61\x72\x64\x73\x2f\x78\155\154\x73\x65\x63\154\x69\x62\x73\x2f\x74\162\145\x65\57\61\x2e\64\47\40\x74\x61\162\147\x65\164\x3d\47\137\142\x6c\141\156\153\47\x3e\x68\x65\162\x65\x3c\57\x61\76\56\xd\12\x9\11\x9\74\x62\162\76\105\x78\x74\162\x61\x63\164\x20\x74\x68\145\x20\x61\x72\x63\150\x69\166\x65\40\141\x6e\144\40\x70\x6c\141\143\x65\40\x69\164\x20\165\156\144\x65\x72\40\74\142\x3e\163\151\164\x65\163\57\141\154\x6c\x2f\x6c\x69\x62\162\141\x72\151\145\x73\x2f\74\x2f\x62\76\x20\151\x6e\40\171\x6f\165\x72\40\104\162\165\160\x61\x6c\40\x64\x69\x72\145\x63\x74\157\162\x79\x2e\x3c\x2f\160\x3e\11\x9\x9\11\x3c\144\151\x76\x3e";
        exit;
        sg:
        $W5 = '';
        $W5 = variable_get("\x6d\x69\x6e\x69\x6f\x72\x61\156\147\145\137\163\x61\x6d\154\137\160\x75\142\154\x5f\143\145\162\x74\151\146\x69\x63\x61\164\145");
        $QP = '';
        $QP = variable_get("\x6d\x69\x6e\151\x6f\x72\141\156\x67\145\137\163\141\x6d\x6c\137\160\162\x69\166\141\164\x65\137\143\145\x72\164\x69\146\151\x63\141\164\145");
        $xb = drupal_get_path("\x6d\157\x64\165\154\145", "\155\x69\x6e\x69\157\x72\x61\x6e\147\145\137\x73\x61\x6d\x6c");
        if (empty($sX) || $sX == "\x48\x54\124\x50\55\122\145\144\x69\x72\x65\x63\x74") {
            goto RB;
        }
        if ($F0) {
            goto oU;
        }
        $DK = base64_encode($Hw);
        Utilities::postSAMLRequest($Ri, $DK, $Mx);
        exit;
        oU:
        if ($QP != '') {
            goto wU;
        }
        $QS = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $xb . DIRECTORY_SEPARATOR . "\x72\x65\163\157\x75\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\x73\160\x2d\153\x65\171\x2e\x6b\145\x79";
        goto eT;
        wU:
        $QS = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $xb . DIRECTORY_SEPARATOR . "\x72\145\163\157\x75\x72\143\145\163" . DIRECTORY_SEPARATOR . "\103\165\163\164\157\155\x5f\x50\162\151\166\x61\164\145\137\103\x65\x72\164\x69\146\151\x63\141\164\x65\x2e\x6b\x65\x79";
        eT:
        if ($W5 != '') {
            goto Ri;
        }
        $LM = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $xb . DIRECTORY_SEPARATOR . "\162\145\x73\157\165\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\163\x70\x2d\143\x65\x72\x74\151\x66\x69\x63\x61\x74\x65\56\143\162\x74";
        goto Cu;
        Ri:
        $LM = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $xb . DIRECTORY_SEPARATOR . "\x72\x65\163\157\x75\x72\x63\145\163" . DIRECTORY_SEPARATOR . "\103\x75\163\164\x6f\155\x5f\x50\165\x62\x6c\151\143\x5f\103\x65\x72\x74\x69\146\x69\x63\141\164\145\56\143\x72\x74";
        Cu:
        $DK = Utilities::signXML($Hw, $LM, $QS, "\116\x61\155\145\x49\x44\x50\x6f\154\151\x63\x79", $f7);
        Utilities::postSAMLRequest($Ri, $DK, $Mx);
        goto Hk;
        RB:
        $Hw = "\123\x41\115\x4c\122\x65\161\165\145\163\164\x3d" . $Hw . "\x26\122\x65\x6c\141\x79\123\x74\141\x74\145\x3d" . $Mx;
        $Aj = array("\x74\x79\x70\x65" => "\160\x72\x69\166\141\x74\145");
        if ($f7 == "\x52\x53\101\137\123\x48\101\62\x35\x36") {
            goto gE;
        }
        if ($f7 == "\122\x53\101\137\x53\x48\101\x33\70\64") {
            goto LC;
        }
        if ($f7 == "\x52\123\101\137\123\x48\101\65\61\x32") {
            goto z7;
        }
        if ($f7 == "\122\123\x41\x5f\x53\110\101\61") {
            goto sI;
        }
        goto Bz;
        gE:
        $aC = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $Aj);
        goto Bz;
        LC:
        $aC = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $Aj);
        goto Bz;
        z7:
        $aC = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $Aj);
        goto Bz;
        sI:
        $aC = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $Aj);
        Bz:
        if ($QP != '') {
            goto nv;
        }
        $dB = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $xb . DIRECTORY_SEPARATOR . "\162\145\x73\x6f\165\x72\x63\145\163" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\x6b\145\171\x2e\x6b\x65\171";
        goto M8;
        nv:
        $dB = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $xb . DIRECTORY_SEPARATOR . "\162\x65\x73\x6f\x75\x72\143\x65\163" . DIRECTORY_SEPARATOR . "\x43\x75\163\x74\157\x6d\x5f\x50\162\151\166\141\x74\145\137\103\145\162\164\151\146\x69\x63\141\164\145\x2e\153\x65\x79";
        M8:
        $aC->loadKey($dB, TRUE);
        $qE = new XMLSecurityDSig();
        $if = $aC->signData($Hw);
        $if = base64_encode($if);
        $t2 = $Ri;
        if (strpos($Ri, "\x3f") !== false) {
            goto Y7;
        }
        $t2 .= "\x3f";
        goto Ne;
        Y7:
        $t2 .= "\46";
        Ne:
        if ($F0) {
            goto Nh;
        }
        $t2 .= $Hw;
        goto D9;
        Nh:
        if ($f7 == "\122\x53\x41\x5f\x53\110\101\x32\65\x36") {
            goto Zs;
        }
        if ($f7 == "\122\x53\101\137\x53\x48\101\63\x38\64") {
            goto Wt;
        }
        if ($f7 == "\x52\123\101\137\123\110\101\65\x31\62") {
            goto EE;
        }
        if ($f7 == "\x52\123\101\137\123\x48\101\x31") {
            goto BG;
        }
        goto Ez;
        Zs:
        $t2 .= $Hw . "\46\x53\151\147\x41\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA256) . "\46\123\x69\147\156\x61\164\x75\x72\x65\75" . urlencode($if);
        goto Ez;
        Wt:
        $t2 .= $Hw . "\x26\x53\x69\x67\101\x6c\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\123\151\x67\x6e\141\164\x75\x72\x65\x3d" . urlencode($if);
        goto Ez;
        EE:
        $t2 .= $Hw . "\x26\123\x69\147\x41\154\x67\75" . urlencode(XMLSecurityKey::RSA_SHA512) . "\46\123\x69\x67\x6e\x61\x74\x75\x72\145\x3d" . urlencode($if);
        goto Ez;
        BG:
        $t2 .= $Hw . "\x26\x53\151\x67\101\154\x67\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\x26\123\x69\x67\156\x61\164\x75\x72\145\75" . urlencode($if);
        Ez:
        D9:
        header("\x4c\157\143\141\x74\x69\157\156\72\40" . $t2);
        exit;
        Hk:
    }
}
