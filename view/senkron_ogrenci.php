
<div class="col-lg-12 text-center">
    <div class="col-lg-12 text-center ">
        <div class="alert alert-primary" role="alert">
            <?php echo $data['mesaj']; ?>
        </div>   
    </div>
</div>


<div class="col-lg-12 text-center">

    <div class="col-lg-5 border text-left float-left">
        <form action="senkron_ogrenci.php?obs_ders_id=<?php echo $data['obs_ders_id']; ?>" method="post">
        <input type="hidden" name="obs_ders_id" value="<?php echo $data['obs_ders_id']; ?>">
        <input type="hidden" name="moodle_ders_id" value="<?php echo $data['moodle_ders_id']; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Bu Dersin Öğrencileri Gibi Aktar(Örnek Alınır)</label>
                <select name="ornek_moodle_ders_id" class="form-control">
                    <?php if($data['moodle_ornek_ders']){ foreach($data['moodle_ornek_ders'] as $omdl){ ?>
                    <option value="<?php echo $omdl['courseid']; ?>"><?php echo $omdl['fullname']; ?> - <?php echo $omdl['shortname']; ?></option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kısa Ad</label>
                <input type="text" name="kisa_ad" value="<?php echo $data['son_kisa_ad']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Açıklama</label>
                <input type="text" name="aciklama" value="OBS OGRENCISI" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">İsim Formatı</label>
                <select name="isim_format" class="form-control">
                    <option value="std">Olduğu gibi bırak</option>
                    <option value="basharfbuyuk">Baş harf büyük</option>
                    <option value="tumubuyuk">Tümü Büyük</option>
                    <option value="tumukucuk">Tümü Küçük</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Soyad Formatı</label>
                <select name="soyad_format" class="form-control">
                    <option value="std">Olduğu gibi bırak</option>
                    <option value="basharfbuyuk">Baş harf büyük</option>
                    <option value="tumubuyuk">Tümü Büyük</option>
                    <option value="tumukucuk">Tümü Küçük</option>
                </select>
            </div>
    </div>
    <div class="col-lg-1 text-left float-left">&nbsp;</div>
    <div class="col-lg-5 border text-left float-left">
        <div class="form-group">
            <label for="exampleInputPassword1">Ülke</label>
            <select name="ulke" class="form-control">
                <option value="TR">Türkiye</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">İl</label>
            <select name="il" class="form-control">
                <option>Karabük</option>
                <option>Ankara</option>
                <option>Kastamonu</option>
                <option>Osmaniye</option>

            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Dil</label>
            <select name="dil" class="form-control">
                <option value="tr">TÜRKÇE</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">KAYDET</button><br>
        </form>
    </div>

</div>