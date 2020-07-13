// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
this.getStatusVente();
function getStatusVente(){
  var urlPath = 'http://'+window.location.hostname+':'+ window.location.port +'/pie';
  var labels = new Array();
  var donnees = new Array();
  var max;
  $(document).ready(function(){
    $.get(urlPath, function(response){
   
        donnees = response.vente;
    
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Vendu", "Non Vendu"],
    datasets: [{
      data: donnees,
      backgroundColor: [ '#1cc88a','#4e73df'],
      hoverBackgroundColor: ['#17a673','#2e59d9', ],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
    });
  });
}