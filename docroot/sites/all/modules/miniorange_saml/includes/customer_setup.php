<?php


class MiniorangeSAMLCustomer
{
    public $email;
    public $customerKey;
    public $transactionId;
    public $password;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($Ry, $Qd)
    {
        $this->email = $Ry;
        $this->password = $Qd;
        $this->defaultCustomerId = "\61\x36\x35\x35\x35";
        $this->defaultCustomerApiKey = "\x66\106\x64\x32\130\x63\166\124\x47\104\x65\x6d\132\x76\142\167\61\x62\x63\x55\x65\x73\116\112\127\x45\161\x4b\142\x62\125\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto DY;
        }
        return json_encode(array("\163\164\x61\164\x75\163" => "\x43\x55\x52\114\137\105\122\122\x4f\122", "\163\x74\x61\x74\165\x73\x4d\x65\163\x73\x61\147\x65" => "\x3c\141\40\150\162\145\146\75\42\x68\164\x74\160\72\57\57\160\x68\160\x2e\x6e\x65\x74\x2f\155\x61\156\x75\141\x6c\x2f\145\x6e\57\143\165\x72\154\x2e\151\x6e\163\x74\141\154\x6c\x61\164\151\157\x6e\56\160\x68\160\42\x3e\120\110\120\x20\143\x55\x52\x4c\x20\x65\x78\x74\x65\156\x73\151\x6f\156\x3c\57\x61\76\40\x69\x73\40\156\157\x74\x20\x69\x6e\163\164\141\x6c\x6c\x65\x64\40\157\162\x20\x64\x69\x73\141\x62\154\x65\144\56"));
        DY:
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\x6f\x61\163\57\162\145\x73\164\x2f\143\165\x73\x74\x6f\155\145\162\x2f\143\x68\x65\143\x6b\55\151\x66\55\x65\170\x69\x73\164\x73";
        $Yq = curl_init($Rq);
        $Ry = $this->email;
        $If = array("\x65\155\x61\x69\x6c" => $Ry);
        $fQ = json_encode($If);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\x6e\x74\x2d\124\x79\160\145\72\40\141\x70\x70\154\151\x63\141\164\151\157\x6e\57\x6a\163\157\x6e", "\x63\x68\141\162\x73\145\x74\x3a\40\x55\x54\x46\40\x2d\x20\70", "\x41\x75\x74\150\x6f\162\x69\x7a\x61\164\x69\x6f\156\72\x20\x42\141\x73\x69\x63"));
        curl_setopt($Yq, CURLOPT_POST, TRUE);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto sw;
        }
        $Cq = array("\45\155\145\x74\150\157\144" => "\143\150\x65\x63\x6b\x43\x75\x73\x74\x6f\x6d\145\162", "\x25\146\151\x6c\145" => "\143\x75\163\164\x6f\x6d\145\162\137\x73\145\164\x75\160\x2e\x70\150\x70", "\45\x65\162\162\x6f\162" => curl_error($Yq));
        watchdog("\155\x69\x6e\151\x6f\x72\x61\156\147\x65\x5f\x73\141\x6d\154", "\105\x72\x72\157\x72\40\141\164\x20\45\x6d\145\x74\150\x6f\144\40\x6f\146\x20\x25\x66\151\x6c\x65\72\40\x25\x65\x72\162\x6f\x72", $Cq);
        sw:
        curl_close($Yq);
        return $Mj;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Gx;
        }
        return json_encode(array("\163\x74\141\x74\165\163\x43\x6f\x64\145" => "\x45\x52\x52\x4f\x52", "\x73\x74\x61\x74\165\x73\x4d\x65\x73\x73\x61\x67\x65" => "\56\x20\x50\x6c\x65\x61\163\145\40\143\x68\145\x63\x6b\x20\x79\157\x75\x72\40\143\157\x6e\146\x69\x67\x75\x72\x61\164\x69\x6f\156\56"));
        Gx:
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\x6f\x61\x73\57\162\145\x73\164\x2f\x63\165\163\x74\157\155\145\162\57\141\144\144";
        $Yq = curl_init($Rq);
        $If = array("\x63\157\155\x70\x61\156\171\116\x61\x6d\145" => $_SERVER["\x53\105\x52\x56\x45\122\x5f\116\101\x4d\x45"], "\141\x72\145\141\117\146\111\x6e\x74\x65\162\145\x73\x74" => "\104\162\x75\160\141\x6c\40\123\x41\115\x4c\x20\x50\154\x75\147\x69\x6e\x20\x2d\x20\120\x72\145\x6d\x69\x75\x6d", "\145\x6d\141\151\x6c" => $this->email, "\x70\150\157\x6e\145" => $this->phone, "\x70\141\x73\163\167\157\x72\x64" => $this->password);
        $fQ = json_encode($If);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\x65\x6e\164\x2d\124\171\x70\x65\x3a\40\x61\x70\160\154\x69\x63\x61\164\x69\157\156\x2f\x6a\x73\157\x6e", "\143\x68\141\x72\163\145\164\x3a\40\125\124\x46\x20\55\40\70", "\x41\165\164\x68\x6f\162\x69\172\x61\x74\151\157\156\x3a\40\102\x61\x73\x69\x63"));
        curl_setopt($Yq, CURLOPT_POST, TRUE);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto ES;
        }
        $Cq = array("\x25\x6d\x65\164\x68\x6f\x64" => "\143\162\145\141\x74\145\103\x75\x73\164\157\x6d\x65\162", "\45\x66\151\154\x65" => "\143\x75\x73\x74\157\x6d\x65\x72\x5f\x73\145\164\165\160\56\x70\x68\x70", "\x25\145\x72\x72\x6f\162" => curl_error($Yq));
        watchdog("\x6d\151\156\151\x6f\162\141\x6e\x67\145\x5f\163\x61\155\154", "\x45\162\x72\x6f\162\40\x61\164\x20\x25\155\x65\x74\x68\157\x64\40\x6f\x66\40\x25\x66\151\x6c\x65\x3a\x20\45\x65\x72\162\157\x72", $Cq);
        ES:
        curl_close($Yq);
        return $Mj;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto gC;
        }
        return json_encode(array("\141\160\151\x4b\145\x79" => "\x43\125\x52\x4c\x5f\105\x52\122\117\x52", "\x74\x6f\x6b\x65\x6e" => "\74\x61\40\x68\162\145\x66\75\x22\x68\164\x74\x70\72\57\57\160\150\160\56\x6e\145\164\x2f\x6d\141\x6e\165\141\154\x2f\x65\156\x2f\143\x75\162\x6c\x2e\151\156\x73\164\141\154\x6c\x61\x74\x69\x6f\x6e\56\160\x68\x70\42\x3e\x50\x48\120\40\x63\125\x52\114\x20\145\x78\x74\145\x6e\163\151\157\x6e\74\x2f\141\76\40\151\163\40\156\x6f\164\x20\x69\x6e\163\x74\x61\154\x6c\145\x64\40\157\162\40\x64\x69\x73\141\x62\154\145\x64\x2e"));
        gC:
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\x61\163\x2f\x72\145\x73\164\57\x63\x75\163\164\x6f\155\145\x72\57\x6b\x65\171";
        $Yq = curl_init($Rq);
        $Ry = $this->email;
        $Qd = $this->password;
        $If = array("\145\x6d\141\151\x6c" => $Ry, "\x70\x61\163\163\x77\157\162\x64" => $Qd);
        $fQ = json_encode($If);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\x43\x6f\156\x74\145\156\164\55\x54\171\x70\145\x3a\x20\141\160\160\x6c\151\x63\141\164\151\157\156\57\152\x73\157\x6e", "\x63\x68\141\162\163\145\x74\72\40\x55\124\x46\x20\x2d\40\70", "\x41\165\164\150\x6f\x72\151\172\x61\x74\151\x6f\x6e\x3a\x20\102\x61\163\151\143"));
        curl_setopt($Yq, CURLOPT_POST, TRUE);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto fk;
        }
        $Cq = array("\45\155\x65\164\x68\157\144" => "\x67\145\x74\103\x75\x73\x74\x6f\x6d\x65\162\x4b\145\171\163", "\45\x66\151\154\145" => "\143\165\163\164\x6f\155\x65\x72\x5f\163\145\164\x75\x70\56\x70\150\160", "\x25\145\162\162\157\162" => curl_error($Yq));
        watchdog("\155\151\x6e\x69\x6f\162\x61\x6e\147\x65\137\163\141\155\154", "\105\x72\162\x6f\162\x20\x61\164\x20\45\155\x65\x74\150\157\144\40\157\146\40\45\146\x69\x6c\145\72\x20\x25\145\162\x72\x6f\162", $Cq);
        fk:
        curl_close($Yq);
        return $Mj;
    }
    function verifyLicense($BJ)
    {
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\141\x73\x2f\x61\160\x69\x2f\x62\141\143\153\165\x70\143\157\144\x65\57\166\x65\x72\151\x66\x79";
        $Yq = curl_init($Rq);
        $z7 = variable_get("\155\x69\x6e\x69\157\162\141\x6e\x67\145\137\x73\141\155\154\x5f\x63\165\163\x74\157\x6d\145\x72\x5f\151\x64");
        $TP = variable_get("\155\x69\156\151\157\x72\x61\156\x67\x65\x5f\x73\x61\155\x6c\x5f\143\x75\163\x74\157\155\145\162\x5f\x61\160\151\x5f\153\x65\x79");
        global $base_url;
        $cv = round(microtime(TRUE) * 1000);
        $XC = $z7 . number_format($cv, 0, '', '') . $TP;
        $rA = hash("\163\x68\x61\x35\x31\x32", $XC);
        $Qf = "\x43\x75\163\164\x6f\155\145\162\55\113\145\x79\x3a\40" . $z7;
        $c7 = "\124\x69\x6d\x65\x73\x74\x61\x6d\x70\x3a\40" . number_format($cv, 0, '', '');
        $Nd = "\x41\x75\x74\x68\157\162\151\x7a\141\x74\x69\157\156\72\40" . $rA;
        $If = '';
        $If = array("\143\157\144\145" => $BJ, "\x63\165\x73\164\157\155\x65\162\113\x65\x79" => $z7, "\141\144\144\x69\164\151\157\x6e\141\x6c\x46\151\145\x6c\x64\x73" => array("\146\151\x65\154\x64\61" => $base_url));
        $fQ = json_encode($If);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, true);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\x65\156\x74\55\x54\x79\x70\145\72\40\141\x70\160\154\151\143\x61\x74\151\x6f\x6e\x2f\x6a\163\157\x6e", $Qf, $c7, $Nd));
        curl_setopt($Yq, CURLOPT_POST, true);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        curl_setopt($Yq, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Yq, CURLOPT_TIMEOUT, 20);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto gr;
        }
        echo "\x52\145\161\165\145\163\164\x20\105\162\x72\x6f\x72\72" . curl_error($Yq);
        die;
        gr:
        curl_close($Yq);
        return $Mj;
    }
    function updateStatus()
    {
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\141\163\x2f\x61\x70\151\57\x62\141\143\153\165\x70\x63\x6f\144\x65\x2f\x75\160\144\x61\164\145\163\x74\141\x74\165\x73";
        $Yq = curl_init($Rq);
        $z7 = variable_get("\x6d\151\x6e\x69\157\162\x61\156\x67\x65\137\x73\x61\x6d\x6c\137\x63\165\x73\x74\157\155\x65\x72\137\x69\144");
        $TP = variable_get("\155\x69\156\151\157\x72\141\156\x67\x65\137\163\141\x6d\x6c\x5f\x63\165\163\164\157\155\x65\162\x5f\x61\x70\x69\x5f\x6b\145\171");
        $cv = round(microtime(TRUE) * 1000);
        $XC = $z7 . number_format($cv, 0, '', '') . $TP;
        $rA = hash("\x73\x68\x61\65\61\x32", $XC);
        $Qf = "\x43\x75\x73\x74\157\155\x65\x72\x2d\x4b\x65\171\x3a\40" . $z7;
        $c7 = "\x54\x69\155\x65\163\x74\141\155\160\72\40" . number_format($cv, 0, '', '');
        $Nd = "\x41\x75\x74\150\157\x72\x69\172\x61\164\x69\x6f\x6e\72\x20" . $rA;
        $l9 = variable_get("\x6d\151\x6e\x69\x6f\162\141\156\147\x65\137\x73\141\155\x6c\137\x63\165\x73\164\157\155\x65\162\x5f\141\144\155\151\156\137\164\157\153\x65\156");
        $BJ = AESEncryption::decrypt_data(variable_get("\155\x69\x6e\151\x6f\x72\141\156\x67\x65\x5f\163\141\155\154\x5f\154\151\143\x65\156\x73\x65\x5f\x6b\145\x79"), $l9);
        $If = array("\x63\x6f\144\x65" => $BJ, "\x63\165\x73\x74\157\155\x65\x72\113\x65\x79" => $z7);
        $fQ = json_encode($If);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, true);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\x43\x6f\156\x74\x65\x6e\x74\55\x54\171\160\x65\x3a\40\141\160\x70\154\x69\143\x61\x74\151\157\156\x2f\x6a\x73\157\x6e", $Qf, $c7, $Nd));
        curl_setopt($Yq, CURLOPT_POST, true);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        curl_setopt($Yq, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Yq, CURLOPT_TIMEOUT, 20);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto zO;
        }
        echo "\x52\x65\x71\165\145\163\x74\x20\x45\162\162\157\x72\72" . curl_error($Yq);
        die;
        zO:
        curl_close($Yq);
        return $Mj;
    }
    function ccl()
    {
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\x6f\x61\x73\57\x72\145\x73\164\x2f\143\165\163\164\x6f\x6d\145\162\x2f\154\151\x63\145\156\x73\145";
        $Yq = curl_init($Rq);
        $z7 = variable_get("\155\151\156\x69\157\x72\x61\156\147\x65\137\x73\141\x6d\154\137\143\165\163\x74\157\155\145\x72\x5f\151\144", '');
        $TP = variable_get("\155\151\156\151\x6f\162\x61\156\x67\x65\137\x73\x61\155\154\137\143\x75\163\x74\x6f\155\145\162\x5f\141\160\151\x5f\153\145\x79", '');
        $cv = round(microtime(TRUE) * 1000);
        $XC = $z7 . number_format($cv, 0, '', '') . $TP;
        $rA = hash("\163\x68\x61\x35\61\x32", $XC);
        $Qf = "\x43\x75\163\x74\x6f\x6d\x65\x72\x2d\113\x65\x79\72\40" . $z7;
        $c7 = "\124\x69\155\x65\163\x74\141\155\160\72\x20" . number_format($cv, 0, '', '');
        $Nd = "\101\x75\164\150\157\162\151\172\141\x74\x69\157\x6e\72\x20" . $rA;
        $If = '';
        $If = array("\x63\x75\163\164\x6f\x6d\145\x72\111\144" => $z7, "\141\160\160\154\x69\x63\x61\164\x69\157\x6e\x4e\x61\155\x65" => "\144\x72\x75\160\141\154\x5f\155\151\x6e\x69\157\x72\x61\156\x67\145\x5f\163\x61\155\154\137\x65\x6e\x74\x65\162\x70\162\x69\163\145\137\x70\154\141\x6e");
        $fQ = json_encode($If);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, true);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\x6e\x74\55\x54\171\x70\145\72\x20\x61\x70\160\x6c\151\x63\141\x74\x69\157\x6e\x2f\152\x73\157\x6e", $Qf, $c7, $Nd));
        curl_setopt($Yq, CURLOPT_POST, true);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        curl_setopt($Yq, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($Yq, CURLOPT_TIMEOUT, 20);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto Md;
        }
        return null;
        Md:
        curl_close($Yq);
        return $Mj;
    }
}
