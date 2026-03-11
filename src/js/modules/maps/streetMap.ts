import * as L from 'leaflet';
export default function streetMap() {
  const map_address = document.querySelector('#map-address') as HTMLElement;
  const map_address_content = map_address.textContent?.trim();
  const map_coords = document.querySelector('#map-coords') as HTMLElement;
  const map_coords_content = map_coords?.textContent?.trim();
  const map_zoom = document.querySelector('#map-zoom') as HTMLElement;
  const map_icon = document.querySelector('#map-icon') as HTMLElement;
  const zoom = map_zoom?.textContent?.trim();
  if (map_address_content?.length === 0 || map_coords_content?.length === 0) {
    alert(
      'Enter coords and address for streetMap from admin Footer fields map coords and adress text'
    );
  }

  if (!map_coords_content || !map_address_content) {
    alert('Enter coords and address for streetMap in admin.');
    return;
  }

  const coords_array = map_coords_content.split(',').map((s) => s.trim());
  if (coords_array.length !== 2) {
    alert('add right coords');
    return;
  }

  const lat = Number.parseFloat(coords_array[0]);
  const lng = Number.parseFloat(coords_array[1]);
  if (Number.isNaN(lat) || Number.isNaN(lng)) {
    alert('Invalid coordinates');
    return;
  }

  // ✅ Используем кортеж строго из двух элементов
  const coords: L.LatLngTuple = [lat, lng];
  const addressText = map_address_content ? map_address_content : '';
  const map = L.map('map', {
    scrollWheelZoom: false
  }).setView(coords, zoom ? parseInt(zoom) : 17);
  const myIcon = L.icon({
    iconUrl: map_icon.textContent ? map_icon.textContent : 'img/map-marker.png',
    iconSize: [32, 32],
    iconAnchor: [16, 32], // first divide iconSize first param by 2, second the same as iconSize last param
    shadowSize: [68, 95],
    shadowAnchor: [22, 94]
  });
  L.marker(coords, { icon: myIcon })
    .bindTooltip(addressText, {
      direction: 'right',
      offset: [-10, -30],
      permanent: false
    })
    .addTo(map);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 24,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  let isMovable = false; // Track state

  function toggleMapInteraction() {
    if (!isMovable) {
      map.dragging.disable();
      map.scrollWheelZoom.disable();
      map.touchZoom.disable();
      map.doubleClickZoom.disable();
      map.boxZoom.disable();
    } else {
      map.dragging.enable();
      map.scrollWheelZoom.enable();
      map.touchZoom.enable();
      map.doubleClickZoom.enable();
      map.boxZoom.enable();
    }
    isMovable = !isMovable; // Toggle state
  }

  // Toggle movement on click
  map.on('click', toggleMapInteraction);
}
