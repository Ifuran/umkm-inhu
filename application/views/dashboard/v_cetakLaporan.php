<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	<title></title>
</head>
<body>
	<div class="heading pb-3">
		<h1 class="text-center">LAPORAN DATA UMKM KABUPATEN INDRAGIRI HULU</h1>				
		<table class="mt-5">		
			<tr>
				<td>Jumlah UMKM</td>
				<td>: <?= $jlh_umkm ?></td>      
			</tr>
			<tr>
				<td>Jumlah Pelaku UMKM</td>
				<td>: <?= $jlh_pelaku_usaha ?></td>      
			</tr>
			<tr>
				<td>Jumlah Sektor</td>
				<td>: <?= $jlh_sektor ?></td>      
			</tr>
			<tr>
				<td>Jumlah Kecamatan</td>
				<td>: <?= $jlh_kecamatan ?></td>      
			</tr>		
		</table>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>NO</th>			
				<th>NIK</th>
				<th>NO. KK</th>
				<th>NAMA</th>			
				<th>ALAMAT USAHA</th>
				<th>KECAMATAN</th>
				<th>SEKTOR</th>
				<th>BIDANG USAHA</th>
				<th>TELEPON</th>
			</tr>	
		</thead>
		<tbody>
			<?php $i=1;
			foreach ($umkm as $key => $value) { ?>
				<tr>
					<td><?= $i ?></td>
					<td><?= $value->nik ?></td>
					<td><?= $value->no_kk ?></td>
					<td><?= $value->user ?></td>
					<td><?= $value->umkm_desa  ?></td>
					<td><?= $value->kecamatan ?></td>
					<td><?= $value->sektor ?></td>
					<td><?= $value->bidang ?></td>
					<td><?= $value->no_telp ?></td>				
				</tr>
				<?php $i++; } ?>
		</tbody>
	</table>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>