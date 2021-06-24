$(function() {
    $('#print').click(function() {
        window.print();
    });

    computeOverallRating();
});

function computeOverallRating() {
    let finalRatings = $('.final_rating');

    let total = 0;

    Object.values(finalRatings).forEach((element, index) => {
        if (index < finalRatings.length) {
            let fr = parseFloat($(element).text());
            total += fr;
            $(element).html(fr.toFixed(2) + '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' + getRate(fr.toFixed(2)));
        }
    });

    const average = (total.toFixed(2)/finalRatings.length);
    let intrepretation = getRate(total.toFixed(2));
    $('.overall').html(average + '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' + intrepretation);
}


function getRate(overallRate) {
    if (overallRate <= 1.49)
        return 'E';
    if (overallRate <= 2.490)
        return 'VG';
    if (overallRate <= 3.49)
        return 'G';
    if (overallRate <= 4.499)
        return 'F';

    return 'P';
}