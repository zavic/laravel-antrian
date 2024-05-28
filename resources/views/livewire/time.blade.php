<div>
    <p class="h5 text-center mt-2" id="jam"></p>
</div>

<script>
    function updateTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        document.getElementById('jam').textContent = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateTime, 1000); // Update every second
    updateTime(); // Initial update
</script>
