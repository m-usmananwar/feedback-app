## Feedback Application

This is the simple project to add feedbacks.

**To create a project from this repository:**

```
git clone https://github.com/m-usmananwar/feedback-app.git

```

To start the Project

```bash
composer install # only the first time
php artisan key:generate 
```
Create new file with name .env in route directory //copy content from existing .env.example file

```bash
php artisan key:generate 
```

If you are running the application for the first time you should
run the migrations first set database credentials in .env file

```bash
php artisan migrate:fresh --seed 
```
### Note: 
Admin user is default added via seeder with email=ninjadeveloper@gmail.com && password=NinjaDev008



