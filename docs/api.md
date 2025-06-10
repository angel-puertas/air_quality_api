# Air Quality API Documentation

## Overview
This API provides access to air quality monitoring data and management endpoints for stations, pollutants, and measurements.

## Base URL
All endpoints are accessed through the base URL:
```
http://localhost/air_quality_api/?page=[endpoint]
```

## Authentication

### Register User
```http
POST /air_quality_api/?page=Register
```

### Login
```http
POST /air_quality_api/?page=Login
```

### Logout
```http
POST /air_quality_api/?page=Logout
```

## Station Management

### Create Station
```http
POST /air_quality_api/?page=StationCreate
```

### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `name` | string | Yes | Name of the station |

### Update Station
```http
PUT /?page=StationUpdate&id=1
```

### Delete Station
```http
GET /?page=StationDelete&id=1
```

### View Station
```http
GET /?page=StationView&id=1
```

### Response Format
```json
{
    "station": {
        "id": 1,
        "name": "Station Name",
    }
}
```

## Pollutant Management

### Create Pollutant
```http
POST /?page=PollutantCreate
```

### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `name` | string | Yes | Name of the pollutant |

### Update Pollutant
```http
PUT /?page=PollutantUpdate&id=1
```

### Delete Pollutant
```http
GET /?page=PollutantDelete&id=1
```

### View Pollutant
```http
GET /?page=PollutantView&id=1
```

### List Pollutants
```http
GET /?page=PollutantList
```

### Response Format
```json
{
    "pollutant": {
        "id": 1,
        "name": "Pollutant Name",
    }
}
```

## Measurement Endpoints

### List Measurements
```http
GET /?page=MeasurementList
```

### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `station_id` | integer | No | Filter by station ID |
| `pollutant_id` | integer | No | Filter by pollutant ID |
| `id` | integer | No | Get specific measurement |

### List Measurements (JSON)
```http
GET /?page=MeasurementListJSON
```

### Response Format
```json
{
    "measurements": [
        {
            "id": 2,
            "station_id": 307,
            "pollutant_id": 1,
            "value": "2.3",
            "unit": "µg/m3",
            "time": "1716681600000"
        }
    ]
}
```