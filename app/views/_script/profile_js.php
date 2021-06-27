<script nonce="<?= NONCE ?>">
  $(function(){
    'use strict'

    /** AREA CHART **/
    var ctx = document.getElementById('chartArea').getContext('2d');

    var gradient = ctx.createLinearGradient(0, 240, 0, 0);
    gradient.addColorStop(0, 'rgba(0,123,255,0)');
    gradient.addColorStop(1, 'rgba(0,123,255,.3)');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= $periods ?>,
        datasets: [{
          data: <?= $activities ?>,
          borderColor: '#007bff',
          borderWidth: 1,
          backgroundColor: gradient
        }]
      },
      options: {
        maintainAspectRatio: false,
        legend: {
          display: false,
            labels: {
              display: false
            }
        },
        scales: {
          yAxes: [{
            display: false,
            ticks: {
              beginAtZero:true,
              fontSize: 10,
              max: 80
            }
          }],
          xAxes: [{
            ticks: {
              beginAtZero:true,
              fontSize: 11,
              fontFamily: 'Arial'
            }
          }]
        }
      }
    });

  });
</script> 