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
        </script>
<div>
    <h3>Pencarian</h3>
    <hr>
    <form name="fcari" method="post" action="cari/result" onsubmit="return val()">
    <input type="text" name="cari" value="" style="width:300px;height:20px;background-color: #B3B4BD;">
    <input type="submit" name="submit" value="CARI" style="height:30px;">
</div>