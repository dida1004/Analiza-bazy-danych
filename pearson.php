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

  function pearson($file){
    sprawdzPlik($file);

    $zmienna_x = 1;
    $zmienna_y = 2;

    $x = 0;
    $y = 0;
    $xy = 0;
    $x2 = 0;
    $y2 = 0;

    if($uchwyt_odczyt = fopen($file, 'r')){
      //print 'Utowrzono uchwyt dla pliku do odczytu. </br>';
    }
    else {
      print 'NIE udało się utworzyć uchwytu dla pliku do odczytu. </br>';
      exit;
    }

    print '</br>4. Korelacja liniowa Pearsona.';
    print '<table id="pearson">';
    $id = 0;
    while(!feof($uchwyt_odczyt)){
      $wiersz = fgetcsv($uchwyt_odczyt, 0, ','); // Pobranie z pliku wiersza tekstu
      print '<tr>';
      //wyswietlenie pierwszego wiersza opisowego
      if($id < 1){
        $wiersz[$zmienna_x] = trim($wiersz[$zmienna_x]);
        $wiersz[$zmienna_y] = trim($wiersz[$zmienna_y]);
        print '<th>' . $wiersz[$zmienna_x] . '</th>';
        print '<th>' . $wiersz[$zmienna_y] . '</th>';
      }
      else{
        // wyswietlanie danych w tabeli i wyliczanie minimalnej i maksymalnej wartosci zmiennej
        if(empty($wiersz[$zmienna_x]) && $wiersz[$zmienna_x] !== '0' || $wiersz[$zmienna_x] < 0){
          // sprawdzenie konca pliku
          if(empty($wiersz[$zmienna_x]) && empty($wiersz[$zmienna_x])){
            break;
          }
        }
        $wiersz[$zmienna_x] = trim($wiersz[$zmienna_x]);
        $wiersz[$zmienna_y] = trim($wiersz[$zmienna_y]);
        print '<td>' . $wiersz[$zmienna_x] . '</td>';
        print '<td>' . $wiersz[$zmienna_y] . '</td>';

        $x += $wiersz[$zmienna_x];
        $y += $wiersz[$zmienna_y];
        $xy += $wiersz[$zmienna_x] * $wiersz[$zmienna_y];
        $x2 += pow($wiersz[$zmienna_x], 2);
        $y2 += pow($wiersz[$zmienna_y], 2);

      }
      print '</tr>';
      $id++;
    }

    $r =((($id-1)*$xy)-($x*$y))/(sqrt(((($id-1)*$x2)-pow($x, 2))*((($id-1)*$y2)-pow($y, 2))));

    /*
    print '</br>x = '.$x;
    print '</br>y = '.$y;
    print '</br>x*y = '.$xy;
    print '</br>x^2 = '.$x2;
    print '</br>y^2 = '.$y2;
    print '</br>n = '.($id-1);
    */
    print '</br>r = '.round($r,5);
  }

  //============================================================================

    pearson($plik_odczyt);
?>
