/** Formata valor monetário assumindo inteiro em centavos (igual à coluna `products.price`). */
export function formatPrice(centavos: number | string): string {
    const valueReais = Number(centavos) / 100;

    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(valueReais);
}

/** Eixo de gráfico: valores grandes em formato curto (centavos → R$). */
export function formatPriceAxisCompact(centavos: number | string): string {
    const r = Number(centavos) / 100;
    if (!Number.isFinite(r)) {
        return "";
    }
    if (r >= 1_000_000) {
        return `R$ ${(r / 1_000_000).toFixed(1).replace(".", ",")} mi`;
    }
    if (r >= 10_000) {
        return `R$ ${Math.round(r / 1_000)} mil`;
    }

    return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
        maximumFractionDigits: 0,
    }).format(r);
}