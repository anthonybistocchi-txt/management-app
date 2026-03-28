import { UFController } from "../../Controllers/UF/UFController";

export async function showUfs($selectElement: JQuery<HTMLElement>): Promise<void> {
    const ufs = await UFController.getUfs();

    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Estado</option>');

    const sortedUfs = [...ufs].sort((a, b) => a.nome.localeCompare(b.nome));

    sortedUfs.forEach((uf) => {
        const regionLabel = uf.regiao?.nome ? ` - ${uf.regiao.nome}` : "";
        const option = `<option value="${uf.sigla}" data-uf-id="${uf.id}">${uf.nome}${regionLabel} (${uf.sigla})</option>`;
        $selectElement.append(option);
    });
}
