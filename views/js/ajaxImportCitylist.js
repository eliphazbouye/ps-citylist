$(document).ready(function() {
    var ajax_url = $('#citylist_ajax_link').data('citlist_ajax_link');

    $.getJSON(ajax_url, (data) => {
        try {
            // console.log('data '  , data);
            data.cities.map((result) => {
                console.log(result.city_name)
            })
            } catch (e) {
            console.error(e);
            // expected output: "Parameter is not a number!"
            }
    })
    
})
