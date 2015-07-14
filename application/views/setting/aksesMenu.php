<div>
    <div>
        <h3 style="float:left;">Data Akses</h3>
    </div>
        <?php if(isset($mess)){ ?><div style='clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:300px;height:20px;padding:5px;'><?php echo $mess?></div><?php }?>
        <hr style="clear:both;">
        <!--<script type="text/javascript">
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
        <form name="fcari" method="post" action="setting/cariAkses/" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>-->
        <form name="aksesmenu" method="post" action="setting/saveAkses">
        <table class="cust">
            <tr>
                <th>ID</th>
                <th>ID Akses</th>
                <th>Fitur</th>
                <th>Menu</th>
            </tr>
            <?php if(isset($aksesmenu)){$no = 1; foreach($aksesmenu->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $row->id_am; ?></td>
                <td><?php echo $this->dbase->getBy('akses','akses',array('id'=>$row->id_akses)); ?></td>
                <td><select name="fitur<?php echo $no ?>">
                        <option value="0" <?php $ak = ($row->fitur == '0' ? 'selected':''); echo $ak; ?>>None</option>
                        <option value="6" <?php $ak = ($row->fitur == '6' ? 'selected':''); echo $ak; ?>>All</option>
                        <option value="4" <?php $ak = ($row->fitur == '4' ? 'selected':''); echo $ak; ?>>Medium</option>
                        <option value="2" <?php $ak = ($row->fitur == '2' ? 'selected':''); echo $ak; ?>>Low</option>
                    </select>
                    <input type="hidden" name="id_am<?php echo $no ?>" value="<?php echo $row->id_am ?>">
                    <input type="hidden" name="id_akses<?php echo $no ?>" value="<?php echo $row->id_akses ?>">
                </td>
                <td><?php echo $this->dbase->getBy('menu','menu',array('id_m'=>$row->id_m)); ?></td>
            </tr>
            <?php $no++;}}?>
            <input type="hidden" name="byk" value="<?php echo $no; ?>">
        </table>
            <p><input type="submit" name="save" value="Simpan" onclick="return confirm('Anda yakin ingin menyimpannya?')"></p>
            </form>
        <p><?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?></p>
</div>
