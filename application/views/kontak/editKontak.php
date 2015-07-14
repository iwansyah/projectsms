<script type="text/javascript">
    function formval(){
         var f = document.fkontak;
         var nama = f.nama.value;
         var nomor = f.nomor.value;
         var phone_reg = /^([0-9\+\.]+)$/;
         
         if(nama === ''){
             alert('Nama tidak boleh kosong...!');
             f.nama.focus();
             return false;
         }
         else if(nomor === ''){
             alert('Nomor tidak boleh kosong...!');
             f.nomor.focus();
             return false;
        }
        else if(phone_reg.test(nomor)===false){
             alert('Nomor tidak valid...!');
             f.nomor.focus();
             return false;
         }
         else{
             return true;
         }
    }
</script>
<div>
    <h3>Edit Kontak</h3>
    <hr>
        <?php if(isset($kontak)){foreach($kontak->result() as $row){ ?>
    <form name="fkontak" method="post" action="kontak/saveData/<?php echo $row->id_pbk ?>" onsubmit="return formval();">
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Group Kontak </td>
            <td><select name="group">
                    <?php if(isset($group)){foreach($group->result() as $r){ ?>
                    <option value="<?php echo $r->id ?>" <?php $sel = ($r->id==$row->group_id ? "selected":" ");echo $sel; ?>><?php echo $r->name ?></option>
                    <?php }}?>
                </select><a href="kontakGroup/addData"> <img src="images/iconpack/add_16x16.gif"> Add Group</a>
            </td>
        </tr>
        <tr>
            <td>Nama </td>
            <td><input type="text" name="nama" value="<?php echo $row->name; ?>" size="35"></td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td><input type="text" name="nomor" value="<?php echo $row->number; ?>" size="35"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Simpan"></td>
            <td><input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
    </form>
        <?php }}?>
</div>
