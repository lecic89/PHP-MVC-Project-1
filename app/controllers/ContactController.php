<?php

/**
 * Ovo je kontakt kontroler aplikacije koji se koristi za definisanje programske logike
 * koja obezbeđuje funkcionalnosti dodavanje nove poruke u tabelu messages.
 */
class ContactController extends Controller
{

	/**
	 * Glavna funkcija kontakt kontrolera
	 * U slučaju GET metoda prikazuje formular za dodavanje poruke, u slučaju POST metoda
	 * radi obradu formulara i dodaje novu poruku ili izveštava korisnika o grešci.
	 * U slučaju da je korisnik autentifikovan, email parametar treba da pokupi preko sesije.
	 * Inače koristi korisnički unetu email adresu.
	 * @return void Metod ne vraca nista, vec koristi return naredbu za prekid izvrsavanja u odredjenim situacijama
	 */
	public function index()
	{
		$this->set('title', 'Kontakt');
		// Provera HTTP metoda
		if (Http::requestMethod() !== 'POST')
		{
			return;
		}
		// Preuzimanje podataka iz zahteva
		$email = null;
		if (Session::exists(Config::USER_SESSION))
		{
			$email = UserModel::getById(Session::get(Config::USER_SESSION))->email;
		}
		else
		{
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		}
		$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
		// Validacija
		if (empty($email) or empty($content) or strlen($email) > 255 or strlen($content) > 65535)
		{
			$this->set('message', 'Greška #1!');
			return;
		}
		// Regex validacija
		if (!RegExHelper::validateUserContentInSerbian($content) || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->set('message', 'Greška kod regularnih izraza.');
			return;
		}
		// Dodavanje poruke
		$message = MessageModel::create([
					'email' => $email,
					'content' => $content
		]);
		if (!$message)
		{
			$this->set('message', 'Greška #2!');
			return;
		}
		else
		{
			$this->set('status', 1);
			$this->set('message', 'Uspeh!');
			return;
		}
	}

}
