<?php

/**
 * Kontroler koji služi za CRUD operacije nad tabelom vehicles
 */
class AdminVehicleController extends AdminAuthController
{

	/**
	 * Glavni metod klase, zadužen za listanje svih zapisa
	 */
	public function index()
	{
		$this->set('title', 'Pregled vozila');
		$this->set('vehicles', VehicleModel::getAll());
	}

	/**
	 * Metod klase zadužen za dodavanje novog zapisa
	 */
	public function create()
	{
		$this->set('title', 'Dodavanje novog vozila');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			return;
		}
		// Preuzimanje podataka iz zahteva
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($name) or strlen($name) > 255)
		{
			$this->set('message', 'Greška #1!');
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateVehicleNameInSerbian($name))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		// Dodavanje
		$vehicle = VehicleModel::create([
					'name' => $name
		]);
		if (!$vehicle)
		{
			$this->set('message', 'Greška #2!');
			return;
		}
		// Redirekcija
		Redirect::to('mvc-admin/vehicles');
	}

	/**
	 * Metod klase zadužen za ažuriranje postojećeg zapisa
	 */
	public function update($id)
	{
		$this->set('title', 'Ažuriranje vozila');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			$this->set('vehicles', VehicleModel::getById($id));
			return;
		}
		// Preuzimanje podataka iz zahteva
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($name) or strlen($name) > 255)
		{
			$this->set('message', 'Greška #1!');
			$this->set('vehicles', VehicleModel::getById($id));
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateVehicleNameInSerbian($name))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		// Ažuriranje
		$status = VehicleModel::update($id, [
					'name' => $name
		]);
		if (!$status)
		{
			$this->set('message', 'Greška #2!');
			$this->set('vehicles', VehicleModel::getById($id));
			return;
		}
		// Redirekcija
		Redirect::to('mvc-admin/vehicles');
	}

	/**
	 * Metod klase zadužen za uklanjanje postojećeg zapisa
	 */
	public function delete($id)
	{
		VehicleModel::delete($id);
		// Redirekcija
		Redirect::to('mvc-admin/vehicles');
	}

}
