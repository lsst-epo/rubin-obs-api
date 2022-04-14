# Rubin Observatory Operational Website Backend/API

Headless Craft CMS backend for the Rubin Observatory operational website with Docker support.

This project was created with Docker version 20.10.5.

## Set up and run the project

### To connect to the dev Cloud SQL DB Instance

1. Install [Docker](https://docs.docker.com/get-docker/) and the [Google Cloud SDK](https://cloud.google.com/sdk/docs/install)
2. Clone this repository
3. Set the database password in the `DB_PASSWORD` environment variable locally, and set the site's security key to the `SECURITY_KEY` env var.
4. Bring the Docker compose file up:

    ```shell
    docker-compose up
    ```

5. Go to <http://localhost:8080/admin> to administer the site

### To connect to the integration Cloud SQL DB Instance

1. Install [Docker](https://docs.docker.com/get-docker/) and the [Google Cloud SDK](https://cloud.google.com/sdk/docs/install)
2. Clone this repository
3. Set the database password in the `DB_PASSWORD` environment variable locally, and set the site's security key to the `SECURITY_KEY` env var.
4. Bring the Docker compose file up:

    ```shell
    docker-compose -f docker-compose.yml -f integration.yml up
    ```

5. Go to <http://localhost:8080/admin> to administer the site

### To use a local db

1. Install [Docker](https://docs.docker.com/get-docker/)
2. Clone this repository
3. Add a .env file (based on .env.sample) and provide values appropriate to your local dev environment
4. If running for the first time, and no local database exists, ask a fellow dev for the Google Cloud Storage location of the `.sql` dump file - download it and put it in the `/db` folder
5. You'll need to install php packages locally. You may do so with your local composer, but you can also run it all through docker: `docker run -v ${PWD}/api:/app composer install`
6. Build and bring up containers for the first time:

```shell
docker-compose -f docker-compose-local-db.yml up --build
```

7. Subsequent bringing up of containers you've already built:
```shell
docker-compose -f docker-compose-local-db.yml up
```
8. Go to <http://localhost:8080/admin> to administer the site

#### Useful docker commands for local development

1. Cleaning house: `docker volume prune` `docker system prune`
2. Spin stuff down politely: `docker-compose -f docker-compose-local-db.yml down`
3. Peek inside your running docker containers:
  * `docker container ls`
  * `docker exec -it <CONTAINER-ID> /bin/sh`
  * and then, for instance, to look at DB `psql -d craft -U craft`
4. To rebuild images and bring up the containers: `docker-compose -f docker-compose-local-db.yml up --build`
5. When you need to do composer stuff: `docker run -v ${PWD}/api:/app composer <blah>`
6. After ssh-ing into a live GAE instance, by way of the GCP console interface, you can ssh into a running container: `docker exec -ti gaeapp sh`
7. When working locally, in order to ensure the latest docker `craft-base-image` is used: `docker pull us-central1-docker.pkg.dev/skyviewer/public-images/craft-base-image`

#### Local Database notes

If you completed the above steps you may have noticed some SQL commands in the log output.

This is because by default the DB snapshot bundled with this repo in /db will execute upon bringing up the docker-compose file.

The commands for executing this file can be found in /scripts/database.sh

If you **do not** want to drop/restore the DB each time you bring up the containers, simply comment out the lines indicated in the Dockerfile.

Note that you will log into <http://localhost:9000/admin> with the same credentials you would have logged into the Rubin site previously as it is hosted on Digital Ocean.

You *may* need to change the root postgres credentials in the docker-compose.yml file at: services.postgres.environment

## Assets

The /api/assets folder has been added to the .gitignore file for obvious file-size related reasons. If you would like you can FTP the assets down from the Digital Ocean hosted site via Cyberduck or your FTP client of preference.

## docker-compose explained

A docker-compose.yml file is simply a way to define multiple images/containers that may be dependent on each other, and any environment variables that each image is expecting. When these defined containers and dependencies are brought up with the ```docker-compose up``` command each container is started as the dependencies dictate.
h the ```docker-compose up``` command each container is started as the dependencies dictate.
