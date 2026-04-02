interface CepAutoFillOptions {
    debounceMs?: number;
    mask?: (value: string) => string;
    onCepReady: (cep: string) => Promise<void> | void;
    onlyWhenUser?: boolean;
}

export function bindCepAutoFill(
    $cep: JQuery<HTMLElement>,
    options: CepAutoFillOptions,
): void {
    const debounceMs = options.debounceMs ?? 500;
    const onlyWhenUser = options.onlyWhenUser ?? true;
    let timer: ReturnType<typeof setTimeout> | null = null;

    $cep.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;

        if (options.mask) {
            target.value = options.mask(target.value);
        }

        if (timer) {
            clearTimeout(timer);
        }

        timer = setTimeout(() => {
            const originalEvent = event.originalEvent as { isTrusted?: boolean } | undefined;
            const isUserEvent = typeof originalEvent?.isTrusted === "boolean" ? originalEvent.isTrusted : true;

            if (onlyWhenUser && !isUserEvent) {
                return;
            }

            const cepValue = String(target.value).replace(/\D+/g, "");
            if (cepValue.length !== 8) {
                return;
            }

            void options.onCepReady(cepValue);
        }, debounceMs);
    });
}
