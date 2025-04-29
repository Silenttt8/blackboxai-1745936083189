<?php include 'header.php'; ?>

<?php 
include '../koneksi.php';
?>
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Pesan Lapangan</h4>
		</div>
		<div class="panel-body">
			<div class="col-md-8 col-md-offset-2">
				<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
				<br/><br/>
				<form method="post" action="transaksi_aksi.php" enctype="multipart/form-data">
					<div class="form-group">
						<label>Tanggal Main</label>
						<input type="date" class="form-control" name="tanggal" required="required">
					</div>	

					<div class="form-group">
						<label>Durasi (Jam)</label>
						<input type="number" class="form-control" name="durasi" min="1" max="5" placeholder="Masukkan durasi dalam jam" required="required">
					</div>

					<div class="form-group">
						<label>Metode Pembayaran</label>
						<select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
							<option value="">- Pilih Metode Pembayaran -</option>
							<option value="DANA">DANA - 085123456789</option>
							<option value="OVO">OVO - 085123456789</option>
							<option value="GOPAY">GOPAY - 085123456789</option>
						</select>
					</div>

					<div class="form-group" id="bukti_pembayaran_div">
						<label>Bukti Pembayaran</label>
						<input type="file" class="form-control" name="bukti_pembayaran" accept="image/*">
						<small class="text-muted">Upload bukti transfer pembayaran (format: jpg, png)</small>
					</div>

					<br/>
					<input type="submit" class="btn btn-primary" value="Pesan Sekarang">
				</form>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
