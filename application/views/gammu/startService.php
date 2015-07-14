<div>
    <h4>Start Service :</h4>
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
                    passthru("gammu-smsd -c smsdrc -s",$hasil);
                    #change back to old location
                    chdir($aloc);
                    echo'<input type="button" name="cek" value="sukses" onclick="document.location=\'gammu/service/on/start\'">|<input type="button" name="cek2" value="gagal" onclick="document.location=\'gammu/service/off/start\'">';
                }
                else{
                    echo'<input type="button" name="cek" value="sukses" onclick="document.location=\'gammu/service/on/start\'">|<input type="button" name="cek2" value="gagal" onclick="document.location=\'gammu/service/off/start\'">';
                }
            }
        echo"</pre>";
        }
        else{if(isset($gammu)){echo $gammu;}
    ?>
    <input type="button" name="button1" value="Start Service" onclick="document.location='gammu/startService/run'">
    <?php }?>
</div>
