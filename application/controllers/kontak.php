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
class Kontak extends CI_Controller {
    //put your code here
    var $class='kontak';
    var $tbl='pbk';
    
    public function __construct() {
        parent::__construct();
        #privilage
        $this->level();
    }
    
    public function index(){
        $iduser = $this->cises('id');
        $data['total'] = $this->dbase->countres($this->tbl,array('user_id'=>$iduser));
        $config['base_url'] = base_url().'/kontak/index/page/';
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
        $data['kontak'] = $this->dbase->getdata('*',$this->tbl,array('user_id'=>$iduser),$limit);
        $this->pagination->initialize($config);
        $this->loadPage('index',$this->class,$data);
    }
    
    public function saveData($id=null){
        #collect all data post
        $g = $this->ipost('group');
        $n = $this->ipost('nama');
        $no = $this->ipost('nomor');
        
        #session user id
        $sesid = $this->cises('id');
        
        $datak = array(
            'group_id'=>$g,
            'user_id'=>$sesid,
            'name'=>$n,
            'number'=>$no
        );
        if($id === null){
            #save to database
            $this->dbase->insdata($this->tbl,$datak);
            #save to log
            $this->savelog('Tambah Kontak');
            $mess = 'sukses/ditambah';
        }
        else{
            #update to database
            $whr = array('id_pbk'=>$id);
            $this->dbase->uptdata($this->tbl,$whr,$datak);
            #save to log
            $this->savelog('Edit Kontak');
            $mess = 'sukses/diedit';
        }
            #redirect
            redirect('kontak/index/'.$mess);
    }
    
    public function addData(){
        $data['group'] = $this->dbase->getdata('*','pbk_groups');
        $this->loadPage('addKontak',$this->class,$data);
    }
    
    public function editData($id){
        $whr = array('id_pbk'=>$id);
        $data['kontak'] = $this->dbase->getdata('*','pbk',$whr);
        $data['group'] = $this->dbase->getdata('*','pbk_groups');
        $this->loadPage('editKontak',$this->class,$data);
    }
    
    public function deleteData($id){
        $whr = array('id_pbk'=>$id);
        #delete from dbase
        $this->dbase->deldata($this->tbl,$whr);
        #save log
        $this->savelog('Hapus Kontak');
        #redirect
        redirect('kontak/index/sukses/dihapus','refresh');
    }
    
    public function cariData(){
        #collect post data
        $c = $this->ipost('cari');
        $like = array(
                'name'=>$c,
                'number'=>$c
            );
        $lim = array('5','0');
        $whr = array('user_id'=>$this->cises('id'));
        #find word like post
        $data['kontak'] = $this->dbase->getfind('*',$this->tbl,'or',$like,$lim,$whr);
        #load page
        $this->savelog('Cari Kontak');
        $this->loadPage('index', $this->class, $data);
    }
    
    public function mess(){
        if($this->iseg(3) != 'page'){
            if($this->iseg(3) == 'sukses'){
                $mess = "<div style='clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:200px;height:20px;padding:5px;'>Data Berhasil ".ucwords($this->iseg(4))."</div>";
            }
            else{
                $mess ="";
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

