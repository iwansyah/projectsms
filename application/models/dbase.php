<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbase
 *
 * @author iwansyahkun
 */
class Dbase extends CI_Model {
    //put your code here
    var $query;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function myquery($q){
        $this->query = $this->db->query($q);
        return $this->query;
    }
    
    public function getdata($sel,$tbl,$whr=null,$lim=null,$by=null){
        $this->db->select($sel);
        if($whr != null){
            $this->db->where($whr);
        }
        if($lim != null){
            $this->db->limit($lim[0],$lim[1]);
        }
        if($by != null){
            $this->db->order_by($by[0],$by[1]);
        }
        $this->query = $this->db->get($tbl);
        return $this->query;
    }
    
    public function getfind($sel,$tbl,$lik=null,$like=null,$lim=null,$whr=null){
        $this->db->select($sel);
        if($lik === 'or'){
            $this->db->or_like($like);
        }
        else{
            $this->db->like($like);
        }
        if($lim !== null){
            $this->db->limit($lim[0],$lim[1]);
        }
        if($whr !== null){
            $this->db->where($whr);
        }
        $this->query = $this->db->get($tbl);
        return $this->query;
    }
    
    public function getjoin($sel,$tbl1,$tbl2,$whr,$lim=null){
        $this->db->select($sel);
        $this->db->from($tbl1);
        $this->db->join($tbl2,$whr);
        if($lim !== null){
            $this->db->limit($lim[0],$lim[1]);
        }
        $this->query = $this->db->get();
        return $this->query;
    }
    
    public function countdata($tbl){
        $total = $this->db->count_all($tbl);
        return $total;
    }
    
    public function countres($tbl,$whr){
        $this->db->from($tbl);
        $this->db->where($whr);
        $total = $this->db->count_all_results();
        return $total;
    }
    
    public function insdata($tbl,$data){
        $this->query = $this->db->insert($tbl,$data);
        return $this->query;
    }
    
    public function uptdata($tbl,$whr,$data){
        $this->db->where($whr);
        $this->query = $this->db->update($tbl,$data);
        return $this->query;
    }
    
    public function deldata($tbl,$whr){
        $this->db->where($whr);
        $this->query = $this->db->delete($tbl);
        return $this->query;
    }
    
    public function empdata($tbl){
        $this->query = $this->db->empty_table($tbl);
        return $this->query;
    }
    
    public function getBy($sel,$tbl,$whr){
        $this->db->select($sel);
        $this->db->where($whr);
        $this->query = $this->db->get($tbl);
        if(isset($this->query)){foreach($this->query->result() as $r){
            return $r->{$sel};  
        }}
    }
    
    public function getUsername($id){
        $whr = array('id'=>$id);
        $this->db->select('user');
        $this->db->where($whr);
        $this->query = $this->db->get('user');
        if(isset($this->query)){foreach($this->query->result() as $r){
            return $r->user;  
        }}
    }
    
    public function getIdByUser($user){
        $whr = array('user'=>$user);
        $this->db->select('id');
        $this->db->where($whr);
        $this->query = $this->db->get('user');
        if(isset($this->query)){foreach($this->query->result() as $r){
            return $r->id;  
        }}
    }
    
    public function getAksesById($idakses){
		$whr = array('id'=>$idakses);
			$this->db->select('akses');
			$this->db->where($whr);
			$this->query = $this->db->get('akses');
			if(isset($this->query)){foreach($this->query->result() as $r){
				return $r->akses;  
			}}
	}
    
    public function getGammu(){
        $q = $this->getData('*','daemons',array('Info'=>'gammu'));
        if(isset($q)){
            foreach($q->result() as $r){
                return $r->Start;
            }
        }
    }
    
    public function getInternet($uid){
        $q = $this->getData('*','notify',array('user_id'=>$uid));
        if(isset($q)){
            foreach($q->result() as $r){
                return $r->internet;
            }
        }
    }
    
    public function myqueryx($sql){
        $q = $this->db->query($sql);
        return $q;
    }
    
    public function uptDownload(){
        $now = $this->getby('counter', 'download',array('id'=>1));
        $upd = $now + 1;
        $data = array(
            'counter'=>$upd
        );
        $this->uptdata('download', array('id'=>1), $data);
        return;
    }
}

