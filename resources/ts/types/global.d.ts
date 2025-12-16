import JQuery from 'jquery';

declare global {
    interface Window {
        $: typeof JQuery;
        jQuery: typeof JQuery;
    }
}