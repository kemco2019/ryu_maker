<link rel="stylesheet" href="ryu-api-style.css">
<?php
    $style = $_POST['paint-style'];

    $key = "68327d0d48208f2afe08ebceede74605lwynmwPIgCC7ymVWVIOSpSWIOVIVIISI";
    $url = "https://objecthub.keio.ac.jp/open_koh/v1/object?api_key=" . $key;
    if (strcmp($style, '---') != 0){
        $url_style = $url . '&data_id=' . $style;
        $json_style = file_get_contents($url_style);
        $arr_style = json_decode($json_style, true);
        $img_url = $arr_style["data"][0]["images"][0]["url"]["medium"];
        $kohurl = $arr_style["data"][0]["kohurl"]["jp"];
    }
?>

<?php
    if (strcmp($style, '---') == 0){
        $message = 'error: 画風を選択してください';
    }else{
        $message = '完成！';
    }
    echo '<div class="text">';
    echo $message;
    echo '</div>';

    if (strcmp($style, '---') != 0){
        $command1 = 'python3 dream-studio-i2i.py "' . $img_url . '"';
        exec($command1, $output, $state);
        $result = exec('ls -Ftr ./output/ | tail -n 1');
        $data = file_get_contents('./output/base64.txt');
        echo '<div class="result_data">';
        echo '  <div class="result_link">';
        echo '      <img src="./output/'.$result.'" id="result">';
        echo '      <form action="https://studio.kemco.keio.ac.jp/NewYear2024/ryu-maker/upload.php" name="Form1" method="POST" enctype="multipart/form-data">';
        echo '          <input type="hidden" name="image" value="'.$data.'">';
        echo '          <input type="hidden" name="kohurl" value="'.$kohurl.'">';
        echo '          <input type="submit" name="upload" value="保存" id="save">';
        echo '      </form>';
        echo '  </div>';
        echo '<br>';
        echo '<a href="'.$kohurl.'" target="_blank">画風選択した作品</a>';
        echo '</div>';
    }
?>
<br>
<a href="ryu-api.php" class="btn">戻る</a>

