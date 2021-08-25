
if (typeof prestashop !== 'undefined') {
    prestashop.on(
      'updatedAddressForm',
      function (event) {
        let country = document.querySelector('select.js-country');
        
        if(country.value != 32) {
            document.querySelector('[name="id_citylist"]').required = false;
            document.querySelector('[name="id_citylist"]').parentElement.parentElement.style.display = 'none';
        }else {
            document.querySelector('[name="id_citylist"]').required = true;
            document.querySelector('[name="id_citylist"]').parentElement.parentElement.style.display = 'block';
        }
        // console.log(country.value)
        // console.log(event)
      }
    );
  }
