+++++++Auteurs++++++++
Jimmy Lu (4141954)
Roel Brouwer (3976866)

+++++++++URL++++++++++
http://www.students.science.uu.nl/~3976866/ci/

+++Geteste Browsers+++

Browser            Versie            Operating System
-------            ------            ----------------
Chrome             32.0.1700.107 m   Windows 7 Home Premium
Chrome             33.0.1750.117     OSX 10.9.2
Firefox            26.0              Windows 7 Home Premium
Firefox            27.0.1            OSX 10.9.2
Internet Explorer  11.0.9600.16518   Windows 7 Home Premium
Safari             (mobiel)          iOS 7.0.6
Safari             7.0.2             OSX 10.9.2

+++++++Extra's++++++++
- Geregistreerd account wordt pas geactiveerd na bevestiging
  via de e-mail.

+++++Toelichting++++++
Alle pagina's die voor een gebruiker toegankelijk zijn binnen
de website zijn te bereiken via het menu of de footer, met
uitzondering van de profieldetail-pagina's (via linkjes in
profielpreviews), de pagina voor het uploaden/wijzigen van de
profielfoto vanuit het profiel (via de profielpagina) en de
formulieren voor het wijzigen van de gegevens/merkvoorkeuren
(via het profiel). Op pagina's die niet toegankelijk zijn voor
de gebruiker wordt op een logische manier doorverwezen naar
wel toegankelijke pagina's (zoals de log-in pagina).
De rest wijst zich vanzelf.

Er is in de applicatie geen duidelijke klasse-hierarchie aan-
wezig. Alle klasses 'staan op gelijke voet' en linken hooguit
naar elkaar door.

Grofweg kun je zeggen dat elk menu-item zijn eigen controller
heeft.

Er zijn vijf verschillende modellen.
- admin_model verzorgt alle informatie die nodig is voor de
  adminomgeving;
- likes_model verzorgt alle informate mbt likes;
- login handelt logins en registraties af;
- test_questions verzorgt de informatie voor persoonlijkheids-
  test en merkvoorkeurentest.
- user_profiles verzorgt informatie over gebruikers, daarbij
  onder andere gebruik makend van likes_model.
Tussen deze vijf modellen bestaat een hoge mate van scheiding,
maar geen strikte scheiding.

Voor de views geldt dat er in sommige gevallen meerdere views
per controller bestaan, en in een enkel geval het omgekeerde
(about_view).

++++++Gebruikers++++++
--Administrator:
E-mail: jaronisgek@live.nl
Wachtwoord: wachtwoord

--Gebruikers
E-mail:
Wachtwoord:

E-mail:
Wachtwoord:

+++++++++SQL++++++++++
CREATE TABLE "algorithm" (
	distance_measure INTEGER NOT NULL,
	xfactor REAL NOT NULL,
	alfa REAL NOT NULL,
	algorithm_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL);

CREATE TABLE "answers" (
	question_tag TEXT NOT NULL REFERENCES "questions" (question_tag) ON DELETE CASCADE ON UPDATE CASCADE, 
	answer_text TEXT NOT NULL, 
	answer_tag TEXT NOT NULL);

CREATE TABLE "brandpref" (
	user_id INTEGER NOT NULL REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
	brand_id INTEGER NOT NULL REFERENCES brands(brand_id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE "brands" (
	brand_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
	name TEXT NOT NULL
	);

CREATE TABLE "dislikes" (
	user_id INTEGER REFERENCES "users" (user_id) ON DELETE CASCADE ON UPDATE CASCADE, 
	user_id_disliked INTEGER REFERENCES "users" (user_id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE "likes" (
	user_id INTEGER REFERENCES "users" (user_id) ON DELETE CASCADE ON UPDATE CASCADE, 
	user_id_liked INTEGER REFERENCES "users" (user_id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE "personalities" (
	personality_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	E REAL NOT NULL,
	N REAL NOT NULL,
	T REAL NOT NULL,
	J REAL NOT NULL);

CREATE TABLE "photos" (
	photo_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	file TEXT NOT NULL,
	thumb TEXT NOT NULL);

CREATE TABLE "questions" (
	question_tag TEXT PRIMARY KEY NOT NULL UNIQUE, 
	question_text TEXT NOT NULL UNIQUE, 
	type TEXT NOT NULL);

CREATE TABLE "users" (
	user_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	nickname TEXT NOT NULL,
	firstname TEXT NOT NULL,
	lastname TEXT NOT NULL,
	email TEXT NOT NULL,
	password TEXT NOT NULL,
	photo_id INTEGER REFERENCES photos(photo_id) ON DELETE SET NULL ON UPDATE CASCADE,
	sex TEXT NOT NULL,
	birthdate DATE NOT NULL,
	sexpref TEXT NOT NULL, 
	description TEXT,
	personality_id INTEGER REFERENCES personalities(personality_id)ON DELETE SET NULL ON UPDATE CASCADE,
	personalpref INTEGER REFERENCES personalities(personality_id)ON DELETE SET NULL ON UPDATE CASCADE,
	minage INTEGER, 
	maxage INTEGER,
	admin BOOLEAN NOT NULL,
	regdate DATE NOT NULL,
	confirmed BOOLEAN NOT NULL,
	key TEXT UNIQUE
);