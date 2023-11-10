window.addEventListener("DOMContentLoaded", () => {
	iniciarApp();
});

function iniciarApp() {
	menuMovil();
	darkMode();
	// Dark mode dinamico
	dinamicDarkMode.addEventListener("change", (e) => {
		if (e.matches) {
			body.classList.add("dark");
		}
	});
}

// Funciones
function menuMovil() {
	barras.addEventListener("click", () => {
		menu.classList.toggle("hide");
	});
}

function darkMode() {
	// Dark mode estatico / inicio
	if (dinamicDarkMode.matches) {
		body.classList.add("dark");
	}
	darkBtn.addEventListener("click", () => {
		body.classList.toggle("dark");
	});
}
