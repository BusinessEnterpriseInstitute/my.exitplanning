<?php


include "\142\x61\x73\151\x63\x45\x6e\165\155\x2e\160\150\160";
class mo_options_enum_identity_provider extends BasicEnum
{
    const Broker_service = "\x6d\157\137\x73\141\155\154\x5f\x65\x6e\x61\142\x6c\x65\137\143\154\x6f\165\x64\x5f\x62\162\157\x6b\145\162";
    const SP_Base_Url = "\155\x69\x6e\x69\157\x72\141\x6e\147\145\x5f\x73\x61\155\154\x5f\x62\x61\x73\145\137\x75\162\154";
    const SP_Entity_ID = "\x6d\151\x6e\x69\x6f\x72\141\156\x67\x65\x5f\x73\x61\x6d\154\137\142\x61\163\x65\x5f\x75\162\154";
    const SP_ACS_URL = "\155\151\x6e\151\157\162\141\156\147\x65\137\x73\141\155\x6c\137\x73\x70\x5f\x69\x73\x73\x75\x65\162";
}
class mo_options_enum_service_provider extends BasicEnum
{
    const Identity_name = "\x6d\157\x5f\x69\x64\x70\137\x6e\x61\155\145";
    const Issuer = "\155\x6f\x5f\151\144\160\137\151\163\163\165\x65\162";
    const Enable_Signed_SSO_and_SLO = "\155\x6f\x5f\151\144\160\x5f\162\145\x71\165\x65\x73\x74\137\163\151\147\156\x65\x64";
    const Name_ID_format = "\x6d\x6f\137\151\x64\x70\x5f\156\x61\x6d\145\151\144\x5f\146\157\x72\x6d\141\164";
    const Binding_SSO = "\x6d\x6f\137\151\x64\x70\x5f\x68\x74\164\160\137\142\x69\156\144\151\156\x67\137\x73\x73\x6f";
    const Login_URL = "\x6d\x6f\x5f\151\144\160\x5f\163\x73\x6f\x5f\x75\162\154";
    const Binding_SLO = "\x6d\x6f\137\151\x64\160\x5f\x68\x74\164\x70\137\142\151\x6e\144\x69\156\x67\137\x73\154\x6f";
    const Fetch_Metadata_Time_Intervals = "\x6d\151\x6e\151\157\162\141\x6e\147\x65\137\x73\141\155\x6c\137\x66\x65\164\x63\150\x5f\x6d\x65\164\x61\x64\141\164\x61\137\164\x69\155\x65\x5f\151\156\x74\145\x72\166\x61\154\x73";
    const Logout_URL = "\155\x6f\x5f\x69\x64\x70\x5f\163\x6c\x6f\137\165\x72\x6c";
    const X509_certificate = "\155\157\137\151\x64\x70\x5f\x63\x65\162\x74";
    const Fetch_Metadata_URL = "\155\x69\156\151\157\x72\x61\x6e\147\x65\137\x73\x61\x6d\x6c\137\155\145\164\141\137\x64\141\x74\141\x5f\165\x72\x6c";
    const Secrity_Signature_Algo = "\163\145\143\165\x72\151\164\x79\137\163\x69\147\x6e\141\164\165\x72\x65\x5f\141\154\x67\x6f\x72\151\x74\x68\x6d";
}
class mo_options_enum_sign_in_settings extends BasicEnum
{
    const Protect_whole_site = "\x6d\x69\x6e\151\x6f\x72\x61\x6e\x67\145\x5f\163\141\155\154\137\146\x6f\x72\x63\145\x5f\x61\165\164\150";
    const Auto_redirect = "\155\x69\156\151\x6f\162\x61\x6e\147\145\137\x73\141\x6d\x6c\137\141\x75\164\157\x5f\x72\x65\144\151\162\145\143\164\x5f\x74\x6f\137\x69\x64\x70";
    const Backdoor_Login = "\155\x69\156\151\x6f\x72\141\x6e\147\x65\137\x73\x61\x6d\154\x5f\145\x6e\x61\142\154\x65\x5f\142\x61\143\153\x64\157\157\162";
    const Default_redirect_url = "\155\x69\x6e\151\x6f\x72\x61\156\x67\x65\x5f\163\141\155\154\x5f\x64\145\146\x61\x75\154\164\137\162\145\154\x61\171\x73\x74\x61\164\145";
}
class mo_options_enum_custom_certificate extends BasicEnum
{
    const Custom_private_cert = "\155\x69\x6e\x69\x6f\x72\141\x6e\147\x65\x5f\x73\141\x6d\x6c\137\160\162\x69\x76\141\x74\145\x5f\x63\145\162\164\151\146\151\x63\x61\164\x65";
    const Custom_public_cert = "\x6d\151\x6e\x69\157\162\x61\x6e\x67\x65\x5f\163\141\155\x6c\137\160\165\x62\x6c\137\x63\145\162\164\x69\x66\x69\x63\x61\x74\x65";
}
