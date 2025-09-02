import $ from "jquery";

export interface formLogin {
  email: string;
  password: string;
}

export function getInputsLogin(): formLogin {
  const email = ($("#email").val() as string) || "";
  const password = ($("#password").val() as string) || "";

  return {
    email,
    password,
  };
}
