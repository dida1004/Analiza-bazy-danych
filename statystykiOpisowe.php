<?php
//zakresy wartości, jakie przyjmują zmienne;
//wartości średnie i odchylenie standardowe,
//mediana zmiennych,
//rozstępy międzykwartylowe dla zmiennych,
//kwantyle rzędu 0.1, 0.9.
	$plik_odczyt = 'transfusion - poprawione.data';
	//$plik_odczyt = 'transfusion - moje.data';
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

	// 2.1
	function zakresyWartosci($file){
		sprawdzPlik($file);

		$min = array(1000000, 1000000, 1000000, 1000000, 1000000);
		$max = array(0,0,0,0,0);

		if($uchwyt_odczyt = fopen($file, 'r')){
			//print 'Utowrzono uchwyt dla pliku do odczytu. </br>';
		}
		else {
			print 'NIE udało się utworzyć uchwytu dla pliku do odczytu. </br>';
			exit;
		}

		print '</br>2.1 Zakresy wartosci zmiennych, jakie przyjmują zmienne.';
		print '<table id="zakresy">';
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
					if($min[$i] > $wiersz[$i]){
						//print '</br>'.$i.' min: '.$min[$i].' <-- '.$wiersz[$i];
						$min[$i] = $wiersz[$i];
					}
					if($max[$i] < $wiersz[$i]){
						//print '</br>'.$i.' max: '.$max[$i].' <-- '.$wiersz[$i];
						$max[$i] = $wiersz[$i];
					}
				}
			}
			print '</tr>';
			$id++;
		}
		print '<tr>';
		for($i = 0; $i < sizeof($min); $i++){
			print '<td>' . $min[$i] . '</td>';
		}
		print '</tr><tr>';
		for($i = 0; $i < sizeof($max); $i++){
			print '<td>' . $max[$i] . '</td>';
		}
		print '</tr>';
		print '</table>';

	}

	// 2.2
	function wartosciSrednie($file){
		sprawdzPlik($file);

		$usrednioneDane = array(0,0,0,0,0);
		$odchylenie = array(0,0,0,0,0);
		$c4 = 0.99965; // wartosc dla 750 zmiennych

		if($uchwyt_odczyt = fopen($file, 'r')){
			//print 'Utowrzono uchwyt dla pliku do odczytu. </br>';
		}
		else {
			print 'NIE udało się utworzyć uchwytu dla pliku do odczytu. </br>';
			exit;
		}

		print '</br>2.2 Wartości średnie i odchylenie standardowe.';
		print '<table id="srednie">';
		// 2.2.1 obliczenie srednich wartosci zmiennych
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
					if(empty($wiersz[$i]) && $wiersz[$i] !== '0' || $wiersz[$i] < 0){
						// sprawdzenie konca pliku
						if(empty($wiersz[0]) && empty($wiersz[1]) && empty($wiersz[2]) && empty($wiersz[3]) && empty($wiersz[4])){
							break;
						}
					}
					//print '</br>'.$i.') '.$usrednioneDane[$i].' + '.$wiersz[$i].' = ';
					$usrednioneDane[$i] += $wiersz[$i];
					//print $usrednioneDane[$i];
				}
			}
			print '</tr>';
			$id++;
		}
		//print '</br>ID: '.($id-1);
		for($i = 0; $i < sizeof($usrednioneDane); $i++){
			$usrednioneDane[$i] = ($usrednioneDane[$i] /($id-1));
		}

		// 2.2.2 obliczenie odchylenia standardowego
		rewind($uchwyt_odczyt);
		$id = 0;
		while(!feof($uchwyt_odczyt)){
			$wiersz = fgetcsv($uchwyt_odczyt, 0, ','); // Pobranie z pliku wiersza tekstu
			print '<tr>';
			//wyswietlenie pierwszego wiersza opisowego
			if($id < 1){
				/*
				for($i = 0; $i < sizeof($wiersz); $i++){
					$wiersz[$i] = trim($wiersz[$i]);
					print '<th>' . $wiersz[$i] . '</th>';
				}
				*/
			}
			else{
				// wyswietlanie danych w tabeli i wyliczanie minimalnej i maksymalnej wartosci zmiennej
				for($i = 0; $i < sizeof($wiersz); $i++){
					if(empty($wiersz[$i]) && $wiersz[$i] !== '0' || $wiersz[$i] < 0){
						// sprawdzenie konca pliku
						if(empty($wiersz[0]) && empty($wiersz[1]) && empty($wiersz[2]) && empty($wiersz[3]) && empty($wiersz[4])){
							break;
						}
					}
					//$usrednioneDane[$i] += $wiersz[$i];
					$odchylenie[$i] += pow($wiersz[$i] - $usrednioneDane[$i], 2);
				}
			}
			print '</tr>';
			$id++;
		}
		print '<tr>';
		for($i = 0; $i < sizeof($usrednioneDane); $i++){
			print '<td>' . round($usrednioneDane[$i]) . '</td>';
		}
		print '</tr><tr>';
		for($i = 0; $i < sizeof($odchylenie); $i++){
			$odchylenie[$i] = sqrt($odchylenie[$i] /($id-1))*$c4;
			print '<td>' . $odchylenie[$i] . '</td>';
		}
		print '</tr>';
		print '</table>';
	}

	//2.3 mediana
	function mediana($file){
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

		print '</br>2.3 Mediany poszczególnych zmiennych.';
		print '<table id="mediany">';
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
		if((sizeof($tab0)+1) %2 == 0){
			print '<tr>';
			print '<td>' . $tab0[sizeof($tab0)/2] . '</td>';
			print '<td>' . $tab1[sizeof($tab1)/2] . '</td>';
			print '<td>' . $tab2[sizeof($tab2)/2] . '</td>';
			print '<td>' . $tab3[sizeof($tab3)/2] . '</td>';
			print '<td>' . $tab4[sizeof($tab4)/2] . '</td>';
			print '</tr>';
			print '</table>';
		}else{
			for($i = 0; $i < (sizeof($tab0)); $i++){
				$med0 = ($tab0[sizeof($tab0)/2] + $tab0[(sizeof($tab0)/2)-1]) /2;
				$med1 = ($tab1[sizeof($tab1)/2] + $tab1[(sizeof($tab1)/2)-1]) /2;
				$med2 = ($tab2[sizeof($tab2)/2] + $tab2[(sizeof($tab2)/2)-1]) /2;
				$med3 = ($tab3[sizeof($tab3)/2] + $tab3[(sizeof($tab3)/2)-1]) /2;
				$med4 = ($tab4[sizeof($tab4)/2] + $tab4[(sizeof($tab4)/2)-1]) /2;
			}

			print '<tr>';
			print '<td>' . $med0 . '</td>';
			print '<td>' . $med1 . '</td>';
			print '<td>' . $med2 . '</td>';
			print '<td>' . $med3 . '</td>';
			print '<td>' . $med4 . '</td>';
			print '</tr>';
			print '</table>';
		}
	}

	// 2.4
	function rozstepyMiedzykwartylowe($file){
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

		print '</br>2.4 Rozstępy miedzykwartylowe poszczególnych zmiennych.';
		print '<table id="rozstepy">';
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
			$mkw[0] = $tab0[round(0.75*($id-1))] -$tab0[round(0.25*($id-1))];
			$mkw[1] = $tab1[round(0.75*($id-1))] -$tab1[round(0.25*($id-1))];
			$mkw[2] = $tab2[round(0.75*($id-1))] -$tab2[round(0.25*($id-1))];
			$mkw[3] = $tab3[round(0.75*($id-1))] -$tab3[round(0.25*($id-1))];
			$mkw[4] = $tab4[round(0.75*($id-1))] -$tab4[round(0.25*($id-1))];
		}

		print '<tr>';
		for($i = 0; $i < (sizeof($mkw)); $i++){
			print '<td>' . $mkw[$i] . '</td>';
		}
		print '</tr>';
		print '</table>';
		/*
		$zmienna = $tab0[round(0.75*($id-1))] -$tab0[round(0.25*($id-1))];
		print 'Q3 - Q1: '.$tab0[round(0.75*($id-1))].' - '.$tab0[round(0.25*($id-1))].' = '.$zmienna.'</br>';*/
	}

	// 2.5 kwantyle 0.1 0.9
	function kwantyle($file){
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

		print '</br>2.5 Kwantyle rzędu 0.1, 0.9.';
		print '<table>';
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
			$mkw1[0] = $tab0[round(0.1*($id-2))];
			$mkw1[1] = $tab1[round(0.1*($id-2))];
			$mkw1[2] = $tab2[round(0.1*($id-2))];
			$mkw1[3] = $tab3[round(0.1*($id-2))];
			$mkw1[4] = $tab4[round(0.1*($id-2))];

			$mkw9[0] = $tab0[round(0.9*($id-2))];
			$mkw9[1] = $tab1[round(0.9*($id-2))];
			$mkw9[2] = $tab2[round(0.9*($id-2))];
			$mkw9[3] = $tab3[round(0.9*($id-2))];
			$mkw9[4] = $tab4[round(0.9*($id-2))];
		}

		print '<tr>';
		for($i = 0; $i < (sizeof($mkw1)); $i++){
			print '<td>' . $mkw1[$i] . '</td>';
		}
		print '</tr>';
		print '<tr>';
		for($i = 0; $i < (sizeof($mkw9)); $i++){
			print '<td>' . $mkw9[$i] . '</td>';
		}
		print '</tr>';
		print '</table>';
		/*
		$zmienna = $tab0[round(0.75*($id-1))] -$tab0[round(0.25*($id-1))];
		print 'Q3 - Q1: '.$tab0[round(0.75*($id-1))].' - '.$tab0[round(0.25*($id-1))].' = '.$zmienna.'</br>';*/
	}

	// 2.6 kwantyle 0.25 0.75
	function kwantyleQ1($file){
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

		print '</br>2.6 Kwantyle rzędu 0.25, 0.75.';
		print '<table id="kwantyleQ1">';
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
			$mkw1[0] = $tab0[round(0.25*($id-2))];
			$mkw1[1] = $tab1[round(0.25*($id-2))];
			$mkw1[2] = $tab2[round(0.25*($id-2))];
			$mkw1[3] = $tab3[round(0.25*($id-2))];
			$mkw1[4] = $tab4[round(0.25*($id-2))];

			$mkw9[0] = $tab0[round(0.75*($id-2))];
			$mkw9[1] = $tab1[round(0.75*($id-2))];
			$mkw9[2] = $tab2[round(0.75*($id-2))];
			$mkw9[3] = $tab3[round(0.75*($id-2))];
			$mkw9[4] = $tab4[round(0.75*($id-2))];
		}

		print '<tr>';
		for($i = 0; $i < (sizeof($mkw1)); $i++){
			print '<td>' . $mkw1[$i] . '</td>';
		}
		print '</tr>';
		print '<tr>';
		for($i = 0; $i < (sizeof($mkw9)); $i++){
			print '<td>' . $mkw9[$i] . '</td>';
		}
		print '</tr>';
		print '</table>';
		/*
		$zmienna = $tab0[round(0.75*($id-1))] -$tab0[round(0.25*($id-1))];
		print 'Q3 - Q1: '.$tab0[round(0.75*($id-1))].' - '.$tab0[round(0.25*($id-1))].' = '.$zmienna.'</br>';*/
	}
	//============================================================================

	zakresyWartosci($plik_odczyt);
	wartosciSrednie($plik_odczyt);
	mediana($plik_odczyt);
	rozstepyMiedzykwartylowe($plik_odczyt);
	kwantyle($plik_odczyt);
	kwantyleQ1($plik_odczyt);
	//test();
?>
