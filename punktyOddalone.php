<?php

	$plik_odczyt = 'transfusion - poprawione.data';
	//$plik_odczyt = 'transfusion - moje.data';

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

  function punktyOddalone($file){
		sprawdzPlik($file);

		$tab0 = array(0,0);
		$tab1 = array(0,0);
		$tab2 = array(0,0);
		$tab3 = array(0,0);
		$tab4 = array(0,0);

		if($uchwyt_odczyt = fopen($file, 'r')){
			//print 'Utowrzono uchwyt dla pliku do odczytu. </br>';
		}
		else {
			print 'NIE udało się utworzyć uchwytu dla pliku do odczytu. </br>';
			exit;
		}

		print '</br>3. Identyfikacja punktów oddalonych - granice dolna i górna.';
		print '<table id="oddalone">';
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
				// wyswietlanie danych w tabeli i wyliczanie minimalnej i maksymalnej wartosci zmiennej
				for($i = 0; $i < sizeof($wiersz); $i++){
					$wiersz[$i] = trim($wiersz[$i]);
					if(empty($wiersz[$i]) && $wiersz[$i] !== '0' || $wiersz[$i] < 0){
						// sprawdzenie konca pliku
						if(empty($wiersz[0]) && empty($wiersz[1]) && empty($wiersz[2]) && empty($wiersz[3]) && empty($wiersz[4])){
							break;
						}
					}
					$tab0[($id-1)] = $wiersz[0];
					$tab1[($id-1)] = $wiersz[1];
					$tab2[($id-1)] = $wiersz[2];
					$tab3[($id-1)] = $wiersz[3];
					$tab4[($id-1)] = $wiersz[4];
				}
			}
			print '</tr>';
			$id++;
		}
		sort($tab0);
		sort($tab1);
		sort($tab2);
		sort($tab3);
		sort($tab4);
		/*
		print '</br>Wielkosc tablicy: '.sizeof($tab0);
		for($i = 0; $i < ($id-2); $i++){
			print '<tr>';
			print '<td>' . $tab0[$i] . '</td>';
			print '<td>' . $tab1[$i] . '</td>';
			print '<td>' . $tab2[$i] . '</td>';
			print '<td>' . $tab3[$i] . '</td>';
			print '<td>' . $tab4[$i] . '</td>';
			print '</tr>';
		}*/

		for($i = 0; $i < (sizeof($tab0)); $i++){
      //Q1
			$mkw1[0] = $tab0[round(0.25*($id-2))];
			$mkw1[1] = $tab1[round(0.25*($id-2))];
			$mkw1[2] = $tab2[round(0.25*($id-2))];
			$mkw1[3] = $tab3[round(0.25*($id-2))];
			$mkw1[4] = $tab4[round(0.25*($id-2))];

      //Q3
			$mkw3[0] = $tab0[round(0.75*($id-2))];
			$mkw3[1] = $tab1[round(0.75*($id-2))];
			$mkw3[2] = $tab2[round(0.75*($id-2))];
			$mkw3[3] = $tab3[round(0.75*($id-2))];
			$mkw3[4] = $tab4[round(0.75*($id-2))];
		}


		for($i = 0; $i < (sizeof($mkw1)); $i++){
			$iqr[$i] = $mkw3[$i] - $mkw1[$i]; //rozstep miedzykwartylowy
		}

    for($i = 0; $i < (sizeof($iqr)); $i++){
			$dolnaGranica[$i] = $mkw1[$i] - (1.5 * $iqr[$i]);
      $gornaGranica[$i] = $mkw3[$i] + (1.5 * $iqr[$i]);
		}
		/*
		print '<tr>';
		for($i = 0; $i < (sizeof($mkw1)); $i++){
			print '<td>' . $mkw1[$i] . '</td>'; //Q1
		}
		print '</tr>';
		print '<tr>';
		for($i = 0; $i < (sizeof($mkw3)); $i++){
			print '<td>' . $mkw3[$i] . '</td>'; //Q3
		}
		print '</tr>';
		print '<tr>';
		for($i = 0; $i < (sizeof($iqr)); $i++){
			print '<td>' . $iqr[$i] . '</td>'; //Q3
		}*/
		print '</tr>';
		print '<tr>';
		for($i = 0; $i < (sizeof($dolnaGranica)); $i++){
			print '<td>' . $dolnaGranica[$i] . '</td>'; //Q3
		}
		print '</tr>';
		print '<tr>';
		for($i = 0; $i < (sizeof($gornaGranica)); $i++){
			print '<td>' . $gornaGranica[$i] . '</td>'; //Q3
		}
		print '</tr>';
		print '</table>';
		/*
		$zmienna = $tab0[round(0.75*($id-1))] -$tab0[round(0.25*($id-1))];
		print 'Q3 - Q1: '.$tab0[round(0.75*($id-1))].' - '.$tab0[round(0.25*($id-1))].' = '.$zmienna.'</br>';*/
	}


  //============================================================================

    punktyOddalone($plik_odczyt);
?>
