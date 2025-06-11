# Air Quality API Architecture Overview

## System Architecture

### 1. Application Structure
The application follows a traditional MVC architecture with the following main components:

```
air_quality_api/
├── README.md               
├── composer.json           
├── composer.lock           
├── docs/                   
├── .htaccess               
├── index.php               
├── install.php             
├── system/                 
│   ├── AppCore.class.php   
│   ├── config.inc.php      
│   ├── core.functions.php  
│   ├── options.inc.php     
│   ├── util/               
│   ├── control/            
│   ├── model/              
│   └── view/               
├── tests/
│   └── unit/               
└── vendor/                 
```

### 2. Core Components

#### 2.1 AppCore
- Central application class that manages database connections

#### 2.2 Controllers
- Inherit from `AbstractPage` class
- Handle HTTP requests and responses
- Main controllers:
  - `ApiPage`: Handles requests to external API
  - `IndexPage`: Main page with resource listings
  - `Station*Page`: Station management
  - `Pollutant*Page`: Pollutant management
  - `Measurement*Page`: Measurement data handling
  -  Authentication pages (Login, Register, Logout)

#### 2.3 Models
- Inherit from `AbstractModel` class
- Data access layer
- Main models:
  - `Station`: Manages air quality stations
  - `Pollutant`: Manages pollutant types
  - `Measurement`: Handles air quality measurements
  - `User`: Manages user
  - `MySqliDatabase`: Manages database connection and queries

#### 2.4 Views
- They exist.