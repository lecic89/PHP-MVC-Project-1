<?php

/**
 * Model koji odgovara tabeli shipment
 * Nasleđuje apstraktnu klasu Model
 */
class ShipmentModel extends Model
{

	/**
	 * Metod koji vraća sve redove iz tabele za odgovarajući ID
	 * Funkcija CONCAT_WS je specifična za MySQL server, u slučaju promene na
	 * Oracle SQL ili neki drugi server obavezno je zameniti sa odgovarajućom
	 * funkcijom, npr. običan CONCAT
	 * @return array
	 */
	public static function getAllById($id)
	{
		$sql = 'SELECT
				shipment.id,
				shipment.service_id AS service_id,
				shipment.offer_id AS offer_id,
				offer.price AS price,
				offer.description AS description,
				service.`at` AS start_time,
				from_city.name AS from_city,
				to_city.name AS to_city,
				vehicle.name AS vehicle,
				user.id AS user_id,
				CONCAT_WS(\' \', user.first_name, user.last_name) AS `user`,
				driver.id AS driver_id,
				CONCAT_WS(\' \', driver.first_name, driver.last_name) AS `driver`,
				delivery_code.status AS delivery_code
				FROM shipment
				LEFT JOIN offer ON offer.id = shipment.offer_id
				LEFT JOIN service ON shipment.service_id = service.id
				LEFT JOIN city AS from_city ON from_city.id = service.from_city_id
				LEFT JOIN city AS to_city ON to_city.id = service.to_city_id
				LEFT JOIN vehicle ON vehicle.id = service.vehicle_id
				LEFT JOIN user ON offer.user_id = user.id
				LEFT JOIN user AS driver ON driver.id = service.user_id
				LEFT JOIN delivery_code ON shipment.delivery_code_id = delivery_code.id
				WHERE shipment.id = ?
				ORDER BY shipment.id DESC
				;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji vraća sve redove iz tabele za odgovarajuće korisnike
	 * Funkcija CONCAT_WS je specifična za MySQL server, u slučaju promene na
	 * Oracle SQL ili neki drugi server obavezno je zameniti sa odgovarajućom
	 * funkcijom, npr. običan CONCAT
	 * @return array
	 */
	public static function getAllByUserId($id)
	{
		$sql = 'SELECT
				shipment.id,
				shipment.service_id AS service_id,
				shipment.offer_id AS offer_id,
				offer.price AS price,
				offer.description AS description,
				service.`at` AS start_time,
				from_city.name AS from_city,
				to_city.name AS to_city,
				vehicle.name AS vehicle,
				user.id AS user_id,
				CONCAT_WS(\' \', user.first_name, user.last_name) AS `user`,
				driver.id AS driver_id,
				CONCAT_WS(\' \', driver.first_name, driver.last_name) AS `driver`,
				delivery_code.status AS delivery_code
				FROM shipment
				LEFT JOIN offer ON offer.id = shipment.offer_id
				LEFT JOIN service ON shipment.service_id = service.id
				LEFT JOIN city AS from_city ON from_city.id = service.from_city_id
				LEFT JOIN city AS to_city ON to_city.id = service.to_city_id
				LEFT JOIN vehicle ON vehicle.id = service.vehicle_id
				LEFT JOIN user ON offer.user_id = user.id
				LEFT JOIN user AS driver ON driver.id = service.user_id
				LEFT JOIN delivery_code ON shipment.delivery_code_id = delivery_code.id
				WHERE user.id = ?
				ORDER BY shipment.id DESC
				;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji vraća sve redove iz tabele za odgovarajuće korisnike
	 * Funkcija CONCAT_WS je specifična za MySQL server, u slučaju promene na
	 * Oracle SQL ili neki drugi server obavezno je zameniti sa odgovarajućom
	 * funkcijom, npr. običan CONCAT
	 * @return array
	 */
	public static function getAllByDriverId($id)
	{
		$sql = 'SELECT
				shipment.id,
				shipment.service_id AS service_id,
				shipment.offer_id AS offer_id,
				offer.price AS price,
				offer.description AS description,
				service.`at` AS start_time,
				from_city.name AS from_city,
				to_city.name AS to_city,
				vehicle.name AS vehicle,
				user.id AS user_id,
				CONCAT_WS(\' \', user.first_name, user.last_name) AS `user`,
				driver.id AS driver_id,
				CONCAT_WS(\' \', driver.first_name, driver.last_name) AS `driver`,
				delivery_code.status AS delivery_code
				FROM shipment
				LEFT JOIN offer ON offer.id = shipment.offer_id
				LEFT JOIN service ON shipment.service_id = service.id
				LEFT JOIN city AS from_city ON from_city.id = service.from_city_id
				LEFT JOIN city AS to_city ON to_city.id = service.to_city_id
				LEFT JOIN vehicle ON vehicle.id = service.vehicle_id
				LEFT JOIN user ON offer.user_id = user.id
				LEFT JOIN user AS driver ON driver.id = service.user_id
				LEFT JOIN delivery_code ON shipment.delivery_code_id = delivery_code.id
				WHERE driver.id = ?
				ORDER BY shipment.id DESC
				;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

}
