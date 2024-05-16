"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const observationDataElement = document.getElementById('observation-data');
    const renderChart = (data) => {
        const donutChartElement = document.getElementById('donutChart');
        if (donutChartElement) {
            const ctx = donutChartElement.getContext('2d');
            if (ctx) {
                const chart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.map(item => item.label),
                        datasets: [{
                                data: data.map(item => item.data),
                                backgroundColor: data.map((_, i) => `hsl(${i * 360 / data.length}, 100%, 50%)`),
                            }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        },
                    },
                });
            }
        }
    };
    if (observationDataElement) {
        const observationsJson = observationDataElement.getAttribute('data-observations') ?? '[]';
        try {
            const observations = JSON.parse(observationsJson);
            // Asegúrate de que cada elemento tiene las propiedades necesarias.
            if (observations.every(obs => typeof obs.species === 'string' && typeof obs.total === 'number')) {
                const data = observations.map(observation => ({
                    label: observation.species,
                    data: observation.total,
                }));
                renderChart(data);
            }
            else {
                console.error('Data is not in the expected format');
            }
        }
        catch (error) {
            console.error('Failed to parse observations data:', error);
        }
    }
});
