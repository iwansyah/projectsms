<script type="text/javascript">
function openform(){
    window.open('sms/myKontak', 'mykontak', 'url=no,location=no,menubar=no,status=no,top=50%,left=50%,height=400,width=550')
}
function fsfmVal(){
    var f = document.fsms;
    var nomor = f.nomor.value;
    var isi = f.isi.value;
    
    if(nomor === ''){
        alert('Nomor tidak boleh kosong...!');
        f.nomor.focus();
        return false;
    }
    else if(isi === ''){
        alert('Isi pesan tidak boleh kosong...!');
        f.isi.focus();
        return false;
    }
    else{
        return true;
    }
}
</script>
<div>
    <h3>SMS</h3>
    <hr style="clear:both;">
    <?php if($_SERVER['SERVER_NAME'] === 'localhost'){ ?>
    <form name="fsms" method="post" action="sms/kirimSms" onsubmit="return fsfmVal()">
        <?php }else{?>
    <form name="fsms" method="post" action="sms/kirimXml" onsubmit="return fsfmVal()">
        <?php }?>
    <table border="0" cellpadding="5" cellspacing="5">
            <?php 
                $number = ''; 
                $mydraf = '';
                if(isset($no)){
                        if($no != ''){
                            $number = $no;
                        }
                } 
                if(isset($draf)){
                        if($draf != ''){
                            $mydraf = $draf;
                        }
                }
             ?>
        <tr>
            <td>Nomor </td>
            <?php
                $seg4 = '';
                if(is_numeric($this->uri->segment(4))){
                   $seg4 = $this->uri->segment(4);
                }
            ?>
            <td><input type="text" name="nomor" value="<?php echo $number;?>" size="25" max="15" maxlength="15"><span style="margin-left: 10px;"><!-- span <a href="kontak/index/<?php echo $seg4 ?>">--><span style="cursor:pointer;color:blue;" onclick="return openform();"><img src="images/iconpack/add_16x16.gif"> Kontak</span></span></td>
        </tr>
        <tr>
            <td>Isi Pesan </td>
            <td><textarea name="isi" rows="7" cols="35" max="160" maxlength="160"><?php echo $mydraf; ?></textarea> </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Kirim"></td>
            <td><input type="reset" name="reset" value="Reset" onclick="return resetd()"></td>
        </tr>
    </table>
        </form>
</div>
