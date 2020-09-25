BloG4
=======

BloG4 is a blog website who allow users to post interresting thing about computer-science. This is a school project started in September 2020 at Institut G4 who purpose many features like:
- A fully secure account
- An article viewer with:
  *filter
  *searcher
  *sorter
- A comments manager


Development
-----------

For compiling and developing BloG4 you need to setup the development
environment first.

Requierements:
* PHP 7.3
* Symfony 5.1


### Development Environment

You can install the needed packages by using these commands:

```sh
...
```


### Installing and Running BloG4

To run the freshly built BloG4 use these commands:

```sh
# Download the project from Github
git clone https://github.com/pac421/BloG4.git

# Go to the app folder
cd BloG4/BloG4

# Create the database
php bin/console doctrine:database:create

# Create the tables and property
php bin/console doctrine:migrations:migrate

# Start the Symfony server
symfony server:start
```
