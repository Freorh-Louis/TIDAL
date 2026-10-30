Projet RLPB

Membres : 
- Louis VINCENT 
- Bastien FREDENUCCI 
- Romane CHANTEPERDRIX 
- Pierre VAULOT 

Liste des choses faites après l'entretien : 
- afficher qqch d'autre qd on est bien log in 
- adapter la propreté : séparer la responsabilité : mise en forme css à part, js à part avec lien dans le header = essayer d'enlever la balise script 
- retravailler l'arborescence séparer les controller 
-adapter l'autoloader à notre arborescence 
- améliorer l'api qui gere 2 pt read 
- inscription peut - etre ?















Fait : 
04/04
- Page home avec grille en dur 
- header, barre de recherche en dur 
- Page pathologie en dur
- Page login en dur html 

11/04
- Page home dynamique en php 
- Base de donnée pathologie et page pathologie en dynamique avec apache 
- template de la base du site (header en navbar dans un template)
- debut page login en dynamique 

14/04
- SEP ok et fonctionnel 
- set up la bdd utilisateur et debut page login 
- set up bdd serveur (pathologie), trie et requete sql pour la lier a notre site 
- css du main et twig ok, twig pathologie et php de template ok
- css et page login fonctionnel 

16/04 
-


A faire 
- ReadME : développements que vous avez réalisés, vos sources, les auteurs, ainsi que les ressources bibliographiques et la webographie que vous avez utilisé.

- Page d’accueil : Elle doit disposer d’un menu et d’un formulaire d’identification pour les utilisateurs.

- Autres pages: L’organisation des autres pages (nombre, architecture, etc...) dépendra des fonctionnalités à implémenter et de l’interprétation que vous en aurez.

- Consultation des pathologies:  première interface permettant d’afficher la liste des pathologies.
Déterminez les infos pertinentes à afficher : il ne faut pas trop charger l’interface.

- Détails d’une pathologie et symptômes associés : il faut pouvoir afficher les détails d’une pathologie ainsi que la liste de symptômes qui lui sont liés.

- lien entre cette nouvelle interface et la précédente 

- Filtrage des pathologies : optimiser au maximum votre solution en limitant autant que possible les requêtes sur le serveur de base de données. Mais le filtrage devra tout de même être réalisé côté serveur, pas en JavaScript.

- Recherche de pathologies par mot–clef :  implémentez une fonctionnalité de recherche de pathologie par mot–clef. Les mot–clefs sont associés aux symptômes dans la base de connaissance. Cette fonctionnalité ne sera accessible qu’aux utilisateurs authentifiés

- Compte utilisateur : Vous proposerez un système de gestion des utilisateurs (connexion, session, etc.). Un utilisateur connecté aura la possibilité d’accéder à la fonctionnalité de recherche de pathologies par mot–clef



CONSIGNES 
Accessibilité et versions HTML
    • L’ensemble du site respectera les normes d’accessibilité de niveau AAA.
    • Il sera écrit en HTML 5.
    • De plus, toute page du site devra être accessible de la page d’accueil en 3 interactions au maximum (clic, raccourci, etc.).
    • La navigation devra être possible sans souris ou sans clavier.

Environnement d’exécution
    - Le site devra être affichable et utilisable à partir d’une version de Firefox de moins de
    deux ans.
    - La partie dynamique (serveur) devra fonctionner sur une architecture Linux/Apache/-PHP/PostgreSQL.
    - Toutefois, vous restez libres des outils et environnements de développement que vous
    souhaitez utiliser pour arriver à ce résultat.

Base de connaissances
    - La base de connaissances vous est fournie sous la forme d’un script SQL de génération
    de base de données.
    - Vous ne pouvez en aucun cas modifier les tables de cette base, mais vous êtes libres
    d’ajouter de nouvelles tables si vous en avez besoin.
    - La base de connaissance a été réalisée à partir du Vademecum d’acupuncture traditionnelle de Jean Motte.