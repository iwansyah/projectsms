<style type="text/css">
.actived a{
    color:black;
}
.divm{
    margin:5px;
}
.divl{
    float:left;
    margin:5px 0 5px 0;
    width:120px;
    font-size: 14px;
    padding-left: 10px;
    border-right: 2px black dashed;
}
.divr{
    float:left;
    margin:5px 0 5px 0;
    width:500px;
    font-size: 14px;
    padding-left: 10px;
}
.divl ul{
    list-style-type: circle;
}
.divl li{
    list-style-type: square;
}
</style>
<div class="divm">
    <div class="divl">
        <ul>
            <li style="list-style-type:circle;">Config</li>
            <ul style="padding-left:5px;">
                <li class="<?php $url = ($this->uri->segment(2) == 'gammurc' ? 'actived':''); echo $url; ?>"><a href="gammu/gammurc">Gammurc</a></li>
                <li class="<?php $url = ($this->uri->segment(2) == 'smsdrc' ? 'actived':''); echo $url; ?>"><a href="gammu/smsdrc">Smsdrc</a></li>
            </ul>
            <p></p>
            <li style="list-style-type:circle;">Service</li>
            <ul style="padding-left:5px;">
                <li class="<?php $url = ($this->uri->segment(2) == 'tesKoneksi' ? 'actived':''); echo $url; ?>"><a href="gammu/tesKoneksi">Tes Koneksi</a></li>
                <li class="<?php $url = ($this->uri->segment(2) == 'cekPulsa' ? 'actived':''); echo $url; ?>"><a href="gammu/cekPulsa">Cek Pulsa</a></li>
            </ul>    
                <p></p>
            <li style="list-style-type:circle;">Service Gammu</li>
            <ul style="padding-left:5px;">
                <li class="<?php $url = ($this->uri->segment(2) == 'addService' ? 'actived':''); echo $url; ?>"><a href="gammu/addService">Install Service</a></li>
                <li class="<?php $url = ($this->uri->segment(2) == 'startService' ? 'actived':''); echo $url; ?>"><a href="gammu/startService">Start Service</a></li>
                <li class="<?php $url = ($this->uri->segment(2) == 'stopService' ? 'actived':''); echo $url; ?>"><a href="gammu/stopService">Stop Service</a></li>
                <li class="<?php $url = ($this->uri->segment(2) == 'unService' ? 'actived':''); echo $url; ?>"><a href="gammu/unService">Uninstall Service</a></li>
            
            </ul>
        </ul>
    </div>
    <div class="divr">
        <?php 
            if(isset($rights)){
                $path = $this->uri->segment(1);
                $path .= '/'.$rights;
                $this->load->view($path);
            }
            else{
                echo "Gammu Settings";
            }
        ?>
    </div>
</div>

