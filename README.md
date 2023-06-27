# Queasy
Projekt iz kolegija Računarski praktikum 2

Web-stranica omogućava korisnicima rješavanje jednog od ponuđenih kvizova. Kvizovi se sastoje od pitanja raznih tipova (npr. pitanja s ponuđenim odgovorima, pitanja gdje treba upisati odgovor i slično). Administrator može stvoriti novi kviz, dodavati pitanja u njega i definirati točne odgovore. (Tipove pitanja možete unaprijed definirati, tj. administrator ne treba biti u stanju definirati nove tipove pitanja.)

---
Link na tablicu `users` preko phpmyadmin: https://rp2.studenti.math.hr/phpmyadmin/index.php?route=/sql&db=kustura&table=users&pos=0  
Za korisnika s korisničkim imenom _username_, odgovarajući password je pridjev(_username_) + "sifra", npr. username: "Vilim", password: "vilimovasifra"

## Napomena preuzeta iz zadatka s vježbi:
- Inače nije dobra ideja spremati puno podataka u `$_SESSION`.
- U `$_SESSION` se obično samo spremi nekakav identifikator `$_SESSION['id']` koji serveru jednoznačno određuje korisnika/session.
- Svi ostali podaci se tada spremaju u bazu podataka pomoću identifikatora.
- Tako i ovdje uspješan login postavlja samo `$_SESSION['id']`, gdje je `id` korisnikov identifikator iz tablice `users`.
- Dosadašnji primjeri započinjanja/dohvaćanja sessiona u projektu su u datotekama:
  - `loginservice.class.php` u metodi `handleLoginAttempt()` -- započinjanje sessiona nakon uspješnog logina i pohrana korisnikovog identifikatora `id` u session
  - `loginController.php` u metodi `handleAction()` -- dohvaćanje sessiona (i identifikatora `id` ulogiranog korisnika)

## TODO
- kreirati u bazi i popuniti tablicu s pitanjima, tipom pitanja, eventualnim ponuđenim odgovorima i točnim odgovorom
- odgovaranje na pitanja u js (Vilim)
- napraviti "homepage" (homepage se prikazuje nakon uspješnog logina) s opcijama
  - singleplayer (**prioritet**)
  - multiplayer (nakon što implementiramo opciju singleplayer)
  - admin opcije (ukoliko je ulogirani korisnik admin)
  - ... TODO opcije koje mogu obogatiti aplikaciju (npr. settings za korisnika, korisnikova statistika, ...)
- dovršiti `Log In` opciju (handleati neuspješan login, odnosno nepostojeći username i/ili netočnu lozinku)
- implementirati mogućnost `Sign Up` (gumb već postoji)
- CSS (nizak prioritet)
- možda u JavaScript kodu, gdje bude potrebe, koristiti Ajax
