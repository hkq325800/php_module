<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@abstract 发送邮件模块
*	@param $myConfig    $to    $html
*	config中须包括：api_user、api_key
*	from 发信邮件地址
*	fromname 发信人
*	to 收件人地址 多个地址用';'分隔
*	subject 邮件标题
*	html 邮件内容 可为html页面
*	files 用相对位置表示
*   调用方法：$this->load->library('my_send_mail');
*   $this->my_send_mail->send_mail($this->config,'576679268@qq.com','蛤蛤');
*/
class My_send_mail {
	function send_mail($myConfig,$to,$html) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, $myConfig->item('url'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                                'api_user' => $myConfig->item('api_user'),
                                'api_key' => $myConfig->item('api_key'),
                                'from' => $myConfig->item('from'), 
                                'fromname' => $myConfig->item('fromname'),
                                'to' => $to,
                                'subject' => $myConfig->item('subject'),
                                'html' => $html,
                                'files' => $myConfig->item('files')));
        $result = curl_exec($ch);
        if($result === false) {
        	echo curl_error($ch);//log代替echo
        }
        curl_close($ch);
        echo $result;
	}
}
/* End of file send_mail.php */
/* Location: ./application/libraries/send_mail.php */