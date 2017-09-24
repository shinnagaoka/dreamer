        //var all_date = ["9\/1","9\/2","9\/3","9\/4","9\/5","9\/6","9\/7","9\/8","9\/9","9\/10","9\/11","9\/12","9\/13","9\/14","9\/15","9\/16","9\/17","9\/18","9\/19","9\/20","9\/21","9\/22","9\/23","9\/24","9\/25","9\/26","9\/27","9\/28","9\/29","9\/30"];
        // console.log(all_date);

        // $ymdなどの値は、配列でないと読み込まれない。連想配列では読み込まれない。
        var all_date =<?php echo json_encode($day); ?>;
        // 連想配列の値だけを取得し、配列にする。
        var all_time =<?php echo json_encode(array_values($month)); ?>;
        var accumulation_time = <?php echo json_encode($accumulation_time) ?>
        //var all_time = [4,7,7,8.3,8.56,8.59,9.2,8.3,8.5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
        // console.log(all_time);

        var each_month_key = ["2017\/1","2017\/2","2017\/3","2017\/4","2017\/5","2017\/6","2017\/7","2017\/8","2017\/9","2017\/10","2017\/11","2017\/12"];
        console.log(each_month_key);
        var each_month_value = [0,0,0,0,0,0,120.24,198.58,71.5,0,0,0];
        console.log(each_month_value);

        // var accumulation_time = [4,11,18,26.3,34.86,43.45,52.65,60.95,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45,69.45];
        // console.log(accumulation_time);

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: all_date,
                datasets: [{
                    type: 'bar',
                    label: '# Daily',
                    data: all_time,
                    borderColor : "rgba(254,97,132,0.8",
                    backgroundColor : "rgba(255,153,0,0.4)",
                    borderWidth: 2,
                    yAxisID: "y-axis-daily"
                },
                {
                    type: 'line',
                    label: '# Total',
                    data: accumulation_time,
                    borderColor : "rgba(54,164,235,0.8)",
                    backgroundColor : "rgba(54,164,235,0.5)",
                    borderWidth: 2,
                    yAxisID: "y-axis-total"
                },
                ]
            },
            options: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#4C4C4C'
                    }
                },
                scales: {
                    yAxes: [
                        {
                            id: "y-axis-daily",   // Y軸のID
                            type: "linear",   // linear固定 
                            position: "left", // どちら側に表示される軸か？
                            ticks: {          // スケール
                                max: 20,
                                min: 0,
                                stepSize: 5,
                                fontColor: '#4C4C4C'
                            },
                        },
                        {
                            id: "y-axis-total",
                            type: "linear",
                            position: "right",
                            ticks: {
                                max: 300,
                                min: 0,
                                stepSize: 50,
                                fontColor: '#4C4C4C'
                            },
                        }
                    ],
                    xAxes: [
                        {
                            ticks: {
                                fontColor: '#4C4C4C'
                            }
                        }
                    ],
                    // yAxes: [{
                    //     ticks: {
                    //         beginAtZero:false
                    //     }
                    // }]
                }
            }
        });

        var ctx2 = document.getElementById("each_month");
        var each_month = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: each_month_key,
                datasets: [{
                    type: 'bar',
                    label: '# Month',
                    data: each_month_value,
                    borderColor : "rgba(54,164,235,0.8)",
                    backgroundColor : "rgba(54,164,235,0.5)",
                    borderWidth: 1,
                    yAxisID: "y-axis-month"
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [
                      {
                          id: "y-axis-month",   // Y軸のID
                          type: "linear",   // linear固定 
                          position: "left", // どちら側に表示される軸か？
                          ticks: {          // スケール
                              max: 200,
                              min: 0,
                              stepSize: 50
                          },
                      }
                    ],
                    // yAxes: [{
                    //     ticks: {
                    //         beginAtZero:false
                    //     }
                    // }]
                }
            }
        });
    $(document).ready(function() {
      $('.progress .progress-bar').css("width",
        function() {
          return $(this).attr("aria-valuenow") + "%";
        }
      );
    });

    var ctx = document.getElementById("epoint_chart");
    var myDoughnutChart = new Chart(ctx, {
      //グラフの種類
      type: 'doughnut',
      //データの設定
      data: {
          //データ項目のラベル
          labels: ["Ex.", "Next."],
          //データセット
          datasets: [{
              // label: '# of Votes',
              // label: ["Ex.", "Next."],
              //背景色
              backgroundColor: [
                  "rgba(51,102,255,0.9)",
                  "rgba(0,0,0,0.3)"
              ],
              borderColor: [
                  "rgba(0,0,0,0.6)",
                  "rgba(0,0,0,0.6)"
              ],
              borderWidth: 0,
              //背景色(ホバーしたとき)
              hoverBackgroundColor: [
                  "rgba(51,102,255,1)",
                  "rgba(0,0,0,0.6)"
              ],
              //グラフのデータ
              data: [37, 6]
          }]
      },options: {
          //アニメーションの設定
          animation: {
              //アニメーションの有無
              animateRotate: true
          },
          cutoutPercentage: 70,
          legend: {
              display: false,
              labels: {
                  fontColor: 'rgb(255, 99, 132)'
              }
          }
      }
    });