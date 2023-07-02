function emphasizeActiveTab(tabId) {
    $(document).ready(function(){
        $('#' + tabId)
            .css('background-color', 'rgb(255,192,74)');
    });
}
