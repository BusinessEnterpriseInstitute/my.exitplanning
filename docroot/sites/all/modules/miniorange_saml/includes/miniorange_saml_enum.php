<?php
include "basicEnum.php";

class mo_options_enum_identity_provider extends BasicEnum{
    const Broker_service ='mo_saml_enable_cloud_broker';
    const SP_Base_Url='miniorange_saml_base_url';
    const SP_Entity_ID = 'miniorange_saml_base_url';
    const SP_ACS_URL = 'miniorange_saml_sp_issuer';
}

class mo_options_enum_service_provider extends BasicEnum{
    const Identity_name ='mo_idp_name';
    const Issuer = 'mo_idp_issuer';
    const  Enable_Signed_SSO_and_SLO= 'mo_idp_request_signed';
    const Name_ID_format ='mo_idp_nameid_format';
    const Binding_SSO = 'mo_idp_http_binding_sso';
    const Login_URL = 'mo_idp_sso_url';
    const Binding_SLO = 'mo_idp_http_binding_slo';
    const Fetch_Metadata_Time_Intervals = 'miniorange_saml_fetch_metadata_time_intervals';
    const Logout_URL = 'mo_idp_slo_url';
    const X509_certificate = 'mo_idp_cert';
    const Fetch_Metadata_URL = 'miniorange_saml_meta_data_url';
    const Secrity_Signature_Algo = 'security_signature_algorithm';
}

class mo_options_enum_sign_in_settings extends BasicEnum{
    const Protect_whole_site = 'miniorange_saml_force_auth';
    const Auto_redirect = 'miniorange_saml_auto_redirect_to_idp';
    const Backdoor_Login = 'miniorange_saml_enable_backdoor';
    const Default_redirect_url = 'miniorange_saml_default_relaystate';
}

class mo_options_enum_custom_certificate extends BasicEnum{
    const Custom_private_cert = 'miniorange_saml_private_certificate';
    const Custom_public_cert = 'miniorange_saml_publ_certificate';
}