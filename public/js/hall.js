document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.selectable');

    seats.forEach(seat => {
        seat.addEventListener('click', function () {
            const row = this.getAttribute('data-row');
            const seatNumber = this.getAttribute('data-seat');
            const price = calculatePrice(row, seatNumber);
            const tickets = document.getElementById('tickets');
            if (this.classList.contains('selected')) {
                const selectedSeatToRemove = document.querySelector(`.selected-seat-info[data-row="${row}"][data-seat="${seatNumber}"]`);
                if (selectedSeatToRemove) {
                    selectedSeatToRemove.remove();
                }
                if (document.getElementById('max_4')) {
                    document.getElementById('max_4').remove();
                }
                this.classList.toggle('selected');
            } else if (tickets.children.length < 4) {
                if (document.getElementById('max_4')) {
                    document.getElementById('max_4').remove();
                }
                const selectedSeatInfo = document.createElement('div');
                selectedSeatInfo.classList.add('selected-seat-info');

                selectedSeatInfo.dataset.row = row;
                selectedSeatInfo.dataset.seat = seatNumber;
                selectedSeatInfo.innerHTML = `
                            <div class="right-ticket">
                                <div class="row-info">
                                    <div class="price">Ряд</div>
                                    <div class="info"> ${row}</div>
                                </div>
                                <div class="seat-info">
                                    <div class="price">Місце</div>
                                    <div class="info">${seatNumber}</div>
                                </div>
                            </div>

                            <div class="price-info">
                                <div class="price">Ціна</div>
                                <div class="info"> ${price}</div>
                            </div>
                        `;
                tickets.appendChild(selectedSeatInfo);
                defineCost();
                this.classList.toggle('selected');
            } else {
                if (!document.getElementById('max_4')) {
                    tickets.insertAdjacentHTML('afterend', `<div id="max_4">Максилальна кількість квитків 4 штуки</div>`);
                }

            }


        });

    });
});
function defineCost(){
    let elements = document.querySelectorAll('div.price-info .info');
    let sum = 0;
    elements.forEach(element => {
        sum += parseFloat(element.textContent);
    });
    console.log(sum);
    document.getElementById('booked-btn').innerText='Забронювати '+ sum+'грн';
    return sum;
}
function calculatePrice(row, seatNumber) {
    return '100 грн'; // Повертаємо деяку фіктивну ціну для прикладу
}

const ticketsElement = document.getElementById('tickets');



function sendSelectedSeats(){
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    let selectedSeats = document.querySelectorAll('.selected');
    let seatData = [];

    selectedSeats.forEach(function(seat) {
        seatData.push({
            row: seat.getAttribute('data-row'),
            seat: seat.getAttribute('data-seat'),
            session_id: sessionId
        });
    });


    fetch('/tickets', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken // Додаємо CSRF-токен до запиту
        },
        body: JSON.stringify(seatData)
        })
        .then(response => {

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                console.log('Server response was ok, but not redirected');
            }
        })
        .catch((error) => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

