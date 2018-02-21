<?php

/**
 * Kontroler koji obezbeđuje programsku logiku za rad sa dodavanjem nove ponude transporta
 */
class UserServiceController extends AuthController
{

	/**
	 * Metod index je zadužen za listanje trenutnih transport ponuda
	 */
	public function index()
	{
		$this->set('title', 'Pregled svih ponuda');
		// Imitacija cron job-a
		ServiceModel::removeAllExpired();
		$services = ServiceModel::getAllActive();
		$this->set('services', $services);
		$status = ServiceModel::getByUserId(Session::get(Config::USER_SESSION));
		$this->set('status', $status);
	}

	/**
	 * Metod koji prikazuje detalje o određenoj usluzi
	 * @param int $id
	 */
	public function readById($id)
	{
		// Imitacija cron job-a
		ServiceModel::removeAllExpired();
		$service = ServiceModel::getActiveById($id);
		if ($service)
		{
			$this->set('title', $service->from_city.' - '.$service->to_city);
		}
		$this->set('service', $service);
	}

	/**
	 * Metod za dodavanje nove usluge transporta
	 * @todo Izvedi parsiranje datuma kao posebnu funkciju
	 */
	public function create()
	{
		$this->set('title', 'Dodavanje usluge transporta');
		// Provera da li već postoji aktivna ponuda transporta povezana sa korisnikom
		if (ServiceModel::getByUserId(Session::get(Config::USER_SESSION)))
		{
			Redirect::to('usluge-transporta');
		}
		$cities = CityModel::getAll();
		$vehicles = VehicleModel::getAll();
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			$this->set('cities', $cities);
			$this->set('vehicles', $vehicles);
			return;
		}
		// Preuzimanje podataka iz zahteva
		$user_id = Session::get(Config::USER_SESSION);
		$vehicle_id = filter_input(INPUT_POST, 'vehicle', FILTER_SANITIZE_NUMBER_INT);
		$from_city_id = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_NUMBER_INT);
		$to_city_id = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_NUMBER_INT);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
		$hours = filter_input(INPUT_POST, 'hours', FILTER_SANITIZE_NUMBER_INT);
		$minutes = filter_input(INPUT_POST, 'minutes', FILTER_SANITIZE_NUMBER_INT);
		$day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT);
		$month = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_NUMBER_INT);
		// Validacija
		if (empty($description) or strlen($description) > 65535 || !is_numeric($vehicle_id) || !is_numeric($from_city_id) || !is_numeric($to_city_id) or $from_city_id === $to_city_id)
		{
			$this->set('message', 'Greška #1!');
			$this->set('cities', $cities);
			$this->set('vehicles', $vehicles);
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateUserContentInSerbian($description))
		{
			$this->set('message', 'Greška kod regularnih izraza!');
			$this->set('cities', $cities);
			$this->set('vehicles', $vehicles);
			return;
		}
		// Parsiranje datuma
		$datetime = $hours.':'.$minutes.':'.date('s').' '.$day.'.'.$month.'.'.date('Y');
		$at = strtotime($datetime);
		if (!$at or $at < time())
		{
			$this->set('message', 'Greška #2!');
			$this->set('cities', $cities);
			$this->set('vehicles', $vehicles);
			return;
		}
		$mysql_at = date('Y-m-d H:i:s', $at);
		// Dodavanje
		$service = ServiceModel::create([
					'user_id' => $user_id,
					'vehicle_id' => $vehicle_id,
					'from_city_id' => $from_city_id,
					'to_city_id' => $to_city_id,
					'at' => $mysql_at,
					'description' => $description
		]);
		if (!$service)
		{
			$this->set('message', 'Greška #3!');
			$this->set('cities', $cities);
			$this->set('vehicles', $vehicles);
			return;
		}
		// Redirekcija
		Redirect::to('usluge-transporta/'.$service->id);
	}

	/**
	 * Metod koji uklanja ponudu korisnika ako postoji
	 * Vrši redirekciju na ponude transporta
	 */
	public function delete()
	{
		ServiceModel::deleteByUserId(Session::get(Config::USER_SESSION));
		Redirect::to('usluge-transporta');
	}

}
