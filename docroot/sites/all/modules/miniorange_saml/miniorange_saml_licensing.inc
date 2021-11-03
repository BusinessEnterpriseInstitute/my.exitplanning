<?php
/**
 * @file
 * Contains Licensing information for miniOrange SAML Login Module.
 */

 /**
 * Showing Licensing form info.
 */
 function miniorange_saml_licensing() {

  drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));
  drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));

     $form['header_top_style_2'] = array('#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout">');

     $form['markup_1'] = array('#markup' =>'<br><h2>Upgrade Plans</h2><hr>');

     $form['markup_free'] = array(
         '#markup' => '<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Main Style -->
        </head>
        <body>
        <!-- Pricing Table Section -->
        <section id="pricing-table">
            <div class="container_1">
                <div class="row">
                    <div class="pricing">
                        <div>
                            <div class="pricing-table class_inline_1">
                                <div class="pricing-header">
                                    <h2 class="pricing-title">Features / Plans</h2>
                                </div>
                                <div class="pricing-list">
                                    <ul>
                                        <li>Unlimited Authentications via IdP</li>
                                        <li>Configure SP Using Metadata XML File</li>
                                        <li>Configure SP Using Metadata URL</li>
                                        <li>Basic Attribute Mapping</li>
                                        <li>Basic Role Mapping</li>
                                        <li>Step-By-Step Guide to Setup IdP</li>                              
                                        <li>Export Configuration</li>
                                        <li>Options to select SAML Request Binding Type</li>
                                        <li>Signed SSO and SLO requests</li>
                                        <li>Import Configuration</li>
                                        <li>Protect your whole site</li>
                                        <li>Force authentication on each login attempt</li>
                                        <li>Default Redirect Url after Login</li>
                                        <li>Integrated Windows Authentication(With ADFS)***</li>
                                        <li>SAML Single Logout</li>
                                        <li>Custom Attribute Mapping</li>
                                        <li>Custom Role Mapping</li>
                                        <li>End to End Identity Provider Configuration **</li>
                                        <li>Auto-sync IdP Configuration from metadata</li>
                                        <li>Generate Custom SP Certificate</li>
                                        <li>Signed requests using different algorithm</li>
                                        <li>Support multiple certificates of IDP</li>
                                        <li>Multiple IDP\'s Supported ****</li>
                                    </ul>
                                </div>
                        </div>    
                        <div class="pricing-table class_inline">
                            <div class="pricing-header">
                                <p class="pricing-title">Free</p>                                
                                <p class="pricing-rate"><sup>$</sup> 0</p>
                                <div class="filler-class"></div>
                                 <a class="btn btn-danger btn-sm mo_btn_note" style="background-color: #337ab7 !important; border-color: #337ab7 !important;display: block;">Free Plan</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="pricing-table class_inline">
                            <div class="pricing-header">
                                <p class="pricing-title">Standard<br> <span>(Auto-Redirect to IdP)</span></p>
                                <p class="pricing-rate"><sup>$</sup> 249<sup>*</sup></p>
                                <div class="filler-class"></div>
                                 <a href="https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=drupal_miniorange_saml_standard_plan"
                                    target="_blank" class="btn btn-custom btn-danger btn-sm" style="background-color: #337ab7 !important; border-color: #337ab7 !important;display: block;">Standard</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        
                        
                        <div class="pricing-table class_inline">
                            <div class="pricing-header">
                                <p class="pricing-title">Premium<br><span>(Attribute & Role Mapping)</span></p>
                                <p class="pricing-rate"><sup>$</sup> 399<sup>*</sup></p>
                                <a href="https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=drupal_miniorange_saml_premium_plan"
                                    target="_blank" class="btn btn-custom btn-danger btn-sm" style="background-color: #337ab7 !important; border-color: #337ab7 !important;display: block;">Premium</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pricing-table class_inline">
                            <div class="pricing-header">
                                <p class="pricing-title">Enterprise <br><span>(Multiple IdP)</span></p>
                                <p class="pricing-rate"><sup>$</sup> 449<sup>*</sup></p>
                                 <a href="https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=drupal_miniorange_saml_enterprise_plan"
                                    target="_blank" class="btn btn-custom btn-danger btn-sm" style="background-color: #337ab7 !important; border-color: #337ab7 !important;display: block;">Enterprise</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                    <li>&#x2714;</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Table Section End -->
    </body>
    </html>',
     );

     $form['markup_4'] = array(
         '#markup' => '<h3>Identity Providers Supported</h3>'
             . 'We support all SAML compliant Identity Providers like Google Apps, ADFS, Okta, Salesforce, Shibboleth, SimpleSAMLphp, OpenAM, Centrify, Ping, RSA, IBM, Oracle, OneLogin, Bitium, WSO2, NetIQ, Portal Guard, Oracle Access Manager and miniOrange Identity Provider.'
     );

     $form['markup_5'] = array(
         '#markup' => '<h3>Steps to Upgrade to Premium Module</h3>'
             . '<ol><li>You will be redirected to miniOrange Login Console. Enter your password with which you created an'
             . ' account with us. After that you will be redirected to payment page.</li>'
             . '<li>Enter your card details and complete the payment. On successful payment completion, you will see the link to download the premium module.</li>'
             . '<li>Once you download the premium module, just unzip it and replace the folder with existing module. Run the Drupal update script. URL to run update script: <b><i>Base URL of Drupal site/update.php</i></b></li></ol>'
     );

   $form['markup_6'] = array(
     '#markup' => '<h6>* One Time Payment</h6>'
   );
   $form['markup_7'] = array(
     '#markup' => '<h3>** End to End Identity Provider Integration (Additional charges may apply)</h3>'
       . 'We will setup a Conference Call / Gotomeeting and do end to end configuration for you for IDP '
       . 'as well as module. We provide services to do the configuration on your behalf. (Extra charges applicable at $60/hr)<br>
            If you have any doubts regarding the licensing plans, you can mail us at <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i>
            </a> or submit a query using the support form <b>(support form available on each tab).</b>'
   );

   $form['markup_s'] = array(
     '#markup' => '<h3>***Integrated Windows Authentication</h3>'
       . 'With Integrated windows authentication, if the user comes to your Drupal Site from a domain joined machine'
       . ' then he will not even have to re-enter his credentials because <br>he already did that when he unlocked his computer.'
   );

   $form['markup_9'] = array(
     '#markup' => '<h3>****Multiple IDP Support</h3>'
       . 'If you want users from different Identity Providers to SSO into your site then you can configure the module with multiple IDPs.'
       . ' <b>Additional charges will be applicable based on the number of Identity Providers you wish to configure.</b>'
   );


   $form['markup_8'] = array(
         '#markup' => '<br><br></div></div>'
     );

     return $form;
 }
