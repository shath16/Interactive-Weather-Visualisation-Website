# Interactive Weather Visualisation Website

## Overview

This project is a full-stack web application focused on **interactive weather data visualisation**. The website allows users to explore weather datasets through dynamic charts, customise visual display options, and interact with data in a responsive and accessible interface.

The application combines front-end and back-end technologies to deliver real-time chart rendering, user authentication, and structured data management using modern web development practices.

---

## Technologies Used

- HTML5
- CSS3
- JavaScript
- PHP (server-side functionality)
- Chart.js (interactive data visualisation)
- JSON (weather data storage)
- CSV (user authentication storage)

---

## Key Features

- Interactive weather data visualisation using Chart.js
- Dynamic dataset switching (e.g. temperature, humidity)
- Customisable chart styling (colour, font, chart type, sizing)
- Responsive multi-page web interface
- PHP session-based authentication system
- Accessible design aligned with WCAG guidelines

---

## Weather Visualisation

The core functionality of this project centres around an interactive weather dashboard that enables users to explore data visually. Weather data stored in JSON format is dynamically rendered into charts using JavaScript and Chart.js.

Users can:

- Change datasets and chart types
- Adjust visual styling for readability
- Modify chart dimensions and presentation
- Interact with visualisations without reloading the page

---

## Accessibility

The project follows WCAG accessibility principles, including:

- High colour contrast for readability
- Responsive layout for different screen sizes
- Alt text for images
- Structured content for improved usability

---

## Project Structure

```
├── index.php
├── weather.php
├── cv.php
├── login.php
├── logout.php
├── add.php
├── addweather.php
├── submit.php
├── update_forecast.php
│
├── css/
│   └── style.css
│
├── js/
│   ├── main.js
│   ├── weather.js
│   ├── weatherforecast.js
│   ├── addweather.js
│   └── dailyweatherdata.js
│
├── includes/
│   ├── header.php
│   └── session.php
│
├── data/
│   ├── weather.json
│   └── users.csv
│
├── images/
│   └── (all image files)
│
├── report/
│   └── technical_report.pdf
│
├── README.md

```

---

## Purpose

This project was created as part of a Web Technologies module to demonstrate interactive data visualisation alongside full-stack web development skills.

---

## Usage

This repository is provided for educational and portfolio purposes only.
Reuse, redistribution, or modification without permission is not allowed.
