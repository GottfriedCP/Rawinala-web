<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Article_model', 'news');
    }

	public function index()
	{
        $data['news'] = $this->news->get_some(5);

        $page['title'] = "Rawinala";
        $this->load->view('templates/header', $page);
        $this->load->view('home', $data);
		$this->load->view('templates/footer');
    }

    public function about()
	{
        $page['title'] = "Tentang Kami - Rawinala";
        
        $this->load->view('templates/header', $page);
        $this->load->view('about');
		$this->load->view('templates/footer');
	}
    
    public function donation($donation_status = 'show_info')
    {
        if ($donation_status == 'success') {
            $page['title'] = "Thank You!";
            $this->load->view('templates/header', $page);
            $this->load->view('donation/success');
            $this->load->view('templates/footer');
        }elseif ($donation_status = 'show_info') {
            $page['title'] = "Donasi - Rawinala";
            $this->load->view('templates/header', $page);
            $this->load->view('donation/info');
            $this->load->view('templates/footer');
        }else{
            redirect('/');
        }
    }
}
