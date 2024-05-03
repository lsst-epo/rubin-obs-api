# Rubin Observatory Operational Website Backend/API

[![Deployed to Production](https://github.com/lsst-epo/rubin-obs-api/actions/workflows/master-tags.yaml/badge.svg)](https://github.com/lsst-epo/rubin-obs-api/actions/workflows/master-tags.yaml)

[![Deployed to Integration](https://github.com/lsst-epo/rubin-obs-api/actions/workflows/master-push-gae.yaml/badge.svg)](https://github.com/lsst-epo/rubin-obs-api/actions/workflows/master-push-gae.yaml)

[![Deployed to Development](https://github.com/lsst-epo/rubin-obs-api/actions/workflows/develop-push-gae.yaml/badge.svg)](https://github.com/lsst-epo/rubin-obs-api/actions/workflows/develop-push-gae.yaml)


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

#### Make scripts

---
To list the local databases for this project, first bring up the postgres container if it's not already up:

`docker-compose -f docker-compose-local-db.yml up --build postgres`

Then, list your local databases:

`make db-list`

---
To list the databases sitting around in the `prod` environment so that you can know which `dbname` to supply in `make cloud-db-export dbname=(which db you want to export)`:

`make cloud-db-list`

---
To export a `prod` database to the `gs://release_db_sql_files/rubinobs/` bucket:

`make cloud-db-export dbname=prod_db`

* The argument `dbname` is required and should be one of the databases listed from `make cloud-db-list`
* You will need to go into the `prod` GCP project in the Google Cloud Storage resource to find the DB dump file
* Once you download the DB dump file, move it to the `./db/` folder
---
To list the local databases for this project, first bring up the postgres container if it's not already up:

`docker-compose -f docker-compose-local-db.yml up --build postgres`

Ensure that the dump file is located within `./db/`, then run:

`make local-db dbname=my_new_local_db dbfile=prod.sql`

* The argument `dbname` is required and will be the name of the newly created database
* The argument `dbfile` is required and should be the name of the DB file to recreate, this file _must_ be in the `./db/` folder
--- 

<br>
<br>
<br>
<br>
<br>

#### Deprecated workflow

0. Uncomment the `COPY` line in `./db/Dockerfile`
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



