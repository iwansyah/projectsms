<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of setting
 *
 * @author iwansyahkun
 */
class Setting extends CI_Controller{
    //put your code here
    var $class = 'setting';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        #privilage
        $this->level();
    }
    
    public function index(){
        $this->profile();
    }
    
    public function tabPage($page,$data=null){
        $data['page'] = $page;
        $this->loadPage('index',$this->class,$data);
    }
    
    public function profile(){
        #akses list data
        $data['akses'] = $this->dbase->getdata('*','akses');
        #where user id
        $whr = 'user.id=pbk.user_id and user.id = '.$this->sesid();
        #get data profile
        $lim = array('1','0');
        $data['profile'] = $this->dbase->getjoin('*','user','pbk',$whr,$lim);
        #message if any
        #echo $this->db->last_query();
        #exit;
        $data['mess'] = $this->mess();
        $this->tabPage('profile',$data);
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
        
        #save editing database
            $whrp = array(
                'id'=>$id,
                'pass'=>$pl
                );
            #check password lama
            $qp = $this->dbase->countres('user',$whrp);
            if(isset($qp)){
                if($qp > 0){
                    $whr1 = array('id'=>$id);
                    $this->dbase->uptdata('user',$whr1,$datau);
                    #change pbk data
                    $whr2 = array('id_pbk'=>$idp);
                    $datap = array(
                            'user_id'=>$id,
                            'name'=>$n,
                            'number'=>$no
                        );
                    $this->dbase->uptdata('pbk',$whr2,$datap);
                    #save log
                    $this->savelog('Edit Profile');
                    #message
                    $mess = 'sukses/diedit';
                }
                else{
                    #save log
                    $this->savelog('Gagal Edit Profile');
                    #message
                    $mess = 'gagal/diedit';
                }
            }
        redirect('setting/profile/'.$mess,'refresh');
    }
    
    public function log(){
        if($this->sesid() == '1'){
            $data['total'] = $this->dbase->countdata('log');
            $whr=null;
        }
        else{
            $whr = array('user_id'=>$this->sesid());
            $data['total'] = $this->dbase->countres('log',$whr);
        }
        $config['base_url'] = base_url().'setting/log/page/';
        $config['total_rows'] = $data['total'];
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $lim1 = ($this->iseg(4)=='' ? 0:$this->iseg(4));
        $lim2 = $lim1;
        if($this->iseg(4)==''){
            $limit = array($config['per_page'],0);
        }
        else{
            $limit = array($config['per_page'],$lim2);
        }
        $data['log'] = $this->dbase->getdata('*','log',$whr,$limit);
        $this->pagination->initialize($config);
        $this->tabPage('log',$data);
    }
    
    public function deleteLog($id){
        $whr = array('id'=>$id);
        $this->dbase->deldata('log',$whr);
        #save log
        $this->savelog('Hapus Log');
        redirect('setting/log/sukses/dihapus');
    }
    
    public function cariDataLog(){
        #data post
        $c = $this->ipost('cari');
        #if the post is username, check on tbl username 
        $cekuser = $this->dbase->countres('user',array('user'=>$c));
        if($cekuser > 0){
            #if true get id and find in tbl log
            $userid = $this->dbase->getIdByUser($c);
        }
        else{
            $userid = '';
        }
        #find like user id or kegiatan or waktu
        $like = array(
                    'user_id'=>$userid,
                    'kegiatan'=>$c,
                    'waktu'=>$c
                );
        #limit find 
        $lim = array('10','0');
        #get data from database
        $data['log'] = $this->dbase->getfind('*','log','or',$like,$lim);
        $this->savelog('Cari Log');
        $this->tabPage('log',$data);
    }
    
    public function akses(){
        $data['akses'] = $this->dbase->getdata('*','akses');
        $this->tabPage('akses',$data);
    }
    
    public function aksesMenu($idakses=null,$mess=null){
        if($idakses!==null){
            $whr = array('id_akses'=>$idakses);
        }
        else{
            $whr = null;
        }
        if($mess !== null){
            $data['mess'] = 'Akses menu berhasil di ubah';
        }
        $data['aksesmenu'] = $this->dbase->getdata('*','akses_menu',$whr);
        $this->tabPage('aksesMenu',$data);
    }
    
    public function saveAkses(){
        $byk = $this->ipost('byk');
        for($i=1;$i<$byk+1;$i++){
            $whr = array(
                'id_am'=>$this->ipost('id_am'.$i)    
                );
            $data = array(
                'fitur'=>$this->ipost('fitur'.$i)
                );
            $this->dbase->uptdata('akses_menu',$whr,$data);
        }
        $this->savelog('Edit Log');
        redirect('setting/aksesmenu/'.$this->ipost('id_akses1').'/mess');
    }
    
    public function sticker(){
        $data['sticker'] = $this->dbase->getData('*','sticker');
        $data['mess'] = $this->mess();
        $this->tabPage('sticker',$data);
    }
    
    public function editSticker($id){
        $data['sticker'] = $this->dbase->getData('*','sticker',array('id'=>$id));
        $this->tabPage('editSticker',$data);
    }
    
    public function deleteSticker($id){
        $this->dbase->deldata('sticker',array('id'=>$id));
        redirect('setting/sticker/sukses/dihapus','refresh');
    }
    
    public function saveSticker($id){
        $p = $this->ipost('page');
        $i = $this->ipost('isi');
        $a = $this->ipost('aktif');
        
        $data = array(
                    'page'=>$p,
                    'isi'=>$i,
                    'aktif'=>$a
                );
        
        $this->dbase->uptdata('sticker',array('id'=>$id),$data);
        redirect('setting/sticker/sukses/diedit','refresh');
    }
    
    public function stickerAktif($id,$ak){
        $this->dbase->uptdata('sticker',array('id'=>$id),array('aktif'=>$ak));
        redirect('setting/sticker/sukses/diedit','refresh');
    }
    
    public function gammu(){
        $this->tabPage('gammu');
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
