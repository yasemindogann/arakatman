<style>
h1{
    color:#333;
    text-align:center;
    margin-top:10px;
}

.kare_btn{
    width: 199px;
    height: 199px;
    padding-top:33px;
    text-align: center;
    margin:15px;
}

.buyuk{
    font-size: 33pt;
    font-weight: bold;
}

</style>

<h3 class="text-center"><strong>MOODLE ARAKATMAN</strong></h3>
<hr>
<a href="iliski.php" class="btn btn-success kare_btn">
    <b>DERS İLİŞKİSİ ATA</b>
    <hr>
    <small>Dışardan alıncak bir ders kısa adının MOODLE'da hangi kısa adlı derse karşılık geleceğini tanımlamak için kullanılır</small>
</a>

<a href="iliskiler.php" class="btn btn-success kare_btn">
    <b>İLİŞKİLER</b>
    <hr>
    <small>Dışardan alıncak kısa adın MOODLE'da hangi kısa adlı derse karşılık geldiğini görüntülemek için kullanılır.</small>
</a>

<a href="dersler.php" class="btn btn-success kare_btn">
    <b>DERSLER</b>
    <hr>
    <small>Dışardan alıncak kısa adın MOODLE'da hangi kısa adlı derse karşılık geldiğini görüntülemek için kullanılır.</small>
</a>

<a href="ogrenciler.php" class="btn btn-success kare_btn">
    <b>ÖĞRENCİLER</b>
    <hr>
    <small>MOODLE'da kayıtlı öğrencileri gösterir</small>
</a>

<div class="btn btn-secondary kare_btn" style="padding-top:13px;">
    <b>MOODLE DERSLER</b>
    <hr>
    <p class="buyuk"><?php echo $data['moodle_dersler']; ?></p><small>Adet</small>
</div>


<div class="btn btn-secondary kare_btn" style="padding-top:13px;">
    <b>MOODLE ÖĞRENCİLER</b>
    <hr>
    <p class="buyuk"><?php echo $data['moodle_ogrenciler']; ?></p><small>Adet</small>
</div>

<hr>

<a href="xml_tanimla.php" class="btn btn-warning kare_btn">
    <b>XML TANIMLA</b>
    <hr>
    <small>Aktarım işlemlerinin yapılması için dışarıdan gönderilecek olan XML linkinin tanımlamak için kullanılır.</small>
</a>

<a href="default.xml" class="btn btn-warning kare_btn">
    <b>ÖRNEK XML</b>
    <hr>
    <small>Dış sistemden gönderilmesi gereken XML çıktısı örneği</small>
</a>

<a href="xml_aktar.php" class="btn btn-warning kare_btn">
    <b>XML AKTAR</b>
    <hr>
    <small>Dış sistemden gelen XML verisini işlem için içe aktar</small>
</a>

<hr>
<a onclick="return confirm('Bu işlem yapılsın mı ?');" href="xml_aktar.php?ders_temizle=1" class="btn btn-danger kare_btn">
    <b>DERSLERi TEMİZLE</b>
    <hr>
    <small>İçe aktarılmış DERSLERi arakatman önbelleğinden siler</small>
</a>

<a onclick="return confirm('Bu işlem yapılsın mı ?');" href="xml_aktar.php?ogrenci_temizle=1" class="btn btn-danger kare_btn">
    <b> ÖĞRENCİLERi TEMİZLE</b>
    <hr>
    <small>İçe aktarılmış ÖĞRENCİLERİ arakatman önbelleğinden siler</small>
</a>







