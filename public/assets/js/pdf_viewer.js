var _PDF_DOC,
    _CURRENT_PAGE,
    _TOTAL_PAGES,
    _PAGE_RENDERING_IN_PROGRESS = 0,
    _CANVAS = document.querySelector('#pdf-render');
const fileName = document.getElementById('fileName').innerText;

const url = `./documents/${fileName}`;
// initialize and load the PDF
async function showPDF(pdf_url) {
    // document.querySelector("#pdf-loader").style.display = 'block';

    // get handle of pdf document
    try {
        _PDF_DOC = await PDFJS.getDocument({ url: pdf_url });
    }
    catch(error) {
        alert(error.message);
    }

    // total pages in pdf
    _TOTAL_PAGES = _PDF_DOC.numPages;
    
    // Hide the pdf loader and show pdf container
    // document.querySelector("#pdf-loader").style.display = 'none';
    // document.querySelector("#pdf-contents").style.display = 'block';
    document.querySelector("#page-count").innerHTML = _TOTAL_PAGES;

    // show the first page
    showPage(1);
}

// load and render specific page of the PDF
async function showPage(page_no) {
    _PAGE_RENDERING_IN_PROGRESS = 1;
    _CURRENT_PAGE = page_no;

    // disable Previous & Next buttons while page is being loaded
    document.querySelector("#next-page").disabled = true;
    document.querySelector("#prev-page").disabled = true;

    // while page is being rendered hide the canvas and show a loading message
    // document.querySelector("#pdf-canvas").style.display = 'none';
    // document.querySelector("#page-loader").style.display = 'block';

    // update current page
    // document.querySelector("#pdf-current-page").innerHTML = page_no;
    document.querySelector("#page-num").innerHTML = page_no;
    
    // get handle of page
    try {
        var page = await _PDF_DOC.getPage(page_no);
    }
    catch(error) {
        alert(error.message);
    }

    // original width of the pdf page at scale 1
    var pdf_original_width = page.getViewport(1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height;

    // setting page loader height for smooth experience
    // document.querySelector("#page-loader").style.height =  _CANVAS.height + 'px';
    // document.querySelector("#page-loader").style.lineHeight = _CANVAS.height + 'px';

    var render_context = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
    };
        
    // render the page contents in the canvas
    try {
        await page.render(render_context);
    }
    catch(error) {
        alert(error.message);
    }

    _PAGE_RENDERING_IN_PROGRESS = 0;

    // re-enable Previous & Next buttons
    document.querySelector("#next-page").disabled = false;
    document.querySelector("#prev-page").disabled = false;

    // show the canvas and hide the page loader
    // document.querySelector("#pdf-canvas").style.display = 'block';
    // document.querySelector("#page-loader").style.display = 'none';

    // Render the page contents in the canvas
        page.render(render_context).then(function() {
            __PAGE_RENDERING_IN_PROGRESS = 0;

            // // Re-enable Prev & Next buttons
            // $("#pdf-next, #pdf-prev").removeAttr('disabled');

            // // Show the canvas and hide the page loader
            // $("#pdf-canvas").show();
            // $("#page-loader").hide();

            // Return the text contents of the page after the pdf has been rendered in the canvas
            return page.getTextContent();
        }).then(function(textContent) {
            // Get canvas offset
            var canvas_offset = $("#pdf-render").offset();

            // Clear HTML for text layer
            $("#text-layer").html('');

            // Assign the CSS created to the text-layer element
            $("#text-layer").css({ left: canvas_offset.left + 'px', top: canvas_offset.top + 'px', height: _CANVAS.height + 'px', width: _CANVAS.width + 'px' });

            // Pass the data to the method for rendering of text over the pdf canvas.
            PDFJS.renderTextLayer({
                textContent: textContent,
                container: $("#text-layer").get(0),
                viewport: viewport,
                textDivs: []
            });
        });
}

// click on "Show PDF" buuton
// document.querySelector("#show-pdf-button").addEventListener('click', function() {
//     this.style.display = 'none';
    // showPDF('https://mozilla.github.io/pdf.js/web/compressed.tracemonkey-pldi-09.pdf');
// });

showPDF(url);

// click on the "Previous" page button
document.getElementById('prev-page').addEventListener('click', function() {
    if(_CURRENT_PAGE != 1)
        showPage(--_CURRENT_PAGE);
});

	// $('#prev-page').on('click', function(){
	// 	if(_CURRENT_PAGE != 1) showPage(_CURRENT_PAGE--);
	// });
	// $('#next-page').on('click', function(){
	// 	if(_CURRENT_PAGE != 1) showPage(_CURRENT_PAGE++);
	// });

// click on the "Next" page button
document.getElementById('next-page').addEventListener('click', function() {
    if(_CURRENT_PAGE != _TOTAL_PAGES)
        showPage(++_CURRENT_PAGE);
});
