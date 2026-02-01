import { StockController } from "../../Controllers/Stock/stockSubmit";
import { DatePicker } from "../DatePicker/flatpickr";
import { Toast } from "../Swal/swal";

export async function submitStockIn($selectProduct: JQuery<HTMLElement>,
    $inputQuantity:  JQuery<HTMLElement>,
    $selectProvider: JQuery<HTMLElement>,
    datePickerInstance: ReturnType<typeof DatePicker.initSingle>,
    $textareaDesc:   JQuery<HTMLElement>,
    $selectLocation: JQuery<HTMLElement>,
    $btnSave:        JQuery<HTMLElement>
    ): Promise<void>

    {
  
    const selectedDates = datePickerInstance.selectedDates;
    const today         = new Date();
    
    const currentDateValue = selectedDates.length > 0 
        ? datePickerInstance.formatDate(selectedDates[0], "Y-m-d H:i:s") 
        : null;
                
            const productId   = Number($selectProduct.val());
            const quantity    = Number($inputQuantity.val());
            const providerId  = Number($selectProvider.val());
            const description = String($textareaDesc.val()) || null;
            const finalDate   = String(currentDateValue); 
            const locationId  = Number($selectLocation.val());
                
            if (!productId || !quantity || !providerId || !finalDate || !locationId) {
                Toast.info("Por favor, preencha todos os campos obrigatórios.");
                return;
            }
                
            if (!currentDateValue) {
                Toast.info("Selecione uma data!");
                return;
            }
            if (quantity <= 0) {
                Toast.info("A quantidade deve ser maior que zero.");
                return;
            }
    
            if (finalDate > String(today)) {
                Toast.info("A data não pode ser no futuro.");
                return;
            }

            $btnSave.html('Salvando...').prop('disabled', true);
    
            const result = await StockController.handleSubmitStockIn(productId, quantity, providerId, finalDate, description, locationId);
    
            if (result) {
                Toast.success("Entrada de estoque registrada com sucesso!");
    
                $selectProduct.prop('selectedIndex', 0); 
                $selectProvider.prop('selectedIndex', 0);
                $selectLocation.prop('selectedIndex', 0);
                $inputQuantity.val('');
                $textareaDesc.val(''); 
                
                datePickerInstance.setDate(new Date()); 
            }
    
            $btnSave.html('Salvar').prop('disabled', false);
}