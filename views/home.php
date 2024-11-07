<h1>Base MVC</h1>
<p>Welcome to this base MVC project.</p>

<h2>Team Statistics</h2>
<canvas id="teamChart" width="400" height="200"></canvas>

<script id="teamData" type="application/json">
    <?= json_encode($teamData) ?>
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Load Chart.js library first -->
<script src="/js/teamChart.js"></script> <!-- Custom script to create the chart -->