<?php
class ControllerModuleFlySms extends Controller {
	private $module_name = 'flysms';
	private $error = array(); 

	public function index() {   
		$this->language->load('module/'.$this->module_name);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if ( isset($this->request->post['login']) ) $this->request->post['login'] = trim($this->request->post['login']);
			if ( isset($this->request->post['password']) ) $this->request->post['password'] = trim($this->request->post['password']);
			if ( isset($this->request->post['alfaname']) ) $this->request->post['alfaname'] = trim($this->request->post['alfaname']);
			$this->model_setting_setting->editSetting($this->module_name, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		// Data
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} else {
			$this->data['status'] = $this->config->get('status');
		}
		if (isset($this->request->post['login'])) {
			$this->data['login'] = $this->request->post['login'];
		} else {
			$this->data['login'] = $this->config->get('login');
		}
		if (isset($this->request->post['password'])) {
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = $this->config->get('password');
		}
		if (isset($this->request->post['alfaname'])) {
			$this->data['alfaname'] = $this->request->post['alfaname'];
		} else {
			$this->data['alfaname'] = $this->config->get('alfaname');
		}
		if (isset($this->request->post['order_new'])) {
			$this->data['order_new'] = $this->request->post['order_new'];
		} else {
			$this->data['order_new'] = $this->config->get('order_new');
		}
		if (isset($this->request->post['order_notify'])) {
			$this->data['order_notify'] = $this->request->post['order_notify'];
		} else {
			$this->data['order_notify'] = $this->config->get('order_notify');
		}

		// Translation
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['text_status'] = $this->language->get('text_status');
		$this->data['text_login'] = $this->language->get('text_login');
		$this->data['text_password'] = $this->language->get('text_password');
		$this->data['text_alfaname'] = $this->language->get('text_alfaname');
		$this->data['text_shortcodes'] = $this->language->get('text_shortcodes');
		$this->data['text_order_new'] = $this->language->get('text_order_new');
		$this->data['text_order_notify'] = $this->language->get('text_order_notify');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		// Template

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_modules'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/'.$this->module_name, 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('module/'.$this->module_name, 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'module/'.$this->module_name.'.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/'.$this->module_name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>