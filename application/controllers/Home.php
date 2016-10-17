<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		$this->load->view('head');
		$this->load->view('page/landing');
		$this->load->view('foot');
	}

	public function register()
	{
		$error_count = 0;
		$data = $this->input->get(null, true);

//		print_r($data);
		$errors = $this->validate_inputs($data);

		foreach ($errors as $key => $value)
		{
			if ($value)
				$error_count++;
		}

		if(!$error_count) {
			$this->send_mail($data);
			$this->user_model->add_user($data);
		}

		$this->encode_data($errors);
	}
	
	protected function send_mail($data)
	{
//		please refer to this link for email service https://www.linkedin.com/pulse/how-send-email-using-html-templates-codeigniter-anil-kumar-panigrahi
		$config = Array(
			'protocol' => 'sendmail',
			'smtp_port' => 25,
			'smtp_timeout' => '4',
			'mailtype'  => 'html',
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('jahgracilla@gmail.com', 'Jay Albert Arcilla');
		$this->email->to($data['email']);
		$this->email->subject('Chowpocket Subscription');

		$body = $this->load->view('email/subscribe', $data, TRUE);
		$this->email->message($body);
		$this->email->send();
	}

	protected function validate_inputs($fields)
	{
		$error = array();
		$error['first_name_error'] = empty($fields['first_name']) || !isset($fields['first_name']) ? true : false;
		$error['last_name_error'] = empty($fields['last_name']) || !isset($fields['last_name']) ? true : false;
		$error['email_error'] = ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $fields['email'])) ? true : false;
		$error['mobile_error'] = ( ! preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $fields['mobile_number'])) ? true : false;
		$error['address_error'] = empty($fields['address']) || !isset($fields['address']) ? true : false;

		return $error;
	}

	protected function encode_data($data)
	{
		header('Access-Control-Allow-Origin: *');
		header("Content-Type: application/json");
		echo json_encode($data);
	}
}
