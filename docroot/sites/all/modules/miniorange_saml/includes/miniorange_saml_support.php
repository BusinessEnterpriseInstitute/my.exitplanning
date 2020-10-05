<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($EV, $nD, $AH)
    {
        $this->email = $EV;
        $this->phone = $nD;
        $this->query = $AH;
    }
    public function sendSupportQuery()
    {
        $this->query = "\x5b\104\162\x75\x70\x61\x6c\55\x37\x20\123\x41\x4d\114\40\123\x50\x20\105\x6e\x74\145\x72\x70\x72\151\163\x65\40\x4d\x6f\144\x75\154\x65\135\40" . $this->query;
        $TH = array("\143\157\x6d\160\141\156\171" => $_SERVER["\x53\x45\x52\126\105\x52\x5f\x4e\x41\115\105"], "\x65\155\x61\151\154" => $this->email, "\143\x63\105\155\141\151\154" => "\x64\x72\165\x70\141\154\163\165\x70\x70\157\x72\x74\x40\x78\x65\x63\x75\x72\151\146\x79\56\x63\157\155", "\160\150\157\156\x65" => $this->phone, "\x71\165\145\x72\x79" => $this->query, "\x73\165\142\152\x65\x63\164" => "\104\x72\165\x70\141\x6c\x2d\x37\40\123\101\115\114\40\123\120\x20\x45\x6e\164\x65\162\160\x72\151\163\145\x20\x51\165\145\162\x79");
        $Un = json_encode($TH);
        $Va = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\163\57\162\x65\x73\x74\57\143\165\x73\x74\x6f\x6d\x65\x72\x2f\143\157\156\164\141\x63\164\55\x75\163";
        $Sn = curl_init($Va);
        curl_setopt($Sn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Sn, CURLOPT_ENCODING, '');
        curl_setopt($Sn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Sn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Sn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Sn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Sn, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\145\x6e\x74\x2d\x54\171\x70\145\72\x20\141\x70\160\x6c\x69\143\x61\x74\151\x6f\x6e\x2f\152\x73\157\156", "\143\150\141\162\x73\x65\x74\x3a\40\125\124\x46\55\70", "\x41\x75\x74\x68\x6f\x72\x69\x7a\141\x74\x69\x6f\x6e\72\40\x42\141\x73\x69\143"));
        curl_setopt($Sn, CURLOPT_POST, TRUE);
        curl_setopt($Sn, CURLOPT_POSTFIELDS, $Un);
        $J3 = curl_exec($Sn);
        if (!curl_errno($Sn)) {
            goto Bj;
        }
        $kN = array("\x25\155\145\x74\x68\x6f\x64" => "\163\x65\x6e\144\123\165\x70\x70\157\x72\x74\121\x75\145\x72\x79", "\45\146\x69\154\x65" => "\155\151\156\151\157\162\141\156\x67\x65\137\163\141\155\154\137\x73\x75\160\x70\157\x72\164\x2e\160\x68\x70", "\45\x65\x72\x72\157\x72" => curl_error($Sn));
        watchdog("\155\x69\x6e\151\x6f\x72\141\156\147\x65\x5f\163\141\155\x6c", "\143\125\122\x4c\x20\105\x72\162\x6f\x72\40\x61\x74\40\x25\155\145\x74\x68\x6f\x64\40\x6f\x66\x20\45\146\151\x6c\x65\72\x20\x25\x65\x72\x72\x6f\x72", $kN);
        return FALSE;
        Bj:
        curl_close($Sn);
        return TRUE;
    }
}
