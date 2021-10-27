<?php


class MiniorangeSAMLCustomer
{
    public $email;
    public $customerKey;
    public $transactionId;
    public $password;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($aa, $Wx)
    {
        $this->email = $aa;
        $this->password = $Wx;
        $this->defaultCustomerId = "\x31\66\65\65\65";
        $this->defaultCustomerApiKey = "\x66\106\x64\x32\x58\x63\x76\x54\107\x44\145\155\132\166\x62\x77\61\142\x63\x55\145\x73\116\112\127\x45\x71\x4b\x62\x62\125\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto LC;
        }
        return json_encode(array("\163\164\x61\164\165\x73" => "\103\125\x52\114\137\105\122\122\117\x52", "\x73\x74\x61\x74\165\163\x4d\145\x73\x73\x61\147\x65" => "\x3c\141\40\150\162\145\x66\x3d\42\150\164\164\x70\x3a\x2f\x2f\160\150\x70\x2e\x6e\x65\164\x2f\x6d\x61\x6e\x75\x61\154\x2f\x65\x6e\x2f\143\165\162\154\x2e\151\x6e\x73\x74\x61\154\154\x61\x74\151\157\x6e\56\x70\x68\160\42\x3e\120\110\x50\x20\x63\x55\x52\114\40\x65\x78\x74\x65\x6e\163\151\x6f\156\74\57\141\x3e\x20\x69\x73\40\x6e\x6f\164\40\151\156\x73\x74\x61\154\x6c\x65\x64\x20\157\x72\x20\144\151\163\x61\142\154\145\144\56"));
        LC:
        $ae = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\x73\57\x72\145\163\164\57\x63\165\x73\x74\x6f\155\145\162\57\x63\x68\x65\x63\x6b\x2d\x69\146\55\145\170\x69\x73\164\x73";
        $XK = curl_init($ae);
        $aa = $this->email;
        $Zq = array("\145\155\x61\151\154" => $aa);
        $Uq = json_encode($Zq);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($XK, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\x43\x6f\156\164\x65\x6e\x74\55\x54\171\160\x65\x3a\40\141\160\x70\154\x69\x63\x61\x74\x69\x6f\x6e\57\x6a\x73\157\156", "\x63\x68\141\162\x73\145\164\x3a\40\x55\x54\x46\40\x2d\x20\x38", "\101\x75\x74\x68\157\x72\x69\172\x61\164\x69\x6f\x6e\72\x20\x42\x61\x73\151\x63"));
        curl_setopt($XK, CURLOPT_POST, TRUE);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto x4;
        }
        $NL = array("\x25\155\x65\x74\x68\157\x64" => "\x63\x68\145\x63\153\x43\165\x73\164\157\155\x65\162", "\x25\146\151\154\x65" => "\143\x75\x73\x74\157\x6d\145\x72\x5f\x73\145\x74\165\x70\x2e\160\150\x70", "\45\x65\162\x72\x6f\x72" => curl_error($XK));
        watchdog("\x6d\151\x6e\x69\157\x72\141\x6e\x67\145\137\x73\141\155\154", "\105\162\x72\x6f\162\40\141\x74\x20\x25\x6d\x65\164\x68\157\x64\40\x6f\x66\x20\45\146\x69\154\145\72\40\45\x65\162\162\157\x72", $NL);
        x4:
        curl_close($XK);
        return $Ar;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto l5;
        }
        return json_encode(array("\x73\x74\x61\164\165\x73\x43\x6f\144\145" => "\105\122\x52\x4f\x52", "\x73\x74\141\164\165\x73\115\145\163\163\141\x67\x65" => "\x2e\x20\x50\x6c\145\x61\163\145\40\143\x68\x65\x63\153\40\x79\x6f\165\162\x20\x63\x6f\156\146\x69\147\x75\x72\x61\x74\151\157\x6e\x2e"));
        l5:
        $ae = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\x61\163\x2f\x72\145\x73\x74\57\143\165\163\164\157\155\x65\x72\57\141\x64\x64";
        $XK = curl_init($ae);
        $Zq = array("\143\x6f\x6d\160\141\x6e\171\116\141\x6d\145" => $_SERVER["\123\105\122\126\105\x52\137\x4e\101\115\x45"], "\x61\x72\x65\141\117\x66\111\156\x74\145\x72\145\163\164" => "\104\162\165\160\141\x6c\x20\123\x41\115\x4c\x20\120\x6c\x75\x67\151\156\x20\x2d\40\x50\162\145\155\151\x75\x6d", "\145\155\x61\151\x6c" => $this->email, "\160\x68\157\x6e\145" => $this->phone, "\x70\141\163\x73\x77\x6f\162\144" => $this->password);
        $Uq = json_encode($Zq);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($XK, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\145\156\164\55\x54\171\x70\145\x3a\40\141\160\x70\x6c\151\143\x61\x74\151\x6f\x6e\57\152\x73\x6f\x6e", "\x63\150\141\162\x73\x65\x74\x3a\x20\125\x54\106\40\x2d\40\70", "\101\165\x74\150\x6f\162\x69\x7a\141\164\x69\x6f\156\72\40\x42\141\163\151\x63"));
        curl_setopt($XK, CURLOPT_POST, TRUE);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto Aq;
        }
        $NL = array("\45\x6d\x65\x74\150\157\144" => "\x63\x72\145\141\164\145\x43\x75\x73\164\157\155\x65\162", "\45\x66\x69\x6c\145" => "\x63\165\x73\x74\157\155\x65\x72\137\163\145\164\165\160\x2e\160\150\160", "\45\x65\x72\162\157\x72" => curl_error($XK));
        watchdog("\155\151\156\x69\157\x72\x61\156\147\x65\137\x73\141\x6d\x6c", "\x45\162\162\x6f\x72\x20\x61\164\x20\x25\x6d\145\164\x68\157\x64\x20\157\x66\40\x25\x66\x69\154\145\x3a\x20\x25\x65\x72\x72\157\x72", $NL);
        Aq:
        curl_close($XK);
        return $Ar;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto X9;
        }
        return json_encode(array("\141\160\x69\113\x65\x79" => "\x43\125\122\x4c\x5f\105\x52\122\x4f\122", "\164\x6f\153\x65\x6e" => "\74\x61\40\x68\x72\x65\146\x3d\42\150\x74\x74\160\x3a\x2f\x2f\160\150\x70\56\156\145\164\57\x6d\141\156\x75\x61\x6c\x2f\x65\x6e\x2f\x63\165\x72\154\x2e\x69\156\163\164\141\154\x6c\141\164\x69\157\156\x2e\160\150\160\x22\x3e\x50\110\120\x20\x63\125\x52\114\x20\145\170\x74\145\x6e\x73\151\157\156\74\x2f\141\76\x20\151\163\40\x6e\x6f\164\x20\x69\156\x73\164\141\x6c\154\145\x64\x20\157\162\x20\x64\x69\163\x61\x62\x6c\145\x64\x2e"));
        X9:
        $ae = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\141\163\x2f\162\x65\x73\x74\57\x63\165\163\x74\157\155\145\x72\57\153\x65\x79";
        $XK = curl_init($ae);
        $aa = $this->email;
        $Wx = $this->password;
        $Zq = array("\145\x6d\141\151\154" => $aa, "\x70\x61\x73\163\x77\x6f\162\x64" => $Wx);
        $Uq = json_encode($Zq);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($XK, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\103\157\156\164\x65\156\x74\55\x54\x79\160\x65\72\40\x61\x70\x70\x6c\x69\143\x61\164\x69\x6f\x6e\57\152\163\x6f\x6e", "\143\x68\x61\162\163\145\164\x3a\x20\125\x54\106\x20\55\40\70", "\101\x75\x74\150\157\x72\151\x7a\141\x74\151\157\156\72\40\102\141\x73\151\143"));
        curl_setopt($XK, CURLOPT_POST, TRUE);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto Ku;
        }
        $NL = array("\x25\x6d\x65\164\x68\x6f\x64" => "\147\145\x74\103\x75\163\x74\157\x6d\145\162\113\145\x79\163", "\x25\146\x69\x6c\x65" => "\x63\165\x73\164\157\x6d\x65\162\x5f\x73\x65\164\x75\x70\56\160\x68\x70", "\45\145\162\x72\x6f\162" => curl_error($XK));
        watchdog("\x6d\x69\156\x69\x6f\x72\141\x6e\x67\145\x5f\163\141\155\154", "\105\x72\162\157\x72\x20\141\x74\40\45\x6d\x65\x74\150\x6f\x64\x20\x6f\146\x20\x25\x66\151\154\145\x3a\40\45\145\x72\x72\157\162", $NL);
        Ku:
        curl_close($XK);
        return $Ar;
    }
    function verifyLicense($re)
    {
        $ae = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\x61\163\x2f\141\160\x69\x2f\142\141\x63\x6b\165\160\x63\157\144\145\x2f\166\145\162\151\x66\x79";
        $XK = curl_init($ae);
        $R4 = variable_get("\155\x69\x6e\151\x6f\162\141\x6e\x67\x65\137\x73\x61\155\154\137\x63\165\x73\x74\157\155\x65\162\137\151\x64");
        $Fr = variable_get("\155\151\156\151\157\162\141\156\x67\x65\x5f\x73\x61\155\x6c\137\143\165\x73\x74\x6f\x6d\x65\162\137\141\160\151\x5f\153\145\x79");
        global $base_url;
        $Ob = round(microtime(TRUE) * 1000);
        $rc = $R4 . number_format($Ob, 0, '', '') . $Fr;
        $DF = hash("\163\150\x61\65\61\62", $rc);
        $zu = "\x43\165\x73\x74\157\155\145\162\55\x4b\145\x79\72\x20" . $R4;
        $EO = "\x54\151\x6d\145\x73\164\141\x6d\x70\x3a\x20" . number_format($Ob, 0, '', '');
        $SZ = "\x41\165\164\150\157\162\151\x7a\x61\x74\x69\157\156\x3a\40" . $DF;
        $Zq = '';
        $Zq = array("\143\157\x64\145" => $re, "\x63\165\x73\x74\157\x6d\x65\x72\x4b\145\171" => $R4, "\x61\x64\144\x69\x74\151\x6f\x6e\x61\154\x46\x69\x65\x6c\x64\x73" => array("\146\151\145\x6c\x64\x31" => $base_url));
        $Uq = json_encode($Zq);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($XK, CURLOPT_AUTOREFERER, true);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\156\x74\55\x54\x79\x70\x65\72\x20\x61\160\160\x6c\151\x63\x61\x74\x69\x6f\x6e\57\152\163\157\156", $zu, $EO, $SZ));
        curl_setopt($XK, CURLOPT_POST, true);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        curl_setopt($XK, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($XK, CURLOPT_TIMEOUT, 20);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto ys;
        }
        echo "\122\145\x71\x75\x65\x73\x74\x20\105\x72\162\157\162\x3a" . curl_error($XK);
        exit;
        ys:
        curl_close($XK);
        return $Ar;
    }
    function updateStatus()
    {
        $ae = MiniorangeSAMLConstants::BASE_URL . "\57\155\x6f\141\163\57\141\160\x69\57\x62\141\x63\x6b\165\x70\143\157\144\145\57\165\160\144\x61\164\x65\163\x74\141\x74\x75\x73";
        $XK = curl_init($ae);
        $R4 = variable_get("\x6d\151\156\x69\x6f\x72\x61\156\x67\x65\x5f\x73\141\155\154\x5f\143\x75\x73\164\157\155\145\162\137\x69\x64");
        $Fr = variable_get("\155\151\x6e\151\x6f\x72\x61\x6e\x67\145\x5f\163\x61\x6d\154\137\x63\x75\x73\x74\157\x6d\x65\x72\137\141\x70\151\137\x6b\x65\x79");
        $Ob = round(microtime(TRUE) * 1000);
        $rc = $R4 . number_format($Ob, 0, '', '') . $Fr;
        $DF = hash("\163\x68\x61\65\x31\x32", $rc);
        $zu = "\103\165\x73\164\157\155\x65\162\x2d\113\x65\x79\72\40" . $R4;
        $EO = "\124\151\x6d\145\163\164\x61\155\x70\x3a\40" . number_format($Ob, 0, '', '');
        $SZ = "\101\165\164\150\157\x72\151\172\141\x74\151\x6f\156\72\40" . $DF;
        $hG = variable_get("\155\x69\x6e\x69\157\162\x61\156\147\x65\x5f\x73\141\x6d\x6c\x5f\x63\165\163\164\x6f\155\145\x72\x5f\141\144\x6d\x69\156\x5f\x74\157\153\145\x6e");
        $re = AESEncryption::decrypt_data(variable_get("\155\151\156\x69\157\162\x61\x6e\147\145\137\163\x61\155\x6c\x5f\154\x69\x63\145\x6e\x73\x65\x5f\153\145\171"), $hG);
        $Zq = array("\143\157\x64\x65" => $re, "\x63\x75\x73\x74\x6f\x6d\145\x72\x4b\x65\171" => $R4);
        $Uq = json_encode($Zq);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($XK, CURLOPT_AUTOREFERER, true);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\x65\x6e\164\55\x54\171\x70\145\x3a\x20\x61\x70\x70\x6c\151\143\x61\164\x69\157\156\57\152\x73\x6f\156", $zu, $EO, $SZ));
        curl_setopt($XK, CURLOPT_POST, true);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        curl_setopt($XK, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($XK, CURLOPT_TIMEOUT, 20);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto Vk;
        }
        echo "\x52\145\x71\x75\x65\x73\x74\40\x45\162\x72\x6f\162\72" . curl_error($XK);
        exit;
        Vk:
        curl_close($XK);
        return $Ar;
    }
    function ccl()
    {
        $ae = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\141\x73\57\162\145\x73\x74\x2f\143\165\x73\164\x6f\155\x65\x72\57\154\151\143\x65\x6e\163\145";
        $XK = curl_init($ae);
        $R4 = variable_get("\x6d\151\x6e\x69\x6f\162\141\x6e\147\x65\137\x73\141\155\x6c\137\143\165\163\x74\x6f\x6d\x65\x72\x5f\x69\144", '');
        $Fr = variable_get("\155\x69\156\x69\x6f\x72\x61\x6e\147\x65\x5f\x73\141\x6d\154\x5f\x63\165\163\164\157\155\145\x72\x5f\x61\x70\x69\x5f\153\145\171", '');
        $Ob = round(microtime(TRUE) * 1000);
        $rc = $R4 . number_format($Ob, 0, '', '') . $Fr;
        $DF = hash("\x73\150\141\x35\x31\62", $rc);
        $zu = "\103\x75\x73\164\157\155\145\x72\x2d\x4b\145\x79\72\x20" . $R4;
        $EO = "\124\151\x6d\x65\x73\164\141\x6d\x70\x3a\x20" . number_format($Ob, 0, '', '');
        $SZ = "\101\165\x74\x68\157\162\151\172\141\x74\x69\157\156\x3a\40" . $DF;
        $Zq = '';
        $Zq = array("\143\165\163\164\157\x6d\x65\162\x49\144" => $R4, "\141\x70\x70\x6c\151\143\141\x74\151\x6f\x6e\x4e\141\x6d\145" => "\x64\x72\x75\x70\x61\x6c\x5f\x6d\x69\x6e\151\x6f\x72\141\156\x67\x65\x5f\x73\141\155\154\137\145\156\x74\x65\162\160\162\151\x73\x65\x5f\x70\x6c\141\156");
        $Uq = json_encode($Zq);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($XK, CURLOPT_AUTOREFERER, true);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($XK, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\145\156\164\x2d\x54\x79\x70\145\x3a\40\141\160\x70\154\151\143\141\x74\x69\x6f\x6e\x2f\152\163\157\156", $zu, $EO, $SZ));
        curl_setopt($XK, CURLOPT_POST, true);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        curl_setopt($XK, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($XK, CURLOPT_TIMEOUT, 20);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto uK;
        }
        return null;
        uK:
        curl_close($XK);
        return $Ar;
    }
}
