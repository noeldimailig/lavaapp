var __PDF_DOC,
	__CURRENT_PAGE,
	__TOTAL_PAGES,
	__PAGE_RENDERING_IN_PROGRESS = 0,
	// __CANVAS = $('#pdf-canvas').get(0),
	__CANVAS = $('#pdf-render').get(0);
	__CANVAS_CTX = __CANVAS.getContext('2d');
const fileName = document.getElementById('fileName').innerText;
const url = `./documents/${fileName}`;

function showPDF(pdf_url) {
	// $("#pdf-loader").show();

	PDFJS.getDocument({ url}).then(function(pdf_doc) {
		__PDF_DOC = pdf_doc;
		__TOTAL_PAGES = __PDF_DOC.numPages;
		
		// Hide the pdf loader and show pdf container in HTML
		// $("#pdf-loader").hide();
		// $("#pdf-contents").show();
		$("#page-count").text(__TOTAL_PAGES);

		// Show the first page
		showPage(1);
	}).catch(function(error) {
		// If error re-show the upload button
		// $("#pdf-loader").hide();
		// $("#upload-button").show();
		
		alert(error.message);
	});;
}

function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	// Disable Prev & Next buttons while page is being loaded
	$("#next-page, #prev-page").attr('disabled', 'disabled');

	// While page is being rendered hide the canvas and show a loading message
	// $("#pdf-canvas").hide();
	// $("#page-loader").show();

	// Update current page in HTML
	$("#page-num").text(page_no);
	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;

		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);

		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;

			// Re-enable Prev & Next buttons
			$("#next-page, #prev-page").removeAttr('disabled');

			// Show the canvas and hide the page loader
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
			$("#text-layer").css({ left: canvas_offset.left + 'px', top: canvas_offset.top + 'px', height: __CANVAS.height + 'px', width: __CANVAS.width + 'px' });

			// Pass the data to the method for rendering of text over the pdf canvas.
			PDFJS.renderTextLayer({
			    textContent: textContent,
			    container: $("#text-layer").get(0),
			    viewport: viewport,
			    textDivs: []
			});
		});
	});
}

// Upon click this should should trigger click on the #file-to-upload file input element
// This is better than showing the not-good-looking file input element
// $("#upload-button").on('click', function() {
// 	$("#file-to-upload").trigger('click');
// });

// When user chooses a PDF file
// $("#file-to-upload").on('change', function() {
	// Validate whether PDF
 //    if(['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
 //        alert('Error : Not a PDF');
 //        return;
 //    }

	// $("#upload-button").hide();

	// Send the object url of the pdf
showPDF(url);
// });

// Previous page of the PDF
$("#prev-page").on('click', function() {
	if(__CURRENT_PAGE != 1)
		showPage(--__CURRENT_PAGE);
});

// Next page of the PDF
$("#next-page").on('click', function() {
	if(__CURRENT_PAGE != __TOTAL_PAGES)
		showPage(++__CURRENT_PAGE);
});