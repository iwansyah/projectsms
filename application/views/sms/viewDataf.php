<div>
    <h3>View Data</h3>
    <hr>
    <form name="saveFolder" method="post" action="sms/updateFolder">
    <table border="0" cellpadding="5" cellspacing="5">
    <?php if(isset($file)){foreach($file->result() as $row){ ?>
        <tr>
            <td>Nama </td>
            <td>: <?php $numb = $this->dbase->getBy('name','pbk',array('number'=>$row->number,'user_id'=>$this->session->userdata('akses')));
                    if($numb === ''){
                            echo $row->number;
                        }
                        else{
                            echo $numb;
                        }
            ?></td>
        </tr>
        <tr>
            <td>Number </td>
            <td>: <?php echo $row->number; ?></td>
        </tr>
        <tr>
            <td>Pesan</td>
            <td>: <?php echo $row->pesan; ?></td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>: <?php echo $row->waktu; ?></td>
        </tr>
        <tr>
            <td width="100">Dari Folder</td>
            <td>: <?php echo $row->table; ?></td>
        </tr>
        <tr>
            <td><input type="button" name="button1" value="Reply" onclick="document.location='sms/newSms/0/<?php echo $row->id_save ?>/saved_folder'"></td>
            <td><input type="submit" name="button2" value="Save Folder"> <select name="id_folder">
                    <?php if(isset($folder)){foreach($folder->result() as $r){?>
                    <option value="<?php echo $r->id ?>.<?php echo $r->name; ?>"><?php echo $r->name; ?></option>
                    <?php }}?>
                </select>
                <input type="hidden" name="id_save" value="<?php echo $row->id_save ?>">
                <input type="hidden" name="tbl" value="saved_folder">
            </td>
        </tr>
    <?php }}?>
    </table>
        </form>
</div>
