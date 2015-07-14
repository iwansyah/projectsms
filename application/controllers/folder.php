<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kontak
 *
 * @author iwansyahkun
 */
class Folder extends CI_Controller {
    //put your code here
    var $class='folder';
    var $tbl='folder';
    
    public function __construct() {
        parent::__construct();
        #privilage
        $this->level();
    }
    
    public function index(){
        $data['total'] = $this->dbase->countdata($this->tbl);
        $config['base_url'] = base_url().'/folder/index/page/';
        $config['total_rows'] = $data['total'];
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $lim1 = ($this->iseg(4)=='' ? 0:$this->iseg(4));
        $lim2 = $lim1;
        if($this->iseg(4)==''){
            $limit = array($config['per_page'],0);
        }
        else{
            $limit = array($config['per_page'],$lim2);
        }
        $data['mess'] = $this->mess();
        $whr = array('user_id'=>$this->cises('id'));
        $data['folder'] = $this->dbase->getdata('*',$this->tbl,$whr,$limit);
        $this->pagination->initialize($config);
        $this->loadPage('addFolder',$this->class,$data);
    }
    
    public function saveData(){
        #collect data post
        $i = $this->ipost('idf');
        $n = $this->ipost('nama');
        
        $datag = array(
                    'user_id'=>$this->cises('id'),
                    'name'=>$n
            );
        #saving add or edit
        if($i === ''){
            #save data
            $this->dbase->insdata($this->tbl,$datag);
            #save log
            $this->savelog('Tambah Folder');
            $mess = 'sukses/ditambah';
        }
        else{
            #update data
            $whr = array('id'=>$i);
            $this->dbase->uptdata($this->tbl,$whr,$datag);
            #save log
            $this->savelog('Edit Folder');
            $mess = 'sukses/diedit';
        }
        redirect('folder/index/'.$mess);
    }
    
    public function deleteData($id){
        #delete data
        $whr = array('id'=>$id);
        $this->dbase->deldata($this->tbl,$whr);
        #delete from saved folder
        $whr = array('id_folder'=>$id);
        $this->dbase->deldata('saved_folder',$whr);
        #save log
        $this->savelog('Hapus folder');
        #redirect
        redirect('folder/index/sukses/dihapus');
    }
    
    public function mess(){
        if($this->iseg(3) != 'page'){
            if($this->iseg(3) == 'sukses'){
                $mess = "<div style='clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:200px;height:20px;padding:5px;'>Data Berhasil ".ucwords($this->iseg(4))."</div>";
            }
            else if($this->iseg(3) == 'gagal'){
                $mess = "<div style='color:red;clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:200px;height:20px;padding:5px;'>Data Gagal ".ucwords($this->iseg(4))."</div>";
            }
            else{
                $mess='';
            }
        }
        else{
            $mess ="";
        }
        return $mess;
    }
    
    public function savelog($log){
        $k = $log;
        $datal = array(
            'user_id'=>$this->cises('id'),#session user id
            'kegiatan'=>$k
        );
        $this->dbase->insdata('log',$datal);
    }
}

