import { UFController } from "../../Controllers/UF/UFController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showUfs($selectElement: JQuery<HTMLElement>): Promise<void> {
    const ufs = await UFController.getUfs();

    const sortedUfs = [...ufs].sort((a, b) => a.nome.localeCompare(b.nome));

    renderSelectOptions(
        $selectElement,
        sortedUfs.map((uf) => {
            const regionLabel = uf.regiao?.nome ? ` - ${uf.regiao.nome}` : "";

            return {
                value: uf.sigla,
                label: `${uf.nome}${regionLabel} (${uf.sigla})`,
                data: {
                    ufId: uf.id,
                },
            };
        }),
        {
            placeholder: "Estado",
        }
    );
}
