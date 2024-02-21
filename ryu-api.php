<link rel="stylesheet" href="ryu-api-style.css">
<?php
    $key = "68327d0d48208f2afe08ebceede74605lwynmwPIgCC7ymVWVIOSpSWIOVIVIISI";
    $url = "https://objecthub.keio.ac.jp/open_koh/v1/object?api_key=" . $key;
    $keyword = "龍,竜,辰";

    $url_ryu = $url . '&title=' . $keyword;
    $json_ryu = file_get_contents($url_ryu);
    $arr_ryu = json_decode($json_ryu, true);

    $r = rand(0,10);
    // $incr = rand(5, 15);
    $incr = 15;
    $total = 74;
?>

<body>
    <header>
        <div class="commonContent">
            <img src="logo.jpg" id="kemlogo">
        <div class="top_images">
            KOH 龍メーカー
        </div>
        </div>
    </header>

    <form action="ryu-form-submit.php" method="post" name="upload" enctype="multipart/form-data">
        <div id="upload">
            <label for="paint-style">画風を選択</label>
            <select name="paint-style">
        <?php
            echo '<option value="---">---</option>';
            $count = 0;
            for($i = 0 ; $count < 4 ; $i++){
                $no = ($r + $i * $incr) % $total;
                if (!empty($arr_ryu["data"][$no]["images"][0]["url"]["medium"])){
                    echo '<option value=';
                    echo $arr_ryu["data"][$no]["id"];
                    echo '>';
                    echo $arr_ryu["data"][$no]["title"]["jp"];
                    echo '</option>';
                    $count++;
                }
            }
            echo '</select>';
            echo '<button id="sbtn4" onclick="Form_Submit()">送信</i></button>';
        ?>
        </div>
    </form>

    <?php
        echo '<div class="data">';
        $count = 0;
        for($i = 0 ; $count < 4 ; $i++){
            $no = ($r + $i * $incr) % $total;
            if (!empty($arr_ryu["data"][$no]["images"][0]["url"]["medium"])){
                echo '<div class="data_item">';
                echo '<img src="'.$arr_ryu["data"][$no]["images"][0]["url"]["medium"].'" alt="" id="collections">';
                echo '<div class="coll_title"><p>'.$arr_ryu["data"][$no]["title"]["jp"].'</p></div>';
                echo '<p><a href="'.$arr_ryu["data"][$no]["kohurl"]["jp"].'" target="_blank">KOHリンク</a></p>';
                echo '</div>';
                $count++;
            }
        } 
        echo '</div>';
    ?>

    <div id="Loading">
        <div id="layer_board_bg"></div>
        <div id="loadings">
            <img src="1-4-loading.gif" class="loadimg">
            <p class="loadmsg">
            処理中...<br>
            しばらくお待ち下さい。
            </p>
        </div>
    </div>
</body>

<!-- script
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="stable-function.js"></script>