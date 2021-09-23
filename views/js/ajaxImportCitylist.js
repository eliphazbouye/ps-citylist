$(document).ready(function() {
    var ajax_url = $('#citylist_ajax_link').data('citlist_ajax_link');

    $.getJSON(ajax_url, (data) => {
        try {
            data.cities.map((result) => {
                console.log(result.city_name)
            })
            } catch (e) {
            console.error(e);
            }
    })
    
})
