## Laravel With Vue.js and Chart.js Todo List Burndown Chart

### Installation
```
git clone https://github.com/psab72/todo-list-burndown-chart.git
```
**Go to project root folder**
```
cd todo-list-burndown-chart
```
*composer install**
```
composer install
```
**npm install**
```
npm install
```
**npm run watch or npm run dev**
```
npm run dev
```
or
```
npm run watch
```
**Copy .env file**
```
cp .env.example .env
```
**Generate APP_KEY**
```
php artisan key:generate
```
**Configure MySQL connection details in .env**

**Run database migrations and seeders**
```
php artisan migrate:fresh --seed
```

### Running the application
For Mac users you can run the program with Laravel Valet. A local dev environment exclusive for Mac.
```
valet install
```
Make sure you are in the project root folder and run:
```
valet link
```
Go to the link:
```
todo-list-burndown-chart.test
```
### User credentials
```
email: juandelacruz@gmail.com
password: password
```
### PHPUnit Test
```
./vendor/bin/phpunit
```
