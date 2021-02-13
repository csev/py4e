Korzystanie z API OpenStreetMap z bazą danych i wizualizacja danych
na OpenStreetMap.

W tym projekcie korzystamy z darmowego API OpenStreetMap (usługa Nominatim) aby 
zamienić wpisane przez użytkowników nazwy uczelni na lokalizacje geograficzne,
a następnie umieszczamy przetworzone dane na mapie OpenStreetMap.

Uwaga: Po Windowsem zalecamy korzystać z terminala PowerShell, tak aby nie było 
problemów z wyświetlaniem znaków UTF-8.

Aby móc przeglądać i modyfikować bazę danych, należy zainstalować program
DB Browser for SQLite:

https://sqlitebrowser.org/

W warunkach korzystania z usługi Nominatim jest wskazanie by ogarniczyć się do 
maksymalnie jednego zapytania na sekundę (usługa jest darmowa, stąd też gdybyśmy
generowali bardzo dużą liczbę zapytań w krótkim czasie, to prawdopodobnie szybko
zablokowano by nam dostęp do API). Nasze zadanie dzielimy na dwie fazy.

W pierwszej fazie bierzemy nasze dane wejściowe z pliku where.data i odczytujemy
je wiersz po wierszu, odczytując przy tym zgeokodowaną odpowiedź serwera
Nominatim i przechowujemy ją w bazie danych (plik geodata.sqlite). Zanim użyjemy
API geokodowania, po prostu sprawdzamy, czy mamy już dane dla tego konkretnego
wiersza, dzięki czemu w przypadku ponownego uruchomienia programu nie będziemy
musieli drugi razy wysyłać zapytania do API.

W dowolnym momencie możesz uruchomić cały proces od początku, po prostu usuwając
wygenerowany plik geodata.sqlite.

Uruchom program geoload.py. Program ten odczyta wiersze wejściowe z pliku
where.data i dla każdego wiersza sprawdzi, czy jest on już w bazie danych, a
jeśli nie mamy danych dla przetwarzanej lokalizacji, to wywoła on zapytanie API
geokodowania aby pobrać dane i przechowywać je w bazie SQLite.

Oto przykładowe uruchomienie po tym, jak w bazie danych znajdują się już jakieś
dane:



python3 geoload.py

Znaleziono w bazie  AGH University of Science and Technology

Znaleziono w bazie  Academy of Fine Arts Warsaw Poland

Znaleziono w bazie  American University in Cairo

Znaleziono w bazie  Arizona State University

Znaleziono w bazie  Athens Information Technology

Pobieranie https://nominatim.openstreetmap.org/search.php?q=University+of+Pretor
ia&format=geojson&limit=1&addressdetails=1&accept-language=pl
Pobrano 954 znaków {"type":"FeatureColl

Pobieranie https://nominatim.openstreetmap.org/search.php?q=University+of+Salama
nca&format=geojson&limit=1&addressdetails=1&accept-language=pl
Pobrano 822 znaków {"type":"FeatureColl



Pierwsze pięć lokalizacji znajduje się już w bazie danych, a więc są one
pomijane. Program przetwarza dane do momentu, w którym znajdzie niezapisane
lokalizacje i zaczyna o nie odpytywać API.

Plik geoload.py może zostać zatrzymany w dowolnym momencie, a ponadto kod
zawiera licznik (zmienna 'count'), którego można użyć do ograniczenia liczby
połączeń do API geokodowania w danym uruchomieniu programu.

Po załadowaniu danych do geodata.sqlite, możesz je zwizualizować za pomocą
programu geodump.py. Program ten odczytuje bazę danych i zapisuje plik where.js
zawierający lokalizacje, szerokości i długości geograficzne w postaci
wykonywalnego kodu JavaScript. Pobrany przez Ciebie plik ZIP zawiera już
wygenerowany where.js, ale możesz go wygenerować jeszcze raz aby sprawdzić
działanie programu geodump.py.

Uruchomienie programu geodump.py odbywa się w następujący sposób:



python3 geodump.py

Akademia Górniczo-Hutnicza, Czarnowiejska, Czarna Wieś, Krowodrza, Kraków,
województwo małopolskie, 31-126, Polska 50.065703299999996 19.918958667058632
Akademia Sztuk Pięknych, Krakowskie Przedmieście, Śródmieście Północne,
Śródmieście, Warszawa, województwo mazowieckie, 00-046, Polska 52.2397515
21.015564130658333
...
260 wierszy zapisano do where.js
Otwórz w przeglądarce internetowej plik where.html aby obejrzeć dane.



Plik where.html składa się z kodu HTML i JavaScript, które służą do wizualizacji
mapy OpenStreetMap przy pomocy biblioteki OpenLayers. Strona odczytuje
najświeższe dane z pliku where.js po to by uzyskać dane niezbędne do
wizualizacji. Oto format pliku where.js:



myData = [
[50.065703299999996,19.918958667058632, 'Akademia Górniczo-Hutnicza, Czarnowiejs
ka, Czarna Wieś, Krowodrza, Kraków, województwo małopolskie, 31-126, Polska'],
[52.2397515,21.015564130658333, 'Akademia Sztuk Pięknych, Krakowskie Przedmieści
e, Śródmieście Północne, Śródmieście, Warszawa, województwo mazowieckie, 00-046,
Polska'],
   ...
];



Jest to lista list zapisana w języku JavaScript. Składnia listy w języku
JavaScript jest bardzo podobna do składni Pythona.

By zobaczyć lokalizacje na mapie, otwórz plik where.html w przeglądarce
internetowej. Możesz najechać kursorem na każdą pinezkę mapy i na nią kliknąć,
tak aby znaleźć lokalizację, którą zwróciło API kodowania dla danych wejściowych
wprowadzonych przez użytkownika. Jeżeli po otwarciu pliku where.html nie widzisz
żadnych danych, sprawdź czy w przeglądarce jest włączony JavaScript lub w
konsoli deweloperskiej swojej przeglądarki sprawdź czy są jakieś błędy.
