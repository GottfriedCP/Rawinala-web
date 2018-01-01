<?php
class Message_model extends CI_Model {
    public $id;
    public $name;
    public $email;
    public $message;
    public $created_on;
    public $read;
    public $reply;
    public $forwarded_to;

    public function get($x_id) {
        $query = $this->db->select('name, email, message, created_on, read, reply, forwarded_to')
            ->where(['id' => $x_id])
            ->get('message');
        $row = $query->row();
        if (NULL === $row) {
            return FALSE;
        } else {
            $this->id = $x_id;
            $this->name = $row->name;
            $this->email = $row->email;
            $this->message = $row->message;
            $this->created_on = $row->created_on;
            $this->read = $row->read;
            $this->reply = $row->reply;
            $this->forwarded_to = $row->forwarded_to;
            return TRUE;
        }
    }

    public function get_all() {

    }

    public function get_some($limit, $skip = 0) {
        $query = $this->db->select('id, name, email, message, created_on, read, reply, forwarded_to')
            ->order_by('created_on DESC')
            ->get('message', $limit, $skip);
        return $query->result();
    }

    public function count() {
        $query = $this->db->select('id')
            ->get('message');
        return $query->num_rows();
    }

    public function count_unread() {
        $query = $this->db->select('id')
            ->where('read', FALSE)
            ->get('message');
        return $query->num_rows();
    }

    public function set_read($x_id) {
        $this->db->set('read', TRUE)
            ->where('id', $x_id)
            ->update('message');
    }

    public function set_reply($x_id, $x_reply) {
        $this->db->set('reply', $x_reply)
            ->where('id', $x_id)
            ->update('message');
    }

    public function set_forward_email($x_id, $x_email) {
        $this->db->set('forwarded_to', $x_email)
            ->where('id', $x_id)
            ->update('message');
    }

    public function delete($x_id) {
        $this->db->where('id', $x_id)
            ->delete('message');
    }
}