
<?php

header("Content-type: text/xml");
//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');


$data = array(

    'obs_dersler'    => $sys->obs_dersler(),//obs_dersler veritabanından dersler çeker

);

?>

<?php if($data['obs_dersler']){ ?>
<LESSONS>
    <?php foreach($data['obs_dersler'] as $ders){ ?>
    <LESSON>
        <NAME><?php echo $ders['tam_adi']; ?></NAME>
        <SHORTNAME><?php echo $ders['kisa_adi']; ?></SHORTNAME>
        <STUDENTDS>
        <?php $ogrenciler = $sys->obs_ogrenciler($ders['kisa_adi']); ?>
            <?php if($ogrenciler){ foreach($ogrenciler as $ogrenci){ ?>
            <STUDENT>
                <USERNAME><?php echo $ogrenci['username']; ?></USERNAME>
                <NAME><?php echo $ogrenci['name']; ?></NAME>
                <LASTNAME><?php echo $ogrenci['lastname']; ?></LASTNAME>
                <EMAIL><?php echo $ogrenci['mail']; ?></EMAIL>
            </STUDENT>
            <?php }} ?>
        </STUDENTDS>
    </LESSON>
    <?php }//foreach x ?>
</LESSONS>
<?php }//if x ?>