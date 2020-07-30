<?php


class MiniOrangeAuthnRequest
{
    public function initiateLogin($C0, $Cd, $KU, $O_, $Up, $hg)
    {
        $FD = variable_get("\155\x69\x6e\x69\157\162\141\156\x67\145\137\156\141\x6d\x65\151\x64\137\x66\x6f\x72\155\x61\164", '');
        if ($O_ == "\144\x69\163\x70\x6c\x61\171\x53\101\x4d\x4c\x52\x65\161\165\x65\x73\x74") {
            goto QS;
        }
        $this->sendSamlRequestByBindingType($GW, $Up, $O_, $Cd, $hg);
        goto yh;
        QS:
        $GW = Utilities::createAuthnRequest($C0, $KU, $Cd, $FD, "\146\x61\x6c\x73\145", $Up);
        Utilities::Print_SAML_Request($GW, "\x53\101\115\114\x20\x52\x65\161\x75\x65\x73\164");
        yh:
    }
    function sendSamlRequestByBindingType($M0, $Up, $lR, $Ih, $hg)
    {
        $m_ = drupal_get_path("\155\x6f\x64\165\154\x65", "\155\x69\156\151\x6f\x72\x61\156\147\145\x5f\163\x61\x6d\x6c");
        if (empty($Up) || $Up == "\110\124\124\120\x2d\122\145\144\x69\162\145\x63\x74") {
            goto sC;
        }
        if ($hg) {
            goto Mz;
        }
        $H3 = base64_encode($M0);
        Utilities::postSAMLRequest($Ih, $H3, $lR);
        die;
        Mz:
        $yO = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $m_ . DIRECTORY_SEPARATOR . "\x72\x65\163\157\x75\x72\x63\145\163" . DIRECTORY_SEPARATOR . "\163\160\55\x6b\145\171\x2e\153\145\171";
        $Jt = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $m_ . DIRECTORY_SEPARATOR . "\x72\145\x73\157\165\162\x63\145\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\143\145\x72\x74\151\x66\151\143\x61\164\145\56\x63\162\164";
        $H3 = Utilities::signXML($M0, $Jt, $yO, "\116\141\x6d\145\x49\x44\120\x6f\x6c\151\143\x79");
        Utilities::postSAMLRequest($Ih, $H3, $lR);
        goto CV;
        sC:
        $M0 = "\x53\101\115\x4c\x52\x65\161\165\x65\163\164\x3d" . $M0 . "\x26\122\x65\x6c\141\x79\123\x74\x61\x74\x65\75" . $lR;
        $Zo = array("\164\171\160\145" => "\160\162\151\166\x61\164\145");
        $qT = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $Zo);
        $xs = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $m_ . DIRECTORY_SEPARATOR . "\x72\145\163\157\x75\162\143\x65\163" . DIRECTORY_SEPARATOR . "\163\x70\55\153\x65\171\56\x6b\145\171";
        $qT->loadKey($xs, TRUE);
        $qp = new XMLSecurityDSig();
        $ur = $qT->signData($M0);
        $ur = base64_encode($ur);
        $Lb = $Ih;
        if (strpos($Ih, "\x3f") !== false) {
            goto ju;
        }
        $Lb .= "\x3f";
        goto Ve;
        ju:
        $Lb .= "\46";
        Ve:
        if ($hg) {
            goto uA;
        }
        $Lb .= $M0;
        goto Uq;
        uA:
        $Lb .= $M0 . "\46\123\x69\147\x41\x6c\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA256) . "\46\x53\x69\147\x6e\141\x74\x75\x72\x65\x3d" . urlencode($ur);
        Uq:
        header("\x4c\157\143\141\164\x69\x6f\156\x3a\40" . $Lb);
        die;
        CV:
    }
}
