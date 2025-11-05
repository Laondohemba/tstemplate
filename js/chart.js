// Sales Trend Line Chart
        const salesCtx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Current Period',
                        data: [30, 25, 36, 45, 40, 42, 50, 48, 52, 55, 58, 60],
                        borderColor: '#1f2937',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 0
                    },
                    {
                        label: 'Previous Period',
                        data: [20, 28, 25, 35, 38, 35, 48, 45, 47, 50, 52, 55],
                        borderColor: '#9ca3af',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        tension: 0.4,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            maxRotation: 0,
                            autoSkip: true,
                            maxTicksLimit: 12
                        }
                    }
                }
            }
        });

        // Subscription Growth Bar Chart
        const subCtx = document.getElementById('subscriptionChart').getContext('2d');
        new Chart(subCtx, {
            type: 'bar',
            data: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6'],
                datasets: [{
                    data: [55, 75, 65, 80, 70, 88],
                    backgroundColor: [
                        '#A0BCE8',
                        '#6BE6D3',
                        '#1f2937',
                        '#7DBBFF',
                        '#B899EB',
                        '#71DD8C'
                    ],
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });

        // Categories Donut Chart
        const catCtx = document.getElementById('categoriesChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: ['Farm Produce', 'Timber', 'Natural Resource', 'Farm Tools'],
                datasets: [{
                    data: [52.1, 22.8, 13.9, 11.2],
                    backgroundColor: [
                        '#1f2937',
                        '#60a5fa',
                        '#86efac',
                        '#c4b5fd'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });