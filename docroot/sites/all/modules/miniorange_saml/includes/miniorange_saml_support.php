<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($NQ, $DC, $U3)
    {
        $this->email = $NQ;
        $this->phone = $DC;
        $this->query = $U3;
    }
    public function sendSupportQuery()
    {
        $this->query = "\x5b\x44\x72\x75\160\141\154\x2d\67\x20\123\x41\x4d\x4c\40\x53\120\40\105\156\x74\145\162\x70\x72\x69\x73\145\40\115\157\x64\165\x6c\x65\x5d\x20" . $this->query;
        $s0 = array("\143\x6f\155\x70\x61\156\171" => $_SERVER["\x53\x45\122\126\105\x52\x5f\116\x41\115\x45"], "\x65\155\x61\151\x6c" => $this->email, "\x63\x63\x45\155\141\x69\x6c" => "\x64\162\x75\x70\x61\154\163\x75\x70\160\x6f\x72\164\x40\x78\145\143\x75\162\151\146\171\56\x63\157\155", "\x70\x68\157\x6e\145" => $this->phone, "\161\165\x65\x72\x79" => $this->query, "\x73\x75\x62\x6a\145\143\164" => "\x44\x72\165\x70\x61\x6c\55\67\x20\123\101\x4d\114\40\123\x50\40\x45\156\x74\x65\162\x70\x72\151\163\145\40\x51\165\145\162\171");
        $Wp = json_encode($s0);
        $lY = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\57\162\145\163\x74\x2f\x63\165\163\164\x6f\155\x65\162\x2f\143\x6f\x6e\x74\x61\143\164\x2d\x75\163";
        $te = curl_init($lY);
        curl_setopt($te, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($te, CURLOPT_ENCODING, '');
        curl_setopt($te, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($te, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($te, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($te, CURLOPT_MAXREDIRS, 10);
        curl_setopt($te, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\145\x6e\164\x2d\x54\171\160\145\72\40\x61\160\160\x6c\x69\x63\141\x74\151\x6f\x6e\57\x6a\x73\157\156", "\143\150\x61\162\x73\x65\164\72\40\125\x54\106\55\70", "\x41\165\x74\150\157\162\x69\172\x61\x74\x69\157\156\72\40\102\141\x73\x69\x63"));
        curl_setopt($te, CURLOPT_POST, TRUE);
        curl_setopt($te, CURLOPT_POSTFIELDS, $Wp);
        $Cy = curl_exec($te);
        if (!curl_errno($te)) {
            goto o4;
        }
        $Pm = array("\x25\x6d\145\164\x68\x6f\x64" => "\163\x65\x6e\x64\x53\165\x70\160\x6f\162\164\121\x75\x65\162\171", "\x25\x66\x69\x6c\145" => "\x6d\x69\x6e\x69\x6f\162\x61\x6e\x67\145\137\x73\141\x6d\x6c\137\x73\x75\160\x70\x6f\162\164\56\x70\150\x70", "\x25\x65\x72\162\157\162" => curl_error($te));
        watchdog("\155\x69\x6e\x69\x6f\162\x61\x6e\x67\x65\137\x73\141\x6d\154", "\x63\125\122\114\40\x45\162\162\157\x72\x20\141\164\x20\x25\155\x65\x74\x68\157\x64\40\157\x66\40\45\146\x69\154\145\72\40\x25\145\162\162\157\162", $Pm);
        return FALSE;
        o4:
        curl_close($te);
        return TRUE;
    }
}
