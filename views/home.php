<h1>Base MVC</h1>
<p>Welcome to this base MVC project.</p>

<h2>Team Statistics</h2>
<div class="chart-container">
    <canvas id="teamChart"></canvas>
</div>
<h2> Task Statistics</h2>
<div class="chart-container">
    <canvas id="taskChart"></canvas>
</div>
<script id="teamData" type="application/json">
    <?= json_encode($teamData) ?>
</script>

<script id="taskData" type="application/json">
    <?= json_encode($taskData) ?>
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Load Chart.js library first -->
<script src="/js/teamChart.js"></script> <!-- Custom script to create the chart -->
<script src="/js/taskChart.js"></script> <!-- Custom script to create the chart -->