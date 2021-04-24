<?php
$pid = $_GET['patient'];
$prick = array();
$avg = array();
$dates = array();

include('../config.php');

if (mysqli_connect_error()) {
  echo "<span class='text-danger'>Unable to connect to database!</span>";

} else {
  $result = mysqli_query($handle, "SELECT * FROM patient_reading where patient_id='$pid' AND pricked!='0' ORDER BY action_taken ASC LIMIT 10;");
  while ($row = mysqli_fetch_array($result)) {
    array_push($prick, $row[4]);
    array_push($avg, $row[3]);
    array_push($dates, $row[5]);
  }
}

?>

<head>
  <style>
    #chart {
      max-width: 800px;
      margin: 35px auto;
    }
  </style>

  <script>
    window.Promise ||
      document.write('<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>')
    window.Promise ||
      document.write('<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>')
    window.Promise ||
      document.write('<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <script>
    var _seed = 42;
    Math.random = function() {
      _seed = _seed * 16807 % 2147483647;
      return (_seed - 1) / 2147483646;
    };
  </script>



</head>

<body>
  <div id="chart"></div>

  <script>
    var options = {
      series: [{
          name: "Prick Value",
          data: [<?php foreach ($prick as $y) echo "$y,"; ?>]
        },
        {
          name: "Glucometer Value",
          data: [<?php foreach ($avg as $x) echo "$x,"; ?>]
        }],
      chart: {
        height: 350,
        type: 'line',
        zoom: {enabled: false},
      },
      dataLabels: {enabled: false},
      stroke: {
        width: [5, 7, 5],
        curve: 'straight',
        dashArray: [0, 8, 5]
      },
      title: {
        text: 'Readings Variation',
        align: 'left'
      },
      legend: {
        tooltipHoverFormatter: function(val, opts) {
          return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '</strong>'}
      },
      markers: {
        size: 0,
        hover: { sizeOffset: 6}
      },
      xaxis: {
        categories: [<?php foreach ($dates as $z) echo "'$z',"; ?>],
      },
      tooltip: {
        y: [{title: {formatter: function(val) {
                return val
              }
            }
          },
          {title: {formatter: function(val) {
                return val
              }
            }
          },
          {title: {formatter: function(val) {
                return val;
              }
            }
          }]
      },
      grid: {
        borderColor: '#f1f1f1',
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>

</body>

</html>