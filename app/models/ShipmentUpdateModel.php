<?php

/**
 * Model koji odgovara tabeli shipment_update
 * Nasleđuje apstraktnu klasu Model
 */
class ShipmentUpdateModel extends Model
{

	/**
	 * Metod koji vraća sve redove iz tabele za odgovarajuće shipment_id vrednosti
	 * Funkcija CONCAT_WS je specifična za MySQL server, u slučaju promene na
	 * Oracle SQL ili neki drugi server obavezno je zameniti sa odgovarajućom
	 * funkcijom, npr. običan CONCAT
	 * @return array
	 */
	public static function getAllByShipmentId($id)
	{
		$sql = 'SELECT * FROM shipment_update WHERE shipment_id = ? ORDER BY id DESC;'
		;
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

}
