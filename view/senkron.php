<form action="senkron.php?obs_ders_id=<?php echo $data['obs_ders_id']; ?>" method="post">
    <table align="center" width="63%">
        <tr>
            <td colspan="3">
                <small>Bilgi Mesajı</small>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="alert alert-primary" role="alert">
                    <?php echo $data['mesaj']; ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <small>Moodle Kategorisini Seçiniz</small>
            </td>
            <td>
                <small>Ders Aktarım İşlemine Başla</small>
            </td>
            <td>
                <small>Öğrenci Aktarım İşlemine Başla</small>
            </td>
         </tr>
        <tr>
            <td width="50%">
                <select name="kategori_id" class="form-control">
                    <?php foreach ($data['moodle_kategoriler'] as $ktg) { ?>
                        <option value="<?php echo $ktg['id']; ?>"><?php echo $ktg['name']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <button type="submit" class="btn btn-success btn-block">Dersi Senkronize Et</button>
            </td>
            <td>
                <a href="senkron_ogrenci.php?obs_ders_id=<?php echo $data['obs_ders_id']; ?>">
                    <div class="btn btn-warning btn-block">Öğrencileri Senkronize Et</div>
                </a>
            </td>
         </tr>
      
    </table>
</form>


