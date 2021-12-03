# Rubin Observatory Operational Website Backend/API

Headless Craft CMS backend for the Rubin Observatory operational website with Docker support.

This project was created with Docker version 20.10.5.

## Set up and run the project

### To connect to the dev Cloud SQL DB Instance

0. Install [Docker](https://docs.docker.com/get-docker/) and the [Google Cloud SDK](https://cloud.google.com/sdk/docs/install)
1. Clone this repository
2. Bring the Docker compose file up:

```
docker-compose up
```

4. Go to <http://localhost:8080/admin> to administer the site

### To use a local db

1. Install [Docker](https://docs.docker.com/get-docker/)
2. Clone this repository
3. Bring the Docker compose file up:

```
docker-compose -f docker-compose-local-db.yml up
```

4. Go to <http://localhost:8080/admin> to administer the site

##### Local Database notes

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
