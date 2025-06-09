# Places API

A RESTful API built with Laravel and PostgreSQL in Docker for managing places, featuring complete CRUD operations, name filtering, automatic slug generation, and comprehensive test coverage.

## Requirements

- Docker
- Docker Compose

## Setup and Installation

1. Clone this repository
2. Start the Docker containers:

```bash
docker-compose up -d
```

3. Install dependencies:

```bash
docker-compose exec app composer install
```

4. Generate application key:

```bash
docker-compose exec app php artisan key:generate
```

5. Run database migrations:

```bash
docker-compose exec app php artisan migrate --force
```

6. (Optional) Create sample data:

```bash
docker-compose exec app php artisan tinker create_places.php
```

The API will be available at `http://localhost:8000/api/places`

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/places` | List all places |
| GET | `/api/places?name=search` | Filter places by name |
| POST | `/api/places` | Create a new place |
| GET | `/api/places/{id}` | Get a specific place |
| PUT/PATCH | `/api/places/{id}` | Update a place |
| DELETE | `/api/places/{id}` | Delete a place |

## Data Structure

```json
{
  "id": 1,
  "name": "Place Name",
  "slug": "place-name", // Auto-generated from name if not provided
  "city": "City Name",
  "state": "State Name",
  "created_at": "2023-01-01T00:00:00.000000Z",
  "updated_at": "2023-01-01T00:00:00.000000Z"
}
```

## Running Tests

```bash
docker-compose exec app php artisan test
```

## API Usage Examples

### List All Places

```bash
curl -X GET http://localhost:8000/api/places
```

### Filter Places by Name

```bash
curl -X GET http://localhost:8000/api/places?name=Beach
```

### Create a New Place

```bash
curl -X POST http://localhost:8000/api/places \
  -H "Content-Type: application/json" \
  -d '{"name":"Copacabana Beach","city":"Rio de Janeiro","state":"RJ"}'
```

### Get a Specific Place

```bash
curl -X GET http://localhost:8000/api/places/1
```

### Update a Place

```bash
curl -X PUT http://localhost:8000/api/places/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"Updated Copacabana Beach","city":"Rio de Janeiro","state":"RJ"}'
```

### Delete a Place

```bash
curl -X DELETE http://localhost:8000/api/places/1
```