<?php


class MiniOrangeAcs
{
    public function processSamlResponse($post, $Sg, $BT, $vH, $base_url, $Rh, $JN, $Fq, $qo)
    {
        watchdog("\155\x69\156\151\x6f\x72\141\x6e\147\x65\x5f\x73\x61\155\x6c", "\x41\x63\163\40\x70\x72\157\x63\145\x73\x73\123\x61\x6d\x6c\122\145\x73\x70\157\156\x73\145", array());
        if (array_key_exists("\x53\x41\x4d\114\x52\145\x73\x70\157\x6e\x73\x65", $post)) {
            goto IG;
        }
        watchdog("\x6d\151\156\x69\x6f\x72\x61\x6e\x67\145\x5f\x73\x61\155\x6c", "\101\x63\x73\x20\160\162\x6f\143\x65\x73\x73\x53\141\x6d\x6c\122\145\x73\160\x6f\x6e\163\x65\40\145\154\163\x65\x20\x6f\x66\x20\x61\162\162\141\171\x5f\153\145\171\x5f\x65\170\151\163\164\163\50\x22\123\x41\115\x4c\122\145\x73\x70\x6f\x6e\x73\x65\x22\54\x20\44\160\x6f\x73\x74\51", array());
        throw new Exception("\x4d\x69\x73\x73\x69\x6e\x67\x20\x53\101\x4d\x4c\122\145\161\x75\145\163\x74\x20\x6f\162\x20\123\101\x4d\x4c\122\145\163\160\x6f\x6e\x73\145\40\160\141\x72\141\155\x65\164\145\162\x2e");
        goto fZ;
        IG:
        watchdog("\x6d\x69\x6e\x69\x6f\162\141\x6e\x67\145\137\163\141\x6d\x6c", "\101\143\163\x20\x70\x72\x6f\x63\x65\163\x73\x53\141\155\x6c\122\145\x73\x70\157\x6e\x73\145\x20\141\x72\x72\141\171\x5f\153\145\171\x5f\145\170\151\x73\x74\x73\x28\x22\x53\101\115\114\x52\145\x73\x70\157\x6e\x73\x65\x22\54\x20\x24\160\157\x73\x74\51", array());
        $DF = $post["\x53\101\x4d\x4c\x52\145\163\x70\157\156\163\145"];
        fZ:
        if (array_key_exists("\x52\x65\154\x61\x79\123\164\141\x74\x65", $post)) {
            goto hr;
        }
        watchdog("\155\x69\156\x69\157\162\141\156\x67\x65\137\x73\141\x6d\x6c", "\101\x63\x73\40\160\162\157\143\145\x73\x73\x53\141\x6d\x6c\x52\145\x73\160\x6f\x6e\x73\x65\x20\x65\x6c\163\x65\40\157\146\x20\x61\x72\162\x61\x79\137\153\145\171\137\x65\x78\151\163\x74\163\50\42\122\145\x6c\x61\171\x53\x74\x61\164\145\42\x2c\x20\x24\160\157\163\x74\51", array());
        $WE = '';
        goto cK;
        hr:
        watchdog("\155\x69\156\151\x6f\162\x61\x6e\147\145\x5f\163\141\155\154", "\x41\143\x73\40\160\x72\x6f\143\x65\163\x73\x53\x61\x6d\154\x52\145\x73\160\x6f\156\x73\145\x20\141\162\x72\x61\x79\x5f\153\145\171\137\145\170\x69\163\x74\163\x28\x22\122\x65\154\141\171\x53\164\141\164\x65\x22\54\x20\44\160\x6f\x73\x74\x29", array());
        $WE = $post["\122\145\154\141\171\x53\x74\x61\x74\x65"];
        cK:
        $DF = base64_decode($DF);
        watchdog("\x6d\151\x6e\x69\x6f\x72\141\x6e\x67\145\x5f\x73\141\155\x6c", "\x41\143\163\40\x70\162\157\143\145\163\163\x53\x61\155\154\122\145\x73\x70\157\x6e\163\145\40\x62\141\163\x65\x36\64\144\x65\143\157\x64\x65\144\40\123\x41\x4d\114\x20\x72\x65\x73\x70\157\x6e\163\145\72\40\x3c\160\162\x65\76\100\x73\x61\155\154\137\162\145\x73\x70\x6f\x6e\x73\145\x3c\x2f\160\x72\145\76", array("\x40\163\x61\155\154\x5f\162\x65\163\x70\x6f\x6e\163\145" => print_r($DF, TRUE)), WATCHDOG_INFO);
        $hW = new DOMDocument();
        $hW->loadXML($DF);
        $K5 = $hW->firstChild;
        if (!($WE == "\163\x68\157\167\x53\141\x6d\x6c\122\x65\163\160\x6f\x6e\x73\145")) {
            goto pl;
        }
        watchdog("\155\151\x6e\151\157\x72\141\x6e\147\x65\137\x73\141\155\x6c", "\x41\x63\163\x20\160\162\x6f\x63\x65\x73\x73\x53\141\x6d\154\122\145\x73\160\157\x6e\163\145\x20\151\x66\x20\122\145\154\x61\171\x53\164\141\164\145\40\75\x3d\40\x22\x73\150\x6f\x77\x53\141\x6d\154\122\145\x73\160\157\x6e\163\145\42", array());
        Utilities::Print_SAML_Request($DF, "\x64\151\x73\x70\154\x61\171\123\x61\x6d\x6c\122\145\163\160\x6f\x6e\163\145");
        pl:
        $rU = $hW->documentElement;
        $pR = new DOMXpath($hW);
        $pR->registerNamespace("\x73\x61\x6d\154\x70", "\165\162\156\x3a\x6f\141\x73\151\163\72\156\141\x6d\145\x73\72\164\x63\x3a\x53\101\x4d\x4c\72\x32\x2e\60\x3a\x70\162\x6f\x74\x6f\x63\x6f\154");
        $pR->registerNamespace("\x73\141\155\154", "\165\x72\x6e\72\x6f\141\163\x69\x73\x3a\x6e\x61\155\x65\163\72\164\143\x3a\123\101\115\114\72\62\x2e\x30\x3a\141\163\x73\145\x72\164\151\157\156");
        $Ch = $pR->query("\x2f\x73\x61\155\x6c\x70\x3a\x52\145\163\x70\x6f\x6e\163\x65\57\x73\141\155\154\x70\72\x53\164\141\x74\x75\x73\x2f\x73\141\x6d\154\x70\72\123\x74\x61\164\165\163\x43\157\x64\145", $rU);
        $Qh = $Ch->item(0)->getAttribute("\x56\141\154\165\x65");
        $FD = '';
        if (!($Ch->item(0)->firstChild !== null)) {
            goto Qq;
        }
        watchdog("\x6d\x69\156\x69\157\x72\141\x6e\147\x65\x5f\x73\x61\x6d\154", "\101\x63\163\x20\x70\x72\x6f\x63\x65\163\163\123\141\x6d\x6c\x52\145\163\x70\x6f\x6e\x73\145\x20\151\x66\x20\x73\x74\141\x74\165\163\x2d\76\x69\164\145\x6d\x28\x30\51\x2d\x3e\x66\x69\x72\x73\164\x43\x68\x69\x6c\x64\40\x21\x3d\x3d\40\156\x75\154\x6c", array());
        $FD = $Ch->item(0)->firstChild->getAttribute("\x56\141\x6c\x75\145");
        Qq:
        $Ch = explode("\72", $Qh)[7];
        watchdog("\155\151\156\x69\157\x72\x61\156\x67\145\137\163\141\x6d\x6c", "\101\143\163\x20\160\162\x6f\143\145\163\163\123\141\x6d\x6c\122\x65\x73\160\157\x6e\163\145\x20\x73\164\141\164\165\163\x3a\x20\x3c\x70\x72\x65\76\x40\163\164\141\x74\x75\x73\74\57\x70\x72\x65\x3e", array("\100\163\x74\x61\164\165\x73" => print_r($Ch, TRUE)), WATCHDOG_INFO);
        if (!($Ch != "\x53\x75\143\143\145\x73\163")) {
            goto xP;
        }
        watchdog("\155\151\x6e\x69\157\162\141\156\x67\x65\x5f\x73\141\x6d\154", "\x41\x63\x73\40\160\162\x6f\143\x65\163\163\x53\x61\155\154\122\x65\163\x70\x6f\156\x73\145\x20\x69\x66\40\x73\x74\141\x74\165\x73\x20\x21\x3d\40\x22\x53\165\x63\x63\x65\x73\x73\x22", array());
        if (empty($FD)) {
            goto ju;
        }
        watchdog("\155\x69\156\151\157\x72\x61\156\147\x65\x5f\163\141\x6d\x6c", "\101\x63\x73\x20\160\162\x6f\143\x65\x73\163\x53\141\x6d\x6c\x52\145\163\160\157\156\x73\x65\x20\x69\x66\40\41\145\x6d\160\164\171\50\x24\163\x74\141\x74\x75\x73\x43\x68\151\x6c\144\x53\164\x72\151\156\147\x29", array());
        $Ch = explode("\72", $FD)[7];
        watchdog("\155\x69\156\151\x6f\x72\x61\x6e\147\145\137\x73\141\155\154", "\101\143\x73\40\160\x72\157\143\145\163\163\123\x61\x6d\x6c\x52\x65\163\x70\x6f\x6e\x73\145\x20\x73\164\x61\x74\x75\x73\x3a\40\74\160\x72\x65\76\x40\163\164\x61\x74\165\x73\x3c\x2f\160\162\145\76", array("\100\x73\x74\141\x74\x75\163" => print_r($Ch, TRUE)), WATCHDOG_INFO);
        ju:
        $this->show_error_message($Ch, $WE);
        xP:
        foreach ($BT as $AM => $W8) {
            watchdog("\155\151\156\x69\157\162\x61\156\147\x65\x5f\163\141\155\x6c", "\101\143\163\x20\x70\x72\157\143\145\163\163\x53\141\155\x6c\122\x65\163\160\157\156\x73\x65\40\151\x66\x20\163\x74\x61\x74\x75\163\x20\x21\75\x20\42\123\x75\x63\x63\145\163\x73\x22", array());
            $HX = XMLSecurityKey::getRawThumbprint($W8);
            $fT = preg_replace("\x2f\x5c\x73\x2b\x2f", '', $HX);
            $BT[$AM] = iconv("\125\x54\106\55\x38", "\x43\120\61\62\x35\62\x2f\57\x49\107\x4e\117\122\x45", $fT);
            watchdog("\155\x69\x6e\151\x6f\x72\x61\156\x67\x65\137\x73\x61\x6d\x6c", "\x41\x63\163\x20\x70\x72\157\143\145\x73\163\123\x61\155\154\x52\x65\163\160\157\x6e\x73\145\x20\x63\145\x72\164\137\x66\151\x6e\x67\145\162\x70\x72\x69\156\x74\x3a\x20\x3c\160\162\x65\76\100\143\145\x72\x74\137\146\151\x6e\147\145\162\160\162\x69\156\x74\x3c\57\x70\x72\x65\x3e", array("\x40\x63\145\162\164\x5f\146\151\x6e\147\145\162\x70\162\151\156\x74" => print_r($BT, TRUE)), WATCHDOG_INFO);
            fU:
        }
        ur:
        $DF = new SAML2_Response($K5);
        $Mz = $DF->getSignatureData();
        watchdog("\155\151\x6e\151\x6f\x72\x61\x6e\147\x65\137\163\141\155\154", "\101\143\163\40\x70\x72\x6f\143\145\x73\x73\x53\x61\155\154\x52\x65\163\x70\x6f\156\163\145\x20\x72\145\163\x70\157\x6e\163\x65\137\163\151\x67\x6e\141\x74\165\162\145\x5f\144\141\x74\x61\72\40\74\160\162\x65\76\100\162\145\163\x70\157\156\x73\x65\137\x73\151\x67\156\x61\x74\165\x72\145\137\144\141\x74\141\74\x2f\160\162\145\76", array("\100\x72\x65\163\x70\x6f\x6e\x73\145\137\x73\151\147\x6e\x61\164\165\x72\x65\137\144\141\164\x61" => print_r($Mz, TRUE)), WATCHDOG_INFO);
        if (empty($Mz)) {
            goto NM;
        }
        watchdog("\x6d\x69\x6e\x69\x6f\162\x61\156\147\145\x5f\x73\x61\155\154", "\x41\x63\163\x20\160\x72\157\x63\x65\x73\x73\x53\x61\x6d\x6c\122\145\x73\160\x6f\x6e\x73\x65\40\41\145\x6d\160\x74\171\x28\44\162\x65\163\x70\x6f\x6e\x73\145\137\x73\x69\147\156\141\x74\x75\162\145\x5f\144\141\164\141\x29", array());
        $HS = Utilities::processResponse($Sg, $BT, $Mz, $DF, $WE);
        if ($HS) {
            goto ne;
        }
        watchdog("\155\151\156\x69\x6f\x72\x61\156\147\145\137\x73\x61\x6d\154", "\101\x63\163\x20\160\162\x6f\143\145\163\163\x53\x61\x6d\x6c\x52\x65\163\x70\157\x6e\x73\x65\x20\41\x76\141\x6c\x69\144\x5f\x73\x69\147\x6e\x61\164\165\x72\x65", array());
        echo "\x49\x6e\166\141\x6c\x69\144\x20\x53\x69\147\x6e\x61\164\165\162\145\40\x69\x6e\40\123\101\x4d\114\x20\x52\145\x73\160\x6f\156\x73\145";
        die;
        ne:
        watchdog("\x6d\x69\x6e\x69\x6f\x72\141\x6e\x67\145\137\x73\x61\x6d\154", "\x41\143\163\x20\x70\x72\157\143\x65\163\163\x53\x61\155\154\122\145\163\x70\157\x6e\163\145\x20\x76\141\154\151\144\137\163\x69\147\156\x61\x74\165\x72\145", array());
        NM:
        $k6 = current($DF->getAssertions())->getSignatureData();
        watchdog("\x6d\151\x6e\151\157\x72\141\156\147\145\137\x73\x61\x6d\154", "\101\x63\x73\40\x70\x72\x6f\143\145\x73\x73\x53\x61\155\154\x52\x65\163\x70\157\x6e\163\145\x20\x61\x73\163\145\162\164\151\157\x6e\x5f\163\151\x67\156\141\x74\x75\x72\145\137\x64\x61\164\141\x3a\40\x3c\x70\x72\x65\x3e\100\x61\x73\x73\145\x72\x74\151\157\x6e\137\x73\151\147\156\x61\x74\x75\162\x65\x5f\x64\x61\x74\x61\x3c\x2f\160\x72\x65\x3e", array("\100\141\x73\x73\x65\162\164\151\x6f\156\137\x73\151\x67\x6e\x61\164\165\x72\145\137\x64\x61\164\141" => print_r($k6, TRUE)), WATCHDOG_INFO);
        if (empty($k6)) {
            goto Nh;
        }
        watchdog("\155\x69\x6e\x69\157\x72\x61\x6e\147\145\137\163\x61\x6d\154", "\101\x63\x73\x20\160\x72\x6f\143\x65\x73\163\123\141\x6d\154\122\x65\x73\x70\x6f\156\x73\145\40\41\x65\x6d\x70\164\171\50\x24\141\163\x73\x65\162\x74\151\157\156\137\163\x69\147\x6e\x61\164\165\x72\x65\x5f\x64\x61\x74\141\51", array());
        $HS = Utilities::processResponse($Sg, $BT, $k6, $DF, $WE);
        if ($HS) {
            goto x1;
        }
        watchdog("\x6d\151\x6e\x69\x6f\162\x61\x6e\147\x65\137\x73\141\x6d\x6c", "\x41\x63\163\40\x70\x72\157\x63\x65\163\x73\x53\141\x6d\x6c\122\145\163\160\157\156\163\145\40\x21\x76\141\154\151\x64\137\x73\x69\x67\x6e\141\164\165\162\145", array());
        echo "\x49\156\x76\x61\x6c\x69\144\40\123\151\x67\x6e\141\164\165\162\145\x20\x69\156\x20\123\x41\115\x4c\x20\x41\163\163\145\x72\x74\x69\x6f\x6e";
        die;
        x1:
        watchdog("\x6d\x69\x6e\x69\x6f\x72\141\x6e\147\145\137\x73\x61\x6d\154", "\x41\143\163\40\x70\x72\x6f\x63\145\163\x73\123\141\155\154\122\145\163\160\x6f\x6e\163\x65\x20\166\x61\154\151\x64\137\163\x69\x67\156\141\x74\x75\162\x65", array());
        Nh:
        $Sg = substr($Sg, 0, strpos($Sg, "\77"));
        watchdog("\x6d\151\156\151\157\162\141\x6e\147\145\137\x73\141\x6d\x6c", "\x41\143\163\x20\x70\162\157\x63\145\x73\x73\123\x61\x6d\154\122\x65\x73\x70\157\x6e\163\x65\40\141\x63\x73\x5f\165\x72\154\x3a\40\x3c\160\x72\x65\x3e\100\x61\143\163\137\165\162\154\x3c\x2f\x70\162\145\x3e", array("\100\141\x63\x73\x5f\165\162\154" => print_r($Sg, TRUE)), WATCHDOG_INFO);
        Utilities::validateIssuerAndAudience($DF, $Rh, $vH, $base_url, $WE);
        $S3 = current($DF->getAssertions())->getAttributes();
        watchdog("\x6d\x69\156\x69\157\162\141\x6e\147\x65\x5f\x73\141\155\154", "\x41\143\x73\40\x70\162\x6f\143\145\x73\163\123\141\155\154\122\145\x73\x70\157\156\163\x65\x20\141\164\x74\162\x73\72\x20\x3c\160\x72\145\76\x40\141\164\x74\162\x73\74\x2f\160\x72\145\x3e", array("\x40\x61\x74\164\x72\163" => print_r($S3, TRUE)), WATCHDOG_INFO);
        variable_set("\155\x69\156\x69\157\x72\141\156\147\145\137\x73\x61\x6d\154\x5f\x61\164\164\x72\163\137\x6c\x69\x73\x74", $S3);
        if ($JN != "\116\141\155\x65\111\104") {
            goto ch;
        }
        watchdog("\x6d\x69\156\x69\x6f\162\x61\x6e\147\145\137\x73\141\155\154", "\x41\143\x73\x20\x70\162\x6f\143\x65\163\x73\x53\x61\155\154\122\145\163\160\x6f\156\163\145\40\145\154\x73\145\40\157\x66\40\165\163\145\x72\x6e\x61\x6d\145\x5f\141\164\164\x72\151\x62\165\164\x65\x20\41\75\40\x22\x4e\141\155\145\111\x44\x22\x20", array());
        $uK = current(current($DF->getAssertions())->getNameId());
        goto XG;
        ch:
        watchdog("\x6d\x69\156\x69\157\x72\x61\x6e\147\145\x5f\163\141\x6d\x6c", "\101\143\x73\40\x70\162\x6f\143\x65\x73\163\123\x61\155\154\x52\145\x73\x70\157\156\163\x65\40\x75\163\145\x72\x6e\141\155\x65\x5f\x61\164\164\x72\x69\142\165\164\145\40\x21\75\x20\42\x4e\x61\x6d\145\x49\104\x22\40", array());
        if (array_key_exists($JN, $S3)) {
            goto EM;
        }
        $uK = current(current($DF->getAssertions())->getNameId());
        goto Pp;
        EM:
        $uK = $S3[$JN][0];
        Pp:
        XG:
        watchdog("\155\151\x6e\x69\157\x72\141\x6e\x67\145\x5f\163\x61\155\x6c", "\101\x63\163\x20\x70\x72\x6f\x63\145\x73\x73\x53\x61\x6d\x6c\122\145\x73\160\157\156\163\x65\40\x75\163\x65\162\156\x61\x6d\145\72\40\x3c\x70\162\x65\x3e\x40\x75\163\x65\162\x6e\141\155\145\74\x2f\x70\162\145\x3e", array("\100\165\x73\x65\x72\156\x61\155\x65" => print_r($uK, TRUE)), WATCHDOG_INFO);
        $FM = variable_get("\x6d\x69\x6e\x69\157\x72\x61\x6e\x67\145\137\x73\x61\x6d\x6c\137\145\155\141\x69\154\137\x61\x74\x74\162\x69\x62\x75\164\145", "\x4e\x61\155\145\111\x44");
        if ($FM == "\116\x61\x6d\145\111\104") {
            goto Px;
        }
        watchdog("\x6d\x69\156\151\157\x72\x61\156\147\145\x5f\163\x61\155\x6c", "\x41\143\x73\x20\x70\162\x6f\143\x65\163\163\123\x61\155\154\122\x65\163\x70\157\156\163\x65\x20\145\154\163\x65\40\157\146\40\x65\155\x61\151\154\137\141\x74\164\162\x69\x62\x75\x74\x65\x20\75\x3d\x20\x22\116\x61\x6d\145\111\104\x22\x20", array());
        $sK = $S3[$FM][0];
        goto vu;
        Px:
        watchdog("\x6d\x69\x6e\151\157\x72\x61\x6e\147\x65\137\x73\141\155\x6c", "\x41\x63\163\40\160\x72\157\143\145\x73\x73\123\x61\155\x6c\122\x65\163\x70\x6f\156\x73\145\40\x65\x6d\141\151\x6c\137\x61\164\164\x72\151\x62\x75\164\145\40\75\75\40\x22\116\x61\x6d\145\111\104\42\40", array());
        $sK = current(current($DF->getAssertions())->getNameId());
        vu:
        watchdog("\x6d\151\x6e\x69\x6f\162\x61\x6e\147\x65\137\163\x61\x6d\154", "\x41\x63\x73\40\x70\162\157\143\x65\163\x73\x53\141\x6d\x6c\x52\x65\x73\x70\157\x6e\163\145\40\x65\155\141\x69\154\137\x76\141\x6c\165\145\72\40\74\x70\x72\x65\x3e\100\x65\155\141\151\x6c\x5f\x76\141\154\165\145\74\57\x70\x72\145\x3e", array("\100\x65\x6d\x61\151\x6c\137\166\x61\x6c\x75\x65" => print_r($sK, TRUE)), WATCHDOG_INFO);
        variable_set("\x6d\x69\156\151\157\x72\141\156\x67\x65\x5f\x73\x61\x6d\x6c\137\145\x6d\141\x69\154\x5f\x69\144\137\x76\141\x6c\165\x65", $sK);
        $P6 = '';
        if (!array_key_exists("\x52\145\x6c\141\171\123\x74\x61\164\x65", $post)) {
            goto BK;
        }
        watchdog("\x6d\x69\156\x69\157\162\141\156\147\145\x5f\163\x61\155\154", "\x41\143\163\x20\x70\x72\157\143\145\163\x73\x53\141\155\154\122\145\163\160\x6f\156\163\145\x20\x69\x66\40\141\162\162\141\x79\137\153\145\171\137\x65\170\x69\163\164\x73\50\42\x52\145\x6c\x61\x79\x53\x74\141\164\145\42\54\x20\x24\x70\157\163\164\51\40", array());
        if ($post["\x52\x65\154\141\x79\x53\x74\141\x74\145"] == "\164\x65\163\x74\126\141\154\151\x64\141\164\x65") {
            goto KD;
        }
        watchdog("\x6d\151\x6e\151\x6f\162\x61\x6e\x67\145\x5f\x73\141\x6d\x6c", "\x41\x63\x73\40\160\x72\x6f\143\145\163\x73\x53\x61\155\x6c\122\x65\163\160\157\x6e\x73\145\x20\x65\154\x73\145\x20\157\146\x20\151\x66\x20\44\x70\157\163\x74\133\x22\122\x65\x6c\141\x79\x53\164\x61\x74\x65\x22\135\40\75\75\x20\42\164\x65\163\164\x56\141\x6c\x69\144\141\x74\145\42\x20", array());
        $P6 = $post["\122\x65\154\141\x79\x53\x74\141\x74\x65"];
        goto Rr;
        KD:
        watchdog("\x6d\151\156\151\x6f\162\x61\156\147\145\137\163\x61\155\154", "\x41\x63\163\40\x70\162\x6f\x63\145\163\163\x53\x61\x6d\154\122\x65\163\160\157\156\163\145\40\x69\x66\x20\x24\160\157\163\164\x5b\42\122\x65\154\x61\171\x53\164\141\164\x65\42\x5d\40\x3d\x3d\40\x22\164\145\x73\x74\126\x61\154\151\144\141\164\145\42\x20", array());
        $this->showTestResults($uK, $S3);
        Rr:
        BK:
        $aA = current($DF->getAssertions())->getSessionIndex();
        $cO = current(current($DF->getAssertions())->getNameId());
        $K9 = array();
        foreach ($Fq as $AM => $W8) {
            if (!array_key_exists($W8, $S3)) {
                goto UA;
            }
            $I3 = $S3[$W8][0];
            $K9[$AM] = $I3;
            UA:
            YO:
        }
        gJ:
        watchdog("\x6d\151\x6e\151\x6f\x72\141\x6e\x67\145\x5f\163\x61\155\x6c", "\x41\x63\x73\40\x70\x72\157\143\x65\163\x73\123\141\x6d\154\x52\145\163\160\157\x6e\x73\x65\40\143\x75\163\164\x6f\155\137\x61\x74\x74\x72\x69\x62\x75\164\145\x5f\x76\x61\x6c\x75\145\x73\72\x20\74\160\162\x65\76\x40\x63\x75\x73\164\157\155\x5f\x61\164\164\x72\151\x62\165\x74\145\137\166\x61\154\x75\145\163\74\x2f\x70\x72\145\x3e", array("\x40\143\165\x73\164\157\x6d\x5f\141\164\x74\162\x69\x62\165\164\145\137\x76\141\x6c\x75\145\x73" => print_r($K9, TRUE)), WATCHDOG_INFO);
        $Yn = variable_get("\155\151\156\x69\x6f\162\x61\156\x67\145\137\x73\x61\x6d\x6c\x5f\x69\x64\160\137\x61\x74\164\162\x31\137\x6e\141\155\x65", '');
        if (!(isset($Yn) && !empty($Yn) && isset($S3[$Yn]))) {
            goto MM;
        }
        watchdog("\155\x69\156\x69\157\162\141\x6e\x67\145\x5f\163\141\x6d\x6c", "\101\143\x73\x20\x70\162\x6f\x63\x65\x73\x73\123\141\x6d\x6c\x52\145\163\x70\157\x6e\x73\x65\x20\151\x66\40\x69\x73\x73\x65\x74\50\44\162\x6f\154\145\x5f\x61\164\164\x72\151\x62\x75\164\x65\51\x20\46\x26\x20\x21\x65\x6d\x70\164\171\x28\x24\x72\157\x6c\145\x5f\141\164\x74\162\151\x62\x75\164\x65\51\x20\x26\x26\x20\151\x73\x73\145\164\50\x24\x61\164\164\x72\163\x5b\44\x72\x6f\154\145\137\141\164\164\162\x69\142\165\164\145\135\51\x20", array());
        $iy = $S3[$Yn];
        $iy[0] = preg_replace("\x2f\134\163\x2b\57", '', $iy[0]);
        $Yo = strpos($iy[0], "\x2c");
        if (!(sizeof($S3[$Yn]) == 1 && $Yo !== false)) {
            goto dl;
        }
        watchdog("\x6d\x69\156\x69\x6f\162\141\156\x67\x65\x5f\163\141\x6d\154", "\101\143\x73\x20\x70\162\157\x63\145\x73\163\x53\141\155\x6c\x52\x65\x73\x70\157\156\x73\145\x20\151\146\x20\x73\x69\172\x65\x6f\146\x28\44\x61\x74\x74\x72\x73\x5b\44\x72\157\154\145\x5f\x61\164\164\x72\x69\x62\165\164\145\x5d\51\x20\75\75\40\x31\x20\46\46\x20\x24\x70\x6f\x73\x20\x21\x3d\75\x20\146\x61\x6c\x73\x65\40", array());
        $Xn = explode("\x2c", $iy[0]);
        $S3[$Yn] = $Xn;
        dl:
        $rJ = 0;
        s1:
        if (!($rJ < sizeof($S3[$Yn]))) {
            goto ys;
        }
        $T8[$rJ] = $S3[$Yn][$rJ];
        AM:
        $rJ++;
        goto s1;
        ys:
        $N8 = array();
        $rJ = 0;
        aN:
        if (!($rJ < sizeof($T8))) {
            goto g7;
        }
        foreach ($qo as $AM => $W8) {
            if (!(!empty($AM) && !is_null($AM) && !strcasecmp($T8[$rJ], $AM))) {
                goto AH;
            }
            $qK = array_search($W8, user_roles());
            $N8[$qK] = $W8;
            AH:
            QS:
        }
        K7:
        Mk:
        $rJ++;
        goto aN;
        g7:
        MM:
        $od = array();
        $od["\145\155\141\151\154"] = isset($sK) ? $sK : '';
        $od["\165\x73\x65\x72\x6e\x61\155\x65"] = isset($uK) ? $uK : '';
        $od["\116\x61\x6d\x65\111\x44"] = isset($cO) ? $cO : '';
        $od["\x73\145\x73\163\x69\x6f\156\x49\156\x64\x65\x78"] = isset($aA) ? $aA : '';
        $od["\143\165\x73\x74\157\155\106\x69\x65\x6c\144\x41\x74\x74\x72\151\x62\165\164\145\163"] = isset($K9) ? $K9 : '';
        $od["\x63\165\163\164\x6f\x6d\106\x69\x65\154\144\x52\157\154\x65\x73"] = isset($N8) ? $N8 : '';
        if (empty($P6)) {
            goto Mj;
        }
        watchdog("\x6d\x69\x6e\x69\x6f\x72\x61\156\x67\x65\137\163\x61\155\154", "\101\143\x73\x20\x70\162\157\x63\145\163\163\x53\141\x6d\154\x52\x65\x73\160\157\x6e\x73\x65\x20\151\x66\40\41\145\155\x70\x74\171\50\44\162\x65\x6c\141\x79\137\x73\x74\141\164\x65\x29", array());
        $od["\x72\145\154\141\x79\x5f\x73\x74\141\164\145"] = $P6;
        Mj:
        return $od;
    }
    function show_error_message($Dc, $y2)
    {
        if ($y2 == "\x74\x65\163\164\x56\141\154\x69\144\141\164\x65") {
            goto EW;
        }
        if ($Dc == "\x52\x65\161\x75\x65\163\x74\104\145\156\151\145\144") {
            goto QE;
        }
        echo "\127\145\x20\x63\157\x75\154\x64\40\156\x6f\x74\40\x73\x69\147\x6e\x20\171\157\165\x20\x69\x6e\56\40\120\154\x65\x61\x73\145\x20\143\x6f\x6e\x74\x61\143\164\x20\171\157\x75\x72\x20\x41\x64\x6d\x69\156\x69\163\x74\x72\x61\x74\x6f\162\56";
        die;
        goto ah;
        QE:
        echo "\x59\x6f\165\40\x61\x72\x65\40\x6e\157\164\x20\141\154\x6c\157\167\x65\x64\40\164\157\40\x6c\157\147\x69\156\x20\151\x6e\164\157\40\x74\x68\145\x20\163\x69\x74\145\x2e\40\120\x6c\145\x61\x73\x65\40\x63\157\x6e\x74\141\143\164\x20\171\x6f\x75\x72\40\x41\x64\x6d\x69\x6e\151\163\x74\162\x61\x74\157\x72\x2e";
        die;
        ah:
        goto jv;
        EW:
        echo "\74\144\151\x76\x20\x73\164\x79\x6c\x65\75\x22\x66\157\x6e\164\x2d\146\x61\155\x69\154\171\x3a\x43\141\x6c\x69\x62\162\151\73\160\x61\x64\144\151\x6e\147\x3a\60\40\x33\x25\x3b\x22\76";
        echo "\74\144\151\x76\x20\x73\164\x79\154\x65\x3d\42\143\x6f\x6c\x6f\162\72\x20\43\141\x39\64\64\x34\62\73\x62\141\x63\x6b\x67\162\157\x75\x6e\x64\x2d\143\x6f\x6c\x6f\162\x3a\40\43\x66\62\x64\145\144\x65\x3b\x70\141\144\144\151\156\x67\x3a\40\61\x35\x70\x78\73\155\x61\x72\x67\x69\156\x2d\142\157\x74\164\157\155\72\x20\62\x30\160\x78\73\164\x65\170\x74\55\x61\x6c\151\147\156\x3a\143\145\156\164\145\162\73\x62\x6f\x72\x64\145\x72\x3a\x31\x70\170\40\x73\x6f\154\x69\144\40\x23\x45\x36\x42\63\x42\62\x3b\146\x6f\x6e\x74\x2d\x73\151\x7a\145\72\x31\x38\160\x74\73\x22\76\40\x45\122\122\x4f\122\x3c\57\x64\151\x76\x3e\15\12\11\x9\x9\x3c\x64\151\166\40\163\164\x79\x6c\x65\75\x22\x63\157\154\157\x72\x3a\x20\x23\141\71\x34\x34\64\x32\73\146\157\x6e\x74\55\x73\151\172\x65\x3a\61\x34\160\164\x3b\x20\x6d\141\x72\147\151\x6e\55\x62\x6f\x74\164\157\x6d\72\62\x30\160\x78\x3b\42\76\74\160\76\74\x73\x74\x72\x6f\156\147\76\105\162\162\x6f\x72\x3a\40\74\57\x73\x74\162\x6f\156\147\76\x20\111\x6e\166\141\x6c\151\144\x20\x53\x41\x4d\x4c\x20\122\145\163\160\157\x6e\x73\145\x20\x53\164\141\164\x75\163\x2e\x3c\57\x70\76\xd\12\x9\11\x9\74\160\76\x3c\163\x74\x72\x6f\x6e\x67\76\103\141\x75\163\145\x73\x3c\x2f\163\x74\162\x6f\x6e\x67\x3e\72\40\x49\x64\x65\x6e\164\151\x74\x79\x20\x50\x72\x6f\166\x69\x64\x65\x72\40\150\141\x73\40\163\145\x6e\164\40\47" . $Dc . "\47\x20\x73\164\141\164\x75\x73\x20\143\157\144\145\x20\x69\156\x20\123\x41\115\114\x20\122\145\163\x70\157\x6e\163\x65\56\40\x3c\57\160\76\xd\12\x9\11\x9\11\x9\x9\11\x3c\x70\x3e\74\163\x74\162\157\x6e\x67\76\x52\x65\141\x73\x6f\x6e\x3c\x2f\x73\x74\x72\157\156\x67\x3e\x3a\40" . $this->get_status_message($Dc) . "\x3c\57\160\76\74\x62\162\76\xd\12\11\x9\x9\74\x2f\144\151\166\76\xd\xa\15\xa\x9\x9\x9\x3c\x64\x69\x76\40\x73\164\x79\x6c\x65\75\x22\x6d\141\162\x67\x69\x6e\x3a\x33\45\x3b\144\x69\163\160\x6c\x61\171\72\x62\154\157\143\153\73\164\145\170\x74\55\x61\x6c\151\147\x6e\x3a\143\x65\156\x74\x65\162\x3b\42\76\xd\xa\11\x9\x9\x3c\144\x69\166\x20\x73\x74\171\154\x65\75\42\x6d\x61\x72\x67\151\x6e\x3a\x33\45\73\144\151\x73\160\154\141\171\72\142\154\157\x63\x6b\x3b\x74\x65\x78\164\55\141\154\151\x67\156\x3a\x63\145\156\x74\x65\x72\73\42\x3e\x3c\151\x6e\160\165\x74\x20\x73\x74\171\x6c\x65\75\x22\160\x61\144\144\151\x6e\x67\72\x31\x25\x3b\x77\151\144\x74\x68\x3a\61\x30\60\x70\170\73\142\141\x63\153\x67\x72\157\165\x6e\x64\72\40\x23\x30\x30\x39\61\103\x44\40\x6e\x6f\156\x65\40\x72\x65\x70\x65\x61\164\40\x73\x63\x72\x6f\x6c\154\x20\x30\x25\40\60\x25\x3b\143\165\x72\163\157\162\x3a\40\160\x6f\151\156\x74\x65\162\73\146\157\x6e\164\x2d\163\151\x7a\x65\72\61\x35\160\x78\73\x62\157\x72\144\145\x72\55\167\151\144\x74\150\x3a\x20\61\160\x78\x3b\142\x6f\162\x64\x65\x72\55\x73\164\x79\154\x65\72\40\x73\x6f\x6c\151\144\73\x62\157\x72\x64\x65\x72\x2d\x72\141\x64\151\x75\x73\72\40\63\160\x78\73\x77\x68\x69\164\x65\55\163\x70\141\x63\145\72\x20\x6e\x6f\x77\162\141\x70\73\142\157\x78\x2d\163\x69\172\151\x6e\x67\x3a\40\142\x6f\162\144\145\x72\x2d\142\x6f\170\73\142\157\162\x64\x65\x72\x2d\x63\157\x6c\x6f\162\72\40\43\x30\x30\x37\x33\x41\101\x3b\142\x6f\170\x2d\163\x68\x61\x64\x6f\167\x3a\x20\60\160\170\x20\x31\x70\x78\40\60\x70\x78\40\162\x67\x62\x61\x28\x31\62\60\x2c\x20\x32\60\60\54\x20\x32\63\x30\54\40\x30\56\x36\x29\40\151\156\x73\145\164\x3b\143\x6f\x6c\157\x72\72\x20\x23\x46\x46\x46\x3b\42\x74\171\x70\x65\x3d\x22\x62\165\x74\x74\x6f\x6e\x22\x20\166\141\x6c\165\x65\75\x22\x44\x6f\x6e\145\x22\40\x6f\156\x43\154\151\x63\153\x3d\x22\163\145\x6c\146\x2e\143\x6c\x6f\163\x65\x28\x29\73\42\x3e\74\57\144\151\x76\76";
        die;
        jv:
    }
    function get_status_message($Dc)
    {
        switch ($Dc) {
            case "\x52\145\x71\165\x65\x73\x74\104\145\x6e\151\x65\144":
                return "\x59\157\165\40\141\x72\145\40\156\x6f\164\40\141\x6c\154\x6f\x77\145\x64\x20\164\157\x20\154\x6f\147\151\156\40\151\156\164\157\x20\164\x68\145\40\x73\x69\164\145\56\x20\120\x6c\x65\x61\163\x65\x20\x63\157\x6e\164\141\x63\x74\40\171\x6f\165\162\x20\x41\x64\x6d\x69\156\151\x73\164\x72\x61\x74\157\x72\x2e";
                goto Dz;
            case "\x52\x65\x71\x75\145\163\164\x65\162":
                return "\124\x68\145\x20\162\145\x71\165\145\x73\164\40\x63\x6f\165\154\144\40\x6e\x6f\x74\40\x62\145\40\160\x65\162\146\157\x72\x6d\x65\144\x20\x64\165\145\x20\x74\157\x20\x61\156\40\145\162\162\157\x72\x20\157\x6e\x20\x74\150\x65\40\160\141\162\164\x20\157\x66\40\164\150\145\40\x72\x65\161\x75\x65\x73\x74\145\162\56";
                goto Dz;
            case "\x52\x65\163\x70\x6f\x6e\144\145\162":
                return "\x54\x68\145\40\162\145\161\x75\x65\163\164\x20\x63\x6f\x75\154\x64\40\156\x6f\x74\x20\142\x65\40\160\145\x72\146\x6f\x72\155\145\x64\40\144\165\x65\40\x74\157\40\x61\x6e\40\x65\x72\162\157\162\40\157\x6e\x20\x74\150\145\x20\x70\141\x72\x74\40\157\146\x20\x74\150\x65\x20\123\x41\x4d\x4c\40\162\x65\x73\x70\x6f\156\144\145\x72\x20\x6f\162\x20\123\x41\x4d\x4c\x20\x61\x75\x74\x68\x6f\162\x69\164\171\x2e";
                goto Dz;
            case "\126\145\x72\163\151\157\x6e\115\x69\163\x6d\141\x74\x63\x68":
                return "\124\150\145\40\x53\x41\x4d\114\40\162\x65\x73\160\x6f\156\x64\x65\x72\x20\x63\157\x75\154\144\40\156\x6f\164\x20\160\162\157\x63\x65\x73\x73\x20\164\150\x65\40\x72\x65\x71\x75\145\x73\x74\40\x62\145\x63\141\165\x73\x65\40\x74\x68\x65\40\166\x65\162\163\x69\157\x6e\x20\157\146\x20\x74\x68\145\40\x72\145\161\x75\145\163\164\40\155\x65\x73\x73\x61\147\x65\x20\167\x61\x73\40\x69\156\x63\x6f\x72\162\145\x63\164\x2e";
                goto Dz;
            default:
                return "\125\156\153\x6e\157\x77\156";
        }
        vX:
        Dz:
    }
    public function showTestResults($uK, $S3)
    {
        global $base_url;
        $na = drupal_get_path("\155\157\x64\165\x6c\x65", "\155\x69\x6e\151\x6f\x72\x61\x6e\x67\145\137\163\x61\155\x6c");
        echo "\74\x64\x69\166\x20\x73\164\x79\154\x65\75\42\x66\x6f\x6e\x74\55\x66\x61\x6d\x69\154\171\72\x43\x61\x6c\x69\142\162\x69\73\x70\x61\144\x64\x69\156\x67\72\x30\x20\63\x25\73\x22\x3e";
        if (!empty($uK)) {
            goto Nv;
        }
        echo "\74\x64\x69\x76\x20\x73\164\171\x6c\145\x3d\42\x63\157\x6c\x6f\x72\72\x20\43\x61\x39\x34\64\64\62\73\142\141\143\153\x67\162\x6f\x75\156\144\55\x63\x6f\154\x6f\162\x3a\x20\x23\146\x32\144\145\x64\145\x3b\x70\141\144\144\151\156\x67\72\40\61\x35\160\170\73\155\141\162\147\151\x6e\x2d\x62\x6f\164\x74\157\155\72\x20\62\x30\x70\x78\x3b\x74\x65\170\x74\x2d\x61\x6c\151\x67\x6e\72\143\x65\x6e\164\145\162\73\142\157\162\x64\145\162\x3a\x31\x70\x78\x20\163\157\154\151\x64\40\43\x45\x36\102\x33\x42\62\73\146\157\x6e\x74\55\x73\151\172\145\72\61\70\x70\x74\x3b\42\x3e\x54\x45\123\x54\x20\x46\x41\111\114\x45\104\x3c\x2f\x64\x69\166\76\15\12\40\x20\x20\x20\x20\40\x20\x20\40\x20\x3c\144\x69\x76\x20\x73\164\x79\154\x65\75\42\x63\x6f\x6c\157\x72\72\40\43\141\71\x34\x34\x34\62\x3b\x66\x6f\156\164\x2d\x73\x69\172\145\72\x31\64\x70\x74\73\x20\155\141\162\147\151\156\55\x62\157\164\x74\x6f\x6d\x3a\x32\60\x70\x78\x3b\42\76\x57\x41\122\x4e\x49\116\x47\72\x20\x53\x6f\155\145\40\x41\x74\x74\162\151\x62\x75\x74\145\x73\40\104\x69\144\x20\x4e\x6f\164\40\115\x61\x74\143\150\x2e\74\57\144\151\166\76\15\12\40\x20\x20\x20\40\x20\x20\40\x20\x20\74\x64\x69\166\40\x73\x74\171\x6c\145\x3d\x22\144\x69\163\160\x6c\141\x79\72\142\x6c\157\143\x6b\73\x74\x65\x78\164\55\141\154\x69\147\156\x3a\x63\x65\x6e\x74\x65\x72\73\x6d\x61\162\147\151\156\55\x62\157\x74\x74\x6f\x6d\72\x34\x25\73\x22\x3e\x3c\151\155\x67\40\x73\164\171\154\145\75\42\x77\x69\x64\x74\150\72\x31\x35\45\73\42\163\x72\143\75\42" . $na . "\151\156\143\x6c\165\144\145\163\57\151\155\x61\147\145\x73\x2f\x77\x72\x6f\x6e\x67\56\160\156\x67\42\x3e\74\57\144\151\x76\76";
        goto xs;
        Nv:
        echo "\x3c\x64\151\166\x20\x73\x74\171\154\145\75\42\143\157\154\157\162\72\x20\x23\x33\143\67\x36\x33\x64\73\15\12\40\40\40\40\40\x20\40\40\x20\x20\142\x61\x63\153\147\x72\157\165\x6e\x64\x2d\143\157\x6c\x6f\162\72\x20\43\144\x66\146\60\144\70\73\40\x70\x61\144\144\x69\x6e\147\x3a\x32\45\x3b\x6d\x61\162\147\x69\156\55\x62\157\164\x74\x6f\x6d\x3a\62\x30\x70\x78\73\x74\x65\x78\164\x2d\x61\x6c\151\x67\156\72\143\x65\x6e\164\145\x72\x3b\40\142\x6f\x72\144\145\x72\x3a\61\160\x78\x20\163\x6f\x6c\151\x64\40\x23\x41\105\104\x42\x39\x41\73\x20\146\x6f\156\x74\55\x73\x69\172\x65\72\x31\x38\x70\164\73\42\76\124\105\123\124\x20\x53\125\x43\x43\105\x53\x53\x46\x55\x4c\74\57\x64\x69\166\76\15\xa\x20\x20\x20\x20\40\40\x20\40\40\40\x3c\144\x69\166\40\163\164\x79\x6c\145\75\x22\x64\151\163\x70\x6c\141\x79\72\x62\x6c\x6f\x63\x6b\x3b\164\x65\x78\x74\x2d\x61\x6c\x69\x67\156\72\143\x65\156\164\145\162\73\155\x61\162\147\151\x6e\x2d\x62\157\164\164\x6f\x6d\72\x34\45\x3b\x22\76\x3c\x69\x6d\147\40\163\164\x79\x6c\x65\75\x22\167\x69\144\164\x68\72\61\x35\45\x3b\x22\x73\x72\143\75\42" . $na . "\57\151\156\x63\x6c\x75\144\145\163\57\x69\x6d\141\x67\x65\x73\x2f\147\162\145\145\156\x5f\143\x68\145\143\x6b\x2e\160\156\147\42\x3e\x3c\57\144\x69\166\x3e";
        xs:
        echo "\74\163\x70\141\156\40\x73\164\x79\x6c\145\75\x22\x66\157\156\x74\x2d\x73\x69\172\x65\72\x31\x34\160\x74\73\x22\x3e\74\142\x3e\x48\x65\154\x6c\157\x3c\57\x62\76\x2c\x20" . $uK . "\x3c\x2f\x73\x70\x61\x6e\76\74\142\162\x2f\x3e\x3c\160\x20\x73\164\171\x6c\145\x3d\x22\x66\157\156\164\55\x77\145\151\x67\x68\x74\x3a\x62\x6f\x6c\144\73\146\157\156\x74\55\x73\x69\x7a\145\72\61\x34\x70\x74\73\155\141\162\x67\x69\156\x2d\x6c\x65\146\x74\72\61\45\x3b\42\x3e\101\124\x54\122\111\x42\125\124\105\123\x20\122\105\x43\x45\111\126\x45\x44\72\x3c\57\x70\76\15\12\x20\40\x20\x20\x20\x20\x20\40\x3c\164\x61\x62\x6c\x65\40\x73\164\x79\x6c\x65\75\42\x62\157\162\x64\x65\162\x2d\143\x6f\154\x6c\141\x70\x73\145\x3a\x63\x6f\x6c\x6c\141\160\x73\145\x3b\142\157\x72\144\145\162\x2d\163\160\141\143\x69\156\147\x3a\x30\x3b\x20\144\151\x73\160\x6c\x61\171\72\x74\141\142\x6c\x65\73\x77\x69\x64\164\150\72\61\x30\x30\x25\x3b\x20\x66\x6f\x6e\164\55\163\151\x7a\x65\72\61\64\160\164\x3b\142\141\143\x6b\147\x72\157\x75\156\x64\55\143\x6f\x6c\x6f\x72\72\43\x45\x44\x45\x44\105\x44\x3b\42\x3e\xd\xa\x20\40\x20\40\x20\40\40\40\74\x74\162\x20\163\x74\171\x6c\x65\75\42\164\x65\x78\x74\55\141\x6c\151\x67\156\72\x63\145\156\164\145\162\73\42\x3e\x3c\164\144\40\163\x74\171\154\x65\x3d\42\x66\157\x6e\164\x2d\167\x65\x69\x67\x68\164\72\142\157\154\144\73\x62\157\x72\144\145\162\72\62\x70\x78\40\x73\157\x6c\151\x64\x20\43\x39\x34\71\60\x39\60\73\x70\x61\144\144\151\x6e\147\x3a\x32\x25\73\x22\x3e\101\124\124\x52\111\x42\x55\x54\x45\40\x4e\x41\115\x45\x3c\57\164\x64\76\74\164\144\40\163\164\171\x6c\x65\75\42\146\x6f\156\164\x2d\167\145\151\x67\150\x74\x3a\142\x6f\x6c\144\73\x70\141\144\x64\x69\156\147\72\62\x25\x3b\142\157\x72\x64\145\162\x3a\x32\x70\x78\40\x73\x6f\x6c\x69\144\40\x23\71\x34\x39\60\71\x30\73\40\167\x6f\162\144\x2d\x77\x72\141\x70\72\142\162\145\141\153\55\167\157\x72\x64\x3b\x22\x3e\x41\x54\x54\122\111\x42\125\124\x45\x20\x56\101\114\125\x45\74\57\164\144\76\74\57\164\x72\76";
        if (!empty($S3)) {
            goto p0;
        }
        echo "\x3c\164\x72\x3e\74\164\x64\x20\163\x74\x79\x6c\145\x3d\47\x66\157\156\x74\55\x77\145\x69\x67\150\x74\72\142\157\x6c\144\x3b\x62\157\162\144\145\162\72\x32\160\170\40\x73\x6f\x6c\151\144\x20\43\71\64\71\x30\x39\x30\73\x70\141\144\144\x69\156\147\72\x32\x25\73\47\x3e\x4e\141\x6d\x65\x49\x44\x3c\57\164\144\76\x3c\164\144\40\x73\164\171\154\145\x3d\47\160\141\144\x64\x69\156\x67\72\62\x25\73\x62\x6f\x72\144\x65\x72\72\62\x70\170\40\x73\x6f\154\151\144\40\43\x39\x34\x39\60\71\x30\x3b\x20\x77\157\162\144\55\167\162\x61\x70\x3a\142\162\145\141\x6b\x2d\x77\157\162\144\73\x27\x3e" . $uK . "\74\x2f\x74\144\76\74\57\x74\162\76";
        goto zH;
        p0:
        echo "\x3c\x74\162\x3e\x3c\164\144\40\163\164\171\x6c\x65\75\47\x66\x6f\x6e\x74\55\167\x65\x69\x67\x68\x74\x3a\x62\157\154\144\73\142\157\162\144\x65\x72\72\62\160\170\x20\163\x6f\x6c\151\144\x20\x23\71\64\x39\x30\x39\60\x3b\x70\141\144\x64\x69\x6e\147\x3a\x32\x25\73\47\x3e\116\141\x6d\145\x49\x44\74\x2f\164\x64\x3e\74\x74\x64\40\x73\x74\x79\x6c\145\75\47\160\141\144\144\151\x6e\x67\72\62\45\73\142\157\x72\144\145\x72\x3a\62\x70\170\40\x73\157\x6c\x69\x64\40\x23\71\64\71\x30\71\60\73\40\x77\x6f\x72\144\x2d\167\x72\x61\x70\72\x62\162\145\x61\153\x2d\167\157\x72\144\73\47\x3e" . $uK . "\74\x2f\164\x64\76\74\57\164\x72\76";
        foreach ($S3 as $AM => $W8) {
            echo "\x3c\164\x72\x3e\74\164\144\x20\x73\164\171\x6c\145\x3d\x27\146\x6f\x6e\164\55\x77\x65\151\147\150\x74\x3a\x62\x6f\154\144\73\142\x6f\x72\144\145\162\72\62\160\x78\x20\163\x6f\154\151\144\40\43\x39\64\71\60\71\x30\73\x70\x61\144\144\151\156\147\72\62\x25\x3b\47\x3e" . $AM . "\x3c\57\164\x64\x3e\74\164\x64\40\163\164\x79\154\145\x3d\47\160\x61\144\x64\x69\x6e\147\72\62\45\x3b\142\157\x72\x64\145\x72\x3a\x32\160\x78\40\x73\157\154\151\144\x20\43\71\x34\x39\60\71\x30\73\x20\x77\x6f\x72\x64\55\x77\162\141\x70\72\x62\x72\145\141\153\55\167\x6f\x72\x64\73\47\x3e" . implode("\x3c\x62\162\57\76", $W8) . "\74\x2f\164\144\76\x3c\57\x74\x72\x3e";
            Vb:
        }
        VI:
        zH:
        echo "\74\x2f\x74\x61\x62\154\145\x3e\74\57\144\151\166\x3e";
        echo "\x3c\x64\x69\166\x20\163\x74\171\154\145\75\x22\155\x61\162\x67\x69\x6e\x3a\63\45\73\144\151\x73\x70\x6c\141\x79\72\x62\154\157\143\153\73\164\145\x78\164\x2d\x61\x6c\x69\x67\156\x3a\x63\x65\x6e\164\145\x72\73\42\x3e\xd\12\40\x20\x20\40\40\40\x20\40\x20\x20\x20\x20\x3c\x69\x6e\x70\x75\x74\40\x73\x74\x79\x6c\145\x3d\42\160\141\144\x64\x69\156\147\72\x31\x25\x3b\167\x69\144\164\150\72\x33\67\x25\x3b\142\x61\x63\x6b\147\x72\157\165\x6e\144\72\x20\43\x30\x30\71\x31\x43\104\40\x6e\157\156\145\40\162\145\160\x65\141\164\x20\163\143\162\157\154\x6c\x20\x30\x25\x20\60\x25\73\143\165\162\163\x6f\162\x3a\40\160\x6f\x69\x6e\164\x65\162\x3b\x66\157\x6e\164\55\163\151\172\145\x3a\x31\65\160\170\x3b\15\xa\x20\40\x20\x20\40\x20\x20\40\x20\x20\40\x20\40\40\x20\40\x62\157\x72\x64\145\x72\x2d\x77\x69\x64\x74\150\x3a\x20\x31\160\170\73\142\157\162\x64\x65\x72\55\163\x74\171\154\x65\72\x20\x73\x6f\x6c\151\144\x3b\x62\157\x72\x64\145\x72\x2d\162\141\x64\x69\x75\163\x3a\40\63\160\170\73\x77\x68\x69\x74\145\x2d\x73\160\141\x63\x65\72\x20\x6e\157\x77\x72\x61\160\73\142\157\x78\x2d\x73\x69\172\151\x6e\x67\x3a\40\x62\157\x72\x64\145\162\55\142\x6f\x78\73\x62\x6f\x72\144\x65\x72\55\x63\157\154\157\x72\72\40\x23\x30\60\67\63\101\101\73\xd\xa\40\40\40\x20\x20\x20\40\40\40\40\40\x20\40\40\40\x20\142\x6f\170\x2d\x73\150\141\144\157\x77\x3a\40\x30\160\170\x20\x31\x70\x78\40\60\160\x78\40\162\147\x62\x61\x28\x31\62\x30\x2c\40\62\x30\60\x2c\x20\x32\x33\x30\54\40\x30\x2e\x36\x29\40\151\x6e\163\x65\164\x3b\x63\157\154\x6f\162\72\x20\43\106\106\x46\73\42\164\x79\x70\145\75\42\142\165\164\x74\x6f\x6e\42\x20\166\141\x6c\165\x65\x3d\42\103\x6f\x6e\146\x69\x67\x75\162\x65\x20\x41\x74\164\162\x69\142\x75\x74\x65\x2f\x52\x6f\154\x65\40\x4d\x61\x70\x70\151\x6e\x67\42\x20\15\12\x20\40\40\x20\40\x20\40\x20\x20\40\40\x20\x20\x20\40\40\157\x6e\x43\x6c\151\x63\153\x3d\x22\x63\x6c\157\163\145\137\141\x6e\x64\x5f\162\145\x64\151\x72\145\x63\x74\50\51\x3b\42\x3e\xd\xa\x20\40\x20\x20\x20\x20\x20\x20\40\x20\40\x20\x20\x20\40\40\xd\12\40\40\40\x20\x20\40\x20\x20\x20\40\x20\x20\40\x20\40\x20\x3c\151\x6e\x70\x75\164\40\x73\x74\x79\x6c\145\x3d\42\160\141\x64\144\151\156\x67\72\x31\45\x3b\x77\x69\144\164\150\x3a\61\x30\60\160\170\x3b\142\x61\x63\153\x67\162\x6f\x75\x6e\144\x3a\40\x23\x30\60\x39\x31\x43\x44\40\156\157\x6e\x65\x20\162\x65\x70\x65\141\164\40\x73\143\162\157\x6c\154\40\60\x25\x20\60\x25\73\x63\165\162\x73\157\x72\72\40\x70\x6f\151\x6e\x74\145\x72\x3b\146\x6f\156\x74\55\163\x69\x7a\x65\72\61\x35\x70\170\73\15\xa\40\40\x20\40\x20\x20\x20\40\x20\40\40\40\x20\40\x20\x20\x20\x20\x20\x20\x62\157\162\x64\145\162\55\167\151\x64\164\x68\72\40\61\x70\170\x3b\142\157\x72\144\145\x72\55\x73\164\171\x6c\145\72\40\163\157\x6c\151\144\x3b\x62\157\162\144\x65\x72\55\162\141\144\151\x75\163\x3a\x20\x33\x70\x78\73\167\x68\151\164\x65\55\x73\160\x61\x63\145\x3a\40\x6e\x6f\167\x72\x61\x70\73\x62\x6f\x78\55\x73\x69\x7a\x69\x6e\147\x3a\40\142\157\162\144\x65\162\55\142\157\170\x3b\x62\157\162\144\145\162\55\143\x6f\x6c\157\x72\x3a\40\x23\x30\60\x37\x33\x41\101\73\xd\xa\x20\x20\x20\40\40\40\x20\x20\x20\40\40\x20\40\x20\40\x20\x20\x20\x20\40\x62\x6f\170\x2d\163\x68\141\x64\x6f\167\x3a\40\60\160\170\40\x31\160\170\40\60\x70\x78\x20\162\147\x62\x61\50\x31\62\60\x2c\x20\62\x30\60\x2c\40\62\63\x30\x2c\x20\60\56\x36\x29\x20\151\x6e\x73\x65\164\x3b\143\x6f\154\x6f\x72\x3a\x20\43\x46\x46\106\73\42\164\171\x70\x65\75\42\142\x75\x74\x74\x6f\156\42\40\x76\141\154\x75\145\x3d\42\104\157\x6e\x65\x22\x20\157\x6e\103\x6c\151\x63\x6b\x3d\x22\x73\x65\x6c\146\x2e\143\x6c\x6f\163\x65\x28\51\x3b\42\76\xd\12\40\x20\40\40\40\40\40\x20\x20\x20\x20\x20\15\12\40\x20\x20\x20\x20\40\40\x20\x20\x20\74\x2f\x64\x69\166\x3e\15\xa\40\x20\x20\40\40\x20\40\40\x20\40\74\x73\143\x72\151\160\x74\76\x20\x20\x20\40\40\x20\40\x20\40\40\x20\40\40\x20\40\15\12\x20\40\x20\40\x20\x20\40\40\x20\x20\40\x20\40\40\x66\x75\156\x63\x74\151\x6f\156\40\143\154\x6f\163\145\137\x61\156\144\x5f\x72\145\x64\151\162\x65\143\164\x28\x29\x7b\15\12\40\x20\x20\x20\40\40\x20\x20\x20\x20\40\40\40\x20\40\40\40\40\40\167\151\x6e\144\157\167\x2e\x6f\x70\145\x6e\x65\x72\x2e\x72\x65\x64\151\162\x65\x63\164\137\164\157\137\x61\x74\x74\x72\151\x62\x75\164\145\137\155\141\x70\x70\151\156\147\50\x29\x3b\15\xa\x20\x20\40\x20\x20\40\x20\40\40\x20\40\x20\40\40\x20\40\x20\40\40\163\145\x6c\146\56\x63\154\157\x73\145\50\51\73\15\12\x20\x20\x20\40\40\x20\40\40\40\40\x20\x20\x20\40\175\x20\x20\xd\xa\x20\x20\40\40\x20\x20\x20\x20\x20\x20\x20\x20\x20\40\xd\xa\x20\x20\x20\x20\x20\40\40\40\x20\40\74\x2f\163\143\x72\151\160\x74\76";
        die;
    }
}
