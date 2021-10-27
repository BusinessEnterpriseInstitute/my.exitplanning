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
    public function __construct($hB, $LS, $el, $FX)
    {
        $this->email = $hB;
        $this->phone = $LS;
        $this->password = $el;
        $this->otpToken = $FX;
        $this->defaultCustomerId = "\61\x36\x35\x35\x35";
        $this->defaultCustomerApiKey = "\x66\106\x64\x32\130\x63\166\124\107\104\145\155\132\166\142\x77\x31\142\x63\125\x65\x73\116\x4a\127\x45\x71\x4b\x62\x62\125\161";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto ST;
        }
        return json_encode(array("\x73\164\141\164\165\163" => "\x43\125\122\x4c\137\x45\122\x52\117\122", "\163\x74\x61\164\165\163\x4d\x65\x73\163\141\x67\x65" => "\74\141\40\x68\162\x65\x66\x3d\42\150\x74\x74\160\x3a\57\x2f\160\x68\x70\56\156\x65\x74\x2f\155\x61\156\165\x61\x6c\57\145\x6e\x2f\x63\165\x72\x6c\x2e\151\156\163\x74\141\x6c\x6c\141\164\151\157\156\56\x70\x68\x70\42\76\120\110\120\x20\143\x55\x52\114\40\x65\x78\x74\x65\x6e\163\151\x6f\x6e\74\57\141\76\40\x69\x73\40\x6e\x6f\164\x20\151\156\x73\x74\141\154\154\x65\x64\40\157\x72\x20\144\x69\x73\x61\x62\x6c\145\x64\x2e"));
        ST:
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\x73\x2f\162\145\163\164\x2f\143\165\x73\164\157\x6d\x65\162\57\143\x68\145\143\153\55\151\x66\x2d\145\x78\151\x73\x74\x73";
        $xI = curl_init($z6);
        $hB = $this->email;
        $II = array("\145\x6d\x61\151\154" => $hB);
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($xI, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\x65\x6e\164\55\124\x79\x70\145\72\40\141\160\x70\154\151\x63\x61\x74\151\x6f\156\x2f\x6a\163\x6f\156", "\x63\x68\x61\162\163\x65\164\72\40\x55\x54\106\40\x2d\40\x38", "\101\165\164\x68\157\x72\151\172\141\x74\x69\157\156\72\x20\102\x61\x73\151\143"));
        curl_setopt($xI, CURLOPT_POST, TRUE);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto q_;
        }
        $X4 = array("\x25\x6d\x65\164\150\157\144" => "\x63\x68\x65\143\x6b\103\165\163\164\x6f\x6d\x65\162", "\45\146\151\x6c\145" => "\x63\x75\x73\x74\157\155\145\x72\137\163\x65\164\x75\160\56\x70\x68\x70", "\x25\145\162\x72\x6f\162" => curl_error($xI));
        watchdog("\155\x69\156\x69\x6f\x72\x61\x6e\147\x65\137\163\x61\x6d\154", "\105\162\162\157\x72\x20\141\164\40\45\155\x65\164\150\x6f\144\40\x6f\146\x20\x25\x66\151\154\145\x3a\x20\45\x65\162\x72\157\x72", $X4);
        q_:
        curl_close($xI);
        return $WD;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Wa;
        }
        return json_encode(array("\x73\164\141\164\165\163\103\x6f\x64\x65" => "\105\122\122\117\x52", "\163\164\141\164\165\163\x4d\145\x73\163\141\x67\x65" => "\56\x20\x50\x6c\145\x61\163\145\40\x63\x68\145\143\x6b\40\171\157\x75\162\40\x63\157\x6e\x66\151\x67\165\x72\x61\164\x69\157\156\x2e"));
        Wa:
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\141\x73\x2f\x72\145\163\164\57\143\165\x73\164\x6f\x6d\x65\162\57\x61\x64\144";
        $xI = curl_init($z6);
        $II = array("\x63\x6f\x6d\x70\x61\x6e\171\116\x61\155\145" => $_SERVER["\123\x45\122\x56\x45\x52\x5f\x4e\x41\115\x45"], "\x61\x72\145\141\117\x66\111\x6e\164\145\x72\x65\163\164" => "\104\x72\165\x70\141\154\40\123\x41\x4d\114\x20\x4d\x6f\144\165\x6c\145\x20\55\40\x50\162\x65\x6d\151\x75\x6d", "\145\155\141\151\x6c" => $this->email, "\160\150\x6f\x6e\145" => $this->phone, "\160\x61\163\163\167\x6f\162\144" => $this->password);
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($xI, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\156\x74\x2d\124\171\160\145\x3a\40\x61\x70\x70\x6c\151\x63\x61\x74\151\x6f\x6e\57\152\163\157\156", "\x63\150\141\x72\x73\145\164\72\40\x55\124\x46\40\x2d\x20\x38", "\101\165\x74\150\x6f\x72\x69\172\141\164\151\157\156\72\40\x42\x61\x73\x69\x63"));
        curl_setopt($xI, CURLOPT_POST, TRUE);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto Kq;
        }
        $X4 = array("\x25\x6d\145\164\150\x6f\x64" => "\143\162\145\x61\x74\x65\103\x75\x73\164\x6f\x6d\x65\162", "\45\x66\151\154\x65" => "\143\165\163\x74\x6f\x6d\145\x72\137\163\145\x74\165\x70\56\160\150\160", "\45\145\x72\x72\x6f\162" => curl_error($xI));
        watchdog("\x6d\x69\156\x69\157\x72\x61\156\147\x65\137\163\x61\155\x6c", "\105\162\162\157\162\40\x61\164\x20\45\x6d\x65\x74\150\157\144\x20\157\x66\x20\45\x66\151\x6c\x65\72\40\x25\145\162\162\x6f\x72", $X4);
        Kq:
        curl_close($xI);
        return $WD;
    }
    function ccl()
    {
        global $base_url;
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\155\x6f\x61\x73\57\162\x65\163\x74\x2f\143\165\x73\x74\x6f\155\145\162\x2f\x6c\151\x63\x65\x6e\163\145";
        $xI = curl_init($z6);
        $Ff = variable_get("\x6d\x69\156\x69\x6f\x72\x61\156\x67\x65\x5f\163\x61\x6d\154\137\x63\x75\x73\x74\157\155\x65\162\x5f\x69\x64", '');
        $Vk = variable_get("\x6d\151\156\x69\157\x72\x61\156\147\x65\137\163\141\x6d\x6c\137\x63\x75\x73\164\x6f\155\145\162\x5f\141\160\x69\x5f\x6b\145\171", '');
        $ct = round(microtime(true) * 1000);
        $mC = $Ff . number_format($ct, 0, '', '') . $Vk;
        $CH = hash("\x73\x68\x61\x35\61\x32", $mC);
        $hW = "\103\x75\163\164\157\155\x65\162\x2d\113\145\x79\x3a\x20" . $Ff;
        $mQ = "\124\151\155\x65\163\164\141\x6d\x70\72\x20" . number_format($ct, 0, '', '');
        $Ca = "\x41\x75\x74\x68\157\162\x69\x7a\141\164\151\x6f\x6e\x3a\x20" . $CH;
        $II = '';
        $II = array("\x63\165\x73\164\x6f\x6d\145\x72\x49\144" => $Ff, "\x61\x70\160\x6c\151\x63\x61\x74\151\x6f\156\116\141\x6d\x65" => "\x64\x72\x75\x70\141\x6c\x5f\155\151\x6e\151\157\x72\141\x6e\147\145\137\x73\141\x6d\154\x5f\145\x6e\x74\x65\162\x70\x72\151\163\145\x5f\x70\x6c\141\x6e");
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($xI, CURLOPT_AUTOREFERER, true);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\145\156\164\x2d\124\x79\x70\145\72\40\141\x70\160\154\x69\x63\141\x74\151\x6f\x6e\57\x6a\x73\157\156", $hW, $mQ, $Ca));
        curl_setopt($xI, CURLOPT_POST, true);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        curl_setopt($xI, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($xI, CURLOPT_TIMEOUT, 20);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto RR;
        }
        return null;
        RR:
        curl_close($xI);
        return $WD;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto hO;
        }
        return json_encode(array("\x61\x70\x69\113\x65\x79" => "\x43\125\x52\114\137\105\122\x52\x4f\x52", "\164\x6f\x6b\145\156" => "\74\141\x20\x68\x72\145\146\x3d\x22\x68\164\x74\x70\x3a\57\x2f\160\150\x70\56\156\x65\x74\x2f\x6d\141\156\x75\141\154\57\x65\x6e\x2f\143\165\162\x6c\x2e\x69\156\163\x74\141\x6c\x6c\141\164\x69\157\x6e\x2e\x70\150\x70\x22\76\120\x48\120\x20\143\125\x52\114\x20\145\x78\164\145\x6e\x73\x69\157\x6e\x3c\x2f\x61\x3e\40\x69\x73\40\x6e\x6f\164\x20\151\x6e\x73\164\141\154\x6c\145\x64\x20\x6f\x72\40\144\151\x73\x61\x62\x6c\x65\144\x2e"));
        hO:
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\x2f\162\x65\163\164\57\143\165\163\x74\157\x6d\145\x72\x2f\x6b\145\x79";
        $xI = curl_init($z6);
        $hB = $this->email;
        $el = $this->password;
        $II = array("\x65\155\141\x69\x6c" => $hB, "\160\141\163\x73\167\157\162\144" => $el);
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($xI, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\x65\156\164\55\x54\x79\160\145\72\x20\x61\x70\x70\154\151\x63\x61\x74\151\x6f\156\x2f\x6a\163\x6f\156", "\143\x68\x61\162\x73\145\x74\x3a\40\125\x54\x46\40\x2d\40\70", "\x41\x75\164\150\x6f\162\x69\172\141\164\151\157\156\72\40\x42\141\163\x69\x63"));
        curl_setopt($xI, CURLOPT_POST, TRUE);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto Wh;
        }
        $X4 = array("\x25\x6d\145\x74\150\x6f\144" => "\147\145\x74\x43\165\x73\x74\x6f\155\x65\162\113\x65\x79\163", "\45\146\151\x6c\x65" => "\143\165\163\x74\x6f\x6d\x65\162\x5f\163\145\x74\165\160\x2e\160\x68\160", "\x25\145\x72\x72\157\x72" => curl_error($xI));
        watchdog("\155\151\x6e\x69\x6f\162\141\156\x67\x65\x5f\x73\x61\x6d\x6c", "\105\162\162\x6f\162\40\141\164\x20\x25\155\x65\164\x68\157\144\40\157\146\x20\45\x66\151\154\x65\x3a\40\45\x65\162\x72\157\x72", $X4);
        Wh:
        curl_close($xI);
        return $WD;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto nX;
        }
        return json_encode(array("\163\164\x61\x74\x75\x73" => "\x43\125\x52\x4c\x5f\105\x52\x52\x4f\x52", "\x73\164\x61\x74\x75\x73\115\145\x73\x73\141\147\145" => "\x3c\141\40\150\x72\x65\x66\x3d\42\x68\164\164\160\72\57\57\x70\x68\x70\x2e\156\x65\164\57\155\x61\156\165\x61\154\x2f\145\x6e\57\x63\165\162\154\56\x69\x6e\x73\x74\x61\x6c\154\x61\164\151\157\x6e\x2e\x70\x68\160\x22\x3e\x50\110\x50\40\143\125\x52\x4c\x20\x65\170\x74\145\156\x73\x69\157\156\74\57\x61\x3e\x20\151\x73\40\156\157\x74\40\x69\x6e\x73\x74\141\154\x6c\x65\x64\40\157\x72\40\x64\151\x73\x61\142\154\145\144\x2e"));
        nX:
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\155\x6f\x61\163\x2f\x61\x70\151\x2f\141\165\x74\x68\57\x63\150\141\154\x6c\x65\156\147\145";
        $xI = curl_init($z6);
        $hn = $this->defaultCustomerId;
        $DE = $this->defaultCustomerApiKey;
        $KG = variable_get("\155\x69\156\151\157\162\141\156\x67\145\137\163\x61\155\x6c\137\143\x75\x73\164\157\155\x65\x72\137\141\x64\x6d\151\x6e\137\x65\x6d\141\x69\154", NULL);
        $Ni = round(microtime(TRUE) * 1000);
        $Wt = $hn . number_format($ct, 0, '', '') . $DE;
        $d6 = hash("\x73\150\141\x35\x31\62", $Wt);
        $tX = "\103\x75\x73\x74\157\x6d\x65\162\55\113\x65\171\x3a\40" . $hn;
        $LO = "\124\151\155\x65\163\164\141\155\x70\x3a\40" . number_format($ct, 0, '', '');
        $sn = "\x41\165\x74\150\157\162\x69\172\141\164\x69\157\156\x3a\40" . $d6;
        $II = array("\143\x75\x73\x74\157\155\145\162\x4b\x65\x79" => $hn, "\145\x6d\x61\151\154" => $KG, "\x61\165\x74\150\x54\x79\x70\145" => "\x45\x4d\101\x49\114");
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($xI, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\145\156\164\55\124\x79\160\145\72\x20\x61\160\160\x6c\151\x63\141\164\x69\157\156\x2f\x6a\163\x6f\156", $tX, $LO, $sn));
        curl_setopt($xI, CURLOPT_POST, TRUE);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto QD;
        }
        $X4 = array("\x25\155\145\x74\x68\157\144" => "\163\145\x6e\x64\117\164\160", "\45\x66\x69\x6c\x65" => "\143\165\163\x74\x6f\x6d\x65\162\137\x73\x65\x74\165\160\x2e\x70\x68\x70", "\x25\145\162\x72\157\x72" => curl_error($xI));
        watchdog("\x6d\x69\x6e\151\x6f\162\x61\x6e\x67\x65\x5f\163\x61\155\154", "\x45\162\x72\x6f\162\x20\141\x74\40\45\x6d\x65\164\x68\x6f\x64\x20\157\x66\x20\45\146\x69\x6c\x65\x3a\40\x25\x65\x72\x72\157\x72", $X4);
        QD:
        curl_close($xI);
        return $WD;
    }
    public function validateOtp($i7)
    {
        if (Utilities::isCurlInstalled()) {
            goto U8;
        }
        return json_encode(array("\x73\x74\141\x74\165\x73" => "\103\x55\x52\x4c\137\x45\122\x52\x4f\122", "\163\x74\x61\x74\x75\163\115\x65\x73\x73\x61\x67\145" => "\x3c\x61\40\x68\x72\145\x66\x3d\42\150\x74\164\x70\72\57\57\x70\150\160\56\x6e\x65\164\57\155\141\x6e\165\x61\x6c\x2f\x65\156\57\143\x75\x72\x6c\x2e\x69\156\163\x74\x61\154\154\x61\x74\x69\157\x6e\x2e\160\x68\x70\x22\x3e\120\110\x50\x20\x63\x55\122\114\x20\x65\170\164\x65\156\163\151\x6f\x6e\x3c\x2f\141\x3e\x20\x69\163\x20\156\x6f\x74\40\x69\x6e\163\x74\141\154\154\x65\144\40\x6f\x72\40\144\151\x73\x61\142\x6c\x65\144\56"));
        U8:
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\x2f\141\x70\x69\57\x61\165\x74\150\x2f\x76\x61\x6c\151\x64\141\164\145";
        $xI = curl_init($z6);
        $hn = $this->defaultCustomerId;
        $DE = $this->defaultCustomerApiKey;
        $Ni = round(microtime(TRUE) * 1000);
        $Wt = $hn . number_format($ct, 0, '', '') . $DE;
        $d6 = hash("\x73\x68\141\65\61\x32", $Wt);
        $tX = "\103\165\x73\164\x6f\155\145\162\x2d\113\145\x79\x3a\x20" . $hn;
        $LO = "\x54\151\x6d\145\163\x74\141\155\x70\72\x20" . number_format($ct, 0, '', '');
        $sn = "\x41\165\x74\150\x6f\162\151\172\141\x74\x69\157\x6e\x3a\x20" . $d6;
        $II = array("\164\170\111\144" => $i7, "\x74\157\153\145\x6e" => $this->otpToken);
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($xI, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\145\x6e\x74\x2d\124\x79\x70\x65\72\40\141\x70\160\x6c\151\143\141\x74\151\157\156\x2f\152\x73\x6f\x6e", $tX, $LO, $sn));
        curl_setopt($xI, CURLOPT_POST, TRUE);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto TQ;
        }
        $X4 = array("\45\x6d\145\x74\x68\157\144" => "\x76\141\154\151\x64\141\164\x65\x4f\x74\160", "\45\x66\x69\154\x65" => "\x63\165\x73\x74\157\155\145\x72\137\x73\x65\164\x75\160\56\160\x68\160", "\x25\145\162\162\157\162" => curl_error($xI));
        watchdog("\x6d\x69\156\x69\157\x72\141\x6e\147\145\137\x73\141\x6d\154", "\105\x72\x72\x6f\162\40\x61\x74\x20\x25\155\x65\164\x68\157\x64\40\157\x66\x20\x25\146\x69\154\x65\72\x20\x25\x65\x72\162\x6f\162", $X4);
        TQ:
        curl_close($xI);
        return $WD;
    }
    function verifyLicense($GL)
    {
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\x61\163\x2f\x61\160\x69\57\142\x61\143\x6b\x75\160\143\x6f\144\145\57\x76\x65\162\151\x66\x79";
        $xI = curl_init($z6);
        $Ff = variable_get("\155\x69\x6e\151\157\162\x61\x6e\147\x65\x5f\163\x61\x6d\154\137\x63\x75\163\x74\x6f\x6d\145\x72\137\x69\144");
        $Vk = variable_get("\x6d\151\156\x69\x6f\162\x61\156\147\145\x5f\163\141\155\x6c\x5f\143\165\x73\164\157\x6d\x65\x72\137\x61\160\151\137\x6b\145\x79");
        global $base_url;
        $ct = round(microtime(TRUE) * 1000);
        $mC = $Ff . number_format($ct, 0, '', '') . $Vk;
        $CH = hash("\x73\x68\x61\x35\61\62", $mC);
        $hW = "\103\165\163\164\157\155\x65\x72\x2d\113\145\x79\72\40" . $Ff;
        $mQ = "\124\x69\x6d\x65\x73\164\141\155\160\x3a\40" . number_format($ct, 0, '', '');
        $Ca = "\101\x75\x74\150\x6f\x72\151\x7a\141\164\x69\x6f\156\72\40" . $CH;
        $II = '';
        $II = array("\x63\157\x64\x65" => $GL, "\x63\x75\163\164\157\x6d\145\162\113\x65\171" => $Ff, "\141\144\x64\x69\x74\x69\x6f\156\x61\x6c\106\151\145\154\144\163" => array("\146\x69\145\x6c\144\x31" => $base_url));
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($xI, CURLOPT_AUTOREFERER, true);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\x43\157\156\x74\x65\x6e\x74\x2d\124\171\x70\x65\x3a\40\141\x70\160\154\151\143\x61\x74\151\x6f\156\x2f\x6a\163\x6f\x6e", $hW, $mQ, $Ca));
        curl_setopt($xI, CURLOPT_POST, true);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        curl_setopt($xI, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($xI, CURLOPT_TIMEOUT, 20);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto pk;
        }
        echo "\122\x65\161\x75\145\163\164\x20\x45\x72\162\x6f\x72\72" . curl_error($xI);
        exit;
        pk:
        curl_close($xI);
        return $WD;
    }
    function updateStatus()
    {
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\163\57\x61\x70\x69\x2f\x62\141\143\x6b\x75\160\143\x6f\x64\145\x2f\x75\x70\x64\141\164\x65\163\164\x61\x74\165\x73";
        $xI = curl_init($z6);
        $Ff = variable_get("\155\x69\156\x69\x6f\x72\x61\156\x67\145\x5f\163\141\155\x6c\137\x63\165\x73\x74\x6f\x6d\x65\162\137\151\x64");
        $Vk = variable_get("\155\151\x6e\x69\157\x72\x61\x6e\147\x65\137\163\x61\x6d\154\x5f\143\x75\163\164\x6f\x6d\145\x72\137\141\160\x69\x5f\153\x65\x79");
        $ct = round(microtime(TRUE) * 1000);
        $mC = $Ff . number_format($ct, 0, '', '') . $Vk;
        $CH = hash("\163\x68\141\65\61\62", $mC);
        $hW = "\x43\x75\163\x74\157\155\145\x72\55\113\x65\x79\72\x20" . $Ff;
        $mQ = "\124\151\155\x65\x73\164\x61\155\x70\72\x20" . number_format($ct, 0, '', '');
        $Ca = "\101\x75\164\150\157\162\151\x7a\x61\x74\x69\157\x6e\72\x20" . $CH;
        $nL = variable_get("\155\151\156\x69\157\x72\141\156\x67\x65\137\163\141\x6d\154\137\x63\165\x73\x74\x6f\x6d\x65\x72\137\141\x64\x6d\x69\156\137\x74\x6f\153\x65\156");
        $GL = AESEncryption::decrypt_data(variable_get("\155\x69\x6e\151\157\x72\x61\x6e\x67\145\137\x73\141\155\x6c\137\x6c\151\x63\145\x6e\163\145\x5f\153\145\x79"), $nL);
        $II = array("\143\157\x64\x65" => $GL, "\143\x75\163\164\157\155\145\x72\113\x65\171" => $Ff);
        $VE = json_encode($II);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($xI, CURLOPT_AUTOREFERER, true);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\x6e\164\55\x54\x79\x70\145\x3a\40\141\160\x70\x6c\x69\143\141\x74\151\157\x6e\57\x6a\163\x6f\x6e", $hW, $mQ, $Ca));
        curl_setopt($xI, CURLOPT_POST, true);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        curl_setopt($xI, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($xI, CURLOPT_TIMEOUT, 20);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto Uz;
        }
        echo "\x52\145\161\x75\x65\163\x74\40\x45\x72\x72\157\x72\x3a" . curl_error($xI);
        exit;
        Uz:
        curl_close($xI);
        return $WD;
    }
}
