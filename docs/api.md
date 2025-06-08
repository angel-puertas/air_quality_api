# API Documentation

## Endpoint: `/api`

### Get Air Quality Data
```http
GET /?page=Api&postaja=1&polutant=1&tipPodatka=avg&vrijemeOd=2023-01-01&vrijemeDo=2023-12-31
```

### Parameters
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `postaja` | integer | Yes | Station ID |
| `polutant` | integer | Yes | Pollutant ID |
| `tipPodatka` | integer | Yes | Data type ID |
| `vrijemeOd` | string | Yes | Start date (dd.mm.yyyy format) |
| `vrijemeDo` | string | Yes | End date (dd.mm.yyyy format) |

### Response Format
{
  "success": true,
  "data": [
    {
      "id": 1,
      "station_id": 1,
      "pollutant_id": 1,
      "value": 25.5,
      "unit": "μg/m³",
      "timestamp": "2023-06-01 12:00:00"
    }
  ]
}