<!DOCTYPE HTML>
<html>
	<head>
		<title>NGO Guard</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
		
		<style>
			meter{
				margin: 0 auto 1.2em;
				display: block;
				width: 300px;
				height: 69px;
			}
			meter::-webkit-meter-bar {
				background: none;
				background-color: lightgrey;
				box-shadow: 0 3px 3px -3px #333 inset;
			}
			meter::-webkit-meter-optimum-value {
				box-shadow: 0 3px 3px -3px #999 inset;
				background-image: linear-gradient( 90deg, #262f3d 5%, #262f3d 5%, #262f3d 15%, #262f3d 15%, #262f3d 55%, #262f3d 55%, #262f3d 95%, #262f3d 95%, #262f3d 100%);
				background-size: 100% 100%;
			}
			.center {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 69px;
			}
			.center1{
				justify-content: center;
				align-items: center;
				height: auto;
			}
		</style>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="">
							<span class="icon"><img src="images/shield-2-64.ico" alt="" /></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>NGO Guard</h1>
								<p>Your donations, secured.</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#NGO">NGO Guard</a></li>
								<li><a href="#contact">Feedback</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- NGO Guard -->
							<article id="NGO">
								<h2 class="major">NGO Guard</h2>
								<label>Enter NGO ID:</label>
								<form name="form" action="#det" method="post">
									<input type="text" id="ngo_id" name="ngo_id" required>
									<br>
									<button>Check Now</button>
								</form>
							</article>
							
							<article id="det">
								<?php include 'ngo_det.php';?>
							</article>

							<article id="meter">
								<h2 class="major" style="display: inline-block">Insights</h2><h5 style="display: inline-block">(2020-Current)</h5>
								<br>
								<h3>Total Funding Secured: &#8377;
								<?php include 'tot_fund.php';
									echo $tot;?>
								</h3>

								<canvas id="donut" style="width:100%;max-width:700px"></canvas>
								
								<script>
									var xValues = ["India Public", "India Govt.", "Overseas"];
									var yValues = [ <?php echo $pt['sum(AMOUNT)']?>,  <?php echo $gt['sum(AMOUNT)']?>, <?php echo $ost['sum(AMOUNT)']?>];
									var barColors = ["#393b46", "#262f3d", "#5e646f"];

									new Chart("donut", {
										type: "doughnut",
										data: {
											labels: xValues,
											datasets: [{
											backgroundColor: barColors,
											data: yValues
											}]
										},
										options: {
											title: {
											display: true,
											text: "Fund Distribution"
											}
										}
									});
									Chart.defaults.global.defaultFontColor = "#fff"
								</script>
								<br>
								<br>
								<h3>Transaction Details</h3>
								<table>
									<thead>
										<th>Date Of Transaction</th>
										<th>Location</th>
										<th>Amount (&#8377;)</th>
									</thead>
									<tbody>
										<?php include 'trans_det.php';?>
									</tbody>
								</table>
								<br>
								<br>
								<h3>Donation Trends</h3>
								<div class = "center1">
									<canvas id="line" style="width:100%;max-width:600px"></canvas>
								</div>

								<script>
									var xarr = new Array();
									var yarr = new Array();
									var vals = <?php echo json_encode($dp); ?>;
									for(let i = 0; i < vals.length; i++){
										xarr[i] = vals[i].DATE_OF_TXN;
										yarr[i] = vals[i].AMOUNT;
									}
									new Chart("line", {
									type: "line",
									data: {
										labels: xarr,
										datasets: [{
											fill: false,
											lineTension: 0.36,
											backgroundColor: "rgba(0,0,255,1.0)",
											borderColor: "#5e646f",
											pointBackgroundColor: "#FFF",
											data: yarr
										}]
									},
									options: {
										legend: {display: false}
									}
									});
								</script>
								<br>
								<br>

								<h2 class="major">NGO-Guard Rating</h2>
								<?php include 'ngo_rate.php';?>
								<br>
							</article>

						<!-- Contact -->
							<article id="contact">
								<h2 class="major">Help Us Improve</h2>
								<form method="post" action="mailto:profitorigin8@gmail.com">
									<div class="fields">
										<div class="field half">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" />
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="message" rows="4"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</form>
								<ul class="icons">
									<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
								</ul>
							</article>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Divyaansh Agarwal - 20BPS1128</a>.</p>
					</footer>
			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
