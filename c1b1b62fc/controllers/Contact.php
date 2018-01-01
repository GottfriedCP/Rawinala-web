<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('email');
    }

	public function index()
	{
        $page['title'] = "Hubungi Kami - Rawinala";

        $this->load->view('templates/header', $page);
        $this->load->view('contact');
		$this->load->view('templates/footer');
    }
    
    public function send() 
    {
        if ('post' == $this->input->method()) {
            $recaptcha_secret = "6Le1xzIUAAAAAAoOvQGPyMhLzRSIALCS7-Ob9oY9";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$this->input->post('g-recaptcha-response'));
            $response = json_decode($response, true);
            
            if ($response["success"] === true) {
                $name_input = $this->input->post('name');
                $email_input = $this->input->post('email');
                $message_input = strip_tags($this->input->post('message'));
                
                if (min(strlen($name_input), strlen($email_input), strlen($message_input)) == 0 || !filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
                    $this->session->set_flashdata('contact_form_input_error', TRUE);
                    redirect('/contact');
                }

                // Save message to database
                $this->db->set('name', $name_input)
                    ->set('email', $email_input)
                    ->set('message', $message_input)
                    ->set('created_on', time())
                    ->insert('message');

                // Send message to admin via email
                $config['mailtype'] = 'text';
                $this->email->initialize($config);

                $this->email->from($email_input, $name_input.' (via Rawinala.org)');
                $this->email->to('dwihardjosto@gmail.com');
                $this->email->cc('gprasetyadi@rawinala.org, office@rawinala.org');
                $this->email->subject('Rawinala - Message from '.$name_input);
                $this->email->message(
                    "Pada ".date("j F Y, H:i", time()).
                    ", ".$name_input." (".$email_input.") meninggalkan pesan:\n\n".
                    $message_input
                );
                if ($this->email->send()) {
                    $this->session->set_flashdata('message_sent', 'sent');
                    redirect('/contact');
                }else{
                    $this->session->set_flashdata('message_sent', 'not_sent');
                    redirect('/contact');
                }
            }else{
                $this->session->set_flashdata('captcha_error', TRUE);
                redirect('/contact');
            }
        }else{
            redirect('/contact');
        }
    }
}
