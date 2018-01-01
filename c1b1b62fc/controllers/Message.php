<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Message_model', 'message');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('pagination');
    }

	public function index($page_num = 1)
	{
        if (!$this->session->userdata('logged_in')) { redirect('/'); }
        $page['title'] = "Pesan Pengunjung";
        $data['messages'] = $this->message->get_some(50, ($page_num-1)*50);
        if ($data['messages'] == NULL && $page_num != 1) {
            show_404();
        }

        // Count unread messages
        $this->session->set_userdata('unread_messages', $this->message->count_unread());

        // Pagination
        $config['base_url'] = base_url('message');
        $config['uri_segment'] = 2;
        $config['total_rows'] = $this->message->count();
        $config['per_page'] = 50;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        $this->load->view('templates/header', $page);
        $this->load->view('message/message_list', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($id)
    {
        if (!$this->session->userdata('logged_in')) { redirect('/'); }
        if ($this->message->get($id)) {
            $data['id'] = $this->message->id;
            $data['name'] = $this->message->name;
            $data['email'] = $this->message->email;
            $data['created_on'] = $this->message->created_on;
            $data['message'] = $this->message->message;
            $data['reply'] = $this->message->reply;
            $data['forwarded_to'] = $this->message->forwarded_to;

            // Mark as read
            $this->message->set_read($id);
            // Count unread messages
            $this->session->set_userdata('unread_messages', $this->message->count_unread());

            $page['title'] = 'Pesan dari '.$data['name'];
            $this->load->view('templates/header', $page);
            $this->load->view('message/message_content', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->set_flashdata('message_not_found', TRUE);
            redirect('message');
        }
    }

    public function send_reply()
    {
        if (!$this->session->userdata('logged_in') && !$this->input->method() == 'post') { redirect('/'); }
        $id = $this->input->post('id');
        $email =  $this->input->post('email');
        $reply = strip_tags($this->input->post('reply'));
        $origin_message = $this->input->post('origin_message');
        // Set message's reply
        $this->message->set_reply($id, $reply);
        
        // Send the reply email
        $config['mailtype'] = 'text';
        $this->email->initialize($config);

        $this->email->from('no-reply@rawinala.org', 'Rawinala');
        $this->email->to($email);
        $this->email->subject('Rawinala - Message response');
        $this->email->message(
            $reply.
            "\n\n----------------------------------------------\n".
            "This is the reply to your message to Rawinala:\n\n".
            $origin_message
        );
        if ($this->email->send()) {
            $this->session->set_flashdata('reply_sent', TRUE);
        }else{
            $this->session->set_flashdata('reply_not_sent', TRUE);
        }

        redirect('message/view/'.$id);
    }

    public function forward()
    {
        if (!$this->session->userdata('logged_in') && !$this->input->method() == 'post') { redirect('/'); }
        $origin_id = $this->input->post('origin_id');
        $origin_name = $this->input->post('origin_name');
        $origin_email = $this->input->post('origin_email');
        $origin_message = $this->input->post('message');
        $dest_email = $this->input->post('email_forward');

        // Set message's forward status
        $this->message->set_forward_email($origin_id, $dest_email);

        // Forward the email
        $config['mailtype'] = 'text';
        $this->email->initialize($config);

        $this->email->from($origin_email, $origin_name);
        $this->email->to($dest_email);
        $this->email->subject('Rawinala - Pesan dari '.$origin_name);
        $this->email->message(
            $origin_name." (".$origin_email.") meninggalkan pesan di website:\n\n".
            $origin_message
        );
        if ($this->email->send()){
            $this->session->set_flashdata('message_forwarded', TRUE);    
        }else{
            $this->session->set_flashdata('message_not_forwarded', TRUE);
        }

        redirect('message/view/'.$origin_id);
    }

    public function delete()
    {
        if (!$this->session->userdata('logged_in') && $this->input->method() != 'post') { redirect('/'); }
        $id_to_delete = $this->input->post('message_id');
        $this->message->delete($id_to_delete);
        redirect('message');
    }
}
