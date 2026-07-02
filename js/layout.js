document.addEventListener("DOMContentLoaded", () => {
    cargarComponente("header", "assets/componets/header.html").then(() => {
      iniciarMenuMovil();
    });
  
    cargarComponente("footer", "assets/componets/footer.html");
  });
  
  async function cargarComponente(id, ruta) {
    const contenedor = document.getElementById(id);
    if (!contenedor) return;
  
    try {
      const respuesta = await fetch(ruta);
      if (!respuesta.ok) throw new Error("No se encontró " + ruta);
  
      const html = await respuesta.text();
      contenedor.innerHTML = html;
    } catch (error) {
      console.error("Error cargando componente:", ruta, error);
    }
  }
  
  function iniciarMenuMovil() {
    const botones = document.querySelectorAll(".nav-button");
  
    if (!botones.length) return;
  
    const esMovil = () => window.matchMedia("(max-width: 768px)").matches;
  
    botones.forEach((boton) => {
      boton.addEventListener("click", function (event) {
        if (!esMovil()) return;
  
        if (!this.classList.contains("is-open")) {
          event.preventDefault();
  
          botones.forEach((btn) => {
            btn.classList.remove("is-open");
          });
  
          this.classList.add("is-open");
          return;
        }
      });
    });
  
    document.addEventListener("click", function (event) {
      if (!esMovil()) return;
  
      if (!event.target.closest(".nav-button")) {
        botones.forEach((btn) => {
          btn.classList.remove("is-open");
        });
      }
    });
  
    window.addEventListener("resize", function () {
      if (!esMovil()) {
        botones.forEach((btn) => {
          btn.classList.remove("is-open");
        });
      }
    });
  }