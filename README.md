# Rubin Observatory Operational Website

Headless Craft CMS backend for the Rubin Observatory operational website with Docker support.

## Set up and run the project

0. Install Docker
1. Clone this repository
2. Build the custom Docker image:

```
docker build -t epo/rubin_api .
```

3. Bring the Docker compose file up:

```
docker-compose up
```

4. Go to http://localhost:9000/admin to administer the site

## Database notes

If you completed the above steps you may have noticed some SQL commands in the log output.

This is because by default the DB snapshot bundled with this repo in /db will execute upon bringing up the docker-compose file.

The commands for executing this file can be found in /scripts/database.sh

If you **do not** want to drop/restore the DB each time you bring up the containers, simply comment out the lines indicated in the Dockerfile.

Note that you will log into http://localhost:9000/admin with the same credentials you would have logged into the Rubin site previously as it is hosted on Digital Ocean.

You *may* need to change the root postgres credentials in the docker-compose.yml file at: services.postgres.environment

## Nginx port mapping and config

If for whatever reason you need to change which port is exposed for Craft CMS, this can be changed in the docker-compose.yml under: services.nginx.ports

The default.conf can be found in /config, this is copied over to the container so changes made here will be reflected the next time you bring up the containers.

## Assets

The /api/assets folder has been added to the .gitignore file for obvious file-size related reasons. If you would like you can FTP the assets down from the Digital Ocean hosted site via Cyberduck or your FTP client of preference.

## docker-compose explained

A docker-compose.yml file is simply a way to define multiple images/containers that may be dependent on each other, and any environment variables that each image is expecting. When these defined containers and dependencies are brought up with the ```docker-compose up``` command each container is started as the dependencies dictate.

It is likely that this file will be replaced with a Kubernetes kompose file at some point, but that work is forthcoming.

