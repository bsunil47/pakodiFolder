   <script type="text/javascript">
          //google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Year', 'Active Users', 'Registered Users'],
              <?php foreach ($datesn as $key=>$value){ 
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
              ['<?php echo $dformat; ?>',  <?php echo $activecount[$key]; ?>, <?php echo $registercount[$key]; ?>],
              <?php } ?>

            ]);
            var options = {
              title: 'User Activity and Registered Users',
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
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
          }
        </script>
    
    