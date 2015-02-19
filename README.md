Zend2 With Doctrine Study
=======================

Introduction
------------
This is a simple application running ZF2 with Doctrine ORM , I created this repository just to share with others developers my learning progress and hope be helpfull and solve some issues

-------------
Start point.

I start this project just clone the skelleton application and change the composer.json add this lines
    
    "minimum-stability": "dev",
    "require": {
                    "doctrine/doctrine-orm-module": "dev-master",
                    "hounddog/doctrine-data-fixture-module": "dev-master"
                }
And Run composer.phar update to instal Doctrine and all modules includin Data-Fixture
