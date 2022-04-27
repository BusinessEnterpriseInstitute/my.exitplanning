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
    public function __construct($k6, $GC, $YP, $BF)
    {
        $this->email = $k6;
        $this->phone = $GC;
        $this->password = $YP;
        $this->otpToken = $BF;
        $this->defaultCustomerId = "\61\x36\x35\65\x35";
        $this->defaultCustomerApiKey = "\x66\106\144\x32\130\143\x76\x54\x47\104\x65\155\x5a\166\142\167\x31\x62\x63\x55\x65\163\x4e\112\x57\105\161\113\142\142\125\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto vZ;
        }
        return json_encode(array("\x73\164\141\164\x75\x73" => "\x43\125\122\114\137\105\122\x52\x4f\122", "\x73\164\x61\164\x75\163\x4d\x65\163\163\x61\x67\x65" => "\x3c\x61\x20\x68\162\x65\146\x3d\42\x68\x74\x74\160\x3a\x2f\57\x70\x68\x70\56\x6e\145\164\57\155\141\156\x75\141\x6c\x2f\145\x6e\57\143\165\x72\154\x2e\x69\156\163\164\141\154\154\x61\164\x69\157\156\56\x70\x68\160\42\76\120\x48\x50\x20\143\125\122\114\40\x65\x78\x74\x65\156\x73\151\157\156\74\x2f\141\x3e\x20\x69\x73\40\x6e\157\x74\x20\x69\156\x73\x74\141\x6c\x6c\x65\x64\x20\157\162\x20\x64\151\163\141\142\154\x65\x64\56"));
        vZ:
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\x73\57\162\x65\x73\x74\57\143\x75\x73\x74\157\155\x65\162\57\143\x68\145\143\x6b\55\151\146\55\145\170\151\x73\x74\x73";
        $Ey = curl_init($P4);
        $k6 = $this->email;
        $qS = array("\145\x6d\141\151\154" => $k6);
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\x65\x6e\164\55\x54\x79\160\x65\x3a\40\x61\160\x70\x6c\x69\143\x61\164\151\157\x6e\x2f\152\x73\x6f\156", "\143\x68\x61\162\163\x65\164\72\x20\x55\124\106\40\55\40\x38", "\x41\165\164\x68\x6f\x72\x69\172\141\164\151\157\156\x3a\40\102\141\x73\x69\143"));
        curl_setopt($Ey, CURLOPT_POST, TRUE);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto qO;
        }
        $be = array("\x25\155\145\x74\x68\x6f\x64" => "\x63\150\145\143\x6b\x43\165\x73\x74\x6f\x6d\x65\x72", "\45\x66\151\x6c\x65" => "\x63\x75\x73\164\x6f\x6d\145\162\x5f\x73\x65\164\x75\x70\56\x70\150\x70", "\x25\145\162\x72\157\162" => curl_error($Ey));
        watchdog("\155\x69\156\151\x6f\x72\x61\x6e\147\145\x5f\x73\141\x6d\x6c", "\x45\162\162\157\162\40\141\164\x20\45\x6d\145\164\150\x6f\x64\40\x6f\x66\40\x25\146\x69\x6c\x65\x3a\x20\45\145\162\162\x6f\x72", $be);
        qO:
        curl_close($Ey);
        return $Ez;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Se;
        }
        return json_encode(array("\x73\x74\x61\x74\165\x73\103\157\x64\145" => "\105\x52\122\x4f\122", "\x73\x74\141\164\165\x73\115\145\x73\163\x61\147\145" => "\x2e\x20\x50\x6c\x65\141\163\x65\40\x63\150\145\143\x6b\40\x79\x6f\x75\x72\40\x63\157\x6e\x66\151\x67\165\162\x61\x74\x69\157\156\56"));
        Se:
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\163\57\x72\145\x73\164\x2f\143\x75\163\164\157\x6d\x65\x72\57\141\x64\x64";
        $Ey = curl_init($P4);
        $qS = array("\x63\x6f\155\x70\141\156\x79\x4e\x61\155\x65" => $_SERVER["\x53\105\122\x56\x45\x52\x5f\x4e\101\115\x45"], "\141\x72\145\x61\117\x66\x49\x6e\164\x65\x72\x65\163\x74" => "\104\x72\165\160\141\x6c\40\123\101\115\x4c\x20\x4d\157\x64\165\x6c\145\40\x2d\40\x50\162\x65\155\x69\165\155", "\145\x6d\x61\x69\x6c" => $this->email, "\x70\x68\157\156\145" => $this->phone, "\x70\141\x73\x73\x77\157\x72\x64" => $this->password);
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\x65\156\164\x2d\x54\171\160\x65\x3a\40\141\x70\x70\154\151\x63\x61\x74\x69\157\x6e\x2f\152\x73\x6f\x6e", "\x63\150\141\x72\x73\145\x74\72\x20\x55\x54\x46\x20\55\x20\x38", "\101\x75\x74\150\157\162\151\x7a\141\x74\x69\157\x6e\x3a\40\102\141\x73\x69\x63"));
        curl_setopt($Ey, CURLOPT_POST, TRUE);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto u4;
        }
        $be = array("\45\x6d\x65\x74\150\157\x64" => "\x63\162\145\x61\x74\x65\103\x75\x73\164\x6f\x6d\145\x72", "\45\146\151\x6c\145" => "\143\165\163\x74\157\155\x65\x72\x5f\163\145\164\165\x70\56\160\x68\x70", "\x25\145\x72\162\157\162" => curl_error($Ey));
        watchdog("\155\151\156\151\x6f\162\141\x6e\147\x65\137\x73\x61\155\154", "\105\x72\x72\157\x72\x20\141\x74\40\45\155\x65\164\x68\x6f\x64\40\157\146\40\x25\x66\x69\x6c\x65\x3a\40\x25\x65\162\x72\157\162", $be);
        u4:
        curl_close($Ey);
        return $Ez;
    }
    function ccl()
    {
        global $base_url;
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\x61\x73\x2f\x72\x65\163\164\57\x63\165\163\x74\x6f\x6d\x65\162\57\154\x69\x63\x65\156\163\x65";
        $Ey = curl_init($P4);
        $wk = variable_get("\155\151\156\x69\x6f\x72\141\x6e\147\x65\x5f\163\141\x6d\154\x5f\143\x75\x73\x74\x6f\155\145\162\137\151\144", '');
        $Zp = variable_get("\x6d\x69\156\151\157\x72\x61\x6e\x67\145\137\x73\141\x6d\x6c\137\143\165\x73\x74\x6f\x6d\145\x72\137\x61\160\151\137\153\x65\171", '');
        $EP = round(microtime(true) * 1000);
        $Qs = $wk . number_format($EP, 0, '', '') . $Zp;
        $TA = hash("\x73\150\141\65\61\62", $Qs);
        $dN = "\x43\165\x73\x74\x6f\x6d\145\162\x2d\x4b\x65\171\x3a\40" . $wk;
        $QI = "\x54\151\155\x65\163\164\x61\155\x70\x3a\40" . number_format($EP, 0, '', '');
        $ni = "\x41\x75\164\x68\x6f\162\151\172\x61\164\151\x6f\x6e\x3a\x20" . $TA;
        $qS = '';
        $qS = array("\x63\x75\x73\x74\157\x6d\145\x72\111\x64" => $wk, "\x61\x70\x70\x6c\151\x63\x61\x74\151\x6f\156\116\141\155\x65" => "\144\162\x75\160\141\x6c\137\155\151\156\x69\x6f\x72\x61\156\x67\145\137\163\x61\155\154\137\145\156\164\x65\x72\x70\162\x69\x73\145\137\x70\154\141\x6e");
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, true);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\x65\x6e\x74\x2d\x54\171\160\x65\72\40\141\x70\160\x6c\x69\x63\141\164\151\x6f\156\x2f\x6a\163\157\156", $dN, $QI, $ni));
        curl_setopt($Ey, CURLOPT_POST, true);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        curl_setopt($Ey, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Ey, CURLOPT_TIMEOUT, 20);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto Kb;
        }
        return null;
        Kb:
        curl_close($Ey);
        return $Ez;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto IH;
        }
        return json_encode(array("\141\160\151\113\145\x79" => "\103\125\122\x4c\x5f\x45\122\122\117\122", "\164\x6f\153\x65\156" => "\x3c\x61\x20\150\x72\x65\146\x3d\x22\150\x74\x74\x70\x3a\x2f\x2f\160\x68\160\56\x6e\x65\x74\57\x6d\141\156\165\x61\154\57\145\x6e\x2f\143\x75\x72\154\x2e\x69\x6e\163\x74\x61\x6c\154\x61\164\x69\157\x6e\x2e\x70\x68\x70\42\76\120\x48\x50\40\143\x55\x52\x4c\x20\x65\170\164\x65\156\163\151\x6f\x6e\x3c\57\x61\76\x20\x69\x73\x20\156\x6f\164\x20\151\156\163\164\141\x6c\154\145\x64\40\x6f\162\x20\x64\x69\163\141\142\x6c\145\x64\56"));
        IH:
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\141\x73\57\x72\x65\x73\164\x2f\x63\165\x73\x74\x6f\x6d\145\x72\x2f\x6b\145\171";
        $Ey = curl_init($P4);
        $k6 = $this->email;
        $YP = $this->password;
        $qS = array("\145\x6d\x61\151\154" => $k6, "\160\141\163\x73\167\157\162\144" => $YP);
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\145\156\x74\x2d\124\x79\x70\145\72\40\x61\160\160\x6c\x69\x63\141\164\x69\x6f\156\x2f\152\163\x6f\156", "\x63\x68\x61\x72\x73\x65\x74\72\x20\x55\x54\x46\x20\55\x20\x38", "\x41\165\164\150\157\x72\151\172\x61\164\151\x6f\156\72\40\102\x61\x73\151\143"));
        curl_setopt($Ey, CURLOPT_POST, TRUE);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto uZ;
        }
        $be = array("\x25\x6d\145\x74\150\157\144" => "\x67\x65\164\103\x75\x73\164\x6f\155\145\x72\113\x65\171\163", "\45\x66\151\x6c\145" => "\143\165\163\x74\157\155\x65\162\137\163\145\x74\165\160\x2e\x70\x68\160", "\45\145\x72\x72\157\162" => curl_error($Ey));
        watchdog("\x6d\151\x6e\x69\157\162\141\156\147\x65\x5f\163\141\155\154", "\x45\x72\x72\x6f\x72\40\141\x74\40\45\155\145\164\150\x6f\x64\40\x6f\x66\40\x25\146\151\154\x65\x3a\x20\x25\x65\x72\x72\157\162", $be);
        uZ:
        curl_close($Ey);
        return $Ez;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto mK;
        }
        return json_encode(array("\x73\164\x61\164\165\163" => "\x43\125\x52\x4c\137\105\x52\x52\x4f\x52", "\163\164\141\164\165\x73\115\x65\163\x73\x61\x67\x65" => "\x3c\x61\40\150\162\145\x66\75\x22\x68\164\164\160\x3a\x2f\x2f\x70\150\x70\x2e\x6e\145\x74\57\x6d\141\156\165\x61\x6c\57\x65\156\57\x63\165\x72\x6c\56\151\156\x73\164\141\154\154\141\x74\151\157\156\x2e\160\150\160\42\76\x50\x48\120\40\143\x55\122\x4c\40\145\170\164\x65\156\163\x69\157\x6e\74\57\x61\x3e\40\151\163\x20\x6e\x6f\x74\40\151\156\x73\164\x61\x6c\154\x65\144\40\157\162\x20\x64\151\163\x61\142\x6c\145\x64\x2e"));
        mK:
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\141\163\57\141\x70\x69\x2f\141\x75\164\150\x2f\x63\x68\141\x6c\x6c\x65\156\147\x65";
        $Ey = curl_init($P4);
        $wB = $this->defaultCustomerId;
        $EW = $this->defaultCustomerApiKey;
        $vy = variable_get("\x6d\x69\156\x69\157\162\141\x6e\x67\x65\137\163\141\x6d\x6c\x5f\143\x75\x73\x74\x6f\x6d\x65\x72\x5f\x61\144\x6d\x69\x6e\137\x65\x6d\x61\x69\x6c", NULL);
        $ny = round(microtime(TRUE) * 1000);
        $V6 = $wB . number_format($EP, 0, '', '') . $EW;
        $Q3 = hash("\x73\150\141\65\61\x32", $V6);
        $hG = "\103\165\163\x74\157\155\145\162\55\113\x65\x79\72\40" . $wB;
        $NF = "\x54\151\155\145\x73\164\141\x6d\160\72\x20" . number_format($EP, 0, '', '');
        $hp = "\x41\165\164\x68\x6f\162\151\x7a\141\164\151\157\x6e\72\40" . $Q3;
        $qS = array("\143\165\163\x74\157\155\145\162\113\145\x79" => $wB, "\145\x6d\x61\151\154" => $vy, "\x61\165\x74\x68\124\171\160\x65" => "\105\x4d\x41\x49\114");
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\156\x74\55\x54\171\160\x65\72\40\x61\x70\160\154\151\x63\x61\164\151\157\x6e\57\152\x73\157\x6e", $hG, $NF, $hp));
        curl_setopt($Ey, CURLOPT_POST, TRUE);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto Ig;
        }
        $be = array("\x25\155\x65\x74\x68\157\144" => "\x73\145\x6e\x64\117\x74\x70", "\x25\146\151\154\145" => "\x63\x75\x73\x74\x6f\155\x65\162\x5f\163\145\164\x75\160\56\x70\150\160", "\x25\x65\162\162\x6f\162" => curl_error($Ey));
        watchdog("\x6d\151\156\x69\157\x72\x61\x6e\147\x65\x5f\163\x61\x6d\x6c", "\x45\162\x72\x6f\x72\x20\x61\x74\x20\45\x6d\x65\164\x68\x6f\x64\40\157\146\40\x25\x66\151\x6c\145\72\x20\45\145\162\x72\x6f\x72", $be);
        Ig:
        curl_close($Ey);
        return $Ez;
    }
    public function validateOtp($AG)
    {
        if (Utilities::isCurlInstalled()) {
            goto Vt;
        }
        return json_encode(array("\x73\164\141\164\x75\163" => "\103\125\122\114\137\x45\122\x52\x4f\122", "\x73\164\141\164\165\x73\115\x65\163\x73\x61\147\x65" => "\x3c\x61\40\x68\162\x65\x66\x3d\42\x68\164\x74\160\72\x2f\x2f\x70\150\160\x2e\x6e\145\x74\57\155\141\156\x75\x61\154\x2f\145\156\57\143\165\x72\x6c\56\151\156\x73\164\x61\154\x6c\141\x74\151\x6f\156\x2e\x70\150\160\42\x3e\120\110\x50\40\x63\125\122\114\40\x65\170\x74\145\156\x73\x69\x6f\x6e\74\57\141\x3e\40\151\163\x20\156\x6f\x74\40\151\x6e\163\164\x61\x6c\x6c\x65\144\40\157\x72\x20\144\151\x73\141\x62\x6c\145\x64\x2e"));
        Vt:
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\57\141\x70\x69\57\x61\165\x74\x68\x2f\166\141\x6c\151\144\141\164\x65";
        $Ey = curl_init($P4);
        $wB = $this->defaultCustomerId;
        $EW = $this->defaultCustomerApiKey;
        $ny = round(microtime(TRUE) * 1000);
        $V6 = $wB . number_format($EP, 0, '', '') . $EW;
        $Q3 = hash("\x73\150\141\65\61\62", $V6);
        $hG = "\x43\x75\x73\164\x6f\x6d\145\162\x2d\113\x65\x79\x3a\x20" . $wB;
        $NF = "\x54\x69\x6d\145\x73\x74\141\x6d\160\72\40" . number_format($EP, 0, '', '');
        $hp = "\x41\165\164\150\x6f\162\151\x7a\x61\x74\x69\x6f\156\72\x20" . $Q3;
        $qS = array("\164\170\111\x64" => $AG, "\x74\157\153\145\156" => $this->otpToken);
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\x43\157\156\164\x65\156\164\55\124\x79\160\x65\72\40\141\x70\x70\154\151\143\141\164\151\157\156\x2f\x6a\163\x6f\x6e", $hG, $NF, $hp));
        curl_setopt($Ey, CURLOPT_POST, TRUE);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto pr;
        }
        $be = array("\x25\x6d\x65\164\150\x6f\x64" => "\x76\x61\154\151\144\141\x74\x65\117\164\x70", "\x25\146\x69\154\145" => "\143\165\x73\164\x6f\155\x65\x72\137\x73\145\x74\165\160\x2e\160\x68\x70", "\x25\145\162\162\157\x72" => curl_error($Ey));
        watchdog("\x6d\151\x6e\x69\157\x72\x61\x6e\147\145\137\x73\141\x6d\154", "\105\x72\x72\x6f\x72\x20\x61\164\x20\45\x6d\x65\x74\150\157\x64\x20\157\x66\x20\45\146\x69\x6c\x65\72\x20\x25\145\162\x72\x6f\162", $be);
        pr:
        curl_close($Ey);
        return $Ez;
    }
    function verifyLicense($yk)
    {
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\x61\163\57\x61\160\x69\x2f\x62\141\x63\x6b\x75\160\x63\x6f\144\145\x2f\166\x65\162\151\x66\171";
        $Ey = curl_init($P4);
        $wk = variable_get("\x6d\x69\x6e\151\157\x72\x61\x6e\147\145\137\x73\x61\155\x6c\x5f\143\x75\x73\164\157\155\145\x72\x5f\x69\144");
        $Zp = variable_get("\x6d\x69\156\x69\x6f\x72\141\x6e\x67\145\x5f\163\141\x6d\154\x5f\143\x75\163\164\157\155\x65\162\x5f\141\160\x69\x5f\153\x65\x79");
        global $base_url;
        $EP = round(microtime(TRUE) * 1000);
        $Qs = $wk . number_format($EP, 0, '', '') . $Zp;
        $TA = hash("\x73\150\x61\x35\x31\x32", $Qs);
        $dN = "\103\x75\x73\x74\157\x6d\x65\x72\x2d\x4b\x65\x79\72\40" . $wk;
        $QI = "\124\151\x6d\x65\x73\164\x61\x6d\x70\72\x20" . number_format($EP, 0, '', '');
        $ni = "\x41\x75\x74\x68\157\x72\151\172\x61\164\151\x6f\156\72\x20" . $TA;
        $qS = '';
        $qS = array("\x63\157\x64\x65" => $yk, "\143\x75\x73\164\x6f\x6d\145\x72\113\145\x79" => $wk, "\x61\x64\x64\151\164\151\157\x6e\x61\154\x46\151\145\154\x64\163" => array("\x66\151\x65\x6c\x64\61" => $base_url));
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, true);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\103\157\156\164\145\x6e\x74\55\124\x79\160\x65\x3a\40\x61\160\x70\x6c\x69\x63\141\x74\151\157\156\x2f\152\163\x6f\156", $dN, $QI, $ni));
        curl_setopt($Ey, CURLOPT_POST, true);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        curl_setopt($Ey, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Ey, CURLOPT_TIMEOUT, 20);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto cH;
        }
        echo "\x52\x65\x71\165\x65\163\164\40\x45\162\162\x6f\x72\x3a" . curl_error($Ey);
        exit;
        cH:
        curl_close($Ey);
        return $Ez;
    }
    function updateStatus()
    {
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\x2f\141\160\x69\x2f\142\x61\143\153\165\160\143\157\x64\x65\x2f\x75\160\x64\141\x74\145\x73\x74\141\164\x75\x73";
        $Ey = curl_init($P4);
        $wk = variable_get("\x6d\151\x6e\151\157\x72\x61\156\147\x65\x5f\x73\x61\x6d\x6c\x5f\143\x75\x73\164\x6f\155\x65\x72\x5f\151\x64");
        $Zp = variable_get("\x6d\x69\x6e\x69\x6f\x72\x61\x6e\147\x65\x5f\x73\x61\x6d\154\x5f\x63\x75\x73\164\x6f\155\x65\162\x5f\141\160\151\137\x6b\x65\171");
        $EP = round(microtime(TRUE) * 1000);
        $Qs = $wk . number_format($EP, 0, '', '') . $Zp;
        $TA = hash("\163\x68\x61\65\x31\x32", $Qs);
        $dN = "\x43\165\x73\164\157\x6d\x65\162\55\x4b\145\171\72\40" . $wk;
        $QI = "\x54\151\x6d\x65\x73\164\141\x6d\160\x3a\x20" . number_format($EP, 0, '', '');
        $ni = "\x41\x75\x74\150\x6f\162\x69\172\141\x74\151\157\156\72\40" . $TA;
        $aC = variable_get("\155\151\156\151\x6f\162\x61\x6e\x67\x65\x5f\x73\x61\155\x6c\x5f\x63\165\163\164\157\x6d\145\162\x5f\x61\144\x6d\x69\x6e\x5f\x74\157\x6b\x65\156");
        $yk = AESEncryption::decrypt_data(variable_get("\x6d\151\156\x69\x6f\162\x61\156\x67\x65\137\163\141\x6d\x6c\x5f\154\151\143\x65\x6e\163\145\137\153\x65\x79"), $aC);
        $qS = array("\143\x6f\x64\145" => $yk, "\x63\165\163\x74\157\155\x65\x72\x4b\145\x79" => $wk);
        $cW = json_encode($qS);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, true);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\x6e\164\55\124\171\160\x65\x3a\40\x61\x70\x70\154\151\143\141\164\151\x6f\x6e\x2f\x6a\163\157\x6e", $dN, $QI, $ni));
        curl_setopt($Ey, CURLOPT_POST, true);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        curl_setopt($Ey, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Ey, CURLOPT_TIMEOUT, 20);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto qd;
        }
        echo "\122\145\161\165\145\163\164\x20\x45\x72\162\x6f\162\x3a" . curl_error($Ey);
        exit;
        qd:
        curl_close($Ey);
        return $Ez;
    }
}
