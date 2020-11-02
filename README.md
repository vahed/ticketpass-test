# Ticketpass Test Project

This project is a nearly default Laravel installation created with some missing functionality just so we can get a practical look in to your coding style and proficiency whilst also giving you freedom to approach the tasks  how you see fit. To make it more appropriate to the Ticketpass product, this project is using [InertiaJS](https://inertiajs.com), a library for creating an SPA experience from a Laravel project using VueJS for the frontend.

## Submitting
When submitting your finished tasks, please ensure to fork this repo and commit your changes there. This repo is only for getting the initial project and task descriptions. Once you have completed the tasks, please email a link to the repository to either Rodrigo or myself.

## Tasks

### Finish the authentication system.
Right now there is a very basic login/registration page set up with the appropriate fields needed for the user. The first task will be to finish the methods on the frontend for both registration and login (This form can be found at `resources/js/pages/auth/Login.vue`) and their respective functions on the `AuthenticationController` (found at `app/Http/Controllers/AuthenicationController`). The routes should allow you to reach the home page upon successful login where your authenticated user information should be dumped out on the page.

### HaveIBeenPwned password checking implementation.
There is a service that I have long wanted to implement in to Ticketpass which allows us to see if the password being provided by the user has been part of a publicly known data breach. This API can be found [here](https://haveibeenpwned.com/API/v2#SearchingPwnedPasswordsByRange).

The task for this one is to implement a check to this API for both newly registering users and those who are returning. If the password provided has been part of a breach we can take action early.

* If the user is just registering, we can reject the password and tell them to pick a better one.
* If the user is logging in, we can make them aware that their password is not very secure and recommend a password change.

You do not need to provide a way for them to actually change their password, adding some kind of alert to the page is sufficient. The task is more about the implementation of the service and making use of the response.

## Installation of Base Project
Once you have downloaded the project you will need to make your `.env` with the settings required, you can grab the variables from `.env.example`. For this project I have gone with sqlite to make it a bit easier to package up however if you would like to use MySQL, PostgreSQL or something else then that is no problem.

After that its the usual Laravel installation process, something like this:
```
composer install
php artisan key:generate
php artisan migrate
yarn install
yarn run watch-poll
```

Now you should be good to go.

## Contact
If you have any questions about the project or tasks, please reach out to me at [rob@ticketpass.org]([mailto:rob@ticketpass.org) and I will get back to you ASAP.

## Links
[Laravel Docs](https://laravel.com/docs/7.x)

[InertiaJS Docs](https://inertiajs.com)

[VueJS Docs](https://vuejs.org/v2/guide/)

[HaveIBeenPwned API](https://haveibeenpwned.com/API/v2)
