<?php

/**
 * Ovaj kontroler služi za osnovne akcije korisnika u vezi pošiljke:
 * - pregled aktuelnih pošiljki
 * - dodavanje nove pošiljke
 * - ažuriranje aktuelnih pošiljki
 * - uklanjanje pošiljke
 */
class UserShipmentController extends AuthController
{

	/**
	 * Aktuelne pošiljke
	 */
	public function index()
	{
		$this->set('title', 'Aktuelne pošiljke');
		$this->set('asDriver', ShipmentModel::getAllByDriverId(Session::get(Config::USER_SESSION)));
		$this->set('asUser', ShipmentModel::getAllByUserId(Session::get(Config::USER_SESSION)));
	}

	/**
	 * Aktuelna pošiljka sa određenim ID parametrom
	 * @param int $id
	 */
	public function readById($id)
	{
		$shipment = ShipmentModel::getAllById($id);
		if ($shipment)
		{
			$this->set('shipment', $shipment[0]);
			$this->set('codes', DeliveryCodeModel::getAll());
			$this->set('updates', ShipmentUpdateModel::getAllByShipmentId($id));
		}
		else
		{
			$this->set('shipment', FALSE);
		}
	}

	/**
	 * Metod za dodavanje nove pošiljke
	 * Uvek radi redirekciju, tj. nema nikakav izlaz
	 */
	public function create($offer_id)
	{
		$service = ServiceModel::getByUserId(Session::get(Config::USER_SESSION));
		if (count($service) !== 1)
		{
			Redirect::to('');
		}
		$status = ShipmentModel::create([
					'service_id' => $service->id,
					'offer_id' => $offer_id,
					'delivery_code_id' => 1
		]);
		if ($status)
		{
			ServiceModel::update($service->id, [
				'active' => 0
			]);
			Redirect::to('isporuka/'.$status);
		}
		else
		{
			Redirect::to('');
		}
	}

	/**
	 * Metod zadužen da odgovara na AJAX zahteve koje upućuje vozač u toku pošilje
	 * u cilju ažuriranja trenutne pozicije
	 */
	public function updateFromDriver()
	{
		// Provera da li je u pitanju asinhroni zahtev i provera HTTP metoda
		if (!Http::isAjax() or Http::requestMethod() !== 'POST')
		{
			Redirect::to('');
		}
		// Preuzimanje podataka iz zahteva
		$shipment_id = filter_input(INPUT_POST, 'shipment_id', FILTER_SANITIZE_NUMBER_INT);
		$dc = filter_input(INPUT_POST, 'dc', FILTER_SANITIZE_NUMBER_INT);
		$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
		// Provera
		$shipment = ShipmentModel::getAllById($shipment_id)[0];
		if ($shipment->driver_id !== Session::get(Config::USER_SESSION))
		{
			$status = 'Niste autorizovani.';
		}
		else
		{
			if (!RegExHelper::validateUserContentInSerbian($message))
			{
				ob_clean();
				die('Greška kod regularnih izraza!');
			}
			ShipmentModel::update($shipment->id, [
				'delivery_code_id' => $dc
			]);
			ShipmentUpdateModel::create([
				'shipment_id' => $shipment->id,
				'message' => $message
			]);
			$status = 'Upsešno je dodata vaša poruka!';
		}
		ob_clean();
		die($status);
	}

	/**
	 * Metod klase zadužen za uklanjanje postojećeg zapisa
	 */
	public function delete($id)
	{
		ShipmentModel::delete($id);
		// Redirekcija
		Redirect::to('usluge-transporta');
	}

}
