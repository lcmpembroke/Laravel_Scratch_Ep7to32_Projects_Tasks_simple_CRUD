# Project Name
>  Projects and associated tasks with authentication and authorization functionality
Laracasts Laravel 5.7 from Scratch   Episodes 7 to 32  
See https://laracasts.com/series/laravel-from-scratch-2018/

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)
* [Features](#features)
* [Status](#status)
* [Inspiration](#inspiration)

## General info
This code follows episodes 7 to 32 of Laravel 5.7 from Scratch.  It is a simple CRUD project to create projects and associated tasks for the logged in user, with authentication and authorization.

## Technologies
* Laravel Framework 5.7 or greater
* Database e.g. mysql
* Developed on local machine. Server requirements found at https://laravel.com/docs/5.7/#server-requirements

## Setup
* git clone https://github.com/lcmpembroke/Laravel_Scratch_Ep7to32_Projects_Tasks_simple_CRUD.git
* cd Laravel_Scratch_Ep7to32_Projects_Tasks_simple_CRUD
* composer install
* npm install
* cp .env.example .env
* php artisan key:generate
* edit the .env file ensuring you have your database connections set up
* php artisan migrate
* php artisan serve

In browser:  
* go to http://localhost:8000 and you will be redirected to a login page
* register a user
* start creating a project for that user

## Features
For an authenicated user, a project can be created. Each project can have tasks assocaited with it which can be ticked off when completed.
Note that the "admin" user has been hardcoded (for speed) into the Gate check within the boot() function of AuthServiceProvider.php.
Any person registered with "test" anywhere in their email address will be treated as admin and therefore able to see projects that they are not the owner of.  
Any other registered users that have email addresses without the word "test" in them, will only be able to access their own projects.  
Note that any email functionality relating to authentication is as it was out of the box from laravel, not configured in this project. to actually send emails.

## Status
Project is: _finished_ as this part of the tutorial came to an end.  
Would be good to develop the Access Control list - create proper roles for users and use these database stored roles for authorization.  

## Inspiration
Project inspired by a desire to learn in order to return to developer role having taken a career break to raise a family.
