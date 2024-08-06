<?php
include('connection.php');
date_default_timezone_set('Asia/Kathmandu');

if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];

    $query = "SELECT * FROM nowshowing WHERE id = $movie_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        date_default_timezone_set('UTC'); 
        $currentDateTime = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Layout</title>
    <link href="css/booknow.css" rel="stylesheet">
    <style>
        .error-message {
            display: none;
            color: red;
            font-weight: bold;
        }
        .date-buttons {
            display: flex;
            gap: 10px;
        }
        .date-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .date-buttons button:hover {
            background-color: #45a049;
        }
        .date-buttons button.selected {
            background-color: #FF5733;
        }
        .seat {
            display: inline-block;
            width: 30px;
            height: 30px;
            margin: 5px;
            text-align: center;
            line-height: 30px;
            border-radius: 5px;
            cursor: pointer;
        }
        .seat.available {
            background-color: #4CAF50;
        }
        .seat.booked {
            background-color: #FF5733;
            cursor: not-allowed;
        }
        .seat.selected {
            background-color: #FFD700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="seat-layout">
            <h2>SCREEN</h2>
            <div id="seatContainer"></div>
        </div>
        <div class="movie-details">
            <h2>Movie: <?php echo $row['title']; ?></h2>
            <p>Theater: SN CINEMAS</p>
            <div class="booking-form">
                <h2>Book Now</h2>
                <form action="booking.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
                    <input type="hidden" id="selectedDate" name="selectedDate">
                    <input type="hidden" id="selectedTime" name="selectedTime">
                    <div class="des">
                        <label for="date">Select Date:</label>
                        <div class="date-buttons">
                            <?php
                            for ($i = 0; $i < 3; $i++) {
                                $date = date('Y-m-d', strtotime("+$i day"));
                                $label = date('D, M j', strtotime($date));
                                echo "<button type=\"button\" onclick=\"selectDate('$date', this)\">$label</button> ";
                            }
                            ?>
                        </div>
                        
                        <label for="showtime">Showtime:</label>
                        <select id="time" name="time" onchange="handleSeatChange()">
                            <!-- Options will be populated by JavaScript -->
                        </select>

                        <label for="seats">Number of Seats:</label>
                        <input type="number" id="seats" name="seats" min="1" required readonly><br>
                        <input type="text" id="selectedSeats" name="selectedSeats" readonly>
                        <label for="price">Total Price:</label>
                        <input type="text" id="price" name="price" readonly><br>
                        <button type="submit" id="submitBtn" disabled>Confirm Booking</button>
                    </div>
                    <div style="margin-top: 20px;">
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: #4CAF50; margin-right: 10px;"></span>
                        <span style="margin-right: 20px;">Available</span>
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: #FF5733; margin-right: 10px;"></span>
                        <span>Booked</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    const numRows = 5;
    const numCols = 10;
    const pricePerSeat = 350;
    const movieId = <?php echo $movie_id; ?>;
    let selectedDate = '';
    let selectedTime = '';

    function selectDate(date, button) {
        selectedDate = date;
        document.getElementById('selectedDate').value = selectedDate;
        populateShowtimes();

        // Remove 'selected' class from all buttons
        const buttons = document.querySelectorAll('.date-buttons button');
        buttons.forEach(btn => btn.classList.remove('selected'));

        // Add 'selected' class to the clicked button
        button.classList.add('selected');
    }

    function populateShowtimes() {
        const showtimes = {
            '09:00': '9:00 am',
            '12:30': '12:30 pm',
            '14:45': '2:45 pm',
            '21:15': '9:15 pm'
        };

        const select = document.getElementById('time');
        select.innerHTML = '';

        const currentDateTime = new Date();

        for (const time in showtimes) {
            const datetimeStr = `${selectedDate} ${time}`;
            const showtime = new Date(datetimeStr.replace(/-/g, '/'));

            if (showtime > currentDateTime) {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = `${showtimes[time]} - ${selectedDate}`;
                select.appendChild(option);
            }
        }

        handleSeatChange();
    }

    function handleSeatChange() {
    const time = document.getElementById('time').value;
    
    if (selectedDate && time) {
        selectedDateTime = `${selectedDate} ${time}:00`; // Add seconds to time
        document.getElementById('selectedTime').value = selectedDateTime;
    }
    
    fetchBookedSeats(time)
        .then(bookedSeats => {
            generateSeats(bookedSeats);
        })
        .catch(error => {
            console.error('Error fetching booked seats:', error);
        });
}


async function fetchBookedSeats(time) {
    try {
        const response = await fetch(`fetch.php?movie_id=${movieId}&showtime=${encodeURIComponent(selectedDate + ' ' + time + ':00')}`);
        const text = await response.text();
        return text ? text.split(',').map(seat => seat.trim()) : [];
    } catch (error) {
        console.error('Error fetching booked seats:', error);
        return [];
    }
}


    async function generateSeats(bookedSeats = []) {
    const seatContainer = document.getElementById('seatContainer');
    seatContainer.innerHTML = '';

    for (let row = 1; row <= numRows; row++) {
        for (let col = 1; col <= numCols; col++) {
            const seatLabel = String.fromCharCode(64 + row) + col;
            const seat = document.createElement('div');
            seat.classList.add('seat');
            seat.dataset.row = row;
            seat.dataset.col = col;

            if (bookedSeats.includes(seatLabel)) {
                seat.classList.add('booked');
            } else {
                seat.classList.add('available');
                seat.addEventListener('click', toggleSeat);
            }

            const label = document.createElement('span');
            label.classList.add('seat-label');
            label.textContent = seatLabel;
            seat.appendChild(label);

            seatContainer.appendChild(seat);
        }
        seatContainer.appendChild(document.createElement('br'));
    }
    updateSelectedSeats();
}


    const selectedSeats = new Set();

    function toggleSeat() {
        if (this.classList.contains('booked')) {
            return;
        }

        const seatLabel = this.querySelector('.seat-label').textContent;
        if (selectedSeats.has(seatLabel)) {
            this.classList.remove('selected');
            selectedSeats.delete(seatLabel);
        } else {
            this.classList.add('selected');
            selectedSeats.add(seatLabel);
        }

        updateSelectedSeats();
    }

    function updateSelectedSeats() {
        const seatNames = Array.from(selectedSeats);
        const totalPrice = seatNames.length * pricePerSeat;
        document.getElementById('seats').value = seatNames.length;
        document.getElementById('selectedSeats').value = seatNames.join(', ');
        document.getElementById('price').value = totalPrice.toFixed(2);
        const submitButton = document.getElementById('submitBtn');
        if (seatNames.length > 0 && document.getElementById('time').value !== '') {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    }

    function validateForm() {
        const selectedTime = document.getElementById('time').value;
        const numSelectedSeats = selectedSeats.size;

        if (selectedTime === '' || numSelectedSeats === 0) {
            alert('Please select a showtime and at least one seat to proceed with the booking.');
            return false; 
        }

        return true; 
    }
    handleSeatChange();
</script>
</body>
</html>

<?php
    } else {
        echo "Movie not found.";
    }
} else {
    echo "Movie ID not specified.";
}
?>
