<?php
	$plik_odczyt = 'transfusion.data';
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

		if($uchwyt_odczyt = fopen($file, 'r')){
			//print 'Utowrzono uchwyt dla pliku do odczytu. </br>';
		}
		else {
			print 'NIE udało się utworzyć uchwytu dla pliku do odczytu. </br>';
			exit;
		}

		print '<table id="oryginalne">';
		$id = 0;
		while(!feof($uchwyt_odczyt)){
			$wiersz = fgetcsv($uchwyt_odczyt, 0, ','); // Pobranie z pliku wiersza tekstu
			print '<tr>';
			//wyswietlenie pierwszego wiersza opisowego
			if($id < 1){
				for($i = 0; $i < sizeof($wiersz); $i++){
					$wiersz[$i] = trim($wiersz[$i]);
					print '<th>' . $wiersz[$i] . '</th>';
				}
			}
			else{
				// wyswietlanie danych w tabeli i wyliczanie sredniej, poprawiadnie danych
				for($i = 0; $i < sizeof($wiersz); $i++){
					print '<td>' . $wiersz[$i] . '</td>';
					$wiersz[$i] = trim($wiersz[$i]);
				}
			}
			print '</tr>';
			$id++;
		}
		print '</table>';

	}
	//=============================================================================

	czytajPlik($plik_odczyt);
	//czytajPlik($plik_zapis);
	//test();
?>
