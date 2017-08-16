<?php

/**
 * @file
 * Default theme implementation to format an HTML mail.
 *
 * Copy this file in your default theme folder to create a custom themed mail.
 * Rename it to mimemail-message--[module]--[key].tpl.php to override it for a
 * specific mail.
 *
 * Available variables:
 * - $recipient: The recipient of the message
 * - $subject: The message subject
 * - $body: The message body
 * - $css: Internal style sheets
 * - $module: The sending module
 * - $key: The message identifier
 *
 * @see template_preprocess_mimemail_message()
 */

global $user;
$sender = user_load($user->uid);
$mc_background_color = field_get_items('user', $sender, 'field_mc_color_email_bg');
$mc_promotional_text = field_get_items('user', $sender, 'field_mc_profile_bio');
$mc_logo = field_get_items('user', $sender, 'field_company_logo');
$mc_logo_background_color = field_get_items('user', $sender, 'field_mc_color_primary');
$mc_disclaimer = field_get_items('user', $sender, 'field_mc_disclaimer');
$mc_sender_address = field_get_items('user', $sender, 'field_address');
$mc_sender_company = field_get_items('user', $sender, 'field_company_name');
$mc_profile_pic = field_get_items('user', $sender, 'field_user_photo');
$mc_sender_name = field_get_items('user', $sender, 'field_display_name');
$mc_sender_email = $sender->mail;
$mc_sender_website = field_get_items('user', $sender, 'field_website');

// Template Background color.
if (!empty($mc_background_color)) {
  $mc_theme = $mc_background_color[0]['rgb'];
}
else {
  $mc_theme = '#DEE0E2';
}
// Logo Background color.
if (!empty($mc_logo_background_color)) {
  $mc_logo_theme = $mc_logo_background_color[0]['rgb'];
}
else {
  $mc_logo_theme = '#FFFFFF';
}
// Promotional Text.
if (!empty($mc_promotional_text)) {
  $mc_promotional_html = '
  <tr>
    <td align="center" valign="top">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBio">
          <tr>
            <td valign="top" class="bioContent">' . $mc_promotional_text[0]['value'] . '</td>
          </tr>
      </table>
    </td>
  </tr>';
  }
else {
  $mc_promotional_html = '';
}

// Disclaimer Text.
if (!empty($mc_disclaimer)) {
  $mc_disclaimer_html = '
  <tr>
    <td valign="top" class="footerContent">' . $mc_disclaimer[0]['value'] . '</td>
  </tr>';
  }
else {
  $mc_disclaimer_html = '';
}

// Logo.
if (!empty($mc_logo)) {
  $mc_logo_attributes = array(
    'style_name' => 'mc_logo',
    'path' => $mc_logo[0]['uri'],
    'width' => $mc_logo[0]['width'],
    'height' => $mc_logo[0]['height'],
    'alt' => 'Logo for ' . $mc_sender_company[0]['value'],
    );
  $mc_logo_output = theme('image_style', $mc_logo_attributes);
  $mc_logo_html = '
    <tr>
      <td align="center" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBranding">
          <tr>
            <td align="center" valign="top" style="padding-top:10px; padding-right:0; padding-bottom:10px; padding-left:0;">
            ' . $mc_logo_output . '
            </td>
          </tr>
        </table>
      </td>
    </tr>';
}
else {
  $mc_logo_html = '';
}
// Sender Name.
if (!empty($mc_sender_name)) {
  $mc_sender_email_value = l($mc_sender_email, 'mailto:' . $mc_sender_email, array('external' => TRUE, 'attributes' => array('target' => '_blank')));
  $mc_sender_name_html = '
  <em>This issue brought to you by:</em><br /><br />
  <strong>' . $mc_sender_name[0]['value'] . '</strong><br />'
  . $mc_sender_email . '<br /><br />
  ';
}
else {
  $mc_sender_name_html = '';
}

// Company Vcard.
if (!empty($mc_sender_company) && !empty($mc_sender_address)) {
  $mc_company_html = '
  <div class="vcard">
  <span class="org fn"><strong>' . $mc_sender_company[0]['safe_value'] . '</strong></span>
  <div class="adr">';
  if (!empty($mc_sender_address[0]['street'])) {
    $mc_company_html .= '<div class="street-address">' . $mc_sender_address[0]['street'] . '</div>';
  }
  if (!empty($mc_sender_address[0]['additional'])) {
    $mc_company_html .= '<div class="extended-address">' . $mc_sender_address[0]['additional'] . '</div>';
  }
  if (!empty($mc_sender_address[0]['city'])) {
    $mc_company_html .= '<span class="locality">' . $mc_sender_address[0]['city'] . '</span>, ';
  }
  if (!empty($mc_sender_address[0]['province'])) {
    $mc_company_html .= '<span class="region">' . $mc_sender_address[0]['province'] . '</span> ';
  }
  if (!empty($mc_sender_address[0]['postal_code'])) {
    $mc_company_html .= '<span class="postal-code">' . $mc_sender_address[0]['postal_code'] . '</span>';
  }
  if ($mc_sender_address[0]['country'] != 'us') {
    $mc_company_html .= '<div class="country">' . $mc_sender_address[0]['country_name'] . '</div>';
  }
  $mc_company_html .= '</div>';
  if ($mc_sender_website) {
    $mc_sender_website_url = $mc_sender_website[0]['url'];
    $mc_sender_website_title = $mc_sender_website[0]['title'];
    if (empty($mc_sender_website_title)) {
      $mc_sender_website_title = $mc_sender_website_url;
    }
    if (!preg_match('/^http:\/\//',$mc_sender_website_url)) {
        $mc_sender_website_url = 'http://' . $mc_sender_website_url;
    }
    $mc_company_html .= '<div>' . l($mc_sender_website_title, $mc_sender_website_url, array('external' => TRUE, 'attributes' => array('target' => '_blank'))) . '</div>';
  }
  // Company Phone
  $mc_company_phone = field_get_items('user', $sender, 'field_phone');
  if ($mc_company_phone) {
    $mc_company_html .= '<div>' . l($mc_company_phone[0]['safe_value'], 'tel:' . $mc_company_phone[0]['safe_value'], array('external' => TRUE)) . '</div>';
  }
  $mc_company_html .= '</div>';
}
else {
  $mc_company_html = '';
}

// Profile.
if (!empty($mc_profile_pic)) {
  $mc_profile_pic_attributes = array(
    'style_name' => 'mc_profile',
    'path' => $mc_profile_pic[0]['uri'],
    'width' => $mc_profile_pic[0]['width'],
    'height' => $mc_profile_pic[0]['height'],
  );
  $mc_profile_pic_output = theme('image_style', $mc_profile_pic_attributes);

  $mc_profile_html = '
  <tr>
    <td valign="top" align="center">
      <!-- BEGIN COLUMNS // -->
      <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateColumns">
        <tr>
          <td align="center" valign="middle" class="templateColumnContainer" style="width:420px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="leftColumnContent profilePerson" style="padding-top: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                ' . $mc_sender_name_html . $mc_company_html . '
                </td>
              </tr>
            </table>
          </td>
          <td align="center" valign="middle" class="templateColumnContainer" style="width:180px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="rightColumnContent profilePerson" style="padding-top: 10px; padding-left: 0px; padding-right: 0px; padding-bottom: 10px;">
                ' . $mc_profile_pic_output . '
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- // END COLUMNS -->
    </td>
  </tr>
  ';
}
else {
  $mc_profile_html = '
  <tr>
    <td valign="top" align="center">
      <!-- BEGIN COLUMNS // -->
      <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateColumns">
        <tr>
          <td align="center" valign="middle" class="templateColumnContainer">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="leftColumnContent profilePerson" style="padding-top: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                ' . $mc_sender_name_html . $mc_company_html . '
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- // END COLUMNS -->
    </td>
  </tr>';
}

$mc_styles = '
    <style type="text/css">
        /* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;} /* Force Hotmail to display normal line spacing */
        body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

        /* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
                        body{
                            margin:0;
                            padding:0;
                        }
                        img{
                            border:0;
                            height:auto;
                            line-height:100%;
                            outline:none;
                            text-decoration:none;
                        }
                        table{
                            border-collapse:collapse !important;
                        }
                        body, #bodyTable, #bodyCell{
                            height:100% !important;
                            margin:0;
                            padding:0;
                            width:100% !important;
                        }

                        /* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

                        /* ========== Page Styles ========== */

                        #bodyCell{padding:20px;}
                        #templateContainer{width:600px;}

                        body, #bodyTable{
                            background-color:' . $mc_theme . ';
                        }
                        #bodyCell{
                        }
                        #templateContainer{
                        }
                        h1{
                            color:#202020 !important;
                            display:block;
                            font-family:Helvetica;
                            font-size:26px;
                            font-style:normal;
                            font-weight:bold;
                            line-height:100%;
                            letter-spacing:normal;
                            margin-top:0;
                            margin-right:0;
                            margin-bottom:10px;
                            margin-left:0;
                            text-align:left;
                        }
                        h2{
                            color:#404040 !important;
                            display:block;
                            font-family:Helvetica;
                            font-style:normal;
                            font-weight:bold;
                            line-height:100%;
                            letter-spacing:normal;
                            margin-top:0;
                            margin-right:0;
                            margin-bottom:10px;
                            margin-left:0;
                            text-align:left;
                        }
                        h3{
                            color:#606060 !important;
                            display:block;
                            font-family:Helvetica;
                            font-size:16px;
                            font-style:italic;
                            font-weight:normal;
                            line-height:100%;
                            letter-spacing:normal;
                            margin-top:0;
                            margin-right:0;
                            margin-bottom:10px;
                            margin-left:0;
                            text-align:left;
                        }
                        h4{
                            color:#808080 !important;
                            display:block;
                            font-family:Helvetica;
                            font-size:14px;
                            font-style:italic;
                            font-weight:normal;
                            line-height:100%;
                            letter-spacing:normal;
                            margin-top:0;
                            margin-right:0;
                            margin-bottom:10px;
                            margin-left:0;
                            text-align:left;
                        }

                        /* ========== Header Styles ========== */

                        #templatePreheader{
                            background-color:#F4F4F4;
                        }
                        #templateBranding {
                            background-color:' . $mc_logo_theme . ';
                        }
                        #templateBranding img {
                            vertical-align: top;
                        }
                        .preheaderContent{
                            color:#808080;
                            font-family:Helvetica;
                            font-size:10px;
                            line-height:125%;
                            text-align:left;
                        }
                        .preheaderContent a:link,
                        .preheaderContent a:visited, /* Yahoo! Mail Override */
                        .preheaderContent a .yshortcuts /* Yahoo! Mail Override */{
                            color:#606060;
                            font-weight:normal;
                            text-decoration:underline;
                        }
                        #templateHeader{
                            background-color:#F4F4F4;
                        }
                        #templateHeader img {
                            height:auto;
                            display:inline;
                            max-width:600px;
                            vertical-align:top;
                        }
                        .headerContent{
                            color:#505050;
                            font-family:Helvetica;
                            font-size:20px;
                            font-weight:bold;
                            line-height:100%;
                            padding-top:0;
                            padding-right:0;
                            padding-bottom:0;
                            padding-left:0;
                            text-align:left;
                            vertical-align:middle;
                        }
                        /**
                        * @tab Header
                        * @section header link
                        * @tip Set the styling for your email header links. Choose a color that helps them stand out from your text.
                        */
                        .headerContent a:link,
                        .headerContent a:visited, /* Yahoo! Mail Override */
                        .headerContent a .yshortcuts /* Yahoo! Mail Override */{
                            color:#EB4102;
                            font-weight:normal;
                            text-decoration:underline;
                        }

                        /* ========== Column Styles ========== */

                        .templateColumnContainer{}
                        #templateColumns{
                            background-color:#F4F4F4;
                            border-top:1px solid #FFFFFF;
                            border-bottom:1px solid #CCCCCC;
                        }
                        #templateArticle {
                            background-color: #fff;
                            border-top: 1px solid #FFFFFF;
                            border-bottom: 1px solid #CCCCCC;
                        }
                        #templateBio {
                            background-color: #F4F4F4;
                            border-top: 1px solid #FFFFFF;
                            border-bottom: 1px solid #CCCCCC;
                        }
                        .bioContent {
                            color: #505050;
                            font-family: Helvetica;
                            font-size: 13px;
                            line-height: 125%;
                            text-align: left;
                            padding-top: 20px;
                            padding-right: 20px;
                            padding-left: 20px;
                            padding-bottom: 20px;
                        }
                        .articleContent {
                            color: #505050;
                            font-family: Helvetica;
                            font-size: 14px;
                            line-height: 150%;
                            padding-top: 20px;
                            padding-right: 20px;
                            padding-left: 20px;
                            padding-bottom: 20px;
                            text-align:left;
                        }
                        .leftColumnContent{
                            color:#505050;
                            font-family:Helvetica;
                            font-size:14px;
                            line-height:150%;
                            padding-top:0;
                            padding-right:10px;
                            padding-bottom:20px;
                            padding-left:10px;
                            text-align:left;
                        }
                        .leftColumnContent a:link,
                        .leftColumnContent a:visited, /* Yahoo! Mail Override */
                        .leftColumnContent a .yshortcuts /* Yahoo! Mail Override */{
                            color:#EB4102;
                            font-weight:normal;
                            text-decoration:underline;
                        }

                        /**
                        * @tab Columns
                        * @section right column text
                        * @tip Set the styling for your email right column content text. Choose a size and color that is easy to read.
                        */
                        .rightColumnContent{
                            color:#505050;
                            font-family:Helvetica;
                            font-size:14px;
                            line-height:150%;
                            padding-top:0;
                            padding-right:10px;
                            padding-bottom:20px;
                            padding-left:10px;
                            text-align:center;
                        }
                        .rightColumnContent a:link,
                        .rightColumnContent a:visited, /* Yahoo! Mail Override */
                        .rightColumnContent a .yshortcuts /* Yahoo! Mail Override */{
                            color:#EB4102;
                            font-weight:normal;
                            text-decoration:underline;
                        }

                        .columnImage{
                            display:inline;
                            height:auto;
                            max-width: 200px !important;
                        }
                        .profileBio {
                            font-size:12px;
                        }
                        .profilePerson {
                            text-align:center;
                            font-size:13px;
                            padding-top: 10px;
                            padding-right: 10px;
                            padding-bottom: 10px;
                            padding-left: 10px;
                        }

                        /* ========== Footer Styles ========== */
                        /**
                        * @tab Footer
                        * @section footer style
                        * @tip Set the background color and borders for your email footer area.
                        * @theme footer
                        */
                        #templateFooter{
                            background-color:#F4F4F4;
                            border-top:1px solid #FFFFFF;
                        }

                        /**
                        * @tab Footer
                        * @section footer text
                        * @tip Set the styling for your email footer text. Choose a size and color that is easy to read.
                        * @theme footer
                        */
                        .footerContent{
                            color:#808080;
                            font-family:Helvetica;
                            font-size:12px;
                            line-height:150%;
                            padding-top:20px;
                            padding-right:20px;
                            padding-bottom:20px;
                            padding-left:20px;
                            text-align:left;
                        }

                        /**
                        * @tip Set the styling for your email footer links. Choose a color that helps them stand out from your text.
                        */
                        .footerContent a:link,
                        .footerContent a:visited, /* Yahoo! Mail Override */
                        .footerContent a .yshortcuts,
                        .footerContent a span /* Yahoo! Mail Override */{
                            color:#606060;
                            font-weight:normal;
                            text-decoration:underline;
                        }
        </style>';
    $mc_styles_mobile = '
    <style type="text/css">
            @media only screen and (max-width: 480px){
                /* ======== CLIENT-SPECIFIC MOBILE STYLES ========= */
                body, table, td, p, a, li, blockquote{
                    -webkit-text-size-adjust:none !important;
                } /* Prevent Webkit platforms from changing default text sizes */
                body{
                    width:100% !important;
                    min-width:100% !important;
                } /* Prevent iOS Mail from adding padding to the body */

                /* ======== MOBILE RESET STYLES ========= */
                #bodyCell{
                    padding:10px !important;
                }

                /* ======== Page Styles ======== */

                #templateContainer{
                    max-width:600px !important;
                    width:100% !important;
                }
                h1{
                    font-size:24px !important;
                    line-height:100% !important;
                }
                h2{
                    font-size:20px !important;
                    line-height:100% !important;
                }
                h3{
                    font-size:18px !important;
                    line-height:100% !important;
                }
                h4{
                    font-size:16px !important;
                    line-height:100% !important;
                }

                /* ======== Header Styles ======== */
                #headerImage{
                    height:auto !important;
                    max-width:600px !important;
                    width:100% !important;
                }
                .headerContent{
                    font-size:20px !important;
                    line-height:125% !important;
                }

                /* ======== Column Styles ======== */

                .templateColumnContainer{
                    display:block !important;
                    width:100% !important;
                }
                #templateHeader img {
                    height:auto !important;
                    max-width:300px !important;
                    width:100% !important;
                }
                .leftColumnContent{
                    font-size:16px !important;
                    line-height:125% !important;
                }
                .rightColumnContent{
                    font-size:16px !important;
                    line-height:125% !important;
                }

                /* ======== Footer Styles ======== */
                .footerContent{
                    font-size:14px !important;
                    line-height:115% !important;
                }
                .footerContent a{
                    display:block !important;
                }
            }
    </style>';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if ($css): ?>
    <style type="text/css">
      <!--
      <?php print $css ?>
      -->
    </style>
    <?php endif; ?>
    <?php print $mc_styles ?>
  </head>
  <body id="mimemail-body" <?php if ($module && $key): print 'class="'. $module .'-'. $key .'"'; endif; ?> leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <center>
        <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
          <tr>
            <td align="center" valign="top" id="bodyCell">
              <!-- BEGIN TEMPLATE // -->
              <table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                <?php print $mc_logo_html ?>
                <?php print $mc_profile_html ?>
                <tr>
                  <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateArticle">
                      <tr>
                        <td align="center" valign="top" class="articleContent"><?php print $body ?></td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <?php print $mc_promotional_html ?>
                <tr>
                  <td align="center" valign="top">
                    <!-- BEGIN FOOTER // -->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                      <?php print $mc_disclaimer_html ?>
                      <tr>
                        <td valign="top" class="footerContent" style="padding-top:0;">
                          <em>Copyright &copy; <?php print date('Y'); ?> Business Enterprise Institute, Inc., All rights reserved.</em>
                        </td>
                      </tr>
                    </table>
                    <!-- // END FOOTER -->
                  </td>
                </tr>
              </table>
              <!-- // END TEMPLATE -->
            </td>
          </tr>
        </table>
    </center>
  </body>
</html>
