<?php


class MiniorangeSAMLIdpSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($Wp, $xK, $bn)
    {
        $this->email = $Wp;
        $this->phone = $xK;
        $this->query = $bn;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\104\162\165\160\x61\x6c\x2d\67\x20\123\101\115\114\40\111\x44\120\40\x50\162\x65\x6d\x69\x75\155\x20\x4d\157\144\x75\154\x65\x5d\x20" . $this->query;
        $lw = array("\x63\x6f\x6d\160\x61\x6e\x79" => $_SERVER["\x53\x45\x52\x56\x45\122\137\116\x41\115\x45"], "\x65\155\141\x69\x6c" => $this->email, "\x63\x63\105\155\x61\x69\x6c" => "\144\162\x75\x70\x61\x6c\x73\x75\x70\x70\x6f\162\164\x40\170\x65\143\165\x72\151\146\x79\56\x63\x6f\x6d", "\x70\x68\x6f\x6e\145" => $this->phone, "\x71\x75\145\x72\x79" => $this->query, "\163\165\142\x6a\145\x63\x74" => "\104\x72\165\160\141\154\55\x37\40\123\101\x4d\114\x20\x49\104\120\40\x50\162\145\155\151\x75\x6d\x20\121\x75\x65\162\171");
        $CW = json_encode($lw);
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\157\141\163\57\x72\145\x73\164\57\x63\165\163\164\157\155\x65\162\x2f\x63\157\x6e\164\141\x63\x74\x2d\x75\x73";
        $MX = curl_init($nk);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($MX, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\145\156\x74\x2d\124\x79\x70\145\x3a\x20\141\x70\160\x6c\x69\143\141\x74\x69\157\156\x2f\x6a\163\157\x6e", "\x63\150\x61\162\x73\145\164\72\x20\125\124\106\x2d\70", "\x41\165\x74\x68\x6f\162\151\172\x61\x74\x69\x6f\x6e\x3a\x20\102\x61\163\x69\143"));
        curl_setopt($MX, CURLOPT_POST, TRUE);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto jO;
        }
        $Qu = array("\x25\x6d\145\x74\x68\157\x64" => "\163\x65\x6e\x64\123\165\160\160\x6f\x72\x74\121\x75\145\x72\x79", "\45\x66\151\x6c\x65" => "\155\x69\x6e\151\157\x72\x61\156\x67\145\137\163\x61\x6d\154\137\151\144\160\137\163\x75\160\x70\x6f\x72\164\56\x70\150\160", "\x25\145\162\x72\x6f\x72" => curl_error($MX));
        watchdog("\x6d\151\x6e\151\157\x72\141\156\147\x65\137\163\x61\x6d\x6c\137\x69\144\x70", "\x63\x55\x52\x4c\x20\105\x72\x72\x6f\x72\x20\x61\164\x20\x25\155\145\164\150\157\144\x20\157\146\x20\45\x66\x69\x6c\145\x3a\x20\x25\145\162\162\157\162", $Qu);
        return FALSE;
        jO:
        curl_close($MX);
        return TRUE;
    }
}
