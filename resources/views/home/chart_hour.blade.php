<div>
<h1>shanuka</h1>
</div>
<div id="chart1">
</div>

<script>
 

var options1 = {
      chart: {
        height: 290,
        type: 'line',
      },
      series: [{
        name: 'Hours',
        type: 'line',
        data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
      }],
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Hour', 
        align: 'center',
      },
      // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      xaxis: {
        type: 'text'
      },
      yaxis: [{
        title: {
          text: 'Presentage',
        },

      }, {
        opposite: true,
        title: {
          text: 'Values'
        }
      }]

    }

    var chart1 = new ApexCharts(
      document.querySelector("#chart1"),
      options1
    );

    chart1.render();



    </script>

