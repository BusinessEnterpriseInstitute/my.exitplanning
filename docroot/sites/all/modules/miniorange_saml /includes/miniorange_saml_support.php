<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($UX, $Vm, $hI)
    {
        $this->email = $UX;
        $this->phone = $Vm;
        $this->query = $hI;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\x44\162\x75\x70\x61\154\55\67\40\x53\101\115\114\x20\x53\120\40\127\151\x74\x68\x20\x4d\x75\154\164\151\160\x6c\145\x20\111\104\120\40\115\157\x64\x75\x6c\x65\135\x20" . $this->query;
        $Sc = array("\143\157\x6d\x70\141\x6e\x79" => $_SERVER["\x53\x45\x52\126\105\x52\x5f\x4e\101\115\105"], "\x65\x6d\141\151\x6c" => $this->email, "\143\x63\x45\x6d\x61\x69\x6c" => "\144\x72\165\160\x61\x6c\x73\165\x70\x70\x6f\162\x74\x40\170\145\143\x75\x72\151\x66\x79\x2e\x63\157\x6d", "\160\x68\x6f\x6e\145" => $this->phone, "\x71\x75\145\162\x79" => $this->query, "\163\x75\x62\152\x65\x63\164" => "\104\162\x75\160\x61\x6c\x2d\x37\40\123\101\x4d\x4c\x20\123\120\40\x57\x69\164\150\40\115\165\x6c\x74\x69\x70\154\x65\40\111\x44\x50\x20\x51\165\145\x72\x79");
        $GZ = json_encode($Sc);
        $eY = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\157\141\163\x2f\x72\145\163\164\57\x63\165\x73\164\157\155\145\x72\57\x63\157\156\x74\141\143\x74\55\x75\163";
        $Rn = curl_init($eY);
        curl_setopt($Rn, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Rn, CURLOPT_ENCODING, '');
        curl_setopt($Rn, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Rn, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Rn, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Rn, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Rn, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\x65\x6e\164\55\124\171\x70\x65\x3a\x20\x61\x70\x70\154\151\143\141\164\151\x6f\x6e\57\x6a\x73\157\156", "\x63\150\x61\162\x73\x65\164\x3a\x20\125\124\106\55\70", "\101\165\x74\150\157\162\x69\172\x61\x74\x69\157\156\72\x20\102\141\x73\x69\143"));
        curl_setopt($Rn, CURLOPT_POST, TRUE);
        curl_setopt($Rn, CURLOPT_POSTFIELDS, $GZ);
        $uj = curl_exec($Rn);
        if (!curl_errno($Rn)) {
            goto TJ;
        }
        $MA = array("\45\155\145\x74\x68\157\144" => "\x73\x65\x6e\x64\x53\165\160\160\157\x72\x74\x51\x75\x65\x72\x79", "\x25\146\151\154\x65" => "\155\151\156\x69\157\x72\x61\x6e\x67\145\x5f\163\x61\x6d\154\137\163\165\x70\160\157\x72\164\56\160\x68\x70", "\x25\145\162\162\x6f\x72" => curl_error($Rn));
        watchdog("\155\151\x6e\151\157\x72\x61\x6e\x67\x65\x5f\x73\141\155\154", "\x63\x55\122\x4c\40\105\x72\162\x6f\162\x20\x61\x74\x20\x25\155\x65\164\150\x6f\x64\x20\157\146\40\x25\x66\x69\x6c\145\x3a\40\45\145\162\x72\x6f\162", $MA);
        return FALSE;
        TJ:
        curl_close($Rn);
        return TRUE;
    }
}
