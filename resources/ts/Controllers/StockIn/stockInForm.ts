import { SubmitStockInService } from "../../Services/StockInService/SubmitService";
import { Toast } from "../../components/Swal/swal";

export const StockInFormController = {
    async handleSubmit(
        event: JQuery.TriggeredEvent, 
        elements: {
            $product: JQuery,
            $qty: JQuery,
            $provider: JQuery,
            $obs: JQuery,
            $date: JQuery,
            $btn: JQuery
        },
        dateValue: string
    ) {
        event.preventDefault();

        const productId  = Number(elements.$product.val());
        const quantity   = Number(elements.$qty.val());
        const providerId = Number(elements.$provider.val());
        const obs        = elements.$obs.val() as string;
        const finalDate  = String(dateValue || elements.$date.val());

        if (!productId || !quantity || !providerId || !finalDate) {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
            return;
        }

        
        elements.$btn.html('Salvando...').prop('disabled', true);

        try {
            const requestData: FormStockInData = {
                product_id:   productId,
                quantity:     quantity,
                provider_id:  providerId,
                date:         finalDate,
                observations: obs || null
            };

            const response = await SubmitStockInService.submitStockIn(requestData);

            if (response.success) {
                Toast.success("Entrada salva com sucesso!");
               
                elements.$product.val('');
                elements.$qty.val('');
                elements.$provider.val('');
                elements.$obs.val('');
                elements.$date.val('');
                
            } else {
                Toast.error("Erro ao enviar entrada de estoque.");
            }

        } catch (error) {
            console.error("Erro no submit:", error);
            Toast.error("Erro crítico ao salvar. Contate o suporte.");
        } finally {
            elements.$btn.html('Salvar').prop('disabled', false);
        }
    }
};