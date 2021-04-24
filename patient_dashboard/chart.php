  <?php
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../login_page.php");
    exit();
  }
  ?>

  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Reading'],

          <?php $pid = $_SESSION['userid'];

          if (mysqli_connect_error()) {
            echo "<span class='text-danger'>Unable to connect to database!</span>";
          } else {

            $result = mysqli_query($handle, "SELECT * FROM (SELECT * FROM patient_reading WHERE patient_id='$pid' ORDER BY action_taken DESC LIMIT 5)
                                             VAR1 ORDER BY action_taken ASC;");

            while ($row = mysqli_fetch_array($result)) {

              if ($row[4] == 0) {
                echo "['$row[5]', $row[3]],";
              } else {
                echo "['$row[5]', $row[4]],";
              }
            }
          }
          ?>
        ]);

        var options = {
          title: 'Last 5 readings',
          hAxis: {title: 'Date & Time'},
          vAxis: {title: 'Readings'},
          legend: {position: 'top'},
          backgroundColor: '#f1f8e9'
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <div id="curve_chart" style="width: auto; height: 500px;"></div>
  </body>

  </html>