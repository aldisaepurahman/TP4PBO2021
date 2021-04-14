<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Pengguna extends DB{
	
	// Mengambil data
	function getPengguna(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM pengguna";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertPengguna($data)
	{
		$nim = $data['nim'];
		$nama = $data['nama'];
		$username = $data['username'];
		$password = md5($data['password']);
		$kelas = $data['kelas'];
		$verified = FALSE;

		$sql = "INSERT INTO pengguna VALUES ('$nim', '$nama',
		'$username', '$password', '$kelas', '$verified')";

		return $this->execute($sql);
	}

	function deletePengguna($nim){
		$query = "DELETE FROM pengguna WHERE nim = '$nim'";

		return $this->execute($query);
	}

	function updatePengguna($nim){
		$query = "UPDATE pengguna SET verified = '1' WHERE nim = '$nim'";

		return $this->execute($query);
	}
}



?>
