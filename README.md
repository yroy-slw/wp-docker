# WP-Docker Project

## Overview
This project is a WordPress development environment powered by Docker. It enables quick setup, easy configuration, and seamless collaboration across development teams by containerizing WordPress and its dependencies.

## Features
- Fully containerized WordPress setup
- Includes MySQL for database management
- phpMyAdmin for database administration
- Supports custom themes and plugins
- Configurable via environment variables
- esbuild for SASS compilation & sourcemaps
- TSX for Javascript

## Prerequisites
Ensure you have the following installed:
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Installation
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd wp-docker
   ```

2. Create a `.env` file to configure environment variables:
   ```bash
   cp .env.example .env
   ```

3. Update the `.env` file with your desired settings (e.g., database credentials, WordPress version).

4. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

5. Access the WordPress site in your browser at `http://localhost`.

## Build

1. Start
```bash
npm run watch
```

## Services
- **WordPress**: Accessible at `http://localhost`
- **phpMyAdmin**: Accessible at `http://localhost:8080` (default credentials defined in `.env`)

## Directory Structure
```
wp-docker/
├── docker-compose.yml      # Docker Compose configuration
├── .env                    # Environment variables
├── theme/              # WordPress custom theme
├── build.ts/              # Esbuild config
├── logs/                   # Log files for debugging
└── README.md               # Project documentation
```

## Environment Variables
Customize your setup by editing the `.env` file. Below are the key variables:

| Variable           | Default Value   | Description                        |
|--------------------|-----------------|------------------------------------|
| `DB_HOST`| `db`            | Database host                     |
| `DB_NAME`| `wordpress`     | Database name                     |
| `DB_USER`| `root`          | Database username                 |
| `DB_PASSWORD`| `password` | Database password                 |
| `DB_HOST`  | `8080`          | Port for phpMyAdmin               |

## Customization
1. **Themes and Plugins**:
   Place custom themes in `wordpress/wp-content/themes` and plugins in `wordpress/wp-content/plugins`.

2. **Database**:
   Access phpMyAdmin at `http://localhost:8080` to manage the database.

## Commands
- Start containers: `docker-compose up -d`
- Stop containers: `docker-compose down`
- View logs: `docker-compose logs`
- Rebuild containers: `docker-compose up --build`

## Troubleshooting
- Check Docker logs for issues:
  ```bash
  docker-compose logs
  ```
- Ensure no conflicting services are running on ports `80` or `8080`.
