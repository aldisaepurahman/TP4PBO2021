<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function getTaskBySubject(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY subject_td";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskByPriority(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY priority_td";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskByDeadline(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY deadline_td";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskByStatus(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY status_td";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertTask($data)
	{
		$nama = $data['tname'];
		$deadline = $data['tdeadline'];
		$details = $data['tdetails'];
		$subject = $data['tsubject'];
		$priority = $data['tpriority'];
		$status = "Belum";

		$sql = "INSERT INTO tb_to_do (name_td, deadline_td, details_td,
		subject_td, priority_td, status_td) VALUES ('$nama', '$deadline',
		'$details', '$subject', '$priority', '$status')";

		return $this->execute($sql);
	}

	function deleteTask($id){
		$query = "DELETE FROM tb_to_do WHERE id = '$id'";

		return $this->execute($query);
	}

	function updateTask($id){
		$query = "UPDATE tb_to_do SET status_td = 'Sudah' WHERE id = '$id'";

		return $this->execute($query);
	}
}



?>
