<p align="center">
  <a href="https://github.com/hiskiapp/course">
    <img src="https://indiepartnership.com/wp-content/uploads/2020/09/icon.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">E-Course</h3>

  <p align="center">
    A website that provides a variety of the best paid courses.
    <br />
    <a href="https://github.com/hiskiapp/course"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/hiskiapp/course">View Demo</a>
    ·
    <a href="https://github.com/hiskiapp/course/issues">Report Bug</a>
    ·
    <a href="https://github.com/hiskiapp/course/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [To Do List](#to-do-list)
* [Acknowledgements](#acknowledgements)

### Built With
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)
* [Laravel](https://laravel.com)



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites
-   PHP Version 7.4 or Above
-   Composer
-   Git

### Installation

1. Open the terminal, navigate to your directory (htdocs or public_html).
```bash
git clone https://github.com/hiskiapp/course.git
cd course
composer install
```

2. Setting the database configuration, open .env file at project root directory
```
DB_DATABASE=**your_db_name**
DB_USERNAME=**your_db_user**
DB_PASSWORD=**password**
```

3. Install Project
```bash
php artisan install
```
You will get the administrator credential and url access like example bellow:
```bash
::Administrator Credential::
URL Login: http://course.test/admin/login
Email: get@hiskia.dev
Password: 123456
```

### To Do List

- [x] Initializing Template
- [x] Initializing Migration
- [x] Login System
- [x] All Admin CRUD
- [x] All Team CRUD
- [x] Manage Course in Team Dashboard
- [x] Initializing Frontend User
- [ ] Course & Quiz User
- [x] Payment Gateway
- [x] Reports

<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
* [Laravel](https://laravel.com)
* [Luma - Education HTML Learning Management System Admin Template](https://themeforest.net/item/luma-education-platform-lms-admin-template/26541343)
