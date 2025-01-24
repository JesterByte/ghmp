class LotMap {
    constructor(mapId, dataUrl) {
        this.map = L.map(mapId).setView([14.871318, 120.976566], 18);
        this.dataUrl = dataUrl;
        this.initMap();
    }

    initMap() {
        // Set up tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 20
        }).addTo(this.map);

        // Add legend
        this.addLegend();

        // Fetch and render lots
        this.fetchLots();
    }

    fetchLots() {
        fetch(this.dataUrl)
            .then(response => response.json())
            .then(data => this.renderLots(data))
            .catch(error => console.error('Error fetching lot data:', error));
    }

    renderLots(lots) {
        lots.forEach(lot => this.drawLot(lot));
    }

    drawLot(lot) {
        const lotWidth = 0.000009;
        const lotHeight = 0.000018;

        // Determine color based on lot status
        const colorMap = {
            'Available': 'green',
            'Reserved': 'yellow',
            'Sold': 'red',
            'Sold and Occupied': 'gray',
        };
        const color = colorMap[lot.status] || 'blue';

        // Create a rectangle for the lot
        const rectangle = L.rectangle(
            [[lot.latitude_start, lot.longitude_start], [lot.latitude_end, lot.longitude_end]],
            { color: color, weight: 1, fillOpacity: 0.5 }
        ).addTo(this.map);

        // Add a popup to the rectangle
        rectangle.bindPopup(`<b>Status:</b> ${lot.status}`);
    }

    addLegend() {
        const legend = L.control({ position: 'bottomright' });
        legend.onAdd = () => {
            const div = L.DomUtil.create('div', 'legend');
            div.innerHTML += '<h4>Legend</h4>';
            div.innerHTML += '<div><span style="background: green;"></span>Available</div>';
            div.innerHTML += '<div><span style="background: yellow;"></span>Reserved</div>';
            div.innerHTML += '<div><span style="background: red;"></span>Sold</div>';
            div.innerHTML += '<div><span style="background: gray;"></span>Sold and Occupied</div>';
            return div;
        };
        legend.addTo(this.map);
    }
}

// Initialize the map
document.addEventListener('DOMContentLoaded', () => {
    const lotMap = new LotMap('map', 'LotController.php');
});
