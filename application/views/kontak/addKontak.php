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
    <h3>Tambah Kontak</h3>
    <hr>
    <form name="fkontak" method="post" action="kontak/saveData" onsubmit="return formval();">
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Group Kontak </td>
            <td><select name="group">
                    <?php if(isset($group)){foreach($group->result() as $r){ ?>
                    <option value="<?php echo $r->id ?>"><?php echo $r->name ?></option>
                    <?php }}?>
                </select><a href="kontakGroup/addData"> <img src="images/iconpack/add_16x16.gif"> Add Group</a>
            </td>
        </tr>
        <tr>
            <td>Nama </td>
            <td><input type="text" name="nama" value="" size="35"></td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td><input type="text" name="nomor" value="" size="35"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Simpan"></td>
            <td><input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
    </form>
</div>
