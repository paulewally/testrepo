<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index()
	{
		$this->home();
	}

	public function home(){
		$this->load->model("model_get");
		$data['title'] = "Home Page";
		$data["results"] = $this->model_get->getData("home");
		$this->load->view("site_header", $data);
		$this->load->view("site_nav");
		$this->load->view("content_home", $data);
		$this->load->view("site_footer");

	}

	public function about(){
		$this->load->model("model_get");
		$data['title'] = "About Us";
		$this->load->view("site_header", $data);
		$data["results"] = $this->model_get->getData("about");
		$this->load->view("site_nav");
		$this->load->view("content_about", $data);
		$this->load->view("site_footer");

	}

	public function contact(){
		$data["message"] = "";
		$data['title'] = "Contact Us";
		$this->load->view("site_header", $data);
		$this->load->view("site_nav");
		$this->load->view("content_contact", $data);
		$this->load->view("site_footer");

	}

	public function send_email(){
		$this->load->library("form_validation");
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules("fullName", "Full Name", "required|alpha|xss_clean");
		$this->form_validation->set_rules("email", "Email Address", "required|valid_email|xss_clean");
		$this->form_validation->set_rules("message", "Message", "required|xss_clean");

		if($this->form_validation->run() == FALSE){
			$data["message"] = "";
			//$this->load->view("site_header");
			//$this->load->view("site_nav");
			$this->load->view("content_contact", $data);
			//$this->load->view("site_footer");
		}else{
			$data["message"] = "The email has been successfully sent";
			$this->load->library("email");
			$this->email->to("paul.p.walters@gmail.com");
			$this->email->from(set_value("email"), set_value("fullName"));
			$this->email->subject("Message from Site Contact Form");
			$this->email->message(set_value("message"));
			//$this->email->send();

			//echo $this->email->print_debugger();

			$this->load->view("site_header");
			$this->load->view("site_nav");
			$this->load->view("content_contact", $data);
			$this->load->view("site_footer");

		}

	}


}

