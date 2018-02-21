<?php

/**
 * Ovo je osnovni kontroler aplikacije koji se koristi da bi omogućio
 * administratorima pristup aplikaciji
 */
class AdminLoginController extends Controller
{

	/**
	 * Ovaj metod proverava da li postoje podaci za prijavu poslati HTTP POST
	 * metodom, vrsi njihovu validaciju, proverava postojanje korisnika sa tim
	 * pristupnim parametrima i u slucaju da sve provere prodju bez greske
	 * metod kreira sesiju za korisnika i preusemrava korisnika na default rutu.
	 * @return void Metod ne vraca nista, vec koristi return naredbu za prekid izvrsavanja u odredjenim situacijama
	 */
	public function index()
	{
		// Korisnik nema pravo pristupa ovoj stranici ako je autentifikovan kao korisnik
		if (Session::exists(Config::USER_SESSION))
		{
			Redirect::to('');
		}
		// Redirekcija ako je već prijavljen
		if (Session::exists(Config::ADMIN_SESSION))
		{
			Redirect::to('mvc-admin/users');
		}
		$this->set('title', 'Prijava na administratorski panel');
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
		$admin = AdminModel::getByEmailAndPasswordHash($email, $passwordHash);
		if (!$admin)
		{
			$this->set('message', 'Greška #2!');
			sleep(2);
			return;
		}
		// Autorizacija
		Session::set(Config::ADMIN_SESSION, $admin->id);
		// Redirekcija
		Redirect::to('mvc-admin/users');
	}

	/**
	 * Ovaj metod gasi sesiju cime efektivno unistava sve u sesiji,
	 * a zatim preusmerava korisnika na stranicu za prijavu na login ruti.
	 */
	public function logout()
	{
		// Korisnik nema pravo pristupa ovoj stranici ako je autentifikovan kao korisnik
		if (Session::exists(Config::USER_SESSION))
		{
			Redirect::to('');
		}
		Session::end();
		Redirect::to('');
	}

}
