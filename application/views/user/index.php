<div>
    <div>
        <h3 style="float:left;">Data User</h3><span style="float:right;margin-top:25px;"><a href="user/addData"><img src="images/iconpack/add_16x16.gif"> Add New</a></span>
    </div><script type="text/javascript">
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
        <br>
    <?php if(isset($mess)){echo $mess;}?>
        <hr style="clear:both;">
        <form name="fcari" method="post" action="user/cariData/" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>
        <table class="cust">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th colspan="3"></th>
            </tr>
            <?php if(isset($user)){$no = 1; foreach($user->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->user; ?></td>
                <td><?php echo $row->email; ?></td>
                <td width="20"><a href="sms/newSms/<?php echo $row->id; ?>"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="user/editData/<?php echo $row->id; ?>"><img src="images/iconpack/edit_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="user/deleteData/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}}?>
        </table><br>
        <?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?>
</div>
