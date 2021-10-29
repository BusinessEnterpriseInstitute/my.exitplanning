<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($aW, $Lh, $wu)
    {
        $this->email = $aW;
        $this->phone = $Lh;
        $this->query = $wu;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\x44\x72\165\x70\x61\154\55\x37\40\x53\x41\x4d\x4c\x20\123\120\40\127\x69\164\x68\x20\x4d\x75\x6c\164\x69\160\x6c\145\x20\111\x44\120\x20\115\x6f\x64\165\x6c\x65\x5d\40" . $this->query;
        $LZ = array("\x63\x6f\x6d\x70\141\156\171" => $_SERVER["\123\x45\x52\126\x45\x52\x5f\x4e\x41\115\105"], "\145\x6d\141\x69\154" => $this->email, "\x63\x63\105\x6d\x61\x69\x6c" => "\x64\162\x75\160\141\154\163\165\160\x70\157\162\164\x40\170\145\143\x75\162\x69\146\171\56\x63\x6f\x6d", "\x70\150\x6f\156\145" => $this->phone, "\x71\165\x65\162\171" => $this->query, "\x73\x75\142\152\x65\x63\164" => "\104\x72\165\x70\x61\154\55\67\x20\123\x41\115\x4c\40\x53\120\x20\x57\151\x74\x68\40\115\x75\x6c\164\x69\x70\x6c\x65\x20\x49\x44\x50\40\121\x75\x65\x72\171");
        $PD = json_encode($LZ);
        $DM = MiniorangeSAMLConstants::BASE_URL . "\57\x6d\157\x61\x73\x2f\162\145\163\164\57\143\x75\x73\164\157\x6d\145\162\x2f\143\157\156\x74\141\143\164\55\x75\163";
        $I9 = curl_init($DM);
        curl_setopt($I9, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($I9, CURLOPT_ENCODING, '');
        curl_setopt($I9, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($I9, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($I9, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($I9, CURLOPT_MAXREDIRS, 10);
        curl_setopt($I9, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\156\164\55\x54\x79\x70\x65\72\x20\x61\x70\x70\154\x69\x63\141\164\151\157\156\x2f\152\163\x6f\156", "\143\x68\x61\x72\x73\145\x74\x3a\40\x55\124\106\x2d\70", "\x41\165\x74\x68\x6f\x72\151\172\x61\164\151\x6f\156\72\x20\102\141\163\x69\143"));
        curl_setopt($I9, CURLOPT_POST, TRUE);
        curl_setopt($I9, CURLOPT_POSTFIELDS, $PD);
        $qc = curl_exec($I9);
        if (!curl_errno($I9)) {
            goto D5;
        }
        $FK = array("\45\155\145\x74\x68\157\x64" => "\163\x65\156\x64\x53\165\160\160\x6f\162\164\x51\x75\x65\162\x79", "\x25\x66\x69\x6c\145" => "\155\x69\156\x69\157\x72\141\x6e\147\145\137\163\x61\155\x6c\137\x73\x75\160\160\x6f\162\164\x2e\160\150\160", "\x25\145\x72\x72\157\x72" => curl_error($I9));
        watchdog("\155\x69\156\151\157\162\141\156\x67\145\137\163\x61\x6d\154", "\143\x55\x52\114\40\x45\x72\x72\x6f\x72\x20\141\x74\x20\x25\x6d\x65\x74\150\x6f\144\x20\157\x66\x20\45\146\151\x6c\x65\72\x20\45\x65\162\x72\x6f\x72", $FK);
        return FALSE;
        D5:
        curl_close($I9);
        return TRUE;
    }
}
