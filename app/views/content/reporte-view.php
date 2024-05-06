<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="report-preview">
                <div class="toolbar">
                    <button id="zoom-out" class="btn btn-light">-</button>
                    <button id="zoom-in" class="btn btn-light">+</button>
                </div>
                <div class="preview-container">
                    <iframe id="report-frame" src="report.html"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const reportFrame = document.getElementById("report-frame");

    document.getElementById("zoom-out").addEventListener("click", function() {
        zoomOut();
    });

    document.getElementById("zoom-in").addEventListener("click", function() {
        zoomIn();
    });

    function zoomOut() {
        reportFrame.style.transform = "scale(0.8)";
    }

    function zoomIn() {
        reportFrame.style.transform = "scale(1.2)";
    }
});
</script>