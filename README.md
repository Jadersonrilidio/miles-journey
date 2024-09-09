# Miles Journey - API Repository

<p align="center"><a href="https://miles-journey-react-frontend.vercel.app/" target="_blank"><img src="https://raw.githubusercontent.com/Jadersonrilidio/miles-journey-react-frontend/master/src/assets/logos/logo-black-tagline.png" width="500" alt="Logo Dark" /></a></p>

<p align="center"><img src="https://img.shields.io/badge/license-MIT-blue" alt="License" /></p>


## Description

This is the GitHub repository of the Miles Journey API, developed during the 7th Challenge Backend edition proposed by Alura.

[Visit the finished project's website](https://miles-journey-react-frontend.vercel.app/)

You can check out the Miles Journey Frontend repository [by clicking here](https://github.com/Jadersonrilidio/miles-journey-react-frontend).


## About the Challenge

Miles Journey is the english version of "Jornada Milhas" project proposed on the 7th Challenge Backend edition by Alura.

In this Challenge, you will:
- Develop a REST API to be integrated into the Front-end;
- Build an API following weekly updates on the challenge's Trello sheet;
- Build the application's frontend from scratch based on a Figma project [available here](https://www.figma.com/design/1qD4hmpnvxoeHRC1cbWKgR/Challenge-Escola-de-Programa%C3%A7%C3%A3o?node-id=0-1&node-type=CANVAS&t=vmOALUYiTmTVyUxP-0);
- **EXTRA:** Implement Authentication and Authorization features;
- **EXTRA:** Integrate ChatGPT artificial intelligence API with the application.


## Tech Stack

- **Frontend:** React Typescrypt
- **Styling:** Raw CSS/SASS modules
- **State Mangement:** Recoil
- **HTTP Client:** Axios
- **Backend:** Laravel 10, PHP 8.2
- **Database:** PostgreSQL
- **Authentication:** Laravel Sanctum Access token
- **Version Control:** Git and GitHub
- **Backend Deployment:** Laravel Render
- **Frontend Deployment:** Vercel Vite


## Project Architecture

The project extends Laravel’s default structure with additional directories to improve modularity and code readability by isolating functionality. Below is a description of the added folders:

- `src/app/Builders`: Custom EloquentBuilder classes for abstracting common database queries.
- `src/app/Casts`: Custom Cast classes for data conversion within Eloquent Models.
- `src/app/Enums`: Enumerable values to standardize variables across the application.
- `src/app/Helpers`: Helper classes and traits for use in Controllers or Services.
- `src/app/ValueObjects`: ValueObject classes to manage value conversion and reduce handling errors.
- `src/app/Http/Responses`: Centralized response classes for managing application-wide changes.
- `src/app/Http/Controllers/Api`: API controller classes.
- `src/app/Http/Controllers/Api/Auth`: Authentication controller classes.

For Docker-based Laravel Render deployments, additional directories include:

- `src/conf/`: NGNIX configuration files for deployment.
- `src/scripts/`: Post-build scripts (_e.g._, Composer and Artisan commands).



## Features

The backend counts with several features built with the aid of laravel packages, composer libraries and services built into the app source code, as follows:

- Use of ChatGPT API as a service to fill out empty destination's description field, done via scheduled tasks running on the background
- Implementation of authentication and authorization features with Laravel Sanctum package via Acess Tokens
- Implementation of an API Response factory, to standardize and facilitate the application's APi responses by the controller methods
- Creation of Database seeders to populate the portfolio project database with mock destinations and reviews.
- CORS middleware implementation to override the faulty CORS feature provided by Laravel 10, thus resolving the issue of frontend CORS policy blocking
- Implementation of Eloquent Builder classes to encapsulate and facilitate models handling by the controller methods.
- Implementation of database Cast classes to ease data handling throughout the application
- Implementation of ValueObject classes to encapsulate complex data handling and threatment, facilitating developer's understanding and its usage
- Creation of jobs, and App console's scheduled tasks to automate couple application's actions, as Artificial Inteligence(AI) services calls and so on
- Implementation and use of Enum classes to standardize and facilitate understanding by the team of developers, for specific data where fits suitable
- Implementation of Helper traits to add more functionality to Api controller classes, when applicable
- Use of Model's traits for instantiate every model to be saved on database with UUID
- Use Request classes to modularize and validate user input data and avoid security issues or errors to be inserted into the database

As the challenge was mainly focused on backend, some application's features and development choices should be explained here to better understand the developer decision-making and technical skills applied to project's conclusion.

- Both authentication and authorization features were built using Laravel Sanctum, which provides simplicity and more reliability for those key features compared to other JWT auth libraries available for Laravel at the moment. Due to the simplicity of the project and its SPA architecture, the Laravel Sanctum suits better for its further development, as well as SPA authentication, if needed.


## License

This project is licensed under the MIT License - see the [MIT License](./LICENSE) file for details.


## Contact information

- **Name:** Jaderson Rodrigues Ilidio
- **Email:** jaderson.rodrigues@yahoo.com
- **LinkedIn:** [linkedin.com/in/jaderson-rodrigues-ilidio](https://www.linkedin.com/in/jaderson-rodrigues-ilidio/)




Here's a revised version of your documentation, with a more standardized and concise writing style:
