<div>
    <h3>View <?php if(isset($tbl)){echo ucfirst($tbl);} ?></h3>
    <hr>
    <form name="saveFolder" method="post" action="sms/savedFolder/">
    <table border="0" cellpadding="5" cellspacing="5">
    <?php if(isset($file)){foreach($file->result() as $row){ ?>
        <tr>
            <td>Nama </td>
            <td>: <?php
                    $num = '';
                    if($tbl==='inbox'){$fnum='SenderNumber'; $num = $row->SenderNumber;}else{$fnum = 'DestinationNumber'; $num = $row->DestinationNumber;}
                    $numb = $this->dbase->getBy('name','pbk',array('number'=>$num,'user_id'=>$this->session->userdata('akses')));
                    if($numb === ''){
                            echo $num;
                        }
                        else{
                            echo $numb;
                        }
            ?></td>
        </tr>
        <tr>
            <td>Number </td>
            <td>: <?php if($tbl==='inbox'){echo $row->SenderNumber;}else{echo $row->DestinationNumber;} ?></td>
        </tr>
        <tr>
            <td>Pesan</td>
            <td>: <?php echo $row->TextDecoded; ?></td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>: <?php if($tbl==='inbox'){echo $row->ReceivingDateTime;}else{echo $row->SendingDateTime;} ?></td>
        </tr>
        <?php if($this->uri->segment(4)==='sentitems'){ ?>
        <tr>
            <td>Status</td>
            <td>: <?php echo $row->Status; ?></td>
        </tr>
        <?php }?>
        <tr>
            <td><input type="button" name="button1" value="Reply" onclick="document.location='sms/newSms/<?php echo $this->dbase->getBy('id_pbk','pbk',array('number'=>$num,'user_id'=>$this->session->userdata('akses'))) ?>'"></td>
            <td><input type="submit" name="button2" value="Save Folder"> <select name="id_folder">
                    <?php if(isset($folder)){foreach($folder->result() as $r){?>
                    <option value="<?php echo $r->id ?>"><?php echo $r->name; ?></option>
                    <?php }}?>
                </select>
                <input type="hidden" name="id_pesan" value="<?php echo $row->ID ?>">
                <input type="hidden" name="tbl" value="<?php echo $tbl ?>">
            </td>
        </tr>
    <?php }}?>
    </table>
        </form>
</div>
