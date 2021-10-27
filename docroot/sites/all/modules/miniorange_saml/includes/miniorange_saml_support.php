<?php


class MiniorangeSamlSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($aa, $wK, $PI)
    {
        $this->email = $aa;
        $this->phone = $wK;
        $this->query = $PI;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\104\x72\165\160\141\154\x2d\x37\x20\123\x41\x4d\114\40\x53\120\x20\105\x6e\x74\145\x72\160\x72\x69\x73\145\40\115\157\144\165\154\x65\135\40" . $this->query;
        $Zq = array("\x63\157\x6d\x70\x61\156\x79" => $_SERVER["\123\x45\x52\126\x45\x52\x5f\x4e\x41\115\x45"], "\x65\155\x61\151\154" => $this->email, "\x63\x63\x45\x6d\141\151\x6c" => "\x64\162\165\x70\141\x6c\163\165\x70\x70\x6f\162\164\100\x78\145\143\165\162\151\x66\171\56\x63\157\x6d", "\x70\150\157\x6e\145" => $this->phone, "\x71\x75\145\x72\171" => $this->query, "\x73\165\142\152\x65\143\164" => "\x44\x72\165\160\141\154\55\x37\x20\x53\x41\115\114\40\x53\120\x20\105\x6e\164\145\162\x70\x72\151\x73\145\x20\121\x75\145\x72\x79");
        $Uq = json_encode($Zq);
        $ae = MiniorangeSAMLConstants::BASE_URL . "\x2f\x6d\157\x61\163\x2f\162\x65\163\164\57\x63\165\x73\164\157\x6d\x65\x72\57\x63\157\x6e\x74\141\x63\164\55\x75\x73";
        $XK = curl_init($ae);
        curl_setopt($XK, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($XK, CURLOPT_ENCODING, '');
        curl_setopt($XK, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($XK, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($XK, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($XK, CURLOPT_MAXREDIRS, 10);
        curl_setopt($XK, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\145\156\164\x2d\124\171\160\145\x3a\x20\x61\x70\x70\154\x69\143\x61\x74\x69\x6f\156\57\152\163\157\156", "\x63\150\141\x72\163\x65\x74\72\40\125\x54\106\x2d\70", "\x41\x75\x74\x68\157\162\x69\172\x61\164\x69\157\156\72\x20\102\x61\x73\x69\143"));
        curl_setopt($XK, CURLOPT_POST, TRUE);
        curl_setopt($XK, CURLOPT_POSTFIELDS, $Uq);
        $Ar = curl_exec($XK);
        if (!curl_errno($XK)) {
            goto yj;
        }
        $NL = array("\x25\x6d\145\164\x68\157\144" => "\163\x65\x6e\x64\123\165\160\160\157\162\164\x51\x75\145\x72\x79", "\45\146\151\154\145" => "\x6d\x69\x6e\x69\x6f\x72\141\156\147\x65\x5f\x73\x61\155\x6c\x5f\163\x75\160\160\x6f\162\x74\56\160\150\x70", "\x25\x65\x72\x72\157\x72" => curl_error($XK));
        watchdog("\x6d\x69\156\151\157\162\x61\156\x67\145\137\163\x61\x6d\x6c", "\x63\125\122\114\40\x45\162\x72\x6f\162\x20\141\164\40\x25\155\x65\x74\150\157\x64\x20\x6f\146\x20\x25\x66\x69\154\x65\x3a\40\45\145\x72\x72\157\162", $NL);
        return FALSE;
        yj:
        curl_close($XK);
        return TRUE;
    }
}
