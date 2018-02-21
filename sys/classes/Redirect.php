<?php

/**
 * Klasa Redirect je klasa koja obezbeđuje fasadni pristup redirekciji preko HTTP protokola.
 */
final class Redirect
{

	/**
	 * Ovaj metod se koristi za preusmeravanje korisnika na relativnu putanju u
	 * odnosu na koren putanje veb aplikacije na Internetu ili apsolutnu putanju.
	 * @param string $link Putanja
	 * @param boolean $absolute relativna ili apsolutna redirekcija
	 */
	public static final function to($link, $absolute = FALSE)
	{
		if ($absolute)
		{
			header('Location: '.$link);
		}
		else
		{
			header('Location: '.Config::BASE.$link);
		}
		die;
	}

}
