<?php
class System {

    public $db_moodle;//veritabanı bağlantısını tutar
    public $db_arakatman;//veritabanı bağlantısını tutar

    function __construct(){ //Class cağırılınca otomatik olarak çalışır fonksiyon

       
        $this->baglan_moodle_sistemi();
        $this->baglan_arakatman_sistemi();
    }

    public function baglan_moodle_sistemi(){

        $host = MOODLE_HOST;
        $dbname = MOODLE_DB_NAME;
        $user = MOODLE_DB_USER;
        $pass = MOODLE_DB_PASS;

        try {
            $this->db_moodle = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", "{$user}", "{$pass}");
            $this->db_moodle->query("SET NAMES 'utf8'");
            $this->db_moodle->query("SET CHARACTER SET utf8");
            $this->db_moodle->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");
        } catch ( PDOException $e ){
            print $e->getMessage();
        } 
    }

    public function baglan_arakatman_sistemi(){

        $host = HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        try {
            $this->db_arakatman = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", "{$user}", "{$pass}");
            $this->db_arakatman->query("SET NAMES 'utf8'");
            $this->db_arakatman->query("SET CHARACTER SET utf8");
            $this->db_arakatman->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");
            $this->db_arakatman->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        } catch ( PDOException $e ){
            print $e->getMessage();
        } 
    }

    public function obs_dersler_kisa_addan($obs_kisa_ad=false){
       
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ders` WHERE kisa_adi=?");//Id istenen dersler
            $cek->execute(array($obs_kisa_ad));
            $array = $cek->fetchAll(PDO::FETCH_ASSOC);

            if(isset($array[0])){
                return $array[0];
            } else {
                return false;
            }
        
    }

    public function obs_dersler($obs_ders_id=false){

        if($obs_ders_id){//ders id gönderilmişse sadece gönderilden ID nin dersini çek
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ders` WHERE id=?");//Id istenen dersler
            $cek->execute(array($obs_ders_id));
        } else {
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ders`");//obsdeki dersler
            $cek->execute();
        }
        
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);


       


        foreach ($array as $key => $val){
            #$array[$key]['deneme'] = 2; //arraya 2 değerinde yeni deneme adında değerler oluşturur.
            $karsilik_gelen_ders = $this->moodle_ders_karsiligi_bul($val['kisa_adi']);//Arakatman veritanında dersin kısa adı var mı araştır

            $array[$key]['moodle_karsiligi'] = $karsilik_gelen_ders['moodle_kisa_ad'];//eğer varsa array elemanın içine bu kısa adı ekle
        }

        //$this->pre($array);
        return $array;

    }//fnk obs dersler x

    
    public function obs_ogrenciler($kisa_adi=false){

        if($kisa_adi){//ders id gönderilmişse sadece gönderilden ID nin dersini çek
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ogrenci` WHERE ders_kisa_adi=?");//Id istenen dersler
            $cek->execute(array($kisa_adi));
        } else {
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ogrenci`");//obsdeki dersler
            $cek->execute();
        }
        
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);
        return $array;

    }//fnk obs ogrenciler x


    public function ders_iliskileri($ara=false){
        if($ara){
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ders_baginti` WHERE obs_kisa_ad LIKE ? OR moodle_kisa_ad LIKE ? OR obs_adi LIKE ? OR moodle_adi LIKE ? GROUP BY moodle_kisa_ad");
            $cek->execute(array('%'.$ara.'%','%'.$ara.'%','%'.$ara.'%','%'.$ara.'%'));
        } else {
            $cek = $this->db_arakatman->prepare("SELECT * FROM `ders_baginti` GROUP BY moodle_kisa_ad");
            $cek->execute();
        }
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);

        $veriler = array();

        foreach($array as $val){
            $veriler[] = array(
                'ders' => $val['moodle_kisa_ad'],
                'ders_adi' => $val['moodle_adi'],
                'alt_elemanlari' => $this->ders_iliskileri_alt_bul($val['moodle_kisa_ad']),
            );
        }//foreach x 

        return $veriler;

    }//fnk ders_iliskileri x


    public function ders_iliskileri_alt_bul($gelen_kisa_ad){
        
        $cek = $this->db_arakatman->prepare("SELECT obs_kisa_ad,obs_adi FROM `ders_baginti` WHERE moodle_kisa_ad = ?");
        $cek->execute(array($gelen_kisa_ad));
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);
        return $array;

    }//fnk moodle dersler x

    public function moodle_ders_karsiligi_bul($gelen_kisa_ad){
        $cek = $this->db_arakatman->prepare("SELECT * FROM `ders_baginti` WHERE obs_kisa_ad = ?");
        $cek->execute(array($gelen_kisa_ad));
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);
        //$ksayisi = $cek->rowCount();//Kayıt sayısını verir
        if(isset($array[0])){
            return $array[0];
        } else {
            return false;
        }
    }//fnk moodle dersler x

    public function arakatman_karsilik_guncelle($obs_kisa_ad,$moodle_kisa_ad,$obs_ad){
        
        $tabloda_var_mi = $this->moodle_ders_karsiligi_bul($obs_kisa_ad);//BU KISA AAD DAHA ÖNCE DERS BAGINTILARI TABLOSUNDA VAR MI BAKALIM
        
        $moodle = $this->moodle_dersler($moodle_kisa_ad);
       

        if(isset($moodle[0]['fullname'])){
            $moodle_adix = $moodle[0]['fullname'];
        } else {
            $moodle_adix = $obs_ad;
        }
        

        if($tabloda_var_mi){ //karşlık tablosunda varsa güncelle
            $guncelle= $this->db_arakatman->prepare("UPDATE `ders_baginti` SET moodle_kisa_ad=?,moodle_adi=? WHERE obs_kisa_ad=?");
            $guncelle->execute(array($moodle_kisa_ad,$moodle_adix,$obs_kisa_ad));
        } else {//karşlık tablosunda yoksa ekle
            $ekle = $this->db_arakatman->prepare("INSERT INTO `ders_baginti` (moodle_kisa_ad,moodle_adi,obs_kisa_ad,obs_adi) VALUES (?,?,?,?)");
            $ekle->execute(array($moodle_kisa_ad,$moodle_adix,$obs_kisa_ad,$obs_ad));
        }
        
    }

    public function moodle_ders_ekle($obs_ders,$kategori_id){
        
        #MOODLE KARDILIGI TANIMLANMIŞSA
        if($obs_ders['moodle_karsiligi']){
            $kisa_adi_vt = $obs_ders['moodle_karsiligi'];//moodle karsılıgı varsa kısa adı o olarak tanımla bunu kısa_ad_vt ye atadık
        } else {
            $kisa_adi_vt = $obs_ders['kisa_adi'];//karsılık yoksa dersin gercek kısa adını al moodle derslere bak orada bu kısa ad yoksa ekleme yap varsa ekleme bunu kısa_ad_vt ye atadık
        }

        $ders = $this->moodle_dersler($kisa_adi_vt); //Son tanımlanan kısa ada göre moodle ye bak o kısa adla ders var mı 
        
        $mesaj = 'işlem başarısız oldu!';
        if(isset($ders[0])){ //eğer moodle de o kısa adla ders varsa dersi ekleme
            //ÖĞRENCİ EKLEME FONKSİYONU
            $data['mesaj'] = 'BU DERS ZATEN MOODLE\'DE VAR'; 
            $data['moodle_ders_id'] = $ders[0]['id'];

        } else { //eğer moodle de o kısa adla ders yoksa ekle
            
            $ekle = $this->db_moodle->prepare("INSERT INTO `mdl_course` 
            (sortorder,category,summaryformat,fullname,shortname,format,visible,visibleold,startdate,enddate,timecreated,timemodified,cacherev) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $eklenecekler = array('30015',$kategori_id,'1',$obs_ders['tam_adi'],$kisa_adi_vt,'weeks','1','1',time(),time()+60*60*24*30*12*360,time(),time()+20,time()+30);
            $ekle->execute($eklenecekler);
            
            $data['mesaj'] = ' DERS MOODLE\'A EKLENDİ'; 
            $data['moodle_ders_id'] = $this->db_moodle->lastInsertId();


        }

        return $data;
        
    }

    public function moodle_ogrenci_ekle_baslat($data=array()){
        
        $obs_ders_id = $data['obs_ders_id'];
        $kaydet_id = $data['moodle_ders_id'];

        $ornek_id = $data['ornek_moodle_ders_id'];

        $kayit_enroll = $this->moodle_ornek_ders_cek($kaydet_id);
        if(isset($kayit_enroll[0]['id']) AND $kayit_enroll[0]['id']!=''){
            $kaydet_enrol_id = $kayit_enroll[0]['id'];
            $role_id = $kayit_enroll[0]['roleid'];
        }

        if(empty($kayit_enroll[0])){//daha önce bir enrol yapısı olusmadıysa olustur
            
            $ornek_enroll = $this->moodle_ornek_ders_cek($ornek_id);
            $role_id = $ornek_enroll[0]['roleid'];
            
            //İLK AŞAMA ÖRNEK DERS GİBİ BİR ENROL OLUŞTUR
            $ekle1 = $this->db_moodle->prepare("INSERT INTO `mdl_enrol` (`enrol`,`status`,`courseid`,`sortorder`,`roleid`,`timecreated`,`timemodified`)VALUES (?,?,?,?,?,?,?)");
            $ekle1->execute(array(
                'manual',
                0,
                $kaydet_id,
                0,
                $ornek_enroll[0]['roleid'],
                time(),
                time(),
            ));

            $kaydet_enrol_id = $this->db_moodle->lastInsertId();
            
        }

        $eklenen_ogrenciler = '';

        $obs_ogrenciler = $this->obs_ogrenciler($data['kisa_ad']);//obs ogrencilerini cek

        foreach ($obs_ogrenciler as $ogr){

            switch ($data['isim_format']) {
                case 'basharfbuyuk':
                    $son_isim = ucfirst($ogr['name']);
                break;
                case 'tumukucuk':
                    $son_isim = strtolower($ogr['name']);
                break;
                case 'tumubuyuk':
                    $son_isim = strtoupper($ogr['name']);
                break;
                case 'std':
                    $son_isim = $ogr['name'];
                break;
            
            }
            switch ($data['soyad_format']) {
                case 'basharfbuyuk':
                    $son_soyad = ucfirst($ogr['lastname']);
                break;
                case 'tumukucuk':
                    $son_soyad = strtolower($ogr['lastname']);
                break;
                case 'tumubuyuk':
                    $son_soyad = strtoupper($ogr['lastname']);
                break;
                case 'std':
                    $son_soyad = $ogr['lastname'];
                break;
            
            }

            $eklenen_ogrenciler .= $son_isim.' '.$son_soyad.'<br>';

            $veri = array(
                'username'      => $ogr['username'],
                'firstname'     => $son_isim,
                'lastname'      => $son_soyad,
                'email'         => $ogr['mail'],
                'description'   => $data['aciklama'],
                'city'          => $data['il'],
                'country'       => $data['ulke'],
                'lang'          => $data['dil'],
                'mnethostid'    => 1,
            );

            $user_id = $this->moodle_ogrenci_ekle($veri);

            #ÖĞRENCİ VAR MI BAK
            $cek = $this->db_moodle->prepare("SELECT COUNT(id) FROM `mdl_user_enrolments` WHERE userid = ? AND enrolid=?");
            $cek->execute(array($user_id,$kaydet_enrol_id));
            $array = $cek->fetchAll(PDO::FETCH_ASSOC);
            $sayi = $array[0]['COUNT(id)'];

            #ÖĞRENCİ YOKSA KAYDET
            if($sayi < 1){
                $ekle2 = $this->db_moodle->prepare("INSERT INTO `mdl_user_enrolments` (`status`,`enrolid`,`userid`,`modifierid`,`timecreated`,`timemodified`)VALUES (?,?,?,?,?,?)");
                $ekle2->execute(array(
                    '0',
                    $kaydet_enrol_id,
                    $user_id,
                    2,
                    time(),
                    time(),
                ));
            }//if sayi x


            #ÖĞRENCİ VAR MI BAK
            $cek = $this->db_moodle->prepare("SELECT COUNT(id) FROM `mdl_role_assignments` WHERE userid = ? AND roleid=?");
            $cek->execute(array($user_id,$role_id));
            $array = $cek->fetchAll(PDO::FETCH_ASSOC);
            $sayi = $array[0]['COUNT(id)'];

            #ÖĞRENCİ YOKSA KAYDET
            if($sayi < 1){

                $ekle2 = $this->db_moodle->prepare("INSERT INTO `mdl_role_assignments` (`roleid`,`contextid`,`userid`,`timemodified`,`modifierid`)VALUES (?,?,?,?,?)");
                $ekle2->execute(array(
                    $role_id,
                    85,
                    $user_id,
                    time(),
                    2
                ));

            }//if sayi x


        }//foreach x


       

        return "EKLENEN ÖĞRENCİLER <br><b>".$eklenen_ogrenciler.'</b>';
    }

    public function moodle_ogrenci_ekle($data = array()){

        $cek = $this->db_moodle->prepare("SELECT * FROM `mdl_user` WHERE email = ?");
        $cek->execute(array($data['email']));
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);

        if(!isset($array[0]['email'])){
        
            $ekle = $this->db_moodle->prepare("INSERT INTO `mdl_user` (`username`,`firstname`,`lastname`,`email`,`description`,`city`,`country`,`lang`,`mnethostid`)VALUES (?,?,?,?,?,?,?,?,?)");

            $ekle->execute(array(
                $data['username'],
                $data['firstname'],
                $data['lastname'],
                $data['email'],
                $data['description'],
                $data['city'],
                $data['country'],
                $data['lang'],
                $data['mnethostid'],
            ));

            $user_id = $this->db_moodle->lastInsertId();

        } else {
            $user_id = $array[0]['id'];
        }//öğrenci yoksa ekle

        return $user_id;

    }

    public function moodle_dersler($kisa_ad=false){

        if($kisa_ad==false){ //Parametre gönderilmediyse tüm dersleri çek
            $cek = $this->db_moodle->prepare("SELECT mdl_course.*,mdl_course_categories.name FROM `mdl_course` LEFT JOIN mdl_course_categories ON mdl_course.category=mdl_course_categories.id WHERE mdl_course.summaryformat > ?");
            $cek->execute(array(0));
        } else {//Parametre gönderildiyse sadece o kısa ada eşit olan dersi çek
            $cek = $this->db_moodle->prepare("SELECT mdl_course.*,mdl_course_categories.name FROM `mdl_course` LEFT JOIN mdl_course_categories ON mdl_course.category=mdl_course_categories.id WHERE mdl_course.summaryformat > ? AND mdl_course.shortname = ?");
            $cek->execute(array(0,$kisa_ad));
        }

        $array = $cek->fetchAll(PDO::FETCH_ASSOC);

        return $array;

    }//fnk moodle dersler x

    public function moodle_dersler_say(){

        $cek = $this->db_moodle->prepare("SELECT COUNT(id) FROM `mdl_course` WHERE summaryformat > ?");
        $cek->execute(array(0));
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);

        return $array[0]['COUNT(id)'];

    }//fnk moodle dersler x

    public function moodle_kategoriler($id=false){

        if($id){ //Parametre gönderilmediyse tüm dersleri çek
            $cek = $this->db_moodle->prepare("SELECT id,name FROM `mdl_course_categories` WHERE id = ?");
            $cek->execute(array($id));
        } else {//Parametre gönderildiyse sadece o kısa ada eşit olan dersi çek
            $cek = $this->db_moodle->prepare("SELECT id,name FROM `mdl_course_categories` ORDER BY id DESC");
            $cek->execute();
        }

        $array = $cek->fetchAll(PDO::FETCH_ASSOC);

        return $array;

    }//fnk moodle dersler x

    public function moodle_ogrenciler(){

        $cek = $this->db_moodle->prepare("SELECT * FROM `mdl_user`");
        $cek->execute();
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);


        return $array;

    }

    public function moodle_ogrenciler_say(){

        $cek = $this->db_moodle->prepare("SELECT COUNT(id) FROM `mdl_user`");
        $cek->execute();
        $array = $cek->fetchAll(PDO::FETCH_ASSOC);
        return $array[0]['COUNT(id)'];
    }

    //ÖĞRENCİLERİ KAYDETMESİ İÇİ MOODLE DB YAPISINDA UYGUN ALANLARIN HANGİ KURSA GÖRE EKLENECEĞİNİ BULMAK İÇİN
    public function moodle_ornek_ders_cek($id=false){

        if($id==false){
            $cek = $this->db_moodle->prepare("SELECT courseid,mdl_course.fullname,mdl_course.shortname FROM `mdl_enrol` LEFT JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id ORDER BY mdl_enrol.id DESC");
            $cek->execute();
            $array = $cek->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $cek = $this->db_moodle->prepare("SELECT * FROM `mdl_enrol` WHERE courseid = ?");
            $cek->execute(array($id));
            $array = $cek->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;

    }

    public function obs_ders_ekle($tam_ad,$kisa_ad,$kategori,$xml_id){
        
        $cek = $this->db_arakatman->prepare("SELECT * FROM `ders` WHERE kisa_adi = ? AND xml_id = ?");
        $cek->execute(array($kisa_ad,$xml_id));
        $tabloda_var_mi = $cek->rowCount();

        if($tabloda_var_mi < 1){ //karşlık tablosunda varsa güncelle
            $ekle = $this->db_arakatman->prepare("INSERT INTO `ders`(tam_adi,kisa_adi,kategori,xml_id) VALUES (?,?,?,?)");
            $ekle->execute(array($tam_ad,$kisa_ad,$kategori,$xml_id));
            return 'Ders aktarım için sisteme kaydedildi : <b>'.$tam_ad.' '.$kisa_ad.$xml_id.'</b><br>';
        } else {
            return 'Ders bu XML id ve DERS KISA ADI ile zaten var : <b>'.$tam_ad.' '.$kisa_ad.'</b><br>';
        }

    }

    public function obs_ogrenci_ekle($username,$name,$lastname,$mail,$ders_kisa_adi,$xml_id){
        
        $cek = $this->db_arakatman->prepare("SELECT * FROM `ogrenci` WHERE ders_kisa_adi = ? AND xml_id = ? AND mail = ?");
        $cek->execute(array($ders_kisa_adi,$xml_id,$mail));
        $tabloda_var_mi = $cek->rowCount();

        if($tabloda_var_mi < 1){ //karşlık tablosunda varsa güncelle
            $ekle = $this->db_arakatman->prepare("INSERT INTO `ogrenci` (username,name,lastname,mail,ders_kisa_adi,xml_id) VALUES (?,?,?,?,?,?)");
            $ekle->execute(array($username,$name,$lastname,$mail,$ders_kisa_adi,$xml_id));
            return 'Öğrenci aktarım için sisteme kaydedildi : <b>'.$name.' '.$lastname.'</b><br>';
        } else {
            return 'Öğrenci bu XML id ve MAIL ve DERS KISA ADI ile zaten var : <b>'.$name.' '.$lastname.'</b><br>';
        }

    }

    public function aktarim_sistemini_temizle_ders($xml_id){
        $sil = $this->db_arakatman->prepare("DELETE FROM `ders` WHERE `ders`.`xml_id` = ?");
        $sil->execute(array($xml_id));
    }

    public function aktarim_sistemini_temizle_ogrenci($xml_id){
        $sil = $this->db_arakatman->prepare("DELETE FROM `ogrenci` WHERE `ogrenci`.`xml_id` = ?");
        $sil->execute(array($xml_id));
    }

    public function pre($deger){

        echo "<pre>";
        print_r($deger);
        echo "</pre>";

    }//fnk pre x

}//cls x

$sys = new System(); //Classı çağırarak başlattık