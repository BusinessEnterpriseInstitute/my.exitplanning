<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($hB, $LS, $pd)
    {
        $this->email = $hB;
        $this->phone = $LS;
        $this->query = $pd;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\104\x72\165\160\x61\154\x2d\x37\x20\x53\101\115\x4c\x20\x53\120\x20\127\151\164\150\40\115\x75\154\x74\x69\x70\154\145\x20\111\104\x50\40\x4d\157\x64\x75\x6c\x65\135\x20" . $this->query;
        $II = array("\x63\x6f\x6d\x70\141\x6e\171" => $_SERVER["\123\105\122\126\105\x52\x5f\116\101\x4d\105"], "\145\x6d\141\151\154" => $this->email, "\x63\143\x45\x6d\141\151\154" => "\x64\x72\165\x70\141\x6c\163\165\160\x70\x6f\162\164\x40\170\x65\x63\x75\x72\151\146\x79\x2e\143\157\x6d", "\160\150\157\156\x65" => $this->phone, "\x71\165\145\x72\x79" => $this->query, "\x73\x75\x62\152\x65\x63\164" => "\x44\x72\165\x70\141\x6c\55\x37\x20\123\x41\x4d\114\40\x53\120\x20\x57\x69\164\150\x20\115\x75\154\x74\151\160\x6c\145\x20\111\x44\120\40\x51\x75\x65\x72\171");
        $VE = json_encode($II);
        $z6 = MiniorangeSAMLConstants::BASE_URL . "\57\155\157\x61\163\x2f\x72\x65\163\164\x2f\x63\165\x73\x74\x6f\155\x65\x72\57\x63\157\156\164\141\x63\164\55\x75\163";
        $xI = curl_init($z6);
        curl_setopt($xI, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($xI, CURLOPT_ENCODING, '');
        curl_setopt($xI, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($xI, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($xI, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($xI, CURLOPT_MAXREDIRS, 10);
        curl_setopt($xI, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\x65\156\x74\x2d\x54\x79\160\x65\72\x20\x61\160\x70\x6c\151\x63\x61\x74\151\157\x6e\x2f\152\163\x6f\156", "\x63\150\141\x72\163\145\164\72\40\x55\124\106\55\70", "\101\x75\x74\150\x6f\162\151\172\x61\x74\x69\x6f\x6e\72\40\102\x61\x73\x69\143"));
        curl_setopt($xI, CURLOPT_POST, TRUE);
        curl_setopt($xI, CURLOPT_POSTFIELDS, $VE);
        $WD = curl_exec($xI);
        if (!curl_errno($xI)) {
            goto Id;
        }
        $X4 = array("\x25\155\x65\x74\x68\157\144" => "\x73\x65\x6e\x64\123\165\160\x70\157\162\164\121\165\145\x72\x79", "\45\146\x69\154\145" => "\155\151\156\x69\157\x72\141\x6e\147\145\x5f\x73\141\x6d\x6c\137\163\165\160\160\x6f\162\x74\56\160\x68\x70", "\45\145\x72\x72\157\162" => curl_error($xI));
        watchdog("\x6d\x69\156\x69\157\x72\141\x6e\147\145\137\x73\141\155\154", "\143\x55\x52\x4c\x20\x45\x72\162\x6f\x72\x20\141\x74\x20\x25\x6d\145\x74\150\157\x64\40\x6f\x66\x20\x25\146\x69\154\x65\72\40\45\x65\162\162\x6f\162", $X4);
        return FALSE;
        Id:
        curl_close($xI);
        return TRUE;
    }
}
