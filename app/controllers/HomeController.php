<?php

/**
 * Ovo je osnovni kontroler aplikacije koji se koristi za izvrsavanje
 * zahteva upucenih prema podrazumevanim rutama koje poznaje veb sajt.
 */
class HomeController extends Controller
{

	/**
	 * Osnovni metod pocetne stranice sajta
	 */
	public function index()
	{
		$this->set('title', 'Početna');
	}

	/**
	 * Ovaj metod proverava da li postoje podaci za prijavu poslati HTTP POST
	 * metodom, vrsi njihovu validaciju, proverava postojanje korisnika sa tim
	 * pristupnim parametrima i u slucaju da sve provere prodju bez greske
	 * metod kreira sesiju za korisnika i preusemrava korisnika na default rutu.
	 * @return void Metod ne vraca nista, vec koristi return naredbu za prekid izvrsavanja u odredjenim situacijama
	 */
	public function login()
	{
		$this->set('title', 'Prijava');
		// Korisnik nema pravo pristupa ovoj stranici ako je autentifikovan kao admin
		if (Session::exists(Config::ADMIN_SESSION))
		{
			Redirect::to('');
		}
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			return;
		}
		// Preuzimanje podataka iz zahteva
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($email) or empty($password) or strlen($email) > 255)
		{
			$this->set('message', 'Greška #1!');
			return;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->set('message', 'Greška kod regularnih izraza!');
			return;
		}
		$passwordHash = Hash::make($password, TRUE);
		// Autentifikacija
		$user = UserModel::getByEmailAndPasswordHash($email, $passwordHash);
		if (!$user)
		{
			$this->set('message', 'Greška #2!');
			sleep(2);
			return;
		}
		// Autorizacija
		Session::set(Config::USER_SESSION, $user->id);
		// Logovanje
		UserLoginModel::create([
			'user_id' => $user->id,
			'remote_addr' => Http::remoteAddr(),
			'user_agent' => Http::userAgent()
		]);
		// Redirekcija
		Redirect::to('');
	}

	/**
	 * Ovaj metod gasi sesiju cime efektivno unistava sve u sesiji,
	 * a zatim preusmerava admina na početnu na login ruti.
	 */
	public function logout()
	{
		// Korisnik nema pravo pristupa ovoj stranici ako je autentifikovan kao admin
		if (Session::exists(Config::ADMIN_SESSION))
		{
			Redirect::to('');
		}
		Session::end();
		Redirect::to('');
	}

}
