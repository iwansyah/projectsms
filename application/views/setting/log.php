<div>
    <div>
        <h3 style="float:left;">Data LOG</h3>
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
        <form name="fcari" method="post" action="setting/cariDataLog/" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th colspan="2"></th>
            </tr>
            <?php if(isset($log)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1); foreach($log->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo $this->dbase->getUsername($row->user_id); ?></td>
                <td><?php echo $row->kegiatan; ?></td>
                <td><?php echo $row->waktu; ?></td>
                <td width="20"><a href="setting/deleteLog/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}}?>
        </table>
        <p><?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?></p>
</div>
