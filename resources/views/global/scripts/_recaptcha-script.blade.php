<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackOne&render=explicit" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackTwo&render=explicit" async defer></script>
<script>
    var onloadCallbackOne = function() {
        if($("#g-recaptcha-1").length) {
            grecaptcha.render("g-recaptcha-1", {
                "sitekey": "{{ env('NOCAPTCHA_SITEKEY') }}",
                "callback" : function(token) {
                    console.log(token);
                }
            });
        }
    };
    var onloadCallbackTwo = function() {
        if($("#g-recaptcha-2").length) {
            grecaptcha.render("g-recaptcha-2", {
                "sitekey": "{{ env('NOCAPTCHA_SITEKEY') }}",
                "callback" : function(token) {
                    console.log(token);
                }
            });
        }
    };
</script>
