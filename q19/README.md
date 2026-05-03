# Q19 - Airplane Seat Booking System

## Problem Statement
Write PHP code for booking seats in airplanes and display seating arrangements in airplanes.

## Features
- Visual seating arrangement display
- 30 seats (5 rows x 6 columns: A-F)
- Click to select seat
- Book seat with passenger name
- Color-coded seats (green=available, red=booked)
- Aisle separation between columns C and D
- Real-time seat availability

## How to Run

1. **Setup Database**
   ```
   http://localhost/q19/setup.php
   ```
   This creates 30 seats automatically.

2. **Access Application**
   ```
   http://localhost/q19/
   ```

3. **Book a Seat**
   - Click on a green (available) seat
   - Enter passenger name
   - Click "Book Seat"
   - Seat turns red (booked)

## Seating Layout
```
Row 1:  [1A] [1B] [1C]  AISLE  [1D] [1E] [1F]
Row 2:  [2A] [2B] [2C]  AISLE  [2D] [2E] [2F]
Row 3:  [3A] [3B] [3C]  AISLE  [3D] [3E] [3F]
Row 4:  [4A] [4B] [4C]  AISLE  [4D] [4E] [4F]
Row 5:  [5A] [5B] [5C]  AISLE  [5D] [5E] [5F]
```

## Files
- `index.php` - Main booking page with seating display
- `config.php` - Database connection
- `setup.php` - Database and seat creation

## Database
- Database: `airplane_db`
- Table: `seats` (id, seat_number, passenger_name, status)

## Seat Status
- **Available** - Green color, can be booked
- **Booked** - Red color, already reserved

## Technologies
- PHP
- MySQL
- JavaScript (for seat selection)
- CSS (for visual layout)
