document.addEventListener("DOMContentLoaded", cargarDocumentos);

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

let documentosGlobal = [];
let filtroAnio = "todos";
let filtroMes = "todos";

function obtenerCategoriaURL() {
  const params = new URLSearchParams(window.location.search);
  return params.get("categoria");
}

async function cargarDocumentos() {
  const categoria = obtenerCategoriaURL();
  const tituloCategoria = document.getElementById("tituloCategoria");
  const contenedor = document.getElementById("contenedorDocumentos");

  tituloCategoria.textContent = nombresCategorias[categoria] || "Documentos";
  contenedor.innerHTML = '<p class="estado-carga">Cargando documentos...</p>';

  try {
    const snapshot = await db
      .collection("documentos")
      .where("categoria", "==", categoria)
      .get();

    documentosGlobal = [];

    snapshot.forEach((doc) => {
      documentosGlobal.push(doc.data());
    });

    if (documentosGlobal.length === 0) {
      contenedor.innerHTML = '<p class="estado-carga">No existen documentos registrados.</p>';
      return;
    }

    documentosGlobal.sort((a, b) => {
      if (b.anio !== a.anio) return b.anio - a.anio;
      return a.ordenMes - b.ordenMes;
    });

    crearToolbar();
    renderizarDocumentos();

  } catch (error) {
    console.error(error);
    contenedor.innerHTML = '<p class="estado-carga">Error al cargar los documentos.</p>';
  }
}

function crearToolbar() {
  const contenedor = document.getElementById("contenedorDocumentos");

  const anios = [...new Set(documentosGlobal.map(doc => doc.anio))]
    .sort((a, b) => b - a);

  const meses = [...new Map(
    documentosGlobal.map(doc => [doc.ordenMes, doc.mes])
  ).entries()].sort((a, b) => a[0] - b[0]);

  contenedor.innerHTML = `
    <div class="toolbar-documentos">

      <div class="filtro-grupo">
        <label>Año</label>
        <div class="custom-select" data-filtro="anio">
          <div class="custom-select-trigger">
            <span>Todos</span>
          </div>
          <div class="custom-options">
            <div class="custom-option activo" data-value="todos">Todos</div>
            ${anios.map(anio => `<div class="custom-option" data-value="${anio}">${anio}</div>`).join("")}
          </div>
        </div>
      </div>

      <div class="filtro-grupo">
        <label>Mes</label>
        <div class="custom-select" data-filtro="mes">
          <div class="custom-select-trigger">
            <span>Todos</span>
          </div>
          <div class="custom-options">
            <div class="custom-option activo" data-value="todos">Todos</div>
            ${meses.map(([orden, mes]) => `<div class="custom-option" data-value="${orden}">${mes}</div>`).join("")}
          </div>
        </div>
      </div>

      <button type="button" class="btn-limpiar" id="limpiarFiltros">
        Mostrar todo
      </button>
    </div>

    <div id="listaDocumentos"></div>
  `;

  activarDropdowns();

  document.getElementById("limpiarFiltros").addEventListener("click", () => {
    filtroAnio = "todos";
    filtroMes = "todos";
    crearToolbar();
    renderizarDocumentos();
  });
}

function activarDropdowns() {
  document.querySelectorAll(".custom-select").forEach((select) => {
    const trigger = select.querySelector(".custom-select-trigger");
    const options = select.querySelector(".custom-options");
    const filtro = select.dataset.filtro;

    trigger.addEventListener("click", () => {
      document.querySelectorAll(".custom-options").forEach((item) => {
        if (item !== options) item.classList.remove("show");
      });

      options.classList.toggle("show");
    });

    options.querySelectorAll(".custom-option").forEach((option) => {
      option.addEventListener("click", () => {
        const value = option.dataset.value;
        const text = option.textContent.trim();

        if (filtro === "anio") filtroAnio = value;
        if (filtro === "mes") filtroMes = value;

        trigger.querySelector("span").textContent = text;

        options.querySelectorAll(".custom-option").forEach(o => o.classList.remove("activo"));
        option.classList.add("activo");

        options.classList.remove("show");

        renderizarDocumentos();
      });
    });
  });

  document.addEventListener("click", (e) => {
    if (!e.target.closest(".custom-select")) {
      document.querySelectorAll(".custom-options").forEach(o => o.classList.remove("show"));
    }
  });
}

function renderizarDocumentos() {
  const lista = document.getElementById("listaDocumentos");

  let documentos = documentosGlobal.filter(doc => {
    const cumpleAnio = filtroAnio === "todos" || String(doc.anio) === String(filtroAnio);
    const cumpleMes = filtroMes === "todos" || String(doc.ordenMes) === String(filtroMes);

    return cumpleAnio && cumpleMes;
  });

  if (documentos.length === 0) {
    lista.innerHTML = '<p class="estado-carga">No hay documentos con los filtros seleccionados.</p>';
    return;
  }

  const agrupados = {};

  documentos.forEach((doc) => {
    if (!agrupados[doc.anio]) agrupados[doc.anio] = {};
    if (!agrupados[doc.anio][doc.mes]) agrupados[doc.anio][doc.mes] = [];

    agrupados[doc.anio][doc.mes].push(doc);
  });

  lista.innerHTML = "";

  Object.keys(agrupados)
    .sort((a, b) => b - a)
    .forEach((anio) => {
      let html = `
        <div class="bloque-anio">
          <h2>${anio}</h2>
      `;

      Object.keys(agrupados[anio]).forEach((mes) => {
        html += `
          <div class="bloque-mes">
            <h3>${mes}</h3>
            <div class="grid-documentos">
        `;

        agrupados[anio][mes].forEach((doc) => {
          html += `
            <a href="${doc.url}" target="_blank" class="btn-documento">
              ${doc.titulo}
            </a>
          `;
        });

        html += `
            </div>
          </div>
        `;
      });

      html += `</div>`;

      lista.insertAdjacentHTML("beforeend", html);
    });
}