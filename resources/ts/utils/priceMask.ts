const onlyDigits = (value: string) => value.replace(/\D+/g, "");

export const maskPrice = (value: string): string => {
    const digits = onlyDigits(value);
    if (!digits) return "";

    if (digits.length <= 2) {
        return digits;
    }

    const integerPart     = digits.slice(0, -2);
    const decimalPart     = digits.slice(-2);
    const integerWithDots = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return `${integerWithDots},${decimalPart}`;
};

export const parsePriceToNumber = (value: string): number => {
    if (!value) return 0;
    return Number(value.replace(/\./g, "").replace(",", "."));
};
