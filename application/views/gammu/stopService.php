<div>
    <h4>Stop Service :</h4>
    <?php
        if(isset($com)){
        echo"<pre>";
            if($com === 'run'){
                if($_SERVER['SERVER_NAME'] === 'localhost'){
                    #old location
                    $aloc = getcwd();
                    #change old location
                    chdir('bin/');
                    #execute command
                    passthru("gammu-smsd -c smsdrc -k",$hasil);
                    #change back to old location
                    chdir($aloc);
                    echo'<input type="button" name="cek" value="sukses" onclick="document.location=\'gammu/service/off/stop\'">|<input type="button" name="cek2" value="gagal" onclick="document.location=\'gammu/service/on/stop\'">';
                }
                else{
                    echo'<input type="button" name="cek" value="sukses" onclick="document.location=\'gammu/service/off/stop\'">|<input type="button" name="cek2" value="gagal" onclick="document.location=\'gammu/service/on/stop\'">';
                }
            }
        echo"</pre>";
        }
        else{if(isset($gammu)){echo $gammu;}
    ?>
    <input type="button" name="button1" value="Stop Service" onclick="document.location='gammu/stopService/run'">
    <?php }?>
</div>
