
<div class="col-lg-12">
    <div class="col-lg-12">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col" colspan="4">OBS SISTEMI DERSLERI</th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ders Adı</th>
                <th scope="col">Kısa Adı</th>
                <th scope="col"></th>
                <th scope="col">Diğer Kısa Ad</th>
                <th scope="col">Kategorisi</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($data['obs_dersler'] as $ders){ ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $ders['tam_adi']; ?></td>
                <td><?php echo $ders['kisa_adi']; ?></td>
                <td><i class="fa fa-arrow"></i></td>
                <td><?php echo $ders['moodle_karsiligi']; ?></td>
                <td><?php echo $ders['kategori']; ?></td>
                <td>
                    <a href="iliski.php?obs_ders_id=<?php echo $ders['id']; ?>">
                        <button class="btn btn-sm btn-info">İlişki Düzenle</button>
                    </a>
                </td>
                <td>
                    <a href="senkron.php?obs_ders_id=<?php echo $ders['id']; ?>">
                        <button class="btn btn-sm btn-warning">Moodle'a Senkronize Et</button>
                    </a>
                </td>
            </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-12">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col" colspan="4">MOODLE DERSLERI</th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ders Adı</th>
                <th scope="col">Kısa Adı</th>
                <th scope="col">Kategorisi</th>
            </tr>
            </thead>
            <tbody>
            <?php $a=1; foreach ($data['moodle_dersler'] as $ders){ ?>
                <tr>
                    <th scope="row"><?php echo $a; ?></th>
                    <td><?php echo $ders['fullname']; ?></td>
                    <td><?php echo $ders['shortname']; ?></td>
                    <td><?php echo $ders['name']; ?></td>
                </tr>
            <?php $a++; } ?>
            </tbody></table> </div>
</div><!-- 12 -->



