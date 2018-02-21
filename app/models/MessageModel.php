<?php

/**
 * Model koji odgovara tabeli message
 * Nasleđuje apstraktnu klasu Model
 */
class MessageModel extends Model
{

	/**
	 * Metod koji ažurira postojeći red u tabeli
	 * Setuje vrednost status polja na 1 (poruka pročitana)
	 * @param int $id
	 * @return TRUE|FALSE
	 */
	public static function markAsRead($id)
	{
		$sql = 'UPDATE message set `status` = 1 WHERE id = ?;';
		$pst = DB::getInstance()->prepare($sql);
		if ($pst->execute([$id]))
		{
			return DB::getInstance()->lastInsertId();
		}
		else
		{
			return FALSE;
		}
	}

}
