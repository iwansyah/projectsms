<script type="text/javascript">
function formValUser(){
    var f = document.fuser;
    var nama = f.nama.value;
    var user = f.user.value;
    var pass = f.pass.value;
    var cpass = f.cpass.value;
    var email = f.email.value;
    var nomor = f.nomor.value;
    var phone_reg = /^([0-9\+\.]+)$/;
    
    if(nama === ''){
        alert('Nama tidak boleh kosong...!');
        f.nama.focus();
        return false;
    }
    else if(user === ''){
        alert('Username tidak boleh kosong...!');
        f.user.focus();
        return false;
    }
    else if(pass === ''){
        alert('Password tidak boleh kosong...!');
        f.pass.focus();
        return false;
    }
    else if(cpass === ''){
        alert('Confirm Password tidak boleh kosong...!');
        f.cpass.focus();
        return false;
    }
    else if(pass !== cpass){
        alert('Password tidak cocok...!');
        f.pass.focus();
        return false;
    }
    else if(email === ''){
        alert('Email tidak boleh kosong...!');
        f.email.focus();
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
    <h3>Tambah User</h3>
    <hr>
    <form name="fuser" method="post" action="user/saveData/add" onsubmit="return formVal();">
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Nama </td>
            <td><input type="text" name="nama" value="" size="35" maxlength="35"></td>
        </tr>
        <tr>
            <td>Username </td>
            <td><input type="text" name="user" value="" size="35" maxlength="35"></td>
        </tr>
        <tr>
            <td>Password </td>
            <td><input type="password" name="pass" value="" size="35" maxlength="35"></td>
        </tr>
        <tr>
            <td>Confirm Password </td>
            <td><input type="password" name="cpass" value="" size="35" maxlength="35"></td>
        </tr>
        <tr>
            <td>Email </td>
            <td><input type="email" name="email" value="" size="35" maxlength="55"></td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td><input type="text" name="nomor" value="" size="35" maxlength="15"></td>
        </tr>
            <td>Akses </td>
            <td>
                <select name="akses">
            <?php if(isset($akses)){foreach($akses->result() as $row){?>
                        <option value="<?php echo $row->id ?>"><?php echo$row->akses ?></option>
            <?php }}?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Simpan"> | <input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
    </form>
</div>
