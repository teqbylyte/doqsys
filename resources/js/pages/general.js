$(document).ready(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    $('#toast-success').delay(3000).fadeOut(300)
    $('#toast-message').delay(3000).fadeOut(300)
    $('#toast-status').delay(3000).fadeOut(300)
    $('#toast-error').delay(5000).fadeOut(500)
});
