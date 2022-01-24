$(document).ready(function(){

    const copyToClipboard = () => {
        var textToCopy = "You are not allowed to take screenshot!!!";
        navigator.clipboard.writeText(textToCopy);
    }
    
    $(window).keyup((e) => {
        if (e.keyCode == 44 || e.keyCode == 17 || e.keyCode == 16 || e.keyCode == 92 || e.keyCode == 91) {
            setTimeout(
                copyToClipboard(), 
                1000
            );
        }
    });
    
    });