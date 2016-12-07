<?php
class ControllerModuleNotification extends Controller {
	
	public function registerUser() {
		
		$this->load->language('module/notification');
		
		$this->load->model('catalog/product');
		
		$json = array();
		$product_id = 0;
		$user_email = '';
		
		if (isset($this->request->post['notify_product_id'])) {
			$product_id = (int)$this->request->post['notify_product_id'];	
		}
		
		if (isset($this->request->post['userEmail'])) {
			$user_email = $this->request->post['userEmail'];	
		}
		
		if ($user_email == '' || $user_email == 'your@email.com' )
		{
			$json['error'] = sprintf($this->language->get('email_is_mandatory'));
		}
		else if ($product_id == 0)
		{
			$json['error'] = sprintf($this->language->get('product_is_not_correct'));
		}
		else if ($product_id <> 0)
		{
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			//$mail->protocol = "mail"; 
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			//$mail->setTo($this->config->get('config_email'));
			$mail->setTo($this->config->get('config_contact_email'));
			//$mail->setFrom($this->request->post['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_email'), ENT_QUOTES, 'UTF-8'));		
			$mail->setSubject(html_entity_decode('Customer registered for Product Notification', ENT_QUOTES, 'UTF-8'));
			$mail->setText($product_info['product_id']."\n\n".$product_info['name']."\n\n".$user_email);
			$mail->send();
			
			
			$json['success'] = sprintf($this->language->get('success_message'));
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}	
?>