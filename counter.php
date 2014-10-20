<?php
	$filePath = './counter.txt';

	if (!is_readable($filePath)) {
	    echo 'Filen är inte läsbar.';
	}

	// Öppna filen med läs- och skrivrättigheter
	$file = fopen($filePath, 'c+') or die('fopen failed.');	

	// Ifall filen inte är låst, lås den (LOCK_EX - exklusiv låsning) 
	// och gå in i if-satsen
	if (flock($file, LOCK_EX)) {
		
		// Läs innehållet och uppdatera siffran 
		$contents = file_get_contents($filePath) + 1;

		// Skriv till txt-filen
		fwrite($file, $contents);

		// Lås upp filen
		flock($file, LOCK_UN);

		// Stäng filen
		fclose($file);

		echo $contents;
	}

	else {
		// Gick inte att låsa filen, antagligen för att den redan används
		print 'Filen ' . $fileName . ' används';
	}
		
