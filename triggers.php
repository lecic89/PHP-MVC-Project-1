<?php

require_once 'sys/autoloader.php';

$email = substr(RegExHelper::patternForEmail(), 1, -1);
$firstOrLastName = substr(RegExHelper::patternForFirstOrLastNameInSerbian(), 1, -1);
$city = substr(RegExHelper::patternForCityNameInSerbian(), 1, -1);
$vehicle = substr(RegExHelper::patternForVehicleNameInSerbian(), 1, -1);

$userBeforeInsert = "CREATE TRIGGER user_before_insert BEFORE INSERT ON user FOR EACH ROW
		BEGIN

		IF NEW.email NOT RLIKE BINARY '".$email."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		IF NEW.first_name NOT RLIKE BINARY '".$firstOrLastName."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		IF NEW.last_name NOT RLIKE BINARY '".$firstOrLastName."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		END";

$adminBeforeInsert = "CREATE TRIGGER admin_before_insert BEFORE INSERT ON admin FOR EACH ROW
		BEGIN

		IF NEW.email NOT RLIKE BINARY '".$email."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		IF NEW.first_name NOT RLIKE BINARY '".$firstOrLastName."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		IF NEW.last_name NOT RLIKE BINARY '".$firstOrLastName."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		END";

$cityBeforeInsert = "CREATE TRIGGER city_before_insert BEFORE INSERT ON city FOR EACH ROW
		BEGIN

		IF NEW.name NOT RLIKE BINARY '".$city."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		END";

$vehicleBeforeInsert = "CREATE TRIGGER vehicle_before_insert BEFORE INSERT ON vehicle FOR EACH ROW
		BEGIN

		IF NEW.name NOT RLIKE BINARY '".$vehicle."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		END";

$serviceBeforeInsert = "CREATE TRIGGER service_before_insert BEFORE INSERT ON service FOR EACH ROW
		BEGIN

		IF NEW.from_city_id = NEW.to_city_id THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Gradovi u service tabeli moraju biti različiti!';
		END IF;

		IF NEW.at < SYSDATE() THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Datum mora biti validan!';
		END IF;

		END";

$messageBeforeInsert = "CREATE TRIGGER message_before_insert BEFORE INSERT ON message FOR EACH ROW
		BEGIN

		IF NEW.email NOT RLIKE BINARY '".$email."' THEN
		   SIGNAL SQLSTATE '45000'
		   SET MESSAGE_TEXT = 'Greška kod regularnih izraza!';
		END IF;

		END";

$triggers = [
	$userBeforeInsert,
	$adminBeforeInsert,
	$cityBeforeInsert,
	$vehicleBeforeInsert,
	$serviceBeforeInsert,
	$messageBeforeInsert
];

foreach ($triggers as $id => $trigger)
{
	$status = DB::getInstance()->query($trigger);
	if (!$status)
	{
		echo 'Greška kod dodavanja okidača '.$id.'!'.PHP_EOL;
	}
	else
	{
		echo 'Uspeh kod dodavanja okidača '.$id.'!'.PHP_EOL;
	}
}

$updateTriggers = array_map(function($trigger)
{
	$trigger = str_replace('before_insert', 'before_update', $trigger);
	$trigger = str_replace('BEFORE INSERT', 'BEFORE UPDATE', $trigger);
	return $trigger;
}, $triggers);

foreach ($updateTriggers as $id => $trigger)
{
	$status = DB::getInstance()->query($trigger);
	if (!$status)
	{
		echo 'Greška kod dodavanja okidača '.$id.'!'.PHP_EOL;
	}
	else
	{
		echo 'Uspeh kod dodavanja okidača '.$id.'!'.PHP_EOL;
	}
}
