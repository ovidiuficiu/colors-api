# colors-api
Vanilla JS Frontend and Vanilla PHP Backend for a demo API

# Description
Implement a vanilla PHP backend (7.4) which implements a simple API to manage CRUD operations for hexadecimal colors. 
A small frontend application has been built to demonstrate the capabilities of the API. API includes a routing system built up from the ground, a SQLite3 database and entity repository for persisting data to the database.

# Get Started
The application can be simply started using the php local server i.e. php -S localhost:8000

# Code description
The codebase is split into two main directories api and frontend. The names are self explanatory. If you'd like to use a dedicated server nginx, apache etc, just point it to the index.php file from api directory and it will take care of the rest. 
The frontend directory hosts a index.html and index.js file. Cors headers have been added to the PHP application so that it will allow localhost requests.

# Requirements
* PHP 7.4
* Any browser

# Issues or questions
For any problems or questions open an issue ticket on this repo and I'll respond as soon as possible.
