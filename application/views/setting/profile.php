<script type="text/javascript">
function formVal(){
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
    else if(cpass === ''){
        alert('Password lama tidak boleh kosong...!');
        f.cpass.focus();
        return false;
    }
    else if(pass === ''){
        alert('Password baru tidak boleh kosong...!');
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
    <h3>Edit Profile</h3>
    <hr>
    <?php if(isset($mess)){echo $mess;} ?>
    <?php if(isset($profile)){foreach($profile->result() as $row){ ?>
    <form name="fuser" method="post" action="setting/saveData/<?php echo $row->id ?>/<?php echo $row->id_pbk ?>" onsubmit="return formVal();">
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Nama </td>
            <td><input type="text" name="nama" value="<?php echo $row->nama ?>" size="35"></td>
        </tr>
        <tr>
            <td>Username </td>
            <td><input type="text" name="user" value="<?php echo $row->user ?>" size="35"></td>
        </tr>
        <tr>
            <td>Password Lama </td>
            <td><input type="text" name="cpass" value="" size="35"></td>
        </tr>
        <tr>
            <td>Password Baru </td>
            <td><input type="text" name="pass" value="" size="35"></td>
        </tr>
        <tr>
            <td>Email </td>
            <td><input type="text" name="email" value="<?php echo $row->email ?>" size="35"></td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td><input type="text" name="nomor" value="<?php echo $row->number ?>" size="35"></td>
        </tr>
        <?php if($this->session->userdata('akses')==='1'){?>
        <tr>
            <td>Akses </td>
            <td>
                <select name="akses">
            <?php if(isset($akses)){foreach($akses->result() as $r){?>
                        <option value="<?php echo $r->id; ?>" <?php $sel = ($r->id==$row->id_akses ? "selected":" ");echo $sel; ?>><?php echo $r->akses; ?></option>
            <?php }}?>
                </select>
            </td>
        </tr>
        <?php }else{?>
        <input type="hidden" name="akses" value="<?php echo $this->session->userdata('akses'); ?>">
        <?php }?>
        <tr>
            <td><input type="submit" name="submit" value="Simpan" onclick="return confirm('Anda yakin ingin mengubahnya...?');"></td>
        </tr>
    </table>
    </form>
<?php }}if($this->session->userdata('akses') === 3){?>
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Nama </td>
            <td>: <?php echo $this->session->userdata('user'); ?></td>
        </tr>
        <tr>
            <td>Username </td>
            <td>: <?php echo $this->session->userdata('user'); ?></td>
        </tr>
        <tr>
            <td>Email </td>
            <td>: -</td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td>: -</td>
        </tr>
        <tr>
            <td>Akses </td>
            <td>: <?php echo $this->dbase->getBy('akses','akses',array('id'=>$this->session->userdata('akses'))); ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal Gabung </td>
            <td>: -
            </td>
        </tr>
    </table>
<?php }?>
</div>