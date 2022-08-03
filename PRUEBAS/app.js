console.log("gola")

var doc = new jsPDF();

doc.text("hello world", 10, 10);
doc.fromHtml($('.hola').get(0), 15, 15);
doc.save("a.pdf")