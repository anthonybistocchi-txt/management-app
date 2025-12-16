export function formatPrice(centavos: number | string): string {
    const valueReais = Number(centavos) / 100;

    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(valueReais);
}