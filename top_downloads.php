<?php
session_start();
include('admin_header.php');
include('db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 Most Downloaded Music</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.19/jspdf.plugin.autotable.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .pdf-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Top 10 Most Downloaded Music</h2>
        <canvas id="downloadsChart"></canvas>
        <a class="pdf-button" id="generatePdf">Generate PDF Report</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('get_top_downloads.php')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('downloadsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.titles,
                            datasets: [{
                                label: 'Number of Downloads',
                                data: data.downloads,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    formatter: function(value) {
                                        return value;
                                    },
                                    color: 'black',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });

                    document.getElementById('generatePdf').addEventListener('click', function() {
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();

                        doc.setFontSize(18);
                        doc.text('Top 10 Most Downloaded Music', 14, 22);
                        doc.setFontSize(12);
                        doc.text('SoundBeyond: Website Report', 14, 32);

                        const headers = [['Position', 'Title', 'Artist', 'Number of Downloads']];
                        const rows = data.titles.map((title, index) => [index + 1, title, data.artists[index], data.downloads[index]]);

                        doc.autoTable({
                            head: headers,
                            body: rows,
                            startY: 40,
                        });

                        doc.save('Top_10_Most_Downloaded_Music.pdf');
                    });
                })
                .catch(error => {
                    console.error('Error fetching the data:', error);
                });
        });
    </script>
</body>
</html>
<?php include('templates/footer.php'); ?>
