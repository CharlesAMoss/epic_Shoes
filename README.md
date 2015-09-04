# _Shoe Store_

#### _A program to list out shoe stores and the brands of shoes they carry built to work with "many to many" mySQL database, 8/28/2015_

#### By _**Charles Moss**_

## Description

An input field accepts a shoe store's name of and adds it to a list. Another input field accepts the name of brands of shoes. The users can make connections of "stores" and "brands". The user can view either by "brand" or "store" and see the relationships they have set. A clear all button can be found on the home page. ( This will clear all entries from the database, handle with care ).

## Setup
When installing from source you may notice that once you have cloned this repo, that this project makes use of a PHP Dependency Manager: [Composer](https://github.com/composer/composer). Once you have Composer installed you can acquire any project dependencies via your shell by entering:

```
$ composer install
```

_You then only need to start up a local PHP server from within the "web" directory within the project's folder and point your browser to whatever local host server you have created._

## Database Setup

```
-> CREATE DATABASE shoes;

-> USE shoes;

-> CREATE TABLE brands_t (id serial PRIMARY KEY, brand_name varchar (255));

-> CREATE TABLE stores_t (id serial PRIMARY KEY, store_name varchar (255));

-> CREATE TABLE brands_stores_t (id serial PRIMARY KEY, brand_id int, store_id int);

```

_An export of this database can be found in the db folder_

## Technologies Used
_This project makes use of PHP, mySQL, the testing framework [PHPUnit](https://phpunit.de/), the micro-framework [Silex](http://silex.sensiolabs.org/), and uses [Twig](http://twig.sensiolabs.org/) templates._

## To do

This project is incomplete:

**Task left to do:**
* get my last 2 store tests to pass **completed 8/29**
* complete the brand tests          **completed 8/29**
* finish client routes              **completed 9/3**
* finish client twig                **completed 9/3**
* confirm features                  **completed 9/3**


### Legal

Copyright (c) 2015 Charles A Moss

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
