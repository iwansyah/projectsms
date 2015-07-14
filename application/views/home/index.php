<div>
    <center><h3>Chart SMS</h3></center>
    <hr>
    <script language="text/javascript" src="fchart/FusionCharts.js"></script>
    <center><?php echo renderChartHtml($graphtype, "", $strXML, "FactoryDetailed", $lebar, $tinggi, false, false); ?></center>
    <p></p>
    <center><table border="0">
        <tr>
            <td colspan="5">Total Data <?php #echo $this->session->userdata('user'); ?></td>
        </tr>
        <tr>
            <td>Kotak Masuk </td>
            <td>: <?php echo $inbox; ?></td>
            <td width="100"></td>
            <td>Draf </td>
            <td>: <?php echo $draf; ?></td>
        </tr>
        <tr>
            <td>Pesan Terkirim </td>
            <td>: <?php echo $sent; ?></td>
            <td width="100"></td>
            <td>Kontak </td>
            <td>: <?php echo $phonebook; ?></td>
        </tr>
        <tr>
            <td>Pesan Tersimpan </td>
            <td>: <?php echo $save; ?></td>
            <td width="100"></td>
            <td>Folder </td>
            <td>: <?php echo $cfolder; ?></td>
        </tr>
    </table></center>
</div>