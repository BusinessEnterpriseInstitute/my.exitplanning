<?php


class MiniorangeSAMLIdpCustomer
{
    public $email;
    public $phone;
    public $customerKey;
    public $transactionId;
    public $password;
    public $otpToken;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($Wp, $xK, $UB, $YQ)
    {
        $this->email = $Wp;
        $this->phone = $xK;
        $this->password = $UB;
        $this->otpToken = $YQ;
        $this->defaultCustomerId = "\x31\66\x35\65\65";
        $this->defaultCustomerApiKey = "\146\x46\x64\x32\130\x63\166\124\x47\x44\x65\155\x5a\166\x62\167\x31\142\143\125\145\x73\x4e\112\x57\x45\x71\x4b\x62\142\x55\161";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto cJ;
        }
        return json_encode(array("\163\x74\141\164\x75\x73" => "\103\x55\x52\114\137\105\122\x52\x4f\x52", "\163\x74\x61\164\x75\163\x4d\x65\x73\163\x61\x67\x65" => "\74\141\40\x68\x72\x65\146\x3d\x22\150\164\x74\x70\72\57\x2f\x70\x68\160\56\x6e\145\164\x2f\x6d\x61\156\165\141\154\57\145\156\x2f\x63\x75\x72\154\x2e\151\156\x73\164\141\154\154\x61\x74\151\157\x6e\56\x70\x68\160\42\76\x50\110\x50\40\143\x55\122\x4c\x20\x65\170\164\145\x6e\x73\x69\x6f\x6e\74\x2f\141\x3e\40\151\163\x20\156\157\x74\x20\151\x6e\163\164\x61\154\154\x65\x64\40\157\162\40\x64\151\163\141\x62\x6c\x65\144\56"));
        cJ:
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\x6f\x61\x73\57\162\145\163\164\57\143\x75\x73\x74\157\155\x65\x72\x2f\143\150\x65\x63\153\55\x69\x66\55\145\x78\151\x73\x74\163";
        $MX = curl_init($nk);
        $Wp = $this->email;
        $lw = array("\x65\155\x61\151\x6c" => $Wp);
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($MX, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\157\156\164\145\x6e\x74\55\124\x79\160\x65\x3a\x20\141\x70\x70\154\x69\143\x61\x74\x69\x6f\x6e\57\x6a\163\x6f\156", "\143\150\x61\x72\x73\x65\164\x3a\40\x55\x54\x46\x20\55\40\70", "\x41\x75\x74\x68\157\162\151\172\141\164\x69\157\x6e\x3a\40\x42\141\163\x69\143"));
        curl_setopt($MX, CURLOPT_POST, TRUE);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto hu;
        }
        $Qu = array("\45\x6d\x65\x74\150\157\x64" => "\x63\150\145\143\153\x43\165\163\x74\x6f\155\x65\162", "\x25\146\x69\154\145" => "\143\x75\x73\x74\x6f\155\x65\162\137\x73\x65\x74\x75\x70\56\x70\x68\x70", "\45\x65\162\162\157\162" => curl_error($MX));
        watchdog("\x6d\151\x6e\151\157\x72\x61\x6e\x67\x65\x5f\163\x61\155\154\x5f\x69\x64\x70", "\x45\x72\162\x6f\162\x20\x61\164\x20\x25\x6d\145\164\150\x6f\x64\40\157\146\x20\x25\146\x69\x6c\145\72\x20\45\145\x72\162\x6f\162", $Qu);
        hu:
        curl_close($MX);
        return $ME;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto aA;
        }
        return json_encode(array("\x73\164\x61\164\x75\163\x43\x6f\x64\x65" => "\105\122\x52\x4f\x52", "\x73\164\x61\x74\x75\x73\115\x65\x73\163\141\147\x65" => "\x2e\40\x50\154\x65\x61\x73\145\x20\143\150\x65\x63\153\x20\171\157\x75\x72\x20\143\x6f\156\x66\151\147\165\162\x61\x74\x69\x6f\156\56"));
        aA:
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\x6f\141\163\x2f\162\x65\x73\164\57\x63\165\163\x74\157\155\x65\x72\x2f\141\x64\144";
        $MX = curl_init($nk);
        $lw = array("\x63\x6f\x6d\x70\141\156\171\116\141\x6d\145" => $_SERVER["\123\105\x52\126\105\x52\x5f\x4e\x41\x4d\x45"], "\141\162\145\x61\117\x66\x49\x6e\x74\x65\162\145\x73\164" => "\104\x52\125\120\x41\114\40\x49\104\x50\40\x50\154\x75\x67\151\x6e", "\x65\x6d\x61\x69\x6c" => $this->email, "\160\150\157\x6e\145" => $this->phone, "\160\x61\x73\x73\167\x6f\162\x64" => $this->password);
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($MX, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\x74\145\156\164\55\124\171\x70\145\72\x20\x61\x70\x70\x6c\151\x63\141\164\151\157\x6e\57\x6a\x73\157\156", "\143\x68\x61\162\163\145\x74\72\40\125\x54\x46\40\x2d\x20\70", "\x41\x75\x74\150\x6f\x72\151\172\141\x74\x69\x6f\x6e\72\40\x42\x61\163\x69\x63"));
        curl_setopt($MX, CURLOPT_POST, TRUE);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto xb;
        }
        $Qu = array("\x25\155\x65\x74\150\x6f\x64" => "\x63\x72\145\x61\x74\x65\x43\165\x73\164\157\155\x65\162", "\45\x66\x69\x6c\145" => "\x63\165\163\164\157\x6d\145\x72\x5f\163\145\164\x75\160\x2e\160\150\160", "\x25\x65\x72\162\x6f\x72" => curl_error($MX));
        watchdog("\155\151\x6e\x69\157\162\x61\x6e\147\145\x5f\x73\x61\155\x6c\137\x69\144\160", "\105\x72\x72\157\x72\40\141\164\x20\45\155\x65\x74\150\x6f\144\40\157\x66\40\x25\x66\151\x6c\145\x3a\40\45\x65\162\162\157\x72", $Qu);
        xb:
        curl_close($MX);
        return $ME;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto xo;
        }
        return json_encode(array("\141\160\x69\113\x65\171" => "\103\125\122\114\x5f\x45\122\x52\117\x52", "\x74\x6f\153\145\156" => "\74\141\x20\x68\162\x65\146\75\42\150\x74\x74\160\x3a\x2f\x2f\160\150\160\x2e\156\x65\164\x2f\x6d\x61\156\x75\x61\154\57\145\x6e\x2f\143\165\x72\x6c\x2e\151\156\163\164\x61\154\x6c\x61\164\151\x6f\x6e\56\160\x68\x70\x22\76\x50\110\x50\40\143\x55\x52\114\x20\145\170\164\x65\x6e\x73\151\157\x6e\x3c\x2f\141\x3e\x20\x69\163\x20\x6e\157\x74\40\151\156\x73\164\141\x6c\x6c\x65\x64\40\x6f\x72\40\144\x69\x73\141\x62\x6c\x65\x64\56"));
        xo:
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\57\x6d\157\x61\163\57\x72\x65\x73\164\x2f\x63\165\163\164\157\x6d\145\162\x2f\x6b\x65\x79";
        $MX = curl_init($nk);
        $Wp = $this->email;
        $UB = $this->password;
        $lw = array("\145\155\x61\x69\154" => $Wp, "\x70\141\x73\x73\x77\x6f\x72\x64" => $UB);
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($MX, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\145\x6e\164\x2d\124\171\x70\145\x3a\40\x61\160\x70\154\x69\x63\141\x74\x69\x6f\x6e\57\x6a\163\157\x6e", "\x63\x68\x61\x72\163\x65\x74\72\x20\125\124\106\40\55\x20\x38", "\x41\x75\x74\150\x6f\162\151\172\x61\164\151\x6f\x6e\x3a\40\102\x61\163\151\x63"));
        curl_setopt($MX, CURLOPT_POST, TRUE);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto vM;
        }
        $Qu = array("\x25\155\x65\164\x68\x6f\x64" => "\147\x65\x74\x43\x75\163\x74\x6f\x6d\145\x72\113\145\171\163", "\45\x66\x69\x6c\x65" => "\143\165\163\164\x6f\155\x65\162\137\163\x65\x74\x75\x70\56\160\150\160", "\45\145\162\x72\x6f\162" => curl_error($MX));
        watchdog("\x6d\x69\x6e\151\157\162\x61\156\147\x65\137\x73\x61\155\154\x5f\x69\x64\x70", "\x45\x72\162\157\x72\40\141\164\x20\x25\155\145\164\x68\x6f\x64\40\157\146\x20\x25\x66\151\x6c\x65\x3a\x20\45\x65\162\162\157\x72", $Qu);
        vM:
        curl_close($MX);
        return $ME;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto YA;
        }
        return json_encode(array("\163\164\141\164\165\163" => "\x43\125\x52\x4c\x5f\105\x52\x52\117\x52", "\163\x74\x61\164\165\x73\115\x65\163\x73\x61\x67\145" => "\x3c\141\40\x68\x72\145\x66\75\x22\150\164\x74\x70\72\57\x2f\x70\150\160\56\156\x65\164\57\155\141\156\165\x61\154\x2f\145\x6e\57\x63\165\162\x6c\x2e\x69\156\x73\164\141\154\x6c\141\164\x69\x6f\156\x2e\160\x68\160\x22\76\x50\110\120\40\x63\125\x52\114\x20\x65\x78\164\145\x6e\163\151\157\156\74\x2f\141\x3e\x20\x69\163\x20\156\157\x74\x20\x69\156\163\x74\141\x6c\154\145\144\x20\x6f\162\x20\x64\151\x73\141\x62\154\x65\x64\x2e"));
        YA:
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\57\x6d\x6f\141\163\57\141\160\151\57\141\165\164\x68\x2f\x63\150\x61\154\x6c\145\x6e\x67\x65";
        $MX = curl_init($nk);
        $L5 = $this->defaultCustomerId;
        $hs = $this->defaultCustomerApiKey;
        $ND = variable_get("\x6d\151\x6e\151\x6f\162\x61\x6e\147\145\137\163\141\x6d\x6c\x5f\151\x64\160\x5f\143\x75\x73\164\x6f\155\x65\162\137\x61\x64\155\x69\x6e\x5f\145\x6d\x61\x69\x6c", NULL);
        $Am = Utilities::get_timestamp();
        $lW = $L5 . $Am . $hs;
        $Fj = hash("\x73\x68\141\65\61\62", $lW);
        $gb = "\x43\x75\x73\x74\157\x6d\145\x72\x2d\x4b\x65\171\x3a\x20" . $L5;
        $Q4 = "\x54\x69\x6d\x65\x73\x74\x61\155\160\x3a\40" . $Am;
        $Bf = "\101\165\x74\150\x6f\x72\x69\172\141\164\151\157\x6e\72\40" . $Fj;
        $lw = array("\143\165\163\x74\157\155\x65\162\113\145\x79" => $L5, "\x65\155\x61\151\154" => $ND, "\141\165\164\150\124\171\160\x65" => "\105\x4d\x41\x49\x4c");
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($MX, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\145\x6e\164\55\x54\171\160\145\72\x20\x61\x70\160\x6c\151\x63\141\x74\x69\157\156\57\x6a\163\157\x6e", $gb, $Q4, $Bf));
        curl_setopt($MX, CURLOPT_POST, TRUE);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto uG;
        }
        $Qu = array("\x25\x6d\x65\164\150\157\144" => "\x73\145\x6e\144\x4f\x74\160", "\x25\x66\151\154\145" => "\x63\165\163\164\157\155\x65\162\x5f\x73\145\164\x75\x70\x2e\x70\150\160", "\x25\x65\x72\162\x6f\162" => curl_error($MX));
        watchdog("\x6d\x69\x6e\151\157\162\x61\156\x67\145\x5f\163\141\155\154\137\151\144\x70", "\x45\162\162\x6f\162\x20\141\164\x20\x25\x6d\145\164\150\x6f\x64\x20\157\146\x20\x25\146\x69\x6c\x65\x3a\40\45\145\x72\x72\x6f\162", $Qu);
        uG:
        curl_close($MX);
        return $ME;
    }
    public function validateOtp($wf)
    {
        if (Utilities::isCurlInstalled()) {
            goto wV;
        }
        return json_encode(array("\x73\164\x61\x74\165\x73" => "\103\125\122\114\x5f\105\x52\x52\x4f\122", "\x73\164\x61\x74\x75\163\115\145\163\x73\141\147\x65" => "\74\141\40\150\x72\x65\146\x3d\42\150\164\164\x70\x3a\x2f\57\160\x68\x70\56\x6e\x65\164\x2f\x6d\141\156\x75\141\x6c\57\x65\156\x2f\143\165\162\x6c\x2e\151\156\163\164\141\154\154\x61\x74\151\x6f\156\x2e\160\150\160\42\x3e\120\110\120\x20\x63\x55\122\x4c\x20\145\170\x74\x65\156\x73\151\157\x6e\x3c\57\141\x3e\40\x69\163\40\x6e\157\x74\40\151\156\163\x74\x61\154\x6c\x65\144\40\157\162\x20\144\x69\x73\x61\x62\x6c\145\x64\56"));
        wV:
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\157\141\x73\57\x61\x70\151\x2f\x61\165\164\150\57\166\141\154\x69\144\141\x74\145";
        $MX = curl_init($nk);
        $L5 = $this->defaultCustomerId;
        $hs = $this->defaultCustomerApiKey;
        $Am = Utilities::get_timestamp();
        $lW = $L5 . $Am . $hs;
        $Fj = hash("\163\x68\141\65\x31\x32", $lW);
        $gb = "\x43\165\163\x74\157\155\145\x72\x2d\x4b\145\x79\72\x20" . $L5;
        $Q4 = "\x54\x69\155\x65\x73\164\141\x6d\x70\x3a\40" . $Am;
        $Bf = "\101\165\x74\x68\x6f\x72\x69\x7a\x61\x74\151\x6f\156\x3a\x20" . $Fj;
        $lw = array("\x74\x78\x49\x64" => $wf, "\164\x6f\153\x65\156" => $this->otpToken);
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($MX, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\145\156\164\55\x54\171\x70\145\x3a\x20\141\x70\x70\x6c\151\x63\141\164\x69\157\x6e\x2f\152\x73\x6f\x6e", $gb, $Q4, $Bf));
        curl_setopt($MX, CURLOPT_POST, TRUE);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto t4;
        }
        $Qu = array("\x25\155\x65\164\150\x6f\x64" => "\166\x61\154\x69\x64\x61\x74\145\x4f\164\x70", "\45\146\x69\x6c\x65" => "\143\x75\163\164\x6f\155\x65\x72\137\x73\145\x74\165\x70\x2e\160\x68\160", "\45\x65\162\x72\x6f\x72" => curl_error($MX));
        watchdog("\155\151\156\151\157\162\141\156\x67\145\137\163\141\155\x6c\137\151\144\x70", "\x45\162\x72\x6f\x72\40\141\x74\x20\45\155\x65\164\150\x6f\144\x20\157\x66\x20\x25\146\x69\x6c\x65\x3a\40\45\145\x72\162\157\x72", $Qu);
        t4:
        curl_close($MX);
        return $ME;
    }
    function check_status($TL)
    {
        global $base_url;
        if (Utilities::isCurlInstalled()) {
            goto Rw;
        }
        return json_encode(array("\163\164\141\x74\165\x73" => "\x43\125\122\x4c\137\105\x52\x52\x4f\122", "\x73\164\x61\164\x75\x73\x4d\145\163\x73\141\x67\x65" => "\74\x61\x20\x68\x72\x65\x66\x3d\42\150\164\x74\x70\72\57\57\160\150\x70\56\x6e\145\164\57\155\141\x6e\165\x61\x6c\x2f\145\156\x2f\x63\165\162\x6c\x2e\x69\156\163\x74\x61\154\154\x61\164\151\157\156\56\x70\150\160\42\x3e\x50\110\x50\x20\143\125\x52\114\40\x65\x78\164\x65\x6e\x73\x69\157\x6e\x3c\x2f\141\76\40\151\163\40\x6e\157\164\40\151\x6e\x73\x74\141\154\154\x65\x64\x20\157\162\40\144\x69\x73\x61\142\154\145\x64\56"));
        Rw:
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\x6f\x61\x73\x2f\141\160\x69\x2f\142\x61\x63\153\x75\x70\143\157\x64\x65\57\166\145\x72\151\x66\171";
        $MX = curl_init($nk);
        $Ue = variable_get("\155\151\156\x69\157\x72\141\156\x67\x65\137\x73\141\x6d\x6c\137\151\144\160\x5f\x63\165\163\x74\157\155\145\162\137\151\144", '');
        $iW = variable_get("\155\x69\156\151\157\x72\141\x6e\147\145\x5f\163\x61\155\x6c\137\x69\x64\160\x5f\143\x75\163\164\157\155\x65\162\x5f\141\160\151\x5f\x6b\x65\x79", '');
        $rr = Utilities::get_timestamp();
        $NR = $Ue . $rr . $iW;
        $ow = hash("\x73\x68\141\x35\x31\62", $NR);
        $E6 = "\103\165\163\164\157\x6d\x65\162\55\113\145\171\72\x20" . $Ue;
        $zV = "\124\151\155\x65\x73\x74\x61\155\x70\x3a\x20" . $rr;
        $z0 = "\101\165\164\x68\157\162\x69\x7a\141\164\x69\x6f\156\x3a\x20" . $ow;
        $lw = '';
        $lw = array("\143\x6f\x64\x65" => $TL, "\143\165\163\164\157\x6d\x65\162\113\145\171" => $Ue, "\141\x64\144\x69\x74\151\157\156\141\154\106\151\x65\x6c\x64\163" => array("\x66\151\145\154\144\x31" => $base_url));
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($MX, CURLOPT_AUTOREFERER, true);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\x65\x6e\x74\x2d\x54\171\160\145\72\x20\x61\x70\160\154\x69\x63\141\x74\151\x6f\156\x2f\152\x73\157\x6e", $E6, $zV, $z0));
        curl_setopt($MX, CURLOPT_POST, true);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        curl_setopt($MX, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($MX, CURLOPT_TIMEOUT, 20);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto hW;
        }
        echo "\122\x65\161\165\x65\x73\x74\40\x45\x72\162\157\162\72" . curl_error($MX);
        die;
        hW:
        curl_close($MX);
        $ME = json_decode($ME, true);
        return $ME;
    }
    function ccl()
    {
        global $base_url;
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\157\x61\x73\x2f\x72\x65\163\164\57\143\x75\163\x74\x6f\x6d\145\x72\x2f\x6c\x69\143\145\156\x73\x65";
        $MX = curl_init($nk);
        $Ue = variable_get("\155\151\x6e\151\x6f\162\141\156\147\145\x5f\163\x61\x6d\154\x5f\151\144\x70\137\x63\165\x73\x74\x6f\155\145\x72\x5f\x69\144", '');
        $iW = variable_get("\155\x69\x6e\x69\157\162\x61\156\147\x65\137\x73\141\155\154\x5f\151\x64\x70\137\x63\x75\163\164\x6f\155\145\162\137\x61\160\151\137\x6b\x65\x79", '');
        $rr = Utilities::get_timestamp();
        $NR = $Ue . $rr . $iW;
        $ow = hash("\163\150\141\65\x31\62", $NR);
        $E6 = "\x43\165\163\x74\x6f\155\145\x72\x2d\x4b\145\171\72\40" . $Ue;
        $zV = "\x54\x69\155\x65\163\x74\x61\x6d\160\x3a\x20" . $rr;
        $z0 = "\101\x75\164\x68\x6f\x72\x69\x7a\x61\164\151\157\x6e\72\40" . $ow;
        $lw = '';
        $lw = array("\143\x75\x73\164\x6f\155\145\162\x49\x64" => $Ue, "\x61\x70\160\x6c\151\143\141\x74\151\157\156\116\x61\x6d\x65" => "\144\162\x75\160\x61\x6c\x5f\x73\x61\x6d\154\137\151\144\x70");
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($MX, CURLOPT_AUTOREFERER, true);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\x65\156\164\55\x54\171\x70\145\x3a\x20\x61\160\x70\154\x69\143\141\164\x69\157\x6e\x2f\x6a\x73\x6f\156", $E6, $zV, $z0));
        curl_setopt($MX, CURLOPT_POST, true);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        curl_setopt($MX, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($MX, CURLOPT_TIMEOUT, 20);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto BX;
        }
        return null;
        BX:
        curl_close($MX);
        return $ME;
    }
    function update_status()
    {
        $nk = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\x6f\141\x73\57\141\160\x69\x2f\x62\x61\x63\x6b\165\160\x63\x6f\x64\145\x2f\x75\x70\x64\141\164\145\x73\x74\141\x74\x75\163";
        $MX = curl_init($nk);
        $Ue = variable_get("\155\x69\x6e\x69\x6f\x72\141\x6e\x67\145\x5f\163\141\x6d\154\137\151\144\160\137\x63\165\x73\164\157\155\145\x72\137\151\x64", '');
        $iW = variable_get("\155\151\156\151\157\162\141\156\x67\145\x5f\163\141\x6d\x6c\137\151\x64\160\137\x63\165\163\164\x6f\155\x65\162\x5f\141\x70\151\x5f\153\x65\171", '');
        $Hm = variable_get("\155\151\156\151\157\162\141\x6e\147\x65\x5f\163\141\155\x6c\137\x69\x64\x70\x5f\x73\155\x6c\x5f\x6c\x6b", '');
        $rr = Utilities::get_timestamp();
        $NR = $Ue . $rr . $iW;
        $ow = hash("\x73\x68\141\x35\x31\62", $NR);
        $E6 = "\103\165\163\164\157\x6d\145\x72\x2d\113\x65\x79\72\x20" . $Ue;
        $zV = "\x54\151\155\145\163\x74\141\155\160\x3a\x20" . $rr;
        $z0 = "\x41\165\x74\150\157\162\x69\172\x61\164\x69\x6f\x6e\x3a\x20" . $ow;
        $z6 = variable_get("\x6d\151\x6e\x69\157\x72\x61\156\x67\145\137\163\x61\x6d\154\137\x69\144\x70\x5f\143\x75\x73\164\157\155\145\x72\x5f\x61\x64\155\151\156\137\x74\x6f\x6b\x65\x6e", '');
        $TL = Utilities::decrypt($Hm, $z6);
        $lw = array("\143\157\144\x65" => $TL, "\143\x75\163\164\157\x6d\145\x72\x4b\x65\171" => $Ue);
        $CW = json_encode($lw);
        curl_setopt($MX, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($MX, CURLOPT_ENCODING, '');
        curl_setopt($MX, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($MX, CURLOPT_AUTOREFERER, true);
        curl_setopt($MX, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($MX, CURLOPT_MAXREDIRS, 10);
        curl_setopt($MX, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\x65\156\x74\55\124\x79\160\145\x3a\40\141\160\160\x6c\x69\x63\x61\164\x69\x6f\x6e\x2f\x6a\x73\x6f\x6e", $E6, $zV, $z0));
        curl_setopt($MX, CURLOPT_POST, true);
        curl_setopt($MX, CURLOPT_POSTFIELDS, $CW);
        curl_setopt($MX, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($MX, CURLOPT_TIMEOUT, 20);
        $ME = curl_exec($MX);
        if (!curl_errno($MX)) {
            goto e_;
        }
        echo "\x52\145\161\165\145\163\x74\x20\105\162\x72\157\x72\x3a" . curl_error($MX);
        die;
        e_:
        curl_close($MX);
        return $ME;
    }
}
