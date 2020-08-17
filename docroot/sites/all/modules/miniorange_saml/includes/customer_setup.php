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
    public function __construct($fB, $KC, $v_, $vY)
    {
        $this->email = $fB;
        $this->phone = $KC;
        $this->password = $v_;
        $this->otpToken = $vY;
        $this->defaultCustomerId = "\61\x36\x35\x35\x35";
        $this->defaultCustomerApiKey = "\146\106\x64\x32\130\x63\166\124\x47\104\x65\155\132\x76\142\x77\61\x62\x63\x55\145\163\x4e\112\127\105\161\x4b\x62\x62\x55\161";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto DV;
        }
        return json_encode(array("\163\164\x61\x74\165\163" => "\x43\x55\122\x4c\137\105\x52\122\117\x52", "\163\x74\x61\164\165\x73\x4d\145\x73\163\x61\147\145" => "\x3c\x61\x20\x68\162\x65\146\x3d\x22\x68\164\164\160\72\57\57\x70\150\160\x2e\x6e\145\164\57\155\141\x6e\165\x61\154\57\145\x6e\x2f\143\x75\162\154\x2e\151\156\x73\164\x61\154\x6c\141\x74\x69\157\x6e\x2e\x70\x68\x70\x22\76\x50\110\120\x20\143\x55\122\114\40\145\170\164\145\x6e\x73\151\x6f\x6e\74\x2f\x61\76\40\x69\163\40\x6e\157\164\40\151\156\163\164\141\154\x6c\145\144\40\x6f\x72\x20\x64\x69\163\141\x62\x6c\145\x64\56"));
        DV:
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\141\x73\x2f\x72\x65\163\164\x2f\x63\x75\x73\x74\x6f\155\145\x72\57\143\x68\145\143\153\55\x69\x66\x2d\145\170\x69\x73\x74\163";
        $Ao = curl_init($e2);
        $fB = $this->email;
        $Cs = array("\x65\x6d\141\x69\x6c" => $fB);
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\145\x6e\164\x2d\124\171\x70\x65\72\x20\x61\x70\160\x6c\x69\x63\x61\x74\151\x6f\156\57\152\163\x6f\x6e", "\143\x68\141\162\163\145\x74\72\40\x55\x54\106\x20\55\40\x38", "\101\165\164\150\x6f\162\x69\172\x61\x74\x69\157\156\x3a\40\102\141\163\x69\143"));
        curl_setopt($Ao, CURLOPT_POST, TRUE);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto Gd;
        }
        $On = array("\45\155\x65\164\150\x6f\x64" => "\x63\x68\145\143\x6b\103\165\163\164\x6f\x6d\145\x72", "\x25\146\151\154\145" => "\x63\x75\163\164\157\155\x65\x72\x5f\x73\x65\x74\x75\160\56\160\x68\x70", "\x25\145\162\x72\x6f\x72" => curl_error($Ao));
        watchdog("\155\151\x6e\151\x6f\x72\x61\156\147\x65\x5f\163\x61\x6d\x6c", "\x45\162\162\x6f\162\x20\x61\164\40\x25\x6d\145\x74\x68\x6f\x64\40\x6f\146\40\45\146\x69\x6c\x65\72\40\x25\x65\162\x72\x6f\x72", $On);
        Gd:
        curl_close($Ao);
        return $uG;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto ik;
        }
        return json_encode(array("\x73\164\141\164\165\x73\103\x6f\144\x65" => "\105\x52\122\117\x52", "\163\164\x61\x74\165\163\115\x65\163\163\141\147\x65" => "\x2e\x20\120\x6c\145\141\x73\145\x20\143\x68\x65\143\153\x20\x79\x6f\x75\162\x20\143\x6f\156\146\x69\147\165\x72\x61\x74\151\157\156\56"));
        ik:
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\141\163\57\x72\x65\x73\164\57\x63\x75\x73\164\x6f\155\x65\x72\57\x61\x64\x64";
        $Ao = curl_init($e2);
        $Cs = array("\x63\157\155\x70\141\156\171\x4e\x61\155\x65" => $_SERVER["\123\x45\122\x56\x45\x52\x5f\x4e\x41\115\105"], "\141\162\x65\x61\x4f\146\x49\156\164\145\x72\x65\x73\164" => "\x44\x72\x75\160\x61\154\x20\x53\x41\115\x4c\x20\115\157\144\x75\154\x65\40\x2d\x20\x50\162\145\x6d\x69\165\155", "\145\x6d\141\151\154" => $this->email, "\x70\150\x6f\156\x65" => $this->phone, "\160\141\163\163\167\157\162\144" => $this->password);
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\x43\x6f\156\x74\x65\156\164\x2d\124\171\160\x65\x3a\40\141\x70\160\x6c\151\x63\141\x74\x69\157\x6e\x2f\152\x73\157\x6e", "\x63\150\141\162\163\145\x74\72\x20\x55\124\106\x20\x2d\x20\x38", "\101\x75\164\150\x6f\162\151\172\141\x74\151\x6f\156\72\40\102\141\163\x69\143"));
        curl_setopt($Ao, CURLOPT_POST, TRUE);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto GF;
        }
        $On = array("\45\x6d\x65\164\150\x6f\x64" => "\143\x72\x65\x61\x74\145\x43\165\163\x74\x6f\155\x65\162", "\45\x66\x69\x6c\145" => "\143\x75\163\164\x6f\x6d\145\162\x5f\x73\145\x74\165\160\x2e\160\x68\160", "\45\145\x72\x72\x6f\x72" => curl_error($Ao));
        watchdog("\155\151\156\x69\x6f\162\141\x6e\x67\x65\137\x73\141\155\x6c", "\105\x72\162\157\162\x20\x61\164\x20\45\x6d\x65\x74\150\x6f\x64\40\157\x66\x20\x25\x66\x69\154\145\x3a\40\45\145\162\162\x6f\x72", $On);
        GF:
        curl_close($Ao);
        return $uG;
    }
    function ccl()
    {
        global $base_url;
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\141\163\57\162\x65\x73\164\x2f\x63\x75\x73\x74\157\x6d\x65\162\57\x6c\151\143\145\x6e\x73\145";
        $Ao = curl_init($e2);
        $WI = variable_get("\x6d\x69\156\x69\x6f\162\141\156\147\x65\x5f\x73\x61\x6d\x6c\x5f\x63\x75\x73\164\157\x6d\x65\162\x5f\151\x64", '');
        $IM = variable_get("\x6d\x69\156\x69\x6f\x72\x61\156\x67\145\137\163\x61\155\x6c\x5f\143\165\163\x74\157\x6d\x65\x72\137\x61\x70\x69\x5f\x6b\x65\x79", '');
        $gX = round(microtime(true) * 1000);
        $DS = $WI . number_format($gX, 0, '', '') . $IM;
        $P7 = hash("\163\150\141\x35\x31\62", $DS);
        $Ai = "\103\x75\163\164\x6f\x6d\145\162\55\x4b\145\x79\72\x20" . $WI;
        $vh = "\x54\x69\x6d\145\x73\164\141\155\160\x3a\40" . number_format($gX, 0, '', '');
        $Q2 = "\x41\165\x74\x68\157\162\x69\172\141\x74\x69\157\156\x3a\40" . $P7;
        $Cs = '';
        $Cs = array("\143\x75\x73\164\157\x6d\x65\x72\x49\144" => $WI, "\x61\160\160\x6c\151\x63\141\x74\151\157\156\x4e\x61\155\145" => "\x64\x72\x75\x70\141\154\x5f\155\x69\x6e\151\157\x72\x61\156\147\145\x5f\x73\141\155\x6c\x5f\145\x6e\164\145\x72\160\x72\x69\163\x65\137\x70\154\141\156");
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, true);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\x65\156\164\55\124\x79\x70\x65\72\x20\x61\x70\160\x6c\151\143\141\164\151\x6f\156\x2f\152\x73\x6f\x6e", $Ai, $vh, $Q2));
        curl_setopt($Ao, CURLOPT_POST, true);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        curl_setopt($Ao, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Ao, CURLOPT_TIMEOUT, 20);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto hl;
        }
        return null;
        hl:
        curl_close($Ao);
        return $uG;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto sn;
        }
        return json_encode(array("\141\x70\x69\113\145\171" => "\103\x55\x52\114\x5f\x45\122\x52\117\122", "\164\x6f\x6b\145\156" => "\x3c\141\40\x68\162\x65\x66\75\x22\x68\x74\x74\x70\72\x2f\57\160\x68\160\56\156\x65\164\57\155\141\x6e\x75\x61\154\57\x65\x6e\57\x63\x75\x72\x6c\x2e\151\x6e\x73\x74\x61\154\154\x61\x74\151\x6f\x6e\x2e\x70\150\x70\x22\76\x50\110\x50\x20\x63\125\122\x4c\x20\145\x78\164\145\156\x73\x69\x6f\x6e\x3c\57\x61\x3e\40\151\x73\40\156\x6f\x74\40\x69\x6e\x73\x74\141\154\154\145\144\x20\x6f\162\40\144\151\x73\141\142\154\x65\144\x2e"));
        sn:
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\141\x73\x2f\162\145\163\164\57\x63\x75\163\x74\x6f\155\145\162\57\153\145\171";
        $Ao = curl_init($e2);
        $fB = $this->email;
        $v_ = $this->password;
        $Cs = array("\145\x6d\141\x69\x6c" => $fB, "\x70\141\163\163\x77\157\x72\x64" => $v_);
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\156\x74\55\x54\171\x70\145\72\40\x61\160\160\x6c\151\143\x61\164\151\x6f\156\x2f\152\x73\157\x6e", "\143\150\141\162\x73\145\x74\x3a\x20\x55\124\106\40\55\40\70", "\x41\x75\x74\x68\x6f\162\x69\172\x61\164\151\157\156\x3a\x20\102\x61\163\x69\143"));
        curl_setopt($Ao, CURLOPT_POST, TRUE);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto GJ;
        }
        $On = array("\45\155\x65\x74\150\x6f\x64" => "\x67\x65\x74\103\165\x73\164\157\x6d\x65\162\x4b\145\x79\x73", "\x25\146\151\x6c\145" => "\143\165\x73\164\x6f\155\x65\162\137\x73\x65\x74\x75\x70\x2e\160\x68\x70", "\45\145\x72\162\157\x72" => curl_error($Ao));
        watchdog("\x6d\x69\x6e\x69\157\x72\141\x6e\x67\x65\137\x73\141\155\x6c", "\x45\x72\x72\157\x72\40\x61\x74\40\x25\x6d\145\x74\150\x6f\144\40\x6f\x66\x20\x25\146\151\154\x65\72\x20\x25\145\x72\x72\157\162", $On);
        GJ:
        curl_close($Ao);
        return $uG;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto b7;
        }
        return json_encode(array("\163\x74\x61\x74\165\163" => "\103\x55\x52\x4c\137\x45\122\122\117\x52", "\163\x74\141\164\165\x73\x4d\145\x73\x73\141\x67\x65" => "\x3c\141\40\x68\162\x65\x66\x3d\42\x68\164\x74\x70\72\x2f\x2f\160\150\x70\x2e\156\145\164\57\x6d\141\156\165\x61\x6c\57\145\x6e\x2f\x63\x75\162\x6c\56\151\156\163\x74\x61\x6c\x6c\x61\164\151\157\x6e\x2e\x70\x68\x70\x22\76\120\x48\120\40\143\125\x52\x4c\40\x65\x78\x74\x65\156\163\151\157\x6e\x3c\57\x61\x3e\40\x69\x73\40\x6e\x6f\x74\40\151\156\163\x74\x61\154\154\x65\x64\x20\x6f\x72\x20\144\151\x73\141\x62\x6c\145\144\x2e"));
        b7:
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\x2f\141\160\151\57\141\165\x74\150\x2f\x63\x68\x61\154\x6c\145\156\147\145";
        $Ao = curl_init($e2);
        $wz = $this->defaultCustomerId;
        $qY = $this->defaultCustomerApiKey;
        $kd = variable_get("\155\151\x6e\x69\157\x72\141\x6e\x67\145\137\163\x61\155\x6c\x5f\x63\x75\163\x74\x6f\x6d\x65\162\137\x61\144\x6d\151\156\137\145\x6d\141\151\154", NULL);
        $W9 = round(microtime(TRUE) * 1000);
        $CI = $wz . number_format($gX, 0, '', '') . $qY;
        $Q4 = hash("\163\150\141\65\x31\x32", $CI);
        $pI = "\x43\165\163\164\157\x6d\145\162\x2d\x4b\x65\x79\x3a\x20" . $wz;
        $kW = "\x54\151\x6d\x65\163\x74\141\155\160\x3a\40" . number_format($gX, 0, '', '');
        $Kg = "\x41\165\164\x68\x6f\x72\151\172\141\x74\151\x6f\x6e\x3a\40" . $Q4;
        $Cs = array("\x63\x75\163\x74\x6f\155\x65\162\113\145\x79" => $wz, "\145\x6d\x61\x69\154" => $kd, "\x61\165\x74\x68\124\x79\x70\145" => "\x45\x4d\x41\x49\114");
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\x65\156\x74\x2d\x54\x79\160\145\x3a\x20\141\x70\160\x6c\x69\143\141\164\151\x6f\x6e\57\152\x73\157\156", $pI, $kW, $Kg));
        curl_setopt($Ao, CURLOPT_POST, TRUE);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto ew;
        }
        $On = array("\45\x6d\145\x74\150\157\x64" => "\x73\x65\156\144\x4f\164\x70", "\45\x66\x69\x6c\x65" => "\x63\x75\163\x74\x6f\155\x65\162\137\x73\145\164\165\160\x2e\x70\150\x70", "\x25\x65\162\x72\x6f\162" => curl_error($Ao));
        watchdog("\155\151\156\x69\x6f\x72\x61\x6e\147\145\137\163\141\155\x6c", "\105\x72\162\x6f\162\x20\141\x74\40\x25\x6d\x65\x74\150\157\x64\40\157\x66\x20\x25\x66\151\x6c\x65\72\x20\45\x65\x72\x72\x6f\x72", $On);
        ew:
        curl_close($Ao);
        return $uG;
    }
    public function validateOtp($x0)
    {
        if (Utilities::isCurlInstalled()) {
            goto Qo;
        }
        return json_encode(array("\x73\x74\x61\x74\165\x73" => "\103\125\x52\114\x5f\105\122\122\117\122", "\x73\164\141\164\165\163\115\x65\163\163\141\147\145" => "\x3c\141\x20\x68\x72\x65\x66\x3d\42\x68\164\164\160\72\x2f\57\160\150\x70\x2e\156\x65\x74\x2f\155\141\x6e\165\141\154\57\145\x6e\57\143\x75\162\x6c\56\x69\156\x73\x74\x61\x6c\x6c\141\x74\151\157\156\56\160\x68\160\42\76\x50\110\x50\40\x63\125\122\114\40\x65\170\x74\145\x6e\163\151\157\x6e\x3c\57\x61\x3e\40\x69\163\x20\156\x6f\x74\x20\x69\x6e\163\x74\x61\154\154\145\144\x20\157\162\40\144\x69\x73\x61\142\x6c\x65\x64\56"));
        Qo:
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\141\163\57\141\160\x69\57\141\165\164\x68\x2f\x76\141\154\151\144\x61\x74\145";
        $Ao = curl_init($e2);
        $wz = $this->defaultCustomerId;
        $qY = $this->defaultCustomerApiKey;
        $W9 = round(microtime(TRUE) * 1000);
        $CI = $wz . number_format($gX, 0, '', '') . $qY;
        $Q4 = hash("\x73\150\x61\65\x31\62", $CI);
        $pI = "\x43\x75\x73\164\157\x6d\x65\162\x2d\x4b\x65\171\x3a\x20" . $wz;
        $kW = "\x54\151\x6d\145\x73\x74\x61\155\160\72\x20" . number_format($gX, 0, '', '');
        $Kg = "\101\x75\x74\150\x6f\x72\x69\172\141\164\x69\x6f\156\x3a\x20" . $Q4;
        $Cs = array("\x74\x78\111\144" => $x0, "\x74\157\x6b\x65\x6e" => $this->otpToken);
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\x65\156\x74\55\x54\x79\x70\145\72\x20\x61\x70\x70\154\x69\x63\141\164\x69\x6f\156\x2f\152\x73\157\156", $pI, $kW, $Kg));
        curl_setopt($Ao, CURLOPT_POST, TRUE);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto WI;
        }
        $On = array("\45\x6d\145\164\150\157\x64" => "\x76\x61\154\x69\144\141\x74\145\x4f\164\x70", "\x25\x66\x69\154\x65" => "\x63\165\x73\164\x6f\x6d\x65\162\137\x73\x65\164\x75\x70\56\160\150\160", "\x25\145\162\x72\157\x72" => curl_error($Ao));
        watchdog("\155\x69\156\151\157\x72\141\x6e\x67\145\137\163\x61\x6d\x6c", "\105\162\x72\x6f\162\40\x61\x74\40\x25\x6d\145\164\x68\157\144\40\x6f\x66\x20\x25\146\x69\154\145\72\40\x25\x65\x72\162\x6f\x72", $On);
        WI:
        curl_close($Ao);
        return $uG;
    }
    function verifyLicense($m2)
    {
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\57\x61\160\151\x2f\x62\141\x63\x6b\165\x70\143\x6f\x64\145\x2f\x76\145\162\x69\146\x79";
        $Ao = curl_init($e2);
        $WI = variable_get("\155\151\156\151\157\x72\141\156\x67\145\137\163\141\x6d\x6c\x5f\143\x75\x73\x74\157\155\x65\162\x5f\x69\144");
        $IM = variable_get("\155\x69\156\x69\x6f\162\x61\156\x67\x65\x5f\163\141\x6d\154\x5f\x63\165\x73\164\157\x6d\x65\x72\137\x61\x70\151\x5f\153\145\171");
        global $base_url;
        $gX = round(microtime(TRUE) * 1000);
        $DS = $WI . number_format($gX, 0, '', '') . $IM;
        $P7 = hash("\x73\x68\x61\65\x31\x32", $DS);
        $Ai = "\103\165\163\x74\157\x6d\145\x72\55\x4b\145\x79\72\40" . $WI;
        $vh = "\124\151\155\x65\x73\164\141\155\x70\x3a\40" . number_format($gX, 0, '', '');
        $Q2 = "\101\x75\164\150\x6f\x72\x69\172\141\x74\151\157\156\72\x20" . $P7;
        $Cs = '';
        $Cs = array("\x63\157\x64\145" => $m2, "\x63\165\163\x74\157\155\x65\162\x4b\x65\171" => $WI, "\141\x64\x64\151\x74\151\x6f\x6e\x61\154\106\151\145\154\144\163" => array("\x66\151\145\x6c\x64\61" => $base_url));
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, true);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\x6e\x74\55\x54\171\x70\145\x3a\x20\x61\x70\x70\x6c\x69\143\x61\x74\x69\x6f\x6e\x2f\x6a\x73\157\x6e", $Ai, $vh, $Q2));
        curl_setopt($Ao, CURLOPT_POST, true);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        curl_setopt($Ao, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Ao, CURLOPT_TIMEOUT, 20);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto qZ;
        }
        echo "\122\x65\161\165\145\x73\164\x20\105\x72\x72\157\162\72" . curl_error($Ao);
        die;
        qZ:
        curl_close($Ao);
        return $uG;
    }
    function updateStatus()
    {
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\141\x73\57\141\x70\x69\57\x62\141\143\x6b\x75\x70\x63\x6f\144\x65\x2f\x75\160\x64\141\164\145\163\x74\x61\x74\x75\163";
        $Ao = curl_init($e2);
        $WI = variable_get("\155\151\156\x69\x6f\x72\x61\x6e\147\145\x5f\163\141\x6d\154\x5f\x63\165\163\164\157\x6d\145\x72\x5f\151\144");
        $IM = variable_get("\x6d\151\x6e\151\157\162\141\156\147\x65\137\x73\x61\x6d\154\137\x63\x75\x73\x74\157\155\145\162\x5f\x61\x70\151\137\153\145\171");
        $gX = round(microtime(TRUE) * 1000);
        $DS = $WI . number_format($gX, 0, '', '') . $IM;
        $P7 = hash("\x73\x68\x61\x35\x31\62", $DS);
        $Ai = "\x43\x75\x73\x74\157\x6d\145\162\x2d\113\x65\171\x3a\40" . $WI;
        $vh = "\124\x69\155\x65\163\x74\x61\x6d\160\72\40" . number_format($gX, 0, '', '');
        $Q2 = "\101\x75\164\150\x6f\162\151\x7a\x61\x74\151\157\156\72\x20" . $P7;
        $FS = variable_get("\x6d\151\x6e\151\x6f\162\141\x6e\147\145\137\163\x61\x6d\x6c\137\x63\x75\x73\x74\157\x6d\145\x72\137\x61\144\155\x69\156\x5f\164\x6f\x6b\145\156");
        $m2 = AESEncryption::decrypt_data(variable_get("\x6d\x69\x6e\x69\x6f\162\x61\x6e\147\145\137\x73\141\155\x6c\x5f\x6c\151\x63\145\156\163\145\137\x6b\x65\x79"), $FS);
        $Cs = array("\x63\157\144\145" => $m2, "\143\165\x73\164\157\155\x65\162\x4b\x65\171" => $WI);
        $Xm = json_encode($Cs);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, true);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\156\x74\55\124\x79\160\x65\x3a\x20\x61\160\x70\154\151\143\x61\164\x69\x6f\x6e\57\x6a\163\157\x6e", $Ai, $vh, $Q2));
        curl_setopt($Ao, CURLOPT_POST, true);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        curl_setopt($Ao, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Ao, CURLOPT_TIMEOUT, 20);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto E2;
        }
        echo "\122\145\x71\x75\145\163\x74\40\x45\x72\162\x6f\x72\72" . curl_error($Ao);
        die;
        E2:
        curl_close($Ao);
        return $uG;
    }
}
