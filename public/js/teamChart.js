document.addEventListener("DOMContentLoaded", function () {
  var ctx = document.getElementById("teamChart").getContext("2d");
  var teamData = JSON.parse(document.getElementById("teamData").textContent);
  var labels = teamData.map(function (team) {
    return team.name;
  });
  var data = teamData.map(function (team) {
    return team.projectCount;
  });
  let delayed;

  var teamChart = new Chart(ctx, {
    type: "bar", // Specify the chart type
    data: {
      labels: labels,
      datasets: [
        {
          label: "Number of Projects",
          data: data,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            // Add more colors if needed
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(75, 192, 192, 1)",
            // Add more colors if needed
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      animation: {
        onComplete: () => {
          delayed = true;
        },
        delay: (context) => {
          let delay = 0;
          if (
            context.type === "data" &&
            context.mode === "default" &&
            !delayed
          ) {
            delay = context.dataIndex * 300 + context.datasetIndex * 100;
          }
          return delay;
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});
