<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Task Manager</h1>
    <br>
</p>


Simple task manager for what:
-------------------
1. If u have several domains(projects) and for everyone u need local task managing;
2. If u use VCS (like git), and for every task you need different name (branch, like `iss1`).

Can we do, what:
-------------------
1. Project managing;
2. Task for every project;
3. Exporting tasks.
4. For every action, event listeners;
5. Log;
6. Backup db.

Installation
-------------------
The preferred way to install this extension is through composer.

Either run
~~~
 php composer.phar ..... in work.
~~~
or add
~~~
 ..... in work.
~~~
to the require section of your composer.json.


create backups folder for db backup.
~~~
runtime/backups
~~~

Configuration
------------
The minimum requirement by this project template that your Web server supports PHP 7.1.

Database Migrations

Edit the file `config/db.php`, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=plan-manager',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```
Run base migration
~~~
 php yii migrate
~~~

**NOTES:**
