<?php  if(!defined('BASEPATH')) exit ('No direct script access allowed'); 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author iwansyahkun
 */
class User extends CI_Controller {
    //put your code here
    var $class='user';
    var $tbl='user';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        #privilage
        $this->level();
    }
    
    public function index(){
        #total data user
        $data['total'] = $this->dbase->countdata($this->class);
        #setting url
        $config['base_url'] = base_url().'/user/index/page/';
        #setting total rows
        $config['total_rows'] = $data['total'];
        #setting per page
        $config['per_page'] = 5;
        #setting uri numb page
        $config['uri_segment'] = 4;
        #limit data
        $lim1 = ($this->iseg(4)=='' ? 0:$this->iseg(4));
        $lim2 = $lim1;
        if($this->iseg(4)==''){
            $limit = array($config['per_page'],0);
        }
        else{
            $limit = array($config['per_page'],$lim2);
        }
        #message
        $data['mess'] = $this->mess();
        #query for get data
        $data['user'] = $this->dbase->getdata('*',$this->class,null,$limit);
        #create pagination
        $this->pagination->initialize($config);
        #load data
        $this->loadPage('index',$this->class,$data);
    }
    
    public function addData(){
        $data['akses'] = $this->dbase->getdata('*','akses');
        $this->loadPage('addUser',$this->class,$data);
    }
    
    public function editData($id){
        $data['akses'] = $this->dbase->getdata('*','akses');
        $data['user'] = $this->dbase->getjoin('*',$this->class,'pbk','user.id=pbk.user_id and user.id = '.$id);
        #echo $this->db->last_query();
        #exit;
        $this->loadPage('editUser',$this->class,$data);
    }
    
    public function saveData($typ,$id=null,$idp=null){
        #post all data from form submit
        $n = $this->ipost('nama');
        $u = $this->ipost('user');
        $p = do_hash($this->ipost('pass'));
        $pl = do_hash($this->ipost('cpass'));
        $e = $this->ipost('email');
        $no = $this->ipost('nomor');
        $a = $this->ipost('akses');
        
        #collect variable
        $datau = array(
            'nama'=>$n,
            'user'=>$u,
            'pass'=>$p,
            'email'=>$e,
            'id_akses'=>$a
        );
        
        #save adding or edit to database
        if($typ == 'add'){
            #save user data
            $this->dbase->insdata('user',$datau);
            #get last user id
            $q = $this->dbase->getdata('id',$this->class,null,array('1','0'),array('id','desc'));
            if(isset($q)){
                foreach($q->result() as $r){
                    $datap = array(
                        'user_id'=>$r->id,
                        'name'=>$n,
                        'number'=>$no
                    );
                #save to phonebook
                $this->dbase->insdata('pbk',$datap);
            }}
            else{
                exit('failed to create user id');
            }
            #save log
            $this->savelog('Tambah User');
            #message
            $mess = 'sukses/ditambah';
        }
        else{
            $whrp = array(
                'id'=>$id,
                'pass'=>$pl
                );
            #check password lama
            $qp = $this->dbase->countres($this->class,$whrp);
            if(isset($qp)){
                if($qp > 0){
                    #change user data
                    $whr1 = array('id'=>$id);
                    $this->dbase->uptdata($this->class,$whr1,$datau);
                    #change pbk data
                    $whr2 = array('id_pbk'=>$idp);
                    $datap = array(
                            'user_id'=>$id,
                            'name'=>$n,
                            'number'=>$no
                        );
                    $this->dbase->uptdata('pbk',$whr2,$datap);
                    #save log
                    $this->savelog('Edit User');
                    #message
                    $mess = 'sukses/diedit';
                }
                else{
                    #save log
                    $this->savelog('Gagal Edit User');
                    #message
                    $mess = 'gagal/diedit';
                }
            }
        }
        redirect('user/index/'.$mess,'refresh');
    }
    
    public function deleteData($id){
        #delete data from user
        $whr = array('id'=>$id);
        $this->dbase->deldata($this->class,$whr);
        #delete data from pbk
        $whr2 = array('user_id'=>$id);
        $this->dbase->deldata('pbk',$whr2);
        #save to log
        $this->savelog('Hapus User');
        #message
        $mess = 'sukses/dihapus';
        redirect('user/index/'.$mess,'refresh');
    }
    
    public function cariData(){
        #collect post data
        $c = $this->ipost('cari');
        $like = array(
                'nama'=>$c,
                'user'=>$c,
                'email'=>$c
            );
        $lim = array('5','0');
        #find word like post
        $data['user'] = $this->dbase->getfind('*',$this->tbl,'or',$like,$lim);
        $this->savelog('Cari User');
        #load page
        $this->loadPage('index', $this->class, $data);
    }
    
    public function savelog($log){
        $k = $log;
        $datal = array(
            'user_id'=>$this->cises('id'),#session user id
            'kegiatan'=>$k
        );
        $this->dbase->insdata('log',$datal);
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
}
