<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Message_model', 'msg');
        $this->load->helper('form');
    }

    public function login() {
        $page['title'] = "Login - Rawinala";

        if ($this->session->userdata('logged_in')){
            redirect('/');
        } else {
            $this->load->view('templates/header', $page);
            $this->load->view('member/login_form');
            $this->load->view('templates/footer');
        }
    }
    
    public function authenticate() {
        if (!'post' == $this->input->method()) { redirect('/'); }
        $recaptcha_secret = "6Le1xzIUAAAAAAoOvQGPyMhLzRSIALCS7-Ob9oY9";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$this->input->post('g-recaptcha-response'));
        $response = json_decode($response, true);
        
        if ($response["success"] === true){
            $this->authenticate_user();
        } else {
            $this->session->set_flashdata('captcha_error', TRUE);
            redirect('/member/login');
        }
    }

    private function authenticate_user() {
        if ('post' == $this->input->method() && NULL === $this->session->userdata('logged_in')) {
            $username = $this->input->post('username');
            $passwrod = $this->input->post('password');
            if (min(strlen($username), strlen($passwrod)) == 0) {
                $this->session->set_flashdata('signin_error', TRUE);
                redirect('/member/login');
            }
            if ($this->user->is_authenticated($username, $passwrod)) {
                $this->session->set_userdata(['logged_in' => TRUE, 'id' => $this->user->id, 'name' => $this->user->name, 'rname' => $this->user->rname, 'level' => $this->user->level]);
                // Count unread messages
                $this->session->set_userdata('unread_messages', $this->msg->count_unread());
                redirect('/');
            } else {
                $this->session->set_flashdata('signin_error', TRUE);
                redirect('/member/login');
            }
        } else {
            redirect('/member/login');
        }
    }

    public function logout() {
        session_destroy();
        redirect('/');
    }
}
