<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengguna.class.php");

// Membuat objek dari kelas task
$pengguna = new Pengguna($db_host, $db_user, $db_password, $db_name);
$pengguna->open();

$pengguna->getPengguna();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($nim, $nama, $username, $password, $kelas, $verified) = $pengguna->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($verified == 1){
		$status = "Sudah";
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $nim . "</td>
		<td>" . $nama . "</td>
		<td>" . $username . "</td>
		<td>" . $kelas . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?nim_hapus=" . $nim . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$status = "Belum";
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $nim . "</td>
		<td>" . $nama . "</td>
		<td>" . $username . "</td>
		<td>" . $kelas . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?nim_hapus=" . $nim . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?nim_status=" . $nim .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$pengguna->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();

$pengguna->open();
if (isset($_POST['add'])) {
	if ($pengguna->insertPengguna($_POST)) {
		echo "<script>
        document.location=('index.php');
        </script>";
	}
}

if (isset($_GET['nim_hapus'])) {
	$nim = $_GET['nim_hapus'];
	if ($pengguna->deletePengguna($nim)) {
		echo "<script>
        document.location=('index.php');
        </script>";
	}
}

if (isset($_GET['nim_status'])) {
	$nim = $_GET['nim_status'];
	if ($pengguna->updatePengguna($nim)) {
		echo "<script>
        document.location=('index.php');
        </script>";
	}
}
$pengguna->close();