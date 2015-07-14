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
class Notify {
    //put your code here
    
    public function __construct() {
        $this->autocheckTbl();
    }
    
    public function autocheckTbl(){
        $now = $this->nowTotal();
        $qc = $this->dbase->getdata('*','notify',array('user_id'=>$this->cises('akses')));
        if($qc->num_rows()>0){
            $old = $this->dbase->getby('old_total','notify',array('user_id'=>$this->cises('akses')));
            if($now > $old){
                $byk = $now-$old;
                echo '<span style="color:red;font-weight:bold;">('.$byk.')</span>';
            }
            else{
                echo '<span style="color:blue;font-weight:bold;">(0)</span>';
            }
        }
        else{
            $datan = array(
                'old_total'=>$now,
                'read'=>1,
                'user_id'=>$this->cises('akses')
                );
            $this->dbase->insdata('notify',$datan);
        }
    }
    
    public function nowTotal(){
        $now = $this->dbase->countdata('inbox');
        return $now;
    }
    
    public function updRead($r=null){
        $query = $this->dbase->uptdata('notify',array('user_id'=>$this->cises('akses')),array('old_total'=>$this->nowTotal(),'read'=>$r));
        return $query;
    }
        
    public function cises($val){
            return $this->session->userdata($val);
    }
    
}

$cls = new Notify();
return $cls;
