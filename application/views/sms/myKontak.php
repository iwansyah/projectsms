<base href="<?php echo base_url() ?>">
<link rel="stylesheet" href="css/style.css" type="text/css">
<div>
    <div>
        <h3 style="float:left;">Data Kontak</h3><span style="float:right;margin-top:25px;"></span>
    </div>
    <?php if(isset($mess)){echo $mess;}?>
        <hr style="clear:both;">
        <script type="text/javascript">
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
            function oper(i){
                window.opener.document.fsms.nomor.value = i;
                self.close();
            }
        </script>
        <form name="fcari" method="post" action="sms/cariKontak/" onsubmit="return val()"> 
            <p>Cari : <input type="text" name="cari" value=""> <input type="image" src="images/iconpack/zoom_16x16.gif" alt="cari"></p>
        </form>
        <form name="fkontak">
        <table class="cust">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th colspan="3"></th>
            </tr>
            <?php if(isset($kontak)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1); foreach($kontak->result() as $row){ ?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $no; ?></td>
                <td><?php echo $row->name; ?></td>
                <td name="mynumb<?php echo $no; ?>"><?php echo $row->number; ?></td>
                <td width="20"><span style="color:blue;cursor:pointer;" onclick="return oper('<?php echo $row->number; ?>')"><img src="images/iconpack/add_16x16.gif" alt="kirim pesan"></span></td>
            </tr>
            <?php $no++;}}?>
        </table>
        </form>
        <p><?php if(isset($total)){if($total>5){echo "Halaman : ".$this->pagination->create_links();}} ?></p>
</div>
