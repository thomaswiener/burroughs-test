Burroughs Test
=====================

## About

This application calculates the payout dates of given processes (regular salary and additional bonus payout).
It can easily be configured differently by changing the config data in the parameter.yml.
Alternatively additional processes can be configured and implemented to extend the application to your needs.
Take look in app/config/parameters.yml for additional information about how to configure a process.

## Installation

This application has dependencies you will need to install prior usage. But don't worry. Composer will take care
of this. Just follow the description...

### Clone project

First clone the project, if not already done so.

```
git clone git@.....
```

### Download Composer

Within the project folder, download the Composer

```

```

### Install Composer

Install dependencies

```
php composer.phar install
```

Later on in order to update dependencies after updating this app just do

```
php composer.phar update
```

## Usage

To start the application call
```
php index.php payout:generate {filename}
```

with filename as your desired filename for the report that is being generated.

Example:
```
php index.php payout:generate report.csv
```

## Run Tests

This Application has test cases for its processors. To run them do the following:

```
php vendor/bin/phpunit app/tests/Burroughs/PayoutProcessor/
```
