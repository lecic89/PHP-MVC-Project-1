<?php

/**
 * Kontroler koji služi za CRUD operacije nad tabelom cities
 */
class AdminCityController extends AdminAuthController
{

	/**
	 * Glavni metod klase, zadužen za listanje svih zapisa
	 */
	public function index()
	{
		$this->set('title', 'Pregled svih gradova');
		$this->set('cities', CityModel::getAll());
	}

	/**
	 * Metod klase zadužen za dodavanje novog zapisa
	 */
	public function create()
	{
		$this->set('title', 'Dodavanje novog grada');
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
		if (!RegExHelper::validateCityNameInSerbian($name))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		// Dodavanje
		$city = CityModel::create([
					'name' => $name
		]);
		if (!$city)
		{
			$this->set('message', 'Greška #2!');
			return;
		}
		// Redirekcija
		Redirect::to('mvc-admin/cities');
	}

	/**
	 * Metod klase zadužen za ažuriranje postojećeg zapisa
	 */
	public function update($id)
	{
		$this->set('title', 'Ažuriranje postojećeg grada');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			$this->set('city', CityModel::getById($id));
			return;
		}
		// Preuzimanje podataka iz zahteva
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($name) or strlen($name) > 255)
		{
			$this->set('message', 'Greška #1!');
			$this->set('city', CityModel::getById($id));
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateCityNameInSerbian($name))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		// Ažuriranje
		$status = CityModel::update($id, [
					'name' => $name
		]);
		if (!$status)
		{
			$this->set('message', 'Greška #2!');
			$this->set('user', UserModel::getById($id));
			return;
		}
		// Redirekcija
		Redirect::to('mvc-admin/cities');
	}

	/**
	 * Metod klase zadužen za uklanjanje postojećeg zapisa
	 */
	public function delete($id)
	{
		CityModel::delete($id);
		// Redirekcija
		Redirect::to('mvc-admin/cities');
	}

}
