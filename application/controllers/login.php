<?php if(!defined('BASEPATH')) exit ('No direct script access allowed'); 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author iwansyahkun
 */
class Login extends CI_Controller{
    //put your code here
    var $class = 'login';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->helper('download');
    }
    
    public function testCtrl(){
        $this->load->model('notify','nf');
        echo $this->nf->test();
    }
    
    public function index($res=null){
        $data['mess'] = $this->mess($res);
        $data['stick'] = $this->notify->showSticker('login');
        $data['gammu'] = $this->dbase->getGammu();
        $data['counter'] = $this->dbase->getBy('counter','download',array('id'=>1));
        $this->load->view('login/index',$data);
    }
    
    public function newUser($typ){
        #post all data from form submit
        $n = $this->ipost('nama');
        $u = $this->ipost('user');
        $p = do_hash($this->ipost('pass'));
        $e = $this->ipost('email');
        $no = $this->ipost('nomor');
        $a = $this->ipost('akses');
        
        #cek username if not exist
        $ceku = $this->dbase->countres('user',array('user'=>$u));
        
        if($ceku > 0){
            redirect('login/index/gagal/user','refresh');
            exit('User is exist!');
        }
        #collect variable
        $datau = array(
            'nama'=>$n,
            'user'=>$u,
            'pass'=>$p,
            'email'=>$e,
            'id_akses'=>'2'
        );
        
        #save adding or edit to database
        if($typ == 'add'){
            #save user data
            $this->dbase->insdata('user',$datau);
            #get last user id
            $q = $this->dbase->getdata('id','user',null,array('1','0'),array('id','desc'));
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
                #echo $this->db->last_query();
                echo'failed to create user id';
                redirect('login/index/gagal','refresh');
            }
            #save log
            $this->savelog('Tambah User');
            #message
            $mess = 'sukses/ditambah';
        }
                #echo $this->db->last_query();
        redirect('login/index/'.$mess,'refresh');
    }
    
    public function prsLogin(){
        $u = $this->ipost('username');
        $b = $this->ipost('submit');
        $p = do_hash($this->ipost('password'));
        
        $whr = array(
            'user'=>$u,
            'pass'=>$p
        );
        
        if($b === 'Login'){
            $q = $this->dbase->getdata('*','user',$whr);
            if(isset($q)){
                if($q->num_rows() > 0){
                    foreach($q->result() as $row){
                        $this->ises($whr);
                        $myid = array(
                                'id'=>$row->id,
                                'akses'=>$row->id_akses
                            );
                        #set session
                        $this->ises($myid);
                        #set notify
                        $this->crtNotify($row->id);
                        #save log
                        $this->savelog('Login Sukses',$this->cises('id'));
                    }
                    redirect('home/','refresh');
                }
                else{
                    #save log
                    $this->savelog('Login Gagal');
                    redirect('login/index/gagal','refresh');
                }
            }
            else{
                #save log
                $this->savelog('Login Gagal');
                redirect('login/index/gagal','refresh');
            }
        }
        else{
            #login as guest
            $myid = array(
                    'id'=>0,
                    'akses'=>3,
                    'user'=>$u
                );
            $this->ises($myid);
            #save log
            $this->savelog('Login Sukses',0);
            redirect('home/','refresh');
        }
    }
    
    public function crtNotify($uid){
        #cek before
        $ceku = $this->dbase->countres('notify',array('user_id'=>$uid));
        if($ceku<1){
            $byk = $this->dbase->countdata('inbox');
            $data = array(
                'old_total'=>$byk, 	
                'read'=>'1', 	
                'user_id'=>$uid, 	
                'internet'=>'offline'
            );
            $this->dbase->insdata('notify',$data);
        }
    }
    
    public function mess($res){
        if($this->iseg(3) != 'page'){
            if($this->iseg(3) == 'sukses' || $this->iseg(3) == 'gagal'){
                if($res=='sukses'){
                    $isi = "Berhasil Menambah User Baru <br>Silahkan Login";
                    $col = 'black';
                }
                else if($this->iseg(4)==='user'){
                    $isi = "Username sudah ada, ganti dengan nama username yang lain!";
                    $col = 'red';
                }
                else{
                    $isi = "Login gagal, Username atau Password salah";
                    $col = 'red';
                }
                $mess = "<center><div style='color:".$col.";clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:250px;padding:5px;'>".$isi."</div></center>";
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
    
    public function savelog($log,$ses=null){
        $k = $log;
        if($ses === null){
            $myses = '0';
        }
        else{
            $myses = $ses;
        }
        $datal = array(
            'user_id'=>$myses,#session user id
            'kegiatan'=>$k
        );
        $this->dbase->insdata('log',$datal);
    }
    
    public function logout(){
        #save log
        $this->savelog('User Logout',$this->cises('id'));
        #all session
        $sessaktif = $this->session->all_userdata();
        #remove session
        $this->session->unset_userdata($sessaktif);
        #destroy session
        $this->session->sess_destroy();
        redirect('login/index');
    }
    
    public function downloadDoc($cod){
        if($cod==="1"){
            getcwd();
            chdir('doc/');
            $this->dbase->uptDownload();
            $data = file_get_contents(getcwd().'\user_guide_smsg.docx');
            $name = ("user_guide_smsg.docx");
            force_download($name, $data);
        }
        else if($cod==="2"){
            getcwd();
            chdir('doc/');
            $this->dbase->uptDownload();
            $data = file_get_contents(getcwd().'\developer_manual_smsg.docx');
            $name = ("developer_manual_smsg.docx");
            force_download($name, $data);
        }
        else if($cod==="3"){
            getcwd();
            chdir('src/');
            $this->dbase->uptDownload();
            $data = file_get_contents(getcwd().'\projectsms.zip');
            $name = ("projectsms.zip");
            force_download($name, $data);
        }
        else{
            echo"file download no exist...";
        }
        #redirect('login/index/','refresh');
    }
}

