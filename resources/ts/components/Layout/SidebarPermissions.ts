import $ from "jquery";

function hideSidebarLinkById(linkId: string): void {
    const $link = $(`#${linkId}`);
    if ($link.length === 0) return;
    $link.addClass("hidden");
}

export function applySidebarPermissions(typeUserId: number): void {
    if (typeUserId === 3) {
        hideSidebarLinkById("link-sidebar-dashboard");
        hideSidebarLinkById("link-sidebar-users");
        hideSidebarLinkById("link-sidebar-providers");
    }
}

$(document).ready(() => {

    const $sidebar: JQuery<HTMLElement> = $('#sidebar-main');

    $(document).on('click', '#btn-open-sidebar', (e: JQuery.ClickEvent) => {
        e.preventDefault();
        e.stopPropagation(); 
        $sidebar.removeClass('-translate-x-full');
        $('#btn-open-sidebar').hide();
    });

    $(document).on('click', '#btn-close-sidebar', (e: JQuery.ClickEvent) => {
        e.preventDefault();
        $sidebar.addClass('-translate-x-full');
    });

    $(document).on('click', (e: JQuery.ClickEvent) => {
        const target = e.target as Element;
        
        if (window.innerWidth < 1024 && !$sidebar.hasClass('-translate-x-full')) {

            if (!$sidebar.is(target) && 
                $sidebar.has(target).length === 0 &&
                !$(target).closest('#btn-open-sidebar').length) { 
                
                $sidebar.addClass('-translate-x-full');
            }
        }
    });

    $(window).on('resize', () => {
        if (window.innerWidth >= 1024) {
            $sidebar.addClass('-translate-x-full');
        }
    });
});