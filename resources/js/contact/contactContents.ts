import $ from "jquery";

export interface formContact {
     name: string;
     email: string;
     message: string;
}

export async function getInputsContact() {
     const name = $("#name").val() as string;
     const email = $("#email").val() as string;
     const message = $("#message").val() as string;

     return {
          name,
          email,
          message
     };
}

