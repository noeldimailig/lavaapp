var searchText = document.querySelector('textarea').value;

function searchPage(doc, pageNumber) {
  return doc.getPage(pageNumber).then(function (page) {
    return page.getTextContent();
  }).then(function (content) {
    // Search combined text content using regular expression
    var text = content.items.map(function (i) { return i.str; }).join('');
    var re = new RegExp("(.{0,20})" + searchText + "(.{0,20})", "gi"), m;
    var lines = [];
    while (m = re.exec(text)) {
      var line = (m[1] ? "..." : "") + m[0] + (m[2] ? "..." : "");
      lines.push(line);
    }
    return {page: pageNumber, items: lines};
  });
}

// $('#generate').on('click', function(){
var loading = PDFJS.getDocument(url);
loading.promise.then(function (doc) {
  var results = [];
  for (var i = 1; i <= doc.numPages; i++)
    results.push(searchPage(doc, i));
  return Promise.all(results);
}).then(function (searchResults) {
  // Display results using divs
  searchResults.forEach(function (result) {
    var div = document.createElement('div'); div.className="pr"; document.body.appendChild(div);
    div.textContent = 'Page ' + result.page + ':';
    result.items.forEach(function (s) {
      var div2 = document.createElement('div'); div2.className="prl"; div.appendChild(div2);
      div2.textContent = s; 
    });

    // var display = $('#reference');
    // display.html(result);
  });
}).catch(console.error);
// });