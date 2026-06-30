# NGO Guard — NGO Legitimacy Monitoring System

A data-driven web platform that rates and monitors Non-Governmental Organisations (NGOs) for legitimacy, helping donors identify fraudulent organisations used for money laundering or misappropriation of charitable funds.

## Problem Statement

Thousands of registered NGOs misuse donor funds for money laundering or personal enrichment. NGO Guard provides a transparent, ML-powered scoring system to help donors and regulatory bodies assess NGO credibility before contributing.

## Features

- **Legitimacy Score** — Machine learning model (PHP-ML) generates a composite credibility rating per NGO
- **Fund Tracking** — Monitors total funds received vs. utilised by each NGO
- **Transaction Analysis** — Detailed transaction history with anomaly indicators
- **NGO Directory** — Searchable database of registered NGOs with profile pages
- **Training Pipeline** — Retrainable scoring model (`ngo_score_train.php`)

## Tech Stack

![PHP](https://img.shields.io/badge/PHP-7.x-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![PHP-ML](https://img.shields.io/badge/PHP--ML-Machine%20Learning-blue)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)

## Project Structure

```
├── main.php            # Dashboard and entry point
├── ngo_det.php         # NGO detail profile
├── ngo_rate.php        # Rating display
├── ngo_score.php       # Score computation and display
├── ngo_score_train.php # Model training pipeline
├── tot_fund.php        # Total fund analysis
├── trans_det.php       # Transaction detail view
├── database_conn.php   # DB configuration
├── NGO_Details.sql     # NGO master data schema
├── TXN_Details.sql     # Transaction data schema
└── phpml/              # PHP Machine Learning library
```

## Getting Started

```bash
git clone https://github.com/DrOneEyed/NGO-Guard.git
cd NGO-Guard
```

1. Import `NGO_Details.sql` and `TXN_Details.sql` into MySQL
2. Update credentials in `database_conn.php`
3. Run with Apache/XAMPP or PHP built-in:

```bash
php -S localhost:8000 main.php
```

## License

MIT