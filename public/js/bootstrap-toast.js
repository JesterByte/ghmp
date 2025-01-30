class Toast {
    constructor() {
        this.toastContainer = null;
    }

    // Method to create and show a toast
    showToast(htmlIcon, message, title = 'Notification', delay = 5000, link = '') {
        // Create toast container if it doesn't exist
        if (!this.toastContainer) {
            this.toastContainer = document.createElement('div');
            this.toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(this.toastContainer);
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        // Create toast header
        const toastHeader = document.createElement('div');
        toastHeader.className = 'toast-header';
        toastHeader.innerHTML = `
            ${htmlIcon}
            <strong class="me-auto">${title}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        `;

        // Create toast body
        const toastBody = document.createElement('div');
        toastBody.className = 'toast-body';
        if (link) {
            toastBody.innerHTML = `<a href="${link}">${message}</a>.`;
        } else {
            toastBody.textContent = message;
        }

        // Append header and body to toast
        toast.appendChild(toastHeader);
        toast.appendChild(toastBody);

        // Append toast to toast container
        this.toastContainer.appendChild(toast);

        // Initialize and show the toast
        const bootstrapToast = new bootstrap.Toast(toast, { delay: delay });
        bootstrapToast.show();

        // Remove toast from DOM after it hides
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }
}

// function unsetToast() {
//     // Add an event listener to unset the session variable when the toast is closed
//     document.querySelector('.toast').addEventListener('hidden.bs.toast', function () {
//         fetch('../process/process-unset-toast.php', {
//             method: 'POST'
//         });
//     });
// }
