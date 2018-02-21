<?php

/**
 * Model koji odgovara tabeli offer
 * Nasleđuje apstraktnu klasu Model
 */
class OfferModel extends Model
{

	/**
	 * Metod koji vraća sve redove iz tabele gde je service_id odgovarajuće vrednosti
	 * Funkcija CONCAT_WS je specifična za MySQL server, u slučaju promene na
	 * Oracle SQL ili neki drugi server obavezno je zameniti sa odgovarajućom
	 * funkcijom, npr. običan CONCAT
	 * @return array
	 */
	public static function getAllByServiceId($id)
	{
		$sql = 'SELECT
				offer.id,
				offer.user_id AS user_id,
				CONCAT_WS(\' \', user.first_name, user.last_name) AS `user`,
				offer.price AS price,
				offer.description AS description
				FROM offer
				LEFT JOIN user ON offer.user_id = user.id
				LEFT JOIN service ON offer.service_id = service.id
				WHERE
				offer.service_id = ?
				ORDER BY `at` ASC
				;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji vraća broj ponuda koje imaju istog korisnika i istu uslugu
	 * @param int $id
	 * @return int
	 */
	public static function getCountById($service_id, $user_id)
	{
		$sql = 'SELECT id FROM offer WHERE service_id = ? AND user_id = ? ORDER BY id DESC;';
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$service_id, $user_id]);
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji uklanja ponude koje imaju određene id parametre
	 * @param array $ids
	 * @return TRUE|FALSE
	 */
	public static function deleteByIds($ids)
	{
		$placeholders = array_fill(0, count($ids), '?');
		$sql = 'DELETE FROM offer WHERE id IN ('.implode(',', $placeholders).');';
		$pst = DB::getInstance()->prepare($sql);
		return $pst->execute($ids);
	}

}
