<?php


class MiniorangeSAMLCustomer
{
    public $email;
    public $customerKey;
    public $transactionId;
    public $password;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($NQ, $N2)
    {
        $this->email = $NQ;
        $this->password = $N2;
        $this->defaultCustomerId = "\61\66\x35\x35\65";
        $this->defaultCustomerApiKey = "\146\106\x64\x32\130\143\x76\124\107\x44\x65\x6d\132\166\x62\x77\x31\142\x63\125\145\x73\116\x4a\127\x45\x71\x4b\x62\x62\125\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Xn;
        }
        return json_encode(array("\x73\164\x61\x74\x75\x73" => "\x43\125\122\114\137\x45\x52\x52\117\122", "\x73\164\x61\164\x75\x73\x4d\145\163\x73\141\x67\x65" => "\x3c\x61\x20\x68\x72\x65\x66\75\x22\150\164\164\x70\x3a\x2f\57\160\150\160\56\156\x65\x74\x2f\x6d\x61\x6e\165\x61\x6c\x2f\x65\x6e\57\143\165\162\x6c\56\x69\156\x73\x74\141\154\154\141\164\151\x6f\x6e\56\x70\150\160\x22\x3e\x50\x48\x50\40\x63\125\122\x4c\x20\x65\170\x74\x65\x6e\x73\x69\157\156\74\57\141\x3e\40\x69\x73\x20\156\157\164\40\151\156\163\164\x61\154\154\145\x64\x20\x6f\162\x20\144\x69\163\141\x62\x6c\145\x64\56"));
        Xn:
        $lY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\x2f\162\145\x73\164\57\143\165\163\164\157\x6d\x65\x72\57\x63\x68\x65\143\153\x2d\151\x66\55\x65\x78\x69\x73\x74\x73";
        $te = curl_init($lY);
        $NQ = $this->email;
        $s0 = array("\145\x6d\x61\151\154" => $NQ);
        $Wp = json_encode($s0);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($te, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\156\164\x2d\124\x79\160\145\72\40\141\160\160\x6c\x69\143\x61\x74\x69\x6f\156\57\152\163\157\156", "\x63\x68\x61\162\x73\145\164\72\x20\125\124\x46\x20\55\40\70", "\x41\x75\x74\150\157\x72\151\x7a\x61\x74\x69\x6f\156\72\40\x42\x61\163\151\143"));
        curl_setopt($te, CURLOPT_POST, TRUE);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto xb;
        }
        $Pm = array("\x25\x6d\145\x74\x68\157\144" => "\x63\150\145\x63\153\103\x75\x73\x74\157\155\x65\x72", "\x25\x66\151\x6c\145" => "\x63\x75\163\x74\157\155\145\162\137\x73\x65\x74\165\160\x2e\160\x68\160", "\x25\145\x72\162\157\x72" => curl_error($te));
        watchdog("\155\151\x6e\x69\x6f\x72\141\x6e\147\x65\137\x73\x61\x6d\x6c", "\105\x72\162\157\162\x20\x61\164\40\x25\155\145\164\x68\157\x64\40\x6f\146\x20\x25\146\x69\154\x65\x3a\40\45\145\x72\x72\x6f\x72", $Pm);
        xb:
        curl_close($te);
        return $Cy;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto wE;
        }
        return json_encode(array("\163\x74\141\x74\x75\163\x43\x6f\144\x65" => "\105\122\x52\117\x52", "\x73\164\x61\164\x75\163\x4d\145\x73\163\141\x67\145" => "\56\40\x50\x6c\145\141\163\145\40\143\x68\x65\143\x6b\x20\171\157\165\162\x20\143\x6f\156\x66\151\147\165\162\141\164\x69\x6f\156\56"));
        wE:
        $lY = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\141\x73\x2f\x72\x65\163\164\57\143\165\x73\164\157\155\x65\x72\57\x61\144\144";
        $te = curl_init($lY);
        $s0 = array("\x63\157\155\x70\141\156\x79\x4e\x61\x6d\x65" => $_SERVER["\x53\x45\122\126\105\122\x5f\x4e\101\x4d\105"], "\141\162\145\141\x4f\146\111\x6e\164\145\x72\x65\163\164" => "\104\x72\x75\160\x61\x6c\x20\x53\101\115\114\40\x50\x6c\x75\147\151\x6e\40\55\40\x50\162\145\155\x69\x75\x6d", "\145\155\141\x69\154" => $this->email, "\x70\150\x6f\x6e\145" => $this->phone, "\x70\x61\x73\x73\x77\157\162\144" => $this->password);
        $Wp = json_encode($s0);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($te, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\x43\x6f\156\x74\145\156\164\x2d\x54\171\x70\x65\x3a\x20\141\160\160\154\x69\143\x61\x74\x69\x6f\x6e\57\x6a\163\157\x6e", "\143\150\141\x72\163\145\164\72\x20\125\124\x46\40\x2d\40\70", "\101\165\x74\x68\157\162\x69\x7a\x61\x74\151\x6f\156\x3a\x20\102\x61\163\151\x63"));
        curl_setopt($te, CURLOPT_POST, TRUE);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto DY;
        }
        $Pm = array("\x25\x6d\x65\164\x68\157\x64" => "\143\162\x65\141\164\145\103\165\x73\x74\157\155\x65\x72", "\x25\146\x69\x6c\145" => "\143\165\163\x74\157\155\145\x72\137\163\145\x74\x75\160\x2e\x70\150\x70", "\x25\x65\162\162\x6f\162" => curl_error($te));
        watchdog("\155\151\156\x69\x6f\x72\141\x6e\147\145\137\163\x61\155\x6c", "\105\x72\x72\x6f\162\x20\141\x74\40\x25\155\145\164\150\157\144\x20\x6f\146\40\x25\x66\x69\154\x65\x3a\40\x25\145\x72\162\x6f\162", $Pm);
        DY:
        curl_close($te);
        return $Cy;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto fO;
        }
        return json_encode(array("\141\160\151\x4b\145\x79" => "\x43\x55\x52\114\137\x45\122\x52\117\122", "\164\x6f\x6b\x65\x6e" => "\74\x61\40\x68\162\x65\x66\75\x22\x68\164\x74\160\72\x2f\57\160\150\160\56\156\145\x74\x2f\155\x61\156\165\141\154\x2f\145\156\57\143\x75\x72\154\x2e\x69\x6e\163\164\141\x6c\x6c\x61\x74\151\x6f\156\x2e\160\150\160\x22\76\120\x48\x50\x20\x63\x55\122\114\x20\145\x78\x74\x65\x6e\163\151\157\x6e\x3c\57\141\x3e\40\x69\x73\40\156\x6f\164\40\151\156\163\x74\141\154\154\x65\x64\40\x6f\x72\x20\x64\x69\163\141\x62\154\145\144\56"));
        fO:
        $lY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\57\x72\x65\x73\x74\57\143\x75\x73\x74\157\155\x65\162\x2f\x6b\145\x79";
        $te = curl_init($lY);
        $NQ = $this->email;
        $N2 = $this->password;
        $s0 = array("\x65\155\141\x69\154" => $NQ, "\160\x61\163\x73\x77\x6f\162\x64" => $N2);
        $Wp = json_encode($s0);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($te, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\156\x74\55\x54\x79\160\x65\72\x20\141\x70\x70\x6c\x69\143\141\x74\151\157\x6e\57\152\163\157\x6e", "\143\150\141\x72\163\x65\x74\x3a\x20\125\x54\x46\x20\55\40\70", "\x41\165\x74\150\x6f\x72\x69\x7a\141\164\x69\157\x6e\72\40\102\x61\x73\151\143"));
        curl_setopt($te, CURLOPT_POST, TRUE);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto ql;
        }
        $Pm = array("\45\155\145\164\x68\157\144" => "\147\x65\x74\x43\165\163\x74\x6f\155\x65\162\x4b\145\x79\163", "\45\146\151\x6c\x65" => "\143\x75\x73\x74\157\155\x65\x72\x5f\x73\x65\x74\165\x70\x2e\x70\150\x70", "\45\145\162\162\157\162" => curl_error($te));
        watchdog("\x6d\x69\x6e\151\x6f\x72\141\x6e\147\145\137\x73\x61\155\x6c", "\x45\x72\x72\157\x72\x20\x61\164\x20\45\155\x65\x74\150\x6f\144\40\x6f\x66\x20\45\146\151\154\x65\72\40\x25\x65\x72\162\157\x72", $Pm);
        ql:
        curl_close($te);
        return $Cy;
    }
    function verifyLicense($Pb)
    {
        $lY = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\141\163\x2f\141\x70\x69\57\x62\x61\x63\153\x75\160\143\x6f\144\x65\x2f\x76\x65\x72\151\146\171";
        $te = curl_init($lY);
        $jR = variable_get("\x6d\x69\156\x69\x6f\x72\x61\x6e\147\x65\x5f\163\x61\155\x6c\137\143\165\163\x74\157\155\x65\162\137\x69\144");
        $i3 = variable_get("\x6d\x69\x6e\x69\157\162\141\x6e\x67\145\x5f\x73\141\x6d\154\137\x63\165\163\x74\157\x6d\145\162\x5f\141\x70\151\137\153\145\x79");
        global $base_url;
        $d2 = round(microtime(TRUE) * 1000);
        $FX = $jR . number_format($d2, 0, '', '') . $i3;
        $oA = hash("\163\x68\141\x35\61\x32", $FX);
        $E8 = "\x43\x75\x73\x74\x6f\155\x65\x72\x2d\113\145\171\72\x20" . $jR;
        $Ny = "\124\151\155\145\163\164\x61\155\160\x3a\40" . number_format($d2, 0, '', '');
        $pC = "\101\x75\164\150\157\x72\151\x7a\141\x74\x69\x6f\156\72\x20" . $oA;
        $s0 = '';
        $s0 = array("\143\x6f\144\145" => $Pb, "\143\165\x73\164\x6f\x6d\x65\x72\113\145\x79" => $jR, "\x61\x64\144\x69\x74\151\x6f\x6e\141\x6c\106\x69\x65\154\144\163" => array("\146\x69\x65\154\144\61" => $base_url));
        $Wp = json_encode($s0);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($te, CURLOPT_AUTOREFERER, true);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\x43\157\156\164\145\156\164\55\124\x79\160\145\72\x20\141\x70\160\x6c\151\143\x61\164\151\x6f\x6e\x2f\152\163\157\156", $E8, $Ny, $pC));
        curl_setopt($te, CURLOPT_POST, true);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        curl_setopt($te, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($te, CURLOPT_TIMEOUT, 20);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto Nm;
        }
        echo "\x52\145\161\x75\x65\x73\164\40\x45\162\162\157\x72\x3a" . curl_error($te);
        die;
        Nm:
        curl_close($te);
        return $Cy;
    }
    function updateStatus()
    {
        $lY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\163\x2f\x61\160\x69\57\x62\141\x63\x6b\165\160\143\x6f\x64\145\x2f\x75\x70\144\141\164\x65\163\164\x61\164\x75\x73";
        $te = curl_init($lY);
        $jR = variable_get("\155\x69\x6e\151\157\x72\x61\156\x67\x65\137\163\x61\x6d\x6c\137\x63\165\x73\164\157\x6d\x65\x72\137\x69\144");
        $i3 = variable_get("\155\x69\x6e\151\157\162\141\x6e\x67\x65\137\x73\141\155\154\x5f\x63\165\x73\x74\157\x6d\x65\x72\x5f\x61\160\151\x5f\x6b\145\x79");
        $d2 = round(microtime(TRUE) * 1000);
        $FX = $jR . number_format($d2, 0, '', '') . $i3;
        $oA = hash("\163\x68\141\x35\61\x32", $FX);
        $E8 = "\103\165\163\164\x6f\x6d\x65\x72\x2d\x4b\x65\171\72\x20" . $jR;
        $Ny = "\x54\151\155\x65\163\164\141\x6d\x70\72\40" . number_format($d2, 0, '', '');
        $pC = "\x41\x75\164\150\157\162\151\x7a\141\x74\x69\x6f\156\x3a\40" . $oA;
        $Rh = variable_get("\x6d\151\x6e\x69\x6f\x72\x61\156\147\145\137\163\x61\x6d\154\x5f\143\x75\x73\164\x6f\155\x65\162\x5f\x61\x64\155\x69\x6e\x5f\x74\157\153\145\x6e");
        $Pb = AESEncryption::decrypt_data(variable_get("\x6d\x69\x6e\151\157\162\141\x6e\147\145\137\x73\x61\x6d\154\137\154\x69\143\145\156\163\x65\137\x6b\145\171"), $Rh);
        $s0 = array("\x63\x6f\x64\145" => $Pb, "\143\165\163\x74\157\155\145\x72\113\x65\171" => $jR);
        $Wp = json_encode($s0);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($te, CURLOPT_AUTOREFERER, true);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\x43\157\156\x74\x65\156\164\x2d\124\171\160\x65\72\x20\141\160\160\154\x69\143\141\164\151\x6f\156\57\x6a\163\x6f\x6e", $E8, $Ny, $pC));
        curl_setopt($te, CURLOPT_POST, true);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        curl_setopt($te, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($te, CURLOPT_TIMEOUT, 20);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto BC;
        }
        echo "\x52\x65\161\x75\145\163\164\40\x45\162\x72\157\x72\x3a" . curl_error($te);
        die;
        BC:
        curl_close($te);
        return $Cy;
    }
    function ccl()
    {
        $lY = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\157\x61\x73\x2f\162\145\x73\164\x2f\143\165\163\164\157\155\145\x72\57\154\151\x63\x65\x6e\163\x65";
        $te = curl_init($lY);
        $jR = variable_get("\x6d\x69\156\151\157\162\141\156\147\x65\x5f\x73\x61\x6d\x6c\x5f\143\x75\x73\164\x6f\x6d\x65\162\137\151\x64", '');
        $i3 = variable_get("\x6d\x69\x6e\151\x6f\162\141\x6e\147\x65\137\x73\141\155\154\x5f\143\x75\x73\164\x6f\155\x65\162\137\x61\x70\151\x5f\153\x65\x79", '');
        $d2 = round(microtime(TRUE) * 1000);
        $FX = $jR . number_format($d2, 0, '', '') . $i3;
        $oA = hash("\x73\x68\x61\x35\61\62", $FX);
        $E8 = "\x43\x75\163\164\157\155\x65\162\55\113\145\x79\x3a\40" . $jR;
        $Ny = "\124\x69\155\145\x73\x74\x61\155\160\x3a\40" . number_format($d2, 0, '', '');
        $pC = "\x41\x75\x74\150\157\x72\151\172\x61\164\151\157\x6e\x3a\40" . $oA;
        $s0 = '';
        $s0 = array("\143\165\x73\164\157\155\145\162\x49\x64" => $jR, "\x61\x70\160\x6c\151\143\141\164\x69\157\156\x4e\141\155\145" => "\x64\162\x75\160\x61\x6c\x5f\x6d\151\156\x69\157\162\141\x6e\x67\145\x5f\163\x61\155\x6c\x5f\145\x6e\164\145\162\x70\162\x69\163\145\137\160\x6c\141\x6e");
        $Wp = json_encode($s0);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($te, CURLOPT_AUTOREFERER, true);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($te, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\x43\x6f\156\164\145\x6e\164\x2d\124\x79\x70\145\72\x20\141\x70\160\x6c\151\x63\141\164\151\x6f\x6e\57\x6a\163\x6f\x6e", $E8, $Ny, $pC));
        curl_setopt($te, CURLOPT_POST, true);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        curl_setopt($te, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($te, CURLOPT_TIMEOUT, 20);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto vD;
        }
        return null;
        vD:
        curl_close($te);
        return $Cy;
    }
}
