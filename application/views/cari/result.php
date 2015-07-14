<div>
    <div>
        <h3>Hasil Pencarian</h3>
    </div>
        <hr style="clear:both;">
        <?php if(isset($inbox)){if($inbox->num_rows()>0){$no=1; ?>
        <h4>Kotak Masuk</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Isi Pesan</th>
                <th colspan="3"></th>
            </tr>
            <?php foreach($inbox->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>', $row->SenderNumber); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>', $row->TextDecoded); ?></td>
                <td width="20"><a href="sms/viewData/<?php echo $row->ID; ?>/inbox"><img src="images/iconpack/zoom_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="sms/newSms/0/<?php echo $row->ID; ?>/inbox"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="sms/deleteData/<?php echo $row->ID; ?>/inbox" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($outbox)){if($outbox->num_rows()>0){$no=1; ?>
        <h4>Kotak Keluar</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Isi Pesan</th>
                <th colspan="3"></th>
            </tr>
            <?php foreach($outbox->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>', $row->$row->DestinationNumber); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>', $row->TextDecoded); ?></td>
                <td width="20"><a href="sms/viewData/<?php echo $row->ID; ?>/outbox"><img src="images/iconpack/zoom_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="sms/newSms/0/<?php echo $row->ID; ?>/outbox"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="sms/deleteData/<?php echo $row->ID; ?>/outbox" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($sent)){if($sent->num_rows()>0){$no=1; ?>
        <h4>Pesan Terkirim</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Isi Pesan</th>
                <th colspan="3"></th>
            </tr>
            <?php foreach($sent->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>', $row->DestinationNumber); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>', $row->TextDecoded); ?></td>
                <td width="20"><a href="sms/viewData/<?php echo $row->ID; ?>/sentitems"><img src="images/iconpack/zoom_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="sms/newSms/0/<?php echo $row->ID; ?>/sentitems"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="sms/deleteData/<?php echo $row->ID; ?>/sentitems" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($save)){if($save->num_rows()>0){$no=1; ?>
        <h4>Saved Folder</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Isi Pesan</th>
                <th colspan="3"></th>
            </tr>
            <?php foreach($save->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->number); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->pesan); ?></td>
                <td width="20"><a href="sms/viewDataf/<?php echo $row->id_save; ?>"><img src="images/iconpack/zoom_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="sms/newSms/0/<?php echo $row->id_save; ?>/saved_folder"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="sms/deleteData/<?php echo $row->id_save; ?>/saved_folder/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($draf)){if($draf->num_rows()>0){$no=1; ?>
        <h4>Draf</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Pesan</th>
                <th colspan="3"></th>
            </tr>
            <?php foreach($draf->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->title); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->content); ?></td>
                <td width="20"><a href="sms/newSms/0/<?php echo $row->id; ?>/draf"><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="draf/editData/<?php echo $row->id; ?>"><img src="images/iconpack/edit_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="draf/deleteData/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        
        <?php if(isset($pbk)){if($pbk->num_rows()>0){$no=1; ?>
        <h4>Kontak</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th colspan="3"></th>
            </tr>
            <?php foreach($pbk->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->name); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->number); ?></td>
                <td width="20"><a href="sms/newSms/<?php echo $row->id_pbk; ?> "><img src="images/iconpack/mail2_16x16.gif" alt="kirim pesan"></a></td>
                <td width="20"><a href="kontak/editData/<?php echo $row->id_pbk; ?>"><img src="images/iconpack/edit_16x16.gif" alt="edit"></a></td>
                <td width="20"><a href="kontak/deleteData/<?php echo $row->id_pbk; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($fol)){if($fol->num_rows()>0){$no=1; ?>
        <h4>Folder</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Group</th>
                <th colspan="1"></th>
            </tr>
            <?php foreach($fol->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->name); ?></td>
                <td width="20"><a href="kontakGroup/deleteData/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($pbkg)){if($pbkg->num_rows()>0){$no=1; ?>
        <h4>Kontak Group</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Group</th>
                <th colspan="1"></th>
            </tr>
            <?php foreach($pbkg->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->name); ?></td>
                <td width="20"><a href="kontakGroup/deleteData/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
        <?php if(isset($log)){if($log->num_rows()>0){$no=1; ?>
        <h4>LOG</h4>
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Kegiatan</th>
                <th colspan="1"></th>
            </tr>
            <?php foreach($log->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->waktu); ?></td>
                <td><?php echo str_replace($key,'<span style="background-color:yellow;">'.$key.'</span>',$row->kegiatan); ?></td>
                <td width="20"><a href="setting/deleteLog/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
            <?php $no++;}?>
        </table>
        <?php }}?>
</div>
