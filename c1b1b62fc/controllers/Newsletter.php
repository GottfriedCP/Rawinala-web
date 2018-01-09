<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('secrets');
        $this->load->library('email');
        $this->load->model('Subscriber_model', 'subscriber');
    }

    public function subscribe()
    {
        if ('post' == $this->input->method()) {
            $recaptcha_secret = get_rcp_secret_key();
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$this->input->post('g-recaptcha-response'));
            $response = json_decode($response, true);
            
            if ($response["success"] === true) {
                $this->subscriber->email = $this->input->post('subscribe_email');
                $this->subscriber->created_on = time();
                $subscribe_status = $this->subscriber->subscribe();
                
                $this->session->set_flashdata(['subscribe_status' => $subscribe_status]);

                if ($subscribe_status) {
                    // Send welcome email
                    $config['mailtype'] = 'text';
                    $this->email->initialize($config);
                    
                    $this->email->from('no-reply@rawinala.org', 'Rawinala');
                    $this->email->to($this->subscriber->email);
                    $this->email->subject('Sapa Sahabat Rawinala - Subscription Confirmation');
                    $this->email->message(
                        "Hello,\n\n".
                        "This email is sent to you to confirm that you have been subscribed successfully to our newsletter 'Sapa Sahabat Rawinala'.\n\n".
                        "To unsubscribe: https://www.rawinala.org/newsletter/unsubscribex/".urlencode($this->subscriber->email)."/".$this->subscriber->created_on
                    );
                    $this->email->send();
                }

                redirect('/#form-ci');
            }
        }
    }

    public function unsubscribex($email, $time_registered)
    {
        $this->subscriber->email = urldecode($email);
        $this->subscriber->created_on = $time_registered;

        $this->session->set_flashdata(['unsubscribed' => $this->subscriber->unsubscribe()]);
        redirect('/');
    }

    public function create()
    {
        $page['title'] = 'Create Newsletter';
        
        $this->load->view('templates/header', $page);
        $this->load->view('newsletter/newsletter_create_form');
        $this->load->view('templates/footer');
    }

    public function publish()
    {
        if ('post' == $this->input->method()) {
            $newsletter_content = $this->input->post('content');

            // Send the newsletter
            $subscriber_ary = $this->subscriber->get_all();
            foreach ($subscriber_ary as $subscriber) {

                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                
                $this->email->clear();
                $this->email->from('newsletter@rawinala.org', 'Rawinala');
                $this->email->to($subscriber->email);
                $this->email->subject('Sapa Sahabat Rawinala');
                $this->email->message(
                    '<!DOCTYPE html>'.
                    '<html lang="id"><head>'.
                    '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">'.
                    '</head><body style="font-family: \'Roboto\', sans-serif; padding: 10px 20px 10px 20px; max-width: 800px;">'.
                    '<div class="container">'.
    
                    '<!-- HEADER -->'.
                    '<div class="container" style="border-bottom: 1px solid #9E9E9E"><img src="https://www.rawinala.org/assets/images/nl_header.png" alt="rawinala-newsletter-header-image"><p><small>Edition: '.date("j F Y").'</small></p></div>'.
                    
                    '<!-- MAIN BODY -->'.
                    '<div class="container" style="padding: 0 10px 10px 10px;">'.
                    $newsletter_content.
                    '</div>'.
    
                    '<!-- FOOTER -->'.
                    '<div class="container" style="border-top: 1px solid #9E9E9E"><p style="text-align: center;"><small>This newsletter is published by:</small></p><p style="text-align: center;"><small>Yayasan Pendidikan Dwituna Rawinala</small></p><p style="text-align: center;"><small>Jl. Inerbang 38, Batu Ampar, Kramat Jati, Jakarta Timur, DKI Jakarta 13520, Indonesia</small></p></div>'.

                    '<p style="text-align: center;"><small><a href="https://www.rawinala.org/newsletter/unsubscribex/'. urlencode($subscriber->email). '/'.$subscriber->created_on.'">Unsubscribe</a></small></p>'.
    
                    '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>'.
                    '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>'.
                    '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>'.
                    '</div>'.
                    '</body></html>'
                );
                $this->email->send();
            }

            redirect('/message');
        } else {
            show_404();
        }
    }
}
