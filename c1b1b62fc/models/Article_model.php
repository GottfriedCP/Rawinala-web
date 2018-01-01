<?php
class Article_model extends CI_Model {
    public $id;
    public $title;
    public $url_title;
    public $preview;
    public $body;
    public $created_on;
    public $author_id;
    public $author_name;

    public function get($x_id, $x_url_title) {
        $query = $this->db->select('article.id, article.title, article.url_title, article.body, article.created_on, article.author_id, user.username')
            ->from('article')
            ->join('user', 'user.id = article.author_id')
            ->where(['article.id' => $x_id, 'article.url_title' => $x_url_title])
            ->get();
        $row = $query->row();
        if (NULL === $row) {
            return FALSE;
        } else {
            $this->id = $row->id;
            $this->title = $row->title;
            $this->url_title = $row->url_title;
            $this->body = $row->body;
            $this->created_on = $row->created_on;
            $this->author_id = $row->author_id;
            $this->author_name = $row->username;
            return TRUE;
        }
    }

    public function get_all() {
        $query = $this->db->select('id, title, url_title, body, created_on, author_id')
            ->order_by('created_on DESC')
            ->get('article');
        return $query->result();
    }

    public function get_some($limit, $skip = 0) {
        $query = $this->db->select('id, title, url_title, body, created_on, author_id')
            ->order_by('created_on DESC')
            ->get('article', $limit, $skip);
        return $query->result();
    }

    public function count() {
        $query = $this->db->select('id')
            ->get('article');
        return $query->num_rows();
    }

    public function insert() {
        $this->db->set('title', $this->title)
            ->set('url_title', $this->url_title)
            ->set('body', $this->body)
            ->set('created_on', $this->created_on)
            ->set('author_id', $this->author_id)
            ->insert('article');
        $query = $this->db->select('id, url_title')
            ->order_by('id DESC')
            ->get('article');
        $result = $query->row();
        return ['id' => $result->id, 'url_title' => $result->url_title];
    }

    public function update() {
        $this->db->set('title', $this->title)
            ->set('body', $this->body)
            ->set('updated_on', time())
            ->where(['id' => $this->id, 'url_title' => $this->url_title])
            ->update('article');
        return TRUE;
    }

    public function delete($x_id, $x_url_title) {
        $this->db->delete('article', ['id' => $x_id, 'url_title' => $x_url_title]);
    }

    public function sluggify($title)
    {
        // Thanks to cbednarski at stackoverflow
        // Prep string with some basic normalization
        $title = strtolower($title);
        $title = strip_tags($title);
        $title = stripslashes($title);
        $title = html_entity_decode($title);
    
        # Remove quotes (can't, etc.)
        $title = str_replace('\'', '', $title);
    
        # Replace non-alpha numeric with hyphens
        $match = '/[^a-z0-9]+/';
        $replace = '-';
        $title = preg_replace($match, $replace, $title);
    
        $title = trim($title, '-');
    
        return $title;
    }
}