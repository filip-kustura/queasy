# Queasy
Projekt iz kolegija Računarski praktikum 2

### Zadatak
Web-stranica omogućava korisnicima rješavanje jednog od ponuđenih kvizova. Kvizovi se sastoje od pitanja raznih tipova (npr. pitanja s ponuđenim odgovorima, pitanja gdje treba upisati odgovor i slično). Administrator može stvoriti novi kviz, dodavati pitanja u njega i definirati točne odgovore. (Tipove pitanja možete unaprijed definirati, tj. administrator ne treba biti u stanju definirati nove tipove pitanja.)

---
- Link na bazu podataka preko phpmyadmin: https://rp2.studenti.math.hr/phpmyadmin/index.php?route=/database/structure&db=kustura
  - Za korisnika s korisničkim imenom _username_, odgovarajući password je pridjev(_username_) + "sifra", npr. username: "Vilim", password: "vilimovasifra"

## Napomena preuzeta iz zadatka s vježbi
- Inače nije dobra ideja spremati puno podataka u `$_SESSION`.
- U `$_SESSION` se obično samo spremi nekakav identifikator `$_SESSION['id']` koji serveru jednoznačno određuje korisnika/session.
- Svi ostali podaci se tada spremaju u bazu podataka pomoću identifikatora.
- Tako i ovdje uspješan login postavlja samo `$_SESSION['id']`, gdje je `id` korisnikov identifikator iz tablice `users`.
- Dosadašnji primjeri započinjanja/dohvaćanja sessiona u projektu su u datotekama:
  - `loginservice.class.php` u metodi `handleLoginAttempt()` -- započinjanje sessiona nakon uspješnog logina i pohrana korisnikovog identifikatora `id` u session
  - `loginController.php` u metodi `handleAction()` -- dohvaćanje sessiona (i identifikatora `id` ulogiranog korisnika)

## TODO
- ~~(Filip) kreirati u bazi i popuniti tablicu s pitanjima, kategorijom, točnim odgovorom i eventualnim ponuđenim odgovorima~~
- ~~(Filip) nadograditi datoteke `create_tables.php` i `seed_tables.php` tako da podržavaju kreiranje/punjenje i tablice `questions`~~
- (Vilim) odgovaranje na pitanja u js - klijentski dio obavljen, potrebna integracija u view-u php, sa pravim pitanjima
- napraviti "homepage" (homepage se prikazuje nakon uspješnog logina) s opcijama
  - singleplayer (**prioritet**)
  - multiplayer (nakon što implementiramo opciju singleplayer)
  - admin opcije (ukoliko je ulogirani korisnik admin)
  - ... TODO opcije koje mogu obogatiti aplikaciju (npr. settings za korisnika, korisnikova statistika, ...)
- ~~(Filip) kreirati u bazi tablice:~~
  - ~~`quizzes`~~
    - ~~sadrži _custom_ kvizove stvorene od strane administratora~~
    - ~~kolone: `id`, `name`, `author`~~
  - ~~`quizzes_questions`~~
    - ~~kolone: `quiz_id`, `question_id`, bez primarnog ključa~~
    - ~~svaki redak predstavlja pripadnost pitanja kvizu~~
- (Filip) dodati još pitanja u tablicu `questions`
- (Filip) dovršiti `Log In` opciju (handleati neuspješan login, odnosno nepostojeći username i/ili netočnu lozinku)
- implementirati mogućnost `Sign Up` (gumb već postoji)
- CSS (nizak prioritet)
- možda u JavaScript kodu, gdje bude prilika, koristiti Ajax
- (?) gdje je već potrebno dodati napomenu za pitanja gdje treba upisati odgovor:
  - ako se traži broj, potrebno ga je upisati brojkama a ne riječima
  - svaki odgovor potrebno je upisati bez "a/an/the" člana
- dodati timer za pitanja
- dodati kolonu creation_date u tablicu `quizzes` koja će se automatski popunjavati prilikom stvaranja novog kviza
