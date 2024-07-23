# Yii2 Logging Module

## Features

- Send log messages to email
- Write log messages to a file
- Insert log messages into a database
- Easily extendable for additional logging types

## Requirements

- Docker
- Docker Compose
- PHP 8.2+
- Composer

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-repository/yii2-logging.git
cd yii2-logging
```

Install dependencies

```bash
composer install
```

Set up Docker

```bash
docker-compose up -d
```

Run the migration:

```bash
php yii migrate
```

### 2. Usage

Log to default logger:

```bash
http://localhost:8080/index.php?r=logger/log&message={message}
```

Log to a specific logger (email, file, database):

```bash
http://localhost:8080/index.php?r=logger/log-to&type={loggerType}&message={message}
```

Replace {loggerType} with email, file, or database.

Log to all loggers:

```bash
http://localhost:8080/index.php?r=logger/log-to-all&message={message}
```

`{message}` - is not an optional parameter to which you can pass text for logging.
