import $ from "jquery";

function hideSidebarLinkById(linkId: string): void {
    const $link = $(`#${linkId}`);

    if ($link.length === 0) {
        return;
    }

    $link.addClass("hidden");
}

export function applySidebarPermissions(typeUserId: number): void {
    // Perfil usuário comum: apenas registrar entrada e registrar venda.
    if (typeUserId === 3) {
        hideSidebarLinkById("link-sidebar-dashboard");
        hideSidebarLinkById("link-sidebar-users");
        hideSidebarLinkById("link-sidebar-providers");
    }
}
