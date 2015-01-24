AliceDemo
=========

A example Symfony2 Application using h4cc/AliceFixureBundle in multiple ways.


## Installation of hacc/AliceFixureBundle

Add in your [composer.json](composer.json) the following line to either "require" or "require-dev":
```
    "h4cc/alice-fixtures-bundle": "dev-master"
```
(I recommend to follow a stable version if available)

Then update your packages
```
php composer.phar update
```

After that, add the Bundle to your [AppKernel](app/AppKernel.php).


## Configuration

A configuration is optional.

Check out the [default configuration](app/config/config_dev.yml).

Use this command to get a up-to-date config reference:
```
php app/console config:dump-reference h4cc_alice_fixtures
```
## How does it work?

Fixtures are stored in YAML files which can be used in a number of ways:

* use app/console to load the fixtures into the database
* use the fixtures in PHPUnit tests
* use the fixtures in Selenium tests


## First fixture file

A simple fixture file is the [default.yml](src/h4cc/AliceCustomerBundle/DataFixtures/Alice/default.yml)

## Creating and using fixture sets

A couple of fixture files can be combined to a set. This is done with a simple PHP script, see [CustomerDefaultSet.php](https://github.com/h4cc/AliceDemo/blob/master/src/h4cc/AliceCustomerBundle/DataFixtures/Alice/CustomerDefaultSet.php) for an example. Any file that is named after the pattern "DataFixtures/Alice/*Set.php" will be recognized automatically as a set.

Sets can be automatically loaded by this command:
```
php app/console h4cc_alice_fixtures:load:sets
```

## Adding a Faker Provider

The configuration of a provider can be found in the [services.yml](src/h4cc/AliceDemoBundle/Resources/config/services.yml).

The referenced "CategoryProvider" class add a method called "categoryName", which can be used in the fixture files like this: "<categoryName()>". For example here in [categories.yml](src/h4cc/AliceDemoBundle/DataFixtures/Alice/categories.yml).


## Using a FixtureSet in a PHPUnit Test

The test [UserControllerTest](src/h4cc/AliceDemoBundle/Tests/Controller/UserControllerTest.php) as a setUp() Method, which will clear the database and load the given fixtures.
This way functional tests could be done, that demand a specific dataset.

## Providing a Controller Action for Selenium tests to load Fixtures

The controller [SeleniumController](src/h4cc/AliceDemoBundle/Controller/SeleniumController.php) contains a action for loading a defined fixture set.
This way, a browser test could force the reset of the database for predictable tests.


