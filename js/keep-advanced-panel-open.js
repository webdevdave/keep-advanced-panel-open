wp.domReady(function() {
    function openAdvancedPanels() {
        const advancedPanels = document.querySelectorAll('.components-panel__body:not(.is-opened)');
        advancedPanels.forEach(panel => {
            if (panel.querySelector('.components-panel__body-title button')) {
                panel.querySelector('.components-panel__body-title button').click();
            }
        });
    }

    // Run initially
    openAdvancedPanels();

    // Set up a MutationObserver to watch for changes in the DOM
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                openAdvancedPanels();
            }
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Run when the editor is ready
    wp.data.subscribe(function() {
        const isEditorReady = wp.data.select('core/editor').isCleanNewPost() || wp.data.select('core/editor').isEditedPostSaveable();
        if (isEditorReady) {
            openAdvancedPanels();
        }
    });
});