<div>
    <h4>Cek Pulsa :</h4>
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
                    if(passthru("gammu getussd ".$code,$hasil)){
                        echo word_wrap($hasil);
                    }
                    #change back to old location
                    chdir($aloc);
                }
            }
        echo"</pre>";
        }
        else{
    ?>
    <p align="left"><input type="button" name="button1" value="Cek Pulsa" onclick="document.location='gammu/cekPulsa/run'"></p>
    <?php }?>
</div>
