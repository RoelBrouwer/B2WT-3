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

+++++++++SQL++++++++++