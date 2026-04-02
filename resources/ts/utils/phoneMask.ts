const onlyDigits = (value: string) => value.replace(/\D+/g, "");

export const maskPhone = (value: string): string => {
    const digits = onlyDigits(value).slice(0, 11);

    if (digits.length <= 2) {
        return digits;
    }

    const ddd  = digits.slice(0, 2);
    const rest = digits.slice(2);

    if (rest.length <= 4) {
        return `(${ddd}) ${rest}`;
    }

    if (rest.length <= 8) {
        return `(${ddd}) ${rest.slice(0, 4)}-${rest.slice(4)}`;
    }

    return `(${ddd}) ${rest.slice(0, 5)}-${rest.slice(5)}`;
};
