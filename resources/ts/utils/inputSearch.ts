export function debounce<TArgs extends unknown[]>(func: (...args: TArgs) => void, wait: number) {
	let timeout: ReturnType<typeof setTimeout> | null = null;

	return (...args: TArgs): void => {
		if (timeout) {
			clearTimeout(timeout);
		}

		timeout = setTimeout(() => {
			func(...args);
		}, wait);
	};
}