<script src="{{ asset('assets/lightbox-image-viewer/js/lc_lightbox.lite.js') }}" type='text/javascript'> </script>
<script src="{{ asset('assets/lightbox-image-viewer/lib/AlloyFinger/alloy_finger.min.js') }}" type='text/javascript'> </script>

<script>

    // A $( document ).ready() block.
    $( document ).ready(function() {
        lc_lightbox('.elem', {
            wrap_class:'lcl_fade_oc',
            gallery :false,
            thumb_attr:'data-lcl-thumb',
            skin:'dark',
            // more options here
        });
    });

</script>
