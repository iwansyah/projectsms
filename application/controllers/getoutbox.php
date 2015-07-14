<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of getoutbox
 *
 * @author iwansyahkun
 */
class Getoutbox extends CI_Controller{
        
    //put your code here
    public function __construct() {
        parent::__construct();
        #$this->level();
    }
    
    #################### get data outbox on the server ########################
    public function getXml(){
        $url = 'http://smsg.ajaregistra.co.id/getoutbox/createXml';
        $datao = @simplexml_load_file($url);
        #print_r($datao);
        #$byk = count($datao);
        $res = @array_key_exists("data", $datao);
            if($res>0){
            #print_r($datao);
                foreach($datao as $row){
                    if($row->id !== ''){

                        $id = $row->id;
                        $n = $row->nomor;
                        $p = $row->pesan;
                        ######### sent in the local gammu ###########
                        $this->kirimSms($id,$n,$p);
                    }
                }
            }
    }
    ############################################################################
    
    ######################## sent sms process #################################
    public function kirimSms($id,$n,$p){
        $this->cekGammu();
        ################### cek pbk if not exist will be adding ############
        $cp = $this->dbase->countres('pbk',array('number'=>$n));
        if($cp===0){
            $datap = array(
                'group_id'=>1,
                'user_id'=>$this->cises('akses'),
                'number'=>$n
            );
            $this->dbase->insdata('pbk',$datap);
        }
        
        $this->dbase->myqueryx('insert into sms_temp(nomor,text,user_id) values("'.$n.'","'.$p.'","'.$id.'")');
        redirect('getoutbox/getSmstemp');
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
            $sentto = $this->dbase->getData('*','sms_temp',null,array(1,0),array('id','desc'));
            if(isset($sentto)){
                foreach($sentto->result() as $sr){
                    $sw = explode(" ",$sr->waktu);
                    if($sw[0] === $now){
                        ########### sent sms with gammu ######################
                        $this->commandSent($sr->nomor,$sr->text);
                    }
                    ######### delete on xml ######################
                    $this->delXml($sr->user_id);

                    ########### delete sms temp ########################
                    $whrd = array('id'=>$id);
                    $this->dbase->deldata('sms_temp',$whrd);
                }
                #empty all queued
                $this->dbase->empdata('sms_temp');
                redirect('sms/outbox/sukses/diproses');
            }else{
                echo"gagal kirim pesan";
                exit;
            }
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
    
    ################# create xml outbox by server ##############################
    public function createXml(){
        header('Content-Type:text/xml');
        echo"<?xml version='1.0'?>";
        echo"<outbox>";
        
        $qo = $this->dbase->getdata('*','outbox');
        if(isset($qo)){
            foreach($qo->result() as $ro){
                echo"<data>";
                echo"<id>".$ro->ID."</id>";
                echo"<nomor>".$ro->DestinationNumber."</nomor>";
                echo"<pesan>".$ro->TextDecoded."</pesan>";
                echo"</data>";
            }
        }
        echo"</outbox>";
    }
    
    ############################################################################
    
    ################## move to sent and delete outbox if sending ok ############
    public function delXml($id){
        $url = 'http://smsg.ajaregistra.co.id/getoutbox/moveoutbox';
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_POSTFIELDS,'id='.$id);
        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_TIMEOUT,30);
        curl_setopt($curl,CURLOPT_POST,1);
        $result = curl_exec($curl);
        curl_close($curl);
        if($result){echo $result;}else{echo $result;}
    }
    
    ##################### if success outbox move to sentitems #################
    public function moveoutbox(){
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $id = $this->ipost('id');
        $qm = $this->dbase->getData('*','outbox',array('ID'=>$id));
        $data = array();
        foreach($qm->result() as $rm){
            $data['UpdatedInDB'] = $now;	
            $data['InsertIntoDB'] = $now; 	
            $data['SendingDateTime'] = $now;	
            $data['Text'] = $rm->Text;  	
            $data['DestinationNumber'] = $rm->DestinationNumber;	
            $data['Coding'] = $rm->Coding; 	
            $data['UDH'] = $rm->UDH;		
            $data['Class'] = $rm->Class; 	
            $data['TextDecoded'] = $rm->TextDecoded;
            $data['ID'] = $rm->ID;
            $data['CreatorID'] = $rm->CreatorID; 
        }
        $this->dbase->insdata('sentitems',$data);
        $this->dbase->deldata('outbox',array('ID'=>$id));
    }
    
    ###########################################################################
    
    ################## check if new inbox exist ###############################
    public function checkInbox(){
        $byk = $this->notify->autocheckTbl('print');
        #echo $byk;
        $data = array();
        if($byk > 0){
            $q = $this->dbase->getData('*','inbox',null,array($byk,'0'),array('ID','desc'));
            $i = 0;
            if(isset($q)){foreach($q->result() as $r){
                $data[$i] = array(
                    'UpdatedInDB' => $r->UpdatedInDB, 	
                    'ReceivingDateTime' => $r->ReceivingDateTime,	
                    'Text' => $r->Text,	
                    'SenderNumber' => $r->SenderNumber,	
                    'Coding' => $r->Coding, 	
                    'UDH' => $r->UDH,	
                    'SMSCNumber' => $r->SMSCNumber,	
                    'Class' => $r->Class,	
                    'TextDecoded' => $r->TextDecoded,	
                    'ID' => $r->ID,
                    'RecipientID' => $r->RecipientID, 	
                    'Processed' => $r->Processed
                        );
                $i++;
            }}
            return $data;
        }
    }
    
    public function sendInbox(){
        $data = $this->checkInbox();
        #exit;
        $tot = count($data);
        if(isset($data)){
                $postvalue='';
                    $no = 0;
                    foreach($data as $row){
                        $postvalue .= 'total'.$no.'='.$tot.'&'.
                        'UpdatedInDB'.$no.'='.$row['UpdatedInDB'].'&'.
                        'ReceivingDateTime'.$no.'='.$row['ReceivingDateTime'].'&'.
                        'Text'.$no.'='.$row['Text'].'&'.
                        'SenderNumber'.$no.'='.$row['SenderNumber'].'&'.
                        'Coding'.$no.'='.$row['Coding'].'&'.
                        'UDH'.$no.'='.$row['UDH'].'&'.
                        'SMSCNumber'.$no.'='.$row['SMSCNumber'].'&'.
                        'Class'.$no.'='.$row['Class'].'&'.
                        'TextDecoded'.$no.'='.$row['TextDecoded'].'&'.
                        'ID'.$no.'='.$row['ID'].'&'.
                        'RecipientID'.$no.'='.$row['RecipientID'].'&'.
                        'Processed'.$no.'='.$row['Processed'];
                    $no++;
                    }
                $url = 'http://smsg.ajaregistra.co.id/getoutbox/insinbox';
                $curl = curl_init();
                curl_setopt($curl,CURLOPT_URL,$url);
                curl_setopt($curl,CURLOPT_POSTFIELDS, $postvalue);
                curl_setopt($curl,CURLOPT_POST,1);
                curl_setopt($curl,CURLOPT_HEADER,0);
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($curl,CURLOPT_TIMEOUT,30);
                $result = curl_exec($curl);
                curl_close($curl);
                #if($result){echo $result;}else{echo $result;}
            }
    }
    
    ################# inbox update from local to server #######################
    public function insinbox(){
        $total = $this->ipost('total0');
        #echo $total;
        $data = array();
        for($i=0;$i<$total;$i++){
            $data[$i]['UpdatedInDB'] = $this->ipost('UpdatedInDB'.$i);
            $data[$i]['ReceivingDateTime'] = $this->ipost('ReceivingDateTime'.$i);
            $data[$i]['Text'] = $this->ipost('Text'.$i);
            $data[$i]['SenderNumber'] = str_replace(" ", "", $this->ipost('SenderNumber'.$i));
            $data[$i]['Coding'] = $this->ipost('Coding'.$i);
            $data[$i]['UDH'] = $this->ipost('UDH'.$i);
            $data[$i]['SMSCNumber'] = $this->ipost('SMSCNumber'.$i);
            $data[$i]['Class'] = $this->ipost('Class'.$i);
            $data[$i]['TextDecoded'] = $this->ipost('TextDecoded'.$i);
            $data[$i]['ID'] = $this->ipost('ID'.$i);
            $data[$i]['RecipientID'] = $this->ipost('RecipientID'.$i);
            $data[$i]['Processed'] = $this->ipost('Processed'.$i);
        }
        for($i=0;$i<$total;$i++){
            $this->dbase->insdata('inbox',$data[$i]);
        }
    }
    
    ###########################################################################
    
//    ##################### check status on sentitems ############################
//    public function checkStat(){
//        $bo = $this->dbase->countdata('outbox');
//        if($bo<1){
//            $whr='';
//            $id='';
//            $st = $this->dbase->getdata('*','sms_temp');
//            if(isset($st)){foreach($st->result() as $rt){
//                    $whr = array(
//                            'DestinationNumber'=>$rt->DestinationNumber
//                        );
//                    $id = $rt->user_id;
//            }}
//            $qd = $this->dbase->getData('*','sentitems',$whr,array(1,0),array('ID','desc'));
//            #echo $this->db->last_query();
//            if(isset($st)){foreach($qd->result() as $rd){
//                    if($rd->Status === 'SendingOKNoReport'){
//                        return $this->delXml($id);
//                    }
//                    else if($rd->Status === 'SendingOK'){
//                        return $this->delXml($id);
//                    }
//                    else{
//                        return 'NoReport';
//                    }
//            }}
//        }
//    }
}

