<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($fB, $KC, $jS)
    {
        $this->email = $fB;
        $this->phone = $KC;
        $this->query = $jS;
    }
    public function sendSupportQuery()
    {
        $this->query = "\x5b\x44\x72\165\160\x61\x6c\x2d\x37\40\123\101\115\x4c\40\x53\x50\x20\x57\x69\x74\150\40\x4d\165\x6c\x74\x69\x70\154\x65\x20\x49\x44\120\40\115\157\144\x75\x6c\x65\x5d\x20" . $this->query;
        $Cs = array("\143\x6f\155\160\141\156\171" => $_SERVER["\x53\105\x52\x56\x45\122\x5f\116\101\x4d\105"], "\x65\x6d\141\151\154" => $this->email, "\x63\x63\105\155\x61\x69\154" => "\144\x72\x75\x70\x61\154\x73\x75\x70\x70\x6f\x72\164\x40\x78\x65\x63\165\x72\151\x66\x79\x2e\x63\x6f\155", "\160\150\157\x6e\x65" => $this->phone, "\161\x75\x65\x72\x79" => $this->query, "\163\x75\x62\x6a\145\143\164" => "\x44\x72\165\x70\141\154\x2d\67\40\x53\101\115\x4c\x20\x53\x50\40\x57\x69\x74\x68\40\115\x75\x6c\x74\151\160\x6c\145\x20\111\x44\120\40\121\165\x65\x72\171");
        $Xm = json_encode($Cs);
        $e2 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\x73\x2f\162\x65\x73\164\x2f\x63\165\x73\x74\x6f\x6d\x65\x72\57\143\x6f\156\164\x61\143\164\x2d\x75\163";
        $Ao = curl_init($e2);
        curl_setopt($Ao, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ao, CURLOPT_ENCODING, '');
        curl_setopt($Ao, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ao, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ao, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ao, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ao, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\145\156\164\x2d\124\x79\160\x65\x3a\40\141\x70\x70\x6c\151\x63\141\164\x69\157\156\57\x6a\x73\x6f\156", "\143\x68\141\162\x73\x65\x74\72\x20\x55\124\x46\55\70", "\101\x75\x74\150\157\x72\x69\172\141\x74\x69\157\156\x3a\40\x42\x61\163\x69\143"));
        curl_setopt($Ao, CURLOPT_POST, TRUE);
        curl_setopt($Ao, CURLOPT_POSTFIELDS, $Xm);
        $uG = curl_exec($Ao);
        if (!curl_errno($Ao)) {
            goto Du;
        }
        $On = array("\45\155\145\164\150\x6f\144" => "\x73\145\156\144\x53\x75\160\x70\x6f\x72\164\x51\165\145\162\171", "\x25\x66\151\x6c\x65" => "\x6d\x69\x6e\x69\157\x72\x61\156\x67\145\137\x73\141\155\x6c\137\x73\x75\x70\x70\x6f\162\x74\56\160\150\x70", "\45\145\x72\x72\x6f\x72" => curl_error($Ao));
        watchdog("\x6d\151\x6e\x69\x6f\162\x61\156\147\x65\137\x73\x61\x6d\154", "\143\x55\122\x4c\40\x45\162\x72\x6f\x72\x20\x61\x74\x20\x25\x6d\x65\164\150\157\x64\x20\157\x66\x20\x25\x66\x69\x6c\x65\72\x20\x25\145\162\x72\x6f\x72", $On);
        return FALSE;
        Du:
        curl_close($Ao);
        return TRUE;
    }
}
