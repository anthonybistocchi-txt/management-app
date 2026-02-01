import "../css/app.css";

// Utils
import "./utils/api";
import "./components/Swal/swal";

// Auth pages
import "./pages/auth/login";
import "./pages/auth/reset-password";

// Index pages
import "./pages/admin/dashboard";
import "./pages/admin/Users/users";
import "./pages/index/providers";
import "./pages/index/products";
import "./pages/index/Stock-in/stock-in";
import "./pages/index/stock-out";
import "./pages/admin/movements";
import "./pages/admin/Users/users";
import $ from 'jquery';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";
import 'datatables.net-dt';
flatpickr("#date_range_picker", {
    mode: "range",
    locale: Portuguese, 
    dateFormat: "d/m/Y",
});

// Isso torna o jQuery acessível globalmente (console do navegador e arquivos Blade)
// @ts-ignore (Ignora erro de tipo caso o TS reclame que window não tem essa propriedade)
window.jQuery = window.$ = $;
