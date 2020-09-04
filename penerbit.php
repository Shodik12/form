<html>
<title>Data Penerbit Buku</title>
<head>

<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <meta name="HandheldFriendly" content="true">


<!--- ccs file ---> 
<link rel="stylesheet" href="/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">





<!--- js file ---> 
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>





</head>
<body>
<nav>
        <div class="card">
<div class="card-body">
        <div class="container">
          <a href="penerbit.php" class="brand-logo center white-text">Back To Home</a>
        </div>
        </div>
</nav>
<div class="container" style="margin-top:8%">
	<div class="row">
		<div class="col-md-8 col-md-offset-2"> 
			<p>
				<center>
					<h5 class="card-title">Data Penerbit Buku</h5>
				</center>
			</p>
			
			<form action="penerbit.php" method="get">

	<label>Cari :</label>

	<input name="cari" placeholder="Cari penerbit"></input>

	<input class="btn btn-secondary" type="submit" value="Cari">

</form>

 



<div class="form-group">

			 <a class='btn btn-primary' href="tambah.php">Tambah</a>
			</div>
<br>
			<table class="table  table-striped table-bordered">
				<tr>

					<th>
						No 
					</th>
					<th>
						Penerbit
					</th>
					<th>
Action
</th>
				</tr>
					<?php
						include"koneksi.php";

	// Cek apakah terdapat data page pada URL
					$page = (isset($_GET['page']))? $_GET['page'] : 1;
					
					$limit = 5; // Jumlah data per halamannya
					
					// Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
					$limit_start = ($page - 1) * $limit;
					
					// Buat query untuk menampilkan data siswa sesuai limit yang ditentukan
					$data = mysqli_query($koneksi, "SELECT * FROM penerbit LIMIT ".$limit_start.",".$limit);
					

						$no = 1;








						while ($row = mysqli_fetch_array ($data))
						{
					?>
				<tr>
					<td>
						<?php echo $no++; ?>
					</td>
					<td>
						<?php echo $row['penerbit']; ?>
					</td>
			
<td>

          <a class='btn btn-primary' href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
|
              <a class='btn btn-danger' href="hapus.php?id=<?php echo $row['id']; ?>">Hapus</a>

        </td>






					
				</tr>
				<?php
					}
				?>
			</table>





			
			<?php 

if(isset($_GET['cari'])){

	$cari = $_GET['cari'];

	echo "<b>Hasil pencarian : ".$cari."</b>";

}
?>

			<table class="table  table-striped table-bordered">
				<tr>

					<th>
						No 
					</th>
					<th>
						Penerbit
					</th>
					<th>
Action
</th>
				</tr>
					

<?php if (ISSET($_GET['cari'])){ $cari = $_GET['cari']; $query2 = "SELECT * FROM penerbit WHERE penerbit LIKE '%$cari%'"; $sql = mysqli_query($koneksi, $query2);
$no = 1;
 while ($caripenerbit = mysqli_fetch_array($sql)){ 

?> 
<tr> 
<td>
<?php echo $no++; ?></td>
 <td>
<?php echo $caripenerbit['penerbit']; ?></td> 

<td>

          <a class='btn btn-primary' href="edit.php?id=<?php echo $caripenerbit['id']; ?>">Edit</a>
|
              <a class='btn btn-danger' href="hapus.php?id=<?php echo $caripenerbit['id']; ?>">Hapus</a>

        </td>

</tr> 

<?php }} ?>
			</table>



<!--
			-- Buat Paginationnya
			-- Dengan bootstrap, kita jadi dimudahkan untuk membuat tombol-tombol pagination dengan design yang bagus tentunya
			-->
			<nav aria-label="Page navigation example"> 
<ul class="pagination">
				<!-- LINK FIRST AND PREV -->
				<?php
				if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
				?>
					<li class="page-item"><a class="page-link" href="#">First</a></li>
					<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
				<?php
				}else{ // Jika page bukan page ke 1
					$link_prev = ($page > 1)? $page - 1 : 1;
				?>
<li class="page-item"><a class="page-link" href="penerbit.php?page=1 ">First</a></li>
					<li class="page-item"><a class="page-link" href="penerbit.php?page=<?php echo $no;?>">&laquo;</a></li>


				<?php
					
				}
				?>
				
				<!-- LINK NUMBER -->
				<?php
				// Buat query untuk menghitung semua jumlah data
				$sql2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM penerbit");
				$get_jumlah = mysqli_fetch_array($sql2);
				
				$jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
				$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
				
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
				?>



					<li class="page-item" <?php echo $link_active; ?>><a class="page-link" href="penerbit.php?page=<?php echo $i;?>" ><?php echo $i; ?></a></li>
				<?php
				}
				?>
				
				<!-- LINK NEXT AND LAST -->
				<?php
				// Jika page sama dengan jumlah page, maka disable link NEXT nya
				// Artinya page tersebut adalah page terakhir 
				if($page == $jumlah_page){ // Jika page terakhir
				?>
					<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
					<li class="page-item"><a class="page-link" href="#">Last</a></li>
				<?php
				}else{ // Jika Bukan page terakhir
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
				?>

<li class="page-item"><a class="page-link" href="penerbit.php?page=<?php echo $link_next; ?>">&raquo;</a></li>

<li class="page-item"><a class="page-link" href="penerbit.php?page=<?php echo $jumlah_page; ?>">Last</a></li>

					
				<?php
				}
				?>
			</ul></nav>







		</div>
	</div>
</div>
</div>
</body>




</html>
