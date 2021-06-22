$(function() {
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
});

function getSheetStatusCount() {
    return $.ajax({
        url: BASE_URI + '/monitoring/count_sheet_per_status_per_subject/',
        type: 'GET',
        dataType: 'json',
    });
}

const countOccurrences = (arr, val) => arr.reduce((a, v) => (v === val ? a + 1 : a), 0);

// Draw the chart and set the chart values
function drawChart() {
    $.when(getSheetStatusCount()).then(function(response) {
        console.log('here');
        if (response.is_available) {
            let professors = [];
            let statusList = []; // List of statuses for each professor whether done or not
            response.statuses.forEach((element, index) => {
                if (!professors.includes(element.full_name)) {
                    professors.push(element.full_name);

                    statusList.push(element.inprogress === '0' && element.open === '0');
                } else {
                    let profIndex = professors.indexOf(element.full_name);

                    // Check if current subject is 100% complete
                    // If complete, no need to change the value inside the list
                    // False is what's important, one false and everything is false
                    // Similar to the rules of AND operator
                    let status = element.inprogress == 0 && element.open == 0;
                    statusList[profIndex] = !status ? status: statusList[profIndex];
                }

                if (index == response.statuses.length-1) {

                    let completeTotal = countOccurrences(statusList, true);

                    var data = google.visualization.arrayToDataTable([
                        ['Incomplete', 'Complete'],
                        ['Incomplete Evaluations', (professors.length - completeTotal)],
                        ['Complete Evaluations', completeTotal]
                    ]);
                
                    // const container = document.getElementById('col-container');
                    // console.log(container.clientWidth);
                
                    var options = {
                        'title':'Evaluation Status Overview',
                        'animation':
                        {
                            'duration':1000,
                            'easing':'in'
                        },
                        'width':'100%',
                        'height':'100%',
                        'backgroundColor':'transparent',
                        'colors':[ '#7b1113' , '#014421' ],
                        'is3D':'true'
                    };
                
                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            });
        } else {
            alertify.error(response.message);
        }
    });
}