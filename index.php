<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Analiza i wizualizacja danych</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0">
		<link rel="stylesheet" href="styles.css">

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script src="script.js"></script>
	</head>

	<body id="main">
		<div class="buttons">
			<input class="button" type="submit" name='oryginalne dane' value="Oryginalne Dane">
			<input class="button" type="submit" name='obrobka danych' value="Obróbka Danych">
			<input class="button" type="submit" name='poprawione dane' value="Poprawione Dane">
			<input class="button" type="submit" name='statystyki opisowe' value="Statystyki Opisowe">
			<input class="button" type="submit" name='punkty oddalone' value="Punkty Oddalone">
			<input class="button" type="submit" name='pearson' value="Pearson">
			<input class="button" type="submit" name='regresja liniowa' value="Regresja Liniowa">
		</div>
		<div id="chartContainer"></div>
		<div id="tekst">
			<!-- ramka wypełniana przy pomocy skryptów -->
		</div>
	</body>
</html>
