<script type="text/javascript">
    function formval(){
        var f = document.fdraf;
        var nama = f.judul.value;
        
        if(nama===''){
            alert('Judul tidak boleh kosong...!');
            f.judul.focus();
            return false
        }
        else{
            return true;
        }
    }
</script>
<div>
    <h3>Edit Draf</h3>
    <hr>
    <?php if(isset($draf)){foreach($draf->result() as $row){ ?>
    <form name="fdraf" method="post" action="draf/saveData/<?php echo $row->id ?>" onsubmit="return formval()">
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Judul </td>
            <td><input type="text" name="judul" value="<?php echo $row->title ?>" size="35" maxlength="20" max="20"></td>
        </tr>
        <tr>
            <td>Isi Draf </td>
            <td><textarea name="isi" rows="7" cols="35" maxlength="160" max="160"><?php echo $row->content ?></textarea> </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Simpan"></td>
            <td><input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
    </form>
    <?php }}?>
</div>
