// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling

$.post("../../functionality/absence/averageAbsence.php",
  {
      action: "add"
  },function(data, status){

    var json_data = JSON.parse(data);
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    // -- Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Септрмври", "Октомври", "Ноември", "Декември", "Януари", "Февруари", "Март", "Април", "Май", "Юни"],
        datasets: [{
          label: "Отсъствия",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
          pointHitRadius: 20,
          pointBorderWidth: 2,
          data: [json_data[0][1], json_data[1][1], json_data[2][1], json_data[3][1], json_data[4][1], json_data[5][1],
           json_data[6][1], json_data[7][1], json_data[8][1], json_data[9][1]],
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 30,
              maxTicksLimit: 1
            },
            gridLines: {
              color: "rgba(0, 0, 0, .125)",
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });


  });
$.post("../../functionality/averageResult/functionality.php",
    {
        action: "add",
    },
    function(data, status){
      var ctx = document.getElementById("myBarChart");

        console.log(data);

        var json_data = JSON.parse(data);




        var myLineChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [json_data[0][1], json_data[1][1], "10h", "11г"],
            datasets: [{
              label: "Среден успех",
              backgroundColor: "rgba(2,117,216,1)",
              borderColor: "rgba(2,117,216,1)",
              data: [json_data[0][0], json_data[1][0], 5, 4 ],
            }],
          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'month'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 6
                }
              }],
              yAxes: [{
                ticks: {
                  min: 2,
                  max: 6,
                  maxTicksLimit: 5
                },
                gridLines: {
                  display: true
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });

    });



// -- Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Blue", "Red", "Yellow", "Green"],
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});
