<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<link rel="stylesheet" href="ichiran.css">
<?php
$host = "mysql57.kemco.sakura.ne.jp";
$dbName = "kemco_api";
$username = "kemco";
$password = "h76-id_z";
$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
    $sql = 'SELECT * FROM ryu_ai';
    $stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = count($images);
?>

<head></head>
<header>
    <div class="commonContent">
        <img src="logo.jpg" id="kemlogo">
    <div class="top_images">
        KOH 龍メーカー 作品一覧
    </div>
    </div>
</header>
<body>
<div class="img_container" >
    <?php
        for ($i=$count-1; $i >= 0; $i=$i-4){
            for ($j=0; $j<4; $j++){
                if ($i-$j >= 0){
                    echo '<a href="' . $images[$i-$j]['path'] . '" data-lightbox="group"><img style = "background-color: #EAEAEA;" src="' . $images[$i-$j]['path'] . '" alt="CLUSTER SEO" /></a>';
                }else{
                    echo '<a href="" data-lightbox="group"><img style = "background-color: #EAEAEA;" src="white.png" alt="CLUSTER SEO" /></a>';
                }
            }
            for ($j=0; $j<4; $j++){
                if ($i-$j >= 0){
                    echo '<a href="' . $images[$i-$j]['url'] .'" target="_blank">元の作品</a>';
                }else{
                    echo '<a href=""></a>';
                }
            }
        }
    ?>
</div>
</body>
<a href="#" class="back-to-top js-to-top">TOP</a>

<!-- script
    ================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
<script type="text/javascript" src="ichiran.js"></script>

