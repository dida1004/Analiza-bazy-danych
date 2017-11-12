<?php
  if (isset($_POST['action'])) {
  	switch ($_POST['action']) {
  			case 'Poprawione Dane':
  					echo "poprawione";
  					break;
  			case 'Oryginalne Dane':
  					echo "oryginalne";
  					break;
  			case 'Obróbka Danych':
  					echo "obrobka";
  					break;
  			case 'Statystyki Opisowe':
  					echo "statystyki";
  					break;
  			case 'Punkty Oddalone':
  					echo "oddalone";
  					break;
  			case 'Pearson':
  					echo "pearson";
  					break;
  			case 'Regresja Liniowa':
  					echo "regresja";
  					break;
  	}
  }
?>
