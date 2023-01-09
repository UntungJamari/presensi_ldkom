<?php class Config
{

	private $host = "localhost";
	private $db_name = "db_ldkom";
	private $username = "root";
	private $password = "";
	public $conn;

	public function getConnection()
	{

		$this->conn = null;

		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		} catch (PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
		}

		return $this->conn;
	}
} ?>
<?php
/**********MYSQL Settings****************/
$host = "localhost";
$databasename = "ldkom";
$user = "root";
$pass = "";
/**********MYSQL Settings****************/


$koneksi = new mysqli($host, $user, $pass, $databasename) or die("Gagal koneksi ke server");



?>
