<link rel="stylesheet" href="ryu-upload-style.css">
<?php
    $host = "DATABASE_SERVER";
    $dbName = "DATABASE_NAME";
    $username = "USER_NAME";
    $password = "PASSWORD";
    $dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if (is_null($_POST["image"])){
        echo "error: nullです";
    }else{
        $koh_url = $_POST["kohurl"];
        $base_data = $_POST["image"];
        $data = base64_decode($base_data);
        $image = uniqid(mt_rand(), true);
        $image .= '.png';
        $file = "images/$image";
        file_put_contents($file,$data);
        $sql = "INSERT INTO ryu_ai (url, path) VALUES (:url, :path)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':url', $koh_url, PDO::PARAM_STR);
        $stmt->bindValue(':path', $file, PDO::PARAM_STR);
        $stmt->execute();
        $message = 'アップロードが完了しました';
        echo '<div class="text">';
        echo $message;
        echo '</div>';
        echo '<img src="https://api.qrserver.com/v1/create-qr-code/?data=https://studio.kemco.keio.ac.jp/NewYear2024/ryu-maker/';
        echo $file;
        echo '&size=100x100" alt="QRコード" id="qr" />';
    }
?>
<a href="http://127.0.0.1:8080/YOUR_PATH/ryu-api.php" class="btn">戻る</a>

