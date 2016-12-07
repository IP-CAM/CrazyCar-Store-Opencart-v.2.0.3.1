<?php  
class ControllerModuleGoogleadsense extends Controller {
	public function index($module) {

    	static $mod = 0;
		
		
		$code = $module['code'];
		$data['code'] = html_entity_decode($code, ENT_QUOTES, 'UTF-8');
		
		
		$data['mod'] = $mod++; 
		//$data['position'] = $module['position']; 
		if(isset($module['abs'])){
			$data['abs'] = $module['abs']; 
		}else{
			$data['abs'] = ''; 
		}
		/*
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/google_adsense.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/google_adsense.tpl', $data);
		} else {
			return $this->load->view('default/template/module/google_adsense.tpl', $data);
		}
		*/
	}
}
?>