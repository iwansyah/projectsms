<script type="text/javascript">
    function formval(){
        var f = document.fdraf;
        var nama = f.judul.value;
        var isi = f.isi.value;
        
        if(nama===''){
            alert('Halaman tidak boleh kosong...!');
            f.judul.focus();
            return false
        }
        else if(isi===''){
            alert('Isi tidak boleh kosong...!');
            f.isi.focus();
            return false
        }
        else{
            return true;
        }
    }
</script>
<div>
    <h3>Edit Sticker</h3>
    <hr>
    <?php if(isset($sticker)){foreach($sticker->result() as $row){ ?>
    <form name="fdraf" method="post" action="setting/saveSticker/<?php echo $row->id ?>" onsubmit="return formval()">
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Halaman </td>
            <td><input type="text" name="page" value="<?php echo $row->page ?>" size="35" maxlength="20" max="20"></td>
        </tr>
        <tr>
            <td>Isi Sticker </td>
            <td><textarea name="isi" rows="7" cols="35" maxlength="160" max="160"><?php echo $row->isi ?></textarea> </td>
        </tr>
        <tr>
            <td>Aktif </td>
            <td><input type="radio" name="aktif" value="yes" <?php $sel = ($row->aktif == 'yes' ? 'checked':''); echo $sel; ?>> Yes <input type="radio" name="aktif" value="no" <?php $sel = ($row->aktif == 'no' ? 'checked':''); echo $sel; ?>> No</td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Simpan"></td>
            <td><input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
    </form>
    <?php }}?>
</div>
