    
    if (typeof prestashop !== 'undefined') {

        //Before when is loaded
        let countryBefore = document.querySelector('select.js-country');

        console.log(countryBefore.value)
        //before when address form is loaded
        if(countryBefore.value != 32) {
            document.querySelector('[name="id_citylist"]').required = false;
            document.querySelector('[name="id_citylist"]').parentElement.parentElement.style.display = 'none';
        }

        //Updated address form listen event
        prestashop.on(
            'updatedAddressForm',
            function (event) {
                let countryUpdated = document.querySelector('select.js-country');

                console.log(countryUpdated.value)
        //updated address form
        if(countryUpdated.value != 32) {
            document.querySelector('[name="id_citylist"]').required = false;
            document.querySelector('[name="id_citylist"]').parentElement.parentElement.style.display = 'none';
        }
        else{
            document.querySelector('[name="id_citylist"]').required = true;
            document.querySelector('[name="id_citylist"]').parentElement.parentElement.style.display = 'block';
        }
        // console.log(country.value)
        // console.log(event)
      }
    );
  }

