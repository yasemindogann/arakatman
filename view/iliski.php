<div class="col-lg-12 text-center">
    <div class="col-lg-6 border text-left">
    <form action="iliski.php?obs_ders_id=<?php echo $data['obs_ders']['id']; ?>" method="post">
    <?php if($data['obs_ders_id']){ ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Ders Adı</label>
        <input type="hidden" name="obs_ad" class="form-control" value="<?php echo $data['obs_ders']['tam_adi']; ?>">
        <input  class="form-control" value="<?php echo $data['obs_ders']['tam_adi']; ?>"  disabled>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Kısa Adı</label>
        <input type="hidden" name="obs_kisa_ad" class="form-control" value="<?php echo $data['obs_ders']['kisa_adi']; ?>">
        <input type="text" class="form-control" value="<?php echo $data['obs_ders']['kisa_adi']; ?>" disabled>
    </div>
    <?php } else { ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Ders Adı</label>
        <input type="text" name="obs_ad" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Kısa Adı</label>
        <input type="text" name="obs_kisa_ad" class="form-control">
    </div>
    <?php } ?>
    <div class="form-group">
        <label for="exampleInputPassword1">Moodle Kısa Ad</label>
        <input type="text" name="moodle_kisa_ad" list="characters" maxlength="50" class="form-control"
         value="<?php echo $data['obs_ders']['moodle_karsiligi']; ?>">
        <datalist id="characters">
            <?php foreach ($data['moodle_dersler'] as $ders){ ?>
                <option value="<?php echo $ders['shortname']; ?>"><?php echo $ders['shortname']; 
                ?> - <?php echo $ders['fullname']; ?></option>
            <?php } ?>
        </datalist>
    </div>
    <button type="submit" class="btn btn-primary">KAYDET</button>
    </form>
    </div>
</div>