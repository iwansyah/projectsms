<?php date_default_timezone_set('Asia/Bangkok'); ?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <title>Index Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- <meta http-equiv="refresh" content="30"> -->
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="images/png/twitter13.png" rel="shortcut icon" />
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/tab.js"></script>
        <script type="text/javascript">
                
                //auto load notify
                setInterval(function(){
                    $('#notify, #notify2').load('home/notify').fadein('slow');
                },5000);
                <?php
                $myak = $this->session->userdata('id'); 
                $int = $this->dbase->getInternet($myak);
                if($_SERVER['SERVER_NAME'] !== 'localhost'){echo"/*";}
                if($int === 'offline'){echo"/*";} ?>
                //auto get outbox from server
                setInterval(function(){
                    $('#outbox').load('getoutbox/getXml'); 
                },5000);
                //auto sent new inbox to server
                setInterval(function(){
                    $('#outbox').load('getoutbox/sendInbox');
                },10000);
                //auto check sent report
//                setInterval(function(){
//                    $('#outbox').load('getoutbox/checkStat').fadein('slow');
//                },20000);
                <?php 
                if($_SERVER['SERVER_NAME'] !== 'localhost'){echo"*/";}
                if($int === 'offline'){echo"*/";}?>
        </script>
    </head>
    <body>
		<?php #print_r($this->session->all_userdata()); ?>
        <div width="100%">
            <marquee behaviour="right" style="color:white;"><?php $stick = $this->notify->showSticker('index'); if(isset($stick)){echo $stick;} ?></marquee>
        </div>
        <div id="outbox"></div>
        <?php #echo date('Y-m-d H:i:s');?>
        <div>
            <header>
                <span><img src="images/png/twitter13.png" >SMS-G</span>
            </header>
        </div>
        <div class="main">
            <div class="navi">
                <div class="navi_left">
                    <a href="sms/index/read"><sup id="notify"></sup><img src="images/png/new56.png" width="20" height="20"></a>  
                    <a href="" onclick="history.back();"><img src="images/png/arrow34.png" width="20" height="20"></a>  
                    <a href="home"><img src="images/png/home63.png" width="20" height="20"></a>  
                    <a href="" onclick="history.back();"><img src="images/png/the14.png" width="20" height="20"></a>  
                </div>
                <div class="navi_right">
                    <nav>
                        <a href="home/profile"><img src="images/png/user58.png" width="20" height="20"></a> 
                        <a href="setting/index"><img src="images/png/settings39.png" width="20" height="20"></a> 
                        <a href="login/logout" onclick="return confirm('Apakah anda yakin ingin keluar?')";><img src="images/png/logout.png" width="20" height="20"></a>  
                    </nav>
                </div>
            </div>
            <table border="0" style="width:100%;">
                <tr>
                    <td style="width:20%;vertical-align: top;">
                        <aside>
                <fieldset>
                    <legend><img src="images/iconpack/mail1_16x16.gif"> Pesan</legend>
                    <ul style="padding:0px;">
                        <li><a href="sms/newSms"><img src="images/iconpack/mail1_(edit)_16x16.gif"> Tulis Pesan</a></li>
                        <li><a href="sms/index/read"><img src="images/iconpack/check-in_16x16.gif"> Kotak Masuk <span id="notify2"></span></a></li>
                        <li><a href="sms/outbox"><img src="images/iconpack/check-out_16x16.gif"> Kotak Keluar</a></li>
                        <li><a href="sms/sentitems"><img src="images/iconpack/ok_16x16.gif"> Pesan Terkirim</a></li>
                        <li>
                            <a href="draf" id="draf"><img src="images/iconpack/file_(edit)_16x16.gif"> Draf</a>
                            <div id="sdraf" style="margin-left:20px;width:auto;height:auto;">
                                <ul>
                                    <li><a href="draf/addData"><img src="images/iconpack/file_(add)_16x16.gif"> Add</a></li>
                                    <li><a href="draf/index"><img src="images/iconpack/file_16x16.gif"> Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="folder/" id="fold"><img src="images/iconpack/folder_(add)_16x16.gif"> Folder</a>
                            <div id="sfold" style="margin-left:30px;width:auto;height:auto;">
                                <ul>
                                <?php 
                                    if(isset($folder)){
                                        foreach($folder->result() as $f){
                                ?>
                                    <li style="list-style-type: square;color:white;"><a href="sms/folder/<?php echo $f->id ?>/<?php echo $f->name; ?>"><?php echo $f->name; ?></a></li>
                                <?php
                                        }
                                    }
                                ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </fieldset>
                <fieldset>
                    <legend><img src="images/iconpack/administrator1_16x16.gif"> Admin</legend>
                    <nav><ul>
                        <li>
                            <a href="kontak" id="kontak"><img src="images/iconpack/contact_16x16.gif"> Kontak</a>
                            <div id="skontak" style="margin-left:20px;width:auto;height:auto;">
                                <ul>
                                    <li><a href="kontak/addData"><img src="images/iconpack/contact_(add)_16x16.gif"> Add</a></li>
                                    <li><a href="kontak/index"><img src="images/iconpack/contact_16x16.gif"> Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <?php if($this->session->userdata('akses')==='1'){ ?>
                        <li>
                            <a href="user/" id="user"><img src="images/iconpack/administrator1_16x16.gif"> User</a>
                            <div id="suser" style="margin-left:20px;width:auto;height:auto;">
                                <ul>
                                    <li><a href="user/addData"><img src="images/iconpack/administrator2_(add)_16x16.gif"> Add</a></li>
                                    <li><a href="user/index"><img src="images/iconpack/administrator1_16x16.gif"> Data</a></li>
                                </ul>
                            </div>
                        </li>
                        <?php }?>
                        <li><a href="setting/index"><img src="images/iconpack/settings1_16x16.gif"> Setting</a></li>
                        <li><a href="cari"><img src="images/iconpack/search_16x16.gif"> Cari</a></li>
                    </ul>
                    </nav>
                </fieldset>
                <fieldset>
                    <legend><img src="images/iconpack/database_table_16x16.gif"> Info</legend>
                    <nav><table border="0">
                        <tr>
                            <td>User </td>
                            <td>: <?php $myus = $this->session->userdata('user'); $us = ($myus =='' ? 'Guest':$myus); echo $us; #ucfirst($this->session->userdata('user')); ?></td>
                        </tr>
                        <tr>
                            <td>Status </td>
                            <td>: <?php $myak = $this->session->userdata('akses'); $ak = ($myak =='3' ? 'Guest':$this->dbase->getAksesById($this->session->userdata('akses'))); echo $ak ?></td>
                        </tr>
                        <tr>
                            <td>Gammu </td>
                            <td>: <?php if($this->dbase->getGammu() !== ''){
                                $sesg = $this->dbase->getGammu();
                                if($sesg === 'on'){
                                    #echo $sesg;
                                    echo "<span style='color:green;font-weight:normal'>ON</span>";
                                }
                                else{
                                    #echo $sesg;
                                    echo "<span style='color:red;font-weight:normal'>OFF</span>";
                                }
                            } ?></td>
                        </tr>
                        <tr>
                            <td>Internet </td>
                            <td>: <?php 
                            $myak = $this->session->userdata('id'); 
                            $int = $this->dbase->getInternet($myak); 
                            if($int === 'online'){
                            ?>
                                <a href="home/updOnline/<?php echo $myak ?>/offline" style="color:green;">Online</a>
                            <?php }else{ ?>    
                                <a href="home/updOnline/<?php echo $myak ?>/online" style="color:blue;">Offline</a>
                                <?php }?>
                            </td>
                        </tr>
                        </table>
                    </nav>
                </fieldset>            
            </aside>
                    </td>
                    <td style="width:76%;vertical-align: top;">
                        <section>
                <fieldset>
                    <legend><img src="images/iconpack/select_all_16x16.gif"> <?php echo ucfirst($this->uri->segment(1)); ?></legend>
                    <?php 
			if(isset($load)){
				if($dir!=''){
					$this->load->view($dir.'/'.$load);
				}
				else{
					$this->load->view($load);
				}
			}
                    ?>
                </fieldset>
            </section>
                    </td>
                </tr>
            </table>
        </div>
        <div style="clear:both;">
            <footer>
                <center style="padding-top: 10px;"><div style="width:900px;text-align:right;font-size:0.8em;">copyright by <a href="http://www.freelancer.co.id">freelancer &#153</a><br>code by <a href="http://www.iwanshare.wordpress.com" target="_BLANK">uchihae</a><br>design by <a href="http://www.twitter.com/iwansyah" target="_BLANK">uchihae</a><br>Copyright (c) 2014 <a href="http://smsg.ajaregistra.co.id/">smsg ver 1.0</a></div></center>
            </footer>
        </div>
    </body>
</html>
