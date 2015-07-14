<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author iwansyahkun
 */
class Home extends CI_Controller{
    //put your code here
    var $class = 'home';
    
    public function __construct() {
        parent::__construct();
        $this->level();
        $this->load->helper('FusionCharts');
        $this->load->helper('FC_Colors');
    }
    
    public function index(){
        $data = $this->createXml();
        $this->loadPage('index',$this->class,$data);
    }
    
    public function dataChart(){
        #$tbl = array('inbox','sentitems','saved_folder','draf','pbk');
        $data['inbox'] = $this->dbase->countdata('inbox');
        $data['sent'] = $this->dbase->countdata('sentitems');
        $data['save'] = $this->dbase->countres('saved_folder',array('id_user'=>$this->cises('id')));
        $data['draf'] = $this->dbase->countres('draf',array('user_id'=>$this->cises('id')));
        $data['phonebook'] = $this->dbase->countres('pbk',array('user_id'=>$this->cises('id')));
        $data['folder'] = $this->dbase->countres('folder',array('user_id'=>$this->cises('id')));
        
        return $data;
    }
    
    public function createXml(){
        
        $img = "";
        $bgcolor = "";
        $transparant = "1";
        #$caption1 = "GRAFIK JUMLAH DATA SMS";
        $xlabel = "DATA";
        $ylabel	= "JUMLAH";
        $decimal = "0";
        
        $colors = array("red","blue","white","yellow","green","black");
        $rand = array_rand($colors,2);
        $data = $this->dataChart();
        $tbl = array('inbox','sent','save','draf','phonebook','folder');
        $byk = count($tbl);
        $strXML = "<graph bgSWF='".$img."' canvasBgColor='".$bgcolor."' canvasBgAlpha='".$transparant."' caption='Statistik SMS'  subcaption='' xAxisName='".$xlabel."' yAxisName='".$ylabel."' formatNumberScale='0' decimalPrecision='".$decimal."'>";
        for($i=0;$i<6;$i++){
            $strXML .= "<set name='" . strtoupper($tbl[$i])."' value='" . $data[$tbl[$i]] . "' color='".  getFCColor()."'/>";
        }
        $strXML .= "</graph>";
        $data['cfolder'] = $data['folder'];
        $data['lebar'] = "650";
        $data['tinggi'] = "350";
        $data['graphtype'] = base_url()."fchart/FCF_Column3D.swf";
        $data['strXML'] = $strXML;
        return $data;
    }
    
    public function profile(){
        $whr = array('id'=>$this->cises('akses'));
        $data['akses'] = $this->dbase->getBy('akses','akses',$whr);
        #where user id
        $whr = 'user.id=pbk.user_id and user.id = '.$this->sesid();
        #get data profile
        $lim = array('1','0');
        $data['profile'] = $this->dbase->getjoin('*','user','pbk',$whr,$lim);
        $this->loadPage('profile',$this->class,$data);
    }
    
    public function notify(){
        $this->notify->autocheckTbl();
    }
    
    public function updOnline($uid,$ol){
        $this->notify->updOnline($uid,$ol);
        redirect('home/','refresh');
    }
}

