import "../css/app.css";

import "./utils/api";

import $ from "jquery";
import { Toast } from "./components/Swal/swal";
import phrases from "../phrases.json";

window.jQuery = window.$ = $;

type Phrase = {
	id: number;
	quote: string;
	author: string;
};

const rotatePhrases = () => {
	const targets = Array.from(document.querySelectorAll<HTMLElement>("[data-phrase-rotator]"));
	if (targets.length === 0) {
		return;
	}

	const phraseList = phrases as Phrase[];
	if (!phraseList.length) {
		return;
	}

	const updatePhrase = () => {
		const nextPhrase = phraseList[Math.floor(Math.random() * phraseList.length)];
		for (const target of targets) {
			const quoteEl = target.querySelector<HTMLElement>("[data-phrase-quote]");
			const authorEl = target.querySelector<HTMLElement>("[data-phrase-author]");

			if (quoteEl) {
				quoteEl.textContent = nextPhrase.quote;
			}
			if (authorEl) {
				authorEl.textContent = nextPhrase.author;
			}
		}
	};

	updatePhrase();
	window.setInterval(updatePhrase, 60_000);
};

document.addEventListener("DOMContentLoaded", () => {
	const logoutForm = document.getElementById("form-sidebar-logout") as HTMLFormElement | null;

	if (logoutForm) {
		logoutForm.addEventListener("submit", async (event) => {
			event.preventDefault();

			Toast.info("Saindo...");

			const tokenInput = logoutForm.querySelector('input[name="_token"]') as HTMLInputElement | null;
			const csrfToken = tokenInput?.value ?? "";

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
	}

	rotatePhrases();
});
