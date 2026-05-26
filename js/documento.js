document.addEventListener("DOMContentLoaded", function () {
  mostrarDocumentos();
});

function obtenerSecciones() {
  return JSON.parse(localStorage.getItem("seccionesTransparencia")) || [];
}

function mostrarDocumentos() {

  const contenedor = document.getElementById("contenedorDocumentos");

  if (!contenedor) return;

  const secciones = obtenerSecciones();

  contenedor.innerHTML = "";

  if (secciones.length === 0) {
    contenedor.innerHTML = `
      <div class="seccion-documentos">
        <h2>No hay documentos registrados</h2>
        <p>Por el momento no se han agregado documentos.</p>
      </div>
    `;
    return;
  }

  secciones.forEach(function (seccion) {

    const tarjeta = document.createElement("div");
    tarjeta.className = "seccion-documentos";

    const titulo = document.createElement("h2");
    titulo.textContent = seccion.titulo;

    const descripcion = document.createElement("p");
    descripcion.textContent = seccion.descripcion;

    const grid = document.createElement("div");
    grid.className = "grid-botones";

    seccion.documentos.forEach(function (documento) {

      const boton = document.createElement("a");

      boton.className = "boton-documento";

      boton.href = documento.url;

      boton.target = "_blank";

      boton.textContent = documento.nombre;

      grid.appendChild(boton);

    });

    tarjeta.appendChild(titulo);
    tarjeta.appendChild(descripcion);
    tarjeta.appendChild(grid);

    contenedor.appendChild(tarjeta);

  });

}
