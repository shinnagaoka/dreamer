$(function(){

    var time = 0;
    var mid = 0;
    var now;

    var min_time = 0;
    var sec_time = 0;

    var count;

    var min = $("#min");
    var sec = $("#sec");

    var start = $("#start");
    var stop = $("#stop");
    var reset = $("#reset");

    //startボタンが押された時の処理
    start.click(function(){
        now = new Date(); //現在時刻
        count = setInterval(counter, 10);
        toggle();
        reset.css("color", "#FF9194");
    });

    //stopボタンが押された時の処理
    stop.click(function(){
        mid += (new Date() - now)/1000;
        clearInterval(count);
        toggle();
        reset.css("color", "red");
    });

    //resetボタンが押された時の処理
    reset.click(function(){
        mid = 0;
        min.html("0");
        sec.html("00.00");
        reset.css("color", "gray");
        reset.prop("disabled", true);
    });

    //時間の計算
    function counter(){

        time = mid + ((new Date() - now)/1000);

        //60秒経過した時の処理
        if(time > 60){
            mid = 0;
            min_time ++;
            now = new Date();
            time = 0;
            sec.html();
        }

        //秒数が10秒より小さかったら01, 02のようにする
        if(time < 10){
            sec.html("0"+time.toFixed(2));
        }else{
            sec.html(time.toFixed(2));
        }
        min.html(min_time);
    }

    //ボタンの切り替え
    function toggle(){
        if(!start.prop("disabled")){
            start.prop("disabled", true);
            stop.prop("disabled", false);
            reset.prop("disabled", true);
        }else{
            start.prop("disabled", false);
            stop.prop("disabled", true);
            reset.prop("disabled", false);
        }
    }
});