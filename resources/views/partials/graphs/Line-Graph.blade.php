<x-default-layout>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <!-- Chart Title -->
                <h1 class="text-center mb-4">Post Created by Month</h1>

                <!-- Chart Canvas -->
                <div class="chart-container">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const labels = @json($labelsLine);
        const data = @json($dataLine);
        const colors = @json($colorsLine);

        // Get the canvas element for the chart
        const ctx = document.getElementById('userChart').getContext('2d');

        // Initialize the chart
        const userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Users Created',
                    data: data,
                    backgroundColor: colors,
                    borderColor: 'purple',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks:{
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-default-layout>
