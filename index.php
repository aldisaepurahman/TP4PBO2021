<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if (isset($_POST['subject'])) {
	$otask->getTaskBySubject();
}
elseif (isset($_POST['priority'])) {
	$otask->getTaskByPriority();
}
elseif (isset($_POST['deadline'])) {
	$otask->getTaskByDeadline();
}
elseif (isset($_POST['status'])) {
	$otask->getTaskByStatus();
}
else{
	// Memanggil method getTask di kelas Task
	$otask->getTask();
}

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();

$otask->open();
if (isset($_POST['add'])) {
	if ($otask->insertTask($_POST)) {
		echo "<script>
        document.location=('index.php');
        </script>";
	}
}

if (isset($_GET['id_hapus'])) {
	$id = $_GET['id_hapus'];
	if ($otask->deleteTask($id)) {
		echo "<script>
        document.location=('index.php');
        </script>";
	}
}

if (isset($_GET['id_status'])) {
	$id = $_GET['id_status'];
	if ($otask->updateTask($id)) {
		echo "<script>
        document.location=('index.php');
        </script>";
	}
}
$otask->close();