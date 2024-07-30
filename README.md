# TEST TECHNIQUE GROUPE NAT 

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP 8.3 ou plus
- Composer
- MySQL (ou tout autre SGBD compatible avec Doctrine)
- Git (pour cloner le projet)

## Installation

Suivez les étapes ci-dessous pour installer le projet sur votre machine locale.

### 1. Cloner le dépôt

```bash
git clone https://github.com/Verriest/APINAT.git
```

### 2. Installer les dépendances

```bash
composer install
```
### 3. Configuration de l'environnement

Copiez le fichier .env et renommez-le en .env.local :
```bash
cp .env .env.local
```
Ouvrez le fichier .env.local et modifiez la ligne de connexion à la base de données (DATABASE_URL) pour correspondre à votre configuration locale. Par exemple :

```bash
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```
### 4. Charger les fixtures de la base de données

```bash
php bin/console doctrine:fixtures:load
```

## Démarrer le serveur

Pour lancer le serveur de développement Symfony, utilisez la commande suivante :
```bash
symfony server:start
```
## TEST

Pour exécuter les tests, utilisez la commande suivante :
```bash
php bin/phpunit
```

## TODO

- **Finaliser l'initialisation de JWT BUNDLE** : L'intégration de JWT BUNDLE dans le projet n'est pas encore terminée. Nous avons rencontré des problèmes lors de la configuration du bundle, ce qui empêche actuellement la finalisation des tests unitaires. Ces soucis doivent être résolus pour garantir une authentification sécurisée et permettre l'exécution complète des tests. Il est essentiel de revisiter la documentation officielle du bundle et de vérifier les configurations de sécurité pour s'assurer que tout est correctement en place.
- **Finaliser la documentation SWAGGER** : L'API JWT etant pas finalisé la documentation ne peu etre realisé que a l'integration final de JWT.


## Remerciements

Je tiens à exprimer ma gratitude à la société GROUPE NAT pour m'avoir offert l'opportunité de réaliser ce test technique. J'ai apprécié le défi et l'occasion de démontrer mes compétences.

Si vous avez la moindre question ou souhaitez discuter davantage de mes réponses, n'hésitez pas à me contacter par email ou par téléphone. Je serais ravi de répondre à toutes vos interrogations.

Merci encore pour cette opportunité !

Cordialement,

**Maxime verriest**

