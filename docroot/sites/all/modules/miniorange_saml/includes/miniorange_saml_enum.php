<?php


include "\142\141\163\x69\x63\105\156\x75\155\x2e\160\x68\x70";
class mo_options_enum_identity_provider extends BasicEnum
{
    const Broker_service = "\155\x6f\x5f\x73\x61\155\x6c\x5f\145\156\141\x62\x6c\x65\137\x63\154\x6f\x75\144\x5f\x62\x72\157\153\x65\x72";
    const SP_Base_Url = "\155\151\x6e\x69\157\x72\x61\156\147\145\137\x73\x61\x6d\x6c\x5f\142\x61\x73\145\137\165\x72\x6c";
    const SP_Entity_ID = "\155\151\156\x69\157\162\141\x6e\147\x65\x5f\x73\141\155\x6c\137\x62\x61\x73\x65\x5f\165\x72\154";
    const SP_ACS_URL = "\x6d\x69\156\151\157\x72\x61\156\147\145\137\163\x61\155\154\x5f\x73\160\137\151\x73\163\x75\x65\162";
}
class mo_options_enum_service_provider extends BasicEnum
{
    const Identity_name = "\155\157\137\151\x64\160\x5f\156\x61\155\x65";
    const Issuer = "\155\157\137\151\144\160\x5f\x69\x73\x73\165\145\162";
    const Enable_Signed_SSO_and_SLO = "\x6d\x6f\x5f\x69\x64\x70\137\x72\145\x71\165\x65\x73\164\137\163\x69\x67\156\x65\144";
    const Name_ID_format = "\x6d\157\137\151\144\160\x5f\156\141\155\145\x69\144\137\146\157\x72\x6d\141\164";
    const Binding_SSO = "\x6d\157\137\151\x64\160\x5f\150\164\x74\160\137\x62\151\x6e\144\x69\x6e\147\137\x73\163\x6f";
    const Login_URL = "\155\x6f\137\151\144\x70\137\163\x73\x6f\137\x75\162\x6c";
    const Binding_SLO = "\x6d\157\137\151\144\160\137\x68\164\164\160\x5f\142\151\x6e\x64\151\156\147\x5f\163\x6c\157";
    const Fetch_Metadata_Time_Intervals = "\155\x69\x6e\x69\157\162\141\x6e\x67\x65\x5f\163\x61\155\154\x5f\146\145\x74\143\x68\x5f\x6d\x65\x74\141\x64\141\164\x61\137\164\151\155\x65\x5f\151\x6e\164\x65\162\166\141\x6c\163";
    const Logout_URL = "\155\157\x5f\x69\x64\160\137\x73\154\157\137\x75\162\154";
    const X509_certificate = "\155\x6f\x5f\151\144\x70\x5f\143\145\162\x74";
    const Fetch_Metadata_URL = "\x6d\151\156\151\x6f\162\141\156\147\x65\137\x73\141\x6d\154\x5f\x6d\145\164\141\137\x64\x61\164\x61\137\x75\162\154";
    const Secrity_Signature_Algo = "\x73\x65\143\165\x72\151\164\x79\137\163\151\147\156\141\x74\165\x72\145\137\141\x6c\x67\x6f\162\151\164\x68\155";
}
class mo_options_enum_sign_in_settings extends BasicEnum
{
    const Protect_whole_site = "\x6d\151\x6e\x69\x6f\162\141\156\x67\145\x5f\163\141\x6d\154\137\146\157\x72\x63\145\x5f\141\165\x74\x68";
    const Auto_redirect = "\x6d\x69\x6e\x69\157\x72\x61\x6e\x67\145\137\x73\141\x6d\x6c\137\141\165\x74\157\137\x72\x65\x64\x69\x72\145\143\164\137\164\157\x5f\151\x64\160";
    const Backdoor_Login = "\155\151\156\x69\157\162\141\x6e\147\145\137\x73\141\x6d\154\137\x65\x6e\x61\x62\154\x65\x5f\x62\x61\143\x6b\x64\157\x6f\162";
    const Default_redirect_url = "\x6d\151\156\x69\157\162\x61\x6e\147\x65\x5f\x73\x61\155\154\137\144\x65\x66\x61\x75\154\x74\x5f\162\x65\x6c\x61\171\163\164\x61\164\x65";
}
class mo_options_enum_custom_certificate extends BasicEnum
{
    const Custom_private_cert = "\x6d\x69\156\x69\157\x72\141\156\x67\145\x5f\x73\x61\x6d\x6c\x5f\x70\162\151\166\141\164\x65\137\143\x65\162\164\151\146\151\x63\x61\x74\145";
    const Custom_public_cert = "\x6d\151\x6e\151\157\x72\x61\x6e\x67\x65\x5f\x73\x61\x6d\154\137\160\x75\x62\x6c\137\143\x65\162\x74\151\146\x69\143\x61\164\x65";
}
