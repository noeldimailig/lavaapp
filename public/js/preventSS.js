// document.addEventListener("keydown", function (e) {
//     e.
//     var keyCode = e.keyCode ? e.keyCode : e.which;
//         if (keyCode == 44 || keyCode == 17 || keyCode == 16 || keyCode == 18) {
//             stopPrntScr();
//         }
//     });
// function stopPrntScr() {

//     var inpFld = document.createElement("input");
//     inpFld.setAttribute("value", ".");
//     inpFld.setAttribute("width", "0");
//     inpFld.style.height = "0px";
//     inpFld.style.width = "0px";
//     inpFld.style.border = "0px";
//     document.body.appendChild(inpFld);
//     inpFld.select();
//     document.execCommand("copy");
//     inpFld.remove(inpFld);
// }
// function AccessClipboardData() {
//     try {
//         window.clipboardData.setData('text', "Access   Restricted");
//     } catch (err) {
//     }
// }
// setInterval("AccessClipboardData()", 300);

const copyToClipboard = () => {
    var textToCopy = "You are not allowed to take screenshot!!!";
    navigator.clipboard.writeText(textToCopy);
}

$(window).keyup((e) => {
    if (e.keyCode == 44 || e.keyCode == 17 || e.keyCode == 16 || e.keyCode == 92 || e.keyCode == 91) {
        alert("You are not allowed to take screenshot of this document!");
        setTimeout(
            copyToClipboard(), 
            1000
        );
    }
});