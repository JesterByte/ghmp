function autofocusModal(modalId, inputId) {
    const myModal = document.getElementById(modalId)
    const myInput = document.getElementById(inputId)

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
}