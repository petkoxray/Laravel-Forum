# Forum built with Laravel and VueJS
***

### Functionalities
- Authentication and Roles (Admin, User)
- User confirmation with email
- Users can create / edit threads, replies, like replies, mark best reply (if author of thread) subscribe to threads (and receive notifications for new replies)
- Users have activities and reputation in their profiles and can upload avatars
- Users can be mentioned in reply (github style) / thread and receive notification for that
- Edit and create reply / thread WYSIWYG style 
- Google recaptcha validation for creating threads
- Redis for caching
- Search functionality for Threads
- and much more...

## Instalation

#### Prerequisites

  - PHP7 / MySQL 
  - Redis for cache driver https://redis.io/topics/quickstart

#### Steps

```sh
git clone git@github.com:petkoxray/Laravel-Forum.git
cd Laravel-Forum && composer install && npm install
npm run dev
create .env file from  .env.example and put database
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan scout:mysql-index App\\Models\\Thread
php artisan serve
```
#### How to use
*Sample Admin user:* admin@abv.bg password: 123456  
*Sample Normal user:* pesho@abv.bg password: 123456  
You should add https://mailtrap.io/ configuraion if you want email confirmation to work.  
Create Categories/Channels before create threads!
