<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <title>Login Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="css/login.css" rel="stylesheet">
        <link href="images/png/twitter13.png" rel="shortcut icon" />
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
function formValLog(){
    var f = document.flogin;
    var username = f.username.value;
    var password = f.password.value;
    
    if(username === ''){
        alert('Username tidak boleh kosong...!');
        f.username.focus();
        return false;
    }
    else if(password === ''){
        alert('Password tidak boleh kosong...!');
        f.password.focus();
        return false;
    }
    else{
        return true;
    }
}
</script>
    </head>
    <body>
        <?php #echo base_url(); ?>
        <?php #echo site_url();?>
        <?php #$ses = $this->session->all_userdata();print_r($ses);?>
            <center><?php if(isset($mess)){echo $mess;}?></center>
            <div width="100%">
                <marquee behaviour="right" style="color:white;"><?php if(isset($stick)){echo $stick;} ?></marquee></div>
        <div class="reg">
            <fieldset>
                <legend>Daftar User</legend>
                <form name="fuser" method="post" action="login/newUser/add" onsubmit="return formValUser();">
            <table border="0" cellpadding="5" cellspacing="5">
                <tr>
                    <td>Nama </td>
                    <td>: <input type="text" name="nama" value="" size="30"></td>
                </tr>
                <tr>
                    <td>Username </td>
                    <td>: <input type="text" name="user" value="" size="30"></td>
                </tr>
                <tr>
                    <td>Password </td>
                    <td>: <input type="password" name="pass" value="" size="30"></td>
                </tr>
                <tr>
                    <td>Confirm Password </td>
                    <td>: <input type="password" name="cpass" value="" size="30"></td>
                </tr>
                <tr>
                    <td>Email </td>
                    <td>: <input type="email" name="email" value="" size="30"></td>
                </tr>
                <tr>
                    <td>Nomor HP </td>
                    <td>: <input type="text" name="nomor" value="" size="30"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Daftar"> </td>
                </tr>
            </table>
                </form>
            </fieldset>
        </div>
        <div class="log"><br><br><br><br>
            <fieldset>
                <legend>Login</legend>
                <form name="flogin" method="post" action="login/prsLogin" onsubmit="return formValLog()">
            <table border="0" cellpadding="5" cellspacing="5">
                <tr>
                    <td>Username </td>
                    <td>: <input type="text" name="username" value="" size="30"></td>
                </tr>
                <tr>
                    <td>Password </td>
                    <td>: <input type="password" name="password" value="" size="30"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Login"> </td>
                    <td><input type="submit" name="submit" value="Login as Guest"> </td>
                </tr>
            </table>
                    </form>
            </fieldset>
        </div>
            <div style="float:right;margin-top:20px;margin-right: 100px;">
                <fieldset><legend>Download</legend>
                Download tutorial untuk user <a href="login/downloadDoc/1">here</a> <br>Download user manual untuk developer <a href="login/downloadDoc/2">here</a>
                <br>Download source code aplikasi SMSG <a href="login/downloadDoc/3">here</a> <br> Download Counter : <span style="color:#000000;"><?php if(isset($counter)){echo $counter;} ?></span>
                </fieldset>
            </div>
        <div class="footer">
            <center><table border="0">
                <tr>
                    <td>
                        <img src="images/mailbird.png" width="250" height="250">
                    </td>
                    <td>
                        <h1>SMS Gateway with Gammu</h1>
                        <h3> ver 1.0</h3>
                    </td>
                </tr>
            </table></center>
            </div>
    </body>
</html>
