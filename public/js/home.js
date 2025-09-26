document.getElementById('year').textContent = new Date().getFullYear();

function updateCountdown() {
    const now = new Date();
    let drawTime = new Date();
    drawTime.setHours(23, 30, 0, 0);
    let midnight = new Date();
    midnight.setHours(24, 0, 0, 0);
    const timerSection = document.querySelector('.timer-section');
    const resultSection = document.querySelector('.timer-section-hide');
    if (now < drawTime) {
        timerSection.style.display = "block";
        resultSection.style.display = "none";
        const timeDiff = drawTime - now;
        const hours = Math.floor(timeDiff / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }
    else if (now >= drawTime && now < midnight) {
        timerSection.style.display = "none";
        resultSection.style.display = "block";
    }
    else {
        drawTime.setDate(drawTime.getDate() + 1);
        const timeDiff = drawTime - now;
        const hours = Math.floor(timeDiff / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
        timerSection.style.display = "block";
        resultSection.style.display = "none";
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }
}

setInterval(updateCountdown, 1000);
updateCountdown();
document.addEventListener('DOMContentLoaded', fetchLotteryResults);
