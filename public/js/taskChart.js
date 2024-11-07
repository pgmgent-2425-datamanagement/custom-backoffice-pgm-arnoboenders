document.addEventListener("DOMContentLoaded", function () {
  var ctx = document.getElementById("taskChart").getContext("2d");
  var taskData = JSON.parse(document.getElementById("taskData").textContent);
  var labels = taskData.map(function (project) {
    return project.name;
  });
  var data = taskData.map(function (team) {
    return team.taskCount;
  });

  var taskChart = new Chart(ctx, {
    type: "pie", // Specify the chart type
    data: {
      labels: labels,
      datasets: [
        {
          label: "Number of tasks per project",
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
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});
