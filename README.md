# Bienvenue à mon projet de fin de formation Développeur Web et Web Mobile

Ceci est un _simple_ blog, suivant les principes du **CRUD**, permettant de :

1.  Créer un article incluant : titre, date, catégorie, contenu et image.
2.  Lire/afficher des articles.
3.  Mettre à jour toutes les informations si nécessaire des articles.
4.  Supprimer des articles.

_**Vous trouverez un aperçu du site en bas de cette page**_

**Pour accéder aux options de création**, mise à jour et de suppression, il faut être connecté via le panneau d'administration; **nécessitant vérification utilisateur/mots de passe**. _Voir ci-dessous pour plus de détails._

## Pour commencer à utiliser l'application

1.  Téléchargez l'appli, soit directement, soit en clonant le repo : (https://github.com/NicholasGillespie/dwwm-php-pdo-blog.git).
2.  A même MySQL/MariaDB, utilisant [query.sql](sql/query.sql), créer une base de données.
3.  Configurez les données de configuration de votre DB dans le fichier [config.php](config.php) :
    `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`.
4.  Configurez les données de configuration de votre SMTP dans le fichier [config.php](config.php):
    `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`.

_Couvrant le sujet de configuration SMTP pour Gmail, je me permets de joindre des informations supplémentaires qui pourraient potentiellement vous intéresser :
(https://support.google.com/a/answer/176600)
(https://youtu.be/QUWDC1ZjMHA)_

## Authentification administrateur

Nom d'utilisateur par défaut pour l'administrateur : **niko**.
Mot de passe par défaut pour l'administrateur : **123**.

A savoir : le mot de passe est haché.
L'authentification est faite à l'aide de la fonction php : [`password_verify()`](https://www.php.net/manual/en/function.password-verify.php).

Si souhaité, vous pouvez changer le nom d'utilisateur 'admin 'directement à même la base de données; voir créer un autre compte. Vous pouvez également changer votre mot de passe, ainsi que le hashé en utilisant un générateur comme celui ci-joint : (https://php-password-hash-online-tool.herokuapp.com/password_hash).

## Errors

A même [config.php](config.php), si la configuration `SHOW_ERROR_DETAIL` est défini à `true`, un rapport détaillé sera afficher à même le navigateur en cas d'erreurs. Si la configuration est défini à `false`, un message d'erreur générique sera afficher.

## Mise en page

Focalisé sur les fonctionnalités du blog, le style du site est épuré. La structure du site est 100% algorithmique, signifiant suppression totale des "@media" break-points.

![Webpage screenshot](/uploads/screenshot.jpg)

Si souhaité, vous trouverez les wireframes du site en suivant le lien ci-joint : [wireframe folder](wireframe/)

## _That's all folks!_
