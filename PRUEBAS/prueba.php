<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<style>
footer {
  color: rgb(180, 180, 180);
}
</style>
      <div id="content">
        <h2 class="text-center">Export from HTML</h2>
        </p>
        <br>
        <table id="demo" class="table table-bordered">
          <thead>
            <tr>
              <th>Serial Number</th>
              <th>Name</th>
              <th>Percentile</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>James</td>
              <td>8.9</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Harry</td>
              <td>7.6</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Emma</td>
              <td>7.0</td>
            </tr>
          </tbody>
        </table>
        <div>
          <button class="btn" id="export">Save</button>
        </div>
 
        <br>
 
      </div>
 
<br>
<script>
 
document.getElementById('export').addEventListener('click',
  exportPDF);
 
var specialElementHandlers = {
  '.no-export': function(element, renderer) {
    return true;
  }
};
 
function exportPDF() {
 
  var doc = new jsPDF('p', 'pt', 'a4');
 
 
  var source = document.getElementById('content').innerHTML;
 
  var margins = {
    top: 10,
    bottom: 10,
    left: 10,
    width: 595
  };
 
  doc.fromHTML(
    source,
    margins.left,
    margins.top, {
      'width': margins.width,
      'elementHandlers': specialElementHandlers
    },
 
    function(dispose) {
      doc.save('Test.pdf');
    }, margins);
}
</script>