<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($xx, $ug, $xI)
    {
        $this->email = $xx;
        $this->phone = $ug;
        $this->query = $xI;
    }
    public function sendSupportQuery()
    {
        $this->query = "\x5b\104\x72\x75\160\x61\x6c\55\67\40\x53\x41\115\114\x20\x53\x50\x20\105\x6e\x74\x65\162\x70\x72\x69\x73\x65\x20\115\157\144\165\x6c\x65\135\x20" . $this->query;
        $Rx = array("\x63\157\155\160\141\x6e\x79" => $_SERVER["\x53\x45\122\x56\x45\x52\x5f\x4e\x41\115\x45"], "\x65\155\141\151\154" => $this->email, "\143\143\x45\155\x61\x69\154" => "\x64\162\x75\160\x61\x6c\x73\165\x70\x70\157\162\164\100\170\x65\143\x75\x72\151\146\x79\56\x63\157\155", "\160\x68\x6f\156\x65" => $this->phone, "\161\x75\x65\x72\x79" => $this->query, "\x73\165\142\x6a\x65\x63\x74" => "\x44\x72\x75\160\x61\154\x2d\x37\x20\123\101\115\114\x20\123\120\x20\105\156\x74\145\x72\x70\x72\151\x73\145\40\121\x75\x65\162\x79");
        $RR = json_encode($Rx);
        $aa = MiniorangeSAMLConstants::BASE_URL . "\x2f\155\157\x61\x73\57\162\x65\163\164\x2f\143\x75\163\164\x6f\x6d\x65\x72\57\143\157\x6e\x74\x61\x63\x74\55\x75\x73";
        $H6 = curl_init($aa);
        curl_setopt($H6, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($H6, CURLOPT_ENCODING, '');
        curl_setopt($H6, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($H6, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($H6, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($H6, CURLOPT_MAXREDIRS, 10);
        curl_setopt($H6, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\x65\x6e\164\x2d\124\x79\x70\145\x3a\x20\141\x70\x70\154\x69\x63\x61\164\x69\157\x6e\57\x6a\x73\x6f\156", "\x63\x68\141\x72\163\x65\164\x3a\x20\125\124\106\55\x38", "\x41\165\x74\x68\157\162\151\x7a\141\164\151\157\156\72\40\102\141\163\x69\143"));
        curl_setopt($H6, CURLOPT_POST, TRUE);
        curl_setopt($H6, CURLOPT_POSTFIELDS, $RR);
        $ry = curl_exec($H6);
        if (!curl_errno($H6)) {
            goto Ax;
        }
        $Ql = array("\x25\x6d\145\x74\150\x6f\144" => "\x73\145\x6e\x64\123\x75\160\160\157\162\x74\121\165\145\162\x79", "\45\x66\151\x6c\x65" => "\155\151\x6e\x69\157\x72\x61\x6e\x67\x65\x5f\x73\x61\x6d\x6c\137\x73\165\160\x70\x6f\x72\164\56\160\x68\x70", "\x25\145\x72\162\157\x72" => curl_error($H6));
        watchdog("\155\151\156\151\x6f\x72\x61\156\x67\x65\x5f\x73\141\155\154", "\143\125\122\114\x20\105\x72\162\157\162\x20\x61\164\40\45\x6d\145\164\150\x6f\x64\40\x6f\x66\40\x25\146\x69\x6c\145\x3a\x20\x25\145\x72\x72\x6f\x72", $Ql);
        return FALSE;
        Ax:
        curl_close($H6);
        return TRUE;
    }
}
