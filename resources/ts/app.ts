import "../css/app.css";

// Utils
import "./Utils/api";
import "./components/swal";

// Auth pages
import "./pages/Auth/login";
import "./pages/Auth/reset-password";

// Index pages
import "./pages/admin/dashboard";
import "./pages/admin/users";
import "./pages/Index/providers";
import "./pages/Index/products";
import "./pages/index/Stock-in/stock-in";
import "./pages/Index/stock-out";
import "./pages/admin/movements";
import "./pages/admin/users";
import $ from 'jquery';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";

flatpickr("#date_range_picker", {
    mode: "range",
    locale: Portuguese, 
    dateFormat: "d/m/Y",
});

// Isso torna o jQuery acessível globalmente (console do navegador e arquivos Blade)
// @ts-ignore (Ignora erro de tipo caso o TS reclame que window não tem essa propriedade)
window.jQuery = window.$ = $;
