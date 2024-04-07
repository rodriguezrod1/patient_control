# API Medical Patients

REST API for hospital patient management, which will allow hospital doctors to search for a patient, create new patients and add diagnoses to patients.


## Used technology

    - Laravel 10.48.3
    - PostgreSQL 14
    - darkaonline/l5-swagger
    - Docker


## Services

### API

The API service is built using Laravel 10.48.3. It is responsible for handling requests and responses for the application. It uses the `api-backend-patients-v001` image and is named `api`. It mounts the `./api/` directory to `/var/www` in the container and exposes port `3005`. It depends on the `db` service and is part of the `patients_network` network.

### Database

The Database service uses PostgreSQL 14. It is responsible for storing and retrieving data for the application. It uses the `postgres:14` image and is named `db-patients`. It is configured to use a PostgreSQL database named `patients` with a user named `postgres` and a password of `personal`. It mounts the `./.docker/postgresql/db-data` directory to `/var/lib/postgresql/data` in the container and is part of the `patients_network` network.



## Documentation Swagger

`http://localhost:3005/api/documentation`



## Networks

The `patients_network` network is used by all services.


## Volumes

The `db-data` volume is used to persist the PostgreSQL database data.



## How to use this Docker Compose file

1. Make sure Docker and Docker Compose are installed on your system.
2. Copy this Docker Compose file to your project directory. 
    - `docker compose up -d --build`
    -  Enter the app container: `docker exec -it api-patients-control bash`
    - `cd ..`
    - `composer install`
    - `php artisan key:generate`
    - `php artisan migrate --seed`
3. Run `docker-compose up -d`. This will start all services in detached mode (in the background).



## How to update this Docker Compose file

1. Make changes to the Docker Compose file.
2. Run `docker-compose up --build` to rebuild the services and apply the changes.



## Where to get help

If you encounter any issues or need help, please open an issue in this repository or contact me [rodriguezrod1@gmail.com].
