# News
## Installation
Create .env.local file with:
```
APP_ENV=dev
MYSQL_ROOT_PASSWORD=mysecretpassword
DATABASE_URL="mysql://root:${MYSQL_ROOT_PASSWORD}@mysql8:3306/news?serverVersion=8.0"
```

```bash
# Docker
docker-compose up -d
docker-compose exec php bash
# Packages
composer install
yarn install
yarn encore dev
# Database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console app:import-news
```

Add `news.me` in /etc/hosts.

## Détails API
UI : http://news.me/api

GET /api/news
```json
[
  {
    "id": 0,
    "title": "string",
    "description": "string",
    "image": "string",
    "publishedAt": "2022-01-25T14:36:10.044Z"
  }
]
```

GET /api/news/{id}
```json
{
  "id": 0,
  "title": "string",
  "description": "string",
  "image": "string",
  "publishedAt": "2022-01-25T14:37:25.186Z"
}
```

## Importer
Le but de l'importer avec une config c'est de pouvoir rajouter facilement d'autres flux RSS.
Avec la factory ça permet d'aller un cran plus loin en facilitant l'import d'autres type de flux.

Configuration config/app/news.yaml
```yaml
  app.feeds:
    feedname:
      type: feedtype (rss)
      options:
        url: https://feeddomain.com
        path: feedpath.xml
```

Pour lancer l'import:
`php bin/console app:import-news [--feed=name]`

## Amélioration possible
- Il y a sans doute mieux à faire niveau Vuejs.
- Il manque un élément entre RSSImporter et NewsImporter pour la transformation des data, peut être un normalizer à utiliser avec le serializer.