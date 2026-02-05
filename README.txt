Web Technology Portfolio website

Outline of:
    - Local deployment and testing instructions
    - File structure outline, stated assumptions

Local Deployment and testing instructions:
    - Copy the '23001655' folder into your web server root (e.g. htdocs)
    - Start Apache Server
    - Open: http://localhost/project/index.php in your browser 

Admin Login:
    - Username: admin
    - Password: admin

There are other username and passwords that are stored in data/users.csv. 


Folder structure:

- css
    - style.css (website's mains theme/style)
- data
    - users.csv
    - weather.json
- images
  - (all images used in project)
- includes (shared PHP files)
    - header.php
    - session.php
- js 
    - addweather.js
    - dailyweatherdata.js
    - main.js
    - weather.js
    - weatherforecast.js
- add.php (server-side script)
- addweather.php 
- cv.php
- index.php (home page)
- login.php
- logout.php
- README.txt
- submit.php (admin only, processes weather record additions)
- weather.php

Libraries:
- Chart.js and jQuery are currently loaded via CDN

Technical Report:
- TechnicalReport.pdf

Stated Assumption:
- The project runs on a local Apache PHP server = XAMPP
- No database is used and all data is stored in CSV and JSON files
- The project is accessed through localhost