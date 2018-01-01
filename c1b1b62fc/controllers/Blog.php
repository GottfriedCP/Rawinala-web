<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Article_model', 'article');
        $this->load->helper('form');
        $this->load->library('pagination');
    }

	public function index($page_num = 1) {
        // List all articles;
        $page['title'] = "Blog - Rawinala";
        $data['articles'] = $this->article->get_some(20, ($page_num-1)*20);
        if ($data['articles'] == NULL && $page_num != 1) {
            show_404();
        }
        // Pagination
        $config['base_url'] = base_url('blog');
        $config['uri_segment'] = 2;
        $config['total_rows'] = $this->article->count();
        $config['per_page'] = 20;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        $this->load->view('templates/header', $page);
        $this->load->view('blog/blog_list', $data);
		$this->load->view('templates/footer');
    }
    
    public function view($id, $url_title) {
        if ($this->article->get($id, $url_title)) {
            $page['title'] = $this->article->title;

            $data['id'] = $this->article->id;
            $data['title'] = $this->article->title;
            $data['url_title'] = $this->article->url_title;
            $data['body'] = $this->article->body;
            $data['created_on'] = date("j F Y, H:i:s", $this->article->created_on);
            $data['author_id'] = $this->article->author_id;
            $data['author_name'] = $this->article->author_name;
            
            $this->load->view('templates/header', $page);
            $this->load->view('blog/blog_content', $data);
            $this->load->view('templates/footer');
        } else {
            show_404();
        }
    }

    public function create() {
        if (!$this->session->userdata('logged_in')) { redirect('/'); }
        if ('post' == $this->input->method()) {
            // Check if content is present
            if ($this->input->post('content') == "") {
                $this->session->set_flashdata(['article_empty' => TRUE]);
                redirect('/blog/create');
            }
            $this->article->title = $this->input->post('title');
            $this->article->url_title = $this->article->sluggify($this->input->post('title'));
            $this->article->body = $this->input->post('content');
            $this->article->created_on = time();
            $this->article->author_id = $this->session->userdata('id');
            $new_article = $this->article->insert();
            redirect('/blog/view/'.$new_article['id'].'/'.$new_article['url_title']);
        } else {
            $page['title'] = "Tulis Artikel";
            $this->load->view('templates/header', $page);
            $this->load->view('blog/blog_create_form');
            $this->load->view('templates/footer');
        }
    }

    public function update($id, $url_title) {
        if (!$this->session->userdata('logged_in')) { redirect('/'); }
        if ($this->input->method() == 'post') {
            if (!$this->article->get($id, $url_title)) { redirect('/blog'); }
            // Check if inputs are empty
            if (min(strlen($this->input->post('title')), strlen($this->input->post('content'))) == 0) {
                $this->session->set_flashdata('article_empty', TRUE);
                redirect('/blog/update/'.$id.'/'.$url_title);
            } else{
                $this->article->id = $id;
                $this->article->url_title = $url_title;
                $this->article->title = $this->input->post('title');
                $this->article->body = $this->input->post('content');
                if ($this->article->update()) {
                    redirect('/blog/view/'.$id.'/'.$url_title);
                }
            }            
        }else{
            // Display form
            if ($this->article->get($id, $url_title)) {
                $data['id'] = $this->article->id;
                $data['url_title'] = $this->article->url_title;
                $data['title'] = $this->article->title;
                $data['content'] = $this->article->body;

                $page['title'] = "Perbarui Artikel";
                $this->load->view('templates/header', $page);
                $this->load->view('blog/blog_update_form', $data);
                $this->load->view('templates/footer');
            } else {
                redirect('/blog');
            }
            
        }
    }

    public function deletex($id, $url_title) {
        if (!$this->session->userdata('logged_in')) { redirect('/'); }
        $this->article->delete($id, $url_title);
        redirect('/blog');
    }
}
