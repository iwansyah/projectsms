<div>
    <div>
        <h3 style="float:left;">Folder <?php if(isset($namaf)){ echo $namaf; }?></h3><span style="float:right;margin-top:25px;"><a href="sms/newSms"><img src="images/iconpack/add_16x16.gif"> New SMS</a></span>
    </div>
    <?php if(isset($mess)){echo $mess;}?>
        <hr style="clear:both;">
        <script type="text/javascript">
            function val(){
                if(document.fcari.cari.value == ''){
                    alert('Form cari tidak boleh kosong...!');
                    document.fcari.cari.focus();
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>
        <form name="fcari" method="post" action="sms/cariDataf" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>    
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Isi</th>
                <th colspan="3"></th>
            </tr>
            <?php if(isset($sfolder)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1); foreach($sfolder->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php $numb = $this->dbase->getBy('name','pbk',array('number'=>$row->number,'user_id'=>$this->session->userdata('akses')));
                        if(isset($numb)){
                            echo $numb;
                        }
                        else{
                            echo $row->number;
                        }
                ?></td>
                <td><?php echo $row->pesan; ?></td>
                <td width="20"><a href="sms/viewDataf/<?php echo $row->id_save; ?>"><img src="images/iconpack/zoom_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="sms/newSms/0/<?php echo $row->id_save; ?>/saved_folder"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="sms/deleteData/<?php echo $row->id_save; ?>/saved_folder/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}}?>
        </table>
        <?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?>
</div>
