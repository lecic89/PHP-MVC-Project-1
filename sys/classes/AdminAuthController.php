<?php

/**
 * Ova klasa je ekvivalentna klasi AuthController i morala je biti napravljena u
 * cilju realizacije dva različita tipa korisnika u aplikaciji.
 */
class AdminAuthController extends Controller
{

	/**
	 * Ovaj metod vrsi proveru postojanja prijavljenog korisnika (otvorena sesija
	 * za korisnika). Ako korisnik koje prijavljen, preusmerava ga na logout rutu,
	 * koja ce isprazniti sve iz sesije i preusmeriti korisnika na login rutu.
	 */
	final function __pre()
	{
		if (!Session::exists(Config::ADMIN_SESSION))
		{
			Redirect::to('mvc-admin');
		}
	}

}
