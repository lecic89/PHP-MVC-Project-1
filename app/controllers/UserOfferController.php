<?php

/**
 * Ovaj kontroler služi za osnovne akcije korisnika u vezi ponuda:
 * - dodavanje nove ponude
 * - pregled svih ponuda
 */
class UserOfferController extends AuthController
{

	/**
	 * Pregled svih ponuda
	 * Odgovara na POST zahtev upućen preko AJAX-a
	 */
	public function index()
	{
		// Provera da li je u pitanju asinhroni zahtev i provera HTTP metoda
		if (!Http::isAjax() or Http::requestMethod() !== 'POST')
		{
			Redirect::to('');
		}
		// Preuzimanje podataka iz zahteva
		$service_id = filter_input(INPUT_POST, 'service_id', FILTER_SANITIZE_NUMBER_INT);
		// Provera da li je u pitanju usluga koju je postavio korisnik koji je trenutno prijavljen
		$service = ServiceModel::getActiveById($service_id);
		if ($service and $service->user_id !== Session::get(Config::USER_SESSION))
		{
			Redirect::to('');
		}
		$this->set('offers', OfferModel::getAllByServiceId($service_id));
	}

	/**
	 * Dodavanje nove ponude
	 */
	public function create($id)
	{
		$this->set('title', 'Dodavanje ponude');
		$service = ServiceModel::getById($id);
		if (!$service)
		{
			Redirect::to('usluge-transporta');
		}
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			$this->set('service', $service);
			return;
		}
		// Preuzimanje podataka iz zahteva
		$user_id = Session::get(Config::USER_SESSION);
		$service_id = $service->id;
		$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($description) or strlen($description) > 65535 || !is_numeric($price) or $user_id === $service->user_id)
		{
			$this->set('message', 'Greška #1!');
			$this->set('service', $service);
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateUserContentInSerbian($description))
		{
			$this->set('message', 'Greška kod regularnih izraza!');
			$this->set('service', $service);
			return;
		}
		// Dodavanje
		$offer = OfferModel::create([
					'user_id' => $user_id,
					'service_id' => $service_id,
					'price' => $price,
					'description' => $description
		]);
		if (!$offer)
		{
			$this->set('message', 'Greška #2!');
			$this->set('service', $service);
			return;
		}
		// Uklanjanje starijih ponuda
		$duplicates = OfferModel::getCountById($service_id, $user_id);
		unset($duplicates[0]);
		if (count($duplicates))
		{
			$ids = [];
			foreach ($duplicates as $duplicate)
			{
				$ids[] = $duplicate->id;
			}
			OfferModel::deleteByIds($ids);
		}
		// Redirekcija
		Redirect::to('usluge-transporta/'.$service->id);
	}

}
