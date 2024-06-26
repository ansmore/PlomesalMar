"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const form1 = document.getElementById('multiGraphForm1');
    const form2 = document.getElementById('multiGraphForm2');
    const updateButton1 = document.getElementById('updateGraphButton1');
    const updateButton2 = document.getElementById('updateGraphButton2');
    const canvas1 = document.getElementById('multiYearSpeciesChart1');
    const canvas2 = document.getElementById('multiYearSpeciesChart2');
    const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMetaTag ? csrfTokenMetaTag.getAttribute('content') : '';
    if (!form1 || !form2 || !updateButton1 || !updateButton2 || !canvas1 || !canvas2 || !csrfToken) {
        console.error('Form, button, canvas, or CSRF token not found');
        return;
    }
    const ctx1 = canvas1.getContext('2d');
    const ctx2 = canvas2.getContext('2d');
    if (!ctx1 || !ctx2) {
        console.error('Could not get canvas context');
        return;
    }
    const scalesOptions = {
        y: { beginAtZero: true }
    };
    const multiYearSpeciesChart1 = new Chart(ctx1, {
        type: 'line',
        data: { labels: [], datasets: [] },
        options: { scales: scalesOptions }
    });
    const multiYearSpeciesChart2 = new Chart(ctx2, {
        type: 'line',
        data: { labels: [], datasets: [] },
        options: { scales: scalesOptions }
    });
    updateButton1.addEventListener('click', async () => {
        await updateGraphs();
    });
    updateButton2.addEventListener('click', async () => {
        await updateGraphs();
    });
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    function updateChart(chart, labels, speciesData, speciesNames) {
        chart.data.labels = labels;
        const datasets = Object.keys(speciesData).map(speciesId => {
            const data = speciesData[speciesId];
            const label = speciesNames[speciesId];
            return {
                label,
                data,
                fill: false,
                borderColor: getRandomColor(),
                tension: 0.1
            };
        });
        chart.data.datasets = datasets;
        chart.update();
    }
    async function updateGraphs() {
        if (!form1 || !form2) {
            console.error('Forms not found');
            return;
        }
        const formData1 = new FormData(form1);
        const formData2 = new FormData(form2);
        const formData = new FormData();
        formData1.forEach((value, key) => {
            formData.append(key, value);
        });
        formData2.forEach((value, key) => {
            formData.append(key, value);
        });
        try {
            const response = await fetch(form1.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken ?? ''
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            if (data?.labels && data?.speciesData1 && data?.speciesData2) {
                updateChart(multiYearSpeciesChart1, data.labels, data.speciesData1, data.speciesNames);
                updateChart(multiYearSpeciesChart2, data.labels, data.speciesData2, data.speciesNames);
            }
            else {
                console.error('Invalid data format received:', data);
            }
        }
        catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    }
});
