/* =========================================================
   VIDEO INDEX - ACTIVAR Y DESACTIVAR SONIDO MANUALMENTE
   ========================================================= */

   document.addEventListener("DOMContentLoaded", function () {
    const video = document.getElementById("videoOOAPAS");
    const boton = document.getElementById("btnSonidoVideo");
  
    if (!video || !boton) return;
  
    boton.addEventListener("click", function () {
      if (video.muted) {
        video.muted = false;
        video.volume = 1;
  
        video.play()
          .then(function () {
            boton.textContent = "Desactivar sonido";
          })
          .catch(function () {
            boton.textContent = "Presiona reproducir";
          });
  
      } else {
        video.muted = true;
        boton.textContent = "Activar sonido";
      }
    });
  });

/* =========================================================
   TRANSPARENCIA - ABRIR PNT CON AGUASCALIENTES Y OOAPAS
   ========================================================= */

   document.addEventListener("DOMContentLoaded", function () {
    const enlacesTransparencia = document.querySelectorAll(".transparencia-pnt");
  
    if (!enlacesTransparencia.length) return;
  
    const anioActual = new Date().getFullYear();
  
    const urlPNT =
      "https://consultapublicamx.plataformadetransparencia.org.mx/" +
      "?v=a" +
      "&e=1" +
      "&y=" + anioActual +
      "&s=25197";
  
    enlacesTransparencia.forEach(function (enlace) {
      enlace.href = urlPNT;
    });
  });