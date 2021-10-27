<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($ix, $IP, $tR, $iz, $lo, $f_, $wv, $mu)
    {
        $fA = Utilities::createAuthnRequest($ix, $tR, $IP, $iz, "\x66\x61\154\x73\145", $f_);
        $this->sendSamlRequestByBindingType($fA, $f_, $lo, $IP, $wv, $mu);
    }
    function sendSamlRequestByBindingType($Xe, $f_, $g4, $wr, $wv, $mu)
    {
        if (libraries_get_path("\170\155\154\x73\x65\x63\154\x69\142\x73")) {
            goto R1;
        }
        $f1 = libraries_get_path("\170\x6d\x6c\163\145\x63\154\x69\x62\x73\55\155\141\163\x74\145\x72") . "\57\x78\x6d\x6c\163\145\143\154\151\142\x73\x2e\x70\150\160";
        goto xO;
        R1:
        $f1 = libraries_get_path("\170\x6d\154\x73\145\x63\x6c\x69\142\163") . "\57\x78\x6d\154\x73\145\x63\x6c\151\x62\163\x2e\x70\150\x70";
        xO:
        libraries_load("\x78\x6d\x6c\x73\145\143\154\x69\x62\x73");
        if (!(!class_exists("\x58\x4d\114\x53\x65\x63\165\162\x69\164\x79\x4b\145\x79") && !@(include $f1))) {
            goto GY;
        }
        echo "\74\x64\151\x76\x3e\15\12\x9\11\11\74\160\x3e\x3c\x66\x6f\156\x74\40\143\x6c\141\163\x73\75\47\x61\154\x65\162\x74\x27\x20\142\x61\143\153\147\162\x6f\x75\x6e\144\x2d\x63\157\x6c\157\162\75\x27\143\162\151\155\163\x6f\156\x27\40\143\x6f\154\157\162\x3d\47\x72\145\x64\x27\x3e\x45\162\x72\x6f\162\x3a\x20\x78\155\154\163\145\143\154\151\x62\163\40\156\157\164\x20\x6c\157\x61\144\x65\x64\x20\x70\162\157\160\x65\x72\x6c\x79\x3c\57\x66\x6f\x6e\164\x3e\x3c\57\160\76\xd\12\x9\11\11\74\x70\76\x59\157\x75\40\x63\141\156\40\x64\x6f\167\156\x6c\x6f\141\144\40\x78\155\154\x73\145\143\x6c\x69\142\163\40\146\x72\x6f\x6d\x20\74\141\x20\150\162\145\146\75\47\x68\164\x74\x70\x73\x3a\x2f\57\x67\151\164\150\x75\x62\x2e\143\157\155\x2f\x72\157\x62\x72\151\143\x68\x61\x72\144\x73\x2f\x78\x6d\x6c\x73\145\143\154\151\142\x73\57\164\162\145\145\57\x31\56\64\x27\x20\x74\141\x72\x67\145\x74\75\47\137\x62\154\x61\x6e\153\x27\76\150\x65\162\145\74\x2f\x61\x3e\x2e\15\xa\x9\x9\11\74\x62\162\x3e\x45\x78\164\162\x61\143\x74\40\x74\150\x65\40\x61\x72\143\x68\151\166\145\x20\x61\156\144\40\x70\x6c\x61\x63\145\40\x69\x74\40\165\156\x64\x65\x72\40\x3c\142\x3e\163\151\x74\145\163\x2f\141\154\x6c\x2f\154\151\142\x72\x61\x72\151\145\163\57\x3c\57\x62\x3e\40\151\x6e\40\171\x6f\x75\162\40\104\x72\165\160\141\x6c\40\144\x69\162\145\x63\x74\x6f\x72\171\56\74\57\160\76\11\x9\11\x9\74\x64\151\x76\76";
        exit;
        GY:
        $SW = '';
        $SW = variable_get("\155\x69\x6e\151\157\162\141\156\147\x65\x5f\163\141\155\154\x5f\160\x75\x62\x6c\x5f\x63\145\x72\164\151\146\151\143\x61\164\x65");
        $SB = '';
        $SB = variable_get("\155\x69\156\x69\x6f\162\x61\156\x67\145\x5f\x73\141\155\154\x5f\x70\162\151\166\141\x74\x65\137\x63\145\162\164\151\146\151\x63\x61\164\145");
        $RK = drupal_get_path("\155\x6f\144\x75\x6c\145", "\x6d\x69\156\x69\x6f\162\x61\156\x67\145\137\x73\x61\x6d\x6c");
        if (empty($f_) || $f_ == "\x48\x54\124\120\x2d\122\x65\144\151\x72\145\x63\x74") {
            goto iO;
        }
        if ($wv) {
            goto nK;
        }
        $SZ = base64_encode($Xe);
        Utilities::postSAMLRequest($wr, $SZ, $g4);
        exit;
        nK:
        if ($SB != '') {
            goto cM;
        }
        $aa = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $RK . DIRECTORY_SEPARATOR . "\x72\x65\163\x6f\x75\x72\143\145\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\x6b\145\x79\56\x6b\145\x79";
        goto Uf;
        cM:
        $aa = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $RK . DIRECTORY_SEPARATOR . "\162\x65\x73\157\x75\162\x63\x65\163" . DIRECTORY_SEPARATOR . "\103\165\163\x74\157\x6d\x5f\x50\162\x69\x76\x61\x74\x65\137\x43\x65\162\x74\x69\x66\151\143\x61\164\x65\56\x6b\x65\x79";
        Uf:
        if ($SW != '') {
            goto Ne;
        }
        $eH = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $RK . DIRECTORY_SEPARATOR . "\162\145\x73\x6f\x75\x72\143\x65\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\x63\145\x72\x74\151\x66\x69\143\141\164\145\56\143\x72\164";
        goto Jm;
        Ne:
        $eH = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $RK . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\x75\162\x63\145\x73" . DIRECTORY_SEPARATOR . "\103\165\163\x74\x6f\155\137\x50\165\142\x6c\151\143\137\103\145\162\164\x69\146\151\143\141\164\145\x2e\143\162\164";
        Jm:
        $SZ = Utilities::signXML($Xe, $eH, $aa, "\x4e\141\x6d\x65\x49\x44\x50\157\154\x69\x63\171", $mu);
        Utilities::postSAMLRequest($wr, $SZ, $g4);
        goto Jz;
        iO:
        $Xe = "\123\x41\x4d\114\122\145\x71\x75\x65\x73\x74\75" . $Xe . "\x26\x52\145\154\x61\x79\x53\x74\141\164\x65\x3d" . $g4;
        $eI = array("\164\171\160\x65" => "\x70\x72\151\166\x61\164\x65");
        if ($mu == "\122\123\101\137\123\110\101\x32\65\66") {
            goto sV;
        }
        if ($mu == "\122\x53\101\x5f\x53\x48\x41\63\x38\64") {
            goto cs;
        }
        if ($mu == "\122\123\101\x5f\x53\x48\101\65\61\x32") {
            goto lp;
        }
        if ($mu == "\122\x53\x41\x5f\x53\110\101\61") {
            goto OZ;
        }
        goto qH;
        sV:
        $nL = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $eI);
        goto qH;
        cs:
        $nL = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $eI);
        goto qH;
        lp:
        $nL = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $eI);
        goto qH;
        OZ:
        $nL = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $eI);
        qH:
        if ($SB != '') {
            goto st;
        }
        $Ed = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $RK . DIRECTORY_SEPARATOR . "\x72\x65\163\x6f\x75\162\143\145\x73" . DIRECTORY_SEPARATOR . "\163\x70\55\153\145\x79\x2e\153\x65\x79";
        goto ds;
        st:
        $Ed = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $RK . DIRECTORY_SEPARATOR . "\162\145\163\x6f\165\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\103\165\x73\x74\157\x6d\x5f\120\x72\151\x76\141\x74\x65\x5f\x43\x65\162\164\x69\x66\x69\x63\x61\164\145\56\x6b\145\171";
        ds:
        $nL->loadKey($Ed, TRUE);
        $VQ = new XMLSecurityDSig();
        $kC = $nL->signData($Xe);
        $kC = base64_encode($kC);
        $jp = $wr;
        if (strpos($wr, "\x3f") !== false) {
            goto XY;
        }
        $jp .= "\x3f";
        goto W1;
        XY:
        $jp .= "\x26";
        W1:
        if ($wv) {
            goto gg;
        }
        $jp .= $Xe;
        goto Qn;
        gg:
        if ($mu == "\x52\123\101\137\123\110\101\x32\65\x36") {
            goto eT;
        }
        if ($mu == "\x52\123\101\x5f\x53\x48\101\x33\x38\64") {
            goto dy;
        }
        if ($mu == "\x52\x53\101\137\x53\110\101\x35\x31\62") {
            goto yU;
        }
        if ($mu == "\x52\123\x41\137\123\x48\x41\x31") {
            goto wm;
        }
        goto Ig;
        eT:
        $jp .= $Xe . "\x26\x53\x69\x67\101\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA256) . "\x26\123\151\147\156\x61\x74\165\x72\x65\75" . urlencode($kC);
        goto Ig;
        dy:
        $jp .= $Xe . "\x26\x53\151\x67\101\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA384) . "\x26\x53\151\147\156\141\x74\x75\x72\x65\75" . urlencode($kC);
        goto Ig;
        yU:
        $jp .= $Xe . "\46\x53\x69\x67\x41\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA512) . "\x26\x53\x69\147\x6e\141\164\165\162\145\x3d" . urlencode($kC);
        goto Ig;
        wm:
        $jp .= $Xe . "\x26\x53\151\147\x41\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA1) . "\46\123\x69\147\156\141\x74\x75\x72\145\75" . urlencode($kC);
        Ig:
        Qn:
        header("\114\157\143\x61\x74\x69\157\156\x3a\40" . $jp);
        exit;
        Jz:
    }
}
