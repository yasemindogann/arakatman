<html xmlns="http://www.w3.org/1999/html">
<head>
<style>
 
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  margin-left: 3;
  margin-right: 3;
  overflow: hidden;
  background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

ul.topnav li a.active {background-color:#cb6343}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px) {
  ul.topnav li.right, 
  ul.topnav li {float: none;}
}
    
</style>

    <title>ARAKATMAN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php $adres = $_SERVER['REQUEST_URI']; ?>


<ul class="topnav">
    <li><a <?php if($adres == '/arakatman/index.php' OR $adres == '/arakatman/'){ ?> class="active" <?php } ?> href="index.php">Anasayfa</a></li>
    <li><a <?php if($adres == '/arakatman/dersler.php'){ ?> class="active" <?php } ?> href="dersler.php">Dersler</a></li>
    <li><a <?php if($adres == '/arakatman/ogrenciler.php'){ ?> class="active" <?php } ?> href="ogrenciler.php">Öğrenciler</a></li>
    <li><a <?php if($adres == '/arakatman/iliskiler.php'){ ?> class="active" <?php } ?> href="iliskiler.php">İlişkiler</a></li>
</ul>

<br>