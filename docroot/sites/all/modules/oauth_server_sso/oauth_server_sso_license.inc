<?php
function oauth_server_sso_license($form, $form_state)
{
    global $base_url;

    drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));
      drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));

  $form['oauth_server_sso_license_tab'] = array(
    '#markup' => "
    <head>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
    </head>
    <div id='mo_oauth_table_layout'>
		<h2>Licensing Plans<a style='float:right' href='index.php?option=com_miniorange_oauth' class='btn btn-primary' role='button'>Ok, Got it</a></h2><br>
		<table class='table mo_table-bordered mo_table-striped' border='1' bordercolor='black'>
            <thead class='thead-dark'>
            <tr style='background-color:#FFFFFF'>
                <th width='20%' style='text-align:center'><br>
                    <h3><font color='#FFFFFF'>Features \ Plans</font></h3><br><br></th>
                <th width='10%' style='text-align:center'><br></h3><p class='mo_plan-desc'></p><h3><font color='#FFFFFF'>FREE</font><br><br><br><span>
                </span></h3></th>
                <th style='text-align:center' width='10%'><h3><font color='#FFFFFF'>Standard<br></font></h3><p class='mo_plan-desc'></p><h3><font color='#FFFFFF'>$49</font><br><br><span>
                <a href='https://www.miniorange.com/contact' class='btn btn-primary' style='margin-bottom:3.8%;' role='button' target='_blank' id='oauth_upgrade'>Contact Us</a>
                </span></h3></th>
                <th style='text-align:center' width='10%'><h3><font color='#FFFFFF'>Premium</font></h3><p></p><p class='mo_plan-desc'></p><h3><font color='#FFFFFF'>$79</font><br><br><span>
				<a href='https://www.miniorange.com/contact' class='btn btn-primary' style='margin-bottom:3.8%;' role='button' target='_blank' id='oauth_upgrade'>Contact Us</a>
            </th>
			<th style='text-align:center' width='10%'><h3><font color='#FFFFFF'>Enterprise</font></h3><p></p><p class='mo_plan-desc'></p><h3><font color='#FFFFFF'>$299</font><br><br><span>
			<a href='https://www.miniorange.com/contact' class='btn btn-primary' style='margin-bottom:3.8%;' role='button' target='_blank' id='oauth_upgrade'>Contact Us</a>
            </th></tr>
            </thead>
			 <tbody>
			<tr>
                <td style='text-align:center'>1 Client Support</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
				<td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
			<td style='text-align:center'>Authorization Code Grant</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
				<td style='text-align:center'>&#x2714;</td>
            </tr>
			<tr>
            <td style='text-align:center'>Resource Owner Credentials Grant(Password Grant) </td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
				<td style='text-align:center'>&#x2714;</td>
            </tr>
			<tr>
            <td style='text-align:center'>One Time Authorization </td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
				<td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>Client Credentials Grant</td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
				<td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>Implicit Grant</td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
				<td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>Refresh token Grant</td>
				<td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
			<tr>
                <td style='text-align:center'>Enable/Disable Switch</td>
                <td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
			 <tr>
                <td style='text-align:center'>Block Unauthenticated Requests to the REST API</td>
                <td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>Token Length</td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>Redirect URI validation</td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>Enforce State parameter</td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>OIDC support </td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
			<tr>
                <td style='text-align:center'>Extended OAuth API support </td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
			<tr>
                <td style='text-align:center'>JWT Signing Algorithm</td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
			<tr>
                <td style='text-align:center'>Error Logging</td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
            <tr>
                <td style='text-align:center'>End to End Integration ** </td>
                <td style='text-align:center'></td>
				<td style='text-align:center'></td>
				<td style='text-align:center'></td>
                <td style='text-align:center'>&#x2714;</td>
            </tr>
		</table>
		</div> ");
    return $form;
}
?>