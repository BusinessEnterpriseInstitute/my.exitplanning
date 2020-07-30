<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($XI, $G9, $ZC)
    {
        $this->email = $XI;
        $this->phone = $G9;
        $this->query = $ZC;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\x44\162\165\x70\141\x6c\55\67\x20\x53\x41\115\x4c\x20\123\120\x20\x50\162\145\x6d\x69\x75\155\x20\x4d\157\x64\x75\x6c\x65\x5d\x20" . $this->query;
        $i5 = array("\143\157\155\x70\141\156\171" => $_SERVER["\x53\105\122\x56\x45\122\137\116\x41\115\105"], "\145\155\141\151\154" => $this->email, "\x63\143\x45\x6d\141\151\x6c" => "\x64\162\x75\160\141\x6c\163\x75\160\x70\157\162\164\x40\x78\x65\x63\x75\162\151\x66\x79\x2e\x63\x6f\155", "\160\x68\x6f\x6e\x65" => $this->phone, "\x71\x75\145\x72\171" => $this->query, "\x73\165\x62\152\145\143\164" => "\x44\x72\x75\160\x61\154\x2d\67\x20\x53\x41\115\x4c\x20\123\120\x20\120\x72\x65\x6d\151\165\x6d\x20\x51\x75\x65\x72\x79");
        $z0 = json_encode($i5);
        $Pk = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\141\163\57\162\145\163\x74\57\143\165\163\164\x6f\x6d\x65\162\x2f\x63\157\x6e\164\x61\143\x74\55\x75\163";
        $hV = curl_init($Pk);
        curl_setopt($hV, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($hV, CURLOPT_ENCODING, '');
        curl_setopt($hV, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($hV, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($hV, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($hV, CURLOPT_MAXREDIRS, 10);
        curl_setopt($hV, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\x6e\164\x2d\x54\171\160\x65\72\x20\141\x70\x70\154\151\x63\141\164\x69\x6f\x6e\x2f\152\163\157\x6e", "\143\x68\x61\162\163\x65\x74\72\x20\125\124\x46\55\x38", "\101\165\x74\x68\157\x72\151\x7a\x61\164\x69\x6f\x6e\72\x20\102\x61\163\151\143"));
        curl_setopt($hV, CURLOPT_POST, TRUE);
        curl_setopt($hV, CURLOPT_POSTFIELDS, $z0);
        $ej = curl_exec($hV);
        if (!curl_errno($hV)) {
            goto om;
        }
        $gn = array("\45\155\145\164\150\157\x64" => "\x73\145\x6e\x64\x53\x75\x70\x70\157\162\164\121\x75\145\162\171", "\45\x66\x69\x6c\145" => "\155\x69\156\x69\157\162\x61\x6e\x67\x65\x5f\163\141\155\154\x5f\163\165\160\160\x6f\162\164\56\160\150\160", "\45\145\162\162\x6f\162" => curl_error($hV));
        watchdog("\x6d\151\156\151\x6f\x72\x61\x6e\147\x65\137\163\x61\155\154", "\143\x55\x52\114\40\105\x72\162\x6f\162\x20\141\164\40\45\x6d\145\164\150\157\144\x20\x6f\x66\40\45\146\151\x6c\145\x3a\x20\45\145\x72\162\157\162", $gn);
        return FALSE;
        om:
        curl_close($hV);
        return TRUE;
    }
}
