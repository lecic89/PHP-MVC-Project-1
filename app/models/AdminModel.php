<?php

/**
 * Model koji odgovara tabeli admin
 * Nasleđuje apstraktnu klasu Model
 */
class AdminModel extends Model
{

	/**
	 * Metod koji se koristi za autentifikaciju administratora
	 * @param string $email
	 * @param string $passwordHash
	 * @return stdClass|NULL
	 */
	public static function getByEmailAndPasswordHash($email, $passwordHash)
	{
		$sql = 'SELECT * FROM admin WHERE email = ? AND password_hash = ?;';
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$email, $passwordHash]);
		return $pst->fetch(PDO::FETCH_OBJ);
	}

}
