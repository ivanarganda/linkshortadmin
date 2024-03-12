const COLORS = {
    red: 'rgba(244, 67, 54, 0.5)',
    pink: 'rgba(233, 30, 99, 0.5)',
    purple: 'rgba(156, 39, 176, 0.5)',
    deepPurple: 'rgba(103, 58, 183, 0.5)',
    indigo: 'rgba(63, 81, 181, 0.5)',
    blue: 'rgba(33, 150, 243, 0.5)',
    lightBlue: 'rgba(3, 169, 244, 0.5)',
    cyan: 'rgba(0, 188, 212, 0.5)',
    teal: 'rgba(0, 150, 136, 0.5)',
    green: 'rgba(76, 175, 80, 0.5)',
    lightGreen: 'rgba(139, 195, 74, 0.5)',
    lime: 'rgba(205, 220, 57, 0.5)',
    yellow: 'rgba(255, 235, 59, 0.5)',
    amber: 'rgba(255, 193, 7, 0.5)',
    orange: 'rgba(255, 152, 0, 0.5)',
    deepOrange: 'rgba(255, 87, 34, 0.5)',
    brown: 'rgba(121, 85, 72, 0.5)',
    grey: 'rgba(158, 158, 158, 0.5)'
};

const THEMES = {
    dark: `<svg class="h-8 w-8" style="color:orange" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="5" />  <line x1="12" y1="1" x2="12" y2="3" />  <line x1="12" y1="21" x2="12" y2="23" />  <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />  <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />  <line x1="1" y1="12" x2="3" y2="12" />  <line x1="21" y1="12" x2="23" y2="12" />  <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />  <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" /></svg>`,
    light: `<svg class="h-8 w-8" style="color:orange"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" /></svg>`
}

if (document.getElementById('toggleButtonUser')) {
    let toogled = false;
    document.getElementById('toggleButtonUser').addEventListener('click', function () {

        if (!toogled) {
            $("#right-sidebar").addClass('right-0').removeClass('-right-full');
            $("#overlay").removeClass('hidden');
            toogled = true;
        } else {
            $("#right-sidebar").removeClass('right-0').addClass('-right-full');
            $("#overlay").addClass('hidden');
            toogled = false;
        }

    });
}

// if (localStorage.getItem('darktheme') != 'false' ){
//     $('body').addClass('bg-gray-800 text-gray-100');
//     $('#theme').html(THEMES.dark);
// } else {
//     $('body').removeClass('bg-gray-800 text-gray-100');
//     $('#theme').html(THEMES.light);
// }

// $('#theme').on('click', ()=>{
//     localStorage.getItem('darktheme') != 'false' ? $('body').removeClass('bg-gray-800 text-gray-100') : $('body').addClass('bg-gray-800 text-gray-100');
//     $('#theme').html( localStorage.getItem('darktheme') !== 'false' ? THEMES.light : THEMES.dark );
//     localStorage.setItem( 'darktheme' , localStorage.getItem('darktheme') !== 'false' ? 'false' : ' true' );   
// })

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

// Chart for both users and linkshorts
const generateChart = ( title , labels, data) => {

    var ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: data,
                backgroundColor: COLORS.red,
                borderColor: COLORS.red,
                borderWidth: 2,
                fill:false
            }]
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

const generateChartRedirectsMonth = (labels, data) => {
    var ctx = document.getElementById('myChart').getContext('2d');

    let datasets = [];

    data.forEach(dataset => {
        datasets.push({
            // label: dataset.label,
            data: dataset.data,
            backgroundColor: dataset.backgroundColor 
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

const generateChartViewersAndUsers = (shorts, viewers , users ) => {

    var ctx = document.getElementById('myChart1').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: shorts,
            datasets: [{
                label: 'Total Viewers',
                data: viewers,
                backgroundColor: COLORS.cyan,
                borderColor: COLORS.cyan,
                borderWidth: 1
            },
            {
                label: 'Unique Users',
                data: users,
                backgroundColor: COLORS.teal,
                borderColor: COLORS.teal,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}


