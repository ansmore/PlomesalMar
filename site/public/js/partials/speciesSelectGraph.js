"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const speciesDropdown = document.getElementById('speciesDropdown');
    const allSpeciesData = ;
    const updateChart = (speciesId) => {
        const data = allSpeciesData[speciesId];
        myChart.data.datasets[0].data = data;
        myChart.update();
    };
    speciesDropdown.addEventListener('change', function () {
        updateChart(this.value);
    });
    updateChart(speciesDropdown.value);
});
