<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gammu
 *
 * @author iwansyahkun
 */
class Gammu extends CI_Controller {
    
    var $class = 'gammu';
    //put your code here
    
    public function __construct() {
        parent::__construct();
        #privilage
        $this->level();
    }
    
    public function index(){
        $this->tabPage('gammu');
    }
    
    ############# inside on inside page ######################
    public function tabPage($page,$data=null){
        $data['page'] = 'gammu';
        $this->loadPage('index',$this->class,$data);
    }
    
    public function secRight($page,$data=null){
        $data['rights'] = $page;
        $this->tabPage($page,$data);
    }
    ############################################################
    
    public function gammurc($save=null){
        #open file gammurc
        $handle = @fopen('bin/gammurc', 'r');
        #per row will be array
        #$baris = array();
        #if open
        if($handle){
            #made loop
            while(!feof($handle)){
                #get text on file
                $buffer = @fgets($handle);
                #print_r($buffer);
                if(substr_count($buffer,"device = ") > 0){
                    #explode for get port
                    $split = explode("device = ",$buffer);
                    $port = str_replace(":", "", $split[1]);
                    #data port
                    $data['port'] = $port;
                }

                if(substr_count($buffer,"connection = ") > 0){
                    #explode for get con
                    $split = explode("connection = ",$buffer);
                    #data con
                    $data['con'] = $split[1];
                }
                #$baris[] = $buffer;
            }
        fclose($handle);
        }else{
            echo "cannot open file";
            exit;
        }
        if($save === 'save'){
            $port = $this->ipost('port');
            $con = $this->ipost('con');
            
            $handle = @fopen("bin/gammurc", "w");
            if($handle){
                $text = "[gammu]\ndevice = ".$port.":\nconnection = ".$con;
                fwrite($handle, $text);
            }
            fclose($handle); 
            
            $data['port'] = $port;
            $data['con'] = $con;
            $data['mess'] = 'Konfigurasi Berhasil Disimpan';
            $this->savelog('Edit Gammurc');
            $this->secRight('gammurc',$data);
        }
        else{
            $this->secRight('gammurc',$data);
        }
    }
    
    public function smsdrc($save=null){
        $handle = fopen('bin/smsdrc','r');
        if($handle){
            while(!feof($handle)){
                $buffer = fgets($handle);
                #print_r($buffer);
                if(substr_count($buffer, "device = ")>0){
                    $split = explode("device = ", $buffer);
                    #print_r($split);
                    $port = str_replace(":", "", $split[1]);
                    #echo $port;
                    $data['port'] = $port;
                }
                if(substr_count($buffer, "connection = ")>0){
                    $split = explode("connection = ", $buffer);
                    #print_r($split);
                    $data['con'] = $split[1];
                }
                if(substr_count($buffer, "user = ")>0){
                    $split = explode("user = ", $buffer);
                    $data['user'] = $split[1];
                }
                if(substr_count($buffer, "password = ")>0){
                    $split = explode("password = ", $buffer);
                    $data['pass'] = $split[1];
                }
                if(substr_count($buffer, "database = ")>0){
                    $split = explode("database = ", $buffer);
                    $data['db'] = $split[1];
                }
            }
        fclose($handle);
        }
        else{
            echo "cannot open file";
        }
        if($save==='save'){
            $port =  $this->ipost('port');
            $con = $this->ipost('con');
            $user =  $this->ipost('user');
            $pass = $this->ipost('pass');
            $db = $this->ipost('db');
            
            $handle = fopen('bin/smsdrc','w');
            
            if($handle){
$text = "
########## gammurc config ##########
[gammu]
device = ".$port.":
connection = ".$con."

########## smsd config ##############
[smsd]
service = mysql
PIN = 1234
logfile = smsdlog
debuglevel = 0
commtimeout = 30
sendtimeout = 30
#jika lebih dari satu
#phoneid = MyPhone1

########## database config ##########
#[database]
user = ".$user."
password = ".$pass."
pc = localhost
database = ".$db;
                $wr = fwrite($handle, $text);
            }
            fclose($handle);
            $data['port'] = $port;
            $data['con'] = $con;
            $data['user'] = $user;
            $data['pass'] = $pass;
            $data['db'] = $db;
            $data['mess'] = 'Konfigurasi Berhasil Disimpan';
            $this->savelog('Edit Smsdrc');
            $this->secRight('smsdrc',$data);
        }else{
            $this->secRight('smsdrc',$data);
        }
    }
    
    public function tesKoneksi($com=null){
        if($com === 'run'){
            $data['com'] = $com;
            $this->savelog('Tes Koneksi');
        }
        $data['com'] = $com;
        $this->secRight('koneksi',$data);
    }
    
    public function cekPulsa($com=null){
        if($com === 'run'){
            $data['com'] = $com;
            $data['code'] = '*388#';
            $this->savelog('Cek Pulsa');
        }
        $data['com'] = $com;
        $this->secRight('cekPulsa',$data);
    }
    
    public function addService($com=null){
        if($com === 'run'){
            $data['com'] = $com;
            $this->savelog('Add Service');
        }
        $data['com'] = $com;
        $this->secRight('addService',$data);
    }
    
    public function startService($com=null){
        if($com === 'run'){
            $data['com'] = $com;
            $this->savelog('Start Service');
        }
        $data['com'] = $com;
        $this->secRight('startService',$data);
    }
    
    public function service($cek,$file){
        $this->dbase->uptdata('daemons',array('Info'=>'gammu'),array('Start'=>$cek));
        $data['gammu'] = 'Service '.$cek;
        $this->secRight($file.'Service',$data);
    }
    
    public function stopService($com=null){
        if($com === 'run'){
            $data['com'] = $com;
            $this->savelog('Stop Service');
        }
        $data['com'] = $com;
        $this->secRight('stopService',$data);
    }
    
    public function unService($com=null){
        if($com === 'run'){
            $data['com'] = $com;
            $this->savelog('Uninstall Service');
        }
        $data['com'] = $com;
        $this->secRight('uninstallService',$data);
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

