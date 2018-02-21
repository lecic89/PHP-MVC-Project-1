<?php

/**
 * Ovaj kontroler služi za osnovne akcije korisnika u vezi profila:
 * - pregled profila svih korisnika
 * - izmena svog profila
 * - ažuriranje profilne slike
 */
class UserController extends AuthController
{

	/**
	 * Pregled sopstvenog profila
	 */
	public function index()
	{
		$this->set('title', 'Moj profil');
		$this->set('user', UserModel::getById(Session::get(Config::USER_SESSION)));
	}

	/**
	 * Pregled tuđeg profila
	 */
	public function readById($id)
	{
		if ($id === Session::get(Config::USER_SESSION))
		{
			Redirect::to('moj-profil');
		}
		$user = UserModel::getById($id);
		if ($user)
		{
			$this->set('title', $user->first_name.' '.$user->last_name);
		}
		$this->set('user', $user);
	}

	/**
	 * Izmena sopstvenog profila
	 */
	public function update()
	{
		$this->set('title', 'Ažuriranje profila');
		$id = Session::get(Config::USER_SESSION);
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
		if (!RegExHelper::validateFirstOrLastNameInSerbian($first_name) || !RegExHelper::validateFirstOrLastNameInSerbian($last_name) || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			$this->set('user', UserModel::getById($id));
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
		Redirect::to('moj-profil');
	}

	/**
	 * Ažuriranje profilne slike
	 */
	public function updateProfilePhoto()
	{
		$this->set('title', 'Ažuriranje profilne slike');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST' || !$_FILES || !isset($_FILES['profile_photo']))
		{
			return;
		}
		// Preuzimanje podataka iz zahteva
		$profile_photo = $_FILES['profile_photo'];
		// Validacija
		if ($profile_photo['error'] !== 0)
		{
			$this->set('message', 'Greška #1!');
			return;
		}
		// Validacija - veličina
		if ($profile_photo['size'] > 300 * 1024)
		{
			$this->set('message', 'Greška #2!');
			return;
		}
		// Validacija - MIME tip
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mimeType = $finfo->file($profile_photo['tmp_name']);
		if ($mimeType !== 'image/jpeg')
		{
			$this->set('message', 'Greška #3!');
			return;
		}
		// Upload slike
		$newLocation = uniqid(Session::get(Config::USER_SESSION), TRUE).'.jpg';
		$res = move_uploaded_file($profile_photo['tmp_name'], Config::IMAGE_PATH.$newLocation);
		if (!$res)
		{
			$this->set('message', 'Greška #4!');
			return;
		}
		// Ažuriranje
		$status = UserModel::update(Session::get(Config::USER_SESSION), [
					'profile_photo' => $newLocation
		]);
		if (!$status)
		{
			$this->set('message', 'Greška #5!');
			return;
		}
		// Redirekcija
		Redirect::to('moj-profil');
	}

}
