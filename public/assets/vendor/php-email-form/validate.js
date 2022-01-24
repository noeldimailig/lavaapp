
(function () {
  "use strict";

  let forms = document.querySelectorAll('#contact-form');

  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');
      // let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');
      
      if( ! action ) {
        displayError(thisForm, 'The form action property is not set!')
        return;
      }
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );
            try {
                php_email_form_submit(thisForm, action, formData);
            } catch(error) {
              displayError(thisForm, error)
            }
        php_email_form_submit(thisForm, action, formData);
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(response => {
      if( response.ok ) {
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.reset(); 
        thisForm.querySelector('.sent-message').classList.add('d-block');
        setTimeout( function(){
          thisForm.querySelector('.sent-message').classList.remove('d-block');
        }, 5000);
      } else {
        thisForm.querySelector('.error-message').classList.add('d-block');
        setTimeout( function(){
          thisForm.querySelector('.error-message').classList.remove('d-block');
        }, 5000);
      }
    });
  }
})();
