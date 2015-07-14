<div>
    <div>
        <h3 style="float:left;">Data Kontak</h3><span style="float:right;margin-top:25px;"><a href="kontak/addData"><img src="images/iconpack/add_16x16.gif"> Add New</a></span>
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
        <form name="fcari" method="post" action="kontak/cariData/" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th colspan="3"></th>
            </tr>
            <?php if(isset($kontak)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1); foreach($kontak->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo $row->name; ?></td>
                <td><?php echo $row->number; ?></td>
                <td width="20"><a href="sms/newSms/<?php echo $row->id_pbk; ?> "><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="kontak/editData/<?php echo $row->id_pbk; ?>"><img src="images/iconpack/edit_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="kontak/deleteData/<?php echo $row->id_pbk; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}}?>
        </table>
        <p><?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?></p>
</div>
