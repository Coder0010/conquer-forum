# Metronic Dashboard

Metronic Dashboard With Laravel backend having the most commen cruds.

### Step One

Clone the repository

    git clone git@gitlab.com:coder0010/conquer-forum

or you can download it by the desktop application of github

https://gitlab.com/coder0010/conquer-forum

Switch to the repo folder

    cd conquer-forum

### Step Two

Run This bash file **bashes/refresh.sh** at your terminal for prepare the project

Copy .env.local file and make the required configuration changes in the .env file

run this command to create main database

    php artisan server:setup   **This Is the most important command for developer**

    then choose first one to create **database** and after it finished,

    choose second one to run **migrate** and after it finished

    choose third one to run **seeder**

### Step Three

    php artisan serve

You can now access the server at http://127.0.0.1:8000

### Step Four

To Create New Domain run this command to create new domain if you want

    php artisan domain:generate [DomainName (Singular)] => to see this command check this file app/console/Commands/DomainGeneratorCommand.php
        ex:- php artisan domain:generate Auth

To Create Crud and append it to specific domain

    php artisan crud:generate [DomainName (Singular)] [CrudName (Singular)] => to see this command check this file app/console/Commands/DomainGeneratorCommand.php
        ex:- php artisan crud:generate Auth Leads
        Then Choose which nameSpace you want to add this crud  (AdminPanel Or Enduser)
