document.getElementById('year').textContent = new Date().getFullYear();

async function fetchLotteryResults() {
    try {
        const response = await fetch('/today-lottery', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        const data = await response.json();

        if (data.number) {
            document.getElementById('result-container').innerHTML = `
                <section class="timer-section-hide">
                    <h2>Today's Result</h2>
                    <div class="numbers-display">
                        ${data.number.split('').map(d => `<div class="number-ball">${d}</div>`).join('')}
                    </div>
                </section>
            `;
        }
    } catch (error) {
        console.error("Error fetching results:", error);
    }
}

function updateCountdown() {
    const now = new Date();
    let drawTime = new Date();
    drawTime.setHours(23, 30, 0, 0);
    let midnight = new Date();
    midnight.setHours(24, 0,0, 0);

    const timerSection = document.querySelector('.timer-section');
    const resultContainer = document.getElementById('result-container');

    if (now < drawTime) {
        // Countdown visible, result nahi
        timerSection.style.display = "block";
        resultContainer.innerHTML = "";

        const timeDiff = drawTime - now;
        const hours = Math.floor(timeDiff / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }
    else if (now >= drawTime && now < midnight) {
        // Countdown hide, result API se inject
        timerSection.style.display = "none";
        if (!document.querySelector('.timer-section-hide')) {
            fetchLotteryResults();
        }
    }
    else {
        // Next day countdown
        drawTime.setDate(drawTime.getDate() + 1);
        timerSection.style.display = "block";
        resultContainer.innerHTML = "";

        const timeDiff = drawTime - now;
        const hours = Math.floor(timeDiff / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }
}

setInterval(updateCountdown, 1000);
updateCountdown();
