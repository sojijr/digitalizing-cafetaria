function printDiv() {
    var qrcode = document.getElementById('qrcode');

    // Check if the image is loaded
    var image = document.getElementById('myImage');
    if (image.complete) {
      // Image is already loaded, proceed with printing
      var newWin = window.open('', '_blank');
      newWin.document.write('<html><head><title>Print</title></head><body>');
      newWin.document.write('<style>body {font-family: Arial, sans-serif;}</style>');
      newWin.document.write(qrcode.innerHTML);
      newWin.document.write('</body></html>');
      newWin.document.close();
      newWin.print();
    } else {
      // Image is not yet loaded, wait for the onload event
      image.onload = function() {
        var newWin = window.open('', '_blank');
        newWin.document.write('<html><head><title>Print</title></head><body>');
        newWin.document.write('<style>body {font-family: Arial, sans-serif;}</style>');
        newWin.document.write(qrcode.innerHTML);
        newWin.document.write('</body></html>');
        newWin.document.close();
        newWin.print();
      };
    }
  }