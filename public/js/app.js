if (document.getElementById('toggleButton')) {
    document.getElementById('toggleButton').addEventListener('click', function () {
        // Toggle visibility of child elements
        var childElements = document.getElementById('childElements');
        if (childElements.classList.contains('hidden')) {
            childElements.classList.remove('hidden');
        } else {
            childElements.classList.add('hidden');
        }
    });
}

let toogled = false;
document.getElementById('toggleSidebar').addEventListener('click', function () {

    if (!toogled) {
        $("#sidebar").addClass('left-0').removeClass('-left-full');
        $("#overlay").removeClass('hidden');
        toogled = true;
    } else {
        $("#sidebar").removeClass('left-0').addClass('-left-full');
        $("#overlay").addClass('hidden');
        toogled = false;
    }

});

const generateChartRedirectsMonth = (labels, data) => {
    var ctx = document.getElementById('myChart').getContext('2d');

    let datasets = [];

    data.forEach(dataset => {
        datasets.push({
            label: dataset.label,
            data: dataset.data,
            backgroundColor: dataset.backgroundColor,
            borderWidth: 1
        });
    });

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        stepSize: 1,
                        callback: function (value, index, values) {
                            return Math.floor(value);
                        }
                    }
                }
            },
            plugins: {
                afterDraw: function(chart) {
                    var ctx = chart.chart.ctx;
                    var width = chart.chart.width;
                    var height = chart.chart.height;
                    var dataset = chart.config.data.datasets[0];
                    var total = dataset.data.reduce((a, b) => a + b, 0);
                    var startAngle = -0.5 * Math.PI;

                    for (var i = 0; i < dataset.data.length; i++) {
                        var angle = (dataset.data[i] / total) * 2 * Math.PI;
                        var endAngle = startAngle + angle;
                        var midAngle = startAngle + (angle / 2);

                        var x = width / 2 + Math.cos(midAngle) * (width * 0.4);
                        var y = height / 2 + Math.sin(midAngle) * (height * 0.4);

                        // Draw the label with shadow
                        ctx.save();
                        ctx.fillStyle = 'black';
                        ctx.shadowColor = 'rgba(0, 0, 0, 0.5)';
                        ctx.shadowBlur = 5;
                        ctx.fillText(labels[i], x, y);
                        ctx.restore();

                        // Draw the pie segment with 3D effect
                        ctx.beginPath();
                        ctx.moveTo(width / 2, height / 2);
                        ctx.arc(width / 2, height / 2, width * 0.4, startAngle, endAngle);
                        ctx.closePath();
                        ctx.fillStyle = dataset.backgroundColor[i];
                        ctx.shadowColor = 'rgba(0, 0, 0, 0.5)';
                        ctx.shadowBlur = 10;
                        ctx.fill();

                        startAngle = endAngle;
                    }
                }
            }
        }
    });
}

const generateChartViewersAndUsers = (labels, data) => {

    var ctx = document.getElementById('myChart1').getContext('2d');

    let datasets = [];

    data.forEach(dataset => {
        datasets.push({
            label: dataset.label,
            data: dataset.data,
            backgroundColor: dataset.backgroundColor,
            borderWidth: 1
        });
    });

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        stepSize: 1,
                        callback: function (value, index, values) {
                            return Math.floor(value);
                        }
                    }
                }
            }
        }
    });

}


