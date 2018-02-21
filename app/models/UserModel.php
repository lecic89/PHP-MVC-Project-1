<?php

/**
 * Model koji odgovara tabeli user
 * Nasleđuje apstraktnu klasu Model
 */
class UserModel extends Model
{

	/**
	 * Metod koji se koristi za autentifikaciju korisnika
	 * @param string $email
	 * @param string $passwordHash
	 * @return stdClass|NULL
	 */
	public static function getByEmailAndPasswordHash($email, $passwordHash)
	{
		$sql = 'SELECT * FROM user WHERE email = ? AND password_hash = ?;';
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$email, $passwordHash]);
		return $pst->fetch(PDO::FETCH_OBJ);
	}

}
