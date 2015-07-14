<div>
    <div>
        <h3 style="float:left;">Data Sticker</h3>
    </div>
    <?php if(isset($mess)){echo $mess;}?>
        <hr style="clear:both;">
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Halaman</th>
                <th>Isi Sticker</th>
                <th>Aktif</th>
                <th colspan="2"></th>
            </tr>
            <?php if(isset($sticker)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1); foreach($sticker->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo $row->page ?></td>
                <td><?php echo $row->isi; ?></td>
                <td><?php if($row->aktif === 'yes'){ ?><a href="setting/stickerAktif/<?php echo $row->id ?>/no" style="color:blue;"><?php echo $row->aktif; ?></a><?php }else{?><a href="setting/stickerAktif/<?php echo $row->id ?>/yes" style="color:red;"><?php echo $row->aktif; ?></a><?php } ?></td>
                <td width="20"><a href="setting/editSticker/<?php echo $row->id; ?>"><img src="images/iconpack/edit_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="setting/deleteSticker/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}}?>
        </table>
</div>