//

$(document).ready(function() {
  var userChart = new Chart(
    document.getElementById("userChart").getContext("2d"),
    {
      type: "doughnut",
      data: {
        labels: [],
        datasets: [
          {
            data: [],
            backgroundColor: ["#17a2b8", "#28a745", "#ffc107"]
          }
        ]
      },

      options: {
        legend: {
          display: true
        },
        responsive: true,
        tooltips: {
          enabled: true
        }
      }
    }
  );

  var logChart = new Chart(
    document.getElementById("logChart").getContext("2d"),
    {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec"
        ],
        datasets: [
          {
            label: "Log by month",
            data: [],
            borderColor: "rgba(0, 176, 228, 0.75)",
            backgroundColor: "transparent",
            pointBorderColor: "rgba(0, 176, 228, 0)",
            pointBackgroundColor: "rgba(0, 176, 228, 0.9)",
            pointBorderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        legend: {
          display: true
        }
      }
    }
  );

  $.ajax({
    url: BASE_URL + `api/log/statistic/${auth.token}`,
    type: "GET",
    dataType: "JSON",
    success: function(response) {
      $.each(response.data.log_by_month, function(k, v) {
        logChart.data.datasets[0].data.push(v);
      });
      $("#count_log").text(response.data.total_log);
      logChart.update();
    }
  });

  $.ajax({
    url: BASE_URL + `api/user/statistic/${auth.token}`,
    type: "GET",
    dataType: "JSON",
    success: function(response) {
      var total = 0;
      $.each(response.data, function(k, v) {
        userChart.data.labels.push(v.level);
        userChart.data.datasets[0].data.push(v.jml_user);

        total += parseInt(v.jml_user);
      });
      $("#count_user").text(total);
      userChart.update();
    }
  });
});
