<x-default-layout>

<h1 id="text-header" style="font-size: 24px; font-weight: bold;">User Creation by Month (2024)</h1>

<div class="card text" style="width: 1000px">
    <div class="card-header mt-10">
        <ul class="nav nav-pills card-header-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" id="graph-tab" href="#" onclick="showContent('Graph')">Graph(%)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="table-tab" href="#" onclick="showContent('Table')">Table(No.)</a>
            </li>
        </ul>
    </div>
    
    <div class="card-body">
        {{-- 3D CHART --}}
        <div>
            <div id="piechart_3d" class="card-title" style="height: 450px"></div>
        </div>

        <div style="margin-left: 10px">
            <button class="btn btn-primary mt-5" id="print-button-graph" onclick="printDivs(['text-header','piechart_3d'])">Print Graph</button>
        </div>

        {{-- Table --}}
        <div id="table" class="container" style="display: none;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>User Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userCounts as $userCount)
                        <tr>
                            <td>{{ date('F', mktime(0, 0, 0, $userCount->month, 1)) }}</td>
                            <td>{{ $userCount->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-left: 10px">
            <button class="btn btn-primary mt-5" id="print-button-table" style="display:none;" onclick="printDivs(['text-header','table'])">Print Table</button>
        </div>
    </div>
</div>
 
    

    {{-- 3D CHART --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(@json($data3D));
            var options = {
                is3D: true, 
                vAxis: {format: '0'}
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>

    {{-- REFRESH AFTER PRINT PAGE --}}
    <script>
        window.onafterprint = function() {
            location.reload(); // Reload the page
        };
    </script>

    {{-- SHOW/HIDE DROP DOWN --}}
    <script>
        function showContent(view) {
            var graph = document.getElementById('piechart_3d');
            var table = document.getElementById('table');
            var printGraphBtn = document.getElementById('print-button-graph');
            var printTableBtn = document.getElementById('print-button-table');
            var graphTab = document.getElementById('graph-tab');
            var tableTab = document.getElementById('table-tab');

            if (view === 'Graph') {
                graph.style.display = 'block';
                table.style.display = 'none';
                printGraphBtn.style.display = 'block';
                printTableBtn.style.display = 'none';
                graphTab.classList.add('active');
                tableTab.classList.remove('active');
            } else {
                graph.style.display = 'none';
                table.style.display = 'block';
                printGraphBtn.style.display = 'none';
                printTableBtn.style.display = 'block';
                graphTab.classList.remove('active');
                tableTab.classList.add('active');
            }
        }
    </script>

    {{-- PRINT HTML --}}
    <script>
        function printDivs(divIds) {
            var original = document.body.innerHTML;
            var printContents = '';

            divIds.forEach(function(divId) {
                var divToPrint = document.getElementById(divId);
                printContents += divToPrint.innerHTML;
            });

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = original;
        }
    </script>
</x-default-layout>