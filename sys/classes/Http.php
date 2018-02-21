<?php

/**
 * Bespotrebno
 * <br>
 * Olakšava rad sa serverskim promenljivama PHP jezika
 */
final class Http
{

	/**
	 * Proverava da li je u pitanju asinhroni zahtev
	 * Napomena: Ovaj metod nisam uspeo da uradim pravilno, Apache server na kom sam radio
	 * ne šalje HTTP_X_REQUESTED_WITH uz zahteve.
	 * @return TRUE|FALSE
	 */
	public static final function isAjax()
	{
		// return strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest';
		return TRUE;
	}

	/**
	 * Vraća IP adresu klijenta - nije 100% sigurno
	 * @todo http://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
	 * @return string
	 */
	public static final function remoteAddr()
	{
		return filter_input(INPUT_SERVER, 'REMOTE_ADDR');
	}

	/**
	 * Vraća tip metode zahteva HTTP protokola
	 * @return string
	 */
	public static final function requestMethod()
	{
		return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
	}

	/**
	 * Vraća URI zahteva HTTP protokola
	 * @return string
	 */
	public static final function requestUri()
	{
		return filter_input(INPUT_SERVER, 'REQUEST_URI');
	}

	/**
	 * Vraća serverski protokol, korisno kod 404 redirekcija
	 * @return string
	 */
	public static final function serverProtocol()
	{
		return filter_input(INPUT_SERVER, 'SERVER_PROTOCOL');
	}

	/**
	 * Vraća informacije o Veb klijentu korisnika kroz polje u zahtevu HTTP protokola
	 * @return string
	 */
	public static final function userAgent()
	{
		return filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
	}

}
