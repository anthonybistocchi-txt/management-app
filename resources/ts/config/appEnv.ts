/**
 * Flag vinda do .env (HAS_SUBSIDIARIES), injetada no HTML pelo Blade:
 * <html data-has-subsidiaries="true|false">
 *
 * - true: há filiais/unidades — carregar localizações e enviar location_id.
 * - false: não fazer nada relacionado a localização no front.
 */
export function hasSubsidiaries(): boolean {
    const raw = document.documentElement.getAttribute('data-has-subsidiaries');

    return raw === 'true' || raw === '1';
}
