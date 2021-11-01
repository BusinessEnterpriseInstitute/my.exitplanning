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
    public function __construct($UX, $Vm, $a2, $Gv)
    {
        $this->email = $UX;
        $this->phone = $Vm;
        $this->password = $a2;
        $this->otpToken = $Gv;
        $this->defaultCustomerId = "\61\x36\x35\65\x35";
        $this->defaultCustomerApiKey = "\146\x46\144\62\130\143\x76\124\107\104\x65\x6d\x5a\166\142\x77\61\142\x63\x55\x65\163\116\112\127\x45\161\x4b\142\142\x55\161";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto J7;
        }
        return json_encode(array("\x73\x74\x61\x74\165\x73" => "\103\125\x52\114\137\105\x52\x52\x4f\x52", "\163\164\x61\x74\x75\163\115\x65\x73\163\x61\x67\145" => "\x3c\x61\40\x68\162\145\x66\x3d\42\150\164\164\160\72\x2f\x2f\160\150\160\56\156\145\x74\57\x6d\141\156\x75\x61\154\x2f\145\156\57\143\x75\x72\x6c\56\151\156\x73\x74\x61\x6c\154\x61\164\151\157\156\x2e\160\150\x70\x22\76\120\x48\120\40\143\x55\x52\114\40\x65\170\164\145\x6e\x73\151\157\x6e\x3c\57\x61\76\x20\151\163\x20\x6e\x6f\x74\x20\151\x6e\163\x74\x61\154\x6c\145\144\40\157\x72\40\144\x69\163\x61\142\x6c\x65\x64\x2e"));
        J7:
        $eY = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\57\x72\145\163\x74\x2f\x63\165\163\x74\157\x6d\145\x72\x2f\x63\150\145\143\153\55\x69\x66\x2d\145\x78\151\x73\x74\x73";
        $Rn = curl_init($eY);
        $UX = $this->email;
        $Sc = array("\145\x6d\141\x69\154" => $UX);
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\156\x74\x2d\124\x79\160\145\x3a\x20\141\x70\x70\x6c\151\143\x61\164\151\157\x6e\57\x6a\x73\157\156", "\143\x68\x61\162\x73\145\164\72\x20\125\124\106\40\55\x20\70", "\101\x75\164\150\x6f\x72\151\172\141\x74\x69\x6f\156\72\40\102\141\163\151\143"));
        curl_setopt($Rn, CURLOPT_POST, TRUE);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto h2;
        }
        $MA = array("\45\155\145\164\x68\157\144" => "\x63\x68\145\143\x6b\x43\x75\163\x74\157\x6d\145\x72", "\45\146\151\x6c\145" => "\143\x75\163\x74\157\155\x65\162\x5f\163\145\164\x75\160\x2e\160\150\160", "\45\x65\x72\x72\157\162" => curl_error($Rn));
        watchdog("\155\x69\x6e\x69\157\x72\141\156\x67\145\137\163\141\155\x6c", "\x45\x72\162\x6f\162\x20\x61\164\40\x25\155\145\x74\x68\x6f\x64\40\x6f\x66\x20\45\146\151\x6c\x65\x3a\x20\45\x65\x72\162\x6f\162", $MA);
        h2:
        curl_close($Rn);
        return $uj;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto sp;
        }
        return json_encode(array("\163\x74\x61\x74\x75\x73\103\x6f\x64\x65" => "\x45\122\x52\117\x52", "\163\x74\x61\x74\165\163\x4d\x65\163\163\x61\147\x65" => "\56\40\120\154\x65\x61\x73\x65\x20\x63\x68\145\143\x6b\40\x79\157\165\x72\x20\x63\x6f\x6e\x66\151\x67\165\162\x61\x74\151\x6f\x6e\x2e"));
        sp:
        $eY = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\x61\163\x2f\x72\x65\x73\x74\57\143\165\163\164\157\155\x65\162\57\x61\144\x64";
        $Rn = curl_init($eY);
        $Sc = array("\x63\157\155\160\141\156\x79\116\x61\155\x65" => $_SERVER["\123\105\x52\126\x45\x52\137\116\x41\x4d\x45"], "\141\162\145\x61\x4f\x66\x49\156\164\x65\162\x65\163\x74" => "\104\162\165\x70\141\154\40\123\101\x4d\114\40\x4d\x6f\144\165\x6c\x65\x20\x2d\x20\120\162\x65\155\x69\165\155", "\145\155\x61\x69\154" => $this->email, "\x70\150\x6f\156\145" => $this->phone, "\x70\x61\163\163\x77\157\x72\x64" => $this->password);
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\145\156\x74\55\124\171\x70\x65\x3a\x20\x61\160\x70\154\x69\x63\141\x74\x69\x6f\x6e\57\x6a\x73\x6f\156", "\143\150\141\162\x73\x65\x74\x3a\40\x55\x54\106\40\x2d\40\70", "\101\165\164\150\x6f\x72\151\172\x61\164\x69\x6f\x6e\x3a\x20\x42\141\x73\151\143"));
        curl_setopt($Rn, CURLOPT_POST, TRUE);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto Cm;
        }
        $MA = array("\45\155\145\x74\x68\157\144" => "\143\x72\x65\141\164\x65\103\165\x73\164\157\x6d\x65\162", "\x25\x66\x69\x6c\145" => "\x63\165\x73\x74\x6f\x6d\145\162\x5f\x73\145\164\x75\x70\56\160\x68\x70", "\x25\145\162\x72\x6f\x72" => curl_error($Rn));
        watchdog("\x6d\151\156\x69\157\162\x61\156\x67\x65\137\x73\x61\x6d\x6c", "\x45\x72\162\x6f\x72\x20\x61\x74\40\45\155\145\164\x68\157\x64\40\x6f\146\x20\x25\146\151\154\145\x3a\40\x25\x65\x72\x72\x6f\162", $MA);
        Cm:
        curl_close($Rn);
        return $uj;
    }
    function ccl()
    {
        global $base_url;
        $eY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\141\x73\x2f\162\145\x73\x74\57\x63\165\163\x74\x6f\x6d\145\x72\x2f\154\151\x63\145\x6e\x73\x65";
        $Rn = curl_init($eY);
        $LR = variable_get("\155\151\156\151\x6f\x72\x61\x6e\x67\145\137\163\x61\x6d\x6c\x5f\143\165\x73\164\x6f\x6d\x65\162\x5f\x69\x64", '');
        $xN = variable_get("\x6d\151\x6e\151\157\x72\141\x6e\x67\145\137\x73\x61\x6d\x6c\x5f\143\165\x73\x74\157\155\145\162\137\x61\x70\x69\x5f\x6b\x65\171", '');
        $gp = round(microtime(true) * 1000);
        $Y1 = $LR . number_format($gp, 0, '', '') . $xN;
        $eZ = hash("\x73\150\141\65\61\62", $Y1);
        $wf = "\x43\165\x73\x74\x6f\155\x65\x72\55\113\145\x79\x3a\x20" . $LR;
        $sL = "\124\x69\x6d\145\163\x74\x61\x6d\160\72\x20" . number_format($gp, 0, '', '');
        $wr = "\x41\x75\x74\150\x6f\x72\x69\172\x61\164\151\x6f\156\72\x20" . $eZ;
        $Sc = '';
        $Sc = array("\143\165\x73\x74\157\155\x65\x72\x49\144" => $LR, "\141\160\x70\154\151\x63\141\x74\151\157\156\116\x61\x6d\145" => "\144\x72\x75\160\141\x6c\137\155\151\156\x69\157\162\x61\x6e\x67\x65\x5f\x73\x61\x6d\x6c\137\x65\156\x74\x65\x72\160\x72\x69\x73\145\x5f\160\154\x61\x6e");
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, true);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\x43\x6f\156\x74\x65\156\x74\x2d\124\x79\x70\x65\x3a\x20\x61\x70\x70\154\x69\143\x61\164\x69\x6f\x6e\57\152\163\x6f\x6e", $wf, $sL, $wr));
        curl_setopt($Rn, CURLOPT_POST, true);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        curl_setopt($Rn, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Rn, CURLOPT_TIMEOUT, 20);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto a8;
        }
        return null;
        a8:
        curl_close($Rn);
        return $uj;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto qy;
        }
        return json_encode(array("\141\160\151\x4b\x65\171" => "\103\125\122\114\137\105\x52\x52\x4f\x52", "\164\157\153\x65\x6e" => "\74\x61\x20\x68\x72\145\x66\75\x22\x68\164\164\x70\72\x2f\57\160\150\160\56\x6e\145\164\57\x6d\141\x6e\165\141\154\x2f\x65\156\57\x63\x75\x72\x6c\56\151\x6e\163\x74\141\x6c\x6c\x61\x74\x69\x6f\x6e\56\x70\x68\160\42\x3e\x50\110\x50\x20\x63\125\x52\x4c\x20\x65\x78\164\x65\156\163\x69\157\x6e\x3c\x2f\x61\76\40\x69\x73\x20\x6e\x6f\164\x20\x69\x6e\x73\x74\141\154\x6c\145\144\x20\x6f\x72\x20\144\x69\163\x61\142\x6c\145\x64\x2e"));
        qy:
        $eY = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\163\57\x72\x65\163\x74\57\143\165\x73\x74\157\x6d\145\x72\57\x6b\145\x79";
        $Rn = curl_init($eY);
        $UX = $this->email;
        $a2 = $this->password;
        $Sc = array("\145\155\141\x69\154" => $UX, "\160\x61\x73\163\167\157\162\144" => $a2);
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\x43\x6f\156\164\145\x6e\x74\55\x54\171\160\145\x3a\40\141\x70\160\x6c\x69\143\x61\x74\151\x6f\x6e\x2f\x6a\x73\x6f\x6e", "\x63\x68\x61\x72\x73\x65\x74\x3a\x20\x55\124\x46\x20\x2d\40\70", "\x41\165\x74\x68\157\162\x69\x7a\141\x74\151\x6f\x6e\72\40\102\x61\163\151\x63"));
        curl_setopt($Rn, CURLOPT_POST, TRUE);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto Mu;
        }
        $MA = array("\45\155\145\164\150\157\x64" => "\147\x65\164\x43\165\163\x74\x6f\x6d\x65\162\x4b\145\171\163", "\x25\x66\151\x6c\x65" => "\143\165\x73\164\157\155\145\x72\x5f\x73\145\x74\x75\160\56\160\150\160", "\45\145\162\162\x6f\x72" => curl_error($Rn));
        watchdog("\x6d\151\x6e\x69\x6f\x72\x61\x6e\147\145\x5f\x73\141\x6d\x6c", "\105\162\x72\157\162\40\141\x74\40\x25\x6d\145\x74\150\157\144\40\157\146\x20\x25\146\x69\x6c\x65\72\40\x25\x65\x72\162\157\x72", $MA);
        Mu:
        curl_close($Rn);
        return $uj;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto eM;
        }
        return json_encode(array("\163\x74\141\x74\165\163" => "\x43\125\122\114\137\x45\122\122\117\122", "\x73\x74\x61\164\x75\163\x4d\x65\x73\x73\x61\147\145" => "\74\x61\40\x68\162\x65\146\x3d\42\x68\x74\164\160\72\57\57\160\x68\160\56\x6e\x65\164\57\155\141\156\165\x61\x6c\x2f\145\156\57\x63\x75\162\x6c\56\x69\156\x73\x74\141\154\x6c\141\x74\151\157\156\x2e\160\150\x70\x22\76\120\110\120\x20\143\125\x52\114\x20\145\170\x74\x65\x6e\x73\x69\x6f\156\x3c\57\141\x3e\x20\x69\163\x20\156\x6f\x74\x20\151\156\163\164\141\x6c\154\145\x64\x20\157\x72\x20\x64\x69\163\141\x62\154\x65\x64\56"));
        eM:
        $eY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\141\163\57\141\x70\151\x2f\141\165\x74\150\57\143\x68\x61\x6c\x6c\x65\x6e\x67\145";
        $Rn = curl_init($eY);
        $Dw = $this->defaultCustomerId;
        $jX = $this->defaultCustomerApiKey;
        $tb = variable_get("\155\151\x6e\x69\157\162\x61\156\147\145\x5f\163\141\x6d\154\137\143\x75\x73\164\157\x6d\145\162\137\141\x64\155\x69\x6e\137\x65\x6d\x61\151\154", NULL);
        $WE = round(microtime(TRUE) * 1000);
        $LZ = $Dw . number_format($gp, 0, '', '') . $jX;
        $D0 = hash("\163\x68\x61\65\x31\x32", $LZ);
        $Qg = "\103\x75\x73\x74\x6f\x6d\145\162\x2d\113\x65\171\x3a\x20" . $Dw;
        $Eq = "\124\x69\155\145\x73\164\141\x6d\x70\x3a\40" . number_format($gp, 0, '', '');
        $Xy = "\101\165\164\x68\157\x72\x69\x7a\141\x74\151\x6f\x6e\72\x20" . $D0;
        $Sc = array("\x63\x75\x73\x74\x6f\x6d\145\162\113\145\171" => $Dw, "\145\x6d\141\151\x6c" => $tb, "\141\x75\164\x68\124\x79\160\145" => "\105\x4d\101\111\x4c");
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\x65\x6e\x74\55\x54\x79\160\x65\x3a\x20\141\160\160\154\x69\x63\141\x74\151\x6f\156\57\152\x73\157\156", $Qg, $Eq, $Xy));
        curl_setopt($Rn, CURLOPT_POST, TRUE);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto HO;
        }
        $MA = array("\45\x6d\145\x74\150\x6f\144" => "\163\145\156\x64\117\164\x70", "\x25\146\151\154\x65" => "\x63\165\x73\164\157\x6d\145\x72\137\x73\145\x74\165\x70\x2e\160\x68\x70", "\45\145\x72\x72\x6f\x72" => curl_error($Rn));
        watchdog("\x6d\151\156\x69\x6f\162\x61\156\147\145\x5f\x73\x61\x6d\154", "\105\162\162\157\x72\40\x61\x74\40\x25\x6d\145\x74\150\157\x64\x20\157\146\40\x25\146\x69\x6c\145\x3a\40\x25\x65\162\x72\157\162", $MA);
        HO:
        curl_close($Rn);
        return $uj;
    }
    public function validateOtp($q7)
    {
        if (Utilities::isCurlInstalled()) {
            goto dG;
        }
        return json_encode(array("\163\x74\x61\x74\165\x73" => "\103\x55\122\114\137\105\122\x52\x4f\x52", "\163\164\141\x74\x75\x73\x4d\145\x73\163\x61\x67\x65" => "\74\x61\40\150\162\x65\146\75\x22\150\164\x74\160\72\x2f\x2f\160\x68\x70\x2e\156\145\x74\x2f\x6d\x61\156\165\141\x6c\57\x65\x6e\x2f\x63\165\x72\154\56\x69\156\163\x74\141\154\x6c\x61\x74\x69\157\x6e\x2e\x70\150\x70\42\x3e\120\x48\120\x20\x63\125\x52\114\x20\x65\x78\x74\145\x6e\x73\x69\x6f\156\74\57\x61\76\40\x69\x73\x20\156\x6f\164\x20\x69\156\x73\x74\141\x6c\x6c\145\144\40\157\162\x20\144\151\x73\141\142\154\145\x64\56"));
        dG:
        $eY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\141\x73\x2f\x61\x70\x69\57\141\x75\x74\x68\57\x76\141\x6c\x69\144\141\x74\x65";
        $Rn = curl_init($eY);
        $Dw = $this->defaultCustomerId;
        $jX = $this->defaultCustomerApiKey;
        $WE = round(microtime(TRUE) * 1000);
        $LZ = $Dw . number_format($gp, 0, '', '') . $jX;
        $D0 = hash("\x73\150\x61\x35\x31\x32", $LZ);
        $Qg = "\103\x75\163\164\x6f\155\145\162\x2d\113\145\x79\72\40" . $Dw;
        $Eq = "\x54\151\155\x65\163\x74\x61\155\x70\72\40" . number_format($gp, 0, '', '');
        $Xy = "\101\x75\164\x68\157\x72\x69\x7a\141\164\x69\157\x6e\x3a\40" . $D0;
        $Sc = array("\x74\170\x49\x64" => $q7, "\x74\157\x6b\x65\156" => $this->otpToken);
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\103\157\156\164\x65\x6e\x74\x2d\x54\x79\160\145\72\x20\141\160\x70\154\x69\143\141\x74\x69\157\156\x2f\152\163\x6f\x6e", $Qg, $Eq, $Xy));
        curl_setopt($Rn, CURLOPT_POST, TRUE);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto cc;
        }
        $MA = array("\x25\x6d\145\164\150\x6f\x64" => "\166\141\154\x69\x64\x61\164\145\117\164\160", "\x25\x66\x69\154\145" => "\x63\x75\163\164\x6f\155\145\x72\137\163\145\164\x75\x70\x2e\x70\150\160", "\x25\145\162\x72\x6f\x72" => curl_error($Rn));
        watchdog("\155\151\x6e\151\x6f\162\141\x6e\x67\145\x5f\x73\141\x6d\154", "\x45\162\162\157\x72\x20\141\164\x20\x25\x6d\x65\x74\x68\x6f\x64\x20\x6f\146\x20\x25\x66\x69\154\145\x3a\x20\45\145\x72\162\x6f\x72", $MA);
        cc:
        curl_close($Rn);
        return $uj;
    }
    function verifyLicense($tU)
    {
        $eY = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\163\x2f\x61\x70\x69\x2f\142\x61\x63\x6b\165\x70\x63\157\x64\145\x2f\x76\145\162\x69\146\171";
        $Rn = curl_init($eY);
        $LR = variable_get("\155\151\156\151\x6f\162\x61\156\x67\x65\x5f\x73\141\x6d\x6c\137\x63\165\x73\164\x6f\x6d\x65\x72\137\151\x64");
        $xN = variable_get("\155\151\x6e\151\x6f\162\x61\x6e\x67\145\137\163\141\155\x6c\137\x63\165\163\164\x6f\x6d\145\162\137\x61\x70\x69\x5f\x6b\x65\x79");
        global $base_url;
        $gp = round(microtime(TRUE) * 1000);
        $Y1 = $LR . number_format($gp, 0, '', '') . $xN;
        $eZ = hash("\163\150\141\x35\x31\x32", $Y1);
        $wf = "\x43\x75\x73\x74\x6f\155\x65\162\55\113\145\x79\72\40" . $LR;
        $sL = "\124\151\x6d\x65\x73\164\141\155\160\x3a\x20" . number_format($gp, 0, '', '');
        $wr = "\101\x75\164\150\157\x72\x69\172\141\164\151\157\156\x3a\40" . $eZ;
        $Sc = '';
        $Sc = array("\x63\x6f\x64\x65" => $tU, "\x63\x75\163\164\x6f\x6d\x65\x72\113\145\x79" => $LR, "\x61\x64\x64\151\164\151\x6f\x6e\x61\x6c\x46\151\145\154\x64\163" => array("\146\151\145\x6c\144\x31" => $base_url));
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, true);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\x65\x6e\x74\55\x54\171\160\145\72\x20\x61\x70\x70\154\x69\143\x61\164\x69\x6f\156\57\x6a\163\157\156", $wf, $sL, $wr));
        curl_setopt($Rn, CURLOPT_POST, true);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        curl_setopt($Rn, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Rn, CURLOPT_TIMEOUT, 20);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto dn;
        }
        echo "\x52\145\161\165\x65\163\x74\x20\105\x72\162\x6f\x72\72" . curl_error($Rn);
        exit;
        dn:
        curl_close($Rn);
        return $uj;
    }
    function updateStatus()
    {
        $eY = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\141\x73\x2f\141\x70\x69\x2f\x62\x61\x63\153\x75\160\x63\157\x64\x65\57\165\x70\x64\x61\x74\145\163\164\141\x74\x75\163";
        $Rn = curl_init($eY);
        $LR = variable_get("\155\x69\156\151\x6f\x72\x61\156\x67\145\x5f\x73\141\x6d\x6c\137\143\x75\x73\164\x6f\155\x65\162\137\x69\144");
        $xN = variable_get("\155\x69\x6e\x69\157\x72\x61\x6e\x67\145\x5f\x73\141\155\154\x5f\143\x75\x73\164\x6f\155\145\x72\137\x61\x70\151\x5f\x6b\x65\x79");
        $gp = round(microtime(TRUE) * 1000);
        $Y1 = $LR . number_format($gp, 0, '', '') . $xN;
        $eZ = hash("\x73\x68\x61\x35\61\x32", $Y1);
        $wf = "\x43\165\x73\x74\157\155\x65\x72\55\113\145\x79\x3a\40" . $LR;
        $sL = "\124\151\155\x65\163\x74\x61\155\x70\72\40" . number_format($gp, 0, '', '');
        $wr = "\101\x75\164\150\157\162\151\172\x61\164\x69\x6f\x6e\x3a\x20" . $eZ;
        $u7 = variable_get("\x6d\x69\156\x69\157\x72\x61\x6e\147\145\x5f\x73\141\x6d\154\137\x63\165\163\164\x6f\x6d\x65\x72\137\x61\x64\155\x69\156\x5f\164\157\x6b\145\x6e");
        $tU = AESEncryption::decrypt_data(variable_get("\155\151\156\151\157\x72\141\x6e\147\145\x5f\163\141\155\x6c\x5f\x6c\x69\x63\x65\x6e\x73\x65\x5f\153\145\171"), $u7);
        $Sc = array("\143\157\144\145" => $tU, "\143\x75\163\x74\x6f\x6d\x65\162\113\145\171" => $LR);
        $GZ = json_encode($Sc);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, true);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\x43\157\156\x74\145\x6e\x74\x2d\x54\171\x70\145\x3a\x20\x61\160\x70\x6c\x69\143\141\164\x69\157\156\x2f\152\x73\157\x6e", $wf, $sL, $wr));
        curl_setopt($Rn, CURLOPT_POST, true);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        curl_setopt($Rn, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Rn, CURLOPT_TIMEOUT, 20);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto m0;
        }
        echo "\x52\145\x71\165\145\163\x74\x20\x45\162\162\157\162\72" . curl_error($Rn);
        exit;
        m0:
        curl_close($Rn);
        return $uj;
    }
}
