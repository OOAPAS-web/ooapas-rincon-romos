document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".custom-select").forEach(select => {

        const trigger = select.querySelector(".custom-select-trigger");
        const options = select.querySelector(".custom-options");
        const hiddenInput = select.querySelector("input[type='hidden']");

        trigger.addEventListener("click", () => {
            document.querySelectorAll(".custom-options").forEach(o => {
                if (o !== options) o.classList.remove("show");
            });

            options.classList.toggle("show");
        });

        options.querySelectorAll(".custom-option").forEach(option => {

            option.addEventListener("click", () => {

                const value = option.dataset.value;
                const text = option.textContent;

                trigger.querySelector("span").textContent = text;
                hiddenInput.value = value;

                options.classList.remove("show");

                document.dispatchEvent(new CustomEvent("filtro-cambiado"));
            });

        });

    });

    document.addEventListener("click", e => {

        if (!e.target.closest(".custom-select")) {

            document.querySelectorAll(".custom-options").forEach(o => {
                o.classList.remove("show");
            });

        }

    });

});