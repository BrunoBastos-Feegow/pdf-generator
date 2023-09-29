# pdf-generator
Just a MVP for a PDF generator :-)

### Dependencies
- Docker 
- Docker Compose

### How to run
- Clone this repository
- Set the environment variables in the .env file
- Run the command `docker-compose up -d`
- Access the url `http://localhost:8008` (apache container) or `http://localhost:8008` (nginx container) in your browser

### Installed libraries so far
- [barryvdh/laravel-snappy](https://github.com/barryvdh/laravel-snappy) docker-only (or you can install the wkhtmltpdf in your machine) 
- [spatie/browsershot](https://github.com/spatie/browsershot)
- [phpoffice/phpword](https://github.com/PHPOffice/PHPWord)


### Routes for mocked tests
- http://localhost:8008/snappy
- http://localhost:8008/snappy?special=1
- http://localhost:8008/browsershot
- http://localhost:8008/browsershot?special=1
- http://localhost:8008/phpword

