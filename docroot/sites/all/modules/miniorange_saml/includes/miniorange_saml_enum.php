<?php


include "\x62\141\163\x69\143\x45\156\165\155\x2e\160\x68\160";
class mo_options_enum_identity_provider extends BasicEnum
{
    const Broker_service = "\x6d\157\x5f\x73\x61\155\154\137\145\156\x61\142\x6c\145\137\x63\154\x6f\165\144\x5f\142\x72\x6f\x6b\x65\162";
    const SP_Base_Url = "\155\x69\156\x69\157\x72\141\x6e\147\x65\x5f\x73\x61\155\x6c\x5f\x62\x61\163\x65\137\165\x72\154";
    const SP_Entity_ID = "\155\151\x6e\151\157\162\141\156\147\x65\137\163\x61\x6d\x6c\x5f\142\141\x73\145\137\x75\x72\154";
    const SP_ACS_URL = "\155\151\156\x69\x6f\x72\141\x6e\147\x65\x5f\163\x61\x6d\154\137\x73\160\137\x69\x73\163\x75\x65\162";
}
class mo_options_enum_service_provider extends BasicEnum
{
    const Identity_name = "\155\x6f\x5f\x69\x64\x70\x5f\x6e\x61\x6d\x65";
    const Issuer = "\155\157\137\x69\x64\160\137\x69\163\163\x75\x65\162";
    const Enable_Signed_SSO_and_SLO = "\x6d\157\137\x69\144\160\x5f\162\x65\x71\165\145\163\164\x5f\163\151\x67\156\145\x64";
    const Name_ID_format = "\x6d\157\137\151\x64\160\x5f\x6e\141\155\x65\x69\x64\x5f\146\157\162\155\x61\x74";
    const Binding_SSO = "\155\157\137\x69\x64\160\x5f\150\164\x74\160\137\142\151\156\144\151\156\x67\137\x73\x73\157";
    const Login_URL = "\155\x6f\137\151\144\160\137\x73\163\x6f\137\165\x72\x6c";
    const Binding_SLO = "\155\x6f\137\x69\144\x70\x5f\150\x74\164\160\x5f\x62\151\x6e\x64\151\x6e\x67\x5f\163\x6c\157";
    const Fetch_Metadata_Time_Intervals = "\155\151\156\x69\157\x72\x61\156\x67\x65\x5f\163\141\155\154\x5f\x66\145\x74\x63\x68\137\x6d\145\164\x61\x64\x61\x74\x61\137\164\151\155\x65\x5f\151\x6e\x74\x65\x72\166\141\x6c\163";
    const Logout_URL = "\155\157\x5f\151\144\160\137\163\x6c\157\137\165\x72\x6c";
    const X509_certificate = "\155\x6f\137\x69\144\160\137\x63\145\x72\164";
    const Fetch_Metadata_URL = "\x6d\151\156\151\157\162\141\x6e\x67\145\137\163\x61\x6d\154\x5f\155\145\x74\141\137\144\141\164\x61\x5f\165\x72\x6c";
    const Secrity_Signature_Algo = "\x73\145\143\165\162\x69\164\x79\137\163\x69\147\x6e\x61\164\165\162\x65\137\x61\154\x67\157\162\x69\x74\x68\x6d";
}
class mo_options_enum_sign_in_settings extends BasicEnum
{
    const Protect_whole_site = "\x6d\x69\156\151\157\162\141\156\x67\x65\137\163\x61\x6d\154\137\x66\x6f\x72\x63\145\137\x61\165\164\150";
    const Auto_redirect = "\x6d\x69\156\x69\x6f\x72\141\156\147\x65\x5f\x73\x61\x6d\x6c\x5f\x61\165\x74\x6f\137\162\x65\144\x69\162\145\143\164\x5f\164\x6f\x5f\151\x64\160";
    const Backdoor_Login = "\x6d\151\x6e\151\157\162\x61\x6e\147\145\x5f\163\x61\155\x6c\137\145\156\x61\x62\x6c\145\137\x62\141\x63\153\x64\x6f\157\x72";
    const Default_redirect_url = "\155\x69\x6e\x69\157\162\x61\156\x67\145\x5f\163\141\x6d\154\137\144\x65\x66\141\x75\x6c\x74\x5f\162\x65\x6c\x61\x79\163\164\141\164\x65";
}
class mo_options_enum_custom_certificate extends BasicEnum
{
    const Custom_private_cert = "\x6d\151\x6e\151\157\162\141\x6e\147\x65\x5f\x73\141\x6d\154\137\x70\x72\151\166\141\x74\x65\137\143\145\162\x74\151\x66\151\x63\x61\164\145";
    const Custom_public_cert = "\155\x69\156\151\157\x72\141\156\147\x65\x5f\163\141\155\x6c\137\x70\x75\142\154\137\143\145\x72\164\151\x66\151\x63\141\x74\145";
}
