<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sms
 *
 * @author iwansyahkun
 */
class Sms extends CI_Controller{
    var $class = 'sms';
    //put your code here
    
    public function __construct() {
        parent::__construct();
        #privilage
        $this->level();
    }
    
    #################### for load data sms #####################################
    public function index($r=null){
        $data['total'] = $this->dbase->countdata('inbox');
        $config['base_url'] = base_url().'/sms/index/page/';
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
        if($r==='read'){
            $this->notify->updRead('1');
        }
        $data['mess'] = $this->mess();
        $data['inbox'] = $this->dbase->getdata('*','inbox',null,$limit,array('ID','DESC'));
        $this->pagination->initialize($config);
        $this->loadPage('index',$this->class,$data);
    }
    
    public function outbox(){
        $data['total'] = $this->dbase->countdata('outbox');
        $config['base_url'] = base_url().'/sms/outbox/page/';
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
        $data['mess'] = $this->mess();
        $data['outbox'] = $this->dbase->getdata('*','outbox',null,$limit,array('ID','DESC'));
        $this->pagination->initialize($config);
        $this->loadPage('outbox',$this->class,$data);
    }
    
    public function sentitems(){
        $data['total'] = $this->dbase->countdata('sentitems');
        $config['base_url'] = base_url().'/sms/sentitems/page/';
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
        $data['mess'] = $this->mess();
        $data['sentitems'] = $this->dbase->getdata('*','sentitems',null,$limit,array('ID','DESC'));
        $this->pagination->initialize($config);
        $this->loadPage('sentitems',$this->class,$data);
    }
    
    ###########################################################################
    
    public function cariData($tbl){
        #collect post data
        $c = $this->ipost('cari');
        if($tbl === 'inbox'){
            $like = array(
                    'ReceivingDateTime'=>$c,
                    'SenderNumber'=>$c,
                    'TextDecoded'=>$c
                );
            $file = 'index';
        }
        else{
            $like = array(
                    'SendingDateTime'=>$c,
                    'DestinationNumber'=>$c,
                    'TextDecoded'=>$c
                );
            $file = $tbl;
        }
        $lim = array('10','0');
        #find word like post
        $data[$tbl] = $this->dbase->getfind('*',$tbl,'or',$like,$lim);
        #load page
        $this->savelog('Cari Data');
        $this->loadPage($file, $this->class, $data);
    }
    
    public function newSms($idpbk=null,$iddraf=null,$tbl=null){
        $number = '';
        $draf = '';
        if($idpbk !== null){
            $whr = array('id_pbk'=>$idpbk);
            $q = $this->dbase->getdata('*','pbk',$whr);
            foreach($q->result() as $r){
                $number .= $r->number;
            }
        }
        if($tbl === 'inbox'){
            $whr = array('ID'=>$iddraf);
            $q = $this->dbase->getdata('*',$tbl,$whr);
            foreach($q->result() as $r){
                $number .= $r->SenderNumber;
                $draf .= $r->TextDecoded;
            }
        }
        else if($tbl === 'outbox'){
            $whr = array('ID'=>$iddraf);
            $q = $this->dbase->getdata('*',$tbl,$whr);
            foreach($q->result() as $r){
                $number .= $r->DestinationNumber;
                $draf .= $r->TextDecoded;
            }
        }
        else if($tbl === 'sentitems'){
            $whr = array('ID'=>$iddraf);
            $q = $this->dbase->getdata('*',$tbl,$whr);
            foreach($q->result() as $r){
                $number .= $r->DestinationNumber;
                $draf .= $r->TextDecoded;
            }
        }
        else if($tbl === 'draf'){
            $whr = array('id'=>$iddraf);
            $q = $this->dbase->getdata('*',$tbl,$whr);
            foreach($q->result() as $r){
                $draf .= $r->content;
            }
        }
        else if($tbl === 'saved_folder'){
            $whr = array('id_save'=>$iddraf);
            $q = $this->dbase->getdata('*',$tbl,$whr);
            foreach($q->result() as $r){
                $number .= $r->number;
                $draf .= $r->pesan;
            }
        }
        $data['no'] = $number;
        $data['draf'] = $draf;
        $this->loadPage('newSms',$this->class,$data);
    }
    
    ######################## sent sms process #################################
    public function kirimSms(){
        $this->cekGammu();
        $n = $this->ipost('nomor');
        $i = $this->ipost('isi');
        ######## add number if not exist ##########
        $this->addNumb($n);
        $data = array('nomor'=>$n,
              'text'=>$i,
              'user_id'=>$this->cises('akses')  
            );
        $this->dbase->insdata('sms_temp',$data);
        redirect('sms/getSmstemp');
    }
    
    public function addNumb($n){
        $cp = $this->dbase->countres('pbk',array('number'=>$n));
        if($cp===0){
            $datap = array(
                'group_id'=>1,
                'user_id'=>$this->cises('akses'),
                'number'=>$n
            );
            $this->dbase->insdata('pbk',$datap);
        }
    }
    
    public function kirimXml(){
        $this->cekGammu();
        $n = $this->ipost('nomor');
        $i = $this->ipost('isi');
        #check outbox
        $byko = $this->dbase->countdata('outbox');
        if($byko < 1){
            $data = array(
                        'DestinationNumber'=>$n,
                        'TextDecoded'=>$i,
                        'UDH'=>' ',
                        'Text'=>$i
                    );
            $this->dbase->insdata('outbox',$data);
            $this->addNumb($n);
            redirect('sms/outbox/sukses/diproses');
            
        }
        else{
            redirect('sms/outbox/gagal/outbox>1');
        }
    }
    
    public function cekGammu(){
        $gam = $this->dbase->getGammu();
        if($gam === 'off'){
            echo"<script type='text/javascript'>alert('Maaf service gammu sedang OFF...!');history.back();</script>";
            exit;
        }
    }
    
    public function getSmstemp(){
        #check outbox
        $byko = $this->dbase->countdata('outbox');
        if($byko < 1){
            $now = date('Y-m-d');
            $whr = array('user_id'=>$this->cises('akses'));
            $sentto = $this->dbase->getData('*','sms_temp',$whr);
            if(isset($sentto)){foreach($sentto->result() as $sr){
                $sw = explode(" ",$sr->waktu);
                if($sw[0] === $now){
                    $this->commandSent($sr->nomor,$sr->text);
                    $id = $sr->id;
                    $whrd = array('id'=>$id);
                    $this->dbase->deldata('sms_temp',$whrd);
                }
            }}else{
                echo"gagal kirim pesan";
                exit;
            }
            redirect('sms/outbox/sukses/dikirim');
        }
        else{
            redirect('sms/outbox/gagal/outbox>1');
        }
    }
    
    public function commandSent($no,$tex){
        #echo $no.$tex;
        #old location
        $aloc = getcwd();
        #change old location
        chdir('bin/');
        #execute command
        passthru('gammu-smsd-inject -c smsdrc TEXT '.$no.' -text "'.$tex.'"',$hasil);
        #change back to old location
        chdir($aloc);
        #exit;
    }
    
    ############################################################################
    
    public function viewDataf($id){
        $whr = array('id_save'=>$id);
        $data['folder'] = $this->dbase->getData('*','folder');
        $data['file'] = $this->dbase->getdata('*','saved_folder',$whr);
        $this->loadPage('viewDataf',$this->class,$data);
    }
    
    public function viewData($id=null,$tbl=null){
        $whr = array('id'=>$id);
        $data['tbl'] = $tbl;
        $data['folder'] = $this->dbase->getData('*','folder');
        $data['file'] = $this->dbase->getdata('*',$tbl,$whr);
        $this->loadPage('viewData',$this->class,$data);
    }
    
    public function deleteData($id,$tbl,$id_f=null,$fn=null){
        #delete data
        if($tbl === 'saved_folder'){
            $whr = array('id_save'=>$id);
        }
        else{
            $whr = array('ID'=>$id);
        }
        $this->dbase->deldata($tbl,$whr);
        #save log
        $this->savelog('Hapus Data '.$tbl);
        #redirect
        if($tbl === 'inbox'){
            redirect('sms/index/sukses/dihapus');
        }
        else if($tbl === 'saved_folder'){
            redirect('sms/folder/'.$id_f.'/'.$fn);
        }
        else{
            redirect('sms/'.$tbl.'/sukses/dihapus');
        }
    }
    
    public function savedFolder(){
        $f = $this->ipost('id_folder');
        $p = $this->ipost('id_pesan');
        $tbl = $this->ipost('tbl');
        $whr = array('ID'=>$p);
        $q = $this->dbase->getdata('*',$tbl,$whr);
        foreach($q->result() as $r){
            if($tbl === 'inbox'){
                $data = array(
                            'id_folder'=>$f,
                            'id_pesan'=>$p,
                            'id_user'=>$this->cises('id'),
                            'waktu'=>$r->ReceivingDateTime,
                            'number'=>$r->SenderNumber,
                            'pesan'=>$r->TextDecoded
                        );
            }
            else{
                $data = array(
                            'id_folder'=>$f,
                            'id_pesan'=>$p,
                            'id_user'=>$this->cises('id'),
                            'waktu'=>$r->SendingDateTime,
                            'number'=>$r->DestinationNumber,
                            'pesan'=>$r->TextDecoded
                        );
            }
        }
        $this->dbase->insdata('saved_folder',$data);
        if($tbl === 'inbox'){
            $tbl = 'index';
        }
        redirect('sms/'.$tbl.'/sukses/disimpan');
    }
    
    public function updateFolder(){
        $f = $this->ipost('id_folder');
        $exp = explode(".",$f);
        $s = $this->ipost('id_save');
        $tbl = $this->ipost('tbl');
        $whr = array('id_save'=>$s);
        $data = array(
                    'id_folder'=>$exp[0],
                    'table'=>$tbl
                );
        $this->dbase->uptdata('saved_folder',$whr,$data);
        redirect('sms/folder/'.$exp[0].'/'.$exp[1]);
    }
    
    public function folder($id,$fol){
        $data['total'] = $this->dbase->countdata('saved_folder');
        $config['base_url'] = base_url().'/sms/folder/page/';
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
        $data['namaf'] = $fol;
        $data['mess'] = $this->mess();
        $whr = array('id_folder'=>$id,'id_user'=>$this->cises('id'));
        $data['sfolder'] = $this->dbase->getdata('*','saved_folder',$whr,$limit,array('id_save','DESC'));
        #echo $this->db->last_query();
        $this->pagination->initialize($config);
        $this->loadPage('folder',$this->class,$data);
    }
    
    public function myKontak(){
        $iduser = $this->cises('id');
        $data['total'] = $this->dbase->countres('pbk',array('user_id'=>$iduser));
        $config['base_url'] = base_url().'/sms/myKontak/page/';
        $config['total_rows'] = $data['total'];
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $lim1 = $this->iseg(4);
        $lim2 =  $lim1 + $config['per_page'];
        #$data['mess'] = $this->mess();
        $data['kontak'] = $this->dbase->getdata('*','pbk',array('user_id'=>$iduser),array($lim2,$lim1));
        $this->pagination->initialize($config);
        $this->load->view('sms/mykontak',$data);
    }
    
    public function cariKontak(){
        #collect post data
        $c = $this->ipost('cari');
        $like = array(
                'name'=>$c,
                'number'=>$c
            );
        $lim = array('5','0');
        #find word like post
        $data['kontak'] = $this->dbase->getfind('*','pbk','or',$like,$lim);
        #load page
        $this->load->view('sms/myKontak',$data);
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

