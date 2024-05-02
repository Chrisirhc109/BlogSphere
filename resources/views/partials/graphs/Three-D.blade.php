<div id="graph">

    <h1 id="text-header" style="margin: auto; font-size: 24px; font-weight: bold;">User Creation by Month (2024)</h1>
    


    <div class="btn-group" style="margin-top: 30px">Change view:
        <select id="select-option" class="form-select" name="dropdown" onchange="showContent()">
            <option value="Graph">Graph(%)</option>
            <option value="Table">Table(No.)</option>
        </select>
    </div>
    
    

    <div id="graph-table-line-no-btn">
        {{--Graphs--}}
        <div style="margin-left:600px;">
            <div id="piechart_3d" style="height:400px; width:600px"></div>
        </div>

        {{--Table--}}
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



    
        <div id="print-button-container" style="position: absolute; bottom: 10%; left: 50%; right:0% ;">
            
            <button class="btn btn-primary" id="print-button-graph"  onclick="printDivs(['text-header','piechart_3d'])">Print Graph</button>
            <button class="btn btn-primary" id="print-button-table"  style="display:none;" onclick="printDivs(['text-header','table'])">Print Table</button>
        </div>
    </div>
</div>

{{--3D CHART--}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
        {
          var data = google.visualization.arrayToDataTable(@json($data3D));

          var options = {
            is3D: true, 
            vAxis:{ format:'0'}
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data,options);       
        }

</script>


{{--REFRESH AFTER PREVIEW PRINT PAGE --}}
<script>
    // Show the print button when exiting print preview
    window.onafterprint = function() {
        location.reload(); // Reload the page
    };
</script>


{{--IF ELSE SHOW/HIDE DROP DOWN--}}
<script>
    function showContent() {

        var selectOption = document.getElementById("select-option").value;
        var elements = ['piechart_3d', 'table','print-button-graph','print-button-table'];

        elements.forEach(function(elemendId)
        {
            document.getElementById(elemendId).style.display = "none";
        });

        if (selectOption === "Graph") 
        {
            document.getElementById("piechart_3d").style.display = "block";
            // PRINT BUTTON
            document.getElementById("print-button-graph").style.display = "block";
        } 
        else if (selectOption === "Table") 
        {
            document.getElementById("table").style.display = "block";
            // PRINT BUTTON
            document.getElementById("print-button-table").style.display = "block";
        } 
    }

</script>

{{--PRINT HTML--}}
<script>
    function printDivs(divIds)
    {
        var original = document.body.innerHTML;
        var printContents = '';

        divIds.forEach(function(divIds)
    {

        var divToPrint = document.getElementById(divIds);
        printContents += divToPrint.innerHTML;

    });

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = original;
    }
</script>