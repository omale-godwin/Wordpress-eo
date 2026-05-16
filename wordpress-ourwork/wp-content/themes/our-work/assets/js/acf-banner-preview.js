jQuery(document).ready(function ($) {
    // Define the base path for banner snapshots
    const themeUrl = '/wp-content/themes/our-work'; // Update this to match your theme path
    const snapshotPath = `${themeUrl}/assets/images/template-previews/`;

    // Handle change event for the select field
    $('#banner-template-select').on('change', function () {
        const selectedValue = $(this).val();
        const previewImage = selectedValue
            ? `${snapshotPath}${selectedValue}.jpg`
            : '';
        
        // Update the preview image
        const $previewImage = $('#banner-preview-image');
        if (selectedValue) {
            $previewImage.attr('src', previewImage).show();
        } else {
            $previewImage.hide();
        }
    });

    // Trigger change event on page load to show the initial preview
    $('#banner-template-select').trigger('change');
});
