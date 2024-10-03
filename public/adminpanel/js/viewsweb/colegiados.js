grecaptcha.ready(function () {
    //alert("key:"+site_key);
    grecaptcha.execute(site_key, {action: 'homepage'})
            .then(function (token) {
                //console.log("TOKEN GOOGLE:" + token);
                document.getElementById('g-recaptcha-response').value = token;
            });

});