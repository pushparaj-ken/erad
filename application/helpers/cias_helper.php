<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        
        // $CI = setProtocol();        
        
        // $CI->email->from(EMAIL_FROM, FROM_NAME);
        // $CI->email->subject("Reset Password");
        // $CI->email->message($CI->load->view('admin/email/resetPassword', $data, TRUE));
        // $CI->email->to($detail["email"]);
        // $status = $CI->email->send();
        
        // return $status;
		
		$from = "no-reply@jockey.com";
		$to = $detail["email"];
		$cc = "";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$headers .= "From: " . $from . "\r\n" .
		"CC: " . $cc;
		
		$subject = "Reset Password";
		
		$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Reset Your Password</title>
	</head>
	<body>
		<div>
			<table style="width:100%;border-spacing:0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
					<th style="border-top:solid 5px #f56400;font-weight:normal;text-align:center;background:#ffffff;border-bottom:solid 1px #e3e5e1">
						<table style="width:100%;max-width:596px;border-spacing:0;margin:0 auto" cellpadding="0" cellspacing="0" align="center">
							<tbody>
								<tr>
									<td>
										<table style="margin:0%;width:100%;border-spacing:0;table-layout:fixed" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td style="padding:17px 3.358% 15px">
														<cite style="text-align:center;display:block;font-style:normal">
															<span style="font-size:1px;min-height:0;color:#fff;width:0;display:block">Just one more step.</span>
															<dl style="list-style-type:none;padding:0;overflow:hidden;margin:0">
																<dt style="font-size:15px;display:inline-block;width:100%;margin:0;padding:0 0 12px 0;vertical-align:top;padding-bottom:0!important">
																	<a href="'.base_url().'" title="Jockey" style="display:inline-block" target="_blank">Jockey Admin</a>
																</dt>
																<div style="font-size:15px;display:inline-block;width:100%;margin:0;vertical-align:top"></div>
															</dl>
														</cite>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</th>
					</tr>
					<tr><th style="background:#f5f5f1;height:28px"></th></tr>
					<tr>
					<th style="background:#f5f5f1;font-weight:normal;text-align:left">
						<table style="width:100%;max-width:596px;border-spacing:0;margin:0 auto" cellpadding="0" cellspacing="0" align="center">
							<tbody>
								<tr>
									<td>
										<table style="margin:0%;width:100%;border-spacing:0;table-layout:fixed" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td style="padding:0 3.358%;font-size:15px;color:#555;line-height:24px">    
														<div style="min-height:28px"></div>
														<div style="padding:24px 3.6% 24px;background:#fff;border:1px solid #e3e5e1">
															<table cellpadding="0" cellspacing="0" style="width:100%;margin:0;padding:0">
																<tbody>
																	<tr>
																		<td align="center">
																			<div style="width:100%">
																				<b>Hi, '.$detail["name"].'</b>! <span class="il">'.$detail["message"].'</span>
																				<div style="min-height:20px"></div>
																				<div style="width:100%">
																					<a style="display:inline-block;font-size:15px;padding:10px 18px;vertical-align:middle;color:#ffffff;background:#34a8c4;border-top:solid 1px #2c8ea6;border-right:solid 1px #2c8ea6;border-bottom:solid 1px #2c8ea6;border-left:solid 1px #2c8ea6;border-radius:3px;text-decoration:none;white-space:normal;font-weight:bold;line-height:18px" href="'.$detail['reset_link'].'" target="_blank"> <span class="il"> Reset Password Link </span></a>
																				</div>
																				<div style="min-height:28px"></div>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="yj6qo"></div>
						<div class="adL"></div>
					</th>
					</tr>
					<tr><th style="background:#f5f5f1;height:28px"></th></tr>
					<tr><th style="background:#f5f5f1;height:28px"></th></tr>
				</tbody>
			</table>
		</div>
	</body>
</html>';
		
		$status = mail($to,$subject,$msg,$headers);
		return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

?>