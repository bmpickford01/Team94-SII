<?php
	function checkLogin($email, $password){
		require 'setPDO.inc';


		$salt = $pdo->prepare('SELECT USER_TB.salt
								FROM TEAM94.USER_TB
								WHERE USER_TB.email = :email');

		$salt->bindvalue(':email', $email);
		$salt->execute();

		$salt = $salt->fetch();

		$query = "SELECT * FROM TEAM94.USER_TB WHERE USER_TB.email = :email AND USER_TB.password = SHA2(CONCAT(:password, :salt), 0)";
		$query = $pdo->prepare($query);

		$query->bindvalue(':email', $email);
		$query->bindvalue(':password', $password);
		$query->bindvalue(':salt', $salt['salt']);
		$query->execute();

		if($query->rowCount() > 0) {
			session_start();
			foreach($query as $result) {
				$_SESSION['id'] = $result['userID'];
				$_SESSION['userType'] = $result['userType'];
			}
		}

		return $query->rowCount() > 0;

	}

?>
