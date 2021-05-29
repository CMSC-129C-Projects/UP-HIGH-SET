// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Not Done', 'Done'],
        ['Professors Not Done Evaluating', 8],
        ['Professors Done Evaluating', 2]
    ]);

    const container = document.getElementById('col-container');
    console.log(container.clientWidth);

    var options = {'title':'Professors Done Answering', 'width':container.clientWidth, 'backgroundColor':'#ffffff'};

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}