document.addEventListener("DOMContentLoaded", function () {
    const candidateNames = ['Candidate 1', 'Candidate 2', 'Candidate 3'];
    const voteCounts = [350, 450, 300];

    const ctx = document.getElementById('results-chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: candidateNames,
            datasets: [{
                label: 'Votes',
                data: voteCounts,
                backgroundColor: [
                    'rgba(0, 123, 255, 0.8)',
                    'rgba(0, 150, 136, 0.8)',
                    'rgba(231, 76, 60, 0.8)',
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(0, 150, 136, 1)',
                    'rgba(231, 76, 60, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.max(...voteCounts) + 50
                }
            }
        }
    });
});
