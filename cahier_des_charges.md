# Click’n Eat - Laravel

## Cahier des charges

---

### Contexte
La startup Click’n Eat nous mandate pour réaliser une application de réservation de restaurant avec prise de commande au préalable, comme un “restaurant sans attente”. Le repas est donc prêt dès notre arrivée.

### Objectif
Proposer une solution optimisée pour plusieurs restaurants qui proposent des menus différents.

### Optimiser les échanges entre les différents acteurs du restaurant (administration, service, cuisine, clients).

### Public cible
Restaurateurs.

### Expression des besoins
Une gestion complète et optimisée des restaurants, permettant de suivre en temps réel les menus, les commandes et les réservations. L’ensemble des opérations est parfaitement synchronisé avec les horaires d’ouverture, assurant une expérience fluide et sur-mesure pour chaque client. L’application Click’n Eat permet de répondre à ces besoins en offrant les outils nécessaires à l’ajustement des offres, à la gestion des réservations et au suivi des commandes, accessibles en ligne pour un pilotage efficace des établissements à tout moment.

### Fonctionnalités MVP (Minimum Viable Product)
Gestion des restaurants
Authentification des utilisateurs
Accès spécifique restaurant
Accès spécifique client
Gestion de la carte/des menus (classification des articles au menu par catégorie)
Gestion des commandes

### Fonctionnalités MLP (Minimum Lovable Product)
Génération d’un lien d’accès à la commande de chaque carte de restaurant via un QR code
Responsive
Paramétrage de la charte graphique du restaurant pour sa carte
Paiement en ligne via API Stripe (avantages : package Laravel cashier, voir doc)

### Contraintes techniques
Laravel
Déploiement sur un nom de domaine
Intégration continue
intégrer automatique les migrations de BDD
gérer le vide des caches de Laravel,
gérer l’optimisation des fichiers de production
Template
Certificat SSL (HTTPs)
Tests unitaires : code qui teste le code