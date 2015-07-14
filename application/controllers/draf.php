<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of draf
 *
 * @author iwansyahkun
 */
class Draf extends CI_Controller {
    var $class = "draf";
    var $tbl = "draf";
    
    //put your code here
    public function __construct() {
        parent::__construct();
        #privilage
        $this->level();
    }
    
    public function index(){
        $data['total'] = $this->dbase->countdata($this->class);
        $config['base_url'] = base_url().'/draf/index/page/';
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
        $data['draf'] = $this->dbase->getdata('*',$this->class,$whr,$limit);
        $this->pagination->initialize($config);
        $this->loadPage('index',$this->class,$data);
    }
    
    public function addData(){
        $this->loadPage('addDraf',$this->class);
    }
    
    public function saveData($id=null){
        #collect all data post
        $j = $this->ipost('judul');
        $i = $this->ipost('isi');
        
        $datad = array(
                        'user_id'=>$this->cises('id'),
                        'title'=>$j,
                        'content'=>$i
                    );
        
        #saved add or update
        
        if($id === null){
            #insert data
            $this->dbase->insdata($this->class,$datad);
            #save log
            $this->savelog('Tambah Draf');
            #redirect
            $mess = 'sukses/ditambah';
        }
        else{
            #update data
            $whr = array('id'=>$id);
            $this->dbase->uptdata($this->class,$whr,$datad);
            #save log
            $this->savelog('Edit Draf');
            #redirect
            $mess = 'sukses/diedit';
        }
            redirect('draf/index/'.$mess);
    }
    
    public function editData($id){
        $whr = array('id'=>$id);
        $data['draf'] = $this->dbase->getdata('*',$this->class,$whr);
        $this->loadPage('editDraf',$this->class,$data);
    }
    
    public function deleteData($id){
        #delete data
        $whr = array('id'=>$id);
        $this->dbase->deldata($this->class,$whr);
        #save log
        $this->savelog('Hapus Draf');
        #redirect
        redirect('draf/index/sukses/dihapus');
    }
    
    public function cariData(){
        #collect post data
        $c = $this->ipost('cari');
        $like = array(
                'title'=>$c,
                'content'=>$c
            );
        $lim = array('5','0');
        #find word like post
        $whr = array('user_id'=>$this->cises('id'));
        $data['draf'] = $this->dbase->getfind('*',$this->tbl,'or',$like,$lim,$whr);
        #load page
        $this->savelog('Cari Data');
        $this->loadPage('index', $this->class, $data);
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

