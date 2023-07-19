<!DOCTYPE html>
<html>

<head>
	<title>Karyawan Dashboard</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels"></script>

</head>

<body>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $karyawan ?> </h3>
							<p>Jumlah Karyawan</p>
						</div>
						<div class="icon">
							<i class="bi bi-people-fill"></i>
						</div>
						<?php if ($this->session->userdata('role') != '2') { ?>
							<a href="<?php echo site_url('karyawan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						<?php } ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?php echo $unit ?><sup style="font-size: 20px"></sup></h3>
							<p>Jumlah Unit</p>
						</div>
						<div class="icon">
							<i class="bi bi-list-task"></i>
						</div>
						<?php if ($this->session->userdata('role') != '2') { ?>
							<a href="<?php echo site_url('unit') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						<?php } ?>
					</div>
				</div>

				<?php if ($this->session->userdata('role') == '3' or $this->session->userdata('role') == '5') { ?>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<?php if ($this->session->userdata('role') == '3') { ?>
							<div class="small-box bg-warning">
							<?php } ?>
							<?php if ($this->session->userdata('role') == '5') { ?>
								<div class="small-box bg-warning">
								<?php } ?>
								<div class="inner">
									<h3><?php echo $jumlah; ?></h3>
									<p>Timesheet DITOLAK</p>
								</div>
								<div class="icon">
									<i class="bi bi-clock"></i>
								</div>
								<?php if ($this->session->userdata('role') != '2') { ?>
									<?php if ($this->session->userdata('role') == '3') { ?>
										<a href="<?php echo site_url('supervisor/ditolak') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
									<?php } ?>
									<?php if ($this->session->userdata('role') != '3') { ?>
										<a href="<?php echo site_url('timesheet/ditolak') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
									<?php } ?>
								<?php } ?>
								</div>
							</div>
						<?php } ?>
						<?php if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '2' or $this->session->userdata('role') == '5') { ?>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="small-box bg-secondary">
									<div class="inner">
										<h3><?php echo $timesheet ?></h3>
										<p>Jumlah Timesheet</p>
									</div>
									<div class="icon">
										<i class="bi bi-pencil-square"></i>
									</div>
									<?php if ($this->session->userdata('role') != '2') { ?>
										<?php if ($this->session->userdata('role') == '3') { ?>
											<a href="<?php echo site_url('supervisor') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
										<?php } ?>
										<?php if ($this->session->userdata('role') != '3') { ?>
											<a href="<?php echo site_url('timesheet') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
						<?php if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '2') { ?>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="small-box bg-warning">
									<div class="inner">
										<?php foreach ($jam as $dt) : ?>
											<h3><?php echo $dt['jam']; ?></h3>
										<?php endforeach ?>
										<p>Total Jam Kerja</p>
									</div>
									<div class="icon">
										<i class="bi bi-clock"></i>
									</div>
									<?php if ($this->session->userdata('role') == '1') { ?>
										<a href="<?php echo site_url('rangkuman') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
									<?php } ?>
								</div>
							</div>
						<?php } ?>

						<?php if ($this->session->userdata('role') == '3') { ?>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="small-box bg-danger">
									<div class="inner">
										<h3><?php echo $total; ?></h3>
										<p>Timeheet Belum di Validasi</p>
									</div>
									<div class="icon">
										<i class="bi bi-clock"></i>
									</div>
									<?php if ($this->session->userdata('role') != '2') { ?>
										<?php if ($this->session->userdata('role') == '3') { ?>
											<a href="<?php echo site_url('supervisor/kosong') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
										<?php } ?>
										<?php if ($this->session->userdata('role') != '3') { ?>
											<a href="<?php echo site_url('timesheet') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
						<?php } ?>

					</div>
			</div>
	</section>
	<hr>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="chart-container small-chart">
					<canvas id="genderChart"></canvas>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="chart-container small-chart">
					<canvas id="doughnutChart"></canvas>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="chart-container small-chart">
					<canvas id="barChart" style="width: 100%; height: 100%;"></canvas>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="chart-container small-chart">
					<canvas id="lineChart" style="width: 100%; height: 100%;"></canvas>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<style>
		.small-chart {
			width: 570px;
			height: 570px;
			margin-left: 130px;
		}

		.text-center {
			width: 570px;
			height: 570px;
		}

		.margin-left {
			margin-left: 130px;
		}
	</style>

	<script>
		var chartData = <?php echo json_encode($chartData); ?>;
		var labels = [];
		var values = [];
		for (var i = 0; i < chartData.length; i++) {
			labels.push(chartData[i].nama_karyawan);
			values.push(chartData[i].jam);
		}
		var colors = generateColors(chartData.length);
		var barData = {
			labels: labels,
			datasets: [{
				data: values,
				backgroundColor: colors,
			}]
		};
		var barConfig = {
			type: 'bar',
			data: barData,
			options: {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'TOP 5 Karyawan Terbaik bulan ini'
					}
				},
				scales: {
					y: {
						beginAtZero: true,
						ticks: {
							stepSize: 1
						}
					}
				}
			}
		};
		var barCtx = document.getElementById('barChart').getContext('2d');
		var chart = new Chart(barCtx, barConfig);

		function updateChart() {
			var selectedMonth = document.getElementById('bulan').value;
			var selectedYear = document.getElementById('tahun').value;
			var filteredLabels = [];
			var filteredValues = [];

			for (var i = 0; i < chartData.length; i++) {
				var monthYear = chartData[i].bulan.toLowerCase();
				var month = monthYear.split(' ')[0];

				if ((selectedMonth === 'all' || month === selectedMonth) &&
					(selectedYear === '' || chartData[i].bulan.includes(selectedYear))) {
					filteredLabels.push(chartData[i].bulan);
					filteredValues.push(chartData[i].jam);
				}
			}
			chart.data.labels = filteredLabels;
			chart.data.datasets[0].data = filteredValues;
			chart.update();
		}

		function generateColors(length) {
			var colors = [];

			for (var i = 0; i < length; i++) {
				var r = Math.floor(Math.random() * 255);
				var g = Math.floor(Math.random() * 255);
				var b = Math.floor(Math.random() * 255);

				colors.push('rgb(' + r + ', ' + g + ', ' + b + ')');
			}

			return colors;
		}
	</script>
	<script>
		var genderData = {
			labels: [
				<?php foreach ($genderData as $data) : ?> "<?php echo $data['jenis_kelamin']; ?> (<?php echo $data['total']; ?>)",
				<?php endforeach; ?>
			],
			datasets: [{
				data: [
					<?php foreach ($genderData as $data) : ?>
						<?php echo $data['percentage']; ?>,
					<?php endforeach; ?>
				],
				backgroundColor: ['blue', 'rgb(250,100,120)'],

			}]
		};

		var genderConfig = {
			type: 'pie',
			data: genderData,
			options: {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Karyawan Gender Distribution'
					},
					tooltip: {
						callbacks: {
							label: function(context) {
								var label = context.label || '';

								if (label) {
									label += ': ';
								}
								if (context.parsed) {
									label += context.dataset.data[context.dataIndex] + '%';
								}

								return label;
							}
						}
					}
				}
			}
		};

		var genderCtx = document.getElementById('genderChart').getContext('2d');
		new Chart(genderCtx, genderConfig);
	</script>
	<script>
		// Data Array
		var data = <?php echo json_encode($jenis); ?>;

		// Mengambil data jenis perusahaan dan jumlah unit
		var jenis = [];
		var jumlahUnit = [];
		for (var i = 0; i < data.length; i++) {
			jenis.push(data[i].perusahaan);
			jumlahUnit.push(parseInt(data[i].jumlah_unit));
		}

		// Fungsi untuk menghasilkan warna acak
		function getRandomColor() {
			var letters = '0123456789ABCDEF';
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += letters[Math.floor(Math.random() * 16)];
			}
			return color;
		}

		// Menghasilkan array warna acak
		var randomColors = [];
		for (var i = 0; i < jenis.length; i++) {
			randomColors.push(getRandomColor());
		}

		// Membuat doughnut chart
		var ctx = document.getElementById('doughnutChart').getContext('2d');
		var doughnutChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: jenis,
				datasets: [{
					data: jumlahUnit,
					backgroundColor: randomColors,
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					title: {
						display: true,
						text: 'Jumlah Unit Kontraktor'
					}
				},
				legend: {
					position: 'bottom',
					labels: {
						fontColor: 'black',
						fontSize: 12,
						boxWidth: 10
					}
				}
			}
		});
	</script>

	<script>
		var data = <?php echo json_encode($hm_bulan); ?>;

		var chartData = [];
		data.forEach(function(item) {
			chartData.push({
				x: item.bulan,
				y: parseFloat(item.total_selisih)
			});
		});

		var ctx = document.getElementById('lineChart').getContext('2d');
		new Chart(ctx, {
			type: 'line',
			data: {
				labels: '',
				datasets: [{
					data: chartData,
					label: 'Timeseries Data',
					borderColor: 'rgba(75, 192, 192, 1)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Line Chart Example'
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}],
					xAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script>





</body>

</html>