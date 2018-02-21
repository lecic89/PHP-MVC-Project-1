<?php

/**
 * Ova klasa predstavlja centralno mesto gde se nalaze svi vazni konfiguracioni
 * parametri ove veb aplikacije, koji su definisani kao clanovi podaci konstante.
 */
final class Config
{

	// Parametri za pristup BP
	const DB_HOST = '127.0.0.1';
	const DB_USER = 'root';
	const DB_PASS = 'p0k3m0n';
	const DB_NAME = 'post4less';
	// Adresni parametri
	const BASE = 'http://localhost:8080/pivt/';
	const PATH = '/pivt/';
	// Korisnički parametri
	const ADMIN_SESSION = 'admin_id';
	const USER_SESSION = 'user_id';
	const SALT = 'xjGGM1cdIWXoU5QVIZPTMeQht9r2Qzqh';
	const IMAGE_PATH = 'data/images/';

}
