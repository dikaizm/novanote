</div>

<script>
    let modalContainer = document.querySelector(".modal-container");
    let modalBackdrop = modalContainer.querySelector(".modal-backdrop");
    let modalPanel = modalContainer.querySelector(".modal-panel");

    let showModal = document.querySelector(".modal-show");
    let closeModal = document.querySelector(".modal-close");

    // Modal function
    function openModal() {
        modalContainer.classList.remove('hidden')
    }

    function hideModal() {
        modalContainer.classList.add('hidden')
    }

    // Modal action
    showModal.addEventListener('click', openModal)
    closeModal.addEventListener('click', hideModal)
    
    // Close modal escape
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            hideModal()
        }
    });
</script>

</body>
</html>