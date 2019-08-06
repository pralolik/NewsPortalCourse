News Portal
=========

A Symfony project.

To start project use:
 * To build: 
    * docker build -t newsportal apache/
    * docker build -t newsportal-prod  -f apache/Dockerfile.production .
- To start. Also you can use "-d" option to run containers in the background.:
    * docker-compose up (in DEV-mode)
    * docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d (in PROD-mode)