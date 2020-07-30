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
    public function __construct($XI, $G9, $j2, $b7)
    {
        $this->email = $XI;
        $this->phone = $G9;
        $this->password = $j2;
        $this->otpToken = $b7;
        $this->defaultCustomerId = "\61\x36\x35\x35\x35";
        $this->defaultCustomerApiKey = "\146\x46\144\62\130\x63\166\x54\x47\x44\145\155\x5a\166\x62\167\61\142\x63\x55\145\x73\x4e\x4a\127\x45\x71\x4b\142\x62\125\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Vc;
        }
        return json_encode(array("\x73\164\141\164\165\163" => "\x43\x55\122\114\137\x45\x52\x52\x4f\x52", "\163\x74\x61\164\165\163\115\x65\x73\x73\141\x67\x65" => "\74\x61\x20\x68\x72\x65\146\x3d\42\x68\164\x74\x70\x3a\57\57\x70\150\160\x2e\156\x65\164\x2f\x6d\141\x6e\x75\x61\154\57\145\156\57\143\165\x72\x6c\x2e\x69\x6e\163\164\x61\154\154\141\x74\151\157\x6e\56\160\x68\160\42\x3e\120\x48\120\x20\x63\125\122\114\40\x65\x78\x74\145\x6e\x73\151\157\x6e\74\57\141\76\x20\151\163\x20\x6e\x6f\x74\x20\x69\156\x73\x74\141\154\x6c\x65\144\x20\157\x72\x20\144\x69\x73\141\142\154\145\144\x2e"));
        Vc:
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\141\x73\57\162\145\x73\x74\57\x63\x75\163\164\157\155\145\162\57\143\150\x65\x63\x6b\55\x69\146\55\x65\x78\x69\x73\164\163";
        $hV = curl_init($Pk);
        $XI = $this->email;
        $i5 = array("\145\155\x61\151\x6c" => $XI);
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($hV, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\x65\156\x74\x2d\x54\x79\160\145\72\x20\141\160\160\154\151\x63\141\x74\151\x6f\x6e\57\x6a\163\x6f\156", "\143\150\141\x72\163\145\x74\72\x20\125\124\106\40\x2d\x20\x38", "\101\165\164\x68\x6f\x72\x69\x7a\141\164\151\x6f\156\x3a\x20\x42\x61\163\x69\143"));
        curl_setopt($hV, CURLOPT_POST, TRUE);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto Ir;
        }
        $gn = array("\45\x6d\x65\x74\150\x6f\144" => "\143\150\145\143\x6b\x43\165\163\x74\x6f\x6d\x65\162", "\45\x66\x69\154\145" => "\143\165\x73\x74\x6f\x6d\x65\162\137\163\145\164\x75\x70\x2e\x70\x68\160", "\x25\x65\x72\162\x6f\162" => curl_error($hV));
        watchdog("\x6d\x69\156\151\157\x72\141\x6e\x67\x65\x5f\163\x61\155\x6c", "\x45\162\162\x6f\162\x20\x61\164\40\x25\x6d\x65\x74\150\x6f\x64\40\x6f\x66\x20\45\146\151\154\145\x3a\40\45\145\x72\162\x6f\162", $gn);
        Ir:
        curl_close($hV);
        return $ej;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto GE;
        }
        return json_encode(array("\163\164\141\x74\165\163\x43\x6f\144\145" => "\105\x52\122\117\122", "\163\x74\x61\164\x75\163\x4d\145\x73\163\141\147\x65" => "\56\40\120\x6c\x65\141\x73\145\x20\x63\x68\145\143\153\x20\x79\157\x75\x72\40\143\157\156\146\151\147\165\162\x61\164\x69\157\x6e\56"));
        GE:
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\x2f\x72\145\163\164\57\143\165\163\164\x6f\155\x65\x72\x2f\141\144\144";
        $hV = curl_init($Pk);
        $i5 = array("\x63\157\155\160\141\x6e\x79\116\141\x6d\x65" => $_SERVER["\x53\105\122\x56\x45\x52\137\x4e\101\115\105"], "\x61\x72\145\x61\117\146\x49\x6e\164\145\x72\x65\x73\x74" => "\104\x72\165\x70\141\154\40\x53\101\x4d\x4c\40\x50\x6c\x75\x67\151\x6e\x20\55\40\x50\162\x65\155\151\x75\155", "\x65\155\x61\151\154" => $this->email, "\160\x68\157\x6e\145" => $this->phone, "\160\141\x73\x73\x77\157\x72\x64" => $this->password);
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($hV, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\x6e\x74\55\x54\171\x70\145\72\40\141\160\x70\x6c\x69\x63\141\164\x69\157\156\x2f\x6a\163\157\x6e", "\x63\x68\141\x72\163\145\164\x3a\x20\125\124\106\40\55\40\x38", "\x41\165\164\150\x6f\x72\x69\172\141\164\x69\x6f\x6e\72\x20\x42\141\x73\x69\x63"));
        curl_setopt($hV, CURLOPT_POST, TRUE);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto UN;
        }
        $gn = array("\x25\x6d\145\x74\x68\157\144" => "\x63\162\x65\141\164\x65\x43\x75\x73\x74\x6f\155\145\x72", "\x25\x66\x69\x6c\145" => "\x63\x75\163\x74\157\155\145\162\x5f\x73\145\164\x75\160\56\x70\150\160", "\x25\145\162\162\157\162" => curl_error($hV));
        watchdog("\155\151\156\x69\157\162\x61\x6e\147\x65\137\163\x61\155\x6c", "\x45\162\162\x6f\162\x20\141\x74\x20\45\155\x65\x74\150\157\x64\x20\x6f\146\40\45\146\x69\154\145\72\40\x25\145\x72\162\x6f\162", $gn);
        UN:
        curl_close($hV);
        return $ej;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto zz;
        }
        return json_encode(array("\x61\160\x69\113\x65\171" => "\x43\x55\x52\x4c\x5f\105\122\x52\117\122", "\164\157\x6b\x65\156" => "\74\x61\40\x68\x72\145\x66\75\x22\x68\x74\164\160\72\57\x2f\160\150\x70\x2e\156\x65\164\57\155\141\156\165\141\x6c\x2f\x65\156\x2f\x63\x75\x72\x6c\x2e\151\156\163\x74\141\154\x6c\141\x74\x69\157\156\x2e\160\x68\160\x22\x3e\120\x48\120\40\x63\x55\x52\114\x20\x65\170\x74\x65\156\x73\x69\x6f\x6e\74\x2f\x61\x3e\x20\151\163\x20\x6e\x6f\164\40\151\x6e\x73\x74\x61\x6c\154\145\144\40\x6f\x72\40\x64\x69\x73\141\x62\154\145\144\56"));
        zz:
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\163\57\x72\x65\163\x74\57\x63\165\x73\x74\x6f\x6d\x65\162\57\x6b\145\171";
        $hV = curl_init($Pk);
        $XI = $this->email;
        $j2 = $this->password;
        $i5 = array("\x65\x6d\141\151\154" => $XI, "\160\x61\x73\x73\167\x6f\x72\x64" => $j2);
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($hV, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\x65\156\164\55\124\171\160\x65\72\40\141\x70\160\154\151\x63\141\x74\151\157\x6e\x2f\152\x73\157\156", "\x63\150\x61\162\163\x65\164\x3a\x20\x55\x54\x46\x20\55\40\x38", "\101\165\164\x68\157\162\x69\172\x61\164\x69\x6f\x6e\72\x20\102\x61\x73\151\x63"));
        curl_setopt($hV, CURLOPT_POST, TRUE);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto gM;
        }
        $gn = array("\x25\x6d\x65\164\x68\x6f\x64" => "\147\x65\164\x43\x75\163\164\157\155\145\162\113\145\x79\x73", "\x25\146\151\x6c\145" => "\143\165\163\x74\x6f\155\x65\162\x5f\163\x65\164\165\160\x2e\160\x68\160", "\x25\145\x72\162\157\162" => curl_error($hV));
        watchdog("\155\151\156\x69\157\x72\141\x6e\x67\145\x5f\x73\x61\x6d\154", "\x45\x72\x72\157\x72\40\141\164\40\x25\155\x65\164\x68\157\x64\40\157\x66\40\x25\x66\151\154\x65\72\40\45\x65\x72\162\x6f\x72", $gn);
        gM:
        curl_close($hV);
        return $ej;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto DI;
        }
        return json_encode(array("\x73\164\141\164\x75\163" => "\x43\125\122\114\x5f\105\122\122\117\122", "\163\164\x61\164\x75\x73\115\x65\163\x73\x61\x67\145" => "\x3c\141\x20\x68\162\x65\146\75\x22\150\164\164\160\72\x2f\x2f\x70\150\160\56\x6e\145\164\x2f\x6d\x61\x6e\x75\141\x6c\x2f\145\x6e\57\143\165\x72\x6c\x2e\151\156\163\164\141\x6c\154\141\x74\151\x6f\x6e\x2e\x70\150\x70\x22\76\120\x48\120\x20\143\x55\x52\x4c\40\x65\x78\164\145\156\163\x69\157\x6e\74\x2f\141\x3e\40\x69\163\x20\156\157\x74\40\151\156\163\164\141\154\x6c\x65\x64\x20\x6f\162\x20\144\x69\163\x61\142\154\145\144\x2e"));
        DI:
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\x61\x73\x2f\x61\160\x69\57\141\165\164\x68\57\x63\150\141\154\x6c\145\156\147\145";
        $hV = curl_init($Pk);
        $L9 = $this->defaultCustomerId;
        $WF = $this->defaultCustomerApiKey;
        $tn = variable_get("\155\x69\156\x69\x6f\162\141\156\147\x65\x5f\x73\141\155\154\137\143\165\x73\x74\157\x6d\145\162\137\x61\144\x6d\x69\x6e\x5f\145\155\141\151\154", NULL);
        $aK = round(microtime(TRUE) * 1000);
        $Im = $L9 . number_format($aK, 0, '', '') . $WF;
        $by = hash("\163\x68\141\x35\61\x32", $Im);
        $XZ = "\103\165\x73\x74\157\x6d\145\x72\55\113\x65\171\x3a\40" . $L9;
        $hL = "\124\x69\155\145\x73\164\141\155\x70\72\40" . number_format($aK, 0, '', '');
        $Q3 = "\101\165\x74\150\157\162\x69\x7a\141\164\151\157\156\x3a\x20" . $by;
        $i5 = array("\143\165\x73\x74\x6f\155\145\162\113\145\171" => $L9, "\145\155\x61\151\154" => $tn, "\x61\x75\164\150\x54\x79\160\x65" => "\x45\115\101\111\114");
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($hV, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\156\x74\x2d\124\x79\160\x65\x3a\40\x61\160\x70\154\x69\x63\141\x74\151\x6f\156\57\152\163\x6f\156", $XZ, $hL, $Q3));
        curl_setopt($hV, CURLOPT_POST, TRUE);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto Aq;
        }
        $gn = array("\45\155\x65\x74\150\x6f\144" => "\x73\x65\x6e\x64\x4f\x74\160", "\45\x66\x69\154\145" => "\143\x75\163\164\157\x6d\145\162\137\x73\145\x74\165\x70\56\160\x68\x70", "\45\x65\x72\162\x6f\x72" => curl_error($hV));
        watchdog("\x6d\151\x6e\151\157\162\141\156\147\145\x5f\x73\141\155\154", "\105\162\162\x6f\x72\x20\141\x74\40\x25\x6d\x65\164\150\157\x64\x20\157\146\x20\45\x66\151\x6c\x65\x3a\40\45\x65\162\x72\157\x72", $gn);
        Aq:
        curl_close($hV);
        return $ej;
    }
    public function validateOtp($ob)
    {
        if (Utilities::isCurlInstalled()) {
            goto jE;
        }
        return json_encode(array("\163\164\x61\164\x75\163" => "\x43\x55\122\x4c\x5f\105\122\122\x4f\122", "\x73\164\x61\x74\165\x73\115\x65\x73\x73\x61\x67\x65" => "\x3c\141\x20\150\162\x65\x66\x3d\42\150\x74\x74\x70\x3a\x2f\x2f\160\x68\160\x2e\x6e\x65\x74\57\x6d\x61\x6e\x75\x61\154\57\x65\156\x2f\143\165\162\154\x2e\151\156\163\164\141\x6c\x6c\x61\164\x69\157\156\x2e\x70\150\160\42\76\x50\110\x50\40\x63\x55\x52\x4c\x20\145\x78\x74\145\156\163\x69\x6f\156\x3c\x2f\141\x3e\40\x69\x73\x20\x6e\157\x74\40\x69\156\x73\x74\x61\x6c\154\145\144\x20\x6f\x72\40\144\x69\x73\x61\142\x6c\x65\144\x2e"));
        jE:
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\163\57\x61\160\x69\x2f\x61\165\x74\x68\57\166\x61\x6c\151\x64\141\164\145";
        $hV = curl_init($Pk);
        $L9 = $this->defaultCustomerId;
        $WF = $this->defaultCustomerApiKey;
        $aK = round(microtime(TRUE) * 1000);
        $Im = $L9 . number_format($aK, 0, '', '') . $WF;
        $by = hash("\163\x68\x61\65\61\62", $Im);
        $XZ = "\103\x75\163\x74\157\155\x65\x72\55\113\x65\x79\x3a\x20" . $L9;
        $hL = "\x54\151\155\x65\x73\164\141\x6d\160\x3a\40" . number_format($aK, 0, '', '');
        $Q3 = "\x41\x75\164\150\157\x72\151\172\141\x74\151\x6f\156\72\40" . $by;
        $i5 = array("\x74\x78\x49\144" => $ob, "\x74\157\153\x65\156" => $this->otpToken);
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($hV, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\x65\156\x74\x2d\124\171\x70\x65\x3a\40\x61\160\x70\154\x69\143\x61\164\151\157\156\x2f\x6a\163\157\156", $XZ, $hL, $Q3));
        curl_setopt($hV, CURLOPT_POST, TRUE);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto nx;
        }
        $gn = array("\x25\x6d\145\x74\x68\157\x64" => "\166\x61\x6c\x69\x64\x61\164\145\117\164\x70", "\45\146\x69\154\145" => "\143\165\163\x74\x6f\x6d\145\162\x5f\x73\x65\x74\x75\x70\x2e\x70\150\160", "\45\145\162\x72\x6f\162" => curl_error($hV));
        watchdog("\x6d\x69\156\151\x6f\162\141\x6e\147\x65\x5f\x73\x61\155\154", "\x45\162\162\157\162\40\x61\164\40\45\x6d\145\x74\x68\157\144\40\157\x66\40\x25\x66\x69\x6c\x65\x3a\40\x25\x65\162\x72\x6f\x72", $gn);
        nx:
        curl_close($hV);
        return $ej;
    }
    function verifyLicense($xU)
    {
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\141\163\x2f\141\160\x69\x2f\x62\141\143\153\x75\160\x63\x6f\x64\145\x2f\x76\x65\162\151\x66\x79";
        $hV = curl_init($Pk);
        $zo = variable_get("\x6d\151\156\151\157\162\141\156\x67\145\x5f\x73\x61\x6d\x6c\137\143\165\163\x74\x6f\155\x65\162\x5f\151\x64");
        $dA = variable_get("\155\151\156\x69\x6f\162\x61\156\147\x65\137\x73\x61\x6d\x6c\137\143\165\163\x74\x6f\x6d\x65\162\137\141\x70\x69\137\153\145\171");
        global $base_url;
        $aK = round(microtime(TRUE) * 1000);
        $ym = $zo . number_format($aK, 0, '', '') . $dA;
        $tj = hash("\163\x68\x61\65\61\62", $ym);
        $Hy = "\x43\165\163\164\157\x6d\x65\162\x2d\x4b\145\171\72\x20" . $zo;
        $J3 = "\x54\x69\155\145\x73\x74\x61\155\x70\x3a\x20" . number_format($aK, 0, '', '');
        $dM = "\x41\x75\x74\150\x6f\x72\151\172\x61\164\151\x6f\156\72\x20" . $tj;
        $i5 = '';
        $i5 = array("\143\x6f\144\145" => $xU, "\143\x75\x73\x74\157\155\x65\x72\113\x65\x79" => $zo, "\141\144\x64\151\164\151\x6f\x6e\141\154\x46\x69\145\x6c\144\x73" => array("\146\x69\145\154\144\61" => $base_url));
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($hV, CURLOPT_AUTOREFERER, true);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\x6e\164\x2d\x54\171\160\145\x3a\x20\x61\x70\x70\154\x69\x63\x61\x74\151\157\156\x2f\152\163\157\x6e", $Hy, $J3, $dM));
        curl_setopt($hV, CURLOPT_POST, true);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        curl_setopt($hV, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($hV, CURLOPT_TIMEOUT, 20);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto Rp;
        }
        echo "\122\x65\161\165\x65\x73\164\40\105\x72\x72\x6f\x72\72" . curl_error($hV);
        die;
        Rp:
        curl_close($hV);
        return $ej;
    }
    function updateStatus()
    {
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\x2f\141\160\151\57\142\x61\x63\153\165\x70\x63\x6f\x64\145\x2f\x75\160\144\x61\164\145\163\164\x61\x74\x75\x73";
        $hV = curl_init($Pk);
        $zo = variable_get("\155\x69\x6e\151\x6f\x72\x61\156\x67\x65\137\163\141\155\x6c\x5f\143\x75\x73\x74\157\x6d\145\x72\x5f\x69\144");
        $dA = variable_get("\x6d\151\x6e\151\157\162\141\x6e\x67\x65\x5f\x73\x61\155\154\x5f\143\165\x73\164\x6f\x6d\145\x72\x5f\x61\160\x69\137\153\145\x79");
        $aK = round(microtime(TRUE) * 1000);
        $ym = $zo . number_format($aK, 0, '', '') . $dA;
        $tj = hash("\x73\150\x61\65\x31\x32", $ym);
        $Hy = "\x43\x75\163\x74\x6f\x6d\x65\x72\x2d\113\x65\x79\72\x20" . $zo;
        $J3 = "\x54\x69\155\145\x73\164\141\x6d\x70\72\40" . number_format($aK, 0, '', '');
        $dM = "\x41\x75\164\x68\157\162\151\172\x61\164\151\x6f\x6e\x3a\x20" . $tj;
        $qT = variable_get("\155\x69\156\x69\157\162\x61\156\147\145\137\163\141\155\154\x5f\x63\165\x73\164\x6f\x6d\145\x72\x5f\x61\144\155\x69\x6e\x5f\164\157\153\x65\156");
        $xU = AESEncryption::decrypt_data(variable_get("\155\151\x6e\x69\157\x72\141\156\147\x65\137\163\x61\x6d\x6c\137\x6c\x69\x63\x65\x6e\163\145\137\153\145\171"), $qT);
        $i5 = array("\x63\157\x64\x65" => $xU, "\x63\165\x73\x74\x6f\x6d\x65\162\113\x65\x79" => $zo);
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($hV, CURLOPT_AUTOREFERER, true);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\157\156\x74\x65\156\164\x2d\124\171\160\x65\72\40\x61\x70\x70\x6c\x69\x63\141\x74\151\157\x6e\x2f\x6a\163\x6f\156", $Hy, $J3, $dM));
        curl_setopt($hV, CURLOPT_POST, true);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        curl_setopt($hV, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($hV, CURLOPT_TIMEOUT, 20);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto ut;
        }
        echo "\122\x65\x71\x75\x65\163\164\x20\105\x72\x72\157\x72\72" . curl_error($hV);
        die;
        ut:
        curl_close($hV);
        return $ej;
    }
    function ccl()
    {
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\x2f\162\x65\163\164\57\143\165\163\x74\157\155\145\162\x2f\154\x69\143\145\x6e\163\x65";
        $hV = curl_init($Pk);
        $zo = variable_get("\x6d\151\156\x69\157\x72\141\156\147\145\137\x73\x61\155\154\x5f\143\165\x73\164\x6f\x6d\x65\x72\137\151\144", '');
        $dA = variable_get("\155\x69\x6e\151\157\x72\x61\156\x67\145\x5f\x73\x61\155\x6c\x5f\x63\x75\x73\164\x6f\155\x65\162\137\141\x70\x69\x5f\x6b\145\x79", '');
        $aK = round(microtime(TRUE) * 1000);
        $ym = $zo . number_format($aK, 0, '', '') . $dA;
        $tj = hash("\x73\x68\x61\x35\x31\62", $ym);
        $Hy = "\103\x75\163\x74\157\x6d\145\162\55\113\145\x79\72\40" . $zo;
        $J3 = "\124\x69\155\x65\163\x74\141\155\160\72\x20" . number_format($aK, 0, '', '');
        $dM = "\101\x75\164\x68\157\x72\151\172\141\164\x69\x6f\156\72\x20" . $tj;
        $i5 = '';
        $i5 = array("\x63\x75\163\x74\x6f\x6d\x65\162\x49\x64" => $zo, "\141\x70\x70\154\x69\x63\141\x74\151\157\x6e\x4e\x61\x6d\145" => Utilities::getPlanName());
        $z0 = json_encode($i5);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($hV, CURLOPT_AUTOREFERER, true);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($hV, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\x65\x6e\164\55\x54\x79\160\x65\72\40\x61\160\160\154\151\143\x61\164\x69\x6f\x6e\57\x6a\163\157\156", $Hy, $J3, $dM));
        curl_setopt($hV, CURLOPT_POST, true);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        curl_setopt($hV, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($hV, CURLOPT_TIMEOUT, 20);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto Jv;
        }
        return null;
        Jv:
        curl_close($hV);
        return $ej;
    }
}
