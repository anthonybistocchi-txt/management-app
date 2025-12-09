import "../css/app.css";

// Utils
import "./utils/api";
import "./components/swal";

// Auth pages
import "./pages/auth/login";
import "./pages/auth/reset-password";

// Index pages
import "./pages/admin/dashboard";
import "./pages/admin/users";
import "./pages/index/providers";
import "./pages/index/products";
import "./pages/index/stock-in";
import "./pages/index/stock-out";
import "./pages/admin/movements";
import "./pages/admin/users";
import $ from 'jquery';

// Isso torna o jQuery acessível globalmente (console do navegador e arquivos Blade)
// @ts-ignore (Ignora erro de tipo caso o TS reclame que window não tem essa propriedade)
window.jQuery = window.$ = $;
