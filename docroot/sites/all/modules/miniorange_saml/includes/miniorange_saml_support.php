<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($Ry, $EZ, $hO)
    {
        $this->email = $Ry;
        $this->phone = $EZ;
        $this->query = $hO;
    }
    public function sendSupportQuery()
    {
        $this->query = "\x5b\x44\x72\165\160\141\x6c\x2d\67\x20\x53\101\115\x4c\40\123\120\x20\105\x6e\x74\x65\x72\x70\x72\x69\163\x65\x20\x4d\x6f\x64\165\154\145\135\x20" . $this->query;
        $If = array("\x63\157\x6d\x70\141\156\x79" => $_SERVER["\x53\x45\122\126\105\122\137\x4e\x41\115\x45"], "\145\x6d\141\151\x6c" => $this->email, "\143\143\105\155\141\x69\154" => "\x64\162\x75\160\141\154\x73\165\160\160\x6f\162\x74\x40\170\145\x63\165\x72\151\146\171\56\x63\157\155", "\x70\150\157\156\145" => $this->phone, "\161\165\x65\162\171" => $this->query, "\163\x75\142\152\145\x63\x74" => "\104\162\x75\x70\x61\x6c\x2d\67\x20\123\101\115\x4c\40\x53\120\40\105\156\x74\x65\x72\x70\162\x69\163\145\40\121\x75\145\x72\171");
        $fQ = json_encode($If);
        $Rq = MiniorangeSAMLConstants::BASE_URL . "\57\155\x6f\x61\163\57\162\145\x73\164\57\x63\x75\163\164\x6f\x6d\145\x72\x2f\143\157\156\x74\x61\x63\x74\x2d\x75\163";
        $Yq = curl_init($Rq);
        curl_setopt($Yq, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($Yq, CURLOPT_ENCODING, '');
        curl_setopt($Yq, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($Yq, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($Yq, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($Yq, CURLOPT_MAXREDIRS, 10);
        curl_setopt($Yq, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\145\156\164\x2d\124\171\x70\145\72\40\x61\160\x70\154\x69\143\x61\164\x69\157\156\x2f\152\x73\x6f\x6e", "\x63\150\141\162\x73\x65\164\72\x20\x55\124\x46\55\70", "\101\165\x74\x68\157\x72\x69\x7a\141\164\x69\157\x6e\x3a\40\x42\x61\x73\151\x63"));
        curl_setopt($Yq, CURLOPT_POST, TRUE);
        curl_setopt($Yq, CURLOPT_POSTFIELDS, $fQ);
        $Mj = curl_exec($Yq);
        if (!curl_errno($Yq)) {
            goto VF;
        }
        $Cq = array("\x25\155\x65\x74\x68\x6f\x64" => "\163\145\156\x64\x53\165\160\160\x6f\x72\x74\x51\x75\145\162\171", "\45\x66\151\x6c\145" => "\155\151\156\x69\x6f\x72\141\x6e\147\x65\x5f\163\x61\x6d\154\x5f\x73\165\160\160\x6f\162\164\56\160\150\160", "\x25\x65\x72\x72\157\162" => curl_error($Yq));
        watchdog("\x6d\151\156\151\x6f\x72\141\x6e\147\x65\x5f\163\141\x6d\x6c", "\143\125\x52\x4c\x20\x45\162\x72\x6f\x72\40\x61\164\x20\45\x6d\145\x74\x68\157\x64\x20\x6f\x66\x20\45\x66\x69\x6c\145\x3a\40\45\145\x72\x72\157\x72", $Cq);
        return FALSE;
        VF:
        curl_close($Yq);
        return TRUE;
    }
}
