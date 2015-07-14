<div>
    <h4>Konfigurasi SMSDRC</h4>
    <hr>
    <?php if(isset($mess)){ ?><div style='clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:200px;height:20px;padding:5px;'><?php echo $mess?></div><?php }?>
    <form name="smsdrc" method="post" action="gammu/smsdrc/save"> 
        <h4>Gammurc</h4>
    <table border="0">
        <tr>
            <td>Port</td>
            <td> : <input type="text" name="port" value="<?php if(isset($port)){echo $port;} ?>" size="10"> ex : com16</td>
        </tr>
        <tr>
            <td>Connection</td>
            <td> : <input type="text" name="con" value="<?php if(isset($con)){echo $con;} ?>" size="10"> ex : at115200</td>
        </tr>
    </table>
        <h4>Database</h4>
    <table border="0">
        <tr>
            <td>User</td>
            <td> : <input type="text" name="user" value="<?php if(isset($user)){echo $user;} ?>" size="10"> ex : myuser</td>
        </tr>
        <tr>
            <td>Password</td>
            <td> : <input type="text" name="pass" value="<?php if(isset($pass)){echo $pass;} ?>" size="10"> ex : mypass</td>
        </tr>
        <tr>
            <td>Database</td>
            <td> : <input type="text" name="db" value="<?php if(isset($db)){echo $db;} ?>" size="10"> ex : mydb</td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="simpan" value="Simpan"></td>
        </tr>
    </table>
    </form>
</div>
