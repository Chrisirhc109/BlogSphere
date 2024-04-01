
    <div id="graph">
        @section('title')
        Google Graph
        @endsection

        <h1 style="text-align: center;">User Creation by Month</h1>

        <div id="piechart_3d" style="width: 1500px; height: 500px; margin: auto;"></div>

        <div id="print-button-container" class="text-center mt-3">
            <button id="print-button" onclick="window.print();">Print</button>
        </div>
    </div>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current',{packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart()
        {
          var data = google.visualization.arrayToDataTable(@json($data3D));

          var options = {
            is3D: true, 
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data,options);       
        }

        // Hide the print button when the page is printed
        window.onbeforeprint = function() {
            document.getElementById('print-button-container').style.display = 'none';
            document.getElementById('header-header').style.display = 'none';
        };

        // Show the print button when exiting print preview
        window.onafterprint = function() {
            document.getElementById('print-button-container').style.display = 'block';
            document.getElementById('header-header').style.display = 'block';
        };
    
        // Functionality to print when the print button is clicked
        document.getElementById('print-button').addEventListener('click', function() {
            window.print();
        });
    </script>
