<?php


include "\x62\x61\x73\151\x63\x45\x6e\x75\155\x2e\160\150\160";
class mo_options_enum_identity_provider extends BasicEnum
{
    const Broker_service = "\155\157\137\163\x61\155\x6c\x5f\145\x6e\141\142\x6c\x65\x5f\x63\x6c\157\x75\x64\137\x62\x72\157\x6b\145\162";
    const SP_Base_Url = "\155\151\156\x69\157\x72\141\x6e\147\x65\137\x73\141\155\154\x5f\142\141\163\x65\x5f\x75\162\154";
    const SP_Entity_ID = "\x6d\151\156\x69\157\162\141\x6e\x67\145\137\x73\141\x6d\154\x5f\x62\141\163\145\x5f\x75\x72\x6c";
    const SP_ACS_URL = "\x6d\x69\156\151\157\x72\x61\156\x67\x65\137\x73\x61\x6d\x6c\x5f\x73\x70\137\x69\x73\x73\165\x65\162";
}
class mo_options_enum_service_provider extends BasicEnum
{
    const Identity_name = "\x6d\x6f\137\151\x64\x70\137\156\141\x6d\145";
    const Issuer = "\x6d\x6f\x5f\x69\144\x70\137\151\163\x73\x75\x65\162";
    const Enable_Signed_SSO_and_SLO = "\155\157\x5f\151\x64\x70\137\162\x65\x71\x75\145\x73\x74\137\163\x69\x67\156\x65\144";
    const Name_ID_format = "\x6d\157\x5f\x69\x64\x70\x5f\156\x61\155\x65\x69\144\x5f\146\157\x72\155\x61\x74";
    const Binding_SSO = "\155\157\x5f\151\x64\160\x5f\x68\x74\x74\160\137\x62\151\156\144\151\x6e\x67\x5f\163\x73\157";
    const Login_URL = "\155\x6f\137\x69\144\160\137\x73\163\157\x5f\x75\162\154";
    const Binding_SLO = "\155\157\137\151\x64\160\x5f\150\164\x74\x70\x5f\142\x69\x6e\x64\x69\156\147\x5f\x73\x6c\x6f";
    const Fetch_Metadata_Time_Intervals = "\155\x69\156\151\157\162\141\156\147\145\137\x73\141\x6d\154\137\146\145\x74\143\150\x5f\x6d\x65\x74\x61\x64\141\164\x61\137\164\151\155\x65\x5f\x69\156\164\145\x72\x76\141\154\x73";
    const Logout_URL = "\155\x6f\x5f\151\x64\160\137\x73\x6c\x6f\137\x75\x72\x6c";
    const X509_certificate = "\x6d\157\137\x69\x64\160\x5f\x63\x65\162\164";
    const Fetch_Metadata_URL = "\155\x69\x6e\151\157\162\141\x6e\x67\x65\x5f\x73\141\x6d\x6c\x5f\155\145\164\141\x5f\x64\141\x74\x61\x5f\x75\x72\154";
    const Secrity_Signature_Algo = "\163\145\x63\x75\x72\x69\x74\171\x5f\163\151\x67\156\x61\164\x75\162\145\x5f\x61\x6c\147\157\x72\x69\164\150\155";
}
class mo_options_enum_sign_in_settings extends BasicEnum
{
    const Protect_whole_site = "\155\x69\x6e\151\157\x72\x61\x6e\147\x65\x5f\x73\x61\x6d\x6c\x5f\146\x6f\x72\143\x65\137\141\165\x74\x68";
    const Auto_redirect = "\155\x69\156\x69\157\x72\141\x6e\x67\x65\x5f\x73\x61\155\x6c\137\x61\x75\164\157\137\162\145\x64\151\x72\x65\143\x74\137\164\157\x5f\151\144\x70";
    const Backdoor_Login = "\x6d\151\x6e\151\157\162\x61\x6e\147\x65\137\x73\x61\155\154\137\x65\x6e\141\x62\x6c\x65\137\x62\141\x63\153\144\157\157\x72";
    const Default_redirect_url = "\x6d\151\156\x69\157\162\x61\x6e\147\145\137\163\141\x6d\x6c\x5f\144\145\x66\141\165\x6c\164\137\162\145\154\x61\x79\x73\164\x61\164\x65";
}
class mo_options_enum_custom_certificate extends BasicEnum
{
    const Custom_private_cert = "\x6d\151\x6e\151\157\162\141\156\147\145\137\x73\x61\x6d\x6c\137\160\x72\151\x76\141\x74\145\137\x63\145\x72\x74\151\x66\x69\x63\x61\164\145";
    const Custom_public_cert = "\x6d\x69\x6e\x69\157\162\x61\156\147\145\137\x73\141\x6d\154\137\160\165\x62\x6c\137\143\x65\162\x74\151\146\x69\x63\141\x74\145";
}
