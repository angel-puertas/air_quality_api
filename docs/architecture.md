# Air Quality API Architecture Overview

## System Architecture

### 1. Application Structure
The application follows a traditional MVC architecture with the following main components:

```
air_quality_api/
├── README.md               # Project documentation
├── composer.json           # Project dependencies configuration
├── composer.lock           # Locked dependency versions
├── docs/                   # Documentation
├── .htaccess               # Apache configuration
├── index.php               # Main entry point
├── install.php             # Installation script
├── system/                 # Core application code
│   ├── AppCore.class.php   # Core application class
│   ├── config.inc.php      # Configuration settings
│   ├── core.functions.php  # Helper functions
│   ├── options.inc.php     # Application options
│   ├── util/               # Utility scripts
│   ├── control/            # Controller classes
│   ├── model/              # Model classes
│   └── view/               # View templates
├── tests/                  # Test files
└── vendor/                 # Composer dependencies
```

### 2. Core Components

#### 2.1 AppCore
- Central application class that manages database connections

#### 2.2 Controllers
- Inherit from `AbstractPage` class
- Handle HTTP requests and responses
- Main controllers:
  - `ApiPage`: Handles air quality data API requests
  - `IndexPage`: Main page with resource listings
  - `Station*Page`: Station management
  - `Pollutant*Page`: Pollutant management
  - `Measurement*Page`: Measurement data handling
  - Authentication pages (Login, Register, Logout)

#### 2.3 Models
- Inherit from `AbstractModel` class
- Data access layer
- Main models:
  - `Station`: Manages air quality stations
  - `Pollutant`: Manages pollutant types
  - `Measurement`: Handles air quality measurements
  - `User`: User authentication and authorization

#### 2.4 Views
- They exist.