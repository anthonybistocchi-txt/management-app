import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";
import "flatpickr/dist/flatpickr.css";
import { Instance } from "flatpickr/dist/types/instance";

export const DatePicker = {

    initRange($element: JQuery<HTMLElement>, onChange?: DateRangeCallback): Instance {
        
        const today        = new Date();
        const sevenDaysAgo = new Date();

        sevenDaysAgo.setDate(today.getDate() - 7);

        return flatpickr($element[0], {
            mode: "range",
            dateFormat: "d/m/Y",
            locale: Portuguese,
            defaultDate: [sevenDaysAgo, today],
            
            onChange: (selectedDates, dateStr, instance) => {
                if (selectedDates.length === 2 && onChange) {
                    const start = instance.formatDate(selectedDates[0], "Y-m-d");
                    const end = instance.formatDate(selectedDates[1], "Y-m-d");
                    onChange(start, end);
                }
            },
            onReady: (selectedDates, dateStr, instance) => {
                 if (selectedDates.length === 2 && onChange) {
                    const start = instance.formatDate(selectedDates[0], "Y-m-d");
                    const end = instance.formatDate(selectedDates[1], "Y-m-d");
                    onChange(start, end);
                }
            }
        });
    },

    initSingle($element: JQuery<HTMLElement>, defaultDate?: string | Date): Instance {
        return flatpickr($element[0], {
            mode: "single",
            dateFormat: "d/m/Y",
            locale: Portuguese,
            defaultDate: defaultDate,
            allowInput: true // Permite digitar se quiser
        });
    }
};