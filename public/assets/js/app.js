var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    savePNGButton = wrapper.querySelector("[data-action=save-png]"),
    closeButton = wrapper.querySelector("[data-action=close]"),
    
    canvas = wrapper.querySelector("canvas"),
    signaturePad;

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

signaturePad = new SignaturePad(canvas);

clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
});

closeButton.addEventListener("click", function (event) {
    $('.signaturepda').css('visibility', 'hidden');
});

savePNGButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
        alert("Please provide signature first.");
    } else {

        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "POST",
            dataType: "json",
            data: {signaturePad: signaturePad.toDataURL(), appId: $('input[name=appId]').val()},
            url: "/signaturepad-convert",
            success: function(data) {
                if( data.code == '200' ){
                    $('.signedImg').html('<img src="'+signaturePad.toDataURL()+'">');
                    $('.signaturepda').css('visibility', 'hidden');
                }else{
                    return false
                }
            }
        });
        return false;
        //window.open(signaturePad.toDataURL());

    }
});


