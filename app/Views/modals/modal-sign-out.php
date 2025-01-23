<!-- Signout Modal -->
<div class="modal fade" id="sign-out-modal" tabindex="-1" aria-labelledby="sign-out-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="sign-out-modal-label">Signout</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to sign out?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form action="sign-out" method="post">
                <button type="submit" class="btn btn-primary">Sign Out</button>
            </form>      
        </div>
        </div>
    </div>
</div>