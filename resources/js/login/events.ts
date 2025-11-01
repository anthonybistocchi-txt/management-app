import $ from "jquery";
import { handleSubmitForm } from "./actions/handleSubmitForm";

export function initEventsPage() {
    $("#btn-submit-login").on("click", handleSubmitForm); 
   console.log("Events initialized");
}