document.addEventListener("DOMContentLoaded", function () {
    mostrarDocumentos();
  });
  
  function obtenerSecciones() {
    return JSON.parse(localStorage.getItem("seccionesTransparencia")) || [];
  }
  
  function mostrarDocumentos() {
    const contenedor = document.getElementById("contenedorDocumentos");
    const secciones = obtenerSecciones();
  
    contenedor.innerHTML = "";
  
    if (secciones.length === 0) {
      contenedor.innerHTML = `
        <div class="seccion-documentos">
          <h2>No hay documentos registrados</h2>
          <p>Por el momento no se han agregado documentos de transparencia.</p>
        </div>
      `;
      return;
    }
  
    secciones.forEach(function (seccion) {
      const div = document.createElement("div");
      div.className = "seccion-documentos";
  
      let botones = "";
  
      seccion.documentos.forEach(function (documento) {
        botones += `
          <a class="boton-documento" href="${documento.url}" target="_blank">
            ${documento.nombre}
          </a>
        `;
      });
  
      div.innerHTML = `
        <h2>${seccion.titulo}</h2>
        <p>${seccion.descripcion}</p>
        <div class="grid-botones">
          ${botones}
        </div>
      `;
  
      contenedor.appendChild(div);
    });
  }