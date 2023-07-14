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
							<h3><?php echo $karyawan ?></h3>
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
								<div class="small-box bg-danger">
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
									<?php if ($this->session->userdata('role') != '2') { ?>
										<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
				<div style="width: 700px; height: 500px">
					<canvas id="barChart" style="width: 100%; height: 100%;"></canvas>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<style>
		.small-chart {
			width: 570px;
			height: 570px;
		}
	</style>

	<script>
		// Membuat chart berdasarkan gender

		// Mendapatkan data dari PHP dan mengubahnya menjadi array JavaScript
		var chartData = <?php echo json_encode($chartData); ?>;

		// Membuat array untuk label dan nilai dari grafik
		var labels = [];
		var values = [];

		// Mengisi array label dan nilai dari data
		for (var i = 0; i < chartData.length; i++) {
			labels.push(chartData[i].nama_karyawan);
			values.push(chartData[i].jam);
		}

		// Menghasilkan array warna yang berbeda untuk setiap balok
		var colors = generateColors(chartData.length);

		// Membuat bar chart menggunakan Chart.js
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

		// Fungsi untuk memperbarui chart berdasarkan bulan dan tahun yang dipilih
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

			// Mengupdate chart dengan data yang difilter
			chart.data.labels = filteredLabels;
			chart.data.datasets[0].data = filteredValues;
			chart.update();
		}

		// Fungsi untuk menghasilkan array warna yang berbeda
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


</body>

</html>