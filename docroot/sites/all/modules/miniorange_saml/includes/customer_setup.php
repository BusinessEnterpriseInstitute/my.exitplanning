<?php


class MiniorangeSAMLCustomer
{
    public $email;
    public $phone;
    public $customerKey;
    public $transactionId;
    public $password;
    public $otpToken;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($aW, $Lh, $m3, $uX)
    {
        $this->email = $aW;
        $this->phone = $Lh;
        $this->password = $m3;
        $this->otpToken = $uX;
        $this->defaultCustomerId = "\x31\66\x35\65\x35";
        $this->defaultCustomerApiKey = "\x66\x46\144\62\130\x63\166\124\107\x44\x65\x6d\132\166\x62\x77\61\x62\x63\x55\145\163\116\112\x57\x45\161\113\142\142\x55\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Pc;
        }
        return json_encode(array("\x73\x74\x61\164\165\x73" => "\103\125\122\x4c\137\x45\x52\x52\117\x52", "\x73\164\x61\164\165\163\115\145\163\x73\141\147\x65" => "\74\141\x20\150\162\x65\146\x3d\42\150\x74\x74\160\x3a\57\57\160\150\x70\56\x6e\145\x74\57\x6d\x61\x6e\x75\x61\x6c\x2f\x65\x6e\57\x63\165\162\x6c\x2e\x69\156\x73\x74\x61\154\x6c\141\x74\151\157\x6e\56\160\150\x70\x22\x3e\120\110\x50\x20\x63\125\x52\114\40\145\170\x74\145\x6e\x73\x69\x6f\x6e\74\x2f\141\76\x20\x69\x73\x20\156\x6f\x74\x20\x69\x6e\x73\x74\141\154\154\145\x64\x20\x6f\x72\x20\x64\x69\163\x61\142\x6c\145\144\x2e"));
        Pc:
        $DM = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\x73\x2f\162\145\x73\x74\x2f\x63\165\163\164\157\x6d\x65\x72\x2f\x63\150\145\x63\153\55\x69\146\x2d\145\x78\151\x73\x74\x73";
        $I9 = curl_init($DM);
        $aW = $this->email;
        $LZ = array("\x65\155\x61\x69\x6c" => $aW);
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($I9, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\156\x74\x2d\124\171\x70\x65\x3a\40\x61\x70\160\154\151\143\141\164\151\157\x6e\57\152\163\157\156", "\x63\x68\x61\162\x73\145\164\x3a\40\x55\x54\x46\x20\55\40\70", "\101\x75\164\150\x6f\162\x69\x7a\x61\x74\151\157\156\x3a\40\x42\x61\163\151\x63"));
        curl_setopt($I9, CURLOPT_POST, TRUE);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto ss;
        }
        $FK = array("\x25\155\x65\164\x68\157\144" => "\x63\150\x65\x63\x6b\x43\x75\163\x74\x6f\x6d\x65\162", "\x25\146\151\x6c\x65" => "\143\x75\163\164\x6f\155\145\162\137\163\x65\164\165\160\x2e\x70\150\160", "\x25\145\x72\x72\x6f\x72" => curl_error($I9));
        watchdog("\x6d\x69\x6e\151\x6f\x72\141\156\147\x65\x5f\163\141\x6d\154", "\105\x72\x72\157\162\40\x61\x74\x20\x25\155\x65\x74\150\x6f\144\40\x6f\146\40\45\146\x69\154\145\72\x20\45\145\162\162\x6f\162", $FK);
        ss:
        curl_close($I9);
        return $qc;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto d8;
        }
        return json_encode(array("\163\x74\141\x74\165\163\x43\157\144\x65" => "\x45\x52\x52\117\x52", "\x73\x74\141\x74\x75\x73\x4d\x65\x73\163\141\147\x65" => "\56\x20\120\x6c\145\141\x73\145\40\143\x68\145\x63\153\40\x79\x6f\165\x72\40\x63\x6f\156\x66\x69\x67\165\162\141\x74\151\x6f\x6e\56"));
        d8:
        $DM = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\x61\163\x2f\x72\x65\x73\x74\x2f\x63\x75\x73\164\157\155\x65\162\57\141\144\144";
        $I9 = curl_init($DM);
        $LZ = array("\x63\x6f\x6d\160\141\x6e\x79\x4e\141\x6d\x65" => $_SERVER["\x53\x45\122\x56\x45\122\x5f\116\x41\x4d\105"], "\141\x72\x65\141\117\x66\111\x6e\x74\145\162\145\163\x74" => "\x44\x72\165\x70\x61\x6c\40\123\x41\115\114\x20\x4d\157\x64\x75\154\145\x20\x2d\40\x50\162\x65\x6d\x69\x75\x6d", "\145\x6d\141\151\154" => $this->email, "\160\150\157\x6e\x65" => $this->phone, "\160\x61\163\163\x77\157\x72\x64" => $this->password);
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($I9, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\x65\156\164\55\124\x79\160\x65\72\40\141\160\160\154\151\x63\x61\164\151\157\x6e\57\152\x73\x6f\x6e", "\x63\150\141\x72\x73\145\x74\x3a\40\x55\124\x46\40\55\40\x38", "\x41\165\x74\150\157\162\x69\x7a\x61\164\151\157\156\72\40\102\141\x73\x69\143"));
        curl_setopt($I9, CURLOPT_POST, TRUE);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto iP;
        }
        $FK = array("\x25\155\145\164\x68\157\x64" => "\x63\162\x65\x61\164\x65\103\165\163\164\157\x6d\145\162", "\45\x66\151\154\x65" => "\143\x75\163\x74\x6f\x6d\x65\x72\x5f\x73\145\x74\165\160\x2e\x70\x68\160", "\45\145\x72\162\157\x72" => curl_error($I9));
        watchdog("\155\x69\x6e\151\157\162\141\156\x67\145\x5f\x73\141\x6d\x6c", "\105\162\162\x6f\x72\40\x61\x74\x20\x25\155\145\x74\x68\157\x64\40\x6f\x66\x20\x25\x66\x69\x6c\x65\x3a\40\x25\x65\162\x72\157\162", $FK);
        iP:
        curl_close($I9);
        return $qc;
    }
    function ccl()
    {
        global $base_url;
        $DM = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\x73\57\x72\x65\x73\164\57\x63\165\163\x74\157\155\x65\x72\x2f\154\151\x63\145\x6e\163\145";
        $I9 = curl_init($DM);
        $lM = variable_get("\155\151\156\151\157\x72\x61\x6e\x67\x65\137\163\x61\x6d\x6c\137\x63\x75\x73\x74\x6f\x6d\145\162\x5f\151\144", '');
        $Ew = variable_get("\155\x69\x6e\x69\x6f\x72\141\156\x67\x65\137\x73\141\x6d\154\137\x63\x75\163\164\157\155\x65\x72\137\141\x70\x69\x5f\153\x65\171", '');
        $Bc = round(microtime(true) * 1000);
        $w_ = $lM . number_format($Bc, 0, '', '') . $Ew;
        $dB = hash("\x73\x68\141\x35\61\62", $w_);
        $wY = "\x43\x75\x73\x74\157\x6d\x65\x72\55\x4b\x65\x79\72\x20" . $lM;
        $Ug = "\x54\x69\x6d\x65\x73\x74\x61\155\160\x3a\40" . number_format($Bc, 0, '', '');
        $xw = "\101\165\164\x68\157\x72\151\172\141\x74\x69\157\156\72\x20" . $dB;
        $LZ = '';
        $LZ = array("\x63\x75\x73\x74\157\x6d\145\x72\x49\x64" => $lM, "\x61\x70\160\154\x69\143\141\164\151\157\156\116\141\x6d\145" => "\x64\162\x75\160\141\154\x5f\155\x69\156\151\157\162\x61\x6e\x67\x65\137\x73\x61\155\154\x5f\145\156\164\145\162\x70\162\x69\x73\145\x5f\x70\154\x61\x6e");
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($I9, CURLOPT_AUTOREFERER, true);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\103\157\156\164\x65\156\164\x2d\x54\171\x70\x65\72\x20\x61\x70\160\154\151\143\x61\x74\151\157\156\x2f\x6a\163\x6f\x6e", $wY, $Ug, $xw));
        curl_setopt($I9, CURLOPT_POST, true);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        curl_setopt($I9, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($I9, CURLOPT_TIMEOUT, 20);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto PQ;
        }
        return null;
        PQ:
        curl_close($I9);
        return $qc;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto R8;
        }
        return json_encode(array("\x61\160\151\x4b\145\x79" => "\x43\125\122\x4c\137\105\x52\122\x4f\x52", "\x74\157\153\145\156" => "\74\x61\40\x68\162\145\146\75\x22\x68\x74\x74\160\72\x2f\x2f\x70\x68\x70\x2e\x6e\145\164\57\155\x61\156\165\x61\x6c\57\x65\156\57\143\x75\162\x6c\x2e\151\x6e\163\x74\141\154\x6c\141\x74\151\157\x6e\x2e\x70\x68\160\42\x3e\x50\110\x50\40\x63\125\x52\114\40\145\170\164\145\x6e\x73\x69\157\x6e\x3c\x2f\x61\x3e\x20\151\163\x20\x6e\157\x74\40\x69\156\163\164\x61\154\x6c\x65\144\40\157\x72\x20\144\x69\x73\x61\142\154\x65\x64\x2e"));
        R8:
        $DM = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\163\x2f\162\x65\x73\164\x2f\x63\165\163\x74\x6f\155\x65\162\x2f\x6b\145\x79";
        $I9 = curl_init($DM);
        $aW = $this->email;
        $m3 = $this->password;
        $LZ = array("\x65\155\x61\x69\154" => $aW, "\160\141\x73\x73\167\x6f\162\144" => $m3);
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($I9, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\145\x6e\164\x2d\x54\x79\160\x65\x3a\40\141\x70\160\x6c\x69\x63\x61\x74\151\x6f\156\x2f\152\x73\x6f\156", "\143\x68\x61\162\163\145\x74\72\40\125\124\106\x20\x2d\40\70", "\101\165\164\150\157\x72\x69\172\141\164\151\x6f\x6e\x3a\x20\x42\141\163\x69\x63"));
        curl_setopt($I9, CURLOPT_POST, TRUE);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto Xl;
        }
        $FK = array("\45\155\145\164\150\157\144" => "\147\145\x74\103\165\163\x74\157\155\x65\x72\x4b\x65\x79\x73", "\x25\x66\x69\x6c\145" => "\x63\165\163\x74\157\x6d\x65\x72\137\x73\145\x74\165\160\56\x70\x68\160", "\45\x65\162\x72\x6f\x72" => curl_error($I9));
        watchdog("\x6d\x69\156\151\x6f\162\141\x6e\147\x65\x5f\163\141\155\154", "\105\x72\162\x6f\x72\40\141\164\x20\45\155\x65\x74\150\157\x64\x20\x6f\146\40\x25\146\x69\154\x65\x3a\x20\x25\x65\x72\162\x6f\162", $FK);
        Xl:
        curl_close($I9);
        return $qc;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto vJ;
        }
        return json_encode(array("\163\164\x61\164\165\163" => "\103\x55\x52\114\137\105\122\x52\117\122", "\x73\x74\x61\x74\x75\163\115\145\x73\163\x61\147\145" => "\74\x61\40\x68\x72\145\x66\75\x22\x68\164\x74\160\72\x2f\x2f\x70\x68\160\x2e\x6e\x65\x74\x2f\x6d\x61\156\x75\x61\154\57\145\156\57\x63\x75\162\x6c\56\151\156\163\x74\x61\154\x6c\141\x74\x69\x6f\x6e\x2e\x70\x68\x70\42\76\120\x48\120\40\x63\x55\122\x4c\40\x65\170\164\145\x6e\163\151\157\156\74\x2f\141\76\x20\x69\163\40\156\x6f\x74\x20\x69\156\163\164\141\154\154\x65\144\40\157\162\x20\x64\x69\x73\141\x62\x6c\145\144\56"));
        vJ:
        $DM = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\57\x61\x70\151\x2f\141\165\164\x68\x2f\x63\150\x61\x6c\x6c\x65\156\x67\x65";
        $I9 = curl_init($DM);
        $bi = $this->defaultCustomerId;
        $BE = $this->defaultCustomerApiKey;
        $CY = variable_get("\155\x69\x6e\x69\x6f\x72\x61\156\x67\145\x5f\163\x61\155\154\137\143\x75\163\x74\x6f\155\x65\x72\137\x61\x64\x6d\151\156\137\x65\x6d\x61\x69\x6c", NULL);
        $Bu = round(microtime(TRUE) * 1000);
        $yB = $bi . number_format($Bc, 0, '', '') . $BE;
        $No = hash("\x73\x68\x61\65\61\62", $yB);
        $Wv = "\103\165\x73\x74\157\155\145\162\55\x4b\x65\171\x3a\x20" . $bi;
        $x_ = "\124\151\155\x65\x73\x74\x61\x6d\x70\72\x20" . number_format($Bc, 0, '', '');
        $Ks = "\101\x75\164\150\157\162\x69\172\141\x74\x69\x6f\x6e\x3a\40" . $No;
        $LZ = array("\143\x75\x73\164\x6f\x6d\145\x72\113\x65\x79" => $bi, "\145\155\141\151\154" => $CY, "\x61\165\x74\150\x54\x79\160\145" => "\105\115\x41\111\114");
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($I9, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\x65\x6e\x74\55\124\171\x70\x65\72\40\141\160\x70\x6c\x69\x63\141\x74\x69\157\x6e\x2f\x6a\163\157\156", $Wv, $x_, $Ks));
        curl_setopt($I9, CURLOPT_POST, TRUE);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto WW;
        }
        $FK = array("\x25\155\145\164\150\157\144" => "\163\x65\156\x64\x4f\164\x70", "\x25\x66\x69\154\x65" => "\143\x75\163\164\157\155\x65\162\x5f\163\x65\x74\x75\160\56\160\x68\x70", "\45\145\162\x72\157\162" => curl_error($I9));
        watchdog("\x6d\x69\x6e\151\157\162\x61\x6e\147\145\137\x73\141\155\154", "\105\162\x72\157\x72\40\x61\164\40\x25\155\145\164\150\x6f\x64\40\x6f\146\40\x25\x66\151\x6c\145\x3a\x20\45\145\x72\162\157\162", $FK);
        WW:
        curl_close($I9);
        return $qc;
    }
    public function validateOtp($UF)
    {
        if (Utilities::isCurlInstalled()) {
            goto u0;
        }
        return json_encode(array("\x73\x74\141\x74\x75\163" => "\x43\125\x52\x4c\x5f\105\x52\x52\x4f\122", "\x73\x74\141\164\165\163\115\x65\x73\163\x61\x67\145" => "\74\x61\x20\150\162\145\x66\x3d\x22\150\164\x74\x70\72\x2f\57\160\150\160\56\156\x65\x74\x2f\x6d\x61\156\x75\141\154\57\x65\x6e\57\143\165\x72\154\56\x69\x6e\163\x74\141\154\154\141\x74\x69\x6f\x6e\x2e\x70\x68\x70\x22\x3e\120\110\120\x20\143\125\x52\x4c\x20\x65\170\x74\x65\156\x73\x69\x6f\x6e\74\57\x61\x3e\x20\151\163\x20\x6e\157\x74\x20\151\x6e\x73\x74\141\x6c\x6c\145\x64\40\157\x72\x20\x64\151\163\x61\142\154\x65\x64\56"));
        u0:
        $DM = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\x61\163\x2f\x61\160\151\57\x61\165\x74\x68\57\166\141\154\x69\x64\x61\x74\x65";
        $I9 = curl_init($DM);
        $bi = $this->defaultCustomerId;
        $BE = $this->defaultCustomerApiKey;
        $Bu = round(microtime(TRUE) * 1000);
        $yB = $bi . number_format($Bc, 0, '', '') . $BE;
        $No = hash("\163\150\141\65\x31\x32", $yB);
        $Wv = "\x43\165\163\164\x6f\x6d\145\x72\x2d\x4b\x65\171\72\40" . $bi;
        $x_ = "\124\151\155\145\x73\164\x61\155\x70\72\40" . number_format($Bc, 0, '', '');
        $Ks = "\x41\x75\x74\150\157\x72\151\172\141\164\151\x6f\x6e\72\x20" . $No;
        $LZ = array("\x74\x78\x49\144" => $UF, "\164\x6f\153\145\156" => $this->otpToken);
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($I9, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\103\157\156\164\x65\x6e\164\x2d\124\x79\160\x65\x3a\40\x61\x70\x70\154\151\x63\x61\164\x69\157\x6e\x2f\x6a\x73\157\156", $Wv, $x_, $Ks));
        curl_setopt($I9, CURLOPT_POST, TRUE);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto Cv;
        }
        $FK = array("\x25\x6d\x65\x74\x68\x6f\144" => "\x76\141\154\151\x64\141\164\145\117\x74\160", "\x25\x66\151\154\145" => "\143\x75\x73\x74\157\x6d\145\x72\137\x73\x65\164\x75\x70\56\x70\150\160", "\45\145\162\162\157\162" => curl_error($I9));
        watchdog("\x6d\x69\x6e\151\x6f\162\x61\156\x67\x65\x5f\x73\141\x6d\154", "\105\x72\162\157\x72\40\x61\164\40\45\x6d\145\164\x68\x6f\x64\40\x6f\x66\x20\x25\x66\151\154\145\72\40\x25\x65\x72\162\157\162", $FK);
        Cv:
        curl_close($I9);
        return $qc;
    }
    function verifyLicense($EX)
    {
        $DM = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\x2f\x61\x70\151\x2f\142\x61\143\x6b\165\160\143\157\x64\145\x2f\x76\145\x72\x69\146\171";
        $I9 = curl_init($DM);
        $lM = variable_get("\x6d\151\156\x69\157\162\141\x6e\147\145\137\163\x61\155\154\x5f\143\165\163\x74\x6f\x6d\x65\162\137\x69\x64");
        $Ew = variable_get("\155\x69\x6e\x69\157\162\141\156\147\x65\137\163\141\155\154\x5f\143\165\x73\164\x6f\155\x65\x72\137\141\160\x69\137\x6b\x65\x79");
        global $base_url;
        $Bc = round(microtime(TRUE) * 1000);
        $w_ = $lM . number_format($Bc, 0, '', '') . $Ew;
        $dB = hash("\163\150\141\65\x31\62", $w_);
        $wY = "\103\x75\163\164\x6f\x6d\x65\162\55\113\x65\171\x3a\40" . $lM;
        $Ug = "\124\151\x6d\x65\x73\164\x61\155\x70\72\x20" . number_format($Bc, 0, '', '');
        $xw = "\x41\165\164\150\157\162\x69\x7a\141\x74\151\157\156\x3a\40" . $dB;
        $LZ = '';
        $LZ = array("\143\157\144\x65" => $EX, "\x63\x75\163\x74\x6f\155\x65\162\113\145\171" => $lM, "\141\x64\x64\151\x74\x69\x6f\156\141\x6c\x46\x69\x65\154\144\x73" => array("\x66\x69\145\154\144\x31" => $base_url));
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($I9, CURLOPT_AUTOREFERER, true);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\156\x74\55\x54\171\160\x65\72\x20\141\x70\x70\154\151\x63\x61\164\151\x6f\156\57\x6a\163\157\x6e", $wY, $Ug, $xw));
        curl_setopt($I9, CURLOPT_POST, true);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        curl_setopt($I9, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($I9, CURLOPT_TIMEOUT, 20);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto W6;
        }
        echo "\122\x65\161\x75\x65\x73\x74\x20\105\162\162\157\162\72" . curl_error($I9);
        exit;
        W6:
        curl_close($I9);
        return $qc;
    }
    function updateStatus()
    {
        $DM = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\x61\163\x2f\x61\160\151\x2f\142\x61\x63\153\x75\160\143\x6f\x64\145\x2f\x75\160\x64\141\x74\x65\x73\164\x61\164\x75\x73";
        $I9 = curl_init($DM);
        $lM = variable_get("\x6d\151\x6e\151\x6f\x72\141\x6e\147\x65\x5f\x73\141\x6d\x6c\137\x63\165\x73\164\157\155\145\x72\137\151\x64");
        $Ew = variable_get("\x6d\x69\x6e\151\x6f\162\141\156\147\145\x5f\163\x61\x6d\x6c\137\143\x75\163\x74\x6f\x6d\145\162\x5f\141\160\151\137\x6b\145\171");
        $Bc = round(microtime(TRUE) * 1000);
        $w_ = $lM . number_format($Bc, 0, '', '') . $Ew;
        $dB = hash("\x73\x68\141\65\x31\62", $w_);
        $wY = "\103\x75\x73\x74\x6f\x6d\x65\x72\55\113\x65\171\72\40" . $lM;
        $Ug = "\124\151\x6d\145\x73\x74\x61\155\160\72\x20" . number_format($Bc, 0, '', '');
        $xw = "\101\x75\164\x68\x6f\x72\x69\172\141\164\151\157\156\72\x20" . $dB;
        $im = variable_get("\155\x69\156\151\157\162\141\156\x67\x65\137\x73\x61\x6d\x6c\137\x63\x75\163\164\x6f\x6d\x65\x72\x5f\141\x64\x6d\x69\156\137\x74\157\x6b\145\156");
        $EX = AESEncryption::decrypt_data(variable_get("\155\151\156\x69\157\x72\141\156\x67\145\137\x73\141\155\x6c\x5f\154\x69\x63\145\x6e\163\145\137\153\145\171"), $im);
        $LZ = array("\x63\157\144\145" => $EX, "\x63\165\x73\x74\157\x6d\145\x72\113\x65\171" => $lM);
        $PD = json_encode($LZ);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($I9, CURLOPT_AUTOREFERER, true);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\x65\156\164\55\124\x79\160\145\x3a\40\x61\160\160\154\x69\143\141\164\151\x6f\x6e\57\152\x73\x6f\x6e", $wY, $Ug, $xw));
        curl_setopt($I9, CURLOPT_POST, true);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        curl_setopt($I9, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($I9, CURLOPT_TIMEOUT, 20);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto Vh;
        }
        echo "\122\x65\161\x75\145\x73\x74\40\105\x72\x72\157\162\x3a" . curl_error($I9);
        exit;
        Vh:
        curl_close($I9);
        return $qc;
    }
}
