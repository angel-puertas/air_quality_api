# Air Quality API Documentation

## Base URL
All endpoints are accessed through the base URL:
```
http://localhost/air_quality_api/?page=[endpoint]
```

## Authentication Endpoints

### Register User
```http
POST /air_quality_api/?page=Register&username=[username]&password=[password]&confirm_password=[confirm_password]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `username` | string | Yes | Username |
| `password` | string | Yes | Password |
| `confirm_password` | string | Yes | Confirm Password |

#### Response Format
```json
{
    "success": boolean,
    "message": string
}
```

### Login
```http
POST /air_quality_api/?page=Login&username=[username]&password=[password]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `username` | string | Yes | Username |
| `password` | string | Yes | Password |

#### Response Format
```json
{
    "success": boolean,
    "message": string
}
```

### Logout
```http
POST /air_quality_api/?page=Logout
```

#### Response Format
```json
{
    "success": boolean,
    "message": string
}
```

## Station Endpoints

### List Stations
```http
GET /?page=StationList
```

#### Response Format
```json
[
    {
        "id": integer,
        "name": string,
    }
]
```

### View Station
```http
GET /?page=StationView&id=[id]
```

#### Response Format
```json
{
    "id": integer,
    "name": string,
}
```

### Create Station
```http
GET /?page=StationCreate&name=[name]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `name` | string | Yes | Station name |

#### Response Format
```json
{
    "success": boolean,
    "message": string,
    "station":
    {
        "id": integer,
        "name": string,
    }
}
```

### Update Station
```http
GET /?page=StationUpdate&id=[id]&name=[name]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | Station ID |
| `name` | string | Yes | Station name |

#### Response Format
```json
{
    "success": boolean,
    "message": string,
    "station":
    {
        "id": integer,
        "name": string,
    }
}
```

### Delete Station
```http
GET /?page=StationDelete&id=[id]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | Station ID |

#### Response Format
```json
{
    "success": boolean,
    "message": string,
    "station":
    {
        "id": integer,
        "name": string,
    }
}
```

## Pollutant Endpoints

### List Pollutants
```http
GET /?page=PollutantList
```

#### Response Format
```json
[
    {
        "id": integer,
        "name": string,
    }
]
```

### View Pollutant
```http
GET /?page=PollutantView&id=[id]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | Pollutant ID |

#### Response Format
```json
{
    "id": integer,
    "name": string,
}
```

### Create Pollutant
```http
GET /?page=PollutantCreate&name=[name]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `name` | string | Yes | Pollutant name |

#### Response Format
```json
{
    "success": boolean,
    "message": string,
    "pollutant":
    {
        "id": integer,
        "name": string,
    }
}
```

### Update Pollutant
```http
GET /?page=PollutantUpdate&id=[id]&name=[name]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | Pollutant ID |
| `name` | string | Yes | Pollutant name |

#### Response Format
```json
{
    "success": boolean,
    "message": string,
    "pollutant":
    {
        "id": integer,
        "name": string,
    }
}
```

### Delete Pollutant
```http
GET /?page=PollutantDelete&id=[id]
```

#### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | Pollutant ID |

#### Response Format
```json
{
    "success": boolean,
    "message": string,
    "pollutant":
    {
        "id": integer,
        "name": string,
    }
}
```


## Measurement Endpoints
```http
GET /?page=MeasurementList
```

```http
GET /?page=MeasurementList&station_id={id}&pollutant_id={id}
```

```http
GET /?page=MeasurementList&station_id={id}
```

```http
GET /?page=MeasurementList&pollutant_id={id}
```

```http
GET /?page=MeasurementList&id={id}
```

```http
GET /?page=MeasurementList&fake=true
```

#### Response Format
```json
[
    {
        "id": integer,
        "station_id": integer,
        "pollutant_id": integer,
        "value": float,
        "unit": string,
        "time": string
    }
]
```