const CLAVE_ADMIN = "admin123";

document.addEventListener("DOMContentLoaded", function () {
  agregarCampoDocumento();
});

function iniciarSesion() {
  const clave = document.getElementById("claveAdmin").value;
  const mensaje = document.getElementById("mensajeLogin");

  if (clave === CLAVE_ADMIN) {
    document.getElementById("loginAdmin").classList.add("oculto");
    document.getElementById("panelAdmin").classList.remove("oculto");
    document.getElementById("vistaAdmin").classList.remove("oculto");

    mostrarSeccionesAdmin();
  } else {
    mensaje.textContent = "Contraseña incorrecta.";
  }
}

function cerrarSesion() {
  document.getElementById("claveAdmin").value = "";
  document.getElementById("loginAdmin").classList.remove("oculto");
  document.getElementById("panelAdmin").classList.add("oculto");
  document.getElementById("vistaAdmin").classList.add("oculto");
}

function agregarCampoDocumento() {
  const contenedor = document.getElementById("listaInputsDocumentos");

  const div = document.createElement("div");
  div.className = "documento-input";

  div.innerHTML = `
    <label>Nombre del botón/documento</label>
    <input type="text" class="nombreDocumento" placeholder="Ejemplo: Informe anual 2026">

    <label>Hipervínculo del documento</label>
    <input type="url" class="urlDocumento" placeholder="https://ejemplo.com/documento.pdf">

    <button type="button" class="btn-peligro" onclick="eliminarCampoDocumento(this)">
      Eliminar documento
    </button>
  `;

  contenedor.appendChild(div);
}

function eliminarCampoDocumento(boton) {
  boton.parentElement.remove();
}

function obtenerSecciones() {
  return JSON.parse(localStorage.getItem("seccionesTransparencia")) || [];
}

function guardarSeccion() {
  const titulo = document.getElementById("tituloSeccion").value.trim();
  const descripcion = document.getElementById("descripcionSeccion").value.trim();
  const nombres = document.querySelectorAll(".nombreDocumento");
  const urls = document.querySelectorAll(".urlDocumento");
  const mensaje = document.getElementById("mensajeAdmin");

  if (titulo === "") {
    mensaje.textContent = "Debes escribir el título de la sección.";
    return;
  }

  const documentos = [];

  for (let i = 0; i < nombres.length; i++) {
    const nombre = nombres[i].value.trim();
    const url = urls[i].value.trim();

    if (nombre !== "" && url !== "") {
      documentos.push({
        nombre: nombre,
        url: url
      });
    }
  }

  if (documentos.length === 0) {
    mensaje.textContent = "Debes agregar al menos un documento con hipervínculo.";
    return;
  }

  const secciones = obtenerSecciones();

  secciones.push({
    titulo: titulo,
    descripcion: descripcion,
    documentos: documentos
  });

  localStorage.setItem("seccionesTransparencia", JSON.stringify(secciones));

  document.getElementById("tituloSeccion").value = "";
  document.getElementById("descripcionSeccion").value = "";
  document.getElementById("listaInputsDocumentos").innerHTML = "";

  agregarCampoDocumento();
  mostrarSeccionesAdmin();

  mensaje.textContent = "Sección guardada correctamente.";
}

function mostrarSeccionesAdmin() {
  const contenedor = document.getElementById("contenedorAdminDocumentos");
  const secciones = obtenerSecciones();

  contenedor.innerHTML = "";

  if (secciones.length === 0) {
    contenedor.innerHTML = "<p>No hay secciones registradas.</p>";
    return;
  }

  secciones.forEach(function (seccion, index) {
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
      <button class="btn-peligro" onclick="eliminarSeccion(${index})">
        Eliminar sección
      </button>
    `;

    contenedor.appendChild(div);
  });
}

function eliminarSeccion(index) {
  const secciones = obtenerSecciones();

  if (confirm("¿Seguro que deseas eliminar esta sección?")) {
    secciones.splice(index, 1);
    localStorage.setItem("seccionesTransparencia", JSON.stringify(secciones));
    mostrarSeccionesAdmin();
  }
}

function borrarTodo() {
  if (confirm("¿Seguro que deseas borrar todas las secciones?")) {
    localStorage.removeItem("seccionesTransparencia");
    mostrarSeccionesAdmin();
  }
}