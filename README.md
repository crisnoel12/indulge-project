# Setup
1. Clone this repo into your laravel environment.
2. Run `ssh vagrant` and then `composer install` and `yarn` to install dependencies.
3. Include the `public` folder path and `indulge` db name in your `homestead.yml` file, under the **sites** and **database** section respectively.
4. Create a `.env` file in project root. Copy and paste contents from `.env.example`. Change **Database** field to `indulge`. Run `php artisan key:generate` to generate a key in your **.env** file.
5. Exit out of ssh and run `vagrant reload --provision` to initiate changes from the **homestead.yml** file.
6. SSH into vagrant again and cd into `indulge`.
7. Run `php artisan migrate` to create the project's database tables.
8. Run `php artisan db:seed` to insert the project's default data.

Project comes with 2 users:

| Email                    | Password                 | 
|:------------------------:|:------------------------:| 
| greenranger@gmail.com    | password                 | 
| redranger@gmail.com      | password                 | 
