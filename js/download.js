const downloadImage = () => {
  const downloadBtn = document.getElementById("download");
  const qrContainer = document.querySelector(".qrContainer");

  downloadBtn.addEventListener("click", () => {
    html2canvas(qrContainer).then((canvas) => {
      const link = document.createElement("a");
      link.href = canvas.toDataURL("image/png");
      link.download = "digital-ticket.png";
      link.click();
    });
  });
};
