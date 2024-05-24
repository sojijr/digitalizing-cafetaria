// function downloadImage() {
//   var image = document.getElementById('myImage');
//   var div = document.querySelector('.qrContainer');

//   // Create a new canvas
//   var combinedCanvas = document.createElement('canvas');
//   var ctx = combinedCanvas.getContext('2d');

//   // Set the canvas size to accommodate both the image and the div content
//   combinedCanvas.width = Math.max(image.width, div.clientWidth);
//   combinedCanvas.height = image.height + div.clientHeight;

//   // Draw the image on the canvas
//   ctx.drawImage(image, 0, 0);

//   html2canvas(div).then(function(divCanvas) {
//     ctx.drawImage(divCanvas, 0, image.height);

//     // Convert the combined canvas content to a data URL
//     var combinedDataURL = combinedCanvas.toDataURL('image/png');

//     // Create a temporary link for the combined image
//     var combinedLink = document.createElement('a');
//     combinedLink.href = combinedDataURL;
//     combinedLink.download = 'digital_ticket.png';

//     document.body.appendChild(combinedLink);
//     combinedLink.click();

//     document.body.removeChild(combinedLink);
//   });
// }

const downloadImage = () => {
  const downloadBtn = document.getElementById("download");
  const qrContainer = document.querySelector(".qrContainer");

  downloadBtn.addEventListener("click", () => {
    html2canvas(qrContainer).then((canvas) => {
      const link = document.createElement("a");
      link.href = canvas.toDataURL("image/png");
      link.download = "qr-code.png";
      link.click();
    });
  });
};
