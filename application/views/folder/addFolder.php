<div>
    <h3>Folder</h3>
    <hr>
    <table class="cust">
            <tr>
                <th>ID</th>
                <th>Nama Folder</th>
                <th colspan="2"></th>
            </tr>
            <?php if(isset($folder)){$no = ($this->uri->segment(4)=='' ? '1':$this->uri->segment(4)+1);($this->uri->segment(4)=='' ? '5':$this->uri->segment(4)+1);foreach($folder->result() as $row){?>
            <tr class="<?php if($no%2 == 0){echo"alt";} ?>">
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->name; ?></td>
                <td width="20"><span style="cursor:pointer;" onclick="javascript:fgroup.nama.value='<?php echo $row->name ?>';fgroup.idf.value='<?php echo $row->id; ?>'"><img src="images/iconpack/edit_16x16.gif" alt="edit"></span></td>
                <td width="20"><a href="folder/deleteData/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="images/iconpack/delete_16x16.gif" alt="hapus"></a></td>
            </tr>
        <?php $no++; }}?>
        </table>
        <?php if($total>5){echo "Halaman : ".$this->pagination->create_links();} ?>
    
    <form name="fgroup" method="post" action="folder/saveData">
    <br><?php if(isset($mess)){echo $mess;} ?>
        <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Folder</td>
            <td>
                <input type="hidden" name="idf" value="" size="1" readonly="readonly">
                <input type="text" name="nama" value="" size="35">
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Simpan"></td>
            <td><input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
        </form>
</div>
