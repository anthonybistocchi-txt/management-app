import $ from "jquery";
import { handleSubmitForm } from "./formContents";

export function initEventsPage() {
    $("#btn-submit-contact").on("click", handleSubmitForm);
}