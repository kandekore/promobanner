document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll(".promo-countdown").forEach(function(el) {

        const targetDate = new Date(el.dataset.date).getTime();

        function updateCountdown() {

            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) return;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000*60*60*24)) / (1000*60*60));
            const minutes = Math.floor((distance % (1000*60*60)) / (1000*60));
            const seconds = Math.floor((distance % (1000*60)) / 1000);

            el.querySelector(".days").innerText = days;
            el.querySelector(".hours").innerText = hours;
            el.querySelector(".minutes").innerText = minutes;
            el.querySelector(".seconds").innerText = seconds;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });

});
