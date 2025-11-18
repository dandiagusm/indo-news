
# IndoNews
![Indonews](app/public/images/indonews.jpg)

## How to Run 
## Install Dependencies

```
composer install
```

---

## Setup Environment File

Copy the example `.env`:

```
cp .env.example .env
```

Generate application key:

```
php artisan key:generate
```

---

## Configure Database

Edit `.env`:

```
DB_DATABASE=indo_news
DB_USERNAME=root
DB_PASSWORD=
```

Run migration:

```
php artisan migrate
```

---

## Add News API Key

Inside `.env`:

```
WORLDNEWS_API_KEY=your_api_key_here
```

---

## Run 

```
php artisan serve
```

App will run at:

```
http://localhost:8000
```
