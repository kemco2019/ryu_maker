function Form_Submit(){
    document.forms["upload"].submit();  //ﾌｫｰﾑ内容を送信します。※ｻﾝﾌﾟﾙのためｺﾒﾝﾄｱｳﾄしています。
      /*メッセージを非表示状態から表示状態へ変更します。 
      メッセージを表示してからSubmitを行うとGIFアニメが再生されないため、
      Submitしてからメッセージを表示しています。*/
    document.getElementById("Loading").style.display = "flex";
    document.getElementById("layer_board_bg").style.display = "flex";
};
