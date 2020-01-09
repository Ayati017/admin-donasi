<html>
	<head>
		<title>Data Donasi</title>
		<style>
			.body-laporan {
				border:solid 1px #CCCCCC;
				width:1000px;
				height:auto;
				margin: 0 auto;
			}
			.data-laporan th{
				text-align:justify;
				width:150px;
			}
			.data-laporan td {
				width:300px;
			}
			.header-lap img {
				margin-top:30px;
				margin-left:40px;
			}
			.header-lap h2 {
				margin-top:-100px;
				text-align:center;
				font-family:Arial;
			}
			.header-lap h3 {
				margin-top:-10px;
				text-align:center;
				font-family:Arial;
			}
			.header-lap h4 {
				margin-top:-10px;
				text-align:center;
				font-family:Arial;
			}
			.header-lap h1 {
				float:right;
				font-family:Arial;
				margin-top:-100px;
			}
		</style>
	</head>
		
		<body onLoad="window.print()">
			<div class="body-laporan">
				<div class="header-lap">
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<h2>Data Donasi</h2>
					
				</div> <hr style="width:950px;" />
				<div class="data-laporan">
				
					<table class="table table-bordered table-hover table-striped" border="1">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Donatur</th>
								<th>Waktu Donasi</th>
								<th>Bukti Transfer</th>
								<th>Status</th>
								<th>Nama Panti</th>
								<th>Jumalah Donasi</th>
							</tr>
						</thead>
						<?php $total=0; $i = 1; foreach($donasi as $donasi):
						
					  ?>
						<tr>
							<td><?php echo $i ?></td>

							<td><?php echo $donasi->nama_donatur?></td>
							<td><?php echo $donasi->waktu_donasi ?></td>
							<td>
								<?php if ($donasi->bukti_tf != "") { ?>
								<img src="<?php echo base_url('assets/upload/image/'.$donasi->bukti_tf) ?>" class="img img-thumbnail" width="60">
								<?php }else{ echo 'tidak ada'; } ?>
								
							</td>
							<td><?php echo $donasi->status ?></td>
							<td><?php echo $donasi->nama_panti?></td>
							<td style="text-align:right;">Rp <?= number_format($donasi->jumlah_donasi,2,',','.'); ?></td>
						</tr>
					  <?php
					    $total=$total+$donasi->jumlah_donasi;
						endforeach; ?>
						<tfoot>
							<tr>
								<th>Total Donasi</th>
								<th colspan="6" style="text-align:right;">Rp <?= number_format($total,2,',','.'); ?></th>
							</tr>
						</tfoot>
						<br/><br/>
					
			</div>
		</body>
</html>
