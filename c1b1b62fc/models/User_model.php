<?php
class User_model extends CI_Model {

    public $id;
    public $name;
    public $rname;
    public $level; //'u' or 'z'

    public function __construct() {
        parent::__construct();
    }

    public function is_authenticated($x_username, $x_password) {
        $query = $this->db->select('passphrase')
            ->where(['username' => $x_username])
            ->get('user');
        $row = $query->row();
        if (isset($row) && password_verify($x_password, $row->passphrase)){
            $query = $this->db->select('id, realname, level')
                ->where(['username' => $x_username, 'authed' => '1'])
                ->get('user');
            $row = $query->row();
            if (isset($row)) {
                $this->id = $row->id;
                $this->name = $x_username;
                $this->rname = $row->realname;
                $this->level = $row->level;
                return TRUE;
            }else{ return FALSE; }
        }else { return FALSE; }
    }
}