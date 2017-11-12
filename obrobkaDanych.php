<?php
  $plik_odczyt = 'transfusion.data';
  $plik_zapis = 'transfusion - poprawione.data';
  // funkcja do testow
  function test(){
  	print 'Test!</br>';
  }
  //=============================================================================
  // sprawdzenie czy plik istnieje i czy mozna odczytywac
  function sprawdzPlik($file){
  	if(file_exists($file) && is_readable($file)){
  		//print 'Plik istnieje, możliwy odczyt.</br>';
  	}
  	else{
  		print 'Plik NIE istnieje lub nie można odczytać</br>';
  		exit;
  	}
  }

  // funkcja odczytuje dane z pliku, uzupełnia brakujące i nieprawidłowe dane wstawiając wartości uśrednione
  function czytajPlik($file){
  	sprawdzPlik($file);
  	$usrednioneDane = array(0,0,0,0,0);

  	if($uchwyt_odczyt = fopen($file, 'r')){
  		//print 'Utowrzono uchwyt dla pliku do odczytu. </br>';
  	}
  	else {
  		print 'NIE udało się utworzyć uchwytu dla pliku do odczytu. </br>';
  		exit;
  	}
  	if($uchwyt_zapis = fopen('transfusion - poprawione.data', 'wb')){
  		//print 'Utowrzono uchwyt dla pliku do zapisu. </br>';
  	}
  	else {
  		print 'NIE udało się utworzyć uchwytu dla pliku do zapisu. </br>';
  		exit;
  	}

  	$id = 0;
  	while(!feof($uchwyt_odczyt)){
  		$wiersz = fgetcsv($uchwyt_odczyt, 0, ','); // Pobranie z pliku wiersza tekstu
  		//wyswietlenie pierwszego wiersza opisowego
  		if($id < 1){
  			for($i = 0; $i < sizeof($wiersz); $i++){
  				$wiersz[$i] = trim($wiersz[$i]);

  				fwrite($uchwyt_zapis, $wiersz[$i], strlen($wiersz[$i]));
  				if($i < sizeof($wiersz)-1){
  					fwrite($uchwyt_zapis,", ", strlen(", "));
  				}
  			}
  			fwrite($uchwyt_zapis,"\n", strlen("\n"));
  		}
  		else{
  			// wyswietlanie danych w tabeli i wyliczanie sredniej, poprawiadnie danych
  			for($i = 0; $i < sizeof($wiersz); $i++){
  				$wiersz[$i] = trim($wiersz[$i]);
          if($i == 2){
            $wiersz[$i] = $wiersz[$i]/1000;
          }
  				//sprawdzanie poprawnosci danych
  				if(empty($wiersz[$i]) && $wiersz[$i] !== '0' || $wiersz[$i] < 0){
					// sprawdzenie konca pliku
					if(empty($wiersz[0]) && empty($wiersz[1]) && empty($wiersz[2]) && empty($wiersz[3]) && empty($wiersz[4])){
						print "Dane zostaly poprawione i zapisane do pliku 'transfusion - poprawione.dat'.";
						exit;
					}
  					$wiersz[$i] = round($usrednioneDane[$i] /$id);
  				}
  				fwrite($uchwyt_zapis, $wiersz[$i], strlen($wiersz[$i]));
  				if($i < sizeof($wiersz)-1){
  					fwrite($uchwyt_zapis,", ", strlen(", "));
  				}
  				$usrednioneDane[$i] += $wiersz[$i];
  			}
  			fwrite($uchwyt_zapis,"\n", strlen("\n"));
  		}
  		$id++;
  	}
  }

  czytajPlik($plik_odczyt);

?>
