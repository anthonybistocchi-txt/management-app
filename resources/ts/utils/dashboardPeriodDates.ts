/** Datas YYYY-MM-DD em horário local (evita desvio de fuso). */
function parseYmd(s: string): Date {
    const part = s.slice(0, 10);
    const [y, m, d] = part.split("-").map(Number);

    return new Date(y, m - 1, d);
}

function formatYmd(d: Date): string {
    const y = d.getFullYear();
    const m = String(d.getMonth() + 1).padStart(2, "0");
    const day = String(d.getDate()).padStart(2, "0");

    return `${y}-${m}-${day}`;
}

/** Lista cada dia entre from e to (inclusive), como YYYY-MM-DD. */
export function eachDayInclusive(dateFrom: string, dateTo: string): string[] {
    const start = parseYmd(dateFrom);
    const end = parseYmd(dateTo);
    const out: string[] = [];
    const d = new Date(start);

    while (d <= end) {
        out.push(formatYmd(new Date(d)));
        d.setDate(d.getDate() + 1);
    }

    return out;
}

/**
 * Espelha a regra do DashboardRepository (Carbon): mesmo número de dias,
 * terminando no dia anterior ao início do período atual.
 */
export function getPreviousPeriodRange(dateFrom: string, dateTo: string): { from: string; to: string } {
    const curFrom = parseYmd(dateFrom);
    const curTo = parseYmd(dateTo);
    const periodDays = Math.round((curTo.getTime() - curFrom.getTime()) / 86400000) + 1;

    const prevTo = new Date(curFrom);
    prevTo.setDate(prevTo.getDate() - 1);

    const prevFrom = new Date(prevTo);
    prevFrom.setDate(prevFrom.getDate() - (periodDays - 1));

    return { from: formatYmd(prevFrom), to: formatYmd(prevTo) };
}
