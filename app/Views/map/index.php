<link rel="stylesheet" href="<?= BASE_URL . "/css/leaflet.css" ?>">
<link rel="stylesheet" href="<?= BASE_URL . "/css/map.css" ?>">

<div id="map" class="rounded shadow d-flex justify-content-center align-items-center">
    <!-- Loading placeholder -->
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>
<script src="<?= BASE_URL . "/js/GhmpMap.js" ?>"></script>

<script>
    const map = new GhmpMap("map", "fetch-lots");
</script>