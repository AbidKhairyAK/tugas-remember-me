<?php
	$connect = mysqli_connect("localhost", "root", "", "pondok_it"); // <-- Digunakan untuk connect ke database mysql
	$email = $_POST['email']; // <-- Untuk mengambil data dari input html yang mempunyai name 'email'
	$password = $_POST['password']; // <-- Untuk mengambil data dari input html yang mempunyai name 'password'
	
	if(!empty($email) && !empty($password)){ // <-- Digunakan untuk memastikan email dan password benar
		$sql = mysqli_query($connect, "SELECT * FROM user WHERE email='$email' AND password='$password'"); // <-- Digunakan untuk mengambil data dari database sesuai dengan permintaan user
		$result = mysqli_num_rows($sql); // <-- Untuk menghitung jumlah baris hasil dari kode "mysqli_query" = menghasilkan integer, dalam kasus ini 0 atau 1
		
		if ($result){ // <-- Untuk memeriksa apakah angkanya 0 / false atau 1 / true, yang dibutuhkan oleh kode "if()" adalah "0" atau "1" 
			$row = mysqli_fetch_array($sql); // <-- Untuk mengubah hasil dari kode "mysqli_query" menjadi array dengan aturan = field table dijadikan index array dan value table dijadikan value array
			
			session_start(); // <-- digunakan untuk memulai kode $_SESSION, untuk versi PHP lama harus ditempatkan di baris pertama
			$_SESSION['login'] = true; // <-- Digunakan untuk mengecek di file lain apakah sudah pernah login disini atau belum
			$_SESSION['email'] = $email; // <-- Digunakan untuk mendaftarkan email ke $_SESSION
			$_SESSION['pass'] = $password; // <-- Digunakan untuk mendaftarkan password ke $_SESSION
			$_SESSION['nama'] = $row['nama']; // <-- Digunakan untuk mendaftarkan nama user ke $_SESSION

			if (isset($_POST['checkbox'])){
				setcookie("cookie_user",$email, time() + (365 * 24 * 60 * 60));
				setcookie("cookie_pass",$password, time() + (365 * 24 * 60 * 60));
				setcookie("cookie_name",$_SESSION['nama'], time() + (365 * 24 * 60 * 60));
			}
			
			header("Location:home.php"); // <-- digunakan untuk otomatis mengarahkan halaman menuju halaman yang dituju seperti penggunaan "<a href=''>"
		} else {
			echo "Email & Password salah";
		}
	} else {
		echo "Email dan Password anda kosong, silahkan diisi.";
	}

?>