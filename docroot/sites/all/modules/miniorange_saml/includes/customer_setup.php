<?php


class MiniorangeSAMLCustomer
{
    public $email;
    public $customerKey;
    public $transactionId;
    public $password;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($EV, $qm)
    {
        $this->email = $EV;
        $this->password = $qm;
        $this->defaultCustomerId = "\x31\66\x35\x35\65";
        $this->defaultCustomerApiKey = "\x66\x46\144\x32\130\x63\x76\124\x47\104\x65\x6d\132\x76\x62\x77\61\142\143\x55\x65\163\116\x4a\x57\x45\161\x4b\142\142\125\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto rt;
        }
        return json_encode(array("\163\164\x61\x74\x75\163" => "\103\x55\122\114\137\105\x52\x52\x4f\x52", "\163\164\141\x74\x75\x73\115\x65\163\163\x61\147\145" => "\x3c\141\x20\150\162\145\x66\x3d\x22\150\x74\x74\x70\72\57\x2f\x70\150\160\x2e\156\145\164\57\155\x61\x6e\165\141\x6c\x2f\145\x6e\x2f\x63\165\162\154\56\151\156\163\x74\x61\x6c\154\x61\x74\x69\x6f\156\56\160\x68\x70\x22\76\x50\x48\120\x20\143\125\122\114\40\145\x78\164\x65\156\x73\151\x6f\x6e\74\x2f\141\x3e\x20\x69\x73\x20\x6e\x6f\x74\x20\151\156\x73\164\141\154\x6c\145\144\x20\x6f\x72\40\x64\151\x73\141\142\154\145\144\x2e"));
        rt:
        $Va = MiniorangeSAMLConstants::BASE_URL . "\57\155\x6f\141\163\57\162\x65\x73\x74\x2f\x63\165\163\x74\157\155\145\x72\57\x63\x68\x65\x63\153\x2d\x69\x66\55\145\170\x69\x73\x74\x73";
        $Sn = curl_init($Va);
        $EV = $this->email;
        $TH = array("\x65\155\x61\x69\x6c" => $EV);
        $Un = json_encode($TH);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\x65\156\x74\55\x54\171\x70\145\x3a\40\141\x70\x70\x6c\x69\143\x61\164\151\x6f\x6e\x2f\x6a\x73\157\x6e", "\143\150\x61\x72\x73\x65\x74\x3a\40\x55\x54\106\40\55\x20\70", "\101\x75\164\150\x6f\x72\151\x7a\141\x74\x69\157\x6e\x3a\40\x42\x61\163\x69\x63"));
        curl_setopt($Sn, CURLOPT_POST, TRUE);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto iu;
        }
        $kN = array("\x25\x6d\x65\164\150\157\144" => "\143\150\145\143\153\x43\x75\x73\164\157\155\x65\x72", "\45\x66\151\154\x65" => "\143\x75\163\164\157\x6d\x65\x72\x5f\x73\145\x74\165\160\56\x70\x68\160", "\x25\x65\162\162\157\162" => curl_error($Sn));
        watchdog("\x6d\x69\156\151\157\162\141\x6e\147\x65\137\x73\x61\155\154", "\105\162\162\x6f\162\40\141\164\40\x25\155\x65\164\150\157\x64\40\x6f\x66\40\x25\x66\151\x6c\145\x3a\40\45\145\162\x72\x6f\x72", $kN);
        iu:
        curl_close($Sn);
        return $J3;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto dA;
        }
        return json_encode(array("\x73\164\141\164\x75\163\x43\157\144\x65" => "\105\x52\x52\117\x52", "\163\164\x61\164\x75\x73\115\x65\x73\x73\141\147\145" => "\56\40\120\x6c\145\141\163\145\x20\x63\150\145\x63\x6b\x20\171\x6f\x75\x72\40\x63\157\x6e\x66\151\147\165\162\x61\x74\x69\x6f\x6e\56"));
        dA:
        $Va = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\x2f\x72\x65\163\x74\57\143\x75\x73\164\x6f\x6d\145\x72\57\141\144\144";
        $Sn = curl_init($Va);
        $TH = array("\x63\x6f\x6d\x70\141\156\x79\x4e\141\x6d\145" => $_SERVER["\123\105\x52\x56\x45\122\137\116\101\115\105"], "\141\x72\x65\x61\x4f\x66\111\x6e\x74\x65\x72\145\163\x74" => "\x44\162\x75\160\x61\x6c\40\123\101\x4d\114\x20\x50\154\165\x67\x69\x6e\40\55\x20\x50\x72\x65\x6d\x69\x75\x6d", "\145\155\141\x69\154" => $this->email, "\160\x68\157\156\145" => $this->phone, "\160\x61\x73\163\x77\x6f\x72\144" => $this->password);
        $Un = json_encode($TH);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\164\145\x6e\164\55\x54\171\160\x65\x3a\x20\x61\160\x70\154\151\x63\141\x74\x69\157\156\57\152\x73\x6f\156", "\x63\150\x61\162\x73\x65\x74\x3a\40\125\x54\x46\40\55\40\x38", "\x41\x75\164\x68\x6f\x72\x69\x7a\x61\164\151\x6f\156\72\x20\102\x61\x73\151\x63"));
        curl_setopt($Sn, CURLOPT_POST, TRUE);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto Rg;
        }
        $kN = array("\x25\155\x65\164\150\157\x64" => "\x63\162\145\x61\x74\145\x43\165\163\x74\x6f\155\145\162", "\45\x66\151\x6c\145" => "\x63\x75\163\164\157\x6d\x65\x72\x5f\163\x65\x74\x75\160\56\160\150\x70", "\45\x65\x72\162\x6f\162" => curl_error($Sn));
        watchdog("\x6d\151\x6e\151\x6f\x72\x61\x6e\147\145\137\x73\141\x6d\154", "\105\x72\x72\x6f\162\x20\141\164\x20\x25\x6d\x65\x74\150\x6f\144\40\157\x66\x20\x25\x66\x69\x6c\x65\72\40\45\x65\x72\x72\157\162", $kN);
        Rg:
        curl_close($Sn);
        return $J3;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto iS;
        }
        return json_encode(array("\x61\160\151\113\145\x79" => "\x43\125\122\x4c\x5f\x45\x52\x52\117\122", "\164\157\153\145\x6e" => "\74\x61\x20\150\162\x65\146\75\42\x68\164\x74\160\72\x2f\57\160\x68\x70\56\156\x65\x74\57\155\141\x6e\165\x61\x6c\57\x65\156\x2f\143\165\x72\x6c\x2e\x69\x6e\x73\164\x61\154\154\141\164\x69\x6f\156\x2e\160\150\160\x22\76\x50\110\120\x20\143\x55\122\114\40\145\x78\x74\145\156\x73\151\157\156\x3c\x2f\141\76\x20\x69\163\x20\x6e\x6f\164\x20\151\156\163\x74\x61\x6c\154\x65\144\x20\x6f\162\x20\x64\x69\163\141\142\x6c\145\144\x2e"));
        iS:
        $Va = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\x61\x73\x2f\x72\x65\163\x74\x2f\143\x75\x73\164\x6f\155\x65\162\x2f\x6b\x65\171";
        $Sn = curl_init($Va);
        $EV = $this->email;
        $qm = $this->password;
        $TH = array("\x65\x6d\x61\151\x6c" => $EV, "\160\x61\163\163\x77\157\162\144" => $qm);
        $Un = json_encode($TH);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\x65\156\164\x2d\124\171\x70\145\72\40\x61\160\160\x6c\x69\143\x61\164\151\157\156\57\x6a\x73\157\x6e", "\143\150\141\162\x73\x65\x74\x3a\40\x55\x54\x46\40\55\x20\x38", "\x41\x75\164\150\x6f\x72\x69\x7a\x61\164\x69\157\x6e\72\x20\x42\x61\x73\x69\x63"));
        curl_setopt($Sn, CURLOPT_POST, TRUE);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto Az;
        }
        $kN = array("\x25\155\145\164\150\x6f\144" => "\x67\x65\164\103\x75\163\x74\x6f\x6d\145\x72\x4b\145\x79\x73", "\x25\x66\x69\x6c\x65" => "\x63\x75\163\x74\x6f\x6d\x65\162\137\163\145\164\x75\160\x2e\x70\x68\x70", "\x25\x65\162\162\x6f\162" => curl_error($Sn));
        watchdog("\x6d\151\x6e\151\157\x72\141\x6e\x67\145\137\x73\x61\155\154", "\105\162\162\157\x72\40\141\x74\x20\x25\155\145\164\150\157\x64\40\x6f\x66\x20\45\x66\151\154\145\72\40\x25\x65\x72\x72\157\x72", $kN);
        Az:
        curl_close($Sn);
        return $J3;
    }
    function verifyLicense($R3)
    {
        $Va = MiniorangeSAMLConstants::BASE_URL . "\57\155\x6f\x61\163\57\x61\160\151\x2f\x62\141\x63\153\165\x70\143\157\144\x65\x2f\166\x65\162\151\146\171";
        $Sn = curl_init($Va);
        $in = variable_get("\x6d\151\156\x69\x6f\162\141\156\147\145\x5f\163\141\155\154\137\143\x75\163\164\x6f\x6d\x65\x72\137\x69\x64");
        $xH = variable_get("\155\x69\x6e\151\157\162\141\x6e\147\145\x5f\163\141\x6d\154\x5f\143\165\x73\164\157\x6d\145\x72\137\141\x70\x69\137\153\145\x79");
        global $base_url;
        $ug = round(microtime(TRUE) * 1000);
        $sa = $in . number_format($ug, 0, '', '') . $xH;
        $a6 = hash("\x73\150\x61\x35\x31\x32", $sa);
        $PC = "\103\x75\163\164\157\x6d\145\162\55\113\x65\171\72\40" . $in;
        $ww = "\124\x69\x6d\x65\163\x74\141\155\x70\x3a\x20" . number_format($ug, 0, '', '');
        $ey = "\101\165\164\150\x6f\x72\x69\172\141\x74\151\x6f\x6e\72\x20" . $a6;
        $TH = '';
        $TH = array("\x63\157\144\x65" => $R3, "\x63\x75\x73\164\x6f\155\x65\x72\113\x65\x79" => $in, "\141\144\x64\x69\x74\151\x6f\x6e\141\x6c\106\x69\x65\154\144\163" => array("\146\151\145\x6c\144\x31" => $base_url));
        $Un = json_encode($TH);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, true);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\x43\157\156\164\x65\x6e\164\55\124\171\x70\x65\x3a\40\x61\160\x70\154\x69\143\141\x74\151\x6f\x6e\57\x6a\163\157\x6e", $PC, $ww, $ey));
        curl_setopt($Sn, CURLOPT_POST, true);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        curl_setopt($Sn, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Sn, CURLOPT_TIMEOUT, 20);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto AN;
        }
        echo "\x52\145\161\165\x65\163\x74\x20\105\162\x72\x6f\x72\72" . curl_error($Sn);
        die;
        AN:
        curl_close($Sn);
        return $J3;
    }
    function updateStatus()
    {
        $Va = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\57\x61\160\151\x2f\142\141\x63\x6b\x75\160\143\x6f\x64\x65\57\165\x70\x64\x61\164\145\163\164\x61\164\x75\x73";
        $Sn = curl_init($Va);
        $in = variable_get("\x6d\151\x6e\x69\x6f\162\141\x6e\147\x65\137\163\x61\x6d\154\x5f\143\165\163\164\157\155\145\162\x5f\151\x64");
        $xH = variable_get("\155\x69\156\151\157\162\x61\x6e\x67\x65\x5f\163\x61\155\x6c\x5f\x63\165\x73\x74\157\x6d\145\162\x5f\141\x70\151\137\153\x65\171");
        $ug = round(microtime(TRUE) * 1000);
        $sa = $in . number_format($ug, 0, '', '') . $xH;
        $a6 = hash("\x73\150\141\x35\61\x32", $sa);
        $PC = "\x43\x75\x73\x74\x6f\x6d\145\162\x2d\113\x65\x79\x3a\x20" . $in;
        $ww = "\124\x69\155\145\x73\x74\x61\155\x70\x3a\x20" . number_format($ug, 0, '', '');
        $ey = "\101\165\164\x68\157\162\x69\172\x61\164\151\x6f\156\x3a\x20" . $a6;
        $xt = variable_get("\x6d\x69\x6e\151\157\162\x61\x6e\x67\x65\x5f\x73\x61\155\x6c\137\x63\x75\x73\164\x6f\x6d\145\162\137\x61\144\155\151\156\x5f\x74\157\153\145\156");
        $R3 = AESEncryption::decrypt_data(variable_get("\x6d\x69\156\x69\x6f\x72\x61\156\x67\x65\137\x73\141\x6d\x6c\x5f\x6c\151\143\x65\x6e\163\x65\x5f\153\145\x79"), $xt);
        $TH = array("\x63\157\144\145" => $R3, "\x63\165\163\x74\x6f\155\x65\162\113\145\x79" => $in);
        $Un = json_encode($TH);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, true);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\x6e\164\55\x54\171\160\x65\72\40\141\x70\160\x6c\x69\143\141\164\151\157\x6e\57\152\163\x6f\156", $PC, $ww, $ey));
        curl_setopt($Sn, CURLOPT_POST, true);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        curl_setopt($Sn, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Sn, CURLOPT_TIMEOUT, 20);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto oL;
        }
        echo "\x52\x65\161\x75\145\x73\x74\x20\105\x72\x72\x6f\x72\72" . curl_error($Sn);
        die;
        oL:
        curl_close($Sn);
        return $J3;
    }
    function ccl()
    {
        $Va = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\57\162\x65\163\x74\57\x63\165\x73\164\x6f\x6d\x65\x72\57\154\x69\x63\x65\x6e\163\x65";
        $Sn = curl_init($Va);
        $in = variable_get("\155\151\x6e\x69\x6f\x72\141\x6e\x67\145\x5f\x73\x61\x6d\x6c\x5f\143\x75\163\164\157\x6d\x65\162\137\151\x64", '');
        $xH = variable_get("\x6d\151\156\x69\157\162\141\x6e\x67\x65\x5f\163\141\155\154\x5f\x63\x75\163\x74\157\155\x65\162\x5f\141\x70\151\137\x6b\145\x79", '');
        $ug = round(microtime(TRUE) * 1000);
        $sa = $in . number_format($ug, 0, '', '') . $xH;
        $a6 = hash("\x73\x68\x61\65\x31\62", $sa);
        $PC = "\103\x75\x73\x74\157\155\x65\x72\55\x4b\x65\x79\72\40" . $in;
        $ww = "\x54\151\155\145\x73\164\141\x6d\160\x3a\40" . number_format($ug, 0, '', '');
        $ey = "\x41\x75\x74\x68\x6f\x72\151\x7a\141\164\x69\x6f\x6e\x3a\40" . $a6;
        $TH = '';
        $TH = array("\x63\x75\163\x74\x6f\x6d\x65\x72\x49\x64" => $in, "\141\160\160\154\x69\143\x61\x74\151\157\x6e\116\x61\155\145" => "\144\x72\x75\160\141\154\x5f\x6d\x69\156\x69\x6f\x72\x61\x6e\147\x65\x5f\x73\x61\155\154\137\x65\156\x74\x65\x72\160\x72\151\163\x65\x5f\x70\154\x61\156");
        $Un = json_encode($TH);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, true);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\x43\157\156\x74\145\x6e\164\x2d\x54\x79\x70\145\72\x20\141\x70\x70\154\151\143\x61\164\x69\157\156\x2f\152\163\x6f\x6e", $PC, $ww, $ey));
        curl_setopt($Sn, CURLOPT_POST, true);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        curl_setopt($Sn, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Sn, CURLOPT_TIMEOUT, 20);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto Iw;
        }
        return null;
        Iw:
        curl_close($Sn);
        return $J3;
    }
}
