<!-- View Certificate Modal -->
<div class="modal fade" id="viewCertificateModal" tabindex="-1" aria-labelledby="viewCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="viewCertificateModalLabel">View Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe class="rounded" id="certificateFrame" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const viewCertificateButtons = document.querySelectorAll(".view-certificate-btn");
        const certificateFrame = document.getElementById("certificateFrame");

        viewCertificateButtons.forEach(button => {
            button.addEventListener("click", function() {
                const fileUrl = this.getAttribute("data-bs-file");
                certificateFrame.src = fileUrl;
            });
        });
    });
</script>