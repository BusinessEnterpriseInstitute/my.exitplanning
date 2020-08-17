<?php


class MiniorangeSAMLCustomer
{
    public $email;
    public $customerKey;
    public $transactionId;
    public $password;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($xx, $r7)
    {
        $this->email = $xx;
        $this->password = $r7;
        $this->defaultCustomerId = "\x31\x36\65\65\65";
        $this->defaultCustomerApiKey = "\x66\106\144\62\130\x63\x76\x54\x47\x44\x65\x6d\132\x76\x62\x77\61\x62\x63\x55\x65\163\x4e\112\x57\105\x71\113\142\x62\125\161";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto jP;
        }
        return json_encode(array("\163\164\x61\164\165\x73" => "\x43\125\122\x4c\x5f\x45\x52\x52\117\122", "\163\x74\x61\x74\x75\163\115\x65\163\x73\x61\x67\x65" => "\74\x61\x20\150\x72\x65\146\x3d\42\150\164\x74\160\72\x2f\x2f\160\150\160\x2e\x6e\x65\164\57\155\141\x6e\165\141\154\x2f\145\156\57\143\165\x72\x6c\x2e\x69\x6e\163\x74\141\x6c\x6c\x61\x74\151\x6f\156\56\x70\x68\x70\x22\76\120\110\120\40\143\x55\x52\114\x20\145\x78\x74\145\156\163\151\x6f\x6e\74\x2f\x61\x3e\x20\151\163\40\156\x6f\164\x20\151\156\163\164\x61\x6c\x6c\145\144\40\x6f\162\40\144\151\163\141\x62\x6c\x65\144\56"));
        jP:
        $aa = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\x61\x73\57\162\x65\163\164\57\143\165\x73\164\157\155\145\x72\x2f\x63\150\145\x63\153\55\151\x66\x2d\x65\x78\151\163\x74\163";
        $H6 = curl_init($aa);
        $xx = $this->email;
        $Rx = array("\x65\x6d\141\151\x6c" => $xx);
        $RR = json_encode($Rx);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($H6, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\x43\157\156\164\145\x6e\x74\x2d\124\x79\x70\x65\x3a\x20\x61\160\x70\154\x69\143\141\x74\x69\x6f\156\57\x6a\163\x6f\156", "\143\x68\x61\162\163\x65\x74\72\40\x55\124\106\x20\x2d\40\70", "\x41\x75\x74\x68\157\162\x69\172\141\164\x69\157\x6e\72\x20\x42\x61\163\x69\x63"));
        curl_setopt($H6, CURLOPT_POST, TRUE);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto z1;
        }
        $Ql = array("\45\155\145\x74\x68\x6f\144" => "\x63\150\x65\143\153\x43\x75\163\x74\x6f\x6d\145\162", "\x25\146\x69\154\x65" => "\143\165\163\164\157\155\x65\162\x5f\x73\x65\164\x75\x70\x2e\x70\150\x70", "\x25\x65\x72\x72\x6f\x72" => curl_error($H6));
        watchdog("\155\x69\156\x69\x6f\162\141\x6e\x67\x65\137\x73\141\x6d\154", "\x45\162\x72\157\162\40\141\x74\40\45\155\x65\164\x68\x6f\x64\x20\x6f\x66\40\45\146\151\154\145\72\x20\45\x65\162\162\x6f\x72", $Ql);
        z1:
        curl_close($H6);
        return $ry;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto hl;
        }
        return json_encode(array("\x73\x74\x61\164\x75\x73\103\157\x64\145" => "\x45\122\x52\x4f\122", "\x73\164\141\x74\165\163\x4d\145\x73\163\x61\147\145" => "\56\x20\x50\x6c\145\141\x73\145\40\x63\x68\x65\x63\x6b\x20\171\x6f\x75\162\40\x63\x6f\156\x66\151\x67\x75\162\x61\x74\x69\157\x6e\56"));
        hl:
        $aa = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\x61\163\x2f\162\x65\163\x74\57\143\x75\x73\x74\157\x6d\145\162\57\141\x64\x64";
        $H6 = curl_init($aa);
        $Rx = array("\143\157\x6d\x70\x61\x6e\171\x4e\141\x6d\145" => $_SERVER["\123\x45\122\x56\x45\122\137\116\101\x4d\x45"], "\x61\x72\145\141\x4f\146\x49\156\x74\145\x72\145\163\x74" => "\104\x72\x75\x70\141\154\x20\x53\x41\x4d\x4c\x20\120\x6c\165\x67\x69\x6e\x20\x2d\40\x50\162\145\155\x69\165\x6d", "\145\x6d\141\x69\x6c" => $this->email, "\x70\x68\157\156\x65" => $this->phone, "\160\141\163\163\x77\157\162\144" => $this->password);
        $RR = json_encode($Rx);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($H6, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\145\156\164\55\124\171\x70\x65\x3a\40\141\160\160\154\151\143\x61\164\151\x6f\156\x2f\152\163\157\x6e", "\x63\150\x61\x72\163\x65\164\x3a\40\125\124\106\x20\x2d\x20\x38", "\x41\x75\164\150\157\x72\151\172\141\x74\151\x6f\x6e\72\x20\x42\141\163\x69\143"));
        curl_setopt($H6, CURLOPT_POST, TRUE);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto LQ;
        }
        $Ql = array("\x25\x6d\145\164\150\157\144" => "\x63\x72\145\x61\164\x65\x43\x75\x73\x74\157\155\145\x72", "\45\x66\x69\154\x65" => "\x63\x75\x73\164\x6f\x6d\x65\x72\x5f\163\x65\x74\165\160\x2e\160\150\160", "\x25\x65\x72\x72\x6f\162" => curl_error($H6));
        watchdog("\155\x69\156\x69\x6f\162\x61\x6e\x67\145\137\x73\x61\155\x6c", "\105\162\162\157\x72\40\x61\164\40\45\x6d\145\164\x68\157\144\40\157\146\x20\x25\146\151\154\x65\72\x20\45\x65\162\162\157\162", $Ql);
        LQ:
        curl_close($H6);
        return $ry;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto s5;
        }
        return json_encode(array("\x61\160\x69\x4b\x65\171" => "\x43\x55\122\114\x5f\x45\122\x52\x4f\x52", "\x74\x6f\x6b\145\x6e" => "\x3c\x61\x20\x68\162\145\146\75\42\x68\164\164\160\x3a\57\57\x70\x68\x70\x2e\156\145\x74\x2f\x6d\141\x6e\x75\x61\154\x2f\145\156\x2f\x63\x75\162\x6c\x2e\151\x6e\163\164\x61\154\154\141\x74\151\x6f\156\56\160\x68\160\42\x3e\x50\x48\x50\x20\143\125\x52\x4c\x20\145\170\164\145\156\x73\x69\157\x6e\x3c\x2f\x61\76\40\x69\163\40\x6e\x6f\x74\x20\x69\x6e\163\164\x61\x6c\154\x65\144\40\157\x72\x20\144\151\x73\141\x62\x6c\x65\x64\56"));
        s5:
        $aa = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\141\x73\57\x72\145\x73\x74\x2f\143\165\163\164\x6f\155\x65\x72\57\x6b\145\x79";
        $H6 = curl_init($aa);
        $xx = $this->email;
        $r7 = $this->password;
        $Rx = array("\x65\155\141\151\154" => $xx, "\160\x61\x73\x73\x77\x6f\162\144" => $r7);
        $RR = json_encode($Rx);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($H6, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\x65\156\164\55\124\171\x70\145\x3a\x20\x61\x70\x70\x6c\x69\x63\141\164\151\157\x6e\57\152\163\x6f\156", "\x63\x68\x61\162\x73\145\x74\72\40\125\124\106\x20\55\40\70", "\101\x75\x74\x68\157\162\x69\172\x61\164\x69\157\156\x3a\40\x42\141\x73\151\x63"));
        curl_setopt($H6, CURLOPT_POST, TRUE);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto dr;
        }
        $Ql = array("\x25\x6d\x65\x74\x68\x6f\x64" => "\x67\145\x74\103\165\x73\x74\157\x6d\145\162\x4b\x65\171\x73", "\45\146\x69\x6c\x65" => "\x63\165\163\164\x6f\x6d\145\162\137\163\145\164\165\x70\x2e\160\150\160", "\x25\x65\162\162\x6f\x72" => curl_error($H6));
        watchdog("\x6d\151\x6e\151\x6f\x72\x61\x6e\147\145\x5f\163\141\x6d\154", "\x45\x72\162\157\x72\x20\x61\164\x20\x25\x6d\x65\164\150\157\144\40\157\x66\x20\45\x66\x69\x6c\145\x3a\x20\x25\145\162\x72\157\x72", $Ql);
        dr:
        curl_close($H6);
        return $ry;
    }
    function verifyLicense($Oe)
    {
        $aa = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\141\163\57\x61\x70\x69\57\142\141\x63\x6b\165\160\x63\157\x64\x65\57\166\x65\162\x69\x66\x79";
        $H6 = curl_init($aa);
        $O6 = variable_get("\x6d\x69\156\151\x6f\x72\141\x6e\147\145\x5f\x73\x61\155\x6c\x5f\143\x75\163\x74\x6f\x6d\x65\x72\137\151\x64");
        $vh = variable_get("\x6d\151\x6e\x69\x6f\x72\x61\x6e\147\x65\137\163\x61\x6d\154\x5f\143\x75\x73\164\x6f\155\x65\x72\x5f\141\160\151\137\x6b\x65\x79");
        global $base_url;
        $jH = round(microtime(TRUE) * 1000);
        $re = $O6 . number_format($jH, 0, '', '') . $vh;
        $go = hash("\x73\150\x61\65\61\62", $re);
        $dA = "\x43\165\x73\x74\157\155\x65\162\x2d\x4b\145\171\72\40" . $O6;
        $zL = "\124\151\x6d\145\x73\164\x61\x6d\x70\72\40" . number_format($jH, 0, '', '');
        $Sa = "\x41\x75\x74\x68\157\x72\151\x7a\x61\x74\151\x6f\x6e\x3a\x20" . $go;
        $Rx = '';
        $Rx = array("\x63\x6f\144\145" => $Oe, "\143\165\163\x74\x6f\155\x65\x72\113\145\x79" => $O6, "\141\144\x64\151\164\151\157\x6e\141\x6c\106\x69\145\x6c\144\163" => array("\x66\151\x65\x6c\x64\61" => $base_url));
        $RR = json_encode($Rx);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($H6, CURLOPT_AUTOREFERER, true);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\x65\156\164\x2d\124\171\x70\145\72\40\x61\x70\x70\x6c\x69\143\x61\x74\x69\157\156\57\x6a\x73\x6f\156", $dA, $zL, $Sa));
        curl_setopt($H6, CURLOPT_POST, true);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        curl_setopt($H6, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($H6, CURLOPT_TIMEOUT, 20);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto vv;
        }
        echo "\x52\145\161\165\145\x73\164\x20\105\162\x72\157\x72\72" . curl_error($H6);
        die;
        vv:
        curl_close($H6);
        return $ry;
    }
    function updateStatus()
    {
        $aa = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\157\141\x73\57\141\160\151\57\x62\x61\143\x6b\x75\x70\143\157\x64\145\57\x75\160\144\x61\164\x65\x73\x74\x61\x74\165\163";
        $H6 = curl_init($aa);
        $O6 = variable_get("\x6d\x69\156\x69\x6f\x72\141\x6e\x67\145\137\163\141\155\x6c\x5f\143\x75\163\x74\x6f\x6d\145\162\137\151\144");
        $vh = variable_get("\x6d\x69\x6e\151\x6f\162\141\x6e\147\145\x5f\163\x61\155\154\x5f\x63\x75\163\164\x6f\155\x65\x72\x5f\x61\x70\x69\x5f\153\x65\x79");
        $jH = round(microtime(TRUE) * 1000);
        $re = $O6 . number_format($jH, 0, '', '') . $vh;
        $go = hash("\x73\150\x61\65\x31\62", $re);
        $dA = "\x43\x75\163\164\157\x6d\145\162\55\113\x65\171\72\40" . $O6;
        $zL = "\124\151\x6d\x65\163\164\141\x6d\x70\72\40" . number_format($jH, 0, '', '');
        $Sa = "\101\x75\x74\150\x6f\x72\x69\x7a\141\x74\151\157\x6e\x3a\x20" . $go;
        $AM = variable_get("\x6d\x69\156\x69\157\162\141\156\147\145\137\x73\x61\155\x6c\x5f\143\x75\x73\164\x6f\155\145\162\x5f\x61\144\x6d\151\x6e\x5f\x74\157\x6b\x65\156");
        $Oe = AESEncryption::decrypt_data(variable_get("\155\151\156\151\157\162\141\156\x67\145\x5f\x73\141\x6d\x6c\x5f\x6c\x69\x63\x65\x6e\163\x65\137\x6b\x65\x79"), $AM);
        $Rx = array("\x63\x6f\x64\145" => $Oe, "\x63\165\163\164\x6f\x6d\145\x72\x4b\x65\171" => $O6);
        $RR = json_encode($Rx);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($H6, CURLOPT_AUTOREFERER, true);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\x43\157\156\164\x65\156\164\x2d\124\x79\160\x65\x3a\40\x61\x70\x70\x6c\x69\143\x61\x74\151\157\x6e\x2f\x6a\163\157\156", $dA, $zL, $Sa));
        curl_setopt($H6, CURLOPT_POST, true);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        curl_setopt($H6, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($H6, CURLOPT_TIMEOUT, 20);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto ed;
        }
        echo "\122\x65\x71\165\x65\x73\164\x20\x45\x72\x72\157\x72\x3a" . curl_error($H6);
        die;
        ed:
        curl_close($H6);
        return $ry;
    }
    function ccl()
    {
        $aa = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\141\x73\x2f\x72\x65\163\164\x2f\143\x75\163\164\x6f\x6d\145\x72\x2f\x6c\x69\x63\145\x6e\163\145";
        $H6 = curl_init($aa);
        $O6 = variable_get("\x6d\x69\156\151\157\x72\141\x6e\147\x65\x5f\x73\x61\155\154\137\x63\x75\163\164\x6f\155\145\162\x5f\151\144", '');
        $vh = variable_get("\x6d\x69\x6e\151\157\162\x61\x6e\147\x65\137\x73\141\155\x6c\137\143\165\x73\164\157\155\x65\162\x5f\x61\x70\x69\x5f\153\145\171", '');
        $jH = round(microtime(TRUE) * 1000);
        $re = $O6 . number_format($jH, 0, '', '') . $vh;
        $go = hash("\163\150\x61\65\x31\x32", $re);
        $dA = "\x43\x75\163\x74\157\x6d\x65\x72\x2d\113\145\171\x3a\x20" . $O6;
        $zL = "\124\151\x6d\145\x73\164\141\x6d\160\72\x20" . number_format($jH, 0, '', '');
        $Sa = "\x41\x75\x74\150\x6f\x72\151\x7a\x61\164\x69\157\156\x3a\x20" . $go;
        $Rx = '';
        $Rx = array("\x63\x75\163\x74\x6f\155\145\x72\111\x64" => $O6, "\x61\160\x70\154\x69\143\141\x74\x69\157\156\x4e\141\155\145" => "\144\x72\165\x70\x61\x6c\x5f\155\151\x6e\151\157\x72\x61\x6e\x67\x65\x5f\163\141\155\x6c\x5f\x65\156\164\x65\x72\160\x72\x69\163\145\137\160\154\x61\x6e");
        $RR = json_encode($Rx);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($H6, CURLOPT_AUTOREFERER, true);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($H6, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\x65\x6e\164\x2d\x54\171\160\x65\72\40\x61\160\160\154\x69\143\x61\164\151\x6f\x6e\x2f\152\x73\x6f\x6e", $dA, $zL, $Sa));
        curl_setopt($H6, CURLOPT_POST, true);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        curl_setopt($H6, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($H6, CURLOPT_TIMEOUT, 20);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto vY;
        }
        return null;
        vY:
        curl_close($H6);
        return $ry;
    }
}
