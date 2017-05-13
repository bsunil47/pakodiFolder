        <script type="text/javascript">
          //google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Year', 'Private', 'Public'],
              <?php foreach ($dates as $key=>$value){ 
                    switch ($rangetype){
                        case 'yearly':
                            $dformat = date('M', strtotime($value));
                            $htitle = 'Months';
                            break;
                        case 'monthly':
                            $dformat = date('jS', strtotime($value));
                            $htitle = 'Days';
                            break;
                        case 'weekly':
                            $dformat = date('D j M-Y', strtotime($value));
                            $htitle = 'Weeks';
                            break;
                        case 'daily':
                            $dformat = date('G', strtotime($value.':00'.':00')).'Hour';
                            //$dformat = $value;
                            $htitle = 'Hours';
                            break;
                    }
              ?>
              ['<?php echo $dformat; ?>',  <?php echo $private_dubs[$key]; ?>, <?php echo $public_dubs[$key]; ?>],
              <?php } ?>

            ]);
            var options = {
              title: 'Dubs Statistics',
              curveType: 'function',
              legend: { position: 'bottom' },
              height: 350,
              hAxis: {
              title: '<?php echo $htitle; ?>',
              },
              vAxis: {
              title: 'Count',
              }
            };
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));
            chart.draw(data, options);
          }
        </script>
    