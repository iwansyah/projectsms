<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notify
 *
 * @author iwansyahkun
 */
class Notify extends CI_Model {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    public function autocheckTbl($pr=null){
        $now = $this->nowTotal();
        $qc = $this->dbase->getdata('*','notify',array('user_id'=>$this->cises('id')));
        if($qc->num_rows()>0){
            $old = $this->dbase->getby('old_total','notify',array('user_id'=>$this->cises('id')));
            if($now > $old){
                $byk = $now-$old;
                if($pr === null){
                    echo '<span style="color:red;font-weight:bold;">('.$byk.')</span>';
                }
                else{
                    return $byk;
                }
            }
            else{
                if($pr === null){
                    echo '<span style="color:blue;font-weight:bold;">(0)</span>';
                }
                else{
                    return $byk = 0;
                }
            }
        }
        else{
            $datan = array(
                'old_total'=>$now,
                'read'=>1,
                'user_id'=>$this->cises('id'),
                'internet'=>'offline'
                );
            $this->dbase->insdata('notify',$datan);
        }
    }
    
    public function nowTotal(){
        $now = $this->dbase->countdata('inbox');
        return $now;
    }
    
    public function updRead($r=null){
        $query = $this->dbase->uptdata('notify',array('user_id'=>$this->cises('id')),array('old_total'=>$this->nowTotal(),'read'=>$r));
        return $query;
    }
        
    public function cises($val){
            return $this->session->userdata($val);
    }
    
    public function updOnline($uid,$ol){
        $whr = array('user_id'=>$uid);
        $data = array('internet'=>$ol);
        $this->dbase->uptdata('notify',$whr,$data);
    }
    
    public function showSticker($page){
        $stick = $this->dbase->getData('*','sticker',array('page'=>$page,'aktif'=>'yes'));
        foreach($stick->result() as $row){
            return $row->isi;
        }
    }
    
    public function test(){
        return "test";
    }
}

