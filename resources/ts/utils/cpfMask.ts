// resources/ts/utils/maskCpf.ts

export const maskCpf = (value: string): string => {
    return value
        .replace(/\D/g, "")                     // Remove tudo que não é dígito
        .slice(0, 11)                           // Limita a 11 caracteres
        .replace(/(\d{3})(\d)/, "$1.$2")        // Coloca o 1º ponto
        .replace(/(\d{3})(\d)/, "$1.$2")        // Coloca o 2º ponto
        .replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Coloca o traço
};