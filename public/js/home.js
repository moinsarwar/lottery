
    document.getElementById('year').textContent = new Date().getFullYear();
    // Countdown Timer
    function updateCountdown() {
    function updateCountdown() {
        const now = new Date();

        // Aaj ka date le lo
        const today = new Date();
        today.setHours(23, 30, 0, 0); // 11:30 PM

        // Agar current time 11:30 PM ke baad ho gaya ho, agle din ka countdown shuru karo
        if (now > today) {
            today.setDate(today.getDate() + 1);
        }

        const timeDiff = today - now;

        const hours = Math.floor(timeDiff / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }

// Update every second
    setInterval(updateCountdown, 1000);
    updateCountdown();
}

    // Initial call
    updateCountdown();

    // Update every second
    setInterval(updateCountdown, 1000);

    // In a real Laravel app, we would fetch data from the backend
    // This is a simulation of fetching lottery data
    function fetchLotteryResults() {
    // Simulate API call to backend
    setTimeout(() => {
        // In a real app, this would come from the server
        const today = new Date().toDateString();

        // This simulates checking if we have results for today
        const hasTodaysResults = Math.random() > 0.5;

        if (hasTodaysResults) {
            // Display today's results
            document.querySelector('.draw-date').textContent = `Draw Date: ${today}`;
        } else {
            // Get the latest results from the database
            document.querySelector('.draw-date').textContent = 'Latest Draw: May 14, 2023';
        }
    }, 1000);
}

    // Fetch results when page loads
    document.addEventListener('DOMContentLoaded', fetchLotteryResults);
