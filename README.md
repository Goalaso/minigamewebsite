# Minigames Website

## Project Overview
Pixel Playground is a mini games website that is a platform designed to offer a collection of engaging and fun minigames to users. Developed as part of the CS 410 Software Engineering course, this project aims to provide a seamless and enjoyable gaming experience through a well-integrated frontend, backend, and game engine.

## Features
- **Variety of Games**: Enjoy multiple minigames including puzzles, action, and strategy games.
- **User-Friendly Interface**: Easy navigation and intuitive design.
- **Scoring System**: Track your scores and compete with others.
- **User Accounts**: Create an account, login, and manage your profile.
- **Leaderboards**: See how you stack up against other players.

## Technology Stack
- **Frontend**: Built with HTML, CSS, and JavaScript.
- **Backend**: Powered by PHP with SQLite3 for database management.
- **Game Development**: Games are created and integrated using Godot Engine.

## Architecture
- **Frontend-Backend Interaction**:
  - The frontend communicates with the backend using calls to PHP scripts.
  - These PHP scripts handle requests such as user authentication, game data retrieval, and score submission.
  - Data is stored in and retrieved from an SQLite3 database by the PHP backend.
  - The backend sends JSON responses to the frontend, ensuring smooth and dynamic user interactions.

- **Data Flow**:
  - User actions (like logging in or submitting scores) are sent from the frontend to PHP scripts via HTTP requests.
  - The PHP scripts process these requests and interact with the SQLite3 database to fetch or store data.
  - The processed data is then returned to the frontend as JSON, which is used to update the UI dynamically.

## Team Members
- **@Goalaso**: Frontend Developer and Game Developer (Godot)
- **@selenasat**: Frontend Developer
- **@AndrewFales**: Game Developer (Godot)
- **@antr0n**: Database Administrator and Backend Developer

## Development Process
We followed Agile methodology with weekly sprints and stand-up meetings. Tools such as Trello for project management and GitHub for version control were crucial in our development process.
