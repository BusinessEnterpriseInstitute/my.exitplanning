<?php


include "\x62\x61\163\x69\x63\x45\x6e\165\155\56\x70\x68\x70";
class mo_options_enum_identity_provider extends BasicEnum
{
    const Broker_service = "\x6d\157\137\163\x61\155\x6c\x5f\x65\156\141\x62\x6c\145\x5f\143\154\x6f\165\144\137\x62\162\x6f\153\145\162";
    const SP_Base_Url = "\155\151\156\151\x6f\x72\x61\x6e\147\x65\137\163\x61\155\x6c\137\x62\x61\163\145\x5f\165\x72\154";
    const SP_Entity_ID = "\x6d\151\x6e\x69\x6f\162\x61\x6e\147\145\137\x73\x61\x6d\154\x5f\142\x61\x73\145\x5f\165\x72\x6c";
    const SP_ACS_URL = "\x6d\151\156\x69\157\162\x61\156\147\145\x5f\163\x61\155\x6c\137\x73\x70\137\x69\163\x73\165\145\162";
}
class mo_options_enum_service_provider extends BasicEnum
{
    const Identity_name = "\155\x6f\x5f\x69\x64\x70\x5f\156\x61\x6d\145";
    const Issuer = "\155\x6f\x5f\151\x64\160\x5f\x69\163\163\165\x65\x72";
    const Enable_Signed_SSO_and_SLO = "\155\x6f\137\151\x64\x70\137\162\145\161\x75\x65\163\164\x5f\163\151\147\x6e\x65\144";
    const Name_ID_format = "\x6d\157\137\151\144\x70\x5f\x6e\x61\155\x65\x69\x64\137\146\157\162\x6d\141\x74";
    const Binding_SSO = "\155\x6f\x5f\x69\x64\160\x5f\x68\x74\164\x70\137\142\x69\156\144\151\x6e\x67\x5f\x73\163\x6f";
    const Login_URL = "\155\157\137\x69\x64\160\x5f\x73\x73\x6f\137\x75\x72\x6c";
    const Binding_SLO = "\x6d\x6f\x5f\x69\144\x70\137\150\164\x74\x70\x5f\142\151\x6e\x64\151\156\x67\x5f\163\x6c\157";
    const Fetch_Metadata_Time_Intervals = "\155\151\x6e\x69\157\162\141\156\147\145\x5f\163\141\155\154\x5f\146\x65\164\143\150\137\155\145\x74\141\144\141\x74\x61\x5f\164\151\155\145\137\151\x6e\164\x65\162\166\x61\x6c\x73";
    const Logout_URL = "\x6d\157\137\x69\x64\x70\x5f\x73\x6c\157\137\x75\162\x6c";
    const X509_certificate = "\155\x6f\137\x69\x64\160\137\x63\145\x72\164";
    const Fetch_Metadata_URL = "\155\x69\x6e\151\157\162\141\156\147\145\137\x73\x61\x6d\x6c\x5f\x6d\145\x74\141\137\144\141\x74\x61\137\165\x72\x6c";
    const Secrity_Signature_Algo = "\x73\x65\x63\165\x72\x69\x74\171\137\163\x69\147\156\141\x74\x75\162\x65\x5f\141\x6c\147\x6f\x72\x69\x74\x68\155";
}
class mo_options_enum_sign_in_settings extends BasicEnum
{
    const Protect_whole_site = "\x6d\x69\x6e\151\157\162\141\x6e\x67\x65\x5f\x73\141\x6d\154\137\146\157\x72\143\x65\x5f\x61\x75\164\150";
    const Auto_redirect = "\x6d\151\156\x69\x6f\162\141\x6e\x67\145\x5f\163\141\x6d\x6c\x5f\141\x75\x74\157\x5f\x72\145\x64\151\162\145\143\164\x5f\164\157\137\151\144\160";
    const Backdoor_Login = "\x6d\151\156\x69\157\162\141\156\147\145\137\163\x61\155\154\137\145\156\x61\142\154\145\137\142\x61\143\x6b\x64\157\157\x72";
    const Default_redirect_url = "\x6d\x69\x6e\x69\x6f\x72\x61\156\147\145\137\x73\x61\155\x6c\137\144\x65\x66\x61\x75\x6c\x74\x5f\162\145\154\141\171\163\164\141\x74\145";
}
class mo_options_enum_custom_certificate extends BasicEnum
{
    const Custom_private_cert = "\155\x69\x6e\151\x6f\162\x61\156\147\x65\x5f\x73\x61\x6d\154\x5f\x70\162\x69\x76\x61\164\x65\137\143\x65\162\164\151\x66\151\143\141\x74\x65";
    const Custom_public_cert = "\x6d\x69\x6e\151\x6f\162\141\156\147\145\137\x73\x61\155\154\x5f\160\x75\x62\154\x5f\143\x65\x72\164\x69\x66\151\x63\141\164\145";
}
