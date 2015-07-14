<div>
    <h4>Detect Phone :</h4>
    <?php
        if(isset($com)){
        echo"<pre id='result'>";
            if($com === 'run'){
                if($_SERVER['SERVER_NAME'] === 'localhost'){
                    #old location
                    $aloc = getcwd();
                    #change old location
                    chdir('bin/');
                    #execute command
                    passthru("gammu identify",$hasil);
                    #change back to old location
                    chdir($aloc);
                }
            }
        echo"</pre>";
        }
        else{
    ?>
    <p align="left"><input type="button" name="button1" value="Tes Koneksi" onclick="document.location='gammu/tesKoneksi/run'"></p>
    <?php }?>
</div>
