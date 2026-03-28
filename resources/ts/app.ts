import "../css/app.css";

import "./utils/api";

import $ from "jquery";
import { Toast } from "./components/Swal/swal";

window.jQuery = window.$ = $;

document.addEventListener("DOMContentLoaded", () => {
	const logoutForm = document.getElementById("form-sidebar-logout") as HTMLFormElement | null;

	if (!logoutForm) {
		return;
	}

	logoutForm.addEventListener("submit", async (event) => {
		event.preventDefault();

		Toast.info("Saindo...");

		const tokenInput = logoutForm.querySelector('input[name="_token"]') as HTMLInputElement | null;
		const csrfToken  = tokenInput?.value ?? "";

		try {
			await new Promise((resolve) => setTimeout(resolve, 500));
			await fetch(logoutForm.action, {
				method: "POST",
				headers: {
					"X-Requested-With": "XMLHttpRequest",
					"Accept": "application/json",
					"X-CSRF-TOKEN": csrfToken,
				},
			});
		} catch (error) {
			console.error("Erro ao fazer logout:", error);
		} finally {
			window.location.href = "/login";
		}
	});
});
