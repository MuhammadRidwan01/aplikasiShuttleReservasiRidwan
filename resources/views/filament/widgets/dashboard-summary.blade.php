<x-filament::card>
    @php
        $stats = $this->getStats();
        $chart = $this->getChartData();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-blue-100 rounded">
            <div class="text-sm text-gray-500">Penumpang Hari Ini</div>
            <div class="text-xl font-bold">{{ $stats['todayCount'] }} orang</div>
        </div>
        <div class="p-4 bg-green-100 rounded">
            <div class="text-sm text-gray-500">Jadwal Paling Populer</div>
            <div class="text-xl font-bold">{{ $stats['mostPicked'] }}</div>
        </div>
        <div class="p-4 bg-purple-100 rounded">
            <div class="text-sm text-gray-500">Perbandingan Hotel</div>
            <div class="text-xl font-bold">Styles: {{ $stats['ibisStyles'] }} | Budget: {{ $stats['ibisBudget'] }}</div>
        </div>
    </div>

    <div>
        <canvas id="dailyPassengerChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Chart(document.getElementById("dailyPassengerChart"), {
                type: 'bar',
                data: {
                    labels: @json($chart['labels']),
                    datasets: [{
                        label: 'Jumlah Penumpang',
                        data: @json($chart['values']),
                        backgroundColor: '#3b82f6',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-filament::card>
