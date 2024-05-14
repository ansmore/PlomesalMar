"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('myChart');
    if (!canvas) {
        console.error('Canvas element not found');
        return;
    }
    const ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Unable to get canvas context');
        return;
    }
    const chartDataElement = document.getElementById('chartData');
    if (!chartDataElement) {
        console.error('Chart data element not found');
        return;
    }
    const labels = JSON.parse(chartDataElement.getAttribute('data-labels') || '[]');
    const seriesData = JSON.parse(chartDataElement.getAttribute('data-series') || '[]');
    const speciesDropdown = document.getElementById('speciesDropdown');
    if (!speciesDropdown) {
        console.error('Species dropdown not found');
        return;
    }
    const chartConfig = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Número de Individuos',
                    data: seriesData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
        }
    };
    const myChart = new Chart(ctx, chartConfig);
    speciesDropdown.addEventListener('change', (event) => {
        const target = event.target;
        if (!target) {
            console.error('Event target is null');
            return;
        }
        const selectedSpeciesId = target.value;
        const speciesData = JSON.parse(localStorage.getItem('speciesData') || '{}');
        const newData = speciesData[selectedSpeciesId] || [];
        if (myChart && myChart.data.datasets) {
            if (myChart.data.datasets[0]) {
                myChart.data.datasets[0].data = newData;
                myChart.update();
            }
            else {
                console.error('No datasets found in myChart');
            }
        }
    });
});
