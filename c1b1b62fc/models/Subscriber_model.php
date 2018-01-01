<?php
class Subscriber_model extends CI_Model {
    public $id;
    public $email;
    public $created_on;

    public function subscribe()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return $this->db->set('email', $this->email)
                            ->set('created_on', $this->created_on)
                            ->insert('subscriber');
        } else {
            return FALSE;
        }
    }

    public function unsubscribe()
    {
        return $this->db->where('email', $this->email)
                        ->where('created_on', $this->created_on)
                        ->delete('subscriber');
    }

    public function get_all()
    {
        $query = $this->db->select('email, created_on')
                        ->get('subscriber');
        return $query->result();
    }
}