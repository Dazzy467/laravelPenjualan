$(document).ready(function () {
    $('#pageDropdown').on('show.bs.collapse', function () {
        $("#chevron").removeClass("fa-chevron-right").addClass("fa-chevron-down");
    });
    
    $('#pageDropdown').on('hide.bs.collapse', function () {
        $("#chevron").removeClass("fa-chevron-down").addClass("fa-chevron-right");
    });
});