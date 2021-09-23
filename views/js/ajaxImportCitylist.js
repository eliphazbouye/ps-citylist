$(document).ready(function() {
    var ajax_url = $('#citylist_ajax_link').data('citlist_ajax_link');


    async function loadCities() {
            //Fetch request
            const response  =  await fetch(ajax_url)
            const getCities = await response.json();

            // ** change 'form' and 'text' to correctly identify the form and text input element **
            var inputElement = document.querySelector("input[name='city']");
            var selectElement = document.createElement('select');


            // get the existing input element's current (or initial) value
            var currentValue = inputElement.value || inputElement.getAttribute('value');

            getCities.cities.map((result, i) => {
                var optionElement = document.createElement('option');
                optionElement.appendChild(document.createTextNode(result.city_name));
                optionElement.setAttribute('value', result.city_name);
                selectElement.appendChild(optionElement);

                // if the option matches the existing input's value, select it
                if (result.city_name == currentValue) {
                    selectElement.selectedIndex = i;
                    console.log('index given ',i);
                }
                
            })


            // // copy the existing input element's attributes to the new select element
            for (var i = 0; i < inputElement.attributes.length; i++) {
                var attribute = inputElement.attributes[i];

                // type and value don't apply, so skip them
                // ** you might also want to skip style, or others -- modify as needed **
                if (attribute.name != 'type' && attribute.name != 'value') {
                    selectElement.setAttribute(attribute.name, attribute.value);
                }
            }


            // // finally, replace the old input element with the new select element
            inputElement.parentElement.replaceChild(selectElement, inputElement);



    }


    loadCities()


     
    // if (typeof prestashop !== 'undefined') {
    //     prestashop.on(
    //       'updatedAddressForm',
    //       function (event) {
    //         // var eventDatas = {};
    //         // if (event && event.reason) {
    //         //   eventDatas = {
    //         //     my_data_1: event.reason.myData1,
    //         //     my_data_2: event.reason.myData2
    //         //   };
    //         // }

    //         console.log(eventDatas)
    //       }
    //     );
    //   }
      

 
    
})
