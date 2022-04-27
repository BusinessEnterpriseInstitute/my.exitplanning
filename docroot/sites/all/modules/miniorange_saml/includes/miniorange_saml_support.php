<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($k6, $GC, $rD)
    {
        $this->email = $k6;
        $this->phone = $GC;
        $this->query = $rD;
    }
    public function sendSupportQuery()
    {
        $this->query = "\x5b\104\x72\165\160\141\154\55\67\x20\123\x41\x4d\114\x20\123\120\x20\127\x69\x74\x68\40\115\165\154\164\151\160\x6c\145\x20\x49\104\x50\40\x4d\157\144\165\x6c\145\x5d\40" . $this->query;
        $qS = array("\x63\x6f\155\x70\x61\156\171" => $_SERVER["\x53\x45\x52\126\105\x52\x5f\116\x41\x4d\105"], "\145\x6d\x61\151\154" => $this->email, "\x63\x63\105\155\141\x69\154" => "\144\162\x75\160\141\x6c\x73\x75\160\x70\157\162\164\x40\170\145\x63\165\x72\x69\x66\171\x2e\143\x6f\155", "\x70\x68\x6f\156\145" => $this->phone, "\x71\165\145\x72\x79" => $this->query, "\x73\165\x62\x6a\145\x63\x74" => "\x44\162\x75\x70\141\154\x2d\x37\x20\123\x41\115\114\x20\123\x50\40\127\151\164\150\40\x4d\x75\154\x74\151\160\154\x65\40\x49\x44\x50\x20\121\165\x65\162\x79");
        $cW = json_encode($qS);
        $P4 = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\157\141\x73\x2f\162\145\x73\164\57\143\165\163\x74\x6f\x6d\x65\162\x2f\143\157\x6e\164\x61\x63\164\x2d\x75\163";
        $Ey = curl_init($P4);
        curl_setopt($Ey, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Ey, CURLOPT_ENCODING, '');
        curl_setopt($Ey, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Ey, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Ey, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Ey, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Ey, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\156\x74\x2d\124\171\x70\x65\72\40\x61\160\160\x6c\151\x63\141\x74\x69\x6f\156\57\152\x73\157\156", "\143\150\141\162\x73\145\164\72\40\x55\124\x46\55\x38", "\x41\165\164\150\157\x72\151\172\141\x74\151\x6f\x6e\x3a\x20\x42\141\163\151\x63"));
        curl_setopt($Ey, CURLOPT_POST, TRUE);
        curl_setopt($Ey, CURLOPT_POSTFIELDS, $cW);
        $Ez = curl_exec($Ey);
        if (!curl_errno($Ey)) {
            goto n7;
        }
        $be = array("\45\155\x65\164\x68\x6f\144" => "\163\x65\x6e\x64\x53\x75\160\x70\157\162\x74\121\165\x65\162\171", "\45\x66\x69\154\x65" => "\x6d\x69\156\151\157\162\141\156\x67\145\137\x73\x61\155\154\137\x73\165\160\x70\157\x72\x74\x2e\x70\x68\x70", "\x25\145\162\x72\x6f\x72" => curl_error($Ey));
        watchdog("\x6d\x69\156\x69\x6f\162\141\156\x67\145\137\163\x61\155\154", "\143\x55\122\x4c\40\105\x72\x72\x6f\162\40\x61\164\x20\45\155\x65\x74\x68\x6f\x64\40\157\x66\x20\x25\x66\151\154\145\72\x20\45\x65\162\162\x6f\162", $be);
        return FALSE;
        n7:
        curl_close($Ey);
        return TRUE;
    }
}
