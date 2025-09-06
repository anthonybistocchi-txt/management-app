export function isStrongPassword(password: string): boolean {
    const regex = /^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{6,}$/;
    return regex.test(password);
}

console.log("to aqui");