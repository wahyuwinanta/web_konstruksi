<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-start min-h-screen p-4">

    <!-- Judul Halaman -->
    <h1 class="text-2xl font-bold text-gray-800 mb-4 mt-2 text-center">
        Owner Dashboard
    </h1>

    <!-- Ringkasan Cepat -->
    <div class="grid grid-cols-2 gap-3 w-full max-w-md mb-4">
        <div class="bg-white rounded-xl shadow-md p-3 text-center">
            <p class="text-gray-500 text-sm">Total Proyek</p>
            <p class="text-xl font-bold text-blue-600">12</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-3 text-center">
            <p class="text-gray-500 text-sm">Proyek Selesai</p>
            <p class="text-xl font-bold text-green-600">5</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-3 text-center">
            <p class="text-gray-500 text-sm">Proyek Berjalan</p>
            <p class="text-xl font-bold text-yellow-600">7</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-3 text-center">
            <p class="text-gray-500 text-sm">Pekerja Aktif</p>
            <p class="text-xl font-bold text-purple-600">24</p>
        </div>
    </div>

    <!-- Grafik Progress Proyek -->
    <div class="bg-white rounded-xl shadow-md p-4 w-full max-w-md mb-5">
        <h2 class="text-lg font-semibold text-gray-700 mb-2 text-center">Progress Proyek</h2>
        <canvas id="progressChart"></canvas>
    </div>

    <!-- Tabel Daftar Proyek -->
    <div class="bg-white rounded-xl shadow-md p-4 w-full max-w-md mb-5">
        <h2 class="text-lg font-semibold text-gray-700 mb-3 text-center">Daftar Proyek</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="py-2 px-2">Nama</th>
                        <th class="py-2 px-2">Status</th>
                        <th class="py-2 px-2">Progress</th>
                        <th class="py-2 px-2">Estimasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-2 px-2">Proyek A</td>
                        <td class="py-2 px-2 text-yellow-600">Berjalan</td>
                        <td class="py-2 px-2">60%</td>
                        <td class="py-2 px-2">20 Okt 2025</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-2">Proyek B</td>
                        <td class="py-2 px-2 text-green-600">Selesai</td>
                        <td class="py-2 px-2">100%</td>
                        <td class="py-2 px-2">12 Sep 2025</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-2">Proyek C</td>
                        <td class="py-2 px-2 text-yellow-600">Berjalan</td>
                        <td class="py-2 px-2">45%</td>
                        <td class="py-2 px-2">5 Des 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Notifikasi Singkat -->
    <div class="bg-white rounded-xl shadow-md p-4 w-full max-w-md mb-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-3 text-center">Aktivitas Terbaru</h2>
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="border-b pb-1">🟢 Proyek Baru: “Gudang Baja Sukabumi” ditambahkan.</li>
            <li class="border-b pb-1">🟡 Progress Proyek A meningkat ke 60%.</li>
            <li class="border-b pb-1">🟢 2 Pekerja baru ditambahkan ke Proyek C.</li>
            <li class="border-b pb-1">🔵 Estimasi Proyek D diperbarui.</li>
            <li>🟢 Proyek B telah selesai dan diarsipkan.</li>
        </ul>
    </div>

    <!-- Script Chart.js -->
    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Proyek A', 'Proyek B', 'Proyek C', 'Proyek D'],
                datasets: [{
                    label: 'Persentase Progress (%)',
                    data: [60, 100, 45, 80],
                    backgroundColor: ['#60A5FA', '#34D399', '#FBBF24', '#A78BFA'],
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

</body>

</html>
