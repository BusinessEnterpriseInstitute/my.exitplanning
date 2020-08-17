<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($OH, $aR, $PY, $SV, $oj, $H4, $F4, $qU)
    {
        $fV = Utilities::createAuthnRequest($OH, $PY, $aR, $SV, "\146\x61\154\x73\x65", $H4);
        $this->sendSamlRequestByBindingType($fV, $H4, $oj, $aR, $F4, $qU);
    }
    function sendSamlRequestByBindingType($pl, $H4, $wN, $Sc, $F4, $qU)
    {
        if (libraries_get_path("\170\x6d\154\163\x65\x63\x6c\151\142\163")) {
            goto UX;
        }
        $U2 = libraries_get_path("\x78\x6d\x6c\x73\145\143\x6c\151\142\163\x2d\155\141\x73\x74\145\162") . "\57\x78\155\154\163\x65\x63\x6c\151\x62\x73\x2e\160\150\160";
        goto Iu;
        UX:
        $U2 = libraries_get_path("\x78\x6d\x6c\x73\145\x63\154\151\142\163") . "\x2f\x78\155\154\x73\145\x63\x6c\x69\x62\163\56\160\x68\x70";
        Iu:
        libraries_load("\x78\x6d\x6c\x73\x65\143\x6c\x69\x62\x73");
        if (!(!class_exists("\x58\x4d\114\123\145\143\x75\x72\151\x74\x79\113\145\x79") && !@(include $U2))) {
            goto hH;
        }
        echo "\x3c\144\x69\x76\x3e\xd\xa\x9\11\11\x3c\x70\76\74\146\x6f\x6e\164\x20\x63\154\141\163\163\x3d\x27\141\154\145\x72\164\47\40\x62\x61\143\153\147\162\157\x75\x6e\144\55\x63\157\154\x6f\x72\75\x27\143\162\x69\155\163\157\156\x27\x20\x63\157\154\x6f\162\x3d\x27\162\145\x64\47\76\x45\162\162\x6f\x72\x3a\x20\x78\155\154\163\x65\x63\154\151\142\x73\x20\x6e\157\164\x20\x6c\157\x61\x64\x65\x64\40\160\x72\x6f\x70\145\x72\154\171\74\x2f\x66\157\156\x74\x3e\74\57\160\76\xd\xa\x9\x9\x9\74\160\x3e\x59\157\165\x20\143\x61\x6e\40\144\x6f\x77\x6e\x6c\157\141\x64\40\170\155\154\163\x65\x63\x6c\x69\x62\163\x20\146\x72\157\x6d\x20\74\x61\40\150\162\145\x66\75\47\150\x74\x74\x70\163\x3a\x2f\57\x67\x69\x74\150\165\x62\56\143\157\155\57\x72\x6f\142\162\151\x63\150\141\162\144\x73\57\x78\x6d\x6c\163\145\x63\154\x69\142\163\57\164\162\145\145\57\x31\x2e\x34\x27\40\164\141\162\147\x65\x74\75\x27\x5f\x62\154\141\156\x6b\x27\x3e\150\145\x72\145\74\57\141\76\56\15\xa\11\11\11\x3c\x62\162\76\105\170\x74\x72\141\143\x74\x20\x74\x68\145\x20\141\x72\x63\150\x69\166\x65\40\x61\156\144\40\x70\x6c\141\x63\145\x20\x69\x74\40\x75\156\x64\145\x72\40\74\142\76\x73\x69\164\145\163\x2f\141\154\154\x2f\154\x69\x62\x72\141\162\x69\x65\163\57\x3c\x2f\142\76\x20\151\x6e\40\171\x6f\x75\x72\40\104\x72\x75\x70\141\154\40\x64\x69\162\145\143\164\157\162\171\x2e\x3c\x2f\x70\76\11\x9\11\x9\74\144\151\x76\76";
        die;
        hH:
        $f5 = '';
        $f5 = variable_get("\155\151\156\x69\157\x72\x61\156\147\145\x5f\x73\x61\x6d\x6c\x5f\x70\165\x62\154\137\143\145\162\x74\x69\x66\151\143\x61\164\x65");
        $N1 = '';
        $N1 = variable_get("\x6d\x69\156\151\157\162\141\x6e\x67\145\x5f\x73\x61\155\x6c\x5f\x70\x72\x69\x76\141\164\145\x5f\x63\145\x72\164\x69\146\151\143\141\164\145");
        $rv = drupal_get_path("\x6d\x6f\x64\165\x6c\x65", "\x6d\151\156\x69\x6f\162\141\156\147\145\x5f\163\141\155\154");
        if (empty($H4) || $H4 == "\110\124\x54\120\55\122\x65\144\151\162\x65\x63\x74") {
            goto JS;
        }
        if ($F4) {
            goto eD;
        }
        $qh = base64_encode($pl);
        Utilities::postSAMLRequest($Sc, $qh, $wN);
        die;
        eD:
        if ($N1 != '') {
            goto uR;
        }
        $cx = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $rv . DIRECTORY_SEPARATOR . "\162\145\x73\157\165\162\143\x65\163" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\x6b\x65\171\x2e\x6b\145\x79";
        goto th;
        uR:
        $cx = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $rv . DIRECTORY_SEPARATOR . "\162\x65\x73\157\x75\162\x63\145\163" . DIRECTORY_SEPARATOR . "\x43\165\163\x74\157\x6d\x5f\x50\162\151\x76\x61\164\x65\137\x43\145\162\164\x69\146\151\x63\x61\x74\145\x2e\x6b\145\171";
        th:
        if ($f5 != '') {
            goto bY;
        }
        $t9 = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $rv . DIRECTORY_SEPARATOR . "\x72\145\163\157\x75\162\143\x65\163" . DIRECTORY_SEPARATOR . "\x73\160\x2d\143\145\x72\164\x69\x66\151\143\141\x74\x65\56\x63\x72\x74";
        goto gw;
        bY:
        $t9 = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $rv . DIRECTORY_SEPARATOR . "\x72\x65\163\x6f\165\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x43\165\x73\x74\157\155\137\x50\x75\142\x6c\x69\x63\x5f\x43\x65\x72\164\151\x66\x69\143\x61\x74\145\x2e\143\x72\x74";
        gw:
        $qh = Utilities::signXML($pl, $t9, $cx, "\x4e\x61\x6d\145\111\x44\120\157\154\151\143\x79", $qU);
        Utilities::postSAMLRequest($Sc, $qh, $wN);
        goto Np;
        JS:
        $pl = "\123\101\115\x4c\x52\145\x71\165\x65\x73\164\75" . $pl . "\x26\x52\x65\154\x61\171\x53\164\x61\164\145\75" . $wN;
        $Ei = array("\x74\171\x70\x65" => "\x70\x72\151\166\x61\x74\x65");
        if ($qU == "\122\x53\101\137\x53\x48\101\x32\x35\x36") {
            goto la;
        }
        if ($qU == "\122\x53\x41\x5f\123\110\x41\x33\x38\64") {
            goto Ca;
        }
        if ($qU == "\122\x53\x41\137\x53\110\x41\65\x31\62") {
            goto ZG;
        }
        if ($qU == "\x52\x53\x41\137\x53\110\101\x31") {
            goto Yn;
        }
        goto VF;
        la:
        $FS = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $Ei);
        goto VF;
        Ca:
        $FS = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $Ei);
        goto VF;
        ZG:
        $FS = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $Ei);
        goto VF;
        Yn:
        $FS = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $Ei);
        VF:
        if ($N1 != '') {
            goto i3;
        }
        $zf = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $rv . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\165\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x73\x70\55\x6b\x65\171\x2e\x6b\x65\x79";
        goto So;
        i3:
        $zf = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $rv . DIRECTORY_SEPARATOR . "\162\145\163\x6f\165\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x43\x75\x73\164\157\x6d\137\120\x72\151\166\141\164\x65\x5f\103\x65\x72\164\x69\146\x69\x63\141\164\145\56\x6b\x65\x79";
        So:
        $FS->loadKey($zf, TRUE);
        $FA = new XMLSecurityDSig();
        $B7 = $FS->signData($pl);
        $B7 = base64_encode($B7);
        $oy = $Sc;
        if (strpos($Sc, "\x3f") !== false) {
            goto aG;
        }
        $oy .= "\77";
        goto Yb;
        aG:
        $oy .= "\46";
        Yb:
        if ($F4) {
            goto YI;
        }
        $oy .= $pl;
        goto NF;
        YI:
        if ($qU == "\122\123\x41\x5f\123\110\x41\62\x35\66") {
            goto ZI;
        }
        if ($qU == "\122\x53\x41\137\x53\x48\x41\63\x38\x34") {
            goto Mg;
        }
        if ($qU == "\122\x53\101\137\123\110\101\x35\61\62") {
            goto v2;
        }
        if ($qU == "\x52\123\101\x5f\x53\x48\101\61") {
            goto rb;
        }
        goto nd;
        ZI:
        $oy .= $pl . "\x26\x53\151\x67\101\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\46\123\151\x67\x6e\141\x74\165\162\x65\75" . urlencode($B7);
        goto nd;
        Mg:
        $oy .= $pl . "\46\x53\x69\147\x41\154\x67\75" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\123\151\x67\x6e\141\164\x75\x72\145\x3d" . urlencode($B7);
        goto nd;
        v2:
        $oy .= $pl . "\x26\123\x69\x67\101\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA512) . "\46\123\x69\147\156\141\x74\x75\162\x65\x3d" . urlencode($B7);
        goto nd;
        rb:
        $oy .= $pl . "\46\123\151\x67\101\154\147\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\x53\x69\x67\x6e\141\x74\165\x72\x65\75" . urlencode($B7);
        nd:
        NF:
        header("\x4c\157\143\x61\x74\x69\x6f\x6e\x3a\40" . $oy);
        die;
        Np:
    }
}
