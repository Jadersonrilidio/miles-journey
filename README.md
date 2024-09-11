# Miles Journey - API Repository

<p align="center"><a href="https://miles-journey-react-frontend.vercel.app/" target="_blank"><img src="https://raw.githubusercontent.com/Jadersonrilidio/miles-journey-react-frontend/master/src/assets/logos/logo-black-tagline.png" width="500" alt="Logo Dark" /></a></p>

<p align="center"><img src="https://img.shields.io/badge/license-MIT-blue" alt="License" /></p>


## Description

This is the GitHub repository of Miles Journey API, developed during the 7th Challenge Backend edition proposed by Alura.

[Visit the finished project's website](https://miles-journey-react-frontend.vercel.app/)

You can check out the Miles Journey Frontend repository [by clicking here](https://github.com/Jadersonrilidio/miles-journey-react-frontend).


## About the Challenge

Miles Journey is the english version of "Jornada Milhas" project proposed on the 7th Challenge Backend edition by Alura.

In this Challenge, you will:
- Develop a REST API to be integrated into the frontend.
- Build an API following weekly updates on the challenge's Trello sheet.
- Build the application's frontend from scratch based on a Figma project [available here](https://www.figma.com/design/1qD4hmpnvxoeHRC1cbWKgR/Challenge-Escola-de-Programa%C3%A7%C3%A3o?node-id=0-1&node-type=CANVAS&t=vmOALUYiTmTVyUxP-0).
- **EXTRA:** Implement Authentication and Authorization features.
- **EXTRA:** Integrate artificial intelligence OpenAI with the application.
- **EXTRA:** Automation of tasks by running on server background.


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

This project extends Laravel’s default structure with additional directories to improve modularity and code readability by isolating functionality. Below is a description of the added folders:

- `src/app/Builders`: Custom EloquentBuilder classes for abstracting common database queries.
- `src/app/Casts`: Custom Cast classes for data conversion within Eloquent Models and database.
- `src/app/Enums`: Enumerable values to standardize variables across the application.
- `src/app/Helpers`: Helper classes and traits for use in Controllers or Services.
- `src/app/ValueObjects`: ValueObject classes to manage value conversion and reduce handling errors.
- `src/app/Http/Responses`: Centralized response classes for standardized responses throughout the application.
- `src/app/Http/Controllers/Api`: API controller classes.
- `src/app/Http/Controllers/Api/Auth`: Authentication controller classes.

For Docker-based Laravel Render deployments, additional directories include:

- `src/conf/`: NGNIX configuration files for deployment.
- `src/scripts/`: Post-build scripts (_e.g._, Composer and Artisan commands).


## Features

Here follows an overview of some key features implemented throughout the application:

- Integration with OpenAI API, available as a service [(see OpenAIService class)](./app/Services/OpenAIService.php).
- Background tasks management with Laravel's task scheduling [(see)](./app/Console/Kernel.php).
- Authentication and authorization features implemented with laravel Sanctum.
- Helper traits and classes to abstract functionalities from Controllers [(see)](./app/Helpers/).
- Auto-generated UUIDs for Models on creation [(see implementation here)](./app/Models/Traits/CreateWithUuid.php).
- Request classes for abstracting input validation [(see)](./app/Http/Requests/).
- API missing resources handling on routes registration files [(see api routes file)](./routes/api.php).
- Higher order Response classes for abstracting API responses from the Controllers [(see ApiResponse class)](./app/Http/Responses/ApiResponse.php).
- CORS Middleware implementation to control unregistered addresses access to API.
- Custom EloquentBuilder classes for abstracting common database queries [(example)](./app/Builders/DestinationBuilder.php).
- Cast classes for data conversion within Eloquent Models and database [(example)](./app/Casts/PriceCast.php).
- ValueObject classes to manage value conversion and reduce handling errors [(example)](./app/ValueObjects/Price.php).

## License

This project is licensed under the MIT License - see the [MIT License](./LICENSE) file for details.


## Contact information

- **Name:** Jaderson Rodrigues Ilidio
- **Email:** jaderson.rodrigues@yahoo.com
- **LinkedIn:** [linkedin.com/in/jaderson-rodrigues-ilidio](https://www.linkedin.com/in/jaderson-rodrigues-ilidio/)
