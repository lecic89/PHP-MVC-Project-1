<?php

/**
 * Model koji odgovara tabeli service
 * Nasleđuje apstraktnu klasu Model
 */
class ServiceModel extends Model
{

	/**
	 * Metod koji vraća red sa odgovarajućim ID parametrom iz tabele gde je active = 1
	 * @param int $id
	 * @return stdClass|NULL
	 */
	public static function getActiveById($id)
	{
		$sql = 'SELECT
				service.id,
				user_id AS user_id,
				CONCAT_WS(\' \', user.first_name, user.last_name) AS `user`,
				vehicle.name AS vehicle,
				from_city.name AS from_city,
				to_city.name AS to_city,
				`at` AS `at`,
				service.description,
				service.active
				FROM service
				LEFT JOIN user ON service.user_id = user.id
				LEFT JOIN vehicle ON service.vehicle_id = vehicle.id
				LEFT JOIN city AS from_city ON from_city.id = service.from_city_id
				LEFT JOIN city AS to_city ON to_city.id = service.to_city_id
				WHERE service.id = ? AND active = 1
				ORDER BY `at` ASC
				;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji vraća sve redove iz tabele gde je polje active = 1
	 * Funkcija CONCAT_WS je specifična za MySQL server, u slučaju promene na
	 * Oracle SQL ili neki drugi server obavezno je zameniti sa odgovarajućom
	 * funkcijom, npr. običan CONCAT
	 * @return array
	 */
	public static function getAllActive()
	{
//		$sql = 'SELECT * FROM service WHERE active = 1 ORDER BY `at` ASC;';
		$sql = 'SELECT
				service.id,
				user_id AS user_id,
				CONCAT_WS(\' \', user.first_name, user.last_name) AS `user`,
				vehicle.name AS vehicle,
				from_city.name AS from_city,
				to_city.name AS to_city,
				`at` AS `at`
				FROM service
				LEFT JOIN user ON service.user_id = user.id
				LEFT JOIN vehicle ON service.vehicle_id = vehicle.id
				LEFT JOIN city AS from_city ON from_city.id = service.from_city_id
				LEFT JOIN city AS to_city ON to_city.id = service.to_city_id
				WHERE active = 1 ORDER BY `at` ASC
				;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute();
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji ažurira postojeće redove u tabeli
	 * Setuje vrednost active = 0 ako je isteklo predviđeno vreme polaska transportera
	 * @return TRUE|FALSE
	 */
	public static function removeAllExpired()
	{
		$sql = 'UPDATE service SET active = 0 WHERE `at` < NOW() AND active = 1;';
		$pst = DB::getInstance()->prepare($sql);
		return $pst->execute();
	}

	/**
	 * Metod koji vraća aktivni red sa odgovarajućim user_id parametrom iz tabele
	 * @param int $user_id
	 * @return stdClass|NULL
	 */
	public static function getByUserId($user_id)
	{
		$sql = 'SELECT * FROM service WHERE user_id = ? AND active = 1;';
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$user_id]);
		return $pst->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji uklanja red iz tabele na osnovu user_id parametra
	 * @param type $user_id
	 * @return TRUE|FALSE
	 */
	public static function deleteByUserId($user_id)
	{
		$sql = 'DELETE FROM service WHERE user_id = ?;';
		$pst = DB::getInstance()->prepare($sql);
		return $pst->execute([$user_id]);
	}

}
