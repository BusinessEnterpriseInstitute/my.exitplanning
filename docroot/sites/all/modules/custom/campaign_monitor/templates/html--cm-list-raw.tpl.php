<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?>
<!DOCTYPE html>
<!-- Sorry no IE7 support! -->
<!-- @see http://foundation.zurb.com/docs/index.html#basicHTMLMarkup -->

<!--[if IE 8]><html class="no-js lt-ie9" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print $head_title; ?></title>
<style type="text/css">
  <?php print $extra_styles; ?>
</style>
<style type="text/css">
  #background-cell { padding: 20px; }
  /* Client-specific Styles */
  #outlook a { padding: 0; } /* Force Outlook to provide a "view in browser" button. */
  body { width: 100% !important; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */
  .ExternalClass,
  .ExternalClass p,
  .ExternalClass span,
  .ExternalClass font,
  .ExternalClass td,
  .ExternalClass div {
    line-height: 100%; /* Force Hotmail to display normal line spacing */
  }
  body, table, td, p, a, li, blockquote {
    -webkit-text-size-adjust:100%;
    -ms-text-size-adjust:100%;
  } /* Prevent WebKit and Windows mobile changing default text sizes */
  table, td {
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
  } /* Remove spacing between tables in Outlook 2007 and up */
  img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
  
  /* Reset Styles */
  html, body { margin: 0; padding: 0; }
  img {
    border: 0;
    height: auto;
    line-height: 100%;
    outline: none;
    text-decoration: none;
  }
  br, strong br, b br, em br, i br { line-height:100%; }
  p { margin-top: 0};
  h1, h2, h3, h4, h5, h6 {
    line-height: 100% !important;
    -webkit-font-smoothing: antialiased;
    letter-spacing: normal;
  }
  h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
  h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }
  /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
  h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
  /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  
  table {
    border-collapse: collapse !important;
  }
  .yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
  } /* Body text color for the New Yahoo.  This example sets the font of Yahoo's Shortcuts to black. */
  /* This most probably won't work in all email clients. Don't include <code _tmplitem="277" > blocks in email. */
  code {
    white-space: normal;
    word-break: break-all;
  }
  /* Webkit Elements */
  #top-bar a { font-weight: bold; color: #444444; text-decoration: none;}
  /* Fonts and Content */
  body { font-family: "Helvetica Neue", Arial, Helvetica, sans-serif; }
  .header-content, .footer-content { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
  /* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */
  #banner-table,
  #footer-table {
    background-color: #FFFFFF;
  }
  #banner-table img {
    display: block;
  }
  #profile-table {background-color: #F4F4F4;}
  #profile-table .profile-pic,
  #profile-table .profile-bio {
    padding: 10px;
  }
  .profile-bio {
    font-size: 13px;
    line-height: 150%;
  }
  .profile-pic {
    text-align: right;
  }
  #article { background-color: #FFFFFF; }
  .article-title { font-size: 18px; line-height:24px; color: #444444; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: "Helvetica Neue", Arial, Helvetica, sans-serif; }
  .article-title a { color: #444444; text-decoration: none; }
  .article-title.with-meta {margin-bottom: 0;}
  .article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}
  .article-content { font-size: 16px; line-height: 150%; color: #505050; font-family: "Helvetica Neue", Arial, Helvetica, sans-serif; padding: 20px;}
  .article-content a { color: #3CA7DD; font-weight:bold; text-decoration:none; }
  .article-content img { max-width: 100% }
  .article-content ol, .article-content ul {
    margin-top:0px;
    margin-bottom:20px;
    margin-left:20px;
    padding:0;
    list-style-position: inside;
  }
  .article-content p {margin-bottom: 15px;}
  .disclaimer-content { font-size: 12px; color: #808080; line-height: 125%; background-color: #F4F4F4; padding: 15px }
  .footer-content {padding: 20px;}
  #copyright {text-align: center;}
  .footer-content-left a { color: #3CA7DD; font-weight: bold; text-decoration: none; }
  .footer-content-right { font-size: 11px; line-height: 16px; color: #A6A6A6; margin-top: 0px; margin-bottom: 15px; }
  .footer-content-right a { color: #3CA7DD; font-weight: bold; text-decoration: none; }
  #footer-table { font-size: 12px; line-height: 15px; color: #808080;}
  #footer-table a { color: #808080; text-decoration: none;}
  #permission-reminder { white-space: pre-wrap; text-align: left; }
  #street-address { color: #B3B3B3; white-space: pre-wrap; }
  /* Mobile-specific Styles */
  @media only screen and (max-width: 480px) {
    #template-table {
      max-width:600px !important;
      width:100% !important;
    }
    #background-cell { padding: 10px; }
    #logo-table img,
    #banner-table img,
    #profile-table img {
      height: auto !important;
      max-width: 100% !important;
    }
    .profile-pic {
      text-align: center !important;
    }
    .template-column {
      display:block !important;
      width:100% !important;
    }
    .article-content, #disclaimers, .footer-content {
      padding: 10px !important;
    }
    #copyright, #permission-reminder {
      text-align: left !important;
    }
    table[class=hide], td[class=hide], img[class=hide], p[class=hide], span[class=hide], .hide { display:none !important; }
    table[class=h0], td[class=h0] { height: 0 !important; }
    p[class=footer-content-left] { text-align: center !important; }
    #headline p { font-size: 30px !important; }
  } 
</style>

</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php print $page; ?>
</body>
</html>
