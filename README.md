BloG4
=======

Écrire ici la description du projet.


Development
-----------

For compiling and developing BloG4 you need to setup the development
environment first.

Requierements
* PHP 7.3
* Symfony 5.1


### Development Environment

You can install the needed packages by using these commands:

```sh
Écrire ici les commandes d'installation de l'environement.
```


### Building BloG4

You can download the sources by using this commands:

```sh
git clone https://github.com/pac421/BloG4.git
```

### Installing and Running BloG4

To run the freshly built BloG4 use this:

```sh
# Go to the project folder
cd <path-of-project>

# Create the database
php bin/console doctrine:database:create

# Create the tables and property
php bin/console doctrine:migrations:migrate

# Start the Symfony server
symfony server:start
```
