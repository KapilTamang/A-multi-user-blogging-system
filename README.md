# Multi User Bogging System
A blogging system that allows multiple users to create account and post blogs, comment on posts.
- Usage of Laravel Socialite for OAUTH 2 authentication.

# Usage
- run 'npm install' for installing dependencies.
- rename .env.example file to .env and provide the required credentials.
- create your database and run 'php artisan migrate'.
- run 'php artisan db:seed' if you want to start with dummy data.
- for OAUTH 2 authentication, register your app with facebook and google and setup the callback url.
- for email verification, you need to provide credentials of your SMTP server in .env file. 

# Running Application
- run 'php artisan serve'.
