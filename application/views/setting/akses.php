<div>
    <div>
        <h3 style="float:left;">Data Akses</h3>
    </div>
    <?php if(isset($mess)){echo $mess;}?>
        <hr style="clear:both;">
        <!--<script type="text/javascript">
            function val(){
                if(document.fcari.cari.value == ''){
                    alert('Form cari tidak boleh kosong...!');
                    document.fcari.cari.focus();
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>
        <form name="fcari" method="post" action="setting/cariAkses/" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>-->
        <table class="cust">
            <tr>
                <th>ID</th>
                <th>Akses</th>
            </tr>
            <?php if(isset($akses)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1); foreach($akses->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><a href="setting/aksesMenu/<?php echo $row->id ?>" style="color:blue;"><?php echo $row->akses; ?></a></td>
            </tr>
            <?php $no++;}}?>
        </table>
        <p><?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?></p>
</div>
