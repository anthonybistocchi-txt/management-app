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
import "./pages/Index/stock-in";
import "./pages/Index/stock-out";
import "./pages/admin/movements";
import "./pages/admin/users";
import $ from 'jquery';

// Isso torna o jQuery acessível globalmente (console do navegador e arquivos Blade)
// @ts-ignore (Ignora erro de tipo caso o TS reclame que window não tem essa propriedade)
window.jQuery = window.$ = $;
