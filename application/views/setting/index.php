<div class='cssmenu'>
<ul>
   <li class="<?php $url = (($this->uri->segment(2) == 'profile')||($this->uri->segment(2) == 'index') ? 'active':''); echo $url; ?>"><a href='setting/profile'><span>Profile</span></a></li>
   <li class="<?php $url = ($this->uri->segment(2) == 'log' ? 'active':''); echo $url; ?>"><a href='setting/log'><span>Log</span></a></li>
   <?php if($this->session->userdata('akses')==='1'){ ?>
   <li class="<?php $url = (($this->uri->segment(2) == 'akses')||($this->uri->segment(2) == 'aksesMenu') ? 'active':''); echo $url; ?>"><a href='setting/akses'><span>Akses</span></a></li>
   <li class="<?php $url = ($this->uri->segment(2) == 'gammu' ? 'active':''); echo $url; ?>"><a href='gammu'><span>Gammu</span></a></li>
   <li class="<?php $url = (($this->uri->segment(2) == 'sticker')||($this->uri->segment(2) == 'editSticker') ? 'active':''); echo $url; ?>"><a href='setting/sticker'><span>Sticker</span></a></li>
   <?php }?>
</ul>
</div>

<?php 
    if(isset($page)){
        $path = $this->uri->segment(1);
        $path .= '/'.$page;
        $this->load->view($path);
    }
?>