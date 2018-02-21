<?php

/**
 * Kontroler koji služi za CRUD operacije nad tabelom users
 */
class AdminUserController extends AdminAuthController
{

	/**
	 * Glavni metod klase, zadužen za listanje svih zapisa
	 */
	public function index()
	{
		$this->set('title', 'Administratorski panel');
		$this->set('users', UserModel::getAll());
		// Broj nepročitanih poruka
		$query = DB::getInstance()->query('SELECT COUNT(id) AS unread FROM message WHERE `status` = 0;');
		$unread = $query->fetch(PDO::FETCH_OBJ)->unread;
		$this->set('unread', $unread);
	}

	/**
	 * Metod klase zadužen za dodavanje novog zapisa
	 */
	public function create()
	{
		$this->set('title', 'Dodavanje novog korisnika');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			return;
		}
		// Preuzimanje podataka iz zahteva
		$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
		$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($first_name) or empty($last_name) or empty($email) or empty($password) or strlen($first_name) > 255 or strlen($last_name) > 255 or strlen($email) > 255)
		{
			$this->set('message', 'Greška #1!');
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateFirstOrLastNameInSerbian($first_name) || !RegExHelper::validateFirstOrLastNameInSerbian($last_name) || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		$passwordHash = Hash::make($password, TRUE);
		// Dodavanje
		$user = UserModel::create([
					'first_name' => $first_name,
					'last_name' => $last_name,
					'email' => $email,
					'password_hash' => $passwordHash
		]);
		if (!$user)
		{
			$this->set('message', 'Greška #2!');
			return;
		}
		// Redirekcija
		Redirect::to('mvc-admin/users');
	}

	/**
	 * Metod klase zadužen za ažuriranje postojećeg zapisa
	 */
	public function update($id)
	{
		$this->set('title', 'Ažuriranje korisnika');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			$this->set('user', UserModel::getById($id));
			return;
		}
		// Preuzimanje podataka iz zahteva
		$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
		$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		// Validacija
		if (empty($first_name) or empty($last_name) or empty($email) or strlen($first_name) > 255 or strlen($last_name) > 255 or strlen($email) > 255)
		{
			$this->set('message', 'Greška #1!');
			$this->set('user', UserModel::getById($id));
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateFirstOrLastNameInSerbian($first_name) || !RegExHelper::validateFirstOrLastNameInSerbian($last_name))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		// Ažuriranje
		$status = UserModel::update($id, [
					'first_name' => $first_name,
					'last_name' => $last_name,
					'email' => $email
		]);
		if (!$status)
		{
			$this->set('message', 'Greška #2!');
			$this->set('user', UserModel::getById($id));
			return;
		}
		// Redirekcija
		Redirect::to('mvc-admin/users');
	}

	/**
	 * Metod klase zadužen za uklanjanje postojećeg zapisa
	 */
	public function delete($id)
	{
		UserModel::delete($id);
		// Redirekcija
		Redirect::to('mvc-admin/users');
	}

}
