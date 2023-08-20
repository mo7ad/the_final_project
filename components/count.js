// Function to animate the counters
const animateCounters = () => {
    const counterNumbers = document.querySelectorAll('.num');
    const options = {
        rootMargin: '0px',
        threshold: 0.5 // Adjust this threshold as needed
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                counterNumbers.forEach(counter => {
                    const goal = parseInt(counter.dataset.goal);
                    const duration = 2000; // Animation duration in milliseconds
                    const interval = 10; // Interval duration for updating the number

                    let currentNumber = 0;
                    const increments = goal / (duration / interval);

                    const intervalId = setInterval(() => {
                        currentNumber += increments;
                        counter.textContent = Math.round(currentNumber);

                        if (currentNumber >= goal) {
                            counter.textContent = goal;
                            clearInterval(intervalId);
                        }
                    }, interval);
                });

                observer.unobserve(entry.target);
            }
        });
    }, options);

    observer.observe(document.getElementById('counter-section'));
};

// Call the animateCounters function when the page is ready
window.addEventListener('load', animateCounters);
