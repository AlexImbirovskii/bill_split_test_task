# Bill Split Test Task

- [Installation](#installation)

## Installation


Make autoload files:
```bash
    composer dump-autoload
```

Copy environment variables ( don't forget to change DB config ):
```bash
    cp .env.example .env
```

Run migrations
```bash
    php database/migrations.php 
```

Run local server
```bash
    php -S localhost:8000 -t public
```

Visit application on localhost:8000
