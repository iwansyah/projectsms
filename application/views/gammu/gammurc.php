<div>
    <h4>Konfigurasi GAMMURC</h4>
    <hr>
    <?php if(isset($mess)){ ?><div style='clear:both;display:block;border:double 2px blue;background-color:#EAF2D3;width:200px;height:20px;padding:5px;'><?php echo $mess?></div><?php }?>
    <form name="gammurc" method="post" action="gammu/gammurc/save"> 
    <table border="0">
        <tr>
            <td>Port</td>
            <td> : <input type="text" name="port" value="<?php if(isset($port)){echo $port;} ?>" size="10"> ex : com16</td>
        </tr>
        <tr>
            <td>Connection</td>
            <td> : <input type="text" name="con" value="<?php if(isset($con)){echo $con;} ?>" size="10"> ex : at115200</td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="simpan" value="Simpan"></td>
        </tr>
    </table>
    </form>
</div>
