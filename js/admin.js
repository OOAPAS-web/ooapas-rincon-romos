const loginAdmin = document.getElementById("loginAdmin");
const panelAdmin = document.getElementById("panelAdmin");
const loginForm = document.getElementById("loginForm");
const formDocumento = document.getElementById("formDocumento");
const mensajeLogin = document.getElementById("mensajeLogin");
const mensajeAdmin = document.getElementById("mensajeAdmin");
const listaAdminDocumentos = document.getElementById("listaAdminDocumentos");

let documentosAdmin = [];

const nombresCategorias = {
  "estado-situacion-financiera": "Estado de Situación Financiera",
  "estado-actividades": "Estado de Actividades",
  "estado-variacion-hacienda-publica": "Estado de Variación en la Hacienda Pública",
  "estado-flujos-efectivo": "Estado de Flujos de Efectivo",
  "presupuesto-ingresos": "Presupuesto de Ingresos",
  "presupuesto-egresos": "Presupuesto de Egresos",
  "cuenta-publica": "Cuenta Pública",
  "lgcg": "Ley General de Contabilidad Gubernamental"
};

auth.onAuthStateChanged((user) => {
  if (user) {
    loginAdmin.style.display = "none";
    panelAdmin.style.display = "block";
    mensajeAdmin.textContent = "Sesión iniciada correctamente.";
    cargarDocumentosAdmin();
  } else {
    loginAdmin.style.display = "block";
    panelAdmin.style.display = "none";
  }
});

loginForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  const email = document.getElementById("emailAdmin").value.trim();
  const password = document.getElementById("passwordAdmin").value;

  try {
    await auth.signInWithEmailAndPassword(email, password);
    mensajeLogin.textContent = "";
  } catch (error) {
    mensajeLogin.textContent = "Error al ingresar: " + error.message;
  }
});

formDocumento.addEventListener("submit", async function (e) {
  e.preventDefault();

  mensajeAdmin.textContent = "Guardando documento...";

  const categoria = document.getElementById("categoriaDocumento").value;
  const titulo = document.getElementById("tituloDocumento").value.trim();
  const url = document.getElementById("urlDocumento").value.trim();
  const anio = Number(document.getElementById("anioDocumento").value);

  const mesSelect = document.getElementById("mesDocumento");
  const mes = mesSelect.value;
  const ordenMes = Number(mesSelect.options[mesSelect.selectedIndex].dataset.orden);

  if (!categoria || !titulo || !url || !anio || !mes || !ordenMes) {
    mensajeAdmin.textContent = "Faltan datos por llenar.";
    return;
  }

  try {
    await db.collection("documentos").add({
      categoria,
      titulo,
      url,
      anio,
      mes,
      ordenMes,
      fechaRegistro: firebase.firestore.FieldValue.serverTimestamp()
    });

    mensajeAdmin.textContent = "Documento guardado correctamente.";
    formDocumento.reset();
    cargarDocumentosAdmin();

  } catch (error) {
    mensajeAdmin.textContent = "Error al guardar: " + error.message;
  }
});

async function cargarDocumentosAdmin() {
  listaAdminDocumentos.innerHTML = '<p class="mensaje">Cargando documentos...</p>';

  try {
    const snapshot = await db.collection("documentos").get();

    documentosAdmin = [];

    snapshot.forEach((doc) => {
      documentosAdmin.push({
        id: doc.id,
        ...doc.data()
      });
    });

    documentosAdmin.sort((a, b) => {
      if (b.anio !== a.anio) return b.anio - a.anio;
      return a.ordenMes - b.ordenMes;
    });

    activarFiltrosAdmin();
    renderizarDocumentosAdmin();

  } catch (error) {
    listaAdminDocumentos.innerHTML = '<p class="mensaje">Error al cargar documentos.</p>';
  }
}

function activarFiltrosAdmin() {
  const buscar = document.getElementById("buscarAdmin");
  const categoria = document.getElementById("filtroCategoriaAdmin");

  if (buscar) buscar.oninput = renderizarDocumentosAdmin;
  if (categoria) categoria.onchange = renderizarDocumentosAdmin;
}

function renderizarDocumentosAdmin() {
  const buscar = document.getElementById("buscarAdmin")?.value.toLowerCase().trim() || "";
  const categoriaFiltro = document.getElementById("filtroCategoriaAdmin")?.value || "todos";

  let documentos = documentosAdmin.filter((doc) => {
    const categoriaNombre = nombresCategorias[doc.categoria] || doc.categoria;

    const texto = `
      ${doc.titulo}
      ${categoriaNombre}
      ${doc.anio}
      ${doc.mes}
    `.toLowerCase();

    const coincideBusqueda = texto.includes(buscar);
    const coincideCategoria = categoriaFiltro === "todos" || doc.categoria === categoriaFiltro;

    return coincideBusqueda && coincideCategoria;
  });

  if (documentos.length === 0) {
    listaAdminDocumentos.innerHTML = '<p class="mensaje">No se encontraron documentos.</p>';
    return;
  }

  listaAdminDocumentos.innerHTML = "";

  documentos.forEach((doc) => {
    const item = document.createElement("div");
    item.className = "item-admin";

    item.innerHTML = `
      <div>
        <h3>${doc.titulo}</h3>
        <p><strong>Categoría:</strong> ${nombresCategorias[doc.categoria] || doc.categoria}</p>
        <p><strong>Periodo:</strong> ${doc.mes} ${doc.anio}</p>
        <p><a href="${doc.url}" target="_blank">Abrir documento</a></p>
      </div>

      <button class="btn-eliminar" onclick="eliminarDocumento('${doc.id}')">
        Eliminar
      </button>
    `;

    listaAdminDocumentos.appendChild(item);
  });
}

let documentoPendienteEliminar = null;

function eliminarDocumento(id) {
  documentoPendienteEliminar = id;
  document.getElementById("modalConfirmacion").classList.add("activo");
}

document.getElementById("btnCancelarEliminar").addEventListener("click", () => {
  documentoPendienteEliminar = null;
  document.getElementById("modalConfirmacion").classList.remove("activo");
});

document.getElementById("btnConfirmarEliminar").addEventListener("click", async () => {
  if (!documentoPendienteEliminar) return;

  try {
    await db.collection("documentos").doc(documentoPendienteEliminar).delete();
    mensajeAdmin.textContent = "Documento eliminado correctamente.";
    documentoPendienteEliminar = null;
    document.getElementById("modalConfirmacion").classList.remove("activo");
    cargarDocumentosAdmin();
  } catch (error) {
    mensajeAdmin.textContent = "Error al eliminar: " + error.message;
  }
});

function cerrarSesion() {
  auth.signOut();
}