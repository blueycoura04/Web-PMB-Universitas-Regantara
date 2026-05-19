<?php
include '../config/koneksi.php';
include '../config/session.php';

$data = mysqli_query($koneksi,"SELECT * FROM pendaftaran ORDER BY id_pendaftaran DESC");

include 'template/header.php';
include 'template/navbar.php';
?>

<div class="container py-4">

<h3 class="fw-bold">Data Pendaftar</h3>

<table class="table table-hover mt-3">
<thead class="table-dark">
<tr>
<th>Nama</th>
<th>No Pendaftaran</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $d['nama_lengkap'] ?></td>
<td><?= $d['no_pendaftaran'] ?></td>
<td><?= $d['status'] ?></td>
<td>
<a href="detail.php?id=<?= $d['id_pendaftaran'] ?>" class="btn btn-primary btn-sm">Detail</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>

<?php include 'template/footer.php'; ?>