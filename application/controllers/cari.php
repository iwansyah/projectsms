<?php if(!defined('BASEPATH')) exit ('No direct script access allowed'); 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cari
 *
 * @author iwansyahkun
 */
class Cari extends CI_Controller {
    //put your code here
    var $class = 'cari';
    
    public function __construct() {
        parent::__construct();
        $this->level();
    }
    
    public function index(){
        $this->loadPage('index', $this->class);
    }
    
    public function result(){
        $c = $this->ipost('cari');
        $lim = array(5,0);
        $likei = array(
                'ReceivingDateTime'=>$c,
                'SenderNumber'=>$c,
                'TextDecoded'=>$c
            );
        
        $likeo = array(
                'SendingDateTime'=>$c,
                'DestinationNumber'=>$c,
                'TextDecoded'=>$c
            );
        $likes = array(
                'waktu'=>$c,
                'number'=>$c,
                'pesan'=>$c,
            );
        $liked = array(
                'title'=>$c,
                'content'=>$c
            );
        $likef = array(
                'name'=>$c
            );
        $likep = array(
                'name'=>$c,
                'number'=>$c
            );
        $likeg = array(
                'name'=>$c
            );
        $likel = array(
                'kegiatan'=>$c,
                'waktu'=>$c,
            );
        $whr = array('user_id'=>$this->cises('id'));
        $whr2 = array('id_user'=>$this->cises('id'));
        
        $data['key'] = $c;
        
        $data['inbox'] = $this->dbase->getfind('*','inbox','or',$likei,$lim);
        $data['outbox'] = $this->dbase->getfind('*','outbox','or',$likeo,$lim);
        $data['sent'] = $this->dbase->getfind('*','sentitems','or',$likeo,$lim);
        $data['save'] = $this->dbase->getfind('*','saved_folder','or',$likes,$lim,$whr2);
        $data['draf'] = $this->dbase->getfind('*','draf','or',$liked,$lim,$whr);
        $data['fol'] = $this->dbase->getfind('*','folder','or',$likef,$lim,$whr);
        $data['pbk'] = $this->dbase->getfind('*','pbk','or',$likep,$lim,$whr);
        $data['pbkg'] = $this->dbase->getfind('*','pbk_groups','or',$likeg,$lim,$whr);
        $data['log'] = $this->dbase->getfind('*','log','or',$likel,$lim,$whr);
        
        $this->loadPage('result',$this->class,$data);
    }
}

