//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
/*
    var umur = {
        labels: [
            "Pelprip",
            "Pelwap",
            "Pelprap",
            "Pelnap"
        ],
        datasets: [
            {
                data: [700, 500, 400, 600],
                backgroundColor: [
                    "#f56954",
                    "#00a65a",
                    "#f39c12",
                    "#00c0ef"
                ]
            }]
    };
*/
    var umur = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: umurData
    });



    var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d');
/*
    var wadahData = {
        labels: [
            "Pria",
            "Wanita",
        ],
        datasets: [
            {
                data: [700, 600],
                backgroundColor: [
                    "#f56954",
                    "#00c0ef"
                ]
            }]
    };
*/


    var priawanita = new Chart(pieChartCanvas2, {
      type: 'doughnut',
      data: priaWanitaData
    });


    var pieChartCanvas2 = $('#pieChart3').get(0).getContext('2d');

    var wadah = new Chart(pieChartCanvas2, {
      type: 'bar',
      data: wadahData
    });

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas, {
        type: 'line',
        data: tahunData,
        options: tahunOption
    });
