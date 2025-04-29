<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Riwayat Pesanan Lapangan</h4>
		</div>
		<div class="panel-body">

			<a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Pesan Lapangan</a>
			
			<br/><br/>

			<table class="table table-bordered table-striped">
				<tr>
					<th>No</th>
					<th>Invoice</th>
					<th>Tanggal Main</th>
					<th>Durasi</th>
					<th>Total Bayar</th>
					<th>Metode Bayar</th>
					<th>Status</th>				
					<th>Opsi</th>
				</tr>

				<?php 
				include '../koneksi.php';
				// ambil username yang login
				$username = $_SESSION['username'];
				
				$data = mysqli_query($koneksi,"SELECT * FROM transaksi WHERE transaksi_pelanggan='$username' ORDER BY transaksi_id DESC");
				$no = 1;
				while($d=mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td>INV-<?php echo $d['transaksi_id']; ?></td>
						<td><?php echo date('d/m/Y', strtotime($d['transaksi_tgl'])); ?></td>
						<td><?php echo $d['transaksi_durasi']; ?> Jam</td>
						<td><?php echo "Rp. ".number_format($d['transaksi_harga']) ." ,-"; ?></td>
						<td>
							<?php 
							if($d['metode_pembayaran']){
								echo $d['metode_pembayaran'];
								if($d['bukti_pembayaran']){
									echo "<br><small><a href='../uploads/".$d['bukti_pembayaran']."' target='_blank'>Lihat Bukti</a></small>";
								}
							}else{
								echo "-";
							}
							?>
						</td>
						<td>
							<?php 
							if($d['transaksi_lap']=="0"){
								echo "<span class='label label-warning'>Menunggu Konfirmasi</span>";
							}else{
								echo "<span class='label label-success'>Dikonfirmasi</span>";
							}
							?>
						</td>		
						<td>
							<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank" class="btn btn-sm btn-warning">Invoice</a>
							<?php if($d['transaksi_lap']=="0"){ ?>
							<a href="transaksi_batal.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">Batalkan</a>
							<?php } ?>
						</td>
					</tr>
					<?php 
				}
				?>
			</table>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
