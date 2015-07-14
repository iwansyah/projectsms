<div>
    <h3>My Profile</h3>
    <hr>
    <?php if(isset($profile)){foreach($profile->result() as $row){ ?>
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Nama </td>
            <td>: <?php echo $row->nama ?></td>
        </tr>
        <tr>
            <td>Username </td>
            <td>: <?php echo $row->user ?></td>
        </tr>
        <tr>
            <td>Email </td>
            <td>: <?php echo $row->email ?></td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td>: <?php echo $row->number ?></td>
        </tr>
        <tr>
            <td>Akses </td>
            <td>: <?php echo $akses; ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal Gabung </td>
            <td>: <?php echo $row->waktu; ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Edit" onclick="document.location='setting/profile'"></td>
        </tr>
    </table>
<?php }} if($this->session->userdata('akses') === 3){?>
    <table border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td>Nama </td>
            <td>: <?php echo $this->session->userdata('user'); ?></td>
        </tr>
        <tr>
            <td>Username </td>
            <td>: <?php echo $this->session->userdata('user'); ?></td>
        </tr>
        <tr>
            <td>Email </td>
            <td>: -</td>
        </tr>
        <tr>
            <td>Nomor </td>
            <td>: -</td>
        </tr>
        <tr>
            <td>Akses </td>
            <td>: <?php echo $this->dbase->getBy('akses','akses',array('id'=>$this->session->userdata('akses'))); ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal Gabung </td>
            <td>: -
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Edit" onclick="document.location='setting/profile'"></td>
        </tr>
    </table>
<?php }?>
</div>