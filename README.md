## Travel Application

This is a simple information web app for tourists. This page aims to provide travel information of Japan for foreign tourists visiting Japan for the first time. The traveller has the possibility of going to the following cities; Tokyo, Yokohama, Kyoto, Osaka, Sapporo and Nagoya.

## Requirements

- Use OpenWeatherMap's Daily API for to get weather forecast.
- Use FourSquare Search Venue API for to get Place information.
- Responsive Design

## Design Reasoning
I chose a very simple design because it is easier to make everything compatible to all screens on most devices. Simple design also means that it looks clean and elegant. Also, older people won't have trouble navigating through the App since the design is so simple.

## Setup Requirements

- PHP 7.4.3
- Node 12.22.10

## Main Frameworks Used

- VueJS 2
- Laravel 8

## Design Framework Used

- Vuetify

## APIs Used

- FourSquare Places API (Need to signup and get API key)
- OpenWeatherMap API (Need to signup and get API key)

## Setup

Copy the `.env.example` file contents into `.env`.
Inside the .env file, there should be keys that are named `FOURSQUARE_API_KEY` and `OPEN_WEATHER_MAP_API_KEY`.
Put your API keys there.

1. Clone this repository
2. `cd travel-app`
3. `composer install`
4. `npm install`
5. `npm run prod`
6. `php artisan serve`
7. Done.

## Features

- Temperature
- Current Weather
- View on Map
- Place image (from FourSquare)
- View Place Reviews

## Screenshots

![Travel App](https://i.imgur.com/Bc3n8zy.png)

![Travel App](https://i.imgur.com/3KAMl3k.png)


