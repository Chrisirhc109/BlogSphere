<x-default-layout>
    <!-- google-chart.blade.php -->
    <div id="graph-only" class="min-h-auto w-100 ps-4 pe-6" style="box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);">
        <div class="card-body d-flex flex-column justify-content-end pe-0">
            <div class="card-body d-flex align-items-end p-0">
                <div id="chart_div" class="min-h-auto w-100 ps-4 pe-6" style="width: auto; height: 500px; margin: auto;"></div>
            </div>
        </div>

        <div id="print-button-container" class="text-center mt-3">
            <button id="print-button">Print</button>
        </div>
    </div>
    

    <!-- Load Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(@json($data));

            var options = {
                title: 'User Creation by Month', 
                titleTextStyle:{
                    bold:true,
                    textAlign:'center'
                },
                legend: { position: 'bottom' },
                hAxis: { title: 'Month' },
                vAxis: { title: 'Number of Users',format: '0' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

    
</x-default-layout>
