# pdf-generator
Just a MVP for a PDF generator :-)

### Dependencies
- Docker 
- Docker Compose

### How to run
- Clone this repository
- Set the environment variables in the .env file
- Install composer dependencies by running `composer install`
- Generate an app_key by running `php artisan key:generate`
- Build the assets by running `npm install && npm run dev`
- Build the images and start the containers by tunning `docker-compose up -d --build`
- Access the url `http://localhost:8008` (apache container) or `http://localhost:8009` (nginx container) in your browser

### Installed libraries so far
- [barryvdh/laravel-snappy](https://github.com/barryvdh/laravel-snappy) docker-only (or you can install the wkhtmltpdf in your machine) 
- [spatie/browsershot](https://github.com/spatie/browsershot)


### Routes for mocked tests
- http://localhost:8008/snappy
- http://localhost:8008/snappy?special=1
- http://localhost:8008/browsershot
- http://localhost:8008/browsershot?special=1

